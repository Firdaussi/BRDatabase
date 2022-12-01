<?php
  echo "<div id=\"navcontainer\">";
  echo "<ul id=\"navlist\">";
  echo "<li><a href=\"sites.php?page=depots&subpage=main&id="  .$id. "\">Depot Details</a></li>";
  echo "<li><a href=\"sites.php?page=depots&subpage=locos&id="  .$id. "\">Locos Allocated</a></li>";
  echo "<li><a href=\"sites.php?page=depots&subpage=snap&id="  .$id. "\">Snapshot</a></li>";
  echo "<li id=\"active\"><a href=\"#\" id=\"current\">Arrivals/Departures</a></li>";
  if ($vlog > 0)
    echo "<li><a href=\"sites.php?page=depots&amp;subpage=vlog&amp;id="  .$id. "\">Visit Log</a></li>";
  if ($imgct > 0)
    echo "<li><a href=\"sites.php?page=depots&subpage=gallery&id="  .$id. "\">Gallery</a></li>";
  echo "</ul>";
  echo "</div>";

  include_once("lib/cache.class.php");
  /**
   * call the class after the include
   */
  $file_cache=new cache();
  $file_cache->start_cache();

  $tb = new MyTables("depot_allocations");

//$tb->sortable();
  
  $tb->colour_coordinate("Y");

  $tb->add_column("long_type",           "Type",              4);
  $tb->add_column("class_type",          "Class",             4);
  $tb->add_column("wheel_arr",           "Wheels",            5);
  $tb->add_column("period",              "Period",            5);
  $tb->add_column("alloc_date",          "Date",             10);
  $tb->add_column("number",              "Number",            7);
  $tb->add_column("movement",            "Event",            12);
  $tb->add_column("chg_allocation",      "Code",              4);
  $tb->add_column("chg_depot_name",      "Depot ",           20);
  $tb->add_column("stayed",              "Length of Stay",   10);
  $tb->add_column("info",                "Notes",            19);

  $sql = 'SELECT *
          FROM   tdw_dep_arrdep
          WHERE  depot_id = ' . $id . '
          ORDER BY concat(alloc_date, seq), movement, number';

