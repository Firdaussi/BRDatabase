<?php

    $sql = 'SELECT concat("images/locos/electric/",
                                   i.image)            AS image_location,
                   i.caption,
                   i.photo_date,
                   ic.copyright,
                   ic.copyright_url

            FROM   ref_images i
            JOIN   ref_image_copyright ic
            ON     ic.ic_id = i.ic_id

            WHERE  i.class_id = ' .$id. '
            AND    i.type = "E"';
          
//echo $sql;

    $result = $db->execute($sql);
    $imgct =  $db->count_select();

    if (!$result)  
    {  
      echo '<br />Error querying railway database: Please contact the administrator.<br />';
//      echo '<br />' .$sql . '<br />';
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
            echo "<td width=32%><img src=" . $img[$j]. " nopin=\"nopin\" width=100%></td>";
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

              if (!empty($phd[$j]))
                $photo = " (" . $phd[$j] . ")";
              else
                $photo = "";

              if (!empty($cap[$j]))
                echo "<td width=32%>$cap[$j] $photo<br />Copyright: <a href=\"javascript:void(0)\" onClick=\"window.open('" .$copyurl. "')\">" .$copyright. "</a></td>";
              else
                echo "<td width=32%>Copyright: <a href=\"javascript:void(0)\" onClick=\"window.open('" .$copyurl. "')\">" .$copyright. " " . $photo . "</a></td>";

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
