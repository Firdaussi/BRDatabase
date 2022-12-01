<?php

/********************************************/
/* Function: fn_determine_brakes            */
/*           *******************            */
/* Check value of brakes in d_config record */
/* Parameters:                              */
/* $config : config parameter               */
/********************************************/

function fn_determine_brakes($config)
{
    if (strchr($config, "v"))
      return "Vacuum";
    else
    if (strchr($config, "a"))
      return "Air";
    else
    if (strchr($config, "x"))
      return "Dual";
    else
    if (strchr($config, "n"))
      return "No train";
    
    return "Unknown";
}    

/*********************************************/
/* Function: fn_determine_heating            */
/*           ********************            */
/* Check value of heating in d_config record */
/* Parameters:                               */
/* $config : config parameter                */
/*********************************************/

function fn_determine_heating($config)
{
    if (strstr($config, "ei"))
      return "Dual heat, boiler isolated";
    else
    if (strchr($config, "b"))
      return "Steam heat";
    else
    if (strchr($config, "i"))
      return "Isolated boiler";
    else
    if (strchr($config, "o"))
      return "No heat";
    else
    if (strchr($config, "e"))
      return "Electric Train Heating";
    else
    if (strchr($config, "d"))
      return "Dual heat";
    else
    if (strchr($config, "n"))
      return "No heating";
    
    return "";
}    
      

/*********************************************/
/* Function: fn_determine_other              */
/*           ******************              */
/* Check value of other data in d_config     */
/* record                                    */
/* Parameters:                               */
/* $config : config parameter                */
/*********************************************/

function fn_determine_other($config)
{
    if (strchr($config, "s"))
      $other = 'Slow Speed Control';

    if (strchr($config, "h"))
      if ($other != "")
        $other .= ", Headlight";
      else
        $other = "Headlight";

    if (strchr($config, "t"))
      if ($other != "")
        $other .= ", Extended Fuel Tanks";
      else
        $other = "Extended Fuel Tanks";
        
    if (strchr($config, "p"))
      if ($other != "")
        $other .= ", Push Pull fitted";
      else
        $other = "Push Pull fitted";
        
    if (strchr($config, "r"))
      if ($other != "")
        $other .= ", Radio Telephone fitted";
      else
        $other = "Radio Telephone fitted";
        
    return $other;
}
      

/*********************************************/
/* Function: fn_determine_extras             */
/*           ******************              */
/* Check value of extras data in d_config    */
/* record                                    */
/* Parameters:                               */
/* $config : config parameter                */
/* Applies to data not represented in the    */
/* old Motive Power books - e.g. AWS         */
/*********************************************/

function fn_determine_extras($config)
{
    /* 1st character indicates the AWS of the loco */
    $extras = '';

    if (substr($config, 0, 1) == 'A')
      $extras = 'BR AWS';
    else
    if (substr($config, 0, 1) == 'W')
      $extras = 'WR ATC';
    else
    if (substr($config, 0, 1) == 'D')
      $extras = 'Dual AWS/ATC';
    else
    if (substr($config, 0, 1) == 'd')
      $extras = 'Dual AWS (WR ATC isolated)';
    else
    if (substr($config, 0, 1) == 'I')
      $extras = 'WR ATC (isolated)';

    /****************************************************/
    
    if (substr($config, 1, 1) == 'E')
      if ($extras != "")
        $extras .= ', EQ Brakes';
      else
        $extras = 'EQ Brakes';
    else
    if (substr($config, 1, 1) == 'M')
      if ($extras != "")
        $extras .= ', Modified Triple Valve Brake';
      else
        $extras = 'Modified Triple Valve Brake';
        
    /*--------------------------------------------------*/
    
    if (substr($config, 1, 1) == 'X')
      if ($extras != "")
        $extras .= ', Modified Triple Valve & EQ Brakes';
      else
        $extras .= 'Modified Triple Valve & EQ Brakes';
        
    /****************************************************/
    
    if (substr($config, 2, 1) == 'M')
      if ($extras != "")
        $extras .= ', Multiple Working fitted';
      else
        $extras = 'Multiple Working fitted';

    return $extras;
}    
      

/********************************************/
/* Function: fn_is_co_and_num               */
/*           ****************               */
/* When searching, is company and number    */
/* provided, e.g. SECR273                   */
/* Parameters:                              */
/* $search : search parameter               */
/********************************************/

function fn_is_co_and_num($search)
{
    /* Have a match when first 2 or more characters are uppercase letters
       followed by a space, then digits (possibly a hash at the end) */
    $sql = " and ";
    
    if (!strchr($search, " "))
        return "";
        
    $tokens = explode(" ", $search);
    
    if (count($tokens) != 2)
        return "";
        
    // 1st element must be all characters representing the company initials
    // 2nd element will be the number
    if (ctype_alpha($tokens[0]))
    {
        $tokens[0] = strtoupper($tokens[0]);
        return $tokens;
    }
    
    return "";
}    
      
/********************************************/
/* Function: fn_formation                   */
/*           ************                   */
/* add elements of a multiple unit together */
/* Parameters:                              */
/* $regpfx:  regional prefix, e.g. W, ScR   */
/* $number:  vehicle number at the time     */
/* $id:      vehicle id                     */
/* $type:    DMU or EMU etc...              */
/* $vehicle: DMBS, TF etc..                 */
/********************************************/

function fn_formation($regpfx, $number, $id, $type, $vehicle)
{
  $str = "<a href=\"locoqry.php?action=locodata&amp;id=" . $id . "&amp;type=" . $type . "\">";
  if (!empty($regpfx)) $str .= $regpfx;
  if (!empty($number)) $str .= $number;
  if (!empty($vehicle)) $str .= " (" . $vehicle . ")";
  $str .= "</a>";
  return $str;
}    
   /********************************************/
/* Function: fn_get_NB                      */
/*           *********                      */
/* Get NB Works                             */
/* Parameter:                               */
/* $type:    HP, A, QP                      */
/********************************************/

function fn_get_NB($type)
{
  $type = strtoupper($type);
  if (!strcmp($type, "HP"))
  {
    return "Hyde Park";
  }
  else
  if ($type == "QP")
  {
    return "Queens Park";
  }
  else
  if ($type == "A")
  {
    return "Atlas";
  }
  else
    return "Unknown";
}

/********************************************/
/* Function: fn_check_type                  */
/*           *************                  */
/* Check vehicle type                       */
/* Parameter:                               */
/* $type:    S, D, E, DMU or EMU etc...     */
/********************************************/

function fn_check_type($type)
{
  $type = strtoupper($type);
  if (!($type == "S" || $type == "D" || $type == "E" || $type == "DMU" || $type == "EMU" || $type == "SRM"))
    fn_poem($type, "(Invalid type)", 1);
}

/********************************************/
/* Function: fn_check_result                */
/*           ***************                */
/* Check result of an sql query for sql     */
/* errors.                                  */
/* Parameter:                               */
/* $result:  result of an sql query         */
/********************************************/

function fn_check_result($result)
{
  if (!$result)
  {
    die("Error communicating with the database. Please try again later.<br />");
  }
}

/********************************************/
/* Function: fn_check_poem                  */
/*           *************                  */
/* Print an error message when someone      */
/* tries an invalid query, usually by       */
/* manipulating the URL                     */
/* Parameters:                              */
/* $srch:    URL line or search text        */
/* $bad:     Reason search has been rejected*/
/* $level:   Error code (mine)              */
/********************************************/

