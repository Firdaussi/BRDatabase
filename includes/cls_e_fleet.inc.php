<?php
  include_once("lib/MyTables.class.php");
  include_once("lib/brlib.php");

  $debug = 0;

  if (!empty($var))
    $extra_sql = "and ecl.e_class_var_id = " . $var;

  if ($debug)
    debug_memory('Start');

  include_once("lib/cache.class.php");
  /**
   * call the class after the include
   */
  $file_cache=new cache();
  $file_cache->start_cache();

  $sql = 'select ecl1.e_class_id,
                 ec1.identifier,
                 min(ecl1.start_date) AS mindate1

          from   e_class_link ecl1
          join   e_class ec1
          on     ec1.e_class_id = ecl1.e_class_id

          join   e_class_link ecl2
          on     ecl2.loco_id = ecl1.loco_id
          and    ecl2.e_class_id = ' . $id . '
          join   e_class ec2
          on     ec2.e_class_id = ecl2.e_class_id
          group by ecl1.e_class_id, ec1.identifier
          order by mindate1';

//echo $sql;

  $result = $db->execute($sql);

  $rbld = 0;
  if (($classcount = $db->count_select()) > 1)
  {
    $rbld = 1;
    // Got rebuilds to contend with
    // Load all class details for the rebuilds
    $necl = 0;
    $x = array();

    while ($row = mysqli_fetch_assoc($result))
    {
      $x[$necl] = $row;

      if ($id == $x[$necl]['e_class_id'])
      {
        $nr = $necl;
      }

      $necl++;
    }

    $necl--;


//    printf("necl=%d, nr=%d<br />", $necl, $nr);
    // Is the class under query the first class built or is it a rebuild?
//    print_r($x);
    $origclass = $x[$nr]['identifier'];
    $rbleclass = $x[$nr-1]['identifier'];
  }

  if ($debug)
    debug_memory('Processed e_class_link');

  $sql3 = 'select en.company,
                  en.subtype,
                  min(en.start_date) mindate
           from   e_nums en
           join   e_class_link ecl
           on     ecl.loco_id = en.loco_id
           and    ecl.e_class_id = ' . $id . '
           where  en.start_date <> "0000-00-00"
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
    debug_memory('Processed e_nums');

  printf("<table width=99%% valign=TOP frame=box class=\"sortable\" id=\"dfleet\">\n");
  printf("<tr>\n");

  for ($ncomp = 0; $ncomp < $arct; $ncomp++)
    printf("<th width=%s%%><strong>%s</strong></th>\n", 24/$arct, $ar_f[$ncomp]);

  $sql = 'SELECT e.loco_id lid,
                 e.b_date,
                 concat(date_format(e.b_date, "%Y%m%d"), e.loco_id) AS b_date_fmt,
                 e.w_date,
                 concat(date_format(e.w_date, "%Y%m%d"), e.loco_id) AS w_date_fmt,
                 concat(sm.merchant_name, " (", sy.location, ")")           AS sc_name,
                 concat("sites.php?page=scrapyards&action=query&id=", e.scrapyard_code) 
                                                                            AS sc_name_ext,
                 e.s_date,
                 date_format(e.s_date, "%Y%m%s") AS s_date_fmt,
                 e.preserved,
                 concat("locoqry.php?action=locodata&id=", e.loco_id,
                        "&type=E&loco=", en.number) AS number_hl,
                 en.number,
                 en.number_type,
                 en.carried_number,
                 case when en.number_type = "BIG4"  THEN 1
                      when en.number_type = "WD"    THEN 2
                      when en.number_type = "PN"    THEN 3
                      when en.number_type = "PRT"   THEN 3
                      when en.number_type = "TOPS"  THEN 4
                      when en.number_type = "DP"    THEN 5
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
                 enm.name,
                 bd.bl_name,
                 en.company,
                 en.subtype,
                 en.carried_number,
                 e.last_depot,
                 ecl.e_class_id,
                 round(datediff(case date_format(e.w_date, "%d")
                            when 0 then date_format(concat(date_format(e.w_date, "%Y-%m-"),
                                                    "15"), "%Y-%m-%d")
                            else e.w_date 
                            END,
                            case date_format(e.b_date, "%d")
                            when 0 then date_format(concat(date_format(e.b_date, "%Y-%m-"),
                                                    "15"), "%Y-%m-%d")
                            else e.b_date 
                            END) /365, 2) AS service_prd,
                 round(datediff(case date_format(e.s_date, "%d")
                            when 0 then date_format(concat(date_format(e.s_date, "%Y-%m-"),
                                                    "15"), "%Y-%m-%d")
                            else e.s_date
                            END,
                            case date_format(e.w_date, "%d")
                            when 0 then date_format(concat(date_format(e.w_date, "%Y-%m-"),
                                                    "15"), "%Y-%m-%d")
                            else e.w_date 
                            END) /365, 2) AS cond_prd,
                 round(datediff(case date_format(coalesce(e.s_date, curdate()), "%d")
                            when 0 then date_format(concat(date_format(coalesce(e.s_date,
                                                           curdate()), "%Y-%m-"),
                                                    "15"), "%Y-%m-%d")
                            else coalesce(e.s_date, curdate())
                            END,
                            case date_format(e.b_date, "%d")
                            when 0 then date_format(concat(date_format(e.b_date, "%Y-%m-"),
                                                    "15"), "%Y-%m-%d")
                            else e.b_date 
                            END) /365, 2) AS tot_age,
                 F.prev_identifier,
                 concat("locoqry.php?action=class&id=", F.prev_e_class, "&type=D&page=fleet")
                                                                            AS prev_identifier_ext,
                 F.main_start_date,
                 F.main_start_date_fmt,
                 F.next_e_class,
                 F.next_identifier,
                 concat("locoqry.php?action=class&id=", F.next_e_class, "&type=D&page=fleet")
                                                                            AS next_identifier_ext,
                 F.next_start_date,
                 F.next_start_date_fmt
          FROM   electric e
          LEFT JOIN e_nums en
          ON     en.loco_id = e.loco_id

          LEFT JOIN ref_scrapyard sy
          ON     sy.scrapyard_code = e.scrapyard_code

          LEFT JOIN ref_scrap_merchant sm
          ON     sm.merchant_code = substr(sy.scrapyard_code, 1, 3)

          LEFT JOIN ref_builders bd
          ON     bd.bl_code = e.bl_code

          LEFT JOIN e_alloc ea
          ON     ea.loco_id = e.loco_id
          AND    ea.alloc_flag = "N"

          LEFT JOIN ref_depot_codes dc1
          ON     dc1.depot_code = e.first_depot
          AND    dc1.date_from = (SELECT max(dc1a.date_from)
                                  FROM   ref_depot_codes dc1a
                                  WHERE  dc1a.depot_code = e.first_depot
                                  AND    dc1a.date_from <= e.b_date)
          LEFT JOIN ref_depot dp1
          ON     dp1.depot_id = dc1.depot_id

          LEFT JOIN ref_depot_codes dc2
          ON     dc2.depot_code = e.last_depot
          AND    dc2.date_from = (SELECT max(dc2a.date_from)
                                  FROM   ref_depot_codes dc2a
                                  WHERE  dc2a.depot_code = e.last_depot
                                  AND    dc2a.date_from <= e.w_date)
          LEFT JOIN ref_depot dp2
          ON     dp2.depot_id = dc2.depot_id

          LEFT JOIN e_name enm
          ON     enm.loco_id = e.loco_id

          JOIN   e_class_link ecl
          ON     ecl.loco_id = e.loco_id
          AND    ecl.e_class_id = ' .$id. '
          ' . $extra_sql . '

          JOIN (    select ecl2.loco_id,
                           ecl1.e_class_id      AS prev_e_class,
                           ec1.identifier       AS prev_identifier,
                           ecl1.start_date      AS prev_start_date,
                           ecl2.e_class_id      AS main_e_class,
                           ec2.identifier       AS main_identifier,
                           ecl2.start_date      AS main_start_date,
                           concat(date_format(ecl2.start_date, "%Y%m%d"), ecl2.loco_id)
                                                AS main_start_date_fmt,
                           ecl3.e_class_id      AS next_e_class,
                           dc3.identifier       AS next_identifier,
                           ecl3.start_date      AS next_start_date,
                           concat(date_format(ecl3.start_date, "%Y%m%d"), ecl3.loco_id)
                                                AS next_start_date_fmt
                    from   e_class_link ecl2
                    left join e_class_link ecl1
                    on     ecl1.loco_id = ecl2.loco_id
                    and    ecl1.e_class_id <> ecl2.e_class_id
                    and    ecl1.start_date = (SELECT max(ecl1a.start_date)
                                              FROM   e_class_link ecl1a
                                              WHERE  ecl1a.loco_id = ecl2.loco_id
                                              AND    ecl1a.start_date < ecl2.start_date
                                              AND    ecl1a.e_class_id <> ecl2.e_class_id)
                    left join e_class ec1
                    on     ecl1.e_class_id = ec1.e_class_id
                    left join e_class_link ecl3
                    on     ecl3.loco_id = ecl2.loco_id
                    and    ecl3.e_class_id <> ecl2.e_class_id
                    and    ecl3.start_date = (SELECT min(ecl3a.start_date)
                                              FROM   e_class_link ecl3a
                                              WHERE  ecl3a.loco_id = ecl2.loco_id
                                              AND    ecl3a.start_date > ecl2.start_date
                                              AND    ecl3a.e_class_id <> ecl2.e_class_id)
                    left join e_class dc3
                    on     ecl3.e_class_id = dc3.e_class_id
                    join e_class ec2
                    on     ecl2.e_class_id = ec2.e_class_id
                    where  ecl2.e_class_id = ' .$id. '
          ) AS F
          ON     F.loco_id = e.loco_id

          ORDER BY e.loco_id, idx, ea.alloc_date';

