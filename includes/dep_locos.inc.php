<?php
  echo "<div id=\"navcontainer\">";
  echo "<ul id=\"navlist\">";
  echo "<li><a href=\"sites.php?page=depots&subpage=main&id="  .$id. "\">Depot Details</a></li>";
  echo "<li id=\"active\"><a href=\"#\" id=\"current\">Locos Allocated</a></li>";
  echo "<li><a href=\"sites.php?page=depots&subpage=snap&id="  .$id. "\">Snapshot</a></li>";
  echo "<li><a href=\"sites.php?page=depots&subpage=arrdep&id="  .$id. "\">Arrivals/Departures</a></li>";
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

  $tb->sortable();
  $tb->allow_rollover();
  $tb->colour_coordinate("Y");

  $sql='SELECT depot_name
        FROM   ref_depot
        WHERE  depot_id = ' . $id;

  $result = $db->execute($sql);

  $row = mysqli_fetch_assoc($result);
  
  $tb->add_column("long_type",             "Type",              4);
  $tb->add_column("loco_type",             "Class",             4);
  $tb->add_column("wheel_arr",             "Wheels",            5);
  $tb->add_column("number",                "Number",            5);

  $tb->add_column("alloc_date_prior_prd",  " ",                 4);
  $tb->add_column("alloc_date_prior",      "Date to Previous Shed",        8);
  $tb->add_column("alloc_prior",           "Code",              3);
  $tb->add_column("depot_name_prior",      "Previous Shed",    15);

  $tb->add_column("alloc_date_current_prd", " ",                4);
  $tb->add_column("alloc_date_current",    "Date to " . $row['depot_name'],11);
  $tb->add_column("alloc_current",         "Code",              3);

  $tb->add_column("alloc_date_next_prd",   " ",                 4);
  $tb->add_column("alloc_date_next",       "Date to Next Shed", 8);
  $tb->add_column("alloc_next",            "Code",              3);
  $tb->add_column("depot_name_next",       "Next Shed",        15);

  $sql='SELECT *
        FROM   tdw_dep_locos
        WHERE  depot_id_current = ' . $id . '
        ORDER BY alloc_date_current, type, loco_id';

