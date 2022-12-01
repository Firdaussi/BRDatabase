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

  $tb_renum->add_column("old_number",        "Old Number",       12);
  $tb_renum->add_column("old_company",       "Company",           8);
  $tb_renum->add_column("old_num_type",      "Old Num Type",      8);
  $tb_renum->add_column("new_number",        "New Number",       12);
  $tb_renum->add_column("new_company",       "Company",           8);
  $tb_renum->add_column("subtype",           "Subtype",           8);
  $tb_renum->add_column("new_num_type",      "New Num Type",      8);
  $tb_renum->add_column("new_start_date_prd","",                  5);
  $tb_renum->add_column("new_start_date",    "Date",             18);
  
  $sql = 'select en1.company        AS new_company,
                 CASE WHEN en1.number_type = "PRG" THEN
                         "Pre Grouping"
                      WHEN en1.number_type = "BIG4" THEN
                         "Big Four"
                      WHEN en1.number_type = "PRT" THEN
                         "Pre TOPS"
                      WHEN en1.number_type = "BR" THEN
                         "British Rail"
                      WHEN en1.number_type = "TOPS" THEN
                         "TOPS"
                      WHEN en1.number_type = "OS" THEN
                         "Other"
                      WHEN en1.number_type = "PN" THEN
                         "Post Nationalisation"
                      WHEN en1.number_type = "DP" THEN
                         "Departmental"
                      ELSE
                         "Unknown"
                      END           AS new_num_type,
                 en1.subtype        AS subtype,
                 en2.company        AS old_company,
                 CASE WHEN en2.number_type = "PRG" THEN
                         "Pre Grouping"
                      WHEN en2.number_type = "BIG4" THEN
                         "Big Four"
                      WHEN en2.number_type = "PRT" THEN
                         "Pre TOPS"
                      WHEN en2.number_type = "BR" THEN
                         "British Rail"
                      WHEN en2.number_type = "TOPS" THEN
                         "TOPS"
                      WHEN en2.number_type = "OS" THEN
                         "Other"
                      WHEN en2.number_type = "PN" THEN
                         "Post Nationalisation"
                      WHEN en2.number_type = "DP" THEN
                         "Departmental"
                      ELSE
                         "Unknown"
                 END                AS old_num_type,
                 en1.number         AS new_number,
                 concat("locoqry.php?action=locodata&id=", en1.loco_id, "&type=E&loco=", en1.number)
                                    AS new_number_hl,
                 en2.number         AS old_number,
                 concat("locoqry.php?action=locodata&id=", en2.loco_id, "&type=E&loco=", en2.number)
                                    AS old_number_hl,
                 en1.start_date     AS new_start_date,
                 en1.start_date_prd AS new_start_date_prd,
                 en2.start_date     AS old_start_date,
                 en2.start_date_prd AS old_start_date_prd
          from   e_nums en1
          left join e_nums en2
          on     en2.loco_id = en1.loco_id
          and    en2.start_date = (select max(en2a.start_date)
                                   from   e_nums en2a
                                   where  en2a.loco_id = en2.loco_id
                                   and    en2a.carried_number = "Y"
                                   and    en2a.start_date < en1.start_date)
          where  en1.loco_id in
                (select distinct(loco_id)
                 from   e_class_link
                 where  e_class_id = ' . $id . ')
          and    en1.first_number = "N"
          and    en1.carried_number = "Y"
          order by en1.start_date';

  $result = $db->execute($sql);

  if ($result)
  if ($db->count_select())
  {
	  while ($row = mysqli_fetch_assoc($result))
	  {
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