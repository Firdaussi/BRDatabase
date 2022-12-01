<?php

  include_once "lib/date_span.class.php";

  $ds = new date_span();

  if ($type == 'S')
  {
    $str = "S" . $id; fn_logit(12, $str); unset($str);
    include("locodatas.inc.php");
  }
  else
  if ($type == 'D')
  {
    $str = "D" . $id; fn_logit(12, $str); unset($str);
    include("locodatad.inc.php");
  }
  else
  if ($type == 'E')
  {
    $str = "E" . $id; fn_logit(12, $str); unset($str);
    include("locodatae.inc.php");
  }
  else
  if ($type == 'DMU')
  {
    $str = "DMU" . $id; fn_logit(12, $str); unset($str);
    include("mudatad.inc.php");
  }
  else
  {
    echo "Unknown type: " . $type . "<br />";
  }
?>