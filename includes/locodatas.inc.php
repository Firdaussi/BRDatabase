<?php

/* Updateable record flag - 0 for off (production) */
  $update = 0;
  
/***********************************************************************************************/
/*                                                                                             */
/* Stage 0: Preliminaries - set up specifics table                                             */
/*                                                                                             */
/***********************************************************************************************/

  include_once "lib/MyTables.class.php";
  include_once "lib/brlib.php";

/* First thing, check id exists */
  $sql = 'SELECT count(*) AS ct
          FROM   steam
          WHERE  loco_id = ' . $id;
          
  $result = $db->execute($sql);

  if ($result)
  {
    $row = mysqli_fetch_assoc($result);
  }
  else
  {
    echo "There is currently a problem with the database - please try again later.<br />";
    exit(1);
  }

  if ($row['ct'] == '0')
  {
    echo "Error: There is no such locomotive with this id. Please contact the administrator or submit a <a href=\"hesk/index.php\">ticket</a>, citing as much information as you can (e.g. page URL).<br />";
    exit(1);
  }
               
  if ($update)
    $caption_hl = sprintf("upd_steam.php?page=upd_loco_spec&id=%s", $id);

  $table_specifics = new MyTables("loco_table");
  $table_specifics->add_caption("Locomotive Specifics", $update ? $caption_hl : NULL);
  $table_specifics->suppress_nulls();
  $table_specifics->add_row("designer",          "Designer");
  $table_specifics->add_row("identifier",        "Class");
  $table_specifics->add_row("co_history",        "Company History");
  $table_specifics->add_row("subclass",          "Rebuild History");
  $table_specifics->add_row("wheel_arrangement", "Wheels");
  $table_specifics->add_row("bl_name",           "Builder");
  $table_specifics->add_row("order_number",      "Order Number");
  $table_specifics->add_row("works_num",         "Works Number");
  $table_specifics->add_row("fittings",          "Fittings (as built)");
  $table_specifics->add_row("to_service",        "To Service");
  $table_specifics->add_row("to_stock",          "Taken into Stock");
  $table_specifics->add_row("cost_when_new",     "Building Cost");
  $table_specifics->add_row("withdrawal",        "Withdrawal");
  $table_specifics->add_row("reason_withdrawn",  "Withdrawal Reason");
  $table_specifics->add_row("w_notes",           "Withdrawal Notes");
  $table_specifics->add_row("dis",               "Service Life");
  $table_specifics->add_row("mileage",           "Total Mileage");
  $table_specifics->add_row("v_info",            "Video Clip");
  $table_specifics->add_row("info",              "Information");
  $table_specifics->add_row_lwidth(35); /* percentage of width of table for first column */
  $table_specifics->set_align("V");
  
  $table_disposal = new MyTables("loco_table");
  $table_disposal->add_caption("Disposal", $update ? $caption_hl : NULL);
  $table_disposal->suppress_nulls();
  $table_disposal->add_row("sfs_date",          "Date Sold for Scrap");
  $table_disposal->add_row("into_date",         "Date Into Works/Scrapyard for Scrap");
  $table_disposal->add_row("cut_number",        "Works Cut Number");
  $table_disposal->add_row("scrapped",          "Scrapping");
  $table_disposal->add_row_lwidth(35); /* percentage of width of table for first column */
  $table_disposal->set_align("V");

  if ($update)
    $caption_hl = sprintf("upd_steam.php?page=upd_loco_nums&id=%s", $id);

  $table_numbers = new MyTables("loco_nums");
  $table_numbers->add_caption("Numbers Carried", $update ? $caption_hl : NULL);
  $table_numbers->add_column("text",             "Company",   35);
  $table_numbers->add_column("number",           "Number",    25);
  $table_numbers->add_column("sdate_prd",        "", 6);
  $table_numbers->add_column("sdate",            "Date From", 34);

  $table_snippets = new MyTables("loco_snippets");
  $table_snippets->add_caption("Mentions ...", NULL);
  $table_snippets->add_column("note_date",       "Report Date", 10);
  $table_snippets->add_column("title",           "Title",       15);
  $table_snippets->add_column("note",            "Report",      65);
  $table_snippets->add_column("source",          "Source",      10);
  
  $table_log = new MyTables("log_details");
  $table_log->add_caption("Sightings", NULL);
  $table_log->add_column("ld_date",              "Report Date", 10);
  $table_log->add_column("lh_main_title",        "Title",       20);
  $table_log->add_column("location",             "Location",    10);
  $table_log->add_column("ld_details",           "Report",      32);
  $table_log->add_column("headcode",             "Headcode",     8);
  $table_log->add_column("reference",            "Reference",   20);
  
  if ($update)
    $caption_hl = sprintf("upd_steam.php?page=upd_loco_notes&id=%s", $id);

  $table_notes = new MyTables("loco_notes");
  $table_notes->suppress_nulls();
  $table_notes->add_row_lwidth(15); /* percentage of width of table for first column */
  $table_notes->set_align("V");
  $table_notes->add_caption("Notes", $update ? $caption_hl : NULL);
  $table_notes->add_row("info",       "Notes");

  if ($update)
    $caption_hl = sprintf("upd_steam.php?page=upd_loco_liv&id=%s", $id);

  $table_liveries = new MyTables("loco_liveries");
  $table_liveries->add_caption("Liveries Carried", $update ? $caption_hl : NULL);
  $table_liveries->add_column("base_colour",     "Colour",    35);
  $table_liveries->add_column("lining",          "Lining",    25);
  $table_liveries->add_column("start_date",      "Date From", 40);

  if ($update)
    $caption_hl = sprintf("upd_steam.php?page=upd_loco_pres&id=%s", $id);

  $table_pres = new MyTables("loco_preservation");
  $table_pres->suppress_nulls();
  $table_pres->add_row_lwidth(35); /* percentage of width of table for first column */
  $table_pres->set_align("V");
  $table_pres->add_caption("Preservation", $update ? $caption_hl : NULL);
  $table_pres->add_row("date_preserved","Preservation Date");
  $table_pres->add_row("status",        "Current Status");
  $table_pres->add_row("info",          "Information");
  $table_pres->add_row("weblink",       "Link");
  $table_pres->add_row("location",      "Current Location");
  $table_pres->add_row("status_date",   "Status Date");

  if ($update)
    $caption_hl = sprintf("upd_steam.php?page=upd_loco_names&id=%s", $id);

  $table_names = new MyTables("loco_names");
  $table_names->add_caption("Names Carried", $update ? $caption_hl : NULL);
  $table_names->add_column("start_date", "Date From", 35);
  $table_names->add_column("name",       "Name",      65);
