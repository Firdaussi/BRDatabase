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

  $sql1 = 'SELECT s.loco_id lid,
                  s.b_date,
                  date_format(s.b_date, "%Y%m%d") AS b_date_fmt,
                  s.w_date,
                  date_format(s.w_date, "%Y%m%d") AS w_date_fmt,
                  coalesce(scv.common_name, sc.identifier) AS identifier,
                  sm.modification,
                  m.description,
                  concat(m.description, "/", s.loco_id) AS description_fmt,
                  sm.date_modified,
                  date_format(sm.date_modified, "%Y%m%d") AS date_modified_fmt
           FROM   steam  s
           JOIN   s_class_link scl
           ON     scl.loco_id = s.loco_id
           JOIN   s_class_var scv
           ON     scv.s_class_id = scl.s_class_id
           AND    scv.s_class_var_id = scl.s_class_var_id
           JOIN   s_class sc
           ON     sc.s_class_id = scl.s_class_id
           JOIN   s_mods sm
           ON     sm.loco_id = s.loco_id
           JOIN   ref_modifications m
           ON     sm.modification = m.modification
           WHERE  scv.s_class_id = ' . $id . '
           ORDER BY s.loco_id';

  $result = $db->execute($sql1);

  $n1= 0; $lastid = 0;
  if ($db->count_select())
  {
    while ($row = mysqli_fetch_array($result))
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
/* Stage 2: Get all modifications for this class                                               */
/*                                                                                             */
/***********************************************************************************************/

  $sql2 = 'select sm.loco_id,
                  sm.modification,
                  sm.date_modified,
                  date_format(sm.date_modified, "%Y%m%d") AS date_modified_fmt,
                  m.description
                          
           FROM   s_mods sm

           LEFT JOIN ref_modifications m
           ON     m.modification = sm.modification

           JOIN   s_class_link scl
           ON     scl.loco_id = sm.loco_id
           AND    scl.s_class_id = ' . $id . '
           
           GROUP BY 1,2,3,4,5

           ORDER BY sm.loco_id, 
                    sm.modification,
                    sm.date_modified';
       
  $result = $db->execute($sql2);

  $n2=0;
  if ($db->count_select())
  {
    while ($row = mysqli_fetch_array($result))
      $row2[$n2++] = $row;
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/* Stage 3: Get all number_types for this class                                                */
/*                                                                                             */
/***********************************************************************************************/

  $sql3a = 'SELECT sn.company,
                   case when sn.number_type = "PRG"  THEN 1
                        when sn.number_type = "BIG4" THEN 2
                        when sn.number_type = "WD"   THEN 6
                        when sn.number_type = "BR"   THEN 7
                        when sn.number_type = "DP"   THEN 8
                        when sn.number_type = "OS"   THEN 9
                   end AS idx,
                   sn.subtype
            FROM   s_nums sn
            JOIN   s_class_link scl
            ON     scl.loco_id = sn.loco_id
            AND    scl.s_class_id = ' . $id . '
            GROUP BY sn.company, idx, sn.subtype
            ORDER BY idx';
            
  $result = $db->execute($sql3a);

  $ar = array(); $ar_f = array(); $arct = 0;
  if ($db->count_select())
  {
    while ($row = mysqli_fetch_array($result))
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

  $sql3 = 'select sn.loco_id,
                  sn.number,
                  concat("locoqry.php?action=locodata&id=",sn.loco_id,
                         "&type=S&loco=",sn.number) AS number_hl,
                  sn.number_type,
                  sn.company,
                  sn.subtype,
                  sn.carried_number,
                   case when sn.number_type = "PRG"  THEN 1
                        when sn.number_type = "BIG4" THEN 2
                        when sn.number_type = "WD"   THEN 6
                        when sn.number_type = "BR"   THEN 7
                        when sn.number_type = "DP"   THEN 8
                        when sn.number_type = "OS"   THEN 9
                   end AS idx
           from   s_nums sn
           join   s_class_link scl
           on     scl.loco_id = sn.loco_id
           and    scl.s_class_id = ' .$id. '
           order by sn.loco_id, idx, subtype';
     
  $result = $db->execute($sql3);

  $n3=0;
  $lastid = 0; $maxnum = 1; $maxnum_val = 0; 
  if ($db->count_select())
  {
    while ($row = mysqli_fetch_array($result))
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

  $tb_mod = new MyTables("mod_data");
  $tb_mod->sortable();

  $tb_mod->add_column("identifier",     "Class",           6);
  for ($nx = 0; $nx < $arct; $nx++)
  {
    $tb_mod->add_column("n".$nx,       $ar_f[$nx],         25/$arct);
  }

  $tb_mod->add_column("b_date", "Built",          8);
  $tb_mod->add_column("w_date", "Date Withdrawn", 8);
  $tb_mod->add_column("description",    "Modification",   20);
  $tb_mod->add_column("date_modified",  "Modification Date", 8);

  $count = -1;

  for ($nx = 0, $lasty = 0, $lastz = 0; $nx < count($row1); $nx++)
  {
    $count++;

    $row1[$nx]['b_date'] = fn_fdate($row1[$nx]['b_date']);
    $row1[$nx]['w_date'] = fn_fdate($row1[$nx]['w_date']);
    $row1[$nx]['date_modified']  = fn_fdate($row1[$nx]['date_modified']);

    for ($ny = $lasty; $ny < count($row2); $ny++)
    {
      if ($row2[$ny]['loco_id'] == $row1[$nx]['lid'])
      {
//       printf("[%s] matches [%s]<br />\n", $row2[$ny]['loco_id'], $row1[$nx]['lid']);
        $lasty = $ny;
      }
      else
      if ($row2[$ny]['loco_id'] > $row1[$nx]['lid'])
      {
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
          if (strcmp($row3[$nz]['number_type'], "PRT") == 0)
            $row3[$nz]['number'] = fn_d_pfx($row3[$nz]['number']);
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

    $tb_mod->add_data($row1[$nx]);
  }

//  $html_str = $tb_mod->get_table();

  if ($db->count_select())
    $tb_mod->draw_table();

/*
  printf("<form method=\"post\" action=\"publishpdf.php\">\n");
  printf("<fieldset>\n");
  printf("<input type=\"hidden\" name=\"sql\" value=\"%s\" />\n", $html_str);
  printf("<input type=\"submit\" id=\"search-submit\" value=\"Generate PDF\" />\n");
  printf("</fieldset>\n");
  printf("</form>\n");
*/



?>