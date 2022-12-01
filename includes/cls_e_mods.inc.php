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
                  date_format(e.b_date, "%Y%m%d") AS b_date_fmt,
                  e.w_date,
                  date_format(e.w_date, "%Y%m%d") AS w_date_fmt,
                  ifnull(ecv.identifier, ec.identifier) AS identifier,
                  em.modification,
                  m.description,
                  concat(m.description, "/", e.loco_id) AS description_fmt,
                  em.date_modified,
                  date_format(em.date_modified, "%Y%m%d") AS date_modified_fmt
           FROM   electric e
           JOIN   e_class_link ecl
           ON     ecl.loco_id = e.loco_id
           JOIN   e_class_var ecv
           ON     ecv.e_class_id = ecl.e_class_id
           AND    ecv.e_class_var_id = ecl.e_class_var_id
           JOIN   e_class ec
           ON     ec.e_class_id = ecl.e_class_id
           JOIN   e_mods em
           ON     em.loco_id = e.loco_id
           JOIN   ref_modifications m
           ON     em.modification = m.modification
           WHERE  ecv.e_class_id = ' . $id . '
           ORDER BY e.loco_id';

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

  $sql2 = 'select em.loco_id,
                  em.modification,
                  em.date_modified,
                  date_format(em.date_modified, "%Y%m%d") AS date_modified_fmt,
                  m.description
                          
           FROM   e_mods em

           LEFT JOIN ref_modifications m
           ON     m.modification = em.modification

           JOIN   e_class_link ecl
           ON     ecl.loco_id = em.loco_id
           AND    ecl.e_class_id = ' . $id . '

           ORDER BY em.loco_id, 
                    em.modification,
                    em.date_modified';
       
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

  $sql3a = 'SELECT en.company,
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

  $sql3 = 'select en.loco_id,
                  en.number,
                  concat("locoqry.php?action=locodata&id=",en.loco_id,
                         "&type=E&loco=",en.number) AS number_hl,
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
           order by en.loco_id, idx, en.subtype';
     
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
            $row3[$nz]['number'] = fn_e_pfx($row3[$nz]['number']);
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
