<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php ob_start('ob_gzhandler'); error_reporting(0); ?>  
<html xmlns="http://www.w3.org/1999/xhtml">

<!--
Copyright: Darren Hester 2006, http://www.designsbydarren.com
License: Released Under the "Creative Commons License", 
http://creativecommons.org/licenses/by-nc/2.5/
-->

<head>

<!-- Meta Data -->
<meta name = "pinterest" content = "nopin" description = "The rights for images on this website lie with the copyright holder, and not BRDatabase!" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="Short description of your site here." />
<meta name="keywords" content="keywords, go, here, seperated, by, commas" />

<!-- Site Title -->
<title>BRDatabase - the Complete British Railways Locomotive Database 1948-1997</title>

<!-- Link to Style External Sheet -->

<style type="text/css">
		@import "css/nestedsidebar.css";
		@import "css/style.css";
</style>

<link rel="stylesheet" href="css/bubble-tooltip.css" media="screen">

<script type="text/javascript" src="scripts/bubble-tooltip.js"></script>

<script type="text/javascript" src="scripts/sorttable.js"></script>

<script type="text/javascript">

//Nested Side Bar Menu (Mar 20th, 09)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

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

</script>


</head>

<body>
<?php require_once "lib/quickdb.class.php"; require_once "lib/brlib.php"; fn_check_country($_SERVER['REMOTE_ADDR']); ?>
<div id="page_wrapper">

<div id="header_wrapper">

<div id="header">

<h1>BR<font color="#FFDF8C">Database</font></h1>
<h2>Complete BR Locomotive Database 1948-1997</h2>

</div><!-- end header -->

<div id="navcontainer">

<ul id="navlist">
<li><a href="index.php">Home</a></li>
<li><a href="contribute.php">Contribute</a></li>
<li><a href="lazarus/index.php">Guestbook</a></li>
<li id="active"><a href="#" id="current">Forum</a></li>
<li><a href="contact.php">Contact</a></li>
<li><a href="links.php">Links</a></li>
<li><a href="preferences.php">Preferences</a></li>
</ul>
</div><!-- end navcontainer -->

</div><!-- end header_wrapper -->

<div id="left_side">