//echo $sql;

  $result = $db->execute($sql);

  if ($debug)
    debug_memory('Main Query');

  printf("<th width=8%%><strong>Date To Service</strong></th>\n");

  if ($classcount > 1 && $nr > 0)
  {
    printf("<th width=8%%><strong>Rebuilt From</strong></th>\n");
  }
//  printf("<th width=5%%><strong>New Depot Code</strong></th>\n");
  printf("<th width=11%%><strong>Depot Delivered To</strong></th>\n");
  printf("<th width=8%%><strong>Date Withdrawn</strong></th>\n");
  if ($classcount > 1 && $nr < $necl)
  {
    printf("<th width=8%%><strong>Rebuilt To</strong></th>\n");
  }
//  printf("<th width=5%%><strong>Wdn Depot Code</strong></th>\n");
  printf("<th width=11%%><strong>Depot Withdrawn From</strong></th>\n");
  printf("<th width=5%%><strong>Svc Age (Yrs)</strong></th>\n");
  printf("<th width=3%%><strong>Fate</strong></th>\n");
  printf("<th width=11%%><strong>Where</strong></th>\n");
  printf("<th width=8%%><strong>When</strong></th>\n");
  printf("<th width=4%%><strong>Tot Age (Yrs)</strong></th>\n");
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
              fn_ptdelem(10, $elem, $prev_start_date_fmt);
            }
            fn_ptdelem(11, $depot_name_new);
            fn_pelem_date(8, $date_wdn,  $date_wdn_fmt);
            if ($classcount > 1 && $nr < $necl)
            {
              if ($next_flag && !empty($next_identifier))
                $elem = sprintf("%s<br />to %s", fn_fdate($next_start_date),
                                                          $next_identifier);
              else
                $elem = "";
              fn_ptdelem(10, $elem, $next_start_date_fmt);
            }
            fn_ptdelem(11, $depot_name_wdn);
            fn_ptdelem(5,  $srv_prd);
            fn_ptdelem(3,  $fate_code);
            fn_ptdelem(11, $fate_site_fmt);
            fn_pelem_date(8, $fate_date, $fate_date_fmt);
            fn_ptdelem(4,  $tot_age);
            fn_ptdelem(10, $name);
          printf("</tr>\n");
        }

        /* Copy all the basic repetitive information for the new loco */
        $depot_code_new = sprintf("<a href=%s>%s</a>", $row['depot_code_new_ext'], 
                                                       $row['depot_code_new']);
        $depot_name_new = sprintf("<a href=%s>%s</a>", $row['depot_name_new_ext'],
                                                       $row['depot_name_new']);
        $depot_code_wdn = sprintf("<a href=%s>%s</a>", $row['depot_code_wdn_ext'], 
                                                       $row['depot_code_wdn']);
        $depot_name_wdn = sprintf("<a href=%s>%s</a>", $row['depot_name_wdn_ext'],
                                                       $row['depot_name_wdn']);
        $date_comp = $row['b_date'];
        $date_comp_fmt = $row['b_date_fmt'];
        $date_wdn  = $row['w_date'];
        $date_wdn_fmt  = $row['w_date_fmt'];
        if (($srv_prd = fn_datediff($row['w_date'], $row['b_date'])) == -1)
          $srv_prd = "";
        $cnd_prd = $row['cond_prd'];
        $tot_age = $row['tot_age'];
        $name = $row['name'];

        $prev_identifier = sprintf("<a href=%s>%s</a>", $row['prev_identifier_ext'],
                                                        $row['prev_identifier']);
        $prev_flag = strlen($row['prev_identifier']);
        $next_identifier = sprintf("<a href=%s>%s</a>", $row['next_identifier_ext'],
                                                        $row['next_identifier']);
        $next_flag = strlen($row['next_identifier']);
        $prev_start_date = $row['main_start_date']; // yes, this is correct
        $prev_start_date_fmt = $row['main_start_date_fmt']; // yes, this is correct
        $next_start_date = $row['next_start_date'];
        $next_start_date_fmt = $row['next_start_date_fmt'];

        if ($row['preserved'] == "Y")
        {
          $fate_code = "Prs";
          $fate_site = "Preserved";
          $fate_date = "";
          $fate_date_fmt = "";
          $fate_site_fmt = $fate_site;
        }
        else
        if (!empty($row['sc_name']))
        {
          $fate_code = "Cut";
          $fate_site = $row['sc_name'];
          $fate_date = $row['s_date'];
          $fate_date_fmt = $row['s_date_fmt'];
          $fate_site_fmt = sprintf("<a href=%s>%s</a>", $row['sc_name_ext'],
                                                        $row['sc_name']);
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
        if ($row['number_type'] == "PRT")
          $row['number'] = fn_e_pfx($row['number']);

        if ($row['carried_number'] == "Y")
        {
          $loconum[$key] = sprintf("<a href=%s><strong>%s</strong></a>\n", 
                                  $row['number_hl'], 
                                  $row['number']);
        }
        else
        {
          $loconum[$key] = sprintf("<a href=%s><i>%s</i></a>\n", 
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
        $elem = sprintf("%s<br />from %s", fn_fdate($prev_start_date),
                                                  $prev_identifier);
        fn_ptdelem(10, $elem, $prev_start_date_fmt);
      }
      fn_ptdelem(11, $depot_name_new);
      fn_pelem_date(8, $date_wdn,  $date_wdn_fmt);
      if ($classcount > 1 && $nr < $necl)
      {
        if ($next_flag)
          $elem = sprintf("%s<br />to %s", fn_fdate($next_start_date),
                                                  $next_identifier);
        else
          $elem = "";
        fn_ptdelem(10, $elem, $next_start_date_fmt);
      }
      fn_ptdelem(11, $depot_name_wdn);
      fn_ptdelem(5,  $srv_prd);
      fn_ptdelem(3,  $fate_code);
      fn_ptdelem(11, $fate_site_fmt);
      fn_pelem_date(8, $fate_date, $fate_date_fmt);
      fn_ptdelem(4,  $tot_age);
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
