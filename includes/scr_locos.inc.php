<?php

  if (strlen($id) == 5)
  {
    echo "<div id=\"navcontainer\">";
    echo "<ul id=\"navlist\">";
    echo "<li><a href=\"sites.php?page=scrapyards&subpage=main&id="  .$id. 
         "\">Scrapyard Details</a></li>";
    echo "<li id=\"active\"><a href=\"#\" id=\"current\">Locos Scrapped by Yard</a></li>";
    if ($imgct > 0)
      echo "<li><a href=\"sites.php?page=scrapyards&subpage=gallery&id="  .$id. 
           "\">Gallery</a></li>";
    if ($vlog > 0)
      echo "<li><a href=\"sites.php?page=scrapyards&subpage=vlog&id="  .$id. 
           "\">Visit Log</a></li>";
    echo "<li><a href=\"sites.php?page=scrapyards&subpage=summary&id="  .$id. 
         "\">Scrapyard Summary</a></li>";
    echo "</ul>";
    echo "</div>";
  }
  else
  {
    echo "<div id=\"navcontainer\">";
    echo "<ul id=\"navlist\">";
    echo "<li><a href=\"sites.php?page=scrapyards&subpage=main&id="  .$id. 
         "\">Scrap Merchant Details</a></li>";
    echo "<li id=\"active\"><a href=\"#\" id=\"current\">Locos Scrapped by Merchant</a></li>";
    echo "<li><a href=\"sites.php?page=scrapyards&subpage=summary&id="  .$id. 
         "\">Group Summary</a></li>";
    echo "</ul>";
    echo "</div>";
  }

  include_once("lib/date_span.class.php");
  include_once("lib/cache.class.php");

  $tb = new MyTables("locomanuf");
  $dt = new date_span();
  /**
   * call the class after the include
   */
  $file_cache=new cache();
  $file_cache->start_cache();


  $sql = $sqlsW = $sqldw = $sqlew = "";

