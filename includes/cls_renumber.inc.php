<?php

  $tabnum = 8;
  include("cls_menu.inc.php");

  if ($type == 'S')
  {
    include("cls_s_renumber.inc.php");
  }
  else
  if ($type == 'D')
  {
    include("cls_d_renumber.inc.php");
  }
  else
  if ($type == 'E')
  {
    include("cls_e_renumber.inc.php");
  }
  else
  if ($type == 'DMU')
  {
    include("cls_dmu_renumber.inc.php");
  }

?>