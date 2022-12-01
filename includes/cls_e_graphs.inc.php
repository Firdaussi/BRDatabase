<?php

  // first, check if any locos were reclassified at some point in their career (not within a
  // class, but from one class to another (i.e. class 30 to class 31)

  $sql = 'select ecl1.e_class_id eci,
                 count(*) ct
          from   e_class_link ecl1
          join   e_class_link ecl2
          on     ecl2.loco_id = ecl1.loco_id
          and    ecl2.e_class_id = ' .$id. '
          group by ecl1.e_class_id';

  $result = $db->execute($sql);
  fn_check_result($result);

  $classcount = $db->count_select();
  
  if ($classcount == 0)
  {
    printf("Unknown class (or data not accurate enough to use) with id %d<br />", $id);
    die("");
  }
  else
  if ($classcount > 1)
  {
    printf("Classes with rebuilds (and classified as new classes) not yet handled<br />");
    die("");
  }
  else
  if ($classcount == 1)
  {
    // get years the locomotives were built
    $sql = 'SELECT ifnull(date_format( e.b_date, "%Y" ), "UNKN") ec,
                   count( * ) ct
            FROM   electric e
            JOIN   e_class_link ecl
            ON     ecl.loco_id = e.loco_id
            JOIN   e_class  ec
            ON     ec.e_class_id = ' .$id. '
            AND    ec.e_class_id = ecl.e_class_id
            GROUP BY date_format( e.b_date, "%Y" )
            ORDER BY e.b_date';

    $result = $db->execute($sql);
    fn_check_result($result);
    
    $dco="X";

    if ($db->count_select() > 0)
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        $dc=$row['ec'];
        $ct=$row['ct'];

        if ($dc == "UNKN")
          continue;

        if ($dco != "X")
          for ($nx=$dco+1;$nx<$dc;$nx++)
            $data1[$nx] = 0;

        $data1[$dc] = $ct;
        $dco = $dc;
      }
    }
    else
    {
      printf("Cannot process as insufficient data available<br />");
      die("");
    }

    $sql = 'SELECT date_format(min(e.b_date),"%M %Y") mbmin,
                   date_format(max(e.b_date),"%M %Y") mbmax,
                   count(*) cl
            FROM   electric e
            JOIN   e_class_link ecl
            ON     ecl.loco_id = e.loco_id
            AND    ecl.e_class_id = ' .$id;

    $result = $db->execute($sql);
    fn_check_result($result);
    
    if ($db->count_select())
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        $numlocos = $row['cl'];
        $mbmin = $row['mbmin']; $minbyear = substr($mbmin, -4, 4);
        $mbmax = $row['mbmax']; $maxbyear = substr($mbmax, -4, 4);
      }
    }

    printf("<table width=99%% format=box>\n");
    printf("<tr>\n");
      printf("<td width=30%% valign=top>\n");
    printf("<br /><h4>Locomotive Construction</h4><br />\n");
    printf("<p>The following graph shows the number of locomotives built by year.</p>\n");
    if ($numlocos > 1)
      printf("<p>The first locomotive was delivered in %s and the last in %s.\n", $mbmin, $mbmax);
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
  }


    // get years the locomotives were withdrawn
    $sql = 'SELECT ifnull(date_format( e.w_date, "%Y" ), "UNKN") dw,
                   count( * ) ct
            FROM   electric e
            JOIN   e_class_link ecl
            ON     ecl.loco_id = e.loco_id
            JOIN   e_class  ec
            ON     ec.e_class_id = ' .$id. '
            AND    ec.e_class_id = ecl.e_class_id
            GROUP BY date_format( e.w_date, "%Y" )
            ORDER BY e.w_date';

    $result = $db->execute($sql);

    $dwo="X";
    $no_withdrawals = false;
    
    if (($rw = $db->count_select()))
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        $dw=$row['dw'];
        $ct=$row['ct'];

        if ($rw == 1 && strcmp($dw, "UNKN") == 0)
        {
          $no_withdrawals = true;
          break;
        }

        if ($dw == "UNKN")
          continue;

        if ($dwo != "X")
          for ($nx=$dwo+1;$nx<$dw;$nx++)
            $data2[$nx] = 0;

        $data2[$dw] = $ct;
        $dwo = $dw;
      }
    }

    if (!$no_withdrawals)
    {
      $sql = 'SELECT date_format(min(e.w_date),"%M %Y") mwmin,
                     date_format(max(e.w_date),"%M %Y") mwmax,
                     count(*) cl
              FROM   electric e
              JOIN   e_class_link ecl
              ON     ecl.loco_id = e.loco_id
              AND    ecl.e_class_id = ' .$id. '
              WHERE  e.w_date is not null';

      $result = $db->execute($sql);

      if ($db->count_select())
      {
        while ($row = mysqli_fetch_assoc($result))
        {
          $numlocos = $row['cl'];
          $mwmin = $row['mwmin']; $minwyear = substr($mwmin, -4, 4);
          $mwmax = $row['mwmax']; $maxwyear = substr($mwmax, -4, 4);
        }
      }

      //printf("<table width=99%% format=box>\n");
      printf("<tr>\n");
        printf("<td width=30%% valign=top>\n");
      printf("<br /><h4>Locomotive Withdrawals</h4><br />\n");
      printf("<p>The following graph shows the number of locomotives withdrawn by year.</p>\n");
      if ($numlocos > 1)
        printf("<p>The first locomotive was withdrawn in %s and the last in %s.\n", $mwmin, $mwmax);
      else
        printf("<p>The locomotive was withdrawn in %s.\n", $mwmin);

      if ($minwyear != $maxwyear)
        printf("A total of %d locomotives were withdrawn between %s and %s.\n", 
             $numlocos, $minwyear, $maxwyear);
      else
      if ($numlocos > 1)
        printf("A total of %d locomotives were withdrawn in %s.\n", $numlocos, $minwyear);

      printf("</p></td>\n");
        printf("<td width=70%% valign=top>\n");
        $mydataval=urlencode(serialize($data2));
          echo "<img src=\"includes/phpgl_withdrawn.php?mydata=$mydataval\"></td>";
      printf("</td>\n");
      printf("</tr>\n");
 

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

      //printf("<table width=99%% format=box>\n");
      printf("<tr>\n");
        printf("<td width=30%% valign=top>\n");
      printf("<br /><h4>Class Lifespan</h4><br />\n");
      printf("<p>This graph show the relationship between builds and withdrawals.</p>\n");
      if ($numlocos > 1)
        printf("<p>The first locomotive was built in %s and the last was withdrawn in %s.\n", $mbmin, $mwmax);
      else
        printf("<p>The locomotive was built in %s and withdrawn in %s\n", $mbmin, $mwmax);

      printf("</p></td>\n");
        printf("<td width=70%% valign=top>\n");
        $mydataval1=urlencode(serialize($data1a));
        $mydataval2=urlencode(serialize($data2a));
          echo "<img src=\"includes/phpgl_lifespan.php?mydata1=$mydataval1&mydata2=$mydataval2\"> </td>";
      printf("</td>\n");
      printf("</tr>\n");

    for ($nx = $minbyear; $nx < $maxwyear+1; $nx++)
    {
      $t1 = $data1[$nx] - $data2[$nx];
      $tot += $t1;
      $data3[$nx] = $tot;
    }

//  print_r($data1); echo "<br />";
//  print_r($data2); echo "<br />";
//  print_r($data3); echo "<br />";

      //printf("<table width=99%% format=box>\n");
      printf("<tr>\n");
        printf("<td width=30%% valign=top>\n");
      printf("<br /><h4>Locomotive Count over Time</h4><br />\n");
      printf("<p>This graph show the relationship between builds and withdrawals.</p>\n");
      if ($numlocos > 1)
        printf("<p>The first locomotive was built in %s and the last was withdrawn in %s.\n", $mbmin, $mwmax);
      else
        printf("<p>The locomotive was built in %s and withdrawn in %s\n", $mbmin, $mwmax);

      printf("</p></td>\n");
        printf("<td width=70%% valign=top>\n");
        $mydataval=urlencode(serialize($data3));
          echo "<img src=\"includes/phpgl_totalsvc.php?mydata=$mydataval\"> </td>";
      printf("</td>\n");
      printf("</tr>\n");

    }
    else
    {
      printf("<tr>\n");
        printf("<td width=30%% valign=top>\n");
      printf("<br /><h4>No Locos withdrawn to date</h4><br />\n");

      printf("</p></td>\n");
      printf("</tr>\n");
    }
    
    printf("</table>\n");
?>