<?php
  include_once("lib/brlib.php");
                
/***********************************************************************************************/
/*                                                                                             */
/* Stage 0: Preliminaries - set up specifics table                                             */
/*                                                                                             */
/***********************************************************************************************/

  include_once "lib/MyTables.class.php";

  $table_specifics = new MyTables("loco_table");

  $table_specifics->add_caption("Vehicle Specifics");
  $table_specifics->suppress_nulls();
//$table_specifics->add_row("designer",          "Designer");
  $table_specifics->add_row("identifier",        "Class as Built");
  $table_specifics->add_row("vehicle_type",      "Vehicle Type");
  $table_specifics->add_row("subclass",          "Rebuild History");
  $table_specifics->add_row("wheel_arrangement", "Wheels");
  $table_specifics->add_row("bl_name",           "Builder");
  $table_specifics->add_row("order_number",      "Order Number");
  $table_specifics->add_row("works_number",      "Works Number");
  $table_specifics->add_row("b_date",            "To Service");

  $table_specifics->add_row("withdrawal",        "Withdrawn");
  $table_specifics->add_row("depot_when_wdn",    "Withdrawn From");
  $table_specifics->add_row("reason_withdrawn",  "Withdrawal Reason");

  $table_specifics->add_row("dis",               "Time in Service");
  $table_specifics->add_row("mileage",           "Total Mileage");
  $table_specifics->add_row("s_date",             "Cut Up");
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
  $table_numbers->add_column("number",           "Number",    25);
  $table_numbers->add_column("sdate",            "Date From", 40);

  $table_liveries = new MyTables("loco_liveries");
  $table_liveries->add_caption("Liveries Carried");
  $table_liveries->add_column("colour",          "Colour",    60);
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
  $table_names->add_column("name",       "Name",      60);
  $table_names->add_column("start_date", "Date From", 40);
//  $table_names->add_row_lwidth(35); /* percentage of width of table for first column */   
//  $table_names->set_align("V");

  $table_mods = new MyTables("loco_mods");
  $table_mods->add_caption("Modifications");
  $table_mods->add_column("date_modified", "Date Modified", 35);
  $table_mods->add_column("description",   "Modification",  65);

  $table_allocs = new MyTables("allocations");
  $table_allocs->add_caption("Allocations");
  $table_allocs->add_column("allocation", "Code",      9);
  $table_allocs->add_column("depot_name", "Name",     49);
  $table_allocs->add_column("period",     "",         14);
  $table_allocs->add_column("alloc_date", "Date From",28); 

  $table_components = new MyTables("components");
  $table_components->add_caption("Components");
  $table_components->sortable();
  $table_components->add_column("start_date",        "Fitted",        11);
  $table_components->add_column("component_details", "Component",     23);
  $table_components->add_column("details",           "Details",       20);
  $table_components->add_column("end_date",          "Removed",       11);
  $table_components->add_column("removal_reason",    "Component",     35);

  $table_works = new MyTables("works_visits");
  $table_works->add_caption("Works Visits");
  $table_works->add_column("bl_name",         "Works",          15);
  $table_works->add_column("start_date",      "Entry",          10);
  $table_works->add_column("end_date",        "Departure",      10);
  $table_works->add_column("duration",        "Durn",           7);
  $table_works->add_column("regime",          "Level of Work",  48);
  $table_works->add_column("mileage",         "Mileage",        10);

  if ($update)
    $caption_hl = sprintf("upd_steam.php?page=upd_loco_inc&id=%s", $id);

  $table_summary = new MyTables("summary");
  $table_summary->add_caption("Summary");
  $table_summary->add_column("event_sdate", "Start",      8);
  $table_summary->add_column("event_edate", "End",        8);
  $table_summary->add_column("event_type",  "Event",     12);
  $table_summary->add_column("details",     "Details",   52);
  $table_summary->add_column("source",      "Source",    16);
  $table_summary->add_column("lnk",         "See Also",   4);

  $table_formation = new MyTables("formation");
  $table_formation->add_caption("Formations");
  $table_formation->add_column("formation_date",   "Date",  10);
  $table_formation->add_column("unit_number",      "Unit",  10);
  $table_formation->add_column("formation_str",    "Formation",  50);
  $table_formation->add_column("notes",            "Notes", 30);
 
