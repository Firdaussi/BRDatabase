<?php

class MyTables
{
  private $p_width   = NULL;       // Table width
  private $p_lwidth  = NULL;       // Table width
  private $p_remwidth= NULL;       // For row based table, how wide are remaining columns after
                                   // the row header has been displayed
  private $p_frame   = NULL;       // Table frame format
  private $p_tableid = NULL;       // for CSS
  private $p_align   = NULL;       // align the table Horizontally or Vertically
  private $p_coltot  = 0;          // Total of all column widths
  private $p_colnum  = 0;          // Number of columns
  private $pa_colh   = NULL;       // Column heading
  private $pa_colw   = NULL;       // Column width
  private $pa_cola   = NULL;       // Column alias
  private $pa_coli   = 0;          // Column is an image url
  private $centred   = NULL;       // Column contents are centred
  private $p_rownum  = 0;          // Number of rows
  private $pa_rowh   = NULL;       // Row heading
  private $pa_roww   = NULL;       // Row width
  private $pa_rowa   = NULL;       // Row alias
  private $dataarr   = NULL;       // store the data
  private $p_sortable = FALSE;     // Sortable table
  private $p_data    = 0;          // Number of rows in the table
  private $p_caption = NULL;       // Caption for table
  private $p_caption_hl = NULL;    // Caption hyperlink for table (for editing as manager)
  private $p_colour  = 0;          // Use colour for steam, diesel or electric based on 'type' field
  private $p_suppress_nulls = 0;   // Suppress NULL values in horizontal tables
  private $html_code = NULL;       // code for use in printing pdf documents
  private $p_rollover = "N";       // Allow rollover highlighting

