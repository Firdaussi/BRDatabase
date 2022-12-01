<?php

  echo "<div id=\"navcontainer\">";
  echo "<ul id=\"navlist\">";
  echo "<li><a href=\"sites.php?page=works&subpage=main&id="   .$id. "\">Works Details</a></li>";
  echo "<li><a href=\"sites.php?page=works&subpage=locos&id="  .$id. "\">Locos Built</a></li>";
  echo "<li><a href=\"sites.php?page=works&subpage=orders&id=" .$id. "\">Orders</a></li>";
  echo "<li id=\"active\"><a href=\"#\" id=\"current\">Visit Log</a></li>";
  if ($olog > 0)
    echo "<li><a href=\"sites.php?page=works&subpage=olog&id=" .$id. "\">Overhauls</a></li>";
  if ($snap > 0)
    echo "<li><a href=\"sites.php?page=works&subpage=snap&id=" .$id. "\">Snapshot</a></li>";
  echo "</ul>";
  echo "</div>";

  $sql = 'SELECT ig.ig_id,
                 ig.ig_title,
                 concat("timelines.php?page=workings&amp;subpage=groups&amp;id=",
                        ig.ig_id)    AS ig_title_hl,
                 ig.ig_date,
                 dayname(ig.ig_date) AS dayname,
                 NULL                AS visit_date
          FROM   incident_groups ig
          WHERE  ig.bl_code = "' . $id . '"
          ORDER BY ig.ig_date ASC';

  $result = $db->execute($sql);

  $tigs = new MyTables("incident_list", 80);
  $tigs->sortable();
  $tigs->add_caption("Works Visits: " . $wks_name);
  $tigs->add_column("visit_date",           "Visit Date", 25);
  $tigs->add_column("ig_title",             "Details",    75);

  while ($row = mysqli_fetch_assoc($result))
  {
    $row['visit_date'] = fn_fdate($row['ig_date']);
  
    if (!empty($row['dayname']))
      $row['visit_date'] .= " (" . $row['dayname'] . ")";

    $tigs->add_data($row);
  }

  $tigs->draw_table();
  $tigs = ""; $row = "";

  $db->close();

?>