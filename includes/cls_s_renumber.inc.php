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

  $tb_renum->add_column("old_company",       "Company",           8);
  $tb_renum->add_column("old_number",        "Old Number",       10);
  $tb_renum->add_column("action",            "",                 12);
  $tb_renum->add_column("new_company",       "Company",           8);
  $tb_renum->add_column("new_number",        "New Number",       10);
  $tb_renum->add_column("subtype",           "Subtype",           8);
  $tb_renum->add_column("new_start_date_prd","",                  5);
  $tb_renum->add_column("new_start_date",    "Date",             11);
  $tb_renum->add_column("notes",             "Information",      28);

  
  $sql = 'select sn_new.company        AS new_company,
                 CASE WHEN sn_new.number_type = "PRG" THEN
                         "Pre Grouping"
                      WHEN sn_new.number_type = "BIG4" THEN
                         "Big Four"
                      WHEN sn_new.number_type = "WD" THEN
                         "War Department"
                      WHEN sn_new.number_type = "BR" THEN
                         "British Rail"
                      WHEN sn_new.number_type = "DP" THEN
                         "Departmental"
                      WHEN sn_new.number_type = "OS" THEN
                         "Other"
                      WHEN sn_new.number_type = "PVT" THEN
                         "Private"
                      ELSE
                         "Unknown"
                      END           AS new_num_type,
                 sn_new.subtype        AS subtype,
                 sn_old.company        AS old_company,
                 CASE WHEN sn_old.number_type = "PRG" THEN
                         "Pre Grouping"
                      WHEN sn_old.number_type = "BIG4" THEN
                         "Big Four"
                      WHEN sn_old.number_type = "WD" THEN
                         "War Department"
                      WHEN sn_old.number_type = "BR" THEN
                         "British Rail"
                      WHEN sn_old.number_type = "DP" THEN
                         "Departmental"
                      WHEN sn_old.number_type = "OS" THEN
                         "Other"
                      WHEN sn_old.number_type = "PVT" THEN
                         "Private"
                      ELSE
                         "Unknown"
                      END           AS old_num_type,
                 sn_new.number         AS new_number,
                 concat("locoqry.php?action=locodata&id=", sn_new.loco_id, "&type=S&loco=", sn_new.number)
                                    AS new_number_hl,
                 sn_old.number         AS old_number,
                 concat("locoqry.php?action=locodata&id=", sn_old.loco_id, "&type=S&loco=", sn_old.number)
                                    AS old_number_hl,
                 sn_new.prefix         AS new_prefix,
                 sn_old.prefix         AS old_prefix,
                 sn_new.suffix         AS new_suffix,
                 sn_old.suffix         AS old_suffix,
                 sn_new.by_flag        AS new_by_flag,
                 sn_new.start_date     AS new_start_date,
                 sn_new.start_date_prd AS new_start_date_prd,
                 sn_old.start_date     AS old_start_date,
                 sn_old.start_date_prd AS old_start_date_prd,
                 sn_new.notes          AS notes
          from   s_nums sn_new
          left join s_nums sn_old
          on     sn_old.loco_id = sn_new.loco_id
          and    sn_old.start_date = (select max(sn_olda.start_date)
                                   from   s_nums sn_olda
                                   where  sn_olda.loco_id = sn_old.loco_id
                                   and    sn_olda.carried_number = "Y"
                                   and    sn_olda.start_date < sn_new.start_date)
          where  sn_new.loco_id in
                (select distinct(loco_id)
                 from   s_class_link
                 where  s_class_id = ' . $id . ')
          and    sn_new.first_number = "N"
          and    sn_new.carried_number = "Y"
          order by sn_new.start_date, sn_old.number';

  $result = $db->execute($sql);

  if ($result)
  if ($db->count_select())
  {
	  while ($row = mysqli_fetch_assoc($result))
	  {
          $row['action'] = "renumbered to";
		  $row['old_start_date'] = fn_fdate($row['old_start_date']);
		  $row['new_start_date'] = fn_fdate($row['new_start_date']);
		  $row['new_start_date_prd'] = fn_prd($row['new_start_date_prd']);
		  if (!empty($row['old_prefix']))
		    $row['old_number'] = $row['old_prefix'] . $row['old_number'];
	          if (!empty($row['new_prefix']))
		    $row['new_number'] = $row['new_prefix'] . $row['new_number'];
	  	  if (!empty($row['old_suffix']))
		    $row['old_number'] = $row['old_number'] . $row['old_suffix'];
	          if (!empty($row['new_suffix']))
		    $row['new_number'] = $row['new_number'] . $row['new_suffix'];

    
		  $tb_renum->add_data($row);
	  }

      $tb_renum->draw_table();
      unset($tb_renum);
  }

  $file_cache->end_cache();

?>