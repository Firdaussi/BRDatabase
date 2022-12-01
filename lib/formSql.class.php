<?php

class formSql
{
  // Global variables

  private $table = NULL;          // Table name
  private $connection = NULL;     // Open Database Connection
  private $structure = NULL;      // Raw data from table structure query
  private $data = NULL;           // Data stored as an associated array per row
  private $key = NULL;            // Primary Key fields
  private $lookup = NULL;         // Lookup values
  private $lookup_index = 0;      // Lookup values array index
  private $fk_index = 0;

  // Public functions

  public function formSql($db_con)
  {
    if (isset($db_con))
      $this->connection = $db_con;
    else
      die("Invalid connection specified!");
  }

  public function __destruct()
  {
  }

  public function define_table($table_name)
  {
    if (isset($this->table))
      die("Table is already defined!");
    else
      $this->table = $table_name;

    $result = mysqli_query($this->connection, "SHOW COLUMNS FROM " . $this->table);

    if (!$result)
    {
      echo "Could not run query: " . mysqli_error();
      exit;
    }

    if (mysqli_num_rows($result) > 0)
    {
      $nx = 0;
      while ($row = mysqli_fetch_assoc($result))
      {
	      $this->structure[$nx] = $row;
        $this->structure[$nx][$row['Field']] = 0;
        $this->structure[$nx]['LookupIdx'] = -1;
        $this->structure[$nx]['FKIdx'] = -1;

        if (($cx=strchr($row['Type'], "(")))
        {
          list($len) = sscanf($cx, "(%d)");
          if (empty($len)) $len = -1;
        }
        else
          $len = -1;

        if (strstr($row['Type'], "text"))
        {
          if (strcmp($row['Type'], "tinytext") == 0)
            $len = 256;
          else
            $len = 512;
        }

        $this->structure[$nx]["Maxlen"] = $len;

        if (strcmp($row['Key'], "PRI") == 0)
          $this->key[] = $row['Field'];
        $nx++;
      }
    }

    if (!isset($this->key) || empty($this->key))
    {
      print_r($this->structure); echo "<br />";
      die("No unique/primary key defined for table!");
    }
  }

  public function define_fk_src($src_field, $rem_table, $rem_key1, $rem_key2 = "", $rem_key3 = "")
  {
    // has a table been defined yet?
    if (!isset($this->table))
      die("Table has not yet been defined!");

    if (($idx = $this->lfn_get_tabidx($src_field)) == -1)
      die("Source column [" . $src_field . "] not in driving table");
  }

  public function define_lookup($src_field, $rem_field, $rem_table, $rem_record)
  {
    // has a table been defined yet?
    if (!isset($this->table))
      die("Table has not yet been defined!");

    if (($idx = $this->lfn_get_tabidx($src_field)) == -1)
      die("Source column [" . $src_field . "] not in driving table");

    $sql = "SELECT " . $rem_field . " AS k, " . $rem_record . " AS v FROM " . $rem_table;

    $result = mysqli_query($this->connection, $sql);

    if (!$result)
    {
      echo "Could not run query: " . mysqli_error();
      exit;
    }

    $this->structure[$idx]['LookupIdx'] = $this->lookup_index;

    if (mysqli_num_rows($result) > 0)
    {
      $nx = 0;
      while ($row = mysqli_fetch_assoc($result))
        $this->lookup[$this->lookup_index][] = $row;
    }

//    print_r($this->structure); echo "<br /><br />";
//    print_r($this->lookup[$this->lookup_index]); echo "<br />";

    $this->lookup_index++;
  }

  public function fetch_table_structure()
  {
    if (count($this->structure) > 0)
      return $this->structure;
    else
      die("No table defined!");
  }

  public function print_table_structure()
  {
    if (count($this->structure) > 0)
    {
      foreach ($this->structure AS $key => $row)
      {
        print_r($row); echo "<br />";
      }
    }
    else
      die("No table defined!");
  }

