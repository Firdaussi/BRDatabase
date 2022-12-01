<?php
  include_once("lib/cache.class.php");
	/**
	 * call the class after the include
	 */
	$file_cache=new cache();
	$file_cache->start_cache();
        $db = fn_connectdb();

	$tb_rep = new MyTables("hydraulics");

	$sql = 'SELECT d.loco_id lid,
		       d.b_date,
                       concat(date_format(d.b_date, "%Y%m%d"), d.loco_id) AS b_date_fmt,
                       d.w_date,
                       concat(date_format(d.w_date, "%Y%m%d"), d.loco_id) AS w_date_fmt,
                       concat(sm.merchant_name, " (", sy.location, ")")           AS sc_name,
                       concat("sites.php?page=scrapyards&action=query&id=", d.scrapyard_code) 
                                                                                  AS sc_name_hl,
                       d.s_date,
                       date_format(d.s_date, "%Y%m%s")                            AS s_date_fmt,
                       d.preserved,
                       concat("locoqry.php?action=locodata&id=",d.loco_id,
                              "&type=D&loco=", dn.number)                         AS number_hl,
                       dn.number,
                       concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                                                                  AS depot_code_new_hl,
                       concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                                                                  AS depot_name_new_hl,
                       dp1.depot_name                                             AS depot_name_new,
                       dc1.depot_code                                             AS depot_code_new,
                       concat("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                                                                  AS depot_code_wdn_hl,
                       concat("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                                                                  AS depot_name_wdn_hl,
                       dp2.depot_name                                             AS depot_name_wdn,
                       dc2.depot_code                                             AS depot_code_wdn,
                       dnm.name,
                       bd.bl_name,
                       dn.company,
                       dn.subtype,
                       dn.carried_number,
                       d.last_depot,
                       dcl.d_class_id,
                       dc.identifier,
                       concat("locoqry.php?action=class&amp;type=D&amp;id=",dc.d_class_id) 
                                                                                  AS identifier_hl,
                       round(datediff(case date_format(d.w_date, "%d")
                             when 0 then date_format(concat(date_format(d.w_date, "%Y-%m-"),
                                   "15"), "%Y-%m-%d")
                             else d.w_date 
                             END,
                             case date_format(d.b_date, "%d")
                             when 0 then date_format(concat(date_format(d.b_date, "%Y-%m-"),
                                   "15"), "%Y-%m-%d")
                             else d.b_date 
                             END) /365, 2)                                        AS service_prd,
                       round(datediff(case date_format(d.s_date, "%d")
                             when 0 then date_format(concat(date_format(d.s_date, "%Y-%m-"),
                                   "15"), "%Y-%m-%d")
                             else d.s_date
                             END,
                             case date_format(d.w_date, "%d")
                             when 0 then date_format(concat(date_format(d.w_date, "%Y-%m-"),
                                   "15"), "%Y-%m-%d")
                             else d.w_date 
                             END) /365, 2)                                       AS cond_prd,
                       round(datediff(case date_format(coalesce(d.s_date, curdate()), "%d")
                             when 0 then date_format(concat(date_format(coalesce(d.s_date,
                                    curdate()), "%Y-%m-"),
                                   "15"), "%Y-%m-%d")
                             else coalesce(d.s_date, curdate())
                             END,
                             case date_format(d.b_date, "%d")
                             when 0 then date_format(concat(date_format(d.b_date, "%Y-%m-"),
                                   "15"), "%Y-%m-%d")
                             else d.b_date 
                             END) /365, 2)                                       AS tot_age
             
                FROM   diesels d

                LEFT JOIN d_nums dn
                ON     dn.loco_id = d.loco_id

                LEFT JOIN ref_scrapyard sy
                ON     sy.scrapyard_code = d.scrapyard_code

                LEFT JOIN ref_scrap_merchant sm
                ON     sm.merchant_code = substr(sy.scrapyard_code, 1, 3)

                LEFT JOIN ref_builders bd
                ON     bd.bl_code = d.bl_code

                LEFT JOIN d_alloc da
                ON     da.loco_id = d.loco_id
                AND    da.alloc_flag = "N"

                LEFT JOIN ref_depot_codes dc1
                ON     dc1.depot_code = da.allocation
                AND    dc1.date_from = (SELECT max(dc1a.date_from)
                                        FROM   ref_depot_codes dc1a
                                        WHERE  dc1a.depot_code = da.allocation
                                        AND    dc1a.date_from <= da.alloc_date)
                LEFT JOIN ref_depot dp1
                ON     dp1.depot_id = dc1.depot_id

                LEFT JOIN ref_depot_codes dc2
                ON     dc2.depot_code = ifnull(d.last_depot, d.last_depot_bak)
                AND    dc2.date_from = (SELECT max(dc2a.date_from)
                                        FROM   ref_depot_codes dc2a
                                        WHERE  dc2a.depot_code = ifnull(d.last_depot, d.last_depot_bak)
                                        AND    dc2a.date_from <= d.w_date)
                LEFT JOIN ref_depot dp2
                ON     dp2.depot_id = dc2.depot_id

                LEFT JOIN d_name dnm
                ON     dnm.loco_id = d.loco_id

                JOIN   d_class_link dcl
                ON     dcl.loco_id = d.loco_id
                AND    dcl.d_class_id in (14, 20, 31, 76, 34, 35, 42)

                JOIN   d_class dc
                ON     dc.d_class_id = dcl.d_class_id

                ORDER BY d.loco_id, da.alloc_date';

//  echo $sql;

	$result = $db->execute($sql);

	$tb_rep->add_caption("Western Region Mainline Diesel Hydraulics");
	$tb_rep->sortable();

	$tb_rep->add_column("identifier",      "Class",                 6);
	$tb_rep->add_column("number",          "Number",                6);
	$tb_rep->add_column("b_date",          "Date To Service",       8);
	$tb_rep->add_column("depot_name_new",  "Depot When New",       11);
	$tb_rep->add_column("w_date",          "Date Withdrawn",        8);
	$tb_rep->add_column("depot_name_wdn",  "Depot Withdrawn From", 11);
	$tb_rep->add_column("service_prd",     "Svc Age (Yrs)",         5);
	$tb_rep->add_column("fate",            "Fate",                  3);
	$tb_rep->add_column("sc_name",         "Where",                11);
	$tb_rep->add_column("when",            "When",                  8);
	$tb_rep->add_column("tot_age",         "Tot Age (Yrs)",         4);
	$tb_rep->add_column("name",            "Name",                 15);

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
