<?php

    if (strlen($id) == 5)
    {
      echo "<div id=\"navcontainer\">";
      echo "<ul id=\"navlist\">";
      echo "<li id=\"active\"><a href=\"#\" id=\"current\">Scrapyard Details</a></li>";
      echo "<li><a href=\"sites.php?page=scrapyards&subpage=locos&id="  .$id. 
           "\">Locos Scrapped</a></li>";
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

      // Get details for specific scrapyard
      $sql = 'SELECT sy.*,
                     concat("https://maps.nls.uk/geo/explore/#zoom=15&lat=", sy.latitude, "&lon=", sy.longitude, "&layers=193&b=1&marker=", sy.latitude, ",", sy.longitude)  AS gr,
                     sm.merchant_name,
                     concat("sites.php?page=scrapyards&subpage=main&id=", 
                                substr(sy.scrapyard_code, 1, 3))       AS merchant_name_hl
              FROM   ref_scrapyard sy

              JOIN   ref_scrap_merchant sm
              ON     sm.merchant_code = substr(sy.scrapyard_code, 1, 3)

              WHERE  sy.scrapyard_code  = "' . $id . '"';
          
      $result = $db->execute($sql);

      $row = mysqli_fetch_assoc($result);

      require_once "lib/MyTables.class.php";

      $tb = new MyTables("locoscrap");

      $tb->add_caption("Scrapyard Details");
      $tb->add_row_lwidth(35);
      $tb->set_align("V");
      $tb->suppress_nulls();
      $tb->add_row("merchant_name",      "Scrap Merchant");
      $tb->add_row("status",             "Affiliation");
      $tb->add_row("location",           "Location");
      $tb->add_row("open_date",          "Works Opened");
      $tb->add_row("closed_date",        "Works Closed");
      $tb->add_row("closure_reason",     "Closure Reason");
      $tb->add_row("info",               "Information");
      $tb->add_row("weblink",            "Web Link");
      $tb->add_row("grid_reference",     "Map");
      $tb->add_row("steam_scrapped",     "Steam Locos Scrapped");
      $tb->add_row("diesels_scrapped",   "Diesel Locos Scrapped");
      $tb->add_row("electrics_scrapped", "Electric Locos Scrapped");
      $tb->add_row("map_choices",        "Popup Maps (New Window)");

  if (!empty($row['latitude']))
  {
    for ($nx = 0, $mapchoice = ""; $nx < 3; $nx++)
    {
      if ($nx == 0)
      {
        $commentary = "25 Inch (1892-1914)";
        $grid = 168;
      }
      else
      if ($nx == 1)
      {
        $commentary = "OS (1:25,000) (1937-1961)";
        $grid = 10;
      }
      else
      if ($nx == 2)
      {
        $commentary = "OS 7th Series 1 inch (1:63,360)";
        $grid = 11;
      }

      if ($mapchoice != "")
        $mapchoice = $mapchoice . "<br />";

      #$mapchoice = $mapchoice . "<a href=\"javascript:void(0)\" onClick=\"window.open('www.streetmap.co.uk/grid/" .
      #                          $row['grid_reference'] . "," . $grid .
      #                          "')\">" . $commentary . "</a>";
      $mapchoice = $mapchoice . "<a href=\"javascript:void(0)\" onClick=\"window.open('https://maps.nls.uk/geo/explore/#zoom=15&lat=" .
                                $row['latitude'] . ",&lon=" . $row['longitude'] . "&layers=" . $grid . "&b=1&marker=" .
                                $row['latitude'] . "," . $row['longitude'] . "')\">" . $commentary . "</a>";
                                
      #https://maps.nls.uk/geo/explore/#zoom=15&lat=", d.latitude, "&lon=", d.longitude, "&layers=193&b=1&marker=", d.latitude, ",", d.longitude) 
    }

    $row['map_choices'] = $mapchoice;
  }

      $tb->add_data($row);

      printf("<table width=99%% frame=box>\n");
        printf("<tr><td width=40%% valign=top>\n");
        $tb->draw_table();
        printf("</td>\n");
        printf("<td width=59%%>\n");
          printf("<iframe src=\"%s\" width=100%% height=400>\n", $row['gr']);
          printf("<p>Your browser does not support iframes - open map using 'Open Popup' on left</p>\n");
          printf("</iframe>\n");
        printf("</td></tr>\n");
      printf("</table><br />\n");
    }
    else
    if (strlen($id) == 3)
    {
      echo "<div id=\"navcontainer\">";
      echo "<ul id=\"navlist\">";
      echo "<li id=\"active\"><a href=\"#\" id=\"current\">Scrap Merchant Details</a></li>";
      echo "<li><a href=\"sites.php?page=scrapyards&subpage=locos&id="  .$id. 
           "\">Locos Scrapped by Merchant</a></li>";
      echo "<li><a href=\"sites.php?page=scrapyards&subpage=summary&id="  .$id. 
           "\">Group Summary</a></li>";
      echo "</ul>";
      echo "</div>";

      // Get details for merchant
      require_once "lib/MyTables.class.php";

      $tb = new MyTables("locoscrap");

      $tb->add_caption("Scrap Merchant Details");
      $tb->add_row_lwidth(35);
      $tb->set_align("V");
      $tb->suppress_nulls();
      $tb->add_row("merchant_name",      "Merchant Name");
      $tb->add_row("yard_list",          "Yards");
      $tb->add_row("info",               "Information");
      $tb->add_row("date_from",          "Date Formed");
      $tb->add_row("date_to",            "Date Closed");
      $tb->add_row("steam_scrapped",     "Steam Locos Scrapped");
      $tb->add_row("diesels_scrapped",   "Diesel Locos Scrapped");
      $tb->add_row("electrics_scrapped", "Electric Locos Scrapped");

      $sql1 = 'SELECT sm.*
               FROM   ref_scrap_merchant sm
               WHERE  sm.merchant_code  = "' . $id . '"';
          
      $result = $db->execute($sql1);
      $row1 = mysqli_fetch_assoc($result);

      $sql2 = 'SELECT sy.location,
                      concat("sites.php?page=scrapyards&subpage=main&id=", sy.scrapyard_code)
                                     AS location_hl
               FROM   ref_scrapyard sy
               WHERE  sy.scrapyard_code like "' .$id . '%"
               ORDER by sy.location';

      $result = $db->execute($sql2);
      $x = 1;
      while ($row2 = mysqli_fetch_assoc($result))
      {
        if ($x == 1)
          $row1['yard_list'] = "<a href=" . $row2['location_hl'] . ">" . $row2['location'] . "</a>";
        else
          $row1['yard_list'] .= "<br />" .
                               "<a href=" . $row2['location_hl'] . ">" . $row2['location'] . "</a>";
        $x++;
      }

      $tb->add_data($row1);

      printf("<table width=99%% frame=box>\n");
        printf("<tr><td width=40%% valign=top>\n");
        $tb->draw_table();
        printf("</td>\n");
        printf("<td width=59%%>\n");
        printf("</td></tr>\n");
      printf("</table><br />\n");
    }
    else
      die("Unknown id: $id");

?>
