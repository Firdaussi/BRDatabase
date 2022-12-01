<?php
include('../lib/baaChart.php');
	$mygraph = new baaChart(600);
	$mygraph->setTitle('Regional Sales','Jan - Jun 2002');
	$mygraph->setXLabels("Jan,Feb,Mar,Apr,May,Jun");
	$mygraph->addDataSeries('L',LINE_MARK_X,"25,30,35,40,30,35","South");
	$mygraph->addDataSeries('L',LINE_MARK_CIRCLE,"65,70,80,90,75,48","North");
	$mygraph->addDataSeries('L',LINE_MARK_SQUARE,"12,18,25,20,22,30","West");
	$mygraph->addDataSeries('L',LINE_MARK_DIAMOND,"50,60,75,80,60,75","East");
	$mygraph->addDataSeries('L',LINE_MARK_NONE,"30,45,50,55,52,60","Europe");
	$mygraph->setBgColor(255,255,255,1); //Transparent
	$mygraph->setXAxis("Month",1);
	$mygraph->setYAxis("Sales (£000)",0,100,10,0);
	$mygraph->drawGraph();

?>
