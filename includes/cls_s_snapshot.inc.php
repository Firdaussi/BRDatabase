<?php

/***********************************************************************************************/
/*                                                                                             */
/* Stage 0: Preliminaries - set up tables and work out parameters                              */
/*                                                                                             */
/***********************************************************************************************/

  include_once("lib/brlib.php");
  include_once("lib/MyTables.class.php");
  include_once("lib/date_span.class.php");

  $tot = $nins = $wdn = $wdn_tm = $ins = $ins_tm = $scr = $scr_tm = $scr_wt = $prs = $prs_wt = $store = $store_tm = 0;

  $sql = "select min(s.b_date) AS mindate
          from   steam s
          join   s_class_link scl
          on     scl.loco_id = s.loco_id
          join   s_class sc
          on     sc.s_class_id = scl.s_class_id
          where  sc.s_class_id = " . $id;

  $result = $db->execute($sql);

  if ($db->count_select())
    $row = mysqli_fetch_assoc($result);
  else
    die("No rows returned");

  $year = substr($row['mindate'], 0, 4);
  $mnth = substr($row['mindate'], 5, 2);

  $selfref = $_SERVER['PHP_SELF'] . "?page=locoqry.php&action=class&type=S&page=snapshot&id=" . $id;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 1: Get all locomotives from this class                                                */
