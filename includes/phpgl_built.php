<?php 
include("../lib/phpgraphlib.php"); 
$graph=new PHPGraphLib(600,350);
$data=unserialize(urldecode(stripslashes($_GET['mydata'])));
$title=unserialize(urldecode(stripslashes($_GET['title'])));
$graph->addData($data);
$graph->setDataValues(true);
if (!empty($title))
  $graph->setTitle($title);
else
  $graph->setTitle("Locomotives Constructed by Year");
$graph->setGradient("green", "yellow");
$graph->createGraph();
?>