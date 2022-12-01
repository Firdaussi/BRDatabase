<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  
<html xmlns="www.w3.org/1999/xhtml">

<!--
Copyright: Darren Hester 2006, www.designsbydarren.com
License: Released Under the "Creative Commons License", 
creativecommons.org/licenses/by-nc/2.5/
-->

<head>

<!-- Site Title -->
<title>Locomotive Depots | Sheds | Manufacturers | Scrapyards | Railways | Locomotive Works | Swindon Works | Doncaster Works | Derby Works | Crewe Works | Gorton | Cowlairs | Eastleigh
</title>

<!-- Meta Data -->
<meta name = "pinterest" content = "nopin" description = "The rights for images on this website lie with the copyright holder, and not BRDatabase!" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="title" content="BRDatabase, locomotive allocations, withdrawals and scrapping details in the UK" />
<meta name="description" content="Locomotive history, railway statistics, steam, diesel and electric locomotives UK" />
<meta name="keywords" content="steam, diesel, electric, locomotives, railways, LNER, LMS, GWR, Southern, Stanier, Gresley, Collett, Maunsell, Bulleid, Churchward, Riddles, Britannia, locos, withdrawals, North British, Swindon, Crewe, Doncaster, Derby, Darlington, Eastleigh, Ashford, Brighton, Cowlairs, Inverurie, Gorton, Great Central, Great Northern, scrapping, allocations " />
<meta http-equiv="Content-Language" content="en-gb">

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
<script type="text/javascript" src="scripts/rollover.js">
</script>

</head>

<body>
<?php require_once "lib/quickdb.class.php"; require_once "lib/brlib.php"; fn_check_country($_SERVER['REMOTE_ADDR']); ?>
<div id="page_wrapper">

<div id="header_wrapper">

<div id="header">

<h1>BR<font color="#FFDF8C">Database</font></h1>
<h2>Complete British Locomotive Database 1923-1997</h2>

<!--
	<div id="right_side">
		<form method="get" id="searchform" action="">
			<div class="searchbox">
				<label for="s">Login:</label>
				<input type="text" value="" name="s" id="s" size="14" />
				<input type="text" value="" name="t" id="t" size="14" />
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

<h3>In Touch</h3>
<div class='featurebox_side'>
<!-- AddThis Button BEGIN -->
<script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
<a class="addthis_button" href="www.addthis.com/bookmark.php?v=250&amp;username=ij1001"><img src="s7.addthis.com/static/btn/sm-share-en.gif" width="83" height="16" alt="Bookmark and Share" style="border:0" /></a><script type="text/javascript" src="s7.addthis.com/js/250/addthis_widget.js#username=ij1001"></script>
<!-- AddThis Button END -->
<br /><br />
<a href="twitter.com/brdatabase"><img src="./images/twitter.png" width="83" height="16" alt="Follow BRDatabase on Twitter" style="border:0" /></a>
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

<h3>Counter</h3>
<div class='featurebox_side'>
<?php include "lib/counter.php"; ?>
</div><!-- end featurebox_side -->

</div><!-- end left_side-->

<div id="content">

<div class='featurebox_center'>
<?php

require_once "lib/quickdb.class.php";
require_once "lib/brlib.php";
require_once "lib/MyTables.class.php";

$db = fn_connectdb();

