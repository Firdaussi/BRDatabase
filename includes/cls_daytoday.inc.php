<?php

  $tabnum = 12;
  include("cls_menu.inc.php");

  if ($type == 'S')
  {
    include("cls_s_daytoday.inc.php");
  }
  else
  if ($type == 'D')
  {
    include("cls_d_daytoday.inc.php");
  }
  else
  if ($type == 'E')
  {
    include("cls_e_daytoday.inc.php");
  }
  else
  if ($type == 'DMU')
  {
    include("cls_dmu_daytoday.inc.php");
  }

?>