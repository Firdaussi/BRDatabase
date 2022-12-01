<?php

/***********************************************************************************************/
/*                                                                                             */
/* Stage 0: Preliminaries - set up tables and work out parameters                              */
/*                                                                                             */
/***********************************************************************************************/

  include_once("lib/brlib.php");
  include_once("lib/MyTables.class.php");
  include_once("lib/tc_calendar.php");

  $sql = "select min(s.b_date) AS mindate,
                 max(s.w_date) AS maxdate
          from   steam s
          join   s_class_link scl
          on     scl.loco_id = s.loco_id
          join   s_class sc
          on     sc.s_class_id = scl.s_class_id
          where  sc.s_class_id = " . $id;

  $result = $db->execute($sql);

  if ($db->count_select())
    $row = mysqli_fetch_assoc($result);
  else
    die("No rows returned");

  $minyear = substr($row['mindate'], 0, 4);
  $maxyear = substr($row['maxdate'], 0, 4);

  $selfref = $_SERVER['PHP_SELF'] . "?page=locoqry.php&action=class&type=S&page=detailed&id=" . $id;
  $theDate = isset($_REQUEST["date2"]) ? $_REQUEST["date2"] : "";

/***********************************************************************************************/
/*                                                                                             */
/* Stage 1: Get all locomotives from this class                                                */
/*                                                                                             */
/***********************************************************************************************/

  if ($theDate != "0000-00-00" && strlen($theDate) == 10)
  {
    $tb_detail = new MyTables("detailed");
    $tb_detail->sortable();
    $tb_detail->add_caption("Detailed snapshot for " . substr($theDate, 8, 2) . '/' . 
                                                       substr($theDate, 5, 2) . '/' . 
                                                       substr($theDate, 0, 4));

    $tb_detail->add_column("number",             "Carried Number",  5);
    $tb_detail->add_column("class_type",         "Class",           5);
    $tb_detail->add_column("allocation",         "Alloc",           5);
    $tb_detail->add_column("depot_name",         "Depot",          12);
    $tb_detail->add_column("livery",             "Livery",         10);
    $tb_detail->add_column("boiler_number",      "Boiler",          6);
    $tb_detail->add_column("boiler_diagram_no",  "Diag",            4);
    $tb_detail->add_column("tender_details",     "Tender",          8);
    $tb_detail->add_column("name",               "Name",           10);
    $tb_detail->add_column("other",              "Notes",          35);


    $sql = 'SELECT s.loco_id,
                   s.b_date,
                   s.w_date,
                   s.s_date,
                   scv.class_type,
                   concat("locoqry.php?action=class&type=S&id=", scv.s_class_id) 
                                                               AS class_type_hl,
                   scl.s_class_id,
                   sn.number,
                   concat("locoqry.php?action=locodata&id=", s.loco_id, "&type=S&loco=", sn.number)
                                                               AS number_hl,
                   sn.number_type,
                   sn.prefix,
                   sn.suffix,
                   sn.subtype,
                   dpc_time.depot_code                         AS allocation,
                   concat("sites.php?page=depots&action=query&id=", dp.depot_id) AS allocation_hl,
                   dp.depot_name,
                   concat("sites.php?page=depots&action=query&id=", dp.depot_id) AS depot_name_hl,
                   l.base_colour                               AS livery,
                   snm.name,
                   sbn.boiler_number,
                   bt.boiler_diagram_no,
                   NULL                                        AS boiler_details,
                   st.tender_number,
                   tt.tender_type,
                   NULL                                        AS tender_details,
                   coalesce(b.bl_short_name, b.bl_name)        AS builder,
                   vt.description                              AS wk_visit_type,
                   NULL                                        AS other,
                   snip.snippet,
                   wv.start_date                               AS wv_start,
                   wv.end_date                                 AS wv_end

            FROM   steam s

            LEFT JOIN   s_class_link scl
            ON     scl.loco_id = s.loco_id
            AND    scl.start_date = (SELECT max(scl1.start_date)
                                     FROM   s_class_link scl1
                                     WHERE  scl1.loco_id = scl.loco_id
                                     AND    scl1.start_date <= "' . $theDate . '")

            LEFT JOIN   s_class_var scv
            ON     scv.s_class_id = scl.s_class_id
            AND    scv.s_class_var_id = scl.s_class_var_id

            LEFT JOIN   s_nums sn
            ON     sn.loco_id = s.loco_id
            AND    sn.start_date =  (SELECT max(sn1.start_date)
                                     FROM   s_nums sn1
                                     WHERE  sn1.loco_id = sn.loco_id
                                     AND    sn1.start_date <= "' . $theDate . '"
                                     AND    sn1.carried_number = "Y")

            LEFT JOIN   s_name snm
            ON     snm.loco_id = s.loco_id
            AND    snm.start_date = (SELECT max(snm1.start_date) 
                                     FROM   s_name snm1 
                                     WHERE  snm1.loco_id = snm.loco_id
                                     AND    snm1.start_date <= "' . $theDate . '")

            LEFT JOIN   s_alloc sa
            ON     sa.loco_id = s.loco_id
            AND    sa.alloc_date =  (SELECT max(sa1.alloc_date)
                                     FROM   s_alloc sa1
                                     WHERE  sa1.loco_id = sa.loco_id
                                     AND    sa1.alloc_date <= "' . $theDate . '")
            
            LEFT JOIN   ref_depot_codes dpc
            ON     dpc.depot_code = coalesce(sa.loan_allocation, sa.allocation)
            AND    dpc.date_from =  (SELECT max(dpc1.date_from)
                                     FROM   depot_codes dpc1
                                     WHERE  dpc1.depot_code = coalesce(sa.loan_allocation, sa.allocation)
                                     AND    dpc1.date_from <= "' . $theDate . '")

            LEFT JOIN   ref_depot dp
            ON     dp.depot_id = dpc.depot_id

            LEFT JOIN   ref_depot_codes dpc_time
            ON     dpc_time.depot_id = dpc.depot_id
            AND    dpc_time.date_from = (SELECT max(dpc_time1.date_from)
                                         FROM   depot_codes dpc_time1
                                         WHERE  dpc_time1.depot_id = dpc.depot_id
                                         AND    dpc_time1.date_from <= "' . $theDate . '")

            LEFT JOIN   s_to_livery s2l
            ON     s2l.loco_id = s.loco_id
            AND    s2l.start_date = (SELECT max(s2l1.start_date)
                                     FROM   s_to_livery s2l1
                                     WHERE  s2l1.loco_id = s2l.loco_id
                                     AND    s2l1.start_date <= "' . $theDate . '")
            LEFT JOIN   ref_livery l
            ON     l.livery_id = s2l.livery_id

            LEFT JOIN   s_to_tender s2t
            ON     s2t.loco_id = s.loco_id
            AND    s2t.start_date = (SELECT max(s2t1.start_date)
                                     FROM   s_to_tender s2t1
                                     WHERE  s2t1.loco_id = s2t.loco_id
                                     AND    s2t1.start_date <= "' . $theDate . '")
            LEFT JOIN   s_tender st
            ON     st.s_tender_id = s2t.s_tender_id
            LEFT JOIN   tender_type tt
            ON     tt.tender_type_id = st.tender_type_id

            LEFT JOIN   s_to_boiler s2b
            ON     s2b.loco_id = s.loco_id
            AND    s2b.start_date = (SELECT max(s2b1.start_date)
                                     FROM   s_to_boiler s2b1
                                     WHERE  s2b1.loco_id = s2b.loco_id
                                     AND    s2b1.start_date <= "' . $theDate . '")
            LEFT JOIN   s_boiler sb
            ON     sb.s_boiler_id = s2b.s_boiler_id
            LEFT JOIN   s_boiler_nums sbn
            ON     sbn.s_boiler_id = sb.s_boiler_id
            AND    sbn.start_date = (SELECT max(sbn1.start_date)
                                     FROM   s_boiler_nums sbn1
                                     WHERE  sbn1.s_boiler_id = sbn.s_boiler_id
                                     AND    sbn1.start_date <= "' . $theDate . '")
            LEFT JOIN   ref_boiler_type bt
            ON     bt.boiler_type_id = sb.boiler_type_id

            LEFT JOIN   works_visits wv
            ON     wv.type = "S"
            AND    wv.loco_id = s.loco_id
            AND    "' . $theDate . '" BETWEEN wv.start_date AND wv.end_date

            LEFT JOIN   ref_visit_type vt
            ON     vt.visit_code = wv.visit_code

            LEFT JOIN   ref_builders b
            ON     b.bl_code = wv.bl_code

            LEFT JOIN   s_to_snippet s2s
            ON     s2s.loco_id = s.loco_id

            LEFT JOIN   s_snippet snip
            ON     snip.s_snippet_id = s2s.s_snippet_id
            AND    snip.snippet_date = "' . $theDate . '"
            
            WHERE  s.loco_id IN
              (SELECT distinct scl.loco_id
               FROM   s_class_link scl
               WHERE  scl.s_class_id = ' . $id . ')
            ORDER BY s.loco_id';

    //echo $sql;

    $result = $db->execute($sql);

    if ($db->count_select())
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        if (!empty($row['snippet']))
        {
          if (!empty($row['other']))
            $row['other'] .= "<br />" . $row['snippet'];
          else
            $row['other'] = $row['snippet'];
        }

        /* Skip those that haven't been built yet */
        if ($row['b_date'] > $theDate)
          continue;

        /* Skip those that have been withdrawn */
        if ($row['w_date'] < $theDate)
        {
          $row['allocation'] = $row['depot_name'] = $row['livery'] = $row['boiler_number'] =
          $row['boiler_diagram_no'] = $row['tender_details'] = "";
          if ($row['s_date'] < $theDate)
            $row['other'] = "<font color=\"red\"><strong>Scrapped</strong></font>";
          else
            $row['other'] = "<font color=\"red\"><strong>Condemned</strong></font>";
          $tb_detail->add_data($row);
          continue;
        }

        /* Skip rebuilds that haven't been done yet e.g. star->castle */
        if ($row['s_class_id'] != $id)
          continue;

        if (!empty($row['tender_type']))
        {
          if (!empty($row['tender_number']))
            $row['tender_details'] = $row['tender_number'] . " (" . $row['tender_type'] . ')';
          else
            $row['tender_details'] = $row['tender_type'];
        }
        else
        if (!empty($row['tender_number']))
        {
          $row['tender_details'] = $row['tender_number'];
        }

        if (!empty($row['wk_visit_type']) && !empty($row['builder']))
        {
          if (!empty($row['other']))
            $row['other'] .= "<br />";

          $row['other'] .= "On " . $row['builder'] . " for a " . $row['wk_visit_type'] . " repair.<br/>";
          if (!empty($row['wv_start']))
          {
              $row['other'] .= " Arrived: " . fn_fdate($row['wv_start']) . ".";
          }
          if (!empty($row['wv_end']))
          {
              $row['other'] .= " Departs: " . fn_fdate($row['wv_end']) . ".";
          }
         }

        $tb_detail->add_data($row);
      }
   
      $tb_detail->draw_table();
    }
  }
?>

  <p>Use this form to generate a snapshot of the configuration and whereabouts of all locomotives of this class on a specific date. Select the date and press 'Submit'.</p>
  <p>Enter Snapshot Date:</p>

  <form name="form" method="post" action="<?php echo $selfref; ?>">
  <table border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td valign="top">
      <?php
        $myCalendar = new tc_calendar("date2");
        $myCalendar->setIcon("img/iconCalendar.gif");
        $myCalendar->setDate(date('d'), date('m'), date('Y'));
        $myCalendar->setPath("includes/");
        $myCalendar->setYearInterval($minyear, $maxyear);
        $myCalendar->dateAllow($minyear . '-01-01', $maxyear . '-12-31', false);
        $myCalendar->startMonday(true);
        //$myCalendar->autoSubmit(true, "", "test.php");
        //$myCalendar->autoSubmit(true, "form");
        $myCalendar->writeScript();
        ?>
      </td>
    </tr>
    <tr>
      <td>
      <input type="submit" name="Submit" value="Submit" />
      </td>
    </tr>
  </table>
  </form>

      
