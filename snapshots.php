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
<meta name="keywords" content="steam, diesel, electric, locomotives, railways, LNER, LMS, GWR, Southern, Stanier, Gresley, Collett, Maunsell, Bulleid, Churchward, Riddles, Britannia, locos, //withdrawals, North British, Swindon, Crewe, Doncaster, Derby, Darlington, Eastleigh, Ashford, Brighton, Cowlairs, Inverurie, Gorton, Great Central, Great Northern, scrapping, allocations " />
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

<?php

  // 1 possible parameter
  //   page   <$pg>   - page selected
  
  $pg = "";  // $_GET parameters
  foreach ($_GET as $key => $value)
  {
    if ($key == "page")
    {
      $pg = $value;
      if (!empty($pg))
        fn_check_alpha($pg, 12);
    }
    else
    if ($key == "fbclid")
    {
    }
    else
      fn_poem($key, $value, 99);
  }
 
  if (isset($pg) or !empty($pg))
  {
    if ($pg == "workings")
    {
      printf("<h4>Locomotive Workings Snapshot</h4>\n");
    }
    else
    if ($pg == "locos")
    {
      printf("<h4>Locomotive Allocation Snapshot</h4>\n");
    }
    else
    if ($pg == "regional")
    {
      printf("<h4>Regional Events Snapshot</h4>\n");
    }
    else
    {
      die("Unknown page request");
    }
  }
  else
  {
    // default page requested
    printf("<h4>Snapshots Page</h4>");
    printf("<p>You have three options: <br />  1) obtain a snapshot of all locomotives extant in a particular month grouped by depot");
    printf("<br />  2) obtain a snapshot of workings and dispositions of all locos for a given month");
    printf("<br />  3) take a snapshot by region of all withdrawals/new builds/allocations and storages</p>");
    printf("<ul><li><a href=\"%s?page=locos\">Allocation Snapshot</a></li>\n", $PHP_SELF);
    printf("    <li><a href=\"%s?page=workings\">Workings Snapshot</a></li>\n", $PHP_SELF);
    printf("    <li><a href=\"%s?page=regional\">Regional Snapshot</a></li></ul>\n", $PHP_SELF);
    die(1);
  }

  $formsubmitted = 0;

  if (isset($_POST['year_select']))
  {
    $formsubmitted = 1;

    // 5 possible parameters
    //   mon_select   <$mval>   - month start 01-12
    //   year_select  <$yval>   - year start (4 digits)
    //   locotype     <$type>   - array of loco types (D, S etc...)
    //   region       <$reg>    - array of regions (    )
    //   region_sel   <$r>      - selected region
  
    $mval = $yval = $type = $reg = $r = "";

    // $_POST parameters
    foreach ($_POST as $key => $value)
    {
      if ($key == "mon_select")
      {
        $mval = $value;
        if (!empty($mval))
          fn_check_digit($mval, 2);
      }
      else
      if ($key == "year_select")
      {
        $yval = $value;
        if (!empty($yval))
          fn_check_digit($yval, 4);
      }
      else
      if ($key == "locotype") // this is an array - taken from form so already uppercase
      {
        $type = $value;
        if (is_array($type))
          for ($nx = 0; $nx < count($type); $nx++)
            if (!empty($type[$nx]))
              fn_check_type($type[$nx]);
      }
      else
      if ($key == "region") // this is an array
      {
        $reg = $value;
        if (is_array($reg))
          for ($nx = 0; $nx < count($reg); $nx++)
            if (!empty($reg[$nx]))
              fn_check_alpha($reg[$nx], 3);
      }
      else
      if ($key == "region_sel")
      {
        $r = $value;
        if (!empty($r))
          fn_check_alpha($r, 3);
      }
      else
        fn_poem($key, $value, 99);
    }

    // Parameters now checked
    
    $region = $r;

    $m = $mval;
    $y = $yval;
    $srchdate = $y . "-" . $m . "-01";
    
    $sclause = $dclause = $eclause = " 1 = 0 ";
    
    for ($nc = 0; $nc < count($type); $nc++)
    {
      switch ($type[$nc][0])
      {
        case 'S':
          $gots = 1;
          $sclause = " 1 = 1 ";
          break;
   
        case 'D':
          $gotd = 1;
          $dclause = " 1 = 1 ";
          break;
   
        case 'E':
          $gote = 1;
          $eclause = " 1 = 1 ";
          break;
      }
    }

    $regionclause = "";

    for ($nc = 0; $nc < count($reg); $nc++)
    {
      if ($nc == 0)
      {
        $regionclause    = ' AND dep_cd.region IN ("' . $reg[$nc] . '"';
      }
      else
      {
        $regionclause   .= ', "' . $reg[$nc] . '"';
      }

      if ($nc == (count($reg)-1))
      {
        $regionclause   .= ') ';
      }
    }
  } // 

  if ($pg == "workings" && $formsubmitted)
  {
    printf("<div class='featurebox_center'>\n");
    printf("</div>  <!-- featurebox_center -->\n");
  }
  else
  if ($pg == "regional" && $formsubmitted)
  {
    printf("<div class='featurebox_center'>\n");

    include_once "lib/quickdb.class.php";
    include_once "lib/brlib.php";
    include_once "lib/MyTables.class.php";

    #echo "Regional: " . $mval . ", " . $yval . " - " . $region . "<br />";
    $search_date = $mval . "-" . $yval;

    if ($mval != "00")
    {
      if ($mval == "01")
        $caps = "January " . $yval;
      else
      if ($mval == "02")
        $caps = "February " . $yval;
      else
      if ($mval == "03")
        $caps = "March " . $yval;
      else
      if ($mval == "04")
        $caps = "April " . $yval;
      else
      if ($mval == "05")
        $caps = "May " . $yval;
      else
      if ($mval == "06")
        $caps = "June " . $yval;
      else
      if ($mval == "07")
        $caps = "July " . $yval;
      else
      if ($mval == "08")
        $caps = "August " . $yval;
      else
      if ($mval == "09")
        $caps = "September " . $yval;
      else
      if ($mval == "10")
        $caps = "October " . $yval;
      else
      if ($mval == "11")
        $caps = "November " . $yval;
      else
      if ($mval == "12")
        $caps = "December " . $yval;
    }
    else
      $caps = $yval;

    $tb = new MyTables("rsnapshot");

    $tb->sortable();
    $tb->colour_coordinate("Y");
    $tb->add_column("number",         "Number",      10);
    $tb->add_column("loco_class",     "Class",        8);
    $tb->add_column("region",         "Region",       5);
    $tb->add_column("allocation1",    "Allocation",   5);
    $tb->add_column("depot1",         "Depot",       18);
    $tb->add_column("event_date2",    "Date",        11);
    $tb->add_column("status",         "Event",       43);

    $sqld =
       'SELECT "NEW"                                                  AS status,
               "D"                                                    AS type,
               d.loco_id                                              AS loco_id,
               dn.number                                              AS number,
               concat("locoqry.php?action=locodata&id=", d.loco_id,
                      "&type=D&loco=", dn.number)                     AS number_hl,
               dn.number_type                                         AS number_type,
               d.b_date                                               AS event_date1,
               concat(date_format(d.b_date, "%Y%m%d"), 
                      lpad(d.loco_id, 10, "0"))                       AS event_date1_fmt,
               d.first_depot                                          AS depot_code1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_code1_hl,
               dp.depot_name                                          AS depot_name1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_name1_hl,
               dp.depot_id                                            AS depot_id1,
               dcc.region                                             AS region1,
               d.b_date                                               AS event_date2,
               concat(date_format(d.b_date, "%Y%m%d"), 
                      lpad(d.loco_id, 10, "0"))                       AS event_date2_fmt,
               d.first_depot                                          AS depot_code2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_code2_hl,
               dp.depot_name                                          AS depot_name2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_name2_hl,
               dp.depot_id                                            AS depot_id2,
               dcc.region                                             AS region2,
               dc.identifier                                          AS loco_class,
               concat("locoqry.php?action=class&id=", 
                      dc.d_class_id, "&type=D&page=fleet")            AS loco_class_hl
        FROM   diesels d

        JOIN   d_nums dn
        ON     dn.loco_id = d.loco_id
        AND    dn.first_number = "Y"

        JOIN   ref_depot_codes dcc
        ON     dcc.depot_code = d.first_depot
        AND    dcc.date_from =                   (SELECT max(dcc1.date_from)
                                                  FROM   ref_depot_codes dcc1
                                                  WHERE  dcc1.depot_code = d.first_depot
                                                  AND    dcc1.date_from <= d.b_date)

        JOIN   ref_depot dp
        ON     dp.depot_id = dcc.depot_id

        JOIN   d_class_link dcl
        ON     dcl.loco_id = d.loco_id
        AND    dcl.start_date =                  (SELECT max(dcl1.start_date)
                                                  FROM   d_class_link dcl1
                                                  WHERE  dcl1.loco_id = d.loco_id
                                                  AND    dcl1.start_date <= d.b_date)

        JOIN   d_class dc
        ON     dc.d_class_id = dcl.d_class_id

        WHERE  dcc.region = "' . $region . '"
        AND    date_format(d.b_date, "%m-%Y") = "' . $search_date . '"

        UNION

        SELECT "WDN"                                                  AS status,
               "D"                                                    AS type,
               d.loco_id                                              AS loco_id,
               dn.number                                              AS number,
               concat("locoqry.php?action=locodata&id=", d.loco_id,
                      "&type=D&loco=", dn.number)                     AS number_hl,
               dn.number_type                                         AS number_type,
               d.w_date                                               AS event_date1,
               concat(date_format(d.w_date, "%Y%m%d"), 
                      lpad(d.loco_id, 10, "0"))                       AS event_date1_fmt,
               d.last_depot                                           AS depot_code1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_code1_hl,
               dp.depot_name                                          AS depot_name1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_name1_hl,
               dp.depot_id                                            AS depot_id1,
               dcc.region                                             AS region1,
               d.w_date                                               AS event_date2,
               concat(date_format(d.w_date, "%Y%m%d"), 
                      lpad(d.loco_id, 10, "0"))                       AS event_date2_fmt,
               d.last_depot                                           AS depot_code2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_code2_hl,
               dp.depot_name                                          AS depot_name2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_name2_hl,
               dp.depot_id                                            AS depot_id2,
               dcc.region                                             AS region2,
               dc.identifier                                          AS loco_class,
               concat("locoqry.php?action=class&id=", 
                      dc.d_class_id, "&type=D&page=fleet")            AS loco_class_hl
        FROM   diesels d

        JOIN   d_nums dn
        ON     dn.loco_id = d.loco_id
        AND    dn.start_date =                   (SELECT max(dn1.start_date)
                                                  FROM   d_nums dn1
                                                  WHERE  dn1.loco_id = dn.loco_id
                                                  AND    dn1.carried_number = "Y"
                                                  AND    dn1.start_date <= d.w_date)

        JOIN   ref_depot_codes dcc
        ON     dcc.depot_code = d.last_depot
        AND    dcc.date_from =                   (SELECT max(dcc1.date_from)
                                                  FROM   ref_depot_codes dcc1
                                                  WHERE  dcc1.depot_code = d.last_depot
                                                  AND    dcc1.date_from <= d.w_date)

        JOIN   ref_depot dp
        ON     dp.depot_id = dcc.depot_id

        JOIN   d_class_link dcl
        ON     dcl.loco_id = d.loco_id
        AND    dcl.start_date =                  (SELECT max(dcl1.start_date)
                                                  FROM   d_class_link dcl1
                                                  WHERE  dcl1.loco_id = d.loco_id
                                                  AND    dcl1.start_date <= d.w_date)

        JOIN   d_class dc
        ON     dc.d_class_id = dcl.d_class_id

        WHERE  dcc.region = "' . $region . '"
        AND    date_format(d.w_date, "%m-%Y") = "' . $search_date . '"

        UNION

        SELECT CASE WHEN ifnull(dpc1.region, "X") = "' . $region . '" THEN
                    CASE WHEN ifnull(dpc2.region, "X") = "' . $region . '" THEN
                         "INT"
                    ELSE
                         "IRO"
                    END
                    ELSE
                         "IRI"
                    END                                               AS status,
               "D"                                                    AS type,
               da2.loco_id                                            AS loco_id,
               dn.number                                              AS number,
               concat("locoqry.php?action=locodata&id=", da2.loco_id,
                      "&type=D&loco=", dn.number)                     AS number_hl,
               dn.number_type                                         AS number_type,
               da1.alloc_date                                         AS event_date1,
               concat(date_format(da2.alloc_date, "%Y%m%d"), 
                      lpad(da2.loco_id, 10, "0"))                     AS event_date1_fmt,
               coalesce(dpc1.displayed_depot_code, da1.allocation)    AS depot_code1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp1.depot_id)                                   AS depot_code1_hl,
               dp1.depot_name                                         AS depot_name1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp1.depot_id)                                   AS depot_name1_hl,
               dp1.depot_id                                           AS depot_id1,
               dpc1.region                                            AS region1,
               da2.alloc_date                                         AS event_date2,
               concat(date_format(da2.alloc_date, "%Y%m%d"), 
                      lpad(da2.loco_id, 10, "0"))                     AS event_date2_fmt,
               coalesce(dpc2.displayed_depot_code, da2.allocation)    AS depot_code2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp2.depot_id)                                   AS depot_code2_hl,
               dp2.depot_name                                         AS depot_name2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp2.depot_id)                                   AS depot_name2_hl,
               dp2.depot_id                                           AS depot_id2,
               dpc2.region                                            AS region2,
               dc.identifier                                          AS loco_class,
               concat("locoqry.php?action=class&id=", 
                      dc.d_class_id, "&type=D&page=fleet")            AS loco_class_hl

        FROM   d_alloc da2

        JOIN   ref_depot_codes dpc2
        ON     dpc2.depot_code = da2.allocation
        AND    dpc2.date_from =                  (SELECT max(dpc2a.date_from)
                                                  FROM   ref_depot_codes dpc2a
                                                  WHERE  dpc2a.depot_code = da2.allocation
                                                  AND    dpc2a.date_from <= da2.alloc_date)

        JOIN   ref_depot dp2
        ON     dp2.depot_id = dpc2.depot_id



        JOIN   d_alloc da1
        ON     da1.loco_id = da2.loco_id
        AND    concat(da1.alloc_date, da1.seq) = (SELECT max(concat(da1a.alloc_date, da1a.seq))
                                                  FROM   d_alloc da1a
                                                  WHERE  da1a.loco_id = da2.loco_id
                                                  AND    concat(da1a.alloc_date, da1a.seq) <
                                                         concat(da2.alloc_date,  da2.seq))

        JOIN   ref_depot_codes dpc1
        ON     dpc1.depot_code = da1.allocation
        AND    dpc1.date_from =                  (SELECT max(dpc1a.date_from)
                                                  FROM   ref_depot_codes dpc1a
                                                  WHERE  dpc1a.depot_code = da1.allocation
                                                  AND    dpc1a.date_from <= da1.alloc_date)

        JOIN   ref_depot dp1
        ON     dp1.depot_id = dpc1.depot_id



        JOIN   d_nums dn
        ON     dn.loco_id = da2.loco_id
        AND    dn.start_date =                   (SELECT max(dn1.start_date)
                                                  FROM   d_nums dn1
                                                  WHERE  dn1.loco_id = da2.loco_id
                                                  AND    dn1.start_date <= da2.alloc_date)
                                                 
        JOIN   d_class_link dcl
        ON     dcl.loco_id = da2.loco_id
        AND    dcl.start_date =                  (SELECT max(dcl1.start_date)
                                                  FROM   d_class_link dcl1
                                                  WHERE  dcl1.loco_id = da2.loco_id
                                                  AND    dcl1.start_date <= da2.alloc_date)

        JOIN   d_class dc
        ON     dc.d_class_id = dcl.d_class_id

        WHERE  date_format(da2.alloc_date, "%m-%Y") = "' . $search_date . '"
        AND   (dpc1.region = "' . $region . '" OR dpc2.region = "' . $region . '")';
    
     $sqle = 
       'SELECT "NEW"                                                  AS status,
               "E"                                                    AS type,
               e.loco_id                                              AS loco_id,
               en.number                                              AS number,
               concat("locoqry.php?action=locodata&id=", e.loco_id,
                      "&type=E&loco=", en.number)                     AS number_hl,
               en.number_type                                         AS number_type,
               e.b_date                                               AS event_date1,
               concat(date_format(e.b_date, "%Y%m%d"), 
                      lpad(e.loco_id, 10, "0"))                       AS event_date1_fmt,
               e.first_depot                                          AS depot_code1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_code1_hl,
               dp.depot_name                                          AS depot_name1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_name1_hl,
               dp.depot_id                                            AS depot_id1,
               dcc.region                                             AS region1,
               e.b_date                                               AS event_date2,
               concat(date_format(e.b_date, "%Y%m%d"), 
                      lpad(e.loco_id, 10, "0"))                       AS event_date2_fmt,
               e.first_depot                                          AS depot_code2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_code2_hl,
               dp.depot_name                                          AS depot_name2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_name2_hl,
               dp.depot_id                                            AS depot_id2,
               dcc.region                                             AS region2,
               ec.identifier                                          AS loco_class,
               concat("locoqry.php?action=class&id=", 
                      ec.e_class_id, "&type=E&page=fleet")            AS loco_class_hl
        FROM   electric e

        JOIN   e_nums en
        ON     en.loco_id = e.loco_id
        AND    en.first_number = "Y"

        JOIN   ref_depot_codes dcc
        ON     dcc.depot_code = e.first_depot
        AND    dcc.date_from =                   (SELECT max(dcc1.date_from)
                                                  FROM   ref_depot_codes dcc1
                                                  WHERE  dcc1.depot_code = e.first_depot
                                                  AND    dcc1.date_from <= e.b_date)

        JOIN   ref_depot dp
        ON     dp.depot_id = dcc.depot_id

        JOIN   e_class_link ecl
        ON     ecl.loco_id = e.loco_id
        AND    ecl.start_date =                  (SELECT max(ecl1.start_date)
                                                  FROM   e_class_link ecl1
                                                  WHERE  ecl1.loco_id = e.loco_id
                                                  AND    ecl1.start_date <= e.b_date)

        JOIN   e_class ec
        ON     ec.e_class_id = ecl.e_class_id

        WHERE  dcc.region = "' . $region . '"
        AND    date_format(e.b_date, "%m-%Y") = "' . $search_date . '"

        UNION

        SELECT "WDN"                                                  AS status,
               "E"                                                    AS type,
               e.loco_id                                              AS loco_id,
               en.number                                              AS number,
               concat("locoqry.php?action=locodata&id=", e.loco_id,
                      "&type=E&loco=", en.number)                     AS number_hl,
               en.number_type                                         AS number_type,
               e.w_date                                               AS event_date1,
               concat(date_format(e.w_date, "%Y%m%d"), 
                      lpad(e.loco_id, 10, "0"))                       AS event_date1_fmt,
               e.last_depot                                           AS depot_code1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_code1_hl,
               dp.depot_name                                          AS depot_name1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_name1_hl,
               dp.depot_id                                            AS depot_id1,
               dcc.region                                             AS region1,
               e.w_date                                               AS event_date2,
               concat(date_format(e.w_date, "%Y%m%d"), 
                      lpad(e.loco_id, 10, "0"))                       AS event_date2_fmt,
               e.last_depot                                           AS depot_code2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_code2_hl,
               dp.depot_name                                          AS depot_name2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_name2_hl,
               dp.depot_id                                            AS depot_id2,
               dcc.region                                             AS region2,
               ec.identifier                                          AS loco_class,
               concat("locoqry.php?action=class&id=", 
                      ec.e_class_id, "&type=E&page=fleet")            AS loco_class_hl
        FROM   electric e

        JOIN   e_nums en
        ON     en.loco_id = e.loco_id
        AND    en.start_date =                   (SELECT max(en1.start_date)
                                                  FROM   e_nums en1
                                                  WHERE  en1.loco_id = en.loco_id
                                                  AND    en1.carried_number = "Y"
                                                  AND    en1.start_date <= e.w_date)

        JOIN   ref_depot_codes dcc
        ON     dcc.depot_code = e.last_depot
        AND    dcc.date_from =                   (SELECT max(dcc1.date_from)
                                                  FROM   ref_depot_codes dcc1
                                                  WHERE  dcc1.depot_code = e.last_depot
                                                  AND    dcc1.date_from <= e.w_date)

        JOIN   ref_depot dp
        ON     dp.depot_id = dcc.depot_id

        JOIN   e_class_link ecl
        ON     ecl.loco_id = e.loco_id
        AND    ecl.start_date =                  (SELECT max(ecl1.start_date)
                                                  FROM   e_class_link ecl1
                                                  WHERE  ecl1.loco_id = e.loco_id
                                                  AND    ecl1.start_date <= e.w_date)

        JOIN   e_class ec
        ON     ec.e_class_id = ecl.e_class_id

        WHERE  dcc.region = "' . $region . '"
        AND    date_format(e.w_date, "%m-%Y") = "' . $search_date . '"

        UNION

        SELECT CASE WHEN ifnull(dpc1.region, "X") = "' . $region . '" THEN
                    CASE WHEN ifnull(dpc2.region, "X") = "' . $region . '" THEN
                         "INT"
                    ELSE
                         "IRO"
                    END
                    ELSE
                         "IRI"
                    END                                               AS status,
               "E"                                                    AS type,
               ea2.loco_id                                            AS loco_id,
               en.number                                              AS number,
               concat("locoqry.php?action=locodata&id=", ea2.loco_id,
                      "&type=E&loco=", en.number)                     AS number_hl,
               en.number_type                                         AS number_type,
               ea1.alloc_date                                         AS event_date1,
               concat(date_format(ea2.alloc_date, "%Y%m%d"), 
                      lpad(ea2.loco_id, 10, "0"))                     AS event_date1_fmt,
               coalesce(dpc1.displayed_depot_code, ea1.allocation)    AS depot_code1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp1.depot_id)                                   AS depot_code1_hl,
               dp1.depot_name                                         AS depot_name1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp1.depot_id)                                   AS depot_name1_hl,
               dp1.depot_id                                           AS depot_id1,
               dpc1.region                                            AS region1,
               ea2.alloc_date                                         AS event_date2,
               concat(date_format(ea2.alloc_date, "%Y%m%d"), 
                      lpad(ea2.loco_id, 10, "0"))                     AS event_date2_fmt,
               coalesce(dpc2.displayed_depot_code, ea2.allocation)    AS depot_code2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp2.depot_id)                                   AS depot_code2_hl,
               dp2.depot_name                                         AS depot_name2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp2.depot_id)                                   AS depot_name2_hl,
               dp2.depot_id                                           AS depot_id2,
               dpc2.region                                            AS region2,
               ec.identifier                                          AS loco_class,
               concat("locoqry.php?action=class&id=", 
                      ec.e_class_id, "&type=E&page=fleet")            AS loco_class_hl

        FROM   e_alloc ea2

        JOIN   ref_depot_codes dpc2
        ON     dpc2.depot_code = ea2.allocation
        AND    dpc2.date_from =                  (SELECT max(dpc2a.date_from)
                                                  FROM   ref_depot_codes dpc2a
                                                  WHERE  dpc2a.depot_code = ea2.allocation
                                                  AND    dpc2a.date_from <= ea2.alloc_date)

        JOIN   ref_depot dp2
        ON     dp2.depot_id = dpc2.depot_id



        JOIN   e_alloc ea1
        ON     ea1.loco_id = ea2.loco_id
        AND    concat(ea1.alloc_date, ea1.seq) = (SELECT max(concat(ea1a.alloc_date, ea1a.seq))
                                                  FROM   e_alloc ea1a
                                                  WHERE  ea1a.loco_id = ea2.loco_id
                                                  AND    concat(ea1a.alloc_date, ea1a.seq) <
                                                         concat(ea2.alloc_date,  ea2.seq))

        JOIN   ref_depot_codes dpc1
        ON     dpc1.depot_code = ea1.allocation
        AND    dpc1.date_from =                  (SELECT max(dpc1a.date_from)
                                                  FROM   ref_depot_codes dpc1a
                                                  WHERE  dpc1a.depot_code = ea1.allocation
                                                  AND    dpc1a.date_from <= ea1.alloc_date)

        JOIN   ref_depot dp1
        ON     dp1.depot_id = dpc1.depot_id



        JOIN   e_nums en
        ON     en.loco_id = ea2.loco_id
        AND    en.start_date =                   (SELECT max(en1.start_date)
                                                  FROM   e_nums en1
                                                  WHERE  en1.loco_id = ea2.loco_id
                                                  AND    en1.start_date <= ea2.alloc_date)
                                                 
        JOIN   e_class_link ecl
        ON     ecl.loco_id = ea2.loco_id
        AND    ecl.start_date =                  (SELECT max(ecl1.start_date)
                                                  FROM   e_class_link ecl1
                                                  WHERE  ecl1.loco_id = ea2.loco_id
                                                  AND    ecl1.start_date <= ea2.alloc_date)

        JOIN   e_class ec
        ON     ec.e_class_id = ecl.e_class_id

        WHERE  date_format(ea2.alloc_date, "%m-%Y") = "' . $search_date . '"
        AND   (dpc1.region = "' . $region . '" OR dpc2.region = "' . $region . '")';

     $sqls = 
       'SELECT "NEW"                                                  AS status,
               "S"                                                    AS type,
               s.loco_id                                              AS loco_id,
               sn.number                                              AS number,
               concat("locoqry.php?action=locodata&id=", s.loco_id,
                      "&type=S&loco=", sn.number)                     AS number_hl,
               sn.number_type                                         AS number_type,
               s.b_date                                               AS event_date1,
               concat(date_format(s.b_date, "%Y%m%d"), 
                      lpad(s.loco_id, 10, "0"))                       AS event_date1_fmt,
               s.first_depot                                          AS depot_code1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_code1_hl,
               dp.depot_name                                          AS depot_name1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_name1_hl,
               dp.depot_id                                            AS depot_id1,
               dcc.region                                             AS region1,
               s.b_date                                               AS event_date2,
               concat(date_format(s.b_date, "%Y%m%d"), 
                      lpad(s.loco_id, 10, "0"))                       AS event_date2_fmt,
               s.first_depot                                          AS depot_code2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_code2_hl,
               dp.depot_name                                          AS depot_name2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_name2_hl,
               dp.depot_id                                            AS depot_id2,
               dcc.region                                             AS region2,
               sc.identifier                                          AS loco_class,
               concat("locoqry.php?action=class&id=", 
                      sc.s_class_id, "&type=S&page=fleet")            AS loco_class_hl
        FROM   steam s

        JOIN   s_nums sn
        ON     sn.loco_id = s.loco_id
        AND    sn.first_number = "Y"

        JOIN   ref_depot_codes dcc
        ON     dcc.depot_code = s.first_depot
        AND    dcc.date_from =                   (SELECT max(dcc1.date_from)
                                                  FROM   ref_depot_codes dcc1
                                                  WHERE  dcc1.depot_code = s.first_depot
                                                  AND    dcc1.date_from <= s.b_date)

        JOIN   ref_depot dp
        ON     dp.depot_id = dcc.depot_id

        JOIN   s_class_link scl
        ON     scl.loco_id = s.loco_id
        AND    scl.start_date =                  (SELECT max(scl1.start_date)
                                                  FROM   s_class_link scl1
                                                  WHERE  scl1.loco_id = s.loco_id
                                                  AND    scl1.start_date <= s.b_date)

        JOIN   s_class sc
        ON     sc.s_class_id = scl.s_class_id

        WHERE  dcc.region = "' . $region . '"
        AND    date_format(s.b_date, "%m-%Y") = "' . $search_date . '"

        UNION

        SELECT "WDN"                                                  AS status,
               "S"                                                    AS type,
               s.loco_id                                              AS loco_id,
               sn.number                                              AS number,
               concat("locoqry.php?action=locodata&id=", s.loco_id,
                      "&type=S&loco=", sn.number)                     AS number_hl,
               sn.number_type                                         AS number_type,
               s.w_date                                               AS event_date1,
               concat(date_format(s.w_date, "%Y%m%d"), 
                      lpad(s.loco_id, 10, "0"))                       AS event_date1_fmt,
               s.last_depot                                           AS depot_code1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_code1_hl,
               dp.depot_name                                          AS depot_name1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_name1_hl,
               dp.depot_id                                            AS depot_id1,
               dcc.region                                             AS region1,
               s.w_date                                               AS event_date2,
               concat(date_format(s.w_date, "%Y%m%d"), 
                      lpad(s.loco_id, 10, "0"))                       AS event_date2_fmt,
               s.last_depot                                           AS depot_code2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_code2_hl,
               dp.depot_name                                          AS depot_name2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp.depot_id)                                    AS depot_name2_hl,
               dp.depot_id                                            AS depot_id2,
               dcc.region                                             AS region2,
               sc.identifier                                          AS loco_class,
               concat("locoqry.php?action=class&id=", 
                      sc.s_class_id, "&type=S&page=fleet")            AS loco_class_hl
        FROM   steam s

        JOIN   s_nums sn
        ON     sn.loco_id = s.loco_id
        AND    sn.start_date =                   (SELECT max(sn1.start_date)
                                                  FROM   s_nums sn1
                                                  WHERE  sn1.loco_id = sn.loco_id
                                                  AND    sn1.carried_number = "Y"
                                                  AND    sn1.start_date <= s.w_date)

        JOIN   ref_depot_codes dcc
        ON     dcc.depot_code = s.last_depot
        AND    dcc.date_from =                   (SELECT max(dcc1.date_from)
                                                  FROM   ref_depot_codes dcc1
                                                  WHERE  dcc1.depot_code = s.last_depot
                                                  AND    dcc1.date_from <= s.w_date)

        JOIN   ref_depot dp
        ON     dp.depot_id = dcc.depot_id

        JOIN   s_class_link scl
        ON     scl.loco_id = s.loco_id
        AND    scl.start_date =                  (SELECT max(scl1.start_date)
                                                  FROM   s_class_link scl1
                                                  WHERE  scl1.loco_id = s.loco_id
                                                  AND    scl1.start_date <= s.w_date)

        JOIN   s_class sc
        ON     sc.s_class_id = scl.s_class_id

        WHERE  dcc.region = "' . $region . '"
        AND    date_format(s.w_date, "%m-%Y") = "' . $search_date . '"

        UNION

        SELECT CASE WHEN ifnull(dpc1.region, "X") = "' . $region . '" THEN
                    CASE WHEN ifnull(dpc2.region, "X") = "' . $region . '" THEN
                         "INT"
                    ELSE
                         "IRO"
                    END
                    ELSE
                         "IRI"
                    END                                               AS status,
               "S"                                                    AS type,
               sa2.loco_id                                            AS loco_id,
               sn.number                                              AS number,
               concat("locoqry.php?action=locodata&id=", sa2.loco_id,
                      "&type=S&loco=", sn.number)                     AS number_hl,
               sn.number_type                                         AS number_type,
               sa1.alloc_date                                         AS event_date1,
               concat(date_format(sa2.alloc_date, "%Y%m%d"), 
                      lpad(sa2.loco_id, 10, "0"))                     AS event_date1_fmt,
               coalesce(dpc1.displayed_depot_code, sa1.allocation)    AS depot_code1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp1.depot_id)                                   AS depot_code1_hl,
               dp1.depot_name                                         AS depot_name1,
               concat("sites.php?page=depots&action=query&id=", 
                      dp1.depot_id)                                   AS depot_name1_hl,
               dp1.depot_id                                           AS depot_id1,
               dpc1.region                                            AS region1,
               sa2.alloc_date                                         AS event_date2,
               concat(date_format(sa2.alloc_date, "%Y%m%d"), 
                      lpad(sa2.loco_id, 10, "0"))                     AS event_date2_fmt,
               coalesce(dpc2.displayed_depot_code, sa2.allocation)    AS depot_code2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp2.depot_id)                                   AS depot_code2_hl,
               dp2.depot_name                                         AS depot_name2,
               concat("sites.php?page=depots&action=query&id=", 
                      dp2.depot_id)                                   AS depot_name2_hl,
               dp2.depot_id                                           AS depot_id2,
               dpc2.region                                            AS region2,
               sc.identifier                                          AS loco_class,
               concat("locoqry.php?action=class&id=", 
                      sc.s_class_id, "&type=S&page=fleet")            AS loco_class_hl

        FROM   s_alloc sa2

        JOIN   ref_depot_codes dpc2
        ON     dpc2.depot_code = sa2.allocation
        AND    dpc2.date_from =                  (SELECT max(dpc2a.date_from)
                                                  FROM   ref_depot_codes dpc2a
                                                  WHERE  dpc2a.depot_code = sa2.allocation
                                                  AND    dpc2a.date_from <= sa2.alloc_date)

        JOIN   ref_depot dp2
        ON     dp2.depot_id = dpc2.depot_id



        JOIN   s_alloc sa1
        ON     sa1.loco_id = sa2.loco_id
        AND    concat(sa1.alloc_date, sa1.seq) = (SELECT max(concat(sa1a.alloc_date, sa1a.seq))
                                                  FROM   s_alloc sa1a
                                                  WHERE  sa1a.loco_id = sa2.loco_id
                                                  AND    concat(sa1a.alloc_date, sa1a.seq) <
                                                         concat(sa2.alloc_date,  sa2.seq))

        JOIN   ref_depot_codes dpc1
        ON     dpc1.depot_code = sa1.allocation
        AND    dpc1.date_from =                  (SELECT max(dpc1a.date_from)
                                                  FROM   ref_depot_codes dpc1a
                                                  WHERE  dpc1a.depot_code = sa1.allocation
                                                  AND    dpc1a.date_from <= sa1.alloc_date)

        JOIN   ref_depot dp1
        ON     dp1.depot_id = dpc1.depot_id



        JOIN   s_nums sn
        ON     sn.loco_id = sa2.loco_id
        AND    sn.start_date =                   (SELECT max(sn1.start_date)
                                                  FROM   s_nums sn1
                                                  WHERE  sn1.loco_id = sa2.loco_id
                                                  AND    sn1.start_date <= sa2.alloc_date)
                                                 
        JOIN   s_class_link scl
        ON     scl.loco_id = sa2.loco_id
        AND    scl.start_date =                  (SELECT max(scl1.start_date)
                                                  FROM   s_class_link scl1
                                                  WHERE  scl1.loco_id = sa2.loco_id
                                                  AND    scl1.start_date <= sa2.alloc_date)

        JOIN   s_class sc
        ON     sc.s_class_id = scl.s_class_id

        WHERE  date_format(sa2.alloc_date, "%m-%Y") = "' . $search_date . '"
        AND   (dpc1.region = "' . $region . '" OR dpc2.region = "' . $region . '")';

    if (!empty($sqld))
      $sql = $sqld;

    if (!empty($sqle))
      if (!empty($sql))
        $sql .= " UNION " . $sqle;
      else
        $sql = $sqle;

    if (!empty($sqls))
      if (!empty($sql))
        $sql .= " UNION " . $sqls;
      else
        $sql = $sqls;

    if (!empty($sql))
      $sql .= " ORDER BY event_date2_fmt, loco_id";

    $caption = "Regional snapshot (" . $region . ") for " . $caps . " (";

    if (!empty($sqld) && !empty($sqle) && !empty($sqls))
      $caption .= "All Locomotives)";
    else
    {
      if (!empty($sqls) && !empty($sqle))
        $caption .= "Steam &amp; Electric)";
      else
      if (!empty($sqls) && !empty($sqld))
        $caption .= "Steam &amp; Diesel)";
      else
      if (!empty($sqls))
        $caption .= "Steam)";
      else
      if (!empty($sqld) && !empty($sqle))
        $caption .= "Diesel &amp; Electric)";
      else
      if (!empty($sqld))
        $caption .= "Diesel)";
      else
      if (!empty($sqle))
        $caption .= "Electric)";
    }

    $tb->add_caption($caption);

    /* Select all inter regional allocations to/from this region this month */
    /* Select depot code changes in the region */
    /* Select depot closures in the region */

    //echo $sql;

    $db = fn_connectdb();
    $result = $db->execute($sql);

    if ($db->count_select())
    {
    while ($row = mysqli_fetch_assoc($result))
    {
      if ($row['type'] == "D" && $row['number_type'] == "PRT")
        $row['number'] = fn_d_pfx($row['number']);
      else
      if ($row['type'] == "E" && $row['number_type'] == "PRT")
        $row['number'] = fn_e_pfx($row['number']);

      $row['event_date1'] = fn_fdate($row['event_date1']);
      $row['event_date2'] = fn_fdate($row['event_date2']);

      if ($row['status'] == "INT") // Internal transfer
      {
        $row['status'] = "Internal transfer: to " . 
                     "<a href=\"sites.php?page=depots&action=query&id=" . $row['depot_id2'] . "\">" .
             $row['depot_code2'] . "</a> - " . 
                     "<a href=\"sites.php?page=depots&action=query&id=" . $row['depot_id2'] . "\">" .
             $row['depot_name2'] . "</a>";
    $row['allocation1'] = $row['depot_code1'];
    $row['allocation1_hl'] = $row['depot_code1_hl'];
    $row['depot1'] = $row['depot_name1'];
    $row['depot1_hl'] = $row['depot_name1_hl'];
    $row['region'] = $row['region1'];
      }
      else
      if ($row['status'] == "IRO") // Inter-regional transfer out
      {
        $row['status'] = "Inter-Regional transfer out: to " . 
                     "<a href=\"sites.php?page=depots&action=query&id=" . $row['depot_id2'] . "\">" .
             $row['depot_code2'] . "</a> - " . 
                     "<a href=\"sites.php?page=depots&action=query&id=" . $row['depot_id2'] . "\">" .
             $row['depot_name2'] . "</a> (" . $row['region2'] . ")";
    $row['allocation1'] = $row['depot_code1'];
    $row['allocation1_hl'] = $row['depot_code1_hl'];
    $row['depot1'] = $row['depot_name1'];
    $row['depot1_hl'] = $row['depot_name1_hl'];
    $row['region'] = $row['region1'];
      }
      else
      if ($row['status'] == "IRI") // Inter-regional transfer in
      {
        $row['status'] = "Inter-Regional transfer in: to " . 
                     "<a href=\"sites.php?page=depots&action=query&id=" . $row['depot_id2'] . "\">" .
             $row['depot_code2'] . "</a> - " . 
                     "<a href=\"sites.php?page=depots&action=query&id=" . $row['depot_id2'] . "\">" .
             $row['depot_name2'] . "</a> (" . $row['region2'] . ")";
    $row['allocation1'] = $row['depot_code1'];
    $row['allocation1_hl'] = $row['depot_code1_hl'];
    $row['depot1'] = $row['depot_name1'];
    $row['depot1_hl'] = $row['depot_name1_hl'];
    $row['region'] = $row['region1'];
      }
      else
      if ($row['status'] == "WDN") // Withdrawn
      {
        $row['status'] = "<strong><font color=\"red\">Condemned</font></strong>";
    $row['allocation1'] = $row['depot_code1'];
    $row['allocation1_hl'] = $row['depot_code1_hl'];
    $row['depot1'] = $row['depot_name1'];
    $row['depot1_hl'] = $row['depot_name1_hl'];
    $row['region'] = $row['region1'];
      }
      else
      if ($row['status'] == "NEW") // New build
      {
        $row['status'] = "<strong><font color=\"green\">New locomotive</font></strong>";
    $row['allocation1'] = $row['depot_code1'];
    $row['allocation1_hl'] = $row['depot_code1_hl'];
    $row['depot1'] = $row['depot_name1'];
    $row['depot1_hl'] = $row['depot_name1_hl'];
    $row['region'] = $row['region1'];
      }


      $tb->add_data($row);
    }

    $tb->draw_table();
    $row = "";
    $result = "";
    }
  }
  else
  if ($pg == "locos"    && $formsubmitted)
  {
    printf("<div class='featurebox_center'>\n");

    include_once "lib/quickdb.class.php";
    include_once "lib/brlib.php";
    include_once "lib/MyTables.class.php";

    $tb = new MyTables("snapshot");

    $tb->sortable();
    $tb->colour_coordinate("Y");
    $tb->add_column("depot_name",     "Depot",       15);
    $tb->add_column("allocation",     "Code",         5);
    $tb->add_column("region",         "Region",       5);
    $tb->add_column("locos",          "Locomotives", 75);

    if ($mval != "00")
    {
      if ($mval == "01")
        $caps = "January " . $yval;
      else
      if ($mval == "02")
        $caps = "February " . $yval;
      else
      if ($mval == "03")
        $caps = "March " . $yval;
      else
      if ($mval == "04")
        $caps = "April " . $yval;
      else
      if ($mval == "05")
        $caps = "May " . $yval;
      else
      if ($mval == "06")
        $caps = "June " . $yval;
      else
      if ($mval == "07")
        $caps = "July " . $yval;
      else
      if ($mval == "08")
        $caps = "August " . $yval;
      else
      if ($mval == "09")
        $caps = "September " . $yval;
      else
      if ($mval == "10")
        $caps = "October " . $yval;
      else
      if ($mval == "11")
        $caps = "November " . $yval;
      else
      if ($mval == "12")
        $caps = "December " . $yval;
    }
    else
      $caps = $yval;

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

    $caption .= "Allocations for " . $caps;
    $tb->add_caption($caption);

    $db = fn_connectdb();

    $sql = "";

    if ($gotd)
    {
      $sql = 'SELECT "Diesel"              AS type,
                     d.loco_id             AS lid,
                     dn.number             AS number,
                     concat("locoqry.php?action=locodata&amp;id=", d.loco_id,
                            "&amp;type=D&amp;loco=", dn.number) AS number_hl,
                     dn.number_type        AS number_type,
                     coalesce(dpc2.displayed_depot_code, dpc2.depot_code)       
                                           AS allocation,
                     concat("sites.php?page=depots&amp;action=query&amp;id=", dep.depot_id)
                                           AS allocation_hl,
                     dep.depot_name        AS depot_name,
                     concat("sites.php?page=depots&amp;action=query&amp;id=", dep.depot_id)
                                           AS depot_name_hl,
                     concat(dc.identifier, " ", dc.wheel_arrangement)
                                           AS identifier,
                     concat("locoqry.php?action=class&amp;id=", dc.d_class_id, "&amp;type=D")
                                           AS identifier_hl,
                     dep_cd.region,
                     dc.d_class_id         AS class_id

              FROM   diesels d

              JOIN   d_nums dn
              ON     dn.loco_id = d.loco_id
              AND    dn.start_date = (SELECT max(dn1.start_date)
                                      FROM   d_nums dn1
                                      WHERE  dn1.loco_id = d.loco_id
                                      AND    dn1.start_date <= "' . $srchdate . '"
                                      AND    dn1.carried_number = "Y")

              JOIN   d_alloc da
              ON     da.loco_id = d.loco_id

              JOIN   ref_depot_codes dep_cd
              ON     dep_cd.depot_code = da.allocation
              AND    dep_cd.date_from  = (SELECT max(dep_cd1.date_from)
                                          FROM   ref_depot_codes dep_cd1
                                          WHERE  dep_cd1.depot_code = dep_cd.depot_code
                                          AND    dep_cd1.date_from <= da.alloc_date)
              ' . $regionclause . '

              JOIN   ref_depot dep
              ON     dep.depot_id = dep_cd.depot_id

              JOIN   ref_depot_codes dpc2
              ON     dpc2.depot_id = dep.depot_id
              AND    dpc2.date_from = (SELECT max(dpc2a.date_from)
                                       FROM   ref_depot_codes dpc2a
                                       WHERE  dpc2a.depot_id = dep.depot_id
                                       AND    dpc2a.date_from <= "' . $srchdate . '")

              JOIN   d_class_link dcl
              ON     dcl.loco_id = d.loco_id
              AND    dcl.start_date = (SELECT max(dcl1.start_date)
                                       FROM   d_class_link dcl1
                                       WHERE  dcl1.loco_id = d.loco_id
                                       AND    dcl1.start_date <= "' . $srchdate . '")

              JOIN   d_class dc
              ON     dc.d_class_id = dcl.d_class_id

              WHERE  concat(da.alloc_date, da.seq) = (SELECT max(concat(da1.alloc_date, da1.seq))
                                      FROM   d_alloc da1
                                      WHERE  da1.loco_id = da.loco_id
                                      AND    da1.allocation NOT LIKE "91%"
                                      AND    da1.alloc_date <= "' . $srchdate . '")

              AND    da.allocation NOT LIKE "91%"
              AND    d.b_date <= "' . $srchdate . '"
              AND    d.w_date >= "' . $srchdate . '"';
    }

    if ($gote)
    {
      if (!empty($sql))
        $sql .= " UNION ";

      $sql .= 'SELECT "Electric"             AS type,
                       e.loco_id             AS lid,
                       en.number             AS number,
                       concat("locoqry.php?action=locodata&amp;id=", e.loco_id,
                              "&amp;type=E&amp;loco=", en.number) AS number_hl,
                       en.number_type        AS number_type,
                       coalesce(dpc2.displayed_depot_code, dpc2.depot_code)       
                                             AS allocation,
                       concat("sites.php?page=depots&amp;action=query&amp;id=", dep.depot_id)
                                             AS allocation_hl,
                       dep.depot_name        AS depot_name,
                       concat("sites.php?page=depots&amp;action=query&amp;id=", dep.depot_id)
                                             AS depot_name_hl,
                       concat(ec.identifier, " ", ec.wheel_arrangement) 
                                             AS identifier,
                       concat("locoqry.php?action=class&amp;id=", ec.e_class_id, "&amp;type=E")
                                             AS identifier_hl,
                       dep_cd.region,
                       ec.e_class_id         AS class_id

                FROM   electric e

                JOIN   e_nums en
                ON     en.loco_id = e.loco_id
                AND    en.start_date = (SELECT max(en1.start_date)
                                        FROM   e_nums en1
                                        WHERE  en1.loco_id = e.loco_id
                                        AND    en1.start_date <= "' . $srchdate . '"
                                        AND    en1.carried_number = "Y")

                JOIN   e_alloc ea
                ON     ea.loco_id = e.loco_id

                JOIN   ref_depot_codes dep_cd
                ON     dep_cd.depot_code = ea.allocation
                AND    dep_cd.date_from  = (SELECT max(dep_cd1.date_from)
                                            FROM   ref_depot_codes dep_cd1
                                            WHERE  dep_cd1.depot_code = dep_cd.depot_code
                                            AND    dep_cd1.date_from <= ea.alloc_date)
                ' . $regionclause . '

                JOIN   ref_depot dep
                ON     dep.depot_id = dep_cd.depot_id

                JOIN   ref_depot_codes dpc2
                ON     dpc2.depot_id = dep.depot_id
                AND    dpc2.date_from = (SELECT max(dpc2a.date_from)
                                         FROM   ref_depot_codes dpc2a
                                         WHERE  dpc2a.depot_id = dep.depot_id
                                         AND    dpc2a.date_from <= "' . $srchdate . '")

                JOIN   e_class_link ecl
                ON     ecl.loco_id = e.loco_id
                AND    ecl.start_date = (SELECT max(ecl1.start_date)
                                         FROM   e_class_link ecl1
                                         WHERE  ecl1.loco_id = e.loco_id
                                         AND    ecl1.start_date <= "' . $srchdate . '")

                JOIN   e_class ec
                ON     ec.e_class_id = ecl.e_class_id

                WHERE  ea.alloc_date = (SELECT max(ea1.alloc_date)
                                        FROM   e_alloc ea1
                                        WHERE  ea1.loco_id = e.loco_id
                                        AND    ea1.alloc_date <= "' . $srchdate . '")


                AND    e.b_date <= "' . $srchdate . '"
                AND    e.w_date >= "' . $srchdate . '"';
    }

    if ($gots)
    {
      if (!empty($sql))
        $sql .= " UNION ";


        $sql .= 'SELECT "Steam"               AS type,
                        s.loco_id             AS lid,
                        sn.number             AS number,
                        concat("locoqry.php?action=locodata&amp;id=", s.loco_id,
                                "&amp;type=S&amp;loco=", sn.number) AS number_hl,
                        sn.number_type        AS number_type,
                        coalesce(dpc2.displayed_depot_code, dpc2.depot_code)       
                                              AS allocation,
                        concat("sites.php?page=depots&amp;action=query&amp;id=", dep.depot_id)
                                              AS allocation_hl,
                        dep.depot_name        AS depot_name,
                        concat("sites.php?page=depots&amp;action=query&amp;id=", dep.depot_id)
                                              AS depot_name_hl,
                        concat(sc.identifier, " ", sc.wheel_arrangement) 
                                              AS identifier,
                        concat("locoqry.php?action=class&amp;id=", sc.s_class_id, "&amp;type=S")
                                              AS identifier_hl,
                        dep_cd.region,
                        sc.s_class_id         AS class_id

                 FROM   steam s

                 JOIN   s_nums sn
                 ON     sn.loco_id = s.loco_id
                 AND    sn.start_date = (SELECT max(sn1.start_date)
                                         FROM   s_nums sn1
                                         WHERE  sn1.loco_id = s.loco_id
                                         AND    sn1.start_date <= "' . $srchdate . '"
                                         AND    sn1.carried_number = "Y")

                 JOIN   s_alloc sa
                 ON     sa.loco_id = s.loco_id
                 AND    sa.alloc_date = (SELECT max(sa1.alloc_date)
                                         FROM   s_alloc sa1
                                         WHERE  sa1.loco_id = s.loco_id
                                         AND    sa1.alloc_date <= "' . $srchdate . '")

                 JOIN   ref_depot_codes dep_cd
                 ON     dep_cd.depot_code = sa.allocation
                 AND    dep_cd.date_from  = (SELECT max(dep_cd1.date_from)
                                             FROM   ref_depot_codes dep_cd1
                                             WHERE  dep_cd1.depot_code = dep_cd.depot_code
                                             AND    dep_cd1.date_from <= sa.alloc_date)
                 ' . $regionclause . '

                 JOIN   ref_depot dep
                 ON     dep.depot_id = dep_cd.depot_id

                 JOIN   ref_depot_codes dpc2
                 ON     dpc2.depot_id = dep.depot_id
                 AND    dpc2.date_from = (SELECT max(dpc2a.date_from)
                                          FROM   ref_depot_codes dpc2a
                                          WHERE  dpc2a.depot_id = dep.depot_id
                                          AND    dpc2a.date_from <= "' . $srchdate . '")

                 JOIN   s_class_link scl
                 ON     scl.loco_id = s.loco_id
                 AND    scl.start_date = (SELECT max(scl1.start_date)
                                          FROM   s_class_link scl1
                                          WHERE  scl1.loco_id = s.loco_id
                                          AND    scl1.start_date <= "' . $srchdate . '")

                 JOIN   s_class sc
                 ON     sc.s_class_id = scl.s_class_id

                 WHERE  s.loco_id > 0 
                 AND    "' . $srchdate . '" BETWEEN s.b_date AND s.w_date';
    }

    if ($gotd || $gote || $gots)
    {
      $sql .= ' ORDER BY depot_name,
                         type,
                         class_id,
                         lid';
    }

    // echo $sql;

    $result = $db->execute($sql);

    $lastdepot = ""; $lastclass = "";

    while ($row = mysqli_fetch_assoc($result))
    {
      if ($row['type'] == "Steam")
        $bgcolour = "#F2F5A9";
      else
      if ($row['type'] == "Diesel")
        $bgcolour = "#F6E3CE";
      else
      if ($row['type'] == "Electric")
        $bgcolour = "#58FAF4";

      if (strcmp($row['depot_name'], $lastdepot) == 0)
        $same_depot = 1;
      else
        $same_depot = 0;

      if (strcmp($row['identifier'], $lastclass) == 0)
      {
        if ($same_depot == 1) // force to be new class if change of depot
          $same_class = 1;
        else
          $same_class = 0;
      }
      else
        $same_class = 0;

      if (empty($lastclass))
        $first_class = 1;
      else
        $first_class = 0;

      // Got the flags, now work out the logic!!!

      if ($row['number_type'] == "PRT")
        if ($row['type'] == "Electric")
          $row['number'] = fn_e_pfx($row['number']);
        else
          $row['number'] = fn_d_pfx($row['number']);

      $row['number'] = "<a href='" . $row['number_hl'] . "'>" . $row['number'] . "</a>";
                           

      if ($same_depot == 1)
      {
        // Build on what we've already got
        if ($same_class == 1)
        {
          // already got one of these, so add on to the end of the string of locos
          $locolist .= ", " . $row['number'];
        }
        else
        {
          $locolist .= "</td></tr><tr bgcolor=\"" . $bgcolour . "\"><td><a href=\"" . 
                        $row['identifier_hl'] . "\">Class " . 
                        $row['identifier'] . "</a></td><td>" . $row['number'];
        }
      }
      else
      {
        // dump data if not first record
        if (!empty($lastdepot))
        {
          $locolist .= "</td></tr></table>";
          $rowx['locos']         = $locolist;
          $rowx['class']         = $lastclass;
          $rowx['depot_name']    = $lastdepot;
          $rowx['depot_name_hl'] = $lastdepot_hl;

          $rowx['region']        = $lastregion;
          $rowx['allocation']    = $lastcode;
          $rowx['allocation_hl'] = $lastcode_hl;

          $tb->add_data($rowx);
        }

        $locolist  = "<table width=\"99%\"><tr bgcolor=\"" . $bgcolour . 
                     "\"><td width=\"20%\"><a href=\"" . $row['identifier_hl'] . "\">Class " . 
                     $row['identifier'] . "</a></td>";
        $locolist .= "<td>" . $row['number'];
      }

      $lastcode      = $row['allocation'];
      $lastcode_hl   = $row['allocation_hl'];
      $lastdepot     = $row['depot_name'];
      $lastdepot_hl  = $row['depot_name_hl'];
      $lastregion    = $row['region'];
      $lastclass     = $row['identifier'];
      $lastclass_hl  = $row['identifier_hl'];
    }

    $tb->draw_table(); $tb = NULL;
    $db->close();

    $rowx = $row = NULL;

    printf("</div>  <!-- featurebox_center -->\n");
  }

  if ($pg == "locos")
  {
?>
    <div class='featurebox_center'>

    <p>This page will let you take a snapshot of locomotives and their allocations in a
    given month between January 1948 and December 1997.</p>

    <p>Select a month/year to display a list of all allocations for that period:</p>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=locos">
     <fieldset id="nb">
     <table width="75%" frame="box" border="0" cellpadding="1">
       <tr>
         <td width="8%" align="right">Date:</td>
         <td width="25%">

         <select size="1" name="mon_select">
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

         <td width="12%">

         <select size="1" name="year_select">
<?php
         for ($nx = 1948; $nx <= 1997; $nx++)
         {
           if ($nx == 1948)
             printf("<option value=\"%d\" selected=\"selected\">%d</option>\n", $nx, $nx);
           else
             printf("<option value=\"%d\">%d</option>\n", $nx, $nx);
         }
?>
         </select>

         </td>

         <td width="25%" valign="middle">
           <input type="checkbox" name="locotype[]" value="S" checked="checked" />&nbsp; Steam<br />
           <input type="checkbox" name="locotype[]" value="D" checked="checked" />&nbsp; Diesel<br />
           <input type="checkbox" name="locotype[]" value="E" checked="checked" />&nbsp; Electric<br />
         </td>

         <td width="25%" valign="middle">
           <input type="checkbox" name="region[]" value="ER"  checked="checked" />&nbsp; Eastern<br />
           <input type="checkbox" name="region[]" value="LMR" checked="checked" />&nbsp; London Midland<br />
           <input type="checkbox" name="region[]" value="SR"  checked="checked" />&nbsp; Southern<br />
           <input type="checkbox" name="region[]" value="SCR" checked="checked" />&nbsp; Scottish<br />
           <input type="checkbox" name="region[]" value="WR"  checked="checked" />&nbsp; Western<br />
         </td>

       </tr>
     </table>
     <br />
     <input type="submit" value="Submit" />&nbsp;&nbsp;
     <input type="reset" />
     </fieldset>
    </form>

    <br />
    <p>PLEASE NOTE: this is a complex query and is likely to take about one minute to run!</p>
  </div>  <!-- featurebox_center -->

<?php
  }
  else
  if ($pg == "regional")
  {
?>
    <div class='featurebox_center'>

    <p>This page will give you a snapshot of activity on a region in a
    given month between January 1948 and December 1997.</p>

    <p>Select a month/year to display a list of activity for that period:</p>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=regional">
     <fieldset id="nb">
     <table width="75%" frame="box" border="0" cellpadding="1">
       <tr>
         <td width="8%" align="right">Date:</td>
         <td width="25%">

         <select size="1" name="mon_select">
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

         <td width="12%">

         <select size="1" name="year_select">
<?php
         for ($nx = 1948; $nx <= 1997; $nx++)
         {
           if ($nx == 1948)
             printf("<option value=\"%d\" selected=\"selected\">%d</option>\n", $nx, $nx);
           else
             printf("<option value=\"%d\">%d</option>\n", $nx, $nx);
         }
?>
         </select>

         </td>

         <td width="25%" valign="middle">
           <input type="checkbox" name="locotype[]" value="S" checked="checked" />&nbsp; Steam<br />
           <input type="checkbox" name="locotype[]" value="D" checked="checked" />&nbsp; Diesel<br />
           <input type="checkbox" name="locotype[]" value="E" checked="checked" />&nbsp; Electric<br />
         </td>

         <td width="25%" valign="middle">
           <select size="1" name="region_sel">
             <option value="ER">Eastern Region</option>
             <option value="LMR">London Midland Region</option>
             <option value="SCR">Scottish Region</option>
             <option value="SR">Southern Region</option>
             <option value="WR">Western Region</option>
           </select>
         </td>
       </tr>
     </table>
     <br />
     <input type="submit" value="Submit" />&nbsp;&nbsp;
     <input type="reset" />
     </fieldset>
    </form>

    <br />
    <p>PLEASE NOTE: this is a complex query and is likely to take about one minute to run!</p>
  </div>  <!-- featurebox_center -->
<?php
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

