<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  
<html xmlns="www.w3.org/1999/xhtml">

<!--
Copyright: Darren Hester 2006, www.designsbydarren.com
License: Released Under the "Creative Commons License", 
creativecommons.org/licenses/by-nc/2.5/
-->

<head>

<!-- Site Title -->
<title>Locomotive number search | Diesel | Steam | Electric
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
Enter search criteria in the box below and press 'Go'!
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

<div class='featurebox_center'>
<h3>Database Search</h3>

<?php if (!isset($_GET['loconum']) or ($_GET['loconum'] == '')): ?>

<!--
/***************************************************************************************************
****************************************************************************************************
****************************************************************************************************
***************************************************************************************************/
-->

  <p>Limit the search by date range</p>

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







<!--
/***************************************************************************************************
****************************************************************************************************
****************************************************************************************************
***************************************************************************************************/
-->


<?php else:
  require_once "lib/quickdb.class.php";
  require_once "lib/MyTables.class.php";  
  require_once "lib/brlib.php";

  // 1 possible parameter
  //   searchtext   <$loconum>  - searchtext
  
  $searchtext = "";

  $db = fn_connectdb();
 
  foreach ($_GET as $key => $value)
  {
    if ($key == "loconum")
    {
      $searchtext = $value;
      if (!empty($searchtext))
	  {
        $con = $db->get_connection();
        $searchtext = mysqli_real_escape_string($con, $searchtext);
        fn_check_input($searchtext);
	  }
    }
    else
    if ($key == "fbclid")
    {
    }
    else
      fn_poem($key, $value, 99);
  }
  
  $arr['loconum'] = $searchtext;
  fn_logit(1, $arr);
  
  $doit = 1; // hard coded - remnant of earlier code
  // Arguments are: host, user, password, database, persistent connection, show errors on screen
  $tb = new MyTables("loco_search");
  $tbs = new MyTables("site_search");
  $tbc_s = new MyTables("s_class_search");
  $tbc_d = new MyTables("d_class_search");
  $tbc_e = new MyTables("e_class_search");
  $tbo = new MyTables("order_search");
  $tbc_so = new MyTables("companies_search");
  $tbe = new MyTables("sightings_search");
  $tbc_dmu = new MyTables("dmu_vehicle_search");
  $tbc_dmu_units = new MyTables("dmu_unit_search");

  echo "<strong>Searching the database for objects matching '" .$searchtext. "'</strong><br />";

//echo "1) : ", $searchtext . "<br />";

  $searchtext = trim($searchtext);
//echo "2) : ", $searchtext . "<br />";

  // If a specific loco was searched for, strip out the hash '#'
  if (strchr($searchtext, '#'))
  {
    $searchtext = trim(trim($searchtext, '#'));
    $exact = 1;
  }
  else
    $exact = 0;
//echo "3) : ", $searchtext . "<br />";

  $arr = fn_is_co_and_num($searchtext);
  $arr1 = "";
  $arr2 = "";
  
  if (!empty($arr))
  {
     $arr1 = $arr[0];
     $arr2 = $arr[1];
  }

  // specific search statement 01/09/2013
  if ($exact)
    $sql1 = '= "' . $searchtext. '"';
  else
    $sql1 = 'like "%' .$searchtext. '%"';

  if ($exact)
    $sqln = '= "' . $searchtext. '"';
  else
    $sqln = 'like "%' . $searchtext. '%"';

  $sql = 'SELECT "Steam"                      AS type,
                 sc.s_class_id                AS class_id,

                 ifnull(sc.common_name, sc.identifier) 
                                              AS identifier,
                 concat("locoqry.php?action=class&type=S&id=",sc.s_class_id)     
                                              AS identifier_hl,

                 sc.wheel_arrangement         AS wheels,
                 concat("misc.php?page=wheelarr&id=", sc.wheel_arrangement)      
                                              AS wheels_hl,

                 sc.prg_company               AS prg_company,
                 concat("companies.php?page=", sc.big4_company,
                        "&prg=", sc.prg_company)
                                              AS prg_company_hl,

                 sc.big4_company              AS big4_company,
                 concat("companies.php?page=", sc.big4_company)
                                              AS big4_company_hl,

                 sc.br_standard               AS standard_flag,
                 sc.loco_count + sc.rblt_in   AS class_size,
                 concat("locoqry.php?action=class&id=", sc.s_class_id,
                        "&type=S&page=fleet") AS class_size_hl,

                 concat(if(length(p1.title), concat(p1.title, " "), ""), p1.forename, " ", p1.surname)
                                              AS cme,
                 concat("people.php?page=cme&id=", p1.p_id)
                                              AS cme_hl,
                 concat(if(length(p2.title), concat(p2.title, " "), ""), p2.forename, " ", p2.surname)
                                              AS cme_r,
                 concat("people.php?page=cme&id=", p2.p_id)
                                              AS cme_r_hl,
                 sc.year_introduced           AS introduced,
                 " "                          AS thumbnail,
                 concat("images/locos/steam/", sc.big4_company, "/thumbs/tn_", i.image)
                                              AS thumbnail_img,
                 concat("locoqry.php?action=class&amp;type=S&amp;id=", sc.s_class_id)     
                                              AS thumbnail_hl,
                 snn.nickname

          FROM   s_class sc
          LEFT JOIN ref_people p1
          ON     p1.p_id = sc.designer_id
          LEFT JOIN ref_people p2
          ON     p2.p_id = sc.modifier_id
          LEFT JOIN ref_gen_name_alt gna
          ON     gna.gna_id = p1.gna_id
          LEFT JOIN s_class_codes scc
          ON     scc.s_class_id = sc.s_class_id
          LEFT JOIN s_class_nn snn
          ON     snn.s_class_id = sc.s_class_id
          LEFT JOIN ref_images i
          ON     i.type = "S"
          AND    i.class_id = sc.s_class_id
          AND    i.img_index = "Y"
          WHERE  sc.identifier        ' . $sql1 . '
             OR  sc.common_name       ' . $sql1 . '
             OR  sc.wheel_arrangement ' . $sql1 . '
             OR  scc.s_class_code     ' . $sql1 . '
             OR  p1.surname           ' . $sql1 . '
             OR  p2.surname           ' . $sql1 . '
             OR  gna.name             ' . $sql1 . '
             OR  snn.nickname         ' . $sql1 . '
             OR  p1.surname           ' . $sql1 . '
             OR  p2.surname           ' . $sql1 . '
          GROUP BY 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20
          ORDER BY coalesce(sc.big4_company, sc.br_standard), sc.sort_order';

