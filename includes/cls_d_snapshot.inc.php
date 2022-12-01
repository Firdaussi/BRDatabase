<?php

/***********************************************************************************************/
/*                                                                                             */
/* Stage 0: Preliminaries - set up tables and work out parameters                              */
/*                                                                                             */
/***********************************************************************************************/

  include_once("lib/date_span.class.php");

  $sql = 'SELECT distinct d_class_id
          FROM   d_class_link
          WHERE  loco_id IN (SELECT loco_id 
                             FROM   d_class_link 
                             WHERE  d_class_id = ' .$id. ')';
                           
  $result = $db->execute($sql);

  $n_classes = $db->count_select();

  if ($n_classes != 0)
  {
    $nx = 0;
    while ($row = mysqli_fetch_array($result))
    {
      if ($nx == 0)
        $class_list = $row['d_class_id'];
      else
        $class_list .= "," . $row['d_class_id'];

      $nx++;
    }
  }
  else
  {
    $class_list = $id;
  }

  $sql = "select min(d.b_date) AS mindate
          from   diesels d
          join   d_class_link dcl
          on     dcl.loco_id = d.loco_id
          join   d_class dc
          on     dc.d_class_id = dcl.d_class_id
          where  dc.d_class_id = " . $id;

  $result = $db->execute($sql);

  if ($result)
    $row = mysqli_fetch_array($result);

  if ($db->count_select() != 1)
  {
    die("No rows returned");
  }

  $year = substr($row['mindate'], 0, 4);
  $mnth = substr($row['mindate'], 5, 2);

  $selfref = $_SERVER['PHP_SELF'] . "?page=locoqry.php&action=class&type=D&page=snapshot&id=" . $id;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 1: Get all locomotives from this class                                                */
