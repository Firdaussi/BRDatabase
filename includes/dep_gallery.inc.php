<?php

  echo "<div id=\"navcontainer\">";
  echo "<ul id=\"navlist\">";
  echo "<li><a href=\"sites.php?page=depots&subpage=main&id="  .$id. "\">Depot Details</a></li>";
  echo "<li><a href=\"sites.php?page=depots&subpage=locos&id="  .$id. "\">Locos Allocated</a></li>";
  echo "<li><a href=\"sites.php?page=depots&subpage=snap&id="  .$id. "\">Snapshot</a></li>";
  echo "<li><a href=\"sites.php?page=depots&subpage=arrdep&id="  .$id. "\">Arrivals/Departures</a></li>";
  if ($vlog > 0)
    echo "<li><a href=\"sites.php?page=depots&amp;subpage=vlog&amp;id="  .$id. "\">Visit Log</a></li>";
  echo "<li id=\"active\"><a href=\"#\" id=\"current\">Gallery</a></li>";
  echo "</ul>";
  echo "</div>";

    $sql = 'SELECT concat("images/sheds/", coalesce(dp.big4_company, "BR"),
                                   "/", i.image)       AS image_location,
                   i.caption,
                   i.photo_date,
                   ic.copyright,
                   ic.copyright_url

            FROM   ref_images i
            JOIN   ref_image_copyright ic
            ON     ic.ic_id = i.ic_id

            JOIN   ref_depot dp
            ON     dp.depot_id = i.class_id

            WHERE  i.class_id = ' .$id. '
            AND    i.type = "A"';
          
    $result = $db->execute($sql);
	$imgct =  $db->count_select();

    if (!$result)  
    {  
      echo '<br />Error querying railway database: ' . mysqli_error($link);  
      echo '<br />' .$sql . '<br />';
      $err=3; 
    }
    else
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        $img[] = $row['image_location'];
        $crg[] = $row['copyright_url'];
        $own[] = $row['copyright'];
        $cap[] = $row['caption'];
      }
  
      echo "<table width=99% frame=box align=center>";
   
      for ($i = 0; $i < $imgct; $i+=2)
      {
        echo "<tr>";
        for ($j = $i; $j < $i+2; $j++)
        {
          if ($j < $imgct)
          {
            echo "<td width=32%><img src=" .$img[$j]. " width=100%></td>";
          }
          else
          {
            echo "<td width=32%>&nbsp;</td>";
          }
        }
        echo "</tr>";
        echo "<tr>";
          for ($j = $i; $j < $i+2; $j++)
          {
            if ($j < $imgct)
            {
              $copyright = $own[$j]; $copyurl = $crg[$j];
              if (!empty($cap[$j]))
                echo "<td width=32%>$cap[$j]<br />Copyright: <a href=\"javascript:void(0)\" onClick=\"window.open('" 
.$copyurl. "')\">" .$copyright. "</a></td>";
              else
                echo "<td width=32%>Copyright: <a href=\"javascript:void(0)\" onClick=\"window.open('" 
.$copyurl. "')\">" .$copyright. "</a></td>";
            }
            else
            {
              echo "<td width=32%>&nbsp;</td>";
            }
          }  
          echo "</tr>";
        }
          
      echo "</table>";
    }
?>
