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

<h3>Generate an ABC...</h3>

<div class='featurebox_center'>

<?php
  $myfile = fopen("tcpdf/examples/data/depots.txt", "w");

  require_once "lib/quickdb.class.php";
  require_once "lib/MyTables.class.php";  
  require_once "lib/brlib.php";
  
  $date = $year . '-' . $month . '-' . '31';
  $date = "1953-10-31";
  $enddate = "2999-01-01";

  $db = fn_connectdb();
  
  $sql = 'SELECT dp.depot_name,
                 coalesce(dpc.displayed_depot_code, dpc.depot_code) AS uncasted_column,
                 CAST(coalesce(dpc.displayed_depot_code, dpc.depot_code) as SIGNED) AS casted_column
                 
          FROM   ref_depot dp
          JOIN   ref_depot_codes dpc
          ON     dpc.depot_id = dp.depot_id
          
          WHERE  ? between dpc.date_from AND ifnull(dpc.date_to, ?)
          AND    coalesce(dpc.displayed_depot_code, dpc.depot_code) between 1 AND 89
          
          ORDER BY casted_column ASC, uncasted_column ASC';

  $con = $db->get_connection();
  $stmt = mysqli_stmt_init($con);
  if ($stmt = mysqli_prepare($con, $sql))
  {
    if (!mysqli_stmt_bind_param($stmt, "ss", $date, $enddate))
      exit;

    if (!mysqli_stmt_execute($stmt))
      exit;
  
    if (!mysqli_stmt_bind_result($stmt, $depot_name, $uncasted_column, $casted_column))
      exit;
      
    // loop
    $x = 0;
    while (mysqli_stmt_fetch($stmt))
    {
      if (strstr($depot_name, "&amp;"))
        $depot_name = str_replace("&amp;", "&", $depot_name);

      $words = preg_replace('/[0-9]+/', '', $uncasted_column);
      if (ctype_lower($words))
      {
        $uncasted_column = strtoupper($uncasted_column);
        $txt = sprintf("%4s(sub) %s\n", $uncasted_column, $depot_name);
      }
      else
        $txt = sprintf("%4s      %s\n", $uncasted_column, $depot_name);
      //echo $txt;
      
      if ($x != $casted_column)
      switch ($casted_column)
      {
        case 1:
          fwrite($myfile, "London Midland Region\n\n");
          break;
          
        case 30:
          fwrite($myfile, "\nEastern Region\n\n");
          break;
          
        case 50:
          fwrite($myfile, "\nNorth Eastern Region\n\n");
          break;
          
        case 60:
          fwrite($myfile, "\nScottish Region\n\n");
          break;
          
        case 70:
          fwrite($myfile, "\nSouthern Region\n\n");
          break;
          
        case 81:
          fwrite($myfile, "\nWestern Region\n\n");
          break;
          
        default:
          break;
      }
      
      $x = $casted_column;
      
      fwrite($myfile, $txt);
    }
    
    fclose($myfile);
  
    if ($stmt)
      mysqli_stmt_close($stmt);
  }


  $cmp = array("GWR", "SR", "LMS", "LNER", "BR", "WD");

  foreach ($cmp as $val)
  {

  /* now for the classes */
  $f = sprintf("tcpdf/examples/data/s_%s_classes.html", $val);
  $myfile = fopen($f, "w");
  //fwrite($myfile, "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n");
  //fwrite($myfile, "<html xmlns=\"www.w3.org/1999/xhtml\">\n");

  //fwrite($myfile, "<head><title></title></head><body>
  
  $date = $year . '-' . $month . '-' . '31';
  $date = "1953-10-31";
  
  $sql = 'select s.loco_id,
                 sa2.allocation,
                 sn.number         AS curr_number,
                 sn.number_type    AS curr_number_type,
                 F.s_class_id,
                 F.identifier
                   
            from   steam s
            join (
                    select scl.loco_id,
                           max(concat(sa.alloc_date, seq)) AS alloc_dt,
                           sc.identifier,
                           scl.s_class_id,
                           scl.s_class_var_id
                    from   s_class sc
                    join   s_class_link scl
                    on     scl.s_class_id = sc.s_class_id

                    left join s_alloc sa
                    on     sa.loco_id = scl.loco_id
                    and    sa.alloc_date <= ?
                    where  sc.big4_company = ? or (? = "BR" and sc.br_standard = "Y")
                    group by scl.loco_id
            ) as F
            on F.loco_id = s.loco_id
            
            LEFT JOIN s_alloc sa2
            ON     sa2.loco_id = s.loco_id
            AND    concat(sa2.alloc_date, seq) = F.alloc_dt

            LEFT JOIN s_nums sn
            ON     sn.loco_id = s.loco_id
            AND    sn.start_date = (SELECT max(sna.start_date)
                                    FROM   s_nums sna
                                    WHERE  sna.loco_id = sn.loco_id
                                    AND    sna.start_date <= ?)

            LEFT JOIN ref_depot_codes dcc
            ON     dcc.depot_code = sa2.allocation
            AND    sa2.alloc_date between dcc.date_from and ifnull(dcc.date_to, ?)

            LEFT JOIN ref_depot dp
            ON     dp.depot_id = dcc.depot_id

            LEFT JOIN s_nums sn2
            ON     sn2.loco_id = s.loco_id
            AND    sn2.start_date = s.b_date
            
            WHERE ? BETWEEN s.b_date AND ifnull(s.w_date, ?)
            
            ORDER BY F.s_class_id, sn.number';

  mysqli_stmt_init($con);
  if ($stmt = mysqli_prepare($con, $sql))
  {
    if (!mysqli_stmt_bind_param($stmt, "sssssss", $date, $val, $val, $date, $enddate, $date, $enddate))
      exit;

    if (!mysqli_stmt_execute($stmt))
      exit;
  
    if (!mysqli_stmt_bind_result($stmt, $loco_id, $allocation, $curr_number, $curr_number_type, $d_class_id, $identifier))
      exit;
      
    // loop
    $x = 0; $buf = ""; $class = 0; $id = ""; $flag = ' '; $change_of_class = 0; $last_class = 0;
    while (mysqli_stmt_fetch($stmt))
    {
      if ($last_class != 0 && $last_class != $d_class_id)
        $change_of_class = 1;
      else
        $change_of_class = 0;
        
      // If it is a change of class, dump anything in previous buffer, then load data for new class info
      if ($change_of_class)
      {
        // array contains all data for locos - find how many there are so we can construct the table in rows of 10
        $ct = count($locos);
        
        $ct1 = (int)($ct / 10);
        
        if ($ct % 10 != 0)
          $ct1++;
          
        $ct2 = $ct % 10;
          
        // $ct is the total numer of locos for this class, e.g. Class 47: 512
        // $ct1 is the number of rows in the table, e.g. 52
        // $ct2 is the modulus by 10, e.g. 2. This gives us the number of columns
        //      in the last row that need to be populated.

        // Loop through every element of table, whether it contains a loco or not
        for ($a = 0, $x = 0; $a < ($ct1*10); $a++)
        {
          if ($a && $a % $ct1 == 0)
            $x = 0; // reset
            
          if ($a < $ct1)
            $row[$x] = "\n<tr>";
          
          if ($a < $ct)
          {
            $str = sprintf("%5s%1s&nbsp;%3s", $locos[$a], $flag == ' ' ? '&nbsp;' : $flag, $alloc[$a]);
            $str = str_replace(" ", "&nbsp;", $str);
          }
          else
            $str = "&nbsp;";
            
          $row[$x] .= "<td>" . $str . "</td>";
        
          if ($a >= ($ct1*9))
            $row[$x] .= "</tr>\n";
        
          $x++;
        }
        
        fwrite($myfile, "<table class=\"pdf_locos\">");
        for ($a = 0; $a < $ct1; $a++)
        {
          fwrite($myfile, $row[$a]);
        }
        
        $str = sprintf("</table><br /><br />Total: %d<br /><br /><br /><br />", $ct);
        fwrite($myfile, $str);
        $locos = "";
        $alloc = "";
      }
      
      $locos[] = $curr_number;
      $alloc[] = $allocation;
      $last_class = $d_class_id;
      $id = $identifier;
    }
  
    fwrite($myfile, "</body></html>");
    fclose($myfile);

    if ($stmt)
      mysqli_stmt_close($stmt);
  }
}

  $myfile = fopen("tcpdf/examples/data/d_classes.html", "w");
  fwrite($myfile, "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n");
  fwrite($myfile, "<html xmlns=\"www.w3.org/1999/xhtml\">\n");

  fwrite($myfile, "<head><title></title></head><body>\n");
  
  /* DIESELS */

  $sql = 'select d.loco_id,
                 da2.allocation,
                 dn.number         AS curr_number,
                 dn.number_type    AS curr_number_type,
                 F.d_class_id,
                 F.identifier
                   
            from   diesels d
            join (
                    select dcl.loco_id,
                           max(concat(da.alloc_date, seq)) AS alloc_dt,
                           dc.identifier,
                           dcl.d_class_id,
                           dcl.d_class_var_id
                    from   d_class dc
                    join   d_class_link dcl
                    on     dcl.d_class_id = dc.d_class_id

                    left join d_alloc da
                    on     da.loco_id = dcl.loco_id
                    and    da.alloc_date <= ?
                    group by dcl.loco_id
            ) as F
            on F.loco_id = d.loco_id
            
            LEFT JOIN d_alloc da2
            ON     da2.loco_id = d.loco_id
            AND    concat(da2.alloc_date, seq) = F.alloc_dt

            LEFT JOIN d_nums dn
            ON     dn.loco_id = d.loco_id
            AND    dn.start_date = (SELECT max(dna.start_date)
                                    FROM   d_nums dna
                                    WHERE  dna.loco_id = dn.loco_id
                                    AND    dna.start_date <= ?)

            LEFT JOIN ref_depot_codes dcc
            ON     dcc.depot_code = da2.allocation
            AND    da2.alloc_date between dcc.date_from and ifnull(dcc.date_to, ?)

            LEFT JOIN ref_depot dp
            ON     dp.depot_id = dcc.depot_id

            LEFT JOIN d_nums dn2
            ON     dn2.loco_id = d.loco_id
            AND    dn2.start_date = d.b_date
            
            WHERE ? BETWEEN d.b_date AND ifnull(d.w_date, ?)
            
            ORDER BY F.d_class_id, d.loco_id';

  mysqli_stmt_init($con);

  if ($stmt = mysqli_prepare($con, $sql))
  {
    if (!mysqli_stmt_bind_param($stmt, "sssss", $date, $date, $enddate, $date, $enddate))
      exit;

    if (!mysqli_stmt_execute($stmt))
      exit;
  
    if (!mysqli_stmt_bind_result($stmt, $loco_id, $allocation, $curr_number, $curr_number_type, $d_class_id, $identifier))
      exit;
      
    // loop
    $x = 0; $buf = ""; $class = 0; $id = ""; $flag = ' '; $change_of_class = 0; $last_class = 0;
    while (mysqli_stmt_fetch($stmt))
    {
      if ($last_class != 0 && $last_class != $d_class_id)
        $change_of_class = 1;
      else
        $change_of_class = 0;
        
      // If it is a change of class, dump anything in previous buffer, then load data for new class info
      if ($change_of_class)
      {
        // array contains all data for locos - find how many there are so we can construct the table in rows of 10
        $ct = count($locos);
        
        $ct1 = (int)($ct / 10);
        
        if ($ct % 10 != 0)
          $ct1++;
          
        $ct2 = $ct % 10;
          
        // $ct is the total numer of locos for this class, e.g. Class 47: 512
        // $ct1 is the number of rows in the table, e.g. 52
        // $ct2 is the modulus by 10, e.g. 2. This gives us the number of columns
        //      in the last row that need to be populated.

        // Loop through every element of table, whether it contains a loco or not
        for ($a = 0, $x = 0; $a < ($ct1*10); $a++)
        {
          if ($a && $a % $ct1 == 0)
            $x = 0; // reset
            
          if ($a < $ct1)
            $row[$x] = "\n<tr>";
          
          if ($a < $ct)
          {
            $str = sprintf("%5s%1s&nbsp;%3s", $locos[$a], $flag == ' ' ? '&nbsp;' : $flag, $alloc[$a]);
            $str = str_replace(" ", "&nbsp;", $str);
          }
          else
            $str = "&nbsp;";
            
          $row[$x] .= "<td>" . $str . "</td>";
        
          if ($a >= ($ct1*9))
            $row[$x] .= "</tr>\n";
        
          $x++;
        }
        
        fwrite($myfile, "<table class=\"pdf_locos\">");
        for ($a = 0; $a < $ct1; $a++)
        {
          fwrite($myfile, $row[$a]);
        }
        
        $str = sprintf("</table><br /><br />Total: %d<br /><br /><br /><br />", $ct);
        fwrite($myfile, $str);
        $locos = "";
        $alloc = "";
      }
      
      $locos[] = $curr_number;
      $alloc[] = $allocation;
      $last_class = $d_class_id;
      $id = $identifier;
    }
    
    fwrite($myfile, "</body></html>");
    fclose($myfile);
  
    if ($stmt)
      mysqli_stmt_close($stmt);
  }



?>

<a href="tcpdf/examples/example_010.php">Link</a>
<!--
<a href="tcpdf/examples/example_010.php">Link</a>
-->







</div>
<br />

</div><!-- end content -->

<div id="footer">

  <a href="index.php">Home</a> |
  <a href="lazarus/index.php">Guestbook</a> |
  <a href="contact.php">Contact</a> |
  <a href="links.php">Links</a> |
  <a href="preferences.php">Preferences</a><br />
<?php printf("Website Copyright(C) 2010-%d BRDatabase.info<br />", date("Y")); ?>

</div><!-- end footer -->

</div><!-- end page_wrapper -->

</body>

</html>

