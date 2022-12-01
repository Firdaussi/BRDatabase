<?php

require("../lib/quickdb.class.php");
require("../lib/brlib.php");

$db = fn_connectdb() or die("Couldn't connect to database");

set_time_limit(360);

$sqlo = 'select distinct(modification) as modi from d_mods';
$resulto = $db->execute($sqlo) or die("Couldn't open d_mods");

while ($row = mysqli_fetch_assoc($resulto))
{
  $sql = 'update d_summary ss,
                 d_mods sm,
                 modifications m,
                 works_visits wv
          set    ss.details = concat(ss.details,
                                     "<br />Modification: ",
                                     m.description)
          where  ss.event_type = "Works Visit"
          and    ss.loco_id = wv.loco_id
          and    sm.loco_id = wv.loco_id
          and    wv.type = "D"
          and    ss.event_date between wv.start_date and wv.end_date
          and    sm.date_modified between wv.start_date and wv.end_date
          and    sm.modification = m.modification
          and    sm.visit_id IS NULL
          and    m.modification = "' . $row['modi'] . '"';

  $result = $db->execute($sql); 
  echo "Updated " .  $db->count_affected() . " rows for works visit/mod " . $row['modi'] . " dates<br />";
}

?>

