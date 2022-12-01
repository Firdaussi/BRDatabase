<?php
  $lwidth = 36;

  include_once("lib/MyTables.class.php");
  include_once("lib/brlib.php");
  
  fn_check_id(999999);

  $tb_class = new MyTables("class_data");

  $tb_class->set_align("V");
  $tb_class->suppress_nulls();
  $tb_class->add_row_lwidth($lwidth);
  $tb_class->add_caption("Class Types");

  $sql = 'SELECT   scc.s_class_code,
                   scc.company,
                   scc.extra_info,
                   date_format(scc.start_date, "%m/%Y") AS sdate,
                   NULL    as scc1,
                   NULL    as scc2,
                   NULL    as scc3
          FROM     s_class_codes scc
		  WHERE    scc.s_class_id = ' .$id. '
          GROUP BY 1,2,3,4,5,6,7
		  ORDER BY scc.start_date';
		  
  $result = $db->execute($sql);
  $sccct = $db->count_select();

  $nx = 0; $tabct = 0;
  if ($result)
  {
  if ($db->count_select())
  {
	  while($sccrow = mysqli_fetch_assoc($result))
	  {
		  $nx++; $tabct++;
		  $tb_class->add_row("scc".$nx, $sccrow['company'] . " Class");

		  $sccrow['scc'.$nx] = $sccrow['s_class_code'];

		  if (!empty($sccrow['extra_info']))
		    $sccrow['scc'.$nx] .= " (" . $sccrow['extra_info'] . ")";
		
		  $tb_class->add_data($sccrow);
	  }
  }
  }
  
  /* Also add any nicknames */
  $sql = 'SELECT   scc.nickname,
                   scc.info,
                   NULL    as scc4,
                   NULL    as scc5,
                   NULL    as scc6
          FROM     s_class_nn scc
		  WHERE    scc.s_class_id = ' .$id. '
          GROUP BY 1,2,3,4,5
		  ORDER BY scc.start_date';
		  
  $result = $db->execute($sql);
  $sccct += $db->count_select();

  if ($result)
  {
  if ($db->count_select())
  {
	  while($sccrow = mysqli_fetch_assoc($result))
	  {
		  $nx++; $tabct++;
		  $tb_class->add_row("scc".$nx, "(Also known as)");

		  $sccrow['scc'.$nx] = $sccrow['nickname'];

		  if (!empty($sccrow['info']))
		    $sccrow['scc'.$nx] .= " (" . $sccrow['info'] . ")";
		
		  $tb_class->add_data($sccrow);
	  }
  }
  }
  
  $sccrow = NULL;

