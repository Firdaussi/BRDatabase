<?php 
include("../lib/phpgraphlib.php"); 
if ($_GET['lrg'] == "Y")
{  $w=1280;$h=960; }
else
{  $w=600;$h=350;  }
$graph=new PHPGraphLib($w,$h);
$data1=unserialize(urldecode(stripslashes($_GET['mydata1'])));
$data2=unserialize(urldecode(stripslashes($_GET['mydata2'])));
$graph->addData($data1, $data2);
$graph->setLegend(true);
$graph->setLegendTitle("Built", "Withdrawn");
$graph->setDataValues(false);
$graph->setTitle("Class Lifespan");
$graph->setGradient("green", "yellow", "red", "maroon");
$graph->createGraph();
?>