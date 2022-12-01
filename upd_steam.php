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
<meta name="title" content="BRDatabase - locomotive allocations, withdrawals and scrapping details in the UK" />
<meta name="description" content="Locomotive history, railway statistics, steam, diesel and electric locomotives UK" />
<meta name="keywords" content="steam, diesel, electric, locomotives, railways, LNER, LMS, GWR, Southern, Stanier, Gresley, Collett, Maunsell, Bulleid, Churchward, Riddles, Britannia, locos, withdrawals, North British, Swindon, Crewe, Doncaster, Derby, Darlington, Eastleigh, Ashford, Brighton, Cowlairs, Inverurie, Gorton, Great Central, Great Northern, scrapping, allocations " />
<meta http-equiv="Content-Language" content="en-gb">

<!-- Site Title -->
<title>BRDatabase - the Complete British Railways Locomotive Database 1948-1997</title>

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
<?php include "master_menu.html"; ?>
</div><!-- end sidebarmenu -->

<h3>Quick Search</h3>

<p>
Enter locomotive number in the box below and press 'Go'!
</p>

<div id="bubble_tooltip">
	<div class="bubble_top"><span></span></div>
	<div class="bubble_middle"><span id="bubble_tooltip_content">Content is coming here as you probably can see.Content is comming here as you probably can see.</span></div>
	<div class="bubble_bottom"></div>
</div>


<div class='featurebox_side'>
<form method="get" action="locomotives.php">
	<input type="text" name="loconum" id="search-text" size="14" maxlength="100" /><br /><br />
	<input class="gobutton" type="submit" id="search-submit" value="Go" />
  <span class="bubble_tooltip" onmousemove="showToolTip(event,'Default search uses a wildcard. For a specific number use a # e.g. 306#');return false" onmouseout="hideToolTip()"> ?</span>
</form>

</div><!-- end featurebox_side -->

<h3>Counter</h3>
<div class='featurebox_side'>
Visitors: <script type="text/javascript" language="Javascript" src="counter/counter.php?page=index"></script>
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

<h3>Updating Steam Locomotive Details<h3>

<div class='featurebox_center'>