/****************************************************************************************/
/* Get main details from Class table                                                    */
/****************************************************************************************/

  $sql = 'SELECT sc.*,
                 scd.description                      AS description,
                 concat(CASE WHEN p1.title IS NOT NULL THEN
                          concat(p1.title, " ")
                        ELSE
                          ""
                        END,
                        p1.forename,
                        " ",
                        p1.surname)                   AS vdesigner,
                 p2.surname                           AS vmodifier,
                 ifnull(c1.cmp_name, sc.prg_company)  AS vprg_company,
                 concat("companies.php?page=", sc.big4_company,
                        "&prg=", sc.prg_company)  AS vprg_company_hl,
                 ifnull(c2.cmp_name, sc.big4_company) AS vbig4_company,
                 concat("companies.php?page=", sc.big4_company)
                                                      AS vbig4_company_hl,
                 sw.work
          from   s_class sc

          left join ref_companies c1
          on     sc.prg_company  = c1.cmp_initials

          left join ref_companies c2
          on     sc.big4_company = c2.cmp_initials

          LEFT JOIN ref_people p1
          ON     p1.p_id = sc.designer_id

          LEFT JOIN ref_people p2
          ON     p2.p_id = sc.modifier_id

          LEFT JOIN s_class_desc scd
          ON     scd.s_class_id = sc.s_class_id
          
          LEFT JOIN s_work sw
          ON     sw.s_class_id = sc.s_class_id

          where  sc.s_class_id = ' .$id;
         
  $result = $db->execute($sql);


  $nx++;

  if ($result)
  {
  if ($db->count_select())
    $row = mysqli_fetch_assoc($result);

  if ($row['br_standard'] = "N")
    $row['br_standard'] = "";

  if ($row['first_in_service'])
    $row['first_in_service'] = fn_fdate($row['first_in_service']);

  if ($row['last_in_service'])
    $row['last_in_service'] = fn_fdate($row['last_in_service']);
  }

  $tb_basics = new MyTables("basics");
  $tb_basics->set_align("V");
  $tb_basics->suppress_nulls();
  $tb_basics->add_row_lwidth($lwidth);
  $tb_basics->add_caption("General");
  $tb_basics->add_row("vdesigner",            "Designer");
  $tb_basics->add_row("vmodifier",            "Rebuilt By");
  $tb_basics->add_row("year_introduced",      "Introduced");
  $tb_basics->add_row("vprg_company",         "Pre-Grouping");
  $tb_basics->add_row("vbig4_company",        "Big Four");
  $tb_basics->add_row("description",          "Description (1957)");
  $tb_basics->add_row("br_standard",          "BR Standard");
  $tb_basics->add_row("wheel_arrangement",    "Wheels");
  $tb_basics->add_row("loco_count",           "Number Built as " . $row['identifier']);
  $tb_basics->add_row("rblt_in",              "Conversions from other classes");
  $tb_basics->add_row("rblt_out",             "Conversions to other classes");
  $tb_basics->add_row("locos_scrapped",       "Number Scrapped");
  $tb_basics->add_row("locos_preserved",      "Number Preserved");
  $tb_basics->add_row("first_in_service",     "First in Service");
  $tb_basics->add_row("last_in_service",      "Last in Service");
  $tb_basics->add_row("manufacturers",        "Manufacturers");
  $tb_basics->add_row("orders",               "Orders");
  $tb_basics->add_row("historical",           "Historical Data");
  $tb_basics->add_row("work",                 "Allocations and Work");

/****************************************************************************************/
/* Get main details from Class table                                                    */
/****************************************************************************************/

  $sql = 'SELECT b.bl_name,
                 concat("sites.php?page=builders&id=", b.bl_code) AS bl_name_hl,
                 count(*)     AS ct
          FROM   steam s

          JOIN  (SELECT DISTINCT scl.loco_id
                 FROM   s_class_link scl
                 WHERE  s_class_id = ' . $id . ') AS F
          ON     F.loco_id = s.loco_id

          JOIN   ref_builders b
          ON     b.bl_code = s.bl_code

          GROUP BY b.bl_name,
                   bl_name_hl';

  $nb = 0;

  $result = $db->execute($sql);

  if ($result)
  {
  if ($db->count_select())
  {
    $line = "<table width=99% frame=\"box\"><tr><td width=80%><strong>Manufacturer</strong></td>";
    $line .=                               "<td width=20%><strong>Total</strong></td></tr>";

    while ($rowb = mysqli_fetch_assoc($result))
    {
      $line .= "<tr><td width=80%><a href=\"" . $rowb['bl_name_hl'] . "\">" .
                                                $rowb['bl_name']    . "</a></td>";
      $line .= "    <td width=20%>" . $rowb['ct'] . "</td></tr>";
    }

    $line .= "</table>";
    $row['manufacturers'] = $line;
  }

  $tb_basics->add_data($rowb);
  }

