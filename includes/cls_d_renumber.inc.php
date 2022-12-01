<?php
  include_once("lib/MyTables.class.php");
  include_once("lib/brlib.php");
  include_once("lib/cache.class.php");
  /**
   * call the class after the include
   */
  $file_cache=new cache();
  $file_cache->start_cache();

  $tb_renum = new MyTables("renum_data");

  $tb_renum->add_column("old_number",        "Old Number",        8);
  $tb_renum->add_column("old_company",       "Company",           8);
  $tb_renum->add_column("old_num_type",      "Old Num Type",      8);
  $tb_renum->add_column("new_number",        "New Number",        8);
  $tb_renum->add_column("new_company",       "Company",           8);
  $tb_renum->add_column("subtype",           "Subtype",           8);
  $tb_renum->add_column("new_num_type",      "New Num Type",      8);
  $tb_renum->add_column("new_start_date_prd","",                  5);
  $tb_renum->add_column("new_start_date",    "Date",             10);
  $tb_renum->add_column("notes",             "Notes",            20);
  
  $sql = 'select dn1.company        AS new_company,
                 CASE WHEN dn1.number_type = "PRG" THEN
                         "Pre Grouping"
                      WHEN dn1.number_type = "BIG4" THEN
                         "Big Four"
                      WHEN dn1.number_type = "PRT" THEN
                         "Pre TOPS"
                      WHEN dn1.number_type = "BR" THEN
                         "British Rail"
                      WHEN dn1.number_type = "TOPS" THEN
                         "TOPS"
                      WHEN dn1.number_type = "OS" THEN
                         "Other"
                      WHEN dn1.number_type = "PN" THEN
                         "Post Nationalisation"
                      WHEN dn1.number_type = "DP" THEN
                         "Departmental"
                      ELSE
                         "Unknown"
                      END           AS new_num_type,
                 dn1.subtype        AS subtype,
                 dn2.company        AS old_company,
                 CASE WHEN dn2.number_type = "PRG" THEN
                         "Pre Grouping"
                      WHEN dn2.number_type = "BIG4" THEN
                         "Big Four"
                      WHEN dn2.number_type = "PRT" THEN
                         "Pre TOPS"
                      WHEN dn2.number_type = "BR" THEN
                         "British Rail"
                      WHEN dn2.number_type = "TOPS" THEN
                         "TOPS"
                      WHEN dn2.number_type = "OS" THEN
                         "Other"
                      WHEN dn2.number_type = "PN" THEN
                         "Post Nationalisation"
                      WHEN dn2.number_type = "DP" THEN
                         "Departmental"
                      ELSE
                         "Unknown"
                 END                AS old_num_type,
                 dn1.number         AS new_number,
                 concat("locoqry.php?action=locodata&id=", dn1.loco_id, "&type=D&loco=", dn1.number)
                                    AS new_number_hl,
                 dn2.number         AS old_number,
                 concat("locoqry.php?action=locodata&id=", dn2.loco_id, "&type=D&loco=", dn2.number)
                                    AS old_number_hl,
                 dn1.start_date     AS new_start_date,
                 dn1.start_date_prd AS new_start_date_prd,
                 dn2.start_date     AS old_start_date,
                 dn2.start_date_prd AS old_start_date_prd,
                 dn1.notes          AS notes
          from   d_nums dn1
          left join d_nums dn2
          on     dn2.loco_id = dn1.loco_id
          and    dn2.start_date = (select max(dn2a.start_date)
                                   from   d_nums dn2a
                                   where  dn2a.loco_id = dn2.loco_id
                                   and    dn2a.carried_number = "Y"
                                   and    dn2a.start_date < dn1.start_date)
          where  dn1.loco_id in
                (select distinct(loco_id)
                 from   d_class_link
                 where  d_class_id = ' . $id . ')
          and    dn1.first_number = "N"
          and    dn1.carried_number = "Y"
          order by dn1.start_date';

  $result = $db->execute($sql);

  if ($result)
  if ($db->count_select())
  {
	  while ($row = mysqli_fetch_assoc($result))
	  {
	      if ($row['new_num_type'] == "Pre TOPS")
	          $row['new_number'] = fn_d_pfx($row['new_number']);
	          
	      if ($row['old_num_type'] == "Pre TOPS")
	          $row['old_number'] = fn_d_pfx($row['old_number']);
	          
		  $row['old_start_date'] = fn_fdate($row['old_start_date']);
		  $row['new_start_date'] = fn_fdate($row['new_start_date']);
		  $row['new_start_date_prd'] = fn_prd($row['new_start_date_prd']);

		  $tb_renum->add_data($row);
	  }

      $tb_renum->draw_table();
      unset($tb_renum);
  }

  $file_cache->end_cache();

?>