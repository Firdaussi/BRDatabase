<?php
  include_once("lib/brlib.php");

/***********************************************************************************************/
/*                                                                                             */
/* Stage 0: Preliminaries - set up tables and work out parameters                              */
/*                                                                                             */
/***********************************************************************************************/
  include_once("lib/MyTables.class.php");

  include_once("lib/cache.class.php");
  /**
   * call the class after the include
   */
  $file_cache=new cache();
  $file_cache->start_cache();

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
          s.loco_id         AS loco_id,
          sn.number         AS number,
          concat("locoqry.php?action=locodata&id=", sn.loco_id,"&type=S&loco=", sn.number)
                            AS number_hl,
          sa1.allocation    AS allocationf,
          concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                            AS allocationf_hl,
          dp1.depot_name    AS depot_namef,
          concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                            AS depot_namef_hl,
          sa.allocation     AS allocationt,
          concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                            AS allocationt_hl,
          dp.depot_name     AS depot_namet,
          concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                            AS depot_namet_hl,
          CASE WHEN sa.loan_allocation IS NOT NULL THEN
            1
          else
            0
          END               AS loan_ind,
          sa.loco_usage     AS loco_usage,
          sa.alloc_date     AS status_date
   from   s_alloc sa
   join   s_nums sn
   on     sn.loco_id = sa.loco_id
   and    sn.start_date =  (SELECT max(sn1.start_date)
                            FROM   s_nums sn1
                            WHERE  sn1.loco_id = sn.loco_id
                            AND    sn1.start_date <= sa.alloc_date)
   join   ref_depot_codes dpc
   on     dpc.depot_code = coalesce(sa.loan_allocation, sa.allocation)
   and    dpc.date_from =  (SELECT max(dpc1.date_from)
                            FROM   ref_depot_codes dpc1
                            WHERE  dpc1.depot_code = dpc.depot_code
                            AND    dpc1.date_from <= sa.alloc_date)
   join   ref_depot dp
   on     dp.depot_id = dpc.depot_id
   join   steam s
   on     s.loco_id = sa.loco_id
   and    s.b_date <> sa.alloc_date
   join   s_class_link scl
   on     scl.loco_id = sa.loco_id
   and    scl.start_date = (SELECT max(scl1.start_date)
                            FROM   s_class_link scl1
                            WHERE  scl1.loco_id = scl.loco_id
                            AND    scl1.start_date <= sa.alloc_date)

   LEFT JOIN s_alloc sa1
   ON     sa1.loco_id = sa.loco_id
   AND    concat(sa1.alloc_date, sa1.seq) = (SELECT MAX(concat(sa1a.alloc_date,
                                                               sa1a.seq))
                                             FROM   s_alloc sa1a
                                             WHERE (sa1a.alloc_date < sa.alloc_date
                                                OR     (sa1a.alloc_date = sa.alloc_date
                                                    AND sa1a.seq        < sa.seq))
                                             AND    sa1a.loco_id = sa.loco_id)
   LEFT JOIN ref_depot_codes dpc1
   ON     dpc1.depot_code = sa1.allocation
   AND    dpc1.date_from = (SELECT max(dpc1a.date_from)
                            FROM   ref_depot_codes dpc1a
                            WHERE  dpc1a.depot_code = sa1.allocation
                            AND    dpc1a.date_from <= sa1.alloc_date)

   LEFT JOIN ref_depot dp1
   ON     dp1.depot_id = dpc1.depot_id

   where  scl.s_class_id = ' . $id . '

   union all

   select "<font color=\"green\"><strong>To Service</strong></font>"
                            AS record_type,
          s.loco_id         AS loco_id,
          sn.number         AS number,
          concat("locoqry.php?action=locodata&id=", sn.loco_id,"&type=S&loco=", sn.number)
                            AS number_hl,
          NULL              AS allocationf,
          NULL              AS allocationf_hl,
          "<font color=\"green\"><strong>NEW</strong></font>"
                            AS depot_namef,
          NULL              AS depot_namef_hl,
          s.first_depot     AS allocationt,
          concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                            AS allocationt_hl,
          dp.depot_name     AS depot_namet,
          concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                            AS depot_namet_hl,
          0                 AS loan_ind,
          NULL              AS loco_usage,
          s.b_date          AS status_date
   from   steam s
   join   s_nums sn
   on     sn.loco_id = s.loco_id
   and    sn.start_date =  (SELECT max(sn1.start_date)
                            FROM   s_nums sn1
                            WHERE  sn1.loco_id = sn.loco_id
                            AND    sn1.start_date <= s.b_date)
   join   ref_depot_codes dpc
   on     dpc.depot_code =  s.first_depot
   and    dpc.date_from =  (SELECT max(dpc1.date_from)
                            FROM   ref_depot_codes dpc1
                            WHERE  dpc1.depot_code = dpc.depot_code
                            AND    dpc1.date_from <= s.b_date)
   join   ref_depot dp
   on     dp.depot_id = dpc.depot_id
   join   s_class_link scl
   on     scl.loco_id = s.loco_id
   and    scl.start_date = (SELECT max(scl1.start_date)
                            FROM   s_class_link scl1
                            WHERE  scl1.loco_id = scl.loco_id
                            AND    scl1.start_date <= s.b_date)
   where  scl.s_class_id = ' . $id . '

   union all

   select "<font color=\"red\"><strong>Condemned</strong></font>"
                            AS record_type,
          s.loco_id         AS loco_id,
          sn.number         AS number,
          concat("locoqry.php?action=locodata&id=", sn.loco_id,"&type=S&loco=", sn.number)
                            AS number_hl,
          sa1.allocation    AS allocationf,
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
          s.w_date          AS status_date
   from   steam s
   join   s_nums sn
   on     sn.loco_id = s.loco_id
   and    sn.start_date =  (SELECT max(sn1.start_date)
                            FROM   s_nums sn1
                            WHERE  sn1.loco_id = sn.loco_id
                            AND    sn1.start_date <= s.w_date)
   join   s_class_link scl
   on     scl.loco_id = s.loco_id
   and    scl.start_date = (SELECT max(scl1.start_date)
                            FROM   s_class_link scl1
                            WHERE  scl1.loco_id = scl.loco_id
                            AND    scl1.start_date <= s.w_date)

   LEFT JOIN s_alloc sa1
   ON     sa1.loco_id = s.loco_id
   AND    concat(sa1.alloc_date, sa1.seq) = (SELECT MAX(concat(sa1a.alloc_date,
                                                               sa1a.seq))
                                             FROM   s_alloc sa1a
                                             WHERE  sa1a.alloc_date < s.w_date
                                             AND    sa1a.loco_id = s.loco_id)
   LEFT JOIN ref_depot_codes dpc1
   ON     dpc1.depot_code = sa1.allocation
   AND    dpc1.date_from = (SELECT max(dpc1a.date_from)
                            FROM   ref_depot_codes dpc1a
                            WHERE  dpc1a.depot_code = sa1.allocation
                            AND    dpc1a.date_from <= sa1.alloc_date)

   LEFT JOIN ref_depot dp1
   ON     dp1.depot_id = dpc1.depot_id

   where  scl.s_class_id = ' . $id . '

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

  $file_cache->end_cache();
?>
