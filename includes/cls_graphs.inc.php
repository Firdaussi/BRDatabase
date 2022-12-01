<?php

  $tabnum = 6;
  include("cls_menu.inc.php");

  if ($type == 'S')
  {
    include("cls_s_graphs.inc.php");
  }
  else
  if ($type == 'D')
  {
    include("cls_d_graphs.inc.php");
  }
  else
  if ($type == 'E')
  {
    include("cls_e_graphs.inc.php");
  }
  else
  if ($type == 'DMU')
  {
    include("cls_dmu_graphs.inc.php");
  }

?>