<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  
<html xmlns="www.w3.org/1999/xhtml">

<!--
Copyright: Darren Hester 2006, www.designsbydarren.com
License: Released Under the "Creative Commons License", 
creativecommons.org/licenses/by-nc/2.5/
-->

<head>

<!-- Site Title -->
<title>Locomotive Manufacturers | Locomotive Works | Locomotive Builders
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

<h2>Manufacturing Report</h2>

<div class="featurebox_center">

<?php
  require_once "lib/quickdb.class.php";
  require_once "lib/MyTables.class.php";
  require_once "lib/brlib.php";

  $db = fn_connectdb();

  $tb = new MyTables("builds");
  $tb_summ = new MyTables("wdn_summary", 65);
?>

<?php if (isset($_POST['year_select_start'])): ?>
<?php

  
  // 6 possible parameters
  //   mon_select_start   <$mvals>   - month start 01-12
  //   mon_select_end     <$mvale>   - month end 01-12 or '-'
  //   year_select_start  <$yvals>   - year start (4 digits)
  //   year_select_end    <$yvale>   - year end (4 digits or '-')
  //   locotype           <$type>    - array of loco types (D, S etc...)
  //   manuf              <$manu>    - array of manufacturers (2 or 3 chars or 00-06 or '??')
  
  $mvals = $mvale = $yvals = $yvale = $type = $manu = "";

  foreach ($_POST as $key => $value)
  {
    if ($key == "mon_select_start")
    {
      $mvals = $value;
      if (!empty($mvals))
        fn_check_digit($mvals, 2);
    }
    else
    if ($key == "mon_select_end")
    {
      $mvale = $value;
      if (!empty($mvale))
        if ($mvale != '-')
          fn_check_digit($mvale, 2);
    }
    else
    if ($key == "year_select_start")
    {
      $yvals = $value;
      if (!empty($yvals))
        fn_check_digit($yvals, 4);
    }
    else
    if ($key == "year_select_end")
    {
      $yvale = $value;
      if (!empty($yvale))
        if ($yvale != '-')
          fn_check_digit($yvale, 4);
    }
    else
    if ($key == "locotype") // this is an array - taken from form and already uppercase
    {
      $type = $value;
      if (is_array($type))
        for ($nx = 0; $nx < count($type); $nx++)
          if (!empty($type[$nx]))
            fn_check_type($type[$nx]);
    }
    else
    if ($key == "manuf") // this is an array
    {
      $manu = $value;
      if (is_array($manu))
        for ($nx = 0; $nx < count($manu); $nx++)
          if (!empty($manu[$nx]))
            if (strcmp($manu[$nx], "??"))
              fn_check_alnum($manu[$nx], 3);
    }
    else
      fn_poem($key, $value, 99);
  }
  
  $all = 0;
  $mtype = array();
  $mlist = array();
  $inclause1 = $inclause2 = $inclause3 = "";
  $b4 = 0;

  for ($nx = 0; $nx < count($manu); $nx++)
  {
    // manufacturers starting with a zero are groups - e.g. all GWR works.
    if (strncmp($manu[$nx], "0", 1) == 0)
    {
      switch($manu[$nx][1])
      {
        case "0": // all
          $all = 1;
          $wk_list = "<li>&nbsp;&nbsp;All Workshops</li>";
          break;
        case "1": // all BR
          $mtype[] = "B";
          if (!empty($wk_list))
            $wk_list .= "<li>&nbsp;&nbsp;";
          else
            $wk_list = "<li>&nbsp;&nbsp;";

          $wk_list .= "BR Workshops</li>";
          break;
        case "2": // all GWR
          $cmp[] = 'GWR'; $b4 = 1;
          if (!empty($wk_list))
            $wk_list .= "<li>&nbsp;&nbsp;";
          else
            $wk_list = "<li>&nbsp;&nbsp;";

          $wk_list .= "GWR Workshops</li>";
          break;
        case "3": // all LMS
          $cmp[] = 'LMS'; $b4 = 1;
          if (!empty($wk_list))
            $wk_list .= "<li>&nbsp;&nbsp;";
          else
            $wk_list = "<li>&nbsp;&nbsp;";
          $wk_list .= "LMS Workshops</li>";
          break;
        case "4": // all LNER
          $cmp[] = 'LNER'; $b4 = 1;
          if (!empty($wk_list))
            $wk_list .= "<li>&nbsp;&nbsp;";
          else
            $wk_list = "<li>&nbsp;&nbsp;";
          $wk_list .= "LNER Workshops</li>";
          break;
        case "5": // all SR
          $cmp[] = 'SR'; $b4 = 1;
          if (!empty($wk_list))
            $wk_list .= "<li>&nbsp;&nbsp;";
          else
            $wk_list = "<li>&nbsp;&nbsp;";
          $wk_list .= "SR Workshops</li>";
          break;
        case "6": // All private.
          $mtype[] = "P";
          if (!empty($wk_list))
            $wk_list .= "<li>&nbsp;&nbsp;";
          else
            $wk_list = "<li>&nbsp;&nbsp;";
          $wk_list .= "All Private Workshops</li>";
          break;
        default:
          die("Unknown option");
          break;
      }
    }
    else
    {
      $mlist[] = $manu[$nx];
    }

    if ($all == 1)
    {
    }
    else
    if (count($mlist) > 0)
    {
      for ($ny = 0; $ny < count($mlist); $ny++)
      {
        if ($ny == 0)
          $inclause1 = "(\"" . $mlist[$ny] . "\"";
        else
          $inclause1 .= ",\"" . $mlist[$ny] . "\"";
      }
      if ($ny)
        $inclause1 .= ")";
    }

    if (count($mtype) > 0)
    {
      for ($ny = 0; $ny < count($mtype); $ny++)
      {
        if ($ny == 0)
          $inclause2  = "(\"" . $mtype[$ny] . "\"";
        else
          $inclause2 .= ",\"" . $mtype[$ny] . "\"";
      }
      if ($ny)
        $inclause2 .= ")";
    }

    if (count($cmp) > 0)
    {
      for ($ny = 0; $ny < count($cmp); $ny++)
      {
        if ($ny == 0)
          $inclause3  = "(\"" . $cmp[$ny] . "\"";
        else
          $inclause3 .= ",\"" . $cmp[$ny] . "\"";
      }
      if ($ny)
        $inclause3 .= ")";
    }
  }

