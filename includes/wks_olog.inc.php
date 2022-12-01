<?php

  echo "<div id=\"navcontainer\">";
  echo "<ul id=\"navlist\">";
  echo "<li><a href=\"sites.php?page=works&subpage=main&id="   .$id. "\">Works Details</a></li>";
  echo "<li><a href=\"sites.php?page=works&subpage=locos&id="  .$id. "\">Locos Built</a></li>";
  echo "<li><a href=\"sites.php?page=works&subpage=orders&id=" .$id. "\">Orders</a></li>";
  if ($vlog > 0)
    echo "<li><a href=\"sites.php?page=works&subpage=vlog&id=" .$id. "\">Visit Log</a></li>";
  echo "<li id=\"active\"><a href=\"#\" id=\"current\">Overhauls</a></li>";
  if ($snap > 0)
    echo "<li><a href=\"sites.php?page=works&subpage=snap&id=" .$id. "\">Snapshot</a></li>";
  echo "</ul>";
  echo "</div>";

  $sql = 'SELECT *
          FROM   tdw_wks_overhaul
          WHERE  bl_code = "' .$id. '"
          ORDER BY coalesce(visit_start, visit_end) ASC';

/*
  $sql = 'SELECT wv.type,
                 wv.loco_id,
                 dn.number,
                 concat("locoqry.php?action=locodata&id=", wv.loco_id,
                        "&type=D&loco=", dn.number) AS number_hl,
                 dn.number_type,
                 da.allocation,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                                    AS allocation_hl,
                 dp.depot_name,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                                    AS depot_name_hl,
                 vt.description                     AS visit_desc,
                 wv.reason_text,
                 wv.start_date                      AS visit_start,
                 wv.end_date                        AS visit_end,
                 wv.mileage,
                 wv.duration,
                 NULL                               AS durn,
                 NULL                               AS durn_fmt
          FROM   works_visits wv
          JOIN   ref_visit_type vt
          ON     vt.visit_code = wv.visit_code
          JOIN   d_nums dn
          ON     dn.loco_id = wv.loco_id
          AND    dn.carried_number = "Y"
          AND    dn.start_date = (SELECT max(dn1.start_date)
                                  FROM   d_nums dn1
                                  WHERE  dn1.loco_id = dn.loco_id
                                  AND    dn1.carried_number = "Y"
                                  AND    dn1.start_date <= coalesce(wv.start_date, wv.end_date))
          LEFT JOIN d_alloc da
          ON     da.loco_id = wv.loco_id
          AND    da.alloc_date = (SELECT max(da1.alloc_date)
                                  FROM   d_alloc da1
                                  WHERE  da1.loco_id = da.loco_id
                                  AND    da1.alloc_date <= coalesce(wv.start_date, wv.end_date))
          LEFT JOIN ref_depot_codes dpc
          ON     dpc.depot_code = da.allocation
          AND    dpc.date_from = (SELECT max(dpc1.date_from)
                                  FROM   ref_depot_codes dpc1
                                  WHERE  dpc1.depot_code = da.allocation
                                  AND    dpc1.date_from <= da.alloc_date)
          LEFT JOIN ref_depot dp
          ON     dp.depot_id = dpc.depot_id
          WHERE  wv.type = "D"
          AND    wv.bl_code = "' .$id. '"
          UNION
          SELECT wv.type,
                 wv.loco_id,
                 sn.number,
                 concat("locoqry.php?action=locodata&id=", wv.loco_id,
                        "&type=S&loco=", sn.number) AS number_hl,
                 sn.number_type,
                 sa.allocation,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                                    AS allocation_hl,
                 dp.depot_name,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                                    AS depot_name_hl,
                 vt.description                     AS visit_desc,
                 wv.reason_text,
                 wv.start_date                      AS visit_start,
                 wv.end_date                        AS visit_end,
                 wv.mileage,
                 wv.duration,
                 NULL                               AS durn,
                 NULL                               AS durn_fmt
          FROM   works_visits wv
          JOIN   ref_visit_type vt
          ON     vt.visit_code = wv.visit_code
          JOIN   s_nums sn
          ON     sn.loco_id = wv.loco_id
          AND    sn.carried_number = "Y"
          AND    sn.start_date = (SELECT max(sn1.start_date)
                                  FROM   s_nums sn1
                                  WHERE  sn1.loco_id = sn.loco_id
                                  AND    sn1.carried_number = "Y"
                                  AND    sn1.start_date <= coalesce(wv.start_date, wv.end_date))
          LEFT JOIN s_alloc sa
          ON     sa.loco_id = wv.loco_id
          AND    sa.alloc_date = (SELECT max(sa1.alloc_date)
                                  FROM   s_alloc sa1
                                  WHERE  sa1.loco_id = sa.loco_id
                                  AND    sa1.alloc_date <= coalesce(wv.start_date, wv.end_date))
          LEFT JOIN ref_depot_codes dpc
          ON     dpc.depot_code = sa.allocation
          AND    dpc.date_from = (SELECT max(dpc1.date_from)
                                  FROM   ref_depot_codes dpc1
                                  WHERE  dpc1.depot_code = sa.allocation
                                  AND    dpc1.date_from <= sa.alloc_date)
          LEFT JOIN ref_depot dp
          ON     dp.depot_id = dpc.depot_id
          WHERE  wv.type = "S"
          AND    wv.bl_code = "' .$id. '"
          UNION
          SELECT wv.type,
                 wv.loco_id,
                 en.number,
                 concat("locoqry.php?action=locodata&id=", wv.loco_id,
                        "&type=E&loco=", en.number) AS number_hl,
                 en.number_type,
                 ea.allocation,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                                    AS allocation_hl,
                 dp.depot_name,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                                    AS depot_name_hl,
                 vt.description                     AS visit_desc,
                 wv.reason_text,
                 wv.start_date                      AS visit_start,
                 wv.end_date                        AS visit_end,
                 wv.mileage,
                 wv.duration,
                 NULL                               AS durn,
                 NULL                               AS durn_fmt
          FROM   works_visits wv
          JOIN   ref_visit_type vt
          ON     vt.visit_code = wv.visit_code
          JOIN   e_nums en
          ON     en.loco_id = wv.loco_id
          AND    en.carried_number = "Y"
          AND    en.start_date = (SELECT max(en1.start_date)
                                  FROM   e_nums en1
                                  WHERE  en1.loco_id = en.loco_id
                                  AND    en1.carried_number = "Y"
                                  AND    en1.start_date <= coalesce(wv.start_date, wv.end_date))
          LEFT JOIN e_alloc ea
          ON     ea.loco_id = wv.loco_id
          AND    ea.alloc_date = (SELECT max(ea1.alloc_date)
                                  FROM   e_alloc ea1
                                  WHERE  ea1.loco_id = ea.loco_id
                                  AND    ea1.alloc_date <= coalesce(wv.start_date, wv.end_date))
          LEFT JOIN ref_depot_codes dpc
          ON     dpc.depot_code = ea.allocation
          AND    dpc.date_from = (SELECT max(dpc1.date_from)
                                  FROM   ref_depot_codes dpc1
                                  WHERE  dpc1.depot_code = ea.allocation
                                  AND    dpc1.date_from <= ea.alloc_date)
          LEFT JOIN ref_depot dp
          ON     dp.depot_id = dpc.depot_id
          WHERE  wv.type = "E"
          AND    wv.bl_code = "' .$id. '"
          ORDER  BY coalesce(visit_start, visit_end) ASC';
*/
  // echo $sql . "<br />";

  $result = $db->execute($sql);

  $tigs = new MyTables("overhauls");
  $tigs->sortable();
  $tigs->colour_coordinate("Y");
  $tigs->add_caption("Overhauls: " . $wks_name);
  $tigs->add_column("number",               "Number",       6);
  $tigs->add_column("allocation",           "Code",         5);
  $tigs->add_column("depot_name",           "Depot",        15);
  $tigs->add_column("visit_start",          "Into Works",   11);
  $tigs->add_column("visit_end",            "Out of Works", 11);
  $tigs->add_column("durn",                 "Durn",         6);
  $tigs->add_column("visit_desc",           "Level",        13);
  $tigs->add_column("reason_text",          "Reason",       23);
  $tigs->add_column("mileage",              "Mileage",      7);

  while ($row = mysqli_fetch_assoc($result))
  {
    $row['mileage'] = fn_ncomma($row['mileage']);
    if (!empty($row['duration']))
    {
      $row['durn'] = $row['duration'] . " days";
      $row['durn_fmt'] = $row['duration'];
    }
    $row['visit_start'] = fn_fdate($row['visit_start']);
    $row['visit_end']   = fn_fdate($row['visit_end']);
    if ($row['type'] == 'D')
      $row['number'] = fn_d_pfx($row['number']);
  
    if (!empty($row['dayname']))
      $row['visit_date'] .= " (" . $row['dayname'] . ")";

    $tigs->add_data($row);
  }

  $tigs->draw_table();
  $tigs = ""; $row = "";

  $db->close();
?>