  public function do_action($arr)
  {
//    echo "<br />In function do_action()<br />"; print_r($arr); echo "<br />";
    $action = 0;

    $act = $arr['Action']; // print "Action is: " . $act . "<br />";

    if (strncmp($act, "Update_", 7) == 0)
    {
      $action = 1;
      list($idx) = sscanf($act, "Update_%d");
//      echo "Update index " . $idx . "<br />";
    }
    else
    if (strncmp($act, "Delete_", 7) == 0)
    {
      $action = 2;
      list($idx) = sscanf($act, "Delete_%d");
//      echo "Delete index " . $idx . "<br />";
    }
    else
    if (strncmp($act, "Insert_", 7) == 0)
    {
      $action = 3;
      list($idx) = sscanf($act, "Insert_%d");
//     echo "Insert index " . $idx . "<br />";
    }
    else
      die("Unknown action from form!");

    switch ($action)
    {
      case 1:
        $sql = "UPDATE " . $this->table . " SET ";
        // loop through columns in correct order

        for ($nx = $ndiffs = 0; $nx < count($this->structure); $nx++)
        {
          $field = $this->structure[$nx]['Field'];
          $type  = $this->structure[$nx]['Type'];
          $null  = $this->structure[$nx]['Null'];
          $def   = $this->structure[$nx]['Default'];

//          echo "<br />Field: " . $field . ", " . $type . ", " . $null;

          if (strcmp($type, "date") == 0)
          {
            $fieldn_y = $arr[$this->structure[$nx]['Field'] . "_yyyy"][$idx];
            $fieldo_y = $arr[$this->structure[$nx]['Field'] . "_yyyy_oldval"][$idx];
            $fieldn_m = $arr[$this->structure[$nx]['Field'] . "_mm"][$idx];
            $fieldo_m = $arr[$this->structure[$nx]['Field'] . "_mm_oldval"][$idx];
            $fieldn_d = $arr[$this->structure[$nx]['Field'] . "_dd"][$idx];
            $fieldo_d = $arr[$this->structure[$nx]['Field'] . "_dd_oldval"][$idx];

//            print "New Date: [" . $fieldn_y . "]-[" . $fieldn_m . "]-[" . $fieldn_d . "]<br />";
//            print "Old Date: [" . $fieldo_y . "]-[" . $fieldo_m . "]-[" . $fieldo_d . "]<br />";

            if (($fieldn_y <> $fieldo_y) ||
                ($fieldn_m <> $fieldo_m) ||
                ($fieldn_d <> $fieldo_d))
            {
              // difference from current data - check validity
              $err=0;
              if ($fieldn_y < 1825 || $fieldn_y > 2011)
              {
                print "Invalid year: " . $fieldn_y;
                $err++;
              }

              if ($fieldn_m < 0 || $fieldn_m > 12)
              {
                print "Invalid month: " . $fieldn_m;
                $err++;
              }

              if ($fieldn_d < 0 || $fieldn_d > 31)
              {
                print "Invalid day: " . $fieldn_d;
                $err++;
              }

              if ($fieldn_m == 0 && $fieldn_d != 0)
              {
                print "Cannot have zero day if month not zero: " . $fieldn_d . "/" . $fieldn_m;
                $err++;
              }

              if ((($fieldn_m == 4) || ($fieldn_m == 6) || ($fieldn_m == 9) || ($fieldn_m == 11))
                  && $fieldn_d > 30)
              {
                print "Too many days for given month: " . $fieldn_d . "/" . $fieldn_m;
                $err++;
              }
              else
              if ($fieldn_m == 2)
              {
                if ((($fieldn_y % 4 == 0) && ($fieldn_y % 400 != 0) && ($fieldn_d > 29)) ||
                    (($fieldn_y % 4 != 0) && ($fieldn_d > 28)))
                {
                  print "Too many days for given month: " . $fieldn_d . "/" . $fieldn_m;
                  $err++;
                }
              }

              if ($err == 0)
              {
                if ($ndiffs++)
                  $sql .= ", ";

                $n = sprintf("%4d-%02d-%02d", $fieldn_y, $fieldn_m, $fieldn_d);
//                echo "Will insert: " . $n . "<br />";
                
                if ($this->lfn_quoted_value($type))
                  $sql .= $field . " = '" . $n . "'";
                else
                  $sql .= $field . " = "  . $n;
              }
              else
                return;
            }
          }
          else
          {
            // Get old value (o) and new value (n)
            $n = $arr[$field][$idx];
            $o = $arr[$field . "_oldval"][$idx];

            // If they are different, validate new
            if ($n <> $o)
            {
              // if length is important, verify new data is not too long
              if (($this->structure[$nx]['Maxlen'] != -1) &&
                  (strlen($n) > $this->structure[$nx]['Maxlen']))
              {
                print "Value [" . $n . "] too long for field [" . $field . "] (max " .
                      $this->structure[$nx]['Maxlen'] . ")";
                return;
              }

              // check if null value is used where field is not null
              if (empty($n) && strcmp($null, "NO") == 0)
              {
                if (!empty($def))
                  $n = $def;
                else
                {
                  print "Null value for non-Null field [" . $field . "]";
                  return;
                }
              }

              if ($ndiffs++)
                $sql .= ", ";

              if ($this->lfn_quoted_value($type))
                $sql .= $field . " = '" . $n . "'";
              else
                $sql .= $field . " = "  . $n;
            }

//            echo "<br />Comparing " . $n . " with " . $o . " (field=" . $field . ")<br />";
          }
        }

        if ($ndiffs == 0)
        {
          print "No changes for row!";
          return;
        }

        // then add where clause, using old values (in case key values have changed too)
        $sql .= " WHERE ";
        for ($nx = 0; $nx < count($this->key); $nx++)
        {
          $tabidx = $this->lfn_get_tabidx($this->key[$nx]); 
          //echo $this->key[$nx] . ", " . $tabidx;

          if (strstr($this->key[$nx], "date"))
            $v = $this->lfn_build_date($arr, $this->key[$nx], $idx, 1);
          else
            $v = $arr[$this->key[$nx] . "_oldval"][$idx];

          $k = $this->key[$nx];

          if ($nx > 0)
            $sql .= " AND ";

          // if ($nx == 0) print_r($this->structure); echo "<br />";
          if ($this->lfn_quoted_value($this->lfn_get_type($this->key[$nx])))
            $sql .= $k . " = '" . $v . "'";
          else
            $sql .= $k . " = " . $v;
        }
        break;
      case 2:
        // Build the where clause from the primary key 
        $sql = "DELETE FROM " . $this->table . " WHERE ";
        for ($nx = 0; $nx < count($this->key); $nx++)
        {
          $tabidx = $this->lfn_get_tabidx($this->key[$nx]); 
          //echo $this->key[$nx] . ", " . $tabidx;

          if (strstr($this->key[$nx], "date"))
            $v = $this->lfn_build_date($arr, $this->key[$nx], $idx, 0);
          else
            $v = $arr[$this->key[$nx]][$idx];

          $k = $this->key[$nx];

          if ($nx > 0)
            $sql .= " AND ";

          // if ($nx == 0) print_r($this->structure); echo "<br />";

          if ($this->lfn_quoted_value($this->lfn_get_type($this->key[$nx])))
            $sql .= $k . " = '" . $v . "'";
          else
            $sql .= $k . " = " . $v;
        }
        break;
      case 3:
        $sqli = "INSERT into " . $this->table . "(";
        $sqlv = ") VALUES (";

        for ($nx = 0; $nx < count($this->structure); $nx++)
        {
          $field  = $this->structure[$nx]['Field'];
          $type   = $this->structure[$nx]['Type'];
          $null   = $this->structure[$nx]['Null'];
          $def    = $this->structure[$nx]['Default'];
          $maxlen = $this->structure[$nx]['Maxlen'];
          $n = "";

//          printf("%s<br />", $field);
//          printf("%s<br />", $type);
//          printf("%s<br />", $null);
//          printf("%s<br />", $def);
//          printf("%s<br />", $maxlen);

          if ($nx)
          {
            $sqli .= ", ";
            $sqlv .= ", ";
          }

          $sqli .= $field;

          if (strcmp($type, "date") == 0)
          {
            $field_y = $arr[$this->structure[$nx]['Field'] . "_yyyy"][$idx];
            $field_m = $arr[$this->structure[$nx]['Field'] . "_mm"][$idx];
            $field_d = $arr[$this->structure[$nx]['Field'] . "_dd"][$idx];

//            print "Date: [" . $field_y . "]-[" . $field_m . "]-[" . $field_d . "]<br />";

            if (empty($field_y)) print "Year is empty<br />";
            if (empty($field_m)) print "Month is empty<br />";
            if (empty($field_d)) print "Day is empty<br />";
//            print "Null value is: " . $null;

            // check if null value is used where field is not null
            if (empty($field_y) && empty($field_m) && empty($field_d))
            {
//              print "All values are empty<br />";

              if (strcmp($null, "NO") == 0)
              {
                if (!empty($def))
                  $n = $def;
                else
                {
                  print "Null value for non-Null field [" . $field . "]";
                  return;
                }
              }
              else
                $n = "NULL";
            }
            else
            {
//              print "Checking quality of values for " . $n . "<br />";
              $err=0; // report all errors

              if ($field_y < 1825 || $field_y > 2011)
              {
                print "Invalid year: " . $field_y;
                $err++;
              }

              if ($field_m < 0 || $field_m > 12)
              {
                print "Invalid month: " . $field_m;
                $err++;
              }

              if ($field_d < 0 || $field_d > 31)
              {
                print "Invalid day: " . $field_d;
                $err++;
              }

              if ($field_m == 0 && $field_d != 0)
              {
                print "Cannot have zero day if month not zero: " . $field_d . "/" . $field_m;
                $err++;
              }

              if ((($field_m == 4) || ($field_m == 6) || ($field_m == 9) || ($field_m == 11))
                  && $field_d > 30)
              {
                print "Too many days for given month: " . $field_d . "/" . $field_m;
                $err++;
              }

              if ($field_m == 2)
              {
                if ((($field_y % 4 == 0) && ($field_y % 400 != 0) && ($field_d > 29)) ||
                    (($field_y % 4 != 0) && ($field_d > 28)))
                {
                  print "Too many days for given month: " . $field_d . "/" . $field_m;
                  $err++;
                }
              }
            }

            if ($err == 0)
            {
              if ($ndiffs++)
                $sql .= ", ";
//print "1. Calculated date is: " . $n . "<br />";

              if (strcmp($n, "NULL") != 0)
                $n = sprintf("%4d-%02d-%02d", $field_y, $field_m, $field_d);
//print "2. Calculated date is: " . $n . "<br />";
              
              if ((strcmp($n, "NULL") != 0) && $this->lfn_quoted_value($type))
                $sqlv .= "'" . $n . "'";
              else
                $sqlv .= $n;
            }
            else
              return;
          }
          else
          {
            $n = $arr[$field][$idx];

            // if length is important, verify new data is not too long
            if (($this->structure[$nx]['Maxlen'] != -1) &&
                (strlen($n) > $this->structure[$nx]['Maxlen']))
            {
              print "Value [" . $n . "] too long for field [" . $field . "] (max " .
                    $this->structure[$nx]['Maxlen'] . ")";
              return;
            }

            // check if null value is used where field is not null
            if (empty($n) && strcmp($null, "NO") == 0)
            {
              if (!empty($def))
                $n = $def;
              else
              {
                print "Null value for non-Null field [" . $field . "]";
                return;
              }
            }
            else
            if (empty($n))
              $n = "NULL";

            if ((strcmp($n, "NULL") != 0) && $this->lfn_quoted_value($type))
              $sqlv .= "'" . $n . "'";
            else
              $sqlv .= $n;
          }
        }
        $sql = $sqli . $sqlv . ")";
        break;

      default:
        die("Unknown action for form!");
        break;
    }

    // Now execute the SQL
//    echo $sql . "<br />";
    $this->run_query($sql);

    return;
  }