//  echo $inclause1 . "<br />";
//  echo $inclause2 . "<br />";
//  echo $inclause3 . "<br />";

  if (!empty($inclause1))
  {
    /* Get a list of manufacturers to display in the summary/heading */
    $sql_wk = 'SELECT coalesce(bl_short_name, bl_name) AS bl_name
               FROM   ref_builders
               WHERE  bl_code in ' . $inclause1;

    $result = $db->execute($sql_wk);

    if ($result)
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        if (!empty($wk_list))
          $wk_list .= "<li>&nbsp;&nbsp;";
        else
          $wk_list = "<li>&nbsp;&nbsp;";

        $wk_list .= $row['bl_name']. "</li>";
      }
    }
  }

  if ($yvale == "-")
  {
    $yvale = $yvals;
    $mvale = $mvals;
  }

  if ($yvale != "-")
  {
    if (($yvale == $yvals) && ($mvale == $mvals))
    {
//      echo "Same start and end date provided - searching for " . $mvals . "/" . $yvals
//                                                               . "<br />";
    }
    else
    if (($yvale == $yvals) && ($mvale == "00" || $mvals == "00"))
    {
      echo "Invalid wildcard search: " . $mvals . "/" . $yvals . " - " .
                                         $mvale . "/" . $yvale . "<br />";
      die("Exiting ...");
    }
    else
    if ((($yvale == $yvals) && $mvale < $mvals) ||
        ( $yvale < $yvals))
    {
      echo "End date precedes start date: " . $mvals . "/" . $yvals . " - " .
                                              $mvale . "/" . $yvale . "<br />";
      die("Exiting ...");
    }
  }

  if ($mvals == "00")
  {
    $formats  = "%Y";
    $datevals = $yvals;

    $datevale = $sdate = $datevals;
  }
  else
  {
    $formats  = "%Y-%m";
    $datevals = $yvals . "-" . $mvals;

    $sdate = $datevals;
  }

  if ($yvale == "-")
  {
    $datevale = $datevals;
  }
  else
  {
    if ($mvale == "00")
    {
      $formate  = "%Y";
      $datevale = $yvale;

      $edate = $datevale;
    }
    else
    {
      $formate  = "%Y-%m";
      $datevale = $yvale . "-" . $mvale;

      $sdate = $datevale;
    }
  }

  $gots = $gote = $gotd = 0;
  $sql_d = $sql_s = $sql_e = $sql = "";
  
  for ($nc = 0; $nc < count($type); $nc++)
  {
    switch ($type[$nc][0])
    {
      case 'S':
        $gots = 1;

        if ($all == 1)
        {
          $extraclause = "";
          $leftjoin = "LEFT ";
        }
        else
        {
          $leftjoin = "";
          if (!empty($inclause1))
          {
            $extraclause = "AND ( ( bl.bl_code IN " . $inclause1 . ")";
          }

          if (!empty($inclause2))
          {
            if (!empty($inclause1))
              $extraclause .= " OR ";
            else
              $extraclause = "AND ( ";
              
            $extraclause .= " (bl.type IN " . $inclause2 . ")";
          }

          if (!empty($inclause3))
          {
            if (!empty($inclause1) || !empty($inclause2))
              $extraclause .= " OR ";
            else
              $extraclause = "AND ( ";

            $extraclause .= " (bl.big4_company IN " . $inclause3 . ")";
          }
          
          if (!empty($extraclause))
            $extraclause .= " )";
        }

        $sql_s = 'SELECT "S"                  AS type,
                         concat("S", lpad(s.loco_id, 7, "0")) AS type_fmt,
                         s.works_num          AS works_num,
                         CASE WHEN o.virtual_ind = "Y" THEN
                           "UNKN"
                         ELSE
                           o.order_number
                         END AS order_number,
                         concat("sites.php?page=builders&amp;subpage=orders&amp;id=",
                                 o.bl_code, "&amp;lot=", o.order_number) AS order_number_hl,
                         s.loco_id            AS lid,
                         s.w_date     AS wdate,
                         concat(lpad(date_format(s.w_date, "%Y%m%d"), 8, "99999999"),
                                lpad(s.loco_id, 7, "0")) 
                                              AS wdate_fmt,
                         s.b_date     AS bdate,
                         concat(date_format(s.b_date, "%Y%m%d"), lpad(s.loco_id, 7, "0"))
                                              AS bdate_fmt,
                         coalesce(bl.bl_short_name, bl.bl_name)           AS manufacturer,
                         concat("sites.php?page=builders&amp;id=", 
                                bl.bl_code)   AS manufacturer_hl,
                         concat(bl.bl_name, s.loco_id) AS manufacturer_fmt,
                         dp.depot_name        AS first_depot,
                                                 concat("sites.php?page=depots&amp;action=query&amp;id=", dp.depot_id) 
                                              AS first_depot_hl,
                         dpc.depot_code       AS first_depot_cd,
                                                 concat("sites.php?page=depots&amp;action=query&amp;id=", dp.depot_id) 
                                              AS first_depot_cd_hl,
                         concat(dpc.depot_code, lpad(s.loco_id, 7, "0")) AS first_depot_fmt,
                         concat(dpc.depot_code, lpad(s.loco_id, 7, "0")) AS first_depot_cd_fmt,
                         sn.number            AS number,
                         sn.number_type       AS number_type,
                         concat("locoqry.php?action=locodata&amp;id=",s.loco_id,"&amp;type=S&amp;loco=",
                                sn.number)    AS number_hl,
                         concat(sn.number, lpad(s.loco_id, 7, "0")) AS number_fmt,
                         CONCAT(
                           CASE WHEN p.surname IS NOT NULL THEN
                             concat(p.surname, " ")
                           ELSE
                             ""
                           END,
                           coalesce(scv.common_name, sc.common_name, scv.class_type)) AS loco_class,
                                     concat("locoqry.php?action=class&amp;type=S&amp;id=",
                              sc.s_class_id)  AS loco_class_hl,
                         concat(sc.identifier, lpad(s.loco_id, 7, "0")) AS loco_class_fmt,
                         sc.wheel_arrangement AS wheel_arr,
                         concat("misc.php?page=wheelarr&amp;id=", 
                                sc.wheel_arrangement) AS wheel_arr_hl,
                         concat(sc.wheel_arrangement, lpad(s.loco_id, 7, "0")) AS wheel_arr_fmt
                   FROM  steam s

                   JOIN  s_nums sn
                   ON    sn.loco_id = s.loco_id
                   AND   sn.start_date = (SELECT max(sn1a.start_date)
                                          FROM   s_nums sn1a
                                          WHERE  sn1a.loco_id = s.loco_id
                                          AND    sn1a.start_date <= s.b_date)

                   LEFT JOIN s_alloc sa
                   ON    sa.loco_id = s.loco_id
                   AND   sa.alloc_flag = "N"

                   LEFT JOIN ref_depot_codes dpc
                   ON    dpc.depot_code = sa.allocation
                   AND   dpc.date_from = (SELECT max(dpc1a.date_from)
                                          FROM   ref_depot_codes dpc1a
                                          WHERE  dpc1a.depot_code = sa.allocation
                                          AND    dpc1a.date_from <= sa.alloc_date)

                   LEFT JOIN ref_depot dp
                   ON    dp.depot_id = dpc.depot_id

                   JOIN  s_class_link scl
                   ON    scl.loco_id = s.loco_id
                   AND   scl.start_date = (SELECT max(scl1a.start_date)
                                           FROM   s_class_link scl1a
                                           WHERE  scl1a.loco_id = s.loco_id
                                           AND    scl1a.start_date <= s.b_date)

                   JOIN  s_class sc
                   ON    sc.s_class_id = scl.s_class_id

                   JOIN  s_class_var scv
                   ON    scv.s_class_id = s.first_class_id
                   AND   scv.s_class_var_id = s.first_class_var_id
                   ' . $leftjoin . ' JOIN ref_builders bl
                   ON    bl.bl_code = s.bl_code
                   ' . $extraclause . '

                   LEFT JOIN ref_orders o
                   ON    o.order_id = s.order_id

                   LEFT JOIN ref_people p
                   ON     p.p_id = sc.designer_id

                   WHERE date_format(s.b_date, 
                                     "' . $formats . '") BETWEEN "' . $datevals . '"
                                                             AND "' . $datevale . '"';

         $sql = $sql_s;

         $sql_s = 'SELECT "Steam"                  AS type,
                          sc.s_class_id,
                          ifnull(sc.common_name, sc.identifier)     AS identifier,
                          p.surname                                 AS part1,
                          concat("people.php?page=cme&amp;id=", p.p_id) AS part1_hl,
                          sc.wheel_arrangement,
                          concat("misc.php?page=wheelarr&amp;id=", 
                                 sc.wheel_arrangement)              AS wheel_arrangement_hl,
                          sc.prg_company                            AS prg,
                          concat("companies.php?page=", ifnull(sc.big4_company, "BR"),
                                 "#", sc.prg_company)               AS prg_hl,
                          sc.big4_company                           AS big4,
                          concat("companies.php?page=", ifnull(sc.big4_company, "BR"))
                                                                    AS big4_hl,
                          count(*)                                  AS ct
                   FROM   steam s

                   JOIN   s_class_link scl
                   ON     scl.loco_id = s.loco_id
                   AND    scl.start_date = (SELECT max(scl1a.start_date)
                                            FROM   s_class_link scl1a
                                            WHERE  scl1a.loco_id = s.loco_id
                                            AND    scl1a.start_date <= s.b_date)

                   JOIN   s_class sc
                   ON     sc.s_class_id = scl.s_class_id

                   ' . $leftjoin . ' JOIN ref_builders bl
                   ON    bl.bl_code = s.bl_code
                   ' . $extraclause . '

                   LEFT JOIN ref_people p
                   ON     sc.designer_id = p.p_id

                   WHERE date_format(s.b_date, 
                                     "' . $formats . '") BETWEEN "' . $datevals . '"
                                                             AND "' . $datevale . '"
                   GROUP BY type, 
                            sc.s_class_id, 
                            sc.identifier,
                            part1,
                            part1_hl,
                            sc.wheel_arrangement,
                            wheel_arrangement_hl,
                            prg,
                            prg_hl,
                            big4,
                            big4_hl';


        if (!empty($sql2))
          $sql2 .= " UNION " . $sql_s;
        else
          $sql2 = $sql_s;

        break;

      case 'D':
        $gotd = 1;
        if ($all == 1)
        {
          $extraclause = "";
          $leftjoin = "LEFT ";
        }
        else
        {
          $leftjoin = "";
          if (!empty($inclause1))
          {
            $extraclause = "AND (bl.bl_code IN " . $inclause1;
            if (!empty($inclause2))
              $extraclause .= "OR  bl.type IN " . $inclause2;
            $extraclause .= ")";
          }
          else
          if (!empty($inclause2))
          {
            $extraclause = "AND  bl.type IN " . $inclause2;
          }
        }

        $sql_d = 'SELECT "D"                  AS type,
                         concat("D", lpad(d.loco_id, 7, "0")) AS type_fmt,
                         d.works_num          AS works_num,
                         o.order_number       AS order_number,
                         concat("sites.php?page=builders&amp;subpage=orders&amp;id=",
                                 o.bl_code, "&amp;lot=", o.order_number) AS order_number_hl,
                         d.loco_id            AS lid,
                         d.w_date     AS wdate,
                         concat(lpad(date_format(d.w_date, "%Y%m%d"), 8, "99999999"),
                                lpad(d.loco_id, 7, "0")) 
                                              AS wdate_fmt,
                         d.b_date     AS bdate,
                         concat(date_format(d.b_date, "%Y%m%d"), 
                                lpad(d.loco_id, 7, "0")) AS bdate_fmt,
                         coalesce(bl.bl_short_name, bl.bl_name)           AS manufacturer,
                         concat("sites.php?page=builders&amp;id=", 
                                bl.bl_code)   AS manufacturer_hl,
                         concat(bl.bl_name, lpad(d.loco_id, 7, "0")) AS manufacturer_fmt,
                         dp.depot_name        AS first_depot,
                                                 concat("sites.php?page=depots&amp;action=query&amp;id=", dp.depot_id) 
                                              AS first_depot_hl,
                         dpc.depot_code       AS first_depot_cd,
                                                 concat("sites.php?page=depots&amp;action=query&amp;id=", dp.depot_id) 
                                              AS first_depot_cd_hl,
                         concat(dpc.depot_code, lpad(d.loco_id, 7, "0")) AS first_depot_fmt,
                         concat(dpc.depot_code, lpad(d.loco_id, 7, "0")) AS first_depot_cd_fmt,
                         dn.number            AS number,
                         dn.number_type       AS number_type,
                         concat("locoqry.php?action=locodata&amp;id=",d.loco_id,"&amp;type=D&amp;loco=",
                                dn.number)    AS number_hl,
                         concat(dn.number, lpad(d.loco_id, 7, "0")) AS number_fmt,
                         dc.identifier        AS loco_class,
                                     concat("locoqry.php?action=class&amp;type=D&amp;id=",
                              dc.d_class_id)  AS loco_class_hl,
                         concat(dc.identifier, lpad(d.loco_id, 7, "0")) AS loco_class_fmt,
                         dc.wheel_arrangement AS wheel_arr,
                         concat("misc.php?page=wheelarr&amp;id=", 
                                dc.wheel_arrangement) AS wheel_arr_hl,
                         concat(dc.wheel_arrangement, lpad(d.loco_id, 7, "0")) AS wheel_arr_fmt
                   FROM  diesels d

                   JOIN  d_nums dn
                   ON    dn.loco_id = d.loco_id
                   AND   dn.start_date = (SELECT max(dn1a.start_date)
                                          FROM   d_nums dn1a
                                          WHERE  dn1a.loco_id = d.loco_id
                                          AND    dn1a.start_date <= d.b_date)

                   LEFT JOIN d_alloc da
                   ON    da.loco_id = d.loco_id
                   AND   da.alloc_flag = "N"

                   LEFT JOIN ref_depot_codes dpc
                   ON    dpc.depot_code = da.allocation
                   AND   dpc.date_from = (SELECT max(dpc1a.date_from)
                                          FROM   ref_depot_codes dpc1a
                                          WHERE  dpc1a.depot_code = da.allocation
                                          AND    dpc1a.date_from <= da.alloc_date)

                   LEFT JOIN ref_depot dp
                   ON    dp.depot_id = dpc.depot_id

                   JOIN  d_class_link dcl
                   ON    dcl.loco_id = d.loco_id
                   AND   dcl.start_date = (SELECT max(dcl1a.start_date)
                                           FROM   d_class_link dcl1a
                                           WHERE  dcl1a.loco_id = d.loco_id
                                           AND    dcl1a.start_date <= d.b_date)

                   JOIN  d_class dc
                   ON    dc.d_class_id = dcl.d_class_id
                   ' . $leftjoin . ' JOIN ref_builders bl
                   ON    bl.bl_code = d.bl_code
                   ' . $extraclause . '

                   LEFT JOIN ref_orders o
                   ON    o.order_id = d.order_id

                   WHERE date_format(d.b_date, 
                                     "' . $formats . '") BETWEEN "' . $datevals . '"
                                                             AND "' . $datevale . '"';

        if ($sql != "")
          $sql .= " UNION " . $sql_d;
        else
          $sql = $sql_d;

        $sql_d = 'SELECT "Diesel"                 AS type,
                         dc.d_class_id,
                         ifnull(dc.common_name, dc.identifier)     AS identifier,
                         NULL                                      AS part1,
                         NULL                                      AS part1_hl,
                         dc.wheel_arrangement,
                         concat("misc.php?page=wheelarr&amp;id=", 
                                dc.wheel_arrangement)              AS wheel_arrangement_hl,
                         NULL                                      AS prg,
                         NULL                                      AS prg_hl,
                         NULL                                      AS big4,
                         NULL                                      AS big4_hl,
                         count(*)                                  AS ct
                  FROM   diesels d

                  JOIN   d_class_link dcl
                  ON     dcl.loco_id = d.loco_id
                  AND    dcl.start_date = (SELECT max(dcl1a.start_date)
                                           FROM   d_class_link dcl1a
                                           WHERE  dcl1a.loco_id = d.loco_id
                                           AND    dcl1a.start_date <= d.b_date)
                  JOIN   d_class dc
                  ON     dc.d_class_id = dcl.d_class_id

                  ' . $leftjoin . ' JOIN ref_builders bl
                  ON    bl.bl_code = d.bl_code
                  ' . $extraclause . '

                  WHERE date_format(d.b_date, 
                                     "' . $formats . '") BETWEEN "' . $datevals . '"
                                                             AND "' . $datevale . '"
                  GROUP BY type, 
                           dc.d_class_id, 
                           dc.identifier,
                           part1,
                           part1_hl,
                           dc.wheel_arrangement,
                           wheel_arrangement_hl,
                           prg,
                           prg_hl,
                           big4,
                           big4_hl';

        if (!empty($sql2))
          $sql2 .= " UNION " . $sql_d;
        else
          $sql2 = $sql_d;
        break;

      case 'E':
        $gote = 1;

        if ($all == 1)
        {
          $extraclause = "";
          $leftjoin = "LEFT ";
        }
        else
        {
          $leftjoin = "";
          if (!empty($inclause1))
          {
            $extraclause = "AND (bl.bl_code IN " . $inclause1;
            if (!empty($inclause2))
              $extraclause .= "OR  bl.type IN " . $inclause2;
            $extraclause .= ")";
          }
          else
          if (!empty($inclause2))
          {
            $extraclause = "AND  bl.type IN " . $inclause2;
          }
        }

        $sql_e = 'SELECT "E"                  AS type,
                         concat("E", lpad(e.loco_id, 7, "0")) AS type_fmt,
                         e.works_num          AS works_num,
                         o.order_number       AS order_number,
                         concat("sites.php?page=builders&amp;subpage=orders&amp;id=",
                                 o.bl_code, "&amp;lot=", o.order_number) AS order_number_hl,
                         e.loco_id            AS lid,
                         e.w_date     AS wdate,
                         concat(lpad(date_format(e.w_date, "%Y%m%d"), 8, "99999999"),
                                lpad(e.loco_id, 7, "0")) 
                                              AS wdate_fmt,
                         e.b_date     AS bdate,
                         concat(date_format(e.b_date, "%Y%m%d"), lpad(e.loco_id, 7, "0"))
                                              AS bdate_fmt,
                         coalesce(bl.bl_short_name, bl.bl_name)           AS manufacturer,
                         concat("sites.php?page=builders&amp;id=", 
                                bl.bl_code)   AS manufacturer_hl,
                         concat(bl.bl_name, lpad(e.loco_id, 7, "0")) AS manufacturer_fmt,
                         dp.depot_name        AS first_depot,
                                                 concat("sites.php?page=depots&amp;action=query&amp;id=", dp.depot_id) 
                                              AS first_depot_hl,
                         dpc.depot_code       AS first_depot_cd,
                                                 concat("sites.php?page=depots&amp;action=query&amp;id=", dp.depot_id) 
                                              AS first_depot_cd_hl,
                         concat(dpc.depot_code, lpad(e.loco_id, 7, "0")) AS first_depot_fmt,
                         concat(dpc.depot_code, lpad(e.loco_id, 7, "0")) AS first_depot_cd_fmt,
                         en.number            AS number,
                         en.number_type       AS number_type,
                         concat("locoqry.php?action=locodata&amp;id=",e.loco_id,"&amp;type=E&amp;loco=",
                                en.number)    AS number_hl,
                         concat(en.number, lpad(e.loco_id, 7, "0")) AS number_fmt,
                         ec.identifier        AS loco_class,
                                     concat("locoqry.php?action=class&amp;type=E&amp;id=",
                              ec.e_class_id)  AS loco_class_hl,
                         concat(ec.identifier, lpad(e.loco_id, 7, "0")) AS loco_class_fmt,
                         ec.wheel_arrangement AS wheel_arr,
                         concat("misc.php?page=wheelarr&amp;id=", 
                                ec.wheel_arrangement) AS wheel_arr_hl,
                         concat(ec.wheel_arrangement, e.loco_id) AS wheel_arr_fmt

                   FROM  electric e

                   JOIN  e_nums en
                   ON    en.loco_id = e.loco_id
                   AND   en.start_date = (SELECT max(en1a.start_date)
                                          FROM   e_nums en1a
                                          WHERE  en1a.loco_id = e.loco_id
                                          AND    en1a.start_date <= e.b_date)

                   LEFT JOIN e_alloc ea
                   ON    ea.loco_id = e.loco_id
                   AND   ea.alloc_flag = "N"

                   LEFT JOIN ref_depot_codes dpc
                   ON    dpc.depot_code = ea.allocation
                   AND   dpc.date_from = (SELECT max(dpc1a.date_from)
                                          FROM   ref_depot_codes dpc1a
                                          WHERE  dpc1a.depot_code = ea.allocation
                                          AND    dpc1a.date_from <= ea.alloc_date)

                   LEFT JOIN ref_depot dp
                   ON    dp.depot_id = dpc.depot_id

                   JOIN  e_class_link ecl
                   ON    ecl.loco_id = e.loco_id
                   AND   ecl.start_date = (SELECT max(ecl1a.start_date)
                                           FROM   e_class_link ecl1a
                                           WHERE  ecl1a.loco_id = e.loco_id
                                           AND    ecl1a.start_date <= e.b_date)

                   JOIN  e_class ec
                   ON    ec.e_class_id = ecl.e_class_id
                   ' . $leftjoin . ' JOIN ref_builders bl
                   ON    bl.bl_code = e.bl_code
                   ' . $extraclause . '

                   LEFT JOIN ref_orders o
                   ON    o.order_id = e.order_id

                   WHERE date_format(e.b_date, 
                                     "' . $formats . '") BETWEEN "' . $datevals . '"
                                                             AND "' . $datevale . '"';
                   
        if ($sql != "")
          $sql .= "UNION " . $sql_e;
        else
          $sql = $sql_e;

        $sql_e = 'SELECT "Electric"                AS type,
                         ec.e_class_id,
                         ifnull(ec.common_name, ec.identifier)     AS identifier,
                         NULL                                      AS part1,
                         NULL                                      AS part1_hl,
                         ec.wheel_arrangement,
                         concat("misc.php?page=wheelarr&amp;id=", 
                                ec.wheel_arrangement)              AS wheel_arrangement_hl,
                         NULL                                      AS prg,
                         NULL                                      AS prg_hl,
                         NULL                                      AS big4,
                         NULL                                      AS big4_hl,
                         count(*)                                  AS ct
                  FROM   electric e

                  JOIN   e_class_link ecl
                  ON     ecl.loco_id = e.loco_id
                  AND    ecl.start_date = (SELECT max(ecl1a.start_date)
                                           FROM   e_class_link ecl1a
                                           WHERE  ecl1a.loco_id = e.loco_id
                                           AND    ecl1a.start_date <= e.b_date)
                  JOIN   e_class ec
                  ON     ec.e_class_id = ecl.e_class_id

                  ' . $leftjoin . ' JOIN ref_builders bl
                  ON    bl.bl_code = e.bl_code
                  ' . $extraclause . '

                  WHERE  date_format(e.b_date, 
                                     "' . $formats . '") BETWEEN "' . $datevals . '"
                                                             AND "' . $datevale . '"
                  GROUP BY type, 
                           ec.e_class_id, 
                           ec.identifier,
                           part1,
                           part1_hl,
                           ec.wheel_arrangement,
                           wheel_arrangement_hl,
                           prg,
                           prg_hl,
                           big4,
                           big4_hl';

        if (!empty($sql2))
          $sql2 .= " UNION " . $sql_e;
        else
          $sql2 = $sql_e;

        break;
      default:
        break;
    }
  }

  if ($sql)
    $sql .= " ORDER BY bdate ASC";

  //echo $sql_s . "<br />";
  //echo $sql_d . "<br />";
  //echo $sql_e . "<br />";

  $caps = $cape = $caplink = "";
    
  if ($mvals != "00")
  {
    if ($mvals == "01")
      $caps = "January " . $yvals;
    else
    if ($mvals == "02")
      $caps = "February " . $yvals;
    else
    if ($mvals == "03")
      $caps = "March " . $yvals;
    else
    if ($mvals == "04")
      $caps = "April " . $yvals;
    else
    if ($mvals == "05")
      $caps = "May " . $yvals;
    else
    if ($mvals == "06")
      $caps = "June " . $yvals;
    else
    if ($mvals == "07")
      $caps = "July " . $yvals;
    else
    if ($mvals == "08")
      $caps = "August " . $yvals;
    else
    if ($mvals == "09")
      $caps = "September " . $yvals;
    else
    if ($mvals == "10")
      $caps = "October " . $yvals;
    else
    if ($mvals == "11")
      $caps = "November " . $yvals;
    else
    if ($mvals == "12")
      $caps = "December " . $yvals;
  }
  else
    $caps = $yvals;

  if ($mvale != "00")
  {
    if ($mvale == "01")
      $cape = "January " . $yvale;
    else
    if ($mvale == "02")
      $cape = "February " . $yvale;
    else
    if ($mvale == "03")
      $cape = "March " . $yvale;
    else
    if ($mvale == "04")
      $cape = "April " . $yvale;
    else
    if ($mvale == "05")
      $cape = "May " . $yvale;
    else
    if ($mvale == "06")
      $cape = "June " . $yvale;
    else
    if ($mvale == "07")
      $cape = "July " . $yvale;
    else
    if ($mvale == "08")
      $cape = "August " . $yvale;
    else
    if ($mvale == "09")
      $cape = "September " . $yvale;
    else
    if ($mvale == "10")
      $cape = "October " . $yvale;
    else
    if ($mvale == "11")
      $cape = "November " . $yvale;
    else
    if ($mvale == "12")
      $cape = "December " . $yvale;
  }
  else
  if ($yvale != "-")
    $cape = $yvale;

  if ($gots && $gotd && $gote)
    $caption = "All ";
  else
  {
    if ($gots && $gote)
      $caption = "Steam &amp; Electric ";
    else
    if ($gots && $gotd)
      $caption = "Steam &amp; Diesel ";
    else
    if ($gots)
      $caption = "Steam ";
    else
    if ($gotd && $gote)
      $caption = "Diesel &amp; Electric ";
    else
    if ($gotd)
      $caption = "Diesel ";
    else
    if ($gote)
      $caption = "Electric ";
  }

  if (!empty($cape))
  {
    if ($caps == $cape)
      $caption .= "locomotives manufactured during " . $caps;
    else
      $caption .= "locomotives manufactured between " . $caps . " and " . $cape;
  }
  else
    $caption .= "locomotives manufactured during " . $caps;

  $tb->sortable();
  $tb->allow_rollover();
  $tb->colour_coordinate("Y");
 
