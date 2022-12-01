<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  
<html xmlns="www.w3.org/1999/xhtml">

<!--
Copyright: Darren Hester 2006, www.designsbydarren.com
License: Released Under the "Creative Commons License", 
creativecommons.org/licenses/by-nc/2.5/
-->

<head>

<!-- Meta Data -->
<meta name = "pinterest" content = "nopin" description = "The rights for images on this website lie with the copyright holder, and not BRDatabase!" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="title" content="BRDatabase, locomotive allocations, withdrawals and scrapping details in the UK" />
<meta name="description" content="Locomotive history, railway statistics, steam, diesel and electric locomotives UK" />
<meta name="keywords" content="steam, diesel, electric, locomotives, railways, LNER, LMS, GWR, Southern, Stanier, Gresley, Collett, Maunsell, Bulleid, Churchward, Riddles, Britannia, locos, withdrawals, North British, Swindon, Crewe, Doncaster, Derby, Darlington, Eastleigh, Ashford, Brighton, Cowlairs, Inverurie, Gorton, Great Central, Great Northern, scrapping, allocations " />
<meta http-equiv="Content-Language" content="en-gb">

<!-- Site Title -->

<!-- Link to Style External Sheet -->

<style type="text/css">
		@import "css/nestedsidebar.css";
		@import "css/style.css";
		/* domCollapse styles */
		@import "css/domcollapse.css";
</style>

<link rel="stylesheet" href="css/bubble-tooltip.css" media="screen" />

<script type="text/javascript" src="scripts/bubble-tooltip.js"></script>

<script type="text/javascript" src="scripts/sorttable.js"></script>

<script type="text/javascript">
//<![CDATA[

//Nested Side Bar Menu (Mar 20th, 09)
//By Dynamic Drive: www.dynamicdrive.com/style/

var menuids=["sidebarmenu1"] //Enter id(s) of each Side Bar Menu's main UL, separated by commas

function initsidebarmenu()
{
  for (var i=0; i<menuids.length; i++)
  {
    var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++)
    {
      ultags[t].parentNode.getElementsByTagName("a")[0].className+=" subfolderstyle"
      if (ultags[t].parentNode.parentNode.id==menuids[i]) //if this is a first level submenu
      {
         //dynamically position first level submenus to be width of main menu item
                 ultags[t].style.left=ultags[t].parentNode.offsetWidth+"px"
      }
      else //else if this is a sub level submenu (ul)
          {
         //position menu to the right of menu item that activated it
                 ultags[t].style.left=ultags[t-1].getElementsByTagName("a")[0].offsetWidth+"px"
          }
      
          ultags[t].parentNode.onmouseover=function()
          {
        this.getElementsByTagName("ul")[0].style.display="block"
      }

      ultags[t].parentNode.onmouseout=function()
          {
        this.getElementsByTagName("ul")[0].style.display="none"
      }
    }

    for (var t=ultags.length-1; t>-1; t--)
    { // loop through all sub menus again, and use "display:none" to hide menus 
      // (to prevent possible page scrollbars
      ultags[t].style.visibility="visible"
      ultags[t].style.display="none"
    }
  }
}

if (window.addEventListener)
  window.addEventListener("load", initsidebarmenu, false)
else if (window.attachEvent)
  window.attachEvent("onload", initsidebarmenu)

//]]>
</script><!--end script -->

<script type="text/javascript" src="scripts/domcollapse.js">
</script>

</head>

<body>
<?php require_once "lib/quickdb.class.php"; require_once "lib/brlib.php"; fn_check_country($_SERVER['REMOTE_ADDR']); ?>
<div id="page_wrapper">

<div id="header_wrapper">

<div id="header">

<h1>BR<font color="#FFDF8C">Database</font></h1>
<h2>Complete BR Locomotive Database 1948-1997</h2>

<!--
	<div id="topright">
		<form method="get" id="searchform" action="">
			<div class="searchbox">
				<label for="s">Search:</label>
				<input type="text" value="" name="s" id="s" size="14" />
				<input type="hidden" id="searchsubmit" value="Search" />
			</div>
		</form>
	</div>
-->
</div><!-- end header -->

<div id="navcontainer">

