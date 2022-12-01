<?php

/***********************************************************************************************/
/*                                                                                             */
/* Stage 0: Preliminaries - set up tables and work out parameters                              */
/*                                                                                             */
/***********************************************************************************************/

include_once("lib/MyTables.class.php");
include_once("lib/brlib.php");

include_once("lib/cache.class.php");
/**
 * call the class after the include
 */
$file_cache=new cache();
$file_cache->start_cache();


/***********************************************************************************************/
/*                                                                                             */
/* Stage 1: Get all locomotives from this class                                                */
/*                                                                                             */
/***********************************************************************************************/

  $sql1 = 'SELECT s.loco_id lid,
                  s.b_date,
                  s.w_date,
                  s.b_date AS date_c,
                  s.w_date AS date_w,
                  coalesce(scv.common_name, scv.class_type) AS class_type
           FROM   steam  s
           JOIN   s_class_link scl
           ON     scl.loco_id = s.loco_id
           JOIN   s_class_var scv
           ON     scv.s_class_id = scl.s_class_id
           AND    scv.s_class_var_id = scl.s_class_var_id
           WHERE  scv.s_class_id = ' .$id. '
           ORDER BY s.loco_id';

  $result = $db->execute($sql1);

  $n1= 0; $lastid = 0;
  if ($db->count_select())
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      if ($lastid == $row['lid'])
        $n1--;
      $row1[$n1++] = $row;
      $lastid = $row['lid'];
	}
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 2: Get all allocations from this class                                                */
/*                                                                                             */
/***********************************************************************************************/

  $sql2 = 'SELECT sa.loco_id,
                  coalesce(dc1.displayed_depot_code, dc1.depot_code) AS allocation,
                  sa.alloc_date,
                  sa.alloc_flag,
                  CASE WHEN sa.loan_allocation IS NOT NULL THEN
                    1
                  ELSE
                    0
                  END AS loan_flag,
                  concat("sites.php?page=depots&action=query&id=", dp1.depot_id) AS allocation_ext,
                  concat("sites.php?page=depots&action=query&id=", dp1.depot_id) AS depot_name_ext,
                  dp1.depot_name,
                  s.last_depot,
                  dp2.depot_name AS last_depot_name
           FROM   s_alloc sa

           JOIN   steam s
           ON     s.loco_id = sa.loco_id

           LEFT JOIN ref_depot_codes dc1
           ON     dc1.depot_code = coalesce(sa.loan_allocation, sa.allocation)
           AND    dc1.date_from = (SELECT max(dc1a.date_from)
                                   FROM   ref_depot_codes dc1a
                                   WHERE  dc1a.depot_code = coalesce(sa.loan_allocation, sa.allocation)
                                   AND    dc1a.date_from <= sa.alloc_date)

           LEFT JOIN   ref_depot dp1
           ON     dp1.depot_id = dc1.depot_id

           LEFT JOIN   ref_depot_codes dc2
           ON     dc2.depot_code = s.last_depot
           AND    dc2.date_from = (SELECT max(dc2a.date_from)
                                   FROM   ref_depot_codes dc2a
                                   WHERE  dc2a.depot_code = s.last_depot
                                   AND    dc2a.date_from <= s.w_date)

           LEFT JOIN   ref_depot dp2
           ON     dp2.depot_id = dc2.depot_id

           JOIN   s_class_link scl
           ON     scl.loco_id = sa.loco_id
           AND    scl.s_class_id = ' .$id. '
           GROUP BY sa.loco_id, 
                    sa.allocation, 
                    sa.alloc_date, 
                    sa.alloc_flag, 
                    allocation_ext, 
                    depot_name_ext, 
                    dp1.depot_name,
                    s.last_depot,
                    last_depot_name
           ORDER BY sa.loco_id, 
                    sa.alloc_date, 
                    sa.seq';

  $result = $db->execute($sql2);

  $n2=0;
  if ($db->count_select())
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      if ($row['loan_flag'] == 1)
      {
        $row['depot_name'] = "<i>" . $row['depot_name'] . " (on loan)</i>";
       $row['allocation'] = "<i>" . $row['allocation'] . "</i>";
      }

      $row2[$n2++] = $row;
	}
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 3: Get all numbers for this class                                                     */
/*                                                                                             */
/***********************************************************************************************/

  $sql3a = 'select sn.company,
                   sn.subtype,
                   min(sn.start_date) mindate
            from   s_nums sn
            join   s_class_link scl
            on     scl.loco_id = sn.loco_id
            and    scl.s_class_id = ' . $id . '
            where  sn.start_date <> "0000-00-00"
            group by 1,2
            order by mindate, subtype';

