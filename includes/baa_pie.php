<?php
  include('../lib/baaChart.php');

  $data  =unserialize(urldecode(stripslashes($_GET['data'])));
  $title1=unserialize(urldecode(stripslashes($_GET['t1'])));
  $title2=unserialize(urldecode(stripslashes($_GET['t2'])));

  $mygraph = new baaChart(700);
  $mygraph->setTitle($title1, $title2);
  
  if (is_array($data))
  {
    foreach ($data as $key)
      $mygraph->addDataSeries('P',PIE_CHART_PCENT + PIE_LEGEND_VALUE,$key[1],$key[0]);
      
    $mygraph->drawGraph();
  }
	
?>