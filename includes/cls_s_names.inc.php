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

  $sql  = 'SELECT s.loco_id lid,
                  s.b_date,
                  date_format(s.b_date, "%Y%m%d")             AS b_date_fmt,
                  s.w_date,
                  date_format(s.w_date, "%Y%m%d")             AS w_date_fmt,
                  coalesce(sc.common_name, sc.identifier)     AS identifier,
                  snm.name,
                  concat("names.php?id=", snm.s_name_id, "&amp;type=S")
                                                              AS name_hl,
                  snm.start_date,
                  snm.end_date,
                  snm.notes,
                  sn.number,
                  concat("locoqry.php?action=locodata&id=", sn.loco_id,"&type=S&loco=", sn.number)
                                                              AS number_hl

           FROM   s_name snm

           JOIN   steam s
           ON     snm.loco_id = s.loco_id

           JOIN   s_class_link scl
           ON     scl.loco_id = s.loco_id
           AND    scl.start_date = (SELECT max(scl1.start_date)
                                    FROM   s_class_link scl1
                                    WHERE  scl1.loco_id = scl.loco_id
                                    AND    
                                           (scl1.start_date <= snm.start_date
                                                OR
                                             (snm.start_date < s.b_date
                                                 AND
                                              scl.first_class_flag = "Y")))

           JOIN   s_class sc
           ON     sc.s_class_id = scl.s_class_id

           JOIN   s_nums sn
           ON     sn.loco_id = s.loco_id
           AND    sn.start_date = (SELECT max(sn1.start_date)
                                   FROM   s_nums sn1
                                   WHERE  sn1.loco_id = sn.loco_id
                                   AND    sn1.carried_number = "Y"
                                   AND   (sn1.start_date <= snm.start_date
                                             OR
                                            (snm.start_date < sn1.start_date
                                               AND
                                             sn1.first_number = "Y")))
           AND    sn.carried_number = "Y"

           WHERE  scl.s_class_id = ' . $id . '

           ORDER BY s.loco_id, snm.start_date';

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