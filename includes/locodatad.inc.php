<?php
  include_once("lib/brlib.php");
                
/***********************************************************************************************/
/*                                                                                             */
/* Stage 0: Preliminaries - set up specifics table                                             */
/*                                                                                             */
/***********************************************************************************************/

  include_once "lib/MyTables.class.php";

  $table_specifics = new MyTables("loco_table");

  $table_specifics->add_caption("Locomotive Specifics");
  $table_specifics->suppress_nulls();
//$table_specifics->add_row("designer",          "Designer");
  $table_specifics->add_row("identifier",        "Class as Built");
  $table_specifics->add_row("subclass",          "Subclass/Rebuild History");
  $table_specifics->add_row("wheel_arrangement", "Wheels");
  $table_specifics->add_row("bl_name",           "Builder");
  $table_specifics->add_row("order_number",      "Order Number");
  $table_specifics->add_row("works_number",      "Works Number");
  $table_specifics->add_row("fittings",          "Fittings (as built)");
  $table_specifics->add_row("cost",              "Cost when Built");
  $table_specifics->add_row("to_service",        "To Service");

  $table_specifics->add_row("withdrawal",        "Withdrawn");
  $table_specifics->add_row("depot_when_wdn",    "Withdrawn From");

  $table_specifics->add_row("dis",               "Time in Service");
  $table_specifics->add_row("mileage",           "Total Mileage");
  $table_specifics->add_row("s_date",            "Cut Up");
  $table_specifics->add_row("sc_name_place",     "Cut At");
  $table_specifics->add_row("v_info",            "Video Clip");
  $table_specifics->add_row("d_info",            "Information");
  $table_specifics->add_row("status",            "Status");
  $table_specifics->add_row_lwidth(35); /* percentage of width of table for first column */
  $table_specifics->set_align("V");

  $table_notes = new MyTables("loco_notes");
  $table_notes->suppress_nulls();
  $table_notes->add_row_lwidth(15); /* percentage of width of table for first column */
  $table_notes->set_align("V");
  $table_notes->add_caption("Notes");
  $table_notes->add_row("info",                  "Notes");
  
  $table_numbers = new MyTables("loco_nums");
  $table_numbers->add_caption("Numbers Carried");
  $table_numbers->add_column("text",             "Type",      35);
  $table_numbers->add_column("number",           "Number",    20);
  $table_numbers->add_column("sdate",            "Date From", 20);
  $table_numbers->add_column("notes",            "Notes",     25);

  $table_liveries = new MyTables("loco_liveries");
  $table_liveries->add_caption("Liveries Carried - WIP");
  $table_liveries->add_column("code",            "Code",      8);
  $table_liveries->add_column("colour",          "Colour",    52);
  $table_liveries->add_column("start_date",      "Date From", 40);

  $table_pres = new MyTables("loco_preservation");
  $table_pres->suppress_nulls();
  $table_pres->add_row_lwidth(35); /* percentage of width of table for first column */
  $table_pres->set_align("V");
  $table_pres->add_caption("Preservation");
  $table_pres->add_row("date_preserved","Preservation Date");
  $table_pres->add_row("status",        "Current Status");
  $table_pres->add_row("status_date",   "Status Date");
  $table_pres->add_row("info",          "Information");
  $table_pres->add_row("weblink",       "Link");

  $table_names = new MyTables("loco_names");
  $table_names->add_caption("Names Carried");
  $table_names->add_column("name",       "Name",      35);
  $table_names->add_column("start_date", "Date From", 65);