/***********************************************************************************************/
/*                                                                                             */
/* Stage 1: Get the class variations for this locomotive                                       */
/*                                                                                             */
/***********************************************************************************************/

  $sql = 'SELECT dc.identifier     AS identifier_main,
                 dcv.identifier,
                 dcv.dmu_class_id,
                 dcv.dmu_class_var_id,
                 dcl.start_date    AS start_date
          FROM   dmu_class_link dcl
          JOIN   dmu_class_var  dcv    
          ON     dcv.dmu_class_id = dcl.dmu_class_id
          AND    dcv.dmu_class_var_id = dcl.dmu_class_var_id
          JOIN   dmu_class dc
          ON     dc.dmu_class_id = dcv.dmu_class_id
          WHERE  dcl.dmu_id = ' . $id . '
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
        $class_id = $row['dmu_class_id'];  // for next/prev button processing

        $rw = "<table width=\"100%\" frame=\"box\"><tr><td width=\"40%\"><strong>Class</strong></td><td width=\"60%\"><strong>From</strong></td></tr>";
        $rw .= "<tr><td><a href=\"locoqry.php?action=class&amp;type=DMU&amp;id=" . $row['dmu_class_id']
              . "\">" . $row['identifier']
              .     "</a></td><td>"  . fn_fdate($row['start_date'])
              .     "</td></tr>";
      }
      else
      {
        if (($row['dmu_class_id']     != $last_class_id) ||
            ($row['dmu_class_var_id'] != $last_class_var_id))
        {
          $rw .= "<tr><td><a href=\"locoqry.php?action=class&amp;type=DMU&amp;id=" . $row['dmu_class_id']
                . "\">" . $row['identifier']
                .     "</a></td><td>"  . fn_fdate($row['start_date'])
                .     "</td></tr>";
        }
      }

      $ct++;

      $last_class_id = $row['dmu_class_id'];
      $last_class_var_id = $row['dmu_class_var_id'];
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
                 d.info                                                      AS dmu_info,
                 CASE WHEN d.works_num_b IS NOT NULL THEN
                   concat(d.works_num, "/", d.works_num_b)
                 ELSE
                   d.works_num
                 END                                                         AS works_number,
                 dcl.dmu_class_id,
                 concat(sm.merchant_name, " (", sy.location, ")")            AS sc_name_place,
                 bl1.bl_name                                                 AS bl_name_mech,
                 concat("sites.php?page=builders&amp;id=", bl1.bl_code)      AS bl_name_mech_hl,
                 bl2.bl_name                                                 AS bl_name_coach,
                 concat("sites.php?page=builders&amp;id=", bl2.bl_code)      AS bl_name_coach_hl,
                 concat("misc.php?page=wheel_arr&amp;id=", dc.wheel_arrangement) 
                                                                             AS wheel_arrangement_hl,
                 concat("sites.php?page=scrapyards&amp;id=", sy.scrapyard_code)  
                                                                             AS sc_name_place_hl,
                 dc.identifier,
                 concat("locoqry.php?action=class&amp;type=DMU&amp;id=",dc.dmu_class_id) 
                                                                             AS identifier_hl,
                 dc.wheel_arrangement,
                 NULL AS dis,
                 d.info as dmu_info,
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
                 CASE WHEN muvt.description IS NOT NULL 
                 THEN
                   concat(muvt.description, " (", muvt.vehicle_code, ")")
                 ELSE
                   ""
                 END                                                       AS vehicle_type
          from   dmu d

          join   dmu_class_link dcl
          on     dcl.dmu_id = d.dmu_id

          join   dmu_class dc
          on     dc.dmu_class_id = dcl.dmu_class_id

          left join ref_builders bl1
          on     bl1.bl_code = d.bl_code_mech

          left join ref_builders bl2
          on     bl2.bl_code = d.bl_code_coach

          left join ref_scrapyard sy
          on     sy.scrapyard_code = d.scrapyard_code

          left join ref_scrap_merchant sm
          on     sm.merchant_code = substr(sy.scrapyard_code, 1, 3)

          left join ref_orders o
          on     o.order_id = d.order_id

          left join videos v
          on     v.type = "DMU"
          and    v.loco_id = d.dmu_id
          
          left join ref_mu_vehicle_types muvt
          on     muvt.vehicle_code = d.vehicle_type

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

          where  d.dmu_id = ' .$id;

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

    if ($ct > 1)
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

    if (!empty($row['depot_name_b']))
    {
      if (!empty($row['b_date']))
        $row['to_service'] = fn_fdate($row['b_date']);

      $row['to_service'] .= " to <a href=\"" . $row['depot_when_new_hl']
                          . "\">" . $row['depot_name_b'] . " (" . $row['depot_code_b'] . ")</a>";
    }
    else
    if (!empty($row['b_date']))
      $row['to_service'] = fn_fdate($row['b_date']);

    $b_date = $row['b_date'];
  
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

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 3: Get the numbers carried by this locomotive                                         */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT *
          from   dmu_nums dn
          where  dn.dmu_id = ' .$id. '
          order by dn.start_date';
  
  $result = $db->execute($sql);
        
  if ($db->count_select())
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $dn01 = $row['number_type'];
      
      if (!empty($row['regional_pfx']))
        $row['number'] = $row['regional_pfx'] . $row['number'];
      
      if (!empty($row['regional_sfx']))
        $row['number'] = $row['number'] . $row['regional_sfx'];

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
        $rowx['text']  = "Pre TOPS";
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
      if ($dn01 == "CARR") /* Industrial */
        $rowx['text']  = "Vehicle";

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
/**********************************************************************************************
        
  $sql = 'SELECT dnm.*,
                 concat("names.php?id=", dnm.d_name_id, "&amp;type=DMU") AS name_hl
          FROM   dmu_name dnm 
          WHERE  dnm.dmu_id = ' .$id. '
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
*/

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
          WHERE  wv.type = "DMU"
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

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 5: Get the modifications made to this locomotive                                      */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT dm.*,
                 m.*
          FROM   dmu_mods dm
          JOIN   ref_modifications m
          ON     m.modification = dm.modification
          WHERE  dm.dmu_id = ' .$id. '
          ORDER BY dm.date_modified ASC';

  $result = $db->execute($sql);

  if (($mods_count = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['date_modified'] = fn_fdate($row['date_modified']);

      $table_mods->add_data($row);
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
                 da.allocation                                AS allocation,
                 da.snap                                      AS snapshot,
                 d.depot_name,
                 da.alloc_date,
                 da.alloc_flag,
                 da.alloc_date_prd                            AS period,
                 concat("sites.php?page=depots&action=query&id=", d.depot_id) AS allocation_hl,
                 concat("sites.php?page=depots&action=query&id=", d.depot_id) AS depot_name_hl,
                 da.caveat,
                 da.dmu_usage,
                 d2.depot_name                                AS home_shed_name,
                 coalesce(dc2.displayed_depot_code, dc2.depot_code) AS home_shed_alloc
          from   vdmu_allocations da
          LEFT JOIN ref_depot_codes dc
          ON     dc.depot_code = coalesce(da.loan_allocation, da.allocation)
          AND    dc.date_from  = (SELECT max(dca.date_from)
                                  FROM   ref_depot_codes dca
                                  WHERE  dca.depot_code = coalesce(da.loan_allocation, da.allocation)
                                  AND    dca.date_from <= da.alloc_date)
          LEFT JOIN ref_depot d
          ON     d.depot_id = dc.depot_id

          LEFT JOIN ref_depot_codes dc2
          ON     dc2.depot_code = substr(da.allocation, 1, instr(da.allocation, ".") -1)
          AND    dc2.date_from  = (SELECT max(dcb.date_from)
                                  FROM   ref_depot_codes dcb
                                  WHERE  dcb.depot_code = substr(da.allocation, 1, instr(da.allocation, ".") -1)
                                  AND    dcb.date_from <= da.alloc_date)
          LEFT JOIN ref_depot d2
          ON     d2.depot_id = dc2.depot_id

          WHERE  da.dmu_id = ' .$id. '
          ORDER BY da.alloc_date ASC, da.seq ASC';

  $result = $db->execute($sql);

  if ($result)
  {
  if (($alloc_ct = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['period'] = fn_prd($row['period']);

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
    
  $sql = 'select i.reporting_number  report_number,
                 i.details           details,
                 i.sdate_of_incident start_date,
                 i.edate_of_incident end_date,

                 i.reference         reference,
                 ig.ig_id            incident_group_id,
                 NULL            AS  incgroup,
                 concat("timelines.php?page=workings&amp;subpage=groups&amp;id=", ig.ig_id) 
                                                                                  AS incgroup_hl
          from   dmu_to_i dtoi
          inner join incidents i
          on     dtoi.inc_id = i.inc_id
          left join  incident_groups ig
          on     i.ig_id = ig.ig_id
          where dtoi.dmu_id = ' .$id. '
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
  
/***********************************************************************************************/
/*                                                                                             */
/* Stage 8: Get the liveries applied to this locomotive                                        */
/*                                                                                             */
/***********************************************************************************************/
        
  $sql = 'SELECT coalesce(l.description, l.base_colour) AS colour,
                 l.company,
                 dl.start_date
          FROM   dmu_to_livery dl
          JOIN   ref_livery l
          ON     l.livery_id = dl.livery_id
          WHERE  dl.dmu_id = ' .$id. '
          ORDER BY dl.start_date ASC';

  $result = $db->execute($sql);

  if (($livery_count = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['start_date'] = fn_fdate($row['start_date']);

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
          AND    p.type = "DMU"';
                           
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
          FROM   dmu_notes dn
          WHERE  dn.dmu_id = ' . $id;
                           
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
          FROM   dmu_to_component d2c
          JOIN   ref_components cmp
          ON     cmp.component_id = d2c.component_id
          LEFT JOIN ref_misc_components mc
          ON     mc.mct_id = cmp.mct_id
          LEFT JOIN ref_misc_components_desc mcd1
          ON     mcd1.mct_type = mc.mct_type
          WHERE  dmu_id = ' . $id . '
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
/* Stage 11b: Get formations for this unit                                                  */
/*                                                                                          */
/********************************************************************************************/

  $sql = 'SELECT df.formation_date,
                 df.unit_number,
                 CASE WHEN df.initial_formation = "Y"
                 THEN
                   "Initial formation"
                 ELSE
                   ""
                 END              AS notes,
                 df.snapshot,
                 dn1.number       AS number_d1,
                 dn1.number_type  AS number_type_d1,
                 dn1.regional_pfx AS regpfx_d1,
                 df.d_car1        AS id_d1,
                 d1.vehicle_type  AS vt_d1,
                 
                 dn2.number       AS number_d2,
                 dn2.number_type  AS number_type_d2,
                 dn2.regional_pfx AS regpfx_d2,
                 df.d_car2        AS id_d2,
                 d2.vehicle_type  AS vt_d2,
                
                 dn3.number       AS number_t1,
                 dn3.number_type  AS number_type_t1,
                 dn3.regional_pfx AS regpfx_t1,
                 df.trailer1      AS id_t1,
                 d3.vehicle_type  AS vt_t1,

                 dn4.number       AS number_t2,
                 dn4.number_type  AS number_type_t2,
                 dn4.regional_pfx AS regpfx_t2,
                 df.trailer2      AS id_t2,
                 d4.vehicle_type  AS vt_t2,

                 dn5.number       AS number_t3,
                 dn5.number_type  AS number_type_t3,
                 dn5.regional_pfx AS regpfx_t3,
                 df.trailer3      AS id_t3,
                 d5.vehicle_type  AS vt_t3,

                 dn6.number       AS number_t4,
                 dn6.number_type  AS number_type_t4,
                 dn6.regional_pfx AS regpfx_t4,
                 df.trailer4      AS id_t4,
                 d6.vehicle_type  AS vt_t4,

                 dn7.number       AS number_t5,
                 dn7.number_type  AS number_type_t5,
                 dn7.regional_pfx AS regpfx_t5,
                 df.trailer5      AS id_t5,
                 d7.vehicle_type  AS vt_t5,

                 dn8.number       AS number_t6,
                 dn8.number_type  AS number_type_t6,
                 dn8.regional_pfx AS regpfx_t6,
                 df.trailer6      AS id_t6,
                 d8.vehicle_type  AS vt_t6,

                 dn9.number       AS number_t7,
                 dn9.number_type  AS number_type_t7,
                 dn9.regional_pfx AS regpfx_t7,
                 df.trailer7      AS id_t7,
                 d9.vehicle_type  AS vt_t7,

                 dn0.number       AS number_t8,
                 dn0.number_type  AS number_type_t8,
                 dn0.regional_pfx AS regpfx_t8,
                 df.trailer8      AS id_t8,
                 d0.vehicle_type  AS vt_t8

          FROM   dmu_formation df
          JOIN   dmu_to_formation d2f
          ON     d2f.dmu_id = ' . $id .'
          AND    d2f.formation_id = df.formation_id
          
          JOIN   dmu_nums dn1
          ON     dn1.dmu_id = df.d_car1
          AND    dn1.start_date = (SELECT max(dn1a.start_date)
                                   FROM   dmu_nums dn1a
                                   WHERE  dn1a.dmu_id = dn1.dmu_id
                                   AND    dn1a.start_date <= df.formation_date)
                                   
          LEFT JOIN   dmu_nums dn2
          ON     dn2.dmu_id = df.d_car2
          AND    dn2.start_date = (SELECT max(dn2a.start_date)
                                   FROM   dmu_nums dn2a
                                   WHERE  dn2a.dmu_id = dn2.dmu_id
                                   AND    dn2a.start_date <= df.formation_date)

          LEFT JOIN   dmu_nums dn3
          ON     dn3.dmu_id = df.trailer1
          AND    dn3.start_date = (SELECT max(dn3a.start_date)
                                   FROM   dmu_nums dn3a
                                   WHERE  dn3a.dmu_id = dn3.dmu_id
                                   AND    dn3a.start_date <= df.formation_date)

          LEFT JOIN   dmu_nums dn4
          ON     dn4.dmu_id = df.trailer2
          AND    dn4.start_date = (SELECT max(dn4a.start_date)
                                   FROM   dmu_nums dn4a
                                   WHERE  dn4a.dmu_id = dn4.dmu_id
                                   AND    dn4a.start_date <= df.formation_date)

          LEFT JOIN   dmu_nums dn5
          ON     dn5.dmu_id = df.trailer3
          AND    dn5.start_date = (SELECT max(dn5a.start_date)
                                   FROM   dmu_nums dn5a
                                   WHERE  dn5a.dmu_id = dn5.dmu_id
                                   AND    dn5a.start_date <= df.formation_date)

          LEFT JOIN   dmu_nums dn6
          ON     dn6.dmu_id = df.trailer4
          AND    dn6.start_date = (SELECT max(dn6a.start_date)
                                   FROM   dmu_nums dn6a
                                   WHERE  dn6a.dmu_id = dn6.dmu_id
                                   AND    dn6a.start_date <= df.formation_date)

          LEFT JOIN   dmu_nums dn7
          ON     dn7.dmu_id = df.trailer5
          AND    dn7.start_date = (SELECT max(dn7a.start_date)
                                   FROM   dmu_nums dn7a
                                   WHERE  dn7a.dmu_id = dn7.dmu_id
                                   AND    dn7a.start_date <= df.formation_date)

          LEFT JOIN   dmu_nums dn8
          ON     dn8.dmu_id = df.trailer6
          AND    dn8.start_date = (SELECT max(dn8a.start_date)
                                   FROM   dmu_nums dn8a
                                   WHERE  dn8a.dmu_id = dn8.dmu_id
                                   AND    dn8a.start_date <= df.formation_date)

          LEFT JOIN   dmu_nums dn9
          ON     dn9.dmu_id = df.trailer7
          AND    dn9.start_date = (SELECT max(dn9a.start_date)
                                   FROM   dmu_nums dn9a
                                   WHERE  dn9a.dmu_id = dn9.dmu_id
                                   AND    dn9a.start_date <= df.formation_date)

          LEFT JOIN   dmu_nums dn0
          ON     dn0.dmu_id = df.trailer8
          AND    dn0.start_date = (SELECT max(dn0a.start_date)
                                   FROM   dmu_nums dn0a
                                   WHERE  dn0a.dmu_id = dn0.dmu_id
                                   AND    dn0a.start_date <= df.formation_date)
                                   
          JOIN dmu d1
          ON   d1.dmu_id = df.d_car1

          LEFT JOIN dmu d2
          ON   d2.dmu_id = df.d_car2

          LEFT JOIN dmu d3
          ON   d3.dmu_id = df.trailer1

          LEFT JOIN dmu d4
          ON   d4.dmu_id = df.trailer2

          LEFT JOIN dmu d5
          ON   d5.dmu_id = df.trailer3

          LEFT JOIN dmu d6
          ON   d6.dmu_id = df.trailer4

          LEFT JOIN dmu d7
          ON   d7.dmu_id = df.trailer5

          LEFT JOIN dmu d8
          ON   d8.dmu_id = df.trailer6

          LEFT JOIN dmu d9
          ON   d9.dmu_id = df.trailer7

          LEFT JOIN dmu d0
          ON   d0.dmu_id = df.trailer8

          ORDER BY df.formation_date ASC';
          
//          echo $sql;
                           
  $result = $db->execute($sql);

  if (($formation_ct = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['formation_date'] = $row['snapshot'] == "Y" ? "<span id=do_italics>" . fn_fdate($row['formation_date']) . "&nbsp;(snapshot)</span> " : fn_fdate($row['formation_date']);
      
      $row['formation_str']  = fn_formation($row['regpfx_d1'], $row['number_d1'], $row['id_d1'], "DMU", $row['vt_d1']);
      if (!empty($row['number_t1'])) $row['formation_str'] .= ",&nbsp;&nbsp;" . fn_formation($row['regpfx_t1'], $row['number_t1'], $row['id_t1'], "DMU", $row['vt_t1']);
      if (!empty($row['number_t2'])) $row['formation_str'] .= ",&nbsp;&nbsp;" . fn_formation($row['regpfx_t2'], $row['number_t2'], $row['id_t2'], "DMU", $row['vt_t2']);
      if (!empty($row['number_t3'])) $row['formation_str'] .= ",&nbsp;&nbsp;" . fn_formation($row['regpfx_t3'], $row['number_t3'], $row['id_t3'], "DMU", $row['vt_t3']);
      if (!empty($row['number_t4'])) $row['formation_str'] .= ",&nbsp;&nbsp;" . fn_formation($row['regpfx_t4'], $row['number_t4'], $row['id_t4'], "DMU", $row['vt_t4']);
      if (!empty($row['number_t5'])) $row['formation_str'] .= ",&nbsp;&nbsp;" . fn_formation($row['regpfx_t5'], $row['number_t5'], $row['id_t5'], "DMU", $row['vt_t5']);
      if (!empty($row['number_t6'])) $row['formation_str'] .= ",&nbsp;&nbsp;" . fn_formation($row['regpfx_t6'], $row['number_t6'], $row['id_t6'], "DMU", $row['vt_t6']);
      if (!empty($row['number_t7'])) $row['formation_str'] .= ",&nbsp;&nbsp;" . fn_formation($row['regpfx_t7'], $row['number_t7'], $row['id_t7'], "DMU", $row['vt_t7']);
      if (!empty($row['number_t8'])) $row['formation_str'] .= ",&nbsp;&nbsp;" . fn_formation($row['regpfx_t8'], $row['number_t8'], $row['id_t8'], "DMU", $row['vt_t8']);
      if (!empty($row['number_d2'])) $row['formation_str'] .= ",&nbsp;&nbsp;" . fn_formation($row['regpfx_d2'], $row['number_d2'], $row['id_d2'], "DMU", $row['vt_d2']);
      
      $table_formation->add_data($row);
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;


/********************************************************************************************/
/*                                                                                          */
/* Stage 12: Get summary for this locomotive                                                */
/*                                                                                          */
/********************************************************************************************/

  $sql = 'SELECT ds.*,
                 ds.ig_id                                                           AS lnk,
                 concat("timelines.php?page=workings&subpage=groups&id=", ds.ig_id) AS lnk_hl
          FROM   dmu_summary ds
          WHERE  dmu_id = ' . $id .'
          ORDER BY event_sdate, ds.details';
                           
  $result = $db->execute($sql);

  if (($summary = $db->count_select()) > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      if (!empty($row['lnk']))
        $row['lnk'] = "Link";
      $row['event_sdate'] = fn_fdate($row['event_sdate']);
      $row['event_edate'] = fn_fdate($row['event_edate']);
      $table_summary->add_data($row);
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/********************************************************************************************/
/*                                                                                          */
/* Stage 13: Get details of previous and next locos (if they exist)                         */
/*                                                                                          */
/********************************************************************************************/

  $sql = 'SELECT dn.number        AS number,
                 dn.number_type   AS number_type,
                 F.mx             AS dmu_id
          FROM   dmu_nums dn
          JOIN (SELECT max(dcl_p.dmu_id) AS mx
                FROM   dmu_class_link dcl_p
                JOIN   dmu_class_link dcl_c
                ON     dcl_p.dmu_class_id = dcl_c.dmu_class_id
                WHERE  dcl_c.dmu_id = ' . $id . '
                AND    dcl_p.dmu_id < dcl_c.dmu_id) AS F
          ON    F.mx = dn.dmu_id
          JOIN  dmu d
          ON    d.dmu_id = F.mx
          AND   d.b_date = dn.start_date';

  $result = $db->execute($sql);

  if ($db->count_select())
  {
    $row = mysqli_fetch_assoc($result);

    $b_prev = true;
    $prev_id  = $row['dmu_id'];
    $prev_num = $row['number_type'] == 'PRT' ? fn_d_pfx($row['number']) : $row['number'];
  }
  else
    $b_prev = false;
          
  $sql = 'SELECT dn.number        AS number,
                 dn.number_type   AS number_type,
                 F.mn             AS dmu_id
          FROM   dmu_nums dn
          JOIN (SELECT min(dcl_p.dmu_id) AS mn
                FROM   dmu_class_link dcl_p
                JOIN   dmu_class_link dcl_c
                ON     dcl_p.dmu_class_id = dcl_c.dmu_class_id
                WHERE  dcl_c.dmu_id = ' . $id . '
                AND    dcl_p.dmu_id > dcl_c.dmu_id) AS F
          ON    F.mn = dn.dmu_id
          JOIN  dmu d
          ON    d.dmu_id = F.mn
          AND   d.b_date = dn.start_date';

  $result = $db->execute($sql);
  
  if ($db->count_select())
  {
    $row = mysqli_fetch_assoc($result);

    $b_next = true;
    $next_id  = $row['dmu_id'];
    $next_num = $row['number_type'] == 'PRT' ? fn_d_pfx($row['number']) : $row['number'];
  }
  else
    $b_next = false;


/********************************************************************************************/
/*                                                                                          */
/* Stage 14: Display the tables with HTML                                                   */
/*                                                                                          */
/********************************************************************************************/

  if ($b_prev)
  {
    printf("<a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=DMU&amp;loco=%s\">", 
           $prev_id, $prev_num);
      printf("<img src=\"img/prev.gif\" alt=\"prev\" id=\"img_prev\" />\n");
    printf("</a>\n");
  }

  if ($b_next)
  {
    printf("<a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=DMU&amp;loco=%s\">", 
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

  if ($wv_count > 0 || $update)
  {
    $table_works->draw_table();
    printf("<br />\n");
  }

  // formations optional
  if ($formation_ct > 0)
  {
    $table_formation->draw_table();
    printf("<br />\n");
  }

  //  always present, even if empty
  $table_summary->draw_table();

  printf("<br />\n");
  if ($b_prev)
  {
    printf("<a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=DMU&amp;loco=%s\">", 
           $prev_id, $prev_num);
      printf("<img src=\"img/prev.gif\" alt=\"prev\" id=\"img_prev\" />\n");
    printf("</a>\n");
  }

  if ($b_next)
  {
    printf("<a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=DMU&amp;loco=%s\">", 
           $next_id, $next_num);
      printf("<img src=\"img/next.gif\" alt=\"prev\" id=\"img_next\" />\n");
    printf("</a>\n");
  }

 //<a href="www.hyperlinkcode.com"><img src="/images/sample-image.gif" border="0"></a> 
 // printf("<img src=\"img/prev.gif\" alt=\"prev\" id=\"img_prev\" />\n");
 // printf("<img src=\"img/next.gif\" alt=\"next\" id=\"img_next\" />\n");

  printf("<br />\n");
?>