/*                                                                                             */
/***********************************************************************************************/

  if (isset($_POST['mon_select']) or (!empty($_POST['mon_select'])))
  {
    @$mvals = $_POST['mon_select'];
    @$yvals = $_POST['year_select'];

    $checkdate0 = sprintf("%04s-%02s", $yvals[0], $mvals[0]);

    if ($mvals[0] == 12)
    {
      $mvals[0] = 1;
      $yvals[0] += 1;
    }
    else
      $mvals[0]++;

    $checkdate1 = sprintf("%04s-%02s", $yvals[0], $mvals[0]);
    $checkdate1a = sprintf("%04s-%02s-01", $yvals[0], $mvals[0]);

//  echo $checkdate0 . ", " . $checkdate1 . ", " . $checkdate1a . "<BR />";

    $sql = 'select coalesce(dpc2.displayed_depot_code, dpc2.depot_code)   AS code,
                   concat("sites.php?page=depots&action=query&id=", 
                                                             dp.depot_id) AS code_hl,
                   dp.depot_name                                          AS depot,
                   concat("sites.php?page=depots&action=query&id=", 
                                                             dp.depot_id) AS depot_hl,
                   count(*)                                               AS ct
            from   steam s

            join (
                    select scl.loco_id,
                           max(concat(date_format(sa.alloc_date, "%Y%m%d"), lpad(sa.seq, 3, "0"))) AS sequence

                    from   s_class sc

                    join   s_class_link scl
                    on     scl.s_class_id = sc.s_class_id
                    and    sc.s_class_id = ' . $id . '

                    left join s_alloc sa
                    on     sa.loco_id = scl.loco_id
                    and    sa.alloc_date < "'. $yvals[0] . '-' . $mvals[0] . '-01' . '"

                    group by scl.loco_id
            ) as F
            on F.loco_id = s.loco_id

            left join s_alloc sa2
            on     sa2.loco_id = s.loco_id
            and    concat(date_format(sa2.alloc_date, "%Y%m%d"), lpad(sa2.seq, 3, "0")) = F.sequence
            and    sa2.allocation not like "98%"
            
            LEFT JOIN s_nums sn
            ON     sn.loco_id = s.loco_id
            AND    sn.start_date = (SELECT max(sn1.start_date)
                                    FROM   s_nums sn1
                                    WHERE  sn1.loco_id = sn.loco_id
                                    AND    sn1.start_date < "'. $checkdate1a . '")

            LEFT JOIN ref_depot_codes dpc1
            ON     dpc1.depot_code = sa2.allocation
            AND    dpc1.date_from = (SELECT max(dpc1a.date_from)
                                     FROM   ref_depot_codes dpc1a
                                     WHERE  dpc1a.depot_code = sa2.allocation
                                     AND    dpc1a.date_from <= "'. $checkdate1a . '")

            LEFT JOIN ref_depot dp
            ON     dp.depot_id = dpc1.depot_id

            LEFT JOIN ref_depot_codes dpc2
            ON     dpc2.depot_id = dp.depot_id
            AND    dpc2.date_from = (SELECT max(dpc2a.date_from)
                                     FROM   ref_depot_codes dpc2a
                                     WHERE  dpc2a.depot_id = dp.depot_id
                                     AND    dpc2a.date_from <= "'. $checkdate1a . '")
            AND    dpc2.gwr_flag = "N"
            
            

            GROUP BY 1,2,3,4

            ORDER BY ct DESC';

    //echo $sql;

    $result = $db->execute($sql);

    if ($db->count_select())
      while ($dprow[] = mysqli_fetch_assoc($result))
        ;

//    echo "1: Records found: " . count($dprow) . "<br />";

    $sql = 'SELECT s.loco_id,
                   s.b_date,
                   s.w_date,
                   s.s_date,
                   s.preserved,
                   sa.allocation AS old_alloc,
                   coalesce(dpc2.displayed_depot_code, dpc2.depot_code)          AS allocation,
                   concat("sites.php?page=depots&action=query&id=", dp.depot_id) AS allocation_hl,
                   sa.alloc_date,
                   dp.depot_name,
                   concat("sites.php?page=depots&action=query&id=", dp.depot_id) AS depot_name_hl,
                   sn.prefix,
                   sn.suffix,
                   sn.number         AS curr_number,
                   concat("locoqry.php?action=locodata&id=",s.loco_id,"&type=S&loco=",sn.number)
                                     AS curr_number_hl,
                   sn.number_type    AS curr_number_type,
                   sn.start_date     AS curr_start_date,
                   sn.end_date       AS curr_end_date,
                   NULL              AS age,
                   NULL              AS status,
                   NULL              AS info,
                   round(datediff("'. $checkdate1a . '", s.b_date) / 365, 3)  
                                                                                 AS service_prd

            FROM   s_class sc

            JOIN   s_class_link scl
            ON     scl.s_class_id = sc.s_class_id
            AND    scl.start_date = (SELECT max(scl1.start_date)
                                     FROM   s_class_link scl1
                                     WHERE  scl1.loco_id = scl.loco_id
                                     AND    scl1.s_class_id = sc.s_class_id
                                     AND    scl1.start_date < "'. $checkdate1a . '")

            JOIN   steam s
            ON     s.loco_id = scl.loco_id


            LEFT JOIN s_alloc sa
            ON     sa.loco_id = s.loco_id
            AND    concat(sa.alloc_date, sa.seq) = (SELECT max(concat(sa1.alloc_date, sa1.seq))
                                                    FROM   s_alloc sa1
                                                    WHERE  sa1.loco_id = sa.loco_id
                                                    AND    sa1.alloc_date < 
                                                           "'. $checkdate1a . '")

            LEFT JOIN s_nums sn
            ON     sn.loco_id = s.loco_id
            AND    sn.start_date = (SELECT max(sn1.start_date)
                                    FROM   s_nums sn1
                                    WHERE  sn1.loco_id = sn.loco_id
                                    AND    sn1.start_date < "'. $checkdate1a . '")

            LEFT JOIN ref_depot_codes dcc
            ON     dcc.depot_code = sa.allocation
            AND    dcc.date_from =  (SELECT max(dcc1.date_from)
                                     FROM   ref_depot_codes dcc1
                                     WHERE  dcc1.depot_code = sa.allocation
                                     AND    dcc1.date_from <= "'. $checkdate1a . '")

            LEFT JOIN ref_depot dp
            ON     dp.depot_id = dcc.depot_id

            LEFT JOIN ref_depot_codes dpc2
            ON     dpc2.depot_id = dp.depot_id
            AND    dpc2.date_from = (SELECT max(dpc2a.date_from)
                                     FROM   ref_depot_codes dpc2a
                                     WHERE  dpc2a.depot_id = dp.depot_id
                                     AND    dpc2a.gwr_flag = "N"
                                     AND    dpc2a.date_from <= "'. $checkdate1a . '")
            AND    dpc2.gwr_flag = "N"

            WHERE  sc.s_class_id = ' . $id;


    // echo "<br />" . $sql;

    $tb_snap = new MyTables("snapshot");
    $tb_snap->add_caption("Snapshot for " . $checkdate0);
    $tb_snap->sortable();
    $tb_snap->add_column("curr_number",    "Carried Number",  5);
    $tb_snap->add_column("status",         "Status",         15);
    $tb_snap->add_column("allocation",     "Depot Code",      5); 
    $tb_snap->add_column("depot_name",     "Depot",          20);
    $tb_snap->add_column("service_prd",    "Age",             7);
    $tb_snap->add_column("info",           "Extra Info",     48);
    $count = 0;

    $result = $db->execute($sql);

    if ($db->count_select())
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        $c1  = strncmp($checkdate1, $row['b_date'], 7);
        $c2  = strncmp($checkdate1, $row['w_date'], 7);
        $c2a = empty($row['w_date']);
        $c3  = strncmp($checkdate1, $row['s_date'], 7);
        $c3a = empty($row['s_date']);

  //echo $row['loco_id'] . " - Comparing " . $checkdate1 .  " and " . $row['b_date'] . "(" . $c1 . ")/" . $row['w_date'] . "(" . $c2 . ") + (" . $c3 . "/" . $c3a . "/" . $row['s_date'] . ")<br />";

        $tot++;

        if ($c1 < 0)
        {
          $nins++;
          $row['status'] = "<font color=\"orange\"><strong>Not Yet In Service</strong></font>";
        }
        else
        if ($c1 >= 0 && ($c2 < 0 || $c2a == 1))
        {
          if ($c1 == 0)
          {
            $ins_tm++; $ins++;
            $row['status'] = "<font color=\"green\"><strong>To Service this month</strong></font>";
          }
          else
          {
            if (!strcmp($row['allocation'], "98S"))
            {
              $store++;
              $row['status']  = "<font color=\"orange\"><strong>In Store</strong></font>";
            }
            else
            {
              $ins++;
              $row['status']  = "<font color=\"green\"><strong>In Service</strong></font>";
            }
            
            $dt = new date_span();

            $b_date_tmp = $row['b_date'];

            if (!strncmp(substr($b_date_tmp, 8), "00", 2))
              $b_date_tmp = substr($b_date_tmp, 0, 8) . "15";

            $row['age']     = $dt->calculate_span($b_date_tmp, $checkdate1a);
            $row['age_fmt'] = $dt->calculate_span($b_date_tmp, $checkdate1a, "Y");
          }
        }
        else
        if ($c2 >= 0 && $c2a != 1)
        {
          if ($c2 == 0)
          {
            $wdn_tm++; $wdn++;
            $row['status'] = "<font color=\"red\"><strong>Withdrawn this month</strong></font>";
          }
          else
          {
            $wdn++;
            $row['status'] = "<font color=\"red\"><strong>Withdrawn</strong></font>";
          }

          $row['allocation'] = $row['depot_name'] = "";
          if ($c3 < 0)
          {
            if ($row['preserved'] == "Y")
            {
              $prs_wt++;
              $row['info'] = "Awaiting Preservation";
            }
            else
            {
              $scr_wt++;
              $row['info'] = "Awaiting Scrapping";
            }
          }
          else
          if ($c3 >= 0 || $c3a == 1)
          {
            if ($row['preserved'] == "Y")
            {
              $prs++;
              $row['info'] = "Preserved";
            }
            else
            {
              $scr++;
              if ($c3 == 0)
                $row['info'] = "Scrapped this month";
              else
                $row['info'] = "Scrapped";
            }
          }
        }
        else
          $row['status'] = "Unknown";

        if (!empty($row['prefix']))
          $row['curr_number'] = $row['prefix'] . $row['curr_number'];

        if (!empty($row['suffix']))
          $row['curr_number'] .= $row['suffix'];

        $tb_snap->dump_data($row);
      }

      if ($tot)
        $tb_snap->dump_data(NULL);

      printf("<br /><br />");
    }

    $tb_summ = new MyTables("summary_data");

    $tb_summ->add_caption("Summary for " . $checkdate0);
    $tb_summ->add_column("stats",    "Statistics", 50);
    $tb_summ->add_column("depots",   "Depot Distribution", 50);

    $tb_stats = new MyTables("statistics");
    $tb_stats->add_caption("Statistics");
    $tb_stats->set_align("V");
    $tb_stats->suppress_nulls();
    $tb_stats->add_row_lwidth(50);
    $tb_stats->add_row("locos", "Locomotives in Class");
    $tb_stats->add_row("nyb",   "Not Yet Built");
    $tb_stats->add_row("is",    "In Service");
    $tb_stats->add_row("ism",   "To Service this Month");
    $tb_stats->add_row("st",    "In Store");
    $tb_stats->add_row("stm",   "To Store this Month");
    $tb_stats->add_row("wd",    "Withdrawn");
    $tb_stats->add_row("wdm",   "Withdrawn this Month");
    $tb_stats->add_row("sc",    "Scrapped");
    $tb_stats->add_row("scm",   "Scrapped this Month");

    $r = array('locos' => $tot,
               'nyb'   => $nins,
               'is'    => $ins,
               'ism'   => $ins_tm,
               'st'    => $store,
               'stm'   => $store_tm,
               'wd'    => $wdn,
               'wdm'   => $wdn_tm,
               'sc'    => $scr,
               'scm'   => $scr_tm);

    $tb_stats->add_data($r);

    $rw['stats'] = $tb_stats->draw_table(FALSE);

    $tb_depots = new MyTables("depots_table");
    $tb_depots->suppress_nulls();
    $tb_depots->add_column("code",  "Depot Code",   10);
    $tb_depots->add_column("depot", "Depot Name",   65);
    $tb_depots->add_column("ct",    "Count",        25);