  private function lfn_quoted_value($val)
  {
    if ((strncmp($val, "int",       3) == 0) ||
        (strncmp($val, "smallint",  8) == 0) ||
        (strncmp($val, "mediumint", 9) == 0) ||
        (strncmp($val, "tinyint",   7) == 0) ||
        (strncmp($val, "bigint",    6) == 0) ||
        (strncmp($val, "decimal",   7) == 0) ||
        (strcmp($val, "float")         == 0) ||
        (strcmp($val, "double")        == 0))
      return 0;
    else
      return 1;
  }

  private function lfn_get_type($t)
  {
    for ($nx = 0; $nx < count($this->structure); $nx++)
    {
      if (strcmp($t, $this->structure[$nx]['Field']) == 0)
        return $this->structure[$nx]['Type'];
    }

    return "Error";
  }

  private function lfn_get_tabidx($k)
  {
//    echo count($this->key) . " records in key<br />";
    for ($nx = 0; $nx < count($this->structure); $nx++)
    {
//      echo $nx . ": Checking " . $k . " against " . $this->structure[$nx]['Field'] . "<br />";
      if (strcmp($this->structure[$nx]['Field'], $k) == 0)
        return $nx;
    }

    return -1;
  }

  private function lfn_build_date($arr, $d, $idx, $old)
  {
    if ($old == 1)
    {
      $y = $arr[$d . "_yyyy_oldval"][$idx];
      $m = $arr[$d . "_mm_oldval"][$idx];
      $d = $arr[$d . "_dd_oldval"][$idx];
    }
    else
    {
      $y = $arr[$d . "_yyyy"][$idx];
      $m = $arr[$d . "_mm"][$idx];
      $d = $arr[$d . "_dd"][$idx];
    }

    $dt = sprintf("%4d-%02d-%02d", $y, $m, $d);

    return $dt;
  }

