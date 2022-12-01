<?php

  $tabnum = 5;
  include("cls_menu.inc.php");

  printf("<div id=\"navcontainer\">\n");
      
  if ($type == 'S')
  {
    include("cls_s_mods.inc.php");
  }
  else
  if ($type == 'D')
  {
    include("cls_d_mods.inc.php");
  }
  else
  if ($type == 'E')
  {
    include("cls_e_mods.inc.php");
  }
  else
  if ($type == 'DMU')
  {
    include("cls_dmu_mods.inc.php");
  }

?>