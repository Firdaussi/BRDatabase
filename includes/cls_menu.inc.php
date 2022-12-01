<?php

  printf("<div id=\"navcontainer\">\n");
  printf("<ul id=\"snavlist\">\n");
  
  if (!isset($ad))
    $ad = "";
  if (!isset($col))
    $col = "";
  
  $stub    = sprintf("<li><a href=\"locoqry.php?action=class&id=%s&type=%s&page=", $id, $type);
  $thisone = sprintf("<li id=\"active\"><a href=\"#\" id=\"current\">");

  if ($tabnum == 1)
    printf("%s%s</a></li>\n",                  $thisone,                       "Summary");
  else
    printf("%s%s\">%s</a></li>\n",             $stub,     "main",              "Summary");

  if ($tabnum == 2)
    printf("%s%s</a></li>\n",                  $thisone,                       "Gallery");
  else
    printf("%s%s\">%s</a></li>\n",             $stub,     "gallery",           "Gallery");

  if ($tabnum == 3)
    printf("%s%s</a></li>\n",                  $thisone,                       "Fleet");
  else
    //printf("%s%s&ad=%s&sc=%s\">%s</a></li>\n", $stub,     "fleet",  $ad, $col, "Fleet");
    printf("%s%s\">%s</a></li>\n", $stub,     "fleet",  "Fleet"); // don't know what ad and sc are!

  if ($tabnum == 4)
    printf("%s%s</a></li>\n",                  $thisone,                       "Alloc");
  else
    printf("%s%s\">%s</a></li>\n",             $stub,     "alloc",             "Alloc");

  if ($tabnum == 16)
    printf("%s%s</a></li>\n",                  $thisone,                       "Names");
  else
    printf("%s%s\">%s</a></li>\n",             $stub,     "names",             "Names");

  if ($tabnum == 13)
    printf("%s%s</a></li>\n",                  $thisone,                       "Cycle");
  else
    printf("%s%s\">%s</a></li>\n",             $stub,     "cycle",             "Cycle");

  if ($tabnum == 11)
    printf("%s%s</a></li>\n",                  $thisone,                       "Snap");
  else
    printf("%s%s\">%s</a></li>\n",             $stub,     "snapshot",          "Snap");

  if ($inc_p_snapshot == "Y")
  {
    if ($tabnum == 14)
      printf("%s%s</a></li>\n",                  $thisone,                       "Detailed");
    else
      printf("%s%s\">%s</a></li>\n",             $stub,     "detailed",          "Detailed");
  }

  if ($tabnum == 5)
    printf("%s%s</a></li>\n",                  $thisone,                       "Mods");
  else
    printf("%s%s\">%s</a></li>\n",             $stub,     "mods",              "Mods");

  if ($tabnum == 6)
    printf("%s%s</a></li>\n",                  $thisone,                       "Stats");
  else
    printf("%s%s\">%s</a></li>\n",             $stub,     "graphs",            "Stats");

  if ($tabnum == 7)
    printf("%s%s</a></li>\n",                  $thisone,                       "Hist");
  else
    printf("%s%s\">%s</a></li>\n",             $stub,     "history",           "Hist");

  if ($inc_p_renumber == "Y")
  {
    if ($tabnum == 8)
      printf("%s%s</a></li>\n",                  $thisone,                       "Renumber");
    else
      printf("%s%s\">%s</a></li>\n",             $stub,     "renumber",          "Renumber");
  }

  if ($inc_p_rebuild == "Y")
  {
    if ($tabnum == 9)
      printf("%s%s</a></li>\n",                  $thisone,                       "Rebuilds");
    else
      printf("%s%s\">%s</a></li>\n",             $stub,     "rebuilds",          "Rebuilds");
  }

  if ($inc_p_reclass == "Y")
  {
    if ($tabnum == 10)
      printf("%s%s</a></li>\n",                  $thisone,                       "ReClass");
    else
      printf("%s%s\">%s</a></li>\n",             $stub,     "reclass",           "ReClass");
  }

  if ($tabnum == 12)
    printf("%s%s</a></li>\n",                  $thisone,                       "Day2Day");
  else
    printf("%s%s\">%s</a></li>\n",             $stub,     "daytoday",          "Day2Day");

  if ($type == "DMU" OR $type == "EMU")
  {
    if ($tabnum == 15)
      printf("%s%s</a></li>\n",                  $thisone,                       "Formations");
    else
      printf("%s%s\">%s</a></li>\n",             $stub,     "formations",        "Formations");
  }

  if ($tabnum == 17)
    printf("%s%s</a></li>\n",                  $thisone,                       "Preservation");
  else
    printf("%s%s\">%s</a></li>\n",             $stub,     "preservation",          "Preservation");



  printf("</ul>\n");
  printf("</div>\n");

?>