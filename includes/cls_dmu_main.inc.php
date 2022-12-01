<?php
  include_once("lib/MyTables.class.php");
  include_once("lib/brlib.php");

  $lwidth = 36;

/****************************************************************************************/
/* Get class aliases                                                                    */
/****************************************************************************************/

  $tb_class = new MyTables("class_data");

  $tb_class->set_align("V");
  $tb_class->suppress_nulls();
  $tb_class->add_row_lwidth($lwidth);
  $tb_class->add_caption("Class Types");

  $sql = 'SELECT   dcc.*
          FROM     dmu_class_codes dcc
		      WHERE    dcc.dmu_class_id = ' .$id. '
		      ORDER BY dcc.start_date ASC, dmu_class_var_id';

  $result = $db->execute($sql);
  $dccct = $db->count_select();

  $nx = 0; $tabct = 0;
  if ($db->count_select())
  {
	  while($dccrow = mysqli_fetch_assoc($result))
	  {
      $nx++; $tabct++;

      if ($dccrow['class_id_type'] == "TOPS")
        $col = "TOPS Class";
      else
      if ($dccrow['class_id_type'] == "PRT")
        $col = "Pre-Tops Class";
      else
      if ($dccrow['class_id_type'] == "PN")
        if ($dccrow['start_date'] == "1955-01-01")
        $col = "1955 Class";
        else
        $col = "1948 Class";
      else
      if ($dccrow['class_id_type'] == "BIG4")
      {
        $col = "Big Four Class";

        if (!empty($dccrow['company']))
        $col .= " (" . $dccrow['company'] . ")";
      }

      $tb_class->add_row("dcc".$nx, $col);

      $dccrow['dcc'.$nx] = $dccrow['dmu_class_code'];

      if (!empty($dccrow['extra_info']))
        $dccrow['dcc'.$nx] .= " (" . $dccrow['extra_info'] . ")";

		  $tb_class->add_data($dccrow);
	  }

	  if ($result) mysqli_free_result($result);
  }

  $row = NULL;

/****************************************************************************************/
/* Get main details from Class table                                                    */
/****************************************************************************************/

  $tb_basics = new MyTables("class_spcs");
  $tb_basics->set_align("V");
  $tb_basics->suppress_nulls();
  $tb_basics->add_row_lwidth($lwidth);
  $tb_basics->add_caption("General");
  $tb_basics->add_row("common_name",               "Alias");
  $tb_basics->add_row("year_introduced",           "Year Introduced");
  $tb_basics->add_row("wheel_arrangement",         "Wheel Arrangement");
  $tb_basics->add_row("designer",                  "Designer");
  $tb_basics->add_row("manufacturers_mech",        "Manufacturers - Mechanical");
  $tb_basics->add_row("manufacturers_coach",       "Manufacturers - Coachwork");
  $tb_basics->add_row("number_range",              "Number Range (as built)");
  $tb_basics->add_row("loco_count",                "Number Built");
//  $tb_basics->add_row("num_in_service",            "Number In Service");
//  $tb_basics->add_row("num_stored",                "Number Stored");
//  $tb_basics->add_row("num_scrapped",              "Number Scrapped");
//  $tb_basics->add_row("num_preserved",             "Number Preserved");
  $tb_basics->add_row("summary",                   "Information");

  $sql = 'SELECT dc.*
          from   dmu_class dc
          where  dc.dmu_class_id = ' .$id;

  $result = $db->execute($sql);

  $nx++;
  if ($db->count_select())
    $row = mysqli_fetch_assoc($result);

	if ($result) mysqli_free_result($result);

