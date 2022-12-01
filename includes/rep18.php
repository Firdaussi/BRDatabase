<?php
  include_once("lib/cache.class.php");
	/**
	 * call the class after the include
	 */
	$file_cache=new cache();
	$file_cache->start_cache();
        $db = fn_connectdb();

	$tb_rep = new MyTables("fires");

	$sql = 'SELECT d.loco_id lid,
                d.b_date,
                concat(date_format(d.b_date, "%Y%m%d"), d.loco_id) AS b_date_fmt,
                d.w_date,
                concat(date_format(d.w_date, "%Y%m%d"), d.loco_id) AS w_date_fmt,

                concat("D", dn.number)                                     AS first_number,
                concat("locoqry.php?action=locodata&id=", d.loco_id,
                       "&type=D&loco=", dn.number)                         AS first_number_hl,

                concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                                                           AS depot_code_hl,
                concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                                                           AS depot_name_hl,
                dp.depot_name                                              AS depot_name,
                dpc.depot_code                                             AS depot_code,
                df.fire_date,
                df.location,
                df.damage,
                df.details,
                df.extent,
                rft1.details   AS src_details,
                rft2.details   AS mat_details
                    
          FROM   diesels d

          JOIN   d_class_link dcl
          ON     dcl.loco_id = d.loco_id

          JOIN   d_class dc
          ON     dc.d_class_id = dcl.d_class_id
          
          JOIN   d_nums dn
          ON     dn.loco_id = d.loco_id
	  AND    dn.first_number = "Y"
	  
          JOIN   d_fires df
          ON     df.loco_id = d.loco_id
 
          JOIN   d_alloc da
          ON     da.loco_id = d.loco_id
	  AND    da.alloc_date = (SELECT max(da2a.alloc_date)
	                           FROM   d_alloc da2a
				   WHERE  da2a.loco_id = da.loco_id
				   AND    da2a.alloc_date <= df.fire_date)

          LEFT JOIN ref_depot_codes dpc
          ON     dpc.depot_code = da.allocation
          AND    dpc.date_from = (SELECT max(dpc2a.date_from)
                                  FROM   ref_depot_codes dpc2a
                                  WHERE  dpc2a.depot_code = da.allocation
                                  AND    dpc2a.date_from <= df.fire_date)
          LEFT JOIN ref_depot dp
          ON     dp.depot_id = dpc.depot_id
          
          JOIN   ref_fire_types rft1
          ON     rft1.type = "D"
          AND    rft1.source = df.source
          
          JOIN   ref_fire_types rft2
          ON     rft2.type = "D"
          AND    rft2.material = df.material

          ORDER BY df.fire_date';

// echo $sql;

	$result = $db->execute($sql);

	$tb_rep->add_caption("Incidents of fires on diesel locomotives, 1961-1964");
	$tb_rep->sortable();

	$tb_rep->add_column("first_number",    "Number",                6);
	$tb_rep->add_column("b_date",          "Date To Service",       8);
	$tb_rep->add_column("fire_date",       "Date of fire",          8);
	$tb_rep->add_column("extent",          "Severity",             10);
        $tb_rep->add_column("src_details",     "Source",               15);
        $tb_rep->add_column("mat_details",     "Material involved",    15);
        $tb_rep->add_column("location",        "Location",             12);
	$tb_rep->add_column("damage",          "Damage",               13);
        $tb_rep->add_column("details",         "Details",              13);
	
  $result = $db->execute($sql) or die("Failed to run query");

  //echo "Records: " . $db->count_select() . "<br />";

  while ($row = mysqli_fetch_assoc($result))
  {
    if ($row['extent'] == 'U')
      $row['extent'] = "Unknown";
    else
    if ($row['extent'] == 'N')
      $row['extent'] = "Not severe";
    else
    if ($row['extent'] == 'S')
      $row['extent'] = "Works attention required";
      
    $row['b_date'] = fn_fdate($row['b_date']);
    $row['w_date'] = fn_fdate($row['w_date']);
    $row['fire_date'] = fn_fdate($row['fire_date']);
    $row['number'] = fn_d_pfx($row['number']);
    $tb_rep->add_data($row);
  }

  $tb_rep->draw_table();

  unset($row); unset($tb_rep);
?>