//  $table_names->add_row_lwidth(35); /* percentage of width of table for first column */   
//  $table_names->set_align("V");

  $table_mods = new MyTables("loco_mods");
  $table_mods->add_caption("Modifications - WIP");
  $table_mods->add_column("date_modified",   "Date Modified", 11);
  $table_mods->add_column("order_number",    "Order Number",  15);
  $table_mods->add_column("description",     "Modification",  32);
  $table_mods->add_column("status",          "Status",        12);
  $table_mods->add_column("cost_to_capital", "Charged to Capital",       10);
  $table_mods->add_column("cost_to_revenue", "Charged to Revenue",       10);
  $table_mods->add_column("total_cost",      "Total Cost",    10);

  $table_config = new MyTables("loco_config");
  $table_config->add_caption("Configuration - WIP");
  $table_config->add_column("config_date",     "Date",               11);
  $table_config->add_column("config",          "Configuration",      15, FALSE, FALSE, TRUE);
  $table_config->add_column("config_desc",     "Description",        32);
  $table_config->add_column("additional",      "Additional",         22);
  $table_config->add_column("diagram",         "Diagram",            10);
  $table_config->add_column("source",          "Source",             10);
  
  $table_allocs = new MyTables("allocations");
  $table_allocs->add_caption("Allocations - WIP");
  $table_allocs->add_column("allocation", "Code",     11);
  $table_allocs->add_column("subsequent", "Subsequent Codes", 15);
  $table_allocs->add_column("depot_name", "Name",     32);
  $table_allocs->add_column("period",     "",          7);
  $table_allocs->add_column("alloc_date", "From Date",35); 

  $table_sls = new MyTables("sls_allocations");
  $table_sls->add_caption("SLS Allocations*");
  $table_sls->add_column("act",         "Type",        8);
  $table_sls->add_column("alloc",       "Code",        8);
  $table_sls->add_column("depot_name",  "Name",       42);
  $table_sls->add_column("inc_prd",     "",           14);
  $table_sls->add_column("inc_date",    "From Date",  28); 
    
  $table_components = new MyTables("components");
  $table_components->add_caption("Components");
  $table_components->sortable();
  $table_components->add_column("start_date",        "Fitted",         11);
  $table_components->add_column("component_details", "Component",      23);
  $table_components->add_column("details",           "Details",        20);
  $table_components->add_column("end_date",          "Removed",        11);
  $table_components->add_column("removal_reason",    "Reason Removed", 35);

  $table_works = new MyTables("works_visits");
  $table_works->add_caption("Works Visits");
  $table_works->add_column("bl_name",         "Where Repaired",          9);
  $table_works->add_column("stopped_date",    "Date Stopped",   9);
  $table_works->add_column("days_since_last", "Days Since Last Stopped", 4);
  $table_works->add_column("start_date",      "Works Entry",    9);
  $table_works->add_column("end_date",        "Departure",      9);
  $table_works->add_column("regime",          "Class of Repair",  9);
  $table_works->add_column("on_decision",     "Waiting Repair Decision",        7);
  $table_works->add_column("waiting",         "Waiting Works",   7);
  $table_works->add_column("on_works",        "On Works",        7);
  $table_works->add_column("duration",        "Total Duration",  7);
  $table_works->add_column("cost",            "Cost of Repair",            7);
  $table_works->add_column("mileage",         "Mileage",         4);
  $table_works->add_column("notes",           "Notes",           12);

  $table_inc = new MyTables("incidents");
  $table_inc->add_caption("Significant Events");
  $table_inc->add_column("event_date", "Date",               15);
  $table_inc->add_column("event_type", "Event type",         25);
  $table_inc->add_column("event_type", "Event type",         25);
  $table_inc->add_column("event_type", "Event type",         25);
  
  $table_fire = new MyTables("Fires");
  $table_fire->add_caption("Fires");
  $table_fire->add_column("fire_date",    "Date of Fire",    11);
  $table_fire->add_column("extent",       "Severity",        9);
  $table_fire->add_column("damage",       "Damage",          17);
  $table_fire->add_column("source",       "Source of Fire",  17);
  $table_fire->add_column("material",     "Material",        17);
  $table_fire->add_column("details",      "Details",         17);
  $table_fire->add_column("location",     "Location",        12);

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

  $table_log = new MyTables("log_details");
  $table_log->add_caption("Sightings", NULL);
  $table_log->add_column("ld_date",              "Report Date", 10);
  $table_log->add_column("lh_main_title",        "Title",       20);
  $table_log->add_column("location",             "Location",    10);
  $table_log->add_column("ld_details",           "Report",      32);
  $table_log->add_column("headcode",             "Headcode",     8);
  $table_log->add_column("reference",            "Reference",   20);
  
  if ($update)
    $caption_hl = sprintf("upd_steam.php?page=upd_loco_inc&id=%s", $id);

  $table_summary = new MyTables("summary");
  $table_summary->add_caption("Summary");
  $table_summary->add_column("event_date",  "Start",      8);
#  $table_summary->add_column("event_edate", "End",        8);
  $table_summary->add_column("event_type",  "Event",     12);
  $table_summary->add_column("details",     "Details",   52);
  $table_summary->add_column("source",      "Source",    16);
  $table_summary->add_column("lnk",         "See Also",   4);


/***********************************************************************************************/
/*                                                                                             */
/* Stage 1: Get the class variations for this locomotive                                       */
/*                                                                                             */
/***********************************************************************************************/

  $sql = 'SELECT dc.identifier     AS identifier_main,
                 dcv.identifier,
                 dcv.d_class_id,
                 dcv.d_class_var_id,
                 dcl.start_date    AS start_date
          FROM   d_class_link dcl
          JOIN   d_class_var  dcv    
          ON     dcv.d_class_id = dcl.d_class_id
          AND    dcv.d_class_var_id = dcl.d_class_var_id
          JOIN   d_class dc
          ON     dc.d_class_id = dcv.d_class_id
          WHERE  dcl.loco_id = ' . $id . '
          ORDER BY start_date';