$debug = 0;

  // 5 possible parameters
  //   page      <$pg>      - month start 01-12
  //   subpage   <$subpage> - month end 01-12 or '-'
  //   id        <$id>      - id into a number of different tables, numeric or alphabetic
  //   lot       <$lot>     - Lot number (for builders)
  //   oid       <$oid>     - Order id (for builders)
  //   cid       <$cid>     - Class id (for scrapyards)
  //   mchnt     <$mchnt>   - Scrap merchant
  
  $pg = $subpage = $cid = $id = $lot = $oid = $mchnt = "";

  foreach ($_GET as $key => $value)
  {
    if ($key == "page")
    {
      $pg = $value;
      if (!empty($pg))
        fn_check_alpha($pg, 20);
    }
    else
    if ($key == "subpage")
    {
      $subpage = $value;
      if (!empty($subpage))
        fn_check_alpha($subpage, 20);
    }
    else
    if ($key == "id")
    {
      $id = $value;
      if (!empty($id))
        if (strcmp($id, "??"))
          fn_check_alnum($id, 12);
    }
    else
    if ($key == "lot")
    {
      $lot = $value;
      if (!empty($lot))
        fn_check_alnum($lot, 12);
    }
    else
    if ($key == "oid")
    {
      $oid = $value;
      if (!empty($oid))
        fn_check_id($oid, 9999);
    }
    else
    if ($key == "cid")
    {
      $cid = $value;
      if (!empty($cid))
        fn_check_id($cid, 799999);
    }
    else
    if ($key == "action")
    {
      $action = $value;
      if (!empty($action))
        fn_check_alpha($action, 12);
    }
    else
    if ($key == "mchnt")
    {
      $mchnt= $value;
      if (!empty($mchnt))
        fn_check_alnum($mchnt, 5);
    }
    else
    if ($key == "fbclid")
    {
    }
    else
      fn_poem($key, $value, 99);
  }

if ($debug == 1) echo "pg         '" . $pg . "'<br />";
if ($debug == 1) echo "id         '" . $id . "'<br />";
if ($debug == 1) echo "subpage    '" . $subpage . "'<br />";
if ($debug == 1) echo "lot        '" . $lot. "'<br />";
if ($debug == 1) echo "oid        '" . $oid. "'<br />";
if ($debug == 1) echo "action     '" . $action. "'<br />";

