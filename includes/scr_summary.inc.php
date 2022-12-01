<?php

  if (strlen($id) == 5)
  {
    echo "<div id=\"navcontainer\">";
    echo "<ul id=\"navlist\">";
    echo "<li><a href=\"sites.php?page=scrapyards&subpage=main&id="  .$id. 
         "\">Scrapyard Details</a></li>";
    echo "<li><a href=\"sites.php?page=scrapyards&subpage=locos&id="  .$id. 
         "\">Locos Scrapped by Yard</a></li>";
    if ($imgct > 0)
      echo "<li><a href=\"sites.php?page=scrapyards&subpage=gallery&id="  .$id. 
           "\">Gallery</a></li>";
    if ($vlog > 0)
      echo "<li><a href=\"sites.php?page=scrapyards&subpage=vlog&id="  .$id. 
           "\">Visit Log</a></li>";
    echo "<li id=\"active\"><a href=\"#\" id=\"current\">Scrapyard Summary</a></li>";
    echo "</ul>";
    echo "</div>";
  }
  else
  if (strlen($id) == 3)
  {
    echo "<div id=\"navcontainer\">";
    echo "<ul id=\"navlist\">";
    echo "<li><a href=\"sites.php?page=scrapyards&subpage=main&id="  .$id. 
         "\">Scrap Merchant Details</a></li>";
    echo "<li><a href=\"sites.php?page=scrapyards&subpage=locos&id="  .$id. 
         "\">Locos Scrapped by Merchant</a></li>";
    echo "<li id=\"active\"><a href=\"#\" id=\"current\">Group Summary</a></li>";
    echo "</ul>";
    echo "</div>";
  }

  $tb = new MyTables("locomanuf");