//echo $sql;

      $allrows = 0;

      $result = $db->execute($sql);
      $numrows= $db->count_select();
      
      if ($numrows == 0)
      {
//        echo "<i>No matches</i><br />";
      }
      else
      {
        echo "<br /><h5><strong>Steam Locomotive Classes: '" .$searchtext. "'</strong></h5><br />"; 

        $tbc_s->sortable("Y");
        $tbc_s->colour_coordinate("Y");
        $tbc_s->add_caption("Steam Locomotive Classes");
        $tbc_s->add_column("cme",               "Designer",    16);
        $tbc_s->add_column("railway",           "Company",     12);
        $tbc_s->add_column("identifier",        "Original Class",  10);
        $tbc_s->add_column("aka",               "Also known as",   14);
        $tbc_s->add_column("wheels",            "Wheels",       7);
        $tbc_s->add_column("class_size",        "Number",       8);
        $tbc_s->add_column("introduced",        "Introduced",  10);
        $tbc_s->add_column("info",              "Information", 13);
        $tbc_s->add_column("thumbnail",         "",            10);

        while ($row = mysqli_fetch_assoc($result))
        {
          if (!empty($row['cme_r']))
            $row['cme'] .= "/" . $row['cme_r'];

          if (!empty($row['prg_company']))
          {
            if (!empty($row['big4_company']))
            {
              $row['railway'] = sprintf("<a href=%s>%s</a> / <a href=%s>%s</a>",
                   $row['prg_company_hl'], $row['prg_company'], 
                   $row['big4_company_hl'], $row['big4_company']);
            }
            else
            {
              $row['railway'] = sprintf("<a href=%s>%s</a>",
                   $row['prg_company_hl'], $row['prg_company']);
            }
          }
          else
          if (!empty($row['big4_company']))
          {
            $row['railway'] = sprintf("<a href=%s>%s</a>",
                 $row['big4_company_hl'], $row['big4_company']);
          }
          else
          if ($row['br_standard'] == "Y")
          {
            $row['railway'] = sprintf("<a href=companies.php?page=BR>British Railways</a>");
          }
          
          if (!empty($row['nickname']))
          {
              $row['identifier'] .= " (" . $row['nickname'] . ")";
          }

          $tbc_s->add_data($row); $allrows++;
        }

        $tbc_s->draw_table();
      }

  $sql = 'SELECT "Diesel" AS type, 
                 dc.d_class_id AS class_id,
                 ifnull(dc.common_name, dc.identifier) AS identifier,
                 concat("locoqry.php?action=class&type=D&id=",dc.d_class_id) AS identifier_hl,
                 dc.wheel_arrangement AS wheels,
                 concat("misc.php?page=wheelarr&id=", dc.wheel_arrangement) AS wheels_hl,       
                 dc.prg_company AS prg_company,       
                 concat("companies.php?page=", dc.big4_company, "&prg=", dc.prg_company) AS prg_company_hl,       
                 dc.big4_company AS big4_company,       
                 concat("companies.php?page=", dc.big4_company) AS big4_company_hl,       
                 dc.loco_count AS class_size,       
                 concat("locoqry.php?action=class&id=", dc.d_class_id, "&type=D&page=fleet") AS class_size_hl,       
                 concat(if(length(p.title), concat(p.title, " "), ""), p.forename, " ", p.surname) AS cme,       
                 concat("people.php?page=cme&id=", p.p_id) AS cme_hl,       
                 dc.year_introduced AS introduced, 
                 " " AS thumbnail,       
                 concat("images/locos/diesel/thumbs/tn_", i.image) AS thumbnail_img,       
                 concat("locoqry.php?action=class&type=D&id=", dc.d_class_id) AS thumbnail_hl

          FROM d_class dc 

          LEFT JOIN ref_people p ON p.p_id = dc.designer_id
          LEFT JOIN ref_gen_name_alt gna ON gna.gna_id = p.gna_id 
          LEFT JOIN d_class_codes dcc ON dcc.d_class_id = dc.d_class_id 
          LEFT JOIN ref_images i ON i.type = "D" AND i.class_id = dc.d_class_id AND i.img_index = "Y"
          LEFT JOIN d_class_nn dnn ON dnn.d_class_id = dc.d_class_id

          WHERE  dc.identifier        ' . $sql1 . '
             OR  dc.common_name       ' . $sql1 . '
             OR  dc.wheel_arrangement ' . $sql1 . '
             OR  dcc.d_class_code     ' . $sql1 . '
             OR  p.surname            ' . $sql1 . '
             OR  gna.name             ' . $sql1 . '
             OR  dnn.nickname         ' . $sql1 . '
          GROUP BY 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18
          ORDER BY dc.big4_company, dc.sort_order';

//echo $sql;

    $result = $db->execute($sql);
    if (!$result)
    {
      echo "Problem searching Diesel Locomotive CLasses<br />";
    }
    else
    {
      $numrows = $db->count_select();
      
      if ($numrows == 0)
      {
//        echo "<i>No matches</i><br />";
      }
      else
      if ($numrows > 0)
      {
        echo "<br /><h5><strong>Diesel Locomotive Classes: '" .$searchtext. "'</strong></h5><br />"; 

        $tbc_d->sortable("Y");
        $tbc_d->colour_coordinate("Y");
        $tbc_d->add_column("cme",               "Designer",    16);
        $tbc_d->add_column("railway",           "Company",     12);
        $tbc_d->add_column("identifier",        "Class",       24);
        $tbc_d->add_column("wheels",            "Wheels",       7);
        $tbc_d->add_column("class_size",        "Number",       8);
        $tbc_d->add_column("introduced",        "Introduced",  10);
        $tbc_d->add_column("info",              "Information", 13);
        $tbc_d->add_column("thumbnail",         "",            10);

        while ($row = mysqli_fetch_assoc($result))
        {
          if (!empty($row['prg_company']))
          {
            if (!empty($row['big4_company']))
            {
              $row['railway'] = sprintf("<a href=%s>%s</a> / <a href=%s>%s</a>",
                   $row['prg_company_hl'], $row['prg_company'], 
                   $row['big4_company_hl'], $row['big4_company']);
            }
            else
            {
              $row['railway'] = sprintf("<a href=%s>%s</a>",
                   $row['prg_company_hl'], $row['prg_company']);
            }
          }
          else
          if (!empty($row['big4_company']))
          {
            $row['railway'] = sprintf("<a href=%s>%s</a>",
                 $row['big4_company_hl'], $row['big4_company']);
          }

          $tbc_d->add_data($row); $allrows++;
        }

        $tbc_d->draw_table();
      }
    }
      
  $sql = 'SELECT "Electric" AS type, 
                 ec.e_class_id AS class_id,
                 ifnull(ec.common_name, ec.identifier) AS identifier,
                 concat("locoqry.php?action=class&type=E&id=",ec.e_class_id) AS identifier_hl,
                 ec.wheel_arrangement AS wheels,
                 concat("misc.php?page=wheelarr&id=", ec.wheel_arrangement) AS wheels_hl,       
                 ec.prg_company AS prg_company,       
                 concat("companies.php?page=", ec.big4_company, "&prg=", ec.prg_company) AS prg_company_hl,       
                 ec.big4_company AS big4_company,       
                 concat("companies.php?page=", ec.big4_company) AS big4_company_hl,       
                 ec.loco_count AS class_size,       
                 concat("locoqry.php?action=class&id=", ec.e_class_id, "&type=E&page=fleet") AS class_size_hl,       
                 concat(if(length(p.title), concat(p.title, " "), ""), p.forename, " ", p.surname) AS cme,       
                 concat("people.php?page=cme&id=", p.p_id) AS cme_hl,       
                 ec.year_introduced AS introduced, 
                 " " AS thumbnail,       
                 concat("images/locos/electric/thumbs/tn_", i.image) AS thumbnail_img,       
                 concat("locoqry.php?action=class&type=E&id=", ec.e_class_id) AS thumbnail_hl

          FROM e_class ec 

          LEFT JOIN ref_people p ON p.p_id = ec.designer_id
          LEFT JOIN ref_gen_name_alt gna ON gna.gna_id = p.gna_id 
          LEFT JOIN e_class_codes ecc ON ecc.e_class_id = ec.e_class_id 
          LEFT JOIN ref_images i ON i.type = "E" AND i.class_id = ec.e_class_id AND i.img_index = "Y"
          LEFT JOIN e_class_nn enn ON enn.e_class_id = ec.e_class_id

          WHERE  ec.identifier        ' . $sql1 . '
             OR  ec.common_name       ' . $sql1 . '
             OR  ec.wheel_arrangement ' . $sql1 . '
             OR  ecc.e_class_code     ' . $sql1 . '
             OR  p.surname            ' . $sql1 . '
             OR  gna.name             ' . $sql1 . '
             OR  enn.nickname         ' . $sql1 . '
          GROUP BY 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18
          ORDER BY ec.big4_company, ec.sort_order';

