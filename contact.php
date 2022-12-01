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
<li id="active"><a href="#" id="current">Contact</a></li>
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
/*******************************************************************************
*  Title: Easy PHP Contact Form
*  Version: 1.3 @ October 23, 2009
*  Author: Vishal P. Rao
*  Website: www.easyphpcontactform.com
********************************************************************************
*  COPYRIGHT NOTICE
*  Copyright 2009 Vishal P. Rao. All Rights Reserved.
*
*  This script may be used and modified free of charge by anyone
*  AS LONG AS COPYRIGHT NOTICES AND ALL THE COMMENTS REMAIN INTACT.
*  By using this code you agree to indemnify Vishal P. Rao or 
*  www.easyphpcontactform.com from any liability that might arise from 
*  it's use.
*
*  Selling the code for this program, in part or full, without prior
*  written consent is expressly forbidden.
*
*  Obtain permission before redistributing this software over the Internet
*  or in any other medium. In all cases copyright and header must remain
*  intact. This Copyright is in full effect in any country that has
*  International Trade Agreements with the India
*
*  Removing any of the copyright notices without purchasing a license
*  is illegal! 
*******************************************************************************/

/*******************************************************************************
 *	Script configuration - Refer README.txt
*******************************************************************************/

/* Email address where the messages should be delivered */
$to = 'thebrdatabase@gmail.com';

/* From email address, in case your server prohibits sending emails from addresses other than those of 
your 
own domain (e.g. email@yourdomain.com). If this is used then all email messages from your contact form 
will appear 
from this address instead of actual sender. */
$from = '';

/* This will be appended to the subject of contact form message */
$subject_prefix = 'BRDataBase Message';

/* Form header file */
$header_file = 'includes/form-header.php';

/* Form footer file */
$footer_file = 'includes/form-footer.php';

/* Form width in px or % value */
$form_width = '70%';

/* Form background color */
$form_background = '#F7F8F7';

/* Form border color */
$form_border_color = '#CCCCCC';

/* Form border width */
$form_border_width = '1px';

/* Form border style. Examples - dotted, dashed, solid, double */
$form_border_style = 'solid';

/* Form cell padding */
$cell_padding = '5px';

/* Form left column width */
$left_col_width = '25%';

/* Form font size */
$font_size = '12px';

/* Empty/Invalid fields will be highlighted in this color */
$field_error_color = '#FF0000';

/* Thank you message to be displayed after the form is submitted. Can include HTML tags. Write your 
message 
between <!-- Start message --> and <!-- End message --> */
$thank_you_message = <<<EOD
<!-- Start message -->
<p>I have received your message. If required, I'll get back to you as soon as possible.</p><br /><br 
/><br /><br /><br /><br /><br /><br />
<!-- End message -->
EOD;

/* URL to be redirected to after the form is submitted. If this is specified, then the above message 
will 
not be shown and user will be redirected to this page after the form is submitted */
/* Example: $thank_you_url = 'www.yourwebsite.com/thank_you.html'; */

$thank_you_url = '';

/*******************************************************************************
 *	Do not change anything below, unless of course you know very well 
 *	what you are doing :)
*******************************************************************************/

$name = array('Name','name',NULL,NULL);
$email = array('Email','email',NULL,NULL,NULL);
$subject = array('Subject','subject',NULL,NULL);
$message = array('Message','message',NULL,NULL);
$code = array('Code','captcha_code',NULL,NULL,NULL);

$error_message = '';

