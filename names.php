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
<title>Locomotive Names | Flying Scotsman | Mallard | Tornado | Princess Elizabeth | Evening Star | Blue Peter | Green Arrow | Nunney Castle | City of Truro
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

<h2>Locomotive Names</h2>

<div class="featurebox_center">

<?php
  require_once "lib/quickdb.class.php";
  require_once "lib/brlib.php";
  require_once "lib/MyTables.class.php";

  // 3 possible parameters
  //   type      <$type>    - type of class (S, D, E etc...)
  //   id        <$id>      - name id
  //   pfx       <$prefix>  - first letter or number of name
  
  $type = $id = "";
  $prefix = "A";
  
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
        fn_check_id($id, 9999);
    }
    else
    if ($key == "pfx")
    {
       $prefix = strtoupper($value);
       if (!empty($prefix))
		 fn_check_alnum($prefix, 1);
    }
    else
    if ($key == "fbclid")
    {
    }
    else
      fn_poem($key, $value, 99);
  }

  if (!empty($id))
  {
    $db = fn_connectdb();
    $loco = $type . $id;
    
    fn_logit(3, $loco);

    if ($type == "S")
    {
      $sql = 'SELECT name
              FROM   s_name
              WHERE  s_name_id = ' . $id;
    }
    else
    if ($type == "D")
    {
      $sql = 'SELECT name
              FROM   d_name
              WHERE  d_name_id = ' . $id;
    }
    else
    if ($type == "E")
    {
      $sql = 'SELECT name
              FROM   e_name
              WHERE  e_name_id = ' . $id;
    }

    if (!empty($sql))
    {
      $result = $db->execute($sql);
      
      fn_check_result($result);
      
      if ($db->count_select())
        $row = mysqli_fetch_assoc($result);

      $srch_name = $row['name'];
    }
    else
    {
      die("Not a valid name traction type");
    }

    if (!empty($srch_name))
    {
      $sql = 'SELECT "S"                                     AS type,
                     snm.name,
                     snm.named_where,
                     snm.named_after,
                     snm.named_by,
                     snm.start_date,
                     snm.end_date,
                     snm.notes,
                     coalesce(sc.common_name, sc.identifier) AS class_name,
                     concat("locoqry.php?action=class&type=S&id=", sc.s_class_id) 
                                                             AS class_name_hl,
                     sn.number,
                     concat("locoqry.php?action=locodata&type=S&id=", snm.loco_id, 
                            "&loco=", sn.number)             AS number_hl,
                     sn.number_type
              FROM   s_name snm

              JOIN   s_nums sn
              ON     sn.loco_id = snm.loco_id
              AND    sn.start_date =  (SELECT max(sn1.start_date)
                                       FROM   s_nums sn1
                                       WHERE  sn1.loco_id = sn.loco_id
                                       AND    sn1.carried_number = "Y"
                                       AND    sn1.start_date <= snm.start_date)

              JOIN   s_class_link scl
              ON     scl.loco_id = snm.loco_id
              AND    scl.start_date = (SELECT max(scl1.start_date)
                                       FROM   s_class_link scl1
                                       WHERE  scl1.loco_id = scl.loco_id
                                       AND    scl1.start_date <= snm.start_date)

              JOIN   s_class sc
              ON     sc.s_class_id = scl.s_class_id

              WHERE  snm.name = "' . $srch_name . '"

              UNION

              SELECT "D"                                     AS type,
                     dnm.name,
                     dnm.named_where,
                     dnm.named_after,
                     dnm.named_by,
                     dnm.start_date,
                     dnm.end_date,
                     dnm.notes,
                     coalesce(dc.common_name, dc.identifier) AS class_name,
                     concat("locoqry.php?action=class&type=D&id=", dc.d_class_id) 
                                                             AS class_name_hl,
                     dn.number,
                     concat("locoqry.php?action=locodata&type=D&id=", dnm.loco_id, 
                            "&loco=", dn.number)             AS number_hl,
                     dn.number_type
              FROM   d_name dnm

              JOIN   d_nums dn
              ON     dn.loco_id = dnm.loco_id
              AND    dn.start_date =  (SELECT max(dn1.start_date)
                                       FROM   d_nums dn1
                                       WHERE  dn1.loco_id = dn.loco_id
                                       AND    dn1.carried_number = "Y"
                                       AND    dn1.start_date <= dnm.start_date)

              JOIN   d_class_link dcl
              ON     dcl.loco_id = dnm.loco_id
              AND    dcl.start_date = (SELECT max(dcl1.start_date)
                                       FROM   d_class_link dcl1
                                       WHERE  dcl1.loco_id = dcl.loco_id
                                       AND    dcl1.start_date <= dnm.start_date)

              JOIN   d_class dc
              ON     dc.d_class_id = dcl.d_class_id

              WHERE  dnm.name = "' . $srch_name . '"

              UNION

              SELECT "E"                                     AS type,
                     enm.name,
                     enm.named_where,
                     enm.named_after,
                     enm.named_by,
                     enm.start_date,
                     enm.end_date,
                     enm.notes,
                     coalesce(ec.common_name, ec.identifier) AS class_name,
                     concat("locoqry.php?action=class&type=E&id=", ec.e_class_id) 
                                                             AS class_name_hl,
                     en.number,
                     concat("locoqry.php?action=locodata&type=E&id=", enm.loco_id, 
                            "&loco=", en.number)             AS number_hl,
                     en.number_type
              FROM   e_name enm

              JOIN   e_nums en
              ON     en.loco_id = enm.loco_id
              AND    en.start_date =  (SELECT max(en1.start_date)
                                       FROM   e_nums en1
                                       WHERE  en1.loco_id = en.loco_id
                                       AND    en1.carried_number = "Y"
                                       AND    en1.start_date <= enm.start_date)

              JOIN   e_class_link ecl
              ON     ecl.loco_id = enm.loco_id
              AND    ecl.start_date = (SELECT max(ecl1.start_date)
                                       FROM   e_class_link ecl1
                                       WHERE  ecl1.loco_id = ecl.loco_id
                                       AND    ecl1.start_date <= enm.start_date)

              JOIN   e_class ec
              ON     ec.e_class_id = ecl.e_class_id

              WHERE  enm.name = "' . $srch_name . '"

              ORDER BY start_date';

      //echo $sql;

      fn_check_result(($result = $db->execute($sql)));

      $tb = new MyTables("loco_names");
      $tb->colour_coordinate("Y");

      $nx = 0;

      while ($row = mysqli_fetch_assoc($result))
      {
        if ($nx++ == 0)
        {
          $tb->add_caption("Name: '<strong><font color=\"red\">" . $row['name'] . "</font></strong>'", NULL);
          $tb->add_column("number",             "Number when named",  8);
          $tb->add_column("class_name",         "Class",             10);
          $tb->add_column("named_where",        "Where Named",       18);
          $tb->add_column("named_after",        "Named After",       18);
          $tb->add_column("named_by",           "Named by",          17);
          $tb->add_column("start_date",         "Date Named",         8);
          $tb->add_column("notes",              "Info",              21);
        }

        if ($row['number_type'] == "PRT")
          if ($row['type'] == "D")
            $row['number'] = fn_d_pfx($row['number']);
          else
          if ($row['type'] == "E")
            $row['number'] = fn_e_pfx($row['number']);

        $row['start_date'] = fn_fdate($row['start_date']);

        $tb->add_data($row);
      }

      if ($nx)
        $tb->draw_table();

      mysqli_free_result($result);
      $row = NULL;
    }
  }
  else
  if (strlen($prefix))
  {
    $str = "Letter " . $prefix;
    fn_logit(4, $str);

    for ($x=65; $x<91; $x++)
      printf("<a href=\"names.php?pfx=%s\">%s</a>&nbsp;&nbsp;", chr($x), chr($x));
    for ($x=0; $x<10;$x++)
      printf("<a href=\"names.php?pfx=%d\">%d</a>&nbsp;&nbsp;", $x, $x);
    echo "<br /><br />";
    
    if (strlen($prefix) != 1 || !(ctype_alnum($prefix)))
      fn_poem($prefix, $prefix);

    $sql = 'SELECT "S"                            AS type,
                   s.b_date                       AS b_date,
                   s.w_date                       AS w_date,
                   concat(ifnull(sn.prefix, ""), 
                          sn.number, 
                          ifnull(sn.suffix, ""))  AS number,
                   concat("locoqry.php?action=locodata&type=S&id=", 
                   snm.loco_id, "&loco=", sn.number)             
			                                      AS number_hl,
                   sn.number_type                 AS number_type,
                   sn.company                     AS company,
                   coalesce(sc.common_name, 
		                    sc.identifier)        AS class,
                   concat("locoqry.php?action=class&type=S&id=", 
                          sc.s_class_id)          AS class_hl,
                   snm.name                       AS name,
                   snm.named_by                   AS named_by,
                   snm.named_where                AS named_where,
                   snm.named_after                AS named_after,
                   snm.start_date                 AS start_date,
                   snm.start_date                 AS start_date_fmt,
                   snm.end_date                   AS end_date,
                   snm.notes                      AS notes
            FROM   s_name snm
            JOIN   steam s
            ON     s.loco_id = snm.loco_id
            JOIN   s_nums sn
            ON     sn.loco_id = snm.loco_id
            AND    sn.start_date =  (SELECT max(sn1.start_date)
                                     FROM   s_nums sn1
                                     WHERE  sn1.loco_id = snm.loco_id
                                     AND    sn1.carried_number = "Y"
                                     AND    sn1.start_date <= snm.start_date)
            JOIN   s_class_link scl
            ON     scl.loco_id = snm.loco_id
            AND    scl.start_date = (SELECT max(scl1.start_date)
                                     FROM   s_class_link scl1
                                     WHERE  scl1.loco_id = snm.loco_id
                                     AND    scl1.start_date <= snm.start_date)
            JOIN   s_class sc
            ON     sc.s_class_id = scl.s_class_id
            AND    snm.name like "' . $prefix . '%"

	    UNION

            SELECT "D"                            AS type,
                   d.b_date                       AS b_date,
                   d.w_date                       AS w_date,
                   dn.number                      AS number,
                   concat("locoqry.php?action=locodata&type=D&id=", 
                          dnm.loco_id, "&loco=", dn.number)             
                                                  AS number_hl,
                   dn.number_type                 AS number_type,
                   dn.company                     AS company,
                   coalesce(dc.common_name,  
                            dc.identifier)        AS class,
                   concat("locoqry.php?action=class&type=D&id=", 
                          dc.d_class_id)          AS class_hl,
                   dnm.name                       AS name,
                   dnm.named_by                   AS named_by,
                   dnm.named_where                AS named_where,
                   dnm.named_after                AS named_after,
                   dnm.start_date                 AS start_date,
                   dnm.start_date                 AS start_date_fmt,
                   dnm.end_date                   AS end_date,
                   dnm.notes                      AS notes
            FROM   d_name dnm
            JOIN   diesels d
            ON     d.loco_id = dnm.loco_id
            JOIN   d_nums dn
            ON     dn.loco_id = dnm.loco_id
            AND    dn.start_date =  (SELECT max(dn1.start_date)
                                     FROM   d_nums dn1
                                     WHERE  dn1.loco_id = dnm.loco_id
                                     AND    dn1.carried_number = "Y"
                                     AND    dn1.start_date <= dnm.start_date)
            JOIN   d_class_link dcl
            ON     dcl.loco_id = dnm.loco_id
            AND    dcl.start_date = (SELECT max(dcl1.start_date)
                                     FROM   d_class_link dcl1
                                     WHERE  dcl1.loco_id = dnm.loco_id
                                     AND    dcl1.start_date <= dnm.start_date)
            JOIN   d_class dc
            ON     dc.d_class_id = dcl.d_class_id
            AND    dnm.name like "' . $prefix . '%"

	    UNION

            SELECT "E"                            AS type,
                   e.b_date                       AS b_date,
                   e.w_date                       AS w_date,
                   en.number                      AS number,
                   concat("locoqry.php?action=locodata&type=E&id=", 
                          enm.loco_id, "&loco=", en.number)             
                                                  AS number_hl,
                   en.number_type                 AS number_type,
                   en.company                     AS company,
                   coalesce(ec.common_name,  
                            ec.identifier)        AS class,
                   concat("locoqry.php?action=class&type=E&id=", 
                          ec.e_class_id)          AS class_hl,
                   enm.name                       AS name,
                   enm.named_by                   AS named_by,
                   enm.named_where                AS named_where,
                   enm.named_after                AS named_after,
                   enm.start_date                 AS start_date,
                   enm.start_date                 AS start_date_fmt,
                   enm.end_date                   AS end_date,
                   enm.notes                      AS notes
            FROM   e_name enm
            JOIN   electric e
            ON     e.loco_id = enm.loco_id
            JOIN   e_nums en
            ON     en.loco_id = enm.loco_id
            AND    en.start_date =  (SELECT max(en1.start_date)
                                     FROM   e_nums en1
                                     WHERE  en1.loco_id = enm.loco_id
                                     AND    en1.carried_number = "Y"
                                     AND    en1.start_date <= enm.start_date)
            JOIN   e_class_link ecl
            ON     ecl.loco_id = enm.loco_id
            AND    ecl.start_date = (SELECT max(ecl1.start_date)
                                     FROM   e_class_link ecl1
                                     WHERE  ecl1.loco_id = enm.loco_id
                                     AND    ecl1.start_date <= enm.start_date)
            JOIN   e_class ec
            ON     ec.e_class_id = ecl.e_class_id
            AND    enm.name like "' . $prefix . '%"

            ORDER BY name';

    $db = fn_connectdb();

    $result = $db->execute($sql);
    $ct = $db->count_select();

    $tb = new MyTables("loco_names");
    $tb->colour_coordinate("Y");
    $tb->sortable("Y");

    $tb->add_caption("Names beginning with '" . $prefix . "'", NULL);
    $tb->add_column("class",              "Class",             10);
    $tb->add_column("number",             "Number when named",  8);
    $tb->add_column("company",            "Company",            6);
    $tb->add_column("name",               "Name",              25);
    $tb->add_column("start_date",         "Date Named",         8);
    $tb->add_column("notes",              "Info",              43);

    while ($row = mysqli_fetch_assoc($result))
    {
      if ($row['number_type'] == "PRT")
        if ($row['type'] == "D")
          $row['number'] = fn_d_pfx($row['number']);
        else
        if ($row['type'] == "E")
          $row['number'] = fn_e_pfx($row['number']);

      if (!empty($row['named_by']))
        if (!empty($row['notes']))
	  $row['notes'] .= "<br />Named by: " . $row['named_by'];
	else
	  $row['notes']  = "Named by: " . $row['named_by'];

      if (!empty($row['named_after']))
        if (!empty($row['notes']))
	  $row['notes'] .= "<br />Named after: " . $row['named_after'];
	else
	  $row['notes']  = "Named after: " . $row['named_after'];

      if (!empty($row['named_at']))
        if (!empty($row['notes']))
	  $row['notes'] .= "<br />Named at: " . $row['named_at'];
	else
	  $row['notes']  = "Named at: " . $row['named_at'];

      $row['start_date'] = fn_fdate($row['start_date']);
      $tb->add_data($row);
    }

    if ($ct)
    {
      $tb->draw_table();
      mysqli_free_result($result);
      $row = NULL;
    }
    else
      printf("No matches found<br />");
  }

?>
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