function fn_poem($srch, $bad, $level=0)
{
    printf("<br />Error %4d: Illegal character(s) found in search term<br /><br />", $level + 9000);
    fn_log_error($srch);
    die("Search cancelled.");
}

function fn_check_digit($str, $maxlen=0)
{
  if (!ctype_digit($str) || ($maxlen > 0 && strlen($str) > $maxlen))
    fn_poem($str, "(not numerical or number too big)", 2);
}

function fn_check_alpha($str, $maxlen=0)
{
  for ($nx=0;$nx<strlen($str);$nx++)
  {
    if (!(($str[$nx] >= 'A' && $str[$nx] <= 'Z') ||
          ($str[$nx] >= 'a' && $str[$nx] <= 'z') ||
          ($str[$nx] == '_')))
    {
      fn_poem($str, "(not alphabetical or too long)", 3);
    }
  }
}

function fn_check_alnum($str, $maxlen=0)
{
  fn_check_allchars($str, $maxlen);
}

function fn_check_allchars($str, $maxlen=0)
{
  if (!ctype_alnum($str) || ($maxlen > 0 && strlen($str) > $maxlen))
    fn_poem($str, "(not alphanumeric or too long)", 4);
}

function fn_check_all_x($str, $extra = "") // meant for wheel-arrangement checks and dates - oops, forgot diesels & electrics!
{
  for ($nx=0;$nx<strlen($str);$nx++)
  {
    if (!(($str[$nx] >= '0' && $str[$nx] <= '9') ||
          ($str[$nx] == '-') ||
          ($str[$nx] == '+') ||   // e.g. Bo+Bo
          ($str[$nx] == 'A') ||   // e.g. A1A-A1A
          ($str[$nx] == 'B') ||   // e.g. Bo-Bo
          ($str[$nx] == 'C') ||   // e.g. Co-Co
          ($str[$nx] == 'D') ||   // e.g. 2-D-2
          ($str[$nx] == 'o') ||   // e.g. Bo-Bo
          ($str[$nx] == 'T') ||   // e.g. 0-6-0T
          ($str[$nx] == 'W') ||   // e.g. 0-4-0WT
          ($str[$nx] == 'S') ||   // e.g. 0-6-0ST
          ($str[$nx] == 'P')))    // e.g. 0-6-0PT
      {
        fn_poem($str, "(not a valid string)", 5);
      }
  }
}

function fn_check_wheels($str)
{
  fn_check_all_x($str);
}

function fn_check_input($srch)
{
  if (stristr($srch, "select"))
    fn_poem($srch, "select", 6);
    
  if (strchr($srch, "'"))
    fn_poem($srch, "'", 7);
    
  if (strchr($srch, '='))
   fn_poem($srch, "=", 8);
   
  if (strchr($srch, '/'))
    fn_poem($srch, "/", 9);
    
  if (strchr($srch, '*'))
    fn_poem($srch, "*", 10);
    
  if (strstr($srch, "0x"))
    fn_poem($srch, "0x", 11);
    
  if (strstr($srch, "/**/"))
    fn_poem($srch, "/**/", 12);

  if (stristr($srch, "count") && !strstr($srch, "county"))
    fn_poem($srch, "count", 13);

}

function fn_check_id($id, $maxid = 999999999)
{
  $local_id = -1;
  if (ctype_digit($id))
    $local_id = intval($id);
 
  if ($local_id <= 0 || $local_id > $maxid)
    fn_poem($id, $id, 14);

  return;
}

function fn_mandatory_field($str)
{
  printf("Missing a mandatory field: %s<br />\n", $str);
  die("Cannot continue with this request");
}

function fn_log_class($type, $class)
{
    $dblog = fn_connectdb("2");

    if (!empty($_SESSION['user']))
        $userid = $_SESSION['user'];
    else
        $userid = "Anonymous";

    $server = $_SERVER['REMOTE_ADDR'];
    $request_uri = $_SERVER['REQUEST_URI'];
    $remote_host = $_SERVER['REMOTE_HOST'];

    $sql = sprintf("INSERT INTO class_log (type, class, ip_address, userid, query_time, request_uri, remote_host) VALUES ('%s', '%s', '%s', '%s', now(), '%s', '%s')", 
                    $type,
                    $class,
                    $server,
                    $userid,
                    $request_uri,
                    $remote_host);

    $result = $dblog->execute($sql);

    $dblog->close();
}

function fn_logit($typ, $arr)
{
  // print_r($arr);
  $dblog = fn_connectdb("2");
  
  if (!empty($_SESSION['user']))
    $userid = $_SESSION['user'];
  else
    $userid = "Anonymous";

  $server = $_SERVER['REMOTE_ADDR'];
  $country_code = fn_check_country($server);
  $request_uri = $_SERVER['REQUEST_URI'];
  $remote_host = $_SERVER['REMOTE_HOST'];

//  print_r($_SERVER);
  $dat = $t = "";

  switch($typ)
  {
    case 1: // loconum
      $d = $arr['loconum'];
      $t = "Box search";
    break;
    
    case 2:
      $d = $arr;
      $t = "Companies";
    break;
    
    case 3:
      $d = $arr;
      $t = "Specific Name";
    break;
    
    case 4:
      $d = $arr;
      $t = "Names";
    break;
    
    case 5:
      $d = "-";
      $t = "Pilot Scheme";
    break;
    
    case 6:
      $d = $arr['sub'] . ", " . $arr['id'];
      $t = "Sites/Depots";
    break;
    
    case 7:
      $d = $arr['sub'] . ", " . $arr['id'];
      $t = "Sites/Builders";
    break;
    
    case 8:
      $d = $arr['sub'] . ", " . $arr['id'];
      $t = "Sites/Works";
    break;
    
    case 9:
      $d = $arr['sub'] . ", " . $arr['id'];
      $t = "Sites/Scrapyards";
    break;
    
    case 10:
      $d = $arr;
      $t = "Timelines";
    break;
    
    case 11:
      $d = "-";
      $t = "Timelines/List";
    break;
    
    case 12:
      $d = $arr;
      $t = "Locodata";
    break;

    case 13:
      $d = $arr['id'];
      $t = "Classes/" . $arr['sub'];
    break;

    default:
    break;
  }
  
  if (!empty($d) && !empty($t))
  {
    //$sql = sprintf("INSERT INTO query_log (query_type, query_text, ip_address, userid, request_uri, remote_host) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')", 
    //                                                   $t,
    //                                                   $d,
    //                                                   $server,
    //                                                   $userid,
    //                                                   $request_uri,
    //                                                   $remote_host);

    //$result = $dblog->execute($sql);
    
    if (empty($server)) $server = "-";
    if (empty($request_uri)) $request_uri= "-";
    if (empty($remote_host)) $remote_host= "-";
    
    if ($dblog->prep_prepare("INSERT INTO query_log (query_type, query_text, ip_address, userid, request_uri, remote_host, country_code) VALUES (?, ?, ?, ?, ?, ?, ?)"))
    {
      $dblog->prep_bind_var('sssssss', $t, $d, $server, $userid, $request_uri, $remote_host, $country_code);
      $dblog->prep_execute();
      $dblog->prep_close();
    }
  }

  $dblog->close();

}

