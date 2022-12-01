<?php

  printf("<h3 align=center>List of Scrapyards</h3><br />\n");
  
  $sql = 'SELECT sm.merchant_name,
                 sy.location,
                 concat("sites.php?page=scrapyards&subpage=main&id=", sm.merchant_code) 
                                                                              AS merchant_name_hl,
                 concat("sites.php?page=scrapyards&subpage=main&id=", sy.scrapyard_code)
                                                                              AS location_hl,
                 sy.diesels_scrapped,
                 sy.electrics_scrapped,
                 sy.steam_scrapped,
                 coalesce(sy.diesels_scrapped, 0)   +
                 coalesce(sy.electrics_scrapped, 0) +
                 coalesce(sy.steam_scrapped, 0)                               AS total_scrapped
          FROM   ref_scrapyard sy

          JOIN   ref_scrap_merchant sm
          ON     sm.merchant_code = substr(sy.scrapyard_code, 1, 3)

          ORDER BY sm.merchant_name, sy.location';

  $result = $db->execute($sql);

  $tb = new MyTables("scrap_list");

  $tb->add_column("merchant_name",     "Merchant",         18);
  $tb->add_column("location",          "Location",         20);
  $tb->add_column("opened_date",       "Date Opened",      11);
  $tb->add_column("closed_date",       "Date Closed",      11);
  $tb->add_column("type",              "Type",             10);
  $tb->add_column("steam_scrapped",    "Steam",             5);
  $tb->add_column("diesels_scrapped",  "Diesel",            5);
  $tb->add_column("electrics_scrapped","Electric",          5);
  $tb->add_column("total_scrapped",    "Total Scrapped",    5);
  $tb->add_column("gr_val",            "Map",               5);
  $tb->add_column("web",               "Web",               5);
  
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
