<?php

  echo "<div id=\"navcontainer\">";
  echo "<ul id=\"navlist\">";
  echo "<li><a href=\"sites.php?page=builders&subpage=main&id=" .$id. "\">Builder Details</a></li>";
  echo "<li id=\"active\"><a href=\"#\" id=\"current\">Locos Built</a></li>";
  echo "<li><a href=\"sites.php?page=builders&subpage=orders&id=" .$id. "\">Orders</a></li>";
  echo "<li><a href=\"sites.php?page=builders&subpage=group&id="  .$id. "\">Group</a></li>";
  echo "</ul>";
  echo "</div>";

  include_once("lib/cache.class.php");
  /**
   * call the class after the include
   */
  $file_cache=new cache();
  $file_cache->start_cache();

// echo "Cachefile: " . $file_cache->get_cachefile() . "<br />";
  $tb = new MyTables("locomanuf");

  $sql = 'SELECT "S"                                                   AS type,
                 s.loco_id                                             AS lid,
                 sn.number                                             AS number,
                 concat("locoqry.php?action=locodata&type=S&id=",
                         s.loco_id,"&loco=", sn.number)                AS number_hl,
                 sn.number_type                                        AS number_type,
		         coalesce(sc.common_name, sc.identifier)               AS identifier,
                 concat("locoqry.php?action=class&type=S&id=",
                         sc.s_class_id)                                AS identifier_hl,
		         s.b_date                                              AS bdate,
                 concat(date_format(s.b_date, "%Y%m%d"), lpad(s.loco_id, 7, "0"))
                                                                       AS bdate_fmt,
                 s.w_date                                              AS wdate,
                 concat(date_format(s.w_date, "%Y%m%d"), lpad(s.loco_id, 7, "0")) 
                                                                       AS wdate_fmt,
		         sc.wheel_arrangement                                  AS wheel_arr,
                 concat("misc.php?page=wheel_arr&id=", sc.wheel_arrangement) 
                                                                       AS wheel_arr_hl,
		         ifnull(ifnull(sc.prg_company, sc.big4_company), "BR") AS company,
                 s.works_num,
                 o.order_number                                        AS order_number,
                 o.lot_number                                          AS lot_number,
                 o.virtual_ind                                         AS virtual_ind,
                 o.order_id,
                 NULL                                                  AS order_details
          FROM   steam s

	  JOIN   s_class_link scl
	  ON     scl.loco_id = s.loco_id
	  AND    scl.start_date = s.b_date

	  JOIN   s_class sc
	  ON     sc.s_class_id = scl.s_class_id

	  LEFT JOIN   s_nums sn
	  ON     sn.loco_id = s.loco_id
          AND    sn.start_date = s.b_date

          LEFT JOIN ref_orders o
          ON     o.type = "S"
          AND    o.class_id = s.order_id

	  WHERE  s.bl_code = "' . $id . '" 

          UNION

          SELECT "D"                                                   AS type,
                 d.loco_id                                             AS lid,
                 dn.number                                             AS number,
                 concat("locoqry.php?action=locodata&type=D&id=",
                         d.loco_id, "&loco=", dn.number)               AS number_hl,
                 dn.number_type                                        AS number_type,
		         dc.identifier                                         AS identifier,
                 concat("locoqry.php?action=class&type=D&id=",
                         dc.d_class_id)                                AS identifier_hl,
		         d.b_date                                              AS bdate,
                 concat(date_format(d.b_date, "%Y%m%d"), lpad(d.loco_id, 7, "0"))
                                                                       AS bdate_fmt,
                 d.w_date                                              AS wdate,
                 concat(date_format(d.w_date, "%Y%m%d"), lpad(d.loco_id, 7, "0")) 
                                                                       AS wdate_fmt,
		         dc.wheel_arrangement                                  AS wheel_arr,
                 concat("misc.php?page=wheel_arr&id=", dc.wheel_arrangement) 
                                                                       AS wheel_arr_hl,
                 NULL                                                  AS company,
                 d.works_num,
                 o.order_number                                        AS order_number,
                 o.lot_number                                          AS lot_number,
                 o.virtual_ind                                         AS virtual_ind,
                 o.order_id,
                 NULL                                                  AS order_details

          FROM   diesels d

	  JOIN   d_class_link dcl
	  ON     dcl.loco_id = d.loco_id
	  AND    dcl.start_date = d.b_date

	  JOIN   d_class dc
	  ON     dc.d_class_id = dcl.d_class_id

	  LEFT JOIN   d_nums dn
	  ON     dn.loco_id = d.loco_id
          AND    dn.start_date = d.b_date

          LEFT JOIN ref_orders o
          ON     o.type = "D"
          AND    o.class_id = d.order_id

	  WHERE  d.bl_code = "' . $id . '"

          UNION

          SELECT "E"                                                   AS type,
                 e.loco_id                                             AS lis,
                 en.number                                             AS number,
                 concat("locoqry.php?action=locodata&type=E&id=",
                         e.loco_id, "&loco=", en.number)               AS number_hl,
                 en.number_type                                        AS number_type,
		         ec.identifier,
                 concat("locoqry.php?action=class&type=E&id=",
                         ec.e_class_id)                                AS identifier_hl,
		         e.b_date                                              AS bdate,
                 concat(date_format(e.b_date, "%Y%m%d"), lpad(e.loco_id, 7, "0"))
                                                                       AS bdate_fmt,
                 e.w_date                                              AS wdate,
                 concat(date_format(e.w_date, "%Y%m%d"), lpad(e.loco_id, 7, "0")) 
                                                                       AS wdate_fmt,
		         ec.wheel_arrangement                                  AS wheel_arr,
                 concat("misc.php?page=wheel_arr&id=", ec.wheel_arrangement) 
                                                                       AS wheel_arr_hl,
                 NULL                                                  AS company,
                 e.works_num,
                 o.order_number                                        AS order_number,
                 o.lot_number                                          AS lot_number,
                 o.virtual_ind                                         AS virtual_ind,
                 o.order_id,
                 NULL                                                  AS order_details

          from   electric e

	  JOIN   e_class_link ecl
	  ON     ecl.loco_id = e.loco_id
	  AND    ecl.start_date = e.b_date

	  JOIN   e_class ec
	  ON     ec.e_class_id = ecl.e_class_id

	  LEFT JOIN   e_nums en
	  ON     en.loco_id = e.loco_id
          AND    en.start_date = e.b_date

          LEFT JOIN ref_orders o
          ON     o.type = "E"
          AND    o.class_id = e.order_id

	  WHERE  e.bl_code = "' . $id . '" 

	  ORDER BY bdate_fmt ASC, works_num';

