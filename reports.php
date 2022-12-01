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
<title>BRDatabase: Miscellaneous Reports
</title>

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

<h3>Miscellaneous Reports</h3>

<div class="featurebox_center">


<?php

  // 1 possible parameter
  //   rpopt   <$option>   - report option
  
  $rpopt = "";

  foreach ($_GET as $key => $value)
  {
    if ($key == "rpopt")
    {
      $option = $value;
      if (!empty($option))
        fn_check_digit($option, 3);
    }
    else
    if ($key == "fbclid")
    {
    }
    else
      fn_poem($key, $value, 99);
  }
  
  if (!empty($option))
  {
    require_once "lib/quickdb.class.php";
    require_once "lib/MyTables.class.php";
    require_once "lib/brlib.php";
    
    fn_check_digit($option);

    switch ($option)
    {
      case 8:
        include "includes/rep08.php";
        break;
      case 10:
        include "includes/rep10.php";
        break;
      case 11:
        include "includes/rep11.php";
        break;
      case 13:
        include "includes/rep13.php";
        break;
      case 14:
        include "includes/rep14.php";
        break;
      case 15:
        include "includes/rep15.php";
        break;
      case 16:
        include "includes/rep16.php";
        break;
      case 17:
        include "includes/rep17.php";
        break;
      case 18:
        include "includes/rep18.php";
        break;
      default:
        echo "<p>Sorry - this report is not yet available.</p>";
        die("");
        break;
    }
  }
    

?>

<p>The following reports are available. </p>

<div class='featurebox_center'>

<ul>
  <li><i>Build dates and withdrawal dates of several classes combined</i>
  <li><i>Weight/Height/Length/Wheelbase/Wheel Diameter comparisons of locomotive classes</i>
  <li><i>Maximum speed of locomotive classes</i>
  <li><i>Diesel locomotive classes by Power Unit</i>
  <li><a href="reports.php?rpopt=10">Western Region Diesel Hydraulics lifespan</a>
  <li><a href="reports.php?rpopt=11">Class 52 'Western' Liveries</a>
  <li><i>Timelines graph of up to ten classes of locomotive</i>
  <li><i>Locomotive classes by longevity</i>
  <li><i>Individual locomotives by longevity</i>
  <li><a href="reports.php?rpopt=08">LNWR 0-8-0/2-8-0 rebuilds</a>
  <li><i>Snapshot of All Locomotives by Class on a user defined date</i>
  <li><i>Great Western 4-6-0 identification</i>
  <li><a href="reports.php?rpopt=13">Early Casualties - Diesel and Electric</a>
  <li><a href="reports.php?rpopt=14">Robinson GCR Class 8K/8M 2-8-0 (LNER Class O4/O5/O1) and ROD derivatives</a>
  <li><a href="reports.php?rpopt=15">Brush Type 2 (Class 30/31) re-engine schedule: Mirrlees to English Electric</a>
  <li><a href="reports.php?rpopt=16">Brush Type 2 (Class 30/31) headcode style</a>
  <li><a href="reports.php?rpopt=17">NBL Type 2 (Class 21/29) re-engine schedule: MAN to Paxman</a>
  <li><a href="reports.php?rpopt=18">Incidents of fires on diesel locomotives, 1961-1964</a>
</ul>

</div>

<p>If there are any reports you would like to see, please contact me - see the Contact tab above.</p>

</div><!-- featurebox_center -->

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