/****************************************************************************************/
/* Get mechanical details builder from main table                                       */
/****************************************************************************************/

  $sql = 'SELECT b.bl_name                                        AS bl_name_mech,
                 concat("sites.php?page=builders&id=", b.bl_code) AS bl_name_mech_hl,
                 count(*)     AS ct
          FROM   dmu d

          JOIN  (SELECT DISTINCT dcl.dmu_id
                 FROM   dmu_class_link dcl
                 WHERE  dmu_class_id = ' . $id . ') AS F
          ON     F.dmu_id = d.dmu_id

          JOIN   ref_builders b
          ON     b.bl_code = d.bl_code_mech

          GROUP BY b.bl_name,
                   bl_name_mech_hl

          ORDER BY b.bl_name';

  $nb = 0;

  $result = $db->execute($sql);

  if ($db->count_select())
  {
    $line = "<table width=99% frame=box><tr><td width=80%><strong>Manufacturer (Mechanical)</strong></td>";
    $line .=                               "<td width=20%><strong>Total</strong></td></tr>";


    while ($rowb = mysqli_fetch_assoc($result))
    {
      $line .= "<tr><td width=80%><a href=\"" . $rowb['bl_name_mech_hl'] . "\">" .
                                                $rowb['bl_name_mech']    . "</a></td>";
      $line .= "    <td width=20%>" . $rowb['ct'] . "</td></tr>";
    }

    $line .= "</table>";
    $row['manufacturers_mech'] = $line;
  }

  $tb_basics->add_data($row);

  if ($result) mysqli_free_result($result);
  $row = NULL;

/****************************************************************************************/
/* Get oachwork details builder from main table                                         */
/****************************************************************************************/

  $sql = 'SELECT b.bl_name                                        AS bl_name_coach,
                 concat("sites.php?page=builders&id=", b.bl_code) AS bl_name_coach_hl,
                 count(*)     AS ct
          FROM   dmu d

          JOIN  (SELECT DISTINCT dcl.dmu_id
                 FROM   dmu_class_link dcl
                 WHERE  dmu_class_id = ' . $id . ') AS F
          ON     F.dmu_id = d.dmu_id

          JOIN   ref_builders b
          ON     b.bl_code = d.bl_code_coach

          GROUP BY b.bl_name,
                   bl_name_coach_hl

          ORDER BY b.bl_name';

  $nb = 0;

  $result = $db->execute($sql);

  if ($db->count_select())
  {
    $line = "<table width=99% frame=box><tr><td width=80%><strong>Manufacturer (Coachwork)</strong></td>";
    $line .=                               "<td width=20%><strong>Total</strong></td></tr>";


    while ($rowb = mysqli_fetch_assoc($result))
    {
      $line .= "<tr><td width=80%><a href=\"" . $rowb['bl_name_coach_hl'] . "\">" .
                                                $rowb['bl_name_coach']    . "</a></td>";
      $line .= "    <td width=20%>" . $rowb['ct'] . "</td></tr>";
    }

    $line .= "</table>";
    $row['manufacturers_coach'] = $line;
  }

  $tb_basics->add_data($row);

  if ($result) mysqli_free_result($result);
  $row = NULL;

