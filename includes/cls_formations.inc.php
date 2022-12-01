<?php

  $tabnum = 15;
  include("cls_menu.inc.php");
  
  printf("<div id=\"navcontainer\">\n");
      
  if ($type == 'DMU')
  {
    include("cls_dmu_formations.inc.php");
  }

?>