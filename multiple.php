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

<div class='featurebox_center'>

<?php
  require_once "lib/quickdb.class.php";
  require_once "lib/MyTables.class.php";
  require_once "lib/brlib.php";
  
  // 2 possible parameters
  //   type      <$type>    - DMU, EMU etc...
  //   subtype   <$subtype> - e.g. GWCAR
  
  $type = $subtype = "";

  foreach ($_GET as $key => $value)
  {
    if ($key == "type")
    {
      $type = strtoupper($value);
      if (!empty($type))
        fn_check_type($type);
    }
    else
    if ($key == "subtype")
    {
      $subtype = strtoupper($value);
      if (!empty($subtype))
        fn_check_alnum($subtype, 7);
    }
    else
      fn_poem($key, $value, 99);
  }
  
  if (!isset($type) || empty($type))
    $type = "ALL";
    
  if (!isset($subtype) || empty($subtype))
    $subtype = "ALL";
  
  $db = fn_connectdb();
  $tb = new MyTables("Railcars");

  if ($type == "SRM")
  {
  }
  else
  if ($type == "DMU")
  {
//	  echo $subtype;
    if ($subtype == "GWCAR")
    {
      printf("<h4>Diesel multiple units - Great Western railcars</h4><br />");
      $asql = ' where dc.type = "GWRcar" ';
    }
    else
    if ($subtype == "LNCAR")
    {
      printf("<h4>Diesel multiple units - London North Eastern railcars</h4><br />");
      $asql = ' where dc.type = "LNERcar" ';
    }
    else
    if ($subtype == "DMU1")
    {
      printf("<h4>Diesel multiple units - 1st Generation DMU's</h4><br /><br />");
      $asql = ' where dc.type = "1stGen" ';
    }
    else
    if ($subtype == "DMU2")
    {
      printf("<h4>Diesel multiple units - 2nd Generation DMU's</h4><br />");
      $asql = ' where dc.type = "2ndGen" ';
    }
    else
    if ($subtype == "DEMU")
    {
      printf("<h4>Diesel multiple units - Diesel Electric Multiple Units</h4><br />");
      $asql = ' where dc.type = "DEMU" ';
    }
    else
    if ($subtype == "PULLMAN")
    {
      printf("<h4>Diesel multiple units - Midland and Western Region Pullman Sets</h4><br />");
      $asql = ' where dc.type = "Pullman" ';
    }
    else
    if ($subtype == "HST")
    {
      printf("<h4>Diesel multiple units - High Speed Train Sets (InterCity 125)</h4><br />");
      $asql = ' where dc.type = "HST" ';
    }
    else
    {
      printf("<ul><li><a href=\"%s?type=DMU&subtype=GWCAR\">Great Western railcars</a></li>\n", $PHP_SELF);
      printf("    <li><a href=\"%s?type=DMU&subtype=LNCAR\">London North Eastern railcars</a></li>\n", $PHP_SELF);
      printf("    <li><a href=\"%s?type=DMU&subtype=DMU1\">1st Generation DMU's</a></li>\n", $PHP_SELF);
      printf("    <li><a href=\"%s?type=DMU&subtype=DMU2\">2nd Generation DMU's</a></li>\n", $PHP_SELF);
      printf("    <li><a href=\"%s?type=DMU&subtype=DEMU\">Diesel Electric Multiple Units</a></li>\n", $PHP_SELF);
      printf("    <li><a href=\"%s?type=DMU&subtype=Pullman\">Midland and Western Region Pullman Sets</a></li>\n", $PHP_SELF);
      printf("    <li><a href=\"%s?type=DMU&subtype=HST\">High Speed Train Sets (InterCity 125)</a></li></ul>\n", $PHP_SELF);
    }
    
    $sql = 'select dc.dmu_class_id,
                   dc.identifier                           AS identifier,
                   concat("locoqry.php?action=class&amp;type=DMU&amp;id=",dc.dmu_class_id)     AS identifier_hl,
                   dc.common_name                          AS common_name,
                   concat("locoqry.php?action=class&amp;type=DMU&amp;id=",dc.dmu_class_id)     AS common_name_hl,
                   dc.year_introduced                      AS year_introduced,
                   dc.wheel_arrangement                    AS wheel_arrangement,
		               concat("misc.php?page=wheelarr&amp;id=",
		                      dc.wheel_arrangement)            AS wheel_arrangement_hl,
                   dc.number_range                         AS number_range,
		               concat("locoqry.php?action=class&amp;type=DMU&amp;id=", dc.dmu_class_id,
			                    "&amp;page=fleet")                   AS number_range_hl,
                   dc.dmu_count                           AS dmu_count,
                   " "                                     AS thumbnail,
                   concat("images/MU/diesel/thumbs/tn_", i.image)
                                                           AS thumbnail_img,
                   concat("locoqry.php?action=class&amp;id=",
		                      dc.identifier,
                          "&amp;type=DMU&amp;id=",dc.dmu_class_id)     AS thumbnail_hl,

                   CASE WHEN dcv.power_unit_number = 1 THEN
                             concat(coalesce(m.short_name, m.name), " ", 
                                    pu.model)
                        ELSE
                             concat(coalesce(m.short_name, m.name), " ",
                                    dcv.power_unit_number,          " x ",
                                    pu.model)
                   END                                     AS power_unit_desc,
                   dcv.transmission_type                   AS transmission_type,
                   dcv.multiple_working                    AS multiple_working,
                   CASE WHEN dcv.power_unit_number IS NOT NULL THEN
                             dcv.power_unit_number * pu.horse_power
                   ELSE
                              NULL
                   END                                     AS horse_power

            from   dmu_class dc

            JOIN   dmu_class_var dcv
            ON     dcv.dmu_class_id = dc.dmu_class_id
            AND    dcv.dmu_class_var_id = 1

            LEFT JOIN ref_images i
            ON     i.type = "DMU"
            AND    i.class_id = dc.dmu_class_id
            AND    i.img_index = "Y"

            LEFT JOIN ref_power_units pu
            ON     pu.pu_id = dcv.pu_id

            LEFT JOIN ref_manufacturer m
            ON     m.manufacturer_id = pu.manufacturer_id'

            . $asql .
            ' ORDER BY dc.type, dc.sort_order';

//            echo $sql;

    $result = $db->execute($sql);
    $numrows= $db->count_select();

    $total_count = 0;

    $tb->allow_rollover();
    $tb->sortable();
    $tb->add_column("identifier",        "Class",         5);
    $tb->add_column("year_introduced",   "Introduced",    5);
    $tb->add_column("manufacturer",      "Manufacturer", 18);
    $tb->add_column("power_unit_desc",   "Power Unit",   18);
    $tb->add_column("horse_power",       "Horse Power",   5);
    $tb->add_column("wheel_arrangement", "Wheels",        5);
    $tb->add_column("transmission_type", "Transmission",  9);
    $tb->add_column("number_range",      "Number Range", 13);
    $tb->add_column("loco_count",        "Number",        4);
    $tb->add_column("multiple_working",  "Multiple",      8);
    $tb->add_column("thumbnail",         "Thumbnail",    10);

    $count = 0; $lastid = 0;
    
    while ($row = mysqli_fetch_assoc($result))
    {
      if ($row['dmu_class_id'] == $lastid)
      {
        /* Same class as previous row */
      }

      $tb->add_data($row);
      $lastid = $row['dmu_class_id'];
    }

    if ($numrows)
      $tb->draw_table();
  }
  else
  if ($type == "EMU")
  {
  }
  else
  if ($type == "ALL")
  {
    // default page requested
    printf("<h4>Multiple Units and Railmotors Page</h4>");
    printf("<p><br />  1) Steam railmotors, covering pre-grouping, LMS, LNER, GWR and SR");
    printf("   <br />  2) Diesel multiple units and single vehicles (including GWR railcars)");
    printf("   <br />  3) Electric multiple units and single vehicles, including IOW</p>");
    printf("<ul><li><a href=\"%s?type=SRM\">Steam Railmotors</a></li>\n", $PHP_SELF);
    printf("    <li><a href=\"%s?type=DMU\">Diesel Multiple Units</a></li>\n", $PHP_SELF);
    printf("    <li><a href=\"%s?type=EMU\">Electric Multiple Units</a></li></ul>\n", $PHP_SELF);
    die(1);
  }
  
?>

</div><!-- end featurebox_center -->

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