<ul id="navlist">
<li><a href="index.php">Home</a></li>
<li><a href="lazarus/index.php">Guestbook</a></li>
<li><a href="contact.php">Contact</a></li>
<li><a href="links.php">Links</a></li>
<li><a href="preferences.php">Preferences</a></li>
</ul>
</div><!-- end navcontainer -->

</div><!-- end header_wrapper -->

<div id="left_side">

<h3>Menu</h3>
<div class="sidebarmenu">
<?php include "includes/master_menu.html"; ?>
</div><!-- end sidebarmenu -->

<h3>Quick Search</h3>

<p>
Enter locomotive number in the box below and press 'Go'!
</p>

<div id="bubble_tooltip">
	<div class="bubble_top"><span></span></div>
	<div class="bubble_middle"><span id="bubble_tooltip_content">Content is coming here as you probably can see. Content is coming here as you probably can see.</span></div>
	<div class="bubble_bottom"></div>
</div>

<!-- search bar -->
<?php include "includes/searchbar.html"; ?>

<h3>Counter</h3>
<div class='featurebox_side'>
<?php include "lib/counter.php"; ?>
</div><!-- end featurebox_side -->

<h3>Advertising</h3>
<div class='featurebox_side'>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-4778123637289700";
/* test */
google_ad_slot = "6591011963";
google_ad_width = 125;
google_ad_height = 125;
//-->
</script>
<script type="text/javascript"
src="pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<br /><br />


</div><!-- end featurebox_side -->

<h3>In Touch</h3>
<div class='featurebox_side'>
<!-- AddThis Button BEGIN -->
<script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
<a class="addthis_button" href="www.addthis.com/bookmark.php?v=250&amp;username=ij1001"><img src="s7.addthis.com/static/btn/sm-share-en.gif" width="83" height="16" alt="Bookmark and Share" style="border:0" /></a><script type="text/javascript" src="s7.addthis.com/js/250/addthis_widget.js#username=ij1001"></script>
<!-- AddThis Button END -->
<br /><br />
<a href="twitter.com/brdatabase"><img src="./images/twitter.png" width="83" height="16" alt="Follow BRDatabase on Twitter" style="border:0" /></a>

</div><!-- end featurebox_side -->

</div><!-- end left_side-->

<div id="content">

<h3>Timelines</h3>

<div class='featurebox_center'>
<?php

include_once "lib/quickdb.class.php";
include_once "lib/MyTables.class.php";
require_once "lib/brlib.php";

$db = fn_connectdb();

  // 4 possible parameters
  //   page        <$pg>      - page choice
  //   subpage     <$subpage> - subpage choice
  //   item        <$item>    - specific reports
  //   id          <$id>      - id into incident groups (currently max 9999)
  
  $pg = $subpage = $id = "";

  foreach ($_GET as $key => $value)
  {
    if ($key == "page")
    {
      $pg = $value;
      if (!empty($pg))
        fn_check_alpha($pg, 12);
    }
    else
    if ($key == "subpage")
    {
      $subpage = $value;
      if (!empty($subpage))
        fn_check_alpha($subpage, 12);
    }
    else
    if ($key == "item")
    {
      $item= $value;
      if (!empty($item))
        fn_check_alpha($item, 12);
    }
    else
    if ($key == "id")
    {
      $id = $value;
      if (!empty($id))
        fn_check_id($id, 9999);
    }
    else
    if ($key == "fbclid")
    {
    }
    else
      fn_poem($key, $value, 99);
  }
 
