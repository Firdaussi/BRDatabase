<?php
  include_once("lib/brlib.php");

/***********************************************************************************************/
/*                                                                                             */
/* Stage 0: Preliminaries - set up tables and work out parameters                              */
/*                                                                                             */
/***********************************************************************************************/

  include_once("lib/MyTables.class.php");

  $tb_d2d = new MyTables("d2d_data");
  $tb_d2d->sortable();

  $tb_d2d->add_column("sdate_of_incident", "Date",            12);
  $tb_d2d->add_column("number",            "Number (at time)", 8);
  $tb_d2d->add_column("allocation",        "Depot (at time)",  5);
  $tb_d2d->add_column("reporting_number",  "Code",             5);
  $tb_d2d->add_column("verbose_details",   "Details",         56);
  $tb_d2d->add_column("reference",         "Ref",             10);
  $tb_d2d->add_column("link",              "Link",             4);

/***********************************************************************************************/
/*                                                                                             */
/* Stage 1: Get all locomotives from this class                                                */
/*                                                                                             */
/***********************************************************************************************/

  $sql = 'SELECT d.loco_id lid,
                 d.b_date,
                 concat(date_format(d.b_date, "%Y%m%d"), lpad(d.loco_id, 10, "0"))
                                                         AS b_date_fmt,
                 d.w_date,
                 concat(date_format(d.w_date, "%Y%m%d"), lpad(d.loco_id, 10, "0"))
                                                         AS w_date_fmt,
                 dc.identifier                           AS identifier,
                 i.*,
                 concat(CASE WHEN ig.ig_title IS NOT NULL THEN
                          concat(ig.ig_title, ": ")
                        ELSE
                          ""
                        END,
                        i.details,
                        CASE WHEN i.reporting_number IS NOT NULL THEN
                          concat(" (", i.reporting_number, ")")
                        ELSE
                          ""
                        END,
                        CASE WHEN d2i.caveat IS NOT NULL THEN
                          concat(" - ", d2i.caveat)
                        ELSE
                          ""
                        END)                                AS verbose_details,
                 date_format(i.sdate_of_incident, "%Y%m%d") AS sdate_of_incident_fmt,
                 date_format(i.sdate_of_incident, "%a")     AS dayofweek,
                 ig.ig_title,
                 dn.number,
                 concat("locoqry.php?action=locodata&id=", dn.loco_id,"&type=D&loco=", dn.number)
                                                            AS number_hl,
                 dn.number_type,
                 coalesce(dc2.depot_code, da.allocation)    AS allocation,
                 concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                                            AS allocation_hlx,
                 dp1.depot_name,
                 da.alloc_flag,
                 da.caveat,
                 da.loan_allocation

          FROM   diesels  d

          JOIN   d_class_link dcl
          ON     dcl.loco_id = d.loco_id

          JOIN   d_class dc
          ON     dc.d_class_id = dcl.d_class_id

          JOIN   d_to_i d2i
          ON     d2i.loco_id = d.loco_id
          
          JOIN   incidents i
          ON     i.inc_id = d2i.inc_id

          JOIN   d_nums dn
          ON     dn.loco_id = d.loco_id
          AND    dn.start_date = (SELECT max(dn1.start_date)
                                   FROM   d_nums dn1
                                   WHERE  dn1.loco_id = d.loco_id
                                   AND    dn1.start_date <= i.sdate_of_incident)

          LEFT JOIN   d_alloc da
          ON     da.loco_id = d.loco_id
          AND    concat(da.alloc_date, da.seq) = (SELECT MAX(concat(da1.alloc_date, da1.seq))
                                                  FROM   d_alloc da1
                                                  WHERE  da1.loco_id = d.loco_id
                                                  AND    da1.alloc_date <= i.sdate_of_incident)

          LEFT JOIN ref_depot_codes dc1
          ON     dc1.depot_code = da.allocation
          AND    dc1.date_from = (SELECT MAX(dc1a.date_from)
                                  FROM   ref_depot_codes dc1a
                                  WHERE  dc1a.depot_code = da.allocation
                                  AND    dc1a.date_from <= da.alloc_date)

          LEFT JOIN ref_depot dp1
          ON     dp1.depot_id = dc1.depot_id

          LEFT JOIN ref_depot_codes dc2
          ON     dc2.depot_id = dc1.depot_id
          AND    dc2.date_from = (SELECT MAX(dc2a.date_from)
                                  FROM   ref_depot_codes dc2a
                                  WHERE  dc2a.depot_id = dc2.depot_id
                                  AND    dc2a.date_from <= i.sdate_of_incident)

          LEFT JOIN incident_groups ig
          ON     ig.ig_id = i.ig_id

          WHERE  dc.d_class_id = ' . $id . '
          ORDER BY i.sdate_of_incident ASC, i.inc_id, d.loco_id';