//  $table_names->add_row_lwidth(35); /* percentage of width of table for first column */   
//  $table_names->set_align("V");

  if ($update)
    $caption_hl = sprintf("upd_steam.php?page=upd_loco_mods&id=%s", $id);

  $table_mods = new MyTables("loco_mods");
  $table_mods->add_caption("Modifications", $update ? $caption_hl : NULL);
  $table_mods->add_column("mdate",         "Date Modified", 35);
  $table_mods->add_column("description",   "Modification",  65);

  if ($update)
    $caption_hl = sprintf("upd_steam.php?page=upd_loco_alloc&id=%s", $id);

  $table_allocs = new MyTables("allocations");
  $table_allocs->add_caption("Allocations", $update ? $caption_hl : NULL);
  $table_allocs->add_column("allocation", "Code",      9);
  $table_allocs->add_column("subsequent", "Subsequent Codes", 9);
  $table_allocs->add_column("depot_name", "Name",     40);
  $table_allocs->add_column("period",     "",          7);
  $table_allocs->add_column("alloc_date", "From Date",35); 
    
  $table_sls = new MyTables("sls_allocations");
  $table_sls->add_caption("SLS Allocations*", $update ? $caption_hl : NULL);
  $table_sls->add_column("act",         "Type",      8);
  $table_sls->add_column("alloc",       "Code",      8);
  $table_sls->add_column("depot_name",  "Name",     42);
  $table_sls->add_column("inc_prd",     "",          7);
  $table_sls->add_column("inc_date",    "From Date",35); 
    
  if ($update)
    $caption_hl = sprintf("upd_steam.php?page=upd_loco_tender&id=%s", $id);

  $table_tender = new MyTables("tenders");
  $table_tender->add_caption("Tenders", $update ? $caption_hl : NULL);
  $table_tender->add_column("tender_type",    "Type",               30);
  $table_tender->add_column("tnum",           "Number",             18);
  $table_tender->add_column("start_date",     "From",               20);
  $table_tender->add_column("company",        "Company",             7);
  $table_tender->add_column("water_capacity", "Water",              12);
  $table_tender->add_column("coal_capacity",  "Coal",               13);
  //$table_tender->add_column("tender_weight",  "Weight",             10);
  //$table_tender->add_column("wheelbase_verbose", "Wheelbase",       15);

  $table_works = new MyTables("works_visits");
  $table_works->add_caption("Works Visits");
  $table_works->add_column("bl_name",         "Works",          15);
  $table_works->add_column("stopped_date",    "Stopped",        10);
  $table_works->add_column("start_date",      "Entry",          10);
  $table_works->add_column("end_date",        "Departure",      10);
  $table_works->add_column("duration",        "Duration",        7);
  $table_works->add_column("regime",          "Level of Work",  12);
  $table_works->add_column("summary",         "Actual",         26);
  $table_works->add_column("mileage",         "Mileage",        10);

  if ($update)
    $caption_hl = sprintf("upd_steam.php?page=upd_loco_inc&id=%s", $id);

  $table_summary = new MyTables("summary");
  $table_summary->add_caption("Summary");
  $table_summary->add_column("event_date",  "Date",       8);
  $table_summary->add_column("event_type",  "Event",     12);
  $table_summary->add_column("details",     "Details",   60);
  $table_summary->add_column("source",      "Source",    16);
  $table_summary->add_column("lnk",         "See Also",   4);           

