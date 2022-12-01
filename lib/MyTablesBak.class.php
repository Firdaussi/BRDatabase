<?php

class MyTables
{
  private $p_width   = NULL;       // Table width
  private $p_lwidth  = NULL;       // Table width
  private $p_frame   = NULL;       // Table frame format
  private $p_tableid = NULL;       // for CSS
  private $p_align   = NULL;       // align the table Horizontally or Vertically
  private $p_coltot  = 0;          // Total of all column widths
  private $p_colnum  = 0;          // Number of columns
  private $pa_colh   = NULL;       // Column heading
  private $pa_colw   = NULL;       // Column width
  private $pa_cola   = NULL;       // Column alias
  private $pa_cols   = NULL;       // Column is sortable
  private $p_rownum  = 0;          // Number of rows
  private $pa_rowh   = NULL;       // Row heading
  private $pa_roww   = NULL;       // Row width
  private $pa_rowa   = NULL;       // Row alias
  private $dataarr   = NULL;       // store the data
  private $p_data    = 0;          // Amount of rows in the table
  private $p_caption = NULL;       // Caption for table
  private $p_colour  = 0;          //* Use colour for steam, diesel or electric based on 'type' field
  private $p_suppress_nulls = 0;   // Suppress NULL values in horizontal tables
  private $html_code = NULL;       // code for use in printing pdf documents

  public function __construct($id, $width = 99)
  {
    $this->p_width = $width;
    $this->p_lwidth = NULL;
    $this->p_frame = "box";
	  $this->p_align = "H";

    $this->pa_colh = array();
    $this->pa_colw = array();
    $this->pa_cola = array();
    $this->pa_cols = array();
	  $this->dataarr = array();
	  $this->p_tableid = $id;
  }

  public function __destruct()
  {
  }

  public function suppress_nulls()
  {
    $this->p_suppress_nulls = 1;
  }

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

  public function add_row_lwidth($wd)
  {
  // the width of the leftmost column for row orientated data
    $this->p_lwidth=$wd;
  }
  
  public function count_rows()
  {
	return $this->p_data;
  }

  public function add_caption($cap)
  {
	$this->p_caption = $cap;
  }

  public function set_align($align)
  {
    $this->p_align = $align;
  }
	
  public function current_width()
  {
    return $this->p_coltot;
  }

  public function flush($id, $width = 99)
  {
	  $this->p_width = $width;
    $this->p_frame = "box";
	  $this->p_align = "H";

    unset ($this->pa_colh); $this->pa_colh = array();
    unset ($this->pa_colw); $this->pa_colw = array();
    unset ($this->pa_cola); $this->pa_cola = array();
    unset ($this->pa_cols); $this->pa_cols = array();
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
	  $this->p_colour = 0;
    $this->html_code = NULL;
  }
	
  private function draw_table_v()
  {
    if ($this->p_data == 0)
    {
	    printf("No data\n");
      return;
    }

    printf("<table width=%s%% frame=box>\n", $this->p_width, $this->p_frame);

	  if (isset($this->p_caption))
      printf("<caption><strong>%s</strong></caption>\n", $this->p_caption);

	  if ($this->p_suppress_nulls == 1)
      $nonulls = 1;
	  else
	    $nonulls = 0;

    // for each row, we have to go through each entry in the data looking for
	  // the data held by the pa_rowh array entry indexed by $n_rows
	  for ($n_rows = 0; $n_rows < $this->p_rownum; $n_rows++)
	  {
      $line = sprintf("<tr>\n");

	    // First thing we do is print the column with the heading in it
	    if ($this->p_lwidth > 0)
	      $line = sprintf("%s<td width=%s%%><strong>%s</strong></td>\n",
		                    $line, $this->p_lwidth, $this->pa_rowa[$n_rows]);
	    else
		    $line = sprintf("%s<td><strong>%s</strong></td>\n", $line, $this->pa_rowa[$n_rows]);

      // We are currently looking for the element in $this->pa_rowh[$n_rows]
	    $element = $this->pa_rowh[$n_rows];

	    // Now loop through the number of entries in the array and look for each 1st element in turn
      for ($n_data = 0, $datacount = 0; $n_data < $this->p_rownum; $n_data++)
      {
        // Get the current element of the two dimensional array and store it in $v
        $v = $this->dataarr[$n_data];

		    // Look in the array to see if it contains the current leftmost element
		    if (isset($v[$element]))
		    {
		      $dataval = $v[$element];

		      // Look to see if a hyperlink is defined
		      $hyper = $element . "_hl";

		      if ($dataval != '')
			    $datacount++;

		      if (isset($v[$hyper]))
		      {
			      $hyperlink = $v[$hyper];

			      // Display the element
			      $line = sprintf("%s<td><a href=%s>%s</a></td>\n",
                            $line, $hyperlink, $dataval);
		      }
		      else
			      $line = sprintf("%s<td>%s</td>\n", $line, $dataval);
		    }
      } // per data element

      $line = sprintf("%s</tr>\n", $line);
	  
	    if ($nonulls == 1 && $datacount == 0)
	      ;
	    else
		    printf("%s", $line);
    } // per row

	  printf("</table>\n");
  }
	

