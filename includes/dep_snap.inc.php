<?php
  echo "<div id=\"navcontainer\">";
  echo "<ul id=\"navlist\">";
  echo "<li><a href=\"sites.php?page=depots&subpage=main&id="  .$id. "\">Depot Details</a></li>";
  echo "<li><a href=\"sites.php?page=depots&subpage=locos&id="  .$id. "\">Locos Allocated</a></li>";
  echo "<li id=\"active\"><a href=\"#\" id=\"current\">Snapshot</a></li>";
  echo "<li><a href=\"sites.php?page=depots&subpage=arrdep&id="  .$id. "\">Arrivals/Departures</a></li>";
  if ($vlog > 0)
    echo "<li><a href=\"sites.php?page=depots&amp;subpage=vlog&amp;id="  .$id. "\">Visit Log</a></li>";
  if ($imgct > 0)
    echo "<li><a href=\"sites.php?page=depots&subpage=gallery&id="  .$id. "\">Gallery</a></li>";
  echo "</ul>";
  echo "</div>";

  $selfref = $_SERVER['PHP_SELF'] . "?page=depots&subpage=snap&id=" . $id;

  if (isset($_POST['mon_select']) or (!empty($_POST['mon_select'])))
  {
    @$mvals = $_POST['mon_select'];
    @$yvals = $_POST['year_select'];

    $qry = $yvals[0] . "-" . $mvals[0];
    $qrys = $yvals[0] . $mvals[0] . "3199";
    $qrye = $yvals[0] . $mvals[0] . "0000";
    
    include_once("lib/MyTables.class.php");
    include_once("lib/brlib.php");

    $tb = new MyTables("depot_allocations");

    $tb->sortable();
    $tb->colour_coordinate("Y");
   
    $sql='SELECT tdw.*,
                tdw.type    AS wtype,
                tdw.loco_id AS wloco_id,
                sn.number,
                sn.number_type,
                CONCAT("locoqry.php?action=locodata&id=", sn.loco_id, "&type=S&loco=", sn.number) AS number_hl
         FROM   tdw_dep_snap tdw
         JOIN   s_nums sn
         ON     sn.loco_id = tdw.loco_id
         AND    sn.start_date = (SELECT max(sn1.start_date)
                                 FROM   s_nums sn1
                                 WHERE  sn1.loco_id = sn.loco_id
                                 AND    sn1.start_date <= last_day(str_to_date("' . $qry . '", "%Y-%m")))

         WHERE  tdw.depot_id_current = ' . $id . '
         AND    tdw.alloc_date_current_fmt <= "' . $qrys . '"
         AND    tdw.alloc_date_next_fmt > "' . $qrye . '"
         AND    tdw.type = "S"

         UNION

         SELECT tdw.*,
                tdw.type    AS wtype,
                tdw.loco_id AS wloco_id,
                dn.number   AS number,
                dn.number_type,
                CONCAT("locoqry.php?action=locodata&id=", dn.loco_id, "&type=D&loco=", dn.number) AS number_hl
         FROM   tdw_dep_snap tdw
         JOIN   d_nums dn
         ON     dn.loco_id = tdw.loco_id
         AND    dn.start_date = (SELECT max(dn1.start_date)
                                 FROM   d_nums dn1
                                 WHERE  dn1.loco_id = dn.loco_id
                                 AND    dn1.start_date <= last_day(str_to_date("' . $qry . '", "%Y-%m")))

         WHERE  tdw.depot_id_current = ' . $id . '
         AND    tdw.alloc_date_current_fmt <= "' . $qrys . '"
         AND    tdw.alloc_date_next_fmt > "' . $qrye . '"
         AND    tdw.type = "D"
         
         UNION

         SELECT tdw.*,
                tdw.type    AS wtype,
                tdw.loco_id AS wloco_id,
                en.number   AS number,
                en.number_type,
                CONCAT("locoqry.php?action=locodata&id=", en.loco_id, "&type=E&loco=", en.number) AS number_hl
         FROM   tdw_dep_snap tdw
         JOIN   e_nums en
         ON     en.loco_id = tdw.loco_id
         AND    en.start_date = (SELECT max(en1.start_date)
                                 FROM   e_nums en1
                                 WHERE  en1.loco_id = en.loco_id
                                 AND    en1.start_date <= last_day(str_to_date("' . $qry . '", "%Y-%m")))

         WHERE  tdw.depot_id_current = ' . $id . '
         AND    tdw.alloc_date_current_fmt <= "' . $qrys . '"
         AND    tdw.alloc_date_next_fmt > "' . $qrye . '"
         AND    tdw.type = "E"
         
         ORDER BY type, class_type, number';

// *The following sql creates the tdw_dep_snap table and isn't executed here.
    $sql2='DROP TABLE tdw_dep_snap;
    
           CREATE TABLE tdw_dep_snap AS
               SELECT "Steam"         AS long_type,
               "S"                    AS type,
               sa2.loco_id            AS loco_id,
               
               sa1.allocation         AS alloc_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS alloc_prior_hl,
               sa1.alloc_date         AS alloc_date_prior,
               sa1.period             AS alloc_date_prior_prd,
               date_format(sa1.alloc_date, "%Y%m%d")  AS alloc_date_prior_fmt,
               sa1.alloc_flag         AS alloc_flag_prior,
               dp1.depot_name         AS depot_name_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS depot_name_prior_hl,
                                      
               ifnull(dpc2.displayed_depot_code, dpc2.depot_code)  AS alloc_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                      AS alloc_current_hl,
               sa2.alloc_date         AS alloc_date_current,
               sa2.period             AS alloc_date_current_prd,
               date_format(sa2.alloc_date, "%Y%m%d")  AS alloc_date_current_fmt,
               sa2.alloc_flag         AS alloc_flag_current,
               dp2.depot_name         AS depot_name_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id)
                                      AS depot_name_current_hl,
               dp2.depot_id           AS depot_id_current,
               
               sa3.allocation         AS alloc_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS alloc_next_hl,
               sa3.alloc_date         AS alloc_date_next,
               sa3.period             AS alloc_date_next_prd,
               date_format(sa3.alloc_date, "%Y%m%d")  AS alloc_date_next_fmt,
               sa3.alloc_flag         AS alloc_flag_next,
               dp3.depot_name         AS depot_name_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS depot_name_next_hl,
                                      
               IFNULL(sc.common_name, sc.identifier) 
                                      AS loco_type,
               concat("locoqry.php?action=class&type=S&id=", sc.s_class_id) AS loco_type_hl,
               sc.wheel_arrangement   AS wheel_arr,
               CONCAT("misc.php?page=wheel_arr&id=", sc.wheel_arrangement) 
                                      AS wheel_arr_hl,
               scv.designer           AS designer,
               CONCAT("people.php?page=cme&name=",scv.designer) 
                                      AS designer_hl,
               CONCAT(
                 CASE WHEN p.surname IS NOT NULL THEN
                   concat(p.surname, " ")
                 ELSE
                   ""
                 END,
                   coalesce(scv.common_name, sc.common_name, scv.class_type)) AS class_type,
               concat("locoqry.php?action=class&type=S&id=", sc.s_class_id)   AS class_type_hl
        
        FROM   s_alloc sa2

        LEFT JOIN s_alloc sa1
        ON     sa1.loco_id = sa2.loco_id
        AND    concat(sa1.alloc_date, sa1.seq) = (SELECT MAX(concat(sa1a.alloc_date, sa1a.seq))
                                 FROM   s_alloc sa1a
                                 WHERE ((sa1a.alloc_date < sa2.alloc_date)
                                     OR (sa1a.alloc_date = sa2.alloc_date
                                        AND 
                                         sa1a.seq        < sa2.seq))
                                 AND    sa1a.loco_id = sa2.loco_id)
        LEFT JOIN s_alloc sa3
        ON     sa3.loco_id = sa2.loco_id
        AND    concat(sa3.alloc_date, sa3.seq) = (SELECT MIN(concat(sa3a.alloc_date, sa3a.seq))
                                 FROM   s_alloc sa3a
                                 WHERE ((sa3a.alloc_date > sa2.alloc_date)
                                     OR (sa3a.alloc_date = sa2.alloc_date
                                        AND
                                         sa3a.seq        > sa2.seq))
                                 AND    sa3a.loco_id = sa2.loco_id)
        LEFT JOIN ref_depot_codes dpc1
        ON     dpc1.depot_code = sa1.allocation
        AND    sa1.alloc_date BETWEEN dpc1.date_from
                                  AND IFNULL(dpc1.date_to, "2999-01-01")
        LEFT JOIN ref_depot dp1
        ON     dp1.depot_id = dpc1.depot_id
        
        JOIN   ref_depot_codes dpc2
        ON     dpc2.depot_code = sa2.allocation
        AND    sa2.alloc_date BETWEEN dpc2.date_from 
                                  AND IFNULL(dpc2.date_to, "2999-01-01")
        JOIN   ref_depot dp2
        ON     dp2.depot_id = dpc2.depot_id
        
        LEFT JOIN ref_depot_codes dpc3
        ON     dpc3.depot_code = sa3.allocation
        AND    sa3.alloc_date BETWEEN dpc3.date_from
                                  AND IFNULL(dpc3.date_to, "2999-01-01")
        LEFT JOIN ref_depot dp3
        ON     dp3.depot_id = dpc3.depot_id
        
        JOIN   s_class_link scl
        ON     scl.loco_id = sa2.loco_id
        AND    scl.start_date = (select max(scl1.start_date)
                                 from   s_class_link scl1
                                 where  scl1.loco_id = scl.loco_id
                                 and    scl1.start_date <= sa2.alloc_date)

        JOIN   s_class sc
        ON     sc.s_class_id = scl.s_class_id
        JOIN   s_class_var scv
        ON     scv.s_class_id = scl.s_class_id
        AND    scv.s_class_var_id = scl.s_class_var_id
        
        LEFT JOIN ref_people p
        ON     p.p_id = sc.designer_id
              
        UNION
        
        SELECT "Diesel"               AS long_type,
               "D"                    AS type,
               da2.loco_id            AS loco_id,
               da1.allocation         AS alloc_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS alloc_prior_hl,
               da1.alloc_date         AS alloc_date_prior,
               da1.period             AS alloc_date_prior_prd,
               date_format(da1.alloc_date, "%Y%m%d") AS alloc_date_prior_fmt,
               da1.alloc_flag         AS alloc_flag_prior,
               dp1.depot_name         AS depot_name_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS depot_name_prior_hl,
               ifnull(dpc2.displayed_depot_code, dpc2.depot_code)  AS alloc_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                      AS alloc_current_hl,
               da2.alloc_date         AS alloc_date_current,
               da2.period             AS alloc_date_current_prd,
               date_format(da2.alloc_date, "%Y%m%d") AS alloc_date_current_fmt,
               da2.alloc_flag         AS alloc_flag_current,
               dp2.depot_name         AS depot_name_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                      AS depot_name_current_hl,
               dp2.depot_id           AS depot_id_current,
               da3.allocation         AS alloc_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS alloc_next_hl,
               da3.alloc_date         AS alloc_date_next,
               da3.period             AS alloc_date_next_prd,
               date_format(da3.alloc_date, "%Y%m%d") AS alloc_date_next_fmt,
               da3.alloc_flag         AS alloc_flag_next,
               dp3.depot_name         AS depot_name_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS depot_name_next_hl,
               IFNULL(dc.common_name, dc.identifier) 
                                      AS loco_type,
               concat("locoqry.php?action=class&type=D&id=", dc.d_class_id) AS loco_type_hl,
               dc.wheel_arrangement   AS wheel_arr,
               CONCAT("misc.php?page=wheel_arr&id=", dc.wheel_arrangement) 
                                      AS wheel_arr_hl,
               dcv.designer           AS designer,
               CONCAT("people.php?page=cme&name=",dcv.designer) 
                                      AS designer_hl,
               dcv.identifier         AS class_type,
               concat("locoqry.php?action=class&type=D&id=", dc.d_class_id) AS class_type_hl
                
        FROM   d_alloc da2
        LEFT JOIN d_alloc da1
        ON     da1.loco_id = da2.loco_id
        AND    concat(da1.alloc_date, da1.seq) = (SELECT MAX(concat(da1a.alloc_date, da1a.seq))
                                 FROM   d_alloc da1a
                                 WHERE ((da1a.alloc_date < da2.alloc_date)
                                     OR (da1a.alloc_date = da2.alloc_date
                                        AND 
                                         da1a.seq        < da2.seq))
                                 AND    da1a.loco_id = da2.loco_id)
        LEFT JOIN d_alloc da3
        ON     da3.loco_id = da2.loco_id
        AND    concat(da3.alloc_date, da3.seq) = (SELECT MIN(concat(da3a.alloc_date,da3a.seq))
                                 FROM   d_alloc da3a
                                 WHERE ((da3a.alloc_date > da2.alloc_date)
                                     OR (da3a.alloc_date = da2.alloc_date
                                        AND
                                         da3a.seq        > da2.seq))
                                 AND    da3a.loco_id = da2.loco_id)

        LEFT JOIN ref_depot_codes dpc1
        ON     dpc1.depot_code = da1.allocation
        AND    da1.alloc_date BETWEEN dpc1.date_from
                                  AND IFNULL(dpc1.date_to, "2999-01-01")
        LEFT JOIN ref_depot dp1
        ON     dp1.depot_id = dpc1.depot_id
        
        JOIN   ref_depot_codes dpc2
        ON     dpc2.depot_code = da2.allocation
        AND    da2.alloc_date BETWEEN dpc2.date_from 
                                  AND IFNULL(dpc2.date_to, "2999-01-01")
        JOIN   ref_depot dp2
        ON     dp2.depot_id = dpc2.depot_id
        
        LEFT JOIN ref_depot_codes dpc3
        ON     dpc3.depot_code = da3.allocation
        AND    da3.alloc_date BETWEEN dpc3.date_from
                                  AND IFNULL(dpc3.date_to, "2999-01-01")
        LEFT JOIN ref_depot dp3
        ON     dp3.depot_id = dpc3.depot_id
        
        JOIN   d_class_link dcl
        ON     dcl.loco_id = da2.loco_id
        AND    dcl.start_date = (select max(dcl1.start_date)
                                 from   d_class_link dcl1
                                 where  dcl1.loco_id = dcl.loco_id
                                 and    dcl1.start_date <= da2.alloc_date)

        JOIN   d_class dc
        ON     dc.d_class_id = dcl.d_class_id
        JOIN   d_class_var dcv
        ON     dcv.d_class_id = dcl.d_class_id
        AND    dcv.d_class_var_id = dcl.d_class_var_id
        
        UNION
        
        SELECT "Electric"             AS long_type,
               "E"                    AS type,
               ea2.loco_id            AS loco_id,
               ea1.allocation         AS alloc_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS alloc_prior_hl,
               ea1.alloc_date         AS alloc_date_prior,
               ea1.period             AS alloc_date_prior_prd,
               date_format(ea1.alloc_date, "%Y%m%d") AS alloc_date_prior_fmt,
               ea1.alloc_flag         AS alloc_flag_prior,
               dp1.depot_name         AS depot_name_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS depot_name_prior_hl,
               ifnull(dpc2.displayed_depot_code, dpc2.depot_code)  AS alloc_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                      AS alloc_current_hl,
               ea2.alloc_date         AS alloc_date_current,
               ea2.period             AS alloc_date_current_prd,
               date_format(ea2.alloc_date, "%Y%m%d") AS alloc_date_current_fmt,
               ea2.alloc_flag         AS alloc_flag_current,
               dp2.depot_name         AS depot_name_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                      AS depot_name_current_hl,
               dp2.depot_id           AS depot_id_current,
               ea3.allocation         AS alloc_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS alloc_next_hl,
               ea3.alloc_date         AS alloc_date_next,
               ea3.period             AS alloc_date_next_prd,
               date_format(ea3.alloc_date, "%Y%m%d") AS alloc_date_next_fmt,
               ea3.alloc_flag         AS alloc_flag_next,
               dp3.depot_name         AS depot_name_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS depot_name_next_hl,
               IFNULL(ec.common_name, ec.identifier) 
                                      AS loco_type,
               concat("locoqry.php?action=class&type=E&id=", ec.e_class_id) AS loco_type_hl,
               ec.wheel_arrangement   AS wheel_arr,
               CONCAT("misc.php?page=wheel_arr&id=", ec.wheel_arrangement) 
                                      AS wheel_arr_hl,
               ecv.designer           AS designer,
               CONCAT("people.php?page=cme&name=",ecv.designer) 
                                      AS designer_hl,
               ecv.identifier         AS class_type,
               concat("locoqry.php?action=class&type=E&id=", ec.e_class_id) AS class_type_hl
        
        FROM   e_alloc ea2
        LEFT JOIN e_alloc ea1
        ON     ea1.loco_id = ea2.loco_id
        AND    concat(ea1.alloc_date, ea1.seq) = (SELECT MAX(concat(ea1a.alloc_date, ea1a.seq))
                                 FROM   e_alloc ea1a
                                 WHERE ((ea1a.alloc_date < ea2.alloc_date)
                                     OR (ea1a.alloc_date = ea2.alloc_date
                                        AND 
                                         ea1a.seq        < ea2.seq))
                                 AND    ea1a.loco_id = ea2.loco_id)
        LEFT JOIN e_alloc ea3
        ON     ea3.loco_id = ea2.loco_id
        AND    concat(ea3.alloc_date, ea3.seq) = (SELECT MIN(concat(ea3a.alloc_date,ea3a.seq))
                                 FROM   e_alloc ea3a
                                 WHERE ((ea3a.alloc_date > ea2.alloc_date)
                                     OR (ea3a.alloc_date = ea2.alloc_date
                                        AND
                                         ea3a.seq        > ea2.seq))
                                 AND    ea3a.loco_id = ea2.loco_id)

        LEFT JOIN ref_depot_codes dpc1
        ON     dpc1.depot_code = ea1.allocation
        AND    ea1.alloc_date BETWEEN dpc1.date_from
                                  AND IFNULL(dpc1.date_to, "2999-01-01")
        LEFT JOIN ref_depot dp1
        ON     dp1.depot_id = dpc1.depot_id
        
        JOIN   ref_depot_codes dpc2
        ON     dpc2.depot_code = ea2.allocation
        AND    ea2.alloc_date BETWEEN dpc2.date_from 
                                  AND IFNULL(dpc2.date_to, "2999-01-01")
        JOIN   ref_depot dp2
        ON     dp2.depot_id = dpc2.depot_id

        LEFT JOIN ref_depot_codes dpc3
        ON     dpc3.depot_code = ea3.allocation
        AND    ea3.alloc_date BETWEEN dpc3.date_from
                                  AND IFNULL(dpc3.date_to, "2999-01-01")
        LEFT JOIN ref_depot dp3
        ON     dp3.depot_id = dpc3.depot_id
        
        JOIN   e_class_link ecl
        ON     ecl.loco_id = ea2.loco_id
        AND    ecl.start_date = (select max(ecl1.start_date)
                                 from   e_class_link ecl1
                                 where  ecl1.loco_id = ecl.loco_id
                                 and    ecl1.start_date <= ea2.alloc_date)

        JOIN   e_class ec
        ON     ec.e_class_id = ecl.e_class_id
        JOIN   e_class_var ecv
        ON     ecv.e_class_id = ecl.e_class_id
        AND    ecv.e_class_var_id = ecl.e_class_var_id
        
        JOIN   e_nums en
        ON     en.loco_id = ea2.loco_id;
        
        ALTER TABLE `brdataba_live`.`tdw_dep_snap` 
        DROP INDEX `depot_id_current`, 
        ADD INDEX `depot_id_current` (`depot_id_current`, `alloc_date_current`, `type`, `loco_id`) USING BTREE';

  //echo $sql;

  $result = $db->execute($sql);

  // $monthNum = sprintf("%02s", $result["month"]);
  $monthName = date("F", mktime(null, null, null, $mvals[0]));

  if ($db->count_select() == 1)
    printf("<br /><h5>1 locomotive allocated in %s, %s</h4><br />\n", $monthName, $yvals[0]);
  else
    printf("<br /><h5>%d locomotives allocated in %s, %s</h4><br />\n", $db->count_select(), $monthName, $yvals[0]);

  echo "<h5><a href=\"#locos\">View Locomotives</a></h5><br />";
  echo "<h5><a href=\"#summary\">View Summary</a></h5><br />";

  echo "<a name=\"locos\"></a>";
  $z = 0;
  while ($row = mysqli_fetch_assoc($result))
  {
    if ($z == 0)
    {
      $tb->add_column("long_type",              "Type",              4);
      $tb->add_column("class_type",             "Class",             8);
      $tb->add_column("wheel_arr",              "Wheels",            5);
      $tb->add_column("number",                 "Number",            5);

      $tb->add_column("depot_name_prior",       "Came From ...",    15);
      $tb->add_column("alloc_prior",            "Code",              3);
      $tb->add_column("alloc_date_prior_prd",   "",               2);
      $tb->add_column("alloc_date_prior",       "When",              8);

      $tb->add_column("alloc_date_current_prd", "",                  2);
      $tb->add_column("alloc_date_current",     "Date to " . $row['depot_name_current'], 11);
      $tb->add_column("alloc_current",          "Code",              3);

      $tb->add_column("depot_name_next",        "Went To ...",       15);
      $tb->add_column("alloc_next",             "Code",              3);
      $tb->add_column("alloc_date_next_prd",    "",                  2);
      $tb->add_column("alloc_date_next",        "When",              8);
    }

    $z = 1;

    if ($row['alloc_next'] == "98W")
    {
      $row['depot_name_next'] = "<font color=red><strong>Withdrawn</strong></font>";
      $row['alloc_next'] = "";
    }

    if ($row['alloc_next'] == "98S")
    {
      $row['depot_name_next'] = "<font color=orange><strong>To Store</strong></font>";
      $row['alloc_next'] = "";
    }

    if ($row['wtype'] != "S")
    {
      if ($row['number_type'] == "PRT")
      {
        if ($row['wtype'] == "D")
          $row['number'] = fn_d_pfx($row['number']);
        else
        if ($row['wtype'] == "E")
          $row['number'] = fn_e_pfx($row['number']);
      }
    }
    
    $row['alloc_date_prior_prd']   = fn_prd($row['alloc_date_prior_prd']);
    $row['alloc_date_current_prd'] = fn_prd($row['alloc_date_current_prd']);
    $row['alloc_date_next_prd']    = fn_prd($row['alloc_date_next_prd']);

    if ($row['alloc_date_current'] == "1948-01-01")
      $row['alloc_date_current'] = "At Nationalisation";
    else
      $row['alloc_date_current'] = fn_fdate($row['alloc_date_current']);

    $row['alloc_date_prior'] = fn_fdate($row['alloc_date_prior']);
    $row['alloc_date_next']  = fn_fdate($row['alloc_date_next']);

    if ($row['alloc_flag_prior'] == "N")
      $row['depot_name_prior'] .= " <font color=green><strong>(New)</strong></font>";

    if ($row['alloc_flag_current'] == "N")
      $row['alloc_date_current'] .= " <font color=green><strong>(New)</strong></font>";

    $tb->dump_data($row);
  }
  
  if ($db->count_select())
    $tb->dump_data(NULL);

  printf("<br />\n");

  echo "<a name=\"summary\"></a>";
  /* Now for the summary */



  }
  else
  {
    printf("<p>To view the allocation for this depot in a given month, enter the date below:</p>\n");
  }

