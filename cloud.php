 <?php
include_once ("lib/tagCloud.class.php");

// Init the tagArray with As many values as you wish 
// Here is a short example for usage.


$tagArray = array (
        "January" => 12,
        "February" => 28,
        "March" => 15,
        "April" => 8,
        "May" => 20,
        "June" => 40,
        "July" => 28,
        "August" => 24,
        "September" => 10,
        "October" => 15,
        "November" => 8,
        "December" => 30
        );


// Example 1:Normal Usage
echo '<h3> Normal Usage : (note the default Row num is 3 and default items per row is 5)<br /><font color="red">tagCloud($tagArray) </font></h3>';
$myTagCloud = new tagCloud($tagArray);
$myTagCloud->CreateHtmlCode();
echo $myTagCloud->HtmlStr;
echo '<hr>';


// Example 2:Overide font color , font type , min font size , max font size
echo '<h3> override  font color , font type , min font size , max font size :<br /> <font color="red">tagCloud($tagArray,4,3,\'#FF0000\',\'Courier\',20,50) </font></h3>';
$myTagCloud = new tagCloud($tagArray,4,3,'#FF0000','Courier',20,50);
$myTagCloud->CreateHtmlCode();
echo $myTagCloud->HtmlStr;
echo '<hr>';



// Example 3:Overide spacing , link , Concatunate ID to Link
echo '<h3> override spacing , link , Concatanate ID to Link ,RTL view  :<br /> <font color="red">tagCloud($tagArray,\'\',\'\',\'\',\'\',\'\',\'\',10,\'ApplyIDtoCloudItem.php?key=\',0,\'\',\'anotherCloudID\',0,0,1) </font></h3>';
$myTagCloud = new tagCloud($tagArray,'','','','','','',10,'ApplyIDtoCloudItem.php?key=',0,'','anotherCloudID',0,0,1);
$myTagCloud->CreateHtmlCode();
echo $myTagCloud->HtmlStr;
echo '<hr>';



// Example 4:Overide All
// Note the usage of a different ID for the HTML Table Object
echo '<h3> override  background color , sort up  :<br /> <font color="red">tagCloud($tagArray,\'\',\'\',\'\',\'\',\'\',\'\',\'\',\'\',\'\',\'#AACC80\',\'yet_another_cloud\',1,1,0) </font></h3>';
$myTagCloud = new tagCloud($tagArray,'','','','','','','','',1,'#AACC80','yet_another_cloud',0,1,0);
$myTagCloud->CreateHtmlCode();
echo $myTagCloud->HtmlStr;
echo '<hr>';



?>
