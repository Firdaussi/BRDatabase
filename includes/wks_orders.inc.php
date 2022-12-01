<?php

  echo "<div id=\"navcontainer\">";
  echo "<ul id=\"navlist\">";
  echo "<li><a href=\"sites.php?page=works&subpage=main&id="  .$id. "\">Works Details</a></li>";
  echo "<li><a href=\"sites.php?page=works&subpage=locos&id="  .$id. "\">Locos Built</a></li>";
  echo "<li id=\"active\"><a href=\"#\" id=\"current\">Orders</a></li>";
  if ($vlog > 0)
    echo "<li><a href=\"sites.php?page=works&subpage=vlog&id=" .$id. "\">Visit Log</a></li>";
  if ($olog > 0)
    echo "<li><a href=\"sites.php?page=works&subpage=olog&id=" .$id. "\">Overhauls</a></li>";
  if ($snap > 0)
    echo "<li><a href=\"sites.php?page=works&subpage=snap&id=" .$id. "\">Snapshot</a></li>";
  echo "</ul>";
  echo "</div>";

  if (empty($lot))
  {
    $tb = new MyTables("borders");

    $tb->add_caption("Order Book");
    $tb->sortable();
    $tb->allow_rollover();
    $tb->add_column("order_number",      "Order Number", 10);
    $tb->add_column("order_date",        "Order Date",   10);
    $tb->add_column("forwhat",           "For",          15);
    $tb->add_column("company",           "Company",       8);
    $tb->add_column("identifier",        "Class",         8);
    $tb->add_column("size",              "Number Off",    5);
    $tb->add_column("info",              "Info",         44);

    $sql = 'select o.order_number,
                   concat("sites.php?page=builders&subpage=orders&id=", o.bl_code, "&lot=",
                         o.order_number)                               AS order_number_hl,
                   o.size,
                   o.order_date, 
                   date_format(o.order_date, "%Y%m%d")                 AS order_date_fmt,
                   o.info,
                   o.type,
                   o.class_id,
                   s.identifier                                        AS s_ident,
                   concat("locoqry.php?action=class&type=S&id=",s.s_class_id) AS s_ident_hl,
                   ifnull(s.prg_company, ifnull(s.big4_company, "BR")) AS s_company,
                   d.identifier                                        AS d_ident,
                   concat("locoqry.php?action=class&type=D&id=",d.d_class_id) AS d_ident_hl,
                   "BR"                                                AS d_company,
                   e.identifier                                        AS e_ident,
                   concat("locoqry.php?action=class&type=E&id=",e.e_class_id) AS e_ident_hl
            from   ref_orders o
            left join s_class s
            on     o.type = "S"
            and    s.s_class_id = o.class_id
            left join e_class e
            on     o.type = "E"
            and    e.e_class_id = o.class_id
            left join d_class d
            on     o.type = "D"
            and    d.d_class_id = o.class_id
            where  o.bl_code = "' . $id. '"
            order by o.order_number';

 // echo $sql;
       
    $result = $db->execute($sql);

    while ($row = mysqli_fetch_assoc($result))
    {
      if ($row['type'] == "S")
      {
        $row['forwhat']       = "Steam Locomotives";
        $row['company']       = $row['s_company'];
        $row['identifier']    = $row['s_ident'];
        $row['identifier_hl'] = $row['s_ident_hl'];
      }
      else
      if ($row['type'] == "D")
      {
        $row['forwhat'] = "Diesel Locomotives";
        $row['company'] = $row['d_company'];
        $row['identifier'] = $row['d_ident'];
        $row['identifier_hl'] = $row['d_ident_hl'];
      }
      else
      if ($row['type'] == "E")
      {
        $row['forwhat'] = "Electric Locomotives";
        $row['company'] = $row['e_company'];
        $row['identifier'] = $row['e_ident'];
        $row['identifier_hl'] = $row['e_ident_hl'];
      }

      $row['order_date'] = fn_fdate($row['order_date']);

      $tb->add_data($row);
    }

    $tb->draw_table();

    $db->close();
  }
  else  /* Specific lot number details */
  {
    if (!empty($oid))
      $asql = 'WHERE o.order_id = ' . $oid;
    else
    if (!empty($lot))
      $asql = 'WHERE o.order_number = "' . $lot . '"';
    else
      die("Can't run order query - no lot number or order_id provided!");

    $sql = 'SELECT o.*,
                   o.type AS otype,
                   o.info AS oinfo,
                   concat(o.size, " ",
                          CASE WHEN o.type = "S" THEN
                            "Steam"
                               WHEN o.type = "D" THEN
                            "Diesel"
                               WHEN o.type = "E" THEN
                            "Electric"
                          END,
                          " locomotives") AS forwhat,
                   bl.*,
                   ifnull(s.identifier, ifnull(e.identifier, d.identifier)) AS identifier
            FROM   ref_orders o
            JOIN   ref_builders bl
            ON     bl.bl_code = o.bl_code
            left join s_class s
            on     o.type = "S"
            and    s.s_class_id = o.class_id
            left join e_class e
            on     o.type = "E"
            and    e.e_class_id = o.class_id
            left join d_class d
            on     o.type = "D"
            and    d.d_class_id = o.class_id '
            . $asql .
          ' AND    o.bl_code = "' . $id . '"';

//echo $sql;

    $result = $db->execute($sql);

    if ($db->count_select() != 1)
    {
      die("More than one order matches those criteria");
    }

    $row = mysqli_fetch_assoc($result);

    echo "<br />";

    $tb1 = new MyTables("order1", 40);
    $tb1->add_caption("Order Details for Lot No: " . $id . "/" . $lot);
    $tb1->suppress_nulls();
    $tb1->add_row("bl_name",           "Builder");
    $tb1->add_row("order_date",        "Order Date");
    $tb1->add_row("forwhat",           "For");
    $tb1->add_row("identifier",        "Class");
    $tb1->add_row("company",           "Built For");
    $tb1->add_row("oinfo",             "Information");
    $tb1->add_row_lwidth(40);
    $tb1->set_align("V");
    $row['order_date'] = fn_fdate($row['order_date']);
    $tb1->add_data($row);
    $tb1->draw_table();

    echo "<br />";

    $tb2 = new MyTables("order2");
    $tb2->sortable();
    $tb2->add_column("number",            "Number (as built)", 8);
    $tb2->add_column("works_num",         "Works Number",      8);
    $tb2->add_column("class_type",        "Class",             10);
    $tb2->add_column("company",           "Built For",         12);
    $tb2->add_column("designer",          "Designer",          15);
    $tb2->add_column("wheel_arrangement", "Wheels",             8);
    $tb2->add_column("b_date",    "Date to Service",   10);
    $tb2->add_column("w_date",    "Date Withdrawn",    10);
    $tb2->add_column("info",              "Info",              13);

    if ($row['otype'] == "S")
    {
      $sql = 'SELECT s.loco_id,
                     s.b_date,
                     date_format(s.b_date, "%Y%m%d")               AS b_date_fmt,
                     s.w_date,
                     date_format(s.w_date, "%Y%m%d")               AS w_date_fmt,
                     s.works_num,
                     NULL           AS works_num_b,
                     sn.number,
                     sn.number_type,
                     concat("locoqry.php?action=locodata&id=",s.loco_id,"&type=S&loco=",
                            sn.number)                                     AS number_hl,
                     p.surname                                             AS designer,
                     concat("people.php?page=cme&id=", p.p_id)             AS designer_hl,
                     ifnull(sc.prg_company, ifnull(sc.big4_company, "BR")) AS company,
                     concat("companies.php?page=", ifnull(sc.big4_company, "BR"),
                                                   CASE ifnull(sc.prg_company, "#")
                                                       WHEN "#" THEN ""
                                                   ELSE
                                                       concat("&subpage=", sc.prg_company)
                                                   END) AS company_hl,
                     ifnull(sc.common_name, sc.identifier) AS class_type,
                     concat("locoqry.php?action=class&type=S&id=", sc.s_class_id) 
                                                                           AS class_type_hl,
                     sc.wheel_arrangement,
                     concat("misc.php?page=wheel_arr&id=", sc.wheel_arrangement) 
                                                                           AS wheel_arrangement_hl
              FROM   steam s
              JOIN   ref_orders o
              ON     o.order_id = s.order_id
              JOIN   s_class sc
              ON     sc.s_class_id = o.class_id
              LEFT JOIN s_nums sn
              ON     sn.loco_id = s.loco_id
              AND    sn.start_date = s.b_date
              LEFT JOIN ref_people p
              ON     p.p_id = sc.designer_id ' 
              . $asql .
            ' ORDER BY s.works_num, s.loco_id';
    }
    else
    if ($row['otype'] == "D")
    {
      $sql = 'SELECT d.loco_id,
                     d.b_date,
                     date_format(d.b_date, "%Y%m%d")               AS b_date_fmt,
                     d.w_date,
                     date_format(d.w_date, "%Y%m%d")               AS w_date_fmt,
                     d.works_num,
                     d.works_num_b,
                     dn.number,
                     concat("locoqry.php?action=locodata&id=",d.loco_id,"&type=D&loco=",
                            dn.number)                                     AS number_hl,
                     dn.number_type,
                     NULL                                                  AS designer,
                     NULL                                                  AS designer_hl,
                     NULL                                                  AS company,
                     NULL                                                  AS company_hl,
                     dc.identifier                                         AS class_type,
                     concat("locoqry.php?action=class&type=D&id=", dc.d_class_id) 
                                                                           AS class_type_hl,
                     dc.wheel_arrangement,
                     concat("misc.php?page=wheel_arr&id=", dc.wheel_arrangement) 
                                                                           AS wheel_arrangement_hl
              FROM   diesels d
              LEFT JOIN d_nums dn
              ON     dn.loco_id = d.loco_id
              AND    dn.start_date = d.b_date
              JOIN   ref_orders o
              ON     o.order_id = d.order_id
              JOIN   d_class dc
              ON     dc.d_class_id = o.class_id '
              . $asql .
            ' ORDER BY d.works_num, d.loco_id';

// echo $sql;
    }
    else
    if ($row['otype'] == "E")
    {
      $sql = 'SELECT e.loco_id,
                     e.b_date,
                     date_format(e.b_date, "%Y%m%d")               AS b_date_fmt,
                     e.w_date,
                     date_format(e.w_date, "%Y%m%d")               AS w_date_fmt,
                     e.works_num,
                     e.works_num_b,
                     en.number,
                     concat("locoqry.php?action=locodata&id=",e.loco_id,"&type=E&loco=",
                            en.number)                                     AS number_hl,
                     en.number_type,
                     NULL                                                  AS designer,
                     NULL                                                  AS designer_hl,
                     NULL                                                  AS company,
                     NULL                                                  AS company_hl,
                     ec.identifier                                         AS class_type,
                     concat("locoqry.php?action=class&type=E&id=", ec.e_class_id) 
                                                                           AS class_type_hl,
                     ec.wheel_arrangement,
                     concat("misc.php?page=wheel_arr&id=", ec.wheel_arrangement) 
                                                                           AS wheel_arrangement_hl
              FROM   electric e
              LEFT JOIN e_nums en
              ON     en.loco_id = e.loco_id
              AND    en.start_date = e.b_date
              JOIN   ref_orders o
              ON     o.order_id = e.order_id
              JOIN   e_class ec
              ON     ec.e_class_id = o.class_id '
              . $asql .
            ' ORDER BY e.works_num, e.loco_id';

// echo $sql;
    }
   
    $result = $db->execute($sql);

    while ($row1 = mysqli_fetch_assoc($result))
    {
      $row1['b_date'] = fn_fdate($row1['b_date']);
      $row1['w_date'] = fn_fdate($row1['w_date']);
      if ($row1['number_type'] == "PRT")
      {
        if ($row['otype'] == "D")
          $row1['number'] = fn_d_pfx($row1['number']);
        else
        if ($row['otype'] == "E")
          $row1['number'] = fn_e_pfx($row1['number']);
      }
      $tb2->add_data($row1);
    }

    $tb2->draw_table();

    $db->close();
  }
?>