function fn_log_error($srch)
{
  // print_r($arr);
  $dblog = fn_connectdb("2");
  
  if (!empty($_SESSION['user']))
    $userid = $_SESSION['user'];
  else
    $userid = "Anonymous";

  $server = $_SERVER['REMOTE_ADDR'];
  $country_code = fn_check_country($server);
  $request_uri = $_SERVER['REQUEST_URI'];
  $remote_host = $_SERVER['REMOTE_HOST'];

//  print_r($_SERVER);
  $dat = $t = "";


  if (!empty($srch))
  {
    if (empty($server)) $server = "-";
    if (empty($request_uri)) $request_uri= "-";
    if (empty($remote_host)) $remote_host= "-";
    
    if ($dblog->prep_prepare("INSERT INTO inject_log (inject_text, ip_address, country_code, userid, request_uri, remote_host) VALUES (?, ?, ?, ?, ?, ?)"))
    {
      $dblog->prep_bind_var('ssssss', $srch, $server, $country_code, $userid, $request_uri, $remote_host);
      $dblog->prep_execute();
      $dblog->prep_close();
    }
  }

  $dblog->close();
}

function fn_errlog($module, $errortxt)
{
 // deprecated!
}

function isdigit ($c){ return $c >= '0' && $c <= '9' ? 1 : 0; }

function fn_region_code($code)
{
  if ((strlen($code) == 3) && (isdigit($code[0]) && isdigit($code[1]) && !isdigit($code[2])))
    return fn_region(substr($code, 0, 2));
  else
  if ((strlen($code) == 2) && (isdigit($code[0]) && !isdigit($code[1])))
    return fn_region(substr($code, 0, 1));
  else
    return ("??");
}

function fn_region($num)
{
  if ($num >= 1 && $num <= 29)
    return "LMR";
  else
  if ($num >= 30 && $num <= 49)
    return "ER";
  else
  if ($num >= 50 && $num <= 59)
    return "NER";
  else
  if ($num >= 60 && $num <= 69)
    return "ScR";
  else
  if ($num >= 70 && $num <= 79)
    return "SR";
  else
  if ($num >= 80 && $num <= 89)
    return "WR";

  return "??";
}

function fn_depot_name($flag, $caveat, $usage, $alloc1, $alloc2, 
                       $depot, $hshed, $hcode, &$code,  &$desc, $short = 0)
{
   /*
    echo "Next: <br />";
    echo $flag . "<br />";
    echo $caveat . "<br />";
    echo $usage . "<br />";
    echo $alloc1 . "<br />";
    echo $alloc2 . "<br />";
    echo $depot . "<br />";
    echo $hshed . "<br />";
*/

  $code = $desc = "";
  if (!empty($alloc1))
  {
    if (strncmp($alloc1, "91", 2) == 0)
    {
      // inter regional transfer
      $code = "&nbsp;&nbsp;";
      if (strcmp($alloc1, "91M") == 0)
        $desc = "To London Midland Region";
      else
      if (strcmp($alloc1, "91E") == 0)
        $desc = "To Eastern Region";
      else
      if (strcmp($alloc1, "91N") == 0)
        $desc = "To North Eastern Region";
      else
      if (strcmp($alloc1, "91W") == 0)
        $desc = "To Western Region";
      else
      if (strcmp($alloc1, "91S") == 0)
        $desc = "To Southern Region";
      else
      if (strcmp($alloc1, "91X") == 0)
        $desc = "To Scottish Region";
      else
      if (strcmp($alloc1, "91LNWR") == 0)
        $desc = "To LNWR";
      else
        $desc = "Unknown - please contact administrator!";

      //return;
    }
    else
    if (strncmp($alloc1, "92", 2) == 0)
    {
      // Research department
      $code = "&nbsp;&nbsp;";

      return;
    }
    else
    if (strcmp($alloc2, "96D") == 0)
    {
      // To Departmental stock
      $code = "&nbsp;&nbsp;";
	  $desc = "Dinsdale Sleeper Depot";

      return;
    }
    else
    if (strncmp($alloc1, "98", 2) == 0)
    {
      // To store or withdrawn
      $code = "&nbsp;&nbsp;";
      if (strcmp($alloc1, "98X") == 0)
        $desc = "<font color=\"red\"><strong>Sold out of Service to the WD</strong></font>";
      else
      if (strcmp($alloc1, "98LS") == 0)
        $desc = "<font color=\"orange\"><strong>Loaned out of Service to the WD/ROD</strong></font>";
      else
      if (strcmp($alloc1, "98LR") == 0)
        $desc = "<font color=\"green\"><strong>Returned from Service with the WD/ROD</strong></font>";
      else
      if (strcmp($alloc1, "98W") == 0 || strtoupper($flag) == "W")
      {
        if ($short == 1)
          $desc = "<font color=\"red\"><strong>Wdn</strong></font>";
        else
        {
          if (!empty($caveat))
            $desc = "<font color=\"orange\"><strong>Withdrawn (" . $caveat . ")</strong></font>";
          else
            $desc = "<font color=\"red\"><strong>Withdrawn</strong></font>";
        }
      }
      else
      if (strncmp($alloc1, "98S", 3) == 0 || strtoupper($flag)  == "S")
      {
        if (strcmp($alloc1, "98Ss") == 0)
          $stored = " Serviceable ";
        else
        if (strcmp($alloc1, "98Su") == 0)
          $stored = " Unserviceable ";
        else
          $stored = " ";

        if (!empty($alloc2))
        {
          if (!empty($caveat))
          {
            $desc = "<font color=\"orange\"><strong>Stored" . $stored . "(at " . $depot . " - " . $caveat . ")</strong></font>";
          }
          else
            $desc = "<font color=\"orange\"><strong>Stored" . $stored . "(" . $depot . ")</strong></font>";
        }
        else
        {
          if (!empty($caveat))
            $desc = "<font color=\"orange\"><strong>Stored" . $stored . "(" . $caveat . ")</strong></font>";
          else
            $desc = "<font color=\"orange\"><strong>Stored" . $stored . "</strong></font>";
        }
      }
      else
      if (strcmp($alloc1, "98D") == 0 || $flag == "D")
      {
        if (!empty($alloc2))
        {
          if (!empty($caveat))
            $desc = "<font color=\"maroon\"><strong>Dumped (at " . $depot . " - " . $caveat . ")</strong></font>";
          else
            $desc = "<font color=\"maroon\"><strong>Dumped (" . $depot . ")</strong></font>";
        }
        else
        {
          if (!empty($caveat))
            $desc = "<font color=\"maroon\"><strong>Dumped (" . $caveat . ")</strong></font>";
          else
            $desc = "<font color=\"maroon\"><strong>Dumped</strong></font>";
        }
      }
      else
      if (strcmp($alloc1, "98DP") == 0)
      {
        if ($short == 1)
          $desc = "<font color=\"red\"><strong>Wdn to Service Stock)</strong></font>";
        else
        {
          if (!empty($caveat))
            $desc = "<font color=\"orange\"><strong>Withdrawn to Service Stock (" . $caveat . ")</strong></font>";
          else
            $desc = "<font color=\"red\"><strong>Withdrawn to Service Stock</strong></font>";
        }
      }
      else
      if ($flag == "H")
      {
        $desc = "<font color=\"maroon\"><strong>On hire " . $depot . "</strong></font>";
      }
      else
        $desc = "Unknown internal code [" . $alloc1 . "] - please contact administrator!";

      return;
    }
    else
    if (strncmp($alloc1, "99", 2) == 0)
    {
      // To BR Works
      $code = "&nbsp;&nbsp;";
      if (strcmp($alloc1, "99C") == 0)
        $desc = "To Crewe Works";
      else
      if (strcmp($alloc1, "99H") == 0)
        $desc = "To Horwich Works";
      else
      if (strcmp($alloc1, "99W") == 0)
        $desc = "To Wolverton Works";
      else
      if (strcmp($alloc1, "99G") == 0)
        $desc = "To Gorton Works";
      else
        $desc = "Unknown - please contact administrator!";

      return;
    }
    else
    if (strncmp($alloc1, "MANUF", 5) == 0)
    {
      // Manufacturer (usually on loan from ...)
      $code = "<font><i>" . $alloc2 . "</i></font>";
      $desc = "<font><i>" . $depot  . " (on loan from Manufacturer)</i></font>";

      return;
    }
  }

  // All the 9xx cases have been dealt with now, so alloc1 contains a valid allocation code
  // simplest case - normal depot
  if (empty($alloc2))
  {
    if (strcmp($alloc1, "??") == 0)
    {
      $code = "";
      $desc = "<i>&lt;unknown&gt;</i>";
    }
    else
    {
      $code = $alloc1;
      $desc = $depot;

//	  if (!empty($hshed))
//		$desc .= " (subshed of " . $hcode . " " . $hshed . ")";
    }

    if ($flag == "B")
      $desc .= " (returned from loan)";
    else
    if ($flag == "P")
      $desc .= " (loan made permanent)";
    else
    if ($flag == "R")
      $desc .= "<font color=\"green\"><strong> (Reinstated)</strong></font>";
    else
    if ($flag == "N")
      $desc .= "<font color=\"green\"><strong> (New)</strong></font>";
    else
    if ($flag == "K")
      $desc .= "<font color=\"green\"><strong> (New to Stock)</strong></font>";

    if (!empty($caveat))
      $desc .= " (" . $caveat . ")";
  }
  else
  {
    // this is a loan
    $code = "<font><i>" . $alloc2 . "</i></font>";
    $desc = "<font><i>" . $depot  . " (on loan)";

    if ($flag == "R")
      $desc .= "<font color=\"green\"><strong> (Reinstated)</strong></font>";
    else
    if ($flag == "N")
      $desc .= "<font color=\"green\"><strong> (New)</strong></font>";
    else
    if ($flag == "K")
      $desc .= "<font color=\"green\"><strong> (New to Stock)</strong></font>";

    if (!empty($caveat))
      $desc .= " (" . $caveat . ")</i></font>";
    else
      $desc .= "</i></font>";
  }

  if (!empty($usage))
  {
    $desc .= "<br /><i>(" . $usage . ")</i>";
  }
}

