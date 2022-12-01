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

<h3></h3>

<div class='featurebox_center'>

<?php
  require_once "lib/quickdb.class.php";
  require_once "lib/brlib.php";
  require_once "lib/MyTables.class.php";

  // 2 possible parameters
  //   page   <$page>   - subpage
  //   id     <$id>     - id of person

  
  $page = $id = "";

  foreach ($_GET as $key => $value)
  {
    // echo $key . ", " . $value . "<br />";
    if ($key == "page")
    {
      $page = $value;
      if (!empty($page))
        fn_check_alpha($page, 12);
    }
    else
    if ($key == "id")
    {
      $id = $value;
      if (!empty($id))
        fn_check_id($id, 500);
    }
    else
    if ($key == "fbclid")
    {
    }
    else
      fn_poem($key, $value, 99);
  }
  
  if (!empty($page))
  {
    if (strcmp($page, "cme") == 0)
    {
      $extra_sql = ' ';

      if (!empty($id))
        $extra_sql = ' AND p.p_id = ' . $id . ' ';

      $db = fn_connectdb();
      $tb = new MyTables("cme");
      $tb->sortable();

      $tb->add_caption("Chief Mechanical Engineers", NULL);
      $tb->add_column("full_name",           "Name",          14);
      $tb->add_column("birth",               "Date of Birth", 8);
      $tb->add_column("death",               "Date of Death", 8);
      $tb->add_column("role",                "Role",          5);
      $tb->add_column("companies",           "Company",       6);
      $tb->add_column("from",                "From",          8);
      $tb->add_column("to",                  "To",            8);
      $tb->add_column("locomotives",         "Loco Classes",  39);
      $tb->add_column("link",                "Bio",           4);
   
      $sql = 'SELECT p.p_id,
                     p.surname,
                     p.middle_names,
                     p.forename,
                     p.title,
                     p.born                                        AS birth,
                     date_format(p.born, "%Y%m%d") AS birth_fmt,
                     p.died                                        AS death,
                     date_format(p.died, "%Y%m%d") AS death_fmt,
                     c.cmp_initials,
                     cme.date_from,
                     cme.date_to,
                     sc.s_class_id,
                     sc.identifier,
                     sc.common_name,
                     sc.wheel_arrangement,
                     sc.year_introduced,
                     rl.role_code                  AS role_desc,
                     p.www_link,
                     coalesce(coalesce(sc.prg_company, sc.big4_company)) AS cmp
              from   ref_people p
              join   ref_cme cme
              on     cme.p_id = p.p_id
              join   ref_companies c
              on     c.cmp_id = cme.cmp_id
              join   s_class sc
              on     sc.designer_id = p.p_id
              JOIN   ref_role rl
              ON     rl.role_code = p.role
              WHERE  rl.role_group = 1 ' . $extra_sql . '
              order by p.surname, p.p_id, cme.date_from, sc.year_introduced, sc.identifier';
              
  // echo $sql;

      // SELECT p.p_id, p.surname, p.middle_names, p.forename, p.title, p.born AS birth, date_format(p.born, "%Y%m%d") AS birth_fmt, p.died AS death, date_format(p.died, "%Y%m%d") AS death_fmt, 
      //        c.cmp_initials, cme.date_from, cme.date_to, sc.s_class_id, sc.identifier, sc.common_name, sc.wheel_arrangement, scc1.s_class_code AS orig_class_code, scc1.company AS orig_company,
      //        scc2.s_class_code AS later_class_code, scc2.company AS later_company, sc.year_introduced, rl.role_code AS role_desc, p.www_link, coalesce(coalesce(sc.prg_company, sc.big4_company)) AS cmp
      //FROM    ref_people p 
      //JOIN    ref_cme on cme.p_id = p.p_id 
      //JOIN    ref_companies c on c.cmp_id = cme.cmp_id
      //JOIN    s_class sc on sc.designer_id = p.p_id
      //left join s_class_codes scc1 on scc1.s_class_id = sc.s_class_id and scc1.company = c.cmp_initials
      //left join s_class_codes scc2 on scc2.s_class_id = scc1.s_class_id and scc2.company <> scc1.company
      //JOIN    ref_role rl ON rl.role_code = p.role
      //WHERE   rl.role_group = 1
      //order by p.surname, p.p_id, cme.date_from, sc.year_introduced, sc.identifier
      
      $result = $db->execute($sql); 

      $ct = 0; $rowx = array(); $lid = -1;

      while ($row = mysqli_fetch_assoc($result))
      {
        if ($ct && $lid != $row['p_id'])
        {
          /* Dump data */
          $tb->add_data($rowx);
          $rowx = array();
        }

        if (empty($rowx['full_name']))
        {
          $rowx['full_name'] = $row['surname'];
          if (!empty($row['forename']))
          {
            if (!empty($row['title']))
              $rowx['full_name'] .= ", " . $row['title'] . " " . $row['forename'];
            else
              $rowx['full_name'] .= ", " . $row['forename'];
            
            if (!empty($row['middle_names']))
              $rowx['full_name'] .= " " . $row['middle_names'];
          }

          $rowx['birth']     = fn_fdate($row['birth']);
          $rowx['birth_fmt'] = $row['birth_fmt'];
          $rowx['death']     = fn_fdate($row['death']);
          $rowx['death_fmt'] = $row['death_fmt'];

          $rowx['role']      = $row['role_desc'];
        }

        if (empty($rowx['link']) && !empty($row['www_link']))
          $rowx['link'] = sprintf("<a href=\"javascript:void(0)\" 
                                   onClick=\"window.open('%s')\">Link</a>", $row['www_link']);

        if (!empty($rowx['companies']) && !empty($row['cmp_initials']))
        {
          if (strcmp($row['cmp_initials'], $cmp) != 0)
          {
            $rowx['companies'] .= "<br />" . $row['cmp_initials'];
            $rowx['from'] = fn_fdate($row['date_from']);
            $rowx['to']   = fn_fdate($row['date_to']);
          }
        }
        else
        {
          $rowx['companies'] .= $row['cmp_initials'];
        }

        if (!empty($row['identifier']) && strcmp($row['cmp'], $row['cmp_initials']) == 0)
        {
          $class_string = "";

          if ($row['br_standard'] == "Y")
            $class_string = "BR";
          else
          {
            if (!empty($row['cmp']))
              $class_string = $row['cmp'];
          }

          if (!empty($class_string))
            $class_string .= " ";

          $class_string .= $row['identifier'] . " ";

          if (!empty($row['wheel_arrangement']))
            $class_string .= $row['wheel_arrangement'] . " ";

          if (!empty($row['common_name']))
            $class_string .= "'" . $row['common_name'] . "' ";

          if (!empty($row['year_introduced']))
            $class_string .= "(" . $row['year_introduced'] . ") ";

          if (!empty($rowx['locomotives']))
            $rowx['locomotives'] .= "<br />" . 
                                    "<a href=\"locoqry.php?action=class&type=S&id=" . 
                                    $row['s_class_id'] .
                                    "\">" . $class_string . "</a>";
          else
            $rowx['locomotives'] = "<a href=\"locoqry.php?action=class&type=S&id=" . 
                                    $row['s_class_id'] . 
                                    "\">" . $class_string . "</a>";
        }
       

        $ct++;
        $lid = $row['p_id'];
        $cmp = $row['cmp_initials'];
      }

      if ($ct)
      {
        $tb->add_data($rowx);
        $tb->draw_table();
      }
    }
  }
?>
</form>
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