//echo $sql;

  $result = $db->execute($sql);

  $last_inc_id = -1;
  if ($result)
  {
  if ($db->count_select())
  {
	  while ($row = mysqli_fetch_assoc($result))
	  {
		if ($row['inc_id'] != $last_inc_id && $last_inc_id != -1)
		{
		  // change of incident - print out the last one
		  $rowx['number'] = $loco_list;
		  $rowx['allocation'] = $alloc_list;
		  $rowx['verbose_details'] = $detail_list;
		  $rowx['sdate_of_incident'] = fn_fdate($rowx['sdate_of_incident']);
		  if (!empty($rowx['dayofweek']))
			$rowx['sdate_of_incident'] = $rowx['dayofweek'] . " " . $rowx['sdate_of_incident'];
		  $tb_d2d->add_data($rowx);

		  $loco_list = "";
		  $alloc_list = "";
		  $detail_list = "";
		  $rowx = $row;
		}
		else
		{
		  if ($last_inc_id == -1)
		  {
			$loco_list = "";
			$alloc_list = "";
			$detail_list = "";
			$rowx = $row;
		  }
		}

		if ($row['number_type'] == "PRT")
		  $loco = fn_d_pfx($row['number']);
		else
		  $loco = $row['number'];

		if (!empty($loco_list))
		  $loco_list .= ",<br />" . "<a href=\"" . $row['number_hl'] . "\">" . $loco . "</a>";
		else
		  $loco_list = "<a href=\"" . $row['number_hl'] . "\">" . $loco . "</a>";

		if (empty($row['allocation']))
		  $row['allocation'] = "??";

		if (strcmp($row['allocation'], "98W") == 0)
		{
		  $row['allocation'] = "Wdn";
		  $row['depot_name'] = "Withdrawn";
		}

		$alloc = "<a href=\"" . $row['allocation_hlx'] . "\">" . $row['allocation'] . "</a>";

		$tip = sprintf("<span class=\"bubble_tooltip\" href=\"#\" onmousemove=\"showToolTip(event,'%s: %s');return false\" onmouseout=\"hideToolTip()\">%s</span>",
					   $row['allocation'], $row['depot_name'], $alloc);

		if (!empty($alloc_list))
		  $alloc_list .= ",<br />" . $tip;
		else
		  $alloc_list = $tip;

		if (!empty($detail_list))
		  $detail_list .= "<br />" . $row['verbose_details'];
		else
		  $detail_list  = $row['verbose_details'];

	/*
		if (!empty($alloc_list))
		  $alloc_list .= ",<br />" . $alloc
		else
		  $alloc_list = $alloc;
	*/

		$last_inc_id = $row['inc_id'];
	  }

    if (!empty($loco_list))
      $rowx['number'] = $loco_list;
    else
    if ($rowx['number_type'] == "PRT")
      $rowx['number'] = fn_d_pfx($rowx['number']);
    $rowx['allocation'] = $alloc_list;
    $rowx['sdate_of_incident'] = fn_fdate($rowx['sdate_of_incident']);
    if (!empty($rowx['dayofweek']))
      $rowx['sdate_of_incident'] = $rowx['dayofweek'] . " " . $rowx['sdate_of_incident'];
    $tb_d2d->add_data($rowx);
  }
  }

  if ($result) mysqli_free_result($result);
  $row = NULL;

/***********************************************************************************************/
/*                                                                                             */
/*                                                                                             */
/***********************************************************************************************/

  if ($db->count_select())
    $tb_d2d->draw_table();

/*
  printf("<form method=\"post\" action=\"publishpdf.php\">\n");
  printf("<fieldset>\n");
  printf("<input type=\"hidden\" name=\"sql\" value=\"%s\" />\n", $html_str);
  printf("<input type=\"submit\" id=\"search-submit\" value=\"Generate PDF\" />\n");
  printf("</fieldset>\n");
  printf("</form>\n");
*/



?>
