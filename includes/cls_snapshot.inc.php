<?php

  $tabnum = 11;
  include("cls_menu.inc.php");

  printf("<div id=\"navcontainer\">\n");
      
  if ($type == 'S')
  {
    include("cls_s_snapshot.inc.php");
  }
  else
  if ($type == 'D')
  {
    include("cls_d_snapshot.inc.php");
  }
  else
  if ($type == 'E')
  {
    include("cls_e_snapshot.inc.php");
  }
  else
  if ($type == 'DMU')
  {
    include("cls_dmu_snapshot.inc.php");
  }

?>