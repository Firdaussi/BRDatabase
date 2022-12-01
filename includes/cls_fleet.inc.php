<?php

  $tabnum = 3;
  include("cls_menu.inc.php");

  if ($type == 'S')
  {
    include("cls_s_fleet.inc.php");
  }
  else
  if ($type == 'D')
  {
    include("cls_d_fleet.inc.php");
  }
  else
  if ($type == 'E')
  {
    include("cls_e_fleet.inc.php");
  }
  else
  if ($type == 'DMU')
  {
    include("cls_dmu_fleet.inc.php");
  }
?>