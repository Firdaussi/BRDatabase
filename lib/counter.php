<?php
include_once "brlib.php";
include_once "quickdb.class.php";
/*
Counter Information

Website: http://www.free-php-counter.com/
Version: Mysql version

Installation help:

http://www.free-php-counter.com/mysql-counter.php


You like to remove the link on the counter? Click here and get an link free license:

http://www.free-php-counter.com/adfree_counter.php
*/


// edit counter settings here


// database configuration
$counter_host = "localhost";
$counter_user = "brdataba_log";
$counter_password = "D813D!adem";
$counter_database = "brdataba_log";

// http path to the folder containing counter.php and counter.gif (do not forget the / at the end)
// set http://www.your-homepage.com/ when the counter is in root dir
$counter_path_http = "lib/";

// ip-protection in seconds
$counter_expire = 600;

// do not edit from here

// connect to database
$counter_connected = true;
/*
$link = @mysqli_connect($counter_host, $counter_user, $counter_password);
if (!$link) 
{
 	// can't connect to database
	$counter_connected = false;
	echo "Counter: " . mysqli_error();
}
else
{
	// select database
	$db_selected = @mysqli_select_db($counter_database, $link);
	if (!$db_selected) 
	{
		// can't select database
		$counter_connected = false;
		echo "Counter: " . mysqli_error();
	}
}
*/

if ($counter_connected == true) 
{
   $ignore = false; 
   $db = fn_connectdb("2");

   // get counter information
   $sql = "select * from counter_values";
   $res = $db->execute($sql);
   
   // fill when empty
   if (mysqli_num_rows($res) == 0)
   {	  
	  $sql = "INSERT INTO `counter_values` (`id`, `day_id`, `day_value`, `yesterday_id`, `yesterday_value`, `week_id`, `week_value`, `month_id`, `month_value`, `year_id`, `year_value`, `all_value`, `record_date`, `record_value`) VALUES ('1', '" . date("z") . "',  '1', '" . (date("z")-1) . "', '0', '" . date("W") . "', '1', '" . date("n") . "', '1', '" . date("Y") . "',  '1',  '1',  NOW(),  '1')";
	  $res = $db->execute($sql);

	  $sql = "select * from counter_values";
    $res = $db->execute($sql);
	  
	  $ignore = true;
   }   
   $row = mysqli_fetch_assoc($res);
   
   $day_id = $row['day_id'];
//echo "day_id <br />";
   $day_value = $row['day_value'];
   $yesterday_id = $row['yesterday_id'];
   $yesterday_value = $row['yesterday_value'];
   $week_id = $row['week_id'];
   $week_value = $row['week_value'];
   $month_id = $row['month_id'];
   $month_value = $row['month_value'];
   $year_id = $row['year_id'];
   $year_value = $row['year_value'];
   $all_value = $row['all_value'];
   $record_date = $row['record_date'];
   $record_value = $row['record_value'];
   
   $counter_agent = (isset($_SERVER['HTTP_USER_AGENT'])) ? addslashes(trim($_SERVER['HTTP_USER_AGENT'])) : "";
   $counter_time = time();
   $counter_ip = trim(addslashes($_SERVER['REMOTE_ADDR'])); 
   
   // ignorore some bots
   if (substr_count($counter_agent, "bot") > 0)
      $ignore = true;
      
   // delete free ips
   if ($ignore == false)
   {
      $sql = "delete from counter_ips where unix_timestamp(NOW())-unix_timestamp(visit) > $counter_expire"; 
      $res = $db->execute($sql);
   }
      
   // check for entry
   if ($ignore == false)
   {
      $sql = "select * from counter_ips where ip = '$counter_ip'";
      $res = $db->execute($sql);
      if (mysqli_num_rows($res) == 0)
      {
         // insert
	     $sql = "INSERT INTO counter_ips (ip, visit) VALUES ('$counter_ip', NOW())";
   	     $res = $db->execute($sql);
      }
      else
      {
         $ignore = true;
	     $sql = "update counter_ips set visit = NOW() where ip = '$counter_ip'";
	     $res = $db->execute($sql);
      }
   }
   
   // online?
   $sql = "select * from counter_ips";
   $res = $db->execute($sql);
   $online = mysqli_num_rows($res);
      
   // add counter
   if ($ignore == false)
   {     	  
      // yesterday
	  if ($day_id == (date("z")-1)) 
	  {
	     $yesterday_value = $day_value; 
		 $yesterday_id = (date("z")-1);
	  }
	  else
	  {
	     if ($yesterday_id != (date("z")-1))
		 {
		    $yesterday_value = 0; 
		    $yesterday_id = date("z")-1;
		 }
	  }
	  
	  // day
	  if ($day_id == date("z")) 
	  {
	     $day_value++; 
	  }
	  else 
	  {
	     $day_value = 1;
		 $day_id = date("z");
	  }
	  
	  // week
	  if ($week_id == date("W")) 
	  {
	     $week_value++; 
	  }
	  else 
	  { 
	     $week_value = 1;
		 $week_id = date("W");
      }
	  
      // month
	  if ($month_id == date("n")) 
	  {
	     $month_value++; 
	  }
	  else 
	  {
	     $month_value = 1;
		 $month_id = date("n");
      }
	  
	  // year
	  if ($year_id == date("Y")) 
	  {
	     $year_value++; 
	  }
	  else 
	  {
	     $year_value = 1;
		 $year_id = date("Y");
      }
	  
	  // all
	  $all_value++;
		 
	  // neuer record?
	  if ($day_value > $record_value)
	  {
	     $record_value = $day_value;
	     $record_date = date("Y-m-d H:i:s");
	  }
		 
	  // speichern und aufräumen
	  $sql = "update counter_values set day_id = '$day_id', day_value = '$day_value', yesterday_id = '$yesterday_id', yesterday_value = '$yesterday_value', week_id = '$week_id', week_value = '$week_value', month_id = '$month_id', month_value = '$month_value', year_id = '$year_id', year_value = '$year_value', all_value = '$all_value', record_date = '$record_date', record_value = '$record_value' where id = 1";
	  $res = $db->execute($sql);  
   }	  
?>
<table cellpadding="1" cellspacing="0" style="border:1px solid #000000">
  <tr> 
    <td width="150">
      <b><font face="Arial, Helvetica, sans-serif" size="2"><a href="http://www.compredia.co.uk/" target="_blank"><img src="<?php echo $counter_path_http; ?>counter.gif" alt="Ad" width="16" height="16" border="0" /></a> Visitor Statistics</font></b>
    </td>
  </tr>
  <tr> 
    <td style="border-top:1px solid #000000"> 
      <font face="Arial, Helvetica, sans-serif" size="1">
      &raquo; <?php echo $online; ?> Online<br />
      &raquo; <?php echo $day_value; ?> Today<br />
      &raquo; <?php echo $yesterday_value; ?> Yesterday<br />
	    &raquo; <?php echo $week_value; ?> Week<br />
	    &raquo; <?php echo $month_value; ?> Month<br />
	    &raquo; <?php echo $year_value; ?> Year<br />
      &raquo; <?php echo $all_value; ?> Total
      </font>
    </td>
  </tr> 
  <tr> 
    <td style="border-top:1px solid #000000" width="150" align="center">
      <font face="Arial, Helvetica, sans-serif" size="1">
      Record: <?php echo $record_value; ?> (<?php echo date("d/m/Y", strtotime($record_date)) ?>)<br />
      (<a href="http://www.free-php-couter.com/mysql-counter.php" target="_blank">Free MySQL Counter</a>)
      </font>
    </td>
  </tr> 
</table>
<?php
}
?>