//    echo "2: Records found: " . count($dprow) . "<br />";

    for ($nx = 0, $otherct = 0; $nx < count($dprow); $nx++)
    {
      if (!empty($dprow[$nx]['code']))
      {
        if (strlen($dprow[$nx]['code']) == 3 &&
            $dprow[$nx]['code'][0] == '9')
          ;
        else
        {
          $tb_depots->add_data($dprow[$nx]);

          if ($nx < 10)
            $pie[]   = array($dprow[$nx]['depot'], $dprow[$nx]['ct']);
          else
            $otherct += $dprow[$nx]['ct'];
        }
      }
    }

    if ($otherct > 0)
      $pie[10] = array("Other", $otherct);

    $x = $rw['depots'] = $tb_depots->draw_table(FALSE);
//print "(" . $x . ")";

    $tb_summ->add_data($rw);
    $tb_summ->draw_table();

    if (is_array($pie) && count($pie))
    {
      printf("<br />");
      printf("<table width=99%% format=box>\n");
        printf("<tr>\n");
        printf("<td width=100%% align=center>\n");

        $urlpie = urlencode(serialize($pie));
        $urlt1  = urlencode(serialize("Depot Allocations for " . $checkdate0));
        $urlt2  = urlencode(serialize($title));

        printf("<img src=\"includes/baa_pie.php?data=%s&t1=%s&t2=%s\">",
             $urlpie, $urlt1, $urlt2);

        printf("</td>\n");
      printf("</tr>\n");
      printf("</table>\n");
    }
    
    unset($tb_depots);
    unset($tb_status);


