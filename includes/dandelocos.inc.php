<?php
  echo "<tr>";
    echo "<td><a href=locoqry.php?action=class&id=" .urlencode($x6). "&type=".$lt.">" .$x6. "</a></td>";
    echo "<td>" .$x8. "</td>";
    echo "<td>" .$x7. "</td>";
    echo "<td><a href=locoqry.php?action=locodata&id=" .$z . "&type=".$lt.
	     "&loco=" .$x2. ">"  .$x2.  "</a></td>";
    
	if ($x3 != '')
    {
      if ($lt == "S")
        $lt1 = "";
      else
        $lt1 = $lt;

      echo "<td><a href=locoqry.php?action=locodata&id=" .$z . "&type=".$lt.
		   "&loco=" .$x3. ">"  .$lt1.$x3.  "</a></td>";
    }
    else
      echo "<td>&nbsp;</td>";

    echo "<td><a href=locoqry.php?action=locodata&id=" .$z . "&type=".$lt.
	     "&loco=" .$x4. ">"  .$x4.  "</a></td>";
    echo "<td><a href=locoqry.php?action=locodata&id=" .$z . "&type=".$lt.
	     "&loco=" .$x5. ">"  .$x5.  "</a></td>";
    echo "<td><a href=locoqry.php?action=locodata&id=" .$z . "&type=".$lt.
	     "&loco=" .$x9. ">"  .$x9.  "</a></td>";
    echo "<td><a href=u_locos.php?id=" .$z . "&type=".$lt."&loco=" .$x9. ">E</a></td>";
  echo "</tr>";
?>