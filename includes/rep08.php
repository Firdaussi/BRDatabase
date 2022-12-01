<?php
  $tb_rep = new MyTables("report");
  $db = fn_connectdb();

  $essay = fn_get_essay($db, 1);

  printf("<h3>LNWR 0-8-0/2-8-0 rebuilds</h3>");

  printf("$essay");

  $sql = 'SELECT sn1.loco_id,
               sn1.number             AS lnwr_num,
               concat("locoqry.php?action=locodata&type=S&id=", sn1.loco_id) 
                                      AS lnwr_num_hl,
               sn2.number             AS lms_num,
               concat("locoqry.php?action=locodata&type=S&id=", sn1.loco_id) 
                                      AS lms_num_hl,
               sn2.carried_number     AS lms_carried,
               sn3.number             AS br_num,
               concat("locoqry.php?action=locodata&type=S&id=", sn1.loco_id) 
                                      AS br_num_hl,
               sn3.carried_number     AS br_carried,
               s.b_date,
               concat(s.b_date, lpad(s.loco_id, 7, "0000000"))
                                      AS b_date_fmt,
               s.w_date,
               concat(s.w_date, lpad(s.loco_id, 7, "0000000"))
                                      AS w_date_fmt,
               scl.start_date,
               concat(scl.start_date,   lpad(s.loco_id, 7, "0000000"))
                                      AS start_date_fmt,
               scl.s_class_id,
               sc.identifier
         FROM  steam s
         LEFT JOIN  s_nums sn1
         ON    s.loco_id = sn1.loco_id
         AND   sn1.company = "LNWR"
         LEFT JOIN s_nums sn2
         ON    sn2.loco_id = sn1.loco_id
         AND   sn2.company = "LMS"
         LEFT JOIN s_nums sn3
         ON    sn3.loco_id = sn1.loco_id
         AND   sn3.company = "BR"
         JOIN  s_class_link scl
         ON    scl.loco_id = s.loco_id
         JOIN  s_class sc
         ON    sc.s_class_id = scl.s_class_id
         AND   sc.s_class_id in (408001, 408006, 408005, 408004, 428001, 428002, 
                                 408002, 408003, 408008, 408007, 408009)

         ORDER BY sn1.loco_id,
                  scl.start_date';

  //        echo $sql;

  $tb_rep->add_caption("LNWR 0-8-0/2-8-0 Matrix");
  $tb_rep->sortable();

  $tb_rep->add_column("b_date",    "Built",            9);
  $tb_rep->add_column("lnwr_num",          "LNWR Number",      5);
  $tb_rep->add_column("lms_num",           "LMS Number",       5);
  $tb_rep->add_column("br_num",            "BR Number",        5);
  $tb_rep->add_column("A",                 "Webb 3 Cyl Compound Class A", 6);
  $tb_rep->add_column("B",                 "Webb 4 Cyl Compound Class B", 6);
  $tb_rep->add_column("C",                 "Whale Simple Class C",        6);
  $tb_rep->add_column("C1",                "Whale Simple Class C1",       6);
  $tb_rep->add_column("D",                 "Whale Simple Class D",        6);
  $tb_rep->add_column("E",                 "Whale 2-8-0 Class E",         6);
  $tb_rep->add_column("F",                 "Whale 2-8-0 Class F",         6);
  $tb_rep->add_column("G",                 "Class G",                     6);
  $tb_rep->add_column("G1",                "Class G1",                    6);
  $tb_rep->add_column("G2",                "Class G2",                    6);
  $tb_rep->add_column("G2A",               "Class G2a",                   6);
  $tb_rep->add_column("w_date",    "Condemned",        9);

  //echo "Executing SQL<br />";

  $result = $db->execute($sql);

  //echo "Records: " . $db->count_select() . "<br />";

  $lid = 0; $x = array();
  while ($row = mysqli_fetch_assoc($result))
  {
    if ($lid != $row['loco_id'])
    {
      /* Change of loco - dump details */

      if ($lid != 0)
      {
        $tb_rep->dump_data($x);
        unset($x);
      }

      $x['b_date'] = fn_fdate($row['b_date']);
      $x['b_date_fmt'] = $row['b_date_fmt'];
      $x['w_date'] = fn_fdate($row['w_date']);
      $x['w_date_fmt'] = $row['w_date_fmt'];
      $x['lnwr_num'] = $row['lnwr_num'];
      $x['lnwr_num_hl'] = $row['lnwr_num_hl'];
      if ($row['lms_carried'] == "N")
        $x['lms_num'] = "<i>" . $row['lms_num'] . "</i>";
      else
        $x['lms_num']  = $row['lms_num'];
      $x['lms_num_hl'] = $row['lms_num_hl'];
      if ($row['br_carried'] == "N")
        $x['br_num']   = "<i>" . $row['br_num'] . "</i>";
      else
        $x['br_num']   = $row['br_num'];
      $x['br_num_hl'] = $row['br_num_hl'];
    }

    $dt = fn_fdate($row['start_date']);

    $x[$row['identifier']] = $dt;
    $x[$row['identifier'] . "_fmt"] = $row['start_date_fmt'];
    $lid = $row['loco_id'];
  }

  $tb_rep->dump_data(NULL);

  unset($x); unset($row);
?>