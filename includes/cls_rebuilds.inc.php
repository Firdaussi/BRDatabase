<?php

  $tabnum = 9;
  include("cls_menu.inc.php");

  if ($type == 'S')
  {
    include("cls_s_rebuilds.inc.php");
  }
  else
  if ($type == 'D')
  {
    include("cls_d_rebuilds.inc.php");
  }
  else
  if ($type == 'E')
  {
    include("cls_e_rebuilds.inc.php");
  }
  else
  if ($type == 'DMU')
  {
    include("cls_dmu_rebuilds.inc.php");
  }

?>