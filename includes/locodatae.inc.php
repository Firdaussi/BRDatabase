<?php
                
/***********************************************************************************************/
/*                                                                                             */
/* Stage 0: Preliminaries - set up specifics table                                             */
/*                                                                                             */
/***********************************************************************************************/

  include_once "lib/MyTables.class.php";
  include_once "lib/brlib.php";

  $table_specifics = new MyTables("loco_table");

  $table_specifics->add_caption("Locomotive Specifics");
  $table_specifics->suppress_nulls();
//$table_specifics->add_row("designer",          "Designer");
  $table_specifics->add_row("identifier",        "Class");
  $table_specifics->add_row("subclass",          "Rebuild History");
  $table_specifics->add_row("wheel_arrangement", "Wheels");
  $table_specifics->add_row("bl_name",           "Builder");
  $table_specifics->add_row("order_number",      "Order Number");
  $table_specifics->add_row("works_number",      "Works Number");
  $table_specifics->add_row("b_date",            "To Service");
  $table_specifics->add_row("depot_when_new",    "To Service At");
  $table_specifics->add_row("w_date",            "Withdrawn");
  $table_specifics->add_row("depot_when_wdn",    "Withdrawn From");
  $table_specifics->add_row("reason_withdrawn",  "Withdrawal Reason");
  $table_specifics->add_row("dis",               "Time in Service");
  $table_specifics->add_row("mileage",           "Total Mileage");
  $table_specifics->add_row("s_date",            "Cut Up");
  $table_specifics->add_row("sc_name_place",     "Cut At");
  $table_specifics->add_row("v_info",            "Video Clip");
  $table_specifics->add_row("e_info",            "Information");
  $table_specifics->add_row("status",            "Status");
  $table_specifics->add_row_lwidth(35); /* percentage of width of table for first column */
  $table_specifics->set_align("V");

  $table_numbers = new MyTables("loco_nums");
  $table_numbers->add_caption("Numbers Carried");
  $table_numbers->add_column("text",       "Type",      35);
  $table_numbers->add_column("number",     "Number",    25);
  $table_numbers->add_column("sdate",      "Date From", 40);

  $table_names = new MyTables("loco_names");
  $table_names->add_caption("Names Carried");
  $table_names->add_column("start_date", "Date From", 35);
  $table_names->add_column("name",       "Name",      65);
