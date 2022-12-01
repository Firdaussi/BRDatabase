<?php

  echo "<div id=\"navcontainer\">";
  echo "<ul id=\"navlist\">";
  echo "<li><a href=\"sites.php?page=scrapyards&subpage=main&id="  .$id. "\">Scrapyard Details</a></li>";
  echo "<li><a href=\"sites.php?page=scrapyards&subpage=locos&id="  .$id. "\">Locos Scrapped</a></li>";
  echo "<li id=\"active\"><a href=\"#\" id=\"current\">Group</a></li>";
  echo "<li><a href=\"sites.php?page=scrapyards&subpage=summary&id="  .$id. "\">Scrap Summary</a></li>";
  if ($imgct > 0)
    echo "<li><a href=\"sites.php?page=scrapyards&subpage=gallery&id="  .$id. "\">Gallery</a></li>";
  echo "</ul>";
  echo "</div>";

  $tb = new MyTables("locomanuf");

  $sql = 'SELECT scrapyard_code
          FROM   ref_scrapyard
          WHERE  substr(scrapyard_code, 1, 3) = "' . $id . '"';

  $result = $db->execute($sql);

  $nx = 0;
  while ($row = mysqli_fetch_array($result))
  {
    if ($nx == 0)
      $scr_grp = '"' . $row['scrapyard_code'] . '"';
    else
      $scr_grp .= ', "' . $row['scrapyard_code'] . '"';

    $nx++;
  }

  if (empty($scr_grp))
    $scr_grp = '"' . $id . '"';

  $sql = 'select "Steam" AS type,
                 concat(sm.merchant_name, " (", sy.location, ")") AS sc_name,
                 concat("sites.php?page=scrapyards&subpage=main&id=", sm.merchant_code)
                                                            AS sc_name_hl,
                 s.loco_id,
                 sn.number,
                 sn.number_type,
                 sc.identifier,
                 concat("locoqry.php?action=class&type=S&id=",sc.s_class_id) 
                                                            AS identifier_hl,
                 s.date_completed,
                 date_format(s.date_completed, "%Y%m%d")    AS date_completed_fmt,
                 sc.wheel_arrangement,
                 concat("misc.php?page=wheel_arr&id=", 
                                sc.wheel_arrangement)       AS wheel_arrangement_hl,
                 concat("locoqry.php?action=locodata&type=S&id=",s.loco_id,"&loco=",sn.number) 
                                                            AS number_hl,
                 ifnull(ifnull(sc.prg_company, sc.big4_company), "BR") 
                                                            AS company,
                 s.disposal_date,
                 date_format(s.disposal_date, "%Y%m%d")     AS disposal_date_fmt,
                 s.date_withdrawn,
                 date_format(s.date_withdrawn, "%Y%m%d")    AS date_withdrawn_fmt,
                 s.last_depot,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                                            AS last_depot_hl,
                 dp.depot_name                              AS last_depot_name,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                                            AS last_depot_name_hl
          from   steam s

          join   s_class_link scl
          on     scl.loco_id = s.loco_id
          and    s.date_withdrawn BETWEEN ifnull(scl.start_date, "1750-01-01")
                                  AND     ifnull(scl.end_date,   "2999-01-01")

          join   s_class sc
          on     sc.s_class_id = scl.s_class_id

          join   s_nums sn
          on     sn.loco_id = s.loco_id
          and    s.date_withdrawn BETWEEN sn.start_date
                                  AND     ifnull(sn.end_date,   "2999-01-01")

          LEFT JOIN ref_depot_codes dpc
          ON     dpc.depot_code = s.last_depot
          AND    s.date_withdrawn BETWEEN dpc.date_from
                                  AND     ifnull(dpc.date_to,   "2999-01-01")

          LEFT JOIN ref_depot dp
          ON     dp.depot_id = dpc.depot_id

          JOIN   ref_scrapyard sy
          ON     s.scrapyard_code = sy.scrapyard_code

          JOIN   ref_scrap_merchant sm
          ON     sm.merchant_code = substr(sy.scrapyard_code, 1, 3)

          where  s.scrapyard_code IN (' . $scr_grp . ')

          UNION

          select "Diesel" AS type,
                 concat(sm.merchant_name, " (", sy.location, ")") AS sc_name,
                 concat("sites.php?page=scrapyards&subpage=main&id=", sm.merchant_code) 
                                                            AS sc_name_hl,
                 d.loco_id,
                 dn.number,
                 dn.number_type,
                 dc.identifier,
                 concat("locoqry.php?action=class&type=D&id=",dc.d_class_id) AS identifier_hl,
                 d.date_completed,
                 date_format(d.date_completed, "%Y%m%d") AS date_completed_fmt,
                 dc.wheel_arrangement,
                 concat("misc.php?page=wheel_arr&id=", 
                                dc.wheel_arrangement) AS wheel_arrangement_hl,
                 concat("locoqry.php?action=locodata&type=D&id=",d.loco_id,"&loco=",dn.number) AS number_hl,
                 "BR" AS company,
                 d.disposal_date,
                 date_format(d.disposal_date, "%Y%m%d") AS disposal_date_fmt,
                 d.date_withdrawn,
                 date_format(d.date_withdrawn, "%Y%m%d") AS date_withdrawn_fmt,
                 d.last_depot,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) AS last_depot_hl,
                 dp.depot_name      AS last_depot_name,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) AS last_depot_name_hl
          from   diesels d

          join   d_class_link dcl
          on     dcl.loco_id = d.loco_id
          and    d.date_withdrawn BETWEEN ifnull(dcl.start_date, "1750-01-01")
                                  AND     ifnull(dcl.end_date,   "2999-01-01")

          join   d_class dc
          on     dc.d_class_id = dcl.d_class_id

          join   d_nums dn
          on     dn.loco_id = d.loco_id
          and    d.date_withdrawn BETWEEN dn.start_date
                                  AND     ifnull(dn.end_date,   "2999-01-01")

          LEFT JOIN ref_depot_codes dpc
          ON     dpc.depot_code = d.last_depot
          AND    d.date_withdrawn BETWEEN dpc.date_from
                                  AND     ifnull(dpc.date_to,   "2999-01-01")

          LEFT JOIN ref_depot dp
          ON     dp.depot_id = dpc.depot_id

          JOIN   ref_scrapyard sy
          ON     d.scrapyard_code = sy.scrapyard_code

          JOIN   ref_scrap_merchant sm
          ON     sm.merchant_code = substr(sy.scrapyard_code, 1, 3)

          where  d.scrapyard_code IN (' . $scr_grp . ')
          
          UNION

          select "Electric" AS type,
                 concat(sm.merchant_name, " (", sy.location, ")") AS sc_name,
                 concat("sites.php?page=scrapyards&subpage=main&id=", sm.merchant_code) 
                                                            AS sc_name_hl,
                 e.loco_id,
                 en.number,
                 en.number_type,
                 ec.identifier,
                 concat("locoqry.php?action=class&type=E&id=",ec.e_class_id) AS identifier_hl,
                 e.date_completed,
                 date_format(e.date_completed, "%Y%m%d") AS date_completed_fmt,
                 ec.wheel_arrangement,
                 concat("misc.php?page=wheel_arr&id=", 
                                ec.wheel_arrangement) AS wheel_arrangement_hl,
                 concat("locoqry.php?action=locodata&type=E&id=",e.loco_id,"&loco=",en.number) AS number_hl,
                 "BR" AS company,
                 e.disposal_date,
                 date_format(e.disposal_date, "%Y%m%d") AS disposal_date_fmt,
                 e.date_withdrawn,
                 date_format(e.date_withdrawn, "%Y%m%d") AS date_withdrawn_fmt,
                 e.last_depot,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) AS last_depot_hl,
                 dp.depot_name      AS last_depot_name,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) AS last_depot_name_hl
          from   electric e

          join   e_class_link ecl
          on     ecl.loco_id = e.loco_id
          and    e.date_withdrawn BETWEEN ifnull(ecl.start_date, "1750-01-01")
                                  AND     ifnull(ecl.end_date,   "2999-01-01")

          join   e_class ec
          on     ec.e_class_id = ecl.e_class_id

          join   e_nums en
          on     en.loco_id = e.loco_id
          and    e.date_withdrawn BETWEEN en.start_date
                                  AND     ifnull(en.end_date,   "2999-01-01")

          LEFT JOIN ref_depot_codes dpc
          ON     dpc.depot_code = e.last_depot
          AND    e.date_withdrawn BETWEEN dpc.date_from
                                  AND     ifnull(dpc.date_to,   "2999-01-01")

          JOIN   ref_scrapyard sy
          ON     e.scrapyard_code = sy.scrapyard_code

          JOIN   ref_scrap_merchant sm
          ON     sm.merchant_code = substr(sy.scrapyard_code, 1, 3)

          LEFT JOIN ref_depot dp
          ON     dp.depot_id = dpc.depot_id

          where  e.scrapyard_code IN (' . $scr_grp . ')';

          echo $sql;