/****************************************************************************************/
/* Get order details                                                                    */
/****************************************************************************************/

  $nb = 0;
  $line = "";

  $sql = 'SELECT CASE when o.lot_number is not null then
                   concat(o.lot_number, "/", o.order_number)
                      else
                   o.order_number
                 END as order_number,
                 concat("sites.php?page=builders&subpage=orders&id=", b.bl_code,
                        "&lot=", o.order_number,
                        "&oid=", o.order_id)                      AS order_number_hl,
                 o.order_date,
                 o.bl_code_var,
                 o.size,
                 o.info,
                 o.virtual_ind,
                 o.acc_order_number,
                 concat("sites.php?page=builders&subpage=orders&id=", b_acc.bl_code,
                        "&lot=", o.order_number,
                        "&oid=", o.order_id)                          AS acc_order_number_hl,
                 o.order_date,
                 b.bl_name,
                 b.bl_code,
                 concat("sites.php?page=builders&id=", b.bl_code)     AS bl_name_hl,
                 b_acc.bl_name                                        AS bl_acc_name,
                 b_acc.bl_code                                        AS bl_acc_code,
                 concat("sites.php?page=builders&id=", b_acc.bl_code) AS bl_acc_name_hl
          FROM   ref_orders o
          
          JOIN   ref_builders b
          ON     b.bl_code = o.bl_code
          
          LEFT JOIN   ref_builders b_acc
          ON     b_acc.bl_code = o.acc_bl_code
          
          WHERE  o.class_id = ' . $id .'
          AND    o.type = "S"
          ORDER BY o.order_date, o.order_number';

  // echo $sql;
  
  $result = $db->execute($sql);

  if ($result)
  {
  if ($db->count_select())
  {
    $line = "<table width=99% frame=\"box\"><tr><td width=28%><strong>Builder</strong></td>";
    $line .=                               "<td width=28%><strong>Sponsor</strong></td>";
    $line .=                               "<td width=20%><strong>Order #</strong></td>";
    $line .=                               "<td width=14%><strong>Date</strong></td>";
    $line .=                               "<td width=10%><strong>Size</strong></td></tr>";

    while ($rowb = mysqli_fetch_assoc($result))
    {
      if ($rowb['virtual_ind'] == "Y")
        $rowb['order_number'] = "n/a";

      $rowb['order_date'] = fn_fdate($rowb['order_date']);

      $line .= "<tr><td><a href=\"" . $rowb['bl_name_hl'] . "\">" .
                                                $rowb['bl_name']    . "</a>";
      if (strcmp($rowb['bl_code'], "NB") == 0)
        $line .= " (" . fn_get_NB($rowb['bl_code_var']) . ")";
        
      $line .= "</td><td>";
    
      if (!empty(($rowb['acc_order_number'])) && !empty(($rowb['bl_acc_code'])))
      {
        $line .= "<a href=\"" . $rowb['bl_acc_name_hl'] . "\">" .
                                $rowb['bl_acc_name']    . "</a>";
      }
      else
        $line .= "&nbsp;";
      
      $line .= "</td>";

      if (!empty(($rowb['acc_order_number'])) && !empty(($rowb['bl_acc_code'])))
      {
        $line .= "    <td><a href=\"" . $rowb['order_number_hl'] . "\">" .
                                        $rowb['order_number'] . " (" . 
                                        $rowb['bl_acc_code'] . " ". 
                                        $rowb['acc_order_number'] . ")</a></td>";
      }
      else
      {
        $line .= "    <td><a href=\"" . $rowb['order_number_hl'] . "\">" .
                                        $rowb['order_number'] . "</a></td>";
      }
      
      $line .= "    <td>" . $rowb['order_date'] . "</td>";
      $line .= "    <td>" . $rowb['size'] . "</td></tr>";
    }

    $line .= "</table>";
    $row['orders'] = $line;
  }

  $tb_basics->add_data($row); $line = "";
  }