/****************************************************************************************/
/* Get remaining details which may have variations on them                              */
/****************************************************************************************/

  $lwidth = 20;
  $rwidth = 80;

  $tb_heat = new MyTables("class_heat");
  $tb_heat->set_align("V");
  $tb_heat->suppress_nulls();
  $tb_heat->add_row_lwidth($lwidth);
  $tb_heat->add_caption("Heating");
  $tb_heat->add_row("str_class_type_fmt",          "");
  $tb_heat->add_row("str_heating_type",            "Heating Type");
  $tb_heat->add_row("int_eth_rating",              "ETH Rating");
  $tb_heat->add_row("str_ets_generator",           "ETS Generator");
  $tb_heat->add_row("str_ets_alternator",          "ETS Alternator");
  $tb_heat->add_row("str_boiler",                  "Boiler");
  $tb_heat->add_row("gal_boiler_water_capacity",   "Boiler Water Capacity");
  $tb_heat->add_row("str_boiler_fuel_supply",      "Boiler Fuel Supply");

  $tb_power = new MyTables("class_power");
  $tb_power->set_align("V");
  $tb_power->suppress_nulls();
  $tb_power->add_row_lwidth($lwidth);
  $tb_power->add_caption("Power");
  $tb_power->add_row("str_class_type_fmt",         "");
  $tb_power->add_row("str_power_unit",             "Power Unit");
  $tb_power->add_row("lbs_tractive_effort",        "Tractive Effort");
  $tb_power->add_row("str_horse_power",            "Horse Power");
  $tb_power->add_row("hp_power_at_rail",           "Power at Rail");
  $tb_power->add_row("inch_cylinder_bore",         "Cylinder Bore");
  $tb_power->add_row("inch_cylinder_stroke",       "Cylinder Stroke");
  $tb_power->add_row("str_main_generator",         "Main Generator");
  $tb_power->add_row("str_main_alternator",        "Main Alternator");
  $tb_power->add_row("str_aux_generator",          "Auxiliary Generator");
  $tb_power->add_row("str_aux_alternator",         "Auxiliary Alternator");

  $tb_trans = new MyTables("class_trans");
  $tb_trans->set_align("V");
  $tb_trans->suppress_nulls();
  $tb_trans->add_row_lwidth($lwidth);
  $tb_trans->add_caption("Transmission");
  $tb_trans->add_row("str_class_type_fmt",         "");
  $tb_trans->add_row("str_transmission_type",      "Transmission Type");
  $tb_trans->add_row("str_transmission",           "Transmission");
  $tb_trans->add_row("str_fluid_coupling",         "Fluid Coupling");
  $tb_trans->add_row("str_gearbox",                "Gearbox");
  $tb_trans->add_row("str_final_drive",            "Final Drive");
  $tb_trans->add_row("str_torque_converter",       "Torque Converter");
  $tb_trans->add_row("int_traction_motor_number",  "Traction Motor Number");
  $tb_trans->add_row("str_traction_motor",         "Traction Motor Type");
  $tb_trans->add_row("str_gear_ratio",             "Gear Ratio");

  $tb_lqd = new MyTables("class_liquids");
  $tb_lqd->set_align("V");
  $tb_lqd->suppress_nulls();
  $tb_lqd->add_row_lwidth($lwidth);
  $tb_lqd->add_caption("Fuel, Lubricants, Water");
  $tb_lqd->add_row("str_class_type_fmt",           "");
  $tb_lqd->add_row("gal_fuel_capacity",            "Fuel Capacity");
  $tb_lqd->add_row("gal_coolant_capacity",         "Coolant Capacity");
  $tb_lqd->add_row("gal_lube_oil_capacity",        "Lubrication Oil Capacity");

  $tb_misc = new MyTables("misc");
  $tb_misc->set_align("V");
  $tb_misc->suppress_nulls();
  $tb_misc->add_row_lwidth($lwidth);
  $tb_misc->add_caption("Miscellaneous");
  $tb_misc->add_row("str_class_type_fmt",          "");
  $tb_misc->add_row("int_year_introduced",         "Year Introduced");
  $tb_misc->add_row("mph_max_speed",               "Maximum Speed");
  $tb_misc->add_row("int_total_number",            "Number Built");
  $tb_misc->add_row("str_number_range",            "Number Range (as built)");
  $tb_misc->add_row("str_sanding",                 "Sanding Equipment");
  $tb_misc->add_row("int_ra",                      "Route Availability");
  $tb_misc->add_row("str_multiple_working",        "Multiple Working");
  $tb_misc->add_row("str_brakes_loco",             "Brake Type (loco - as built)");
  $tb_misc->add_row("str_brakes_train",            "Brake Type (train - as built)");
  $tb_misc->add_row("lbf_brake_force",             "Brake Force");
  $tb_misc->add_row("str_notes",                   "Notes");

  $tb_dim = new MyTables("class_dim");
  $tb_dim->set_align("V");
  $tb_dim->suppress_nulls();
  $tb_dim->add_row_lwidth($lwidth);
  $tb_dim->add_caption("Dimensions");
  $tb_dim->add_row("str_class_type_fmt",           "");
  $tb_dim->add_row("loco_weight",                  "Weight");
  $tb_dim->add_row("ft_wheel_diameter",            "Wheel Diameter");
  $tb_dim->add_row("ft_pony_wheel_diameter",       "Pony Wheel Diameter");
  $tb_dim->add_row("ft_carrier_wheel_diameter",    "Carrier Wheel Diameter");
  $tb_dim->add_row("ft_length",                    "Length");
  $tb_dim->add_row("ft_height",                    "Height");
  $tb_dim->add_row("ft_width",                     "Width");
  $tb_dim->add_row("ft_wheelbase",                 "Wheelbase");
  $tb_dim->add_row("ft_bogie_wheelbase",           "Bogie Wheelbase");
  $tb_dim->add_row("ft_bogie_pivot_centres",       "Bogie Pivot Centres");
  $tb_dim->add_row("minimum_curve",                "Minimum Curve");

  $sql = 'SELECT  dcv.dmu_class_var_id                         AS int_dmu_class_var_id,
                  dcv.identifier                             AS str_class_type,
                  concat("locoqry.php?action=class&id=", dcv.dmu_class_id, 
                         "&type=DMU&page=fleet&var=", dcv.dmu_class_var_id)
                                                             AS hl_class_type,
                  dcv.year_introduced                        AS int_year_introduced,
                  dcv.designer                               AS str_designer,
                  coalesce(b1.bl_short_name, b1.bl_name)     AS str_mechanical, 
                  coalesce(b2.bl_short_name, b2.bl_name)     AS str_coachwork, 
                  dcv.vehicle_weight                         AS wt_loco_weight, 
                  dcv.wheel_diameter                         AS ft_wheel_diameter, 
                  dcv.length                                 AS ft_length, 
                  dcv.height                                 AS ft_height, 
                  dcv.width                                  AS ft_width, 
                  dcv.wheelbase                              AS ft_wheelbase, 
                  dcv.bogie_wheelbase                        AS ft_bogie_wheelbase, 
                  dcv.bogie_pivot_centres                    AS ft_bogie_pivot_centres, 
                  dcv.brakes                                 AS str_brakes_train, 
                  dcv.sanding                                AS str_sanding, 
                  dcv.ra                                     AS int_ra, 
                  dcv.total_number                           AS int_total_number,
                  dcv.number_range                           AS str_number_range,
                  dcv.minimum_curve                          AS str_minimum_curve, 
                  CASE WHEN dcv.power_unit_number > 1 THEN
                    concat(dcv.power_unit_number, " x ",
                           coalesce(m.short_name, m.name), " ", pu.model)
                  ELSE
                    concat(coalesce(m.short_name, m.name), " ", pu.model)
                  END                                        AS str_power_unit, 
                  dcv.tractive_effort                        AS lbs_tractive_effort,
                  CASE WHEN dcv.power_unit_number > 1 THEN
                    concat(dcv.power_unit_number * 
                                 coalesce(dcv.horse_power, pu.horse_power),
                           "hp (", dcv.power_unit_number, " x ",
                                 coalesce(dcv.horse_power, pu.horse_power),
                           "hp)")
                  ELSE
                    concat(coalesce(dcv.horse_power, pu.horse_power),
                           "hp")
                  END                                        AS str_horse_power,
                  dcv.power_at_rail                          AS hp_power_at_rail,
                  dcv.power_rating                           AS str_power_rating,
                  dcv.brake_force                            AS str_brake_force,
                  dcv.max_speed                              AS mph_max_speed,
                  concat(mw.mw_detail, " ", 
                              ifnull(mw.mw_symbol, " "))     AS str_multiple_working,
                  dcv.fuel_capacity                          AS gal_fuel_capacity,
                  dcv.coolant_capacity                       AS gal_coolant_capacity,
                  dcv.lube_oil_capacity                      AS gal_lube_oil_capacity,
                  dcv.traction_motor_number                  AS int_traction_motor_number,
                  dcv.gear_ratio                             AS str_gear_ratio,
                  dcv.transmission_type                      AS str_transmission_type,
                  dcv.heating_type                           AS str_heating_type,
                  dcv.boiler_water_capacity                  AS gal_boiler_water_capacity,
                  dcv.boiler_fuel_supply                     AS gal_boiler_fuel_supply,
                  dcv.notes                                  AS str_notes,
                  dcv.dmu_class_var_base                       AS ign_var_base,
                  concat(coalesce(mA.short_name, mA.name), " ", mcA.mct_name)  
                                                             AS str_main_generator, 
                  concat(coalesce(mB.short_name, mB.name), " ", mcB.mct_name)  
                                                             AS str_aux_generator, 
                  concat(coalesce(mC.short_name, mC.name), " ", mcC.mct_name)  
                                                             AS str_main_alternator, 
                  concat(coalesce(mD.short_name, mD.name), " ", mcD.mct_name)  
                                                             AS str_aux_alternator, 
                  concat(coalesce(mE.short_name, mE.name), " ", mcE.mct_name)  
                                                             AS str_ets_generator, 
                  concat(coalesce(mF.short_name, mF.name), " ", mcF.mct_name)  
                                                             AS str_ets_alternator, 
                  concat(coalesce(mG.short_name, mG.name), " ", mcG.mct_name)  
                                                             AS str_traction_motor, 
                  concat(coalesce(mH.short_name, mH.name), " ", mcH.mct_name)  
                                                             AS str_boiler, 
                  concat(coalesce(mI.short_name, mI.name), " ", mcI.mct_name)  
                                                             AS str_transmission, 
                  concat(coalesce(mJ.short_name, mJ.name), " ", mcJ.mct_name)  
                                                             AS str_traction_alternator,
                  concat(coalesce(mK.short_name, mK.name), " ", mcK.mct_name)  
                                                             AS str_fluid_coupling,
                  concat(coalesce(mL.short_name, mL.name), " ", mcL.mct_name)  
                                                             AS str_gearbox,
                  concat(coalesce(mM.short_name, mM.name), " ", mcM.mct_name)  
                                                             AS str_final_drive,
                  concat(coalesce(mN.short_name, mN.name), " ", mcN.mct_name)  
                                                             AS str_torque_converter

          from   dmu_class_var dcv

          LEFT JOIN ref_misc_components mcA
          ON     mcA.mct_id = dcv.main_generator_id
          LEFT JOIN ref_manufacturer mA
          ON     mA.manufacturer_id = mcA.manufacturer_id

          LEFT JOIN ref_misc_components mcB
          ON     mcB.mct_id = dcv.aux_generator_id
          LEFT JOIN ref_manufacturer mB
          ON     mB.manufacturer_id = mcB.manufacturer_id

          LEFT JOIN ref_misc_components mcC
          ON     mcC.mct_id = dcv.main_alternator_id
          LEFT JOIN ref_manufacturer mC
          ON     mC.manufacturer_id = mcC.manufacturer_id

          LEFT JOIN ref_misc_components mcD
          ON     mcD.mct_id = dcv.aux_alternator_id
          LEFT JOIN ref_manufacturer mD
          ON     mD.manufacturer_id = mcD.manufacturer_id

          LEFT JOIN ref_misc_components mcE
          ON     mcE.mct_id = dcv.ets_generator_id
          LEFT JOIN ref_manufacturer mE
          ON     mE.manufacturer_id = mcE.manufacturer_id

          LEFT JOIN ref_misc_components mcF
          ON     mcF.mct_id = dcv.ets_alternator_id
          LEFT JOIN ref_manufacturer mF
          ON     mF.manufacturer_id = mcF.manufacturer_id

          LEFT JOIN ref_misc_components mcG
          ON     mcG.mct_id = dcv.traction_motor_id
          LEFT JOIN ref_manufacturer mG
          ON     mG.manufacturer_id = mcG.manufacturer_id

          LEFT JOIN ref_misc_components mcH
          ON     mcH.mct_id = dcv.boiler_id
          LEFT JOIN ref_manufacturer mH
          ON     mH.manufacturer_id = mcH.manufacturer_id

          LEFT JOIN ref_misc_components mcI
          ON     mcI.mct_id = dcv.transmission_id
          LEFT JOIN ref_manufacturer mI
          ON     mI.manufacturer_id = mcI.manufacturer_id

          LEFT JOIN ref_misc_components mcJ
          ON     mcJ.mct_id = dcv.traction_alternator_id
          LEFT JOIN ref_manufacturer mJ
          ON     mJ.manufacturer_id = mcJ.manufacturer_id

          LEFT JOIN ref_misc_components mcK
          ON     mcK.mct_id = dcv.fluid_coupling_id
          LEFT JOIN ref_manufacturer mK
          ON     mK.manufacturer_id = mcK.manufacturer_id

          LEFT JOIN ref_misc_components mcL
          ON     mcL.mct_id = dcv.gearbox_id
          LEFT JOIN ref_manufacturer mL
          ON     mL.manufacturer_id = mcL.manufacturer_id

          LEFT JOIN ref_misc_components mcM
          ON     mcM.mct_id = dcv.final_drive_id
          LEFT JOIN ref_manufacturer mM
          ON     mM.manufacturer_id = mcM.manufacturer_id

          LEFT JOIN ref_misc_components mcN
          ON     mcN.mct_id = dcv.torque_converter_id
          LEFT JOIN ref_manufacturer mN
          ON     mN.manufacturer_id = mcN.manufacturer_id

          LEFT JOIN ref_power_units pu
          ON     pu.pu_id = dcv.pu_id
          LEFT JOIN ref_manufacturer m
          ON     m.manufacturer_id = pu.manufacturer_id

          LEFT JOIN ref_multiple_working mw
          ON     mw.mw_code = dcv.multiple_working

          LEFT JOIN ref_builders b1
          ON     b1.bl_code = dcv.bl_code_mech
          
          LEFT JOIN ref_builders b2
          ON     b2.bl_code = dcv.bl_code_coach

          WHERE  dcv.dmu_class_id = ' .$id. '
          ORDER BY dcv.dmu_class_var_id';