function fn_print_form($url, $arr, $data, $delflag, $page, $id)
{
  $count = 0;

  $html  = "<form method=\"post\" action=\"" . $url . "\">";
  $html .= "<table><tr>";

  foreach ($arr as $i)
  {
    if (strcmp($i['Null'], "NO") == 0)
      $html .= "<th>" . strtoupper($i['Field']) . "</th>";
    else
      $html .= "<th>" . $i['Field'] . "</th>";
  }
  $html .= "<th></th><th></th>";
  $html .= "</tr>";

  $html .= "<tr>";

  for ($loop = 0; $loop <= count($data); $loop++)
  {
    if ($loop < count($data))
      $thisdata = $data[$loop];
    else
      $thisdata = "";

//    print_r($thisdata); echo "<br />";

    foreach ($arr as $i)
    {
      $def = $i['Default']; if ($def == "NULL") $def = "";
      $thisfield = $i['Field'];
      $thisval = $thisdata[$thisfield];

      if (strncmp($i['Type'], "int", 3) == 0)
      {
        list($len) = sscanf($i['Type'], "int(%d)");
        if (empty($thisval))
        {
          if ($i['Default'] == "NULL")
            $thisval = "NULL";
          else
            $thisval = $i['Default'];
        }

        $html .= "<td><input type=\"text\" name=" . $i['Field'] . "[" . $loop . "]" . 
                 " id=\"search-text\" size= "     . $len        .
                 " value=\""                      . $thisval    . "\"" .
                 " maxlength= "                   . $len        . "/></td>\n";
        $html .= "    <input type=\"hidden\" name=" . $i['Field'] . "_oldval[" . $loop . "] value=\"" . $thisval ."\" />\n";
      }
      else
      if (strncmp($i['Type'], "date", 4) == 0)
      {
        if (empty($thisval))
        {
          if ($i['Default'] == "NULL")
          {
            $thisvaly = "NULL";
            $thisvalm = "";
            $thisvald = "";
          }
          else
          {
            $thisvaly = "";
            $thisvalm = "";
            $thisvald = "";
          }
        }
        else
        {
          $lst = explode("-", $thisval);
          $thisvaly = $lst[0];
          $thisvalm = $lst[1];
          $thisvald = $lst[2];
        }

        $html .= "<td><input type=\"text\" name=" . $i['Field'] . "_dd" . "[" . $loop . "]" . 
                 " id=\"search-text\" size=2"                   .
                 " value=\""                      . $thisvald   . "\"" .
                 " maxlength=2"                                 . "/>";
        $html .= "-";
        $html .= "    <input type=\"text\" name=" . $i['Field'] . "_mm" . "[" . $loop . "]" .
                 " id=\"search-text\" size=2"                   .
                 " value=\""                      . $thisvalm   . "\"" .
                 " maxlength=2"                                 . "/>";
        $html .= "-";
        $html .= "    <input type=\"text\" name=" . $i['Field'] . "_yyyy" . "[" . $loop . "]" .
                 " id=\"search-text\" size=4"                   .
                 " value=\""                      . $thisvaly   . "\"" .
                 " maxlength=4 "                                . "/></td>\n";
        $html .= "    <input type=\"hidden\" name=" . $i['Field'] . "_dd_oldval[" . $loop . "] value=\"" . $thisvald ."\" />\n";
        $html .= "    <input type=\"hidden\" name=" . $i['Field'] . "_mm_oldval[" . $loop . "] value=\"" . $thisvalm ."\" />\n";
        $html .= "    <input type=\"hidden\" name=" . $i['Field'] . "_yyyy_oldval[" . $loop . "] value=\"" . $thisvaly ."\" />\n";
      }
      else
      if (strncmp($i['Type'], "char", 4) == 0)
      {
//        print_r($i); echo "[" . $thisval . "]<br />";
        list($len) = sscanf($i['Type'], "char(%d)");
        if (empty($thisval))
        {
          if ($i['Default'] == "NULL")
            $thisval = "NULL";
          else
            $thisval = $i['Default'];
        }

        $html .= "<td><input type=\"text\" name=" . $i['Field'] . "[" . $loop . "]" .
                 " id=\"search-text\" size= "     . $len        .
                 " value=\""                      . $thisval    . "\"" .
                 " maxlength= "                   . $len        . "/></td>\n";

        $html .= "    <input type=\"hidden\" name=" . $i['Field'] . "_oldval[" . $loop . "] value=\"" . $thisval ."\" />\n";
      }
      else
      if (strncmp($i['Type'], "varchar", 7) == 0)
      {
        list($len) = sscanf($i['Type'], "varchar(%d)");
        if (empty($thisval))
        {
          if ($i['Default'] == "NULL")
            $thisval = "NULL";
          else
            $thisval = $i['Default'];
        }

        $html .= "<td><input type=\"text\" name=" . $i['Field'] . "[" . $loop . "]" . 
                 " id=\"search-text\" size= "     . $len        .
                 " value=\""                      . $thisval    . "\"" .
                 " maxlength= "                   . $len        . "/></td>\n";
        $html .= "    <input type=\"hidden\" name=" . $i['Field'] . "_oldval[" . $loop . "] value=\"" . $thisval ."\" />\n";
      }
      else
      if (strncmp($i['Type'], "smallint", 7) == 0)
      {
        list($len) = sscanf($i['Type'], "smallint(%d)");
        if (empty($thisval))
        {
          if ($i['Default'] == "NULL")
            $thisval = "NULL";
          else
            $thisval = $i['Default'];
        }

        $html .= "<td><input type=\"text\" name=" . $i['Field'] . "[" . $loop . "]" .
                 " id=\"search-text\" size= "     . $len        .
                 " value=\""                      . $thisval    . "\"" .
                 " maxlength= "                   . $len        . "/></td>\n";
        $html .= "    <input type=\"hidden\" name=" . $i['Field'] . "_oldval[" . $loop . "] value=\"" . $thisval ."\" />\n";
      }
      else
      if ((strncmp($i['Type'], "tinytext", 8)    == 0) ||
          (strncmp($i['Type'], "text", 3)        == 0) ||
          (strncmp($i['Type'], "mediumtext", 10) == 0) ||
          (strncmp($i['Type'], "longtext", 3)    == 0))
      {
        if (empty($thisval))
        {
          if ($i['Default'] == "NULL")
            $thisval = "NULL";
          else
            $thisval = $i['Default'];
        }

        $html .= "<td><textarea name=" . $i['Field'] . " COLS=25 ROWS=2 "  .
                 " id=\"search-text\" size="     . $len        .
                 " value=\""                     . $thisval    . "\"></TEXTAREA></td>\n";
        $html .= "    <input type=\"hidden\" name=" . $i['Field'] . "_oldval[" . $loop . "] value=\"" . $thisval ."\" />\n";
      }
      else
      if (strncmp($i['Type'], "set", 3) == 0)
      {
        $string = substr(str_ireplace("'", "", $i['Type']), 4, -1);
        $lst = explode(",", $string);
        $html .= "<td><select name=" . $i['Field'] . "[" . $loop . "]>";
        for ($nx = 0; $nx < count($lst); $nx++)
        {
          if (strcmp($thisval, $lst[$nx]) == 0)
            $html .= "<option value=" . $lst[$nx] . " SELECTED>" . $lst[$nx] . "</option>";
          else
            $html .= "<option value=" . $lst[$nx] . ">" . $lst[$nx] . "</option>";
        }

        $html .= "</select></td>\n";
        $html .= "    <input type=\"hidden\" name=" . $i['Field'] . "_oldval[" . $loop . "] value=\"" . $thisval ."\" />\n";
      }
    }

    if ($loop < count($data))
      $html .= "    <input type=\"hidden\" name=\"page[" . $loop . "]\" value=\"" . $page ."\" />\n" .
               "    <input type=\"hidden\" name=\"id[" . $loop . "]\"   value=\"" . $id   . "\" />\n" .
               "<td><input type=\"submit\" id=\"search-submit\" name=\"Del[" . $loop . "]\" value=\"Delete\" /></td>\n" .
               "<td><input type=\"submit\" id=\"search-submit\" name=\"Upd[" . $loop . "]\" value=\"Update\"> </td>\n";
    else
      $html .= "    <input type=\"hidden\" name=\"page[" . $loop . "]\" value=\"" . $page . "\" />\n" .
               "    <input type=\"hidden\" name=\"id[" . $loop . "]\"   value=\"" . $id   . "\" />\n" .
               "<td><input type=\"submit\" id=\"search-submit\" name=\"Ins[" . $loop . "]\" value=\"Insert\" /></td>\n";

    $html .= "</tr>";
  }

  $html .= "</table>";

  return $html;
}

