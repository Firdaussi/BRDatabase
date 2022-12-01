<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  
<html xmlns="www.w3.org/1999/xhtml">

<!--
Copyright: Darren Hester 2006, www.designsbydarren.com
License: Released Under the "Creative Commons License", 
creativecommons.org/licenses/by-nc/2.5/
-->

<head>
    
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-PFQZGGZJS5"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-PFQZGGZJS5');
</script>

<!-- Site Title -->
<title>BRDatabase - the Complete British Railways Locomotive Database 1948-1997
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

<!-- Begin Cookie Consent plugin by Silktide - silktide.com/cookieconsent -->
<script type="text/javascript">
    window.cookieconsent_options = {"message":"BRDatabase uses cookies to ensure you get the best experience on our website","Dismiss":"Got it!","learnMore":"More info","link":"/cookiepolicy.html","theme":"light-top"};
</script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/cookieconsent.min.js"></script>
<!-- End Cookie Consent plugin -->

<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "ca3evzk6gy");
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
<a class="addthis_button" href="www.addthis.com/bookmark.php?v=300&amp;username=ij1001"><img src="s7.addthis.com/static/btn/sm-share-en.gif" width="83" height="16" alt="Bookmark and Share" style="border:0" /></a><script type="text/javascript" src="s7.addthis.com/js/300/addthis_widget.js#username=ij1001"></script>
<!-- AddThis Button END -->
<br /><br />
<a href="www.twitter.com/brdatabase"><img src="./images/twitter.png" width="83" height="16" alt="Follow BRDatabase on Twitter" style="border:0" /></a>
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

<br /><br />

</div><!-- end featurebox_side -->

<h3>Counter</h3>
<div class='featurebox_side'>
<?php include "lib/counter.php"; ?>
</div><!-- end featurebox_side -->

</div><!-- end left_side-->

<div id="content">

<h3>Welcome!</h3>
<p>
Welcome to BRDatabase!  The purpose of this site is to bring together varied and disparate 
sources of data including books, webpages, magazines and personal records and present this
data in a homogeneous manner, allowing the user to search for data in context, i.e. not in
just a 'dry' statistical manner. However, to achieve this 'grand' aim, I need your help!
Data sources, anecdotes, photographs, trainspotting logs etc... will all be welcome. The more
accurate the better.
</p>
<p>
There <strong>will</strong> be errors, so please bear with me and either report the error by
using the <a href="hesk/index.php">helpdesk</a> page or leave me a message using the <a href="contact.php">contact form</a>.
</p>
<p>
A word of thanks too, for all the kind words, contributions, suggestions, support and donations I have received over the years. I started the site partly for my
own pleasure but it has clearly become quite important to a number of enthusiasts & researchers. I have no plans to shut it down at all; quite the contrary, I have much
planned for the future!</br>
</p>
</br>

