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
		@import "css/rollover.css";
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

<!--
<script type="text/javascript" src="scripts/rollover.js"></script>
-->

<script type="text/javascript" src="scripts/calendar.js"></script>

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
  require_once "lib/brlib.php";
  require_once("lib/MyTables.class.php");
  
  $db = fn_connectdb();

  // 5 possible parameters
  //   id        <$id>       - person id
  //   type      <$type>     - loco type
  //   action    <$act>      - action to be taken - locodata, class etc...
  //   page      <$cls_page> - 
  //   loco      <$loco>     - not used
  
  $page = $id = $action = $cls_page = $loco = $var = $fclid = "";

  foreach ($_GET as $key => $value)
  {
    if ($key == "type")
    {
      $type = strtoupper($value);
      if (!empty($type))
        fn_check_type($type);
    }
    else
    if ($key == "id")
    {
      $id = $value;
      if (!empty($id))
        fn_check_id($id, 999999999);
    }
    else
    if ($key == "action")
    {
      $act = $value;
      if (!empty($act))
        fn_check_alpha($act, 15);
    }
    else
    if ($key == "loco")
    {
      $loco = $value;
      if (!empty($loco))
        fn_check_alnum($loco, 12);
    }
    else
    if ($key == "page")
    {
      $cls_page = $value;
      if (!empty($cls_page))
        fn_check_alpha($cls_page, 15);
    }
    else
    if ($key == "var")
    {
      $var = $value;
      if (!empty($var))
        fn_check_digit($var, 2);
    }
    else
    if ($key == "fbclid")
    {
    }
    else
    if ($key == "ad")
    {
    }
    else
    if ($key == "sc")
    {
    }
    else
      fn_poem($key, $value, 99);
  }

  if (empty($cls_page))
    $cls_page = "main";

  //echo "type:    " . $type . "<br />";
  //echo "id:      " . $id   . "<br />";
  //echo "act:     " . $act  . "<br />";
  //echo "page:    " . $cls_page . "<br />";
  //echo "loco:    " . $loco . "<br />";

$debug = 0;

//  if ($debug)
//    debug_memory('Start (locoqry.m)');

