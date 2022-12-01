<?php 
include("../lib/phpgraphlib.php"); 
if ($_GET['lrg'] == "Y")
{  $w=1280;$h=960; }
else
{  $w=600;$h=350;  }
$graph=new PHPGraphLib($w,$h);

$graph->setLegend(true);
$graph->setLegendTitle("Class Totals");

$data=unserialize(urldecode(stripslashes($_GET['mydata'])));
$graph->setDataValues(true);
$graph->addData($data);
$graph->setTitle("Locomotive Totals by Year (Stock on New Years Eve)");
$graph->setGradient("green", "yellow");
$graph->createGraph();
?>