// echo $sql3;

  $result = $db->execute($sql3a);

  $arct = 0; $ar_f = array(); $ar = array();

  if ($db->count_select())
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $ar[$arct] = $row['company'].$row['subtype'];
      if (isset($row['subtype']))
        $ar_f[$arct++] = $row['company']. " (" .$row['subtype']. ")";
      else
        $ar_f[$arct++] = $row['company'];
	}
  }

  //printf("[[ar]] array: <br />\n"); print_r($ar); printf("<br />\n");

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 4: Get all numbers for this class                                                     */
/*                                                                                             */
/***********************************************************************************************/

  $sql3 = 'select sn.loco_id,
                  sn.number,
                  concat("locoqry.php?action=locodata&id=", sn.loco_id,"&type=S&loco=",sn.number) 
                                                         AS number_hl,
                  sn.number_type,
                  sn.company,
                  sn.subtype,
                  sn.carried_number,
                  case when sn.number_type = "PRG"  THEN 1
                       when sn.number_type = "BIG4" THEN 2
                       when sn.number_type = "WD"   THEN 7
                       when sn.number_type = "BR"   THEN 8
                       when sn.number_type = "DP"   THEN 9
                  end AS idx
           from   s_nums sn
           join   s_class_link scl
           on     scl.loco_id = sn.loco_id
           and    scl.s_class_id = ' .$id. '
           order by sn.loco_id, idx, subtype';
     
  $result = $db->execute($sql3);
  //echo $sql3;

  $n3=0;
  $lastid = 0; $maxnum = 1; $maxnum_val = 0; 
  if ($db->count_select())
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      // determine how many potential columns there are for numbers
      if ($lastid == $row['loco_id'])
        $maxnum ++;
      else
        $maxnum = 1;
      $row3[$n3++] = $row;
      if ($maxnum_val < $maxnum)
        $maxnum_val = $maxnum;
      $lastid = $row['loco_id'];
	}
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 5: Set up the tables with headings based on number of number_types                    */
/*                                                                                             */
/***********************************************************************************************/

  $tb_alloc = new MyTables("alloc_data");

  $tb_alloc->add_column("class_type",     "Class",          11);
  for ($nx = 0; $nx < $arct; $nx++)
    $tb_alloc->add_column("n".$nx,       $ar_f[$nx],        25/$arct);

  $tb_alloc->add_column("b_date",         "Built",           6);
  $tb_alloc->add_column("depot_code",     " ",               3);
  $tb_alloc->add_column("depot_name",     "Depot Name",     15);
  $tb_alloc->add_column("alloc_date",     "From",            6);
  $tb_alloc->add_column("w_date",         "Date Withdrawn",  6);


  $count = -1;

  for ($nx = 0, $lasty = 0, $lastz = 0; $nx < count($row1); $nx++)
  {
    $count++;

    $row1[$nx]['b_date'] = fn_fdate($row1[$nx]['b_date']);
    $row1[$nx]['w_date'] = fn_fdate($row1[$nx]['w_date']);

    for ($ny = $lasty; $ny < count($row2); $ny++)
    {
//echo $row2[$ny]['loco_id'] . " - looping " . $ny . " from " . $lasty . " to " . count($row2) . "<br />";
      if ($row2[$ny]['loco_id'] == $row1[$nx]['lid'])
      {
//printf("[%s] matches [%s]<br />\n", $row2[$ny]['loco_id'], $row1[$nx]['lid']);
        $lasty = $ny;

        if ($row2[$ny]['alloc_flag'] == "W")
        {
          $row2[$ny]['allocation'] = "<font color=\"red\">W</font>";
          $row2[$ny]['depot_name'] = "<font color=\"red\">Withdrawn</font>";
        }
        else
        if ($row2[$ny]['alloc_flag'] == "R")
        {
          $row2[$ny]['allocation'] = sprintf("<a href=\"%s\">%s</a>",
                                       $row2[$ny]['allocation_ext'],
                                       $row2[$ny]['allocation']);
          $row2[$ny]['depot_name'] = sprintf("<a href=\"%s\">%s <font color=\"green\">(Re-instd)</font></a>",
                                       $row2[$ny]['allocation_ext'],
                                       $row2[$ny]['depot_name']);
        }
        else
        if ($row2[$ny]['alloc_flag'] == "S")
        {
          $row2[$ny]['allocation'] = "<font color=\"orange\">S</font>";
          $row2[$ny]['depot_name'] = "<font color=\"orange\">Stored</font>";
        }
        else
        if (!empty($row2[$ny]['allocation_ext']))
        {
          $row2[$ny]['allocation'] = sprintf("<a href=\"%s\">%s</a>",
                                       $row2[$ny]['allocation_ext'],
                                       $row2[$ny]['allocation']);
          $row2[$ny]['depot_name'] = sprintf("<a href=\"%s\">%s</a>",
                                       $row2[$ny]['allocation_ext'],
                                       $row2[$ny]['depot_name']);
        }

        if ($yval1 == "")
          $yval1 = $row2[$ny]['allocation'];
        else
          $yval1 = $yval1 . "<br />" . $row2[$ny]['allocation'];

        if ($yval2 == "")
          $yval2 = $row2[$ny]['depot_name'];
        else
          $yval2 = $yval2 . "<br />" . $row2[$ny]['depot_name'];

        if ($yval3 == "")
          $yval3 = fn_fdate($row2[$ny]['alloc_date']);
        else
          $yval3 = $yval3 . "<br />" . fn_fdate($row2[$ny]['alloc_date']);

        $row1[$nx]['depot_code'] = $yval1;
        $row1[$nx]['depot_name'] = $yval2;
        $row1[$nx]['alloc_date'] = $yval3;
      }
      else
      if ($row2[$ny]['loco_id'] > $row1[$nx]['lid'])
      {
        $row1[$nx]['depot_code'] = $yval1;
        $row1[$nx]['depot_name'] = $yval2;
        $row1[$nx]['alloc_date'] = $yval3;

        $yval1 = $yval2 = $yval3 = "";
        break;
      }
      else
      {
        $lasty++;
      }
    }

    //$row1[$nx]['alloc_date'] = fn_fdate($yval3);

    for ($nz = $lastz; $nz < count($row3); $nz++)
    {
      if ($row3[$nz]['loco_id'] == $row1[$nx]['lid'])
      {
      //printf("[%s] matches [%s]<br />\n", $row3[$nz]['loco_id'], $row1[$nx]['lid']);
        $lastz = $nz;

      //printf("Looking up [%s][%s] in array<br />\n", $row3[$nz]['company'],$row3[$nz]['subtype']);
        $key = array_search($row3[$nz]['company'].$row3[$nz]['subtype'], $ar);

        if ($key === FALSE)
        {
      //printf("Not found in array <br />\n");
        }
        else
        {
          $nval = "n".$key;
          $nvalraw = $nval . "r";
          $row1[$nx][$nvalraw] = $row3[$nz]['number'];
          if ($row3[$nz]['carried_number'] == "Y")
          {
            $row1[$nx][$nval] = sprintf("<a href=\"%s\">%s</a>\n", 
                                    $row3[$nz]['number_hl'], 
                                    $row3[$nz]['number']);
          }
          else
          {
            $row1[$nx][$nval] = sprintf("<a href=\"%s\"><i>%s</i></a>\n", 
                                    $row3[$nz]['number_hl'], 
                                    $row3[$nz]['number']);
          }
        }
      }
      else
      if ($row3[$nz]['loco_id'] > $row1[$nx]['lid'])
        break;
      else
      {
      //printf("Comparing [%s] with [%s]<br />\n", $row3[$nz]['loco_id'], $row1[$nx]['lid']);
        $lastz++;
      }
    }
  }

  if ($count != -1)  // at least one loco
  {
    for ($x = 0; $x < count($row1); $x++)
      $tb_alloc->dump_data($row1[$x]);
  }

//  $html_str = $tb_alloc->get_table();

  $tb_alloc->dump_data(NULL);

/*
  printf("<form method=\"post\" action=\"publishpdf.php\">\n");
  printf("<fieldset>\n");
  printf("<input type=\"hidden\" name=\"sql\" value=\"%s\" />\n", $html_str);
  printf("<input type=\"submit\" id=\"search-submit\" value=\"Generate PDF\" />\n");
  printf("</fieldset>\n");
  printf("</form>\n");
*/

  $file_cache->end_cache();
?>