if (!empty($act))
{
  $err=0;

  if ($err==0)
  {
    if ($act == "locodata")
    {
      include ("includes/locodata.inc.php");
    }
    else
    if ($act == "class")
    {
      fn_check_id($id, 999999);
        
      if ($type == 'S')
      {
        $sql = 'SELECT sc.page_renum,
                       sc.page_reclass,
                       sc.page_subclass,
                       sc.page_snapshot,
                       sc.identifier,
                       sc.common_name,
                       sc.prg_company,
                       sc.big4_company,
                       sc.br_standard,
                       sc.wheel_arrangement,
                       p.surname,
                       snn.nickname
                FROM   s_class sc
                LEFT JOIN ref_people p
                ON     p.p_id = sc.designer_id
                LEFT JOIN s_class_nn snn
                ON     snn.s_class_id = sc.s_class_id
                AND    snn.principal = "Y"
                WHERE  sc.s_class_id = ' .$id;

        $result = $db->execute($sql);

        if ($db->count_select())
        {
          $row = mysqli_fetch_assoc($result);

          if ($row)
          {
            $inc_p_renumber = $row['page_renum'];
            $inc_p_rebuild  = $row['page_reclass'];
            $inc_p_reclass  = $row['page_subclass'];
            $inc_p_snapshot = $row['page_snapshot'];
  
            $title = fn_fmt_s_class($row);

            printf("<h3 align=center>%s</h3><br />\n", $title);
          }
        }
      }
      else
      if ($type == "D")
      {
        $inc_p_renumber = $inc_p_rebuild = $inc_p_reclass = "N";
        
        $sql = 'SELECT dc.page_renum,
                       dc.page_reclass,
                       dc.page_subclass,
                       dc.identifier,
                       dc.wheel_arrangement,
                       dcv.manufacturer
                FROM   d_class dc
                JOIN   d_class_var dcv
                ON     dcv.d_class_id = dc.d_class_id
                AND    dcv.d_class_var_id = 1
                WHERE  dc.d_class_id = ' .$id;

        $result = $db->execute($sql);

        if ($db->count_select())
        {
          $row = mysqli_fetch_assoc($result);

          if ($row)
          {
            $heading = "";
            $inc_p_renumber = $row['page_renum'];
            $inc_p_rebuild  = $row['page_reclass'];
            $inc_p_reclass  = $row['page_subclass'];

            if (!empty($row['manufacturer']))
              $heading = $row['manufacturer'];
            if (!empty($row['power_unit_manufacturer']))
              $heading .= "/" . $row['power_unit_manufacturer'] . " ";
            if (!empty($row['identifier']))
              $heading .= " " . $row['identifier'];
            if (!empty($row['wheel_arrangement']))
              $heading .= " " . $row['wheel_arrangement'];

            printf("<h3 align=center>%s</h3><br />\n", $heading);
          }
        }
      }
      else
      if ($type == "E")
      {
        $inc_p_renumber = $inc_p_rebuild = $inc_p_reclass = "N";
        
        $sql = 'SELECT ec.page_renum,
                       ec.page_reclass,
                       ec.page_subclass,
                       ec.identifier,
                       ec.wheel_arrangement,
                       ecv.manufacturer
                FROM   e_class ec
                JOIN   e_class_var ecv
                ON     ecv.e_class_id = ec.e_class_id
                AND    ecv.e_class_var_id = 1
                WHERE  ec.e_class_id = ' .$id;

        $result = $db->execute($sql);

        if ($db->count_select())
        {
          $row = mysqli_fetch_assoc($result);

          if ($row)
          {
            $inc_p_renumber = $row['page_renum'];
            $inc_p_rebuild  = $row['page_reclass'];
            $inc_p_reclass  = $row['page_subclass'];

            if (!empty($row['manufacturer']))
              $heading = $row['manufacturer'];
            if (!empty($row['power_unit_manufacturer']))
              $heading .= "/" . $row['power_unit_manufacturer'] . " ";
            if (!empty($row['identifier']))
              $heading .= " " . $row['identifier'];
            if (!empty($row['wheel_arrangement']))
              $heading .= " " . $row['wheel_arrangement'];

            printf("<h3 align=center>%s</h3><br />\n", $heading);
          }
        }
      }
      else
      if ($type == "DMU")
      {
        $inc_p_renumber = $inc_p_rebuild = $inc_p_reclass = "N";
        
        $sql = 'SELECT dc.page_renum,
                       dc.page_reclass,
                       dc.page_subclass,
                       dc.identifier,
                       dc.wheel_arrangement,
                       dcv.manufacturer
                FROM   dmu_class dc
                JOIN   dmu_class_var dcv
                ON     dcv.dmu_class_id = dc.dmu_class_id
                AND    dcv.dmu_class_var_id = 1
                WHERE  dc.dmu_class_id = ' .$id;

        $result = $db->execute($sql);

        if ($db->count_select())
        {
          $row = mysqli_fetch_assoc($result);

          if ($row)
          {
            $heading = "";
            $inc_p_renumber = $row['page_renum'];
            $inc_p_rebuild  = $row['page_reclass'];
            $inc_p_reclass  = $row['page_subclass'];

            if (!empty($row['manufacturer']))
              $heading = $row['manufacturer'];
            if (!empty($row['power_unit_manufacturer']))
              $heading .= "/" . $row['power_unit_manufacturer'] . " ";
            if (!empty($row['identifier']))
              $heading .= " " . $row['identifier'];
            if (!empty($row['wheel_arrangement']))
              $heading .= " " . $row['wheel_arrangement'];

            printf("<h3 align=center>%s</h3><br />\n", $heading);
          }
        }
      }

      if (!isset($cls_page) || $cls_page == "" || $cls_page == "main")
      {
        $arr = ["sub" => "Main", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_main.inc.php");
      }
      else
      if ($cls_page == "gallery")
      {
        $arr = ["sub" => "Gallery", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_gallery.inc.php");
      }
      else
      if ($cls_page == "graphs")
      {
        $arr = ["sub" => "Graphs", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_graphs.inc.php");
      }
      else
      if ($cls_page == "history")
      {
        $arr = ["sub" => "History", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_history.inc.php");
      }
      else
      if ($cls_page == "alloc")
      {
        $arr = ["sub" => "Alloc", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_alloc.inc.php");
      }
      else
      if ($cls_page == "mods")
      {
        $arr = ["sub" => "Mods", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_mods.inc.php");
      }
      else
      if ($cls_page == "fleet")
      {
        $arr = ["sub" => "Fleet", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_fleet.inc.php");
      }
      else
      if ($cls_page == "snapshot")
      {
        $arr = ["sub" => "Snapshot", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_snapshot.inc.php");
      }
      else
      if ($cls_page == "detailed")
      {
        $arr = ["sub" => "Detailed", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_detailed.inc.php");
      }
      else
      if ($cls_page == "cycle")
      {
        $arr = ["sub" => "Cycle", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_cycle.inc.php");
      }
      else
      if ($cls_page == "daytoday")
      {
        $arr = ["sub" => "DayToDay", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_daytoday.inc.php");
      }
      else
      if ($cls_page == "rebuilds")
      {
        $arr = ["sub" => "Rebuilds", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_rebuilds.inc.php");
      }
      else
      if ($cls_page == "renumber")
      {
        $arr = ["sub" => "Renumber", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_renumber.inc.php");
      }
      else
      if ($cls_page == "reclass")
      {
        $arr = ["sub" => "Reclass", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_reclass.inc.php");
      }
      else
      if ($cls_page == "preservation")
      {
        $arr = ["sub" => "Preservation", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_preservation.inc.php");
      }
      else
      if ($cls_page == "names")
      {
        $arr = ["sub" => "Names", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_names.inc.php");
      }
      else
      if ($type == "DMU" && $cls_page == "formations")
      {
        $arr = ["sub" => "Formations", "id" => $type . $id]; fn_logit(13, $arr); unset($arr);
        include("includes/cls_formations.inc.php");
      }
    }
    else
    if ($act == "withdrawals")
    {
      include("includes/withdrawals.inc.php");
    }
    else
    if ($act == "build")
    {
      include("includes/build.inc.php");
    }
    else
    {
      echo "<br />Unknown tag: " .$act;
    }
  }
  
  $db->close();
}

  if ($debug)
    debug_memory('Tidy (locoqry.m)');

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