/***********************************************************************************************/
/*                                                                                             */
/* Stage 1: Get the class variations for this locomotive                                       */
/*                                                                                             */
/***********************************************************************************************/

  $sql = 'SELECT sc.identifier                           AS identifier_main,
                 ifnull(scv.common_name, scv.class_type) AS identifier,
                 scv.s_class_id,
                 scv.s_class_var_id,
                 scv.wheel_arrangement,
                 scc.s_class_code,
                 scc.company,
                 c.cmp_name,
                 scc.start_date                          AS scc_start_date,
                 scc.class_id_type,
                 scl.start_date                          AS start_date
          FROM   s_class_link scl
          JOIN   s_class_var  scv    
          ON     scv.s_class_id = scl.s_class_id
          AND    scv.s_class_var_id = scl.s_class_var_id
          JOIN   s_class sc
          ON     sc.s_class_id = scv.s_class_id
          LEFT JOIN s_class_codes scc
          ON     scc.s_class_id = scv.s_class_id
          AND    scc.s_class_var_id = scv.s_class_var_id
          LEFT JOIN ref_companies c
          ON     c.cmp_initials = scc.company
          WHERE  scl.loco_id = ' . $id . '
          ORDER BY start_date, scc_start_date ASC';
          
 //         echo $sql;

  $result = $db->execute($sql);
  //print_r($result);

  /* Build a mini table of variations - only displayed if more than one variation exists*/
  $ct = $last_class_id = $last_class_var_id = 0;

  if ($result)
      while ($row = mysqli_fetch_assoc($result))
      {
        if ($last_class_id == 0)
        {
          $class_id = $row['s_class_id'];  // for next/prev button processing

          $rw = "<table width=\"100%\" frame=\"box\"><tr><td width=\"60%\"><strong>Class</strong></td><td width=\"40%\"><strong>From</strong></td></tr>";
          $rw .= "<tr><td><a href=\"locoqry.php?action=class&amp;type=S&amp;id=" . $row['s_class_id']
                . "\">" . $row['identifier']
                .     "</a></td><td>"  . fn_fdate($row['start_date'])
                .     "</td></tr>";
          $wheel_arrangement = $row['$wheel_arrangement'];
        }
        else
        {
          if (($row['s_class_id']     != $last_class_id) ||
              ($row['s_class_var_id'] != $last_class_var_id))
          {
            if ($row['wheel_arrangement'] != $wheel_arrangement)
              $rw .= "<tr><td><a href=\"locoqry.php?action=class&amp;type=S&amp;id=" . $row['s_class_id']
                  . "\">" . $row['identifier'] . " (" . $row['wheel_arrangement'] . ")" 
                  .     "</a></td><td>"  . fn_fdate($row['start_date'])
                  .     "</td></tr>";
            else
              $rw .= "<tr><td><a href=\"locoqry.php?action=class&amp;type=S&amp;id=" . $row['s_class_id']
                  . "\">" . $row['identifier']
                  .     "</a></td><td>"  . fn_fdate($row['start_date'])
                  .     "</td></tr>";
          }
        }

        $ct++;

        $last_class_id = $row['s_class_id'];
        $last_class_var_id = $row['s_class_var_id'];
      }

  if ($ct > 0)
  {
    $rw = $rw . "</table>";
    $class_desc .= ")";
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 2: Get the detailed info specific to this locomotive                                  */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT s.*,
                 date_format(s.b_date, "%W")                               AS b_date_day,
                 date_format(s.w_date, "%W")                               AS w_date_day,
                 date_format(s.s_date, "%W")                               AS s_date_day,
                 date_format(s.svc_date, "%W")                             AS svc_date_day,
                 date_format(s.sfs_date, "%W")                             AS sfs_date_day,
                 dp_w.depot_name                                           AS depot_name_w,
                 coalesce(dc_w.displayed_depot_code, dc_w.depot_code)      AS depot_code_w,
                 concat("sites.php?page=depots&action=query&id=", dp_w.depot_id) 
                                                                           AS depot_when_wdn_hl,
                 dp_b.depot_name                                           AS depot_name_b,
                 coalesce(dc_b.displayed_depot_code, dc_b.depot_code)      AS depot_code_b,
                 concat("sites.php?page=depots&action=query&id=", dp_b.depot_id) 
                                                                           AS depot_when_new_hl,
                 s.w_notes,
                 s.w_order,
                 c1.cmp_name,
                 o.order_number,
                 o.virtual_ind,
                 concat("sites.php?page=builders&subpage=orders&id=", o.bl_code, "&lot=",
                         o.order_number, "&oid=", o.order_id)              AS order_number_hl,
                 concat("sites.php?page=builders&subpage=orders&id=", o.bl_code, "&lot=",
                         o.order_number, "&oid=", o.order_id)              AS works_num_hl,
                 scl.s_class_id,
                 concat(sm.merchant_name, " (", sy.location, ")")          AS sc_name,
                 concat("misc.php?page=wheel_arr&id=", sc.wheel_arrangement) 
                                                                           AS wheel_arrangement_hl,
                 bl.bl_name,
                 bl_main.bl_name                                           AS subbed_by,
                 concat("sites.php?page=builders&id=",           bl.bl_code) AS bl_name_hl,
                 concat("sites.php?page=scrapyards&mchnt=", sm.merchant_code,
                                                 "&id=",    sy.scrapyard_code) AS sc_name_hl,
                 ifnull(sc.common_name, sc.identifier)                       AS identifier,
                 concat("locoqry.php?action=class&type=S&id=",sc.s_class_id) AS identifier_hl,
                 concat(substr(p1.forename,1,1), ". ", p1.surname, CASE 
                                 WHEN p2.surname IS NOT NULL THEN
                                        concat(" / ", substr(p2.forename,1,1), ". ", p2.surname)
                                 ELSE
                                      ""
                                 END)                                      AS designer,
                 sc.wheel_arrangement,
                 NULL                                                      AS dis,
                 NULL                                                      AS subclass,
                 sc.prg_company,
                 sc.big4_company,
                 sc.br_standard,
                 NULL AS co_history,
                 v.url                                                     AS v_info_pop,
                 v.info                                                    AS v_info,
                 sf.condenser,
                 m1.description                                            AS safety,
                 m4.description                                            AS reverser,
                 m2.description                                            AS engine_brakes,
                 m3.description                                            AS train_brakes,
                 bt1.boiler_diagram_no                                     AS boiler1,
                 bt1.firebox_type                                          AS firebox1,
                 bt2.boiler_diagram_no                                     AS boiler2,
                 bt2.firebox_type                                          AS firebox2,
                 sb.boiler_number                                          AS boiler_number2,
                 sf.water_pickup,
                 sf.warning_system
          from   steam s

          join   s_class_link scl
          on     scl.loco_id = s.loco_id

          join   s_class sc
          on     sc.s_class_id = scl.s_class_id
          
          left join s_fittings sf
          on     sf.loco_id = s.loco_id

          left join ref_modifications m1
          on     sf.safety_valves = m1.modification

          left join ref_modifications m2
          on     sf.engine_brakes = m2.modification

          left join ref_modifications m3
          on     sf.train_brakes = m3.modification

          left join ref_modifications m4
          on     sf.reverser = m4.modification

          left join ref_builders bl
          on     bl.bl_code = s.bl_code

          left join ref_builders bl_main
          on     bl.bl_code = s.subcontracted_by

          left join ref_scrapyard sy
          on     sy.scrapyard_code = s.scrapyard_code

          left join ref_scrap_merchant sm
          on     sm.merchant_code = substr(sy.scrapyard_code, 1, 3)

          left join videos v
          on     v.type = "S"
          and    v.loco_id = s.loco_id

          left join ref_orders o
          on     o.order_id = s.order_id

          left join ref_companies c1
          on     c1.cmp_initials = ifnull(ifnull(sc.prg_company, sc.big4_company), "BR")

          left join ref_depot_codes dc_w
          on     dc_w.depot_code = s.last_depot
          and    dc_w.date_from = (select max(dc_w1.date_from)
                                   from   ref_depot_codes dc_w1
                                   where  dc_w1.depot_code = s.last_depot
                                   and    dc_w1.date_from <= s.w_date)

          left join ref_depot dp_w
          on     dp_w.depot_id = dc_w.depot_id

          left join ref_depot_codes dc_b
          on     dc_b.depot_code = s.first_depot
          and    dc_b.date_from = (select max(dc_b1.date_from)
                                   from   ref_depot_codes dc_b1
                                   where  dc_b1.depot_code = s.first_depot
                                   and    dc_b1.date_from <= coalesce(s.svc_date, s.b_date))

          left join ref_depot dp_b
          on     dp_b.depot_id = dc_b.depot_id

          left join ref_people p1
          on     p1.p_id = sc.designer_id

          left join ref_people p2
          on     p2.p_id = sc.modifier_id
          
          left join ref_boiler_type bt1
          on     bt1.boiler_type_id = sf.boiler_type_id

          left join s_to_boiler s2b
          on     s2b.loco_id = s.loco_id
          and    s2b.s_boiler_id = sf.boiler_id
          and    s2b.first_boiler = "Y"
          left join s_boiler sb
          on     sb.s_boiler_id = s2b.s_boiler_id
          left join ref_boiler_type bt2
          on     bt2.boiler_type_id = sb.boiler_type_id

          where  s.loco_id = ' .$id;

  // echo $sql;

  $result = $db->execute($sql);
  
  if ($result)
  {
  $row = mysqli_fetch_assoc($result);

// Don't loop - just take the info from the first record - needs revising!!!
  {
    if (($row['condenser'] != 'N' && !empty($row['condenser']))  ||
        (!empty($row['boiler1']))     ||
        (!empty($row['boiler2']))     ||
        (!empty($row['safety']))     ||
        (!empty($row['reverser']))    ||
        (!empty($row['water_pickup']))    ||
        (!empty($row['warning_system']))    ||
        (!empty($row['train_brakes']))    ||
        (!empty($row['engine_brakes'])))
    {
      $details = "<table width=\"100%\" frame=\"box\">";
  
      if (!empty($row['condenser']))
      {
        if ($row['condenser'] == "Y")
        {
          $details .= "<tr><td width=\"30%\"><strong>Condenser</strong></td>";
          $details .= "    <td width=\"70%\">Fitted</td></tr>";
        }
      }
    
      if (!empty($row['boiler2']))
      {
        $details .= "<tr><td width=\"30%\"><strong>Boiler</strong></td>";
        $details .= "    <td width=\"70%\">Diagram " . $row['boiler2'];
        $details .= " #" . $row['boiler_number2'] . " ";
        if (!empty($row['firebox2']))
        {
          $details .= " (" . $row['firebox2'] . " firebox)";
        }
        $details .= "</td></tr>";
      }
      else if (!empty($row['boiler1']))
      {
        $details .= "<tr><td width=\"30%\"><strong>Boiler</strong></td>";
        $details .= "    <td width=\"70%\">Diagram " . $row['boiler1'];
        if (!empty($row['firebox1']))
        {
          $details .= " (" . $row['firebox1'] . " firebox)";
        }
        $details .= "</td></tr>";
      }
      
      if (!empty($row['reverser']))
      {
        $details .= "<tr><td width=\"30%\"><strong>Reverser</strong></td>";
        $details .= "    <td width=\"70%\">" . $row['reverser'] . "</td></tr>";
      }

      if (!empty($row['engine_brakes']))
      {
        $details .= "<tr><td width=\"30%\"><strong>Engine Brakes</strong></td>";
        $details .= "    <td width=\"70%\">" . $row['engine_brakes'] . "</td></tr>";
      }

      if (!empty($row['train_brakes']))
      {
        $details .= "<tr><td width=\"30%\"><strong>Train Brakes</strong></td>";
        $details .= "    <td width=\"70%\">" . $row['train_brakes'] . "</td></tr>";
      }

      if (!empty($row['safety']))
      {
        $details .= "<tr><td width=\"30%\"><strong>Safety Valves</strong></td>";
        $details .= "    <td width=\"70%\">" . $row['safety'] . "</td></tr>";
      }

      if (!empty($row['water_pickup']))
      {
        $details .= "<tr><td width=\"30%\"><strong>Water Pickup</strong></td>";
        $details .= "    <td width=\"70%\">" . $row['water_pickup'] . "</td></tr>";
      }

      if (!empty($row['warning_system']))
      {
        $details .= "<tr><td width=\"30%\"><strong>Warning System</strong></td>";
        $details .= "    <td width=\"70%\">" . $row['warning_system'] . "</td></tr>";
      }

      $details .= "</table>";
      
      $row['fittings'] = $details;
    }
   //  else
   //   $row['fittings'] = NULL;
    
    if (!empty($row['w_date']))
    {
      $use_dow = $use_dur = $use_per = $use_dep = 0;

      $wdate = fn_fdate($row['w_date']);
      if (strcmp(substr($row['w_date'], 8, 2), "00") == 0)
        $use_dur = 1;
      else
      if (!empty($row['w_date_day']))
        $use_dow = 1;

      if ($row['w_date_prd'] != 'E' && $row['w_date_prd'] != 'M')
      {
        $use_per = 1;
        $per = fn_prd($row['w_date_prd']);
      }

      if (!empty($row['depot_name_w']))
      {
        $use_dep = 1;
        $dep .= " off <a href=\"" . $row['depot_when_wdn_hl']
                          . "\">" . $row['depot_name_w'] . " (" . $row['depot_code_w'] . ")";
      }

      // Now build the string
      $row['withdrawal'] = '';
      if ($use_dur)
        $row['withdrawal'] .= 'During ';
      if ($use_per)
        $row['withdrawal'] .= $per . ' ';
      if ($use_dow)
        $row['withdrawal'] .= substr($row['w_date_day'], 0, 3) . ' ';
      $row['withdrawal'] .= $wdate;
      if ($use_dep)
        $row['withdrawal'] .= ' ' . $dep;
        
      if (!empty($row['w_notes']))
      {
        $row['withdrawal'] .= ' (' . $row['w_notes'] . ')';
      }
    }
    
    if (!empty($row['b_date']))
    {
      $use_dow = $use_dur = $use_per = $use_dep = 0;

      $wdate = fn_fdate($row['b_date']);
      if (strcmp(substr($row['b_date'], 8, 2), "00") == 0)
        $use_dur = 1;
      else
      if (!empty($row['b_date_day']))
        $use_dow = 1;

      if ($row['b_date_prd'] != 'E' && $row['b_date_prd'] != 'M')
      {
        $use_per = 1;
        $per = fn_prd($row['b_date_prd']);
      }

      if (!empty($row['depot_name_b']))
      {
        $use_dep = 1;
        $dep = " to <a href=\"" . $row['depot_when_new_hl']
                         . "\">" . $row['depot_name_b'] . " (" . $row['depot_code_b'] . ")";
      }

      // Now build the string
      $row['to_service'] = '';
      if ($use_dur)
        $row['to_service'] .= 'During ';
      if ($use_per)
        $row['to_service'] .= $per . ' ';
      if ($use_dow)
        $row['to_service'] .= substr($row['w_date_day'], 0, 3) . ' ';
      $row['to_service'] .= $wdate;
      if ($use_dep)
        $row['to_service'] .= ' ' . $dep;
    }
    
    if (!empty($row['initial_cost']))
    {
      $row['cost_when_new'] = fn_cost($row['initial_cost']);
      
      if (!empty($row['initial_cost_notes']))
      {
        $row['cost_when_new'] .= ' (' . str_replace("�", "&pound;", $row['initial_cost_notes']) . ')';
      }
    }

    if (!empty($row['s_date']))
    {
      $use_dow = $use_dur = $use_per = $use_dep = 0;

      $wdate = fn_fdate($row['s_date']);
      if (strcmp(substr($row['s_date'], 8, 2), "00") == 0)
        $use_dur = 1;
      else
      if (!empty($row['s_date_day']))
        $use_dow = 1;

      if ($row['s_date_prd'] != 'E' && $row['s_date_prd'] != 'M')
      {
        $use_per = 1;
        $per = fn_prd($row['s_date_prd']);
      }

      if (!empty($row['sc_name']))
      {
        $use_dep = 1;
        $dep = " at <a href=\"" . $row['sc_name_hl'] . "\">" . $row['sc_name'];
      }

      // Now build the string
      $row['scrapped'] = '';
      if ($use_dur)
        $row['scrapped'] .= 'During ';
      if ($use_per)
        $row['scrapped'] .= $per . ' ';
      if ($use_dow)
        $row['scrapped'] .= substr($row['s_date_day'], 0, 3) . ' ';
      $row['scrapped'] .= $wdate;
      if ($use_dep)
        $row['scrapped'] .= ' ' . $dep;
    }
    else
    if (!empty($row['sc_name']))
    {
      $row['scrapped'] = " <a href=\"" . $row['sc_name_hl'] . "\">" . $row['sc_name'];
    }

    if (!empty($row['svc_date']))
      $row['to_stock'] = fn_fdate($row['svc_date']);

    $b_date = $row['b_date'];

    $dt = new date_span();

    if (!empty($row['w_date']) && !empty($row['b_date']))
    {
      $dis_val = $dt->calculate_span($row['b_date'], $row['w_date']);
      $dis_val_fmt = $dt->calculate_span($row['b_date'], $row['w_date'], "Y");
    }

    if (!empty($row['sfs_date']))
      $row['sfs_date'] = fn_fdate($row['sfs_date']);

    if (!empty($row['into_date']))
      $row['into_date'] = fn_fdate($row['into_date']);

    if (!empty($row['cut_notes']))
    {
      if (!empty($row['s_date']))
        $row['s_date'] .= " (" . $row['cut_notes'] . ")";
      else
        $row['s_date'] = $row['cut_notes'];
    }

      $row['dis'] = $dis_val;
    $row['dis_fmt'] = $dis_val_fmt;

    if ($ct > 1)
      $row['subclass'] = $rw;

    if (!empty($row['prg_company']))
    {
      $row['co_history'] = $row['prg_company'];
    }

    if (!empty($row['big4_company']))
    {
      if (!empty($row['co_history']))
      {
        $row['co_history'] .= "/" . $row['big4_company'];
      }
      else
      {
        $row['co_history'] = $row['big4_company'];
      }
    }

    if ($row['br_standard'] != "N")
    {
      if (!empty($row['co_history']))
      {
        $row['co_history'] .= "/BR";
      }
      else
      {
        $row['co_history'] = "BR";
      }
    }

    if (!empty($row['mileage']))
    {
      $row['mileage'] = fn_ncomma($row['mileage']);
    }

    if ($row['virtual_ind'] == "Y")
      $row['order_number'] = "No Order ID issued";

    $table_specifics->add_data($row);
    $table_disposal->add_data($row);
  }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 3: Get the numbers carried by this locomotive                                         */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT sn.start_date,
                 sn.start_date_prd,
                 sn.number_type,
                 sn.subtype,
                 cmp_name AS company,
                 sn.carried_number,
                 concat(ifnull(sn.prefix, ""), sn.number, ifnull(sn.suffix, "")) AS number,
                 sn.by_flag,
                 sn.notes
          from   s_nums sn
          left join ref_companies c
          on     c.cmp_initials = sn.company
          where  sn.loco_id = ' .$id. '
          order by sn.start_date, subtype';
  
  $result = $db->execute($sql);

  $nx = 0;
  
  if ($result)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $sn01 = $row['number_type'];
    
      if ($row['by_flag'] == "B")
        $rowx['sdate'] = "by " . fn_fdate($row['start_date']);
      else
      if ($row['by_flag'] == "A")
        $rowx['sdate'] = "after " . fn_fdate($row['start_date']);
      else
        $rowx['sdate'] = fn_fdate($row['start_date']);
        
      if (!empty($row['notes']))
        $rowx['sdate'] .= ' (' . $row['notes'] . ')';

      if ($row['carried_number'] == "N")
      {
        $rowx['number'] = "<i>" . $row['number'] . "</i>";    
        $rowx['sdate'] = "Not applied";
      }
      else
      {
        $rowx['number'] = $row['number'];
        
        if ($row['start_date_prd'] != 'E' /* && $row['start_date_prd'] != 'M' */)
          $rowx['sdate_prd'] = fn_prd($row['start_date_prd']);
        else
          $rowx['sdate_prd'] = 'on';
      }

      if ($sn01 == "PRG" or $sn01 == "BIG4") /* Pre 1923 Grouping - excepting GWR */
      {
        if (!empty($row['company']))
          $rowx['text'] = $row['company'];
        else
        {
          if ($sn01 == "BIG4")
            $rowx['text'] = "Big Four";
          else
            $rowx['text']  = "Pre Grouping";
        }

        if (!empty($row['subtype']))
          $rowx['text'] .= " (" . $row['subtype'] . ")";
      }
      else
      if ($sn01 == "WD")
      {
        $rowx['text']  = "War Dept.";

        if (!empty($row['company']) && $row['company'] <> "WD")
          $rowx['text'] .= " (" . $row['company'] . ")";
      }
      else
      if ($sn01 == "DP") /* Departmental */
        $rowx['text']  = "Departmental";
      else
      if ($sn01 == "OS") /* Overseas */
        $rowx['text']  = "Overseas (" . $row['company'] . ")";
      else
      if ($sn01 == "PVT") /* Private */
        $rowx['text']  = "Private (" . $row['company'] . ")";
      else
      {
        $rowx['text']  = $row['company'];

        if (!empty($row['subtype']))
          $rowx['text'] .= " (" . $row['subtype'] . ")";
      }

      if (!empty($rowx['sdate']))
      {
        $msgdate = $row['start_date'];
        if (strncmp($rowx['sdate'], "00", 2) == 0)
        {
          $rowx['sdate'] = "c. " . substr($rowx['sdate'], 3);
        }
      }
      else
        $msgdate = "Unknown";

      if ($nx++ == 0)
      {
        $msg = "Original: " .  $row['company'];

        if (!empty($row['subtype']))
          $msg .= " (" . $row['subtype'] . ")";
        $msg .= " number allocated: " . $row['number'];
      }
      else
      {
        $msg = "Renumbered: " . $row['company'];

        if (!empty($row['subtype']))
          $msg .= " (" . $row['subtype'] . ")";
        $msg .= " number applied: " . $row['number'];
      }

      $table_numbers->add_data($rowx);
    }
  }

  if ($result) mysqli_free_result($result);
  $row = $rowx = NULL;