//  $tb->add_caption($caption);
  printf("<h4>%s by:</h4><br /> <ul class=\"ulist\">%s</ul><br />\n", $caption, $wk_list);
  $tb->add_column("ltype",           "Type",            5);
  $tb->add_column("number",          "Number (as built)",    7);
  $tb->add_column("order_number",    "Order",           4);
  $tb->add_column("works_num",       "Works Number",    7);
  $tb->add_column("loco_class",      "Class",          13);
  $tb->add_column("wheel_arr",       "Wheels",          7);
  $tb->add_column("bdate",           "Build Date",      9);
  $tb->add_column("manufacturer",    "Builder",        20);
  $tb->add_column("first_depot_cd",  "Code",            5);
  $tb->add_column("first_depot",     "First Depot",    14);
  $tb->add_column("wdate",           "Withdrawn",       9);

  $result = $db->execute($sql);

  $tot = $db->count_select();

  if ($result)
  {
  if ($tot > 0)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      if ($row['type'] == "S")
        $row['ltype'] = "Steam";
      else
      if ($row['type'] == "D")
      {
        $row['ltype'] = "Diesel";

        if ($row['number_type'] == "PRT")
          $row['number'] = fn_d_pfx($row['number']);
      }
      else
      if ($row['type'] == "E")
      {
        $row['ltype'] = "Electric";

        if ($row['number_type'] == "PRT")
          $row['number'] = fn_e_pfx($row['number']);
      }

      $row['bdate'] = fn_fdate($row['bdate']);
      $row['wdate'] = fn_fdate($row['wdate']);

      $tb->dump_data($row);
      unset($row);
    }

    if ($tot > 0)
      $tb->dump_data(NULL);
  }
  }

  /* Now for the summary */
  echo "<a name=\"summary\"></a>";

  $tb_summ->sortable();
  $tb_summ->allow_rollover();
  $tb_summ->colour_coordinate("Y");

  $tb_summ->add_caption("Summary for Selected Period");
  $tb_summ->add_column("type",           "Type",         15);
  $tb_summ->add_column("prg",            "Pre Grouping", 10);
  $tb_summ->add_column("big4",           "Big 4",        10);
  $tb_summ->add_column("desc",           "Class",        55);
  $tb_summ->add_column("ct",             "Number",       10);

  $result = $db->execute($sql2);

  if ($result)
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      if ($row['type'] == "Steam")
      {
        if (!empty($row['part1']))
          $row['desc'] = $row['part1'];
        $row['desc'] .= " " . $row['identifier'] . " " . $row['wheel_arrangement'];
        
      }
      else
      {
        $row['desc'] = "Class " . $row['identifier'] . " " . $row['wheel_arrangement'];
      }

      $tb_summ->dump_data($row);
    }

    if ($db->count_select())
    {
      echo "<br />";
      $tb_summ->dump_data(NULL);
    }
  }