//    print_r($rw);
//    print_r($alloc2);
  }

?>

  <p>Enter Snapshot Date:</p>
  <form method="post" action="<?php echo $selfref; ?>">
    <fieldset id="snap">
    <table width="36%" frame=box border=0 cellpadding=1>
      <tr>
        <td width="25%">

        <SELECT size="1" name="mon_select[]">
          <OPTION value="01">January</OPTION>
          <OPTION value="02">February</OPTION>
          <OPTION value="03">March</OPTION>
          <OPTION value="04">April</OPTION>
          <OPTION value="05">May</OPTION>
          <OPTION value="06">June</OPTION>
          <OPTION value="07">July</OPTION>
          <OPTION value="08">August</OPTION>
          <OPTION value="09">September</OPTION>
          <OPTION value="10">October</OPTION>
          <OPTION value="11">November</OPTION>
          <OPTION value="12">December</OPTION>
        </SELECT>

        </td>

        <td width=10%>

        <SELECT size="1" name="year_select[]">
<?php
        for ($nx = $year; $nx <= 1997; $nx++)
        {
          printf("<OPTION value=\"%d\">%d</OPTION>\n", $nx, $nx);
        }
?>
        </SELECT>
 
        </td>
      </tr>
    </table>

  <input type="submit" id="search-submit" value="GO" />
  </form>