//  $table_names->add_row_lwidth(35); /* percentage of width of table for first column */   
//  $table_names->set_align("V");

  $table_mods = new MyTables("loco_mods");
  $table_mods->add_caption("Modifications");
  $table_mods->add_column("date_modified",   "Date Modified", 11);
  $table_mods->add_column("order_number",    "Order Number",  15);
  $table_mods->add_column("description",     "Modification",  32);
  $table_mods->add_column("status",          "Status",        12);
  $table_mods->add_column("cost_to_capital", "Charged to Capital",       10);
  $table_mods->add_column("cost_to_revenue", "Charged to Revenue",       10);
  $table_mods->add_column("total_cost",      "Total Cost",    10);


  $table_allocs = new MyTables("allocations");
  $table_allocs->add_caption("Allocations");
  $table_allocs->add_column("allocation", "Code ",     9);
  $table_allocs->add_column("depot_name", "Name",     49);
  $table_allocs->add_column("period",     "",          7);
  $table_allocs->add_column("alloc_date", "Date From",35); 
  
  $table_works = new MyTables("works_visits");
  $table_works->add_caption("Works Visits");
  $table_works->add_column("bl_name",         "Works",          15);
  $table_works->add_column("start_date",      "Entry",          10);
  $table_works->add_column("end_date",        "Departure",      10);
  $table_works->add_column("duration",        "Durn",           7);
  $table_works->add_column("regime",          "Level of Work",  48);
  $table_works->add_column("mileage",         "Mileage",        10);
  
  $table_config = new MyTables("loco_config");
  $table_config->add_caption("Configuration");
  $table_config->add_column("config_date",     "Configuration Date", 11);
  $table_config->add_column("config",          "Configuration",      15);
  $table_config->add_column("config_desc",     "Description",        32);
  $table_config->add_column("additional",      "Additional",         32);
  $table_config->add_column("source",          "Source",             10);

  $table_log = new MyTables("log_details");
  $table_log->add_caption("Sightings", NULL);
  $table_log->add_column("ld_date",              "Report Date", 10);
  $table_log->add_column("lh_main_title",        "Title",       20);
  $table_log->add_column("location",             "Location",    10);
  $table_log->add_column("ld_details",           "Report",      32);
  $table_log->add_column("headcode",             "Headcode",     8);
  $table_log->add_column("reference",            "Reference",   20);
  
  $table_mil = new MyTables("mileages");
  $table_mil->add_caption("Performance Statistics (Form E.R.O 3666)");
  $table_mil->add_column("ym_date",            "Year",                       5, NULL, NULL, TRUE);
  $table_mil->add_column("mileage",            "Annual Mileage",             7);
  $table_mil->add_column("cumulative_mileage", "Cumulative Mileage",         7);
  $table_mil->add_column("fuel_oil",           "Fuel Oil Utilised",          7);
  $table_mil->add_column("fuel_consumption",   "Approximate Miles/Gallon",   7);
  $table_mil->add_column("classified_wrd",     "Classified Wait Repair",     6);
  $table_mil->add_column("classified_ww",      "Classified Wait Works",      6);
  $table_mil->add_column("classified_ow",      "Classified On Works",        6);
  $table_mil->add_column("classified_total",   "Classified Total (Wkdys)",   6);
  $table_mil->add_column("running_repairs",    "Running Repairs",            6);
  $table_mil->add_column("rr_cost",            "Running Repair & Exams Cost",       7);
  $table_mil->add_column("not_required",       "Wkdys Not Required for Service",   6);
  $table_mil->add_column("stored_ss",          "Wkdys Stored Serviceable",         6);
  $table_mil->add_column("stored_us",          "Wkdys Stored Unserviceable",       6);
  $table_mil->add_column("grand_total",        "Total Weekdays Unavailable", 6);
  
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

  $sql = 'SELECT ecv.identifier,
                 ecv.e_class_id,
                 ecl.start_date,
                 ecv.e_class_var_id
          FROM   e_class_link ecl
          JOIN   e_class_var  ecv
          ON     ecv.e_class_id = ecl.e_class_id
          AND    ecv.e_class_var_id = ecl.e_class_var_id
          WHERE  ecl.loco_id = ' .$id. '
          ORDER BY ecl.start_date, ecl.e_class_var_id';

  /* Build a mini table of variations - only displayed if more than one variation exists*/
  $ct = $last_class_id = $last_class_var_id = 0;

  $result = $db->execute($sql);

  if ($db->count_select())
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      if ($last_class_id == 0)
      {
        $class_id = $row['d_class_id'];  // for next/prev button processing

        $rw = "<table width=\"100%\" frame=\"box\"><tr><td width=\"40%\"><strong>Class</strong></td><td width=\"60%\"><strong>From</strong></td></tr>";
        $rw .= "<tr><td><a href=\"locoqry.php?action=class&amp;type=E&amp;id=" . $row['e_class_id']
              . "\">" . $row['identifier']
              .     "</a></td><td>"  . fn_fdate($row['start_date'])
              .     "</td></tr>";
      }
      else
      {
        if (($row['d_class_id']     != $last_class_id) ||
            ($row['d_class_var_id'] != $last_class_var_id))
        {
          $rw .= "<tr><td><a href=\"locoqry.php?action=class&amp;type=E&amp;id=" . $row['e_class_id']
                . "\">" . $row['identifier']
                .     "</a></td><td>"  . fn_fdate($row['start_date'])
                .     "</td></tr>";
        }
      }


      $ct++;

      $last_class_id = $row['e_class_id'];
      $last_class_var_id = $row['e_class_var_id'];
    }

    if ($ct > 0)
    {
      $rw = $rw . "</table>";
      $class_desc .= ")";
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 2: Get the detailed info specific to this locomotive                                  */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT e.*,
                 CASE WHEN e.works_num_b IS NOT NULL THEN
                   concat(e.works_num, "/", e.works_num_b)
                 ELSE
                   e.works_num
                 END                                                         AS works_number,
                 ecl.e_class_id,
                 concat(sm.merchant_name, " ", sy.location)            AS sc_name_place,
                 bl.bl_name,
                 concat("misc.php?page=wheel_arr&amp;id=", ec.wheel_arrangement) 
                                                                       AS wheel_arrangement_hl,
                 concat("sites.php?page=builders&amp;id=",           
                        bl.bl_code)                                    AS bl_name_hl,
                 concat("sites.php?page=scrapyards&amp;id=",  
                        sy.scrapyard_code)                             AS sc_name_place_hl,
                 ec.identifier,
                 concat("locoqry.php?action=class&amp;type=E&amp;id=",
                        ec.e_class_id)                                 AS identifier_hl,
                 ec.wheel_arrangement,
                 NULL AS dis,
                 e.info AS e_info,
                 NULL AS subclass,
                 v.url  as v_info_pop,
                 v.info as v_info,
                 dp_w.depot_name                                           AS depot_name_w,
                 coalesce(dc_w.displayed_depot_code, dc_w.depot_code)      AS depot_code_w,
                 concat("sites.php?page=depots&action=query&id=", dp_w.depot_id) 
                                                                           AS depot_when_wdn_hl,
                 dp_b.depot_name                                           AS depot_name_b,
                 coalesce(dc_b.displayed_depot_code, dc_b.depot_code)      AS depot_code_b,
                 concat("sites.php?page=depots&action=query&id=", dp_b.depot_id)
                                                                           AS depot_when_new_hl,
                 o.order_number,
                 o.virtual_ind,
                 concat("sites.php?page=builders&subpage=orders&id=", o.bl_code, "&lot=",
                         o.order_number, "&oid=", o.order_id)              AS order_number_hl,
                 concat("sites.php?page=builders&subpage=orders&id=", o.bl_code, "&lot=",
                         o.order_number, "&oid=", o.order_id)              AS works_number_hl
          from   electric e
          join   e_class_link ecl
          on     ecl.loco_id = e.loco_id
          join   e_class ec
          on     ec.e_class_id = ecl.e_class_id
          left join ref_builders bl
          on     bl.bl_code = e.bl_code
          left join ref_scrapyard sy
          on     sy.scrapyard_code = e.scrapyard_code
          left join ref_scrap_merchant sm
          on     sm.merchant_code = substr(sy.scrapyard_code, 1, 3)
          left join videos v
          on     v.type = "E"
          and    v.loco_id = e.loco_id
          left join ref_depot_codes dc_w
          on     dc_w.depot_code = e.last_depot
          and    dc_w.date_from = (select max(dc_w1.date_from)
                                   from   ref_depot_codes dc_w1
                                   where  dc_w1.depot_code = e.last_depot
                                   and    dc_w1.date_from <= e.w_date)
          left join ref_depot dp_w
          on     dp_w.depot_id = dc_w.depot_id
          left join ref_depot_codes dc_b
          on     dc_b.depot_code = e.first_depot
          and    dc_b.date_from = (select max(dc_b1.date_from)
                                   from   ref_depot_codes dc_b1
                                   where  dc_b1.depot_code = e.first_depot
                                   and    dc_b1.date_from <= e.b_date)
          left join ref_depot dp_b
          on     dp_b.depot_id = dc_b.depot_id
          left join ref_orders o
          on     o.order_id = e.order_id

          where  e.loco_id = ' .$id;

  $result = $db->execute($sql);

  if ($db->count_select())
  {
    $row = mysqli_fetch_assoc($result);

  // Don't loop - just take the info from the first record - needs revising!!!
    {
  //    $b_date = fn_fdate($row['b_date']);

      if (!empty($row['depot_name_w']))
        $row['depot_when_wdn'] = $row['depot_name_w'] . " (" . $row['depot_code_w'] . ")";

      if (!empty($row['depot_name_b']))
        $row['depot_when_new'] = $row['depot_name_b'] . " (" . $row['depot_code_b'] . ")";

      $b_date = $row['b_date'];

      $dt = new date_span();

      if (!empty($row['w_date']) && !empty($row['b_date']))
        $dis_val = $dt->calculate_span($row['b_date'], $row['w_date']);

      $row['dis'] = $dis_val;

      if ($ct > 1)
        $row['subclass'] = $rw;

      $row['class_type'] = $class_desc;

      $row['status'] = fn_get_status($row['b_date'],
                                     $row['w_date'],
                                     $row['scrapyard_code'],
                                     $row['preserved']);


      $row['b_date'] = fn_fdate($row['b_date']);
      $row['w_date'] = fn_fdate($row['w_date']);
      $row['s_date'] = fn_fdate($row['s_date']);
      $row['mileage'] = fn_ncomma($row['mileage'], " miles");

      $table_specifics->add_data($row);
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 3: Get the numbers carried by this locomotive                                         */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT en.start_date,
                 en.number_type,
                 en.subtype,
                 en.carried_number,
                 en.number,
                 en.start_date,
                 c.cmp_initials AS cmp_name
          from   e_nums en
          left join ref_companies c
          on     c.cmp_initials = en.company
          where  en.loco_id = ' .$id. '
          order by en.start_date, en.subtype';
  
  $result = $db->execute($sql);

  $nx = 0;

  if ($db->count_select())
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $dn01 = $row['number_type'];
        
      $rowx['sdate'] = fn_fdate($row['start_date']);

      if ($row['carried_number'] == "N")
      {
        $rowx['number'] = "<i>" . $row['number'] . "</i>";
        $rowx['sdate'] = "Not applied";
      }
      else
        $rowx['number'] = $row['number'];

      if ($dn01 == "BIG4") /* 1923-1948 */
      {
        if (!empty($row['cmp_name']))
        {
          if (!empty($row['subtype']))
            $rowx['text'] = $row['cmp_name'] . ' (' . $row['subtype'] . ')';
          else
            $rowx['text'] = $row['cmp_name'];
        }
      else
        $rowx['text']  = "Big Four";
      }
      else
      if ($dn01 == "PN")  /* 1948-1957 */
        $rowx['text']  = "Post 1948";
      else
      if ($dn01 == "PRT") /* 1957-1973 */
      {
        $rowx['text']  = "Pre TOPS";
        $rowx['number'] = fn_e_pfx($row['number']);
      }
      else
      if ($dn01 == "TOPS") /* BR Era */
        $rowx['text']  = "TOPS";
      else
      if ($dn01 == "DP") /* Departmental */
        $rowx['text']  = "Departmental";
      else
      if ($dn01 == "IND") /* Industrial */
        $rowx['text']  = "Industrial";
      else
      if ($dn01 == "OS") /* Overseas */
      $rowx['text']  = "Overseas (" . $row['company'] . ")";
      else
      $rowx['text']  = $row['cmp_name'];

      if (!empty($row['subtype']))
        $rowx['text'] .= " (" . $row['subtype'] . ")";

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

/***********************************************************************************************/
/*                                                                                             */
/* Stage 4: Get the names carried by this locomotive                                           */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT enm.*
          from   e_name enm 
          where  enm.loco_id = ' .$id. '
          order by enm.start_date ASC';
  
  $result = $db->execute($sql);

  if (($name_ct = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['start_date'] = fn_fdate($row['start_date']);
      $row['end_date']   = fn_fdate($row['end_date']);

      $table_names->add_data($row);
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 4c: Document the visits to works                                                      */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT wv.start_date,
                 wv.end_date,
                 wv.mileage,
                 wv.duration,
                 coalesce(vt.description, wv.visit_code) AS regime,
                 coalesce(bl.bl_short_name, bl.bl_name)  AS bl_name,
                 wv.summary
          FROM   works_visits wv
          JOIN   ref_builders bl
          ON     bl.bl_code = wv.bl_code
          LEFT JOIN ref_visit_type vt
          ON     vt.visit_code = wv.visit_code
          WHERE  wv.type = "E"
          AND    wv.loco_id = ' . $id . '
          ORDER BY ifnull(wv.start_date, wv.end_date) ASC';

  //echo $sql;

  $result = $db->execute($sql);

  if (($wv_count = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['start_date'] = fn_fdate($row['start_date']);
      $row['end_date'] = fn_fdate($row['end_date']);

      if (!empty($row['duration']))
      {
        if ($row['duration'] == 1)
          $row['duration'] .= " day";
        else
          $row['duration'] .= " days";
      }

      if (!empty($row['summary']))
        $row['regime'] .=  "<br />" . $row['summary'];
      $table_works->add_data($row);
    }
  }

  if ($result) if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 5: Get the modifications made to this locomotive                                      */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT em.*,
                 m.*
          FROM   e_mods em
          JOIN   ref_modifications m
          ON     m.modification = em.modification
          WHERE  em.loco_id = ' .$id. '
          ORDER BY em.date_modified ASC';

  $result = $db->execute($sql);

  if (($mods_count = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['date_modified'] = fn_fdate($row['date_modified']);
      
      if (!empty($row['total_cost']))
        $row['total_cost'] = fn_cost($row['total_cost']);
      if (!empty($row['cost_to_capital']))
        $row['cost_to_capital'] = fn_cost($row['cost_to_capital']);
      if (!empty($row['cost_to_revenue']))
        $row['cost_to_revenue'] = fn_cost($row['cost_to_revenue']);

      $table_mods->add_data($row);
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;
  
/***********************************************************************************************/
/*                                                                                             */
/* Stage 5b: Get the configuration of this locomotive                                          */
/*                                                                                             */
/***********************************************************************************************/

  $sql = 'SELECT ec.*
          FROM   e_config ec
          WHERE  ec.loco_id = ' .$id. '
          ORDER BY ec.config_date ASC';
          
  $result = $db->execute($sql);

  if (($config_count = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['config'] = '';
      
      $row['config_date'] = fn_fdate($row['config_date']);
      
      if (($desc = fn_determine_brakes($row['B'])) != "")
      {
        $desc .= " braked";
        $row['config'] .= $row['B'];
      }
        
      if (($heat = fn_determine_heating($row['H'])) != "")
      {
        if ($desc != "")
          $desc .= ", " . $heat;
        else
          $desc = $heat;
          
        $row['config'] .= $row['H'];
      }
      
      if (($other = fn_determine_other($row['O'])) != "")
      {
        if ($desc != "")
          $desc .= ", " . $other;
        else
          $desc = $other;
          
        $row['config'] .= $row['O'];
      }
        
      if (($extras = fn_determine_extras($row['extras'])) != "")
      {
        $row['additional'] = $extras;
      }
        
      $row['config_desc'] = $desc;

      $table_config->add_data($row);
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;
  
  
/***********************************************************************************************/
/*                                                                                             */
/* Stage 5c: Get the mileages accrued by this locomotive                                       */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT dm.*,
                 doos.*,
                 date_format(dm.m_date, "%Y") AS ym_date
          FROM   e_mileage dm
          LEFT JOIN e_wkd_oos doos
          ON     doos.loco_id = dm.loco_id
          AND    doos.oos_date = dm.m_date
          WHERE  dm.loco_id = ' .$id. '
          ORDER BY dm.m_date ASC';

  $result = $db->execute($sql);

  if (($mil_count = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['m_date'] = fn_fdate($row['ym_date']);
      $row['mileage'] = fn_ncomma($row['mileage']);
      $row['cumulative_mileage'] = fn_ncomma($row['cumulative_mileage']);
      $row['rr_cost'] = fn_cost($row['rr_cost'], 0);

      if (!empty($row['fuel_oil']))
      {
        $row['fuel_oil'] = fn_ncomma($row['fuel_oil']) . "g";
      }
      
      if (!empty($row['classified_total']))
        $row['classified_total'] = "<b>" . $row['classified_total'] . "</b>";

      if (!empty($row['grand_total']))
        $row['grand_total'] = "<b>" . $row['grand_total'] . "</b>";

      $table_mil->add_data($row);
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;


/***********************************************************************************************/
/*                                                                                             */
/* Stage 6: Get the allocations this locomotive undertook                                      */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT coalesce(dc.displayed_depot_code, ea.allocation) AS allocation,
                 ea.loan_allocation                           AS loan_allocation,
                 ea.allocation                                AS check_allocation,
                 ea.snap                                      AS snapshot,
                 d.depot_name,
                 ea.alloc_date,
                 ea.alloc_flag,
                 ea.alloc_date_prd                            AS period,
                 concat("sites.php?page=depots&action=query&id=", d.depot_id) AS allocation_hl,
                 concat("sites.php?page=depots&action=query&id=", d.depot_id) AS depot_name_hl,
                 ea.caveat,
                 ea.loco_usage,
                 d2.depot_name                                AS home_shed_name,
                 coalesce(dc2.displayed_depot_code, dc2.depot_code) AS home_shed_alloc
          from   ve_allocations ea
          LEFT JOIN ref_depot_codes dc
          ON     dc.depot_code = coalesce(ea.loan_allocation, ea.allocation)
          AND    dc.date_from  = (SELECT max(dca.date_from)
                                  FROM   ref_depot_codes dca
                                  WHERE  dca.depot_code = coalesce(ea.loan_allocation, ea.allocation)
                                  AND    dca.date_from <= ea.alloc_date)
          LEFT JOIN ref_depot d
          ON     d.depot_id = dc.depot_id

          LEFT JOIN ref_depot_codes dc2
          ON     dc2.depot_code = substr(ea.allocation, 1, instr(ea.allocation, ".") -1)
          AND    dc2.date_from  = (SELECT max(dcb.date_from)
                                  FROM   ref_depot_codes dcb
                                  WHERE  dcb.depot_code = substr(ea.allocation, 1, instr(ea.allocation, ".") -1)
                                  AND    dcb.date_from <= ea.alloc_date)
          LEFT JOIN ref_depot d2
          ON     d2.depot_id = dc2.depot_id

          WHERE  ea.loco_id = ' .$id. '
          ORDER BY ea.alloc_date ASC, ea.seq ASC';

  $result = $db->execute($sql);

  if ($result)
  {
  if (($alloc_ct = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['period'] = fn_prd($row['period']);

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

      if ($row['snapshot'] == "Y")
        $row['alloc_date'] .= " (Snapshot)";

      $table_allocs->add_data($row);
	}
  }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 7: Get any incidents associated with this locomotive                                  */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT es.*,
                 es.ig_id                                                           AS lnk,
                 concat("timelines.php?page=workings&subpage=groups&id=", es.ig_id) AS lnk_hl
          FROM   e_summary es
          WHERE  es.loco_id = ' . $id .'
          ORDER BY es.event_date, es.details';
                           
  $result = $db->execute($sql);

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

  if ($result) mysqli_free_result($result);
  $row = NULL;

/********************************************************************************************/
/*                                                                                          */
/* Stage 8: Get details of previous and next locos (if they exist)                          */
/*                                                                                          */
/********************************************************************************************/

  $sql = 'SELECT en.number        AS number,
                 en.number_type   AS number_type,
                 F.mx             AS loco_id
          FROM   e_nums en
          JOIN (SELECT max(ecl_p.loco_id) AS mx
                FROM   e_class_link ecl_p
                JOIN   e_class_link ecl_c
                ON     ecl_p.e_class_id = ecl_c.e_class_id
                WHERE  ecl_c.loco_id = ' . $id . '
                AND    ecl_p.loco_id < ecl_c.loco_id) AS F
          ON    F.mx = en.loco_id
          JOIN  electric e
          ON    e.loco_id = F.mx
          AND   e.b_date = en.start_date';

  $result = $db->execute($sql);
          
  if ($db->count_select())
  {
    $row = mysqli_fetch_assoc($result);

    $b_prev = true;
    $prev_id  = $row['loco_id'];
    $prev_num = $row['number_type'] == 'PRT' ? fn_e_pfx($row['number']) : $row['number'];
  }
  else
    $b_prev = false;
          
  $sql = 'SELECT en.number        AS number,
                 en.number_type   AS number_type,
                 F.mn             AS loco_id
          FROM   e_nums en
          JOIN (SELECT min(ecl_p.loco_id) AS mn
                FROM   e_class_link ecl_p
                JOIN   e_class_link ecl_c
                ON     ecl_p.e_class_id = ecl_c.e_class_id
                WHERE  ecl_c.loco_id = ' . $id . '
                AND    ecl_p.loco_id > ecl_c.loco_id) AS F
          ON    F.mn = en.loco_id
          JOIN  electric e
          ON    e.loco_id = F.mn
          AND   e.b_date = en.start_date';

  $result = $db->execute($sql);
          
  if ($db->count_select())
  {
    $row = mysqli_fetch_assoc($result);

    $b_next = true;
    $next_id  = $row['loco_id'];
    $next_num = $row['number_type'] == 'PRT' ? fn_e_pfx($row['number']) : $row['number'];
  }
  else
    $b_next = false;
          
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
                 e2l.caveat
          FROM   log_details ld
          JOIN   e_to_log e2l
          ON     e2l.log_dtl_id = ld.ld_id
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
          WHERE  e2l.loco_id = ' . $id . '
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
/* Stage 99: Display the tables with HTML                                                   */
/*                                                                                             */
/***********************************************************************************************/
        
  if ($b_prev)
  {
    printf("<a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=E&amp;loco=%s\">", 
           $prev_id, $prev_num);
      printf("<img src=\"img/prev.gif\" alt=\"prev\" id=\"img_prev\" />\n");
    printf("</a>\n");
  }

  if ($b_next)
  {
    printf("<a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=E&amp;loco=%s\">", 
           $next_id, $next_num);
      printf("<img src=\"img/next.gif\" alt=\"prev\" id=\"img_next\" />\n");
    printf("</a>\n");
  }

/* HTML table definition */
printf("<!-- Start of main table  -->\n");
  printf("<table width=\"99%%\" frame=\"box\">\n");
    printf("<tr valign=\"top\">\n");
      printf("<td width=\"49%%\">\n");

        // numbers always present
        $table_numbers->draw_table();
        printf("<br />\n");

        // names optional
        if ($name_ct > 0)
        {
          $table_names->draw_table();
          printf("<br />\n");
        }

        // liveries optional
        if ($livery_count > 0)
        {
          $table_liveries->draw_table();
          printf("<br />\n");
        }

        // always present
        $table_specifics->draw_table();
        printf("<br />\n");

      printf("</td>\n");
      printf("<td width=\"49%%\" valign=\"top\">\n");

      // always present - but not until database is complete
      $table_allocs->draw_table();
      printf("<br />\n");

      if ($mods_count > 0)
      {
        $table_mods->draw_table();
        printf("<br />\n");
      }
      
      if ($config_count > 0)
      {
        $table_config->draw_table();
        printf("<br />\n");
      }

      // components optional
      if ($component_count > 0)
      {
        $table_components->draw_table();
        printf("<br />\n");
      }

      // preservation optional
      if ($preservation_count > 0)
      {
        $table_pres->draw_table();
        printf("<br />\n");
      }

      if ($notes > 0)
      {
        $table_notes->draw_table();
        printf("<br />\n");
      }

      printf("</td>\n");
    printf("</tr>\n");
  printf("</table>\n");
  printf("<!-- End of main table -->\n");

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

  if ($mil_count > 0)
  {
    $table_mil->draw_table();
    printf("<br />\n");
  }

  //  always present, even if empty
  $table_summary->draw_table();

  printf("<br />\n");
  if ($b_prev)
  {
    printf("<a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=E&amp;loco=%s\">", 
           $prev_id, $prev_num);
      printf("<img src=\"img/prev.gif\" alt=\"prev\" id=\"img_prev\" />\n");
    printf("</a>\n");
  }

  if ($b_next)
  {
    printf("<a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=E&amp;loco=%s\">", 
           $next_id, $next_num);
      printf("<img src=\"img/next.gif\" alt=\"prev\" id=\"img_next\" />\n");
    printf("</a>\n");
  }

 //<a href="www.hyperlinkcode.com"><img src="/images/sample-image.gif" border="0"></a> 
 // printf("<img src=\"img/prev.gif\" alt=\"prev\" id=\"img_prev\" />\n");
 // printf("<img src=\"img/next.gif\" alt=\"next\" id=\"img_next\" />\n");

  printf("<br />\n");
?>