  public function run_query($sql)
  {
    if (!isset($this->table))
      die("Table is not defined!");

    $result = mysqli_query($this->connection, $sql);

    if (!$result)
    {
      echo "Could not run query: (" . $sql . "), " . mysqli_error();
      exit;
    }

    while ($row = mysqli_fetch_assoc($result))
      $this->data[] = $row;
  }

  public function dump_data() // for test purposes only
  {
    if (empty($this->data) || count($this->data) < 1)
      die("No data to publish!");

    for ($nx = 0; $nx < count($this->data); $nx++)
    {
      print_r($this->data[$nx]); echo "<br />";
    }
  }

  public function show_form($target, $page)
  {
    $count = 0;

    print '<form method="post" action="' . $target . '">';
    print '<table><tr>';

    // Print the headers - capitalise the mandatory fields
    foreach ($this->structure as $i)
    {
      if (strcmp($i['Null'], "NO") == 0)
        print '<th>' . strtoupper($i['Field']) . '</th>';
      else
        print '<th>' . $i['Field'] . '</th>';
    }

    print '<th></th><th></th></tr>';

    // loop through all rows in the array (table)
    for ($loop = 0; $loop <= count($this->data); $loop++)
    {
      if ($loop == count($this->data))
        $thisdata = "";
      else
        $thisdata = $this->data[$loop];

      print '<tr>';

      // Loop through all items in table structure array
      foreach ($this->structure as $i)
      {
        // Set the default value (if exists)
        $def = $i['Default']; if ($def == "NULL") $def = "";

        // get current field
        $thisfield = $i['Field'];

        // get current value
        $thisval = $thisdata[$thisfield];

        if ($i['LookupIdx'] != -1)
        {
          print "<td><select name=" . $i['Field'] . "[" . $loop . "]>";
          $lookup = $this->lookup[$i['LookupIdx']];
//echo "FK Data for " . $thisfield .": ";print_r($lookup); echo "<br />";
          for ($nx = 0; $nx < count($lookup); $nx++)
          {
            if (strcmp($thisval, $lookup[$nx]['k']) == 0)
              print '<option value="' . $lookup[$nx]['k'] . '" SELECTED>' . $lookup[$nx]['v'] . '</option>';
            else
              print '<option value="' . $lookup[$nx]['k'] . '">'          . $lookup[$nx]['v'] . '</option>';
          }

          print '</select></td>';
          print '    <input type="hidden" name=' . $i['Field'] . '_oldval[' . $loop . ']' .
                '           value="' . $thisval .'"/>';
        }
        else
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
          print '<td><input type="text"   name=' . $i['Field'] . '[' . $loop . ']' . 
                '           id="search-text" size=' . $len        .
                '           value="'                . $thisval    . '"' .
                '           maxlength='             . $len        . '/></td>';
          print '    <input type="hidden" name=' . $i['Field'] . '_oldval[' . $loop . '] value="' . $thisval .'" />';
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

          print '<td><input type="text" name=' . $i['Field'] . '_dd[' . $loop . ']' . 
                '           id="search-text" size=2'         .
                '           value="'           . $thisvald   . '"' .
                '           maxlength=2/>';
          print '-';
          print     '<input type="text" name=' . $i['Field'] . '_mm[' . $loop . ']' .
                '           id="search-text" size=2'         .
                '           value="'           . $thisvalm   . '"' .
                '           maxlength=2/>';
          print '-';
          print '    <input type="text" name=' . $i['Field'] . '_yyyy[' . $loop . ']' .
                '           id="search-text" size=4'         .
                '           value="'           . $thisvaly   . '"' .
                '           maxlength=4/></td>';
          print '    <input type="hidden" name=' . $i['Field'] . '_dd_oldval[' . $loop . ']' .
                '           value="' . $thisvald . '"/>';
          print '    <input type="hidden" name=' . $i['Field'] . '_mm_oldval[' . $loop . ']' .
                '           value="' . $thisvalm . '"/>';
          print '    <input type="hidden" name=' . $i['Field'] . '_yyyy_oldval[' . $loop . ']' .
                '           value="' . $thisvaly . '"/>';
        }
        else
        if (strncmp($i['Type'], "char", 4) == 0)
        {
          list($len) = sscanf($i['Type'], "char(%d)");

          if (empty($thisval))
          {
            if ($i['Default'] == "NULL")
              $thisval = "NULL";
            else
              $thisval = $i['Default'];
          }

          print '<td><input type="text" name=' . $i['Field'] . '[' . $loop . ']' .
                '           id="search-text" size=' . $len   .
                '           value="'                . $thisval    . '"' .
                '           maxlength='             . $len        . '/></td>';

          print '    <input type="hidden" name=' . $i['Field'] . '_oldval[' . $loop . ']' .
                '           value="' . $thisval .'"/>';
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

          print '<td><input type="text" name=' . $i['Field'] . '[' . $loop . ']' .
                '           id="search-text" size=' . $len   .
                '           value="'                . $thisval    . '"' .
                '           maxlength='             . $len        . '/></td>';

          print '    <input type="hidden" name=' . $i['Field'] . '_oldval[' . $loop . ']' .
                '           value="' . $thisval .'"/>';
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

          print '<td><input type="text" name=' . $i['Field'] . '[' . $loop . ']' .
                '           id="search-text" size=' . $len   .
                '           value="'                . $thisval    . '"' .
                '           maxlength='             . $len        . '/></td>';

          print '    <input type="hidden" name=' . $i['Field'] . '_oldval[' . $loop . ']' .
                '           value="' . $thisval .'"/>';
        }
        else
        if ((strncmp($i['Type'], "tinytext", 8)    == 0) ||
            (strncmp($i['Type'], "text", 4)        == 0) ||
            (strncmp($i['Type'], "mediumtext", 10) == 0) ||
            (strncmp($i['Type'], "longtext", 8)    == 0))
        {
          if (empty($thisval))
          {
            if ($i['Default'] == "NULL")
              $thisval = "NULL";
            else
              $thisval = $i['Default'];
          }

          if (strcmp($i['Type'], "tinytext") == 0)
            $len = 256;
          else
            $len = 512;

          print '<td><textarea name=' . $i['Field'] . '[' . $loop . '] COLS=25 ROWS=2 '  .
                '              id="search-text" size='  . $len .
                '              value="'   . htmlspecialchars($thisval) . '">' . htmlspecialchars($thisval) . '</textarea></td>';
          print '    <input type="hidden" name=' . $i['Field'] . '_oldval[' . $loop . ']' .
                '           value="' . $thisval . '"/>';
        }
        else
        if (strncmp($i['Type'], "set", 3) == 0)
        {
          $string = substr(str_ireplace("'", "", $i['Type']), 4, -1);
          $lst = explode(",", $string);
          print "<td><select name=" . $i['Field'] . "[" . $loop . "]>";
          for ($nx = 0; $nx < count($lst); $nx++)
          {
            if (strcmp($thisval, $lst[$nx]) == 0)
              print '<option value="' . $lst[$nx] . '" SELECTED>' . $lst[$nx] . '</option>';
            else
              print '<option value="' . $lst[$nx] . '">'          . $lst[$nx] . '</option>';
          }

          print '</select></td>';
          print '    <input type="hidden" name=' . $i['Field'] . '_oldval[' . $loop . ']' .
                '           value="' . $thisval .'"/>';
        }
        else
        {
          $msg = sprintf("Do not know how to handle %s records", $i['Type']);
          die($msg);
        }
      }

      if ($loop == count($this->data))
        print '    <input type="hidden" name="page" value="' . $page . '" />' .
              '    <input type="hidden" name="id['   . $loop . ']" value="' . $id   . '" />' .
              '<td><input type="submit" id="search-submit" name="Action"' .
              '           value="Insert_' . $loop . '" /></td>';
      else
        print '    <input type="hidden" name="page" value="' . $page . '" />' .
              '    <input type="hidden" name="id['   . $loop . ']" value="' . $id   . '" />' .
              '<td><input type="submit" id="search-submit" name="Action"' .
              '           value="Delete_' . $loop . '"/> </td>' .
              '<td><input type="submit" id="search-submit" name="Action"' .
              '           value="Update_' . $loop . '"/> </td>';

      print '</tr>';
    }

    print '</table>';
  }
}

?>