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
<title>Locomotive Withdrawals | Steam Withdrawal Dates | Diesel Withdrawal Dates | Electric Withdrawal Dates
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

<h3>Withdrawal Report</h3>

<div class="featurebox_center">

<?php
  require_once "lib/quickdb.class.php";
  require_once "lib/MyTables.class.php";
  require_once "lib/brlib.php";
  
  fn_check_country($_SERVER['REMOTE_ADDR']);

  $db = fn_connectdb();

$tb      = new MyTables("wdn");
$tb_summ = new MyTables("wdn_summary", 65);
?>

<?php if (isset($_POST['year_select_start'])):


  // 5 possible parameters
  //   mon_select_start   <$mvals>   - month start 01-12
  //   mon_select_end     <$mvale>   - month end 01-12 or '-'
  //   year_select_start  <$yvals>   - year start (4 digits)
  //   year_select_end    <$yvale>   - year end (4 digits or '-')
  //   locotype           <$type>    - array of loco types (D, S etc...)
  
  $mvals = $mvale = $yvals = $yvale = $type = "";

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
      fn_poem($key, $value, 99);
  }
  
  {
    if (($yvale == $yvals) && ($mvale == $mvals))
    {
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
  $sql = $sql_d = $sql_e = $sql_s = "";
  
  for ($nc = 0; $nc < count($type); $nc++)
  {
    switch ($type[$nc][0])
    {
      case 'S':
        $gots = 1;
        $sql_s = 'SELECT "S"                  AS type,
                         s.loco_id            AS lid,
                         sa.alloc_date        AS alloc_date,
                         sa.alloc_flag,
                         s.w_date     AS wdate,
                         s.b_date     AS bdate,
                         s.s_date      AS cdate,
                         concat(date_format(s.w_date, "%Y%m%d"), lpad(s.loco_id, 7, "0"))
                                              AS wdate_fmt,
                         concat(date_format(s.b_date, "%Y%m%d"), lpad(s.loco_id, 7, "0"))
                                              AS bdate_fmt,
                         concat(date_format(s.s_date,  "%Y%m%d"), lpad(s.loco_id, 7, "0"))
                                              AS cdate_fmt,
                         concat(sm.merchant_name, " (", scr.location, ")")     AS sc_name,
                         concat("sites.php?page=scrapyards&id=",  scr.scrapyard_code) 
                                                                               AS scrapyard_hl,
                         dp.depot_name        AS last_depot,
                         dpc.depot_code       AS last_depot_cd,
                         sn.number            AS number,
                         sn.number_type,
                         concat("locoqry.php?action=locodata&id=",s.loco_id,"&type=S&loco=",
                                sn.number)    AS number_hl,
                         sc.identifier        AS loco_class,
                         concat(lpad(sc.identifier, 6, "      "), 
                                date_format(s.w_date, "%Y%m%d"),
                                lpad(s.loco_id, 7, "0")) AS loco_class_fmt,
		                     concat("locoqry.php?action=class&type=S&id=",
                              sc.s_class_id)  AS loco_class_hl,
                         sc.wheel_arrangement AS wheel_arr,
                         concat("misc.php?page=wheelarr&id=", 
                                sc.wheel_arrangement) AS wheel_arr_hl,
                         concat(sc.wheel_arrangement, lpad(s.loco_id, 7, "0")) AS wheel_arr_fmt,
                         NULL                 AS service_prd,
                         concat("S",              lpad(s.loco_id, 7, "0")) AS type_fmt,
                         concat(sm.merchant_name, " (", scr.location, ")") AS scrapyard_fmt,
                         concat(dp.depot_name,    lpad(s.loco_id, 7, "0")) AS last_depot_fmt,
                         concat(dpc.depot_code,   lpad(s.loco_id, 7, "0")) AS last_depot_cd_fmt,
                         concat(lpad(sn.number, 7, "0"),  
                                lpad(s.loco_id, 7, "0")) AS number_fmt,
                         round(datediff(s.w_date, s.b_date) / 365, 2)  
                                                          AS service_prd1,
                         round(datediff(sa.alloc_date,    s.b_date) / 365, 2)  
                                                          AS service_prd2,
                         Coalesce(sc.big4_company, sc.prg_company)         AS final_cmp

                   FROM  steam s
                   LEFT JOIN  s_nums sn
                   ON    sn.loco_id = s.loco_id
                   AND   sn.start_date = (SELECT max(sn1.start_date)
                                          FROM   s_nums sn1
                                          WHERE  sn1.loco_id = s.loco_id
                                          AND    sn1.carried_number = "Y")

                   LEFT JOIN ref_depot_codes dpc
                   ON    dpc.depot_code = s.last_depot
                   AND   dpc.date_from = (SELECT max(dpc2.date_from)
                                          FROM   ref_depot_codes dpc2
                                          WHERE  dpc2.depot_code = s.last_depot
                                          AND    dpc2.date_from  <= s.w_date)

                   LEFT JOIN ref_depot dp
                   ON    dp.depot_id = dpc.depot_id

                   JOIN  s_class_link scl
                   ON    scl.loco_id = s.loco_id
                   AND   scl.start_date = (SELECT max(scl2.start_date)
                                           FROM   s_class_link scl2
                                           WHERE  scl2.loco_id = s.loco_id
                                           AND    scl2.start_date <= s.w_date)

                   LEFT JOIN s_alloc sa
                   ON    sa.loco_id = s.loco_id
                   AND   sa.allocation = "98W"
                   AND   date_format(sa.alloc_date, 
                                     "' . $formats . '") BETWEEN "' . $datevals . '"
                                                             AND "' . $datevale . '"
                   JOIN  s_class sc
                   ON    sc.s_class_id = scl.s_class_id

                   LEFT JOIN ref_scrapyard scr
                   ON    scr.scrapyard_code = s.scrapyard_code

                   LEFT JOIN ref_scrap_merchant sm
                   ON    sm.merchant_code = substr(scr.scrapyard_code, 1, 3)

                   WHERE date_format(s.w_date, 
                                     "' . $formats . '") BETWEEN "' . $datevals . '"
                                                             AND "' . $datevale . '"
                      OR date_format(sa.alloc_date, 
                                     "' . $formats . '") BETWEEN "' . $datevals . '"
                                                             AND "' . $datevale . '"';
// echo $sql_s;

        if ($sql != "")
          $sql .= " UNION " . $sql_s;
        else
          $sql = $sql_s;

        $sql_s = 'SELECT "Steam"                  AS type,
                         sc.s_class_id,
                         ifnull(sc.common_name, sc.identifier)     AS identifier,
                         p.surname                                 AS part1,
                         concat("people.php?page=cme&id=", p.p_id) AS part1_hl,
                         sc.wheel_arrangement,
                         concat("misc.php?page=wheelarr&id=", 
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
                  AND    scl.start_date = (SELECT max(scl2.start_date)
                                           FROM   s_class_link scl2
                                           WHERE  scl2.loco_id = s.loco_id
                                           AND    scl2.start_date <= s.w_date)

                  JOIN   s_class sc
                  ON     sc.s_class_id = scl.s_class_id
                  LEFT JOIN ref_people p
                  ON     sc.designer_id = p.p_id
                  WHERE date_format(s.w_date, 
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
        $sql_d = 'SELECT "D"                  AS type,
                         d.loco_id            AS lid,
                         da.alloc_date        AS alloc_date,
                         da.alloc_flag,
                         d.w_date     AS wdate,
                         d.b_date     AS bdate,
                         d.s_date      AS cdate,
                         concat(date_format(d.w_date, "%Y%m%d"), lpad(d.loco_id, 7, "0"))
                                              AS wdate_fmt,
                         concat(date_format(d.b_date, "%Y%m%d"), lpad(d.loco_id, 7, "0"))
                                              AS bdate_fmt,
                         concat(date_format(d.s_date,  "%Y%m%d"), lpad(d.loco_id, 7, "0"))
                                              AS cdate_fmt,
                         concat(sm.merchant_name, " (", scr.location, ")")     AS sc_name,
                         concat("sites.php?page=scrapyards&id=",  scr.scrapyard_code) 
                                                                               AS scrapyard_hl,
                         dp.depot_name        AS last_depot,
                         dpc.depot_code       AS last_depot_cd,
                         dn.number            AS number,
                         dn.number_type,
                         concat("locoqry.php?action=locodata&id=",d.loco_id,"&type=D&loco=",
                                dn.number)    AS number_hl,
                         dc.identifier        AS loco_class,
                         concat(dc.identifier, "/", d.w_date, "/", d.loco_id) AS loco_class_fmt,
		                     concat("locoqry.php?action=class&type=D&id=",
                              dc.d_class_id)  AS loco_class_hl,
                         dc.wheel_arrangement AS wheel_arr,
                         concat("misc.php?page=wheelarr&id=", 
                                dc.wheel_arrangement) AS wheel_arr_hl,
                         concat(dc.wheel_arrangement, d.loco_id) AS wheel_arr_fmt,
                         NULL                 AS service_prd,
                         concat("D",              d.loco_id) AS type_fmt,
                         concat(sm.merchant_name, " (", scr.location, ")")     AS scrapyard_fmt,
                         concat(dp.depot_name,    d.loco_id) AS last_depot_fmt,
                         concat(dpc.depot_code,   d.loco_id) AS last_depot_cd_fmt,
                         concat(lpad(dn.number, 10, "0"),  
                                lpad(d.loco_id, 10, "0")) AS number_fmt,
                         round(datediff(d.w_date, d.b_date) / 365, 2)  
                                                          AS service_prd1,
                         round(datediff(da.alloc_date,    d.b_date) / 365, 2)  
                                                          AS service_prd2,
                         NULL                             AS final_cmp

                   FROM  diesels d

                   JOIN  d_nums dn
                   ON    dn.loco_id = d.loco_id
                   AND   d.w_date BETWEEN        dn.start_date
                                          AND     ifnull(dn.end_date,   "2999-01-01")
                   LEFT JOIN ref_depot_codes dpc
                   ON    dpc.depot_code = d.last_depot
                   AND   d.w_date BETWEEN        dpc.date_from
                                          AND     ifnull(dpc.date_to,   "2999-01-01")
                   LEFT JOIN ref_depot dp
                   ON    dp.depot_id = dpc.depot_id

                   JOIN  d_class_link dcl
                   ON    dcl.loco_id = d.loco_id
                   AND   dcl.start_date = (SELECT max(dcl1.start_date)
                                           FROM   d_class_link dcl1
                                           WHERE  dcl1.loco_id = dcl.loco_id
                                           AND    dcl1.start_date <= d.w_date)
                   LEFT JOIN d_alloc da
                   ON    da.loco_id = d.loco_id
                   AND   da.allocation = "98W"
                   AND   date_format(da.alloc_date, 
                                     "' . $formats . '") BETWEEN "' . $datevals . '"
                                                             AND "' . $datevale . '"
                   JOIN  d_class dc
                   ON    dc.d_class_id = dcl.d_class_id

                   LEFT JOIN ref_scrapyard scr
                   ON    scr.scrapyard_code = d.scrapyard_code

                   LEFT JOIN ref_scrap_merchant sm
                   ON    sm.merchant_code = substr(scr.scrapyard_code, 1, 3)

                   WHERE date_format(d.w_date, 
                                     "' . $formats . '") BETWEEN "' . $datevals . '"
                                                             AND "' . $datevale . '"
                      OR date_format(da.alloc_date, 
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
                         concat("misc.php?page=wheelarr&id=", 
                                dc.wheel_arrangement)              AS wheel_arrangement_hl,
                         NULL                                      AS prg,
                         NULL                                      AS prg_hl,
                         NULL                                      AS big4,
                         NULL                                      AS big4_hl,
                         count(*)                                  AS ct
                  FROM   diesels d
                  JOIN   d_class_link dcl
                  ON     dcl.loco_id = d.loco_id
                  AND    dcl.start_date = (SELECT max(dcl1.start_date)
                                           FROM   d_class_link dcl1
                                           WHERE  dcl1.loco_id = dcl.loco_id
                                           AND    dcl1.start_date <= d.w_date)
                  JOIN   d_class dc
                  ON     dc.d_class_id = dcl.d_class_id

                  WHERE date_format(d.w_date, 
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
        $sql_e = 'SELECT "E"                  AS type,
                         e.loco_id            AS lid,
                         ea.alloc_date        AS alloc_date,
                         ea.alloc_flag,
                         e.w_date     AS wdate,
                         e.b_date     AS bdate,
                         e.s_date      AS cdate,
                         concat(date_format(e.w_date, "%Y%m%d"), lpad(e.loco_id, 7, "0"))
                                              AS wdate_fmt,
                         concat(date_format(e.b_date, "%Y%m%d"), lpad(e.loco_id, 7, "0"))
                                              AS bdate_fmt,
                         concat(date_format(e.s_date,  "%Y%m%d"), lpad(e.loco_id, 7, "0"))
                                              AS cdate_fmt,
                         concat(sm.merchant_name, " (", scr.location, ")")     AS sc_name,
                         concat("sites.php?page=scrapyards&id=",  scr.scrapyard_code) 
                                                                               AS scrapyard_hl,
                         dp.depot_name        AS last_depot,
                         dpc.depot_code       AS last_depot_cd,
                         en.number            AS number,
                         en.number_type,
                         concat("locoqry.php?action=locodata&id=",e.loco_id,"&type=E&loco=",
                                en.number)    AS number_hl,
                         ec.identifier        AS loco_class,
                         concat(ec.identifier, "/", e.w_date, "/", e.loco_id) AS loco_class_fmt,
		                     concat("locoqry.php?action=class&type=E&id=",
                              ec.e_class_id)  AS loco_class_hl,
                         ec.wheel_arrangement AS wheel_arr,
                         concat("misc.php?page=wheelarr&id=", 
                                ec.wheel_arrangement) AS wheel_arr_hl,
                         concat(ec.wheel_arrangement, e.loco_id) AS wheel_arr_fmt,
                         NULL                 AS service_prd,
                         concat("E",              e.loco_id) AS type_fmt,
                         concat(sm.merchant_name, " (", scr.location, ")")     AS scrapyard_fmt,
                         concat(dp.depot_name,    e.loco_id) AS last_depot_fmt,
                         concat(dpc.depot_code,   e.loco_id) AS last_depot_cd_fmt,
                         concat(lpad(en.number, 10, "0"),  
                                lpad(e.loco_id, 10, "0")) AS number_fmt,
                         round(datediff(e.w_date, e.b_date) / 365, 2)  
                                                          AS service_prd1,
                         round(datediff(ea.alloc_date,    e.b_date) / 365, 2)  
                                                          AS service_prd2,
                         NULL         AS final_cmp

                   FROM  electric e
                   JOIN  e_nums en
                   ON    en.loco_id = e.loco_id
                   AND   e.w_date BETWEEN ifnull(en.start_date, "1800-01-01")
                                          AND     ifnull(en.end_date,   "2999-01-01")
                   LEFT JOIN ref_depot_codes dpc
                   ON    dpc.depot_code = e.last_depot
                   AND   e.w_date BETWEEN dpc.date_from
                                          AND     ifnull(dpc.date_to,   "2999-01-01")
                   LEFT JOIN ref_depot dp
                   ON    dp.depot_id = dpc.depot_id

                   JOIN  e_class_link ecl
                   ON    ecl.loco_id = e.loco_id
                   AND   ecl.start_date = (SELECT max(ecl1.start_date)
                                           FROM   e_class_link ecl1
                                           WHERE  ecl1.loco_id = ecl.loco_id
                                           AND    ecl1.start_date <= e.w_date)

                   LEFT JOIN e_alloc ea
                   ON    ea.loco_id = e.loco_id
                   AND   ea.allocation = "98W"
                   AND   date_format(ea.alloc_date, 
                                     "' . $formats . '") BETWEEN "' . $datevals . '"
                                                             AND "' . $datevale . '"
                   JOIN  e_class ec
                   ON    ec.e_class_id = ecl.e_class_id

                   LEFT JOIN ref_scrapyard scr
                   ON    scr.scrapyard_code = e.scrapyard_code

                   LEFT JOIN ref_scrap_merchant sm
                   ON    sm.merchant_code = substr(scr.scrapyard_code, 1, 3)

                   WHERE date_format(e.w_date, 
                                     "' . $formats . '") BETWEEN "' . $datevals . '"
                                                             AND "' . $datevale . '"
                      OR date_format(ea.alloc_date, 
                                     "' . $formats . '") BETWEEN "' . $datevals . '"
                                                             AND "' . $datevale . '"';

        if ($sql != "")
          $sql .= " UNION " . $sql_e;
        else
          $sql = $sql_e;

        $sql_e = 'SELECT "Electric"                AS type,
                         ec.e_class_id,
                         ifnull(ec.common_name, ec.identifier)     AS identifier,
                         NULL                                      AS part1,
                         NULL                                      AS part1_hl,
                         ec.wheel_arrangement,
                         concat("misc.php?page=wheelarr&id=", 
                                ec.wheel_arrangement)              AS wheel_arrangement_hl,
                         NULL                                      AS prg,
                         NULL                                      AS prg_hl,
                         NULL                                      AS big4,
                         NULL                                      AS big4_hl,
                         count(*)                                  AS ct
                  FROM   electric e
                  JOIN   e_class_link ecl
                  ON     ecl.loco_id = e.loco_id
                  AND    ecl.start_date = (SELECT max(ecl1.start_date)
                                           FROM   e_class_link ecl1
                                           WHERE  ecl1.loco_id = ecl.loco_id
                                           AND    ecl1.start_date <= e.w_date)
                  JOIN   e_class ec
                  ON     ec.e_class_id = ecl.e_class_id

                  WHERE  date_format(e.w_date, 
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

// echo $sql;

  if ($sql)
    $sql .= " ORDER BY CAST(number AS unsigned)";

//  echo $sql . "<br />";

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
      $caption = "Steam & Electric ";
    else
    if ($gots && $gotd)
      $caption = "Steam & Diesel ";
    else
    if ($gots)
      $caption = "Steam ";
    else
    if ($gotd && $gote)
      $caption = "Diesel & Electric ";
    else
    if ($gotd)
      $caption = "Diesel ";
    else
    if ($gote)
      $caption = "Electric ";
  }

  if (!empty($cape) && $cape != $caps)
    $caption .= "locomotives withdrawn between " . $caps . " and " . $cape;
  else
    $caption .= "locomotives withdrawn during " . $caps;

  $tb->sortable();
  $tb->allow_rollover();
  $tb->colour_coordinate("Y");
 
  $tb->add_caption($caption);
  $tb->add_column("ltype",           "Type",               5);
  $tb->add_column("final_cmp",       "Company",            5);
  $tb->add_column("loco_class",      "Class",              5);
  $tb->add_column("wheel_arr",       "Wheels",             5);
  $tb->add_column("number",          "Loco Number",        7);
  $tb->add_column("bdate",           "Build Date",         9);
  $tb->add_column("last_depot_cd",   "Code",               5);
  $tb->add_column("last_depot",      "Last Depot",        12);
  $tb->add_column("wdate",           "Withdrawn",          9);
  $tb->add_column("notes",           "Note",              12);
  $tb->add_column("service_prd",     "Period in Service",  5);
  $tb->add_column("scrapyard",       "Scrapyard",         12);
  $tb->add_column("cdate",           "Disposal Date",      9);


  $result = $db->execute($sql);

  $tot = $db->count_select();

  if ($result)
  {
    while ($row = mysqli_fetch_array($result))
    {
      $row['notes'] = "";

      if ($row['type'] == "S")
      {
        $row['ltype'] = "Steam";
      }
      else
      if ($row['type'] == "D")
      {
        $row['ltype'] = "Diesel";

        if (strcmp($row['number_type'], "PRT") == 0)
          $row['number'] = fn_d_pfx($row['number']);
      }
      else
      if ($row['type'] == "E")
      {
        $row['ltype'] = "Electric";

        if (strcmp($row['number_type'], "PRT") == 0)
          $row['number'] = fn_e_pfx($row['number']);
      }

      $row['bdate'] = fn_fdate($row['bdate']);
      $row['cdate'] = fn_fdate($row['cdate']);

      if ($row['alloc_flag'] == 'v')
      {
        $row['service_prd'] = $row['service_prd2'] . "*";
        $row['notes'] = "*Reinstated<br />Wdn " . fn_fdate($row['wdate']);
        $row['wdate'] = fn_fdate($row['alloc_date']);
        $row['wdate'] .= "*";
      }
      else
      {
        $row['wdate'] = fn_fdate($row['wdate']);
        $row['service_prd'] = $row['service_prd1'];
        $row['notes'] = "";
      }

      //$tb->add_data($row);
      $tb->dump_data($row);
    }
  }

  if ($tot == 1)
    printf("<h4>1 match</h4><br />\n");
  else
    printf("<h4>%d matches</h4><br />\n", $tot);

  echo "<h5><a href=\"#locos\">View Locomotives</a></h5><br />";
  echo "<h5><a href=\"#summary\">View Summary</a></h5><br />";

  echo "<a name=\"locos\"></a>";


  if ($db->count_select())
    $tb->dump_data(NULL);

  echo "<a name=\"summary\"></a>";
  /* Now for the summary */

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
    while ($row = mysqli_fetch_array($result))
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
  }

  if ($db->count_select())
  {
    echo "<BR />";
    $tb_summ->dump_data(NULL);
  }

endif; ?>


  <p>Select a month/year to display a list of all locomotives withdrawn for that period:<p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"">
   <fieldset "nb">
   <table width="96%" frame=box border=0 cellpadding=1>
     <tr>
       <td width=4% align=right>Start:</td>
       <td width=10%>

       <SELECT size="1" name="mon_select_start">
         <OPTION selected value="00">*</OPTION>
         <OPTION value="01">January</OPTION>
         <OPTION value="02">February</OPTION>
         <OPTION value="03">March</OPTION>
         <OPTION value="04">April</OPTION>
         <OPTION value="05">May</OPTION>
         <OPTION value="06">June</OPTION>
         <OPTION value="07">July</OPTION>
         <OPTION value="08">August</OPTION>
         <OPTION value="09">September</OPTION>
         <OPTION value="10">October</OPTION>
         <OPTION value="11">November</OPTION>
         <OPTION value="12">December</OPTION>
       </SELECT>

       </td>

       <td width=4%>

       <SELECT size="1" name="year_select_start">
<?php
       for ($nx = 1875; $nx <= 1997; $nx++)
       {
         if ($nx == 1948)
	         printf("<OPTION value=\"%d\" SELECTED>%d</OPTION>\n", $nx, $nx);
         else
	         printf("<OPTION value=\"%d\">%d</OPTION>\n", $nx, $nx);
       }
?>
       </SELECT>

       </td>

       <td width=4% align=right>End:</td>
       <td width=10%>

       <SELECT size="1" name="mon_select_end">
         <OPTION selected value="00">*</OPTION>
         <OPTION value="01">January</OPTION>
         <OPTION value="02">February</OPTION>
         <OPTION value="03">March</OPTION>
         <OPTION value="04">April</OPTION>
         <OPTION value="05">May</OPTION>
         <OPTION value="06">June</OPTION>
         <OPTION value="07">July</OPTION>
         <OPTION value="08">August</OPTION>
         <OPTION value="09">September</OPTION>
         <OPTION value="10">October</OPTION>
         <OPTION value="11">November</OPTION>
         <OPTION value="12">December</OPTION>
       </SELECT>

       </td>

       <td width=10%>

       <SELECT size="1" name="year_select_end">
<?php
       for ($nx = 1875; $nx <= 1997; $nx++)
       {
         if ($nx == 1875)
	         printf("<OPTION value=\"-\" SELECTED>-</OPTION>\n");

	       printf("<OPTION value=\"%d\">%d</OPTION>\n", $nx, $nx);
       }
?>
       </SELECT>

       </td>

       <td width=14% valign=center>
       <input type="checkbox" name="locotype[]" value="S" checked=true/>&nbsp; Steam<br />
       <input type="checkbox" name="locotype[]" value="D" checked=true/>&nbsp; Diesel<br />
       <input type="checkbox" name="locotype[]" value="E" checked=true/>&nbsp; Electric<br />
       </td>
       <td width=24% valign=top>&nbsp;
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

