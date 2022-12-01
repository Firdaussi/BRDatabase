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
require_once "lib/brlib.php";

  // 2 possible parameters
  //   page   <$pg>   - selected subpage
  //   id     <$id>   - at the moment, wheel arrangement - may need dedicated value at some later point.
  
  $pg = $id = "";

  foreach ($_GET as $key => $value)
  {
    // print "$key" . ", [$value]" . "<br />";
    if ($key == "page")
    {
      $pg = $value;
      if (!empty($pg))
        fn_check_alpha($pg, 12);
    }
    else
    if ($key == "id")
    {
      $id = $value;
      if (!empty($id))
        fn_check_wheels($id);
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
  if ($pg == "graphs")
  {
  }
  else
  if ($pg == "anecdotes")
  {
  }
  else
  if ($pg == "royal")
  {
  }
  else
  if ($pg == "accidents")
  {
  }
  else
  if ($pg == "wheel_arr" || $pg == "wheelarr")
  {
    printf("<h3>Wheel Arrangements</h3>\n");

    $db = fn_connectdb();

    if (!empty($id))
    {
      $sql = 'SELECT image, caption
              FROM   ref_wdiagrams
              WHERE  wheel_arrangement = "' . $id . '"';

      $result = $db->execute($sql);

      if ($db->count_select() == 0)
      {
         printf("<h3>No details for wheel arrangement %s yet</h3>\n", $id);
      }
      else
      {
        $row = mysqli_fetch_assoc($result);

        printf("<table width=75%% frame=box align=center>\n");
          printf("<tr>\n");
            printf("<td width=25%%><h4>%s</h4></td>\n", $row['caption']);
            printf("</td>\n");
            printf("<td width=75%% align=center><img src=%s width=480></td>\n", $row['image']);
            printf("</td>");
          printf("</tr>\n");
          printf("<tr>\n");
            printf("<td width=25%%>&nbsp;</td>\n");
            printf("<td width=75%% align=center><h3>Wheel Arrangement: %s</h3></td>\n",
                   $id);
          printf("</tr>\n");
        printf("</table>\n");
      }
    }
    else
    {
      $sql = 'SELECT *
              FROM ref_wdiagrams
              ORDER BY type, wheel_arrangement';

      $result = $db->execute($sql);

      if ($db->count_select())
      {
        printf("<table width=75%% frame=box align=center>\n");

        while ($row = mysqli_fetch_array($result))
        {
          printf("<tr>\n");
            printf("<td width=25%%>%s</td>\n", $row['caption']);
            printf("</td>\n");
            printf("<td width=75%% align=center><img src=%s width=480></td>\n", $row['image']);
            printf("</td>");
          printf("</tr>\n");
          printf("<tr>\n");
            printf("<td width=25%%>&nbsp;</td>\n");
            printf("<td width=75%% align=center><h3>Wheel Arrangement: %s</h3></td>\n",
                   $row['wheel_arrangement']);
          printf("</tr>\n");
          printf("<tr>\n");
            printf("<td>&nbsp;</td>\n");
          printf("</tr>\n");
        }

        printf("</table>\n");
      }
    }
  }
}
else
{
  printf("<table width=75%% frame=box align=center>\n");
    printf("<tr>\n");
      printf("<td width=35%%><a href=\"misc.php?page=graphs\">Graphs</a></td>\n");
      printf("<td width=65%%>A collection of statistics displayed in graphical form regarding the 
withdrawals, new builds, conversions, allocations (and more) of locomotives during the BR 
period.</td>\n");
    printf("</tr>\n");
    printf("<tr>\n");
      printf("<td width=35%%><a href=\"misc.php?page=anecdotes\">Anecdotes</a></td>\n");
      printf("<td width=65%%>Stories, tales, myths.</td>\n");
    printf("</tr>\n");
    printf("<tr>\n");
      printf("<td width=35%%><a href=\"misc.php?page=royal\">Royal Trains</a></td>\n");
      printf("<td width=65%%>Royal Trains during the BR period - locomotives, destinations and 
purposes.</td>\n");
    printf("</tr>\n");
    printf("<tr>\n");
      printf("<td width=35%%><a href=\"misc.php?page=accidents\">Accidents</a></td>\n");
      printf("<td width=65%%>Mishaps, prangs, disasters involving BR trains.</td>\n");
    printf("</tr>\n");
    printf("<tr>\n");
      printf("<td width=35%%><a href=\"misc.php?page=designers\">Designers</a></td>\n");
      printf("<td width=65%%>Principle designers from Pre-Grouping days, through the Big Four and in to 
the British Railways period.</td>\n");
    printf("</tr>\n");
    printf("<tr>\n");
      printf("<td width=35%%><a href=\"misc.php?page=wheelarr\">Wheel Arrangements</a></td>\n");
      printf("<td width=65%%>Information regarding the various types of wheel arrangements in use during 
the British Railways period, including a few stats and graphs.</td>\n");
    printf("</tr>\n");
  printf("</table>\n");
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
<?php printf("Website Copyright(C) 2010-%d BRDatabase.info<br />", date("Y")); ?>
<br />
</div><!-- end footer -->

</div><!-- end page_wrapper -->

</body>

</html>

