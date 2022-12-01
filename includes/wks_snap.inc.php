<?php

  echo "<div id=\"navcontainer\">";
  echo "<ul id=\"navlist\">";
  echo "<li><a href=\"sites.php?page=works&subpage=main&id=" .$id. "\">Works Details</a></li>";
  echo "<li><a href=\"sites.php?page=works&subpage=locos&id="  .$id. "\">Locos Built</a></li>";
  echo "<li><a href=\"sites.php?page=works&subpage=orders&id=" .$id. "\">Orders</a></li>";
  if ($vlog > 0)
    echo "<li><a href=\"sites.php?page=works&subpage=vlog&id=" .$id. "\">Visit Log</a></li>";
  if ($olog > 0)
    echo "<li><a href=\"sites.php?page=works&subpage=olog&id=" .$id. "\">Overhauls</a></li>";
  echo "<li id=\"active\"><a href=\"#\" id=\"current\">Snapshot</a></li>";
  echo "</ul>";
  echo "</div>";

  $selfref = $_SERVER['PHP_SELF'] . "?page=works&subpage=snap&id=" . $id;

  //echo $selfref;

// print_r($_POST['mon_select']);
// print_r($_POST['year_select']);

  if (isset($_POST['mon_select']) or (!empty($_POST['mon_select'])))
  {
    @$dvals = $_POST['day_select'];
    @$mvals = $_POST['mon_select'];
    @$yvals = $_POST['year_select'];

    $qry = $yvals[0] . "-" . $mvals[0] . "-" . $dvals[0];

    include_once("lib/MyTables.class.php");
    include_once("lib/brlib.php");

    $tb = new MyTables("works_snapshot");

    $tb->add_column("number",      "Locomotive",   10);
    $tb->add_column("identifier",  "Class",        10);
    $tb->add_column("start_date",  "Arrival",      10);
    $tb->add_column("description", "Works Regime", 25);
    $tb->add_column("end_date",    "Departure",    10);
    $tb->add_column("duration",    "Durn",         5);
    $tb->add_column("notes",       "Notes",        30);
   

    $tb->sortable();
    $tb->colour_coordinate("Y");

    $sql = 'SELECT "S"               AS type,
                   sn.number,
                   concat("locoqry.php?action=locodata&id=", sn.loco_id,"&type=S&loco=", sn.number)
                                     AS number_hl,
                   wv.start_date,
                   wv.end_date,
                   vt.description,
                   wv.duration,
                   wv.summary        AS notes,
                   sc.identifier,
                   CONCAT("locoqry.php?action=class&type=S&id=", sc.s_class_id) 
                                     AS identifier_hl,
                   sc.big4_company
            FROM   works_visits wv

            JOIN   s_nums sn
            ON     sn.loco_id = wv.loco_id
            AND    sn.start_date =  (SELECT max(sn1.start_date)
                                     FROM   s_nums sn1
                                     WHERE  sn1.loco_id = sn.loco_id
                                     AND    sn1.start_date < wv.end_date)

            JOIN   s_class_link scl
            ON     scl.loco_id = wv.loco_id
            AND    scl.start_date = (SELECT max(scl1.start_date)
                                     FROM   s_class_link scl1
                                     WHERE  scl1.loco_id = scl.loco_id
                                     AND    scl1.start_date < wv.end_date)

            JOIN   s_class sc
            ON     sc.s_class_id = scl.s_class_id

            LEFT JOIN ref_visit_type vt
            ON     vt.visit_code = wv.visit_code

            WHERE  wv.type = "S"
            AND    wv.bl_code = "' . $id . '"
            AND    "' . $qry . '" BETWEEN wv.start_date AND wv.end_date
            
            UNION
            
            SELECT "D"               AS type,
                   dn.number,
				   concat("locoqry.php?action=locodata&id=", dn.loco_id,"&type=D&loco=", dn.number)
                                     AS number_hl,
                   wv.start_date,
                   wv.end_date,
                   vt.description,
                   wv.duration,
                   wv.summary        AS notes,
                   dc.identifier,
                   CONCAT("locoqry.php?action=class&type=D&id=", dc.d_class_id) 
                                     AS identifier_hl,
                   NULL              AS big4_company
            FROM   works_visits wv

            JOIN   d_nums dn
            ON     dn.loco_id = wv.loco_id
            AND    dn.start_date =  (SELECT max(dn1.start_date)
                                     FROM   d_nums dn1
                                     WHERE  dn1.loco_id = dn.loco_id
                                     AND    dn1.start_date < wv.end_date)

            JOIN   d_class_link dcl
            ON     dcl.loco_id = wv.loco_id
            AND    dcl.start_date = (SELECT max(dcl1.start_date)
                                     FROM   d_class_link dcl1
                                     WHERE  dcl1.loco_id = dcl.loco_id
                                     AND    dcl1.start_date < wv.end_date)

            JOIN   d_class dc
            ON     dc.d_class_id = dcl.d_class_id

            LEFT JOIN ref_visit_type vt
            ON     vt.visit_code = wv.visit_code

            WHERE  wv.type = "D"
            AND    wv.bl_code = "' . $id . '"
            AND    "' . $qry . '" BETWEEN wv.start_date AND wv.end_date

            ORDER BY start_date';


    // echo $sql;

    $result = $db->execute($sql);

/*
  if ($db->count_select() == 1)
    printf("<br /><h5>1 locomotive in %s</h4><br />\n", $qry);
  else
    printf("<br /><h5>%d locomotives allocated in %s</h4><br />\n", $db->count_select(), $qry);
*/

    $z = 0;
    while ($row = mysqli_fetch_assoc($result))
    {
      $row['start_date'] = fn_fdate($row['start_date']);
      $row['end_date'] = fn_fdate($row['end_date']);
      $tb->add_data($row);
    }

    $tb->draw_table();
  }
  else
  {
    printf("<p>To view the works list for this works on a given day, enter the date below:</p>\n");
  }

?>

  <p>Enter Snapshot Date:</p>
  <form method="post" action="<?php echo $selfref; ?>">
    <fieldset "snap">
    <table width="49%" frame=box border=0 cellpadding=1>
      <tr>
        <td width=10%>

        <SELECT size="1" name="day_select[]">
<?php
        for ($nx = 1; $nx <= 31; $nx++)
	      printf("<OPTION value=\"%d\">%d</OPTION>\n", $nx, $nx);
?>
        </SELECT>
        </td>

        <td width=25%>

        <SELECT size="1" name="mon_select[]">
          <OPTION value="01">January</OPTION>
          <OPTION value="02">February</OPTION>
          <OPTION value="03">March</OPTION>
          <OPTION value="04">April</OPTION>
          <OPTION value="05">May</OPTION>
          <OPTION value="06">June</OPTION>
          <OPTION value="07">July</OPTION>
          <OPTION value="08">August</OPTION>
          <OPTION value="09">September</OPTION>
          <OPTION value="10">October</OPTION>
          <OPTION value="11">November</OPTION>
          <OPTION value="12">December</OPTION>
        </SELECT>

        </td>

        <td width=10%>

        <SELECT size="1" name="year_select[]">
<?php
        for ($nx = 1875; $nx <= 1997; $nx++)
        {
          if ($nx == 1948)
	          printf("<OPTION value=\"%d\" SELECTED>%d</OPTION>\n", $nx, $nx);
          else
	          printf("<OPTION value=\"%d\">%d</OPTION>\n", $nx, $nx);
        }
?>
        </SELECT>
 
        </td>
      </tr>
    </table>

  <input type="submit" id="search-submit" value="GO" />
  </form>
