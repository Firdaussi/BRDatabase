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
<title>Railway Companies</title>

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

  if (isset($_GET['page']) && !empty($_GET['page']))
  {
    require_once "lib/quickdb.class.php";
    require_once "lib/MyTables.class.php";
    require_once "lib/brlib.php";

  // 6 possible parameters
  //   page   <$page>  - should be cmp as it referes to company initiala
  //   prg    <$prg>   - sub-company (constituent)

  $page = $prg = "";

  foreach ($_GET as $key => $value)
  {
    if ($key == "page")
    {
      $page = $value;
      if (!empty($page))
        fn_check_alpha($page, 5);
    }
    else
    if ($key == "subpage")
    {
      $subpage = $value;
      if (!empty($subpage))
        fn_check_alpha($subpage, 5);
    }
    else
    if ($key == "prg")
    {
      $prg = $value;
      if (!empty($prg))
        fn_check_alpha($prg, 5);
    }
    else
      fn_poem($key, $value, 99);
  }
  

    $db = fn_connectdb();
    $tb = new MyTables("companies");
    $tb->sortable();

    if (!empty($prg))
    {
      $prg = $prg;
      
      $sql = 'SELECT *
              FROM   ref_companies
              WHERE  cmp_initials = "' . $prg . '"';

      $result = $db->execute($sql);

      $row = mysqli_fetch_assoc($result);

      $title = $row['cmp_name'];
      if (empty($row['cmp_parent']))
        $title .= " (" . $page . " Constituent Company)";

      $prg_data = new MyTables("prg_locos");
      $prg_data->sortable();
      $prg_data->add_caption("Locomotives of the " . $row['cmp_name']);
      $prg_data->add_column("b_date",            "Build Date",      12);
      $prg_data->add_column("prg_class",         $prg . " Class",    7);
      $prg_data->add_column("big4_class",        $page . " Class",   7);
      $prg_data->add_column("number",            "First " . $prg . " Number",   8);
      $prg_data->add_column("wheel_arrangement", "Wheels",           9);
      $prg_data->add_column("cme",               "Designer",        15);
      $prg_data->add_column("builder",           "Manufacturer",    18);
      $prg_data->add_column("order_number",      "Order Number",     6);
      $prg_data->add_column("works_num",         "Works Number",     6);
      $prg_data->add_column("w_date",            "Withdrawn",       11);

      $sql = 'SELECT s.b_date,
                     concat(s.b_date, lpad(s.loco_id, " ", 10))       AS b_date_fmt,
                     s.w_date,
                     concat(s.w_date, lpad(s.loco_id, " ", 10))       AS w_date_fmt,
                     sc.identifier,
                     concat(sc.identifier, lpad(s.loco_id, " ", 10))  AS identifier_fmt,
                     sc.wheel_arrangement,
                     concat("misc.php?page=wheelarr&id=", sc.wheel_arrangement) 
                                                                      AS wheel_arrangement_hl,
                     concat(sc.wheel_arrangement, lpad(s.loco_id, " ", 10))
                                                                      AS wheel_arrangement_fmt,
                     concat(substr(p.forename, 1, 1),
                            ". ",
                            p.surname)                                AS cme,
                     concat("people.php?page=cme&id=", p.p_id)        AS cme_hl,
                     concat(p.surname, lpad(s.loco_id, " ", 10))      AS cme_fmt,
                     coalesce(b.bl_short_name, b.bl_name)             AS builder,
                     concat("sites.php?page=builders&id=", b.bl_code) AS builder_hl,
                     concat(b.bl_name, lpad(s.loco_id, " ", 10))      AS builder_fmt,
                     s.works_num,
                     concat("locoqry.php?action=locodata&id=", s.loco_id, "&type=S&loco=",
                            sn.number)                                AS works_num_hl,
                     concat(s.works_num, lpad(s.loco_id, " ", 10))    AS works_num_fmt,
                     CASE WHEN o.virtual_ind = "N" THEN
		               o.order_number
		             ELSE
		               "??"
		             END                                              AS order_number,
                     concat("sites.php?page=builders&subpage=orders&id=", o.bl_code, "&lot=",
                         o.order_number, "&oid=", o.order_id)         AS order_number_hl,
                     concat(o.order_number, lpad(s.loco_id, " ", 10)) AS order_number_fmt,
                     sn.number,
                     concat("locoqry.php?action=locodata&id=", s.loco_id, "&type=S&loco=",
                            sn.number)                                AS number_hl,
                     scc1.s_class_code                                AS prg_class,
                     concat("locoqry.php?action=class&type=S&id=", sc.s_class_id) 
                                                                      AS prg_class_hl,
                     concat(scc1.s_class_code, lpad(s.loco_id, " ", 10))
                                                                      AS prg_class_fmt

              FROM   steam s
              JOIN   s_class_link scl
              ON     scl.loco_id = s.loco_id
              AND    scl.first_class_flag = "Y"
              JOIN   s_class sc
              ON     sc.s_class_id = scl.s_class_id
              LEFT JOIN s_nums sn
              ON     sn.loco_id = s.loco_id
              AND    sn.first_number = "Y"
              JOIN   ref_people p
              ON     sc.designer_id = p.p_id
              LEFT JOIN s_class_codes scc1
              ON     scc1.s_class_id = s.first_class_id
              AND    scc1.s_class_var_id = s.first_class_var_id
              AND    scc1.company = sc.prg_company
              LEFT JOIN ref_builders b
              ON     b.bl_code = s.bl_code
              LEFT JOIN ref_orders o
              ON     o.order_id = s.order_id
              WHERE  sc.prg_company = "' . $prg . '"
              ORDER BY s.b_date, sn.number';
              
//            echo $sql;

      fn_logit(2, $prg);
              
      $result = $db->execute($sql);

      while ($row = mysqli_fetch_assoc($result))
      {
        $row['b_date'] = fn_fdate($row['b_date']);
        $row['w_date'] = fn_fdate($row['w_date']);
        $prg_data->add_data($row);
      }

      $prg_data->draw_table();
    }
    else
    {
      $sql = 'SELECT *
              FROM   ref_companies
              WHERE  cmp_initials = "' . $page . '"';
          
      fn_logit(2, $page);
      
      $result = $db->execute($sql);

      if ($result)
      {
        if ($db->count_select())
        {
          $row = mysqli_fetch_assoc($result);

          $title = $row['cmp_name'];
          if (empty($row['cmp_parent']))
            $title .= " and Constituent Companies";
          $parent_id = $row['cmp_id'];

          $sql = 'SELECT c.*
                  FROM   ref_companies c
                  WHERE  c.cmp_parent = ' . $parent_id . '
                  OR     c.cmp_id = ' . $parent_id . '
                  ORDER BY ifnull(c.cmp_parent, 0), c.cmp_name';
                
 // echo $sql;
          $result = $db->execute($sql);
        
          $tb->add_caption($title);
          $tb->add_column("cmp_initials",      " ",        5);
          $tb->add_column("cmp_name",          "Company", 25);
          $tb->add_column("cme",               "CME",     40);
          $tb->add_column("cmp_incorporated",  "Date Incorporated", 10);
          $tb->add_column("cmp_amalgamated",   "Date Amalgamated", 10);
          $tb->add_column("locos",             "Locomotives", 5);

          $last_cmp_id = -1;

          if ($result)
          while ($row = mysqli_fetch_assoc($result))
          {
            $tb->add_data($row);
          }
        
          $tb->draw_table();
        }
        else
        {
          echo "Unknown company: " . $page . "<br />";
        }
      }
    }

    // printf("<h3>%s</h3>\n", $title);
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

