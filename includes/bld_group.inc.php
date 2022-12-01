<?php

  echo "<div id=\"navcontainer\">";
  echo "<ul id=\"navlist\">";
  echo "<li><a href=\"sites.php?page=builders&subpage=main&id="  .$id. "\">Builder Details</a></li>";
  echo "<li><a href=\"sites.php?page=builders&subpage=locos&id="  .$id. "\">Locos Built</a></li>";
  echo "<li><a href=\"sites.php?page=builders&subpage=orders&id=" .$id. "\">Orders</a></li>";
  echo "<li id=\"active\"><a href=\"#\" id=\"current\">Group</a></li>";
  echo "</ul>";
  echo "</div>";

  $db->close();

?>