function fn_get_table($table_name, $db)
{
  $qry = "SHOW COLUMNS FROM " . $table_name;

  $result = $db->execute($qry);

  if (!$result)
    die("Failed to run query");

  while ($row = mysqli_fetch_assoc($result))
    $x[] = $row;

  return $x;
}

function debug_memory($reason) 
{
  echo $reason, ': ', memory_get_usage() . "<br />";
}

function fn_get_essay($dblink, $num)
{
  $retval = "No information found!";

  if ($dblink)
  {
    $sql = 'SELECT text
            FROM   essays
            WHERE  essay_id = ' . $num;

    $result = $dblink->execute($sql);

    $row = mysqli_fetch_array($result);

    if (!empty($row))
      $retval = $row['text'];
  }

  return $retval;
}

function fn_icon($str)
{
  switch ($str[0])
  {
    case '-':
      $retval = "<align=center><strong>-</strong>";
      break;
    case 'Y':
      $retval = "<img class=\"progress\" src=\"img/tick_octagon_frame.png\" alt=\"Done\">";
      break;
    case 'N':
      $retval = "<img src=\"img/cross_octagon_frame.png\" alt=\"Not Done\">";
      break;
    default:
      $retval = "Oh Bum!";
    break;
  }

   return $retval;
}

function fn_fmt_s_class($arr)
{
  $tg = "";

  if (!empty($arr['prg_company']))
  {
    if (!empty($arr['big4_company']))
    {
      $tg = $arr['prg_company'] . "/" . $arr['big4_company'];
    }
    else
    {
      $tg = $arr['prg_company'];
    }
  }
  else
  if (!empty($arr['big4_company']))
  {
    $tg = $arr['big4_company'];
  }
  else
  if ($arr['br_standard'] == "Y")
  {
    $tg = "BR Standard";
  }

  if (!empty($arr['surname']))
    $tg .= " " . $arr['surname'] . " ";
  else
    $tg .= " ";

/*
  if (!empty($arr['common_name']))
    $tg .= "\"" . $arr['common_name'] . "\" Class ";
  else
*/
  if (!empty($arr['identifier']))
    $tg .= "\"" . $arr['identifier']  . "\" Class ";

  if (!empty($arr['wheel_arrangement']))
    $tg .= " " . $arr['wheel_arrangement'];
    
  if (!empty($arr['nickname']))
    $tg .= " - '" . $arr['nickname'] . "'";
    
  /* print_r($arr); */

  return $tg;
}



function fn_connectdb($db="1")
{
  if ($db == "1")
  {
//    echo "Ordinary database<br />";
    return new QuickDB("localhost", "brdataba_momo", "D8!7F0xh0und",  "brdataba_live", false, true);
  }
  else
  if ($db == "2")
  {
//    echo "Log database<br />";
    return new QuickDB("localhost", "brdataba_log", "D813D!adem", "brdataba_log",   false, true);
  }
}

function fn_connectforumdb()
{
  return NULL;
}

function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
            }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}


function fn_xdate($inv)
{
  $temp1 = explode("-", $inv);

  return ($temp1[0] - 1700) + (($temp1[1] * (365/12)) + ($temp1[2]/365)) / 365;
}

