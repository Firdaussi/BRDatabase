<?php 
include("../lib/phpgraphlib.php"); 
$graph=new PHPGraphLib(600,350);
$data=unserialize(urldecode(stripslashes($_GET['mydata'])));
$graph->addData($data);
$graph->setDataValues(true);
$graph->setTitle("Locomotives Withdrawn by Year");
$graph->setGradient("red", "maroon");
$graph->createGraph();
?>