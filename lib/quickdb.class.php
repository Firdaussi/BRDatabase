<?php

    #########################################################
    #            QuickDB->MySQL Wrapper Class               #
    #-------------------------------------------------------#
    #    Author: SARFRAZ AHMED CHANDIO                      #
    #            Web Developer                              #
    #            The Brains                                 #
    #            http://www.brainstech.com                  #
    #            http://sarfraz-ahmed.blogspot.com/         #
    #                                                       #
    #    Date Created: 12 April 2009                        #
    #########################################################

    #-------------------------------------------------------#
    #     +++ Future Additions +++                          #
    #-------------------------------------------------------#
    #    Paging                                             #
    #    Multi-Language Support                             #
    #-------------------------------------------------------#



    class QuickDB
    {
        private $con             = null;        // for db connection
        private $result          = null;        // for mysql result resource id
        private $row             = null;        // for fetched row
        private $rows            = null;        // for number of rows fetched
        private $affected        = null;        // for number of rows affected
        private $insert_id       = null;        // for last inserted id
        private $query           = null;        // for the last run query
        private $show_errors     = null;        // for knowing whether to display errors
        private $emsg            = null;        // for mysql error description
        private $eno             = null;        // for mysql error number
        private $stmt            = null;        // IJ - for prepared statements
        
        private $logit           = 1;           // IJ - added to log errors (1) or errors/normal queries (2). Use 0 for no logging.
        
        // Intialize the class with connection to db
        public function __construct($host, $user, $password, $db, $persistent = false, $show_errors = false)
        {
            if ($show_errors == true)
            {
                $this->show_errors = true;
            }
            
            if ($persistent == true)
            {
                $this->con = @mysqli_pconnect($host, $user, $password);
            }
            else
            {
                $this->con = @mysqli_connect($host, $user, $password);
            }
            
            if ($this->con)
            {
                $result = mysqli_select_db($this->con, $db) or die("Could Not Select The Database !!");
                return $result;
            }
            else
            {
                die("Could Not Establish The Connection !!");
            }
        }
        
        // Close the connection to database
        public function __destruct()
        {
            $this->close();
        }

        // Close the connection to database
        public function close()
        {
            $result = @mysqli_close($this->con);
            return $result;
        }

        public function get_connection()
        {
            return $this->con;
        }

        public function prep_prepare($command)
        {
            $this->stmt = mysqli_prepare($this->con, $command); // returns statement
            return $this->stmt;
        }
    
        public function prep_bind_var($type, $v01, $v02=null, $v03=null, $v04=null, $v05=null, $v06=null, $v07=null, $v08=null, $v09=null)
        {
            if ($this->stmt)
            {
              if (!empty($v09))
                mysqli_stmt_bind_param($this->stmt, $type, $v01, $v02, $v03, $v04, $v05, $v06, $v07, $v08, $v09);
              else if (!empty($v08))
                mysqli_stmt_bind_param($this->stmt, $type, $v01, $v02, $v03, $v04, $v05, $v06, $v07, $v08);
              else if (!empty($v07))
                mysqli_stmt_bind_param($this->stmt, $type, $v01, $v02, $v03, $v04, $v05, $v06, $v07);
              else if (!empty($v06))
                mysqli_stmt_bind_param($this->stmt, $type, $v01, $v02, $v03, $v04, $v05, $v06);
              else if (!empty($v05))
                mysqli_stmt_bind_param($this->stmt, $type, $v01, $v02, $v03, $v04, $v05);
              else if (!empty($v04))
                mysqli_stmt_bind_param($this->stmt, $type, $v01, $v02, $v03, $v04);
              else if (!empty($v03))
                mysqli_stmt_bind_param($this->stmt, $type, $v01, $v02, $v03);
              else if (!empty($v02))
                mysqli_stmt_bind_param($this->stmt, $type, $v01, $v02);
              else
                mysqli_stmt_bind_param($this->stmt, $type, $v01);
            }
        }
/*
	public function prep_bind_result(&$v01,      &$v02=null, &$v03=null, &$v04=null, &$v05=null, &$v06=null, &$v07=null, &$v08=null, &$v09=null, &$v10=null,
	                                 &$v11=null, &$v12=null, &$v13=null, &$v14=null, &$v15=null, &$v16=null, &$v17=null, &$v18=null, &$v19=null, &$v20=null,
	                                 &$v21=null, &$v22=null, &$v23=null, &$v24=null, &$v25=null, &$v26=null, &$v27=null, &$v28=null, &$v29=null, &$v30=null)
        {
            if ($this->stmt)
            {
              if (!empty($v10))
                mysqli_stmt_bind_result($this->stmt, $v01, $v02, $v03, $v04, $v05, $v06, $v07, $v08, $v09, $v10);
              else if (!empty($v09))
                mysqli_stmt_bind_result($this->stmt, $v01, $v02, $v03, $v04, $v05, $v06, $v07, $v08, $v09);
              else if (!empty($v08))
                mysqli_stmt_bind_result($this->stmt, $v01, $v02, $v03, $v04, $v05, $v06, $v07, $v08);
              else if (!empty($v07))
                mysqli_stmt_bind_result($this->stmt, $v01, $v02, $v03, $v04, $v05, $v06, $v07);
              else if (!empty($v06))
                mysqli_stmt_bind_result($this->stmt, $v01, $v02, $v03, $v04, $v05, $v06);
              else if (!empty($v05))
                mysqli_stmt_bind_result($this->stmt, $v01, $v02, $v03, $v04, $v05);
              else if (!empty($v04))
                mysqli_stmt_bind_result($this->stmt, $v01, $v02, $v03, $v04);
              else if (!empty($v03))
                mysqli_stmt_bind_result($this->stmt, $v01, $v02, $v03);
              else if (!empty($v02))
                mysqli_stmt_bind_result($this->stmt, $v01, $v02);
              else
                mysqli_stmt_bind_result($this->stmt, $v01);
            }
        }
*/
        public function prep_execute()
        {
            if ($this->stmt)
                mysqli_stmt_execute($this->stmt);
                
            return(mysqli_stmt_affected_rows($this->stmt));
        }
        
        public function prep_fetch()
        {
            if ($this->stmt)
        	mysqli_stmt_fetch($this->stmt);
        }
        
        public function prep_close()
        {
          if ($this->stmt)
            mysqli_stmt_close($this->stmt);
          $this->stmt = NULL;
        }

        // stores mysql errors
        private function setError($msg, $no)
        {
            $this->emsg = $msg;
            $this->eno = $no;
            
            if ($this->show_errors == true)
            {
                print '    <br /><br /><div style="background:#f6f6f6; padding:5px; font-size:13px; font-family:verdana; border:1px solid #cccccc;">
                        <span style="color:#ff0000;">MySQL Error Number</span> : ' . $no . '<br />
                        <span style="color:#ff0000;">MySQL Error Message</span> : ' . $msg . '</div><br />';
            }
        }
        
    
        #################################################
        #                General Functions                #
        #################################################
    
        // Runs the SQL query (general execute query function)
        public function execute($command)
        {
            # Params:
            #         $command = query command
            
            if (!$command)
            {
                exit("No Query Command Specified !!");
            }
            
            $this->query = $command;
            
            // For Operational query
            if     (
                (stripos($command, "insert ") !== false) ||
                (stripos($command, "update ") !== false) ||
                (stripos($command, "delete ") !== false) ||
                (stripos($command, "replace ") !== false)
                )
            {
                $this->result = mysqli_query($this->con, $command) or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));

                if (stripos($command, "insert ") !== false)
                {
                    if ($this->result)
                    {
                        $this->insert_id = intval(mysqli_insert_id($this->con));
                    }
                }

                if ($this->result)
                {
                    $this->affected = intval(mysqli_affected_rows($this->con));
                    // return the number of rows affected
                    return $this->affected;
                }
            }
            else
            {
                // For Selection query
                $this->result = mysqli_query($this->con, $command); // or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));
                if ($this->result)
                {
                    $this->rows = intval(mysqli_num_rows($this->result));
                    // return the query resource for later processing
                    
                    if ($this->logit == 2)
                    {
                            $quickdb_file = @fopen("logs/quickdb.log", 'a');
                            @fwrite($quickdb_file, "***************************************************************************\n");
                            $tm = "1: " . date("D M j G:i:s T Y") . "\n\n";
                            @fwrite($quickdb_file, $tm);
                            @fwrite($quickdb_file, $command);
                            @fwrite($quickdb_file, "\n");
                            @fclose($quickdb_file);
                    }
                    
                    return $this->result;
                }
                else
                {
                    if ($this->logit)
                    {
                            $quickdb_file = @fopen("logs/quickdb.log", 'a');
                            @fwrite($quickdb_file, "***************************************************************************\n");
                            $tm = "2: " . date("D M j G:i:s T Y") . "\n\n";
                            @fwrite($quickdb_file, $tm);
                            @fwrite($quickdb_file, $command);
                            @fwrite($quickdb_file, "\n");
                            @fclose($quickdb_file);
                        }
                        
                        $this->setError(mysqli_error($this->con), mysqli_errno($this->con));
                }
            }
        }    

        // Gets records from table
        public function select($table, $rows = "*", $condition = null, $order = null)
        {
            # Params:
            #         $table = the name of the table
            #        $rows = rows to be selected
            #         $condition = example: where id = 99
            #        $order = ordering field name

            if (!$table)
            {
                exit("No Table Specified !!");
            }
            
            $sql = "select $rows from $table";

            if($condition)
            {
                $sql .= ' where ' . $condition;
            }
            else if($order)
            {
                $sql .= ' order by ' . $order;
            }

            $this->query = $sql;
            $this->result = mysqli_query($this->con, $sql) or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));

            if ($this->result)
            {
                $this->rows = intval(mysqli_num_rows($this->result));
                // return the query resource for later processing
                return $this->result;
            }
        }    


        // Inserts records
        public function insert($table, $data)
        {
            # Params:
            #         $table = the name of the table
            #         $data = field/value pairs to be inserted
            
            if ($table)
            {
                if ($data)
                {
                    $this->result = mysqli_query($this->con, "insert into $table set $data") or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));
                    $this->query = "insert into $table set $data";

                    if ($this->result)
                    {
                        $this->affected = intval(mysqli_affected_rows($this->con));
                        $this->insert_id = intval(mysqli_insert_id($this->con));
                        // return the number of rows affected
                        return $this->affected;
                    }
                }
                else
                {
                    print "No Data Specified !!";
                }
            }
            else
            {
                print "No Table Specified !!";
            }
        }

        // Updates records
        public function update($table, $data, $condition)
        {
            # Params:
            #         $table = the name of the table
            #         $data = field/value pairs to be updated
            #         $condition = example: where id = 99

            if ($table)
            {
                if ($data)
                {
                    if ($condition)
                    {
                        $this->result = mysqli_query($this->con, "update $table set $data where $condition") or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));
                        $this->query = "update $table set $data where $condition";

                        if ($this->result)
                        {
                            $this->affected = intval(mysqli_affected_rows($this->con));
                            // return the number of rows affected
                            return $this->affected;
                        }
                    }
                    else
                    {
                        print "No Condition Specified !!";
                    }
                }
                else
                {
                    print "No Data Specified !!";
                }
            }
            else
            {
                print "No Table Specified !!";
            }
        }

        // Deletes records
        public function delete($table, $condition)
        {
            # Params:
            #         $table = the name of the table
            #         $condition = example: where id = 99

            if ($table)
            {
                if ($condition)
                {
                    $this->result = mysqli_query($this->con, "delete from $table where $condition") or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));
                    $this->query = "delete from $table where $condition";

                    if ($this->result)
                    {
                        $this->affected = intval(mysqli_affected_rows($this->con));
                        // return the number of rows affected
                        return $this->affected;
                    }
                }
                else
                {
                    print "No Condition Specified !!";
                }
            }
            else
            {
                print "No Table Specified !!";
            }
        }

        // returns table data in array
        public function load_array()
        {
            $arr = array();
            
            while ($row = mysqli_fetch_array($this->result))
            {
                $arr[] = $row;
            }

            return $arr;
        }

        // returns table data in array
        public function load_array_assoc()
        {
            $arr = array();
            
            while ($row = mysqli_fetch_assoc($this->result))
            {
                $arr[] = $row;
            }

            return $arr;
        }


        // print a complete table from the specified table
        public function get_html($command, $display_field_headers = true, $table_attribs = 'border="0" cellpadding="3" cellspacing="2" style="padding-bottom:5px; border:1px solid #cccccc; font-size:13px; font-family:verdana;"')
        {
            if (!$command)
            {
                exit("No Query Command Specified !!");
            }

            $this->query = $command;
            $this->result = mysqli_query($this->con, $command) or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));
            
            if ($this->result)
            {
                $this->rows = intval(mysqli_num_rows($this->result));
                
                $num_fields = mysqli_num_fields($this->result);

                print '<br /><br /><div>
                        <table ' . $table_attribs . '>'
                        . "\n" . '<tr>';

                if ($display_field_headers == true)
                {
                    // printing table headers
                    for($i = 0; $i < $num_fields; $i++)
                    {
                        $field = mysqli_fetch_field($this->result);
                        print "<td bgcolor='#f6f6f6' style=' border:1px solid #cccccc;'><strong style='color:#666666;'>" . ucwords($field->name) . "</strong></td>\n";
                    }
                    print "</tr>\n";
                }
                
                // printing table rows
                while($row = mysqli_fetch_row($this->result))
                {
                    print "<tr>";
                
                    foreach($row as $td)
                    {
                        print "<td bgcolor='#f6f6f6'>$td</td>\n";
                    }
                
                    print "</tr>\n";
                }
                print "</table></div><br /><br />";
            }
        }
        
        
        public function last_insert_id()
        {
            if ($this->insert_id)
            {
                return $this->insert_id;
            }
        }
        
        // Counts all records from a table
        public function count_all($table)
        {
            if (!$table)
            {
                exit("No Table Specified !!");
            }
            
            $this->result = mysqli_query($this->con,"select count(*) as total from $table") or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));
            $this->query = "select count(*) as total from $table";

            if ($this->result)
            {
                $this->row = mysqli_fetch_array($this->result);
                return intval($this->row["total"]);
            }
        }
        
        // Counts records based on specified criteria
        public function count_rows($command)
        {
            # Params:
            #         $command = query command

            if (!$command)
            {
                exit("No Query Command Specified !!");
            }
        
            $this->query = $command;
            $this->result = mysqli_query($this->con, $command) or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));

            if ($this->result)
            {
                return intval(mysqli_num_rows($this->result));
            }
        }

        // Updates a row if it exists or adds if it doesn't already exist.
        public function insert_update($table, $data, $condition)
        {
            # Params:
            #         $table = the name of the table
            #         $data = field/value pairs to be added/updated
            #         $condition = example: where id = 99

            if ($table)
            {
                if ($data)
                {
                    if ($condition)
                    {
                        if ($this->row_exists("select * from $table where $condition"))
                        {
                            $this->result = mysqli_query($this->con, "update $table set $data where $condition") or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));
                            $this->query = "update $table set $data where $condition";

                            if ($this->result)
                            {
                                $this->affected = intval(mysqli_affected_rows($this->con));
                                // return the number of rows affected
                                return $this->affected;
                            }
                        }
                        else
                        {
                            $this->result = mysqli_query($this->con, "insert into $table set $data") or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));
                            $this->query = "insert into $table set $data";

                            if ($this->result)
                            {
                                $this->insert_id = intval(mysqli_insert_id());
                                $this->affected = intval(mysqli_affected_rows($this->con));
                                // return the number of rows affected
                                return $this->affected;
                            }
                        }
                    }
                    else
                    {
                        print "No Condition Specified !!";
                    }
                }
                else
                {
                    print "No Data Specified !!";
                }
            }
            else
            {
                print "No Table Specified !!";
            }
        }


        // Runs the sql query with claus "limit x, x"
        public function select_limited($table, $start, $return_count, $condition = null, $order = null)
        {
            # Params:
            #         $start = starting row for limit clause
            #         $return_count = number of records to fetch
            #         $condition = example: where id = 99
            #         $order = ordering field name
            
            if ($table && $start >= 0 && $return_count)
            {
                if ($condition)
                {
                    if ($order)
                    {
                        $this->result = mysqli_query($this->con, "select * from $table where $condition order by $order limit $start, $return_count") or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));
                        $this->query = "select * from $table where $condition order by $order limit $start, $return_count";
                    }
                    else
                    {
                        $this->result = mysqli_query($this->con, "select * from $table where $condition limit $start, $return_count") or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));
                        $this->query = "select * from $table where $condition limit $start, $return_count";
                    }
                }
                else
                {
                    if ($order)
                    {
                        $this->result = mysqli_query($this->con, "select * from $table order by $order limit $start, $return_count") or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));
                        $this->query = "select * from $table order by $order limit $start, $return_count";
                    }
                    else
                    {
                        $this->result = mysqli_query($this->con, "select * from $table limit $start, $return_count") or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));
                        $this->query = "select * from $table limit $start, $return_count";
                    }
                }

                if ($this->result)
                {
                    $this->rows = intval(mysqli_num_rows($this->result));
                    // return the query resource for later processing
                    return $this->result;
                }
            }
            else
            {
                print "Parameter Missing !!";
            }
        }    

        
        #################################################
        #                Utility Functions                #
        #################################################

        // Counts rows from last Select query
        public function count_select()
        {
            if ($this->rows)
            {
                return $this->rows;
            }
        }

        // Gets the number of affected rows after Operational query has executed
        public function count_affected()
        {
            if ($this->affected)
            {
                return $this->affected;
            }
        }

        // Checks whether a table has records        
        public function has_rows($table)
        {
            $rows = $this->count_all($table);
            
            if ($rows)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        // Checks whether or not a row exists with specified criteria
        public function row_exists($command)
        {
            # Params:
            #         $command = query command

            if (!$command)
            {
                exit("No Query Command Specified !!");
            }
        
            $this->query = $command;
            $this->result = mysqli_query($command) or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));

            if ($this->result)
            {
                if (mysqli_num_rows($this->result))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }

        // Returns single fetched row
        public function fetch_row($command)
        {

            if (!$command)
            {
                exit("No Query Command Specified !!");
            }

            $this->query = $command;
            $this->result = mysqli_query($this->con, $command) or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));

            if ($this->result)
            {
                $this->rows = intval(mysqli_num_rows($this->result));
                $this->row = mysqli_fetch_array($this->result);
                return $this->row;
            }
        }
        
        // Returns single fetched row
        public function fetch_row_assoc($command)
        {

            if (!$command)
            {
                exit("No Query Command Specified !!");
            }

            $this->query = $command;
            $this->result = mysqli_query($this->con, $command) or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));

            if ($this->result)
            {
                $this->rows = intval(mysqli_num_rows($this->result));
                $this->row = mysqli_fetch_assoc($this->result);
                return $this->row;
            }
        }
        
        
        // Returns single field value
        public function fetch_value($table, $field, $condition = null)
        {

            if (!$table || !$field)
            {
                exit("Arguments Missing !!");
            }

            $query = "select $field from $table";
            
            if ($condition != null)
            {
                $query = "select $field from $table where $condition";
            }
            
            $this->query = $query;
            $this->result = mysqli_query($this->con, $query) or $this->setError(mysqli_error($this->con), mysqli_errno($this->con));

            if ($this->result)
            {
                $this->rows = intval(mysqli_num_rows($this->result));
                $this->row = mysqli_fetch_array($this->result);
                return $this->row->$field;
            }
        }
        
        
        // Returns the last run query
        public function last_query()
        {
            if ($this->query)
            {
                return $this->alert_msg($this->query);
            }
        }
        
        
        // Gets today's date
        public function get_date($format = null)
        {
            # Params:
            #        $format = date format like Y-m-d
            
            if ($format)
            {
                $today = date($format);
            }
            else
            {
                $today = date("Y-m-d");
            }
            
            return $today;
        }
        
        // Gets currents time
        public function get_time($format = null)
        {
            # Params:
            #        $format = date format like H:m:s
            
            if ($format)
            {
                $time = date($format);
            }
            else
            {
                $time = date("H:m:s");
            }
            
            return $time;
        }

        // Adds slash to the string irrespective of the setting of getmagicquotesgpc
        public function smartslashes($value)
        {
            if (get_magic_quotes_gpc())
            {
                $value = stripslashes($value);
            }

            if (!is_numeric($value))
            {
                $value = mysqli_real_escape_string($value);
            }
            
            return $value;
        } 
        
        // This function can be used to discard any characters that can be used to manipulate the SQL queries or SQL injection

        /* EXAMPLE USE:
        
            if (is_valid($_REQUEST["username"]) === true && is_valid($_REQUEST["pass"]) === true)
            {
                //login now
            }
        */
        
        public function is_valid($input)
        {
            $input = strtolower($input);
            
            if (str_word_count($input) > 1)
            {
                $loop = "true";
                $input = explode(" ",$input);
            }
            
            $bad_strings = array("'","--","select","union","insert","update","like","delete","1=1","or");
        
            if ($loop)
            {
                foreach($input as $value)
                {
                    if (in_array($value, $bad_strings))
                    {
                      return false;
                    }
                    else
                    {
                      return true;
                    }
                }
            }
            else
            {
                if (in_array($input, $bad_strings))
                {
                  return false;
                }
                else
                {
                  return true;
                }
            }
        }

    
        // lists tables of database
        public function list_tables()
        {
            $this->result = mysqli_query($this->con, "show tables");
            $this->query = "show tables";
            
            if ($this->result)
            {
                $tables = array();
                while($row = mysqli_fetch_array($this->result))
                {
                    $tables[] = $row[0];
                }
                
                foreach ($tables as $table)
                {
                    print $table . "<br />";
                }
            }
        }


        // provides info about given table
        public function table_info($table)
        {
            if ($table)
            {
                $this->result = mysqli_query($this->con, "select * from " . $table);
                $this->query = "select * from $table";

                $fields = mysql_num_fields($this->result);echo $fields;
                $rows   = mysql_num_rows($this->result);echo $rows;
                $table  = mysql_field_table($this->result, 0); echo $table;

                print "    The '<strong>" . $table . "</strong>' table has <strong>" . $fields . "</strong> fields and <strong>" . $rows . "</strong>
                        record(s) with following fields.\n<br /><ul>";

                for ($i=0; $i < $fields; $i++)
                {
                    $type  = mysql_field_type($this->result, $i);
                    $name  = mysql_field_name($this->result, $i);
                    $len   = mysql_field_len($this->result, $i);
                    $flags = mysql_field_flags($this->result, $i);
                    
                    print "<strong><li>" . $type . " " . $name . " " . $len . " " . $flags . "</strong></li>\n";
                }
                print "</ul>";
                
            }
            else
            {
                print "The table not specified !!";
            }
        }


        // displays any mysql errors generated
        public function display_errors()
        {
            if ($this->show_errors == false)
            {
                if ($this->emsg)
                {
                    print '    <br /><br /><div style="background:#f6f6f6; padding:5px; font-size:13px; font-family:verdana; border:1px solid #cccccc;">
                            <span style="color:#ff0000;">MySQL Error Number</span> : ' . $this->eno . '<br />
                            <span style="color:#ff0000;">MySQL Error Message</span> : ' . $this->emsg . '</div>';
                }
                else
                {
                    print '    <br /><br /><div style="background:#f6f6f6; padding:5px; font-size:13px; font-family:verdana; border:1px solid #cccccc;">
                            <strong>No Erros Found !!</strong>
                            </div>';
                }
            }
        }

        // to display success message
        public function success_msg($msg)
        {
            print '    <br /><br /><div align="center" style="background:#EEFDD7; padding:5px; font-size:13px; font-family:verdana; border:1px solid #8DD607;">
                    ' . $msg . '
                    </div><br />';
        }
    
        // to display failure message
        public function failure_msg($msg)
        {
            print '    <br /><br /><div align="center" style="background:#FFF2F2; padding:5px; font-size:13px; font-family:verdana; border:1px solid #FF8080;">
                    ' . $msg . '
                    </div><br />';
        }

        // to display general alert message
        public function alert_msg($msg)
        {
            print '    <br /><br /><div align="center" style="background:#FFFFCC; padding:5px; font-size:13px; font-family:verdana; border:1px solid #CCCC33;">
                    ' . $msg . '
                    </div><br />';
        }

    ////////////////////////////////////////////////////////
    }

?>