function fn_datediff($dhigh, $dlow)
{
  if ((($r1 = fn_xdate($dhigh)) > 0) && (($r2 = fn_xdate($dlow)) > 0))
    return round($r1 - $r2, 2);
  else
    return -1;
}

function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
   
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
   
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
   
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
   
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
   
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 

/* Function to print locomotive hyperlink:

  1) width - width of field
  2) type  - S, D or E (Steam, Diesel or Electric)
  3) lid   - loco_id
  4) number - number of loco to print 
*/

function fn_pelem_loco($width, $type, $lid, $number)
{
  printf("<td width=\"%d%%\"><a href=\"locoqry.php?action=locodata&amp;id=%s&amp;type=%s\">%s</a></td>",
             $width, $lid, $type, $number);
  return;
}

/* Simple function to print a td table element - width and value passed as parameters */

function fn_ptdelem($width, $val, $customkey="")
{
  if (!empty($customkey))
    printf("<td width=\"%d%%\" sorttable_customkey=\"%s\">%s</td>\n", $width, $customkey, $val);
  else
    printf("<td width=\"%d%%\">%s</td>\n", $width, $val);
}

function fn_pttooltip($width, $val, $tip, $customkey="")
{
  if (!empty($customkey))
    printf("<td width=\"%d%%\" sorttable_customkey=\"%s\"><span class=\"bubble_tooltip\" onmousemove=\"showToolTip(event,'%s');return false\" onmouseout=\"hideToolTip()\">%s</span></td>\n", $width, $tip, $val);
  else
    printf("<td width=\"%d%%\"><span class=\"bubble_tooltip\" onmousemove=\"showToolTip(event,'%s');return false\" onmouseout=\"hideToolTip()\">%s</span></td>\n", $width, $tip, $val);
}

//<span class="bubble_tooltip" onmousemove="showToolTip(event,'Default search uses a wildcard. For a specific number use a # //e.g. 306#');return false" onmouseout="hideToolTip()"> ?</span>




/* Function to print date (allowing for sortable tables):

  1) width - width of field
  2) date  - date to print
  3) fmt   - optional formatted date for sorting e.g. 19920121
*/

function fn_pelem_date($width, $date, $fmt=NULL)
{
  if ($fmt != NULL)
    printf("<td width=\"%d%%\" sorttable_customkey=\"%s\">%s</td>\n", 
            $width, $fmt, fn_fdate($date));
  else
    printf("<td width=\"%d%%\">%s</td>\n", $width, fn_fdate($date));
}

function fn_get_status($built, $wdn, $cut, $prs, $currdate=NULL)
{
  $str = "Unknown";
  
  if (!empty($cut))
    $str = "<font color=\"red\"><strong>Scrapped</strong></font>";
  else
  if ($prs == "Y")
    $str = "<font color=\"#7E3117\"><strong>Preserved</strong></font>";
  else
  if (empty($cut) && !empty($wdn))
    $str = "<font color=\"orange\"><strong>Awaiting Scrapping</strong></font>";
  else
  if (empty($wdn))
    $str = "<font color=\"green\"><strong>In Service</strong></font>";
  return $str;
}

function getmicrotime(){
  list($usec, $sec) = explode(" ",microtime());
  return ((float)$usec + (float)$sec);
}

function fn_nfrac($num)
{
  $nwhole = floor($num);
  $nfrac  = floor(($num - floor($num)) * 100000) / 100000; // gets rid of very tiny discrepancies

  if ($nx = strpos($num, "."))
  {
    $nwhole = substr($num, 0, $nx);
    $nfrac  = substr($num, $nx+1);
  }
  else
  {
    $nwhole = $num;
    $nfrac = "";
  }

  //printf("[%s] = [%s] . [%s]<br />", $num, $nwhole, $nfrac);

  if (strcmp($nfrac, "0625") == 0)
  {  $numerator = 1; $denominator = 16; }
  else
  if (strcmp($nfrac, "09375") == 0)
  {  $numerator = 3; $denominator = 32; }
  else
  if (strcmp($nfrac, "1") == 0)
  {  $numerator = 1; $denominator = 10; }
  else
  if (strcmp($nfrac, "125") == 0)
  {  $numerator = 1; $denominator = 8; }
  else
  if (strcmp($nfrac, "1875") == 0)
  {  $numerator = 3; $denominator = 16; }
  else
  if (strcmp($nfrac, "2") == 0)
  {  $numerator = 1; $denominator = 5; }
  else
  if (strcmp($nfrac, "21875") == 0)
  {  $numerator = 7; $denominator = 32; }
  else
  if (strcmp($nfrac, "25") == 0)
  {  $numerator = 1; $denominator = 4; }
  else
  if (strcmp($nfrac, "3") == 0)
  {  $numerator = 3; $denominator = 10; }
  else
  if (strcmp($nfrac, "3125") == 0)
  {  $numerator = 5; $denominator = 16; }
  else
  if (strcmp($nfrac, "333") == 0)
  {  $numerator = 1; $denominator = 3; }
  else
  if (strcmp($nfrac, "375") == 0)
  {  $numerator = 3; $denominator = 8; }
  else
  if (strcmp($nfrac, "4") == 0)
  {  $numerator = 2; $denominator = 5; }
  else
  if (strcmp($nfrac, "4375") == 0)
  {  $numerator = 7; $denominator = 16; }
  else
  if (strcmp($nfrac, "5") == 0)
  {  $numerator = 1; $denominator = 2; }
  else
  if (strcmp($nfrac, "5625") == 0)
  {  $numerator = 9; $denominator = 16; }
  else
  if (strcmp($nfrac, "6") == 0)
  {  $numerator = 3; $denominator = 5; }
  else
  if (strcmp($nfrac, "625") == 0)
  {  $numerator = 5; $denominator = 8; }
  else
  if (strcmp($nfrac, "666") == 0)
  {  $numerator = 2; $denominator = 3; }
  else
  if (strcmp($nfrac, "6875") == 0)
  {  $numerator = 11; $denominator = 16; }
  else
  if (strcmp($nfrac, "7") == 0)
  {  $numerator = 7; $denominator = 10; }
  else
  if (strcmp($nfrac, "75") == 0)
  {  $numerator = 3; $denominator = 4; }
  else
  if (strcmp($nfrac, "8") == 0)
  {  $numerator = 4; $denominator = 5; }
  else
  if (strcmp($nfrac, "8125") == 0)
  {  $numerator = 13; $denominator = 16; }
  else
  if (strcmp($nfrac, "875") == 0)
  {  $numerator = 7; $denominator = 8; }
  else
  if (strcmp($nfrac, "9") == 0)
  {  $numerator = 9; $denominator = 10; }
  else
  if (strcmp($nfrac, "9375") == 0)
  {  $numerator = 15; $denominator = 16; }
  else
  {
//echo "Can't do!<br />";
    return $num;
  }

//echo "== " . $numerator .  " " . $denominator . "<br />";

  $str = $nwhole . "<span style=\"font-size: 80%\"><sup>" . $numerator .   "</sup>" .
                                                  "&frasl;" .
                                                  "<sub>" . $denominator . "</sub></span>";

  return $str;
}

function fn_d_pfx($num)
{
  if (strlen($num) < 5 && strlen($num) > 0)
  {
    $bad = 0;

    if (!is_numeric($num))
    {
      $bad = 1;
    }

    if ($bad == 0)
      $num_ret = "D" . $num;
    else
      $num_ret = $num;
  }
  else
    $num_ret = $num;

  return $num_ret;
}


