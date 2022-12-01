<?php
  $tb_rep = new MyTables("report");
  $db = fn_connectdb();

  printf("<h3>Diesel and Electric Casualties</h3>");

  printf("<p>This report highlights diesel or electric locomotives belonging to generally long lived classes that didn't survice as long as the others. A variety of situations occured that explain the early demise of specific locomotives, more often than not either accident damage or fire. This report examines those locomtoves in more detail.</p>");

  $sql = 'SELECT "D"                  AS type,
                 dn.number,
                 d.loco_id            AS number_fmt,
                 concat("locoqry.php?action=locodata&id=",d.loco_id,
                        "&type=D&loco=", dn.number)                 AS number_hl,
                 da.allocation,
                 dp.depot_name,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                                                    AS depot_name_hl,
                 d.b_date,
                 d.w_date,
                 d.s_date,
                 concat(date_format(d.b_date, "%Y%m%d"), lpad(d.loco_id, 6, "0")) AS b_date_fmt,
                 concat(date_format(d.w_date, "%Y%m%d"), lpad(d.loco_id, 6, "0")) AS w_date_fmt,
                 concat(date_format(d.s_date, "%Y%m%d"), lpad(d.loco_id, 6, "0")) AS s_date_fmt,
                 round(datediff(case date_format(d.w_date, "%d")
                            when 0 then date_format(concat(date_format(d.w_date, "%Y-%m-"),
                                                    "15"), "%Y-%m-%d")
                            else d.w_date 
                            END,
                            case date_format(d.b_date, "%d")
                            when 0 then date_format(concat(date_format(d.b_date, "%Y-%m-"),
                                                    "15"), "%Y-%m-%d")
                            else d.b_date 
                            END) /365, 2) AS service_age,
                 d.scrapyard_code,
                 sc.scrapyard_code,
                 sc.location,
                 sm.merchant_name,
                 i.details            AS reason_wdn,
                 i.sdate_of_incident  AS acc_date,
                 concat(date_format(i.sdate_of_incident, "%Y%m%d"), lpad(d2i.loco_id, 6, "0")) AS acc_date_fmt,
                 dc.identifier,
                 concat("locoqry.php?action=class&amp;type=D&amp;id=", dc.d_class_id) 
                                                                    AS identifier_hl
          FROM   early_withdrawals ew

          JOIN   diesels d
          ON     d.loco_id = ew.loco_id

          JOIN   d_nums dn
          ON     dn.loco_id = ew.loco_id

          AND    dn.start_date = (SELECT max(dn1.start_date)
                                  FROM   d_nums dn1
                                  WHERE  dn1.loco_id = ew.loco_id
                                  AND    dn1.carried_number = "Y"
                                  AND    dn1.start_date <= d.w_date)

          LEFT JOIN   d_alloc da
          ON     da.loco_id = ew.loco_id
          AND    concat(da.alloc_date, da.seq)
                               = (SELECT max(concat(da1.alloc_date, da.seq))
                                  FROM   d_alloc da1
                                  WHERE  da1.loco_id = ew.loco_id
                                  AND    da1.alloc_date <= d.w_date
                                  AND    da1.allocation NOT LIKE "98%")

          LEFT JOIN ref_depot_codes dpc
          ON     dpc.depot_code = da.allocation
          AND    dpc.date_from = (SELECT max(dc1.date_from)
                                  FROM   ref_depot_codes dc1
                                  WHERE  dc1.depot_code = da.allocation
                                  AND    dc1.date_from <= da.alloc_date)

          LEFT JOIN ref_depot dp
          ON     dp.depot_id = dpc.depot_id

          LEFT JOIN ref_scrapyard sc
          ON     sc.scrapyard_code = d.scrapyard_code

          LEFT JOIN ref_scrap_merchant sm
          ON     sm.merchant_code = substr(sc.scrapyard_code, 1, 3)

          JOIN   d_class_link dcl
          ON     dcl.loco_id = ew.loco_id
          AND    dcl.start_date = (SELECT max(dcl1.start_date)
                                   FROM   d_class_link dcl1
                                   WHERE  dcl1.loco_id = ew.loco_id
                                   AND    dcl1.start_date <= d.w_date)

          JOIN   d_class dc
          ON     dc.d_class_id = dcl.d_class_id

          JOIN   d_to_i d2i
          ON     d2i.loco_id = ew.loco_id

          JOIN   incidents i
          ON     i.inc_id = d2i.inc_id
          AND    i.incident_type in ("ACC1", "ACC2", "FIRE")

          WHERE  ew.type = "D"

          UNION

          SELECT "E"                  AS type,
                 en.number,
                 e.loco_id            AS number_fmt,
                 concat("locoqry.php?action=locodata&id=",e.loco_id,
                        "&type=E&loco=", en.number)                 AS number_hl,
                 ea.allocation,
                 dp.depot_name,
                 concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                                                    AS depot_name_hl,
                 e.b_date,
                 e.w_date,
                 e.s_date,
                 concat(date_format(e.b_date, "%Y%m%d"), lpad(e.loco_id, 6, "0")) AS b_date_fmt,
                 concat(date_format(e.w_date, "%Y%m%d"), lpad(e.loco_id, 6, "0")) AS w_date_fmt,
                 concat(date_format(e.s_date, "%Y%m%d"), lpad(e.loco_id, 6, "0")) AS s_date_fmt,
                 round(datediff(case date_format(e.w_date, "%d")
                            when 0 then date_format(concat(date_format(e.w_date, "%Y-%m-"),
                                                    "15"), "%Y-%m-%d")
                            else e.w_date 
                            END,
                            case date_format(e.b_date, "%d")
                            when 0 then date_format(concat(date_format(e.b_date, "%Y-%m-"),
                                                    "15"), "%Y-%m-%d")
                            else e.b_date 
                            END) /365, 2) AS service_age,
                 e.scrapyard_code,
                 sc.scrapyard_code,
                 sc.location,
                 sm.merchant_name,
                 i.details            AS reason_wdn,
                 i.sdate_of_incident  AS acc_date,
                 concat(date_format(i.sdate_of_incident, "%Y%m%d"), lpad(e2i.loco_id, 6, "0")) AS acc_date_fmt,
                 ec.identifier,
                 concat("locoqry.php?action=class&amp;type=E&amp;id=", ec.e_class_id) 
                                                                    AS identifier_hl
          FROM   early_withdrawals ew

          JOIN   electric e
          ON     e.loco_id = ew.loco_id

          JOIN   e_nums en
          ON     en.loco_id = e.loco_id

          AND    en.start_date = (SELECT max(en1.start_date)
                                  FROM   e_nums en1
                                  WHERE  en1.loco_id = en.loco_id
                                  AND    en1.carried_number = "Y"
                                  AND    en1.start_date <= e.w_date)

          LEFT JOIN   e_alloc ea
          ON     ea.loco_id = e.loco_id
          AND    concat(ea.alloc_date, ea.seq)
                               = (SELECT max(concat(ea1.alloc_date, ea.seq))
                                  FROM   e_alloc ea1
                                  WHERE  ea1.loco_id = ea.loco_id
                                  AND    ea1.alloc_date <= e.w_date
                                  AND    ea1.allocation NOT LIKE "98%")

          LEFT JOIN ref_depot_codes dpc
          ON     dpc.depot_code = ea.allocation
          AND    dpc.date_from = (SELECT max(dc1.date_from)
                                  FROM   ref_depot_codes dc1
                                  WHERE  dc1.depot_code = ea.allocation
                                  AND    dc1.date_from <= ea.alloc_date)

          LEFT JOIN ref_depot dp
          ON     dp.depot_id = dpc.depot_id

          LEFT JOIN ref_scrapyard sc
          ON     sc.scrapyard_code = e.scrapyard_code

          LEFT JOIN ref_scrap_merchant sm
          ON     sm.merchant_code = substr(sc.scrapyard_code, 1, 3)

          JOIN   e_class_link ecl
          ON     ecl.loco_id = e.loco_id
          AND    ecl.start_date = (SELECT max(ecl1.start_date)
                                   FROM   e_class_link ecl1
                                   WHERE  ecl1.loco_id = ecl.loco_id
                                   AND    ecl1.start_date <= e.w_date)

          JOIN   e_class ec
          ON     ec.e_class_id = ecl.e_class_id

          JOIN   e_to_i e2i
          ON     e2i.loco_id = e.loco_id

          JOIN   incidents i
          ON     i.inc_id = e2i.inc_id
          AND    i.incident_type in ("ACC1", "ACC2", "FIRE")

          WHERE  ew.type = "E"
          
          ORDER BY w_date';