if (isset($pg) && !empty($pg))
{
  /****************************************************************

         #####   ######  #####    ####    #####   ####
         #    #  #       #    #  #    #     #    #
         #    #  #####   #    #  #    #     #     ####
         #    #  #       #####   #    #     #         #depot
         #    #  #       #       #    #     #    #    #
         #####   ######  #        ####      #     ####

   ****************************************************************/
  
  if ($pg == "depots")
  {
    $dep_page = $subpage;

    if (!empty($id))
    {
      $sql = 'select depot_name
              from   ref_depot 
              where  depot_id = ' . $id;

      $result = $db->execute($sql);

      if ($result)
      {
        $row = mysqli_fetch_assoc($result);

        if ($row)
          printf("<h3 align=center>Depot: %s</h3><br />\n", $row['depot_name']);
        $dep_name = $row['depot_name'];
      }

      //$sql = 'SELECT count(*) AS vlog
      //        FROM   log_visit lv
      //        WHERE  lv.depot_id = "' . $id . '"';
//
      //$result = $db->execute($sql);

      //$row = mysqli_fetch_assoc($result);

      //$vlog = $row['vlog'];
    }

    if (!empty($id))
    {
      $sql = 'SELECT count(*) AS ct
              FROM   ref_images
              WHERE  type = "A"
              AND    class_id = ' . $id;

      $result = $db->execute($sql);
      
      if ($result)
      {
        $row = mysqli_fetch_assoc($result);
        $imgct = $row['ct'];
      }
    }
    
    if ((!isset($dep_page) || empty($dep_page)) && empty($id))
    {
      if ($debug == 1) echo "Going to list<br />";
      
      include("includes/dep_list.inc.php");
    }
    else
    if ($dep_page == "main" || (empty($dep_page) && !empty($id)))
    {
      if ($debug == 1) echo "Going to main<br />";
      $arr = ["sub" => "Main", "id" => $id,]; fn_logit(6, $arr); unset($arr);
      include("includes/dep_main.inc.php");
    }
    else
    if ($dep_page == "locos")
    {
      if ($debug == 1) echo "Going to locos<br />";
      $arr = ["sub" => "Locos", "id" => $id,]; fn_logit(6, $arr); unset($arr);
      include("includes/dep_locos.inc.php");
    }
    else
    if ($dep_page == "snap")
    {
      if ($debug == 1) echo "Going to snapshot<br />";
      $arr = ["sub" => "Snapshot", "id" => $id,]; fn_logit(6, $arr); unset($arr);
      include("includes/dep_snap.inc.php");
    }
    else
    if ($dep_page == "arrdep")
    {
      if ($debug == 1) echo "Going to Arrivals/Departures<br />";
      $arr = ["sub" => "ArrDep", "id" => $id,]; fn_logit(6, $arr); unset($arr);
      include("includes/dep_arrdep.inc.php");
    }
    else
    if (($dep_page == "gallery") && $imgct > 0)
    {
      if ($debug == 1) echo "Going to Gallery<br />";
      $arr = ["sub" => "Gallery", "id" => $id,]; fn_logit(6, $arr); unset($arr);
      include("includes/dep_gallery.inc.php");
    }
    else
    if (($dep_page == "vlog" && !empty($id)) && $vlog != 0)
    {
      if ($debug == 1) echo "Going to visitlog<br />";
      $arr = ["sub" => "Vlog", "id" => $id,]; fn_logit(6, $arr); unset($arr);
      include("includes/dep_vlog.inc.php");
    }
  } /* Page = depots */
  else
  if ($pg == "builders")
  {

    /*********************************************************************

         #####   #    #     #    #       #####   ######  #####    ####
         #    #  #    #     #    #       #    #  #       #    #  #
         #####   #    #     #    #       #    #  #####   #    #   ####
         #    #  #    #     #    #       #    #  #       #####        #
         #    #  #    #     #    #       #    #  #       #   #   #    #
         #####    ####      #    ######  #####   ######  #    #   ####

     *********************************************************************/

    $bld_page = $subpage;
 
    if (!empty($id))
    {
      $sql = 'select bl_name
              from   ref_builders 
              where  bl_code = "' . $id. '"';

      $result = $db->execute($sql);

      $row = mysqli_fetch_assoc($result);

      if ($row)
        printf("<h3 align=center>Manufacturer: %s</h3><br />\n", $row['bl_name']);

      $sql = 'SELECT count(*) AS vlog
              FROM   ref_incident_groups ig
              WHERE  ig.bl_code = "' . $id . '"';

      $result = $db->execute($sql);

      $row = mysqli_fetch_assoc($result);

      $vlog = $row['vlog'];
    }

    if ((!isset($bld_page) || $bld_page == "") && empty($id))
    {
      if ($debug == 1) echo "Going to list<br />";
      $arr = ["sub" => "List", "id" => $id,]; fn_logit(7, $arr); unset($arr);
      include("includes/bld_list.inc.php");
    }
    else
    if ($bld_page == "main" || ($bld_page == "" && !empty($id)))
    {
      if ($debug == 1) echo "Going to main<br />";
      $arr = ["sub" => "Main", "id" => $id,]; fn_logit(7, $arr); unset($arr);
      include("includes/bld_main.inc.php");
    }
    else
    if ($bld_page == "locos")
    {
      if ($debug == 1) echo "Going to locos<br />";
      $arr = ["sub" => "Locos", "id" => $id,]; fn_logit(7, $arr); unset($arr);
      include("includes/bld_locos.inc.php");
    }
    else
    if ($bld_page == "orders")
    {
      if ($debug == 1) echo "Going to orders<br />";
      $arr = ["sub" => "Orders", "id" => $id,]; fn_logit(7, $arr); unset($arr);
      include("includes/bld_orders.inc.php");
    }
    else
    if ($bld_page == "group")
    {
      if ($debug == 1) echo "Going to group<br />";
      $arr = ["sub" => "Group", "id" => $id,]; fn_logit(7, $arr); unset($arr);
      include("includes/bld_group.inc.php");
    }
    else
    if (($bld_page == "vlog" && !empty($id)) && $vlog != 0)
    {
      if ($debug == 1) echo "Going to visitlog<br />";
      $arr = ["sub" => "Vlog", "id" => $id,]; fn_logit(7, $arr); unset($arr);
      include("includes/bld_vlog.inc.php");
    }
  }
  else

    /*****************************************************

       #    #   ####   #####   #    #   ####
       #    #  #    #  #    #  #   #   #
       #    #  #    #  #    #  ####     ####
       # ## #  #    #  #####   #  #         #
       ##  ##  #    #  #   #   #   #   #    #
       #    #   ####   #    #  #    #   ####

     *****************************************************/

  if ($pg == "works")
  {
    $wks_page = $subpage;

    if (!empty($id))
    {
      $sql = 'select bl_name
              from   ref_builders 
              where  bl_code = "' . $id. '"
              and    works_flag = "Y"';

      $result = $db->execute($sql);

      $row = mysqli_fetch_assoc($result);

      if ($row)
        printf("<h3 align=center>Works: %s</h3><br />\n", $row['bl_name']);
      $wks_name = $row['bl_name'];

      $sql = 'SELECT count(*) AS vlog
              FROM   ref_incident_groups ig
              WHERE  ig.bl_code = "' . $id . '"';

      $result = $db->execute($sql);

      $row = mysqli_fetch_assoc($result);

      $vlog = $row['vlog'];

      $sql = 'SELECT count(*) AS olog
              FROM   works_visits wv
              WHERE  wv.bl_code = "' . $id . '"';

      // disabled for performance reasons
      //$result = $db->execute($sql);

      //$row = mysqli_fetch_assoc($result);

      //$olog = $row['olog'];
      $olog = 0;

      $sql = 'SELECT count(*) as snap
              FROM   ref_builders
              WHERE  bl_code = "' . $id . '"
              AND    snapshot_flag = "Y"';

      $result = $db->execute($sql);

      $row = mysqli_fetch_assoc($result);

      $snap = $row['snap'];
    }

    if ((!isset($wks_page) || $wks_page == "") && empty($id))
    {
      if ($debug == 1) echo "Going to list<br />";
      $arr = ["sub" => "List", "id" => $id,]; fn_logit(8, $arr); unset($arr);
      include("includes/wks_list.inc.php");
    }
    else
    if ($wks_page == "main" || ($wks_page == "" && !empty($id)))
    {
      if ($debug == 1) echo "Going to main<br />";
      $arr = ["sub" => "Main", "id" => $id,]; fn_logit(8, $arr); unset($arr);
      include("includes/wks_main.inc.php");
    }
    else
    if ($wks_page == "locos" && !empty($id))
    {
      if ($debug == 1) echo "Going to locos<br />";
      $arr = ["sub" => "Locos", "id" => $id,]; fn_logit(8, $arr); unset($arr);
      include("includes/wks_locos.inc.php");
    }
    else
    if ($wks_page == "orders" && !empty($id))
    {
      if ($debug == 1) echo "Going to orders<br />";
      $arr = ["sub" => "Orders", "id" => $id,]; fn_logit(8, $arr); unset($arr);
      include("includes/wks_orders.inc.php");
    }
    else
    if (($wks_page == "vlog" && !empty($id)) && $vlog != 0)
    {
      if ($debug == 1) echo "Going to visitlog<br />";
      $arr = ["sub" => "Vlog", "id" => $id,]; fn_logit(8, $arr); unset($arr);
      include("includes/wks_vlog.inc.php");
    }
    else
    if (($wks_page == "olog" && !empty($id)) && $olog != 0)
    {
      if ($debug == 1) echo "Going to overhaullog<br />";
      $arr = ["sub" => "Olog", "id" => $id,]; fn_logit(8, $arr); unset($arr);
      include("includes/wks_olog.inc.php");
    }
    else
    if (($wks_page == "snap" && !empty($id)) && $snap != 0)
    {
      if ($debug == 1) echo "Going to snapshot<br />";
      $arr = ["sub" => "Snapshot", "id" => $id,]; fn_logit(8, $arr); unset($arr);
      include("includes/wks_snap.inc.php");
    }
  }
  else

    /******************************************************************************

      ####    ####   #####     ##    #####   #   #    ##    #####   #####    ####
     #       #    #  #    #   #  #   #    #   # #    #  #   #    #  #    #  #
      ####   #       #    #  #    #  #    #    #    #    #  #    #  #    #   ####
          #  #       #####   ######  #####     #    ######  #####   #    #       #
     #    #  #    #  #   #   #    #  #         #    #    #  #   #   #    #  #    #
      ####    ####   #    #  #    #  #         #    #    #  #    #  #####    ####

    *******************************************************************************/

  if ($pg == "scrapyards")
  {
    $scr_page = $subpage;

    if (strlen($id) == 5) // we've got a specific scrapyard
    {
      $sql = 'SELECT concat(sm.merchant_name, " ", sy.location) AS scrapyard_name,
                     sy.scrapyard_id
              FROM   ref_scrap_merchant sm
              JOIN   ref_scrapyard sy
              ON     sm.merchant_code = substr(sy.scrapyard_code, 1, 3)
              WHERE  sy.scrapyard_code = "' . $id . '"';

      $result = $db->execute($sql);

      $row = mysqli_fetch_assoc($result);

      if ($row)
        printf("<h3 align=center>Scrapyard: %s</h3><br />\n", $row['scrapyard_name']);
      $scr_name = $row['scrapyard_name'];

      if (!empty($row['scrapyard_id']))
      {
        $sql = 'SELECT count(*) AS ct
                FROM   ref_images
                WHERE  type = "X"
                AND    class_id = ' . $row['scrapyard_id'];

        $result = $db->execute($sql);
        $row = mysqli_fetch_assoc($result);
        $imgct = $row['ct'];
      }

      $sql = 'SELECT count(*) AS vlog
              FROM   ref_incident_groups ig
              WHERE  ig.scrapyard_code = "' . $id . '"';

      $result = $db->execute($sql);

      $row = mysqli_fetch_assoc($result);

      $vlog = $row['vlog'];
    }
    else
    if (strlen($id) == 3) // we've got the scrap merchant - display the group totals
    {
      $sql = 'SELECT sm.merchant_name AS merchant_name
              FROM   ref_scrap_merchant sm
              WHERE  sm.merchant_code = "' . $id . '"';

      $result = $db->execute($sql);

      $row = mysqli_fetch_assoc($result);

      if ($row)
        printf("<h3 align=center>Scrap Merchant: %s</h3><br />\n", $row['merchant_name']);
    }


    if ((!isset($scr_page) || $scr_page == "") && empty($id))
    {
      $arr = ["sub" => "List", "id" => $id,]; fn_logit(9, $arr); unset($arr);
      include("includes/scr_list.inc.php");
    }
    else
    if ($scr_page == "main" || ($scr_page == "" && !empty($id)))
    {
      $arr = ["sub" => "Main", "id" => $id,]; fn_logit(9, $arr); unset($arr);
      include("includes/scr_main.inc.php");
    }
    else
    if ($scr_page == "locos")
    {
      $arr = ["sub" => "Locos", "id" => $id,]; fn_logit(9, $arr); unset($arr);
      include("includes/scr_locos.inc.php");
    }
    else
    if ($scr_page == "summary")
    {
      $arr = ["sub" => "Summary", "id" => $id,]; fn_logit(9, $arr); unset($arr);
      include("includes/scr_summary.inc.php");
    }
    else
    if ($scr_page == "gallery")
    {
      $arr = ["sub" => "Gallery", "id" => $id,]; fn_logit(9, $arr); unset($arr);
      include("includes/scr_gallery.inc.php");
    }
    else
    if (($scr_page == "vlog" && !empty($id)) && $vlog != 0)
    {
      if ($debug == 1) echo "Going to visitlog<br />";
      $arr = ["sub" => "Vlog", "id" => $id,]; fn_logit(9, $arr); unset($arr);
      include("includes/scr_vlog.inc.php");
    }
  }
}

$db->close();

?>
</div>  <!-- close div featurebox_center -->
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

