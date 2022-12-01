<?php

  // first, check if any locos were reclassified at some point in their career (not within a
  // class, but from one class to another (i.e. class 30 to class 31)
    
    $sql = 'select scl1.s_class_id sci,
                   count(*) ct
            from   s_class_link scl1
            join   s_class_link scl2
            on     scl2.loco_id = scl1.loco_id
            and    scl2.s_class_id = ' .$id. '
            group by scl1.s_class_id';

    $result = $db->execute($sql);

    if (($classcount = $db->count_select()) > 1)
    {
      // rebuilds. Ugh!
      echo "Data unavailable for this class.";
      exit(0);
    }

    if ($classcount == 0)
    {
      echo "Data unavailable for this class.";
      exit(0);
    }
    
    // get years the locomotives were built
    $sql = 'SELECT IFNULL(DATE_FORMAT( s.b_date, "%Y" ), "UNKN") dc,
                   COUNT( * ) ct
            FROM   steam s
            JOIN   s_class_link scl
            ON     scl.loco_id = s.loco_id
            JOIN   s_class  sc
            ON     sc.s_class_id = ' .$id. '
            AND    sc.s_class_id = scl.s_class_id
            GROUP BY date_format( s.b_date, "%Y" )
            ORDER BY s.b_date';

    $result = $db->execute($sql);

    $dco="X";
    
    $data1 = array();
    $data2 = array();
    $data3 = array();
    $data1a = array();
    $data2a = array();

    if (($yearcountb = $db->count_select()) > 0)
    {
      $unknown_b = 0;
        
      while ($row = mysqli_fetch_assoc($result))
      {
        $dc=$row['dc'];
        $ct=$row['ct'];

        if ($dc == "UNKN")
        {
          // Unknown build dates
          $unknown_b = 1;
          break;
        }

        if ($dco != "X")
          for ($nx=$dco+1;$nx<$dc;$nx++)
            $data1[$nx] = 0;
        $data1[$dc] = $ct;
        $dco = $dc;
      }
    }

    if ($unknown_b == 0)
    {
      $sql = 'SELECT date_format(min(s.b_date),"%M %Y") mbmin,
                     date_format(max(s.b_date),"%M %Y") mbmax,
                     count(*) AS cl
                     FROM   steam s
                     JOIN   s_class_link scl
                     ON     scl.loco_id = s.loco_id
                     AND    scl.s_class_id = ' .$id;

      $result = $db->execute($sql);

      if ($db->count_select() == 1)
      {
        $row = mysqli_fetch_assoc($result);
        // If the value of mbmin is NULL then we can't display min/max build dates
        if (!empty($row['mbmin']))
        {
          $numblocos = $row['cl'];
          $mbmin = $row['mbmin']; $minbyear = substr($mbmin, -4, 4);
          $mbmax = $row['mbmax']; $maxbyear = substr($mbmax, -4, 4);
        }
        else
        {
          $mbmin = "Unknown";
          $mbmax = "Unknown";
          $numblocos = 0;
          $unknown_b = 1;
        }
      }
    }

    // get years the locomotives were withdrawn
    $sql = 'SELECT ifnull(date_format( s.w_date, "%Y" ), "UNKN") dw,
                   count( * ) ct
            FROM   steam s
            JOIN   s_class_link scl
            ON     scl.loco_id = s.loco_id
            JOIN   s_class  sc
            ON     sc.s_class_id = ' .$id. '
            AND    sc.s_class_id = scl.s_class_id
            GROUP BY date_format( s.w_date, "%Y" )
            ORDER BY s.w_date';

    $result = $db->execute($sql);

    $dwo="X";

    if (($yearcountw = $db->count_select()) > 0)
    {
        while ($row = mysqli_fetch_assoc($result))
        {
          $dw=$row['dw'];
          $ct=$row['ct'];
          
          $unaccounted = 0;

          if ($dw == "UNKN")
          {
            // Unknown withdrawal dates - some of class might still be in service
            // (for diesels and electrics anyway), so allow this figure through
            $unaccounted = $row['ct'];
            continue;
          }
    
          if ($dwo != "X")
            for ($nx=$dwo+1;$nx<$dw;$nx++)
              $data2[$nx] = 0;
      
          $data2[$dw] = $ct;
          $dwo = $dw;
        }
      }

      $sql = 'SELECT date_format(min(s.w_date),"%M %Y") mwmin,
                     date_format(max(s.w_date),"%M %Y") mwmax,
                     count(*) cl
              FROM   steam s
              JOIN   s_class_link scl
              ON     scl.loco_id = s.loco_id
              AND    scl.s_class_id = ' .$id. '
              WHERE  s.w_date is not null';

      $result = $db->execute($sql);

      $nolocos = 0;
      
      if ($db->count_select() == 1)
      {
        $row = mysqli_fetch_assoc($result);
        // If the value of mbmin is NULL then we can't display min/max build dates
        if (!empty($row['mwmin']))
        {
          $numwlocos = $row['cl'];
          $mwmin = $row['mwmin']; $minwyear = substr($mwmin, -4, 4);
          $mwmax = $row['mwmax']; $maxwyear = substr($mwmax, -4, 4);
        }
        else
        {
          $mwmin = "Unknown";
          $mwmax = "Unknown";
          $numwlocos = 0;
          $unknown_w = 1;
        }

    /******************************************
     *                                        *
     * Graph 1: Locomotives built by year     *
     *                                        *
     ******************************************/
     
    if ($unknown_b == 0)
    {
      printf("<table width=\"99%%\" format=\"box\">\n");
      printf("<tr>\n");
        printf("<td width=\"30%%\" valign=\"top\">\n");
          printf("<br /><h4>Locomotive Construction</h4><br />\n");
          
          printf("<p>The following graph shows the number of locomotives built by year.</p>\n");
          if ($numblocos > 1)
            printf("<p>The first locomotive was delivered in %s and the last in %s.\n", 
                   $mbmin, $mbmax);
          else
            printf("<p>The locomotive was delivered in %s.\n", $mbmin);

          if ($minbyear != $maxbyear)
            printf("A total of %d locomotives were built between %s and %s.\n", 
                 $numblocos, $minbyear, $maxbyear);
          else
          if ($numblocos > 1)
            printf("A total of %d locomotives were built in %s.\n", $numblocos, $minbyear);

          printf("</p></td>\n");
        printf("<td width=\"70%%\" valign=\"top\">\n");
          $mydataval=urlencode(serialize($data1));
          echo "<img src=\"includes/phpgl_built.php?mydata=$mydataval\">";
        printf("</td>\n");
      printf("</tr>\n");
      printf("</table>\n");
// print_r($data1); echo "<br />";
    }
  

    /******************************************
     *                                        *
     * Graph 2: Locomotives withdrawn by year *
     *                                        *
     ******************************************/
 // echo $numwlocos . ", " . $minwyear . ", " . $maxwyear .", " . $mwmin .", " . $mwmax ."<br />";
 
    printf("<table width=99%% format=box>\n");
      printf("<tr>\n");
        printf("<td width=30%% valign=top>\n");
          printf("<br /><h4>Locomotive Withdrawals</h4><br />\n");

          printf("<p>The following graph shows the number of locomotives withdrawn by year.</p>\n");
          if ($numwlocos > 1)
            printf("<p>The first locomotive was withdrawn in %s and the last in %s.\n", 
                   $mwmin, $mwmax);
          else
          if ($numwlocos == 1)
            printf("<p>The locomotive was withdrawn in %s.\n", $mwmin);
          else
            printf("<p>No locomotives withdrawn yet.\n");

          if ($numwlocos && $minwyear != $maxwyear)
            printf("A total of %d locomotives were withdrawn between %s and %s.\n", 
                 $numwlocos, $minwyear, $maxwyear);
          else
          if ($numwlocos > 1)
            printf("A total of %d locomotives were withdrawn in %s.\n", $numwlocos, $minwyear);

        printf("</p></td>\n");
        printf("<td width=70%% valign=top>\n");
          if ($numwlocos > 0)
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
    $mydataval = unserialize(urldecode(stripslashes($mydataval)));
//print_r($mydataval); echo "<br />";
  }

  if ($unknown_b == 0)
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

    /******************************************
     *                                        *
     * Graph 3: Locomotives build/withdrawals *
     *          combined                      *
     *                                        *
     ******************************************/
     
    printf("<table width=99%% format=box>\n");
      printf("<tr>\n");
        printf("<td width=30%% valign=top>\n");
          printf("<br /><h4>Class Lifespan</h4><br />\n");
          printf("<p>This graph show the relationship between builds and withdrawals.</p>\n");
          if ($numblocos > 1)
            printf("<p>The first locomotive was built in %s and the last was withdrawn in %s.\n",
                    $mbmin, $mwmax);
          else
          if ($numblocos == 1)
            printf("<p>The locomotive was built in %s and withdrawn in %s\n", $mbmin, $mwmax);
          else
            printf("<p>No locomotives withdrawn yet.\n");
        printf("</p></td>\n");
        printf("<td width=70%% valign=top>\n");
          if ($numblocos > 0)
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
//print_r($data1a); echo "<br />";
//print_r($data2a); echo "<br />";


    for ($nx = $minbyear; $nx < $maxwyear+1; $nx++)
    {
      $t1 = $data1[$nx] - $data2[$nx];
      $tot += $t1;
      $data3[$nx] = $tot;
    }

    /******************************************
     *                                        *
     * Graph 4: Locomotive count by year      *
     *                                        *
     ******************************************/
     
    printf("<table width=99%% format=box>\n");
      printf("<tr>\n");
        printf("<td width=30%% valign=top>\n");
          printf("<br /><h4>Class Stock</h4><br />\n");
          printf("<p>This graph shows the number of locomotives in this class, by year, ");
          printf("over the entire lifespan of the class.\n");
          printf("This information illustrates how rapidly/slowly a class may have been ");
          printf("constructed or withdrawn from service.</p>\n"); 
          if ($numwlocos == 0)
            printf("<p>No locomotives withdrawn yet - can't display data</p>\n");
        printf("</td>\n");
        printf("<td width=70%% valign=top>\n");
          if ($numwlocos > 0)
          {
            $mydataval=urlencode(serialize($data3));
            echo "<img src=\"includes/phpgl_totalsvc.php?mydata=$mydataval\">";
          }
          else
            echo "<br /><h4>No withdrawals yet!</h4>";
        printf("</td>\n");
      printf("</tr>\n");
    printf("</table>\n");
//print_r($data3); echo "<br />";
  }

?>