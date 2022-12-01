<?php

/***********************************************************************************************/
/*                                                                                             */
/* Stage 0: Preliminaries - set up tables and work out parameters                              */
/*                                                                                             */
/***********************************************************************************************/

  include_once("lib/brlib.php");
  include_once("lib/MyTables.class.php");
  include_once("lib/date_span.class.php");

  $sql = "select min(e.b_date) AS mindate
          from   electric e
          join   e_class_link ecl
          on     ecl.loco_id = e.loco_id
          join   e_class ec
          on     ec.e_class_id = ecl.e_class_id
          where  ec.e_class_id = " . $id;

  $result = $db->execute($sql);

  if ($db->count_select())
    $row = mysqli_fetch_assoc($result);
  else
    die("No rows returned");

  $year = substr($row['mindate'], 0, 4);
  $mnth = substr($row['mindate'], 5, 2);

  $selfref = $_SERVER['PHP_SELF'] . "?page=locoqry.php&action=class&type=E&page=snapshot&id=" . $id;

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

    $sql = 'SELECT ea2.allocation    AS code,
                   CONCAT("sites.php?page=depots&action=query&id=", dp.depot_id) AS code_hl,
                   dp.depot_name     AS depot,
                   CONCAT("sites.php?page=depots&action=query&id=", dp.depot_id) AS depot_hl,
                   COUNT(*)                      AS ct
            FROM   electric e
            JOIN (
                    select ecl.loco_id,
                           max(ea.seq)        AS sequence,
                           max(ea.alloc_date) AS alloc_dt
                    from   e_class ec
                    join   e_class_link ecl
                    on     ecl.e_class_id = ec.e_class_id
                    and    ec.e_class_id = ' . $id . '
                    left join e_alloc ea
                    on     ea.loco_id = ecl.loco_id
                    and    ea.alloc_date < "'. $yvals[0] . '-' . $mvals[0] . '-01' . '"
                    group by ecl.loco_id
            ) as F
            on F.loco_id = e.loco_id
            left join e_alloc ea2
            on     ea2.loco_id = e.loco_id
            and    ea2.alloc_date = F.alloc_dt
            and    ea2.seq = F.sequence
            left join e_nums en
            on     en.loco_id = e.loco_id
            and    "'. $yvals[0] . '-' . $mvals[0] . '-01' . '" 
                                 between ifnull(en.start_date, "1800-00-00")
                                     and ifnull(en.end_date,   "2999-01-02")
            LEFT JOIN ref_depot_codes dcc
            ON     dcc.depot_code = ea2.allocation
            AND    ea2.alloc_date between dcc.date_from and ifnull(dcc.date_to, "2999-01-01")
            LEFT JOIN ref_depot dp
            ON     dp.depot_id = dcc.depot_id
            left join e_nums en2
            on     en2.loco_id = e.loco_id
            and    en2.start_date = e.b_date
            GROUP BY 1,2,3,4
            ORDER BY ct DESC';

    $result = $db->execute($sql);

    if ($db->count_select())
      while ($dprow[] = mysqli_fetch_assoc($result))
        ;

//    echo "1: Records found: " . count($dprow) . "<br />";

    $sql = 'select e.loco_id,
                   e.b_date,
                   e.w_date,
                   e.s_date,
                   e.disposed_by,
                   ea2.allocation,
                   concat("sites.php?page=depots&action=query&id=", dp.depot_id) AS allocation_hl,
                   ea2.alloc_date,
                   dp.depot_name,
                   concat("sites.php?page=depots&action=query&id=", dp.depot_id) AS depot_name_hl,
                   en.number         AS curr_number,
                   concat("locoqry.php?action=locodata&id=",e.loco_id,"&type=E&loco=",en.number)
                                     AS curr_number_hl,
                   en.number_type    AS curr_number_type,
                   en.start_date     AS curr_start_date,
                   en.end_date       AS curr_end_date,
                   en2.number        AS orig_number,
                   concat("locoqry.php?action=locodata&id=",e.loco_id,"&type=E&loco=",en.number)
                                     AS orig_number_hl,
                   en2.number_type   AS orig_number_type,
                   NULL              AS age,
                   NULL              AS status,
                   NULL              AS info
            from   electric e
            join (
                    select ecl.loco_id,
                           max(ea.seq)        AS sequence,
                           max(ea.alloc_date) AS alloc_dt
                    from   e_class ec
                    join   e_class_link ecl
                    on     ecl.e_class_id = ec.e_class_id
                    and    ec.e_class_id = ' . $id . '
                    left join e_alloc ea
                    on     ea.loco_id = ecl.loco_id
                    and    ea.alloc_date < "'. $yvals[0] . '-' . $mvals[0] . '-01' . '"
                    group by ecl.loco_id
            ) as F
            on F.loco_id = e.loco_id
            left join e_alloc ea2
            on     ea2.loco_id = e.loco_id
            and    ea2.alloc_date = F.alloc_dt
            and    ea2.seq = F.sequence
            left join e_nums en
            on     en.loco_id = e.loco_id
            and    "'. $yvals[0] . '-' . $mvals[0] . '-01' . '" 
                                 between ifnull(en.start_date, "1800-00-00")
                                     and ifnull(en.end_date,   "2999-01-02")
            LEFT JOIN ref_depot_codes dcc
            ON     dcc.depot_code = ea2.allocation
            AND    ea2.alloc_date between dcc.date_from and ifnull(dcc.date_to, "2999-01-01")
            LEFT JOIN ref_depot dp
            ON     dp.depot_id = dcc.depot_id
            left join e_nums en2
            on     en2.loco_id = e.loco_id
            and    en2.start_date = e.b_date';


    $dt = new date_span();

    printf("<table width=99%% valign=TOP frame=box class=\"sortable\" id=\"snapshot\">\n");
    printf("<caption>Snapshot for 1961-01</caption>\n");
    printf("<tr>\n");
    printf("<th width=5%%><strong>Number as built</strong></th>\n");
    printf("<th width=5%%><strong>Carried Number</strong></th>\n");
    printf("<th width=15%%><strong>Status</strong></th>\n");
    printf("<th width=5%%><strong>Depot Code</strong></th>\n");
    printf("<th width=15%%><strong>Depot</strong></th>\n");
    printf("<th width=20%%><strong>Age</strong></th>\n");
    printf("<th width=35%%><strong>Extra Info</strong></th>\n");
    printf("</tr>\n");