  public function get_table()
  {
    return $this->draw_table(FALSE);
  }

  public function draw_table($print=TRUE)
  {
	  if ($this->p_align == "V")
	  {
	    $this->draw_table_v($print);
	    return;
	  }

    if ($this->p_colnum == 0)
    {
      die("No columns defined!");
    }

    $html_code = sprintf("<table width=%s%% frame=%s>\n", $this->p_width, $this->p_frame);

	  if (isset($this->p_caption))
      $html_code = sprintf("%s<caption>%s</caption>\n", $html_code, $this->p_caption);

    $html_code = sprintf("%s<tr>\n", $html_code);

    for ($nx=0;$nx < $this->p_colnum; $nx++)
    {
      if (isset($this->pa_cols[$nx]) && $this->pa_cols[$nx] != "")
        $html_code = sprintf("%s<td width=%s%%><strong><a href=%s>%s</a></strong></td>",
           $html_code,
		       $this->pa_colw[$nx],
		       $this->pa_cols[$nx],
		       $this->pa_cola[$nx]);
      else
        $html_code = sprintf("%s<td width=%s%%><strong>%s</strong></td>\n",
           $html_code,
           $this->pa_colw[$nx],
           $this->pa_cola[$nx]);  
    }

    $html_code = sprintf("%s</tr>\n", $html_code);

    if (isset($this->dataarr))
    {
      foreach ($this->dataarr as $v)
      {
		    if ($this->p_colour)
		    {
          if (isset($v['type']))
		      {
			      if ($v['type'] == "S")
			        $bgcolour = "#FFdd77";
			      else
			      if ($v['type'] == "D")
			        $bgcolour = "#FFFFbb";
			      else
			     if ($v['type'] == "E")
			        $bgcolour = "#33CCFF";
		      }
		    }

        if ($this->p_colour)
		      $html_code = sprintf("%s<tr bgcolor=\"%s\">\n", $html_code, $bgcolour);
		    else
          $html_code = sprintf("%s<tr>\n", $html_code);

        for ($nz = 0; $nz < $this->p_colnum; $nz++)
        {
          if (isset($v[$this->pa_colh[$nz]]))
          {
            $temp_field = $this->pa_colh[$nz]. "_hl";
//            printf("[%s]\n", $temp_field);
            if (isset($v[$temp_field]))
              $flag = 1;
            else
              $flag = 0;
            
            $html_code = sprintf("%s<td width=%s%%>", $html_code, $this->pa_colw[$nz]);
            if ($flag)
              $html_code = sprintf("%s<a href=%s>", $html_code, $v[$temp_field]);
            $html_code = sprintf("%s%s", $html_code, $v[$this->pa_colh[$nz]]);
            if ($flag)
              $html_code = sprintf("%s</a>", $html_code);
            $html_code = sprintf("%s</td>\n", $html_code);                                     
          }
          else
            $html_code = sprintf("%s<td width=%s%%>&nbsp;</td>\n", $html_code, $this->pa_colw[$nz]);
        }
        $html_code = sprintf("%s</tr>\n", $html_code);
      }
    }

    $html_code = sprintf("%s</table>\n", $html_code);

    if ($print == TRUE)
      printf("%s\n", $html_code);

    return $html_code;
  }

  public function add_row_img($rowname, $rowalias)
  {
    $this->add_row($rowname, $rowalias);
  }

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

  public function add_column_img($colname, $colalias, $width, $sort_command = "")
  {
    $this->add_column($colname, $colalias, $width, $sort_command);
  }

  public function add_column($colname, $colalias, $width, $sort_command = "")
  {
    $this->p_coltot += $width;

    if ($this->p_coltot > 100)
    {
      die("Table width exceeds 100%!");
    }

    $this->pa_colh[$this->p_colnum] = $colname;
    $this->pa_colw[$this->p_colnum] = $width;
    $this->pa_cola[$this->p_colnum] = $colalias;
    $this->pa_cols[$this->p_colnum] = $sort_command;
    $this->p_colnum++;
  }

  public function add_data($val)
  {
    $this->dataarr[] = $val;
    $this->p_data++;
//	printf("Now got %d records\n", $this->p_data);
  }
}
?>