<h3>Menu</h3>
<div class="sidebarmenu">
<ul id="sidebarmenu1">
  <li><a href="locomotives.php">Locomotives</a>
    <ul>
      <li><a href="build.php">Build Dates</a></li>
      <li><a href="withdrawals.php">Withdrawals</a></li>
      <li><a href="names.php">Names</a></li>
      <li><a href="snapshots.php">Snapshots</a>
        <ul>
          <li><a href="snapshots.php?page=locos">Locomotives</a></li>
          <li><a href="snapshots.php?page=workings">Workings</a></li>
        </ul>
      </li>
      <li><a href="reclassified.php">ReClassifications</a></li>
      <li><a href="pilot.php">Pilot Scheme</a></li>
      <li><a href="prototypes.php">Prototypes</a></li>
      <li><a href="preservation.php">Preservation</a>
	    <ul>
		    <li><a href="preservation.php?type=D">Diesels</a></li>
		    <li><a href="preservation.php?type=E">Electrics</a></li>
		    <li><a href="preservation.php?type=S">Steam</a></li>
		  </ul>
      </li>
    </ul>
  </li>
  <li><a href="classes.php">Classes</a>
    <ul>
      <li><a href="classes.php?type=S">Steam</a>
	    <ul>
		  <li><a href="classes.php?type=S&subtype=Standards">Standards</a></li>
		  <li><a href="classes.php?type=S&subtype=GWR">ex GWR</a>
        <ul>
          <li><a href="classes.php?type=S&subtype=GWR&prg=TVR">ex Taff Vale</a></li>
          <li><a href="classes.php?type=S&subtype=GWR&prg=RR">ex Rhymney</a></li>
          <li><a href="classes.php?type=S&subtype=GWR&prg=CambR">ex Cambrian</a></li>
          <li><a href="classes.php?type=S&subtype=GWR&prg=BaR">ex Barry</a></li>
        </ul>
      </li>
		  <li><a href="classes.php?type=S&subtype=SR">ex SR</a>
        <ul>
          <li><a href="classes.php?type=S&subtype=SR&prg=LSWR">ex LSWR</a></li>
          <li><a href="classes.php?type=S&subtype=SR&prg=LBSCR">ex LBSCR</a></li>
          <li><a href="classes.php?type=S&subtype=SR&prg=SECR">ex SECR</a></li>
        </ul>
      </li>
		  <li><a href="classes.php?type=S&subtype=LNER">ex LNER</a>
        <ul>
          <li><a href="classes.php?type=S&subtype=LNER&prg=GER">ex GER</a></li>
          <li><a href="classes.php?type=S&subtype=LNER&prg=GNR">ex GNR</a></li>
          <li><a href="classes.php?type=S&subtype=LNER&prg=GCR">ex GCR</a></li>
          <li><a href="classes.php?type=S&subtype=LNER&prg=MGNR">ex MGNR</a></li>
          <li><a href="classes.php?type=S&subtype=LNER&prg=NER">ex NER</a></li>
          <li><a href="classes.php?type=S&subtype=LNER&prg=NBR">ex NBR</a></li>
          <li><a href="classes.php?type=S&subtype=LNER&prg=GNSR">ex GNoSR</a></li>
        </ul>
      </li>
		  <li><a href="classes.php?type=S&subtype=LMS">ex LMS</a>
        <ul>
          <li><a href="classes.php?type=S&subtype=LMS&prg=MR">ex MR</a></li>
          <li><a href="classes.php?type=S&subtype=LMS&prg=LNWR">ex LNWR</a></li>
          <li><a href="classes.php?type=S&subtype=LMS&prg=LTSR">ex LTSR</a></li>
          <li><a href="classes.php?type=S&subtype=LMS&prg=SDJR">ex S&DJR</a></li>
          <li><a href="classes.php?type=S&subtype=LMS&prg=GSWR">ex G&SWR</a></li>
          <li><a href="classes.php?type=S&subtype=LMS&prg=CR">ex CR</a></li>
          <li><a href="classes.php?type=S&subtype=LMS&prg=HR">ex HR</a></li>
        </ul>
      </li>
		  <li><a href="classes.php?type=S&subtype=WD">ex WD</a></li>
		</ul>
	  </li>
      <li><a href="classes.php?type=D">Diesel</a>
	    <ul>
		  <li><a href="classes.php?type=D&subtype=RCar">Big 4 Railcars</a></li>
		  <li><a href="classes.php?type=D&subtype=DMU">Multiple Units</a></li>
		  <li><a href="classes.php?type=D&subtype=Shunters">Shunters</a></li>
		  <li><a href="classes.php?type=D&subtype=Type1">Type 1</a></li>
		  <li><a href="classes.php?type=D&subtype=Type2">Type 2</a></li>
		  <li><a href="classes.php?type=D&subtype=Type3">Type 3</a></li>
		  <li><a href="classes.php?type=D&subtype=Type4">Type 4</a></li>
		  <li><a href="classes.php?type=D&subtype=Type5">Type 5</a></li>
		</ul>
	  </li>
      <li><a href="classes.php?type=E">Electric</a>
	    <ul>
		  <li><a href="classes.php?type=E&subtype=EMU">Multiple Units</a></li>
		  <li><a href="classes.php?type=E&subtype=25kvac">25KV A.C</a></li>
		  <li><a href="classes.php?type=E&subtype=1500vdc">1500V D.C</a></li>
		  <li><a href="classes.php?type=E&subtype=750vdc">750V D.C</a></li>
		</ul>
	  </li>
    </ul>
  </li>
  <li><a href="sites.php">Sites</a>
    <ul>
      <li><a href="sites.php?page=depots&action=list">Depots</a></li>
      <li><a href="sites.php?page=builders&action=list">Builders</a></li>
      <li><a href="sites.php?page=works&action=list">Locomotive Works</a></li>
      <li><a href="sites.php?page=scrapyards&action=list">Scrapyards</a></li>
    </ul>
  </li>
  <li><a href="people.php">People</a>
    <ul>
      <li><a href="people.php?page=cme">CME's</a></li>
      <li><a href="people.php?page=managers">Management</a></li>
      <li><a href="people.php?page=misc">Miscellaneous</a></li>
    </ul>
  </li>
  <li><a href="companies.php">Companies</a>
    <ul>
      <li><a href="companies.php?page=BR">British Railways</a></li>
      <li><a href="companies.php?page=GWR">GWR & Constituents</a></li>
      <li><a href="companies.php?page=SR">SR & Constituents</a></li>
      <li><a href="companies.php?page=LNER">LNER & Constituents</a></li>
      <li><a href="companies.php?page=LMS">LMS & Constituents</a></li>
    </ul>
  </li>
  <li><a href="timelines.php">Timelines</a>
    <ul>
      <li><a href="timelines.php?page=workings">Workings</a></li>
      <li><a href="timelines.php?page=events">Events</a></li>
      <li><a href="timelines.php?page=news">News Stories</a></li>
    </ul>
  </li>
  <li><a href="misc.php">Miscellaneous</a>
    <ul>
      <li><a href="reports.php">Reports</a></li>
      <li><a href="misc.php?page=graphs">Graphs</a></li>
      <li><a href="misc.php?page=anecdotes">Anecdotes</a></li>
      <li><a href="misc.php?page=headcodes">Headcodes</a></li>
      <li><a href="misc.php?page=royal">Royal Trains</a></li>
      <li><a href="misc.php?page=accidents">Accidents</a></li>
      <li><a href="misc.php?page=wheelarr">Wheel Arrangements</a></li>
      <li><a href="timelines.php?page=news&item=ModPlan">Modernisation Plan 1955</a></li>
      <li><a href="timelines.php?page=news&item=Beeching">The Beeching Plan</a></li>
      <li><a href="abc.php">Generate an ABC!</a></li>
    </ul>
  </li>
  <li><a href="otd.php">On This Day ...</a></li>
