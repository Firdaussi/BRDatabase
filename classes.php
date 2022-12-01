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
<title>Locomotive Classes | LNER | LMS | SR | GWR
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
  require_once "lib/quickdb.class.php";
  require_once "lib/MyTables.class.php";
  require_once "lib/brlib.php";
  
  $pg = $type = $subtype = $prg = $arr = "";

  // Five possible parameters
  //   type      <$type>    - type of class (S, D, E etc...)
  //   subtype   <$subtype> - company or type of search (wheels etc...)
  //   prg       <$prg>     - pre grouping company
  //   arr       <$arr>     - specific wheel arrangement
  
  foreach ($_GET as $key => $value)
  {
    if ($key == "type")
    {
      $type = strtoupper($value);
      if (!empty($type))
        fn_check_type($value);
    }
    else
    if ($key == "subtype")
    {
      $subtype = $value;
      if (!empty($subtype))
        fn_check_alnum($subtype);
    }
    else
    if ($key == "prg")
    {
       $prg = strtoupper($value);
       // might be 1850 or a string of chars, e.g. TVR
       if (!empty($prg))
		 if (!((strlen($prg) == 4) && !strcmp($prg, "1850")))
           fn_check_alnum($prg);
    }
    else
    if ($key == "arr")
    {
      $arr = strtoupper($value);
	  if (!empty($arr))
        fn_check_wheels($arr);
    }
    else
    if ($key == "fbclid")
    {
    }
    else
      fn_poem($key, $value, 99);
  }
  
  //echo "prg = " . $prg . "</br >";
  //echo "arr = " . $arr . "</br >";
  //echo "type = " . $type. "</br >";
  //echo "subtype= " . $subtype . "</br >";

