<?php
  include_once("lib/brlib.php");

/***********************************************************************************************/
/*                                                                                             */
/* Stage 0: Preliminaries - set up tables and work out parameters                              */
/*                                                                                             */
/***********************************************************************************************/

include_once("lib/MyTables.class.php");

/***********************************************************************************************/
/*                                                                                             */
/* Stage 1: Get all locomotives from this class                                                */
/*                                                                                             */
/***********************************************************************************************/

  $sql1 = 'SELECT e.loco_id lid,
                  e.b_date,
                  e.w_date,
                  e.b_date AS date_c,
                  e.w_date AS date_w,
                  ecv.identifier
           FROM   electric e
           JOIN   e_class_link ecl
           ON     ecl.loco_id = e.loco_id
           JOIN   e_class_var ecv
           ON     ecv.e_class_id = ecl.e_class_id
           AND    ecv.e_class_var_id = ecl.e_class_var_id
           WHERE  ecv.e_class_id = ' .$id. '
           ORDER BY e.loco_id';

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

  $sql2 = 'select ea.loco_id,
                  coalesce(dc1.displayed_depot_code, dc1.depot_code) AS allocation,
                  ea.alloc_date,
                  ea.alloc_flag,
                  concat("sites.php?page=depots&action=query&id=", dp1.depot_id) AS allocation_ext,
                  concat("sites.php?page=depots&action=query&id=", dp1.depot_id) AS depot_name_ext,
                  dp1.depot_name,
                  ea.loan_allocation,
                  ldp.depot_name       AS loan_depot_name
           from   e_alloc ea

           LEFT JOIN ref_depot_codes dc1
           ON     dc1.depot_code = ea.allocation
           AND    dc1.date_from = (SELECT max(dc1a.date_from)
                                   FROM   ref_depot_codes dc1a
                                   WHERE  dc1a.depot_code = ea.allocation
                                   AND    dc1a.date_from <= ea.alloc_date)

           LEFT JOIN ref_depot dp1
           ON     dp1.depot_id = dc1.depot_id

           LEFT JOIN  ref_depot_codes ldc
           ON     ldc.depot_code = ea.loan_allocation
           AND    ldc.date_from  = (SELECT max(ldc1.date_from)
                                   FROM   ref_depot_codes ldc1
                                   WHERE  ldc1.depot_code = ea.loan_allocation
                                   AND    ldc1.date_from <= ea.alloc_date)

           LEFT JOIN  ref_depot ldp
           ON     ldp.depot_id = ldc.depot_id

           join   e_class_link ecl
           on     ecl.loco_id = ea.loco_id
           and    ecl.e_class_id = ' .$id. '

           group by ea.loco_id, 
                    ea.allocation, 
                    ea.alloc_date, 
                    ea.alloc_flag, 
                    allocation_ext, 
                    depot_name_ext, 
                    dp1.depot_name
           order by ea.loco_id, 
                    ea.alloc_date, 
                    ea.seq';
       
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

  $sql3a = 'SELECT en.company,
                   en.number_type,
                   case when en.number_type = "PN"   THEN 1
                        when en.number_type = "PRT"  THEN 2
                        when en.number_type = "WD"   THEN 7
                        when en.number_type = "TOPS" THEN 8
                        when en.number_type = "DP"   THEN 9
                   end AS idx,
                   en.subtype
            FROM   e_nums en
            JOIN   e_class_link ecl
            ON     ecl.loco_id = en.loco_id
            AND    ecl.e_class_id = ' . $id . '
            GROUP BY en.company, idx, en.subtype
            ORDER BY idx, en.subtype';
            
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

  $sql3 = 'select en.loco_id,
                  en.number,
                  concat("locoqry.php?action=locodata&id=",en.loco_id,"&type=E&loco=",en.number) AS number_hl,
                  en.number_type,
                  en.company,
                  en.subtype,
                  en.carried_number,
                  case when en.number_type = "PN"   THEN 1
                       when en.number_type = "PRT"  THEN 2
                       when en.number_type = "WD"   THEN 7
                       when en.number_type = "TOPS" THEN 8
                       when en.number_type = "DP"   THEN 9
                  end AS idx
           from   e_nums en
           join   e_class_link ecl
           on     ecl.loco_id = en.loco_id
           and    ecl.e_class_id = ' .$id. '
           order by en.loco_id, idx, subtype';
     
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

  $tb_alloc->add_column("identifier",     "Class",           6);
  for ($nx = 0; $nx < $arct; $nx++)
  $tb_alloc->add_column("n".$nx,       $ar_f[$nx],         25/$arct);

  $tb_alloc->add_column("b_date",         "Built",           8);
  $tb_alloc->add_column("depot_code",     " ",               3);
  $tb_alloc->add_column("depot_name",     "Depot Name",     15);
  $tb_alloc->add_column("alloc_date",     "From",            7 );
  $tb_alloc->add_column("w_date",         "Date Withdrawn",  8);

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

        if ($row2[$ny]['alloc_flag'] == "W")
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
            $row1[$nx][$nvalraw] = fn_e_pfx($row3[$nz]['number']);
          else
            $row1[$nx][$nvalraw] = $row3[$nz]['number'];
          if ($row3[$nz]['carried_number'] == "Y")
          {
            $row1[$nx][$nval] = sprintf("<a href=%s>%s</a>\n", 
                                    $row3[$nz]['number_hl'], 
                                    $row3[$nz]['number']);
          }
          else
          {
            $row1[$nx][$nval] = sprintf("<a href=%s>(%s)</a>\n", 
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



?>