//echo $sql;

    $result = $db->execute($sql);
    if (!$result)
    {
      echo "Problem searching Electric Locomotive CLasses<br />";
    }
    else
    {
      $numrows = $db->count_select();
      
      if ($numrows == 0)
      {
//        echo "<i>No matches</i><br />";
      }
      else
      if ($numrows > 0)
      {
        echo "<br /><h5><strong>Electric Locomotive Classes: '" .$searchtext. "'</strong></h5><br />"; 

        $tbc_e->sortable("Y");
        $tbc_e->colour_coordinate("Y");
        $tbc_e->add_column("cme",               "Designer",    16);
        $tbc_e->add_column("railway",           "Company",     12);
        $tbc_e->add_column("identifier",        "Class",       24);
        $tbc_e->add_column("wheels",            "Wheels",       7);
        $tbc_e->add_column("class_size",        "Number",       8);
        $tbc_e->add_column("introduced",        "Introduced",  10);
        $tbc_e->add_column("info",              "Information", 13);
        $tbc_e->add_column("thumbnail",         "",            10);

        while ($row = mysqli_fetch_assoc($result))
        {
          if (!empty($row['prg_company']))
          {
            if (!empty($row['big4_company']))
            {
              $row['railway'] = sprintf("<a href=%s>%s</a> / <a href=%s>%s</a>",
                   $row['prg_company_hl'], $row['prg_company'], 
                   $row['big4_company_hl'], $row['big4_company']);
            }
            else
            {
              $row['railway'] = sprintf("<a href=%s>%s</a>",
                   $row['prg_company_hl'], $row['prg_company']);
            }
          }
          else
          if (!empty($row['big4_company']))
          {
            $row['railway'] = sprintf("<a href=%s>%s</a>",
                 $row['big4_company_hl'], $row['big4_company']);
          }

          $tbc_e->add_data($row); $allrows++;
        }

        $tbc_e->draw_table();
      }
    }
    
    /* Diesel Multiple Unit vehicles * /
	$sql = 'SELECT "Diesel" AS type, 
                 dc.dmu_class_id AS class_id,
                 ifnull(dc.common_name, dc.identifier) AS identifier,
                 concat("locoqry.php?action=class&type=DMU&id=", dc.dmu_class_id) AS identifier_hl,
                 dc.wheel_arrangement AS wheels,
                 concat("misc.php?page=wheelarr&id=", dc.wheel_arrangement) AS wheels_hl,       
                 dc.big4_company AS big4_company,       
                 concat("companies.php?page=", dc.big4_company) AS big4_company_hl,       
                 dc.dmu_count AS class_size,       
                 concat("locoqry.php?action=class&id=", dc.dmu_class_id, "&type=DMU&page=fleet") AS class_size_hl,               
                 dc.year_introduced AS introduced, 
                 " " AS thumbnail,       
                 concat("images/MU/diesel/thumbs/tn_", i.image) AS thumbnail_img,       
                 concat("locoqry.php?action=class&type=DMU&id=", dc.dmu_class_id) AS thumbnail_hl

          FROM dmu_class dc 

          LEFT JOIN dmu_class_codes dcc ON dcc.dmu_class_id = dc.dmu_class_id 
          LEFT JOIN ref_images i ON i.type = "DMU" AND i.class_id = dc.dmu_class_id AND i.img_index = "Y"
          LEFT JOIN dmu_class_nn dnn ON dnn.dmu_class_id = dc.dmu_class_id

          WHERE  dc.identifier        ' . $sql1 . '
             OR  dc.common_name       ' . $sql1 . '
             OR  dc.wheel_arrangement ' . $sql1 . '
             OR  dcc.dmu_class_code   ' . $sql1 . '
             OR  dnn.nickname         ' . $sql1 . '
          GROUP BY 1,2,3,4,5,6,7,8,9,10,11,12,13,14
          ORDER BY dc.big4_company, dc.sort_order';

//echo $sql;

    $result = $db->execute($sql);
    if (!$result)
    {
      echo "Problem searching Diesel Multiple Unit Vehicles<br />";
    }
    else
    {
      $numrows = $db->count_select();
      
      if ($numrows == 0)
      {
//        echo "<i>No matches</i><br />";
      }
      else
      if ($numrows > 0)
      {
        echo "<br /><h5><strong>Diesel Multiple Unit Vehicles: '" .$searchtext. "'</strong></h5><br />"; 

        $tbc_dmu->sortable("Y");
        $tbc_dmu->colour_coordinate("Y");
        $tbc_dmu->add_column("cme",               "Designer",    16);
        $tbc_dmu->add_column("railway",           "Company",     12);
        $tbc_dmu->add_column("identifier",        "Class",       24);
        $tbc_dmu->add_column("wheels",            "Wheels",       7);
        $tbc_dmu->add_column("class_size",        "Number",       8);
        $tbc_dmu->add_column("introduced",        "Introduced",  10);
        $tbc_dmu->add_column("info",              "Information", 12);
        $tbc_dmu->add_column("thumbnail",         "",            10);

        while ($row = mysqli_fetch_assoc($result))
        {
          if (!empty($row['prg_company']))
          {
            if (!empty($row['big4_company']))
            {
              $row['railway'] = sprintf("<a href=%s>%s</a> / <a href=%s>%s</a>",
                   $row['prg_company_hl'], $row['prg_company'], 
                   $row['big4_company_hl'], $row['big4_company']);
            }
            else
            {
              $row['railway'] = sprintf("<a href=%s>%s</a>",
                   $row['prg_company_hl'], $row['prg_company']);
            }
          }
          else
          if (!empty($row['big4_company']))
          {
            $row['railway'] = sprintf("<a href=%s>%s</a>",
                 $row['big4_company_hl'], $row['big4_company']);
          }

          $tbc_dmu->add_data($row); $allrows++;
        }

        $tbc_dmu->draw_table();
      }
    }
 
    /* Diesel Multiple Units * /
	$sql = 'SELECT df.formation_date,
                   df.unit_number,
                   CASE WHEN df.initial_formation = "Y"
                     THEN
                       "Initial formation"
                     ELSE
                     ""
                     END              AS notes,
                  df.snapshot
              FROM   dmu_formation df
              WHERE  unit_number ' . $sql1 . '
              ORDER BY unit_number';

 // echo $sql;

    $result = $db->execute($sql);
    if (!$result)
    {
      echo "Problem searching Diesel Multiple Units<br />";
    }
    else
    {
      $numrows = $db->count_select();
      
      if ($numrows == 0)
      {
//        echo "<i>No matches</i><br />";
      }
      else
      if ($numrows > 0)
      {
        echo "<br /><h5><strong>Diesel Multiple Units: '" .$searchtext. "'</strong></h5><br />"; 

        $tbc_dmu_units->sortable("Y");
        $tbc_dmu_units->colour_coordinate("Y");
        $tbc_dmu_units->add_column("cme",               "Designer",    16);
        $tbc_dmu_units->add_column("railway",           "Company",     12);
        $tbc_dmu_units->add_column("identifier",        "Class",       24);
        $tbc_dmu_units->add_column("wheels",            "Wheels",       7);
        $tbc_dmu_units->add_column("class_size",        "Number",       8);
        $tbc_dmu_units->add_column("introduced",        "Introduced",  10);
        $tbc_dmu_units->add_column("info",              "Information", 12);
        $tbc_dmu_units->add_column("thumbnail",         "",            10);

        while ($row = mysqli_fetch_assoc($result))
        {
          if (!empty($row['prg_company']))
          {
            if (!empty($row['big4_company']))
            {
              $row['railway'] = sprintf("<a href=%s>%s</a> / <a href=%s>%s</a>",
                   $row['prg_company_hl'], $row['prg_company'], 
                   $row['big4_company_hl'], $row['big4_company']);
            }
            else
            {
              $row['railway'] = sprintf("<a href=%s>%s</a>",
                   $row['prg_company_hl'], $row['prg_company']);
            }
          }
          else
          if (!empty($row['big4_company']))
          {
            $row['railway'] = sprintf("<a href=%s>%s</a>",
                 $row['big4_company_hl'], $row['big4_company']);
          }

          $tbc_dmu_units->add_data($row); $allrows++;
        }

        $tbc_dmu_units->draw_table();
      }
    }
 
 
*/ 
 

  // Locos

  for ($nx = 0; $nx <= 7; $nx++)
  {
    // Empty the table
    $tb->flush("loco_search");

    switch ($nx)
    {
      case '0': // steam

        if ($doit == 1)
        {
          $tb->add_column("company",        "Built For",    4);
          $tb->add_column("cme",            "Designer",     8);
          $tb->add_column("works_num",      "Works Num",    4);
          $tb->add_column("power_rating",   "Power",        4);
          $tb->add_column("class",          "Class",       10);
//          $tb->add_column("identifier",   "Common Name", 12);
          $tb->add_column("wheels",         "Wheels",       7);
          $tb->add_column("introduced",     "Intro.",       4);
          $tb->add_column("b_date",         "Built",        8);
          $tb->add_column("w_date",         "Withdrawn",    8);
          $tb->add_column("number_type",    "Number Type",  8);
          $tb->add_column("number",         "Number",       6);
          $tb->add_column("num_start_date", "Number Start", 8);
          $tb->add_column("sname",          "Name",        16);

          $headline = "<br /><h5><strong>Steam Locomotive: '" .$searchtext. "'</strong></h5><br />"; 
          
          if ($arr1 != "" && $arr2 != "")
          {
              $company1 = " and sn1.company = '" . $arr1 . "'";
              $company2 = " and sn2.company = '" . $arr1 . "'";
              $company3 = " and sn3.company = '" . $arr1 . "'";

              $sql1 = " = '" . $arr2 . "'";
          }

          $sql = 'SELECT "S"                                        AS type,
                         F.loco_id                                  AS id,
                         concat(ifnull(sn.prefix, ""),
                                sn.number,
                                ifnull(sn.suffix, ""))              AS number,
                         concat("locoqry.php?action=locodata&type=S&id=", sn.loco_id, 
                            "&loco=", sn.number)                    AS number_hl,
                         CASE WHEN sn.company IS NOT NULL THEN
                         concat(sn.company,
                                CASE WHEN sn.subtype IS NOT NULL THEN
                                  concat(" (", sn.subtype, ")")
                                ELSE
                                  ""
                                END)
                         ELSE
                           ""
                         END                                        AS number_type,
                         sc.wheel_arrangement                       AS wheels,
                         concat("misc.php?page=wheelarr&id=", sc.wheel_arrangement)      
                                                                    AS wheels_hl,
                         coalesce(sc.common_name, sc.identifier)    AS class,
                         concat("locoqry.php?action=class&type=S&id=", sc.s_class_id) 
                                                                    AS class_hl,
                         ifnull(ifnull(sc.prg_company, sc.big4_company), "BR")
                                                                    AS company,
                         p.surname                                  AS cme,
                         concat("people.php?page=cme&id=", p.p_id)  AS cme_hl,
                         sn.carried_number,
                         sc.year_introduced                         AS introduced,
                         scv.power_rating,
                         snm.name                                   AS sname,
                         s.b_date,
                         s.b_date_prd,
                         s.w_date,
                         s.w_date_prd,
                         s.works_num                                AS works_num_a,
                         s.works_num_b                              AS works_num_b,
                         snn.nickname,
                         sn.start_date                              AS num_start_date
                  from s_nums sn
                  
                  join steam s
                  on   s.loco_id = sn.loco_id
                  join s_class_link scl
                  on   scl.loco_id = sn.loco_id ' .
//                  and  scl.start_date = (select max(scl1.start_date)
//                                         from   s_class_link scl1
//                                         where  scl1.loco_id = scl.loco_id
//                                         and    scl1.start_date <= sn.start_date)
                 'join s_class sc
                  on   scl.s_class_id = sc.s_class_id
                  join s_class_var scv
                  on   scv.s_class_id = scl.s_class_id
                  and  scv.s_class_var_id = scl.s_class_var_id
                  left join s_name snm
                  on   snm.loco_id = sn.loco_id
                  and  snm.start_date = (select max(snm1.start_date)
                                         from   s_name snm1
                                         where  snm1.loco_id = snm.loco_id
                                         and    snm1.start_date <= s.w_date)
                  left join ref_people p
                  on   p.p_id = sc.designer_id
                  left join s_class_nn snn
                  on   snn.s_class_id = sc.s_class_id
                  and  snn.principal = "Y"
                  JOIN
                  (
                         SELECT sn0.loco_id
                         FROM   s_nums sn0
                         WHERE  sn0.loco_id in
                                  (select sn1.loco_id
                                   from   s_nums sn1
                                   where  sn1.number  ' .$sql1. '
                                   ' .$company1. ')
                            OR  sn0.loco_id in
                                  (select sn2.loco_id
                                   from   s_nums sn2
                                   where  concat(ifnull(sn2.prefix, ""), sn2.number, ifnull(sn2.suffix, ""))  ' .$sql1. '
                                   ' .$company2. ')
                            OR  sn0.loco_id IN
                                  (select sn3.loco_id
                                   from   s_nums sn3
                                   where  concat("S", sn3.number)  ' .$sql1. '
                                   ' .$company3. ')
                            OR  sn0.loco_id IN 
                                  (select s4.loco_id
                                   from steam s4
                                   where s4.works_num ' .$sql1. '
                                   or    s4.works_num_b ' .$sql1. ')
                            OR  sn0.loco_id IN
                                  (select sn4.loco_id
                                   from s_name sn4
                                   where  sn4.name    ' .$sqln. ')
                            OR  concat("ID", sn0.loco_id) = "' . $searchtext . '"
                         GROUP BY sn0.loco_id
                  ) AS F
                  on F.loco_id = sn.loco_id
                  group by F.loco_id, concat(ifnull(sn.prefix, ""), sn.number, ifnull(sn.suffix, ""))
                  order by F.loco_id, sn.start_date, company';
  // echo $sql . "<br />" . $sqln . "<br />" . $searchtext . "<br />";
        }
        break;

      case '1': // steam railmotors etc ...
          // echo "<br /><h5><strong>Steam Railmotors etc...: '" .$searchtext. "'</strong></h5><br />";
          $sql = 'SELECT * FROM ref_depot where depot_id = 156432153';
        break;

      case '2': // diesel

        if ($doit == 1)
        {
          $tb->add_column("company",        "Built For",    4);
          $tb->add_column("bl_name",        "Builder",      8);
          $tb->add_column("works_num",      "Works Num",    4);
          $tb->add_column("loco_type",      "Type",         4);
          $tb->add_column("class",          "Class",       10);
//          $tb->add_column("identifier",   "Common Name", 12);
          $tb->add_column("wheels",         "Wheels",       7);
          $tb->add_column("introduced",     "Intro.",       4);
          $tb->add_column("b_date",         "Built",        8);
          $tb->add_column("w_date",         "Withdrawn",    8);
          $tb->add_column("number_type",    "Number Type",  8);
          $tb->add_column("number",         "Number",       6);
          $tb->add_column("num_start_date", "Number Start", 8);
          $tb->add_column("name",           "Name",        16);
 
          $headline = "<br /><h5><strong>Diesel Locomotive: '" .$searchtext. "'</strong></h5><br />"; 

          $sql = 'SELECT "D"                                        AS type,
                         F.loco_id                                  AS id,
                         concat(if(dn.number_type = "PRT", "D", ""),
                                dn.number)                          AS number,
                         concat("locoqry.php?action=locodata&type=D&id=", dn.loco_id, 
                            "&loco=", dn.number)                    AS number_hl,
                         CASE WHEN dn.company IS NOT NULL THEN
                         concat(dn.company,
                                CASE WHEN dn.subtype IS NOT NULL THEN
                                  concat(" (", dn.subtype, ")")
                                ELSE
                                  ""
                                END)
                         ELSE
                           ""
                         END                                        AS number_type,
                         dc.wheel_arrangement                       AS wheels,
                         concat("misc.php?page=wheelarr&id=", dc.wheel_arrangement)      
                                                                    AS wheels_hl,
                         coalesce(dc.common_name, dc.identifier)    AS class,
                         concat("locoqry.php?action=class&type=D&id=", dc.d_class_id) 
                                                                    AS class_hl,
                         ifnull(dc.big4_company, "BR")              AS company,
                         dn.carried_number,
                         dc.year_introduced                         AS introduced,
                         dc.type                                    AS loco_type,
                         dnm.name                                   AS name,
                         coalesce(b.bl_short_name, b.bl_name)       AS bl_name,
                         dcv.total_horse_power                      AS horse_power,
                         d.works_num                                AS works_num_a,
                         d.works_num_b                              AS works_num_b,
                         d.b_date,
                         d.w_date,
                         NULL                                       AS nickname,
                         dn.start_date                              AS num_start_date
                  from d_nums dn
                  join diesels d
                  on   d.loco_id = dn.loco_id
                  join d_class_link dcl
                  on   dcl.loco_id = dn.loco_id
                  and  dcl.start_date = (select max(dcl1.start_date)
                                         from   d_class_link dcl1
                                         where  dcl1.loco_id = dcl.loco_id
                                         and    dcl1.start_date <= dn.start_date)
                  join d_class dc
                  on   dcl.d_class_id = dc.d_class_id
                  join d_class_var dcv
                  on   dcv.d_class_id = dcl.d_class_id
                  and  dcv.d_class_var_id = dcl.d_class_var_id
                  left join d_name dnm
                  on   dnm.loco_id = dn.loco_id
                  LEFT JOIN  ref_builders b
                  ON    b.bl_code = d.bl_code
                  JOIN
                  (
                         SELECT dn.loco_id
                         FROM   d_nums dn
                         WHERE  dn.loco_id in
                                  (select d1.loco_id
                                   from   d_nums d1
                                   where  d1.number  ' .$sql1. ')
                            OR     dn.loco_id IN
                                  (select d2.loco_id
                                   from   d_nums d2
                                   where  concat("D", d2.number)  ' .$sql1. ')
                            OR     dn.loco_id IN 
                                  (select d4.loco_id
                                   from diesels d4
                                   where d4.works_num ' .$sql1. '
                                   or    d4.works_num_b ' .$sql1. ')
                            OR     dn.loco_id IN
                                  (select d3.loco_id
                                   from   d_name d3
                                   where  d3.name    ' .$sqln. ')
                            OR     concat("ID", dn.loco_id) = "' . $searchtext . '"
                         GROUP BY dn.loco_id
                  ) AS F
                  ON F.loco_id = dn.loco_id
                  group by F.loco_id, dn.number
                  order by F.loco_id, dn.start_date, dn.number';
//echo $sql;
        }
        break;

      case '3': // DMU vehicles & Railcars
        if ($doit == 1)
        {
          $tb->add_column("company",      "Built For",    8);
          $tb->add_column("bl_name",      "Builder",     16);
          $tb->add_column("class",        "Class",       10);
//          $tb->add_column("identifier",   "Common Name", 12);
          $tb->add_column("wheels",       "Wheels",       7);
          $tb->add_column("introduced",   "Intro.",       4);
          $tb->add_column("number_type",  "Number Type", 16);
          $tb->add_column("number",       "Number",       6);
          $tb->add_column("loco_type",    "Type",         9);

          $headline = "<br /><h5><strong>Diesel Multiple Unit Vehicles: '" .$searchtext. "'</strong></h5><br />"; 

          $sql = 'SELECT "DMU"                                      AS type,
                         F.dmu_id                                   AS id,
                         dn.number                                  AS number,
                         concat("locoqry.php?action=locodata&type=DMU&id=", dn.dmu_id, 
                            "&loco=", dn.number)                    AS number_hl,
                         CASE WHEN dn.company IS NOT NULL THEN
                         concat(dn.company,
                                CASE WHEN dn.subtype IS NOT NULL THEN
                                  concat(" (", dn.subtype, ")")
                                ELSE
                                  ""
                                END)
                         ELSE
                           ""
                         END                                        AS number_type,
                         dc.wheel_arrangement                       AS wheels,
                         concat("misc.php?page=wheelarr&id=", dc.wheel_arrangement)      
                                                                    AS wheels_hl,
                         coalesce(dc.common_name, dc.identifier)    AS class,
                         concat("locoqry.php?action=class&type=DMU&id=", dc.dmu_class_id) 
                                                                    AS class_hl,
                         ifnull(dc.big4_company, "BR")              AS company,
                         dn.carried_number,
                         dc.year_introduced                         AS introduced,
                         dc.type                                    AS loco_type,
                         coalesce(b.bl_short_name, b.bl_name)       AS bl_name
                  from dmu_nums dn
                  join dmu d
                  on   d.dmu_id = dn.dmu_id
                  join dmu_class_link dcl
                  on   dcl.dmu_id = dn.dmu_id
                  and  dcl.start_date = (select max(dcl1.start_date)
                                         from   dmu_class_link dcl1
                                         where  dcl1.dmu_id = dcl.dmu_id
                                         and    dcl1.start_date <= dn.start_date)
                  join dmu_class dc
                  on   dcl.dmu_class_id = dc.dmu_class_id
                  join dmu_class_var dcv
                  on   dcv.dmu_class_id = dcl.dmu_class_id
                  and  dcv.dmu_class_var_id = dcl.dmu_class_var_id
                  LEFT JOIN  ref_builders b
                  ON    b.bl_code = d.bl_code_mech
                  JOIN
                  (
                         SELECT dn.dmu_id
                         FROM   dmu_nums dn
                         WHERE  dn.dmu_id in
                                  (select d1.dmu_id
                                   from   dmu_nums d1
                                   where  d1.number  ' .$sql1. ')
                            OR     dn.dmu_id IN
                                  (select d2.dmu_id
                                   from   dmu_nums d2
                                   where  concat("D", d2.number)  ' .$sql1. ')
                            OR     concat("ID", dn.dmu_id) = "' . $searchtext . '"
                         GROUP BY dn.dmu_id
                  ) AS F
                  ON F.dmu_id = dn.dmu_id
                  group by F.dmu_id, dn.number
                  order by F.dmu_id, dn.start_date, dn.number';
//echo $sql;
        }
      break;

      case '4': // DMU vehicles & Railcars
        if ($doit == 1)
        {
          $tb->add_column("company",      "Built For",    8);
          $tb->add_column("bl_name",      "Builder",     16);
          $tb->add_column("class",        "Class",       10);
//          $tb->add_column("identifier",   "Common Name", 12);
          $tb->add_column("wheels",       "Wheels",       7);
          $tb->add_column("introduced",   "Intro.",       4);
          $tb->add_column("number_type",  "Set Number",  16);
          $tb->add_column("unit_number",  "Number",       6);
          $tb->add_column("loco_type",    "Type",         9);

          $headline = "<br /><h5><strong>Diesel Multiple Unit Sets: '" .$searchtext. "'</strong></h5><br />"; 
          
          $sql = 'SELECT "DMU"                   AS type,
                         df.formation_date,
                         df.unit_number,
                         CASE WHEN df.initial_formation = "Y" THEN
                           "Initial formation"
                         ELSE
                           ""
                         END                     AS notes,
                         df.snapshot
              FROM   dmu_formation df
              WHERE  unit_number ' . $sql1 . '
              ORDER BY unit_number';
        }
      break;

      case '5': // electric

        if ($doit == 1)
        {
          $tb->add_column("company",        "Built For",    4);
          $tb->add_column("bl_name",        "Builder",      8);
          $tb->add_column("works_num",      "Works Num",    4);
          $tb->add_column("loco_type",      "Type",         4);
          $tb->add_column("class",          "Class",       10);
//          $tb->add_column("identifier",   "Common Name", 12);
          $tb->add_column("wheels",         "Wheels",       7);
          $tb->add_column("introduced",     "Intro.",       4);
          $tb->add_column("b_date",         "Built",        8);
          $tb->add_column("w_date",         "Withdrawn",    8);
          $tb->add_column("number_type",    "Number Type",  8);
          $tb->add_column("number",         "Number",       6);
          $tb->add_column("num_start_date", "Number Start", 8);
          $tb->add_column("name",           "Name",        16);

          $headline = "<br /><h5><strong>Electric Locomotive: '" .$searchtext. "'</strong></h5><br />"; 

          $sql = 'SELECT "E"                                        AS type,
                         F.loco_id                                  AS id,
                         concat(if(en.number_type = "PRT" OR en.number_type = "PN", "E", ""),
                                en.number)                          AS number,
                         concat("locoqry.php?action=locodata&type=E&id=", en.loco_id, 
                            "&loco=", en.number)                    AS number_hl,
                         CASE WHEN en.company IS NOT NULL THEN
                         concat(en.company,
                                CASE WHEN en.subtype IS NOT NULL THEN
                                  concat(" (", en.subtype, ")")
                                ELSE
                                  ""
                                END)
                         ELSE
                           ""
                         END                                        AS number_type,
                         ec.wheel_arrangement                       AS wheels,
                         concat("misc.php?page=wheelarr&id=", ec.wheel_arrangement)      
                                                                    AS wheels_hl,
                         coalesce(ec.common_name, ec.identifier)    AS class,
                         concat("locoqry.php?action=class&type=E&id=", ec.e_class_id) 
                                                                    AS class_hl,
                         ifnull(ec.big4_company, "BR")              AS company,
                         en.carried_number,
                         ec.year_introduced                         AS introduced,
                         ec.current                                 AS loco_type,
                         enm.name                                   AS name,
                         coalesce(b.bl_short_name, b.bl_name)       AS bl_name,
                         ecv.horse_power,
                         e.works_num                                AS works_num_a,
                         e.works_num_b                              AS works_num_b,
                         e.b_date,
                         e.w_date,
                         NULL                                       AS nickname,
                         en.start_date                              AS num_start_date
                  from e_nums en
                  join electric e
                  on   e.loco_id = en.loco_id
                  join e_class_link ecl
                  on   ecl.loco_id = en.loco_id
                  and  ecl.start_date = (select max(ecl1.start_date)
                                         from   e_class_link ecl1
                                         where  ecl1.loco_id = ecl.loco_id
                                         and    ecl1.start_date <= en.start_date)
                  join e_class ec
                  on   ecl.e_class_id = ec.e_class_id
                  join e_class_var ecv
                  on   ecv.e_class_id = ecl.e_class_id
                  and  ecv.e_class_var_id = ecl.e_class_var_id
                  left join e_name enm
                  on   enm.loco_id = en.loco_id
                  LEFT JOIN ref_builders b
                  ON    b.bl_code = e.bl_code
                  JOIN
                  (
                         SELECT en.loco_id
                         FROM   e_nums en
                         WHERE  en.loco_id in
                                  (select e1.loco_id
                                   from   e_nums e1
                                   where  e1.number  ' .$sql1. ')
                            OR     en.loco_id IN
                                  (select e2.loco_id
                                   from   e_nums e2
                                   where  concat("E", e2.number)  ' .$sql1. ')
                            OR     en.loco_id IN 
                                  (select e4.loco_id
                                   from electric e4
                                   where e4.works_num ' .$sql1. '
                                   or    e4.works_num_b ' .$sql1. ')
                            OR     en.loco_id IN
                                  (select e3.loco_id
                                   from   e_name e3
                                   where  e3.name    ' .$sqln. ')
                            OR     concat("ID", en.loco_id) = "' . $searchtext . '"
                         GROUP BY en.loco_id
                  ) AS F
                  ON F.loco_id = en.loco_id
                  group by F.loco_id, en.number
                  order by F.loco_id, en.start_date, en.number';
                  
                  //echo $sql;
        }
        break;
      case '6': // EMU vehicles
      
        if ($doit == 1)
        {
          $tb->add_column("company",      "Built For",    8);
          $tb->add_column("bl_name",      "Builder",     16);
          $tb->add_column("class",        "Class",       10);
//          $tb->add_column("identifier",   "Common Name", 12);
          $tb->add_column("wheels",       "Wheels",       7);
          $tb->add_column("introduced",   "Intro.",       4);
          $tb->add_column("number_type",  "Number Type", 16);
          $tb->add_column("number",       "Number",       6);
          $tb->add_column("loco_type",    "Type",         9);

          $headline = "<br /><h5><strong>Electric Multiple Unit Vehicles: '" .$searchtext. "'</strong></h5><br />"; 

          $sql = 'SELECT "EMU"                                      AS type,
                         F.emu_id                                   AS id,
                         en.number                                  AS number,
                         concat("locoqry.php?action=locodata&type=emu&id=", en.emu_id, 
                            "&loco=", en.number)                    AS number_hl,
                         CASE WHEN en.company IS NOT NULL THEN
                         concat(en.company,
                                CASE WHEN en.subtype IS NOT NULL THEN
                                  concat(" (", en.subtype, ")")
                                ELSE
                                  ""
                                END)
                         ELSE
                           ""
                         END                                        AS number_type,
                         ec.wheel_arrangement                       AS wheels,
                         concat("misc.php?page=wheelarr&id=", ec.wheel_arrangement)      
                                                                    AS wheels_hl,
                         coalesce(ec.common_name, ec.identifier)    AS class,
                         concat("locoqry.php?action=class&type=emu&id=", ec.emu_class_id) 
                                                                    AS class_hl,
                         ifnull(ec.big4_company, "BR")              AS company,
                         en.carried_number,
                         ec.year_introduced                         AS introduced,
                         ec.type                                    AS loco_type,
                         coalesce(b.bl_short_name, b.bl_name)       AS bl_name,
                         NULL                                       AS num_start_date
                  from emu_nums en
                  join emu e
                  on   e.emu_id = en.emu_id
                  join emu_class_link ecl
                  on   ecl.emu_id = en.emu_id
                  and  ecl.start_date = (select max(ecl1.start_date)
                                         from   emu_class_link ecl1
                                         where  ecl1.emu_id = ecl.emu_id
                                         and    ecl1.start_date <= en.start_date)
                  join emu_class ec
                  on   ecl.emu_class_id = ec.emu_class_id
                  join emu_class_var ecv
                  on   ecv.emu_class_id = ecl.emu_class_id
                  and  ecv.emu_class_var_id = ecl.emu_class_var_id
                  LEFT JOIN  ref_builders b
                  ON    b.bl_code = e.bl_code_mech
                  JOIN
                  (
                         SELECT en.emu_id
                         FROM   emu_nums en
                         WHERE  en.emu_id in
                                  (select e1.emu_id
                                   from   emu_nums e1
                                   where  e1.number  ' .$sql1. ')
                            OR     en.emu_id IN
                                  (select e2.emu_id
                                   from   emu_nums e2
                                   where  concat("E", en.number)  ' .$sql1. ')
                            OR     concat("ID", en.emu_id) = "' . $searchtext . '"
                         GROUP BY en.emu_id
                  ) AS F
                  ON F.emu_id = en.emu_id
                  group by F.emu_id, en.number
                  order by F.emu_id, en.start_date, en.number';
//echo $sql;
        }

        break;
        
      case '7': // EMU units
        if ($doit == 1)
        {
          $headline = "<br /><h5><strong>Electric Multiple Unit Sets: '" .$searchtext. "'</strong></h5><br />"; 
          $sql = 'SELECT * FROM ref_depot where depot_id = 156432153';
        }

      default:
        break;
    }

    if ($doit == 1)
    {
      $tb->colour_coordinate("Y");

      //echo $sql;
      
      $result = $db->execute($sql);
      $numrows= $db->count_select();

      if ($numrows == 0)
      {
        //echo "<i>No matches</i><br />";
      }
      else
      if ($numrows > 400)
      {
        echo " (Too many matches ($numrows) - please refine your search - see hints on front page)<br />";
      }
      else
      {
        echo $headline;

        $lastid = 0; $nc = -1; $curr = array(); $lastclass = ""; $lastname = "";

        while ($row = mysqli_fetch_assoc($result))
        {
          $nc++;
          // echo "Lastid = " . $lastid . ", currid = " . $row['id'] . "<br />";
          if ($lastid == 0 || ($row['id'] != $curr['id']))
          {
            // copy current into aggregate - print out old one first
            if ($lastid != 0)
            {
              // print("Adding data <br />");
              $tb->add_data($curr); $allrows++;
              $nc = 0;
              $lastclass = ""; $lastname = ""; $class = ""; $name = "";
            }

            $curr = $row;
          }

          // now load aggregated data

          $nt = $row['number_type'];

          switch ($row['type'])
          {
            case "S": // steam
              $name = "";
              
              if (!empty($row['b_date']))
                  $curr['b_date'] = fn_fdate($row['b_date']);
                  
              if (!empty($row['w_date']))
                  $curr['w_date'] = fn_fdate($row['w_date']);

              if (!empty($row['works_num_a']))
                  $curr['works_num'] = $row['works_num_a'];

              if (!empty($row['works_num_b']))
              {
                  if (!empty($row['works_num_a']))
                      $curr['works_num'] = $curr['works_num'] . '/' .$row['works_num_b'];
                  else
                      $curr['works_num'] = $row['works_num_b'];
              }

              if ($row['carried_number'] == "N")
                $row['number'] = "<i>" . $row['number'] . "</i>";
              // print "Number Type for (" . $row['number'] .") is " . $row['number_type'] . "<br />";
              if (!empty($row['number_type']) && $nc)
              {
                $curr['number_type'] .= "<br />" . $row['number_type'];
                $curr['number'] .= "<br />" . $row['number'];
                //printf("Adding %s\n", $row['num_start_date']);
                $curr['num_start_date'] .= "<br />" . fn_fdate($row['num_start_date']);
              }
              else
              {
                $curr['number_type'] = $row['number_type'];
                $curr['number'] = $row['number'];
                //printf("</br >Starting %s\n", $row['num_start_date']);
                $curr['num_start_date'] = fn_fdate($row['num_start_date']);
              }
              
              if (!empty($row['nickname']))
                $row['class'] .= " (" . $row['nickname'] . ')';

              if ($lastclass != $row['class'])
              {
                if ($lastclass == "")
                  $class = $row['class'];
                else
                  $class .= ", " . $row['class'];
              }

              $curr['class'] = $class;
              $lastclass = $row['class'];

              if ($lastname != $row['sname'])
              {
                if ($lastname == "")
                  $name = $row['sname'];
                else
                  $name .= "<br />" . $row['sname'];
              }

              $curr['name'] = $name;
              $lastname = $row['sname'];
            break;
            case "D":
            case "E": // electric - deliberate follow through
            
              if (!empty($row['works_num_a']))
                  $curr['works_num'] = $row['works_num_a'];

              if (!empty($row['b_date']))
                  $curr['b_date'] = fn_fdate($row['b_date']);
                  
              if (!empty($row['w_date']))
                  $curr['w_date'] = fn_fdate($row['w_date']);

              if (!empty($row['works_num_b']))
              {
                  if (!empty($row['works_num_a']))
                      $curr['works_num'] = $curr['works_num'] . '/' .$row['works_num_b'];
                  else
                      $curr['works_num'] = $row['works_num_b'];
              }

              $curr['horse_power'] = fn_ncomma($row['horse_power'], "hp");

              if ($row['carried_number'] == "N")
                $row['number'] = "<i>" . $row['number'] . "</i>";
              // print "Number Type for (" . $row['number'] .") is " . $row['number_type'] . "<br />";
              if (!empty($row['number_type']) && $nc)
              {
                $curr['number_type'] .= "<br />" . $row['number_type'];
                $curr['number'] .= "<br />" . $row['number'];
                //printf("Adding %s\n", $row['num_start_date']);
                $curr['num_start_date'] .= "<br />" . fn_fdate($row['num_start_date']);
              }
              else
              {
                $curr['number_type'] = $row['number_type'];
                $curr['number'] = $row['number'];
                //printf("</br >Starting %s\n", $row['num_start_date']);
                $curr['num_start_date'] = fn_fdate($row['num_start_date']);
              }

              if ($lastclass != $row['class'])
              {
                if ($lastclass == "")
                  $class = $row['class'];
                else
                  $class .= ", " . $row['class'];
              }

              $curr['class'] = $class;
              $lastclass = $row['class'];

              $name = "";
              if ($lastname != $row['name'])
              {
                if (empty($lastname))
                  $name = $row['name'];
                else
                  $name .= "<br />" . $row['name'];
                  
                $curr['name'] = $name;
              }

              $lastname = $row['name'];
              break;
            case "DMU":
            case "EMU": // Deliberate follow through
              break;
            default:
              print "Unknown option " . $row['type'];
              break;
          } // switch

          $lastid = $curr['id'];
        } // while

        // mop up
        $tb->add_data($curr); $allrows++;

        $tb->draw_table();
      }
    } // print this table
  } // loop three times

  $tbs->add_column("s_type",         "Type",        15);
  $tbs->add_column("s_code",         "Code",        10);
  $tbs->add_column("date1",          "From",        10);
  $tbs->add_column("date2",          "To",          10);
  $tbs->add_column("s_name",         "Name",        35);
  $tbs->add_column("s_company",      "Company",     20);

  $sql = 'SELECT     i.reporting_number,
                     i.details,
                     i.sdate_of_incident,
                     ig.ig_id,
                     ig.ig_title,
                     dn.number                  AS d_number,
                     en.number                  AS e_number,
                     sn.number                  AS s_number
          FROM       incidents i
          LEFT JOIN  incident_groups ig
          ON         ig.ig_id = i.ig_id

          LEFT JOIN  d_to_i d2i
          ON         d2i.inc_id = i.inc_id
          LEFT JOIN  d_nums dn
          ON         dn.loco_id = d2i.loco_id
          AND        dn.start_date = (SELECT max(dn1.start_date)
                                      FROM   d_nums dn1
                                      WHERE  dn1.loco_id = dn.loco_id
                                      AND    dn1.start_date <= i.sdate_of_incident)
          AND        dn.carried_number = "Y"

          LEFT JOIN  e_to_i e2i
          ON         e2i.inc_id = i.inc_id
          LEFT JOIN  e_nums en
          ON         en.loco_id = e2i.loco_id
          AND        en.start_date = (SELECT max(en1.start_date)
                                      FROM   e_nums en1
                                      WHERE  en1.loco_id = en.loco_id
                                      AND    en1.start_date <= i.sdate_of_incident)
          AND        en.carried_number = "Y"

          LEFT JOIN  s_to_i s2i
          ON         s2i.inc_id = i.inc_id
          LEFT JOIN  s_nums sn
          ON         sn.loco_id = s2i.loco_id
          AND        sn.start_date = (SELECT max(sn1.start_date)
                                      FROM   s_nums sn1
                                      WHERE  sn1.loco_id = sn.loco_id
                                      AND    sn1.start_date <= i.sdate_of_incident)
          AND        sn.carried_number = "Y"

          WHERE      i.details like "%' . $searchtext . '%"
          OR         i.reporting_number like "%' . $searchtext . '%"
          OR         ig.ig_title like "%' . $searchtext . '%"
          ORDER BY   i.sdate_of_incident';

  // //echo $sql;

  if ($exact == 0)
    $sql1 = 'like "%' .$searchtext. '%"';
  else
    $sql1 = '= "' .$searchtext. '"';

  $sql = 'SELECT      b.bl_code                 AS id,
                      NULL                      AS s_code,
                      NULL                      AS s_code_app,
                      b.bl_name                 AS s_name,
                      "Manufacturer"            AS s_type,
                      b.company                 AS s_company,
                      concat("sites.php?page=builders&subpage=main&id=", 
                             b.bl_code)         AS s_code_hl,
                      concat("sites.php?page=builders&subpage=main&id=", 
                             b.bl_code)         AS s_name_hl,
                      NULL                      AS date1,
                      NULL                      AS date1_fmt,
                      NULL                      AS date2,
                      NULL                      AS date2_fmt
          FROM        ref_builders b
          WHERE       b.bl_name ' . $sql1 . '
          UNION
          SELECT      sm.merchant_code          AS id,
                      NULL                      AS s_code,
                      NULL                      AS s_code_app,
                      concat(sm.merchant_name, " (",
                             sy.location, ")")  AS s_name,
                      "Scrapyard"               AS s_type,
                      sm.merchant_name          AS s_company,
                      concat("sites.php?page=scrapyards&subpage=main&id=", 
                             sy.scrapyard_code) AS s_code_hl,
                      concat("sites.php?page=scrapyards&subpage=main&id=", 
                             sy.scrapyard_code) AS s_name_hl,
                      NULL                      AS date1,
                      NULL                      AS date1_fmt,
                      NULL                      AS date2,
                      NULL                      AS date2_fmt
          FROM        ref_scrap_merchant sm
          JOIN        ref_scrapyard sy
          ON          sm.merchant_code = substr(sy.scrapyard_code, 1, 3)
          WHERE      (sm.merchant_name ' . $sql1 . '
                      OR
                      sy.location      ' . $sql1 . ')
          UNION
          SELECT      d.depot_id                AS id,
                      coalesce(dc.displayed_depot_code, dc.depot_code)
                                                AS s_code,
                      CASE WHEN INSTR(dc.depot_code, ".") = 0 THEN
                         ""
                        ELSE
                         " (Subshed)"
                      END                       AS s_code_app,
                      d.depot_name              AS s_name,
                      "Depot"                   AS s_type,
                      concat(d.prg_company, ",", d.big4_company) AS s_company,
                      concat("sites.php?page=depots&subpage=main&id=", 
                             d.depot_id)        AS s_code_hl,
                      concat("sites.php?page=depots&subpage=main&id=", 
                             d.depot_id)        AS s_name_hl,
                      dc.date_from              AS date1,
                      dc.date_from              AS date1_fmt,
                      dc.date_to                AS date2,
                      dc.date_to                AS date2_fmt
          FROM        ref_depot d
          LEFT JOIN   ref_depot_codes dc
          ON          dc.depot_id = d.depot_id
          WHERE      (d.depot_name ' . $sql1 . ')
          OR         (dc.depot_code ' . $sql1 . ')
          ORDER BY s_type, id, date1';