/* Steam */

  if ((!empty($type) && $type == "S") || empty($type))
  {
    if (!empty($cid))
    {
      $sqlsw = " AND sc.s_class_id = " . $cid . " ";
    }
    else
      $sqlsw = " ";

    $sql = 'select "Steam" AS longtype,
                 "S"       AS type,
                 s.loco_id,
                 sn.number,
                 sn.number_type,
                 sc.identifier,
                 concat("locoqry.php?action=class&type=S&id=",
                        sc.s_class_id) AS identifier_hl,
                 concat("S_", sc.identifier)   AS identifier_fmt,
                 s.b_date,
                 concat(date_format(s.b_date, "%Y%m%d"), lpad(s.loco_id, 10, "0"))
                                                                            AS b_date_fmt,
                 sc.wheel_arrangement,
                 concat("misc.php?page=wheel_arr&id=", 
                        sc.wheel_arrangement) AS wheel_arrangement_hl,
                 concat("locoqry.php?action=locodata&type=S&id=",
                        s.loco_id,"&loco=",sn.number) AS number_hl,
                 ifnull(ifnull(sc.prg_company, sc.big4_company), "BR") AS company,
                 s.s_date,
                 concat(date_format(s.s_date, "%Y%m%d"),  lpad(s.loco_id, 10, "0")) 
                                                                            AS s_date_fmt,
                 s.w_date,
                 concat(date_format(s.w_date, "%Y%m%d"), lpad(s.loco_id, 10, "0"))
                                                                            AS w_date_fmt,
                 s.last_depot,
                 concat("sites.php?page=depots&action=query&id=", 
                        dp.depot_id) AS last_depot_hl,
                 dp.depot_name       AS last_depot_name,
                 concat("sites.php?page=depots&action=query&id=", 
                        dp.depot_id) AS last_depot_name_hl,
                 round(datediff(F.wdate, F.bdate) / 365, 3)  AS service_prd,
                 round(datediff(F.ddate, F.wdate) / 365, 3)  AS cond_prd,
                 round(datediff(F.ddate, F.bdate) / 365, 3)  AS tot_age
          from   steam s

          join   s_class_link scl
          on     scl.loco_id = s.loco_id
          and    scl.start_date = (SELECT max(scl1.start_date)
                                   FROM   s_class_link scl1
                                   WHERE  scl1.loco_id = s.loco_id
                                   AND    scl1.start_date < s.w_date)

          join   s_class sc
          on     sc.s_class_id = scl.s_class_id ' . $sqlsw . '

          join   s_nums sn
          on     sn.loco_id = s.loco_id
          and    sn.start_date =  (SELECT max(sn1.start_date)
                                   FROM   s_nums sn1
                                   WHERE  sn1.loco_id = s.loco_id
                                   AND    sn1.start_date < s.w_date)

          LEFT JOIN ref_depot_codes dpc
          ON     dpc.depot_code = s.last_depot
          AND    dpc.date_from = (SELECT max(dpc1.date_from)
                                  FROM   ref_depot_codes dpc1
                                  WHERE  dpc1.depot_code = s.last_depot
                                  AND    dpc1.date_from <= s.w_date)

          LEFT JOIN ref_depot dp
          ON     dp.depot_id = dpc.depot_id

          JOIN  (SELECT s1.loco_id,
                        concat(substr(s1.w_date, 1, 8),
                               case substr(s1.w_date, 9, 2)
                                 when "00" THEN "15"
                                 else substr(s1.w_date, 9, 2)
                               end) AS wdate,
                        concat(substr(s1.b_date, 1, 8),
                               case substr(s1.b_date, 9, 2)
                                 when "00" THEN "15"
                                 else substr(s1.b_date, 9, 2)
                               end) AS bdate,
                        concat(substr(s1.s_date, 1, 8),
                               case substr(s1.s_date, 9, 2)
                                 when "00" THEN "15"
                                 else substr(s1.s_date, 9, 2)
                               end) AS ddate
                 FROM   steam s1
                 WHERE  s1.scrapyard_code like "' . $id . '%") AS F

          ON     F.loco_id = s.loco_id

          where  s.scrapyard_code like "' . $id . '%"';
          
          // echo $sql;
  }

  if ((!empty($type) && $type == "D") || empty($type))
  {
    if (!empty($cid))
    {
      $sqldw = " AND dc.d_class_id = " . $cid . " ";
    }
    else
      $sqldw = " ";

    if (empty($type))
      $sql .= " UNION ";

    $sql .= 'select "Diesel" AS longtype,
                 "D"         AS type,
                 d.loco_id,
                 dn.number,
                 dn.number_type,
                 dc.identifier,
                 concat("locoqry.php?action=class&type=D&id=",dc.d_class_id) AS identifier_hl,
                 concat("D_", dc.identifier)   AS identifier_fmt,
                 d.b_date,
                 concat(date_format(d.b_date, "%Y%m%d"), lpad(d.loco_id, 10, "0"))
                                                                            AS b_date_fmt,
                 dc.wheel_arrangement,
                 concat("misc.php?page=wheel_arr&id=", 
                                dc.wheel_arrangement) AS wheel_arrangement_hl,
                 concat("locoqry.php?action=locodata&type=D&id=",
                        d.loco_id,"&loco=",dn.number) AS number_hl,
                 "BR" AS company,
                 d.s_date,
                 concat(date_format(d.s_date, "%Y%m%d"),  lpad(d.loco_id, 10, "0"))
                                                                            AS s_date_fmt,
                 d.w_date,
                 concat(date_format(d.w_date, "%Y%m%d"), lpad(d.loco_id, 10, "0"))
                                                                            AS w_date_fmt,
                 d.last_depot,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) AS last_depot_hl,
                 dp.depot_name      AS last_depot_name,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                                                           AS last_depot_name_hl,
                 round(datediff(F.wdate, F.bdate) / 365, 3)  AS service_prd,
                 round(datediff(F.ddate, F.wdate) / 365, 3)  AS cond_prd,
                 round(datediff(F.ddate, F.bdate) / 365, 3)  AS tot_age
          from   diesels d

          join   d_class_link dcl
          on     dcl.loco_id = d.loco_id
          and    dcl.start_date = (SELECT max(dcl1.start_date)
                                   FROM   d_class_link dcl1
                                   WHERE  dcl1.loco_id = d.loco_id
                                   AND    dcl1.start_date < d.w_date)

          join   d_class dc
          on     dc.d_class_id = dcl.d_class_id ' . $sqldw . '

          join   d_nums dn
          on     dn.loco_id = d.loco_id
          and    dn.start_date =  (SELECT max(dn1.start_date)
                                   FROM   d_nums dn1
                                   WHERE  dn1.loco_id = d.loco_id
                                   AND    dn1.start_date <= d.w_date)

          LEFT JOIN ref_depot_codes dpc
          ON     dpc.depot_code = d.last_depot
          AND    dpc.date_from = (SELECT max(dpc1.date_from)
                                  FROM   ref_depot_codes dpc1
                                  WHERE  dpc1.depot_code = d.last_depot
                                  AND    dpc1.date_from <= d.w_date)

          LEFT JOIN ref_depot dp
          ON     dp.depot_id = dpc.depot_id

          JOIN  (SELECT d1.loco_id,
                        concat(substr(d1.w_date, 1, 8),
                               case substr(d1.w_date, 9, 2)
                                 when "00" THEN "15"
                                 else substr(d1.w_date, 9, 2)
                               end) AS wdate,
                        concat(substr(d1.b_date, 1, 8),
                               case substr(d1.b_date, 9, 2)
                                 when "00" THEN "15"
                                 else substr(d1.b_date, 9, 2)
                               end) AS bdate,
                        concat(substr(d1.s_date, 1, 8),
                               case substr(d1.s_date, 9, 2)
                                 when "00" THEN "15"
                                 else substr(d1.s_date, 9, 2)
                               end) AS ddate
                 FROM   diesels d1
                 WHERE  d1.scrapyard_code like "' . $id . '%") AS F

          ON     F.loco_id = d.loco_id

          where  d.scrapyard_code like "' . $id . '%"';   