//echo $sql;
         
  $result = $db->execute($sql);

  $ct = $db->count_select();

  if ($ct > 1) 
  {
    $tb_dim->add_row_rwidth(($rwidth/$ct));
    $tb_heat->add_row_rwidth(($rwidth/$ct));
    $tb_power->add_row_rwidth(($rwidth/$ct));
    $tb_lqd->add_row_rwidth(($rwidth/$ct));
    $tb_trans->add_row_rwidth(($rwidth/$ct));
    $tb_misc->add_row_rwidth(($rwidth/$ct));
  }

  if ($ct >= 1) 
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $arr[] = $row;
      $arr_bak[] = $row;
    }
  }

  if ($ct > 1)
  {
    /* In order to print the table correctly, it is necessary to find out which columns
       have values in them so that if the first column doesn't have a value and the second does,
       we can put a &nbsp; tag in the first to ensure printing. */

    for ($nx = $ny = 0; $nx < $ct; $nx ++)
    {
      foreach ($arr[$nx] as $key => $val)
      {
        if (!empty($arr[$nx][$key]))
          $v[$key] ++;
        else
          $v[$key] += 0;
        $ny++;
      }

      $ny = 0;
    }

//print_r($v); echo "<br />";
  }

  for ($nx = 0; $nx < $ct; $nx++)
  {
    // if multiple variations, print headers for each column in bold for clarity
    if ($ct > 1)
    {
      $arr[$nx]['str_class_type_fmt'] = "<strong><a href=" . $arr[$nx]['hl_class_type'] .
                                    ">" . $arr[$nx]['str_class_type'] . "</a></strong>";
    }
    else // otherwise don't print at all
      $arr[$nx]['str_class_type'] = "";

    // For this variant, if the dmu_class_var_base is set, use it for the default (if NULL,
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
            ;
          else
          if (strncmp($key, "hp_", 3) == 0)
            $arr[$nx][$key] = fn_ncomma($val) . "hp";
          else
          if (strncmp($key, "ign_", 4) == 0)
            ;
          else
          if (strncmp($key, "hl_", 3) == 0)
            ;
          else
          if (strncmp($key, "mph_", 4) == 0)
            $arr[$nx][$key] = $val . "mph";
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
            ;
          else
          if (strncmp($key, "hp_", 3) == 0)
            $arr[$nx][$key] = fn_ncomma($val) . "hp";
          else
          if (strncmp($key, "ign_", 4) == 0)
            ;
          else
          if (strncmp($key, "hl_", 3) == 0)
            ;
          else
          if (strncmp($key, "mph_", 4) == 0)
            $arr[$nx][$key] = $val . "mph";
          else
            printf("Unknown tag: [%s]<br />\n", $key);
        }
        else
        if ($ct > 0 && $v[$key] > 0)
          $arr[$nx][$key] = "&nbsp;";
      }
    }

    $tb_dim->add_data($arr[$nx]);
    $tb_heat->add_data($arr[$nx]);
    $tb_power->add_data($arr[$nx]);
    $tb_lqd->add_data($arr[$nx]);
    $tb_trans->add_data($arr[$nx]);
    $tb_misc->add_data($arr[$nx]);
  }

  $arr = array();
  $arr_bak = array();

  if ($result) mysqli_free_result($result);
  $row = NULL;



