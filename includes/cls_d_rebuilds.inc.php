<?php
  include_once("lib/MyTables.class.php");
  include_once("lib/brlib.php");

  // Determine what other classes have been rebuilt to/from the current one ($id)

  $sql = 'SELECT distinct d_class_id
          FROM   d_class_link
          WHERE  d_class_id != ' .$id. ' 
          AND    loco_id IN (SELECT loco_id 
                             FROM   d_class_link 
                             WHERE  d_class_id = ' .$id. ')';
                           
  $result = $db->execute($sql);

  $n_classes = $db->count_select();

  if ($n_classes == 0)
  {
    printf("Error - no rebuilds found<br />\n");
    die();
  }

  $tb_rblds = new MyTables("fleet_data");
  $tb_rblds->sortable();
  $tb_rblds->allow_rollover();

  $tb_rblds->add_column("number_pt",      "Pre-TOPS",      8);
  $tb_rblds->add_column("number_t",       "TOPS",          8);
  $tb_rblds->add_column("rbld_msg",       "Rebuild",      25);
  $tb_rblds->add_column("rebuild_date",   "Rebuild Date", 11);
  $tb_rblds->add_column("notes",          "Notes",        48);

  $nx = 0;
  while ($row = mysqli_fetch_assoc($result))
  {
    if ($nx == 0)
      $class_list = $row['d_class_id'];
    else
      $class_list .= "," . $row['d_class_id'];

    $nx++;
  }

  $sql = 'SELECT dc1.identifier       AS class1,
                 concat("locoqry.php?action=class&type=D&id=",dc1.d_class_id) AS class1_hl,
                 dcl1.loco_id,
                 dcl1.d_class_id,
                 dcl1.start_date      AS sd1,
                 date_format(dcl1.start_date, "%Y%m%d") AS sd1_fmt,
                 dc2.identifier       AS class2,
                 concat("locoqry.php?action=class&type=D&id=",dc2.d_class_id) AS class2_hl,
                 dcl2.d_class_id,
                 dcl2.start_date      AS sd2,
                 date_format(dcl2.start_date, "%Y%m%d") AS sd2_fmt,
                 dn.number_type,
                 dn.number,
                 concat("locoqry.php?action=locodata&id=",dn.loco_id,"&type=D&loco=",dn.number) 
                                                            AS number_pt_hl,
				         concat("locoqry.php?action=locodata&id=",dn.loco_id,"&type=D&loco=",dn.number) 
                                                            AS number_t_hl,
                 case when dn.number_type = "PRG"  THEN 1
                      when dn.number_type = "PN"   THEN 2
                      when dn.number_type = "PRT"  THEN 3
                      when dn.number_type = "TOPS" THEN 4
                      when dn.number_type = "DP"   THEN 5
                 end AS idx
          FROM   d_class_link dcl1
          JOIN   d_class_link dcl2
          ON     dcl1.loco_id = dcl2.loco_id
          AND    dcl1.d_class_id = ' .$id. '
          AND    dcl2.d_class_id IN (' .$class_list. ')
          JOIN   d_nums dn
          ON     dn.loco_id = dcl1.loco_id
          JOIN   d_class dc1
          ON     dc1.d_class_id = dcl1.d_class_id
          JOIN   d_class dc2
          ON     dc2.d_class_id = dcl2.d_class_id
          ORDER BY dcl1.loco_id, dcl1.start_date, idx, dn.start_date';

  $result = $db->execute($sql);

  $lid = 0; $nx = 0; $last_id = 0;
  while ($row = mysqli_fetch_assoc($result))
  {
    $nx++;
    $lid = $row['loco_id'];

    if ($lid != $last_lid && $last_lid != 0)
    {
      /* Dump existing data */

        $rowx['number_pt'] = $number_prt;
        $rowx['number_t']  = $number_tops;
        $rowx['rbld_msg']  = $rbld_msg;
        $rowx['rebuild_date'] = fn_fdate($rebuild_date);
        $rowx['rebuild_date_fmt'] = $rebuild_date_fmt;

        $number_tops = $number_prt = "";

        $tb_rblds->add_data($rowx);
    }

    $rowx = $row;

    if ($row['number_type'] == "PRT")
      $number_prt = fn_d_pfx($row['number']);
    else
    if ($row['number_type'] == "TOPS")
    {
      if ($number_tops != "")
        $number_tops .= "<br />" . $row['number'];
      else
        $number_tops = $row['number'];
    }

    if (($row['sd1'] != "" && $row['sd2'] != "" && strcmp($row['sd1'], $row['sd2']) > 0) ||
        ($row['sd1'] == "" && $row['sd2'] != "")) /* class 1 is the rebuild */
    {
      $rbld_msg = "Rebuilt from <a href=" .$row['class2_hl']. ">" . $row['class2'] . "</a> to <a href=" .$row['class1_hl']. ">" . $row['class1'];
      $rebuild_date = $row['sd1'];
      $rebuild_date_fmt = $row['sd1_fmt'];
    }
    else /* class 1 is the donator */
    if (($row['sd1'] != "" && $row['sd2'] != "" && strcmp($row['sd1'], $row['sd2']) < 0) || 
        ($row['sd1'] != "" && $row['sd2'] == ""))
    {
      $rbld_msg = "Rebuilt from <a href=" .$row['class1_hl']. ">" . $row['class1'] . "</a> to <a href=" .$row['class2_hl']. ">" . $row['class2'];
      $rebuild_date = $row['sd2'];
      $rebuild_date_fmt = $row['sd2_fmt'];
    }

    $last_lid = $lid;
  }

  /* Last one */
  if ($nx > 0)
  {
    /* Dump existing data */

    $rowx['number_pt'] = $number_prt;
    $rowx['number_t']  = $number_tops;
    $rowx['rbld_msg']  = $rbld_msg;
    $rowx['rebuild_date'] = fn_fdate($rebuild_date);
    $rowx['rebuild_date_fmt'] = $rebuild_date_fmt;

    $number_tops = $number_prt = "";

    $tb_rblds->add_data($rowx);
  }

  $tb_rblds->draw_table();
?>