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
<title>On this Day snapshot | Locomotive snapshot</title>

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

<h3>On This Day ...</h3>

<div class='featurebox_center'>
<?php

  $today = getdate();

  $date_db_fmt = sprintf("%4s-%02s-%02s", $today['year'], $today['mon'], $today['mday']);

  $ftoday = $today['month'] . " the " . $today['mday'];
  $dt = sprintf("%02s-%02s", $today['mon'], $today['mday']);

  if ($today['mday'] == "1" ||
      $today['mday'] == "21" ||
      $today['mday'] == "31")
    $sfx = "st";
  else
  if ($today['mday'] == "2" ||
      $today['mday'] == "22")
    $sfx = "nd";
  else
  if ($today['mday'] == "3" ||
      $today['mday'] == "23")
    $sfx = "rd";
  else
    $sfx = "th";

  printf("<h2>Events that occured on this day, %s%s</h2>\n", $ftoday, $sfx);

  require_once "lib/quickdb.class.php";
  require_once "lib/MyTables.class.php";
  require_once "lib/brlib.php";

  $db = fn_connectdb();
  $tb = new MyTables("otd_new");

  $tb->sortable();

  printf("<table width=99%% style=\"frame: box;\" cellspacing=\"0\" cellpadding=\"0\">\n");
  printf("<tr>\n");
  printf("<td>\n");
  {
    $tb->add_caption("Locomotives to Service");

    $sql = 'select "S"                   AS type,
                   s.loco_id             AS loco_id,
                   sn.number             AS number,
                   concat("locoqry.php?action=locodata&id=",
                           s.loco_id,"&type=S&loco=",sn.number) 
                                         AS number_hl,
                   date_format(s.b_date, "%Y") 
                                         AS date_new,
                   COALESCE(dcs.displayed_depot_code, s.first_depot) AS first_depot,
                   dep.depot_name,
                   concat(scv.class_type, " (", sc.wheel_arrangement, ")")        AS class,
                   NULL                  AS designer,
                   IF(sc.prg_company IS NOT NULL, sc.prg_company, IF(sc.big4_company IS NOT NULL, sc.big4_company, IF(sc.br_standard = "N", "UNK", "BR")))
                                         AS company
            from   steam s
            join   s_nums sn
            on     sn.loco_id = s.loco_id
            and    sn.first_number = "Y"
            join   s_class_link scl
            on     scl.loco_id = s.loco_id
            and    scl.first_class_flag = "Y"
            join   s_class sc
            on     sc.s_class_id = scl.s_class_id
            join   s_class_var scv
            on     scv.s_class_var_id = scl.s_class_var_id
            and    scv.s_class_id = sc.s_class_id

            join   ref_depot_codes dcs
            on     dcs.depot_code =  s.first_depot
            and    dcs.date_from =  (SELECT max(dcs1.date_from)
                            FROM   ref_depot_codes dcs1
                            WHERE  dcs1.depot_code = dcs.depot_code
                            AND    dcs1.date_from <= s.b_date)
            LEFT JOIN ref_depot dep
            ON     dep.depot_id = dcs.depot_id
            
            where  date_format(  s.b_date, "%m-%d" ) = "' .$dt. '" 
            and    s.b_date_prd = "E"
            
            union all
            select "D"         type,
                    d.loco_id            loco_id,
                    IF(dn.number_type = "PRT", concat("D", dn.number), dn.number)         number,
                    concat("locoqry.php?action=locodata&id=",
                            d.loco_id,"&type=D&loco=",dn.number) AS number_hl,
                    date_format(d.b_date, "%Y") date_new,
                    COALESCE(dcs.displayed_depot_code, d.first_depot) AS first_depot,
                    dep.depot_name,
                    concat(dcv.identifier, " (", dc.wheel_arrangement, ")")        AS class,
                    NULL      AS designer,
                    NULL      AS company
            from   diesels d
            join   d_nums dn
            on     dn.loco_id = d.loco_id
            and    dn.first_number = "Y"
            join   d_class_link dcl
            on     dcl.loco_id = d.loco_id
            and    dcl.first_class_flag = "Y"
            join   d_class dc
            on     dc.d_class_id = dcl.d_class_id
            join   d_class_var dcv
            on     dcv.d_class_var_id = dcl.d_class_var_id
            and    dcv.d_class_id = dc.d_class_id

            join   ref_depot_codes dcs
            on     dcs.depot_code =  d.first_depot
            and    dcs.date_from =  (SELECT max(dcs1.date_from)
                            FROM   ref_depot_codes dcs1
                            WHERE  dcs1.depot_code = dcs.depot_code
                            AND    dcs1.date_from <= d.b_date)
            LEFT JOIN ref_depot dep
            ON     dep.depot_id = dcs.depot_id

            where  date_format(  d.b_date, "%m-%d" ) = "' .$dt. '" 
            and    d.b_date_prd = "E"

            union all
            
            select "E"         type,
            e.loco_id            loco_id,
            IF(en.number_type = "PRT", concat("E", en.number), en.number) number,
            CONCAT("locoqry.php?action=locodata&id=",
                    e.loco_id,"&type=E&loco=",en.number) AS number_hl,
            DATE_FORMAT(e.b_date, "%Y") date_new,
            COALESCE(dcs.displayed_depot_code, e.first_depot) AS first_depot,
            dep.depot_name,
            CONCAT(ecv.identifier, " (", ec.wheel_arrangement, ")") AS class,
            NULL      AS designer,
            NULL      AS company
            
            from   electric e
            join   e_nums en
            on     en.loco_id = e.loco_id
            and    en.first_number = "Y"
            join   e_class_link ecl
            on     ecl.loco_id = e.loco_id
            and    ecl.first_class_flag = "Y"
            join   e_class ec
            on     ec.e_class_id = ecl.e_class_id
            join   e_class_var ecv
            on     ecv.e_class_var_id = ecl.e_class_var_id
            and    ecv.e_class_id = ec.e_class_id
            left join e_alloc ea
            on     ea.loco_id = e.loco_id
            and    ea.alloc_date = e.b_date

            join   ref_depot_codes dcs
            on     dcs.depot_code =  e.first_depot
            and    dcs.date_from =  (SELECT max(dcs1.date_from)
                            FROM   ref_depot_codes dcs1
                            WHERE  dcs1.depot_code = dcs.depot_code
                            AND    dcs1.date_from <= e.b_date)
            LEFT JOIN ref_depot dep
            ON     dep.depot_id = dcs.depot_id

            where  date_format(  e.b_date, "%m-%d" ) = "' .$dt. '" 
            and    e.b_date_prd = "E"
            
            order by date_new, number';

  $tb->add_column("number", "Number", 8);
  $tb->add_column("date_new", "Year", 6);
  $tb->add_column("company", "Company", 8);
  $tb->add_column("class",   "Class", 12);
  $tb->add_column("first_depot", "Depot", 7);
  $tb->add_column("depot_name", "Depot Name", 20);
  $tb->add_column("designer", "Design", 10);
  $tb->add_column("info", "Information", 28);
  $tb->colour_coordinate("Y");

  $result = $db->execute($sql);

  while ($row = mysqli_fetch_assoc($result))
  {
    if ($row['date_new'] >= "1948" AND $row['company'] != "BR" AND $row['company'] != "")
      $row['company'] .= "/BR";
    $tb->add_data($row);
  }

  $tb->draw_table();
}
  printf("</td>\n");
  printf("</tr>\n");
  printf("</table>\n");
  printf("<br />\n");
  
  printf("<table width=99%% style=\"frame: box;\" cellspacing=\"0\" cellpadding=\"0\">\n");
  printf("<tr>\n");
  printf("<td>\n");
  $tb->flush("otd_wdn");
{
    $tb->add_caption("Locomotives Withdrawn");

    $sql = 'select "S"                  type,
                   s.loco_id            loco_id,
                   sn.number            number,
                   concat("locoqry.php?action=locodata&id=",
                              s.loco_id,"&type=S&loco=",sn.number) AS number_hl,
                   date_format(s.w_date, "%Y") AS date_wdn,
                   date_format(s.b_date, "%Y") AS date_new,
                   COALESCE(dpc1.displayed_depot_code, s.last_depot)              AS last_depot,
                   dp1.depot_name,
                   concat(scv.class_type, " (", sc.wheel_arrangement, ")")        AS class,
                   NULL             AS  designer,
                   IF(sc.prg_company IS NOT NULL, sc.prg_company, IF(sc.big4_company IS NOT NULL, sc.big4_company, IF(sc.br_standard = "N", "UNK", "BR")))
                                         AS company
            from   steam s

            join   s_nums sn
            on     sn.loco_id = s.loco_id
            and    sn.start_date =  (SELECT max(sn1.start_date)
                            FROM   s_nums sn1
                            WHERE  sn1.loco_id = sn.loco_id
                            AND    sn1.start_date <= s.w_date)
                            
            join   s_class_link scl
            on     scl.loco_id = s.loco_id
            and    scl.start_date = (SELECT max(scl1.start_date)
                            FROM   s_class_link scl1
                            WHERE  scl1.loco_id = scl.loco_id
                            AND    scl1.start_date <= s.w_date)

            join   s_class sc
            on     sc.s_class_id = scl.s_class_id
            
            join   s_class_var scv
            on     scv.s_class_var_id = scl.s_class_var_id
            and    scv.s_class_id = sc.s_class_id
            
            LEFT JOIN ref_depot_codes dpc1
            ON     dpc1.depot_code = s.last_depot
            AND    dpc1.date_from = (SELECT max(dpc1a.date_from)
                            FROM   ref_depot_codes dpc1a
                            WHERE  dpc1a.depot_code = s.last_depot
                            AND    dpc1a.date_from <= s.w_date)

            LEFT JOIN ref_depot dp1
            ON     dp1.depot_id = dpc1.depot_id

            where  date_format(  s.w_date, "%m-%d" ) = "' .$dt. '" 
            AND    s.w_date_prd = "E"
            
            union all
            select "D"                                                           AS type,
                   d.loco_id                                                     AS loco_id,
                   IF(dn.number_type = "PRT", concat("D", dn.number), dn.number) AS number,
                   concat("locoqry.php?action=locodata&id=",
                              d.loco_id,"&type=D&loco=",dn.number)               AS number_hl,
                   date_format(d.w_date, "%Y")                                   AS date_wdn,
                   date_format(d.b_date, "%Y")                                   AS date_new,
                   COALESCE(dpc1.displayed_depot_code, d.last_depot)             AS last_depot,
                   dp1.depot_name                                                AS depot_name,
                   concat(dcv.identifier, " (", dc.wheel_arrangement, ")")       AS class,
                   NULL                                                          AS  designer,
                   NULL                                                          AS company
            from   diesels d
                   
            join   d_nums dn
            on     dn.loco_id = d.loco_id
            and    dn.start_date =  (SELECT max(dn1.start_date)
                            FROM   d_nums dn1
                            WHERE  dn1.loco_id = dn.loco_id
                            AND    dn1.start_date <= d.w_date)
                            
            join   d_class_link dcl
            on     dcl.loco_id = d.loco_id
            and    dcl.start_date = (SELECT max(dcl1.start_date)
                            FROM   d_class_link dcl1
                            WHERE  dcl1.loco_id = dcl.loco_id
                            AND    dcl1.start_date <= d.w_date)

            join   d_class dc
            on     dc.d_class_id = dcl.d_class_id
            
            join   d_class_var dcv
            on     dcv.d_class_var_id = dcl.d_class_var_id
            and    dcv.d_class_id = dc.d_class_id
            
            LEFT JOIN ref_depot_codes dpc1
            ON     dpc1.depot_code = d.last_depot
            AND    dpc1.date_from = (SELECT max(dpc1a.date_from)
                            FROM   ref_depot_codes dpc1a
                            WHERE  dpc1a.depot_code = d.last_depot
                            AND    dpc1a.date_from <= d.w_date)

            LEFT JOIN ref_depot dp1
            ON     dp1.depot_id = dpc1.depot_id

            where  date_format(  d.w_date, "%m-%d" ) = "' .$dt. '" 
            AND    d.w_date_prd = "E"

            union all
            select "E"                                                           AS type,
                   e.loco_id                                                     AS loco_id,
                   IF(en.number_type = "PRT", concat("E", en.number), en.number) AS number,
                   concat("locoqry.php?action=locodata&id=",
                              e.loco_id,"&type=E&loco=",en.number)               AS number_hl,
                   date_format(e.w_date, "%Y")                                   AS date_wdn,
                   date_format(e.b_date, "%Y")                                   AS date_new,
                   COALESCE(dpc1.displayed_depot_code, e.last_depot)              AS last_depot,
                   dp1.depot_name,
                   concat(ecv.identifier, " (", ec.wheel_arrangement, ")")       AS class,
                   NULL                                                          AS designer,
                   NULL                                                          AS company

            from   electric e
            join   e_nums en
            on     en.loco_id = e.loco_id
            and    en.start_date =  (SELECT max(en1.start_date)
                            FROM   e_nums en1
                            WHERE  en1.loco_id = en.loco_id
                            AND    en1.start_date <= e.w_date)
                            
            join   e_class_link ecl
            on     ecl.loco_id = e.loco_id
            and    ecl.start_date = (SELECT max(ecl1.start_date)
                            FROM   e_class_link ecl1
                            WHERE  ecl1.loco_id = ecl.loco_id
                            AND    ecl1.start_date <= e.w_date)

            join   e_class ec
            on     ec.e_class_id = ecl.e_class_id
            
            join   e_class_var ecv
            on     ecv.e_class_var_id = ecl.e_class_var_id
            and    ecv.e_class_id = ec.e_class_id
            
            LEFT JOIN ref_depot_codes dpc1
            ON     dpc1.depot_code = e.last_depot
            AND    dpc1.date_from = (SELECT max(dpc1a.date_from)
                            FROM   ref_depot_codes dpc1a
                            WHERE  dpc1a.depot_code = e.last_depot
                            AND    dpc1a.date_from <= e.w_date)

            LEFT JOIN ref_depot dp1
            ON     dp1.depot_id = dpc1.depot_id

            where  date_format(  e.w_date, "%m-%d" ) = "' .$dt. '" 
            AND    e.w_date_prd = "E"

            order by date_wdn, number';

  $tb->add_column("number", "Number", 8);
  $tb->add_column("date_wdn", "Year", 6);
  $tb->add_column("company", "Company", 8);
  $tb->add_column("class",   "Class", 12);
  $tb->add_column("last_depot", "Depot", 7);
  $tb->add_column("depot_name", "Depot Name", 20);
  $tb->add_column("designer", "Design", 10);
  $tb->add_column("info", "Information", 28);
  $tb->colour_coordinate("Y");

  $result = $db->execute($sql);

  while ($row = mysqli_fetch_assoc($result))
  {
    if ($row['date_new'] >= "1948" AND $row['company'] != "BR" AND $row['company'] != "")
      $row['company'] .= "/BR";
    $tb->add_data($row);
  }

  $tb->draw_table();
}
    printf("</td>\n");

  printf("</tr>\n");
  printf("<tr>\n");
    printf("<td width=100%%><strong>Accidents</strong></td>\n");
  printf("</tr>\n");
  printf("<tr>\n");
    printf("<td width=100%%><strong>Depots</strong></td>\n");
  printf("</tr>\n");
  printf("<tr>\n");
    printf("<td width=100%%><strong>Railway Events</strong></td>\n");
  printf("</tr>\n");
  printf("<tr>\n");
    $tb->flush("otd_work");
    printf("<td>\n");
{
    $tb->add_caption("Workings");

    $sql = 'select "S"               type,
                   s.loco_id         loco_id,
                   sn.number         number,
                       concat("locoqry.php?action=locodata&id=",
                       s.loco_id,"&type=S&loco=",sn.number) AS number_hl,
                   i.details         i_details,
                       i.reporting_number,
                       date_format(i.sdate_of_incident, "%Y") AS date_inc
            from   steam s
            join   s_to_i si
            on     si.loco_id = s.loco_id
            join   incidents i
            on     i.inc_id = si.inc_id
            join   s_nums sn
            on     sn.loco_id = s.loco_id
            and    sn.start_date = (SELECT max(sn1.start_date)
                                    FROM   s_nums sn1
                                    WHERE  sn1.loco_id = sn.loco_id
                                    AND    sn1.start_date <= i.sdate_of_incident)
            WHERE  date_format(i.sdate_of_incident, "%m-%d") = "' .$dt. '"
            UNION ALL
            select "D"                                                             AS type,
                   d.loco_id                                                       AS loco_id,
                       IF (dn.number_type = "PRT", concat("D", dn.number), dn.number)  AS number,
                       concat("locoqry.php?action=locodata&id=",
                              d.loco_id,"&type=D&loco=",dn.number)                     AS number_hl,
                   i.details                                                       AS i_details,
                       i.reporting_number,
                       date_format(i.sdate_of_incident, "%Y")                          AS date_inc
            from   diesels d
            join   d_to_i di
            on     di.loco_id = d.loco_id
            join   incidents i
            on     i.inc_id = di.inc_id
            join   d_nums dn
            on     dn.loco_id = d.loco_id
            and    dn.start_date = (SELECT max(dn1.start_date)
                                    FROm   d_nums dn1
                                    WHERE  dn1.loco_id = dn.loco_id
                                    AND    dn1.start_date <= i.sdate_of_incident)
            and    i.sdate_of_incident between 
                     IFNULL(dn.start_date, d.b_date) and IFNULL(dn.end_date,   d.w_date)
            where  date_format(i.sdate_of_incident, "%m-%d") = "' .$dt. '"
              UNION ALL
              select "E"                                                             AS type,
                   e.loco_id                                                       AS loco_id,
                       IF(en.number_type = "PRT", concat("E", en.number), en.number)   AS number,
                       concat("locoqry.php?action=locodata&id=",
                              e.loco_id, "&type=E&loco=", en.number)                   AS number_hl,
                       i.details                                                       AS i_details,
                       i.reporting_number,
                       date_format(i.sdate_of_incident, "%Y")                          AS date_inc
            from   electric e
            join   e_to_i ei
            on     ei.loco_id = e.loco_id
            join   incidents i
            on     i.inc_id = ei.inc_id
            join   e_nums en
            on     en.loco_id = e.loco_id
            and    en.start_date = (SELECT max(en1.start_date)
                                    FROm   e_nums en1
                                    WHERE  en1.loco_id = en.loco_id
                                    AND    en1.start_date <= i.sdate_of_incident)
            where  date_format(i.sdate_of_incident, "%m-%d") = "' .$dt. '"
              order by date_inc, number';

  $tb->add_column("date_inc", "Year", 5);
  $tb->add_column("number", "Number", 10);
  $tb->add_column("reporting_number", "Train", 7);
  $tb->add_column("i_details", "Details", 78);
  $tb->colour_coordinate("Y");

  $result = $db->execute($sql);

  if ($db->count_select() == 0)
  {
    printf("No Workings for this date\n");
  }
  else
  {
    while ($row = mysqli_fetch_assoc($result))
    {
      $tb->add_data($row);
    }

    $tb->draw_table();
  }
}
    printf("</td>\n");

  printf("</tr>\n");
  printf("</table>\n");

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