/* Steam */

  $sql = 'SELECT "Steam"               AS longtype,
                 "S"                   AS type,
                 CONCAT(sc.identifier, IF(sc.common_name IS NULL, "", 
                                          CONCAT(" (", sc.common_name, ")")))
                                       AS identifier,
                 CONCAT("locoqry.php?action=class&type=S&id=", sc.s_class_id) 
                                       AS identifier_hl,
                 CONCAT("S_", sc.identifier) AS identifier_fmt,
                 p.surname             AS designer,
                 CONCAT("people.php?page=cme&id=", sc.designer_id)
                                       AS designer_hl,
                 sc.wheel_arrangement  AS wheel_arrangement,
                 CONCAT("misc.php?page=wheel_arr&id=", sc.wheel_arrangement) 
                                       AS wheel_arrangement_hl,
                 ifnull(ifnull(sc.prg_company, sc.big4_company), "BR") 
                                       AS company,
                 concat("companies.php?page=", ifnull(sc.big4_company, "BR"),
                                               CASE ifnull(sc.prg_company, "#")
                                                   WHEN "#" THEN ""
                                               ELSE
                                                   concat("&subpage=", sc.prg_company)
                                               END) AS company_hl,
                 count(*)              AS total_scrapped
          FROM   steam s

          JOIN   s_class_link scl
          ON     scl.loco_id = s.loco_id
          AND    scl.start_date = (SELECT max(scl1.start_date)
                                   FROM   s_class_link scl1
                                   WHERE  scl1.loco_id = s.loco_id
                                   AND    scl1.start_date < s.w_date)

          JOIN   s_class sc
          ON     sc.s_class_id = scl.s_class_id

          LEFT JOIN ref_people p
          ON     sc.designer_id = p.p_id

          WHERE  s.scrapyard_code LIKE "' . $id . '%"

          GROUP BY 
                 type, 
                 identifier,        identifier_hl,
                 designer,          designer_hl,
                 wheel_arrangement, wheel_arrangement_hl,
                 company,           company_hl

          UNION
          
          SELECT "Diesel"              AS longtype,
                 "D"                   AS type,
                 CONCAT(dc.identifier, IF(dc.common_name IS NULL, "", 
                                          CONCAT(" (", dc.common_name, ")")))
                                       AS identifier,
                 CONCAT("locoqry.php?action=class&type=D&id=", dc.d_class_id) 
                                       AS identifier_hl,
                 CONCAT("D_", dc.identifier) AS identifier_fmt,
                 NULL                  AS designer,
                 NULL                  AS designer_hl,
                 dc.wheel_arrangement  AS wheel_arrangement,
                 CONCAT("misc.php?page=wheel_arr&id=", dc.wheel_arrangement) 
                                       AS wheel_arrangement_hl,
                 "BR"                  AS company,
                 "companies.php?page=BR"
                                       AS company_hl,
                 count(*)              AS total_scrapped
          FROM   diesels d

          JOIN   d_class_link dcl
          ON     dcl.loco_id = d.loco_id
          AND    dcl.start_date = (SELECT max(dcl1.start_date)
                                   FROM   d_class_link dcl1
                                   WHERE  dcl1.loco_id = d.loco_id
                                   AND    dcl1.start_date < d.w_date)

          JOIN   d_class dc
          ON     dc.d_class_id = dcl.d_class_id

          WHERE  d.scrapyard_code LIKE "' . $id . '%"

          GROUP BY 
                 type, 
                 identifier,        identifier_hl,
                 designer,          designer_hl,
                 wheel_arrangement, wheel_arrangement_hl,
                 company,           company_hl

          UNION
          
          SELECT "Electric"            AS longtype,
                 "E"                   AS type,
                 CONCAT(ec.identifier, IF(ec.common_name IS NULL, "", 
                                          CONCAT(" (", ec.common_name, ")")))
                                       AS identifier,
                 CONCAT("locoqry.php?action=class&type=E&id=", ec.e_class_id) 
                                       AS identifier_hl,
                 CONCAT("E_", ec.identifier) AS identifier_fmt,
                 NULL                  AS designer,
                 NULL                  AS designer_hl,
                 ec.wheel_arrangement  AS wheel_arrangement,
                 CONCAT("misc.php?page=wheel_arr&id=", ec.wheel_arrangement) 
                                       AS wheel_arrangement_hl,
                 "BR"                  AS company,
                 "companies.php?page=BR"
                                       AS company_hl,
                 count(*)              AS total_scrapped
          FROM   electric e

          JOIN   e_class_link ecl
          ON     ecl.loco_id = e.loco_id
          AND    ecl.start_date = (SELECT max(ecl1.start_date)
                                   FROM   e_class_link ecl1
                                   WHERE  ecl1.loco_id = e.loco_id
                                   AND    ecl1.start_date < e.w_date)

          JOIN   e_class ec
          ON     ec.e_class_id = ecl.e_class_id

          WHERE  e.scrapyard_code LIKE "' . $id . '%"

          GROUP BY 
                 type, 
                 identifier,        identifier_hl,
                 designer,          designer_hl,
                 wheel_arrangement, wheel_arrangement_hl,
                 company,           company_hl

          ORDER BY
                 type,
                 company,
                 identifier';
 //echo $sql;

  $result = $db->execute($sql);

  if (($scount = $db->count_select()) > 0)
  {
    $tbs = new MyTables("smanuf");

    $tbs->add_caption("Scrap Summary");
    $tbs->sortable();
    $tbs->colour_coordinate("Y");
    $tbs->add_column("longtype",          "Type",               8);
    $tbs->add_column("company",           "Company",            8);
    $tbs->add_column("designer",          "Designer",           10);
    $tbs->add_column("wheel_arrangement", "Wheels",             10);
    $tbs->add_column("identifier",        "Class",              20);
    $tbs->add_column("total_scrapped",    "Scrapped",           44);

    while ($row = mysqli_fetch_assoc($result))
      $tbs->dump_data($row);

    $tbs->dump_data(NULL);
  }

  //$db->close();

?>