die(1);
  $result = $db->execute($sql);

  if (($scount = $db->count_select()) > 0)
  {
    $tbs = new MyTables("smanuf");

    $tbs->add_caption("Locomotives");
    $tbs->sortable();
    $tbs->add_column("sc_name",           "Scrapyard",          15);
    $tbs->add_column("type",              "Type",                5);
    $tbs->add_column("company",           "Company",             8);
    $tbs->add_column("identifier",        "Class",              10);
    $tbs->add_column("wheel_arrangement", "Wheels",              7);
    $tbs->add_column("number",            "Number when Cut",     7);
    $tbs->add_column("date_completed",    "Date Built",         10);
    $tbs->add_column("date_withdrawn",    "Date Withdrawn",     10);
    $tbs->add_column("last_depot",        " ",                   4);
    $tbs->add_column("last_depot_name",   "Depot on Withdrawal",14);
    $tbs->add_column("disposal_date",     "Date Scrapped",      10);

    $last_lid = 0;
    while ($row = mysqli_fetch_array($result))
    {
      if ($row['type'] != "Steam" && $row['number_type'] == "PRT")
      {
        if (strlen($row['number']) < 5)
        {
          $row['number'] = substr($row['type'], 0, 1) . $row['number'];
        }
      }

//      $tbs->add_data($row);
      $row['date_completed'] = fn_fdate($row['date_completed']);
      $row['date_withdrawn'] = fn_fdate($row['date_withdrawn']);
      $row['disposal_date']  = fn_fdate($row['disposal_date']);

      $tbs->add_data($row);
    }
  }

  $tbs->draw_table();

  $db->close();

?>
