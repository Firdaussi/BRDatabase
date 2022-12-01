<?php

  $tabnum = 1;
  include("cls_menu.inc.php");

  if ($type == 'S')
  {
    include("cls_s_main.inc.php");
  }
  else
  if ($type == 'D')
  {
    include("cls_d_main.inc.php");
  }
  else
  if ($type == 'E')
  {
    include("cls_e_main.inc.php");
  }
  else
  if ($type == 'DMU')
  {
    include("cls_dmu_main.inc.php");
  }

?>