//  //echo $sql;

  $result = $db->execute($sql);
  $numrows= $db->count_select();

  if ($numrows == 0)
  {
    // echo "<i>No matches</i><br />";
  }
  else
  {
    echo "<br /><h5><strong>Sites: '" .$searchtext. "'</strong></h5><br />"; 

    while ($row = mysqli_fetch_assoc($result))
    {
      $row['date1'] = fn_fdate($row['date1']);
      $row['date2'] = fn_fdate($row['date2']);

      if (!empty($row['s_code_app']))
        $row['s_name'] .= $row['s_code_app'];

      $tbs->add_data($row); $allrows++;
    }

    $tbs->draw_table();
    echo "<br />";
  }

/******************************************************************************************/
/*                                         O R D E R S                                    */
/******************************************************************************************/

  $tbo->add_column("bl_name",         "Manufacturer",   15);
  $tbo->add_column("order_number",    "Order Number",   8);
  $tbo->add_column("order_date",      "Order Date",     11);
  $tbo->add_column("company",         "Company",        8);
  $tbo->add_column("class",           "Locomotive Class", 8);
  $tbo->add_column("designer",        "Designer",       12);
  $tbo->add_column("wheel_arr",       "Wheels",         8);
  $tbo->add_column("o_size",          "Order Size",     8);

  $sql = 'SELECT o.order_number,
                 o.order_date,
                 o.size AS o_size,
                 b.bl_name,
                 concat("sites.php?page=builders&subpage=orders&id=", 
                         b.bl_code, "&lot=", o.order_number) AS order_number_hl,
                 coalesce(sc.prg_company, sc.big4_company)   AS company,
                 p.surname                                   AS designer,
                 CASE WHEN o.type = "S" THEN
                        sc.wheel_arrangement
                      WHEN o.type = "D" THEN
                        dc.wheel_arrangement
                      WHEN o.type = "E" THEN
                        ec.wheel_arrangement
                 END AS wheel_arr,
                 CASE WHEN o.type = "S" THEN
                        concat("misc.php?page=wheelarr&id=", sc.wheel_arrangement)
                      WHEN o.type = "D" THEN
                        concat("misc.php?page=wheelarr&id=", dc.wheel_arrangement)
                      WHEN o.type = "E" THEN
                        concat("misc.php?page=wheelarr&id=", ec.wheel_arrangement)
                 END AS wheel_arr_hl,
                 CASE WHEN o.type = "S" THEN
                        sc.identifier
                      WHEN o.type = "D" THEN
                        dc.identifier
                      WHEN o.type = "E" THEN
                        ec.identifier
                 END AS class,
                 concat("locoqry.php?action=class&type=", o.type, "&id=", o.class_id) 
                                                             AS class_hl  
          FROM   ref_orders o
          JOIN   ref_builders b
          ON     o.bl_code = b.bl_code
          LEFT JOIN s_class sc
          ON     o.type = "S"
          AND    sc.s_class_id = o.class_id
          LEFT JOIN ref_people p
          ON     p.p_id = sc.designer_id
          LEFT JOIN d_class dc
          ON     o.type = "D"
          AND    dc.d_class_id = o.class_id
          LEFT JOIN e_class ec
          ON     o.type = "E"
          AND    ec.e_class_id = o.class_id
          WHERE  o.order_number ' . ($exact == 1 ? " = " : " like ") . ' ? 
          AND    o.virtual_ind = "N"
          ORDER BY o.order_number';
          
  $con = $db->get_connection();

  $stmt = mysqli_stmt_init($con);
  if ($stmt = mysqli_prepare($con, $sql))
  {
    $param = ($exact == 1 ? $searchtext : "%$searchtext%");

    if (!mysqli_stmt_bind_param($stmt, "s", $param))
      die("Error in stmt_bind_param: companies");

    if (!mysqli_stmt_execute($stmt))
      die("Error in stmt_execute: orders");
  
    if (!mysqli_stmt_bind_result($stmt, $order_number, $order_date, $o_size, $bl_name, $order_number_hl, $company, $designer, $wheel_arr, $wheel_arr_hl, $class, $class_hl))
      die("Error in stmt_bind_result: orders");
      
    // loop
    $row = array(); $x = 0;
    while (mysqli_stmt_fetch($stmt))
    {
      $x++;

      $row['order_number']    = $order_number;
      $row['order_date']      = fn_fdate($order_date);
      $row['o_size']          = $o_size;
      $row['bl_name']         = $bl_name;
      $row['order_number_hl'] = $order_number_hl;
      $row['company']         = $company;
      $row['designer']        = $designer;
      $row['wheel_arr']       = $wheel_arr;
      $row['wheel_arr_hl']    = $wheel_arr_hl;
      $row['class']           = $class;
      $row['class_hl']        = $class_hl;
 
      $tbo->add_data($row); $allrows++;
    }
  
    if ($x)
    {
      echo "<br /><h5><strong>Orders: '" .$searchtext. "'</strong></h5><br />"; 

      $tbo->draw_table();
      echo "<br />";
    }
  
    if ($stmt)
      mysqli_stmt_close($stmt);
  }

