<?php

  if (strlen($id) == 5)
  {
    echo "<div id=\"navcontainer\">";
    echo "<ul id=\"navlist\">";
    echo "<li><a href=\"sites.php?page=scrapyards&subpage=main&id="  .$id. 
         "\">Scrapyard Details</a></li>";
    echo "<li><a href=\"sites.php?page=scrapyards&subpage=locos&id="  .$id. 
         "\">Locos Scrapped by Yard</a></li>";
    echo "<li id=\"active\"><a href=\"#\" id=\"current\">Gallery</a></li>";
    if ($vlog > 0)
      echo "<li><a href=\"sites.php?page=scrapyards&subpage=vlog&id="  .$id. 
           "\">Visit Log</a></li>";
    echo "<li><a href=\"sites.php?page=scrapyards&subpage=summary&id="  .$id. 
         "\">Scrapyard Summary</a></li>";
    echo "</ul>";
    echo "</div>";
  }
  else
    die("Not applicable");

  $sql = 'SELECT COALESCE(i.image_url, concat("images/scrapyards/", i.image)) 
                                                     AS image_location,
                 i.caption,
                 i.photo_date,
                 coalesce(ic.name, ic.copyright)     AS copyright,
                 ic.copyright_url,
                 i.idx

          FROM   ref_scrapyard sc

          JOIN   ref_images i
          ON     i.class_id = sc.scrapyard_id
          AND    i.type = "X"

          JOIN   ref_image_copyright ic
          ON     ic.ic_id = i.ic_id

          WHERE  sc.scrapyard_code = "' .$id. '"
          ORDER BY idx';
        
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
      $phd[] = fn_fdate($row['photo_date']);
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
            {
              if (!empty($phd[$j]))
                $dat = " (" . $phd[$j] . ")";
              else
                $dat = "";
              echo "<td width=32%>$cap[$j]$dat<br />Copyright: <a href=\"javascript:void(0)\" onClick=\"window.open('" 
.$copyurl. "')\">" .$copyright. "</a></td>";
            }
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
