<?php

/***********************************************************************************************/
/*                                                                                             */
/* Stage 0: Preliminaries - set up tables and work out parameters                              */
/*                                                                                             */
/***********************************************************************************************/

  include_once("lib/brlib.php");
  include_once("lib/MyTables.class.php");

  $tb_names = new MyTables("name_data");
  $tb_names->sortable();

  $tb_names->add_column("identifier",     "Class",           8);
  $tb_names->add_column("number",         "Number",          8);
  $tb_names->add_column("b_date",         "Built",           8);
  $tb_names->add_column("name",           "Name",           22);
  $tb_names->add_column("start_date",     "Name Date",       8);
  $tb_names->add_column("notes",          "Notes",          30);
  $tb_names->add_column("end_date",       "Removed",         8);
  $tb_names->add_column("w_date",         "Date Withdrawn",  8);

/***********************************************************************************************/
/*                                                                                             */
/* Stage 1: Get all locomotives from this class                                                */
/*                                                                                             */
/***********************************************************************************************/

  $sql  = 'SELECT d.loco_id lid,
                  d.b_date,
                  date_format(d.b_date, "%Y%m%d")             AS b_date_fmt,
                  d.w_date,
                  date_format(d.w_date, "%Y%m%d")             AS w_date_fmt,
                  coalesce(dc.common_name, dc.identifier)     AS identifier,
                  dnm.name,
                  concat("names.php?id=", dnm.e_name_id, "&amp;type=E")
                                                              AS name_hl,
                  dnm.start_date,
                  dnm.end_date,
                  dnm.notes,
                  dn.number,
                  concat("locoqry.php?action=locodata&id=", dn.loco_id,"&type=E&loco=", dn.number)
                                                              AS number_hl

           FROM   e_name dnm

           JOIN   electric d
           ON     dnm.loco_id = d.loco_id

           JOIN   e_class_link dcl
           ON     dcl.loco_id = d.loco_id

           JOIN   e_class dc
           ON     dc.e_class_id = dcl.e_class_id

           JOIN   e_nums dn
           ON     dn.loco_id = d.loco_id
           AND    dn.start_date = (SELECT max(dn1.start_date)
                                   FROM   e_nums dn1
                                   WHERE  dn1.loco_id = dn.loco_id
                                   AND    dn1.carried_number = "Y"
                                   AND    dn1.start_date <= dnm.start_date)
           AND    dn.carried_number = "Y"

           WHERE  dcl.e_class_id = ' . $id . '

           ORDER BY d.loco_id, dnm.start_date';

  $result = $db->execute($sql);

  if ($result)
  if ($db->count_select())
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['start_date'] = fn_fdate($row['start_date']);
      $row['end_date'] = fn_fdate($row['end_date']);
      $row['b_date'] = fn_fdate($row['b_date']);
      $row['w_date'] = fn_fdate($row['w_date']);

      $tb_names->add_data($row);
    }
  }

  if ($result) mysqli_free_result($result);

/***************************************************/
/* Show table                                      */
/***************************************************/

  if ($db->count_select())
    $tb_names->draw_table();

?>