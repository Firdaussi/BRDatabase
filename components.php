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
<title>Power Units | Traction Motors | Stones Boilers | Transmission | Diesel Electric | Diesel Hydraulic
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

<h3>Locomotive Components</h3>

<div class='featurebox_center'>

<?php

  require_once "lib/quickdb.class.php";
  require_once "lib/brlib.php";
  require_once "lib/MyTables.class.php";

  // 4 possible parameters
  //   comp      <$comp>    - component type, e.g. boiler
  //   id        <$id>      - tender or boiler id
  
  $comp = $id = "";

  foreach ($_GET as $key => $value)
  {
    if ($key == "comp")
    {
      $comp = $value;
      if (!empty($comp))
        fn_check_alpha($comp, 12);
    }
    else
    if ($key == "id")
    {
      $id = $value;
      if (!empty($id))
        fn_check_id($id, 99999);
    }
    else
    if ($key == "fbclid")
    {
    }
    else
      fn_poem($key, $value, 99);
  }
  
  if (strlen($comp) == 0)
    fn_mandatory_field("component type (comp) is a mandatory field");
  else
  {
    $db = fn_connectdb();

    if (strcmp($comp, "boiler") == 0)
    {
      $tb1 = new MyTables("boiler_facts");
      $tb2 = new MyTables("boiler_history");

      if (!empty($id)) // specific boiler details
      {
        $sql = 'SELECT s2b.loco_id,
                       s2b.start_date,
                       sn.number,
                       concat("locoqry.php?action=locodata&id=", sn.loco_id,
                       "&type=S&loco=", sn.number)             AS number_hl,
                       coalesce(sc.common_name, sc.identifier) AS identifier,
                       snm.name
                FROM   s_to_boiler s2b
                JOIN   s_nums sn
                ON     sn.loco_id = s2b.loco_id
                AND    sn.start_date = (select max(sn1.start_date)
                                        from   s_nums sn1
                                        where  sn1.loco_id = s2b.loco_id
                                        and    sn1.carried_number = "Y"
                                        and    sn1.start_date <= s2b.start_date)
                JOIN   s_class_link scl
                ON     scl.loco_id = s2b.loco_id
                AND    scl.start_date = (select max(scl1.start_date)
                                         from   s_class_link scl1
                                         where  scl1.loco_id = s2b.loco_id
                                         and    scl1.start_date <= s2b.start_date)
                JOIN   s_class sc
                ON     sc.s_class_id = scl.s_class_id
                LEFT JOIN s_name snm
                ON     snm.loco_id = sn.loco_id
                AND    snm.start_date = (select max(snm1.start_date)
                                         from   s_name snm1
                                         where  snm1.loco_id = s2b.loco_id
                                         and    snm1.start_date <= s2b.start_date)
                WHERE  s2b.s_boiler_id = ' . $id .'
                ORDER BY s2b.start_date ASC';

        // echo $sql;

        $result = $db->execute($sql);

        $tb2->add_caption("Boiler History"   , NULL);
        $tb2->add_column("identifier",       "Class",                10);
        $tb2->add_column("number",           "Loco Number",           8);
        $tb2->add_column("name",             "Name",                 32);
        $tb2->add_column("start_date",       "Date Fitted",          14);

        while ($row = mysqli_fetch_assoc($result))
        {
          $row['start_date'] = fn_fdate($row['start_date']);
          $tb2->add_data($row);
        }

        $sql = 'SELECT bt.*,
                       sbn.boiler_number,
                       sb.earliest_usage_date
                FROM   s_boiler sb

                JOIN   ref_boiler_type bt
                ON     sb.boiler_type_id = bt.boiler_type_id

                JOIN   s_boiler_nums sbn
                ON     sbn.s_boiler_id = sb.s_boiler_id

                WHERE  sb.s_boiler_id = ' . $id . '
                ORDER BY sbn.start_date ASC';

        // echo $sql;
        $result = $db->execute($sql);

        $ct = 0;
        while ($row = mysqli_fetch_assoc($result))
        {
          $row['earliest_usage_date'] = fn_fdate($row['earliest_usage_date']);

          if ($ct > 0)
            $cap .= "/" . $row['boiler_number'];
          else
          {
            $cap = "Boiler #" . $row['boiler_number'];
            $tb1->add_data($row);
          }

          $ct ++;
        }

        $tb1->add_caption($cap, NULL);
        $tb1->suppress_nulls();
        $tb1->set_align("V");
        $tb1->add_row_lwidth(35); /* percentage of width of table for first column */
        $tb1->add_row("prg_company",       "Pre Grouping Company");
        $tb1->add_row("big4_company",      "Big Four Company");
        $tb1->add_row("firebox_group",     "GWR Boiler Group");
        $tb1->add_row("gwr_standard",      "GWR Standard Boiler");
        $tb1->add_row("boiler_diagram_no", "Diagram");
        $tb1->add_row("firebox_type",      "Firebox Type");
        $tb1->add_row("extra_info",        "Notes");

        printf("<table width=\"98%%\" frame=\"box\">\n");
          printf("<tr valign=\"top\">\n");
            printf("<td width=\"50%%\">\n");
              $tb1->draw_table();
            printf("</td>\n");
            printf("<td width=\"50%%\">\n");
             $tb2->draw_table();
            printf("</td>\n");
          printf("</tr>\n");
        printf("</table>\n");
      }
      else
      {
        $sql = "SELECT *
                FROM   ref_boiler_type
                ORDER BY big4_company, boiler_diagram_no";

        $result = $db->execute($sql);

        $tb_all = new MyTables("boiler_list");
        $tb_all->sortable();
        $tb_all->add_caption("Boiler Types",   NULL);
        $tb_all->add_column("prg_company",           "Pre-Grouping",           4);
        $tb_all->add_column("big4_company",          "Big Four",               4);
        $tb_all->add_column("boiler_diagram_no",     "Diagram",                4);
        $tb_all->add_column("firebox",               "Firebox",                7);
        $tb_all->add_column("barrel",                "Barrel Dimensions",      7);
        $tb_all->add_column("barrel_heating",        "Barrel Heating",         7);
        $tb_all->add_column("superheater",           "Superheater",            7);
        $tb_all->add_column("superheater",           "Superheater",            7);

        if ($db->count_select())
        {
          while ($row = mysqli_fetch_assoc($result))
          {
            $row['firebox'] = "";
            if (!empty($row['firebox_type']))
              $row['firebox'] = $row['firebox_type'];
            if (!empty($row['hs_firebox_area']))
              $row['firebox'] .= (empty($row['firebox']) ? " " : ", ") . fn_area_i($row['hs_firebox_area']);
            if (!empty($row['grate_area']))
              $row['firebox'] .= (empty($row['firebox']) ? " " : ", grate: ") . fn_area_i($row['grate_area']);

            $row['barrel'] = "";
            if (!empty($row['boiler_barrel_length']))
              $row['barrel'] = fn_feet($row['boiler_barrel_length']);
            if (!empty($row['boiler_max_diam_outside']))
              $row['barrel'] .= (empty($row['barrel']) ? " " : " x ") . fn_feet($row['boiler_max_diam_outside']);
            if (!empty($row['boiler_min_diam_outside']))
              $row['barrel'] .= (empty($row['barrel']) ? " " : "/") . fn_feet($row['boiler_min_diam_outside']) . ")";
            else
            if (!empty($row['boiler_max_diam_outside']))
              $row['barrel'] .= ")";

            $row['barrel_heating'] = "";
            if (!empty($row['hs_tube_num']))
              $row['barrel_heating'] = "(" . $row['hs_tube_num'];
            if (!empty($row['hs_tube_diameter']))
              $row['barrel_heating'] .=  " x " . fn_feet($row['hs_tube_diameter']) . ")";
            if (!empty($row['hs_tube_area']))
              $row['barrel_heating'] .=  " = " . fn_area_i($row['hs_tube_area']);

            $tb_all->add_data($row);
          }

          $tb_all->draw_table();
          $tb_all = null;
        }
      }
    }
    else
    if (strcmp($comp, "tender") == 0)
    {
      $tb1 = new MyTables("tender_facts");
      $tb2 = new MyTables("tender_history");

      if (!empty($id)) // specific boiler details
      {
        $sql = 'SELECT s2t.loco_id,
                       s2t.start_date,
                       sn.number,
                       concat("locoqry.php?action=locodata&id=", sn.loco_id,
                        "&type=S&loco=", sn.number)            AS number_hl,
                       coalesce(sc.common_name, sc.identifier) AS identifier,
                       snm.name
                FROM   s_to_tender s2t
                JOIN   s_nums sn
                ON     sn.loco_id = s2t.loco_id
                AND    sn.start_date = (select max(sn1.start_date)
                                        from   s_nums sn1
                                        where  sn1.loco_id = s2t.loco_id
                                        and    sn1.carried_number = "Y"
                                        and    sn1.start_date <= s2t.start_date)
                JOIN   s_class_link scl
                ON     scl.loco_id = s2t.loco_id
                AND    scl.start_date = (select max(scl1.start_date)
                                         from   s_class_link scl1
                                         where  scl1.loco_id = s2t.loco_id
                                         and    scl1.start_date <= s2t.start_date)
                JOIN   s_class sc
                ON     sc.s_class_id = scl.s_class_id
                LEFT JOIN s_name snm
                ON     snm.loco_id = sn.loco_id
                AND    snm.start_date = (select max(snm1.start_date)
                                         from   s_name snm1
                                         where  snm1.loco_id = s2t.loco_id
                                         and    snm1.start_date <= s2t.start_date)
                WHERE  s2t.s_tender_id = ' . $id .'
                ORDER BY s2t.start_date ASC';

        //echo $sql;

        $result = $db->execute($sql);

        $tb2->add_caption("Tender History",   NULL);
        $tb2->add_column("identifier",       "Class",                10);
        $tb2->add_column("number",           "Loco Number",           8);
        $tb2->add_column("name",             "Name",                 32);
        $tb2->add_column("start_date",       "Date Fitted",          14);

        while ($row = mysqli_fetch_assoc($result))
        {
          $row['start_date'] = fn_fdate($row['start_date']);
          $tb2->add_data($row);
        }

        $sql = 'SELECT st.earliest_usage_date,
                       st.tender_number,
                       tt.tender_type,
                       tt.tender_weight,
                       tt.company,
                       p.surname,
                       tt.water_capacity,
                       tt.coal_capacity,
                       tt.oil_capacity,
                       tt.wheelbase,
                       tt.wheelbase_verbose,
                       tt.wheelset_type,
                       tt.wheel_diameter,
                       tt.extra_info
                FROM   s_tender st

                JOIN   ref_tender_type tt
                ON     st.tender_type_id = tt.tender_type_id

                LEFT JOIN ref_people p
                ON     p.p_id = tt.designer_id

                WHERE  st.s_tender_id = ' . $id;

        // echo $sql;
        $result = $db->execute($sql);

        while ($row = mysqli_fetch_assoc($result))
        {
          $row['earliest_usage_date'] = fn_fdate($row['earliest_usage_date']);
          $cap = "Tender #" . $row['tender_number'];
          if (!empty($row['water_capacity']))
            $row['water_capacity'] = fn_ncomma($row['water_capacity']) . "gal";
          if (!empty($row['oil_capacity']))
            $row['oil_capacity'] = fn_ncomma($row['oil_capacity']) . "gal";
          if (!empty($row['tender_weight']))
            $row['tender_weight'] = fn_tons($row['tender_weight']);
          if (!empty($row['coal_capacity']))
            $row['coal_capacity'] = fn_tons($row['coal_capacity']);
          if (!empty($row['wheel_diameter']))
            $row['wheel_diameter'] = fn_msr_i($row['wheel_diameter']);

          $tb1->add_data($row);
        }

        $tb1->add_caption($cap, NULL);
        $tb1->suppress_nulls();
        $tb1->set_align("V");
        $tb1->add_row_lwidth(35); /* percentage of width of table for first column */
        $tb1->add_row("tender_type",       "Type");
        $tb1->add_row("company",           "Company");
        $tb1->add_row("water_capacity",    "Water");
        $tb1->add_row("coal_capacity",     "Coal");
        $tb1->add_row("oil_capacity",      "Oil");
        $tb1->add_row("tender_weight",     "Weight Laden");
        $tb1->add_row("wheelbase_verbose", "Wheelbase");
        $tb1->add_row("wheel_diameter",    "Wheel Diameter");
        $tb1->add_row("extra_info",        "Notes");

        printf("<table width=\"98%%\" frame=\"box\">\n");
          printf("<tr valign=\"top\">\n");
            printf("<td width=\"50%%\">\n");
              $tb1->draw_table();
            printf("</td>\n");
            printf("<td width=\"50%%\">\n");
              $tb2->draw_table();
            printf("</td>\n");
          printf("</tr>\n");
        printf("</table>\n");
      }
      else
      {
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