//echo $sql;
  }

  if ((!empty($type) && $type == "E") || empty($type))
  {
    if (!empty($cid))
    {
      $sqlew = " AND ec.e_class_id = " . $cid . " ";
    }
    else
      $sqlew = " ";

    if (empty($type))
      $sql .= " UNION ";

    $sql .= 'select "Electric" AS longtype,
                 "E"           AS type,
                 e.loco_id,
                 en.number,
                 en.number_type,
                 ec.identifier,
                 concat("locoqry.php?action=class&type=E&id=",ec.e_class_id) AS identifier_hl,
                 concat("E_", ec.identifier)   AS identifier_fmt,
                 e.b_date,
                 concat(date_format(e.b_date, "%Y%m%d"), lpad(e.loco_id, 10, "0"))
                                                                            AS b_date_fmt,
                 ec.wheel_arrangement,
                 concat("misc.php?page=wheel_arr&id=", 
                                ec.wheel_arrangement) AS wheel_arrangement_hl,
                 concat("locoqry.php?action=locodata&type=E&id=",
                        e.loco_id,"&loco=",en.number) AS number_hl,
                 "BR" AS company,
                 e.s_date,
                 concat(date_format(e.s_date, "%Y%m%d"),  lpad(e.loco_id, 10, "0"))
                                                                            AS s_date_fmt,
                 e.w_date,
                 concat(date_format(e.w_date, "%Y%m%d"), lpad(e.loco_id, 10, "0"))
                                                                            AS w_date_fmt,
                 e.last_depot,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) AS last_depot_hl,
                 dp.depot_name      AS last_depot_name,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                                                            AS last_depot_name_hl,
                 round(datediff(F.wdate, F.bdate) / 365, 3)  AS service_prd,
                 round(datediff(F.ddate, F.wdate) / 365, 3)  AS cond_prd,
                 round(datediff(F.ddate, F.bdate) / 365, 3)  AS tot_age
          from   electric e

          join   e_class_link ecl
          on     ecl.loco_id = e.loco_id
          and    ecl.start_date = (SELECT max(ecl1.start_date)
                                   FROM   e_class_link ecl1
                                   WHERE  ecl1.loco_id = e.loco_id
                                   AND    ecl1.start_date < e.w_date)

          join   e_class ec
          on     ec.e_class_id = ecl.e_class_id ' . $sqlew . '

          join   e_nums en
          on     en.loco_id = e.loco_id
          and    en.start_date =  (SELECT max(en1.start_date)
                                   FROM   e_nums en1
                                   WHERE  en1.loco_id = e.loco_id
                                   AND    en1.start_date < e.w_date)

          LEFT JOIN ref_depot_codes dpc
          ON     dpc.depot_code = e.last_depot
          AND    dpc.date_from = (SELECT max(dpc1.date_from)
                                  FROM   ref_depot_codes dpc1
                                  WHERE  dpc1.depot_code = e.last_depot
                                  AND    dpc1.date_from <= e.w_date)

          LEFT JOIN ref_depot dp
          ON     dp.depot_id = dpc.depot_id

          JOIN  (SELECT e1.loco_id,
                        concat(substr(e1.w_date, 1, 8),
                               case substr(e1.w_date, 9, 2)
                                 when "00" THEN "15"
                                 else substr(e1.w_date, 9, 2)
                               end) AS wdate,
                        concat(substr(e1.b_date, 1, 8),
                               case substr(e1.b_date, 9, 2)
                                 when "00" THEN "15"
                                 else substr(e1.b_date, 9, 2)
                               end) AS bdate,
                        concat(substr(e1.s_date, 1, 8),
                               case substr(e1.s_date, 9, 2)
                                 when "00" THEN "15"
                                 else substr(e1.s_date, 9, 2)
                               end) AS ddate
                 FROM   electric e1
                 WHERE  e1.scrapyard_code like "' . $id . '%") AS F

          ON     F.loco_id = e.loco_id

          where  e.scrapyard_code like "' . $id . '%"';
  }

  $sql .= " ORDER BY s_date ASC";

