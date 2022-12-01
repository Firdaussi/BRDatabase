<?php

  include_once("lib/MyTables.class.php");
  include_once("lib/brlib.php");

  // Determine what other classes have been rebuilt to/from the current one ($id)

  $sql = 'SELECT distinct s_class_id
          FROM   s_class_link
          WHERE  s_class_id != ' .$id. ' 
          AND    loco_id IN (SELECT loco_id 
                             FROM   s_class_link 
                             WHERE  s_class_id = ' .$id. ')';
                           
  $result = $db->execute($sql);

  if ($result)
  {
    $n_classes = $db->count_select();

    if ($n_classes == 0)
    {
      printf("Error - no rebuilds found<br />\n");
      die();
    }

    $tb_rblds = new MyTables("fleet_data");
    $tb_rblds->sortable();

    $tb_rblds->add_column("number_prg",     "Pre Grouping", 8);
    $tb_rblds->add_column("number_b4",      "Big 4",        8);
    $tb_rblds->add_column("number_br",      "BR",           8);
    $tb_rblds->add_column("build_date",     "Build Date",   11);
    $tb_rblds->add_column("rbld_msg",       "Rebuild",      25);
    $tb_rblds->add_column("rebuild_date",   "Rebuild Date", 11);
    $tb_rblds->add_column("notes",          "Notes",        29);

    $nx = 0;
    if ($result)
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        if ($nx == 0)
          $class_list = $row['s_class_id'];
        else
          $class_list .= "," . $row['s_class_id'];

        $nx++;
      }
    }
  }
    
  $sql = 'SELECT coalesce(sc1.common_name, sc1.identifier)       AS class1,
                 concat("locoqry.php?action=class&type=S&id=",sc1.s_class_id) AS class1_hl,
                 scl1.loco_id,
                 scl1.s_class_id,
                 scl1.start_date      AS sd1,
                 coalesce(sc2.common_name, sc2.identifier)       AS class2,
                 concat("locoqry.php?action=class&type=S&id=",sc2.s_class_id) AS class2_hl,
                 scl2.s_class_id,
                 scl2.start_date      AS sd2,
                 sn.number_type,
                 sn.number,
                 concat("locoqry.php?action=locodata&id=",sn.loco_id,"&type=S&loco=",sn.number) AS number_b4_hl,
				         concat("locoqry.php?action=locodata&id=",sn.loco_id,"&type=S&loco=",sn.number) AS number_br_hl,
				         concat("locoqry.php?action=locodata&id=",sn.loco_id,"&type=S&loco=",sn.number) AS number_prg_hl,
                 case when sn.number_type = "PRG"  THEN 1
                      when sn.number_type = "BIG4" THEN 2
                      when sn.number_type = "WD"   THEN 3
                      when sn.number_type = "BR"   THEN 4
                      when sn.number_type = "DP"   THEN 5
                 end AS idx,
                 s.b_date     AS build_date
          FROM   s_class_link scl1
          JOIN   s_class_link scl2
          ON     scl1.loco_id = scl2.loco_id
          AND    scl1.s_class_id = ' .$id. '
          AND    scl2.s_class_id IN (' .$class_list. ')
          JOIN   s_nums sn
          ON     sn.loco_id = scl1.loco_id
          JOIN   s_class sc1
          ON     sc1.s_class_id = scl1.s_class_id
          JOIN   s_class sc2
          ON     sc2.s_class_id = scl2.s_class_id
          JOIN   steam s
          ON     s.loco_id = scl1.loco_id
          ORDER BY scl1.loco_id, scl1.start_date, idx, sn.start_date';

//echo $sql;

  $result = $db->execute($sql);

  $lid = 0; $nx = 0; $last_id = 0;

  if ($result)
  while ($row = mysqli_fetch_assoc($result))
  {
    $nx++;
    $lid = $row['loco_id'];

    if ($lid != $last_lid && $last_lid != 0)
    {
      /* Dump existing data */

        $rowx['number_b4']    = $number_b4;
        $rowx['number_br']    = $number_brops;
        $rowx['number_prg']   = $number_prg;
        $rowx['rbld_msg']     = $rbld_msg;
        $rowx['build_date']   = fn_fdate($build_date);
        $rowx['rebuild_date'] = fn_fdate($rebuild_date);

        $number_brops = $number_b4 = $number_prg = "";

        $tb_rblds->dump_data($rowx);
    }

    $rowx = $row;

    if ($row['number_type'] == "BIG4")
    {
      if ($number_b4 != "")
        $number_b4 .= "<br />" . $row['number'];
      else
        $number_b4 = $row['number'];
    }
    else
    if ($row['number_type'] == "BR")
    {
      if ($number_brops != "")
        $number_brops .= "<br />" . $row['number'];
      else
        $number_brops = $row['number'];
    }
    else
    if ($row['number_type'] == "PRG")
    {
      if ($number_prg != "")
        $number_prg .= "<br />" . $row['number'];
      else
        $number_prg = $row['number'];
    }

    $build_date = $row['build_date'];

    if (($row['sd1'] != "" && $row['sd2'] != "" && strcmp($row['sd1'], $row['sd2']) > 0) ||
        ($row['sd1'] == "" && $row['sd2'] != "")) /* class 1 is the rebuild */
    {
      $rbld_msg = "Rebuilt from <a href=" .$row['class2_hl']. ">" . $row['class2'] . "</a> to <a href=" .$row['class1_hl']. ">" . $row['class1'];
      $rebuild_date = $row['sd1'];
    }
    else /* class 1 is the donator */
    if (($row['sd1'] != "" && $row['sd2'] != "" && strcmp($row['sd1'], $row['sd2']) < 0) || 
        ($row['sd1'] != "" && $row['sd2'] == ""))
    {
      $rbld_msg = "Rebuilt from <a href=" .$row['class1_hl']. ">" . $row['class1'] . "</a> to <a href=" .$row['class2_hl']. ">" . $row['class2'];
      $rebuild_date = $row['sd2'];
    }
    else
      echo "Error";

    $last_lid = $lid;
  }

  /* Last one */
  if ($result)
  {
      if ($nx > 0)
      {
        /* Dump existing data */

        $rowx['number_b4']    = $number_b4;
        $rowx['number_prg']   = $number_prg;
        $rowx['number_br']    = $number_brops;
        $rowx['rbld_msg']     = $rbld_msg;
        $rowx['build_date']   = fn_fdate($build_date);
        $rowx['rebuild_date'] = fn_fdate($rebuild_date);

        $tb_rblds->dump_data($rowx);
      }

    if ($db->count_select())
      $tb_rblds->dump_data(NULL);
  }


?>