<?php

  require_once "lib/quickdb.class.php";
  require_once "lib/MyTables.class.php";
  require_once "lib/brlib.php";

  $db = fn_connectdb();

  $action = 0;

  // Check if this is a submitted form
  if ( isset($_REQUEST['Action']) && !empty($_REQUEST['Action']))
  {
//    print_r($_REQUEST); echo "<br />";

    $act = $_REQUEST['Action']; // print "Action is: " . $act . "<br />";

    if (strncmp($act, "Update_", 7) == 0)
    {
      $action = 1;
      list($idx) = sscanf($act, "Update_%d");
//      echo "Update index " . $idx . "<br />";
    }
    else
    if (strncmp($act, "Delete_", 7) == 0)
    {
      $action = 2;
      list($idx) = sscanf($act, "Delete_%d");
//      echo "Delete index " . $idx . "<br />";
    }
    else
    if (strncmp($act, "Insert_", 7) == 0)
    {
      $action = 3;
      list($idx) = sscanf($act, "Insert_%d");
//      echo "Insert index " . $idx . "<br />";
    }
    else
      die("Unknown action from form!");

    if (isset($_REQUEST['loco_id'][0]) && !empty($_REQUEST['loco_id'][0]))
      $id = $_REQUEST['loco_id'][0];

    if (isset($_REQUEST['page']) && !empty($_REQUEST['page']))
      $page = $_REQUEST['page'];
  }
  else
  {
    if ((isset($_GET['page']) && !empty($_GET['page'])) &&
        (isset($_GET['id'])   && !empty($_GET['id'])))
    {
      $page = $_GET['page'];
      $id   = $_GET['id'];
    }
    else
    if ((isset($_POST['page']) && !empty($_POST['page'])) &&
        (isset($_POST['id'])   && !empty($_POST['id'])))
    {
      $page = $_POST['page'][0];
      $id   = $_POST['id'][0];
    }
  }

  if (!isset($id) || empty($id))
    die("loco_id not provided");

  if (isset($upd) && !empty($upd))
    printf("Updating record for loco id %s<br />", $upd);

  if ($page == "upd_loco_nums")
  {
    printf("<h4>Editing Numbers!</h4><br />");

    require_once "lib/formSql.class.php";

    $form = new formSql($db->get_connection());
    $form->define_table("s_nums");

    if ($action)
      $form->do_action($_REQUEST);

    $form->run_query("SELECT * FROM S_NUMS WHERE LOCO_ID = " . $id . 
                     " ORDER BY START_DATE ASC");
    $form->show_form($_SERVER['PHP_SELF'], "upd_loco_nums");
  }
  else
  if ($page == "upd_loco_spec")
  {
    printf("<h4>Editing Specifics</h4><br />");
    require_once "lib/formSql.class.php";

    $form = new formSql($db->get_connection());
    $form->define_table("steam");

    if ($action)
      $form->do_action($_REQUEST);

    $form->run_query("SELECT * FROM S_ALLOC WHERE LOCO_ID = " . $id . 
                     " ORDER BY ALLOC_DATE ASC");
    $form->show_form($_SERVER['PHP_SELF'], "upd_loco_alloc");
  }
  else
  if ($page == "upd_loco_alloc")
  {
    printf("<h4>Editing Allocations</h4><br />");

    require_once "lib/formSql.class.php";

    $form = new formSql($db->get_connection());
    $form->define_table("s_alloc");

    if ($action)
      $form->do_action($_REQUEST);

    $form->run_query("SELECT * FROM S_ALLOC WHERE LOCO_ID = " . $id . 
                     " ORDER BY ALLOC_DATE ASC");
    $form->show_form($_SERVER['PHP_SELF'], "upd_loco_alloc");
  }
  else
  if ($page == "upd_loco_mods")
  {
    printf("<h4>Editing Mods</h4><br />");
    require_once "lib/formSql.class.php";

    $form = new formSql($db->get_connection());
    $form->define_table("s_mods");
    $form->define_lookup("modification", "modification", "modifications", "description");

    if ($action)
      $form->do_action($_REQUEST);

    $form->run_query("SELECT * FROM S_MODS WHERE LOCO_ID = " . $id . 
                     " ORDER BY DATE_MODIFIED ASC");
    $form->show_form($_SERVER['PHP_SELF'], "upd_loco_mods");
  }
  else
  if ($page == "upd_loco_liv")
  {
    printf("<h4>Editing Liveries</h4><br />");
    require_once "lib/formSql.class.php";

    $form = new formSql($db->get_connection());
    $form->define_table("s_to_livery");

    if ($action)
      $form->do_action($_REQUEST);

    $form->run_query("SELECT * FROM S_TO_LIVERY WHERE LOCO_ID = " . $id . 
                     " ORDER BY START_DATE ASC");
    $form->show_form($_SERVER['PHP_SELF'], "upd_loco_liv");
  }
  else
  if ($page == "upd_loco_names")
  {
    printf("<h4>Editing Names</h4><br />");
    require_once "lib/formSql.class.php";

    $form = new formSql($db->get_connection());
    $form->define_table("s_name");

    if ($action)
      $form->do_action($_REQUEST);

    $form->run_query("SELECT * FROM S_NAME WHERE LOCO_ID = " . $id . 
                     " ORDER BY START_DATE ASC");
    $form->show_form($_SERVER['PHP_SELF'], "upd_loco_names");
  }
  else
  if ($page == "upd_loco_pres")
  {
    printf("<h4>Editing Preservation Details</h4><br />");
    require_once "lib/formSql.class.php";

    $form = new formSql($db->get_connection());
    $form->define_table("preservation");

    if ($action)
      $form->do_action($_REQUEST);

    $form->run_query("SELECT * FROM PRESERVATION WHERE LOCO_ID = " . $id . 
                     " AND TYPE = 'D' ORDER BY DATE_PRESERVED ASC");
    $form->show_form($_SERVER['PHP_SELF'], "upd_loco_pres");
  }
  else
  if ($page == "upd_loco_tender")
  {
    printf("<h4>Editing Tenders</h4><br />");
    require_once "lib/formSql.class.php";

    $form = new formSql($db->get_connection());
    $form->define_table("s_to_tender");
    $form->define_lookup("tender_id", "tender_id", "tender", "tender_type");

    if ($action)
      $form->do_action($_REQUEST);

    $form->run_query("SELECT * FROM S_TO_TENDER WHERE LOCO_ID = " . $id . 
                     " ORDER BY DATE_FROM ASC");
    $form->show_form($_SERVER['PHP_SELF'], "upd_loco_tender");
  }
  else
  if ($page == "upd_loco_inc")
  {
    printf("<h4>Editing Incidents</h4><br />");
    require_once "lib/formSql.class.php";

    $form = new formSql($db->get_connection());
    $form->define_table("s_to_i");
//    $form->define_lookup("inc_id", "inc_id", "incidents", "inc_id");

    if ($action)
      $form->do_action($_REQUEST);

    $form->run_query("SELECT * FROM S_TO_I WHERE LOCO_ID = " . $id);
    $form->show_form($_SERVER['PHP_SELF'], "upd_loco_inc");
  }
  else
  if ($page == "upd_loco_notes")
  {
    printf("<h4>Editing Notes</h4><br />");
    require_once "lib/formSql.class.php";

    $form = new formSql($db->get_connection());
    $form->define_table("s_notes");

    if ($action)
      $form->do_action($_REQUEST);

    $form->run_query("SELECT * FROM S_NOTES WHERE LOCO_ID = " . $id); 
    $form->show_form($_SERVER['PHP_SELF'], "upd_loco_notes");
  }
  else
  {
    printf("No action specified<br />");
  }

?>

</div> 
</div><!-- end content -->

<div id="footer">

  <a href="index.php">Home</a> |
  <a href="lazarus/index.php">Guestbook</a> |
  <a href="contact.php">Contact</a> |
  <a href="links.php">Links</a> |
  <a href="preferences.php">Preferences</a><br />
Website Copyright(C) 2010-12 BRDatabase.info
<br />
</div><!-- end footer -->

</div><!-- end page_wrapper -->

</body>

</html>

