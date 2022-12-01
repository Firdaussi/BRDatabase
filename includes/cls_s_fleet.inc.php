<?php
  include_once("lib/MyTables.class.php");
  include_once("lib/brlib.php");

  $debug = 0;

  if (!empty($var))
    $extra_sql = "and scl.s_class_var_id = " . $var;

  if ($debug)
    debug_memory('Start');

  include_once("lib/cache.class.php");
  /**
   * call the class after the include
   */
  $file_cache=new cache();
  $file_cache->start_cache();
  // echo $file_cache->get_cachefile();

  $sql = 'select scl1.s_class_id,
                 sc1.identifier,
                 sc1.locos_named,
                 sc1.mileage_flag,
                 min(scl1.start_date) AS mindate1

          from   s_class_link scl1
          join   s_class sc1
          on     sc1.s_class_id = scl1.s_class_id

          join   s_class_link scl2
          on     scl2.loco_id = scl1.loco_id
          and    scl2.s_class_id = ' . $id . '
          join   s_class sc2
          on     sc2.s_class_id = scl2.s_class_id
          
          group by scl1.s_class_id,
                   sc1.identifier,
                   sc1.locos_named,
                   sc1.mileage_flag
          order by mindate1';

  $result = $db->execute($sql);

  $rbld = 0;
  $mileage_flag = 'N';
  
  if (($classcount = $db->count_select()) > 1)
  {
    $rbld = 1;
    // Got rebuilds to contend with
    // Load all class details for the rebuilds
    $nscl = 0;
    $named = 0;
    $x = array();
    while ($x[] = mysqli_fetch_assoc($result))
    {
      $named = $named + $x[$nscl]['locos_named'];

      if ($id == $x[$nscl]['s_class_id'])
      {
        $nr = $nscl;
      }

      $nscl++;
    }

    $nscl--;
    
    $mileage_flag = $x[0]['mileage_flag'];


    //printf("nscl=%d, nr=%d<br />", $nscl, $nr);
    // Is the class under query the first class built or is it a rebuild?
    //print_r($x[0]); echo "<br />";
    //print_r($x[1]); echo "<br />";
    $origclass = $x[$nr]['identifier'];
    $rbldclass = $x[$nr-1]['identifier'];
    //echo "Original Class: " . $origclass . "<br />";
    //echo "Rebuilds Class: " . $rbldclass . "<br />";
  }
  else
  {
    if ($db->count_select())
      $x = mysqli_fetch_assoc($result);
    $named = $x['locos_named'];
    $mileage_flag = $x['mileage_flag'];
  }

  //echo $nr . "<br />" ; print_r($x); echo "<br />";

  if ($debug)
    debug_memory('Processed s_class_link');

  $sql3 = 'select sn.company,
                  sn.subtype,
                  min(CASE WHEN sn.carried_number = "N" THEN
                        DATE_ADD(
                          CASE WHEN dayofmonth(sn.start_date) = 0 THEN
                            concat(year(sn.start_date), "-01-01")
                          ELSE
                            sn.start_date
                          END, INTERVAL 6 MONTH)
                      ELSE
                        sn.start_date
                      END) AS mindate
           from   s_nums sn
           join   s_class_link scl
           on     scl.loco_id = sn.loco_id
           and    scl.s_class_id = ' . $id . '
           where  sn.start_date <> "0000-00-00"
           group by 1,2
           order by mindate, subtype';

 // echo $sql3;

  $result = $db->execute($sql3);

  $arct = 0; $ar_f = array(); $ar = array();

  if ($db->count_select())
    while ($row = mysqli_fetch_assoc($result))
    {
      $ar[$arct] = $row['company'].$row['subtype'];
      if (isset($row['subtype']))
        $ar_f[$arct++] = $row['company']. " (" .$row['subtype']. ")";
      else
        $ar_f[$arct++] = $row['company'];
    }

  if ($debug)
    debug_memory('Processed s_nums');

  printf("<table width=99%% valign=TOP frame=box class=\"sortable\" id=\"sfleet\">\n");
  printf("<tr>\n");

  for ($ncomp = 0; $ncomp < $arct; $ncomp++)
    printf("<th width=%s%%><strong>%s</strong></th>\n", 24/$arct, $ar_f[$ncomp]);

  $sql = 'SELECT s.loco_id lid,
                 s.b_date,
                 concat(date_format(s.b_date, "%Y%m%d"), 
                                     lpad(s.loco_id, 10, "0"))         AS b_date_fmt,
                 s.w_date,
                 concat(date_format(s.w_date, "%Y%m%d"), 
                                     lpad(s.loco_id, 10, "0"))         AS w_date_fmt,
                 s.scrapyard_code                                           AS scrapyard_code,
                 concat("sites.php?page=scrapyards&action=query&id=", s.scrapyard_code) 
                                                                            AS scrapyard_code_ext,
                 s.s_date,
                 concat(date_format(s.s_date, "%Y%m%d"), 
                                     lpad(s.loco_id, 10, "0"))         AS s_date_fmt,
                 s.preserved,
                 concat("locoqry.php?action=locodata&id=",s.loco_id,
                        "&type=S&loco=", sn.number)                         AS number_hl,
                 concat(ifnull(sn.prefix, ""), 
                               sn.number, 
                        ifnull(sn.suffix, ""))                              AS number,
                 sn.number_type,
                 sn.carried_number,
                 case when sn.number_type = "PRG"  THEN 1
                      when sn.number_type = "BIG4" THEN 2
                      when sn.number_type = "WD"   THEN 3
                      when sn.number_type = "BR"   THEN 4
                      when sn.number_type = "DP"   THEN 5
                 end AS idx,
                 concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                                                            AS depot_code_new_ext,
                 concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                                                            AS depot_name_new_ext,
                 dp1.depot_name AS depot_name_new,
                 dc1.depot_code AS depot_code_new,
                 concat("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                                                            AS depot_code_wdn_ext,
                 concat("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                                                            AS depot_name_wdn_ext,
                 dp2.depot_name AS depot_name_wdn,
                 dc2.depot_code AS depot_code_wdn,
                 snm.name,
                 concat("names.php?id=", snm.s_name_id, "&amp;type=S")      AS name_hl,
                 concat(sm.merchant_name, " (", sy.location, ")")           AS scrapyard_name,
                 bd.bl_name,
                 sn.company,
                 sn.subtype,
                 sn.carried_number,
                 s.last_depot,
                 s.mileage,
                 scl.s_class_id,
                 round(datediff(case date_format(s.w_date, "%d")
                            when 0 then date_format(concat(date_format(s.w_date, "%Y-%m-"),
                                                    "15"), "%Y-%m-%d")
                            else s.w_date 
                            END,
                            case date_format(s.b_date, "%d")
                            when 0 then date_format(concat(date_format(s.b_date, "%Y-%m-"),
                                                    "15"), "%Y-%m-%d")
                            else s.b_date 
                 END) /365, 2) AS service_prd,
                 round(datediff(case date_format(s.s_date, "%d")
                            when 0 then date_format(concat(date_format(s.s_date, "%Y-%m-"),
                                                    "15"), "%Y-%m-%d")
                            else s.s_date
                            END,
                            case date_format(s.w_date, "%d")
                            when 0 then date_format(concat(date_format(s.w_date, "%Y-%m-"),
                                                    "15"), "%Y-%m-%d")
                            else s.w_date 
                 END) /365, 2) AS cond_prd,
                 round(datediff(case date_format(coalesce(s.s_date, curdate()), "%d")
                            when 0 then date_format(concat(date_format(coalesce(s.s_date,
                                                           curdate()), "%Y-%m-"),
                                                    "15"), "%Y-%m-%d")
                            else coalesce(s.s_date, curdate())
                            END,
                            case date_format(s.b_date, "%d")
                            when 0 then date_format(concat(date_format(s.b_date, "%Y-%m-"),
                                                    "15"), "%Y-%m-%d")
                            else s.b_date 
                 END) /365, 2) AS tot_age,
                 F.prev_identifier,
                 concat("locoqry.php?action=class&id=", F.prev_s_class, "&type=S&page=fleet")
                                                                            AS prev_identifier_ext,
                 F.main_start_date,
                 F.next_s_class,
                 F.next_identifier,
                 concat("locoqry.php?action=class&id=", F.next_s_class, "&type=S&page=fleet")
                                                                            AS next_identifier_ext,
                 F.next_start_date
          FROM   steam s
          LEFT JOIN s_nums sn
          ON     sn.loco_id = s.loco_id
          LEFT JOIN ref_scrapyard sy
          ON     sy.scrapyard_code = s.scrapyard_code
          LEFT JOIN ref_scrap_merchant sm
          ON     sm.merchant_code = substr(s.scrapyard_code, 1, 3) 
          LEFT JOIN ref_builders bd
          ON     bd.bl_code = s.bl_code

          LEFT JOIN s_alloc sa
          ON     sa.loco_id = s.loco_id
          AND    sa.alloc_flag = "N"

          LEFT JOIN ref_depot_codes dc1
          ON     dc1.depot_code = s.first_depot
          AND    dc1.date_from = (SELECT max(dc1a.date_from)
                                  FROM   ref_depot_codes dc1a
                                  WHERE  dc1a.depot_code = s.first_depot
                                  AND    dc1a.date_from <= s.b_date)
          LEFT JOIN ref_depot dp1
          ON     dp1.depot_id = dc1.depot_id

          LEFT JOIN ref_depot_codes dc2
          ON     dc2.depot_code = s.last_depot
          AND    dc2.date_from = (SELECT max(dc2a.date_from)
                                  FROM   ref_depot_codes dc2a
                                  WHERE  dc2a.depot_code = s.last_depot
                                  AND    dc2a.date_from <= s.w_date)
          LEFT JOIN ref_depot dp2
          ON     dp2.depot_id = dc2.depot_id

          LEFT JOIN s_name snm
          ON     snm.loco_id = s.loco_id

          JOIN   s_class_link scl
          ON     scl.loco_id = s.loco_id
          AND    scl.s_class_id = ' .$id. '
          ' . $extra_sql . '

          JOIN (    select scl2.loco_id,
                           scl1.s_class_id      AS prev_s_class,
                           sc1.identifier       AS prev_identifier,
                           scl1.start_date      AS prev_start_date,
                           scl2.s_class_id      AS main_s_class,
                           sc2.identifier       AS main_identifier,
                           scl2.start_date      AS main_start_date,
                           scl3.s_class_id      AS next_s_class,
                           sc3.identifier       AS next_identifier,
                           scl3.start_date      AS next_start_date
                    from   s_class_link scl2
                    left join s_class_link scl1
                    on     scl1.loco_id = scl2.loco_id
                    and    scl1.s_class_id <> scl2.s_class_id
                    and    scl1.start_date = (SELECT max(scl1a.start_date)
                                              FROM   s_class_link scl1a
                                              WHERE  scl1a.loco_id = scl2.loco_id
                                              AND    scl1a.start_date < scl2.start_date
                                              AND    scl1a.s_class_id <> scl2.s_class_id)
                    left join s_class sc1
                    on     scl1.s_class_id = sc1.s_class_id
                    left join s_class_link scl3
                    on     scl3.loco_id = scl2.loco_id
                    and    scl3.s_class_id <> scl2.s_class_id
                    and    scl3.start_date = (SELECT min(scl3a.start_date)
                                              FROM   s_class_link scl3a
                                              WHERE  scl3a.loco_id = scl2.loco_id
                                              AND    scl3a.start_date > scl2.start_date
                                              AND    scl3a.s_class_id <> scl2.s_class_id)
                    left join s_class sc3
                    on     scl3.s_class_id = sc3.s_class_id
                    join s_class sc2
                    on     scl2.s_class_id = sc2.s_class_id
                    where  scl2.s_class_id = ' .$id. '
          ) AS F
          ON     F.loco_id = s.loco_id

          ORDER BY s.loco_id, idx, sa.alloc_date';

  // echo $sql;

  $result = $db->execute($sql);

  if ($debug)
    debug_memory('Main Query');

  printf("<th width=8%%><strong>Date To Service</strong></th>\n");

  if ($classcount > 1 && $nr > 0)
  {
    printf("<th width=8%%><strong>Rebuilt From</strong></th>\n", $rbldclass);
  }
//  printf("<th width=5%%><strong>New Depot Code</strong></th>\n");
  printf("<th width=11%%><strong>Depot Delivered To</strong></th>\n");
  printf("<th width=8%%><strong>Date Withdrawn</strong></th>\n");
  if ($classcount > 1 && $nr < $nscl)
  {
    printf("<th width=8%%><strong>Rebuilt To</strong></th>\n", $rbldclass);
  }
//  printf("<th width=5%%><strong>Wdn Depot Code</strong></th>\n");
  printf("<th width=11%%><strong>Depot Withdrawn From</strong></th>\n");
  printf("<th width=5%%><strong>Svc Age (Yrs)</strong></th>\n");
  
  if ($mileage_flag == 'Y')
  {
      printf("<th width=3%%><strong>Mileage</strong></th>\n");
  }
  printf("<th width=3%%><strong>Fate</strong></th>\n");
  printf("<th width=11%%><strong>Where</strong></th>\n");
  printf("<th width=8%%><strong>When</strong></th>\n");
  printf("<th width=4%%><strong>Tot Age (Yrs)</strong></th>\n");

  if ($named > 0)
    printf("<th width=10%%><strong>Name</strong></th>\n");
  printf("</tr>\n");

  $nx = 0; $last_loco_id = "0"; $count = 0;
  if ($db->count_select())
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      if ($row['lid'] == $last_loco_id)
      {
        // same loco, changed details (allocations/names/numbers)
      }
      else
      {
        /* Change of loco = dump all data unless this is the first record */
        if (strcmp($last_loco_id, "0") != 0)
        {
          printf("<tr>\n");
            for ($ncomp = 0; $ncomp < $arct; $ncomp++)
            {
              if (empty($loconum[$ncomp]))
                $fmt = sprintf("9%07d", $row['lid']);
              else
                $fmt = sprintf("0%07s", $lnum[$ncomp]);

              fn_ptdelem(24/$arct, $loconum[$ncomp], $fmt);
              $loconum[$ncomp] = "";
            }

            fn_pelem_date(8, $date_comp, $date_comp_fmt);
            if ($classcount > 1 && $nr > 0)
            {
              if ($prev_flag)
                $elem = sprintf("%s<br />from %s", fn_fdate($prev_start_date),
                                                            $prev_identifier);
              else
                $elem = "";
              fn_ptdelem(10, $elem);
            }
            fn_ptdelem(11, $depot_name_new);
            fn_pelem_date(8, $date_wdn,  $date_wdn_fmt);
            if ($classcount > 1 && $nr < $nscl)
            {
              if ($next_flag)
                $elem = sprintf("%s<br />to %s", fn_fdate($next_start_date),
                                                          $next_identifier);
              else
                $elem = "";
              fn_ptdelem(10, $elem);
            }
            fn_ptdelem(11, $depot_name_wdn);
            fn_ptdelem(5,  $srv_prd);
            if ($mileage_flag == 'Y')
            {
              fn_ptdelem(3,  fn_ncomma($mileage));
            }
            fn_ptdelem(3,  $fate_code);
            fn_ptdelem(11, $fate_site_fmt);
            fn_pelem_date(8, $fate_date, $fate_date_fmt);
            fn_ptdelem(4,  $tot_age);
            if ($named > 0)
              fn_ptdelem(10, $name);
          printf("</tr>\n");
        }

        /* Copy all the basic repetitive information for the new loco */
        $depot_code_new = sprintf("<a href=\"%s\">%s</a>", $row['depot_code_new_ext'], 
                                                       $row['depot_code_new']);
        $depot_name_new = sprintf("<a href=\"%s\">%s</a>", $row['depot_name_new_ext'],
                                                       $row['depot_name_new']);
        $depot_code_wdn = sprintf("<a href=\"%s\">%s</a>", $row['depot_code_wdn_ext'], 
                                                       $row['depot_code_wdn']);
        $depot_name_wdn = sprintf("<a href=\"%s\">%s</a>", $row['depot_name_wdn_ext'],
                                                       $row['depot_name_wdn']);
        $date_comp = $row['b_date'];
        $date_comp_fmt = $row['b_date_fmt'];
        $date_wdn  = $row['w_date'];
        $date_wdn_fmt  = $row['w_date_fmt'];
        $mileage = $row['mileage'];
        if (($srv_prd = fn_datediff($row['w_date'], $row['b_date'])) == -1)
          $srv_prd = "";
        $cnd_prd = $row['cond_prd'];
        if (!empty($row['s_date']))
          $tot_age = $row['tot_age'];
        else
          $tot_age = "";
        $name = $row['name'];

        $prev_identifier = sprintf("<a href=\"%s\">%s</a>", $row['prev_identifier_ext'],
                                                        $row['prev_identifier']);
        $prev_flag = strlen($row['prev_identifier']);
        $next_identifier = sprintf("<a href=\"%s\">%s</a>", $row['next_identifier_ext'],
                                                        $row['next_identifier']);
        $next_flag = strlen($row['next_identifier']);
        $prev_start_date = $row['main_start_date']; // yes, this is correct
        $next_start_date = $row['next_start_date'];

        if ($row['preserved'] == "Y")
        {
          $fate_code = "Prs";
          $fate_site = "Preserved";
          $fate_date = "";
          $fate_date_fmt = "";
          $fate_site_fmt = $fate_site;
        }
        else
        if (!empty($row['scrapyard_code']))
        {
          $fate_code = "Cut";
          $fate_site = $row['sc_name'];
          $fate_date = $row['s_date'];
          $fate_date_fmt = $row['s_date_fmt'];
          $fate_site_fmt = sprintf("<a href=\"%s\">%s</a>", $row['scrapyard_code_ext'],
                                                        $row['scrapyard_name']);
        }
        else
        {
          $fate_code = "";
          $fate_site = "";
          $fate_site_fmt = "";
          $fate_date = "";
          $fate_date_fmt = "";
        }
      }

      /* Look for the company/subtype combination in the saved array of possible number types
         so that we can put this number in the correct column */
      $key = array_search($row['company'].$row['subtype'], $ar);

      if ($key === FALSE)
      {
        $loconum = "";
      }
      else
      {
        $nval = "n".$key; // echo $nval . "<br />";
        if ($row['carried_number'] == "Y")
        {
          $loconum[$key] = sprintf("<a href=\"%s\"><strong>%s</strong></a>\n", 
                                  $row['number_hl'], 
                                  $row['number']);
        }
        else
        {
          $loconum[$key] = sprintf("<a href=\"%s\"><i>%s</i></a>\n", 
                                  $row['number_hl'], 
                                  $row['number']);
        }

        $lnum[$key]    = $row['number'];
      }

      $last_loco_id = $row['lid'];
      $last_number  = $row['number'];
    }
  }

  /* Last row */
  if (strcmp($last_loco_id, "0") != 0)
  {
    printf("<tr>\n");
      for ($ncomp = 0; $ncomp < $arct; $ncomp++)
      {
        if (empty($loconum[$ncomp]))
          $fmt = sprintf("9%07d", $row['lid']);
        else
          $fmt = sprintf("0%07s", $lnum[$ncomp]);

        fn_ptdelem(24/$arct, $loconum[$ncomp], $fmt);
        $loconum[$ncomp] = "";
      }

      fn_pelem_date(8, $date_comp, $date_comp_fmt);
      if ($classcount > 1 && $nr > 0)
      {
        if ($prev_flag && !empty($prev_start_date) && !empty($prev_identifier))
          $elem = sprintf("%s<br />from %s", fn_fdate($prev_start_date),
                                                      $prev_identifier);
        else
          $elem = "";
        fn_ptdelem(10, $elem);
      }
      fn_ptdelem(11, $depot_name_new);
      fn_pelem_date(8, $date_wdn,  $date_wdn_fmt);
      if ($classcount > 1 && $nr < $nscl)
      {
        if ($next_flag && !empty($next_start_date) && !empty($next_identifier))
          $elem = sprintf("%s<br />to %s", fn_fdate($next_start_date),
                                                    $next_identifier);
        else
          $elem = "";
        fn_ptdelem(10, $elem);
      }
      fn_ptdelem(11, $depot_name_wdn);
      fn_ptdelem(5,  $srv_prd);
      if ($mileage_flag == 'Y')
      {
        fn_ptdelem(3,  fn_ncomma($mileage));
      }

      fn_ptdelem(3,  $fate_code);
      fn_ptdelem(11, $fate_site_fmt);
      fn_pelem_date(8, $fate_date, $fate_date_fmt);
      fn_ptdelem(4,  $tot_age);
      if ($named > 0)
        fn_ptdelem(10, $name);
    printf("</tr>\n");

  if ($debug)
    debug_memory('Main Query endloop');

  }

  printf("</table>\n");

  if ($debug)
    debug_memory('End');

  $row = "";
  $file_cache->end_cache();
?>