/****************************************************************************************/
/* Get details from the variations Class table                                          */
/****************************************************************************************/

  $lwidth = 20;
  $rwidth = 80;

  $tb_misc = new MyTables("misc");
  $tb_misc->set_align("V");
  $tb_misc->suppress_nulls();
  $tb_misc->add_row_lwidth($lwidth);
  $tb_misc->add_caption("Power");
  $tb_misc->add_row("str_class_type_fmt",     "");
  $tb_misc->add_row("int_subtype_introduced", "Variant Introduced");
  $tb_misc->add_row("str_differences",        "Miscellaneous Differences");
  $tb_misc->add_row("int_power_rating",       "Power Rating");
  $tb_misc->add_row("lbs_tractive_effort",    "Tractive Effort");
  $tb_misc->add_row("lbs_bs_tractive_effort", "Booster Tractive Effort");
  $tb_misc->add_row("int_tcyl_num",           "Number of Cylinders");
  $tb_misc->add_row("str_icyl_desc_i",        "Inside Cylinders");
  $tb_misc->add_row("str_icyl_valves",        "Inside Valves");
  $tb_misc->add_row("str_imotion",            "Inside Motion");
  $tb_misc->add_row("str_ocyl_desc_i",        "Outside Cylinders");
  $tb_misc->add_row("str_ocyl_valves",        "Outside Valves");
  $tb_misc->add_row("str_omotion",            "Outside Motion");

  $tb_wheels = new MyTables("wheels");
  $tb_wheels->set_align("V");
  $tb_wheels->suppress_nulls();
  $tb_wheels->add_row_lwidth($lwidth);
  $tb_wheels->add_caption("Wheels");
  $tb_wheels->add_row("str_class_type_fmt",   "");
  $tb_wheels->add_row("ft_leading_wheels",    "Pony");
  $tb_wheels->add_row("ft_coupled_wheels",    "Drivers");
  $tb_wheels->add_row("ft_trailing_wheels",   "Truck");
  $tb_wheels->add_row("ft_wheelbase_loco",    "Locomotive Wheelbase");
  $tb_wheels->add_row("ft_wheelbase_tender",  "Tender Wheelbase");
  $tb_wheels->add_row("ft_wheelbase",         "Total Wheelbase");
  $tb_wheels->add_row("str_wheelbase_desc",   "Descriptive Wheelbase");

  $tb_dim = new MyTables("dimensions");
  $tb_dim->set_align("V");
  $tb_dim->suppress_nulls();
  $tb_dim->add_row_lwidth($lwidth);
  $tb_dim->add_caption("Dimensions");
  $tb_dim->add_row("str_class_type_fmt",      "");
  $tb_dim->add_row("ft_length_over_buffers",  "Length (over buffers)");
  $tb_dim->add_row("wt_weight_full",          "Weight (in running order)");
  $tb_dim->add_row("wt_weight_loco",          "Weight (loco only)");
  $tb_dim->add_row("wt_adhesive_weight",      "Adhesive Weight");
  $tb_dim->add_row("wt_max_axle_load",        "Maximum Axle Load");
  $tb_dim->add_row("gal_water_capacity",      "Water Capacity");
  $tb_dim->add_row("wt_coal_capacity",        "Coal Capacity");

  $tb_boiler = new MyTables("boiler");
  $tb_boiler->set_align("V");
  $tb_boiler->suppress_nulls();
  $tb_boiler->add_row_lwidth($lwidth);
  $tb_boiler->add_caption("Boiler & Firebox");
  $tb_boiler->add_row("str_class_type_fmt",           "");
  $tb_boiler->add_row("str_boiler_diagram",           "Boiler Diagram");
  $tb_boiler->add_row("str_boiler_notes",             "Boiler Notes");
  $tb_boiler->add_row("ft_boiler_diameter_outside",   "Boiler Max Diameter");
  $tb_boiler->add_row("ft_boiler_diameter_tapered",   "Boiler Min Diameter - tapered boiler");
  $tb_boiler->add_row("ft_boiler_barrel_length",      "Boiler Barrel Length");
  $tb_boiler->add_row("lbs_boiler_pressure",          "Boiler Pressure");
  $tb_boiler->add_row("ft_boiler_pitch",              "Boiler Pitch");
  $tb_boiler->add_row("str_firebox_type",             "Firebox Type");
  $tb_boiler->add_row("ft_boiler_firebox_length",     "Firebox Length");
  $tb_boiler->add_row("area_grate_area",              "Firebox Grate Area");
  $tb_boiler->add_row("area_hs_firebox_area",         "Firebox Heating Surface");
  $tb_boiler->add_row("int_hs_tube_num",              "Tube Number");
  $tb_boiler->add_row("inch_hs_tube_diameter",        "Tube Diameter");
  $tb_boiler->add_row("area_hs_tube_area",            "Tube Area");
  $tb_boiler->add_row("tubes",                        "Tubes");
  $tb_boiler->add_row("int_hs_flue_num",              "Flue Elements");
  $tb_boiler->add_row("inch_hs_flue_diameter",        "Flue Diameter");
  $tb_boiler->add_row("area_hs_flue_area",            "Flue Area");
  $tb_boiler->add_row("flues",                        "Flues");
  $tb_boiler->add_row("area_hs_total_evaporative",    "Total Evaporative Area");
  $tb_boiler->add_row("int_hs_superheater_num",       "Superheater Elements");
  $tb_boiler->add_row("inch_hs_superheater_diameter", "Superheater Element Diameter");
  $tb_boiler->add_row("area_hs_superheater_area",     "Superheater Element Area");
  $tb_boiler->add_row("superheater",                  "Superheater");
  $tb_boiler->add_row("area_total_heating_surface",   "Total Heating Area");

  $sql = 'SELECT coalesce(scv.descriptive, scv.class_type)
                                            AS str_class_type,
                 scv.misc_differences       AS str_differences,
                 concat("locoqry.php?action=class&id=", scv.s_class_id, 
                        "&type=S&page=fleet&var=", scv.s_class_var_id)
                                            AS hl_class_type,
                 scv.compound_flag          AS flg_compound_flag,
                 scv.icyl_num               AS int_icyl_num,
                 scv.icyl_diam              AS inch_icyl_diam,
                 scv.icyl_throw             AS inch_icyl_throw,
                 CASE WHEN scv.icyl_diam is not null AND scv.icyl_throw is not null THEN
                   concat(scv.icyl_diam, "\" x ", scv.icyl_throw, "\" (", scv.icyl_num, 
                                                                            " off)") ELSE
                   NULL
                 END                        AS str_icyl_desc_i,
                 CASE WHEN scv.icyl_diam is not null AND scv.icyl_throw is not null THEN
                   concat(scv.icyl_diam*2.53, "cm x ", scv.icyl_throw*2.53, "cm (", scv.icyl_num,
                                                                            " off)") ELSE
                   NULL
                 END                        AS str_icyl_desc_d,
                 CASE WHEN scv.icyl_valve_diam IS NOT NULL THEN
                   concat(scv.icyl_valve_diam, "\"", scv.icyl_valves, " ")
                 ELSE
                   scv.icyl_valves
                 END                        AS str_icyl_valves,
                 scv.icyl_compound          AS flg_icyl_compound,
                 scv.imotion                AS str_imotion,
                 scv.ocyl_num               AS int_ocyl_num,
                 scv.ocyl_diam              AS inch_ocyl_diam,
                 scv.ocyl_throw             AS inch_ocyl_throw,
                 CASE WHEN scv.ocyl_diam is not null AND scv.ocyl_throw is not null THEN
                   concat(scv.ocyl_diam, "\" x ", scv.ocyl_throw, "\" (", scv.ocyl_num, 
                                                                            " off)") ELSE
                   NULL
                 END                        AS str_ocyl_desc_i,
                 CASE WHEN scv.ocyl_diam is not null AND scv.ocyl_throw is not null THEN
                   concat(scv.ocyl_diam*2.53, "cm x ", scv.ocyl_throw*2.53, "cm (", scv.ocyl_num,
                                                                            " off)") ELSE
                   NULL
                 END                        AS str_ocyl_desc_d,
                 CASE WHEN scv.ocyl_valve_diam IS NOT NULL THEN
                   concat(scv.ocyl_valve_diam, "\"", scv.ocyl_valves, " ")
                 ELSE
                   scv.ocyl_valves
                 END                        AS str_ocyl_valves,
                 scv.ocyl_compound          AS flg_ocyl_compound,
                 scv.omotion                AS str_omotion,
                 scv.boiler_type_id         AS int_boiler_type_id,
                 scv.boiler_pitch           AS ft_boiler_pitch,
                 scv.leading_wheels         AS ft_leading_wheels ,
                 scv.coupled_wheels         AS ft_coupled_wheels ,
                 scv.trailing_wheels        AS ft_trailing_wheels ,
                 scv.tractive_effort        AS lbs_tractive_effort ,
                 scv.length_over_buffers    AS ft_length_over_buffers ,
                 scv.weight_full            AS wt_weight_full ,
                 scv.weight_loco            AS wt_weight_loco ,
                 scv.adhesive_weight        AS wt_adhesive_weight ,
                 scv.max_axle_load          AS wt_max_axle_load ,
                 scv.water_capacity         AS gal_water_capacity ,
                 scv.coal_capacity          AS wt_coal_capacity ,
                 scv.wheelbase              AS ft_wheelbase ,
                 scv.wheelbase_loco         AS ft_wheelbase_loco ,
                 scv.wheelbase_tender       AS ft_wheelbase_tender ,
                 scv.wheelbase_desc         AS str_wheelbase_desc ,
                 scv.big_four               AS str_big_four ,
                 scv.pre_grouping           AS str_pre_grouping ,
                 scv.ra                     AS int_ra ,
                 scv.power_rating	        AS str_power_rating,
                 scv.s_class_var_base       AS ign_var_base,
                 sb.tractive_effort         AS lbs_bs_tractive_effort,
                 sb.num_cylinders           AS int_bs_num_cylinders,
                 sb.cylinder_location       AS str_bs_cylinder_location,
                 CASE WHEN sb.cyl_diam is not null AND sb.cyl_throw is not null THEN
                   concat(sb.cyl_diam, "\" x ", sb.cyl_throw, "\"") ELSE
                   NULL
                 END                        AS str_bs_cyl_desc_i,
                 CASE WHEN sb.cyl_diam is not null AND sb.cyl_throw is not null THEN
                   concat(sb.cyl_diam*2.53, "cm x ", sb.cyl_throw*2.53, "cm") ELSE
                   NULL
                 END                        AS str_bs_cyl_desc_d,
                 sb.valve_type              AS str_bs_valve_type,
                 sb.gear_ratio              AS str_bs_gear_ratio,
                 scv.year_introduced        AS int_subtype_introduced,
                 bt.boiler_max_diam_outside AS ft_boiler_diameter_outside,
                 bt.boiler_min_diam_outside AS ft_boiler_diameter_tapered,
                 bt.boiler_barrel_length    AS ft_boiler_barrel_length,
                 bt.boiler_firebox_length   AS ft_boiler_firebox_length,
                 bt.boiler_diagram_no       AS str_boiler_diagram,
                 bt.firebox_type            AS str_firebox_type,
                 bt.notes                   AS str_boiler_notes,
                 bt.hs_firebox_area         AS area_hs_firebox_area,
                 bt.hs_firebox_tubes        AS area_hs_firebox_tubes,
                 bt.hs_tube_num             AS int_hs_tube_num,
                 bt.hs_tube_diameter        AS inch_hs_tube_diameter,
                 bt.hs_tube_area            AS area_hs_tube_area,
                 bt.hs_flue_num             AS int_hs_flue_num,
                 bt.hs_flue_diameter        AS inch_hs_flue_diameter,
                 bt.hs_flue_area            AS area_hs_flue_area,
                 bt.hs_total_evaporative    AS area_hs_total_evaporative,
                 bt.hs_superheater_num      AS int_hs_superheater_num,
                 bt.hs_superheater_diameter AS inch_hs_superheater_diameter,
                 bt.hs_superheater_area     AS area_hs_superheater_area,
                 bt.total_heating_surface   AS area_total_heating_surface,
                 bt.grate_area              AS area_grate_area,
                 bt.boiler_pressure         AS lbs_boiler_pressure

          FROM   s_class_var scv

          LEFT JOIN s_booster sb
          ON     scv.booster_id = sb.booster_id

          LEFT JOIN ref_boiler_type bt
          ON     bt.boiler_type_id = scv.boiler_type_id

          WHERE  scv.s_class_id = ' .$id. '
          ORDER BY scv.s_class_var_id ASC';

  // echo $sql;

  $result = $db->execute($sql);

  $ct = $db->count_select();

  if ($ct > 1) 
  {
    //printf("Count is %d<br />", $ct);
    $tb_wheels->add_row_rwidth(($rwidth/$ct));
    $tb_dim->add_row_rwidth(($rwidth/$ct));
    $tb_boiler->add_row_rwidth(($rwidth/$ct));
    $tb_misc->add_row_rwidth(($rwidth/$ct));
  }

  if ($result)
  if ($ct > 0)
    while ($row = mysqli_fetch_assoc($result))
    {
      $arr[] = $row;
      $arr_bak[] = $row;
    }

  if ($ct > 1)
  {
    /* In order to print the table correctly, it is necessary to find out which columns
       have values in them so that if the first column doesn't have a value and the second does,
       we can put a &nbsp; tag in the first to ensure printing. */

    /* If the count is zero, then no engine variations have that data, so don't print it */

    for ($nx = $ny = 0; $nx < $ct; $nx ++)
    {
      foreach ($arr[$nx] as $key => $val)
      {
        //  echo $arr[$nx][$key] . "<br />";
        if (!empty($arr[$nx][$key]))
          $v[$key] ++;
        else
          $v[$key] += 0;
        $ny++;
      }
      //printf("+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<br />");
      $ny = 0;
    }

    //print_r($v); echo "<br />";
  }

  for ($nx = 0; $nx < $ct; $nx++)
  {
    // if multiple variations, print headers for each column in bold for clarity
    if ($ct > 1)
    {
      $arr[$nx]['str_class_type_fmt'] = "<strong><a href=\"" . $arr[$nx]['hl_class_type'] .
                                    "\">" . $arr[$nx]['str_class_type'] . "</a></strong>";
    }
    else // otherwise don't print at all
      $arr[$nx]['str_class_type'] = "";

    // For this variant, if the s_class_var_base is set, use it for the default (if NULL,
    // use variant 0. Remember the index starts at 0 !!

    if (!empty($arr[$nx]['ign_var_base']))
    {
      $defval = $arr[$nx]['ign_var_base'] -1;
      $class_type = $arr[$defval]['str_class_type'];
      $astag[$defval] = "<div id=\"astag\">As $class_type</div>";
    }
    else
    {
      $defval = 0;
      $class_type = $arr[0]['str_class_type'];
      $astag[0] = "<div id=\"astag\">As $class_type</div>";
    }

    foreach ($arr[$nx] as $key => $val)
    {
      if ($nx > 0)
      {
        if (empty($val) && !empty($arr_bak[$defval][$key]))
          $arr[$nx][$key] = $astag[$defval];
        else
        if (($defval <> 0) && (empty($val) && !empty($arr_bak[0][$key])))
          $arr[$nx][$key] = $astag[0];
        else
        if (!empty($val))                                                                    
        {
          if (strncmp($key, "ft_", 3) == 0)
            $arr[$nx][$key] = $_SESSION['msr'] == "D" ? fn_msr_d($val) : fn_msr_i($val);
          else
          if (strncmp($key, "gal_", 4) == 0)
            $arr[$nx][$key] = fn_ncomma($val) . "gal";
          else
          if (strncmp($key, "wt_", 3) == 0)
            $arr[$nx][$key] = $_SESSION['msr'] == "D" ? fn_tons($val) : fn_tons($val);
          else
          if ((strncmp($key, "int_", 4) == 0) ||
              (strncmp($key, "str_", 4) == 0))
            $arr[$nx][$key] = $val;
          else
          if (strncmp($key, "lbs_", 4) == 0)
            $arr[$nx][$key] = fn_ncomma($val) . "lbs";
          else
          if (strncmp($key, "flg_", 4) == 0)
            $arr[$nx][$key] = $val == "N" ? "No" : "Yes";
          else
          if (strncmp($key, "inch_", 5) == 0)
            $arr[$nx][$key] = fn_nfrac($val) . "\"";
          else
          if (strncmp($key, "ign_", 4) == 0)
            ;
          else
          if (strncmp($key, "hl_", 3) == 0)
            ;
          else
          if (strncmp($key, "area_", 5) == 0)
          {
            $arr[$nx][$key] = fn_area_i($val);
//            echo "[" . $arr[$nx][$key] . "], [" . $val . "]<br />";
          }
          else
            printf("Unknown tag: [%s]<br />\n", $key);
        }
        else
        if ($v[$key] > 0)
          $arr[$nx][$key] = "&nbsp;";
      }
      else
      {
        if (!empty($val))
        {
          if (strncmp($key, "ft_", 3) == 0)
            $arr[$nx][$key] = $_SESSION['msr'] == "D" ? fn_msr_d($val) : fn_msr_i($val);
          else
          if (strncmp($key, "gal__", 4) == 0)
            $arr[$nx][$key] = fn_ncomma($val) . "gal";
          else
          if (strncmp($key, "wt_", 3) == 0)
            $arr[$nx][$key] = $_SESSION['msr'] == "D" ? fn_tons($val) : fn_tons($val);
          else
          if ((strncmp($key, "int_", 4) == 0) ||
              (strncmp($key, "str_", 4) == 0))
            $arr[$nx][$key] = $val;
          else
          if (strncmp($key, "lbs_", 4) == 0)
            $arr[$nx][$key] = fn_ncomma($val) . "lbs";
          else
          if (strncmp($key, "flg_", 4) == 0)
            $arr[$nx][$key] = $val == "N" ? "No" : "Yes";
          else
          if (strncmp($key, "inch_", 5) == 0)
            $arr[$nx][$key] = fn_nfrac($val) . "\"";
          else
          if (strncmp($key, "ign_", 4) == 0)
            ;
          else
          if (strncmp($key, "hl_", 3) == 0)
            ;
          else
          if (strncmp($key, "area_", 5) == 0)
          {
            $arr[$nx][$key] = fn_area_i($val);
//            echo "[" . $arr[$nx][$key] . "], [" . $val . "]<br />";
          }
          else
            printf("Unknown tag: [%s]<br />\n", $key);
        }
        else
        if ($ct > 0 && $v[$key] > 0)
          $arr[$nx][$key] = "&nbsp;";
      }
    }

    // Some tweaking

    $tb_wheels -> add_data($arr[$nx]);
    $tb_dim    -> add_data($arr[$nx]);
    $tb_boiler -> add_data($arr[$nx]);
    $tb_misc   -> add_data($arr[$nx]);
  }

  $arr = array();
  $arr_bak = array();

  $sql = 'SELECT concat("images/locos/steam/",
                        CASE WHEN sc.br_standard = "Y" THEN
                           "BR"
                        ELSE
                           sc.big4_company
                        END, "/", i.image) AS image_location,
                 i.caption,
                 i.photo_date,
                 ic.copyright,
                 ic.copyright_url

          FROM   ref_images i
          JOIN   ref_image_copyright ic
          ON     ic.ic_id = i.ic_id

          JOIN   s_class sc
          ON     sc.s_class_id = i.class_id

          WHERE  i.class_id = ' .$id. '
          AND    i.type = "S"
          AND    i.img_index = "Y"';
          
  $result = $db->execute($sql);

  if ($result)  
  {  
    if ($db->count_select())
      while ($row = mysqli_fetch_assoc($result))
      {
        $img[]  = $row['image_location'];
        $crg[]  = $row['copyright_url'];
        $own[]  = $row['copyright'];
      }
  }

  printf("<table width=99%% frame=box>\n");
  printf("  <tr>\n");
  printf("    <td width=49%% valign=top>\n");
  printf("      <table width=100%% frame=box>\n");
  printf("        <tr>\n");
  printf("          <td width=100%%>\n");
                      if ($sccct > 0)
                      {
                        $tb_class->draw_table();
                        printf("<br />\n");
                      }

                      $tb_basics->draw_table();
                      printf("<br />\n");
  printf("          </td>\n");
  printf("        </tr>\n");
  printf("      </table>\n");
  printf("    </td>\n");
  printf("    <td width=49%% valign=top>\n");
                if (count($img) > 0)
                {
                  printf("<table width=99%% frame=box>\n");
                  printf("<caption><strong>Illustration</strong></caption>\n");

                  $url = $img[0]; $copyright = $own[0]; $copyurl = $crg[0];

                  printf("<tr><td width=100%%><img src=\"%s\" nopin=\"nopin\" width=100%%</td></tr>\n", $url);
                  printf("<tr><td width=100%%>Copyright: <a href=\"javascript:void(0)\" onClick=\"window.open('%s')\">%s</a></td></tr>\n", $copyurl, $copyright);
                  printf("</table>\n");
                }

  printf("    </td>\n");
  printf("  </tr>\n");
  printf("</table>\n");

  printf("<table width=99%% frame=box>\n");
  printf("  <tr>\n");
  printf("    <td>\n");
                $tb_misc->draw_table();
                printf("<br />\n");
                $tb_wheels->draw_table();
                printf("<br />\n");
                $tb_dim->draw_table();
                printf("<br />\n");
                $tb_boiler->draw_table();
                printf("<br />\n");
  printf("    </td>\n");
  printf("  </tr>\n");
  printf("</table>\n");

  $db->close();

?>
