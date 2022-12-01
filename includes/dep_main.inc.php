<?php
  $sql = 'select d.*,
                 concat("companies.php?page=", d.big4_company, "&amp;subpage=", d.prg_company) 
                                                                   AS prg_company_hl,
                 concat("companies.php?page=", d.big4_company)     AS big4_company_hl,
                 concat("companies.php?page=BR&amp;subpage=", d.br_region)     AS br_region_hl,
                 concat("https://maps.nls.uk/geo/explore/#zoom=15&lat=", d.latitude, "&lon=", d.longitude, "&layers=193&b=1&marker=", d.latitude, ",", d.longitude) 
                                                                   AS gr,
                 d.date_opened AS date_opened,
                 d.date_closed AS date_closed,
                 directions,
                 directions1980,
                 proximity
          from   ref_depot d
          where  d.depot_id = ' .$id;

/*
  $sql = 'select d.*,
                 concat("companies.php?page=", d.big4_company, "&amp;subpage=", d.prg_company) 
                                                                   AS prg_company_hl,
                 concat("companies.php?page=", d.big4_company)     AS big4_company_hl,
                 concat("companies.php?page=BR&amp;subpage=", d.br_region)     AS br_region_hl,
                 concat("www.streetmap.co.uk/grid/", d.grid_reference,",115") 
                                                                   AS gr,
                 d.date_opened AS date_opened,
                 d.date_closed AS date_closed,
                 directions,
                 directions1980,
                 proximity
          from   ref_depot d
          where  d.depot_id = ' .$id;
*/
          
  $result = $db->execute($sql);
  $gotdepot = 0;

  if ($result)
  {
  if ($db->count_select())
  {
    $gotdepot = 1; 
    $row = mysqli_fetch_assoc($result);
    $row['date_opened'] = fn_fdate($row['date_opened']);
    $row['date_closed'] = fn_fdate($row['date_closed']);
    $prox = $row['proximity'];
  }
  else
  {
    fn_errlog('dep_main', 'Cannot find depot id ' . $id);
    printf("Unknown depot id requested (%s) - please contact administrator\n", $id);
    exit(1);
  }
  }

  $sql = 'select ifnull(dc.displayed_depot_code, dc.depot_code) AS depot_code,
                 dc.gwr_numeric_code,
                 dc.date_from,
                 dc.date_to
          from   ref_depot_codes dc
          where  dc.depot_id = ' .$id. '
          order by dc.date_from, dc.date_to, dc.depot_code_id';

  $result2 = $db->execute($sql);

  $ct = 0;
  if ($result2)
  {
  if ($db->count_select())
  {
	  while ($row2 = mysqli_fetch_assoc($result2))
	  {
		if ($ct == 0)
		{
		  $rw = "<table width=\"100%\" frame=\"box\"><tr><td width=\"20%\"><strong>Code</strong></td><td width=\"40%\"><strong>From</strong></td><td width=\"40%\"><strong>To</strong></td></tr>";
		}

        if ($row2['gwr_numeric_code'] != "")
          $row2['depot_code'] .= " (" . $row2['gwr_numeric_code'] . ")";
          
        $rw = $rw . "<tr><td>" . $row2['depot_code']   . "</td>" .
						"<td>" . fn_fdate($row2['date_from'])  . "</td>" .
						"<td>" . fn_fdate($row2['date_to'])    . "</td>" .
					"</tr>";
		$ct++;
	  }

	  if ($ct > 0)
		$row['codes'] = $rw . "</table>";
  }
  }

  $sql = 'SELECT xc.*
          FROM   xdepot_change xc
          WHERE  xc.depot_id = ' .$id . '
          ORDER BY xc.event_date';

  //        echo $sql;

  $result3 = $db->execute($sql);

  $ct = 0;
  if ($result3)
  {
  if ($db->count_select())
  {
    while ($row3 = mysqli_fetch_assoc($result3))
    {
      if ($ct == 0)
      {
        $rw = "<table width=\"100%\" frame=\"box\"><tr><td width=\"30%\"><strong>Date</strong></td><td width=\"70%\"><strong>Event</strong></td></tr>";
      }

      $row3['event_date'] = fn_fdate($row3['event_date']);
      $rw .= "<tr><td>" . $row3['event_date'] . "</td>" .
             "<td>" . $row3['description'] . "</td> </tr>";
    $ct++;
    }
  }
  else
  {
    fn_errlog('dep_main', 'Cannot find xdepot id ' . $id);
    //exit(1);
  }

  if ($ct > 0)
    $row['event_list'] = $rw . "</table>";

  $tb = new MyTables("depot");

  $tb->add_caption("Depot Details");
  $tb->add_row_lwidth(35);
  $tb->set_align("V");
  $tb->suppress_nulls();
  $tb->add_row("depot_name",      "Depot Name");
  $tb->add_row("codes",           "Depot Codes");
  $tb->add_row("date_opened",     "Date Opened");
  $tb->add_row("date_closed",     "Date Closed");
  $tb->add_row("prg_company",     "Pre Grouping Company");
  $tb->add_row("big4_company",    "Big 4 Company");
  $tb->add_row("br_region",       "British Railways Region");
  $tb->add_row("division",        "Regional Division");
  $tb->add_row("gwr_division",    "GWR Division");
  $tb->add_row("closure_reason",  "Closure Reason");
  $tb->add_row("info",            "Information");
  $tb->add_row("directions",      "1947 Directions");
  $tb->add_row("directions1980",  "1980 Directions");
  $tb->add_row("weblink",         "Web Link");
  $tb->add_row("map_choices",     "Popup Maps (New Window)");
  $tb->add_row("event_list",      "Chronology");

  if (!empty($row['grid_reference']))
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
  }

  echo "<div id=\"navcontainer\">";
  echo "<ul id=\"navlist\">";
  echo "<li id=\"active\"><a href=\"#\" id=\"current\">Depot Details</a></li>";
  echo "<li><a href=\"sites.php?page=depots&amp;subpage=locos&amp;id="  .$id. "\">Locos Allocated</a></li>";
  echo "<li><a href=\"sites.php?page=depots&amp;subpage=snap&amp;id="  .$id. "\">Snapshot</a></li>";
  echo "<li><a href=\"sites.php?page=depots&amp;subpage=arrdep&amp;id="  .$id. "\">Arrivals/Departures</a></li>";
  if ($vlog > 0)
    echo "<li><a href=\"sites.php?page=depots&amp;subpage=vlog&amp;id="  .$id. "\">Visit Log</a></li>";
  if ($imgct > 0)
    echo "<li><a href=\"sites.php?page=depots&amp;subpage=gallery&amp;id="  .$id. "\">Gallery</a></li>";
  echo "</ul>";
  echo "</div>";

  printf("<table width=99%% frame=box>\n");
    printf("<tr><td width=40%% valign=top>\n");
    if ($gotdepot)
      $tb->draw_table();
    else
      printf("No data available<br />");
      
    printf("</td>\n");
    printf("<td width=59%% valign=top>\n");
      printf("<iframe src=\"%s\" width=100%% height=700 marginwidth=300>\n", $row['gr']);
      printf("<p>Your browser does not support iframes - open map using 'Open Popup' on left</p>\n");
      printf("</iframe>\n");
    printf("</td></tr>\n");
  printf("</table><br />\n");

  if (!empty($prox))
  {
    $tb1 = new MyTables("shunters");

    $tb1->add_caption("Shunter Duties");
    $tb1->add_row_lwidth(25);
    $tb1->set_align("V");
    $tb1->suppress_nulls();
    $tb1->add_row("proximity",  "Nearby Shunter Duties");
    $tb1->add_data($row);

    printf("<table width=99%% frame=box>\n");
      printf("<tr><td width=100%% valign=top>\n");
      $tb1->draw_table();
      
      printf("</td></tr>\n");
    printf("</table><br />\n");

  }

?>
