<?php

  // first, check if any locos were reclassified at some point in their career (not within a
  // class, but from one class to another (i.e. class 30 to class 31)

    $ok = 1;
    
    $sql = 'select dcl1.dmu_class_id dci,
                   count(*) ct
            from   dmu_class_link dcl1
            join   dmu_class_link dcl2
            on     dcl2.dmu_id = dcl1.dmu_id
            and    dcl2.dmu_class_id = ' .$id. '
            group by dcl1.dmu_class_id';

    $result = $db->execute($sql);

    if (($classcount = $db->count_select()) > 1)
    {
      // rebuilds. Ugh!
      $ok = 0;
    }
    else
    if ($db->count_select() == 1)
    {
      // get years the locomotives were built
      $sql = 'SELECT IFNULL(DATE_FORMAT( d.b_date, "%Y" ), "UNKN") dc,
	                   COUNT( * ) ct
              FROM   dmu d
              JOIN   dmu_class_link dcl
              ON     dcl.dmu_id = d.dmu_id
              JOIN   dmu_class  dc
              ON     dc.dmu_class_id = ' .$id. '
              AND    dc.dmu_class_id = dcl.dmu_class_id
              GROUP BY date_format( d.b_date, "%Y" )
		          ORDER BY d.b_date';

      $result = $db->execute($sql);

      $dco="X";

      if ($db->count_select() > 0)
      {
        while ($row = mysqli_fetch_assoc($result))
        {
          $dc=$row['dc'];
          $ct=$row['ct'];

          if ($dc == "UNKN")
          {
            $ok = 0;
	          continue;
	        }

          if ($dco != "X")
            for ($nx=$dco+1;$nx<$dc;$nx++)
		          $data1[$nx] = 0;
          $data1[$dc] = $ct;
          $dco = $dc;
          $ok = 1;
        }
      }
    }
    else
    {
      echo "No data available for this class yet.";
      exit(0);
    }

    $sql = 'SELECT date_format(min(d.b_date),"%M %Y") mbmin,
                   date_format(max(d.b_date),"%M %Y") mbmax,
                   count(*) AS cl
                   FROM   dmu d
                   JOIN   dmu_class_link dcl
                   ON     dcl.dmu_id = d.dmu_id
                   AND    dcl.dmu_class_id = ' .$id;