//echo $sql;

  $result = $db->execute($sql);

  /* Build a mini table of variations - only displayed if more than one variation exists*/
  $ct = $last_class_id = $last_class_var_id = 0;

  if ($db->count_select())
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      if ($last_class_id == 0)
      {
        $class_id = $row['d_class_id'];  // for next/prev button processing

        $rw = "<table width=\"100%\" frame=\"box\"><tr><td width=\"40%\"><strong>Class</strong></td><td width=\"60%\"><strong>From</strong></td></tr>";
        $rw .= "<tr><td><a href=\"locoqry.php?action=class&amp;type=D&amp;id=" . $row['d_class_id']
              . "\">" . $row['identifier']
              .     "</a></td><td>"  . fn_fdate($row['start_date'])
              .     "</td></tr>";
      }
      else
      {
        if (($row['d_class_id']     != $last_class_id) ||
            ($row['d_class_var_id'] != $last_class_var_id))
        {
          $rw .= "<tr><td><a href=\"locoqry.php?action=class&amp;type=D&amp;id=" . $row['d_class_id']
                . "\">" . $row['identifier']
                .     "</a></td><td>"  . fn_fdate($row['start_date'])
                .     "</td></tr>";
        }
      }

      $ct++;

      $last_class_id = $row['d_class_id'];
      $last_class_var_id = $row['d_class_var_id'];
    }

    if ($ct > 0)
      $rw = $rw . "</table>";
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 2: Get the detailed info specific to this locomotive                                  */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT d.*,
                 d.info                                                      AS d_info,
                 CASE WHEN d.works_num_b IS NOT NULL THEN
                   concat(d.works_num, "/", d.works_num_b)
                 ELSE
                   d.works_num
                 END                                                         AS works_number,
                 dcl.d_class_id,
                 concat(sm.merchant_name, " (", sy.location, ")")            AS sc_name_place,
                 bl.bl_name,
                 concat("misc.php?page=wheel_arr&amp;id=", dc.wheel_arrangement) 
                                                                             AS wheel_arrangement_hl,
                 concat("sites.php?page=builders&amp;id=", bl.bl_code)       AS bl_name_hl,
                 concat("sites.php?page=scrapyards&amp;id=", sy.scrapyard_code)  
                                                                             AS sc_name_place_hl,
                 dc.identifier,
                 concat("locoqry.php?action=class&amp;type=D&amp;id=",dc.d_class_id) 
                                                                             AS identifier_hl,
                 dc.wheel_arrangement,
                 NULL AS dis,
                 d.info as d_info,
                 NULL AS subclass,
                 o.order_number,
                 o.virtual_ind,
                 concat("sites.php?page=builders&amp;subpage=orders&amp;id=", o.bl_code, "&amp;lot=",
                         o.order_number, "&amp;oid=", o.order_id)            AS order_number_hl,
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
                                                                           
                 dp_bl.depot_name                                          AS depot_name_bl,
                 coalesce(dc_bl.displayed_depot_code, dc_bl.depot_code)    AS depot_code_bl,
                 concat("sites.php?page=depots&action=query&id=", dp_bl.depot_id) 
                                                                           AS depot_loan_when_new_hl,
                                                                           
                 m1.description                                            AS train_brakes,
                 concat(mA.name, " ", mcA.mct_name)                        AS boiler_type,
                 df.eth_rating,
                 m2.description                                            AS aws,
                 df.multiple,
                 df.misc                                                   AS misc_details
                 
          from   diesels d

          join   d_class_link dcl
          on     dcl.loco_id = d.loco_id

          join   d_class dc
          on     dc.d_class_id = dcl.d_class_id

          left join d_fittings df
          on     df.loco_id = d.loco_id

          left join ref_modifications m1
          on     df.train_brakes = m1.modification

          LEFT JOIN ref_misc_components mcA
          ON     mcA.mct_id = df.heating_boiler_id
          LEFT JOIN ref_manufacturer mA
          ON     mA.manufacturer_id = mcA.manufacturer_id

          left join ref_modifications m2
          on     df.aws = m2.modification

          left join ref_builders bl
          on     bl.bl_code = d.bl_code

          left join ref_scrapyard sy
          on     sy.scrapyard_code = d.scrapyard_code

          left join ref_scrap_merchant sm
          on     sm.merchant_code = substr(sy.scrapyard_code, 1, 3)

          left join ref_orders o
          on     o.order_id = d.order_id

          left join videos v
          on     v.type = "D"
          and    v.loco_id = d.loco_id

          left join ref_depot_codes dc_w
          on     dc_w.depot_code = d.last_depot
          and    dc_w.date_from = (select max(dc_w1.date_from)
                                   from   ref_depot_codes dc_w1
                                   where  dc_w1.depot_code = d.last_depot
                                   and    dc_w1.date_from <= d.w_date)

          left join ref_depot dp_w
          on     dp_w.depot_id = dc_w.depot_id

          left join ref_depot_codes dc_b
          on     dc_b.depot_code = d.first_depot
          and    dc_b.date_from = (select max(dc_b1.date_from)
                                   from   ref_depot_codes dc_b1
                                   where  dc_b1.depot_code = d.first_depot
                                   and    dc_b1.date_from <= d.b_date)

          left join ref_depot dp_b
          on     dp_b.depot_id = dc_b.depot_id

          left join ref_depot_codes dc_bl
          on     dc_bl.depot_code = d.first_depot_loan
          and    dc_bl.date_from = (select max(dc_bl1.date_from)
                                    from   ref_depot_codes dc_bl1
                                    where  dc_bl1.depot_code = d.first_depot_loan
                                    and    dc_bl1.date_from <= d.b_date)

          left join ref_depot dp_bl
          on     dp_bl.depot_id = dc_bl.depot_id

          where  d.loco_id = ' .$id;

  $result = $db->execute($sql);
  //echo $sql;

  if ($db->count_select())
  {
    $row = mysqli_fetch_assoc($result);

// Don't loop - just take the info from the first record - needs revising!!!

//    $b_date = fn_fdate($row['b_date']);

    if (!empty($row['depot_name']))
      $row['depot_when_wdn'] = $row['depot_name'] . " (" . $row['depot_code'] . ")";

    $dt = new date_span();

    if (!empty($row['w_date']) && !empty($row['b_date']))
      $dis_val = $dt->calculate_span($row['b_date'], $row['w_date']);

    $row['dis'] = $dis_val;

#    if ($ct > 1)
      $row['subclass'] = $rw;

    if (!empty($row['depot_name_w']))
    {
      if (!empty($row['w_date']))
        $row['withdrawal'] = fn_fdate($row['w_date']);

      $row['withdrawal'] .= " off <a href=\"" . $row['depot_when_wdn_hl']
                          . "\">" . $row['depot_name_w'] . " (" . $row['depot_code_w'] . ")";
    }
    else
    if (!empty($row['w_date']))
      $row['withdrawal'] = fn_fdate($row['w_date']);

    if (!empty($row['b_date']))
      $row['to_service'] = fn_fdate($row['b_date']);

    if (!empty($row['depot_name_b']))
    {
      $row['to_service'] .= " to <a href=\"" . $row['depot_when_new_hl']
                          . "\">" . $row['depot_name_b'] . " (" . $row['depot_code_b'] . ")</a>";
                          
      if (!empty($row['depot_name_bl']))
      {
        $row['to_service'] .= " (on loan to <a href=\"" . $row['depot_loan_when_new_hl']
                          . "\">" . $row['depot_name_bl'] . " (" . $row['depot_code_bl'] . "))</a>";
      }
    }

    $b_date = $row['b_date'];
  
    $row['status'] = fn_get_status($row['b_date'],
                                   $row['w_date'],
                                   $row['scrapyard_code'],
                                   $row['preserved']);


    $row['b_date'] = fn_fdate($row['b_date']);
    $row['w_date'] = fn_fdate($row['w_date']);
    $row['s_date'] = fn_fdate($row['s_date']);
    $row['mileage'] = fn_ncomma($row['mileage'], " miles");
    $row['cost'] = fn_cost($row['cost']);

    if ((!empty($row['train_brakes'])))
    {
      $details = "<table width=\"100%\" frame=\"box\">";
  
      if (!empty($row['train_brakes']))
      {
        $details .= "<tr><td width=\"30%\"><strong>Train Brakes</strong></td>";
        $details .= "    <td width=\"70%\">" . $row['train_brakes'] . "</td></tr>";
      }

      if (!empty($row['boiler_type']))
      {
        $details .= "<tr><td width=\"30%\"><strong>Steam Boiler</strong></td>";
        $details .= "    <td width=\"70%\">" . $row['boiler_type'] . "</td></tr>";
      }

      if (!empty($row['eth_rating']))
      {
        $details .= "<tr><td width=\"30%\"><strong>eth Fitted</strong></td>";
        $details .= "    <td width=\"70%\"> Rating (" . $row['eth_rating'] . ")</td></tr>";
      }

      if (!empty($row['aws']))
      {
        $details .= "<tr><td width=\"30%\"><strong>AWS</strong></td>";
        $details .= "    <td width=\"70%\">" . $row['aws'] . "</td></tr>";
      }

      if (!empty($row['multiple']))
      {
        $details .= "<tr><td width=\"30%\"><strong>Multiple Fitting</strong></td>";
        $details .= "    <td width=\"70%\">" . $row['multiple'] . "</td></tr>";
      }

      if (!empty($row['misc_details']))
      {
        $details .= "<tr><td width=\"30%\"><strong>Other Details</strong></td>";
        $details .= "    <td width=\"70%\">" . $row['misc_details'] . "</td></tr>";
      }

      $details .= "</table>";
      
      $row['fittings'] = $details;
    }
    
    $table_specifics->add_data($row);
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 3: Get the numbers carried by this locomotive                                         */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT *
          from   d_nums dn
          where  dn.loco_id = ' .$id. '
          order by dn.start_date';
  
  $result = $db->execute($sql);
        
  if ($db->count_select())
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $rowx['notes'] = $row['notes'];
      $dn01 = $row['number_type'];

      if ($row['carried_number'] == "N")
      {
        $rowx['number'] = "<i>" . $row['number'] . "</i>";
        $rowx['sdate'] = "";
        $msg = "";
      }
      else
      {
        $rowx['sdate'] = fn_fdate($row['start_date']);
        $rowx['number'] = $row['number'];
        $msg = "Number: " . $row['number'];
      }

      if ($sn01 == "BIG4") /* 1923-1948 */
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
        $rowx['number'] = fn_d_pfx($row['number']);
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

      $table_numbers->add_data($rowx);
	}
  }

