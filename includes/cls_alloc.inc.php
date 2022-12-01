<?php

  $tabnum = 4;
  include("cls_menu.inc.php");
  
  if ($type == 'S')
  {
    include("cls_s_alloc.inc.php");
  }
  else
  if ($type == 'D')
  {
    include("cls_d_alloc.inc.php");
  }
  else
  if ($type == 'E')
  {
    include("cls_e_alloc.inc.php");
  }
  else
  if ($type == 'DMU')
  {
    include("cls_dmu_alloc.inc.php");
  }

?>