/*                                                                                             */
/***********************************************************************************************/

  if (isset($_POST['mon_select']) or (!empty($_POST['mon_select'])))
  {
    @$mvals = $_POST['mon_select'];
    @$yvals = $_POST['year_select'];

    $sql = 'SELECT             last_day("' . $yvals[0] . '-' . $mvals[0] . '-01") AS sdate,
                   date_format(last_day("' . $yvals[0] . '-' . $mvals[0] . '-01"),
                               "%d/%m/%Y")                                        AS fsdate';
//echo $sql;
    $result = $db->execute($sql);
    $drow = mysqli_fetch_assoc($result);

    $checkdate1 = sprintf("%04s-%02s", $yvals[0], $mvals[0]);
    $checkdate1a = sprintf("%04s-%02s-01", $yvals[0], $mvals[0]);


    $sql = 'select da2.allocation             AS code,
                   concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                              AS code_hl,
                   dp.depot_name              AS depot,
                   concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                              AS depot_hl,
                   count(*)                   AS ct
            from   diesels d
            join (
                    select dcl.loco_id,
                    max(concat(date_format(da.alloc_date, "%Y%m%d"), lpad(da.seq, 3, "0"))) AS sequence
                    from   d_class dc
                    join   d_class_link dcl
                    on     dcl.d_class_id = dc.d_class_id
                    and    dc.d_class_id = ' . $id . '
                    left join d_alloc da
                    on     da.loco_id = dcl.loco_id
                    and    da.alloc_date <= "'. $drow['sdate'] . '"
                    group by dcl.loco_id
            ) as F
            on F.loco_id = d.loco_id
            left join d_alloc da2
            on     da2.loco_id = d.loco_id
            and    concat(date_format(da2.alloc_date, "%Y%m%d"), lpad(da2.seq, 3, "0")) = F.sequence
            left join d_nums dn
            on     dn.loco_id = d.loco_id
            and    "'. $drow['sdate'] . '" 
                                 between ifnull(dn.start_date, "1800-00-00")
                                     and ifnull(dn.end_date,   "2999-01-02")
            LEFT JOIN ref_depot_codes dcc
            ON     dcc.depot_code = da2.allocation
            AND    da2.alloc_date between dcc.date_from and ifnull(dcc.date_to, "2999-01-01")
            LEFT JOIN ref_depot dp
            ON     dp.depot_id = dcc.depot_id
            left join d_nums dn2
            on     dn2.loco_id = d.loco_id
            and    dn2.start_date = d.b_date
            where  da2.allocation not like "98%"
            GROUP BY 1,2,3,4
            ORDER BY ct DESC';
            
//          echo $sql;

    $result = $db->execute($sql);

    while ($dprow[] = mysqli_fetch_assoc($result))
      ;
/*
//    echo "1: Records found: " . count($dprow) . "<br />";

$ext_id = $id;

    $sql = 'select d.loco_id,
                   d.b_date,
                   d.w_date,
                   d.s_date,
                   d.disposed_by,
                   da2.allocation,
                   concat("sites.php?page=depots&action=query&id=", dp.depot_id) AS allocation_hl,
                   da2.alloc_date,
                   dp.depot_name,
                   concat("sites.php?page=depots&action=query&id=", dp.depot_id) AS depot_name_hl,
                   dn.number         AS curr_number,
                   concat("locoqry.php?action=locodata&id=",d.loco_id,"&type=D&loco=",dn.number)
                                     AS curr_number_hl,
                   dn.number_type    AS curr_number_type,
                   dn.start_date     AS curr_start_date,
                   dn.end_date       AS curr_end_date,
                   dn2.number        AS orig_number,
                   concat("locoqry.php?action=locodata&id=",d.loco_id,"&type=D&loco=",dn.number)
                                     AS orig_number_hl,
                   dn2.number_type   AS orig_number_type,
                   NULL              AS age,
                   NULL              AS status,
                   G.dci, G.pum, G.pu,
                   G.horse_power,
                   CASE WHEN G.dci = 28 THEN  concat(G.pum, " / ", G.pu, " rated at ")
                        WHEN G.dci = 29 THEN  concat(G.pum, " / ", G.pu, " rated at ")
                        WHEN G.dci = 19 THEN  concat(G.pum, " / ", G.pu, " rated at ")
                        WHEN G.dci = 27 THEN  concat(G.pum, " / ", G.pu, " rated at ")
                   else 0
                   end               AS info
            from   diesels d
            join (
                    select dcl.loco_id,
                           max(concat(da.alloc_date, seq)) AS alloc_dt
                    from   d_class dc
                    join   d_class_link dcl
                    on     dcl.d_class_id = dc.d_class_id
                    and    dc.d_class_id = ' . $id . '
                    left join d_alloc da
                    on     da.loco_id = dcl.loco_id
                    and    da.alloc_date <= "'. $drow['sdate'] . '"
                    group by dcl.loco_id
            ) as F
            on F.loco_id = d.loco_id
            left join (
                     SELECT dcl2.loco_id,
                            dcv2.d_class_id                AS dci,
                            coalesce(m.short_name, m.name) AS pum,
                            pu.model                       AS pu,
                            dcl2.start_date,
                            pu.horse_power
                     FROM   d_class_var dcv2
                     JOIN   d_class_link dcl2
                     ON     dcl2.d_class_id = dcv2.d_class_id
                     AND    dcl2.d_class_var_id = dcv2.d_class_var_id
                     AND    dcl2.d_class_id IN (' . $class_list. ')
                     AND    dcl2.start_date = 
                           (SELECT MAX(dcl3.start_date)
                            FROM   d_class_link dcl3
                            WHERE  dcl3.loco_id = dcl2.loco_id
                            AND    dcl3.start_date <= "'. $drow['sdate'] . '")
                     LEFT JOIN ref_power_units pu
                     ON     pu.pu_id = dcv2.pu_id
                     LEFT JOIN ref_manufacturer m
                     ON     m.manufacturer_id = pu.manufacturer_id
            ) AS G
            ON G.loco_id = d.loco_id

            LEFT JOIN d_alloc da2
            ON     da2.loco_id = d.loco_id
            AND    concat(da2.alloc_date, seq) = F.alloc_dt

            LEFT JOIN d_nums dn
            ON     dn.loco_id = d.loco_id
            AND    dn.start_date = (SELECT max(dna.start_date)
                                    FROM   d_nums dna
                                    WHERE  dna.loco_id = dn.loco_id
                                    AND    dna.start_date <= "'. $drow['sdate'] .'")

            LEFT JOIN ref_depot_codes dcc
            ON     dcc.depot_code = da2.allocation
            AND    da2.alloc_date between dcc.date_from and ifnull(dcc.date_to, "2999-01-01")

            LEFT JOIN ref_depot dp
            ON     dp.depot_id = dcc.depot_id

            LEFT JOIN d_nums dn2
            ON     dn2.loco_id = d.loco_id
            AND    dn2.start_date = d.b_date';
//echo $sql;

/*
   $sql2 = 'SELECT d2i1.loco_id,
                   i1.details,
                   i1.sdate_of_incident,
                   i1.edate_of_incident,
                   "T"
            FROM   d_to_i d2i1
            JOIN   incidents i1
            ON     i1.inc_id = d2i1.inc_id
            AND    i1.sdate_of_incident = (SELECT max(ia.sdate_of_incident)
                                           FROM   incidents ia
                                           JOIN   d_to_i d2ia
                                           ON     d2ia.inc_id = ia.inc_id
                                           WHERE  d2ia.loco_id = d2i1.loco_id
                                           AND    ia.edate_of_incident IS NULL)
            JOIN (
                    SELECT dcl.loco_id,
                           max(da.seq)        AS sequence,
                           max(da.alloc_date) AS alloc_dt
                    FROM   d_class dc
                    JOIN   d_class_link dcl
                    ON     dcl.d_class_id = dc.d_class_id
                    AND    dc.d_class_id = ' . $id . '
                    LEFT JOIN d_alloc da
                    ON     da.loco_id = dcl.loco_id
                    AND    da.alloc_date <= "'. $drow['sdate'] . '"
                    GROUP BY dcl.loco_id
            ) as F
            on F.loco_id = d2i1.loco_id

            UNION ALL

            SELECT d2i2.loco_id,
                   i2.details,
                   i2.sdate_of_incident,
                   i2.edate_of_incident,
                   "P"
            FROM   d_to_i d2i2
            JOIN   incidents i2
            ON     i2.inc_id = d2i2.inc_id
            AND    i2.sdate_of_incident = (SELECT max(ia.sdate_of_incident)
                                           FROM   incidents ia
                                           JOIN   d_to_i d2ia
                                           ON     d2ia.inc_id = ia.inc_id
                                           WHERE  d2ia.loco_id = d2i2.loco_id
                                           AND    ia.edate_of_incident IS NOT NULL)
            JOIN (
                    SELECT dcl.loco_id,
                           max(da.seq)        AS sequence,
                           max(da.alloc_date) AS alloc_dt
                    FROM   d_class dc
                    JOIN   d_class_link dcl
                    ON     dcl.d_class_id = dc.d_class_id
                    AND    dc.d_class_id = ' . $id . '
                    LEFT JOIN d_alloc da
                    ON     da.loco_id = dcl.loco_id
                    AND    da.alloc_date <= "'. $drow['sdate'] . '"
                    GROUP BY dcl.loco_id
            ) as F
            on F.loco_id = d2i2.loco_id';

// echo $sql;
*/

    $sql = 'select d.loco_id,
                   dc.identifier,
                   da.allocation,
                   d.b_date,
                   date_format(d.b_date, "%D")     AS cmp_nth,
                   d.w_date,
                   date_format(d.w_date, "%D")     AS wdn_nth,
                   d.s_date,
                   date_format(d.s_date,  "%D")    AS dsp_nth,
                   dc.identifier,
                   dn1.number               AS curr_number,
                   dn2.number               AS orig_number,
                   dp.depot_name,
                   dpw.depot_name           AS last_depot_name,
                   d.preserved,
                   concat(CASE
                              WHEN dco.B = "n" THEN ""
                              ELSE ifnull(dco.B, "")
                          END,
                          CASE 
                              WHEN dco.H = "n" THEN ""
                              ELSE ifnull(dco.H, "")
                          END,
                          ifnull(dco.O, "")) AS config,
                   dco.B,
                   dco.H,
                   dco.O,
                   dco.extras                        AS extra_dtls,
                   coalesce(l.short, l.base_colour)  AS livery,
                   l.code                            AS livery_code

            from   diesels d

            left join   d_class_link dcl
            on     dcl.loco_id = d.loco_id
            and    dcl.start_date = (SELECT max(dcl1.start_date)
                                     FROM   d_class_link dcl1
                                     WHERE  dcl1.loco_id = d.loco_id
                                     AND    dcl1.start_date <= "'. $drow['sdate'] . '")

            left join   d_class dc
            on     dc.d_class_id = dcl.d_class_id

            left join   d_alloc da
            on     da.loco_id = d.loco_id
            and    concat(da.alloc_date, da.seq) = (SELECT MAX(concat(da1.alloc_date, da1.seq))
                                                    FROM   d_alloc da1
                                                    WHERE  da1.loco_id = d.loco_id
                                                    AND    da1.alloc_date <= "'.$drow['sdate'].'")

            left join d_nums dn1
            on     dn1.loco_id = d.loco_id
            and    dn1.start_date = (SELECT max(dn1a.start_date)
                                     FROM   d_nums dn1a
                                     WHERE  dn1a.loco_id = d.loco_id
                                     AND    dn1a.carried_number = "Y"
                                     AND    dn1a.start_date <= "'.$drow['sdate'].'")

            LEFT JOIN ref_depot_codes dcc
            ON     dcc.depot_code = da.allocation
            AND    dcc.date_from = (SELECT max(dcc1.date_from)
                                    FROM   ref_depot_codes dcc1
                                    WHERE  dcc1.depot_code = da.allocation
                                    AND    dcc1.date_from <= "'.$drow['sdate'].'")

            LEFT JOIN ref_depot dp
            ON     dp.depot_id = dcc.depot_id

            LEFT JOIN ref_depot_codes dccw
            ON     dccw.depot_code = d.last_depot
            AND    dccw.date_from = (SELECT max(dccw1.date_from)
                                     FROM   ref_depot_codes dccw1
                                     WHERE  dccw1.depot_code = d.last_depot
                                     AND    dccw1.date_from <= "'.$drow['sdate'].'")

            LEFT JOIN ref_depot dpw
            ON     dpw.depot_id = dccw.depot_id

            LEFT JOIN d_nums dn2
            ON     dn2.loco_id = d.loco_id
            AND    dn2.start_date = d.b_date

            LEFT JOIN d_config dco
            ON     dco.loco_id = d.loco_id
            AND    dco.config_date = (select max(dco1.config_date)
                                      from   d_config dco1
                                      where  dco1.loco_id = dco.loco_id
                                      and    dco1.config_date <= "'. $drow['sdate'] . '")
                                      
            LEFT JOIN d_to_livery d2l
            ON     d2l.loco_id = d.loco_id
            AND    d2l.start_date = (select max(d2l1.start_date)
                                     from   d_to_livery d2l1
                                     where  d2l1.loco_id = d2l.loco_id
                                     and    d2l1.start_date <= "'. $drow['sdate'] . '")
            LEFT JOIN ref_livery l
            ON     l.livery_id = d2l.livery_id

            where  d.loco_id IN (select distinct(dcl1.loco_id)
                                 from   d_class_link dcl1
                                 where  dcl1.d_class_id in (' . $class_list . '))
            order by d.loco_id';

/*
select d.loco_id,
                   dc.identifier,
                   da.allocation,
                   d.b_date,
                   d.w_date
            from   diesels d
            join   d_class_link dcl
            on     dcl.loco_id = d.loco_id
            and    dcl.start_date = (SELECT max(dcl1.start_date)
                                     FROM   d_class_link dcl1
                                     WHERE  dcl1.loco_id = d.loco_id
                                     AND    dcl1.start_date <= "'. $drow['sdate'] . '")
            join   d_class dc
            on     dc.d_class_id = dcl.d_class_id
            join   d_alloc da
            on     da.loco_id = d.loco_id
            and    concat(da.alloc_date, da.seq) =  (SELECT MAX(concat(da1.alloc_date, da1.seq))
                                                     FROM   d_alloc da1
                                                     WHERE  da1.loco_id = d.loco_id
                                                     AND    da1.alloc_date < "'. $drow['sdate'] . '")
            where  dc.d_class_id IN (' . $class_list . ')';
*/
    $dt = new date_span();

    printf("<table width=99%% valign=TOP frame=box class=\"sortable\" id=\"snapshot\">\n");
    printf("<caption>Snapshot for m/e %s</caption>\n", $drow['fsdate']);
    printf("<tr>\n");
    printf("<th width=5%%><strong>Number as built</strong></th>\n");
    printf("<th width=5%%><strong>Carried Number</strong></th>\n");
    if ($n_classes > 1)
      printf("<th width=8%%><strong>Class</strong></th>\n");

    printf("<th width=10%%><strong>Status</strong></th>\n");
    printf("<th width=5%%><strong>Depot Code</strong></th>\n");
    printf("<th width=10%%><strong>Depot</strong></th>\n");
    printf("<th width=10%%><strong>Age</strong></th>\n");
    printf("<th width=3%%><strong>Config Code</strong></th>\n");
    printf("<th width=8%%><strong>Brakes</strong></th>\n");
    printf("<th width=8%%><strong>Heating</strong></th>\n");
    printf("<th width=8%%><strong>Other</strong></th>\n");
    printf("<th width=2%%><strong>Livery Code</strong></th>\n");
    printf("<th width=8%%><strong>Livery</strong></th>\n");
    printf("<th width=8%%><strong>Extras</strong></th>\n");
    printf("<th><strong>Extra Info</strong></th>\n");
    printf("</tr>\n");

    $count = 0;

    $result = $db->execute($sql);

    $tot = $nins = $wdn = $wdn_tm = $ins = $ins_tm = $scr = $scr_tm = $scr_wt = $prs = $prs_wt = $store = 0;
    $alloc = array();

    while ($row = mysqli_fetch_assoc($result))
    {
      /* Last record for loco so display details with extra information filled in */
      $c1  = strncmp($checkdate1, $row['b_date'], 7);
      $c2  = strncmp($checkdate1, $row['w_date'], 7);
      $c2a = empty($row['w_date']);
      $c3  = strncmp($checkdate1, $row['s_date'], 7);
      $c3a = empty($row['s_date']);
      $c4  = strncmp($row['preserved'], "Y", 1);

      $row['curr_number'] = fn_d_pfx($row['curr_number']);
      $row['orig_number'] = fn_d_pfx($row['orig_number']);

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
          
          $row['age']     = $dt->calculate_span($row['b_date'], $checkdate1a);
          $row['age_fmt'] = $dt->calculate_span($row['b_date'], $checkdate1a, "Y");
        }
      }
      else
      if ($c2 >= 0 && $c2a != 1)
      {
        $row['status'] = "<font color=\"red\"><strong>Withdrawn</strong></font>";

        if ($c2 == 0)
        {
          $wdn_tm++; $wdn++;

          $row['info1'] = "<font color=\"red\"><strong>";

          if (!empty($row['last_depot_name']))
          {
            $row['info1'] .= "Withdrawn off " . $row['last_depot_name'] . ". ";

            if (strcmp($row['wdn_nth'], "0th"))
              $row['info1'] .= " on the " . $row['wdn_nth'];
          }
          else
          if (!empty($row['wdn_nth']) && strcmp($row['wdn_nth'], "0th"))
          {
            $row['info1'] .= "Withdrawn on the " . $row['wdn_nth'] . ". ";
          }
          else
          {
            $row['info1'] = "Withdrawn this month. ";
          }

          $row['info1'] .= "</strong></font>";
        }
        else
        {
          $wdn++;
        }

        $row['allocation'] = $row['depot_name'] = "";
        if ($c3 < 0)
        {
          if ($c4 == 0) // preserved
          {
            $prs_wt++;
            $row['info2'] .= "Awaiting Preservation. ";
          }
          else
          {
            $scr_wt++;
            $row['info2'] .= "Awaiting Scrapping. ";
          }
        }
        else
        if ($c3 >= 0 || $c3a == 1)
        {
          if ($c4 == 0) // preserved
          {
            $prs++;
            $row['info2'] = "Preserved. ";
          }
          else
          {
            $scr++;
            if ($c3 == 0)
              $row['info2'] .= "Scrapped this month. ";
            else
              $row['info2'] .= "Scrapped. ";
          }
        }
      }
      else
        $row['status'] = "Unknown";
        
      $row['brakes'] = fn_determine_brakes($row['B']);
      $row['heating'] = fn_determine_heating($row['H']);
      $row['other'] = fn_determine_other($row['O']);
      $row['extras'] = fn_determine_extras($row['extra_dtls']);

      printf("<tr>\n");
      printf("<td width=5%%><a href=locoqry.php?action=locodata&id=%s&type=D>%s</a></td>",
             $row['loco_id'], $row['orig_number']);
      printf("<td width=5%%><a href=locoqry.php?action=locodata&id=%s&type=D&loco=%s>%s</a></td>",
             $row['loco_id'], $row['curr_number'], $row['curr_number']);

      if ($n_classes > 1)
        printf("<td width=8%%>Class %s</td>\n", $row['identifier']);

      printf("<td width=10%%>%s</td>\n", $row['status']);
      printf("<td width=5%%><a href=sites.php?page=depots&action=query&id=%s>%s</a></td>",
             $row['depot_id'], $row['allocation']);
      printf("<td width=10%%><a href=sites.php?page=depots&action=query&id=%s>%s</a></td>",
             $row['depot_id'], $row['depot_name']);
      printf("<td width=10%% sorttable_customkey=%s>%s</td>\n", $row['age_fmt'], $row['age']);
      printf("<td width=3%% align='center'>%s</td>\n", $row['config']);
      printf("<td width=8%%>%s</td>\n", $row['brakes']); // brakes
      printf("<td width=8%%>%s</td>\n", $row['heating']); // heating
      printf("<td width=8%%>%s</td>\n", $row['other']); // other
      printf("<td width=2%%>%s</td>", $row['livery_code']);
      printf("<td width=8%%>%s</td>", $row['livery']);
      printf("<td width=8%%>%s</td>", $row['extras']);
      printf("<td>%s</td>", $row['info2']);
      printf("</tr>\n");
    }

    printf("</table>\n");

    printf("<br /><br />");

    $tb_summ = new MyTables("summary_data");

    $tb_summ->add_caption("Summary for m/e " . $drow['fsdate']);
    $tb_summ->add_column("stats",    " ", 50);
    $tb_summ->add_column("depots",   "  ", 50);

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
    $tb_depots->add_caption("Shed Distribution");
    $tb_depots->suppress_nulls();
    $tb_depots->sortable();
    $tb_depots->add_column("code",  "Depot Code",   10);
    $tb_depots->add_column("depot", "Depot Name",   65);
    $tb_depots->add_column("ct",    "Count",        25);

//    echo "2: Records found: " . count($dprow) . "<br />";

    for ($nx = 0; $nx < count($dprow); $nx++)
    {
      if (!empty($dprow[$nx]['code']))
      {
        if (strcmp($dprow[$nx]['code'], "98S"))
          $tb_depots->add_data($dprow[$nx]);
      }
    }

    $x = $rw['depots'] = $tb_depots->draw_table(FALSE);
//print "(" . $x . ")";

    $tb_summ->add_data($rw);
    $tb_summ->draw_table();
    printf("</div>");
    

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
