<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  
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
<meta name="title" content="BRDatabase, locomotive allocations, withdrawals and scrapping details in the UK" />
<meta name="description" content="Locomotive history, railway statistics, steam, diesel and electric locomotives UK" />
<meta name="keywords" content="steam, diesel, electric, locomotives, railways, LNER, LMS, GWR, Southern, Stanier, Gresley, Collett, Maunsell, Bulleid, Churchward, Riddles, Britannia, locos, withdrawals, North British, Swindon, Crewe, Doncaster, Derby, Darlington, Eastleigh, Ashford, Brighton, Cowlairs, Inverurie, Gorton, Great Central, Great Northern, scrapping, allocations " />
<meta http-equiv="Content-Language" content="en-gb">

<!-- Site Title -->
<title>BRDatabase - the Complete British Railways Locomotive Database 1948-1997
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
<li id="active"><a href="#" id="current">Home</a></li>
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
	<div class="bubble_middle"><span id="bubble_tooltip_content">Content is coming here as you probably can see. Content is coming here as you probably can see.</span></div>
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
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<br /><br />


</div><!-- end featurebox_side -->

<h3>In Touch</h3>
<div class='featurebox_side'>
<!-- AddThis Button BEGIN -->
<script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;username=ij1001"><img src="http://s7.addthis.com/static/btn/sm-share-en.gif" width="83" height="16" alt="Bookmark and Share" style="border:0" /></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=ij1001"></script>
<!-- AddThis Button END -->
<br /><br />
<a href="http://twitter.com/brdatabase"><img src="./images/twitter.png" width="83" height="16" alt="Follow BRDatabase on Twitter" style="border:0" /></a>

</div><!-- end featurebox_side -->

</div><!-- end left_side-->

<div id="content">

<h3>Welcome!</h3>

<div class='featurebox_center'>
<h3>Breaking News! Furness Railway No 115 Recovery</h3>
News from the Furness Railway Society (Lindal branch): having been buried in a giant pothole for over 120 years, an attempt is being made to recover Furness Railway No 115, a D1 0-6-0 built by Sharp Stewart. On 22nd September, 1892, just east of <a href="http://www.streetmap.co.uk/grid/325812,476047/115">Lindal station</a>, a giant pothole opened up and swallowed the aforementioned locomotive, which had been shunting the yard - it's crew escaped in the nick of time. The project to recover 115 will be funded by a National Lottery grant and once returned to the surface, restoration to running order is expected to take about 5 years. FRS (Lindal) treasurer, T.H. Isiscrap, said that the ambition of the project reflects the ambition of the Furness Railway and that if succesful, they may consider recovering BRCW diesel, 27043, which is buried at Patterson's Tip in Glasgow as their next project.
</div>

<br />


<p>
Welcome to BRDatabase!  The purpose of this site is to bring together varied and disparate 
sources of data including books, webpages, magazines and personal records and present this
data in a homogenous manner, allowing the user to search for data in context, i.e. not in
just a 'dry' statistical manner. However, to achieve this 'grand' aim, I need your help!
Data sources, anecdotes, photographs, trainspotting logs etc... will all be welcome. The more
accurate the better.
</p>
<p>
There <strong>will</strong> be errors, so please bear with me and either report the error by
using the contact page, or by registering on the forum - link above.
</p>

<p>A list of the latest updates can be found <a href="./updates.php">here</a>, while a summary of which months have been processed
so far can be found <a href="./hist.php">here</a>.</p>

<div class='featurebox_center'>
<h3>Scrapping Data</h3>
Much as I would like to have a time machine, I can't afford one, so I cannot go back and verify the data that is used in this website. I have spent many many hours (sorry missus) working on this site and using data from a whole host of sources and my aim is to be as accurate as is possible.<br />
To this end, it has been brought to my attention by the <a href="http://www.whatreallyhappenedtosteam.co.uk/">HSBT project</a> that the scrapping details of thousands of steam locomotives in the 1960's was fabricated by an individual (for what reasons, one can only guess). This information has been published in good faith in the 'What Happened to Steam' series, authored by Peter Hands. The HSBT project is attempting to piece together the correct scrapping information from original documents and this will be published in due course. I suggest that you take the scrapping details of locos broken up between 1960 and 1968 with a little pinch of salt until the full picture emerges in the next year or two.<br />Please also note that even when a scrapping site is verified, the date of scrapping quoted <i>may</i> be the sale date or arrival date and may not represent the exact scrapping. Readers observations are welcomed!
</div>

