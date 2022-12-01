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
<title>Locomotives Preservation | Preserved Steam Engines | Preserved Diesel Engines  | Preserved Electric Engines
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

<div class='featurebox_center'>

<?php

  // 2 possible parameters
  //   type   <$pg>   - type (D, S, E etc...)
  //   cid    <$cid>  - Class id
  
  $pg = $cid = "";

  foreach ($_GET as $key => $value)
  {
    if ($key == "type")
    {
      $pg = strtoupper($value);
      if (!empty($pg))
        fn_check_type($pg);
    }
    else
    if ($key == "cid")
    {
      $cid = $value;
      if (!empty($cid))
        fn_check_id($cid, 799999);
    }
    else
    if ($key == "fbclid")
    {
    }
    else
      fn_poem($key, $value, 99);
  }

  require_once "lib/quickdb.class.php";
  require_once "lib/MyTables.class.php";
  require_once "lib/brlib.php";

  $db = fn_connectdb();

  if ($pg == "D" || empty($pg))
  {
    if (!empty($cid))
    {
      $sqlw = "AND   dc.d_class_id = " . $cid;
    }
    else
      $sqlw = " ";

    $sqld = 'SELECT "D"        AS type,
                    "Diesel"   AS l_type,
                    d.loco_id,
                    d.b_date,
                    concat(date_format(d.b_date, "%Y%m%d"), lpad(d.loco_id, 7, "0000000"))
                               AS b_date_fmt,
                    d.w_date,
                    concat(date_format(d.w_date, "%Y%m%d"), lpad(d.loco_id, 7, "0000000"))
                               AS w_date_fmt,
                    p.date_preserved,
                    concat(date_format(p.date_preserved, "%Y%m%d"), lpad(d.loco_id, 7, "0000000"))
                               AS date_preserved_fmt,
                    p.status,
                    p.status_date,
                    concat(date_format(p.status_date, "%Y%m%d"), lpad(d.loco_id, 7, "0000000"))
                               AS status_date_fmt,
                    p.weblink,
                    concat("\"javascript:void(0)\" onClick=\"window.open(\'https://", 
                           p.weblink, "\')\"") as weblink_hl,
                    concat("locoqry.php?action=locodata&id=",d.loco_id,"&type=D&loco=",
                           dn.number)    AS number_hl,
                    dn.number,
                    dn.number_type,
                    ifnull(dcv.identifier, dc.identifier) AS class_type,
                    concat("locoqry.php?action=class&type=D&id=",dc.d_class_id) AS class_type_hl,
                    dnm.name
              FROM  diesels d

              JOIN  d_nums dn
              ON    dn.loco_id = d.loco_id
              AND   dn.start_date  = (SELECT max(dn1.start_date)
                                      FROM   d_nums dn1
                                      WHERE  dn1.loco_id = d.loco_id
                                      AND    dn1.start_date <= d.w_date)

              JOIN  d_class_link dcl
              ON    dcl.loco_id = d.loco_id
              AND   dcl.start_date = (SELECT max(dcl1.start_date)
                                      FROM   d_class_link dcl1
                                      WHERE  dcl1.loco_id = d.loco_id
                                      AND    dcl1.start_date <= d.w_date)

              LEFT JOIN  d_name dnm
              ON    dnm.loco_id = d.loco_id
              AND   dnm.start_date = (SELECT max(dnm1.start_date)
                                      FROM   d_name dnm1
                                      WHERE  dnm1.loco_id = d.loco_id
                                      AND    dnm1.start_date <= d.w_date)

              JOIN  d_class dc
              ON    dc.d_class_id = dcl.d_class_id ' . $sqlw . '

              JOIN  d_class_var dcv
              ON    dcv.d_class_id = dcl.d_class_id
              AND   dcv.d_class_var_id = dcl.d_class_var_id

              LEFT JOIN  preservation p
              ON    p.type = "D"
              AND   p.loco_id = d.loco_id

              WHERE d.preserved = "Y"';

    $sql = $sqld;
  }

  if ($pg == "S" || empty($pg))
  {
    if (!empty($cid))
    {
      $sqlw = "AND   sc.s_class_id = " . $cid;
    }
    else
      $sqlw = " ";

    $sqls = 'SELECT "S"        AS type,
                    "Steam"    AS l_type,
                    s.loco_id,
                    s.b_date,
                    concat(date_format(s.b_date, "%Y%m%d"), lpad(s.loco_id, 7, "0000000"))
                               AS b_date_fmt,
                    s.w_date,
                    concat(date_format(s.w_date, "%Y%m%d"), lpad(s.loco_id, 7, "0000000"))
                               AS w_date_fmt,
                    p.date_preserved,
                    concat(date_format(p.date_preserved, "%Y%m%d"), lpad(s.loco_id, 7, "0000000"))
                               AS date_preserved_fmt,
                    p.status,
                    p.status_date,
                    concat(date_format(p.status_date, "%Y%m%d"), lpad(s.loco_id, 7, "0000000"))
                               AS status_date_fmt,
                    p.weblink,
                    concat("\"javascript:void(0)\" onClick=\"window.open(\'https://", 
                           p.weblink, "\')\"") as weblink_hl,
                    concat("locoqry.php?action=locodata&id=",s.loco_id,"&type=S&loco=",
                           sn.number)    AS number_hl,
                    sn.number,
                    sn.number_type,
                    ifnull(scv.common_name, scv.class_type) AS class_type,
                    concat("locoqry.php?action=class&type=S&id=",sc.s_class_id) AS class_type_hl,
                    snm.name
              FROM  steam s

              JOIN  s_nums sn
              ON    sn.loco_id = s.loco_id
              AND   sn.start_date  = (SELECT max(sn1.start_date)
                                      FROM   s_nums sn1
                                      WHERE  sn1.loco_id = s.loco_id
                                      AND    sn1.start_date <= s.w_date)

              JOIN  s_class_link scl
              ON    scl.loco_id = s.loco_id
              AND   scl.start_date = (SELECT max(scl1.start_date)
                                      FROM   s_class_link scl1
                                      WHERE  scl1.loco_id = s.loco_id
                                      AND    scl1.start_date <= s.w_date)

              LEFT JOIN  s_name snm
              ON    snm.loco_id = s.loco_id
              AND   snm.start_date = (SELECT max(snm1.start_date)
                                      FROM   s_name snm1
                                      WHERE  snm1.loco_id = s.loco_id
                                      AND    snm1.start_date <= s.w_date)

              JOIN  s_class sc
              ON    sc.s_class_id = scl.s_class_id ' . $sqlw . '

              JOIN  s_class_var scv
              ON    scv.s_class_id = scl.s_class_id
              AND   scv.s_class_var_id = scl.s_class_var_id

              LEFT JOIN  preservation p
              ON    p.type = "S"
              AND   p.loco_id = s.loco_id

              WHERE s.preserved = "Y"';

    $sql = $sqls;
  }

  if ($pg == "E" || empty($pg))
  {
    if (!empty($cid))
    {
      $sqlw = "AND   ec.e_class_id = " . $cid;
    }
    else
      $sqlw = " ";

    $sqle = 'SELECT "E"        AS type,
                    "Electric" AS l_type,
                    e.loco_id,
                    e.b_date,
                    concat(date_format(e.b_date, "%Y%m%d"), lpad(e.loco_id, 7, "0000000"))
                               AS b_date_fmt,
                    e.w_date,
                    concat(date_format(e.w_date, "%Y%m%d"), lpad(e.loco_id, 7, "0000000"))
                               AS w_date_fmt,
                    p.date_preserved,
                    concat(date_format(p.date_preserved, "%Y%m%d"), lpad(e.loco_id, 7, "0000000"))
                               AS date_preserved_fmt,
                    p.status,
                    p.status_date,
                    concat(date_format(p.status_date, "%Y%m%d"), lpad(e.loco_id, 7, "0000000"))
                               AS status_date_fmt,
                    p.weblink,
                    concat("\"javascript:void(0)\" onClick=\"window.open(\'https://", 
                           p.weblink, "\')\"") as weblink_hl,
                    concat("locoqry.php?action=locodata&id=",e.loco_id,"&type=E&loco=",
                           en.number)    AS number_hl,
                    en.number,
                    en.number_type,
                    ifnull(ecv.identifier, ec.identifier) AS class_type,
                    concat("locoqry.php?action=class&type=E&id=",ec.e_class_id) AS class_type_hl,
                    enm.name
              FROM  electric e

              JOIN  e_nums en
              ON    en.loco_id = e.loco_id
              AND   en.start_date  = (SELECT max(en1.start_date)
                                      FROM   e_nums en1
                                      WHERE  en1.loco_id = e.loco_id
                                      AND    en1.start_date <= e.w_date)

              JOIN  e_class_link ecl
              ON    ecl.loco_id = e.loco_id
              AND   ecl.start_date = (SELECT max(ecl1.start_date)
                                      FROM   e_class_link ecl1
                                      WHERE  ecl1.loco_id = e.loco_id
                                      AND    ecl1.start_date <= e.w_date)

              LEFT JOIN  e_name enm
              ON    enm.loco_id = e.loco_id
              AND   enm.start_date = (SELECT max(enm1.start_date)
                                      FROM   e_name enm1
                                      WHERE  enm1.loco_id = e.loco_id
                                      AND    enm1.start_date <= e.w_date)

              JOIN  e_class ec
              ON    ec.e_class_id = ecl.e_class_id ' . $sqlw . '

              JOIN  e_class_var ecv
              ON    ecv.e_class_id = ecl.e_class_id
              AND   ecv.e_class_var_id = ecl.e_class_var_id

              LEFT JOIN  preservation p
              ON    p.type = "E"
              AND   p.loco_id = e.loco_id

              WHERE e.preserved = "Y"';

    $sql = $sqle;
  }

  if (empty($pg))
  {
    $sql = $sqls . " UNION " . $sqld . " UNION " . $sqle;
  }

  $sql .= " ORDER BY loco_id, date_preserved";