//  echo $sql;

  $result = $db->execute($sql);

  if (($scount = $db->count_select()) > 0)
  {
    $tbs = new MyTables("smanuf");

    $tbs->add_caption("Locomotives");
    $tbs->sortable();
    $tbs->colour_coordinate("Y");
    $tbs->add_column("longtype",          "Type",                5);
    $tbs->add_column("company",           "Company",             4);
    $tbs->add_column("identifier",        "Class",               9);
    $tbs->add_column("wheel_arrangement", "Wheels",              6);
    $tbs->add_column("number",            "Number when Cut",     8);
    $tbs->add_column("b_date",            "Date Built",         10);
    $tbs->add_column("w_date",            "Date Withdrawn",     10);
    $tbs->add_column("service_prd",       "Service (yrs)",       5);
    $tbs->add_column("cond_prd",          "Awaiting Scrap (yrs)",5);
    $tbs->add_column("last_depot",        " ",                   5);
    $tbs->add_column("last_depot_name",   "Depot on Withdrawal",17);
    $tbs->add_column("s_date",            "Date Scrapped",      10);
    $tbs->add_column("tot_age",           "Age (yrs)",           5);

    $last_lid = 0;
    while ($row = mysqli_fetch_assoc($result))
    {
      if (($row['type'] == "D") && $row['number_type'] == "PRT")
        $row['number'] = fn_d_pfx($row['number']);
      else
      if (($row['type'] == "E") && $row['number_type'] == "PRT")
        $row['number'] = fn_e_pfx($row['number']);

      $row['b_date'] = fn_fdate($row['b_date']);
      $row['w_date'] = fn_fdate($row['w_date']);
      $row['s_date']  = fn_fdate($row['s_date']);

      $tbs->dump_data($row);
    }
  }

  if ($db->count_select())
    $tbs->dump_data(NULL);

  $db->close();

  $file_cache->end_cache();
?>