<br />
<h3>Finding Data</h3>
<p>
The easiest way to find data is to type it in the 'Quick Search' box on the left: the box will accept <strong>locomotive numbers, locomotive names, 
shed names/codes, scrapyards, builders, works and even CME's</strong>. If you enter '1' in the box, you will get a lot of matches,
so if you are looking for locomotive number 1 (e.g. D1 'Scafell Pike', or LMS Fowler 2-6-2T No 1) put a hash (#) after the criteria,
e.g. 1#. Furthermore, specifying S1# will only return <strong>S</strong>team locos (also works for <strong>D</strong>iesel and <strong>E</strong>lectrics too).
</p>

<div class='featurebox_center'>
<?php
  require_once "lib/quickdb.class.php";
  require_once "lib/MyTables.class.php";
  require_once "lib/brlib.php";

  $db = fn_connectdb();
//  printf("<p>Random Image (refresh for a new one):<br />");
/*
  $sql[] = "select count(*) AS ct from steam";
  $sql[] = "select count(*) AS ct from diesels";
  $sql[] = "select count(*) AS ct from electric";
  $sql[] = "select count(*) AS ct from s_alloc where allocation != '98W'";
  $sql[] = "select count(*) AS ct from d_alloc where allocation != '98W'";
  $sql[] = "select count(*) AS ct from e_alloc where allocation != '98W'";

  $tb = new MyTables("stats",50);

  $tb->set_align("V");
  $tb->add_row_lwidth(60);
  $tb->add_row("s_count",      "Total Steam Locos");
  $tb->add_row("sa_count",     "Total Steam Allocations");
  $tb->add_row("d_count",      "Total Diesel Locos");
  $tb->add_row("da_count",     "Total Diesel Allocations");
  $tb->add_row("e_count",      "Total Electric Locos");
  $tb->add_row("ea_count",     "Total Electric Allocations");

  for ($nx = 0; $nx < 6; $nx++)
  {
    $result = $db->execute($sql[$nx]);
    $row = mysqli_fetch_assoc($result);

    switch ($nx)
    {
      case 0:
        if ($row)
          $r['s_count'] = fn_ncomma($row['ct']);
        break;
      case 1:
        if ($row)
          $r['d_count'] = fn_ncomma($row['ct']);
        break;
      case 2:
        if ($row)
          $r['e_count'] = fn_ncomma($row['ct']);
        break;
      case 3:
        if ($row)
          $r['sa_count'] = fn_ncomma($row['ct']);
        break;
      case 4:
        if ($row)
          $r['da_count'] = fn_ncomma($row['ct']);
        break;
      case 5:
        if ($row)
          $r['ea_count'] = fn_ncomma($row['ct']);
        break;
      default:
        break;
    }
  }

  $tb->add_data($r);

  $tb->draw_table();
*/
  $sql = "SELECT last_updated
          FROM   updated";

  $result = $db->execute($sql);

  if ($result)
  {
    $row = mysqli_fetch_assoc($result);

    if ($row)
      $lu = $row['last_updated'];
  }

  // Get a random image to display
  $sql = "SELECT count(*) AS ct FROM images";

  $x = $db->execute($sql);
  $d = mysqli_fetch_assoc($x);

  for ($nx = 0; $nx < 5; $nx++)
  {
    $rand = mt_rand(0,$d['ct'] - 1); 
    $rnd = $db->execute("SELECT * FROM images LIMIT $rand, 1");
    $v = mysqli_fetch_assoc($rnd);
    if ($nx == 0)
      $str  = "('" . $v['image'] . "'";
    else
      $str .= ",'" . $v['image'] . "'";
  }

  $str .= ")";

  $sql = "SELECT CASE WHEN i.type = 'D' THEN
                        concat('images/locos/diesel/thumbs/tn_',   i.image)
                      WHEN i.type = 'E' THEN
                        concat('images/locos/electric/thumbs/tn_', i.image)
                      WHEN i.type = 'S' THEN
                        concat('images/locos/steam/',    
                                         CASE WHEN sc.br_standard = 'Y' THEN
                                           'BR'
                                         ELSE 
                                           sc.big4_company
                                         END,
                                         '/thumbs/tn_',
                                         i.image)
                      WHEN i.type = 'A' THEN
                        concat('images/sheds/',    
                                         ifnull(dp.big4_company, 'BR'),
                                         '/thumbs/tn_',
                                         i.image)
                      ELSE ' '
                 END AS image_location,
                 CASE WHEN i.type = 'D' THEN
                        concat('locoqry.php?action=class&type=D&id=', dc.d_class_id)
                      WHEN i.type = 'E' THEN
                        concat('locoqry.php?action=class&type=E&id=', ec.e_class_id)
                      WHEN i.type = 'S' THEN
                        concat('locoqry.php?action=class&type=S&id=', sc.s_class_id)
                      WHEN i.type = 'A' THEN
                        concat('sites.php?page=depots&subpage=main&id=', dp.depot_id)
                      ELSE ' '
                 END AS image_hyperlink,
                 sc.br_standard,
                 sc.big4_company,
                 dp.big4_company,
                 i.caption
          FROM   images i
          LEFT JOIN depot dp
          ON     dp.depot_id = i.class_id
          AND    i.type  = 'A'
          LEFT JOIN s_class sc
          ON     sc.s_class_id = i.class_id
          AND    i.type  = 'S'
          LEFT JOIN d_class dc
          ON     dc.d_class_id = i.class_id
          AND    i.type  = 'D'
          LEFT JOIN e_class ec
          ON     ec.e_class_id = i.class_id
          AND    i.type  = 'E'
          WHERE  i.image IN " . $str;

  //     echo $sql;

  $result = $db->execute($sql);

  $nx = 0;

  if ($result)
    while (($row[] = mysqli_fetch_assoc($result)))
      $nx++;

  if ($nx > 4)
    $nx = 4;
  
  printf("<table width=\"100%%\" frame=\"box\">\n");
  printf("<caption>A few random suggestions...</caption>\n");

    printf("<tr>\n");
    for ($ny = 0; $ny < $nx; $ny++)
    {
      printf("<td width=25%% align=\"center\"><a href=\"%s\">", $row[$ny]['image_hyperlink']);
      printf("<img src=\"%s\" /></td>\n", $row[$ny]['image_location']);
    }
    printf("</tr>\n");
    printf("<tr>\n");
    for ($ny = 0; $ny < $nx; $ny++)
    {
      if (strlen($row[$ny]['caption']) > 40)
        $cap = substr($row[$ny]['caption'], 0, 40) . "...";
      else
        $cap = $row[$ny]['caption'];

      printf("<td width=25%%><a href=\"%s\">", $row[$ny]['image_hyperlink']);
      printf("%s</a></td>\n", $cap);
    }
    printf("</tr>\n");

  printf("</table>\n");
?>
</div>

<div class='featurebox_center'>
<h3>Last few Updates</h3>
<?php
  require_once "lib/quickdb.class.php";
  require_once "lib/MyTables.class.php";
  require_once "lib/brlib.php";

  $db = fn_connectdb();

  $sql = 'SELECT u.link,
                 u.details,
                 u.update_date
          FROM   updates u
          ORDER BY u.update_date DESC
          LIMIT 0, 6';
   
  $result = $db->execute($sql);

  printf("<table width=\"50%%\">");

  if ($result)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      if (!empty($row['link']))
        printf("<tr><td width=\"30%%\">%s</td><td width=\"70%%\"><a href=\"%s\">%s</a></td>",
          $row['update_date'], $row['link'], $row['details']);
      else
        printf("<tr><td width=\"30%%\">%s</td><td width=\"70%%\">%s</td>",
          $row['update_date'], $row['details']);
    }
  }

  printf("</table>");
  