/******************************************************************************************/
/*                                      C O M P A N I E S                                 */
/******************************************************************************************/

  /* Companies */
  $tbc_so->add_column("cmp_initials",     "Company Initials",    8);
  $tbc_so->add_column("cmp_name",         "Company Name",       50);
  $tbc_so->add_column("cmp_incorporated", "Date Incorporated",  11);
  $tbc_so->add_column("cmp_amalgamated",  "Date Amalgamated",   11);

  $sql = 'SELECT c.cmp_initials,
                 concat("companies.php?page=", c.cmp_initials) AS cmp_initials_hl,
                 c.cmp_name,
                 c.cmp_incorporated,
                 c.cmp_amalgamated
          FROM   ref_companies c
          WHERE  c.cmp_initials ' . ($exact == 1 ? " = " : " like ") . ' ?
          OR     c.cmp_name     ' . ($exact == 1 ? " = " : " like ") . ' ? ';

  $con = $db->get_connection();

  $stmt = mysqli_stmt_init($con);
  if ($stmt = mysqli_prepare($con, $sql))
  {
    $param = ($exact == 1 ? $searchtext : "%$searchtext%");

    if (!mysqli_stmt_bind_param($stmt, "ss", $param, $param))
      die("Error in stmt_bind_param: companies");

    if (!mysqli_stmt_execute($stmt))
      die("Error in stmt_execute: companies");
  
    if (!mysqli_stmt_bind_result($stmt, $cmp_initials, $cmp_initials_hl, $cmp_name, $cmp_incorporated, $cmp_amalgamated))
      die("Error in stmt_bind_result: companies");
      
    // loop
    $row = array(); $x = 0;
    while (mysqli_stmt_fetch($stmt))
    {
      $x++;
      $row['cmp_initials']     = $cmp_initials;
      $row['cmp_initials_hl']  = $cmp_initials_hl;
      $row['cmp_name']         = $cmp_name;
      $row['cmp_incorporated'] = fn_fdate($cmp_incorporated);
      $row['cmp_amalgamated']  = fn_fdate($cmp_amalgamated);

      $tbc_so->add_data($row); $allrows++;
    }
  
    if ($x)
    {
      echo "<br /><h5><strong>Companies: '" .$searchtext. "'</strong></h5><br />"; 

      $tbc_so->draw_table();
      echo "<br />";
    }
 
    if ($stmt)
      mysqli_stmt_close($stmt);
  }

/******************************************************************************************/
/*                                              E N D                                     */
/******************************************************************************************/

  if ($allrows == 1)
    echo "<br />" . $allrows . " match<br />";
  else
    echo "<br />" . $allrows . " matches<br />";

?>

 
<?php endif; 
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

