<?php

  $tabnum = 16;
  include("cls_menu.inc.php");

  if ($type == 'S')
  {
    include("cls_s_names.inc.php");
  }
  else
  if ($type == 'D')
  {
    include("cls_d_names.inc.php");
  }
  else
  if ($type == 'E')
  {
    include("cls_e_names.inc.php");
  }
  else
  if ($type == 'DMU')
  {
    /*include("cls_dmu_names.inc.php");*/
  }
?>