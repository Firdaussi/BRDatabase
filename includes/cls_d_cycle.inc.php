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
          d.loco_id         AS loco_id,
          dn.number         AS number,
          concat("locoqry.php?action=locodata&id=", dn.loco_id,"&type=D&loco=", dn.number)
                            AS number_hl,
          da1.allocation    AS allocationf,
          concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                            AS allocationf_hl,
          dp1.depot_name    AS depot_namef,
          concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                            AS depot_namef_hl,
          da.allocation     AS allocationt,
          concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                            AS allocationt_hl,
          dp.depot_name     AS depot_namet,
          concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                            AS depot_namet_hl,
          CASE WHEN da.loan_allocation IS NOT NULL THEN
            1
          else
            0
          END               AS loan_ind,
          da.loco_usage     AS loco_usage,
          da.alloc_date     AS status_date
   from   d_alloc da
   join   d_nums dn
   on     dn.loco_id = da.loco_id
   and    dn.start_date =  (SELECT max(dn1.start_date)
                            FROM   d_nums dn1
                            WHERE  dn1.loco_id = dn.loco_id
                            AND    dn1.start_date <= da.alloc_date)
   join   ref_depot_codes dpc
   on     dpc.depot_code = coalesce(da.loan_allocation, da.allocation)
   and    dpc.date_from =  (SELECT max(dpc1.date_from)
                            FROM   ref_depot_codes dpc1
                            WHERE  dpc1.depot_code = dpc.depot_code
                            AND    dpc1.date_from <= da.alloc_date)
   join   ref_depot dp
   on     dp.depot_id = dpc.depot_id
   join   diesels d
   on     d.loco_id = da.loco_id
   and    d.b_date <> da.alloc_date
   join   d_class_link dcl
   on     dcl.loco_id = da.loco_id
   and    dcl.start_date = (SELECT max(dcl1.start_date)
                            FROM   d_class_link dcl1
                            WHERE  dcl1.loco_id = dcl.loco_id
                            AND    dcl1.start_date <= da.alloc_date)

   LEFT JOIN d_alloc da1
   ON     da1.loco_id = da.loco_id
   AND    concat(da1.alloc_date, da1.seq) = (SELECT MAX(concat(da1a.alloc_date,
                                                               da1a.seq))
                                             FROM   d_alloc da1a
                                             WHERE (da1a.alloc_date < da.alloc_date
                                                OR     (da1a.alloc_date = da.alloc_date
                                                    AND da1a.seq        < da.seq))
                                             AND    da1a.loco_id = da.loco_id)
   LEFT JOIN ref_depot_codes dpc1
   ON     dpc1.depot_code = da1.allocation
   AND    dpc1.date_from = (SELECT max(dpc1a.date_from)
                            FROM   ref_depot_codes dpc1a
                            WHERE  dpc1a.depot_code = da1.allocation
                            AND    dpc1a.date_from <= da1.alloc_date)

   LEFT JOIN ref_depot dp1
   ON     dp1.depot_id = dpc1.depot_id

   where  dcl.d_class_id = ' . $id . '

   union all

   select "<font color=\"green\"><strong>To Service</strong></font>"
                            AS record_type,
          d.loco_id         AS loco_id,
          dn.number         AS number,
          concat("locoqry.php?action=locodata&id=", dn.loco_id,"&type=D&loco=", dn.number)
                            AS number_hl,
          NULL              AS allocationf,
          NULL              AS allocationf_hl,
          "<font color=\"green\"><strong>NEW</strong></font>"
                            AS depot_namef,
          NULL              AS depot_namef_hl,
          d.first_depot     AS allocationt,
          concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                            AS allocationt_hl,
          dp.depot_name     AS depot_namet,
          concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                            AS depot_namet_hl,
          0                 AS loan_ind,
          NULL              AS loco_usage,
          d.b_date          AS status_date
   from   diesels d
   join   d_nums dn
   on     dn.loco_id = d.loco_id
   and    dn.start_date =  (SELECT max(dn1.start_date)
                            FROM   d_nums dn1
                            WHERE  dn1.loco_id = dn.loco_id
                            AND    dn1.start_date <= d.b_date)
   join   ref_depot_codes dpc
   on     dpc.depot_code =  d.first_depot
   and    dpc.date_from =  (SELECT max(dpc1.date_from)
                            FROM   ref_depot_codes dpc1
                            WHERE  dpc1.depot_code = dpc.depot_code
                            AND    dpc1.date_from <= d.b_date)
   join   ref_depot dp
   on     dp.depot_id = dpc.depot_id
   join   d_class_link dcl
   on     dcl.loco_id = d.loco_id
   and    dcl.start_date = (SELECT max(dcl1.start_date)
                            FROM   d_class_link dcl1
                            WHERE  dcl1.loco_id = dcl.loco_id
                            AND    dcl1.start_date <= d.b_date)
   where  dcl.d_class_id = ' . $id . '

   union all

   select "<font color=\"red\"><strong>Condemned</strong></font>"
                            AS record_type,
          d.loco_id         AS loco_id,
          dn.number         AS number,
          concat("locoqry.php?action=locodata&id=", dn.loco_id,"&type=D&loco=", dn.number)
                            AS number_hl,
          da1.allocation    AS allocationf,
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
          d.w_date          AS status_date
   from   diesels d
   join   d_nums dn
   on     dn.loco_id = d.loco_id
   and    dn.start_date =  (SELECT max(dn1.start_date)
                            FROM   d_nums dn1
                            WHERE  dn1.loco_id = dn.loco_id
                            AND    dn1.start_date <= d.w_date)
   join   d_class_link dcl
   on     dcl.loco_id = d.loco_id
   and    dcl.start_date = (SELECT max(dcl1.start_date)
                            FROM   d_class_link dcl1
                            WHERE  dcl1.loco_id = dcl.loco_id
                            AND    dcl1.start_date <= d.w_date)

   LEFT JOIN d_alloc da1
   ON     da1.loco_id = d.loco_id
   AND    concat(da1.alloc_date, da1.seq) = (SELECT MAX(concat(da1a.alloc_date,
                                                               da1a.seq))
                                             FROM   d_alloc da1a
                                             WHERE  da1a.alloc_date < d.w_date
                                             AND    da1a.loco_id = d.loco_id)
   LEFT JOIN ref_depot_codes dpc1
   ON     dpc1.depot_code = da1.allocation
   AND    dpc1.date_from = (SELECT max(dpc1a.date_from)
                            FROM   ref_depot_codes dpc1a
                            WHERE  dpc1a.depot_code = da1.allocation
                            AND    dpc1a.date_from <= da1.alloc_date)

   LEFT JOIN ref_depot dp1
   ON     dp1.depot_id = dpc1.depot_id

   where  dcl.d_class_id = ' . $id . '

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