//        echo $sql;

  $tb_rep->add_caption("Diesel and Electric Casualties");
  $tb_rep->sortable();
  $tb_rep->colour_coordinate("Y");

  $tb_rep->add_column("number",             "Number",            6);
  $tb_rep->add_column("identifier",         "Class",             4);
  $tb_rep->add_column("b_date",             "Built",             8);
  $tb_rep->add_column("depot_name",         "Final Depot",      12);
  $tb_rep->add_column("acc_date",           "Event Date",        8);
  $tb_rep->add_column("w_date",             "Cond",              8);
  $tb_rep->add_column("service_age",        "Age when Wdn",      5);
  $tb_rep->add_column("reason_wdn",         "Reason Withdrawn", 39);
  $tb_rep->add_column("s_date",             "Scrapped",          8);

  //echo "Executing SQL<br />";

  $result = $db->execute($sql);

  while ($row = mysqli_fetch_assoc($result))
  {
    if ($row['type'] == "D")
      $row['number'] = fn_d_pfx($row['number']);
    else
      $row['number'] = fn_e_pfx($row['number']);

    $row['acc_date'] = fn_fdate($row['acc_date']);
    $row['b_date'] = fn_fdate($row['b_date']);
    $row['w_date'] = fn_fdate($row['w_date']);
    $row['s_date'] = fn_fdate($row['s_date']);

    $tb_rep->add_data($row);
  }

  $tb_rep->draw_table();

  unset($row); unset($tb_rep);
?>