?>

  <p>Enter Snapshot Date:<p>
  <form method="post" action="<?php echo $selfref; ?>">
    <fieldset "snap">
    <table width="36%" frame=box border=0 cellpadding=1>
      <tr>
        <td width=25%>

        <SELECT size="1" name="mon_select[]">
          <OPTION value="01">January</OPTION>
          <OPTION value="02">February</OPTION>
          <OPTION value="03">March</OPTION>
          <OPTION value="04">April</OPTION>
          <OPTION value="05">May</OPTION>
          <OPTION value="06">June</OPTION>
          <OPTION value="07">July</OPTION>
          <OPTION value="08">August</OPTION>
          <OPTION value="09">September</OPTION>
          <OPTION value="10">October</OPTION>
          <OPTION value="11">November</OPTION>
          <OPTION value="12">December</OPTION>
        </SELECT>

        </td>

        <td width=10%>

        <SELECT size="1" name="year_select[]">
<?php
        for ($nx = 1875; $nx <= 1997; $nx++)
        {
          if ($nx == 1948)
            printf("<OPTION value=\"%d\" SELECTED>%d</OPTION>\n", $nx, $nx);
          else
            printf("<OPTION value=\"%d\">%d</OPTION>\n", $nx, $nx);
        }
?>
        </SELECT>
 
        </td>
      </tr>
    </table>

  <input type="submit" id="search-submit" value="GO" />
  </form>