/*
  Use the following to create the temporary data warehouse table:
  $sql='SELECT "Steam"                AS long_type,
               "S"                    AS type,
               sa2.loco_id            AS loco_id,
               sn.number              AS number,
               sn.number_type         AS number_type,
               CONCAT("locoqry.php?action=locodata&id=", sa2.loco_id, "&type=S&loco=", sn.number)
                                      AS number_hl,
               ifnull(dpc1.displayed_depot_code, sa1.allocation)
                                      AS alloc_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS alloc_prior_hl,
               dp1.depot_id           AS depot_id_prior,
               sa1.alloc_date         AS alloc_date_prior,
               sa1.alloc_date         AS alloc_date_prior_fmt,
               sa1.period             AS alloc_date_prior_prd,
               sa1.alloc_flag         AS alloc_flag_prior,
               dp1.depot_name         AS depot_name_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS depot_name_prior_hl,

               ifnull(dpc2.displayed_depot_code, dpc2.depot_code)  AS alloc_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                      AS alloc_current_hl,
               dp2.depot_id           AS depot_id_current,
               sa2.alloc_date         AS alloc_date_current,
               sa2.alloc_date         AS alloc_date_current_fmt,
               sa2.period             AS alloc_date_current_prd,
               sa2.alloc_flag         AS alloc_flag_current,
               dp2.depot_name         AS depot_name_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                      AS depot_name_current_hl,

               ifnull(dpc3.displayed_depot_code, sa3.allocation)
                                      AS alloc_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS alloc_next_hl,
               dp3.depot_id           AS depot_id_next,
               sa3.alloc_date         AS alloc_date_next,
               sa3.alloc_date         AS alloc_date_next_fmt,
               sa3.period             AS alloc_date_next_prd,
               sa3.alloc_flag         AS alloc_flag_next,
               dp3.depot_name         AS depot_name_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS depot_name_next_hl,

               IFNULL(sc.common_name, sc.identifier) 
                                      AS loco_type,
               CONCAT("locoqry.php?action=class&type=S&id=", sc.s_class_id) 
                                      AS loco_type_hl,
               IFNULL(sc.common_name, sc.identifier)
                                      AS loco_type_fmt,
               sc.wheel_arrangement   AS wheel_arr,
               CONCAT("misc.php?page=wheel_arr&id=", sc.wheel_arrangement) 
                                      AS wheel_arr_hl,
               scv.designer           AS designer,
               CONCAT("people.php?page=cme&name=",scv.designer) 
                                      AS designer_hl,
               scv.class_type         AS class_type
        
        FROM   s_alloc sa2

        LEFT JOIN s_alloc sa1
        ON     sa1.loco_id = sa2.loco_id
        AND    concat(sa1.alloc_date, sa1.seq) = (SELECT MAX(concat(sa1a.alloc_date,
                                                                    sa1a.seq))
                                                  FROM   s_alloc sa1a
                                                  WHERE (sa1a.alloc_date < sa2.alloc_date
                                                     OR     (sa1a.alloc_date = sa2.alloc_date
                                                         AND sa1a.seq        < sa2.seq))
                                                  AND    sa1a.loco_id = sa2.loco_id)

        LEFT JOIN s_alloc sa3
        ON     sa3.loco_id = sa2.loco_id
        AND    concat(sa3.alloc_date, sa3.seq) = (SELECT MIN(concat(sa3a.alloc_date,
                                                                    sa3a.seq))
                                                  FROM   s_alloc sa3a
                                                  WHERE (sa3a.alloc_date > sa2.alloc_date
                                                     OR     (sa3a.alloc_date = sa2.alloc_date
                                                         AND sa3a.seq        > sa2.seq))
                                                  AND    sa3a.loco_id = sa2.loco_id)

        LEFT JOIN ref_depot_codes dpc1
        ON     dpc1.depot_code = sa1.allocation
        AND    dpc1.date_from = (SELECT max(dpc1a.date_from)
                                 FROM   ref_depot_codes dpc1a
                                 WHERE  dpc1a.depot_code = sa1.allocation
                                 AND    dpc1a.date_from <= sa1.alloc_date)

        LEFT JOIN ref_depot dp1
        ON     dp1.depot_id = dpc1.depot_id
        

        JOIN   ref_depot_codes dpc2
        ON     dpc2.depot_code = sa2.allocation
        AND    dpc2.date_from = (SELECT max(dpc2a.date_from)
                                 FROM   ref_depot_codes dpc2a
                                 WHERE  dpc2a.depot_code = sa2.allocation
                                 AND    dpc2a.date_from <= sa2.alloc_date)

        JOIN   ref_depot dp2
        ON     dp2.depot_id = dpc2.depot_id
        AND    dp2.depot_id = ' . $id . '
        

        LEFT JOIN ref_depot_codes dpc3
        ON     dpc3.depot_code = sa3.allocation
        AND    dpc3.date_from = (SELECT max(dpc3a.date_from)
                                 FROM   ref_depot_codes dpc3a
                                 WHERE  dpc3a.depot_code = sa3.allocation
                                 AND    dpc3a.date_from <= sa3.alloc_date)

        LEFT JOIN ref_depot dp3
        ON     dp3.depot_id = dpc3.depot_id
        
        JOIN   s_class_link scl
        ON     scl.loco_id = sa2.loco_id
        AND    scl.start_date = (SELECT max(scla.start_date)
                                 FROM   s_class_link scla
                                 WHERE  scla.loco_id = sa2.loco_id
                                 AND    scla.start_date <= sa2.alloc_date)

        JOIN   s_class sc
        ON     sc.s_class_id = scl.s_class_id
        JOIN   s_class_var scv
        ON     scv.s_class_id = scl.s_class_id
        AND    scv.s_class_var_id = scl.s_class_var_id
        

        JOIN   s_nums sn
        ON     sn.loco_id = sa2.loco_id
        AND    sn.start_date =  (SELECT max(sna.start_date)
                                 FROM   s_nums sna
                                 WHERE  sna.loco_id = sa2.loco_id
                                 AND    sna.start_date <= sa2.alloc_date)

        UNION
      
        SELECT "Diesel"               AS long_type,
               "D"                    AS type,
               da2.loco_id            AS loco_id,
               dn.number              AS number,
               dn.number_type         AS number_type,
               CONCAT("locoqry.php?action=locodata&id=", da2.loco_id, "&type=D&loco=", dn.number)
                                      AS number_hl,
               ifnull(dpc1.displayed_depot_code, da1.allocation)
                                      AS alloc_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS alloc_prior_hl,
               dp1.depot_id           AS depot_id_prior,
               da1.alloc_date         AS alloc_date_prior,
               da1.alloc_date         AS alloc_date_prior_fmt,
               da1.period             AS alloc_date_prior_prd,
               da1.alloc_flag         AS alloc_flag_prior,
               dp1.depot_name         AS depot_name_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS depot_name_prior_hl,

               ifnull(dpc2.displayed_depot_code, dpc2.depot_code)  AS alloc_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                      AS alloc_current_hl,
               dp2.depot_id           AS depot_id_current,
               da2.alloc_date         AS alloc_date_current,
               da2.alloc_date         AS alloc_date_current_fmt,
               da2.period             AS alloc_date_current_prd,
               da2.alloc_flag         AS alloc_flag_current,
               dp2.depot_name         AS depot_name_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                      AS depot_name_current_hl,

               ifnull(dpc3.displayed_depot_code, da3.allocation)
                                      AS alloc_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS alloc_next_hl,
               dp3.depot_id           AS depot_id_next,
               da3.alloc_date         AS alloc_date_next,
               da3.alloc_date         AS alloc_date_next_fmt,
               da3.period             AS alloc_date_next_prd,
               da3.alloc_flag         AS alloc_flag_next,
               dp3.depot_name         AS depot_name_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS depot_name_next_hl,

               IFNULL(dc.common_name, dc.identifier) 
                                      AS loco_type,
               CONCAT("locoqry.php?action=class&type=D&id=", dc.d_class_id) 
                                      AS loco_type_hl,
               IFNULL(dc.common_name, dc.identifier) 
                                      AS loco_type_fmt,
               dc.wheel_arrangement   AS wheel_arr,
               CONCAT("misc.php?page=wheel_arr&id=", dc.wheel_arrangement) 
                                      AS wheel_arr_hl,
               dcv.designer           AS designer,
               CONCAT("people.php?page=cme&name=",dcv.designer) 
                                      AS designer_hl,
               dcv.identifier         AS class_type
        
        FROM   d_alloc da2

        LEFT JOIN d_alloc da1
        ON     da1.loco_id = da2.loco_id
        AND    concat(da1.alloc_date, da1.seq) = (SELECT MAX(concat(da1a.alloc_date,
                                                                    da1a.seq))
                                                  FROM   d_alloc da1a
                                                  WHERE (da1a.alloc_date < da2.alloc_date
                                                     OR     (da1a.alloc_date = da2.alloc_date
                                                         AND da1a.seq        < da2.seq))
                                                  AND    da1a.loco_id = da2.loco_id)

        LEFT JOIN d_alloc da3
        ON     da3.loco_id = da2.loco_id
        AND    concat(da3.alloc_date, da3.seq) = (SELECT MIN(concat(da3a.alloc_date,
                                                                    da3a.seq))
                                                  FROM   d_alloc da3a
                                                  WHERE (da3a.alloc_date > da2.alloc_date
                                                     OR     (da3a.alloc_date = da2.alloc_date
                                                         AND da3a.seq        > da2.seq))
                                                  AND    da3a.loco_id = da2.loco_id)

        LEFT JOIN ref_depot_codes dpc1
        ON     dpc1.depot_code = da1.allocation
        AND    dpc1.date_from = (SELECT max(dpc1a.date_from)
                                 FROM   ref_depot_codes dpc1a
                                 WHERE  dpc1a.depot_code = da1.allocation
                                 AND    dpc1a.date_from <= da1.alloc_date)

        LEFT JOIN ref_depot dp1
        ON     dp1.depot_id = dpc1.depot_id
        
        JOIN   ref_depot_codes dpc2
        ON     dpc2.depot_code = da2.allocation
        AND    dpc2.date_from = (SELECT max(dpc2a.date_from)
                                 FROM   ref_depot_codes dpc2a
                                 WHERE  dpc2a.depot_code = da2.allocation
                                 AND    dpc2a.date_from <= da2.alloc_date)

        JOIN   ref_depot dp2
        ON     dp2.depot_id = dpc2.depot_id
        AND    dp2.depot_id = ' . $id . '
        
        LEFT JOIN ref_depot_codes dpc3
        ON     dpc3.depot_code = da3.allocation
        AND    dpc3.date_from = (SELECT max(dpc3a.date_from)
                                 FROM   ref_depot_codes dpc3a
                                 WHERE  dpc3a.depot_code = da3.allocation
                                 AND    dpc3a.date_from <= da3.alloc_date)

        LEFT JOIN ref_depot dp3
        ON     dp3.depot_id = dpc3.depot_id
        
        JOIN   d_class_link dcl
        ON     dcl.loco_id = da2.loco_id
        AND    dcl.start_date = (SELECT max(dcla.start_date)
                                 FROM   d_class_link dcla
                                 WHERE  dcla.loco_id = da2.loco_id
                                 AND    dcla.start_date <= da2.alloc_date)

        JOIN   d_class dc
        ON     dc.d_class_id = dcl.d_class_id
        JOIN   d_class_var dcv
        ON     dcv.d_class_id = dcl.d_class_id
        AND    dcv.d_class_var_id = dcl.d_class_var_id
        
        JOIN   d_nums dn
        ON     dn.loco_id = da2.loco_id
        AND    dn.start_date =  (SELECT max(dna.start_date)
                                 FROM   d_nums dna
                                 WHERE  dna.loco_id = da2.loco_id
                                 AND    dna.start_date <= da2.alloc_date)

        UNION
        
        SELECT "Electric"             AS long_type,
               "E"                    AS type,
               ea2.loco_id            AS loco_id,
               en.number              AS number,
               en.number_type         AS number_type,
               CONCAT("locoqry.php?action=locodata&id=", ea2.loco_id, "&type=E&loco=", en.number)
                                      AS number_hl,
               ifnull(dpc1.displayed_depot_code, ea1.allocation)
                                      AS alloc_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS alloc_prior_hl,
               dp1.depot_id           AS depot_id_prior,
               ea1.alloc_date         AS alloc_date_prior,
               ea1.alloc_date         AS alloc_date_prior_fmt,
               ea1.period             AS alloc_date_prior_prd,
               ea1.alloc_flag         AS alloc_flag_prior,
               dp1.depot_name         AS depot_name_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS depot_name_prior_hl,

               ifnull(dpc2.displayed_depot_code, dpc2.depot_code)  AS alloc_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                      AS alloc_current_hl,
               dp2.depot_id           AS depot_id_current,
               ea2.alloc_date         AS alloc_date_current,
               ea2.alloc_date         AS alloc_date_current_fmt,
               ea2.period             AS alloc_date_current_prd,
               ea2.alloc_flag         AS alloc_flag_current,
               dp2.depot_name         AS depot_name_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                      AS depot_name_current_hl,

               ifnull(dpc3.displayed_depot_code, ea3.allocation)
                                      AS alloc_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS alloc_next_hl,
               dp3.depot_id           AS depot_id_next,
               ea3.alloc_date         AS alloc_date_next,
               ea3.alloc_date         AS alloc_date_next_fmt,
               ea3.period             AS alloc_date_next_prd,
               ea3.alloc_flag         AS alloc_flag_next,
               dp3.depot_name         AS depot_name_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS depot_name_next_hl,
               IFNULL(ec.common_name, ec.identifier) 
                                      AS loco_type,
               CONCAT("locoqry.php?action=class&type=E&id=", ec.e_class_id) 
                                      AS loco_type_hl,
               IFNULL(ec.common_name, ec.identifier)
                                      AS loco_type_fmt,
               ec.wheel_arrangement   AS wheel_arr,
               CONCAT("misc.php?page=wheel_arr&id=", ec.wheel_arrangement) 
                                      AS wheel_arr_hl,
               ecv.designer           AS designer,
               CONCAT("people.php?page=cme&name=",ecv.designer) 
                                      AS designer_hl,
               ecv.identifier         AS class_type
        
        FROM   e_alloc ea2
        LEFT JOIN e_alloc ea1
        ON     ea1.loco_id = ea2.loco_id
        AND    concat(ea1.alloc_date, ea1.seq) = (SELECT MAX(concat(ea1a.alloc_date,
                                                                    ea1a.seq))
                                                  FROM   e_alloc ea1a
                                                  WHERE (ea1a.alloc_date < ea2.alloc_date
                                                     OR     (ea1a.alloc_date = ea2.alloc_date
                                                         AND ea1a.seq        < ea2.seq))
                                                  AND    ea1a.loco_id = ea2.loco_id)

        LEFT JOIN e_alloc ea3
        ON     ea3.loco_id = ea2.loco_id
        AND    concat(ea3.alloc_date, ea3.seq) = (SELECT MIN(concat(ea3a.alloc_date,
                                                                    ea3a.seq))
                                                  FROM   e_alloc ea3a
                                                  WHERE (ea3a.alloc_date > ea2.alloc_date
                                                     OR     (ea3a.alloc_date = ea2.alloc_date
                                                         AND ea3a.seq        > ea2.seq))
                                                  AND    ea3a.loco_id = ea2.loco_id)

        LEFT JOIN ref_depot_codes dpc1
        ON     dpc1.depot_code = ea1.allocation
        AND    dpc1.date_from = (SELECT max(dpc1a.date_from)
                                 FROM   ref_depot_codes dpc1a
                                 WHERE  dpc1a.depot_code = ea1.allocation
                                 AND    dpc1a.date_from <= ea1.alloc_date)

        LEFT JOIN ref_depot dp1
        ON     dp1.depot_id = dpc1.depot_id
        
        JOIN   ref_depot_codes dpc2
        ON     dpc2.depot_code = ea2.allocation
        AND    dpc2.date_from = (SELECT max(dpc2a.date_from)
                                 FROM   ref_depot_codes dpc2a
                                 WHERE  dpc2a.depot_code = ea2.allocation
                                 AND    dpc2a.date_from <= ea2.alloc_date)

        JOIN   ref_depot dp2
        ON     dp2.depot_id = dpc2.depot_id
        AND    dp2.depot_id = ' . $id . '
        
        LEFT JOIN ref_depot_codes dpc3
        ON     dpc3.depot_code = ea3.allocation
        AND    dpc3.date_from = (SELECT max(dpc3a.date_from)
                                 FROM   ref_depot_codes dpc3a
                                 WHERE  dpc3a.depot_code = ea3.allocation
                                 AND    dpc3a.date_from <= ea3.alloc_date)

        LEFT JOIN ref_depot dp3
        ON     dp3.depot_id = dpc3.depot_id
        
        JOIN   e_class_link ecl
        ON     ecl.loco_id = ea2.loco_id
        AND    ecl.start_date = (SELECT max(ecla.start_date)
                                 FROM   e_class_link ecla
                                 WHERE  ecla.loco_id = ea2.loco_id
                                 AND    ecla.start_date <= ea2.alloc_date)

        JOIN   e_class ec
        ON     ec.e_class_id = ecl.e_class_id
        JOIN   e_class_var ecv
        ON     ecv.e_class_id = ecl.e_class_id
        AND    ecv.e_class_var_id = ecl.e_class_var_id
        
        JOIN   e_nums en
        ON     en.loco_id = ea2.loco_id
        AND    en.start_date =  (SELECT max(ena.start_date)
                                 FROM   e_nums ena
                                 WHERE  ena.loco_id = ea2.loco_id
                                 AND    ena.start_date <= ea2.alloc_date)

        ORDER BY alloc_date_current, type, loco_id';     
*/ 
 //echo $sql;

  //$sql = 'select * from dw_depot_alloc
  //        where  depot_id = ' . $id . '
  //        ORDER BY alloc_date_current, type, loco_id';     

  $result = $db->execute($sql);

  if ($result)
  {
  while ($row = mysqli_fetch_assoc($result))
  {
    $extra = "";
    if ($row['alloc_flag_prior'] == "N")
      $row['depot_name_prior'] .= " <font color=green><strong>(New)</strong></font>";

    if ($row['alloc_flag_current'] == "N")
      $extra = "<font color=green><strong> (New)</strong></font>";

    if ($row['alloc_next'] == "98W")
    {
      $row['depot_name_next'] = "<font color=red><strong>Withdrawn</strong></font>";
      $row['alloc_next'] = "";
    }

    if ($row['alloc_prior'] == "98W")
    {
      $row['depot_name_prior'] = "<font color=red><strong>Withdrawn</strong></font>";
      $row['alloc_prior'] = "";
      $extra = "<font color=orange><strong> (R)</strong></font>";
    }

    if ($row['alloc_next'] == "98S")
    {
      $row['depot_name_next'] = "<font color=orange><strong>To Store</strong></font>";
      $row['alloc_next'] = "";
    }

    if ($row['type'] != "S")
    {
      if ($row['number_type'] == "PRT")
      {
        if ($row['type'] == "D")
          $row['number'] = fn_d_pfx($row['number']);
        else
          $row['number'] = fn_e_pfx($row['number']);
      }
    }

    if ($row['alloc_date_current'] == "01/01/1948")
      $row['alloc_date_current'] = "At Nationalisation";

    $row['alloc_date_current'] = "<strong>" . fn_fdate($row['alloc_date_current']) . $extra 
                                                                                   . "</strong>";
    $row['alloc_current'] = "<strong>" . $row['alloc_current'] . "</strong>";
    $row['alloc_date_prior'] = fn_fdate($row['alloc_date_prior']);
    $row['alloc_date_next'] = fn_fdate($row['alloc_date_next']);
    
    if (!empty($row['alloc_date_prior_prd']))
      $row['alloc_date_prior_prd'] = fn_prd($row['alloc_date_prior_prd']);
    if (!empty($row['alloc_date_current_prd']))
      $row['alloc_date_current_prd'] = fn_prd($row['alloc_date_current_prd']);
    if (!empty($row['alloc_date_next_prd']))
      $row['alloc_date_next_prd'] = fn_prd($row['alloc_date_next_prd']);

    $tb->dump_data($row);
  }
  
    if ($db->count_select())
    $tb->dump_data(NULL);
  }
  
  $file_cache->end_cache();
?>