if (!empty($pg))
{
  if ($pg == "closures")
  {
    $sql = 'SELECT "C" AS type,
                    closure_date   AS act_date,
                    closure_prd    AS act_prd,
                    loc_from,
                    loc_to,
                    details
            FROM    brdataba_stage.st_closure
            UNION ALL
            SELECT "D" AS type,
                    delclosure_date   AS act_date,
                    delclosure_prd    AS act_prd,
                    loc_from,
                    loc_to,
                    details
            FROM    brdataba_stage.st_delclosure
            UNION ALL
            SELECT "O" AS type,
                    opening_date     AS act_date,
                    opening_prd      AS act_prd,
                    loc_from,
                    loc_to,
                    concat(details, " (Opened to ", traffic, ")") AS details
            FROM    brdataba_stage.st_opened
            UNION ALL
            SELECT "R" AS type,
                    opening_date     AS act_date,
                    opening_prd      AS act_prd,
                    loc_from,
                    loc_to,
                    concat(details, " (Re-opened to ", traffic, ")") AS details
            FROM    brdataba_stage.st_reopened
            ORDER BY act_date, act_prd';
            
    $result = $db->execute($sql);
    
    if ($result)
    {
      $tclos = new MyTables("closure_list", 80);
      $tclos->sortable();
      $tclos->add_caption("Line Closures, Openings and Re-openings");
      $tclos->add_column("type",              "Type",    12);
      $tclos->add_column("loc_from",          "From",    12);
      $tclos->add_column("loc_to",            "To",      12);
      $tclos->add_column("act_date",          "Date",    10);
      $tclos->add_column("details",           "Details", 54);

      while ($row = mysqli_fetch_assoc($result))
      {
        switch ($row['type'])
        {
          case 'O': $row['type'] = "<font color=\"green\"><strong>OPENED</strong></font>"; break;
          case 'C': $row['type'] = "<font color=\"red\"><strong>CLOSED</strong></font>"; break;
          case 'R': $row['type'] = "<font color=\"green\"><strong>REOPENED</strong></font>"; break;
          case 'D': $row['type'] = "<font color=\"green\"><strong>CLOSURE CANCELLED</strong></font>"; break;
          default: $row['type'] = "ERROR"; break;
        }

        $row['act_date'] = fn_fdate($row['act_date']);
        
        $tclos->add_data($row);
      }
      
      $tclos->draw_table();
    }
  }
  else
  if ($pg == "workings")
  {
    if (!empty($subpage))
    {
      if ($subpage == "groups")
      {
        /* this is the group page */

        if (!empty($id))
        {
          $sql = 'SELECT dayname(ig.ig_date) AS daynm
                  FROM   incident_groups ig
                  WHERE  ig.ig_id = ' . $id;
                  
          fn_logit(10, $id);

          $result = $db->execute($sql);
          $row = mysqli_fetch_assoc($result);

          $dayofweek = $row['daynm'];

          /* specific incident/event group */
          
          $tigs = new MyTables("incidents");
          $tigs->sortable();
          $tigs->colour_coordinate("Y");
          $tigs->add_column("identifier",           "Class",       6);
          $tigs->add_column("wheels",               "Wheels",      7);
          $tigs->add_column("locomotive",           "Loco",        6);
          $tigs->add_column("allocation",           "Code",        4);
          $tigs->add_column("depot_name",           "Allocation", 14);
          $tigs->add_column("b_date",               "To Service",  8);
          $tigs->add_column("w_date",               "Withdrawn",   8);
          $tigs->add_column("verbose_details",      "Details",    42);
          $tigs->add_column("report_number",        "Rep Num",     5);

          $sql = 'SELECT "D"         AS type,
                         i.*,
                         concat(i.details,
                                CASE WHEN i.reporting_number IS NOT NULL THEN
                                  concat(" (", i.reporting_number, ")")
                                ELSE
                                  ""
                                END,
                                CASE WHEN d2i.caveat IS NOT NULL THEN
                                  concat(" - ", d2i.caveat)
                                ELSE
                                  ""
                                END)  AS verbose_details,
                         ig.ig_title,
                         ig.ig_date,
                         date_format(ig.ig_date, "YYYYMMDD")                AS ig_date_fmt,
                         dnm.name,
                         dn1.number   AS  locomotive,
				                 concat("locoqry.php?action=locodata&id=", dn1.loco_id, 
                                "&type=D&loco=", dn1.number) AS  locomotive_hl,
                         dn1.number_type,
                         dn2.number   AS  locomotive_pre,
				                 concat("locoqry.php?action=locodata&id=", dn2.loco_id, 
                                "&type=D&loco=", dn2.number) AS  locomotive_pre_hl,
                         dn2.number_type    AS number_type_pre,
                         da.allocation,
                         concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                     AS allocation_hl,
                         dp.depot_name,
                         concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                     AS depot_name_hl,
                         dpc.depot_code,
                         dn1.loco_id  AS  loco_id,
                         coalesce(dc.identifier, dc2.identifier)            AS identifier,
                         concat("locoqry.php?action=class&amp;type=D&amp;id=",
                                  coalesce(dc.d_class_id, dc2.d_class_id))  AS identifier_hl,
                         d.b_date,
                         date_format(d.b_date, "%Y%m%d")                    AS b_date_fmt,
                         d.w_date,
                         date_format(d.w_date, "%Y%m%d")                    AS w_date_fmt,
                         dc.wheel_arrangement                               AS wheels,
                         concat("misc.php?page=wheelarr&id=", dc.wheel_arrangement)      
                                                                            AS wheels_hl


                  FROM   incidents i

                  JOIN   incident_groups ig
                  ON     i.ig_id = ig.ig_id

                  JOIN   d_to_i d2i
                  ON     d2i.inc_id = i.inc_id

                  JOIN   diesels d
                  ON     d.loco_id = d2i.loco_id

                  LEFT JOIN d_name dnm
                  ON     dnm.loco_id = d.loco_id
                  AND    dnm.start_date = (SELECT max(dnm2.start_date)
                                           FROM   d_name dnm2
                                           WHERE  dnm2.loco_id = d.loco_id
                                           AND    dnm2.start_date <= ig.ig_date)
                   
                  LEFT JOIN d_nums dn1
                  ON     dn1.loco_id = d.loco_id
                  AND    dn1.start_date = (SELECT max(dn1a.start_date)
                                           FROM   d_nums dn1a
                                           WHERE  dn1a.loco_id = d.loco_id
                                           AND    dn1a.start_date <= ig.ig_date)
                  LEFT JOIN d_nums dn2
                  ON     dn2.loco_id = d.loco_id
                  AND    dn2.start_date = (SELECT min(dn2a.start_date)
                                           FROM   d_nums dn2a
                                           WHERE  dn2a.loco_id = d.loco_id)

                  LEFT JOIN   d_class_link dcl
                  ON     dcl.loco_id = d.loco_id
                  AND    dcl.start_date = (SELECT max(dcla.start_date)
                                           FROM   d_class_link dcla
                                           WHERE  dcla.loco_id = d.loco_id
                                           AND    dcla.start_date <= ig.ig_date)

                  LEFT JOIN   d_class dc
                  ON     dc.d_class_id = dcl.d_class_id

                  LEFT JOIN   d_class_link dcl2
                  ON     dcl2.loco_id = d.loco_id
                  AND    dcl2.start_date = (SELECT min(dcl2a.start_date)
                                            FROM   d_class_link dcl2a
                                            JOIN   diesels d
                                            ON     d.loco_id = dcl2a.loco_id
                                            WHERE  dcl2a.loco_id = d.loco_id
                                            AND    dcl2a.start_date >= date_sub(d.b_date,
                                                                                INTERVAL 6 MONTH))

                  LEFT JOIN   d_class dc2
                  ON     dc2.d_class_id = dcl2.d_class_id

                  LEFT JOIN d_alloc da
                  ON     da.loco_id = d.loco_id
                  AND    concat(da.alloc_date, da.seq) = (SELECT max(concat(da2.alloc_date, 
                                                                            da2.seq))
                                                          FROM   d_alloc da2
                                                          WHERE  da2.loco_id = d.loco_id
                                                          AND    da2.alloc_date <= ig.ig_date)

                  LEFT JOIN ref_depot_codes dpc
                  ON     dpc.depot_code = da.allocation
                  AND    dpc.date_from = (SELECT max(dpc2.date_from)
                                          FROM   ref_depot_codes dpc2
                                          WHERE  dpc2.depot_code = da.allocation
                                          AND    dpc2.date_from  <= da.alloc_date)

                  LEFT JOIN ref_depot dp
                  ON     dp.depot_id = dpc.depot_id

                  WHERE  ig.ig_id = ' . $id . '

                  UNION

                  SELECT "S"         AS type,
                         i.*,
                         concat(i.details,
                                CASE WHEN i.reporting_number IS NOT NULL THEN
                                  concat(" (", i.reporting_number, ")")
                                ELSE
                                  ""
                                END,
                                CASE WHEN s2i.caveat IS NOT NULL THEN
                                  concat(" - ", s2i.caveat)
                                ELSE
                                  ""
                                END)  AS verbose_details,
                         ig.ig_title,
                         ig.ig_date,
                         date_format(ig.ig_date, "YYYYMMDD")                AS ig_date_fmt,
                         snm.name,
                         sn1.number   AS  locomotive,
				                 concat("locoqry.php?action=locodata&id=", sn1.loco_id, 
                                "&type=S&loco=", sn1.number) AS  locomotive_hl,
                         sn1.number_type,
                         sn2.number   AS  locomotive_pre,
				                 concat("locoqry.php?action=locodata&id=", sn2.loco_id, 
                                "&type=S&loco=", sn2.number) AS  locomotive_pre_hl,
                         sn2.number_type    AS number_type_pre,
                         sa.allocation,
                         concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                     AS allocation_hl,
                         dp.depot_name,
                         concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                     AS depot_name_hl,
                         dpc.depot_code,
                         sn1.loco_id  AS  loco_id,
                         coalesce(sc.identifier, sc2.identifier)            AS identifier,
                         concat("locoqry.php?action=class&amp;type=S&amp;id=",
                                  coalesce(sc.s_class_id, sc2.s_class_id))  AS identifier_hl,
                         s.b_date,
                         date_format(s.b_date, "%Y%m%d")                    AS b_date_fmt,
                         s.w_date,
                         date_format(s.w_date, "%Y%m%d")                    AS w_date_fmt,
                         sc.wheel_arrangement                               AS wheels,
                         concat("misc.php?page=wheelarr&id=", sc.wheel_arrangement)      
                                                                            AS wheels_hl



                  FROM   incidents i

                  JOIN   incident_groups ig
                  ON     i.ig_id = ig.ig_id

                  JOIN   s_to_i s2i
                  ON     s2i.inc_id = i.inc_id

                  JOIN   steam s
                  ON     s.loco_id = s2i.loco_id

                  LEFT JOIN s_name snm
                  ON     snm.loco_id = s.loco_id
                  AND    snm.start_date = (SELECT max(snm2.start_date)
                                           FROM   s_name snm2
                                           WHERE  snm2.loco_id = s.loco_id
                                           AND    snm2.start_date <= ig.ig_date)
                   
                  LEFT JOIN s_nums sn1
                  ON     sn1.loco_id = s.loco_id
                  AND    sn1.start_date = (SELECT max(sn1a.start_date)
                                           FROM   s_nums sn1a
                                           WHERE  sn1a.loco_id = s.loco_id
                                           AND    sn1a.start_date <= ig.ig_date)

                  LEFT JOIN s_nums sn2
                  ON     sn2.loco_id = s.loco_id
                  AND    sn2.start_date = (SELECT min(sn2a.start_date)
                                           FROM   s_nums sn2a
                                           WHERE  sn2a.loco_id = s.loco_id)

                  LEFT JOIN   s_class_link scl
                  ON     scl.loco_id = s.loco_id
                  AND    scl.start_date = (SELECT max(scl2.start_date)
                                           FROM   s_class_link scl2
                                           WHERE  scl2.loco_id = s.loco_id
                                           AND    scl2.start_date <= ig.ig_date)

                  LEFT JOIN   s_class sc
                  ON     sc.s_class_id = scl.s_class_id

                  LEFT JOIN   s_class_link scl2
                  ON     scl2.loco_id = s.loco_id
                  AND    scl2.start_date = (SELECT min(scl2a.start_date)
                                            FROM   s_class_link scl2a
                                            JOIN   steam s
                                            ON     s.loco_id = scl2a.loco_id
                                            WHERE  scl2a.loco_id = s.loco_id
                                            AND    scl2a.start_date >= date_sub(s.b_date,
                                                                                INTERVAL 6 MONTH))

                  LEFT JOIN   s_class sc2
                  ON     sc2.s_class_id = scl2.s_class_id

                  LEFT JOIN s_alloc sa
                  ON     sa.loco_id = s.loco_id
                  AND    concat(sa.alloc_date, sa.seq) = (SELECT max(concat(sa2.alloc_date, 
                                                                            sa2.seq))
                                                          FROM   s_alloc sa2
                                                          WHERE  sa2.loco_id = s.loco_id
                                                          AND    sa2.alloc_date <= ig.ig_date)

                  LEFT JOIN ref_depot_codes dpc
                  ON     dpc.depot_code = sa.allocation
                  AND    dpc.date_from = (SELECT max(dpc2.date_from)
                                          FROM   ref_depot_codes dpc2
                                          WHERE  dpc2.depot_code = sa.allocation
                                          AND    dpc2.date_from  <= sa.alloc_date)
                  LEFT JOIN ref_depot dp
                  ON     dp.depot_id = dpc.depot_id

                  WHERE  ig.ig_id = ' . $id . '

                  UNION

                  SELECT "E"         AS type,
                         i.*,
                         concat(i.details,
                                CASE WHEN i.reporting_number IS NOT NULL THEN
                                  concat(" (", i.reporting_number, ")")
                                ELSE
                                  ""
                                END,
                                CASE WHEN e2i.caveat IS NOT NULL THEN
                                  concat(" - ", e2i.caveat)
                                ELSE
                                  ""
                                END)  AS verbose_details,
                         ig.ig_title,
                         ig.ig_date,
                         date_format(ig.ig_date, "YYYYMMDD")                AS ig_date_fmt,
                         enm.name,
                         en1.number   AS locomotive,
				                 concat("locoqry.php?action=locodata&id=", en1.loco_id, 
                                "&type=E&loco=", en1.number) AS  locomotive_hl,
                         en1.number_type,
                         en2.number   AS  locomotive_pre,
				                 concat("locoqry.php?action=locodata&id=", en2.loco_id, 
                                "&type=E&loco=", en2.number) AS  locomotive_pre_hl,
                         en2.number_type    AS number_type_pre,
                         ea.allocation,
                         concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                     AS allocation_hl,
                         dp.depot_name,
                         concat("sites.php?page=depots&action=query&id=", dp.depot_id) 
                                     AS depot_name_hl,
                         dpc.depot_code,
                         en1.loco_id  AS loco_id,
                         coalesce(ec.identifier, ec2.identifier)            AS identifier,
                         concat("locoqry.php?action=class&amp;type=E&amp;id=",
                                  coalesce(ec.e_class_id, ec2.e_class_id))  AS identifier_hl,
                         e.b_date,
                         date_format(e.b_date, "%Y%m%d")                    AS b_date_fmt,
                         e.w_date,
                         date_format(e.w_date, "%Y%m%d")                    AS w_date_fmt,
                         ec.wheel_arrangement                               AS wheels,
                         concat("misc.php?page=wheelarr&id=", ec.wheel_arrangement)      
                                                                            AS wheels_hl



                  FROM   incidents i

                  JOIN   incident_groups ig
                  ON     i.ig_id = ig.ig_id

                  JOIN   e_to_i e2i
                  ON     e2i.inc_id = i.inc_id

                  JOIN   electric e
                  ON     e.loco_id = e2i.loco_id

                  LEFT JOIN e_name enm
                  ON     enm.loco_id = e.loco_id
                  AND    enm.start_date = (SELECT max(enm2.start_date)
                                           FROM   e_name enm2
                                           WHERE  enm2.loco_id = e.loco_id
                                           AND    enm2.start_date <= ig.ig_date)
                   
                  LEFT JOIN e_nums en1
                  ON     en1.loco_id = e.loco_id
                  AND    en1.start_date = (SELECT max(en1a.start_date)
                                           FROM   e_nums en1a
                                           WHERE  en1a.loco_id = e.loco_id
                                           AND    en1a.start_date <= ig.ig_date)

                  LEFT JOIN e_nums en2
                  ON     en2.loco_id = e.loco_id
                  AND    en2.start_date = (SELECT min(en2a.start_date)
                                           FROM   e_nums en2a
                                           WHERE  en2a.loco_id = e.loco_id)

                  LEFT JOIN e_class_link ecl
                  ON     ecl.loco_id = e.loco_id
                  AND    ecl.start_date = (SELECT max(ecl2.start_date)
                                           FROM   e_class_link ecl2
                                           WHERE  ecl2.loco_id = e.loco_id
                                           AND    ecl2.start_date <= ig.ig_date)

                  LEFT JOIN e_class ec
                  ON     ec.e_class_id = ecl.e_class_id

                  LEFT JOIN e_class_link ecl2
                  ON     ecl2.loco_id = e.loco_id
                  AND    ecl2.start_date = (SELECT min(ecl2a.start_date)
                                            FROM   e_class_link ecl2a
                                            JOIN   electric e
                                            ON     e.loco_id = ecl2a.loco_id
                                            WHERE  ecl2a.loco_id = e.loco_id
                                            AND    ecl2a.start_date >= date_sub(e.b_date,
                                                                                INTERVAL 36 MONTH))

                  LEFT JOIN   e_class ec2
                  ON     ec2.e_class_id = ecl2.e_class_id

                  LEFT JOIN e_alloc ea
                  ON     ea.loco_id = e.loco_id
                  AND    concat(ea.alloc_date, ea.seq) = (SELECT max(concat(ea2.alloc_date, 
                                                                            ea2.seq))
                                                          FROM   e_alloc ea2
                                                          WHERE  ea2.loco_id = e.loco_id
                                                          AND    ea2.alloc_date <= ig.ig_date)

                  LEFT JOIN ref_depot_codes dpc
                  ON     dpc.depot_code = ea.allocation
                  AND    dpc.date_from = (SELECT max(dpc2.date_from)
                                          FROM   ref_depot_codes dpc2
                                          WHERE  dpc2.depot_code = ea.allocation
                                          AND    dpc2.date_from  <= ea.alloc_date)
                  LEFT JOIN ref_depot dp
                  ON     dp.depot_id = dpc.depot_id

                  WHERE  ig.ig_id = ' . $id . '

                  ORDER BY ig_date ASC, ig_order, type, loco_id';

          $result = $db->execute($sql);

          $nx = 0;
          
          while ($row = mysqli_fetch_assoc($result))
          {
            if ($nx++ == 0)
              $tigs->add_caption($row['ig_title'] . " - " . $dayofweek . " " . 
                                                            fn_fdate($row['ig_date']));

            $row['b_date'] = fn_fdate($row['b_date']);
            $row['w_date'] = fn_fdate($row['w_date']);

            if (($row['number_type'] == "PRT") ||
                ($row['type'] ==  "E" && $row['number_type'] == "PN"))
            {
              if ($row['type'] == "E")
                $row['locomotive']     = fn_e_pfx($row['locomotive']);
              else
              if ($row['type'] == "D")
                $row['locomotive']     = fn_d_pfx($row['locomotive']);
            }

            if (($row['number_type_pre'] == "PRT") ||
                ($row['type'] ==  "E" && $row['number_type'] == "PN"))
            {
              if ($row['type'] == "E")
                $row['locomotive_pre'] = fn_e_pfx($row['locomotive_pre']);
              else
              if ($row['type'] == "D")
                $row['locomotive_pre'] = fn_d_pfx($row['locomotive_pre']);
            }

            if ($row['allocation'] == "98W")
	          {
              $row['allocation'] = "";
              $row['depot_name'] = "<font color=\"red\"><strong>Withdrawn</strong></font>";
            }
            else
            if ($row['allocation'] == "98S")
            {
              $row['allocation'] = "";
              $row['depot_name'] = $row['depot_name'] . "<font color=\"orange\"><strong> (Stored " . $row['caveat'] . ")</strong></font>";
            }

            if (empty($row['locomotive']))
            {
              $row['locomotive']    = $row['locomotive_pre'];
              $row['locomotive_hl'] = $row['locomotive_pre_hl'];
            }

            $tigs->add_data($row);
          }

          $tigs->draw_table();
        }
        else
        {
          /* All event/groups */
/*
          $sql = 'SELECT i.*,
                         ig.ig_title,
                         ig.ig_date
                  FROM   incidents i
                  LEFT JOIN incident_groups ig
                  ON     i.ig_id = ig.ig_id
                  ORDER BY ig.ig_date ASC';
          
          $result = $db->execute($sql);
*/
        }
      }
    }
    else
    {
?>
      <p>Below is a list of visits to depots, scrapyards, locomotive works and major stations, 
      usually in organised groups by organisations such as the RCTS, SLS, LCGB or BR itself.
      </p><p>Each listing contains those locomotives present on that day and may include 
      further details such as the reason for the locomotive being present</p><br />
<?php
      // put a list of all workings/groups here
      $sql = 'SELECT ig.ig_id,
                     ig.ig_title,
                     concat("timelines.php?page=workings&amp;subpage=groups&amp;id=",
                            ig.ig_id)    AS ig_title_hl,
                     ig.ig_date,
                     date_format(ig.ig_date, "YYYYMMDD") AS ig_date_fmt,
                     dayname(ig.ig_date) AS dayname,
		             ig.contributor
              FROM   incident_groups ig
              ORDER BY ig.ig_date ASC';

      $result = $db->execute($sql);

      $tigs = new MyTables("incident_list", 80);
      $tigs->sortable();
      $tigs->add_caption("Site Visits");
      $tigs->add_column("ig_date",              "Visit Date",  25);
      $tigs->add_column("ig_title",             "Details",     45);
      $tigs->add_column("contributor",          "Contributor", 20);
      
      fn_logit(11, "");


      while ($row = mysqli_fetch_assoc($result))
      {
        $row['ig_date'] = fn_fdate($row['ig_date']);
      
        if (!empty($row['dayname']))
          $row['ig_date'] .= " (" . $row['dayname'] . ")";

        $tigs->add_data($row);
      }

      $tigs->draw_table();
      $tigs = ""; $row = "";
    }
  }
  else
  if ($pg == "events")
  {
    printf("<h4>Events</h4>\n");
  }
  else
  if ($pg == "news")
  {
    printf("<h4>News Stories</h4>\n");
    printf("<p>The following articles are contemporary reports from the railway press and provide an 
interesting insight into new developments and old practices. It may be noted that many of the facts 
or assumptions have proved to be incorrect, while others have proven to be prophetic.</p>\n");

    $sql = 'select date_format(news_date, "%M, %Y") AS news_date_my,
                   date_format(news_date, "%M") AS news_date_m,
                   date_format(news_date, "%Y") AS news_date_y,
                   news_type,
                   news_title,
                   news_story,
                   news_author,
                   news_source,
                   news_permit
            from   news_stories
            order by news_date ASC';

    $result = $db->execute($sql);

    $numrows = $db->count_select();

    if ($numrows == 0)
    {
      printf("<p>No stories found</p><br />\n");
    }
    else
    {
      $ny = 0; $nm = "fred"; $nm_ct = 0;
      while ($row = mysqli_fetch_assoc($result))
      {
        $ny_new = "N";
        if ($row['news_date_y'] != $ny)
        {
          $nm_ct = 0;
          $ny_new = "Y";
          if ($ny != 0)
          {
            printf("<br />\n");
            printf("</div> <!-- close div 1 for year -->\n");
          }
          printf("<h4 class=\"trigger\">%s</h4>\n", $row['news_date_y']);
          printf("<div> <!-- open div 1 for year -->\n<br />\n");
          $ny = $row['news_date_y'];
        }

        if ($row['news_date_m'] != $nm || $ny_new == "Y")
        {
          if ($nm_ct != 0)
            printf("<br />\n");
          printf("<h5>%s</h5>\n", $row['news_date_m']);
          $nm = $row['news_date_m'];
          $nm_ct++;
        }

        printf("<h6 class=\"trigger\"> %s</h6>\n", $row['news_title']);
        printf("<div> <!-- open div 2 for new story -->\n<br /><fieldset class=\"news_fs\">\n");
        printf("<p><em>From %s (%s). %s</em></p>\n", $row['news_source'],
                                                     $row['news_date_my'],
                                                     $row['news_permit']);
        printf("%s\n", $row['news_story']);
              printf("</fieldset><br /></div> <!-- close div for new story -->\n");
      }

      if ($ny != 0)
      {
        printf("<br />\n");
        printf("</div> <!-- close div 1 for year -->\n");
      }
    }
  }
  else
  {
    die("Unknown timeline requested - oh dear!");
  }

  $db->close();
}
else
{
}

?>
</div>  <!-- featurebox_center -->

</div><!-- end content -->

<div id="footer">

  <a href="index.php">Home</a> |
  <a href="lazarus/index.php">Guestbook</a> |
  <a href="contact.php">Contact</a> |
  <a href="links.php">Links</a> |
  <a href="preferences.php">Preferences</a><br />
<?php printf("Website Copyright(C) 2010-%d BRDatabase.info<br />", date("Y")); ?>
<br />
</div><!-- end footer -->

</div><!-- end page_wrapper -->

</body>

</html>