/****************************************************************************************/
/* Get main details from Class table                                                    */
/****************************************************************************************/

  $tb_disp = new MyTables("class_disp");
  $tb_disp->set_align("V");
  $tb_disp->suppress_nulls();
  $tb_disp->add_row_lwidth($lwidth);
  $tb_disp->add_caption("Disposal Details");
  $tb_disp->add_row("scrapped",     "Scrapped By");
  $tb_disp->add_row("preservation", "Preserved");

  $sql = 'SELECT concat(sm.merchant_name, " (",
                        sy.location, ")")        AS sc_name,
                 d.scrapyard_code,
                 count(*) AS dct
          FROm   dmu d
          JOIN   dmu_class_link dcl
          ON     dcl.dmu_id = d.dmu_id
          AND    dcl.dmu_class_id = ' . $id . '
          LEFT JOIN ref_scrapyard sy
          ON     sy.scrapyard_code = d.scrapyard_code
          LEFT JOIN ref_scrap_merchant sm
          ON     sm.merchant_code = substr(sy.scrapyard_code, 1, 3)
          GROUP BY sc_name, scrapyard_code
          ORDER BY dct DESC';

  $result = $db->execute($sql);

  $ct = 0; $st = 0;
  if ($db->count_select())
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      if ($row['preserved'] == "Y")
      {
        $prs = "<table width=99% frame=box><tr><td width=80%>&nbsp;</td><td><a href=\"preservation.php?type=DMU&cid=" . $id . "\">" . $row['sct'] . "</a></td></tr></table>";
      }
      else if (!empty($row['disposed_by']))
      {
        if ($ct == 0)
        {
          $rw = "<table width=99% frame=box><tr><td width=80%><strong>Scrapyard</strong></td>".
                "<td width=20%><strong>Total</strong></td></tr>";
        }

        $rw = $rw . "<tr><td><a href=\"sites.php?page=scrapyards&id=" . $row['scrapyard_code']
            . "\">" . $row['sc_name']
            .     "</a></td><td><a href=\"sites.php?page=scrapyards&id=" . $row['scrapyard_code']
            . "&type=DMU&subpage=locos&cid=" . $id . "\">" . $row['sct']
            .     "</a></td></tr>";
        $ct++;

        $st += $row['sct'];
      }
    }

    $rw = $rw . "</table>";
  } // count select

  $row['scrapped'] = $rw;
  $row['preservation'] = $prs;

  $tb_disp->add_data($row);

  if ($result) mysqli_free_result($result);
  $row = NULL;

  $sql = 'SELECT concat("./images/MU/diesel/", i.image) AS image_url,
                 i.photo_date,
                 ic.copyright,
                 ic.copyright_url

          FROM   ref_images i
          JOIN   ref_image_copyright ic
          ON     ic.ic_id = i.ic_id

          WHERE  i.class_id = ' .$id. '
          AND    i.type = "DMU"
          AND    i.img_index = "Y"';

  $result = $db->execute($sql);
  $imgct = $db->count_select();
  
  if (!$result)  
  {  
    echo '<br />Error querying railway database: Please contact the administrator.<br />';
//    echo '<br />' .$sql . '<br />';
    $err=3; 
  }
  else
  if ($db->count_select())
  {
    $row = mysqli_fetch_assoc($result); // just get the first image

    if ($result) mysqli_free_result($result);
  }

  printf("<table width=99%% frame=box>\n");
  printf("  <tr>\n");
  printf("    <td width=49%% valign=top>\n");
  printf("      <table width=100%% frame=box>\n");
  printf("        <tr>\n");
  printf("          <td width=100%%>\n");
                      if ($dccct > 0)
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
                if ($imgct == 1)
                {
                  printf("<table width=99%% frame=box>\n");
                  printf("<caption><strong>Illustration</strong></caption>\n");

                  printf("<tr><td width=100%%><img src=\"%s\" width=100%%</td></tr>\n", 
                         $row['image_url']);
                  printf("<tr><td width=100%%>Copyright: <a href=\"javascript:void(0)\" onClick=\"window.open('%s')\">%s</a> (%s)</td></tr>\n", $row['copyright_url'], 
                                                   $row['copyright'],
                                                   fn_fdate($row['photo_date']));
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
                $tb_dim->draw_table();
                printf("<br />\n");
                $tb_power->draw_table();
                printf("<br />\n");
                $tb_trans->draw_table();
                printf("<br />\n");
                $tb_heat->draw_table();
                printf("<br />\n");
                $tb_lqd->draw_table();
                printf("<br />\n");
  printf("    </td>\n");
  printf("  </tr>\n");
  printf("</table>\n");

  $db->close();

  $tb_dim=$tb_heat=$tb_power=$tb_lqd=$tb_trans=$tb_misc=$tb_class=$tb_basics=NULL;
  $row = NULL;
?>
