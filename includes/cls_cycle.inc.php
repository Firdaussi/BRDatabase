<?php

  $tabnum = 13;
  include("cls_menu.inc.php");

  if ($type == 'S')
  {
    include("cls_s_cycle.inc.php");
  }
  else
  if ($type == 'D')
  {
    include("cls_d_cycle.inc.php");
  }
  else
  if ($type == 'E')
  {
    include("cls_e_cycle.inc.php");
  }
  else
  if ($type == 'DMU')
  {
    include("cls_dmu_cycle.inc.php");
  }
?>