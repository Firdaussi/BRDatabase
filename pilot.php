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
<title>Pilot Scheme Locomotives | BTC Modernisation Plan 1955</title>

<!-- Link to Style External Sheet -->

<style type="text/css">
		@import "css/nestedsidebar.css";
		@import "css/style.css";
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

<h3>Pilot Scheme Locomotives</h3>

<div class='featurebox_center'>
<?php

  require_once "lib/quickdb.class.php";
  require_once "lib/brlib.php";

  $db = fn_connectdb();
  fn_logit(5, "Pilot");

  $sql = 'select d.loco_id,
                 concat("D", dn1.number) AS dn1n,
		             concat("locoqry.php?action=locodata&id=", d.loco_id,"&type=D&loco=",dn1.number) 
                                         AS dn1n_hl,
                 lpad(dn1.number, 6, "00000") AS dn1n_fmt,
		             dn2.number              AS dn2n,
                 concat("locoqry.php?action=locodata&id=", d.loco_id,"&type=D&loco=",dn2.number) 
                                         AS dn2n_hl,
                 lpad(dn2.number, 6, "00000") AS dn2n_fmt,
		             d.b_date,
                 concat(date_format(d.b_date, "%Y%m%d"), lpad(d.loco_id, 7, "00000"))
                                         AS b_date_fmt,
                 d.w_date,
                 concat(date_format(d.w_date, "%Y%m%d"), lpad(d.loco_id, 7, "00000"))
                                         AS w_date_fmt,
                 d.s_date,
                 concat(date_format(d.s_date, "%Y%m%d"), lpad(d.loco_id, 7, "00000"))
                                         AS s_date_fmt,
                 d.preserved,
                 dc.identifier,
		             concat("locoqry.php?action=class&type=D&id=", dc.d_class_id) 
                                         AS identifier_hl,
                 coalesce(b.bl_short_name, b.bl_name)
                                         AS bl_name,
                 concat("sites.php?page=builders&id=", b.bl_code) AS bl_name_hl,
                 concat(b.bl_code, lpad(dn1.number, 6, "0"))      AS bl_name_fmt,
                 concat("sites.php?page=builders&subpage=main&id=", dcv.bl_code) 
                                         AS manufacturer_hl,
                 dcv.horse_power,
                 CAST(dcv.horse_power AS UNSIGNED) as horse_power_fmt,
                 coalesce(m.short_name, m.name)                  AS power_unit_manufacturer,
		             concat("sites.php?page=manuf&subpage=main&id=", m.manufacturer_id)
                                                                 AS power_unit_manufacturer_hl,
                 pu.model                                        AS power_unit,
                 concat("components.php?page=pu&id=", dcv.pu_id) AS power_unit_hl
          FROM   diesels d

          LEFT JOIN   d_class_link dcl
          ON     dcl.loco_id = d.loco_id
          AND    dcl.start_date = d.b_date

          LEFT JOIN   d_class dc
          ON     dc.d_class_id = dcl.d_class_id

          LEFT JOIN   d_class_var dcv
          ON     dcv.d_class_id = dcl.d_class_id
          AND    dcv.d_class_var_id = dcl.d_class_var_id

          LEFT JOIN ref_builders b
          ON     d.bl_code = b.bl_code

          LEFT JOIN   d_nums dn1
          ON     dn1.loco_id = d.loco_id
          AND    dn1.number_type = "PRT"

          JOIN   d_pilot dpi
          ON     dpi.loco_id = d.loco_id

          JOIN   ref_power_units pu
          ON     pu.pu_id = dcv.pu_id

          JOIN   ref_manufacturer m
          ON     m.manufacturer_id = pu.manufacturer_id

          LEFT JOIN d_nums dn2
          ON     dn2.loco_id = d.loco_id
          AND    dn2.number_type = "TOPS"

          ORDER BY d.loco_id ASC';

// echo $sql;

  $result = $db->execute($sql);
     
  if (!$result)  
  {  
    echo '<br />Error querying railway database: ' . mysqli_error($link);  
    echo '<br />' .$sql . '<br />';
    $err=3; 
  } 
        
  if ($err == 0)
  {
    echo "<table width=100% border=box>";
      echo "<tr>";
        echo "<td width=100%>";
?>
<p>
	  The British Transport Commission (BTC) published their modernisation plan 'A Blueprint 
for the Modernisation of British Railways' in 1955. Part of this document outlined the requirement
to replace steam locomotives with diesel and electric's, over a period of 10 years. The BTC 
identified a range of power requirements and, wishing to stimulate British industry, placed 
orders with a variety of companies for the production of pilot scheme locomotives for evaluation.</p>
<p>174 locos falling into 4 power output bands were ordered, from North British, Metropolitan 
Vickers, BRCW, English Electric, BTH, Brush Bagnall and their own workshops at Derby and 
Swindon. The following list highlights the fate of those 174 locomotives.
  </p>
<?php
	echo "</td>";
      echo "</tr>";
      echo "<tr>";

      include_once "lib/MyTables.class.php";

      $tb = new MyTables("pilotscheme");

      $tb->sortable();
      $tb->add_column("identifier",              "Class",          7);  
      $tb->add_column("dn1n",                    "Pre Tops",       7);
      $tb->add_column("dn2n",                    "Tops",           7);
      $tb->add_column("b_date",                  "To Service",    10);
      $tb->add_column("w_date",                  "Withdrawn",     10);
      $tb->add_column("bl_name",                 "Builder",       19);
      $tb->add_column("power_unit_manufacturer", "PU Builder", 11);
      $tb->add_column("power_unit",              "Power Unit",    11);
      $tb->add_column("horse_power",             "BHP",            8);
      $tb->add_column("s_date",                  "Disposal Date", 10);

      while ($row = mysqli_fetch_assoc($result))
      {
        $row['b_date'] = fn_fdate($row['b_date']);
        $row['w_date'] = fn_fdate($row['w_date']);

        if ($row['preserved'] == "Y")
          $row['s_date'] = 'Preserved';
        else
          $row['s_date']  = fn_fdate($row['s_date']);

        $row['horse_power'] = fn_ncomma($row['horse_power'], "hp");

        $tb->add_data($row);
      }

      $tb->draw_table();
  }

  $db->close();

?>
</div>
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

