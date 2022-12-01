<?php
  include_once("lib/brlib.php");

/***********************************************************************************************/
/*                                                                                             */
/* Stage 0: Preliminaries - set up tables and work out parameters                              */
/*                                                                                             */
/***********************************************************************************************/
  include_once("lib/MyTables.class.php");

  $tb_event = new MyTables("cycle_data");

  $tb_event->add_column("status_date",       "Date",             11);
  $tb_event->add_column("record_type",       "Event",             8);
  $tb_event->add_column("number",            "Number",            8);
  $tb_event->add_column("allocationf",       "From",              5);
  $tb_event->add_column("depot_namef",       "Depot From",       15);
  $tb_event->add_column("allocationt",       "To",                5);
  $tb_event->add_column("depot_namet",       "Depot To",         15);
  $tb_event->add_column("loco_usage",        "Usage",            33);

/***********************************************************************************************/
/*                                                                                             */
/* Stage 1: Get all locomotives from this class                                                */
/*                                                                                             */
/***********************************************************************************************/

  $sql = 'select "Reallocation"    AS record_type,
          e.loco_id         AS loco_id,
          en.number         AS number,
          concat("locoqry.php?action=locodata&id=", en.loco_id,"&type=E&loco=", en.number)
                            AS number_hl,
          coalesce(dpc1.displayed_depot_code, ea1.allocation)    AS allocationf,
          concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                            AS allocationf_hl,
          dp1.depot_name    AS depot_namef,
          concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                            AS depot_namef_hl,
          coalesce(dpc.displayed_depot_code, ea.allocation)      AS allocationt,
          concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                            AS allocationt_hl,
          dp.depot_name     AS depot_namet,
          concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                            AS depot_namet_hl,
          CASE WHEN ea.loan_allocation IS NOT NULL THEN
            1
          else
            0
          END               AS loan_ind,
          ea.loco_usage     AS loco_usage,
          ea.alloc_date     AS status_date
   from   e_alloc ea
   join   e_nums en
   on     en.loco_id = ea.loco_id
   and    en.start_date =  (SELECT max(en1.start_date)
                            FROM   e_nums en1
                            WHERE  en1.loco_id = en.loco_id
                            AND    en1.start_date <= ea.alloc_date)
   join   ref_depot_codes dpc
   on     dpc.depot_code = coalesce(ea.loan_allocation, ea.allocation)
   and    dpc.date_from =  (SELECT max(dpca.date_from)
                            FROM   ref_depot_codes dpca
                            WHERE  dpca.depot_code = dpc.depot_code
                            AND    dpca.date_from <= ea.alloc_date)
   join   ref_depot dp
   on     dp.depot_id = dpc.depot_id
   join   electric e
   on     e.loco_id = ea.loco_id
   and    e.b_date <> ea.alloc_date
   join   e_class_link ecl
   on     ecl.loco_id = ea.loco_id
   and    ecl.start_date = (SELECT max(ecl1.start_date)
                            FROM   e_class_link ecl1
                            WHERE  ecl1.loco_id = ecl.loco_id
                            AND    ecl1.start_date <= ea.alloc_date)

   LEFT JOIN e_alloc ea1
   ON     ea1.loco_id = ea.loco_id
   AND    concat(ea1.alloc_date, ea1.seq) = (SELECT MAX(concat(ea1a.alloc_date,
                                                               ea1a.seq))
                                             FROM   e_alloc ea1a
                                             WHERE (ea1a.alloc_date < ea.alloc_date
                                                OR     (ea1a.alloc_date = ea.alloc_date
                                                    AND ea1a.seq        < ea.seq))
                                             AND    ea1a.loco_id = ea.loco_id)
   LEFT JOIN ref_depot_codes dpc1
   ON     dpc1.depot_code = ea1.allocation
   AND    dpc1.date_from = (SELECT max(dpcb.date_from)
                            FROM   ref_depot_codes dpcb
                            WHERE  dpcb.depot_code = ea1.allocation
                            AND    dpcb.date_from <= ea1.alloc_date)

   LEFT JOIN ref_depot dp1
   ON     dp1.depot_id = dpc1.depot_id

   where  ecl.e_class_id = ' . $id . '

   union all

   select "<font color=\"green\"><strong>To Service</strong></font>"
                            AS record_type,
          e.loco_id         AS loco_id,
          en.number         AS number,
          concat("locoqry.php?action=locodata&id=", en.loco_id,"&type=E&loco=", en.number)
                            AS number_hl,
          NULL              AS allocationf,
          NULL              AS allocationf_hl,
          "<font color=\"green\"><strong>NEW</strong></font>"
                            AS depot_namef,
          NULL              AS depot_namef_hl,
          coalesce(dpc.displayed_depot_code, e.first_depot)     AS allocationt,
          concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                            AS allocationt_hl,
          dp.depot_name     AS depot_namet,
          concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                            AS depot_namet_hl,
          0                 AS loan_ind,
          NULL              AS loco_usage,
          e.b_date          AS status_date
   from   electric e
   join   e_nums en
   on     en.loco_id = e.loco_id
   and    en.start_date =  (SELECT max(en1.start_date)
                            FROM   e_nums en1
                            WHERE  en1.loco_id = en.loco_id
                            AND    en1.start_date <= e.b_date)
   join   ref_depot_codes dpc
   on     dpc.depot_code =  e.first_depot
   and    dpc.date_from =  (SELECT max(dpc1.date_from)
                            FROM   ref_depot_codes dpc1
                            WHERE  dpc1.depot_code = dpc.depot_code
                            AND    dpc1.date_from <= e.b_date)
   join   ref_depot dp
   on     dp.depot_id = dpc.depot_id
   join   e_class_link ecl
   on     ecl.loco_id = e.loco_id
   and    ecl.start_date = (SELECT max(ecl1.start_date)
                            FROM   e_class_link ecl1
                            WHERE  ecl1.loco_id = ecl.loco_id
                            AND    ecl1.start_date <= e.b_date)
   where  ecl.e_class_id = ' . $id . '

   union all

   select "<font color=\"red\"><strong>Condemned</strong></font>"
                            AS record_type,
          e.loco_id         AS loco_id,
          en.number         AS number,
          concat("locoqry.php?action=locodata&id=", en.loco_id,"&type=E&loco=", en.number)
                            AS number_hl,
          coalesce(dpc1.displayed_depot_code, ea1.allocation)    AS allocationf,
          concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                            AS allocationf_hl,
          dp1.depot_name    AS depot_namef,
          concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                            AS depot_namef_hl,
          NULL              AS allocationt,
          NULL              AS allocationt_hl,
          "<font color=\"red\"><strong>COND</strong></font>"
                            AS depot_namet,
          NULL              AS depot_namet_hl,
          0                 AS loan_ind,
          NULL              AS loco_usage,
          e.w_date          AS status_date
   from   electric e
   join   e_nums en
   on     en.loco_id = e.loco_id
   and    en.start_date =  (SELECT max(en1.start_date)
                            FROM   e_nums en1
                            WHERE  en1.loco_id = en.loco_id
                            AND    en1.start_date <= e.w_date)
   join   e_class_link ecl
   on     ecl.loco_id = e.loco_id
   and    ecl.start_date = (SELECT max(ecl1.start_date)
                            FROM   e_class_link ecl1
                            WHERE  ecl1.loco_id = ecl.loco_id
                            AND    ecl1.start_date <= e.w_date)

   LEFT JOIN e_alloc ea1
   ON     ea1.loco_id = e.loco_id
   AND    concat(ea1.alloc_date, ea1.seq) = (SELECT MAX(concat(ea1a.alloc_date,
                                                               ea1a.seq))
                                             FROM   e_alloc ea1a
                                             WHERE  ea1a.alloc_date < e.w_date
                                             AND    ea1a.loco_id = e.loco_id)
   LEFT JOIN ref_depot_codes dpc1
   ON     dpc1.depot_code = ea1.allocation
   AND    dpc1.date_from = (SELECT max(dpc1a.date_from)
                            FROM   ref_depot_codes dpc1a
                            WHERE  dpc1a.depot_code = ea1.allocation
                            AND    dpc1a.date_from <= ea1.alloc_date)

   LEFT JOIN ref_depot dp1
   ON     dp1.depot_id = dpc1.depot_id

   where  ecl.e_class_id = ' . $id . '

   order by status_date, loco_id';


  //echo $sql;

  $result = $db->execute($sql);

  $last_inc_id = -1;
  if ($db->count_select())
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['status_date'] = fn_fdate($row['status_date']);
      $tb_event->add_data($row);
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/*                                                                                             */
/***********************************************************************************************/

  if ($db->count_select())
    $tb_event->draw_table();
?>
