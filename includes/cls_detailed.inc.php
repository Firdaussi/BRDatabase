<?php

  $tabnum = 14;
  include("cls_menu.inc.php");

  printf("<div id=\"navcontainer\">\n");
      
  if ($type == 'S')
  {
    include("cls_s_detailed.inc.php");
  }
  else
  if ($type == 'D')
  {
    include("cls_d_detailed.inc.php");
  }
  else
  if ($type == 'E')
  {
    include("cls_e_detailed.inc.php");
  }
  else
  if ($type == 'DMU')
  {
    include("cls_dmu_detailed.inc.php");
  }

?>