</ul>
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


<div class='featurebox_side'>
<form method="get" action="locomotives.php">
	<input type="text" name="loconum" id="search-text" size="10" maxlength="100"/>
	<input type="submit" id="search-submit" value="Go" />
  <span class="bubble_tooltip" href="#" onmousemove="showToolTip(event,'Default search uses a wildcard. For a specific number use a # e.g. 306#');return false" onmouseout="hideToolTip()"> ?</span>
</form>

</div><!-- end featurebox_side -->

<h3>Counter</h3>
<div class='featurebox_side'>
Visitors: <script language="Javascript" src="counter/counter.php?page=index"></script>
</div><!-- end featurebox_side -->

<h3>In Touch</h3>
<div class='featurebox_side'>
<!-- AddThis Button BEGIN -->
<script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;username=ij1001"><img src="http://s7.addthis.com/static/btn/sm-share-en.gif" width="83" height="16" alt="Bookmark and Share" style="border:0"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=ij1001"></script>
<!-- AddThis Button END -->
<br /><br />
<a href="http://twitter.com/brdatabase"><img src="./images/twitter.png" width="83" height="16" alt="Follow BRDatabase on Twitter" style="border:0"/></a>

</div><!-- end featurebox_side -->

</div><!-- end left_side-->

<div id="content">

<div class='featurebox_center'>

<?php
  include("forum/index.php");
?>

</div>
</div><!-- end content -->

<div id="footer">

  <a href="index.php">Home</a> |
  <a href="contribute.php">Contribute</a> |
  <a href="lazarus/index.php">Guestbook</a> |
  <a href="#">Forum</a> |
  <a href="contact.php">Contact</a> |
  <a href="links.php">Links</a> |
  <a href="preferences.php">Preferences</a><br />
Website Copyright(C) 2011 BRDatabase.info
<br />
Template provided by: 
<a href="http://www.designsbydarren.com" target="_blank">DesignsByDarren.com</a>
</div><!-- end footer -->

</div><!-- end page_wrapper -->

</body>

</html>
<?php ob_end_flush(); ?> 