//  echo $sql;

  $result = $db->execute($sql);
  
  if ($result)
  {

  $tb_pres = new MyTables("preservation");

  $tb_pres->allow_rollover();
  $tb_pres->sortable();

  $tb_pres->add_column("l_type",         "Type",           5);
  $tb_pres->add_column("class_type",     "Class",          8);
  $tb_pres->add_column("number",         "Number",         8);
  $tb_pres->add_column("name",           "Name",          25);
  $tb_pres->add_column("company",        "Company",        8);
  $tb_pres->add_column("b_date", "To Service",     9);
  $tb_pres->add_column("w_date", "Withdrawn",      9);
  $tb_pres->add_column("date_preserved", "Date Preserved", 9);
  $tb_pres->add_column("status",         "Status",         2);
  $tb_pres->add_column("status_date",    "Last Updated",   5);
  $tb_pres->add_column("weblink",        "Link",           5);

  while ($row = mysqli_fetch_array($result))
  {
    if (empty($class_type) || !isset($class_type))
      $class_type = $row['class_type'];

    if ($row['type'] == "D")
      $row['number'] = fn_d_pfx($row['number']);
    else
    if ($row['type'] == "E")
      $row['number'] = fn_e_pfx($row['number']);

    $row['b_date'] = fn_fdate($row['b_date']);
    $row['w_date'] = fn_fdate($row['w_date']);
    $row['status_date']    = fn_fdate($row['status_date']);

    $row['status'] = fn_preservation_status($row['status']);

    $tb_pres->add_data($row);
  }

  if (!empty($cid))
    printf("<h3>Preserved %s Locomotives of Class %s</h3><br />\n", 
           strcmp($pg, "D") == 0 ? "Diesel" : (strcmp($pg, "S") == 0 ? "Steam" : "Electric"),
           $class_type);
  else
  {
    if (strcmp($pg, "D") == 0)
      printf("<h3>Preserved Diesel Locomotives</h3><br />\n");
    else
    if (strcmp($pg, "E") == 0)
      printf("<h3>Preserved Electric Locomotives</h3><br />\n");
    else
    if (strcmp($pg, "S") == 0)
      printf("<h3>Preserved Steam Locomotives</h3><br />\n");
    else
      printf("<h3>Preserved Locomotives</h3><br />\n");
  }


  $tb_pres->draw_table();
  }

  if ($result)
    mysqli_free_result($result);

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