function fn_e_pfx($num)
{
  if ((strlen($num) < 5) ||
      (strlen($num) == 5 && (substr($num, 1, 3) == "260" ||
                             substr($num, 1, 2) == "27")))
  {
    $bad = 0;

    if (!is_numeric($num))
      $bad = 1;

    if ($bad == 0)
      $num_ret = "E" . $num;
    else
      $num_ret = $num;
  }
  else
    $num_ret = $num;
  
  return $num_ret;
}

// Numbers are stored in inches (floating point). Convert to metres/centimetres
function fn_msr_d($num)
{
  if ($num == "")
    $str = "";
  else
  {
    $cent = round($num * 25.3) / 10.0;

//    if ($cent < 100.0)
      $str = $cent . "cm";
//    else
//    {
//      $str = ($cent /= 100.0) . "m";
//    }
  }

  return $str;
}

function fn_msr_i($num)
{
  return fn_feet($num);
}

function fn_feet($num)
{
  if ($num == "")
    $str = "";
  else
  {
    $feet = floor($num / 12);
    $inch = $num - ($feet * 12);

    if ($feet == 0)
    {
      if ($inch == 0)
        $str = "";
      else
        $str = fn_nfrac($inch) . "\"";
    }
    else
    {
      if ($inch == 0)
        $str = $feet . "'";
      else
        $str = $feet . "' " . fn_nfrac($inch) . "\"";
    }
  }
  
  return $str;
}

function fn_area_d($num)
{
  if ($num == "")
    $str = "";
  else
  {
    $m2 = "<span style=\"font-size: 80%\">m<sup>2</sup></sub></span>";
    $val = round($num * 92.903) / 1000.0;
    $str = $val . $m2;
  }
  
  return $str;
}

function fn_area_i($num)
{
  return fn_area($num);
}

function fn_area($num)
{
  if ($num == "")
    $str = "";
  else
  {
    $ft2 = "<span style=\"font-size: 80%\">ft<sup>2</sup></sub></span>";
    $str = $num . $ft2;
  }
  
  return $str;
}

function fn_lbf_d($num)
{
  return fn_lbf($num);
}

function fn_lbf_i($num)
{
  return fn_lbf($num);
}

function fn_lbf($num)
{
  $str = $num;

  return $str;
}

function fn_lbs($num)
{
  if ($num == "")
    $str = "";
  else
  {
    if ($num > 999)
      $str = $num;
  }
  
  return $str;
}

function fn_tons($num)
{
  if ($num == "")
    $str = "";
  else
  {
    // echo $num . "<br />";
    //$num = round($num + 0.00001);
    $tons = floor($num);
    $cwt  = $num - $tons;
//echo $cwt . "<br />";
    $cwt = floor($cwt * 20.00001);
//echo $cwt . "<br />";
    $cwt = fn_nfrac($cwt);
//echo $cwt . "<br />";

    $str = $tons . "t " . $cwt . "cwt";
  }

//echo $num;
//echo $cwt;
  
  return $str;
}

/************************************************************************

Given a number, return it with thousand commas inserted

e.g.

435     ->  435
1021    ->  1,021
1216661 ->  1,216,661


************************************************************************/

function fn_ncomma($num, $sfx = "")
{
  if ($num == "")
    $str = "";
  else
  {
    if ($num <= 999)
      $str = $num . $sfx;
    else
    if ($num <= 999999)
    {
      $str = substr($num, 0, strlen($num) - 3) . "," . substr($num, strlen($num) -3) . $sfx;
    }
    else
    {
      $str = substr($num, 0, strlen($num) - 6) . "," . substr($num, strlen($num) - 6, 3) .
                                                 "," . substr($num, -3) . $sfx;
    }
  }
  
  return $str;
}

function fn_cost($cost, $dec=2)
{
    if (strlen($cost))
    {
      if (strchr($cost, '/'))
      {
        $marr = explode('/', $cost);
        if (count($marr) == 3)
        {
          if ($marr[1] == 0)
            $marr[1] = '-';
           if ($marr[2] == 0)
            $marr[2] = '-';
          $str = "&pound;" . $marr[0] . '/' . $marr[1] . '/' . $marr[2];
        }
        else
        {
          $str = $cost;
        }
      }
      else
      {
        $str = "£" . number_format($cost, $dec, '.', ',');
      }
    }
    else
      $str = "";
      
    return $str;
}

function fn_prd($prd)
{
  switch ($prd[0])
  {
    case 'W':
      $str = "w/e";
      break;
    case '1':
    case '2':
    case '3':
    case '4':
    case '5':
    case '6':
    case '7':
    case '8':
    case '9':
      $str = $prd . "w/e";
      break;
    case 'M':
      $str = "m/e";
      break;
    case 'T':
      $str = "10w/e";
      break;
    case 'Q':
      $str = "q/e";
      break;
    case 'Y':
      $str = "y/e";
      break;
    case 'E':
      $str = "on";
      break;
    case 'B':
      $str = "by";
      break;
    case 'C':
      $str = "c.";
      break;
    default:
      $str = $prd;
    break;
  }

  return $str;
}

function fn_depot99($type)
{
  switch($type[0])
  {
    case 'H':
      $str = "Horwich Works";
      break;
    case 'C':
      $str = "Crewe Works";
      break;
    case 'W':
      $str = "Wolverton Works";
      break;
    case 'R':
      $str = "Research Department";
      break;
    case 'Q':
      $str = "Derby Design Dept.";
      break;
    default:
      $str = "99" . $type;
      break;
  }

  return $str;
}

function fn_depot91($type)
{
  switch($type[0])
  {
    case 'W':
      $str = "To Western Region";
      break;
    case 'S':
      $str = "To Southern Region";
      break;
    case 'M':
      $str = "To London Midland Region";
      break;
    case 'E':
      $str = "To Eastern Region";
      break;
    case 'N':
      $str = "To North Eastern Region";
      break;
    case 'X':
      $str = "To Scottish Region";
      break;
    default:
      $str = "91" . $type;
    break;
  }

  return $str;
}

/************************************************************************

Given a date in YYYY-MM-DD format, return a neater date if the last two 
digits (DD) are 00 (and, in those circumstances, if the MM is also 00)

e.g.

1965-02-00 -> 02/1965
1965-00-00 -> 1965
1965-02-02 -> 02/02/1965

************************************************************************/

