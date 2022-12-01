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
<li id="active"><a href="#" id="current">Preferences</a></li>
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

<h3></h3>

<div class='featurebox_center'>

<p>Here you can set preferences for various display options. These preferences will only last for 
the duration of your visit but if you wish, you can subscribe (free of charge) and your preferences 
will thereafter be retained each time you visit.</p>

<?php
  require_once "lib/quickdb.class.php";
  require_once "lib/brlib.php";

  $debug = 1;
  $usr = "Sansovino";

  if (isset($_COOKIE['user']) || ($debug == 1 && $usr == "Sansovino"))
  {
    $user = $_COOKIE['user'];

    if ($debug == 1)
      $user = $usr;

    $_SESSION['user'] = $user;

    $sql = 'SELECT *
            FROM   ref_tkpoil
            WHERE  bandh= "' . $user . '"';

//    $db = fn_connectdb();

//    $result = $db->execute($sql);

//    echo $sql;

//    if ($db->count_select() == 1)
//    {
//      $row = mysqli_fetch_array($result);
//      $_SESSION['dist'] = $row['dist'];
//      $_SESSION['weight'] = $row['weight'];
//      $_SESSION['pressure'] = $row['pressure'];
//      $_SESSION['msr'] = $row['msr'];
//      $_SESSION['vol'] = $row['vol'];
//      $_SESSION['area'] = $row['area'];
////    if (isset($row['fav_date']) && !empty($row['fav_date']))
//        $_SESSION['fav_date']= $row['fav_date'];
//    }
  }

//  print_r($_SESSION);

  if (isset($_GET['dist']))
  {
    echo "<strong>Preferences set!</strong><br />";
//    echo $_GET['dist'];

    $_SESSION['dist']     = $_GET['dist'];
    $_SESSION['weight']   = $_GET['weight'];
    $_SESSION['pressure'] = $_GET['pressure'];
    $_SESSION['msr']      = $_GET['msr'];
    $_SESSION['vol']      = $_GET['vol'];
    $_SESSION['area']     = $_GET['area'];
    $_SESSION['fav_date'] = $_GET['fav_date'];

    if (isset($_COOKIE['user']) || ($debug == 1 && $usr == "Sansovino"))
    {
      if (isset($_COOKIE['user']))
        $user = $_COOKIE['user'];
      else
      if ($debug == 1)
        $user = "Sansovino";

      $sql = 'UPDATE ref_tkpoil
              SET    dist       = "' . $_GET['dist'] . '",
                     weight     = "' . $_GET['weight'] . '",
                     pressure   = "' . $_GET['pressure'] . '",
                     msr        = "' . $_GET['msr'] . '",
                     vol        = "' . $_GET['vol'] . '",
                     area       = "' . $_GET['area'] . '",
                     fav_date   = "' . $_GET['fav_date'] . '"
              WHERE  bandh= "' . $user . '"';
//      echo $sql;
//      $result = $db->execute($sql);
    }
  }
  else
    echo "<br />";
?>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">

<table width=50%>
  <tr width=100%>
    <th width=50%>
      Parameter
    </th>
    <th width=25%>
      Decimal
    </th>
    <th width=25%>
      Imperial
    </th>
  </tr>

  <tr width=100%>
    <td width=50%>
      Distances
    </td>
<?php $d_check=!strcmp($_SESSION['dist'], "D") ? "checked" : "";
      $i_check=!strcmp($_SESSION['dist'], "I") ? "checked" : ""; ?>
    <td>
      <input type="radio" name ="dist" value="D" <?php echo $d_check; ?> >km
    </td>
    <td>
      <input type="radio" name ="dist" value="I" <?php echo $i_check; ?> >miles
    </td>
  </tr>

  <tr width=100%>
    <td width=50%>
      Weights
    </td>
<?php $d_check=!strcmp($_SESSION['weight'], "D") ? "checked" : "";
      $i_check=!strcmp($_SESSION['weight'], "I") ? "checked" : ""; ?>
    <td>
      <input type="radio" name ="weight" value="D" <?php echo $d_check; ?> >tonnes/kg
    </td>
    <td>
      <input type="radio" name ="weight" value="I" <?php echo $i_check; ?> >tons/cwts/lbs
    </td>
  </tr>

  <tr width=100%>
    <td width=50%>
      Pressure
    </td>
<?php $d_check=!strcmp($_SESSION['pressure'], "D") ? "checked" : "";
      $i_check=!strcmp($_SESSION['pressure'], "I") ? "checked" : ""; ?>
    <td>
      <input type="radio" name ="pressure" value="D" <?php echo $d_check; ?> >Pascals
    </td>
    <td>
      <input type="radio" name ="pressure" value="I" <?php echo $i_check; ?> >psi
    </td>
  </tr>

  <tr width=100%>
    <td width=50%>
      Measurements
    </td>
<?php $d_check=!strcmp($_SESSION['msr'], "D") ? "checked" : "";
      $i_check=!strcmp($_SESSION['msr'], "I") ? "checked" : ""; ?>
    <td>
      <input type="radio" name ="msr" value="D" <?php echo $d_check; ?> >metres/cms
    </td>
    <td>
      <input type="radio" name ="msr" value="I" <?php echo $i_check; ?> >feet & inches
    </td>
  </tr>

  <tr width=100%>
    <td width=50%>
      Volume
    </td>
<?php $d_check=!strcmp($_SESSION['vol'], "D") ? "checked" : "";
      $i_check=!strcmp($_SESSION['vol'], "I") ? "checked" : ""; ?>
    <td>
      <input type="radio" name ="vol" value="D" <?php echo $d_check; ?> >cubic metres
    </td>
    <td>
      <input type="radio" name ="vol" value="I" <?php echo $i_check; ?> >gallons
    </td>
  </tr>

  <tr width=100%>
    <td width=50%>
      Area
    </td>
<?php $d_check=!strcmp($_SESSION['area'], "D") ? "checked" : "";
      $i_check=!strcmp($_SESSION['area'], "I") ? "checked" : ""; ?>
    <td>
      <input type="radio" name ="area" value="D" <?php echo $d_check; ?> >square metres
    </td>
    <td>
      <input type="radio" name ="area" value="I" <?php echo $i_check; ?> >square feet
    </td>
  </tr>

</table>
<BR />
<input type="submit" value="Save Settings" />

</form>
  <p>
  </p>
</div>
</div><!-- end content -->

<div id="footer">

  <a href="index.php">Home</a> |
  <a href="lazarus/index.php">Guestbook</a> |
  <a href="contact.php">Contact</a> |
  <a href="links.php">Links</a> |
  <a href="#">Preferences</a><br />
<?php printf("Website Copyright(C) 2010-%d BRDatabase.info<br />", date("Y")); ?>

<br />
</div><!-- end footer -->

</div><!-- end page_wrapper -->

</body>

</html>

