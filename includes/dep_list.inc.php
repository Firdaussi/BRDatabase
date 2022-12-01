<?php

  printf("<h3 align=center>List of Depots</h3><br />\n");

  include_once("lib/cache.class.php");
  /**
   * call the class after the include
   */
  $file_cache=new cache();
  $file_cache->start_cache();

  $sql = 'SELECT *
          FROM   tdw_dep_list
          ORDER BY depot_name, date_from';

  /*
  Use the following to create the temporary data warehouse table:
  $sql = 'SELECT d.depot_id,
                 d.depot_name,
                 concat("sites.php?page=depots&subpage=main&id=",d.depot_id) AS depot_name_hl,
                 NULL                                                        AS depot_codes,
                 d.date_opened,
                 d.closed_to_steam,
                 d.date_closed,
                 d.grid_reference,
                 dc.date_from,
                 ifnull(dc.displayed_depot_code, dc.depot_code) AS corr_depot_code,
                 concat("sites.php?page=depots&subpage=main&id=",d.depot_id) AS corr_depot_code_hl,
                 d.big4_company,
                 d.prg_company,
                 d.br_region,
                 concat("companies.php?page=", d.big4_company, "&subpage=", d.prg_company)
                                                                             AS prg_company_hl,
                 concat("companies.php?page=", d.big4_company)               AS big4_company_hl,
                 concat("companies.php?page=BR&subpage=", d.br_region)       AS br_region_hl
          FROM   ref_depot d
          JOIN   ref_depot_codes dc
          ON     dc.depot_id = d.depot_id
          ORDER BY d.depot_name, dc.date_from';
  */

  $result = $db->execute($sql);

  $tb = new MyTables("depot_list");

  $tb->add_caption("Summary of Locomotive Depots");
  $tb->allow_rollover();
  $tb->sortable();

  $tb->add_column("depot_name",       "Depot",            23);
  $tb->add_column("depot_codes",      "Codes",             7);
  $tb->add_column("dc_date_start",    "From",             10);
  $tb->add_column("date_opened",      "Date Opened",      10);
  $tb->add_column("closed_to_steam",  "Closed to Steam",  10);
  $tb->add_column("date_closed",      "Date Closed",      10);
  $tb->add_column("prg_company",      "Original Company",  6);
  $tb->add_column("big4_company",     "Big Four Company",  6);
  $tb->add_column("br_region",        "BR Region",         6);
  $tb->add_column("gr_val",           "Map",               6);
  $tb->add_column("web",              "Web",               6);
  
  $dn = ""; $ct = 0;
  while ($row = mysqli_fetch_assoc($result))
  {
    if ($lastdepot == $row['depot_name'])
    {
      $rowx['depot_codes']   .= "<br /><a href=\"" . $row['corr_depot_code_hl'] . "\">" .
                                                     $row['corr_depot_code']    . "</a>";
      $rowx['dc_date_start'] .= "<br />" . fn_fdate($row['date_from']);
    }
    else
    {
      if ($lastdepot != "")
        $tb->add_data($rowx);

      $rowx = NULL;

      $rowx['depot_codes'] = "<a href=\"" . $row['corr_depot_code_hl'] . "\">" .
                                            $row['corr_depot_code']    . "</a>";
      $rowx['dc_date_start'] = fn_fdate($row['date_from']);
      $rowx['depot_name'] =  "<a href=\"" . $row['depot_name_hl'] . "\">" .
                                            $row['depot_name']    . "</a>";
      if (!empty($row['date_opened']))
        $rowx['date_opened'] = fn_fdate($row['date_opened']);
      if (!empty($row['date_closed']))
        $rowx['date_closed'] = fn_fdate($row['date_closed']);
      if (!empty($row['closed_to_steam']))
        $rowx['closed_to_steam'] = fn_fdate($row['closed_to_steam']);

      if (!empty($row['prg_company']))
        $rowx['prg_company'] = "<a href=\"" . $row['prg_company_hl'] . "\">" .
                                              $row['prg_company']    . "</a>";
      if (!empty($row['big4_company']))
        $rowx['big4_company'] = "<a href=\"" . $row['big4_company_hl'] . "\">" .
                                               $row['big4_company']    . "</a>";
      if (!empty($row['br_region']))
        $rowx['br_region']    = "<a href=\"" . $row['br_region_hl'] . "\">" .
                                               $row['br_region']    . "</a>";

      if (!empty($row['grid_reference']))
        $rowx['gr_val'] = "<a href=\"javascript:void(0)\" onClick=\"window.open('www.streetmap.co.uk/grid/" .
                                $row['grid_reference'] . ",115')\">Map</a>";

      if (!empty($row['weblink']))
        $rowx['web'] = "<a href=\"javascript:void(0)\" onClick=\"window.open('" . 
                       $row['weblink'] . "')\">Link</a>";

    }

    $lastdepot = $row['depot_name'];
  }

  if ($lastdepot != "")
    $tb->add_data($rowx);

  $tb->draw_table();

  $file_cache->end_cache();
?>