function fn_fdate($dt)
{
/*
  $month = array("01" => "Jan",
                 "02" => "Feb",
                 "03" => "Mar",
                 "04" => "Apr",
                 "05" => "May",
                 "06" => "Jun",
                 "07" => "Jul",
                 "08" => "Aug",
                 "09" => "Sep",
                 "10" => "Oct",
                 "11" => "Nov",
                 "12" => "Dec");

  $day   = array("01" => "1st",
                 "02" => "2nd",
                 "03" => "3rd",
                 "04" => "4th",
                 "05" => "5th",
                 "06" => "6th",
                 "07" => "7th",
                 "08" => "8th",
                 "09" => "9th",
                 "10" => "10th",
                 "11" => "11th",
                 "12" => "12th",
                 "13" => "13th",
                 "14" => "14th",
                 "15" => "15th",
                 "16" => "16th",
                 "17" => "17th",
                 "18" => "18th",
                 "19" => "19th",
                 "20" => "20th",
                 "21" => "21st",
                 "22" => "22nd",
                 "23" => "23rd",
                 "24" => "24th",
                 "25" => "25th",
                 "26" => "26th",
                 "27" => "27th",
                 "28" => "28th",
                 "29" => "29th",
                 "30" => "30th",
                 "31" => "31st");
*/

  for ($nx = 0; $nx < strlen($dt); $nx++)
  {
    if (($nx == 4 || $nx == 7) && ($dt[$nx] != '-'))
      return $dt;
    if (($nx != 4 && $nx != 7) && ($dt[$nx] < '0' || $dt[$nx] > '9'))
      return $dt;
  }

  if (strlen($dt))
  {
    if (strcmp(substr($dt, 8, 2), "00") == 0)
    {
      if (strcmp(substr($dt, 5, 2), "00") == 0)
        $str = substr($dt, 0, 4);
      else
      {
//      $str = $month[substr($dt, 5, 2)] . " " . substr($dt, 0, 4);
        $str = substr($dt, 5, 2) . "/" . substr($dt, 0, 4);
      }
    }
    else
    {
//    $str = $day[substr($dt, 8, 2)] . " " . $month[substr($dt, 5, 2)] . " " . substr($dt, 0, 4);
      $str = substr($dt, 8, 2) . "/" . substr($dt, 5, 2) . "/" . substr($dt, 0, 4);
    }
  }
  else
    $str = "";

  return $str;
}

/************************************************************************

Return a string that represents the current status of a preserved loco

************************************************************************/

function fn_preservation_status($str)
{
  switch ($str[0])
  {
    case 'A':
      $ret = "Awaiting Restoration";
      break;
    case 'R':
      $ret = "Under Restoration/Overhaul";
      break;
    case 'D':
      $ret = "Derelict";
      break;
    case 'O':
      $ret = "Operational";
      break;
    case 'U':
      $ret = "Unserviceable";
      break;
    case 'S':
      $ret = "For Spares/Scrap";
      break;
    case 'X':
      $ret = "Static Exhibit";
      break;
    case 'B':
      $ret = "Boiler certificate expired";
      break;
    default:
      $ret = "Unknown";
      break;
  }

  return $ret;
}

function &array_find_element_by_key($key, &$form) {
  printf("Looking for %s in ", $key); print_r($form); printf("<br />\n");
  if (array_key_exists($key, $form)) {
    printf("Found it!<br />\n");
    $ret =& $form[$key];
printf("1: Returning %s<br />\n", $ret);
printf("form[key] = %s<br />\n", $form[$key]);
    return $ret;
  }

  foreach ($form as $k => $v) {
    printf("Checking subarrays<br />\n");
    if (is_array($v)) {
      $ret =& array_find_element_by_key($key, $form[$k]);
      if ($ret) {
        printf("2: Returning : "); print_r($ret); printf("<br />\n");
        return $ret;
      }
    }
  }

  printf("3: Returning : FALSE<br />\n");
  return FALSE;
}

function fn_ip_to_numerical($ip)
{
    $ips=preg_split("/\./",$ip);
    $ipnum=(int)$ips[3]+((int)$ips[2]*256)+((int)$ips[1]*256*256)+((int)$ips[0]*256*256*256);
    return ($ipnum);
}

function fn_locate_ip_2($ip,$needed_info="name", $alternative_loc="")
{
    $ipn=fn_ip_to_numerical($ip);
    #echo "<p>IP: $ip</p>";
    #echo "<p>Numerical: $ipn</p>";
    
    if (empty($alternative_loc))
      $db="lib/IpToCountry.csv";
    else
      $db = $alternative_loc;
      
    #$db="test.txt";
    $lines_num = count(file($db));
    #echo "<p>There are $lines_num lines in the file</p>";
    $fh = fopen($db, "r"); # file handle
    $range_start='';
    $range_end='';
    $country_name='';
    $country_code='';
    $matches=array();
    $i=0;
    $j=0;
    while($i<(int)$lines_num)
    {
      $i=$i+1;
      $line=fgets($fh);
      if (preg_match("/\"(\d+)\",\"(\d+)\",\"(\w+)\",\"(\d+)\",\"(\w+)\",\"(\w+)\",\"([\w\s\(\);]+)\"/",$line,$matches)==1)
      {
        #if ($j==1){next;}
        #echo "<p>line found<p>";
        #echo "the line:<br>".$line."<p>";
        $j++;
        $range_start=(int)$matches[1];
        if ($range_start==0){next;}
        $range_end=(int)$matches[2];
        $country_code=$matches[5];
        $country_name=$matches[7];
        #if ($i<800){echo "range start: $range_start, range end: $range_end, country code: $country_code, country name: $country_name";}
        
        if (($ipn>$range_start && $ipn<$range_end) or $ipn==$range_start or $ipn==$range_end)
        {
            #echo "<p>Country found!</p>";
            if ($needed_info=="name")
            {
                $result=$country_name;
            }
            elseif ($needed_info=="code")
            {
                $result=$country_code;
            }
            break;
        }
      }
    }
    fclose($fh);
    if (!$result){$result="unknown";}
    return ($result);
}

function fn_check_country($ip_addr, $alternative_loc="")
{
  if (empty($alternative_loc))
    $geoip_db="lib/IpToCountry.csv"; # see comments above
  else
    $geoip_db=$alternative_loc; # see comments above
    
  // echo "Using " . $geoip_db . "<br />";

  $geoip_file_exists=file_exists($geoip_db);
  if($geoip_file_exists)
  {
    $geoip_file_detected="<span style=\"color:green\">yes</span>";
  }
  else
  {
    $geoip_file_detected="<span style=\"color:red\">no</span>";
  }
  
  //echo $geoip_file_detected;

  if (1)
  {
    $user_country_name=fn_locate_ip_2($ip_addr, "name", $alternative_loc);
    $user_country_code=fn_locate_ip_2($ip_addr, "code", $alternative_loc);
  }
  
  //echo "Country name: " . $user_country_name . "<br />";
  //echo "Country code: " . $user_country_code . "<br />";
  
  if ((!strcmp($user_country_code, "UA")) ||   // Ukraine
      (!strcmp($user_country_code, "RU")) ||   // Russia
      (!strcmp($user_country_code, "CZ")) ||   // Czech Republic
      (!strcmp($user_country_code, "BN")) ||   // Bangladesh
      (!strcmp($user_country_code, "CN")) ||   // China
      (!strcmp($user_country_code, "RO")) ||   // Romania
      (!strcmp($user_country_code, "PL")) ||   // Poland
      (!strcmp($user_country_code, "BY")) ||   // Belarus
      (!strcmp($user_country_code, "SK")) ||   // Slovakia
      (!strcmp($user_country_code, "MD")) ||   // Moldova
      (!strcmp($user_country_code, "RS")) ||   // Serbia
      (!strcmp($user_country_code, "HU")))     // Hungary
  {
    $dblog = fn_connectdb("2");
    if ($dblog->prep_prepare("INSERT INTO country_deny (ip_address, country_code, country_name) VALUES (?, ?, ?)"))
    {
      $dblog->prep_bind_var('sss', $ip_addr, $user_country_code, $user_country_name);
      $dblog->prep_execute();
      $dblog->prep_close();
    }
    die("");
  }
  
  return $user_country_code;
}
?>