if (!isset($_POST['submit'])) {

  showForm();

} else { //form submitted

  $error = 0;
  
  if(!empty($_POST['name'])) {
  	$name[2] = clean_var($_POST['name']);
  }
  else {
    $error = 1;
    $name[3] = 'color:#FF0000;';
  }
  
  if(!empty($_POST['email'])) {
  	$email[2] = clean_var($_POST['email']);
  	if (!validEmail($email[2])) {
  	  $error = 1;
  	  $email[3] = 'color:#FF0000;';
  	  $email[4] = '<strong><span style="color:#FF0000;">Invalid email</span></strong>';
	  }
  }
  else {
    $error = 1;
    $email[3] = 'color:#FF0000;';
  }
  
  if(!empty($_POST['subject'])) {
  	$subject[2] = clean_var($_POST['subject']);
  	if (function_exists('htmlspecialchars')) $subject[2] = htmlspecialchars($subject[2], 
ENT_QUOTES);  	
  }
  else {
  	$error = 1;
    $subject[3] = 'color:#FF0000;';
  }  

  if(!empty($_POST['message'])) {
  	$message[2] = clean_var($_POST['message']);
  	if (function_exists('htmlspecialchars')) $message[2] = htmlspecialchars($message[2], 
ENT_QUOTES);
  }
  else {
    $error = 1;
    $message[3] = 'color:#FF0000;';
  }    

  if(empty($_POST['captcha_code'])) {
    $error = 1;
    $code[3] = 'color:#FF0000;';
  } else {
  	include_once "includes/securimage.php";
		$securimage = new Securimage();
    $valid = $securimage->check($_POST['captcha_code']);

    if(!$valid) {
      $error = 1;
      $code[3] = 'color:#FF0000;';   
      $code[4] = '<strong><span style="color:#FF0000;">Incorrect code</span></strong>';
    }
  }

  if ($error == 1) {
    $error_message = '<span style="font-weight:bold;font-size:90%;">Please correct/enter field(s) in 
red.</span>';

    showForm();

  } else {
  	
  	if (function_exists('htmlspecialchars_decode')) $subject[2] = 
htmlspecialchars_decode($subject[2], ENT_QUOTES);
  	if (function_exists('htmlspecialchars_decode')) $message[2] = 
htmlspecialchars_decode($message[2], ENT_QUOTES);  	
  	
    $body = "$name[0]: $name[2]\r\n";
    $body .= "$email[0]: $email[2]\r\n\r\n";
    $body .= "$message[0]:\r\n$message[2]\r\n";
    
    if (!$from) $from_value = $email[2];
    else $from_value = $from;
    
    $headers = "From: $from_value" . "\r\n";
    $headers .= "Reply-To: $email[2]" . "\r\n";
    
    mail($to,"$subject_prefix - $subject[2]", $body, $headers);
    
    if (!$thank_you_url) {
    
      include $header_file;
      echo $GLOBALS['thank_you_message'];
      echo "\n";
      include $footer_file;
	  }
	  else {
	  	header("Location: $thank_you_url");
	  }
       	
  }

} //else submitted



function showForm()

{
global $name, $email, $subject, $message, $code, $header_file, $footer_file, $form_width, 
$form_background, $form_border_color, $form_border_width, $form_border_style, $cell_padding, 
$left_col_width, $font_size; 	
include $header_file;
echo $GLOBALS['error_message'];  
echo <<<EOD

<form method="post" class="cForm">
<table style="width:{$form_width}; background-color:{$form_background}; border:{$form_border_width} 
{$form_border_style} {$form_border_color}; padding:10px; font-size:{$font_size};" class="contactForm">
<tr>
<td style="width:{$left_col_width}; text-align:left; vertical-align:top; padding:{$cell_padding}; 
font-weight:bold; {$name[3]}">{$name[0]}</td>
<td style="text-align:left; vertical-align:top; padding:{$cell_padding};"><input type="text" 
name="{$name[1]}" value="{$name[2]}" maxlength="75"/></td>
</tr>
<tr>
<td style="width:{$left_col_width}; text-align:left; vertical-align:top; padding:{$cell_padding}; 
font-weight:bold; {$email[3]}">{$email[0]}</td>
<td style="text-align:left; vertical-align:top; padding:{$cell_padding};"><input type="text" 
name="{$email[1]}" value="{$email[2]}" maxlength="125"/> {$email[4]}</td>
</tr>
<tr>
<td style="width:{$left_col_width}; text-align:left; vertical-align:top; padding:{$cell_padding}; 
font-weight:bold; {$subject[3]}">{$subject[0]}</td>
<td style="text-align:left; vertical-align:top; padding:{$cell_padding};"><input type="text" 
name="{$subject[1]}" value="{$subject[2]}" size="40" maxlength="150"/></td>
</tr>
<tr>
<td style="width:{$left_col_width}; text-align:left; vertical-align:top; padding:{$cell_padding}; 
font-weight:bold; {$message[3]}">{$message[0]}</td>
<td style="text-align:left; vertical-align:top; padding:{$cell_padding};"><textarea 
name="{$message[1]}" cols="40" rows="6">{$message[2]}</textarea></td>
</tr>
<tr>
<td style="width:{$left_col_width}; text-align:left; vertical-align:top; 
padding:{$cell_padding};">&nbsp;</td>
<td style="text-align:left; vertical-align:top; padding:{$cell_padding};"><img id="captcha" 
src="includes/securimage_show.php" alt="CAPTCHA Image" /></td>
</tr>
<tr>
<td style="width:{$left_col_width}; text-align:left; vertical-align:top; padding:{$cell_padding}; 
font-weight:bold; {$code[3]}">{$code[0]}</td>
<td style="text-align:left; vertical-align:top; padding:{$cell_padding};"><input type="text" 
name="{$code[1]}" size="10" maxlength="5" /> {$code[4]}
<br /><br />(Please enter the text in the image above. Text is not case sensitive.)<br />
</td>
</tr>
<tr>
<td colspan="2" style="text-align:left; vertical-align:middle; padding:{$cell_padding}; font-size:90%; 
font-weight:bold;">All fields are required.</td>
</tr>
<tr>
<td colspan="2" style="text-align:left; vertical-align:middle; padding:{$cell_padding};"><input 
type="submit" name="submit" value="Submit" style="border:1px solid 
#999;background:#E4E4E4;margin-top:5px;" /></td>
</tr>
</table>
</form>
<div style="width:{$form_width};text-align:right;font-size:80%;">
<a href="www.easyphpcontactform.com/" title="PHP Contact Form">PHP Contact Form</a>
</div> 
EOD;

include $footer_file;
}

