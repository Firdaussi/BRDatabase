<?php
  include_once("lib/brlib.php");

/***********************************************************************************************/
/*                                                                                             */
/* Stage 0: Preliminaries - set up tables and work out parameters                              */
/*                                                                                             */
/***********************************************************************************************/

  include_once("lib/MyTables.class.php");
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

  $sql1 = 'SELECT d.loco_id lid,
                  d.b_date,
                  d.w_date,
                  d.b_date AS date_c,
                  d.w_date AS date_w,
                  dcv.identifier
           FROM   diesels  d
           JOIN   d_class_link dcl
           ON     dcl.loco_id = d.loco_id
           JOIN   d_class_var dcv
           ON     dcv.d_class_id = dcl.d_class_id
           AND    dcv.d_class_var_id = dcl.d_class_var_id
           WHERE  dcv.d_class_id = ' .$id. '
           ORDER BY d.loco_id';

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

  $sql2 = 'select da.loco_id,
                  coalesce(dc1.displayed_depot_code, dc1.depot_code) AS allocation,
                  da.alloc_date,
                  da.alloc_flag,
                  concat("sites.php?page=depots&action=query&id=", dp1.depot_id) AS allocation_ext,
                  concat("sites.php?page=depots&action=query&id=", dp1.depot_id) AS depot_name_ext,
                  dp1.depot_name,
                  da.loan_allocation,
                  ldp.depot_name       AS loan_depot_name
           from   d_alloc da

           LEFT JOIN ref_depot_codes dc1
           ON     dc1.depot_code = da.allocation
           AND    dc1.date_from = (SELECT max(dc1a.date_from)
                                   FROM   ref_depot_codes dc1a
                                   WHERE  dc1a.depot_code = da.allocation
                                   AND    dc1a.date_from <= CASE WHEN date_format(da.alloc_date, "%d") = 0 THEN
                                                                    last_day(da.alloc_date)
                                                                 ELSE
                                                                    da.alloc_date
                                                            END)

           LEFT JOIN ref_depot dp1
           ON     dp1.depot_id = dc1.depot_id

           LEFT JOIN  ref_depot_codes ldc
           ON     ldc.depot_code = da.loan_allocation
           AND    ldc.date_from  = (SELECT max(ldc1.date_from)
                                   FROM   ref_depot_codes ldc1
                                   WHERE  ldc1.depot_code = da.loan_allocation
                                   AND    ldc1.date_from <= CASE WHEN date_format(da.alloc_date, "%d") = 0 THEN
                                                                    last_day(da.alloc_date)
                                                                 ELSE
                                                                    da.alloc_date
                                                             END)

           LEFT JOIN  ref_depot ldp
           ON     ldp.depot_id = ldc.depot_id

           join   d_class_link dcl
           on     dcl.loco_id = da.loco_id
           and    dcl.d_class_id = ' .$id. '

           group by da.loco_id, 
                    da.allocation, 
                    da.alloc_date, 
                    da.alloc_flag, 
                    allocation_ext, 
                    depot_name_ext, 
                    dp1.depot_name
           order by da.loco_id, 
                    da.alloc_date, 
                    da.seq';
       
  $result = $db->execute($sql2);

  $n2=0;
  if ($db->count_select())
  {
    while ($row = mysqli_fetch_assoc($result))
      $row2[$n2++] = $row;
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 3: Get all numbers for this class                                                     */
/*                                                                                             */
/***********************************************************************************************/

  $sql3a = 'SELECT dn.company,
                   dn.number_type,
                   case when dn.number_type = "PN"   THEN 1
                        when dn.number_type = "PRT"  THEN 2
                        when dn.number_type = "WD"   THEN 7
                        when dn.number_type = "TOPS" THEN 8
                        when dn.number_type = "DP"   THEN 9
                   end AS idx,
                   dn.subtype
            FROM   d_nums dn
            JOIN   d_class_link dcl
            ON     dcl.loco_id = dn.loco_id
            AND    dcl.d_class_id = ' . $id . '
            GROUP BY dn.company, idx, dn.subtype
            ORDER BY idx, dn.subtype';
            
  $result = $db->execute($sql3a);

  $ar = array(); $ar_f = array(); $arct = 0;
  if ($db->count_select())
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $key = array_search($row['company'].$row['subtype'], $ar);

      if ($key === FALSE)
      {
        $ar[$arct] = $row['company'].$row['subtype'];
        if (isset($row['subtype']))
          $ar_f[$arct++] = $row['company']. " (" .$row['subtype']. ")";
        else
          $ar_f[$arct++] = $row['company'];
	  }
    }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 4: Get all numbers for this class                                                     */