// echo $sql;
           
  $result = $db->execute($sql);

  if (($count = $db->count_select()) > 0)
  {
    $tbs = new MyTables("manuf");

    $tbs->add_caption("Locomotives built");
    $tbs->sortable();
    $tbs->allow_rollover();
    $tbs->colour_coordinate("Y");
    $tbs->add_column("company",           "Company",         7);
    $tbs->add_column("identifier",        "Class",           7);
    $tbs->add_column("wheel_arr",         "Wheels",          7);
    $tbs->add_column("number",            "Number as Built", 10);
    $tbs->add_column("works_num",         "Works Number",    10);
    $tbs->add_column("bdate",             "Date Built",      10);
    $tbs->add_column("wdate",             "Date Withdrawn",  25);

    $last_lid = 0;
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['bdate'] = fn_fdate($row['bdate']);
      $row['wdate'] = fn_fdate($row['wdate']);

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

      if ($row['virtual_ind'] == "N")
      {
        if (!empty($row['lot_no'] ) && !empty($row['order_number']))
          $row['order_details'] = $row['lot_no'] . "/" . $row['order_number'];
        else
        if (!empty($row['order_number']))
          $row['order_details'] = $row['order_number'];
        else
          $row['order_details'] = $row['lot_no'];
      }
      else
      if ($row['virtual_ind'] == "Y")
      {
        $row['order_details'] = "(" . $id . $row['order_id'] . ")";
      }

      $tbs->add_data($row);
	}
  }

  if ($count > 0)
  {
    $tbs->draw_table();
    printf("<br />\n");
  }


  $db->close();
  $file_cache->end_cache();

?>