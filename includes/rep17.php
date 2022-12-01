<?php
  include_once("lib/cache.class.php");
	/**
	 * call the class after the include
	 */
	$file_cache=new cache();
	$file_cache->start_cache();
        $db = fn_connectdb();

	$tb_rep = new MyTables("Mirrlees");

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

                concat("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                                                           AS depot_code_reeng_hl,
                concat("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                                                           AS depot_name_reeng_hl,
                dp2.depot_name                                             AS depot_name_reeng,
                dpc2.depot_code                                            AS depot_code_reeng,
                dcl.start_date                                             AS dcl_start_date,
                dcl.start_date_prd                                         AS dcl_start_date_prd,
                date_format(dcl.start_date, "%Y%m%s")                      AS dcl_start_date_fmt,
                
                round(datediff(case date_format(dcl.start_date, "%d")
                    when 0 then date_format(concat(date_format(dcl.start_date, "%Y-%m-"),
                          "15"), "%Y-%m-%d")
                    else dcl.start_date 
                    END,
                    case date_format(d.b_date, "%d")
                    when 0 then date_format(concat(date_format(d.b_date, "%Y-%m-"),
                          "15"), "%Y-%m-%d")
                    else d.b_date 
                    END) /365, 2)                                          AS tf_man,

                round(datediff(case date_format(d.w_date, "%d")
                    when 0 then date_format(concat(date_format(d.w_date, "%Y-%m-"),
                          "15"), "%Y-%m-%d")
                    else d.w_date
                    END,
                    case date_format(dcl.start_date, "%d")
                    when 0 then date_format(concat(date_format(dcl.start_date, "%Y-%m-"),
                          "15"), "%Y-%m-%d")
                    else dcl.start_date 
                    END) /365, 2)                                          AS tf_paxman
                    
          FROM   diesels d

          JOIN   d_class_link dcl
          ON     dcl.loco_id = d.loco_id
          AND    dcl.d_class_id = 27

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

          LEFT JOIN d_alloc da2
          ON     da2.loco_id = d.loco_id
	  AND    da2.alloc_date = (SELECT max(da2a.alloc_date)
	                           FROM   d_alloc da2a
				   WHERE  da2a.loco_id = da2.loco_id
				   AND    da2a.alloc_date <= dcl.start_date)

          LEFT JOIN ref_depot_codes dpc2
          ON     dpc2.depot_code = da2.allocation
          AND    dpc2.date_from = (SELECT max(dpc2a.date_from)
                                   FROM   ref_depot_codes dpc2a
                                   WHERE  dpc2a.depot_code = da2.allocation
                                   AND    dpc2a.date_from <= dcl.start_date)
          LEFT JOIN ref_depot dp2
          ON     dp2.depot_id = dpc2.depot_id

          ORDER BY d.loco_id';

//  echo $sql;

	$result = $db->execute($sql);

	$tb_rep->add_caption("Re-engineering of NBL Type 2's - MAN to Paxman");
	$tb_rep->sortable();

	$tb_rep->add_column("first_number",    "Number",                6);
	$tb_rep->add_column("b_date",          "Date To Service",       8);
	$tb_rep->add_column("depot_name_new",  "Depot When New",       11);
	$tb_rep->add_column("dcl_start_date",  "Re-Engined",           11);
	$tb_rep->add_column("tf_man",          "Time fitted with a MAN engine", 11);
        $tb_rep->add_column("tf_paxman",       "Time fitted with a Paxman engine", 11);
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
    $row['dcl_start_date'] = fn_fdate($row['dcl_start_date']);
    $row['number'] = fn_d_pfx($row['number']);
    $tb_rep->add_data($row);
  }

  $tb_rep->draw_table();

  unset($row); unset($tb_rep);
?>
