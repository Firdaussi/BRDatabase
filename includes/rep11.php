<?php
  include_once("lib/cache.class.php");
	/**
	 * call the class after the include
	 */
	$file_cache=new cache();
	$file_cache->start_cache();
        $db = fn_connectdb();

	$tb_rep = new MyTables("westernliveries");

	$sql = 'SELECT d.loco_id lid,
                d.b_date,
                concat(date_format(d.b_date, "%Y%m%d"), d.loco_id) AS b_date_fmt,
                d.w_date,
                concat(date_format(d.w_date, "%Y%m%d"), d.loco_id) AS w_date_fmt,

                dn.number,
                concat("locoqry.php?action=locodata&id=", d.loco_id,
                       "&type=D&loco=", dn.number)                         AS number_hl,

                dpc.depot_code,
                concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                                                           AS depot_code_hl,
                dp.depot_name,
                concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                                                           AS depot_name_hl,
                d2l.start_date                                             AS livery_date,
	        l.description                                              AS livery_description,
                dnm.name

          FROM   diesels d

	  JOIN d_to_livery d2l
	  ON   d2l.loco_id = d.loco_id

	  JOIN ref_livery l
	  ON   l.livery_id = d2l.livery_id

	  JOIN   d_nums dn
          ON     dn.loco_id = d.loco_id

          LEFT JOIN d_alloc da
          ON     da.loco_id = d.loco_id
	  AND    da.alloc_date = (SELECT max(daa.alloc_date)
	                          FROM   d_alloc daa
				  WHERE  daa.loco_id = da.loco_id
				  AND    daa.alloc_date <= d2l.start_date)

          LEFT JOIN ref_depot_codes dpc
          ON     dpc.depot_code = da.allocation
          AND    dpc.date_from = (SELECT max(dpca.date_from)
                                  FROM   ref_depot_codes dpca
                                  WHERE  dpca.depot_code = da.allocation
                                  AND    dpca.date_from <= d2l.start_date)
          LEFT JOIN ref_depot dp
          ON     dp.depot_id = dpc.depot_id

          LEFT JOIN d_name dnm
          ON     dnm.loco_id = d.loco_id

	  WHERE d.first_class_id = 42

          ORDER BY d.loco_id';

//  echo $sql;

	$result = $db->execute($sql);

	$tb_rep->add_caption("Class 52 Diesel Hydraulic Liveries");
	$tb_rep->sortable();

	$tb_rep->add_column("number",             "Number",                6);
	$tb_rep->add_column("livery_date",        "Livery Applied",        8);
        $tb_rep->add_column("livery_description", "Livery",               28);
	$tb_rep->add_column("depot_name",         "Depot",                11);
	$tb_rep->add_column("name",               "Name",                 15);

  $result = $db->execute($sql) or die("Failed to run query");

  //echo "Records: " . $db->count_select() . "<br />";

  while ($row = mysqli_fetch_assoc($result))
  {
    $row['livery_date'] = fn_fdate($row['livery_date']);
    $row['number'] = fn_d_pfx($row['number']);
    $tb_rep->add_data($row);
  }

  $tb_rep->draw_table();

  unset($row); unset($tb_rep);
?>
