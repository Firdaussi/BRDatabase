<?php
  printf("<h3 align=center>List of Manufacturers</h3><br />\n");
  
  $sql = 'SELECT *,
                 concat("sites.php?page=builders&subpage=main&id=", bl_code) AS bl_code_hl,
                 concat("sites.php?page=builders&subpage=main&id=", bl_code) AS bl_name_hl
          FROM   ref_builders
          ORDER BY bl_name';

  $result = $db->execute($sql);

  $tb = new MyTables("manuf_list");

  $tb->add_column("bl_code",        "Code",              3);
  $tb->add_column("bl_name",        "Builder Name",     32);
  $tb->add_column("location",       "Location",          8);
  $tb->add_column("opened_date",    "Date Opened",      11);
  $tb->add_column("closed_date",    "Date Closed",      11);
  $tb->add_column("type",           "Type",             10);
  $tb->add_column("locos_built_s",  "Steam",             5);
  $tb->add_column("locos_built_d",  "Diesel",            5);
  $tb->add_column("locos_built_e",  "Electric",          5);
  $tb->add_column("gr_val",         "Map",               5);
  $tb->add_column("web",            "Web",               5);
  
  while ($row = mysqli_fetch_array($result))
  {
    if ($row['type'] == "P")
      $row['type'] = "Private";
    else
      $row['type'] = $row['company'];

    $tb->add_data($row);
  }

  $tb->draw_table();
?>