function clean_var($variable) {
    $variable = strip_tags(stripslashes(trim(rtrim($variable))));
  return $variable;
}

/**
Email validation function. Thanks to www.linuxjournal.com/article/9585
*/
function validEmail($email)
{
   $isValid = true;
   $atIndex = strrpos($email, "@");
   if (is_bool($atIndex) && !$atIndex)
   {
      $isValid = false;
   }
   else
   {
      $domain = substr($email, $atIndex+1);
      $local = substr($email, 0, $atIndex);
      $localLen = strlen($local);
      $domainLen = strlen($domain);
      if ($localLen < 1 || $localLen > 64)
      {
         // local part length exceeded
         $isValid = false;
      }
      else if ($domainLen < 1 || $domainLen > 255)
      {
         // domain part length exceeded
         $isValid = false;
      }
      else if ($local[0] == '.' || $local[$localLen-1] == '.')
      {
         // local part starts or ends with '.'
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $local))
      {
         // local part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^[A-Za-z0-9\\-\\.]+$/', $domain))
      {
         // character not valid in domain part
         $isValid = false;
      }
      else if (preg_match('/\\.\\./', $domain))
      {
         // domain part has two consecutive dots
         $isValid = false;
      }
      else if (!preg_match('/^(\\\\.|[A-Za-z0-9!#%&`_=\\/$\'*+?^{}|~.-])+$/', 
str_replace("\\\\","",$local)))
      {
         // character not valid in local part unless 
         // local part is quoted
         if (!preg_match('/^"(\\\\"|[^"])+"$/',
             str_replace("\\\\","",$local)))
         {
            $isValid = false;
         }
      }
      if ($isValid && function_exists('checkdnsrr'))
      {
      	if (!(checkdnsrr($domain,"MX") || checkdnsrr($domain,"A"))) {
         // domain not found in DNS
         $isValid = false;
       }
      }
   }
   return $isValid;
}


?>
</div>
</div><!-- end content -->

<div id="footer">

  <a href="index.php">Home</a> |
  <a href="lazarus/index.php">Guestbook</a> |
  <a href="#">Contact</a> |
  <a href="links.php">Links</a> |
  <a href="preferences.php">Preferences</a><br />
<?php printf("Website Copyright(C) 2010-%d BRDatabase.info<br />", date("Y")); ?>
<br />
</div><!-- end footer -->

</div><!-- end page_wrapper -->

</body>

</html>

