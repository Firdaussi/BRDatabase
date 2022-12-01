<?php

  $tabnum = 2;
  include("cls_menu.inc.php");

  if ($type == 'S')
  {
    include("cls_s_gallery.inc.php");
  }
  else
  if ($type == 'D')
  {
    include("cls_d_gallery.inc.php");
  }
  else
  if ($type == 'E')
  {
    include("cls_e_gallery.inc.php");
  }
  else
  if ($type == 'DMU')
  {
    include("cls_dmu_gallery.inc.php");
  }

?>