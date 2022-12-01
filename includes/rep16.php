<?php
  include_once("lib/cache.class.php");
	/**
	 * call the class after the include
	 */
	$file_cache=new cache();
	$file_cache->start_cache();
        $db = fn_connectdb();

	$tb_rep = new MyTables("Route_Indicators");

	$sql = 'SELECT d.loco_id lid,
                d.b_date,
                concat(date_format(d.b_date, "%Y%m%d"), d.loco_id) AS b_date_fmt,
                d.w_date,
                concat(date_format(d.w_date, "%Y%m%d"), d.loco_id) AS w_date_fmt,

                concat("D", dn.number)                                     AS first_number,
                concat("locoqry.php?action=locodata&id=", d.loco_id,
                       "&type=D&loco=", dn.number)                         AS first_number_hl,

                concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                                                           AS depot_code_new_hl,
                concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                                                           AS depot_name_new_hl,
                dp1.depot_name                                             AS depot_name_new,
                dpc1.depot_code                                            AS depot_code_new,
                d.info
                
          FROM   diesels d

          JOIN   d_nums dn
          ON     dn.loco_id = d.loco_id
	  AND    dn.first_number = "Y"

          LEFT JOIN ref_depot_codes dpc1
          ON     dpc1.depot_code = d.first_depot
          AND    dpc1.date_from = (SELECT max(dpc1a.date_from)
                                   FROM   ref_depot_codes dpc1a
                                   WHERE  dpc1a.depot_code = d.first_depot
                                   AND    dpc1a.date_from <= d.b_date)
          LEFT JOIN ref_depot dp1
          ON     dp1.depot_id = dpc1.depot_id
          
          WHERE d.first_class_id = 28

          ORDER BY d.loco_id';

//  echo $sql;

	$result = $db->execute($sql);

	$tb_rep->add_caption("Re-engineering of Brush Type 2's - Mirrlees to E.E.");
	$tb_rep->sortable();

	$tb_rep->add_column("first_number",    "Number",                6);
	$tb_rep->add_column("b_date",          "Date To Service",       8);
	$tb_rep->add_column("depot_name_new",  "Depot When New",       11);
	$tb_rep->add_column("info",            "Info",                 48);
	$tb_rep->add_column("w_date",          "Date Withdrawn",        8);
	$tb_rep->add_column("depot_name_wdn",  "Depot Withdrawn From", 11);
	$tb_rep->add_column("service_prd",     "Svc Age (Yrs)",         5);
	$tb_rep->add_column("fate",            "Fate",                  3);
	
  $result = $db->execute($sql) or die("Failed to run query");

  //echo "Records: " . $db->count_select() . "<br />";

  while ($row = mysqli_fetch_assoc($result))
  {
    $row['b_date'] = fn_fdate($row['b_date']);
    $row['w_date'] = fn_fdate($row['w_date']);
    $row['number'] = fn_d_pfx($row['number']);
    $tb_rep->add_data($row);
  }

  $tb_rep->draw_table();

  unset($row); unset($tb_rep);
?>