/***********************************************************************************************/
/*                                                                                             */
/* Stage 4: Get the names carried by this locomotive                                           */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT dnm.*,
                 concat("names.php?id=", dnm.d_name_id, "&amp;type=D") AS name_hl
          FROM   d_name dnm 
          WHERE  dnm.loco_id = ' .$id. '
      ORDER BY dnm.start_date ASC';
  
  $result = $db->execute($sql);
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

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 4c: Document the visits to works                                                      */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT wv.stopped_date,
                 wv.start_date,
                 wv.end_date,
                 wv.mileage,
                 wv.duration,
                 coalesce(vt.description, wv.visit_code) AS regime,
                 coalesce(bl.bl_short_name, bl.bl_name)  AS bl_name,
                 dp.depot_name,
                 wv.summary,
                 wv.cost,
                 wv.notes,
                 wv.mileage,
                 wv.on_decision,
                 wv.waiting,
                 wv.on_works
          FROM   works_visits wv
          JOIN   ref_builders bl
          ON     bl.bl_code = wv.bl_code
          LEFT JOIN ref_visit_type vt
          ON     vt.visit_code = wv.visit_code
          LEFT JOIN ref_depot dp
          ON     wv.depot_id = dp.depot_id
          WHERE  wv.type = "D"
          AND    wv.loco_id = ' . $id . '
          ORDER BY ifnull(wv.start_date, wv.end_date) ASC';

  //echo $sql;

  $result = $db->execute($sql);

  if (($wv_count = $db->count_select()) > 0)
  {
    $loop = 0; $last_date = NULL;
    
    while ($row = mysqli_fetch_assoc($result))
    {
      if ($loop++ && !empty($row['stopped_date']) && !empty($last_date))
      {
        $date1 = new DateTime($last_date);
        $date2 = new DateTime($row['stopped_date']);
        $interval = $date1->diff($date2);
        $row['days_since_last'] = $interval->days;
      }
      else
        $row['days_since_last'] = 'n/a';
      
      $last_date = $row['end_date'];

      $row['stopped_date'] = fn_fdate($row['stopped_date']);
      $row['start_date'] = fn_fdate($row['start_date']);
      $row['end_date'] = fn_fdate($row['end_date']);
      $row['mileage'] = fn_ncomma($row['mileage']);
      
      if (!empty($row['cost']))
      {
        $row['cost'] = fn_cost($row['cost']);
      }

      if ($row['days_since_last'] != "n/a")
      {
        if ($row['days_since_last'] == 1)
          $row['days_since_last'] .= " day";
        else
          $row['days_since_last'] .= " days";
      }

      if (!empty($row['duration']))
      {
        if ($row['duration'] == 1)
          $row['duration'] .= " day";
        else
          $row['duration'] .= " days";
      }

      if (!empty($row['on_works']))
      {
        if ($row['on_works'] == 1)
          $row['on_works'] .= " day";
        else
          $row['on_works'] .= " days";
      }
      
      if (!empty($row['waiting']))
      {
        if ($row['waiting'] == 1)
          $row['waiting'] .= " day";
        else
          $row['waiting'] .= " days";
      }
      
      if (!empty($row['on_decision']))
      {
        if ($row['on_decision'] == 1)
          $row['on_decision'] .= " day";
        else
          $row['on_decision'] .= " days";
      }

      if (!empty($row['summary']))
        $row['regime'] .=  "<br />" . $row['summary'];
        
      if (empty($row['bl_name']) && !empty($row['depot_name']))
        $row['bl_name'] = $row['depot_name'];
        
      $table_works->add_data($row);
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 5: Get the ref_modifications made to this locomotive                                      */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT dm.*,
                 m.*
          FROM   d_mods dm
          JOIN   ref_modifications m
          ON     m.modification = dm.modification
          WHERE  dm.loco_id = ' .$id. '
          AND    dm.as_built = "N" 
          ORDER BY dm.date_modified ASC';

  $result = $db->execute($sql);

  if (($mods_count = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['date_modified'] = fn_fdate($row['date_modified']);
      
      if ($row['date_modified_prd'] == "Y")
        $row['date_modified'] = "by " . $row['date_modified'];
      
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
/* Stage 5a: Get the configuration of this locomotive                                          */
/*                                                                                             */
/***********************************************************************************************/

  $sql = 'SELECT dc.*
          FROM   d_config dc
          WHERE  dc.loco_id = ' .$id. '
          ORDER BY dc.config_date ASC';
          
  $result = $db->execute($sql);

  if (($config_count = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['config'] = '';
      
      $row['config_date'] = fn_fdate($row['config_date']);
      
      if ($row['config_date_prd'] == "Y")
        $row['config_date'] = "by " . $row['config_date'];
        
      if (($desc = fn_determine_brakes($row['B'])) != "")
      {
        $desc .= " brakes";
        
        if ($row['B'] != 'n')
          $row['config'] .= $row['B'];
      }
        
      if (($heat = fn_determine_heating($row['H'])) != "")
      {
        if ($desc != "")
          $desc .= ", " . $heat;
        else
          $desc = $heat;
        
        if ($row['H'] != 'n')
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
/* Stage 5b: Get the mileages accrued by this locomotive                                       */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT dm.*,
                 doos.*,
                 date_format(dm.m_date, "%Y") AS ym_date,
                 round(dm.fuel_consumption, 2) AS fuel_consumption
          FROM   d_mileage dm
          LEFT JOIN d_wkd_oos doos
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
/* Stage 5c: Get the events (fires, accidents) for this locomotive                             */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT df.fire_date,
                 df.fire_date_prd,
                 CASE 
                 WHEN df.extent = "S" THEN
                   "Severe"
                 WHEN df.extent = "N" THEN
                   "Not severe"
                 ELSE
                   "Unknown"
                 END                           AS extent,
                 rf1.details                   AS source,
                 rf2.details                   AS material,
                 df.location,
                 df.damage,
                 df.details
          FROM   d_fires df
          JOIN   ref_fire_types rf1
          ON     rf1.type = "D"
          AND    rf1.source = df.source
          JOIN   ref_fire_types rf2
          ON     rf2.type = "D"
          AND    rf2.material = df.material
          WHERE  df.loco_id = ' .$id. '
          ORDER BY df.fire_date ASC';

  $result = $db->execute($sql);

  if (($fire_count = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['fire_date'] = fn_fdate($row['fire_date']);

      $table_fire->add_data($row);
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 6: Get the allocations this locomotive undertook                                      */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT coalesce(dc.displayed_depot_code, da.allocation) AS allocation,
                 da.loan_allocation                           AS loan_allocation,
                 da.allocation                                AS check_allocation,
                 da.snap                                      AS snapshot,
                 d.depot_name,
                 da.alloc_date,
                 da.alloc_flag,
                 da.alloc_date_prd                                            AS period,
                 concat("sites.php?page=depots&action=query&id=", d.depot_id) AS allocation_hl,
                 concat("sites.php?page=depots&action=query&id=", d.depot_id) AS depot_name_hl,
                 da.caveat,
                 da.loco_usage,
                 d2.depot_name                                AS home_shed_name,
                 coalesce(dc2.displayed_depot_code, dc2.depot_code) AS home_shed_alloc
          from   vd_allocations da
          LEFT JOIN ref_depot_codes dc
          ON     dc.depot_code = coalesce(da.loan_allocation, da.allocation)
          AND    dc.date_from  = (SELECT max(dca.date_from)
                                  FROM   ref_depot_codes dca
                                  WHERE  dca.depot_code = coalesce(da.loan_allocation, da.allocation)
                                  AND    dca.date_from <= CASE WHEN date_format(da.alloc_date, "%d") = 0 THEN
                                                                    last_day(da.alloc_date)
                                                          ELSE
                                                                    da.alloc_date
                                                          END)
          LEFT JOIN ref_depot d
          ON     d.depot_id = dc.depot_id

          LEFT JOIN ref_depot_codes dc2
          ON     dc2.depot_code = substr(da.allocation, 1, instr(da.allocation, ".") -1)
          AND    dc2.date_from  = (SELECT max(dcb.date_from)
                                  FROM   ref_depot_codes dcb
                                  WHERE  dcb.depot_code = substr(da.allocation, 1, instr(da.allocation, ".") -1)
                                  AND    dcb.date_from <= CASE WHEN date_format(da.alloc_date, "%d") = 0 THEN
                                                                    last_day(da.alloc_date)
                                                          ELSE
                                                                    da.alloc_date
                                                          END)
          LEFT JOIN ref_depot d2
          ON     d2.depot_id = dc2.depot_id

          WHERE  da.loco_id = ' .$id. '
          ORDER BY da.alloc_date ASC, da.seq ASC';
          
          // echo $sql;

  $result = $db->execute($sql);

  if ($result)
  {
  if (($alloc_ct = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['period'] = fn_prd($row['period']);

      #if (!strncmp($row['check_allocation'], "98S", 3))
      #  $row['allocation'] = '98S';
        
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
          from   brdataba_stage.allocation_history_d stg
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
/* Stage 7: Get any incidents associated with this locomotive                                  */
/*                                                                                             */
/***********************************************************************************************/
/*       
  $sql = 'select i.reporting_number  report_number,
                 i.details           details,
                 i.sdate_of_incident start_date,
                 i.edate_of_incident end_date,
                 i.sdate_approx      sdate_flag,
                 i.reference         reference,
                 ig.ig_id            incident_group_id,
                 NULL            AS  incgroup,
                 concat("timelines.php?page=workings&amp;subpage=groups&amp;id=", ig.ig_id) 
                                                                                  AS incgroup_hl
          from   d_to_i dtoi
          inner join incidents i
          on     dtoi.inc_id = i.inc_id
          left join  incident_groups ig
          on     i.ig_id = ig.ig_id
          where dtoi.loco_id = ' .$id. '
          order by start_date asc';
         
  $result = $db->execute($sql);
  
  while ($row = mysqli_fetch_assoc($result))
  {
    if (!empty($row['incident_group_id']))
      $lk = sprintf("<a href=timelines.php?page=workings&amp;subpage=groups&amp;id=%s>Link</a>",
                    $row['incident_group_id']);
    else
      $lk = "";
  }

  mysqli_free_result($result);
  $row = NULL;
*/
/***********************************************************************************************/
/*                                                                                             */
/* Stage 8: Get the liveries applied to this locomotive                                        */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT coalesce(l.description, l.base_colour) AS colour,
                 l.company,
                 l.code,
                 dl.start_date,
                 dl.start_date_prd
          FROM   d_to_livery dl
          JOIN   ref_livery l
          ON     l.livery_id = dl.livery_id
          WHERE  dl.loco_id = ' .$id. '
          ORDER BY dl.start_date ASC';

  $result = $db->execute($sql);

  if (($livery_count = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['start_date'] = fn_fdate($row['start_date']);
      
      if ($row['start_date_prd'] == "Y")
        $row['start_date'] = "by " . $row['start_date'];

      $table_liveries->add_data($row);
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
                 concat("\"javascript:void(0)\" onclick=\"window.open(\'https://", p.weblink, "\')\"") 
                           as weblink_hl 
          FROM   preservation p
          WHERE  p.loco_id = ' . $id . '
          AND    p.type = "D"';
                           
  $result = $db->execute($sql);

  if (($preservation_count = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['date_preserved'] = fn_fdate($row['date_preserved']);
      $row['status']         = fn_preservation_status($row['status']);
      $row['status_date']    = fn_fdate($row['status_date']);

      $table_pres->add_data($row);
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/********************************************************************************************/
/*                                                                                          */
/* Stage 10: Get any notes for this locomotive                                              */
/*                                                                                          */
/********************************************************************************************/

  $sql = 'SELECT info
          FROM   d_notes dn
          WHERE  dn.loco_id = ' . $id;
                           
  $result = $db->execute($sql);

  if (($notes = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $table_notes->add_data($row);
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;


/********************************************************************************************/
/*                                                                                          */
/* Stage 11: Get any component history for this locomotive                                  */
/*                                                                                          */
/********************************************************************************************/
  $sql = 'SELECT cmp.details,
                 d2c.start_date,
                 d2c.end_date,
                 d2c.removal_reason,
                 d2c.details,
                 concat(CASE WHEN cmp.pu_id IS NOT NULL THEN
                          "Power Unit"
                        ELSE
                          mcd1.description
                        END, " ",
                        cmp.serial_no) AS component_details,
                 concat(CASE WHEN cmp.pu_id IS NOT NULL THEN
                          "Power Unit"
                        ELSE
                          mcd1.description
                        END, " ",
                        cmp.serial_no, " ",
                        ifnull(d2c.details, " ")) AS component_details_long
          FROM   d_to_component d2c
          JOIN   ref_components cmp
          ON     cmp.component_id = d2c.component_id
          LEFT JOIN ref_misc_components mc
          ON     mc.mct_id = cmp.mct_id
          LEFT JOIN ref_misc_components_desc mcd1
          ON     mcd1.mct_type = mc.mct_type
          WHERE  loco_id = ' . $id . '
          ORDER BY d2c.start_date';

  $result = $db->execute($sql);

  if (($component_count = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
       $row['start_date'] = fn_fdate($row['start_date']);
       $row['end_date']   = fn_fdate($row['end_date']);

       $table_components->add_data($row);
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/********************************************************************************************/
/*                                                                                          */
/* Stage 11: Get summary for this locomotive                                                */
/*                                                                                          */
/********************************************************************************************/

  $sql = 'SELECT ds.*,
                 ds.ig_id                                                           AS lnk,
                 concat("timelines.php?page=workings&subpage=groups&id=", ds.ig_id) AS lnk_hl
          FROM   d_summary ds
          WHERE  loco_id = ' . $id .'
          ORDER BY event_date, seq, ds.details';
                           
  $result = $db->execute($sql);

  if (($summary = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
  {
      if (!empty($row['lnk']))
        $row['lnk'] = "Link";
      $row['event_date'] = fn_fdate($row['event_date']);
     # $row['event_edate'] = fn_fdate($row['event_edate']);
    $table_summary->add_data($row);
  }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/********************************************************************************************/
/*                                                                                          */
/* Stage 12: Get details of previous and next locos (if they exist)                         */
/*                                                                                          */
/********************************************************************************************/

  $sql = 'SELECT dn.number        AS number,
                 dn.number_type   AS number_type,
                 F.mx             AS loco_id
          FROM   d_nums dn
          JOIN (SELECT max(dcl_p.loco_id) AS mx
                FROM   d_class_link dcl_p
                JOIN   d_class_link dcl_c
                ON     dcl_p.d_class_id = dcl_c.d_class_id
                WHERE  dcl_c.loco_id = ' . $id . '
                AND    dcl_p.loco_id < dcl_c.loco_id) AS F
          ON    F.mx = dn.loco_id
          JOIN  diesels d
          ON    d.loco_id = F.mx
          AND   d.b_date = dn.start_date';

  $result = $db->execute($sql);

  if ($db->count_select())
  {
    $row = mysqli_fetch_assoc($result);

    $b_prev = true;
    $prev_id  = $row['loco_id'];
    $prev_num = $row['number_type'] == 'PRT' ? fn_d_pfx($row['number']) : $row['number'];
  }
  else
    $b_prev = false;
          
  $sql = 'SELECT dn.number        AS number,
                 dn.number_type   AS number_type,
                 F.mn             AS loco_id
          FROM   d_nums dn
          JOIN (SELECT min(dcl_p.loco_id) AS mn
                FROM   d_class_link dcl_p
                JOIN   d_class_link dcl_c
                ON     dcl_p.d_class_id = dcl_c.d_class_id
                WHERE  dcl_c.loco_id = ' . $id . '
                AND    dcl_p.loco_id > dcl_c.loco_id) AS F
          ON    F.mn = dn.loco_id
          JOIN  diesels d
          ON    d.loco_id = F.mn
          AND   d.b_date = dn.start_date';

  $result = $db->execute($sql);
  
  if ($db->count_select())
  {
    $row = mysqli_fetch_assoc($result);

    $b_next = true;
    $next_id  = $row['loco_id'];
    $next_num = $row['number_type'] == 'PRT' ? fn_d_pfx($row['number']) : $row['number'];
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
                 d2l.caveat
          FROM   log_details ld
          JOIN   d_to_log d2l
          ON     d2l.log_dtl_id = ld.ld_id
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
          WHERE  d2l.loco_id = ' . $id . '
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

/********************************************************************************************/
/*                                                                                          */
/* Stage 99: Display the tables with HTML                                                   */
/*                                                                                          */
/********************************************************************************************/

  if ($b_prev)
  {
    printf("<a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=D&amp;loco=%s\">", 
           $prev_id, $prev_num);
      printf("<img src=\"img/prev.gif\" alt=\"prev\" id=\"img_prev\" />\n");
    printf("</a>\n");
  }

  if ($b_next)
  {
    printf("<a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=D&amp;loco=%s\">", 
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

        // always present
        $table_specifics->draw_table();
        printf("<br />\n");

        // liveries optional
        if ($livery_count > 0)
        {
          $table_liveries->draw_table();
          printf("<br />\n");
        }

      printf("</td>\n");
      printf("<td width=\"49%%\" valign=\"top\">\n");

      // always present - but not until database is complete
      $table_allocs->draw_table();
      printf("<br />\n");

      // always present - but not until database is complete
      // $table_sls->draw_table();
      // printf("<br />\n");
	  // printf("* Stephenson Locomotive Society data - raw and not yet cross-referenced<br />");

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

      if ($fire_count > 0)
      {
        $table_fire->draw_table();
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
    printf("<a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=D&amp;loco=%s\">", 
           $prev_id, $prev_num);
      printf("<img src=\"img/prev.gif\" alt=\"prev\" id=\"img_prev\" />\n");
    printf("</a>\n");
  }

  if ($b_next)
  {
    printf("<a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=D&amp;loco=%s\">", 
           $next_id, $next_num);
      printf("<img src=\"img/next.gif\" alt=\"prev\" id=\"img_next\" />\n");
    printf("</a>\n");
  }

 //<a href="www.hyperlinkcode.com"><img src="/images/sample-image.gif" border="0"></a> 
 // printf("<img src=\"img/prev.gif\" alt=\"prev\" id=\"img_prev\" />\n");
 // printf("<img src=\"img/next.gif\" alt=\"next\" id=\"img_next\" />\n");

  printf("<br />\n");
?>