<h3>Finding Data</h3>
<p>
The easiest way to find data is to type it in the 'Quick Search' box on the left: the box will accept <strong>locomotive numbers, locomotive names, 
shed names/codes, scrapyards, builders, works and even CME's</strong>. If you enter '1' in the box, you will get a lot of matches,
so if you are looking for locomotive number 1 (e.g. D1 'Scafell Pike', or LMS Fowler 2-6-2T No 1) put a hash (#) after the criteria,
e.g. 1#. Furthermore, specifying S1# will only return <strong>S</strong>team locos (also works for <strong>D</strong>iesel and <strong>E</strong>lectrics too).</br></br></p>
<p>
I have just added (June 2020) a feature to the search where you can specify the company and number (only for steam engines). So, if you have a picture of, say, LNER 5561, enter 'LNER 5561'
(without the quotes but with the space) and the search is limited to that particular combination.</p>


<div class='featurebox_center'>
<?php
  require_once "lib/quickdb.class.php";
  require_once "lib/MyTables.class.php";
  require_once "lib/brlib.php";

  $db = fn_connectdb();
//  printf("<p>Random Image (refresh for a new one):<br />");

  $s[] = "select count(*) AS ct from steam";
  $s[] = "select count(*) AS ct from diesels";
  $s[] = "select count(*) AS ct from electric";
  $s[] = "select count(*) AS ct from s_alloc where allocation != '98W'";
  $s[] = "select count(*) AS ct from d_alloc where allocation != '98W'";
  $s[] = "select count(*) AS ct from e_alloc where allocation != '98W'";

  $tb = new MyTables("stats",50);

  $tb->set_align("V");
  $tb->add_row_lwidth(60);
  $tb->add_caption("A few stats ...");
  $tb->add_row("s_count",      "Total Steam Locos");
  $tb->add_row("sa_count",     "Total Steam Allocations");
  $tb->add_row("d_count",      "Total Diesel Locos");
  $tb->add_row("da_count",     "Total Diesel Allocations");
  $tb->add_row("e_count",      "Total Electric Locos");
  $tb->add_row("ea_count",     "Total Electric Allocations");

  for ($nx = 0; $nx < 6; $nx++)
  {
    $result = $db->execute($s[$nx]);
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

  echo "<br />";

  $sql = "SELECT last_updated
          FROM   ref_updated";

  $result = $db->execute($sql);

  if ($result)
  {
    $row = mysqli_fetch_assoc($result);

    if ($row)
      $lu = $row['last_updated'];
  }

  // Get a random image to display
  $sql = "SELECT count(*) AS ct FROM ref_images";

  $x = $db->execute($sql);
  $d = mysqli_fetch_assoc($x);

  for ($nx = 0; $nx < 5; $nx++)
  {
    $rand = mt_rand(0,$d['ct'] - 1); 
    $rnd = $db->execute("SELECT * FROM ref_images LIMIT $rand, 1");
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
          FROM   ref_images i
          LEFT JOIN ref_depot dp
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
      printf("<img src=\"%s\" nopin=\"nopin\" /></td>\n", $row[$ny]['image_location']);
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


<h3>Donations</h3>
<p>
I have received some fantastic support, both financial and data, in recent months. I would particularly like to thank John Bird at <a href=""javascript:void(0)" onClick="window.open('www.anistr.com')"">www.anistr.com</a> for his generous support and encouragement. Also thanks to Paul Davis, Jim Richards, David Ford, Graham Vincent, Wanderlust Images, The Railway Herald, and many others who have helped me in the past. Thank You!</br></br>
</p>

<h3>Updates</h3>
<p>
I am actively in the process of updating data to a higher standard. I have used data from my collection of <a href=""javascript:void(0)" onClick="window.open('www.stephensonloco.org.uk')"">Stephenson Locomotive Society</a> magazines, as well as books, anecdotes and submitted corrections. In an ideal world, I would merge SLS data with the existing data but there are discrepancies galore. Therefore, for the time being, I have included SLS data underneath current data on the individual (steam only) loco pages, along with the caveat that the data is raw and has yet to be cross-checked. Furthermore, some SLS data is not yet in the database (for reasons I won't bore you with) but that will change quite rapidly.</br></br>
</p>

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
<input type="image" src="www.paypal.com/en_GB/i/btn/x-click-butcc-donate.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
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
  <a href="lazarus/index.php">Guestbook</a> |
  <a href="contact.php">Contact</a> |
  <a href="links.php">Links</a> |
  <a href="preferences.php">Preferences</a><br />
<?php printf("Website Copyright(C) 2010-%d BRDatabase.info<br />", date("Y")); ?>

<a href="www.beyondsecurity.com/vulnerability-scanner-verification/www.brdatabase.info"><img src="https://seal.beyondsecurity.com/verification-images/www.brdatabase.info/vulnerability-scanner-2.gif" alt="Website Security Test" border="0" /></a>


</div><!-- end footer -->

</div><!-- end page_wrapper -->
<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ij1001"></script> 
</body>

</html>