//echo $sql . "<br />";
    $result = $db->execute($sql);

    if ($db->count_select() == 1)
    {
      $row = mysqli_fetch_assoc($result);
      if (!empty($row['mbmin']))
      {
        $numlocos = $row['cl'];
        $mbmin = $row['mbmin']; $minbyear = substr($mbmin, -4, 4);
        $mbmax = $row['mbmax']; $maxbyear = substr($mbmax, -4, 4);
      }
      else
      {
        $mbmin = "Unknown";
        $mbmax = "Unknown";
        $numlocos = 0;
        $ok = 0;
      }
    }

    if ($ok)
    {
      printf("<table width=99%% format=box>\n");
	    printf("<tr>\n");
	      printf("<td width=30%% valign=top>\n");
		      printf("<br /><h4>Locomotive Construction</h4><br />\n");
          printf("<p>The following graph shows the number of locomotives built by year.</p>\n");
          if ($numlocos > 1)
            printf("<p>The first locomotive was delivered in %s and the last in %s.\n", 
                   $mbmin, $mbmax);
          else
            printf("<p>The locomotive was delivered in %s.\n", $mbmin);

          if ($minbyear != $maxbyear)
            printf("A total of %d locomotives were built between %s and %s.\n", 
                 $numlocos, $minbyear, $maxbyear);
          else
          if ($numlocos > 1)
            printf("A total of %d locomotives were built in %s.\n", $numlocos, $minbyear);

          printf("</p></td>\n");
	      printf("<td width=70%% valign=top>\n");
		      $mydataval=urlencode(serialize($data1));
	        echo "<img src=\"includes/phpgl_built.php?mydata=$mydataval\"></td>";
		    printf("</td>\n");
	    printf("</tr>\n");
      printf("</table>\n");
    }
  

  if ($classcount > 1)
  {
	// rebuilds. Ugh!
  }
  else
  if ($classcount == 1)
  {
    // get years the locomotives were built
    $sql = 'SELECT ifnull(date_format( d.w_date, "%Y" ), "UNKN") dw,
	           count( * ) ct
            FROM   dmu d
            JOIN   dmu_class_link dcl
            ON     dcl.dmu_id = d.dmu_id
            JOIN   dmu_class  dc
            ON     dc.dmu_class_id = ' .$id. '
            AND    dc.dmu_class_id = dcl.dmu_class_id
            GROUP BY date_format( d.w_date, "%Y" )
            ORDER BY d.w_date';
//echo $sql . "<br />";
    $result = $db->execute($sql);

    $dwo="X";

    while ($row = mysqli_fetch_assoc($result))
    {
      $dw=$row['dw'];
      $ct=$row['ct'];

        if ($dw == "UNKN")
        continue;
      if ($dwo != "X")
          for ($nx=$dwo+1;$nx<$dw;$nx++)
        $data2[$nx] = 0;
      $data2[$dw] = $ct;
      $dwo = $dw;
    }

    $sql = 'SELECT date_format(min(d.w_date),"%M %Y") mwmin,
                   date_format(max(d.w_date),"%M %Y") mwmax,
                   count(*) cl
            FROM   dmu d
            JOIN   dmu_class_link dcl
            ON     dcl.dmu_id = d.dmu_id
            AND    dcl.dmu_class_id = ' .$id. '
            WHERE  d.w_date is not null';
//echo $sql . "<br />";

    $result = $db->execute($sql);

    $nolocos = 0;
    while ($row = mysqli_fetch_assoc($result))
    {
      $numlocos = $row['cl'];
      $mwmin = $row['mwmin']; $minwyear = substr($mwmin, -4, 4);
      $mwmax = $row['mwmax']; $maxwyear = substr($mwmax, -4, 4);
    }

    printf("<table width=99%% format=box>\n");
	    printf("<tr>\n");
        printf("<td width=30%% valign=top>\n");
          printf("<br /><h4>Locomotive Withdrawals</h4><br />\n");

          printf("<p>The following graph shows the number of locomotives withdrawn by year.</p>\n");
          if ($numlocos > 1)
            printf("<p>The first locomotive was withdrawn in %s and the last in %s.\n", 
                   $mwmin, $mwmax);
          else
          if ($numlocos == 1)
            printf("<p>The locomotive was withdrawn in %s.\n", $mwmin);
          else
            printf("<p>No locomotives withdrawn yet.\n");

          if ($numlocos && $minwyear != $maxwyear)
            printf("A total of %d locomotives were withdrawn between %s and %s.\n", 
                 $numlocos, $minwyear, $maxwyear);
          else
          if ($numlocos > 1)
            printf("A total of %d locomotives were withdrawn in %s.\n", $numlocos, $minwyear);

        printf("</p></td>\n");
        printf("<td width=70%% valign=top>\n");
          if ($numlocos > 0)
          {
            $mydataval=urlencode(serialize($data2));
            echo "<img src=\"includes/phpgl_withdrawn.php?mydata=$mydataval\">";
          }
          else
          {
            echo "<br /><h4>No withdrawals yet!</h4>";
          }
        printf("</td>\n");
	    printf("</tr>\n");
    printf("</table>\n");
  }

  
  if ($classcount > 1)
  {
	// rebuilds. Ugh!
  }
  else
  {
	for ($nx = $minbyear; $nx < $maxwyear+1; $nx++)
	{
      if ($data1[$nx] > 0)
		$data1a[$nx] = $data1[$nx];
	  else
		$data1a[$nx] = 0;

	  if ($data2[$nx] > 0)
	    $data2a[$nx] = $data2[$nx];
	  else
	    $data2a[$nx] = 0;
	}

    printf("<table width=99%% format=box>\n");
	    printf("<tr>\n");
	      printf("<td width=30%% valign=top>\n");
          printf("<br /><h4>Class Lifespan</h4><br />\n");
          printf("<p>This graph show the relationship between builds and withdrawals.</p>\n");
          if ($numlocos > 1)
            printf("<p>The first locomotive was built in %s and the last was withdrawn in %s.\n",
                    $mbmin, $mwmax);
          else
          if ($numlocos == 1)
            printf("<p>The locomotive was built in %s and withdrawn in %s\n", $mbmin, $mwmax);
          else
            printf("<p>No locomotives withdrawn yet.\n");
        printf("</p></td>\n");
	      printf("<td width=70%% valign=top>\n");
          if ($numlocos > 0)
          {
            $mydataval1=urlencode(serialize($data1a));
            $mydataval2=urlencode(serialize($data2a));
            echo "<img src=\"includes/phpgl_lifespan.php?mydata1=$mydataval1&mydata2=$mydataval2\">";
          }
          else
            echo "<br /><h4>No withdrawals yet!</h4>";
		    printf("</td>\n");
	    printf("</tr>\n");
    printf("</table>\n");
  }

  if ($classcount > 1)
  {
	// rebuilds. Ugh!
  }
  else
  {
	for ($nx = $minbyear; $nx < $maxwyear+1; $nx++)
	{
	  $t1 = $data1[$nx] - $data2[$nx];
	  $tot += $t1;
	  $data3[$nx] = $tot;
	}

//	print_r($data1); echo "<br />";
//	print_r($data2); echo "<br />";
//	print_r($data3); echo "<br />";

    printf("<table width=99%% format=box>\n");
	    printf("<tr>\n");
	      printf("<td width=30%% valign=top>\n");
		      printf("<br /><h4>Class Stock</h4><br />\n");
          printf("<p>This graph shows the number of locomotives in this class, by year, ");
          printf("over the entire lifespan of the class.\n");
          printf("This information illustrates how rapidly/slowly a class may have been ");
          printf("constructed or withdrawn from service.</p>\n"); 
          if ($numlocos == 0)
            printf("<p>No locomotives withdrawn yet - can't display data\n");
        printf("</td>\n");
	      printf("<td width=70%% valign=top>\n");
          if ($numlocos > 0)
          {
            $mydataval=urlencode(serialize($data3));
            echo "<img src=\"includes/phpgl_totalsvc.php?mydata=$mydataval\">";
          }
          else
            echo "<br /><h4>No withdrawals yet!</h4>";
		    printf("</td>\n");
	    printf("</tr>\n");
    printf("</table>\n");
  }

?>