if (1)
{
  $db = fn_connectdb();
  $tb = new MyTables("Diesels");

  if ($type == "D")
  {
    if (isset($subtype) && !empty($subtype))
    {
//      echo $subtype . "<br />";

      if ($subtype == "RCar" || $subtype == "DMU")
      {
      }
      else
      {
        if ($subtype == "Shunters")
        {
          printf("<h3>Shunters</h3>\n");
          $asql = ' where dc.type = "Shunter" ';
        }
        else
        if ($subtype == "Type1")
        {
          printf("<h3>Type 1 Diesels</h3>\n");
          $asql = ' where dc.type = "Type1" ';
        }
        else
        if ($subtype == "Type2")
        {
          printf("<h3>Type 2 Diesels</h3>\n");
          $asql = ' where dc.type = "Type2" ';
        }
        else
        if ($subtype == "Type3")
        {
          printf("<h3>Type 3 Diesels</h3>\n");
          $asql = ' where dc.type = "Type3" ';
        }
        else
        if ($subtype == "Type4")
        {
          printf("<h3>Type 4 Diesels</h3>\n");
          $asql = ' where dc.type = "Type4" ';
        }
        else
        if ($subtype == "Type5")
        {
          printf("<h3>Type 5 Diesels</h3>\n");
          $asql = ' where dc.type = "Type5" ';
        }
      }

//      echo "Extra sql: " . $asql . "<br />";
    }
    else
      printf("<h3>Diesel Locomotive Classes</h3>\n");

    $sql = 'select dc.d_class_id,
                   dc.identifier                           AS identifier,
                   concat("locoqry.php?action=class&amp;type=D&amp;id=",dc.d_class_id)     AS identifier_hl,
                   dc.common_name                          AS common_name,
                   concat("locoqry.php?action=class&amp;type=D&amp;id=",dc.d_class_id)     AS common_name_hl,
                   dc.year_introduced                      AS year_introduced,
                   dc.wheel_arrangement                    AS wheel_arrangement,
		               concat("misc.php?page=wheelarr&amp;id=",
		                      dc.wheel_arrangement)            AS wheel_arrangement_hl,
                   dc.number_range                         AS number_range,
		               concat("locoqry.php?action=class&amp;type=D&amp;id=", dc.d_class_id,
			                    "&amp;page=fleet")                   AS number_range_hl,
                   dc.loco_count                           AS loco_count,
                   " "                                     AS thumbnail,
                   concat("images/locos/diesel/thumbs/tn_", i.image)
                                                           AS thumbnail_img,
                   concat("locoqry.php?action=class&amp;id=",
		                      dc.identifier,
                          "&amp;type=D&amp;id=",dc.d_class_id)     AS thumbnail_hl,

                   CASE WHEN dcv.power_unit_number = 1 THEN
                             concat(coalesce(m.short_name, m.name), " ", 
                                    pu.model)
                        ELSE
                             concat(coalesce(m.short_name, m.name), " ",
                                    dcv.power_unit_number,          " x ",
                                    pu.model)
                   END                                     AS power_unit_desc,
                   dcv.transmission_type                   AS transmission_type,
                   dcv.multiple_working                    AS multiple_working,
                   CASE WHEN dcv.power_unit_number IS NOT NULL THEN
                             dcv.power_unit_number * pu.horse_power
                   ELSE
                              NULL
                   END                                     AS horse_power,
                   bl.bl_name

            from   d_class dc

            JOIN   d_class_var dcv
            ON     dcv.d_class_id = dc.d_class_id
            AND    dcv.d_class_var_id = 1

            LEFT JOIN ref_images i
            ON     i.type = "D"
            AND    i.class_id = dc.d_class_id
            AND    i.img_index = "Y"

            LEFT JOIN ref_power_units pu
            ON     pu.pu_id = dcv.pu_id
            
            LEFT JOIN ref_builders bl
            ON     dc.bl_code = bl.bl_code

            LEFT JOIN ref_manufacturer m
            ON     m.manufacturer_id = pu.manufacturer_id'

            . $asql .
            ' order by dc.type, dc.sort_order';

//echo $sql;

/*
    $sql = 'select dc.d_class_id,
                   ifnull(dcv.identifier, dc.identifier)   AS identifier,
                   concat("locoqry.php?action=class&type=D&id=",dc.d_class_id)     AS identifier_hl,
                   (dcv.d_class_id * 100 + dcv.d_class_var_id)                     AS identifier_fmt,
                   dc.common_name                          AS common_name,
                   concat("locoqry.php?action=class&type=D&id=",dc.d_class_id)     AS common_name_hl,
                   dcv.year_introduced                     AS year_introduced,
                   dc.wheel_arrangement                    AS wheel_arrangement,
		               concat("misc.php?page=wheelarr&id=",
		                      dc.wheel_arrangement)            AS wheel_arrangement_hl,
                   dcv.manufacturer,
                   NULL                                    AS number_range,
		               concat("locoqry.php?action=class&type=D&id=", dc.d_class_id,
			                    "&page=fleet")                   AS number_range_hl,
                   dcv.horse_power                         AS power_rating,
                   dcv.designer                            AS designer,
		               concat("people.php?page=cme&name=",
		                      dcv.designer)                    AS designer_hl,
                   dc.loco_count                           AS loco_count,
                   dc.thumbnail                            AS thumbnail_thb,
                   case when dcv.power_unit_number = 1 then
                             concat(dcv.power_unit_manufacturer, " ", 
                                    dcv.power_unit)
                        else
                             concat(dcv.power_unit_manufacturer, " ",
                                    dcv.power_unit_number,       " x ",
                                    dcv.power_unit)
                   end                                     AS power_unit_desc,
                   dcv.transmission_type                   AS transmission_type,
                   dcv.multiple_working                    AS multiple_working
            from   d_class dc
            join   d_class_var dcv
            on     dcv.d_class_id = dc.d_class_id'
            . $asql .
	          ' group by dc.d_class_id, identifier
              order by dc.type, identifier_fmt';
*/
//    echo $sql;

    $result = $db->execute($sql);
    $numrows= $db->count_select();

    $total_count = 0;

    $tb->allow_rollover();
    $tb->sortable();
    $tb->add_column("identifier",        "Class",         5);
    $tb->add_column("year_introduced",   "Introduced",    5);
    $tb->add_column("bl_name",           "Manufacturer", 18);
    $tb->add_column("power_unit_desc",   "Power Unit",   18);
    $tb->add_column("horse_power",       "Horse Power",   5);
    $tb->add_column("wheel_arrangement", "Wheels",        5);
    $tb->add_column("transmission_type", "Transmission",  9);
    $tb->add_column("number_range",      "Number Range", 13);
    $tb->add_column("loco_count",        "Number",        4);
    $tb->add_column("multiple_working",  "Multiple",      8);
    $tb->add_column("thumbnail",         "Thumbnail",    10);

    $count = 0; $lastid = 0;
    
    while ($row = mysqli_fetch_assoc($result))
    {
      if ($row['d_class_id'] == $lastid)
      {
        /* Same class as previous row */
      }

      $tb->add_data($row);
      $lastid = $row['d_class_id'];
    }

    if ($numrows)
      $tb->draw_table();
  }
  else
  if ($type == "S")
  {
    if (isset($subtype) or !empty($subtype))
    {
      if ($subtype == "Standards")
      {
        printf("<h3>British Railways Standard Locomotive Classes</h3>\n");
        $asql = " where sc.br_standard = 'Y' ";
      }
      else
      if ($subtype == "WD")
      {
        printf("<h3>War Department Locomotive Classes</h3>\n");
        $asql = " where sc.big4_company = 'WD' ";
      }
      else 
      if ($subtype == "ws")
      {
        printf("<h3>Locomotive Classes with Wheel Arrangement %s</h3>\n", $arr);

	    if (strchr($arr, "x"))
	    {
	      $val = str_replace("x", "%", $arr);

          $asql = " where sc.wheel_arrangement like '" . $val . "'";
	    }
	    else
	    {
          $asql = " where sc.wheel_arrangement = '" . $arr . "'";
	    }
      }
      else
      {
        if (isset($prg) && (strcmp($prg, "1850") != 0 && strcmp($prg, "1923") != 0))
        {
          $sql1 = "SELECT cmp1.cmp_name,
                          cmp1.cmp_initials   AS parent_code,
                          cmp2.cmp_initials   AS child_code
                   FROM   ref_companies cmp1
                   LEFT JOIN ref_companies cmp2
                   ON     cmp2.cmp_parent = cmp1.cmp_id
                   WHERE  cmp1.cmp_initials = '" . $prg  . "'";
                   
         // echo $sql1;

          $result = $db->execute($sql1);
          $n = 0;
          while ($row = mysqli_fetch_assoc($result))
            $r[] = $row;

          $complist = "'" . $r[0]['parent_code'] . "'";
          $compname = $r[0]['cmp_name'];

          for ($n = 0; $n < $db->count_select(); $n++)
          {
            if (!empty($r[$n]['child_code']))
              $complist .= ", '" . $r[$n]['child_code']  . "'";
          }

          $asql = " WHERE sc.prg_company IN (" . $complist . ")";
          printf("<h3>Locomotive Classes of the %s</h3>\n", $compname);
        }
        else
        {
            $sql1 = "SELECT cmp_name
                     FROM   ref_companies
                     WHERE  cmp_initials = '" . $subtype . "'";
                   
          if (isset($prg) && (strcmp($prg, "1850") == 0 || strcmp($prg, "1923") == 0))
          {
            $asql = " WHERE sc.big4_company =  '" . $subtype . "'
                      AND   CAST(sc.year_introduced AS unsigned) >= " . $prg . "
                      AND   sc.prg_company IS NULL";
          }
          else
            $asql = " WHERE sc.big4_company =  '" . $subtype . "'";

          $result = $db->execute($sql1);
          $numrows= $db->count_select();

          if ($numrows == 0)
          {
            die("Unknown selection: " . $prg . "/" . $subtype);
          }
          else
          {
            $row = mysqli_fetch_assoc($result);
          }

          printf("<h3>Locomotive Classes of the %s</h3>\n", $row['cmp_name']);
        }
      }

      if (!empty($asql))
        $asql .= " and scv.s_class_var_id = 1 ";
      else
        $asql  = " where scv.s_class_var_id = 1 ";
    }
    else
      printf("<h3>Steam Locomotive Classes</h3>\n");

    $sql = 'select sc.s_class_id,
                   coalesce(sc.common_name, sc.identifier) AS identifier,
                   concat("locoqry.php?action=class&type=S&id=", sc.s_class_id)    AS identifier_hl,
                   sc.sort_order                           AS identifier_fmt,
                   sc.common_name                          AS common_name,
                   concat("locoqry.php?action=class&type=S&id=", sc.s_class_id)    AS common_name_hl,
                   sc.year_introduced                      AS year_introduced,
                   sc.wheel_arrangement                    AS wheel_arrangement,
		               concat("misc.php?page=wheelarr&id=",
		                      sc.wheel_arrangement)            AS wheel_arrangement_hl,
                   sc.big4_company                         AS big_four,
		           sc.first_in_service                     AS s_date,
                   concat(date_format(sc.first_in_service, "%Y%m%d"), 
                                     lpad(sc.s_class_id, 7, "0000000"))  AS s_date_fmt,
		           sc.last_in_service                      AS e_date,
                   concat(date_format(sc.last_in_service, "%Y%m%d"), 
                                     lpad(sc.s_class_id, 7, "0000000"))  AS e_date_fmt,
                   c.cmp_name                              AS pre_grouping,
                   sc.prg_company,
                   sc.number_l,
                   sc.number_h,
                   NULL                                    AS number_range,
		               concat("locoqry.php?action=class&type=S&id=", 
                          sc.s_class_id, "&page=fleet")    AS number_range_hl,
                   scv.power_rating                        AS power_rating,
                   p1.surname                              AS designer,
		               concat("people.php?page=cme&id=",
		                      p1.p_id)                         AS designer_hl,
                   p2.surname                              AS modifier,
		               concat("people.php?page=cme&id=",
		                      p2.p_id)                         AS modifier_hl,
                   b.bl_name                               AS builder,
		               concat("sites.php?page=builders&subpage=main&id=",
		                      b.bl_code)                       AS builder_hl,
                   sc.loco_count                           AS loco_count,
                   IFNULL(sc.sort_order, 0)                AS sort_order,
                   " "                                     AS thumbnail,
                   concat("images/locos/steam/",
                                   CASE WHEN sc.br_standard = "Y" THEN
                                     "BR"
                                   ELSE
                                     sc.big4_company
                                   END,
                                   "/thumbs/tn_",
                                   i.image)                AS thumbnail_img,
                   concat("locoqry.php?action=class&type=S&id=",sc.s_class_id)     AS thumbnail_hl,
                   scc.s_class_code                        AS identifier_prg,
                   concat("locoqry.php?action=class&type=S&id=", sc.s_class_id)    AS identifier_prg_hl

            from   s_class_var scv

            join   s_class sc
            on     sc.s_class_id = scv.s_class_id

            LEFT JOIN ref_images i
            ON     i.type = "S"
            AND    i.class_id = sc.s_class_id
            AND    i.img_index = "Y"

            LEFT JOIN s_class_codes scc
            ON     scc.s_class_id = sc.s_class_id
            AND    scc.company = sc.prg_company

            LEFT JOIN ref_companies c
            ON     c.cmp_initials = sc.prg_company

            LEFT JOIN ref_people p1
            ON     p1.p_id = sc.designer_id

            LEFT JOIN ref_builders b
            ON     b.bl_code = sc.designer_bl_code

            left join ref_people p2
            on     p2.p_id = sc.modifier_id'
            . $asql . '
            ORDER BY sc.year_introduced ASC, sc.designer_id ASC';
// echo $sql;

    $result = $db->execute($sql);
    $numrows= $db->count_select();

    $total_count = 0;

    $tb->allow_rollover();
    $tb->sortable();
    $tb->add_column("designer",          "Designer",           10);
    $tb->add_column("identifier",        "Class",               9);
    $tb->add_column("identifier_prg",    "Pre Grouping Class", 11);
    $tb->add_column("wheel_arrangement", "Wheels",              5);
    $tb->add_column("year_introduced",   "Year",                5);
    $tb->add_column("prg_company",       "Pre Grouping",        5);
    $tb->add_column("big_four",          "Big 4",               5);
    $tb->add_column("power_rating",      "BR Power Class",      4);
    $tb->add_column("number_range",      "Number Range",       10);
    $tb->add_column("s_date",            "First",              10);
    $tb->add_column("e_date",            "Last",               10);
    $tb->add_column("loco_count",        "#",                   4);
    $tb->add_column("thumbnail",         "Thumbnail",          10);

    $lastid = 0;

//  echo $sql;

    if ($db->count_select())
    {
    while ($row = mysqli_fetch_assoc($result))
    {
      if (!empty($row['s_date']))
        $row['s_date'] = fn_fdate($row['s_date']);

      if (!empty($row['e_date']))
        $row['e_date'] = fn_fdate($row['e_date']);
	
      if (!empty($row['number_l']))
      {
        $row['number_range'] = $row['number_l'];

        if (!empty($row['number_h']))
          $row['number_range'] .= " - " . $row['number_h'];
      }

      if (!empty($row['identifier_prg']))
      {
        $x = $row['prg_company'] . " class '" . $row['identifier_prg'] . "'";
        $row['identifier_prg'] = $x;
      }

      if (!empty($row['modifier']))
      {
        $row['designer'] = "<a href=\"" . $row['designer_hl'] . "\">".$row['designer']."</a>".
                     "/" . "<a href=\"" . $row['modifier_hl'] . "\">".$row['modifier']."</a>";
      }

      if (empty($row['designer']) && !empty($row['builder']))
      {
        $row['designer'] = "<a href=\"" . $row['builder_hl'] . "\">".$row['builder']."</a>";
      }

      $tb->add_data($row);
    }

    if ($numrows)
      $tb->draw_table();
    }
  }
  else
  if ($type == "E")
  {
    if (isset($subtype) or !empty($subtype))
    {
      if ($subtype == "25kvac")
      {
        printf("<h3>25KV A/C Electrics</h3>\n");
        $asql = " where ec.current = '25KV' ";
      }
      else
      if ($subtype == "1500vdc")
      {
        printf("<h3>630/1500V D/C Electrics</h3>\n");
        $asql = " where ec.current IN ('630V', '1500V') ";
      }
      else
      if ($subtype == "SR")
      {
        printf("<h3>750V D/C Electrics</h3>\n");
        $asql = " where ec.current = '750V' ";
      }
    }
    else
      printf("<h3>Electric Locomotive Classes</h3>\n");

    $sql = 'select ec.e_class_id,
                   ec.identifier                           AS identifier,
                   concat("locoqry.php?action=class&type=E&id=",ec.e_class_id)     AS identifier_hl,
                   ec.common_name                          AS common_name,
                   concat("locoqry.php?action=class&type=E&id=",ec.e_class_id)     AS common_name_hl,
                   ec.year_introduced                      AS year_introduced,
                   ec.wheel_arrangement                    AS wheel_arrangement,
		               concat("misc.php?page=wheelarr&id=",
		                      ec.wheel_arrangement)            AS wheel_arrangement_hl,
                   ec.number_l,
                   ec.number_h,
                   ec.current,
                   NULL                                    AS number_range,
		               concat("locoqry.php?action=class&type=E&id=", ec.e_class_id,
			                    "&page=fleet")                   AS number_range_hl,
                   ec.loco_count                           AS loco_count,
                   " "                                     AS thumbnail,
                   concat("images/locos/electric/thumbs/tn_", i.image)
                                                           AS thumbnail_img,
                   concat("locoqry.php?action=class&type=E&id=",ec.e_class_id)     AS thumbnail_hl
            from   e_class ec

            LEFT JOIN ref_images i
            ON     i.type = "E"
            AND    i.class_id = ec.e_class_id
            AND    i.img_index = "Y"'

            . $asql .
            ' order by ec.identifier';
    // echo $sql;
    $result = $db->execute($sql);
    $numrows= $db->count_select();

    $total_count = 0;

    $tb->allow_rollover();
    $tb->sortable();
    $tb->add_column("identifier",        "Class",         5);
    $tb->add_column("common_name",       "AKA",          10);
    $tb->add_column("year_introduced",   "Introduced",    5);
    $tb->add_column("manufacturer",      "Manufacturer", 18);
    $tb->add_column("wheel_arrangement", "Wheels",        5);
    $tb->add_column("current",           "Current",       8);
    $tb->add_column("number_range",      "Number Range", 10);
    $tb->add_column("loco_count",        "Number",       10);
    $tb->add_column("multiple_working",  "Multiple",      8);
    $tb->add_column("thumbnail",         "Thumbnail",    10);

    $count = 0; $lastid = 0;
    
    while ($row = mysqli_fetch_assoc($result))
    {
      if ($lastid == $row['e_class_id'])
      {
      }
      else
      if ($count++ != 0)
      {
        $rowx['number_range'] = $number_range;
        $tb->add_data($rowx);
        $number_range = "";
      }

      $rowx = $row;

      if ($rowx['number_l'] != "")
      {
        $number_range = $rowx['number_l'];

        if ($rowx['number_h'] != "")
          $number_range = $number_range . " - " . $rowx['number_h'];
      }

      if ($rowx['modifier'] != "")
      {
        $rowx['designers'] = "<a href=\"" . $rowx['designer_hl'] . "\">".$rowx['designer']."</a>".
                       "/" . "<a href=\"" . $rowx['modifier_hl'] . "\">".$rowx['modifier']."</a>";
      }
      else
      {
        $rowx['designers_hl'] = $row['designer_hl'];
        $rowx['designers']    = $rowx['designer'];
      }

      $lastid = $rowx['e_class_id'];
    }

    if ($count)
    {
      $rowx['number_range'] = $number_range;
      $tb->add_data($rowx);

      $tb->draw_table();
    }
  }
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