?>
</div>

<p>
A big thank you to any photographers whose material appears here - permission was sought and received. Links to photographic collections
are under each image used.
</p>


<h3>Running Costs</h3>
<p>If you find this site useful, maybe you would be interested in helping with the running costs. 
Any donations to help me with the upkeep of this site will be gratefully received! I have introduced a tiny amount of advertising but it doesn't 
cover the costs and I don't want to cover the site with adverts!</p>
<p>A big thank you to those who have made a donation - much appreciated!!!</p>
<table width=100%><tr><td align=center>
<form name="_xclick" action="https://www.paypal.com/uk/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="brdatabase@tiscali.co.uk">
<input type="hidden" name="item_name" value="BR Database">
<input type="hidden" name="currency_code" value="GBP">
<input type="image" src="http://www.paypal.com/en_GB/i/btn/x-click-butcc-donate.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
</form>
</td></tr></table></p>

<p>All the best, Ian</p>
<br />
<p>
Last update was: <?php echo $lu; ?>
</p>

<br />

</div><!-- end content -->

<div id="footer">

  <a href="#">Home</a> |
  <a href="contribute.php">Contribute</a> |
  <a href="lazarus/index.php">Guestbook</a> |
  <a href="forum.php">Forum</a> |
  <a href="contact.php">Contact</a> |
  <a href="links.php">Links</a> |
  <a href="preferences.php">Preferences</a><br />
Website Copyright(C) 2010-13 BRDatabase.info
<br />
Template provided by: 
<a href="http://www.designsbydarren.com" target="_blank">DesignsByDarren.com</a>

</div><!-- end footer -->

</div><!-- end page_wrapper -->

</body>

</html>