endif; ?>

  <p>Select a month/year to display a list of all locomotives built for that period:</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <fieldset id="nb">
   <table width="96%" frame="box" border="0" cellpadding="1">
     <tr>
       <td width="4%" align="right">Start:</td>
       <td width="10%">

       <select size="1" name="mon_select_start">
         <option value="00">-</option>
         <option selected="selected" value="01">January</option>
         <option value="02">February</option>
         <option value="03">March</option>
         <option value="04">April</option>
         <option value="05">May</option>
         <option value="06">June</option>
         <option value="07">July</option>
         <option value="08">August</option>
         <option value="09">September</option>
         <option value="10">October</option>
         <option value="11">November</option>
         <option value="12">December</option>
       </select>

       </td>

       <td width="4%">

       <select size="1" name="year_select_start">
               <option value="1825">1825</option>
<?php
       for ($nx = 1826; $nx <= 1997; $nx++)
       {
         if ($nx == 1948)
                 printf("<option value=\"%d\" selected=\"selected\">%d</option>\n", $nx, $nx);
         else
                 printf("<option value=\"%d\">%d</option>\n", $nx, $nx);
       }
?>
       </select>

       </td>

       <td width="4%" align="right">End:</td>
       <td width="10%">

       <select size="1" name="mon_select_end">
         <option selected="selected" value="00">-</option>
         <option value="01">January</option>
         <option value="02">February</option>
         <option value="03">March</option>
         <option value="04">April</option>
         <option value="05">May</option>
         <option value="06">June</option>
         <option value="07">July</option>
         <option value="08">August</option>
         <option value="09">September</option>
         <option value="10">October</option>
         <option value="11">November</option>
         <option value="12">December</option>
       </select>

       </td>

       <td width="10%">

       <select size="1" name="year_select_end">
               <option value="-" selected="selected">-</option>