/***********************************************************************************************/
/*                                                                                             */
/* Stage 4a: Get the tenders carried by this locomotive                                        */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT t.*,
                 s.b_date                                                 AS start_date,
                 st.tender_number                                         AS tnum,
                 concat("components.php?comp=tender&id=", st.s_tender_id) AS tnum_hl
          FROM   s_to_tender s2ta

          JOIN   s_tender st
          ON     st.s_tender_id = s2ta.s_tender_id

          JOIN   ref_tender_type t
          ON     st.tender_type_id = t.tender_type_id
          
          JOIN   steam s
          ON     s.loco_id = s2ta.loco_id

          WHERE  s2ta.loco_id = ' . $id . '
          AND    s2ta.first_tender = "Y"
          
          UNION
          
          SELECT t.*,
                 ifnull(s2tb.start_date, "9999-12-31")                    AS start_date,
                 st.tender_number                                         AS tnum,
                 concat("components.php?comp=tender&id=", st.s_tender_id) AS tnum_hl
          FROM   s_to_tender s2tb

          JOIN   s_tender st
          ON     st.s_tender_id = s2tb.s_tender_id

          JOIN   ref_tender_type t
          ON     st.tender_type_id = t.tender_type_id

          WHERE  s2tb.loco_id = ' . $id . '
          AND    s2tb.first_tender = "N"
          
          ORDER BY start_date ASC';

  //echo $sql;

  $result = $db->execute($sql);

  if ($result)
  {
    if (($tender_ct = $db->count_select()) > 0)
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        if ($row['start_date'] == "9999-12-31")
          $row['start_date'] = "Unknown";
        else
          $row['start_date'] = fn_fdate($row['start_date']);
        $row['water_capacity'] = fn_ncomma($row['water_capacity'], "g");
        $row['coal_capacity'] = fn_tons($row['coal_capacity']);
        $row['tender_weight'] = fn_tons($row['tender_weight']);
        $table_tender->add_data($row);
      }
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 4b: Get the names carried by this locomotive                                          */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT snm.*,
                 concat("names.php?id=", snm.s_name_id, "&amp;type=S") AS name_hl
          FROM   s_name snm 
          WHERE  snm.loco_id = ' .$id. '
          ORDER BY snm.start_date ASC';
  
  $result = $db->execute($sql);

  if ($result)
  {
    $name_ct = $db->count_select();
    $nct = 0;

    if ($name_ct > 0)
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        ++$nct;

        $row['start_date'] = fn_fdate($row['start_date']);
        if (!empty($row['end_date']) && $nct < $name_ct)
          $row['name'] .= " (removed " . fn_fdate($row['end_date']) . ")";
        $table_names->add_data($row);
      }
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 4c: Document the visits to works                                                      */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT wv.visit_id,
                 wv.stopped_date,
                 wv.start_date,
                 wv.end_date,
                 wv.mileage,
                 wv.duration,
                 wv.summary,
                 coalesce(vt.description, wv.visit_code) AS regime,
                 coalesce(bl.bl_short_name, bl.bl_name)  AS bl_name,
                 concat("sites.php?page=builders&subpage=main&id=", wv.bl_code) 
                                                         AS bl_name_hl,
                 dp.depot_name                           AS dp_name,
                 concat("sites.php?page=depots&subpage=main&id=", wv.depot_id) 
                                                         AS dp_name_hl,
                 wv.summary,
                 wv.reason_text
          FROM   works_visits wv
          LEFT JOIN ref_builders bl
          ON     bl.bl_code = wv.bl_code
          LEFT JOIN ref_depot dp
          ON     dp.depot_id = wv.depot_id
          LEFT JOIN ref_visit_type vt
          ON     vt.visit_code = wv.visit_code
          WHERE  wv.type = "S"
          AND    wv.loco_id = ' . $id . '
          ORDER BY ifnull(wv.start_date, wv.end_date) ASC';

  //echo $sql;

  $result = $db->execute($sql);

  if ($result)
  {
    if (($wv_count = $db->count_select()) > 0)
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        $row['stopped_date'] = fn_fdate($row['stopped_date']);
        $row['start_date'] = fn_fdate($row['start_date']);
        $row['end_date'] = fn_fdate($row['end_date']);

        if (!empty($row['duration']))
        {
          if ($row['duration'] == 1)
            $row['duration'] .= " day";
          else
            $row['duration'] .= " days";
        }

#        if (!empty($row['summary']))
#         $row['regime'] .=  "<br />" . $row['summary'];
        
        if (!empty($row['dp_name']))
        {
          $row['bl_name'] = $row['dp_name'] . " (on shed)";
          $row['bl_name_hl'] = $row['dp_name_hl'];
        }
        
        $table_works->add_data($row);
      }
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 5: Get the modifications made to this locomotive                                      */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT sm.date_modified         AS mdate_unf,
                 m.description            AS description,
                 sm.date_modified_prd     AS date_approx
          FROM   s_mods sm
          JOIN   ref_modifications m
          ON     m.modification = sm.modification
          WHERE  sm.loco_id = ' .$id. '
          UNION
          SELECT s2b.start_date           AS mdate_unf,
                 concat("Diagram ",
                        CASE when bt.boiler_diagram_no IS NULL THEN
                          "(unknown)"
                             else
                          bt.boiler_diagram_no
                        END,
                        " boiler fitted",
                        CASE when sbn.boiler_number IS NOT NULL THEN
                          concat(" (number <a href=\"components.php?comp=boiler&id=", sb.s_boiler_id,
                                 "\">", sbn.boiler_number, "</a>)")
                             else
                          " "
                        END) AS description,
                 NULL                     AS date_approx
          FROM   s_to_boiler s2b
          LEFT JOIN s_boiler sb
          ON     sb.s_boiler_id = s2b.s_boiler_id
          LEFT JOIN s_boiler_nums sbn
          ON     sbn.s_boiler_id = sb.s_boiler_id
          AND    sbn.start_date = (SELECT max(sbn1.start_date)
                                   FROM   s_boiler_nums sbn1
                                   WHERE  sbn1.s_boiler_id = sb.s_boiler_id
                                   AND    sbn1.start_date <= s2b.start_date)
          JOIN   ref_boiler_type bt
          ON     bt.boiler_type_id = sb.boiler_type_id
          WHERE  s2b.loco_id = ' . $id . '
          and    sb.renumber_date is null
          and    s2b.first_boiler = "N"

          UNION

          SELECT s2bt.start_date          AS mdate_unf,
                 concat("Diagram ",
                        CASE when bt.boiler_diagram_no IS NULL THEN
                          "(unknown)"
                             else
                          bt.boiler_diagram_no
                        END,
                        " boiler fitted",
                        CASE when bt.firebox_type IS NOT NULL THEN
                          concat(" (", bt.firebox_type, " firebox)")
                            else
                          " "
                        END) AS description,
                 NULL                     AS date_approx
          FROM   s_to_boiler_type s2bt
          JOIN   steam s
          ON     s.loco_id = s2bt.loco_id
          JOIN   ref_boiler_type bt
          ON     bt.boiler_type_id = s2bt.boiler_type_id
          WHERE  s2bt.loco_id = ' . $id . '
          AND    s.b_date <> s2bt.start_date
          ORDER BY mdate_unf ASC';
          
  // echo $sql;

  $result = $db->execute($sql);

  if ($result)
  {
  if (($mods_count = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      if ($row['date_approx'] == "B" or $row['date_approx'] == "Y")
          $row['mdate'] = "by " . fn_fdate($row['mdate_unf']);
      else
          $row['mdate'] = fn_fdate($row['mdate_unf']);

        $table_mods->add_data($row);
    }
  }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 6: Get the allocations this locomotive undertook                                      */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT ifnull(dc.displayed_depot_code, sa.allocation)         AS allocation,
                 sa.loan_allocation                                     AS loan_allocation,
                 sa.allocation                                          AS check_allocation,
                 sa.snap,
                 d.depot_name,
                 sa.alloc_date,
                 sa.alloc_flag,
                 sa.alloc_date_prd,
                 concat("sites.php?page=depots&action=query&id=", d.depot_id) AS allocation_hl,
                 concat("sites.php?page=depots&action=query&id=", d.depot_id) AS depot_name_hl,
                 sa.caveat,
                 sa.loco_usage,
                 d2.depot_name                                          AS home_shed_name,
                 dc2.depot_code                                         AS home_shed_alloc
          from   tdw_allocations sa
          
          LEFT JOIN ref_depot_codes dc
          ON    (dc.depot_code = coalesce(sa.loan_allocation, sa.allocation)
             OR  dc.gwr_numeric_code = coalesce(sa.loan_allocation, sa.allocation))
          AND    dc.date_from  = (SELECT max(dca.date_from)
                                  FROM   ref_depot_codes dca
                                  WHERE (dca.depot_code = coalesce(sa.loan_allocation, sa.allocation)
                                     OR  dca.gwr_numeric_code = coalesce(sa.loan_allocation, sa.allocation))
                                  AND    dca.date_from <= sa.alloc_date)
          LEFT JOIN ref_depot d
          ON     d.depot_id = dc.depot_id

          LEFT JOIN ref_depot_codes dc2
          ON     dc2.depot_code = sa.allocation
          AND    dc2.date_from  = (SELECT max(dcb.date_from)
                                  FROM   ref_depot_codes dcb
                                  WHERE  dcb.depot_code = sa.allocation
                                  AND    dcb.date_from <= sa.alloc_date)
          LEFT JOIN ref_depot d2
          ON     d2.depot_id = dc2.depot_id

          WHERE  sa.loco_id = ' .$id. '
          AND    sa.type = "S"
          ORDER BY sa.alloc_date ASC, sa.seq ASC';


  $result = $db->execute($sql);

  if ($result)
  {
  if (($alloc_ct = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      if (!empty($row['alloc_date']))
      {
        $row['period'] = fn_prd($row['alloc_date_prd']);

        if (!strncmp($row['check_allocation'], "98S", 3))
          $row['allocation'] = '98S';
        
        if ($row['alloc_flag'] == 'W')
          $row['allocation'] = '98W';
        
        fn_depot_name($row['alloc_flag'], 
                      $row['caveat'],
                      $row['loco_usage'],
                      $row['allocation'],
                      $row['loan_allocation'],
                      $row['depot_name'],
                      $row['home_shed_name'],
                      $row['home_shed_alloc'],
                      $alloc,
                      $desc);

        $row['alloc_date'] = fn_fdate($row['alloc_date']);
        $row['allocation'] = $alloc;
        $row['depot_name'] = $desc;

        if ($row['snap'] == "Y")
          $row['alloc_date'] .= " (Snapshot)";

        $table_allocs->add_data($row);
      }
    }
  }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 6a: Get the allocations this locomotive undertook                                     */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT stg.alloc,
                 stg.act,
                 stg.inc_date,
                 stg.inc_prd,
                 stg.number,
                 stg.company,
                 d.depot_name,
                 concat("sites.php?page=depots&action=query&id=", d.depot_id) AS allocation_hl,
                 concat("sites.php?page=depots&action=query&id=", d.depot_id) AS depot_name_hl
          from   brdataba_stage.allocation_history_st stg
          LEFT JOIN brdataba_live.ref_depot_codes dc
          ON     dc.depot_code = stg.alloc
          AND    dc.date_from  = (SELECT max(dca.date_from)
                                  FROM   brdataba_live.ref_depot_codes dca
                                  WHERE  dca.depot_code = stg.alloc
                                  AND    dca.date_from <= stg.inc_date)
          LEFT JOIN brdataba_live.ref_depot d
          ON     d.depot_id = dc.depot_id

          WHERE  stg.loco_id = ' .$id. '
          ORDER BY stg.inc_date ASC, stg.sequence ASC';

  $result = $db->execute($sql);

  if ($result)
  {
  if (($alloc_ct = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['inc_prd'] = fn_prd($row['inc_prd']);
      
      if ($row['act'] == 'HIRE')
      {
          $row['depot_name'] = $row['alloc'];
          $row['alloc'] = "";
      }
      
      //fn_depot_name($row['alloc_flag'], 
      //              $row['caveat'],
      //              $row['loco_usage'],
      //              $row['allocation'],
      //              $row['loan_allocation'],
      //              $row['depot_name'],
      //              $row['home_shed_name'],
      //              $row['home_shed_alloc'],
      //              $alloc,
      //              $desc);

      $row['inc_date'] = fn_fdate($row['inc_date']);
      //$row['allocation'] = $alloc;
      //$row['depot_name'] = $desc;

      //if ($row['snapshot'] == "Y")
      //  $row['alloc_date'] .= " (Snapshot)";

      $table_sls->add_data($row);
    }
  }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 8: Get the liveries applied to this locomotive                                        */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT concat(l.company, " ", l.base_colour) AS base_colour,
                 l.lining,
                 sl.start_date
          FROM   s_to_livery sl
          JOIN   ref_livery l
          ON     l.livery_id = sl.livery_id
          WHERE  sl.loco_id = ' .$id. '
          ORDER BY sl.start_date ASC';

  $result = $db->execute($sql);

  if ($result)
  {
  if (($livery_count = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
      {
        $row['start_date'] = fn_fdate($row['start_date']);

        $table_liveries->add_data($row);
      }
  }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 9: Get the preservation details for this locomotive                                   */
/*                                                                                             */
/***********************************************************************************************/

  $sql = 'SELECT p.*,
                 concat("\"javascript:void(0)\" onClick=\"window.open(\'https://", p.weblink, "\')\"") 
                           as weblink_hl  ,
                 rps.name
          FROM   preservation p
          LEFT JOIN ref_preservation_sites rps
          ON     rps.code = p.current_base
          WHERE  p.loco_id = ' . $id . '
          AND    p.type = "S"';
                           
  $result = $db->execute($sql);

  if ($result)
  {
  if (($preservation_count = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
      {
        $row['date_preserved'] = fn_fdate($row['date_preserved']);
        $row['status']         = fn_preservation_status($row['status']);
        $row['status_date']    = fn_fdate($row['status_date']);
        
        if (!empty($row['name']))
          $row['location'] = $row['name'];

        $table_pres->add_data($row);
      }
  }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 10: Get the preservation details for this locomotive                                  */
/*                                                                                             */
/***********************************************************************************************/

  $sql = 'SELECT info
          FROM   s_notes sn
          WHERE  sn.loco_id = ' . $id . '
          ORDER BY sn.seq';
                           
  $result = $db->execute($sql);

  if ($result)
  {
  if (($notes = $db->count_select()) > 0)
  {
    $ct = 0;
    while ($row = mysqli_fetch_assoc($result))
    {
      $ct += 1;

      if ($ct == 1)
        $nt = $row['info'];
      else
        $nt .= "<br />" . $row['info'];
    }

    $row['info'] = $nt;
    $table_notes->add_data($row);
  }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;


/***********************************************************************************************/
/*                                                                                             */
/* Stage 11: Get the snippet details for this locomotive                                       */
/*                                                                                             */
/***********************************************************************************************/

  $sql = 'select concat(stn.source, "/", stn.file_date) AS source,
                 concat(stn.title, CASE WHEN stnl.sublocation IS NOT NULL THEN
                                        concat(" (", stnl.sublocation, ")")
                                   ELSE
                                        ""
                                   END)     AS title,
                 stn.note,
                 stn.note_date,
                 stn.note_prd
          from   brdataba_stage.st_notes stn
          join   brdataba_stage.st_notes_link stnl
          on     stnl.unique_id = stn.unique_id
          join   brdataba_live.steam s
          on     s.loco_id = stnl.loco_id
          and    stnl.type = "S"
          and    s.loco_id = ' . $id . '
          order by stnl.note_date';
                           
  $result = $db->execute($sql);

  if ($result)
  {
  if (($snippet_count = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
      {
        $row['note_date'] = fn_fdate($row['note_date']);

        $table_snippets->add_data($row);
      }
  }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;


/********************************************************************************************/
/*                                                                                          */
/* Stage 12: Get summary for this locomotive                                                */
/*                                                                                          */
/********************************************************************************************/

  $sql = 'SELECT ss.*,
                 ss.ig_id                                                           AS lnk,
                 concat("timelines.php?page=workings&subpage=groups&id=", ss.ig_id) AS lnk_hl
          FROM   s_summary ss
          WHERE  ss.loco_id = ' . $id .'
          ORDER BY event_date, ss.details';
                           
  $result = $db->execute($sql);

  if ($result)
  {
  if (($summary = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      if (!empty($row['lnk']))
        $row['lnk'] = "Link";
      $row['event_date'] = fn_fdate($row['event_date']);
      $table_summary->add_data($row);
    }
  }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/********************************************************************************************/
/*                                                                                          */
/* Stage 13: Get details of previous and next locos (if they exist)                         */
/*                                                                                          */
/********************************************************************************************/

  $prev_id = $next_id = 0;
  $prev_num = $next_num = "";
  $b_prev = false;
  
  $sql = 'SELECT sn.number        AS number,
                 F.mx             AS loco_id
          FROM   s_nums sn
          JOIN (SELECT max(scl_p.loco_id) AS mx
                FROM   s_class_link scl_p
                JOIN   s_class_link scl_c
                ON     scl_p.s_class_id = scl_c.s_class_id
                WHERE  scl_c.loco_id = ' . $id . '
                AND    scl_p.loco_id < scl_c.loco_id) AS F
          ON    F.mx = sn.loco_id
          JOIN  steam s
          ON    s.loco_id = F.mx
          AND   s.b_date = sn.start_date';

  $result = $db->execute($sql);

  if ($result)
  {
    $row = mysqli_fetch_assoc($result);

    if (!$db->count_select())
      $b_prev = false;
    else
    {
      $b_prev = true;
      $prev_id  = $row['loco_id'];
      $prev_num = $row['number'];
    }
  }
          
  $sql = 'SELECT sn.number        AS number,
                 F.mn             AS loco_id
          FROM   s_nums sn
          JOIN (SELECT min(scl_p.loco_id) AS mn
                FROM   s_class_link scl_p
                JOIN   s_class_link scl_c
                ON     scl_p.s_class_id = scl_c.s_class_id
                WHERE  scl_c.loco_id = ' . $id . '
                AND    scl_p.loco_id > scl_c.loco_id) AS F
          ON    F.mn = sn.loco_id
          JOIN  steam s
          ON    s.loco_id = F.mn
          AND   s.b_date = sn.start_date';

//echo $sql;

  $result = $db->execute($sql);
          
  if ($result)
  {
    $row = mysqli_fetch_assoc($result);

    if (!$db->count_select())
      $b_next = false;
    else
    {
      $b_next = true;
      $next_id  = $row['loco_id'];
      $next_num = $row['number'];
    }
  }

/***********************************************************************************************/
/*                                                                                             */
/* Stage 14: Get details of previous and next locos (if they exist)                            */
/*                                                                                             */
/***********************************************************************************************/

  $log_count = 0;
  
  $sql = 'SELECT lh.lh_main_title,
                 lh.lh_start_date,
                 lh.lh_end_date,
                 ld.ld_details,
                 coalesce(ld.ld_date, lh.lh_start_date) as ld_date,
                 ld.ld_reporting_number AS headcode,
                 lr.reference,
                 rd.depot_name,
                 rsm.merchant_name      AS scr_merchant,
                 rs.location            AS scr_location,
                 rl.location            AS site_location,
                 rbl.bl_name            AS bl_name,
                 s2l.caveat
          FROM   log_details ld
          JOIN   s_to_log s2l
          ON     s2l.log_dtl_id = ld.ld_id
          LEFT JOIN log_head lh
          ON     lh.lh_id = ld.ld_lh_id
          LEFT JOIN log_reference lr
          ON     lr.log_ref_id = coalesce(lh.reference_id, ld.reference_id)
          LEFT JOIN ref_depot rd
          ON     rd.depot_id = ld.depot_id
          LEFT JOIN ref_scrapyard rs
          ON     rs.scrapyard_code = ld.scrapyard_code
          LEFT JOIN ref_scrap_merchant rsm
          ON     rsm.merchant_code =  substr(rs.scrapyard_code, 1, 3)
          LEFT JOIN ref_locations rl
          ON     rl.location_id = ld.site_reference
          LEFT JOIN ref_builders rbl
          ON     rbl.bl_code = ld.bl_code
          WHERE  s2l.loco_id = ' . $id . '
          ORDER BY ld_date';

  $result = $db->execute($sql);

  if ($result)
  {
    if (($log_count = $db->count_select()) > 0)
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        $row['ld_date'] = fn_fdate($row['ld_date']);
        
        if (!empty($row['start_date']))
          $row['start_date'] = fn_fdate($row['start_date']);
          
        if (!empty($row['end_date']))
          $row['end_date'] = fn_fdate($row['end_date']);
          
        if (!empty($row['caveat']))
          $row['ld_details'] .= " (" . $row['caveat'] . ")";
          
        if (!empty($row['depot_name']))
          $row['location'] = $row['depot_name'];
        elseif (!empty($row['site_location']))
          $row['location'] = $row['site_location'];
        elseif (!empty($row['bl_name']))
          $row['location'] = $row['bl_name'];
        elseif (!empty($row['scr_merchant']))
          $row['location'] = $row['scr_merchant'] . $row['scr_location'];
          
        $table_log->add_data($row);
      }      
    }
  }
  
  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 99: Display the tables with HTML                                                      */
/*                                                                                             */
/***********************************************************************************************/

  if ($b_prev)
  {
    printf("<a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=S&amp;loco=%s\">", 
           $prev_id, $prev_num);
      printf("<img src=\"img/prev.gif\" alt=\"prev\" id=\"img_prev\" />\n");
    printf("</a>\n");
  }

  if ($b_next)
  {
    printf("<a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=S&amp;loco=%s\">", 
           $next_id, $next_num);
      printf("<img src=\"img/next.gif\" alt=\"prev\" id=\"img_next\" />\n");
    printf("</a>\n");
  }

/* HTML table definition */
  printf("<table width=99%% frame=box valign=top>\n");
    printf("<tr valign=top>\n");
      printf("<td width=49%%>\n");

            // numbers always present
        $table_numbers->draw_table();
        printf("<br />\n");

            // names optional
        if ($name_ct > 0 || $update)
        {
            $table_names->draw_table();
          printf("<br />\n");
        }
            // liveries optional
        if ($livery_count > 0 || $update)
        {
            $table_liveries->draw_table();
          printf("<br />\n");
        }

            // always present
        $table_specifics->draw_table();
        printf("<br />\n");

        $table_disposal->draw_table();
        printf("<br />\n");

        if ($tender_ct > 0 || $update)
        {
          $table_tender->draw_table();
          printf("<br />\n");
        }

        if ($notes > 0 || $update)
        {
          $table_notes->draw_table();
          printf("<br />\n");
        }

      printf("</td>\n");
      printf("<td width=49%% valign=top>\n");

      // always present - but not until database is complete
      $table_allocs->draw_table();
      printf("<br />\n");

      // always present - but not until database is complete
      $table_sls->draw_table();
      printf("<br />\n");
	  printf("* Stephenson Locomotive Society data - raw and not yet cross-referenced<br />");

      if ($mods_count > 0 || $update)
      {
        $table_mods->draw_table();
        printf("<br />\n");
      }

      // preservation optional
      if ($preservation_count > 0 || $update)
      {
        $table_pres->draw_table();
        printf("<br />\n");
      }

    printf("</td>\n");
    printf("</tr>\n");
  printf("</table>\n");

  printf("<br />\n");
 
  if ($log_count > 0 || $update)
  {
    $table_log->draw_table();
    printf("<br />\n");
  }

  if ($wv_count > 0 || $update)
  {
    $table_works->draw_table();
    printf("<br />\n");
  }

  if ($snippet_count > 0 || $update)
  {
    $table_snippets->draw_table();
    printf("<br />\n");
  }

  //  always present, even if empty
  $table_summary->draw_table();

  printf("<br />\n");

  if ($b_prev)
  {
    printf("<a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=S&amp;loco=%s\">", 
           $prev_id, $prev_num);
      printf("<img src=\"img/prev.gif\" alt=\"prev\" id=\"img_prev\" />\n");
    printf("</a>\n");
  }

  if ($b_next)
  {
    printf("<a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=S&amp;loco=%s\">", 
           $next_id, $next_num);
      printf("<img src=\"img/next.gif\" alt=\"prev\" id=\"img_next\" />\n");
    printf("</a>\n");
  }

 //<a href="www.hyperlinkcode.com"><img src="/images/sample-image.gif" border="0"></a> 
 // printf("<img src=\"img/prev.gif\" alt=\"prev\" id=\"img_prev\" />\n");
 // printf("<img src=\"img/next.gif\" alt=\"next\" id=\"img_next\" />\n");

  printf("<br />\n");
  printf("<br />\n");
?>
