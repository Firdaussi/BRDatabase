<?php

  printf("<h3 align=center>List of Locomotive Works</h3><br />\n");
  
  $sql = 'SELECT *,
                 concat("sites.php?page=works&subpage=main&id=", bl_code) AS bl_code_hl,
                 concat("sites.php?page=works&subpage=main&id=", bl_code) AS bl_name_hl
          FROM   ref_builders
          WHERE  works_flag = "Y"
          ORDER BY bl_name';

  $result = $db->execute($sql);

  $tb = new MyTables("manuf_list");

  $tb->add_column("bl_name",        "Works Name",       38);
  $tb->add_column("prg_company",    "Pre Grouping",      5);
  $tb->add_column("big4_company",   "Big 4 Company",     5);
  $tb->add_column("br_region",      "BR Region",         5);
  $tb->add_column("opened_date",    "Date Opened",      11);
  $tb->add_column("closed_date",    "Date Closed",      11);
  $tb->add_column("type",           "Type",             11);
  $tb->add_column("gr_val",         "Map",               7);
  $tb->add_column("web",            "Web",               7);
  
  while ($row = mysqli_fetch_assoc($result))
  {
    if ($row['type'] == "P")
      $row['type'] = "Private";
    else
      $row['type'] = $row['company'];

    $row['opened_date'] = fn_fdate($row['opened_date']);
    $row['closed_date'] = fn_fdate($row['closed_date']);

    $tb->add_data($row);
  }

  $tb->draw_table();
?>
