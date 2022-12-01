<?php

  $sql = 'select *,
                 locos_built_s as totals,
                 locos_built_d as totald,
                 locos_built_e as totale,
                 coalesce(locos_built_s, 0) +
                 coalesce(locos_built_d, 0) +
                 coalesce(locos_built_e)       AS totalall,
                 weblink,
		             concat("\"javascript:void(0)\"  
                           onClick=\"window.open(\'", weblink, "\')\"") AS weblink_hl,
                 concat("\"javascript:void(0)\"  
                           onClick=\"window.open(\'www.streetmap.co.uk/grid/", 
                 grid_reference,",115\')\"") AS bl_name_hl,
                 concat("www.streetmap.co.uk/grid/", grid_reference,",115") AS gr
		      from   ref_builders 
          where  bl_code = "' . $id. '"';

  $result = $db->execute($sql);

  $row = mysqli_fetch_assoc($result);

  require_once "lib/MyTables.class.php";

  $tb = new MyTables("locomanuf");

  $tb->add_caption("Manufacturer Details");
  $tb->add_row_lwidth(35);
  $tb->set_align("V");
  $tb->suppress_nulls();
  $tb->add_row("status",          "Affiliation");
  $tb->add_row("location",        "Location");
  $tb->add_row("opened_date",     "Works Opened");
  $tb->add_row("closed_date",     "Works Closed");
  $tb->add_row("closure_reason",  "Closure Reason");
  $tb->add_row("info",            "Information");
  $tb->add_row("directions",      "Directions");
  $tb->add_row("weblink",         "Web Link");
  $tb->add_row("grid_reference",  "Map");
  $tb->add_row("totals",          "Steam Locos Constucted");
  $tb->add_row("totald",          "Diesel Locos Constucted");
  $tb->add_row("totale",          "Electric Locos Constucted");
  $tb->add_row("totalall",        "Total Locos Constucted");

  $row['opened_date'] = fn_fdate($row['opened_date']);
  $row['closed_date'] = fn_fdate($row['closed_date']);

  $tb->add_data($row);

  echo "<div id=\"navcontainer\">";
  echo "<ul id=\"navlist\">";
  echo "<li id=\"active\"><a href=\"#\" id=\"current\">Builder Details</a></li>";
  echo "<li><a href=\"sites.php?page=builders&subpage=locos&id="  .$id. "\">Locos Built</a></li>";
  echo "<li><a href=\"sites.php?page=builders&subpage=orders&id=" .$id. "\">Orders</a></li>";
  echo "<li><a href=\"sites.php?page=builders&subpage=group&id="  .$id. "\">Group</a></li>";
  echo "</ul>";
  echo "</div>";

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

?>
