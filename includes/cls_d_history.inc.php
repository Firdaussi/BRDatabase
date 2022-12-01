<?php
  include_once("lib/MyTables.class.php");

  $sql = 'SELECT info from d_class
          WHERE  d_class_id = ' .$id;

  $result = $db->execute($sql);

  $info_table = new MyTables("infotable");
  $info_table->add_caption("Locomotive History");

  $info_table->add_column("info", "Information and History",100);

  if ($db->count_select())
  {
    $row = mysqli_fetch_array($result);

    if ($row)
      $info_table->add_data($row);
 

    $info_table->draw_table();

    $sql = 'select date_format(news_date, "%M, %Y") AS news_date_my,
                   date_format(news_date, "%M") AS news_date_m,
                   date_format(news_date, "%Y") AS news_date_y,
                   news_type,
                   news_title,
                   news_story,
                   news_author,
                   news_source,
                   news_permit
            from   news_stories
            where  type = "D"
            and    class_id = ' .$id. '
            order by news_date ASC';

    $result = $db->execute($sql);

    $numrows = $db->count_select();

    if ($numrows == 0)
    {
      printf("<p>No stories found</p><br />\n");
    }
    else
    {
      $ny = 0; $nm = "fred"; $nm_ct = 0;
      while ($row = mysqli_fetch_array($result))
      {
        $ny_new = "N";
        if ($row['news_date_y'] != $ny)
        {
          $nm_ct = 0;
          $ny_new = "Y";
          if ($ny != 0)
          {
            printf("<br />\n");
            printf("</div> <!-- close div 1 for year -->\n");
          }

//        printf("<h4 class=\"trigger\">%s</h4>\n", $row['news_date_y']);
          printf("<div> <!-- open div 1 for year -->\n<br />\n");
          $ny = $row['news_date_y'];
        }

        if ($row['news_date_m'] != $nm || $ny_new == "Y")
        {
//        if ($nm_ct != 0)
//          printf("<br />\n");
//        printf("<h5>%s</h5>\n", $row['news_date_m']);
          $nm = $row['news_date_m'];
          $nm_ct++;
        }

        printf("<h4 class=\"trigger\"> %s</h4>\n", $row['news_title']);
        printf("<div> <!-- open div 2 for new story -->\n<br /><fieldset class=\"news_fs\">\n");
        printf("<p><em>From %s (%s). %s</em></p>\n", $row['news_source'],
                                                     $row['news_date_my'],
                                                     $row['news_permit']);
        printf("%s\n", $row['news_story']);
        printf("</fieldset><br /></div> <!-- close div for new story -->\n");
      }

      if ($ny != 0)
      {
        printf("<br />\n");
        printf("</div> <!-- close div 1 for year -->\n");
      }
    }
  }
?>