<?php
       for ($nx = 1826; $nx <= 1997; $nx++)
               printf("<option value=\"%d\">%d</option>\n", $nx, $nx);
?>
       </select>

       </td>

       <td width="14%" valign="middle">
       <input type="checkbox" name="locotype[]" value="S" checked="checked" />&nbsp; Steam<br />
       <input type="checkbox" name="locotype[]" value="D" checked="checked" />&nbsp; Diesel<br />
       <input type="checkbox" name="locotype[]" value="E" checked="checked" />&nbsp; Electric<br />
       </td>

       <td width="24%" valign="top">&nbsp;

       <select size="10" name="manuf[]" multiple="multiple">
         <option value="00" selected="selected">All</option>
         <option value="01">BR Workshops</option>
         <option value="02">GWR Workshops</option>
         <option value="03">LMS Workshops</option>
         <option value="04">LNER Workshops</option>
         <option value="05">SR Workshops</option>
         <option value="06">Private Workshops</option>

<?php
       $sql = 'select bl_code, 
                      coalesce(bl_short_name, bl_name) AS bl_name
               FROM   ref_builders
               ORDER BY bl_name ASC';

       $result = $db->execute($sql);

       if ($result)
       {
         while ($row = mysqli_fetch_assoc($result))
         {
           printf("<option value=\"%s\">%s</option>\n",
                  $row['bl_code'],
                  $row['bl_name']);
         }
       }
        
?>
       </select>
       </td>
     </tr>
   </table>
   <br />
   <input type="submit" value="Submit" />&nbsp;&nbsp;
   <input type="reset" />
   </fieldset>
  </form>

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