/*
    $tb_snap->add_caption("Snapshot for " . $checkdate0);
    $tb_snap->add_column("orig_number",    "Number as built", 5);
    $tb_snap->add_column("curr_number",    "Carried Number",  5);
    $tb_snap->add_column("status",         "Status",         15);
    $tb_snap->add_column("allocation",     "Depot Code",      5); 
    $tb_snap->add_column("depot_name",     "Depot",          15);
    $tb_snap->add_column("age",            "Age",            20);
    $tb_snap->add_column("info",           "Extra Info",     35);
*/

    $count = 0;

    $result = $db->execute($sql);

    $tot = $nins = $wdn = $wdn_tm = $ins = $ins_tm = $scr = $scr_tm = $scr_wt = $prs = $prs_wt = 0;;
    $alloc = array();

    if ($db->count_select())
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        /* Last record for loco so display details with extra information filled in */
        $c1  = strncmp($checkdate1, $row['b_date'], 7);
        $c2  = strncmp($checkdate1, $row['w_date'], 7);
        $c2a = empty($row['w_date']);
        $c3  = strncmp($checkdate1, $row['s_date'], 7);
        $c3a = empty($row['s_date']);

        $row['curr_number'] = fn_e_pfx($row['curr_number']);
        $row['orig_number'] = fn_e_pfx($row['orig_number']);

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
            $ins++;
            $row['status']  = "<font color=\"green\"><strong>In Service</strong></font>";
            $row['age']     = $dt->calculate_span($row['b_date'], $checkdate1a);
            $row['age_fmt'] = $dt->calculate_span($row['b_date'], $checkdate1a, "Y");
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
            if ($row['disposed_by'] == "P")
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
            if ($row['disposed_by'] == "P")
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

        printf("<tr>\n");
        printf("<td width=5%%><a href=locoqry.php?action=locodata&id=%s&type=E>%s</a></td>",
               $row['loco_id'], $row['orig_number']);
        printf("<td width=5%%><a href=locoqry.php?action=locodata&id=%s&type=E&loco=%s>%s</a></td>",
               $row['loco_id'], $row['curr_number'], $row['curr_number']);
        printf("<td width=15%%>%s</td>\n", $row['status']);
        printf("<td width=5%%><a href=sites.php?page=depots&action=query&id=%s>%s</a></td>",
               $row['depot_id'], $row['allocation']);
        printf("<td width=15%%><a href=sites.php?page=depots&action=query&id=%s>%s</a></td>",
               $row['depot_id'], $row['depot_name']);
        printf("<td width=20%% sorttable_customkey=%s>%s</td>\n", $row['age_fmt'], $row['age']);
        printf("<td width=35%%>%s (%s)</td>", $row['info'], $row['age_fmt']);
        printf("</tr>\n");
      }

      printf("</table>\n");

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
    $tb_stats->add_row("wd",    "Withdrawn");
    $tb_stats->add_row("wdm",   "Withdrawn this Month");
    $tb_stats->add_row("sc",    "Scrapped");
    $tb_stats->add_row("scm",   "Scrapped this Month");

    $r = array('locos' => $tot,
               'nyb'   => $nins,
               'is'    => $ins,
               'ism'   => $ins_tm,
               'wd'    => $wdn,
               'wdm'   => $wdn_tm,
               'sc'    => $scr,
               'scm'   => $scr_tm);

    $tb_stats->add_data($r);

    $rw['stats'] = $tb_stats->draw_table(FALSE);

    $tb_depots = new MyTables("depots_table");
    $tb_depots->suppress_nulls();
    $tb_depots->sortable();
    $tb_depots->add_column("code",  "Depot Code",   10);
    $tb_depots->add_column("depot", "Depot Name",   65);
    $tb_depots->add_column("ct",    "Count",        25);

//    echo "2: Records found: " . count($dprow) . "<br />";

    for ($nx = 0; $nx < count($dprow); $nx++)
    {
      if (!empty($dprow[$nx]['code']))
        $tb_depots->add_data($dprow[$nx]);
    }

    $x = $rw['depots'] = $tb_depots->draw_table(FALSE);
//print "(" . $x . ")";

    $tb_summ->add_data($rw);
    $tb_summ->draw_table();

    unset($tb_depots);
    unset($tb_status);

//    print_r($rw);
//    print_r($alloc2);
  }

?>

  <p>Enter Snapshot Date:</p>
  <form method="post" action="<?php echo $selfref; ?>">
    <fieldset "snap">
    <table width="36%" frame=box border=0 cellpadding=1>
      <tr>
        <td width=25%>

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