/*
  $sql = 'DROP TABLE tdw_dep_arrdep;
  
          CREATE TABLE tdw_dep_arrdep AS
          SELECT "Steam"                 AS long_type,
                 "S"                     AS type,
                 CASE WHEN sa.alloc_flag = "N"
                   THEN "<span id=do_green>1st Allocation</span>"
                      WHEN sa.alloc_flag = "R"
                   THEN "Reinstated"
                      ELSE
                        CASE WHEN sa.snapshot = "Y"
                          THEN "<span id=do_italics>Snapshot</span>"
                        ELSE
                               "Transfer in from: "
                        END
                 END                     AS movement,
                 "fmt_green"             AS movement_col,
                 sa.loco_id              As loco_id,
                 sa.alloc_date           AS alloc_date,
                 sa.allocation           AS allocation,
                 dp.depot_name           AS depot_name,
                 coalesce(dpc_prev.displayed_depot_code,
                          dpc_prev.depot_code)     AS chg_allocation,
                 sa.seq                  AS seq,
                 sa.period               AS period,
                 CONCAT("sites.php?page=depots&action=query&id=", dep_prev.depot_id) 
                                         AS chg_allocation_hl,
                 dep_prev.depot_name     AS chg_depot_name,
                 CONCAT("sites.php?page=depots&action=query&id=", dep_prev.depot_id) 
                                         AS chg_depot_name_hl,
                 sa.period               AS alloc_period,
                 sa.seq                  AS alloc_seq,
                 sn.number               AS number,
                 CONCAT("locoqry.php?action=locodata&id=", sa.loco_id, "&type=S&loco=", sn.number)
                                         AS number_hl,
                 sn.number_type          AS number_type,
                 IFNULL(sc.common_name, sc.identifier) 
                                         AS class_type,
                 concat("locoqry.php?action=class&type=S&id=",sc.s_class_id) 
                                         AS class_type_hl,
                 sc.wheel_arrangement    AS wheel_arr,
                 CONCAT("misc.php?page=wheel_arr&id=", sc.wheel_arrangement) 
                                        AS wheel_arr_hl
          FROM   s_alloc sa

          JOIN   s_nums sn
          ON     sn.loco_id = sa.loco_id
          AND    sn.start_date =    (SELECT max(sna.start_date)
                                     FROM   s_nums sna
                                     WHERE  sna.loco_id = sa.loco_id
                                     AND    sna.start_date <= sa.alloc_date)

          JOIN   ref_depot_codes dpc
          ON     dpc.depot_code = sa.allocation
          AND    dpc.date_from =    (SELECT max(dpc2a.date_from)
                                     FROM   ref_depot_codes dpc2a
                                     WHERE  dpc2a.depot_code = sa.allocation
                                     AND    dpc2a.date_from <= sa.alloc_date)

          JOIN   ref_depot dp
          ON     dp.depot_id = dpc.depot_id

          LEFT JOIN s_alloc sa_prev
          ON     sa_prev.loco_id = sa.loco_id
          AND    concat(sa_prev.alloc_date, sa_prev.seq) = 
                                    (SELECT MAX(concat(sa_preva.alloc_date, sa_preva.seq))
                                     FROM   s_alloc sa_preva
                                     WHERE (sa_preva.alloc_date < sa.alloc_date
                                            OR     (sa_preva.alloc_date = sa.alloc_date
                                                AND sa_preva.seq        < sa.seq))
                                     AND    sa_preva.loco_id = sa.loco_id)

          LEFT JOIN ref_depot_codes dpc_prev
          ON     dpc_prev.depot_code = sa_prev.allocation
          AND    dpc_prev.date_from = 
                                    (SELECT max(dpc_preva.date_from)
                                     FROM   ref_depot_codes dpc_preva
                                     WHERE  dpc_preva.depot_code = sa_prev.allocation
                                     AND    dpc_preva.date_from <= sa_prev.alloc_date)

          LEFT JOIN ref_depot dep_prev
          ON     dep_prev.depot_id = dpc_prev.depot_id
    
          JOIN   s_class_link scl
          ON     scl.loco_id = sa.loco_id
          AND    scl.start_date =   (SELECT max(scla.start_date)
                                     FROM   s_class_link scla
                                     WHERE  scla.loco_id = sa.loco_id
                                     AND    scla.start_date <= sa.alloc_date)

          JOIN   s_class sc
          ON     sc.s_class_id = scl.s_class_id

          JOIN   s_class_var scv
          ON     scv.s_class_id = scl.s_class_id
          AND    scv.s_class_var_id = scl.s_class_var_id

          UNION

          SELECT "Steam"                 AS long_type,
                 "S"                     AS type,
                 CASE WHEN sa_next.alloc_flag = "W"
                   THEN "<span id=do_red>Condemned</span>"
                      WHEN sa_next.alloc_flag = "S"
                   THEN "To Store"
                      ELSE
                        CASE WHEN sa_next.snapshot = "Y"
                          THEN "<span id=do_italics>Snapshot</span>"
                            ELSE
                               "Transfer out to:"
                        END
                 END                     AS movement,
                 "fmt_red"               AS movement_col,
                 sa.loco_id              AS loco_id,
                 sa_next.alloc_date      AS alloc_date,
                 NULL                    AS allocation,
                 NULL                    AS depot_name,
                 coalesce(dpc_next.displayed_depot_code,
                          dpc_next.depot_code)     AS chg_allocation,
                 sa_next.seq             AS seq,
                 sa_next.period          AS period,
                 CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                         AS chg_allocation_hl,
                 dp3.depot_name          AS chg_depot_name,
                 CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                         AS chg_depot_name_hl,
                 sa_next.period          AS alloc_period,
                 sa_next.seq             AS alloc_seq,
                 sn.number               AS number,
                 CONCAT("locoqry.php?action=locodata&id=", sa.loco_id, "&type=S&loco=", sn.number)
                                         AS number_hl,
                 sn.number_type          AS number_type,
                 IFNULL(sc.common_name, sc.identifier) 
                                         AS class_type,
                 concat("locoqry.php?action=class&type=S&id=",sc.s_class_id) 
                                         AS class_type_hl,
                 sc.wheel_arrangement    AS wheel_arr,
                 CONCAT("misc.php?page=wheel_arr&id=", sc.wheel_arrangement) 
                                        AS wheel_arr_hl

          FROM   s_alloc sa
          
          JOIN s_alloc sa_next
          ON     sa_next.loco_id = sa.loco_id
          AND    concat(sa_next.alloc_date, sa_next.seq) = 
                                    (SELECT MIN(concat(sa_nexta.alloc_date, sa_nexta.seq))
                                     FROM   s_alloc sa_nexta
                                     WHERE (sa_nexta.alloc_date > sa.alloc_date
                                            OR     (sa_nexta.alloc_date = sa.alloc_date
                                                AND sa_nexta.seq        > sa.seq))
                                     AND    sa_nexta.loco_id = sa.loco_id)

          JOIN   ref_depot_codes dpc2
          ON     dpc2.depot_code = sa.allocation
          AND    dpc2.date_from =   (SELECT max(dpc2a.date_from)
                                     FROM   ref_depot_codes dpc2a
                                     WHERE  dpc2a.depot_code = sa.allocation
                                     AND    dpc2a.date_from <= sa.alloc_date)

          JOIN   ref_depot dp2
          ON     dp2.depot_id = dpc2.depot_id

          LEFT JOIN ref_depot_codes dpc_next
          ON     dpc_next.depot_code = sa_next.allocation
          AND    dpc_next.date_from =   (SELECT max(dpc3a.date_from)
                                         FROM   ref_depot_codes dpc3a
                                         WHERE  dpc3a.depot_code = sa_next.allocation
                                         AND    dpc3a.date_from <= sa_next.alloc_date)

          LEFT JOIN ref_depot dp3
          ON     dp3.depot_id = dpc_next.depot_id
          
          JOIN   s_class_link scl
          ON     scl.loco_id = sa.loco_id
          AND    scl.start_date =   (SELECT max(scla.start_date)
                                     FROM   s_class_link scla
                                     WHERE  scla.loco_id = sa.loco_id
                                     AND    scla.start_date <= sa.alloc_date)

          JOIN   s_class sc
          ON     sc.s_class_id = scl.s_class_id

          JOIN   s_class_var scv
          ON     scv.s_class_id = scl.s_class_id
          AND    scv.s_class_var_id = scl.s_class_var_id
          
          JOIN   s_nums sn
          ON     sn.loco_id = sa.loco_id
          AND    sn.start_date =    (SELECT max(sna.start_date)
                                     FROM   s_nums sna
                                     WHERE  sna.loco_id = sa.loco_id
                                     AND    sna.start_date <= sa_next.alloc_date)

          UNION

          SELECT "Diesel"                AS long_type,
                 "D"                     AS type,
                 CASE WHEN da.alloc_flag = "N"
                   THEN "<span id=do_green>1st Allocation</span>"
                      WHEN da.alloc_flag = "R"
                   THEN "Reinstated"
                      ELSE
                        CASE WHEN da.snapshot = "Y"
                          THEN "<span id=do_italics>Snapshot</span>"
                            ELSE
                               "Transfer in from:"
                        END
                 END                     AS movement,
                 "fmt_green"             AS movement_col,
                 da.loco_id              As loco_id,
                 da.alloc_date           AS alloc_date,
                 da.allocation           AS allocation,
                 dp.depot_name           AS depot_name,
                 da_prev.allocation      AS chg_allocation,
                 da.seq                  AS seq,
                 da.period               AS period,
                 CONCAT("sites.php?page=depots&action=query&id=", dep_prev.depot_id) 
                                         AS chg_allocation_hl,
                 dep_prev.depot_name     AS chg_depot_name,
                 CONCAT("sites.php?page=depots&action=query&id=", dep_prev.depot_id) 
                                         AS chg_depot_name_hl,
                 da.period               AS alloc_period,
                 da.seq                  AS alloc_seq,
                 dn.number               AS number,
                 CONCAT("locoqry.php?action=locodata&id=", da.loco_id, "&type=D&loco=", dn.number)
                                         AS number_hl,
                 dn.number_type          AS number_type,
                 IFNULL(dc.common_name, dc.identifier) 
                                         AS class_type,
                 concat("locoqry.php?action=class&type=D&id=",dc.d_class_id) 
                                         AS class_type_hl,
                 dc.wheel_arrangement    AS wheel_arr,
                 CONCAT("misc.php?page=wheel_arr&id=", dc.wheel_arrangement) 
                                        AS wheel_arr_hl
          FROM   d_alloc da

          JOIN   d_nums dn
          ON     dn.loco_id = da.loco_id
          AND    dn.start_date =    (SELECT max(dna.start_date)
                                     FROM   d_nums dna
                                     WHERE  dna.loco_id = da.loco_id
                                     AND    dna.start_date <= da.alloc_date)

          JOIN   ref_depot_codes dpc
          ON     dpc.depot_code = da.allocation
          AND    dpc.date_from =    (SELECT max(dpc2a.date_from)
                                     FROM   ref_depot_codes dpc2a
                                     WHERE  dpc2a.depot_code = da.allocation
                                     AND    dpc2a.date_from <= da.alloc_date)

          JOIN   ref_depot dp
          ON     dp.depot_id = dpc.depot_id

          LEFT JOIN d_alloc da_prev
          ON     da_prev.loco_id = da.loco_id
          AND    concat(da_prev.alloc_date, da_prev.seq) = 
                                    (SELECT MAX(concat(da_preva.alloc_date, da_preva.seq))
                                     FROM   d_alloc da_preva
                                     WHERE (da_preva.alloc_date < da.alloc_date
                                            OR     (da_preva.alloc_date = da.alloc_date
                                                AND da_preva.seq        < da.seq))
                                     AND    da_preva.loco_id = da.loco_id)

          LEFT JOIN ref_depot_codes dpc_prev
          ON     dpc_prev.depot_code = da_prev.allocation
          AND    dpc_prev.date_from = 
                                    (SELECT max(dpc_preva.date_from)
                                     FROM   ref_depot_codes dpc_preva
                                     WHERE  dpc_preva.depot_code = da_prev.allocation
                                     AND    dpc_preva.date_from <= da_prev.alloc_date)

          LEFT JOIN ref_depot dep_prev
          ON     dep_prev.depot_id = dpc_prev.depot_id
    
          JOIN   d_class_link dcl
          ON     dcl.loco_id = da.loco_id
          AND    dcl.start_date =   (SELECT max(dcla.start_date)
                                     FROM   d_class_link dcla
                                     WHERE  dcla.loco_id = da.loco_id
                                     AND    dcla.start_date <= da.alloc_date)

          JOIN   d_class dc
          ON     dc.d_class_id = dcl.d_class_id

          JOIN   d_class_var dcv
          ON     dcv.d_class_id = dcl.d_class_id
          AND    dcv.d_class_var_id = dcl.d_class_var_id

          UNION

          SELECT "Diesel"                AS long_type,
                 "D"                     AS type,
                 CASE WHEN da_next.alloc_flag = "W"
                   THEN "<span id=do_red>Condemned</span>"
                      WHEN da_next.alloc_flag = "S"
                   THEN "To Store"
                      ELSE
                        CASE WHEN da_next.snapshot = "Y"
                          THEN "<span id=do_italics>Snapshot</span>"
                            ELSE
                               "Transfer out to:"
                        END
                 END                     AS movement,
                 "fmt_red"               AS movement_col,
                 da.loco_id              AS loco_id,
                 da_next.alloc_date      AS alloc_date,
                 NULL                    AS allocation,
                 NULL                    AS depot_name,
                 da_next.allocation      AS chg_allocation,
                 da_next.seq             AS seq,
                 da_next.period          AS period,
                 CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                         AS chg_allocation_hl,
                 dp3.depot_name          AS chg_depot_name,
                 CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                         AS chg_depot_name_hl,
                 da_next.period          AS alloc_period,
                 da_next.seq             AS alloc_seq,
                 dn.number               AS number,
                 CONCAT("locoqry.php?action=locodata&id=", da.loco_id, "&type=D&loco=", dn.number)
                                         AS number_hl,
                 dn.number_type          AS number_type,
                 IFNULL(dc.common_name, dc.identifier) 
                                         AS class_type,
                 concat("locoqry.php?action=class&type=D&id=",dc.d_class_id) 
                                         AS class_type_hl,
                 dc.wheel_arrangement    AS wheel_arr,
                 CONCAT("misc.php?page=wheel_arr&id=", dc.wheel_arrangement) 
                                        AS wheel_arr_hl

          FROM   d_alloc da
          
          JOIN d_alloc da_next
          ON     da_next.loco_id = da.loco_id
          AND    concat(da_next.alloc_date, da_next.seq) = 
                                    (SELECT MIN(concat(da_nexta.alloc_date, da_nexta.seq))
                                     FROM   d_alloc da_nexta
                                     WHERE (da_nexta.alloc_date > da.alloc_date
                                            OR     (da_nexta.alloc_date = da.alloc_date
                                                AND da_nexta.seq        > da.seq))
                                     AND    da_nexta.loco_id = da.loco_id)

          JOIN   ref_depot_codes dpc2
          ON     dpc2.depot_code = da.allocation
          AND    dpc2.date_from =   (SELECT max(dpc2a.date_from)
                                     FROM   ref_depot_codes dpc2a
                                     WHERE  dpc2a.depot_code = da.allocation
                                     AND    dpc2a.date_from <= da.alloc_date)

          JOIN   ref_depot dp2
          ON     dp2.depot_id = dpc2.depot_id

          LEFT JOIN ref_depot_codes dpc3
          ON     dpc3.depot_code = da_next.allocation
          AND    dpc3.date_from =   (SELECT max(dpc3a.date_from)
                                     FROM   ref_depot_codes dpc3a
                                     WHERE  dpc3a.depot_code = da_next.allocation
                                     AND    dpc3a.date_from <= da_next.alloc_date)

          LEFT JOIN ref_depot dp3
          ON     dp3.depot_id = dpc3.depot_id
          
          JOIN   d_class_link dcl
          ON     dcl.loco_id = da.loco_id
          AND    dcl.start_date =   (SELECT max(dcla.start_date)
                                     FROM   d_class_link dcla
                                     WHERE  dcla.loco_id = da.loco_id
                                     AND    dcla.start_date <= da.alloc_date)

          JOIN   d_class dc
          ON     dc.d_class_id = dcl.d_class_id

          JOIN   d_class_var dcv
          ON     dcv.d_class_id = dcl.d_class_id
          AND    dcv.d_class_var_id = dcl.d_class_var_id
          
          JOIN   d_nums dn
          ON     dn.loco_id = da.loco_id
          AND    dn.start_date =    (SELECT max(dna.start_date)
                                     FROM   d_nums dna
                                     WHERE  dna.loco_id = da.loco_id
                                     AND    dna.start_date <= da_next.alloc_date)

          UNION

          SELECT "Electric"              AS long_type,
                 "E"                     AS type,
                 CASE WHEN ea.alloc_flag = "N"
                   THEN "<span id=do_green>1st Allocation</span>"
                      WHEN ea.alloc_flag = "R"
                   THEN "Reinstated"
                      ELSE
                        CASE WHEN ea.snapshot = "Y"
                          THEN "<span id=do_italics>Snapshot</span>"
                            ELSE
                               "Transfer in from:"
                        END
                 END                     AS movement,
                 "fmt_green"             AS movement_col,
                 ea.loco_id              As loco_id,
                 ea.alloc_date           AS alloc_date,
                 ea.allocation           AS allocation,
                 dp.depot_name           AS depot_name,
                 ea_prev.allocation      AS chg_allocation,
                 ea.seq                  AS seq,
                 ea.period               AS period,
                 CONCAT("sites.php?page=depots&action=query&id=", dep_prev.depot_id) 
                                         AS chg_allocation_hl,
                 dep_prev.depot_name     AS chg_depot_name,
                 CONCAT("sites.php?page=depots&action=query&id=", dep_prev.depot_id) 
                                         AS chg_depot_name_hl,
                 ea.period               AS alloc_period,
                 ea.seq                  AS alloc_seq,
                 en.number               AS number,
                 CONCAT("locoqry.php?action=locodata&id=", ea.loco_id, "&type=E&loco=", en.number)
                                         AS number_hl,
                 en.number_type          AS number_type,
                 IFNULL(ec.common_name, ec.identifier) 
                                         AS class_type,
                 concat("locoqry.php?action=class&type=E&id=",ec.e_class_id) 
                                         AS class_type_hl,
                 ec.wheel_arrangement    AS wheel_arr,
                 CONCAT("misc.php?page=wheel_arr&id=", ec.wheel_arrangement) 
                                        AS wheel_arr_hl
          FROM   e_alloc ea

          JOIN   e_nums en
          ON     en.loco_id = ea.loco_id
          AND    en.start_date =    (SELECT max(ena.start_date)
                                     FROM   e_nums ena
                                     WHERE  ena.loco_id = ea.loco_id
                                     AND    ena.start_date <= ea.alloc_date)

          JOIN   ref_depot_codes dpc
          ON     dpc.depot_code = ea.allocation
          AND    dpc.date_from =    (SELECT max(dpc2a.date_from)
                                     FROM   ref_depot_codes dpc2a
                                     WHERE  dpc2a.depot_code = ea.allocation
                                     AND    dpc2a.date_from <= ea.alloc_date)

          JOIN   ref_depot dp
          ON     dp.depot_id = dpc.depot_id

          LEFT JOIN e_alloc ea_prev
          ON     ea_prev.loco_id = ea.loco_id
          AND    concat(ea_prev.alloc_date, ea_prev.seq) = 
                                    (SELECT MAX(concat(ea_preva.alloc_date, ea_preva.seq))
                                     FROM   e_alloc ea_preva
                                     WHERE (ea_preva.alloc_date < ea.alloc_date
                                            OR     (ea_preva.alloc_date = ea.alloc_date
                                                AND ea_preva.seq        < ea.seq))
                                     AND    ea_preva.loco_id = ea.loco_id)

          LEFT JOIN ref_depot_codes dpc_prev
          ON     dpc_prev.depot_code = ea_prev.allocation
          AND    dpc_prev.date_from = 
                                    (SELECT max(dpc_preva.date_from)
                                     FROM   ref_depot_codes dpc_preva
                                     WHERE  dpc_preva.depot_code = ea_prev.allocation
                                     AND    dpc_preva.date_from <= ea_prev.alloc_date)

          LEFT JOIN ref_depot dep_prev
          ON     dep_prev.depot_id = dpc_prev.depot_id
    
          JOIN   e_class_link ecl
          ON     ecl.loco_id = ea.loco_id
          AND    ecl.start_date =   (SELECT max(ecla.start_date)
                                     FROM   e_class_link ecla
                                     WHERE  ecla.loco_id = ea.loco_id
                                     AND    ecla.start_date <= ea.alloc_date)

          JOIN   e_class ec
          ON     ec.e_class_id = ecl.e_class_id

          JOIN   e_class_var ecv
          ON     ecv.e_class_id = ecl.e_class_id
          AND    ecv.e_class_var_id = ecl.e_class_var_id

          UNION

          SELECT "Electric"              AS long_type,
                 "E"                     AS type,
                 CASE WHEN ea_next.alloc_flag = "W"
                   THEN "<span id=do_red>Condemned</span>"
                      WHEN ea_next.alloc_flag = "S"
                   THEN "To Store"
                      ELSE
                        CASE WHEN ea_next.snapshot = "Y"
                          THEN "<span id=do_italics>Snapshot</span>"
                            ELSE
                               "Transfer out to:"
                        END
                 END                     AS movement,
                 "fmt_red"               AS movement_col,
                 ea.loco_id              AS loco_id,
                 ea_next.alloc_date      AS alloc_date,
                 NULL                    AS allocation,
                 NULL                    AS depot_name,
                 ea_next.allocation      AS chg_allocation,
                 ea_next.seq             AS seq,
                 ea_next.period          AS period,
                 CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                         AS chg_allocation_hl,
                 dp3.depot_name          AS chg_depot_name,
                 CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                         AS chg_depot_name_hl,
                 ea_next.period          AS alloc_period,
                 ea_next.seq             AS alloc_seq,
                 en.number               AS number,
                 CONCAT("locoqry.php?action=locodata&id=", ea.loco_id, "&type=E&loco=", en.number)
                                         AS number_hl,
                 en.number_type          AS number_type,
                 IFNULL(ec.common_name, ec.identifier) 
                                         AS class_type,
                 concat("locoqry.php?action=class&type=E&id=",ec.e_class_id) 
                                         AS class_type_hl,
                 ec.wheel_arrangement    AS wheel_arr,
                 CONCAT("misc.php?page=wheel_arr&id=", ec.wheel_arrangement) 
                                        AS wheel_arr_hl

          FROM   e_alloc ea
          
          JOIN   e_alloc ea_next
          ON     ea_next.loco_id = ea.loco_id
          AND    concat(ea_next.alloc_date, ea_next.seq) = 
                                    (SELECT MIN(concat(ea_nexta.alloc_date, ea_nexta.seq))
                                     FROM   e_alloc ea_nexta
                                     WHERE (ea_nexta.alloc_date > ea.alloc_date
                                            OR     (ea_nexta.alloc_date = ea.alloc_date
                                                AND ea_nexta.seq        > ea.seq))
                                     AND    ea_nexta.loco_id = ea.loco_id)

          JOIN   ref_depot_codes dpc2
          ON     dpc2.depot_code = ea.allocation
          AND    dpc2.date_from =   (SELECT max(dpc2a.date_from)
                                     FROM   ref_depot_codes dpc2a
                                     WHERE  dpc2a.depot_code = ea.allocation
                                     AND    dpc2a.date_from <= ea.alloc_date)

          JOIN   ref_depot dp2
          ON     dp2.depot_id = dpc2.depot_id

          LEFT JOIN ref_depot_codes dpc3
          ON     dpc3.depot_code = ea_next.allocation
          AND    dpc3.date_from =   (SELECT max(dpc3a.date_from)
                                     FROM   ref_depot_codes dpc3a
                                     WHERE  dpc3a.depot_code = ea_next.allocation
                                     AND    dpc3a.date_from <= ea_next.alloc_date)

          LEFT JOIN ref_depot dp3
          ON     dp3.depot_id = dpc3.depot_id
          
          JOIN   e_class_link ecl
          ON     ecl.loco_id = ea.loco_id
          AND    ecl.start_date =   (SELECT max(ecla.start_date)
                                     FROM   e_class_link ecla
                                     WHERE  ecla.loco_id = ea.loco_id
                                     AND    ecla.start_date <= ea.alloc_date)

          JOIN   e_class ec
          ON     ec.e_class_id = ecl.e_class_id

          JOIN   e_class_var ecv
          ON     ecv.e_class_id = ecl.e_class_id
          AND    ecv.e_class_var_id = ecl.e_class_var_id
          
          JOIN   e_nums en
          ON     en.loco_id = ea.loco_id
          AND    en.start_date =    (SELECT max(ena.start_date)
                                     FROM   e_nums ena
                                     WHERE  ena.loco_id = ea.loco_id
                                     AND    ena.start_date <= ea_next.alloc_date);
                                     
          ALTER TABLE `brdataba_live`.`tdw_dep_arrdep`
          DROP INDEX `depot_id`,
          ADD INDEX `depot_id` (`depot_id`) USING BTREE;'

          
*/
 //echo $sql . "<br />";
  $result = $db->execute($sql);

  if ($result)
  {
  while ($row = mysqli_fetch_assoc($result))
  {
    if ((strstr($row['movement'], "Condemned")) ||
        (strstr($row['movement'], "To Store") ) ||
        (strncmp($row['chg_allocation'], "99", 2) == 0))
      $row['chg_allocation'] = "";

    if ($row['type'] == "D" && $row['number_type'] == "PRT")
      $row['number'] = fn_d_pfx($row['number']);
    else
    if ($row['type'] == "E" && $row['number_type'] == "PRT")
      $row['number'] = fn_e_pfx($row['number']);

    $row['period'] = fn_prd($row['period']);

    $row['alloc_date'] = fn_fdate($row['alloc_date']);
    $row['event'] = "Arrival";
    $tb->add_data($row);
  }

  $tb->draw_table();
  }

  $file_cache->end_cache();
?>