/*                                                                                             */
/***********************************************************************************************/

  $sql3 = 'select dn.loco_id,
                  dn.number,
                  concat("locoqry.php?action=locodata&id=",dn.loco_id,"&type=D&loco=",dn.number)
                                        AS number_hl,
                  dn.number_type,
                  dn.company,
                  dn.subtype,
                  dn.carried_number,
                  case when dn.number_type = "PN"   THEN 1
                       when dn.number_type = "PRT"  THEN 2
                       when dn.number_type = "WD"   THEN 7
                       when dn.number_type = "TOPS" THEN 8
                       when dn.number_type = "DP"   THEN 9
                  end AS idx
           from   d_nums dn
           join   d_class_link dcl
           on     dcl.loco_id = dn.loco_id
           and    dcl.d_class_id = ' .$id. '
           order by dn.loco_id, idx, subtype';
     
  $result = $db->execute($sql3);

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

  $tb_alloc->sortable();
  $tb_alloc->allow_rollover();

  for ($nx = 0; $nx < $arct; $nx++)
  {
    $tb_alloc->add_column("n".$nx,       $ar_f[$nx],         25/$arct);
  }

  $tb_alloc->add_column("b_date", "Built",          8);
  $tb_alloc->add_column("depot_code",     " ",              3);
  $tb_alloc->add_column("depot_name",     "Depot Name",     15);
  $tb_alloc->add_column("alloc_date",     "From",           7 );
  $tb_alloc->add_column("w_date", "Date Withdrawn", 8);

  $count = -1;

  for ($nx = 0, $lasty = 0, $lastz = 0; $nx < count($row1); $nx++)
  {
    $count++;

    $row1[$nx]['b_date'] = fn_fdate($row1[$nx]['b_date']);
    $row1[$nx]['w_date'] = fn_fdate($row1[$nx]['w_date']);

    for ($ny = $lasty; $ny < count($row2); $ny++)
    {
      if ($row2[$ny]['loco_id'] == $row1[$nx]['lid'])
      {
//      printf("[%s] matches [%s]<br />\n", $row2[$ny]['loco_id'], $row1[$nx]['lid']);
        $lasty = $ny;

        if (strlen($row2[$ny]['loan_allocation']))
          $row2[$ny]['depot_name'] = $row2[$ny]['loan_depot_name'];

        fn_depot_name($row2[$ny]['alloc_flag'], 
                      $row2[$ny]['caveat'],
                      "",
                      $row2[$ny]['allocation'],
                      $row2[$ny]['loan_allocation'],
                      $row2[$ny]['depot_name'],
                      "",
                      "",
                      $alloc,
                      $desc);

        $row2[$ny]['allocation'] = $alloc;
        $row2[$ny]['depot_name'] = $desc;


        if (strtoupper($row2[$ny]['alloc_flag']) == "W")
        {
          $row2[$ny]['allocation'] = "<font color=\"red\">W</font>";
          $row2[$ny]['depot_name'] = "<font color=\"red\">Withdrawn</font>";
        }
        else
        if ($row2[$ny]['alloc_flag'] == "R")
        {
          $row2[$ny]['allocation'] = "<font color=\"red\">R</font>";
          $row2[$ny]['depot_name'] = "<font color=\"red\">Reinstated</font>";
        }
        else
        if ($row2[$ny]['allocation_ext'] != "")
        {
          $row2[$ny]['allocation'] = sprintf("<a href=%s>%s</a>",
                                             $row2[$ny]['allocation_ext'],
                                             $row2[$ny]['allocation']);
          $row2[$ny]['depot_name'] = sprintf("<a href=%s>%s</a>",
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
//      printf("Comparing [%s] with [%s]<br />\n", $row2[$ny]['loco_id'], $row1[$nx]['lid']);
        $lasty++;
      }
    }

    for ($nz = $lastz; $nz < count($row3); $nz++)
    {
      if ($row3[$nz]['loco_id'] == $row1[$nx]['lid'])
      {
//      printf("[%s] matches [%s]<br />\n", $row3[$nz]['loco_id'], $row1[$nx]['lid']);
        $lastz = $nz;

//      printf("Looking up %s%s in array<br />\n", $row3[$nz]['company'],$row3[$nz]['subtype']);
        $key = array_search($row3[$nz]['company'].$row3[$nz]['subtype'], $ar);

        if ($key === FALSE)
        {
        }
        else
        {
          $nval = "n".$key;
          $nvalraw = $nval . "r";

          if ($row3[$nz]['number_type'] == "PRT")
            $row1[$nx][$nvalraw] = fn_d_pfx($row3[$nz]['number']);
          else
            $row1[$nx][$nvalraw] = $row3[$nz]['number'];

          if ($row3[$nz]['carried_number'] == "Y")
          {
            $row1[$nx][$nval] = sprintf("<a href=%s>%s</a>\n", 
                                    $row3[$nz]['number_hl'], 
                                    $row1[$nx][$nvalraw]);
          }
          else
          {
            $row1[$nx][$nval] = sprintf("<a href=%s><i>%s</i></a>\n", 
                                    $row3[$nz]['number_hl'], 
                                    $row1[$nx][$nvalraw]);
          }
        }
      }
      else
      if ($row3[$nz]['loco_id'] > $row1[$nx]['lid'])
        break;
      else
      {
//      printf("Comparing [%s] with [%s]<br />\n", $row3[$nz]['loco_id'], $row1[$nx]['lid']);
        $lastz++;
      }
    }

    $tb_alloc->dump_data($row1[$nx]);
  }

  if ($db->count_select())
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