  private $gnx = 0;
  private $p_debug = 0;

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function __construct($id, $width = 99)
  {
    $this->p_width = $width;
    $this->p_lwidth = NULL;
    $this->p_frame = "box";
    $this->p_align = "H";

    $this->pa_colh = array();
    $this->pa_colw = array();
    $this->pa_cola = array();
    $this->dataarr = array();
    $this->p_tableid = $id;

    if ($this->p_debug)
      echo memory_get_usage() . "\n";
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function __destruct()
  {
    if ($this->p_debug)
      echo "Destruction!!!" . "\n";
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  private function l_getmicrotime(){
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function suppress_nulls()
  {
    $this->p_suppress_nulls = 1;
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function allow_rollover()
  {
    $this->p_rollover = "Y";
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function sortable($flag = "Y")
  {
    $this->p_sortable=TRUE;
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function colour_coordinate($flag = "N")
  {
    if ($flag == "N")
      $this->p_colour = 0;
    else
    if ($flag == "Y")
      $this->p_colour = 1;
    else
      die("Not a valid response for colour choice");
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function add_row_lwidth($wd)
  {
    // the width of the leftmost column for row orientated data
    $this->p_lwidth=$wd;
  }
  
/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function add_row_rwidth($wd)
  {
    // the width of the remaining columns for row orientated data (all the same)
    $this->p_remwidth=$wd;
  }
  
/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/
  public function count_rows()
  {
    return $this->p_data;
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function add_caption($cap, $cap_hl = NULL)
  {
    $this->p_caption = $cap;
    $this->p_caption_hl = $cap_hl;
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function set_align($align)
  {
    $this->p_align = $align;
  }
  
/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function current_width()
  {
    return $this->p_coltot;
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function flush($id, $width = 99)
  {
    $this->p_width = $width;
    $this->p_frame = "box";
    $this->p_align = "H";

    unset ($this->pa_colh); $this->pa_colh = array();
    unset ($this->pa_colw); $this->pa_colw = array();
    unset ($this->pa_cola); $this->pa_cola = array();
    unset ($this->pa_rowh); $this->pa_rowh = array();
    unset ($this->pa_roww); $this->pa_roww = array();
    unset ($this->pa_rowa); $this->pa_rowa = array();
    unset ($this->dataarr); $this->dataarr = array();

    $this->p_data = 0;
    $this->p_colnum = 0;
    $this->p_rownum = 0;
    $this->p_coltot = 0;
    $this->p_tableid = $id;
    $this->p_caption = NULL;
    $this->p_caption_hl = NULL;
    $this->p_colour = 0;
    $this->html_code = NULL;
  }
  
/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  private function draw_table_v($print=TRUE)
  {
    $line = "";
/*
    if ($this->p_data == 0)
    {
      printf("No data: %s\n", $this->p_tableid);
      return;
    }
*/

    if ($this->p_debug)
      echo "Got here with " . $this->p_data . " records<br />";

    printf("<!-- Start of table %s -->\n", $this->p_tableid);

    $html_code = sprintf("<table width=\"%s%%\" frame=\"%s\" id=\"%s\">\n", 
                         $this->p_width, $this->p_frame, $this->p_tableid);

    if (isset($this->p_caption))
    {
      if (isset($this->p_caption_hl) && !empty($this->p_caption_hl))
        $html_code = sprintf("%s<caption><a href=\"%s\"><strong>%s</strong></a></caption>\n", 
                             $html_code, $this->p_caption_hl, $this->p_caption);
      else
        $html_code = sprintf("%s<caption><strong>%s</strong></caption>\n", 
                             $html_code, $this->p_caption);
    }

    if ($this->p_debug) echo "1: Length of code: " . strlen($html_code) . "<br />";
    if ($this->p_debug) echo "Number of rows: " . $this->p_rownum . "<br />";

    if ($this->p_suppress_nulls == 1)
      $nonulls = 1;
    else
      $nonulls = 0;

    if ($this->p_rownum)
      $html_code = sprintf("%s<tbody>\n", $html_code);

    // for each row, we have to go through each entry in the data looking for
    // the data held by the pa_rowh array entry indexed by $n_rows
    for ($n_rows = 0; $n_rows < $this->p_rownum; $n_rows++)
    {
      $line = sprintf("%s<tr>\n", $line);

      // First thing we do is print the column with the heading in it
      if ($this->p_lwidth > 0)
        $line = sprintf("%s<td width=\"%s%%\"><strong>%s</strong></td>\n",
                        $line, $this->p_lwidth, $this->pa_rowa[$n_rows]);
      else
        $line = sprintf("%s<td>       <strong>%s</strong></td>\n", $line, $this->pa_rowa[$n_rows]);

      // We are currently looking for the element in $this->pa_rowh[$n_rows]
      $element = $this->pa_rowh[$n_rows];

      // Now loop through the number of entries in the array and look for each 1st element in turn
      for ($n_data = 0, $datacount = 0; $n_data < $this->p_rownum; $n_data++)
      {
        // Get the current element of the two dimensional array and store it in $v
        if (isset($this->dataarr[$n_data]))
          $v = $this->dataarr[$n_data];
        else
          $v = "";

        // Look in the array to see if it contains the current leftmost element
        if (isset($v[$element]))
        {
          $dataval = $v[$element];

          // Look to see if a hyperlink is defined
          $hyper  = $element . "_hl";
          $popup  = $element . "_pop";
          $format = $element . "_fmt";
          $title  = $element . "_tit";
          $colour = $element . "_col";

//printf("%s/%s/%s<br />\n", $hyper, $popup, $format);

          if ($dataval != '')
            $datacount++;

          if (isset($v[$title]))
            $titleval = $v[$title];
          else
            $titleval = "";

          if (isset($v[$colour]) && strlen($v[$colour]))
            $col = "class=\"" . $v[$colour] . "\"";
          else
            $col = "";

          if (isset($v[$hyper]))
          {
            $hyperlink = $v[$hyper];

            // Display the element
            if ($this->p_remwidth > 0)
            {
              if (!empty($titleval))
                $line = sprintf("%s<td %s width=\"%d%%\" title=\"%s\"><a href=\"%s\">%s</a></td>\n",
                                $line, $col, $this->p_remwidth, $titleval, $hyperlink, $dataval);
              else
                $line = sprintf("%s<td %s width=\"%d%%\"><a href=\"%s\">%s</a></td>\n",
                                $line, $col, $this->p_remwidth, $hyperlink, $dataval);
            }
            else
            {
              if (!empty($titleval))
                $line = sprintf("%s<td %s title=\"%s\"><a href=\"%s\">%s</a></td>\n",
                                $line, $col, $titleval, $hyperlink, $dataval);
              else
                $line = sprintf("%s<td %s><a href=\"%s\">%s</a></td>\n",
                                $line, $col, $hyperlink, $dataval);
            }
          }
          else
          if (isset($v[$popup]))
          {
            $popuplink = $v[$popup];

            // Display the element

            if ($this->p_remwidth > 0)
            {
              if (!empty($titleval))
                $line = sprintf("%s<td %s width=\"%d%%\" title=\"%s\"><a href=\"javascript:void(0)\" onClick=\"window.open('%s')\">%s</a></td>\n",
                            $line, $col, $this->p_remwidth, $titleval, $popuplink, $dataval);
              else
                $line = sprintf("%s<td %s width=\"%d%%\"><a href=\"javascript:void(0)\" onClick=\"window.open('%s')\">%s</a></td>\n",
                            $line, $col, $this->p_remwidth, $popuplink, $dataval);
            }
            else
            {
              if (!empty($titleval))
                $line = sprintf("%s<td %s title=\"%s\"><a href=\"javascript:void(0)\" onClick=\"window.open('%s')\">%s</a></td>\n",
                              $line, $col, $titleval, $popuplink, $dataval);
              else
                $line = sprintf("%s<td %s><a href=\"javascript:void(0)\" onClick=\"window.open('%s')\">%s</a></td>\n",
                              $line, $col, $popuplink, $dataval);
            }
          }
          else
          if (isset($v[$format]))
          {
            $formatstmt = $v[$format];

            if ($this->p_remwidth > 0)
            {
              if (!empty($titleval))
                $line = sprintf("%s<td %s width=\"%d%%\" sorttable_customkey=\"%s\" title=\"%s\">%s</td>\n", 
                                $line, $col, $this->p_remwidth, $formatstmt, $titleval, $dataval);
              else
                $line = sprintf("%s<td %s width=\"%d%%\" sorttable_customkey=\"%s\">%s</td>\n", 
                                $line, $col, $this->p_remwidth, $formatstmt, $dataval);
            }
            else
            {
              if (!empty($titleval))
                $line = sprintf("%s<td %s sorttable_customkey=\"%s\" title=\"%s\">%s</td>\n", 
                                $line, $col, $formatstmt, $titleval, $dataval);
              else
                $line = sprintf("%s<td %s sorttable_customkey=\"%s\">%s</td>\n", 
                                $line, $col, $formatstmt, $dataval);
            }
          }
          else
          {
            if ($this->p_remwidth > 0)
            {
              if (!empty($titleval))
                $line = sprintf("%s<td %s width=\"%d%%\" title=\"%s\">%s</td>\n", 
                                $line, $col, $this->p_remwidth, $titleval, $dataval);
              else
                $line = sprintf("%s<td %s width=\"%d%%\">%s</td>\n", 
                                $line, $col, $this->p_remwidth, $dataval);
            }
            else
            {
              if (!empty($titleval))
                $line = sprintf("%s<td %s title=\"%s\">%s</td>\n", 
                                $line, $col, $titleval, $dataval);
              else
                $line = sprintf("%s<td %s>%s</td>\n", 
                                $line, $col, $dataval);
            }
          }
        }
      } // per data element

      $line = sprintf("%s</tr>\n", $line);
 
      if ($this->p_debug) echo "1a: Length of code: " . strlen($line) . "<br />";
    
      if ($nonulls == 1 && $datacount == 0)
        ;
      else
        $html_code = sprintf("%s%s\n", $html_code, $line);

      $line = '';
    } // per row

    $html_code = sprintf("%s</tbody></table>\n", $html_code);

    if ($this->p_debug) echo "3: Length of code: " . strlen($html_code) . "<br />";

    if ($print == TRUE)
      printf("%s\n", $html_code);

    printf("<!-- End of table %s -->\n", $this->p_tableid);

    return $html_code;
  }
  

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function get_table()
  {
    return $this->draw_table(FALSE);
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function p_headings()
  {
    $html_code = sprintf("<thead><tr>\n");

    for ($nx=0;$nx < $this->p_colnum; $nx++)
    {
      $cent = 1;
      $html_code = sprintf("%s<th width=\"%s%%\"><strong>%s</strong></th>\n",
           $html_code,
           $this->pa_colw[$nx],
           $this->pa_cola[$nx]);  
    }

    $html_code = sprintf("%s</tr></thead>\n", $html_code);

    return $html_code;
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function p_header()
  {
    if ($this->p_debug)
      echo memory_get_usage() . "\n";

    $html_code = sprintf("<table width=\"%s%%\" frame=\"%s\" %s id=\"%s\">\n", 
                         $this->p_width, 
                         $this->p_frame,
                         $this->p_sortable ? "class=\"sortable\"" : "",
                         $this->p_tableid );

    if (isset($this->p_caption_hl) && !empty($this->p_caption_hl))
      $html_code = sprintf("%s<caption><a href=\"%s\"><strong>%s</strong></a></caption>\n", 
                           $html_code, $this->p_caption_hl, $this->p_caption);
    else
      $html_code = sprintf("%s<caption><strong>%s</strong></caption>\n", 
                           $html_code, $this->p_caption);

    return $html_code;
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function draw_table($print=TRUE)
  {
    if ($this->p_debug)
      $time_array = $this->l_getmicrotime();

    if ($this->p_align == "V")
      return ($this->draw_table_v($print));

    if ($this->p_colnum == 0)
      die("No columns defined!");
      
    printf("<!-- Start of table %s -->\n", $this->p_tableid);

    set_time_limit(360);

    /*********************************/
    /* Step 1 - print header/caption */
    /*********************************/

    $html_code = $this->p_header();

    if ($this->p_debug)
      echo "<br />1: Length of html: " . strlen($html_code);

    /***********************/
    /* Step 2 - print data */
    /***********************/

    $html_code .= $this->p_headings();

    if (isset($this->dataarr))
    {
      $html_code .= "<tbody>";
      foreach ($this->dataarr as $v)
      {
        if ($this->p_colour)
          $html_code = sprintf("%s<tr class=\"bg_%s\">\n", $html_code, 
                               strtolower(substr($v['type'], 0, 1)));
        else
          $html_code = sprintf("%s<tr>\n", $html_code);

if ($this->p_debug)
  echo "<br />2: Length of html: " . strlen($html_code);

        for ($nz = 0; $nz < $this->p_colnum; $nz++)
        {
          if (isset($v[$this->pa_colh[$nz]]))
          {
            $temp_field1 = $this->pa_colh[$nz]. "_hl";

            if (isset($v[$temp_field1]))
              $hlflag = 1;
            else
              $hlflag = 0;

            $temp_field2 = $this->pa_colh[$nz]. "_fmt";

            if (isset($v[$temp_field2]))
              $fmtflag = 1;
            else
              $fmtflag = 0;
           
            $temp_field3 = $this->pa_colh[$nz]. "_img";

            if (isset($v[$temp_field3]))
              $imgflag = 1;
            else
              $imgflag = 0;

            $temp_field4 = $this->pa_colh[$nz]. "_tit";

            if (isset($v[$temp_field4]))
              $titflag = 1;
            else
              $titflag = 0;

            $temp_field5 = $this->pa_colh[$nz]. "_col";

            if (isset($v[$temp_field5]) && strlen($v[$temp_field5]))
              $col = "class=\"" . $v[$temp_field5] . "\"";
            else
              $col = "";

            if ($fmtflag)
            {
              if ($titflag)
                $html_code = sprintf("%s<td %s width=\"%s%%\" sorttable_customkey=\"%s\" title=\"%s\">", 
                                     $html_code, $col, $this->pa_colw[$nz], 
                                     $v[$temp_field2], $v[$temp_field4]);
              else
                $html_code = sprintf("%s<td %s width=\"%s%%\" sorttable_customkey=\"%s\">", 
                                     $html_code, $col, $this->pa_colw[$nz], $v[$temp_field2]);
            }
            else
            {
              if ($titflag)
                $html_code = sprintf("%s<td %s width=\"%s%%\" title=\"%s\">", 
                                     $html_code, $col, $this->pa_colw[$nz],
                                     $v[$temp_field4]);
              else
              {
                if ($this->centred[$nz])
                {
                  $html_code = sprintf("%s<td %s style=\"text-align:center\" width=\"%s%%\">", $html_code, $col, $this->pa_colw[$nz]);
                }
                else
                {
                  $html_code = sprintf("%s<td %s width=\"%s%%\">", $html_code, $col, $this->pa_colw[$nz]);
                }
              }
            }
if ($this->p_debug)
  echo "<br />3: Length of html: " . strlen($html_code);

            if ($hlflag)
              $html_code = sprintf("%s<a href=\"%s\">", $html_code, $v[$temp_field1]);

            if ($imgflag)
              $html_code = sprintf("%s<img src=\"%s\" align=\"center\">", $html_code, $v[$temp_field3]);

if ($this->p_debug)
  echo "<br />4: Length of html: " . strlen($html_code);

            $html_code = sprintf("%s%s", $html_code, $v[$this->pa_colh[$nz]]);
if ($this->p_debug)
  echo "<br />5: Length of html: " . strlen($html_code);

            if ($hlflag)
              $html_code = sprintf("%s</a>", $html_code);
if ($this->p_debug)
  echo "<br />6: Length of html: " . strlen($html_code);

            $html_code = sprintf("%s</td>\n", $html_code);                                     
if ($this->p_debug)
  echo "<br />7: Length of html: " . strlen($html_code);
          }
          else
            $html_code = sprintf("%s<td width=\"%s%%\">&nbsp;</td>\n", $html_code, $this->pa_colw[$nz]);
        }

        $html_code = sprintf("%s</tr>\n", $html_code);
if ($this->p_debug)
  echo "<br />8: Length of html: " . strlen($html_code);
      }

      $html_code .= "</tbody>";
    }

    /**************************/
    /* Step 3 - print trailer */
    /**************************/

    $html_code = sprintf("%s</table>\n", $html_code);
if ($this->p_debug)
  echo "<br />9: Length of html: " . strlen($html_code);

    if ($print == TRUE)
    {
      if ($this->p_debug)
        echo "<br />Printing";

      printf("%s\n", $html_code);

      if ($this->p_rollover == "Y")
      {
        printf("<script type=\"text/javascript\">\n");
        printf("addTableRolloverEffect('%s',
                                       'tableRollOverEffect1',
                                       'tableRowClickEffect1');\n",
                                       $this->p_tableid);
        printf("</script>\n");
      }

      unset($this->dataarr);
    }
    else
    if ($this->p_debug)
    {
      echo "<br />Not printing";
    }

    if ($this->p_debug)
      echo memory_get_usage() . "\n";

    if ($this->p_debug)
    {
      $time_array = $this->l_getmicrotime() - $time_array;
      echo "<P>MyTables->draw_table():&nbsp; $time_array seconds.</P>\r\n";
    }

    printf("<!-- End of table %s -->\n", $this->p_tableid);

    return $html_code;
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function add_row_img($rowname, $rowalias)
  {
    $this->add_row($rowname, $rowalias);
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function add_row($rowname, $rowalias)
  {
  // this is effectively defining the heading on the left of the first row
  //
  // e.g.
  //
  // Class
  // Designer
  // Wheels
  //
  // ... and associating that row with the field in the array

    $this->pa_rowh[$this->p_rownum] = $rowname;
    $this->pa_rowa[$this->p_rownum] = $rowalias;
    $this->p_rownum++;
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/


  public function add_column($colname, $colalias, $width, $image = NULL, $id = NULL, $centred = FALSE)
  {
    $this->p_coltot += $width;

    if ($this->p_coltot > 100)
    {
      die("Table width exceeds 100%!");
    }

    $this->pa_colh[$this->p_colnum] = $colname;
    $this->pa_colw[$this->p_colnum] = $width;
    $this->pa_cola[$this->p_colnum] = $colalias;
    /*$this->pa_coli[$this->p_colnum] = $image;*/
    $this->pa_colid[$this->p_colnum] = $id;
    $this->centred[$this->p_colnum] = $centred;
    $this->p_colnum++;
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function add_data($val, $dumpnow="N")
  {
    if ($dumpnow == "Y")
    {
      $this->dataarr[0] = $val;
    }
    else
    {
      $this->dataarr[] = $val;
      //echo "<br />" . "+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++"            . "<br />" . $this->p_data . ": "; print_r($this->dataarr[$this->p_data]);
      $this->p_data++;
    }

    if ($this->p_debug)
      echo memory_get_usage() . "\n";
//  printf("Now got %d records\n", $this->p_data);
  }

/********************************************************************************************/
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/*                                                                                          */
/********************************************************************************************/

  public function dump_data($val)
  {
    if ($this->gnx++ == 0)
    {
      if ($this->p_colnum == 0)
      {
        die("No columns defined!");
      }
      
      printf("<table width=\"%s%%\" frame=\"%s\" %s id=\"%s\">\n", 
                           $this->p_width,   $this->p_frame,
                           $this->p_sortable ? "class=\"sortable\"" : "",
                           $this->p_tableid );

      if (isset($this->p_caption_hl) && !empty($this->p_caption_hl))
        printf("<caption><a href=\"%s\"><strong>%s</strong></a></caption>\n", 
                $this->p_caption_hl, $this->p_caption);
      else
        printf("<caption><strong>%s</strong></caption>\n", $this->p_caption);

      printf("<tr>\n");

      /* Header column */

      for ($nx=0;$nx < $this->p_colnum; $nx++)
      {
        printf("<th width=\"%s%%\"><strong>%s</strong></th>\n",
        $this->pa_colw[$nx],
        $this->pa_cola[$nx]);  
      }

      printf("</tr>\n");
    }

    /* Data */

    if (isset($val))
    {
//      print_r($val);

      if ($this->p_colour)
        printf("<tr class=\"bg_%s\">", strtolower(substr($val['type'], 0, 1)));
      else
        printf("<tr>\n");

      for ($nz = 0; $nz < $this->p_colnum; $nz++)
      {
        if (isset($val[$this->pa_colh[$nz]]))
        {
          $temp_field1 = $this->pa_colh[$nz]. "_hl";
          if (isset($val[$temp_field1]))
            $hlflag = 1;
          else
            $hlflag = 0;
            
          $temp_field2 = $this->pa_colh[$nz]. "_fmt";
          if (isset($val[$temp_field2]))
            $fmtflag = 1;
          else
            $fmtflag = 0;

          if ($fmtflag)
            printf("<td width=\"%s%%\" sorttable_customkey=\"%s\">", 
                                 $this->pa_colw[$nz], $val[$temp_field2]);
          else
            printf("<td width=\"%s%%\">", $this->pa_colw[$nz]);

          if ($hlflag)
            printf("<a href=\"%s\">", $val[$temp_field1]);

          printf("%s", $val[$this->pa_colh[$nz]]);

          if ($hlflag)
            printf("</a>");

          printf("</td>\n");                                     
        }
        else
          printf("<td width=\"%s%%\">&nbsp;</td>\n", $this->pa_colw[$nz]);
      }

      printf("</tr>\n");
    }
    else
    {
      /* Trailer */
      printf("</table>\n");
    }
  }
}
?>
