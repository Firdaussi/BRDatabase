<?php

require("../lib/quickdb.class.php");
require("../lib/brlib.php");

$db = fn_connectdb() or die("Couldn't connect to database");

set_time_limit(360);

$result = $db->delete("d_summary", "loco_id >= 0");
echo "Deleted " .  $db->count_affected() . " rows<br />";

$sql = 'update works_visits
        set    summary = NULL
        where  type = "D"';

$result = $db->execute($sql) or die("works_visits 1");

$sql = 'update works_visits
        set    summary = concat(reason_text, "<br />")
        where  type = "D"
        and    reason_text is not null';

$result = $db->execute($sql) or die("works_visits 2");

#$sql = 'update works_visits wv, 
#               boiler_type bt,
#               d_boiler sb,
#               d_boiler_nums sbn,
#               d_to_boiler s2b
#        set    wv.summary = concat(ifnull(wv.summary, ""),
#                                   "Boiler number ",
#                                   sbn.boiler_number,
#                                   " (Diagram ",
#                                   bt.boiler_diagram_no,
#                                   ")<br />")
#        where  wv.type = "D"
#        and    wv.visit_id = s2b.visit_id
#        and    s2b.d_boiler_id = sb.d_boiler_id
#        and    sb.boiler_type_id = bt.boiler_type_id
#        and    sbn.d_boiler_id = sb.d_boiler_id';

#$result = $db->execute($sql) or die("works_visits 3");

#$sql = 'update works_visits wv, 
#               tender_type tt,
#               d_tender st,
#               d_to_tender s2t
#        set    wv.summary = concat(ifnull(wv.summary, ""),
#                                   "Tender number ",
#                                   st.tender_number,
#                                   " (",
#                                   tt.tender_type,
#                                   ") attached.<br />")
#        where  wv.type = "D"
#        and    wv.visit_id = s2t.visit_id
#        and    s2t.d_tender_id = st.d_tender_id
#        and    st.tender_type_id = tt.tender_type_id';

#$result = $db->execute($sql) or die("works_visits 4");

$sql = 'update works_visits wv, 
               d_mods dm,
               ref_modifications m
        set    wv.summary = concat(ifnull(wv.summary, ""),
                                   m.description,
                                   "<br />")
        where  wv.type = "D"
        and    wv.visit_id = dm.visit_id
        and    dm.modification = m.modification';

$result = $db->execute($sql) or die("works_visits 3 failed");

$sql = 'update works_visits wv, 
               d_to_livery d2l,
               ref_livery l
        set    wv.summary = concat(ifnull(wv.summary, ""),
                                   "Painted ",
                                   l.description,
                                   "<br />")
        where  wv.type = "D"
        and    wv.visit_id = d2l.visit_id
        and    d2l.livery_id = l.livery_id';

$result = $db->execute($sql);

$sql = 'update works_visits wv, 
               d_nums dn
        set    wv.summary = concat(ifnull(wv.summary, ""),
                                   "Renumbered to ",
                                   dn.company,
                                   " ",
                                   CASE WHEN dn.subtype IS NOT NULL THEN
                                     concat("(", dn.subtype, ") number ")
                                   ELSE ""
                                   END,
                                   "<br />")
        where  wv.type = "D"
        and    wv.visit_id = dn.visit_id
        and    dn.carried_number = "Y"';

$result = $db->execute($sql);

$sql = 'update works_visits wv, 
               d_name dn
        set    wv.summary = concat(ifnull(wv.summary, ""),
                                   "De-named ",
                                   dn.name,
                                   "<br />")
        where  wv.type = "D"
        and    wv.visit_id = dn.visit_id2';

$result = $db->execute($sql);

$sql = 'update works_visits wv, 
               d_name dn
        set    wv.summary = concat(ifnull(wv.summary, ""),
                                   "Named ",
                                   dn.name,
                                   "<br />")
        where  wv.type = "D"
        and    wv.visit_id = dn.visit_id';

$result = $db->execute($sql);

$sql = 'update works_visits wv
        set    wv.duration = datediff(end_date, start_date) + 1
        where  wv.start_date is not null
        and    wv.end_date is not null';

$result = $db->execute($sql);

// $result = $db->execute($sql) or die("Couldn't truncate table d_summary");

/***********************************************************************************************/
/*                                                                                             */
/* Basic details when new                                                                      */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select d2dnip.loco_id,
               ddnip.snippet_date,
               concat("Report: ",
                      ddnip.snippet,
                      " (", pub.title,
                      CASE WHEN pub.issue IS NOT NULL THEN
                        concat(" - ", pub.issue)
                      ELSE
                        ""
                      END,
                      ")"),
               "Report",
               NULL
        from   d_snippet ddnip
        join   d_to_snippet d2dnip
        on     d2dnip.d_snippet_id = ddnip.d_snippet_id
        join   ref_publication pub
        on     pub.pub_id = ddnip.publication_id
        where  d2dnip.loco_id > 0';

$result = $db->execute($sql);
echo "Inserted " .  $db->count_affected() . " rows for dnippets<br />";

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select d.loco_id, 
               d.b_date, 
               concat("To service as ",
                      coalesce(c.cmp_name, dn.company),
                      " Number ",
                      dn.number,
                      CASE WHEN dnm.name IS NOT NULL THEN
                        concat(", name: ", dnm.name)
                      ELSE
                        " "
                      END), 
               "To Service", 
               NULL
        from   diesels d
        join   d_nums dn
        on     dn.loco_id = d.loco_id
        and    dn.start_date = d.b_date
        left join ref_companies c
        on     c.cmp_initials = dn.company
        left join d_name dnm
        on     dnm.loco_id = d.loco_id
        and    dnm.start_date = d.b_date';

$result = $db->execute($sql) or die("rows for diesels");
echo "Inserted " .  $db->count_affected() . " rows for build date<br />";

$result = $db->update("d_summary dd, diesels d, ref_builders b",
                      "dd.details = concat(dd.details, \"<br />\",
                                               \"Built at \", b.bl_name,
                       CASE WHEN d.works_num IS NULL THEN
                         \" \"
                       ELSE
                         concat(\", Works Number \", d.works_num)
                             END)",
                      "dd.event_type = \"To Service\"
                       and    dd.loco_id = d.loco_id
                       and    d.bl_code = b.bl_code");

echo "Updated " .  $db->count_affected() . " rows for build details<br />";

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select d.loco_id, 
               d.svc_date, 
               concat("To ",
                      dn.company,
                      " stock"), 
               "To Stock", 
               NULL
        from   diesels d
        join   d_nums dn
        on     dn.loco_id = d.loco_id
        and    dn.start_date = (select max(dn1.start_date)
                                from   d_nums dn1
                                where  dn1.loco_id = d.loco_id
                                and    dn1.start_date <= d.svc_date)';

$result = $db->execute($sql);
echo "Inserted " .  $db->count_affected() . " rows for stock date<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Allocation details when new                                                                 */
/*                                                                                             */
/***********************************************************************************************/

$result = $db->update("d_summary dd, diesels d, d_alloc da, ref_depot dp, ref_depot_codes dpc",
                      "dd.details = concat(dd.details, \"<br />\",
                                           \"Allocated to \",
                                           dp.depot_name,
                                           \" (\",
                                           coalesce(dpc.displayed_depot_code,
                                                     coalesce(da.loan_allocation, da.allocation)),
                                           \")\",
                                           CASE WHEN da.loan_allocation IS NOT NULL THEN
                                             \" (on loan)\"
                                           ELSE
                                             \"\"
                                           END)",
                      "dd.event_type = \"To Service\"
                       and dd.loco_id = d.loco_id
                       and da.loco_id = d.loco_id
                       and da.alloc_flag = \"N\"
                       and dpc.depot_code = coalesce(da.loan_allocation, da.allocation)
                       and dpc.date_from = (select max(dpc1.date_from)
                                            from   ref_depot_codes dpc1
                                            where  dpc1.depot_code = coalesce(da.loan_allocation,
                                                                              da.allocation)
                                            and    dpc1.date_from <= d.b_date)
                       and dp.depot_id = dpc.depot_id");

echo "Updated " .  $db->count_affected() . " rows for allocation details<br />";

/***********************************************************************************************/
/*                                                                                             */
/* ref_livery details when new                                                                     */
/*                                                                                             */
/***********************************************************************************************/

$result = $db->update("d_summary dd, d_to_livery d2l, ref_livery l",
                      "dd.details = concat(dd.details, \"<br />\",
                                           \"Livery applied: \",
                                           coalesce(l.description, l.base_colour))",
                      "dd.event_type = \"To Service\"
                       and d2l.loco_id = dd.loco_id
                       and d2l.start_date = dd.event_date
                       and l.livery_id = d2l.livery_id");

echo "Updated " .  $db->count_affected() . " rows for ref_livery details<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Condemnation details                                                                        */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select d.loco_id, 
               d.w_date, 
               concat("Condemned as ", 
                      dn.number,
                      CASE WHEN d.last_depot IS NOT NULL THEN
                        concat(" from ", dp.depot_name, " (", d.last_depot, ")")
                      ELSE
                        ""
                      END),
               "Withdrawn", 
               NULL
        from   diesels d
        join   d_nums dn
        on     dn.loco_id = d.loco_id
        and    dn.start_date = (select max(dn1.start_date)
                                from   d_nums dn1
                                where  dn1.loco_id = d.loco_id
                                and    dn1.carried_number = "Y"
                                and    dn1.start_date <= d.w_date)
        left join ref_depot_codes dpc
        on     dpc.depot_code = d.last_depot
        and    dpc.date_from = (select max(dpc1.date_from)
                                from   ref_depot_codes dpc1
                                where  dpc1.depot_code = d.last_depot
                                and    dpc1.date_from <= d.w_date)
        left join ref_depot dp
        on     dp.depot_id = dpc.depot_id
        where d.w_date is not null';

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for withdrawals");
echo "Inserted " .  $db->count_affected() . " rows for withdrawal dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* ref_livery changes throught the course of the locomotives life                                  */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select s2l.loco_id, 
               s2l.start_date, 
        concat("Change of ref_livery to ", CASE WHEN l.description IS NOT NULL THEN
                                           l.description
                                       ELSE
                                           CASE WHEN l.lining IS NOT NULL THEN
                                               concat(l.base_colour, " (Lining: ", l.lining, ")")
                                           ELSE
                                               l.base_colour
                                           END
                                       END),
               "Livery", 
               NULL
        FROM   d_to_livery s2l
        JOIN   ref_livery l on s2l.livery_id = l.livery_id
        WHERE  s2l.first_livery = "N"';

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for liveries");
echo "Inserted " .  $db->count_affected() . " rows for ref_livery dates<br />";


/***********************************************************************************************/
/*                                                                                             */
/* Allocation changes throught the course of the locomotives life                              */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select d.loco_id, 
               da.alloc_date,
               concat( CASE WHEN da.loan_allocation IS NOT NULL THEN
                         "Loaned to "
                       ELSE
                         CASE WHEN da.snapshot = "Y" THEN
                           "Allocation dnapshot - "
                         ELSE
                           "Reallocated to "
                         END
                       END,
                       dp.depot_name, " (", coalesce(dpc.displayed_depot_code, dpc.depot_code), ")",
                       CASE WHEN da.caveat IS NOT NULL THEN
                         concat(" (", da.caveat, ")")
                       ELSE
                         " "
                       END,
                       CASE WHEN da.loco_usage IS NOT NULL THEN
                         concat(" (", da.loco_usage, ")")
                       ELSE
                         " "
                       END),
               "Allocation", 
               NULL
        from   diesels d
        join   d_alloc da
        on     da.loco_id = d.loco_id
        and   (da.alloc_flag is NULL or da.alloc_flag = "8" or da.alloc_flag = "B")
        left join ref_depot_codes dpc
        on     dpc.depot_code = coalesce(da.loan_allocation, da.allocation)
        and    dpc.date_from = (select max(dpc1.date_from)
                                from   ref_depot_codes dpc1
                                where  dpc1.depot_code = coalesce(da.loan_allocation,
                                                                  da.allocation)
                                and    dpc1.date_from <= da.alloc_date)
        left join ref_depot dp
        on     dp.depot_id = dpc.depot_id';

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for allocations 1");
echo "Inserted " .  $db->count_affected() . " rows for allocation dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Withdrawals where not final                                                                 */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select d.loco_id, 
               d.w_date,
               concat("Condemned as ", 
                      dn.number,
                      CASE WHEN d.last_depot IS NOT NULL THEN
                        concat(" from ", d.last_depot, " ", dp.depot_name)
                      ELSE
                        ""
                      END),
               "Withdrawn", 
               NULL
        from   diesels d
        join   d_nums dn
        on     dn.loco_id = d.loco_id
        and    dn.start_date = (select max(dn1.start_date)
                                from   d_nums dn1
                                where  dn1.loco_id = d.loco_id
                                and    dn1.carried_number = "Y")
        left join ref_depot_codes dpc
        on     dpc.depot_code = d.last_depot
        and    dpc.date_from = (select max(dpc1.date_from)
                                from   ref_depot_codes dpc1
                                where  dpc1.depot_code = d.last_depot
                                and    dpc1.date_from <= d.w_date)
        left join ref_depot dp
        on     dp.depot_id = dpc.depot_id';

//$result = $db->execute($sql) or die("Couldn't insert into table d_summary for allocations 2");
//echo "Inserted " .  $db->count_affected() . " rows for condemnation dates (prior to reinstatement)<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Going into store                                                                            */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select d.loco_id, 
               da.alloc_date,
               concat("To Store ", 
                      CASE WHEN da.loan_allocation IS NOT NULL THEN
                        concat(" at ", dp.depot_name, " (", da.loan_allocation, ")" )
                      ELSE
                        ""
                      END,
                      CASE WHEN da.caveat IS NOT NULL THEN
                        concat(" (", da.caveat, ")")
                      ELSE
                        ""
                      END),
               "To Store", 
               NULL
        from   diesels d
        join   d_alloc da
        on     da.loco_id = d.loco_id
        and    da.allocation like "98S%"

        left join ref_depot_codes dpc
        on     dpc.depot_code = da.loan_allocation
        and    dpc.date_from = (select max(dpc1.date_from)
                                from   ref_depot_codes dpc1
                                where  dpc1.depot_code = da.loan_allocation
                                and    dpc1.date_from <= da.alloc_date)

        left join ref_depot dp
        on     dp.depot_id = dpc.depot_id';

$result = $db->execute($sql);// or die("Couldn't insert into table d_summary for storage");
echo "Inserted " .  $db->count_affected() . " rows for storage dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Allocation changes for reinstatements                                                       */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select d.loco_id, 
               da.alloc_date,
               concat("Reinstated to ", dp.depot_name, " (", da.allocation, ")"),
               "Reinstated", 
               NULL
        from   diesels d
        join   d_alloc da
        on     da.loco_id = d.loco_id
        and    da.alloc_flag = "R"
        left join ref_depot_codes dpc
        on     dpc.depot_code = da.allocation
        and    dpc.date_from = (select max(dpc1.date_from)
                                from   ref_depot_codes dpc1
                                where  dpc1.depot_code = da.allocation
                                and    dpc1.date_from <= da.alloc_date)
        left join ref_depot dp
        on     dp.depot_id = dpc.depot_id';

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for reinstatements");
echo "Inserted " .  $db->count_affected() . " rows for reinstatement dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Works Visits                                                                                */
/*                                                                                             */
/***********************************************************************************************/

/*
$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select wv.loco_id,
               wv.start_date,
               concat("Works Visit - Arrival: ",
                      coalesce(bl.bl_short_name, bl.bl_name),
                      " (", vt.description, ")",
                      CASE WHEN wv.stopped_date IS NOT NULL THEN
                        concat("<br />Stopped on ",
                               date_format(wv.stopped_date, "%d/%m/%Y"))
                      ELSE
                        " "
                      END,
                      CASE WHEN wv.reason_text IS NOT NULL THEN
                        concat("<br />Work undertaken:  ", wv.reason_text)
                      ELSE
                        " "
                      END),
               "Into Works",
               NULL
        from   works_visits wv
        JOIN   visit_type vt
        ON     vt.visit_code = wv.visit_code
        JOIN   ref_builders bl
        ON     bl.bl_code = wv.bl_code
        WHERE  wv.type = "D"
        AND    wv.start_date IS NOT NULL';

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for works visits arrivals");
echo "Inserted " .  $db->count_affected() . " rows for works visit dates<br />";
*/

/***********************************************************************************************/
/*                                                                                             */
/* Mods on works visits                                                                        */
/*                                                                                             */
/***********************************************************************************************/
/*
$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select wv.loco_id,
               wv.end_date,
               concat("Works Visit - Departure",
                       CASE WHEN wv.duration IS NOT NULL THEN
                         concat(" - ", wv.duration, " days")
                       ELSE
                         " "
                       END),
               "Released from Works",
               NULL
        from   works_visits wv
        JOIN   visit_type vt
        ON     vt.visit_code = wv.visit_code
        JOIN   ref_builders bl
        ON     bl.bl_code = wv.bl_code
        WHERE  wv.type = "D"
        AND    wv.end_date IS NOT NULL';

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for works visit departures");
echo "Inserted " .  $db->count_affected() . " rows for works visit dates<br />";
*/
/***********************************************************************************************/
/*                                                                                             */
/* Modifications                                                                               */
/*                                                                                             */
/***********************************************************************************************/

/*
 $result = $db->update("d_summary dd, diesels d, d_alloc sa, d_to_boiler s2b, d_boiler sb, boiler_type bt",
                      "dd.details = concat(sd.details, \"<br />\",
                                           \"Diagram \",
                                           CASE when bt.boiler_diagram_no IS NULL THEN
                                             \"(unknown)\"
                                               else
                                             bt.boiler_diagram_no
                                           END,
                                           \" boiler fitted\")",
                      "dd.event_type = \"To Service\"
                       and dd.loco_id = d.loco_id
                       and sa.loco_id = d.loco_id
                       and s2b.loco_id = d.loco_id
                       and s2b.d_boiler_id = sb.d_boiler_id
                       and d.b_date = s2b.start_date
                       and bt.boiler_type_id = sb.boiler_type_id");

echo "Updated " .  $db->count_affected() . " rows for 'boiler when new' details<br />";


$result = $db->update("d_summary ss, diesels d, d_to_boiler_type s2bt, boiler_type bt",
                      "sd.details = concat(sd.details, \"<br />\",
                                           \"Diagram \",
                                           CASE when bt.boiler_diagram_no IS NULL THEN
                                             \"(unknown)\"
                                               else
                                             bt.boiler_diagram_no
                                           END,
                                           \" boiler fitted\")",
                      "sd.event_type = \"To Service\"
                       and sd.loco_id = d.loco_id
                       and s2bt.loco_id = d.loco_id
                       and d.b_date = s2bt.start_date
                       and bt.boiler_type_id = s2bt.boiler_type_id");

echo "Updated " .  $db->count_affected() . " rows for 'boiler when new' details<br />";
*/

/***********************************************************************************************/
/*                                                                                             */
/* Modifications 2                                                                             */
/*                                                                                             */
/***********************************************************************************************/


$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select d.loco_id, 
               dm.date_modified,
               concat("Modification: ", m.description),
               "Modification", 
               NULL
        from   diesels d
        join   d_mods dm
        on     dm.loco_id = d.loco_id
        and    dm.visit_id IS NULL
        join   ref_modifications m
        on     m.modification = dm.modification
        and    dm.visit_id IS NULL';


$result = $db->execute($sql) or die("Couldn't insert into table d_summary for modifications");
echo "Inserted " .  $db->count_affected() . " rows for modification dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* ref_components                                                                                  */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select d2c_b.loco_id,
               d2c_b.start_date,
               concat("Power Unit ",
                      cmp_a.serial_no,
                      " removed: ",
                      d2c_a.removal_reason,
                      ". Replaced with ",
                      cmp_b.serial_no,
                      CASE WHEN d2c_a.details IS NOT NULL THEN
                        concat(" (", d2c_a.details, ")")
                      ELSE
                        ""
                      END),
                "Components",
                NULL
        from   d_to_component d2c_a
        left join   d_to_component d2c_b
        on     d2c_a.loco_id = d2c_b.loco_id
        left join ref_components cmp_a
        on     cmp_a.component_id = d2c_a.component_id
        left join ref_components cmp_b
        on     cmp_b.component_id = d2c_b.component_id
        where  d2c_a.end_date = d2c_b.start_date
        and    d2c_a.details = d2c_b.details
        and    d2c_b.visit_id IS NULL';

$result = $db->execute($sql);// or die("Couldn't insert into table d_summary for components");
echo "Inserted " .  $db->count_affected() . " rows for ref_components dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Extra Names                                                                                 */
/*                                                                                             */
/***********************************************************************************************/

$sql = "insert into d_summary (loco_id, event_date, details, event_type, source)
        select dnm.loco_id,
               dnm.start_date,
               concat(CASE WHEN dnm1.name IS NOT NULL THEN
                        \"Renamed '\"
                      ELSE
                        \"Named '\"
                      END,
                      dnm.name,
                      \"'\",
                      CASE WHEN dnm.named_by IS NOT NULL THEN
                        concat(\" by \", dnm.named_by)
                      ELSE
                        \"\"
                      END,
                      CASE WHEN dnm.named_where IS NOT NULL THEN
                        concat(\" at \", dnm.named_where)
                      ELSE
                        \"\"
                      END
                      ),
               \"Naming\",
               NULL
        from   d_name dnm
        join   diesels d
        on     d.loco_id = dnm.loco_id
        and    dnm.visit_id is null
        left join d_name dnm1
        on     dnm1.loco_id = dnm.loco_id
        and    dnm1.start_date < dnm.start_date
        where  dnm.start_date > d.b_date";

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for namings");
echo "Inserted " .  $db->count_affected() . " rows for naming dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Incidents                                                                                   */
/*                                                                                             */
/***********************************************************************************************/

/*
$sql = 'update d_mods dm, works_visits wv
        set    dm.visit_id = wv.visit_id
        where  dm.loco_id = wv.loco_id
        and    wv.type = "D"
        and    dm.date_modified between coalesce(wv.stopped_date, wv.start_date) and wv.end_date';
               

$result = $db->execute($sql);
echo "Updated " .  $db->count_affected() . " rows for d_mods<br />";

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source, ig_id)
        select d2i.loco_id,
               i.sdate_of_incident,
               concat(CASE WHEN ig.ig_title IS NOT NULL THEN
                        concat(ig.ig_title, ": ")
                      ELSE
                        ""
                      END,
                      i.details,
                      CASE WHEN i.reporting_number IS NOT NULL THEN
                        concat(" (", i.reporting_number, ")")
                      ELSE
                        ""
                      END,
                      CASE WHEN d2i.caveat IS NOT NULL THEN
                        concat(" - ", d2i.caveat)
                      ELSE
                        ""
                      END),
               "Sightings",
               i.reference,
               i.ig_id
        from   d_to_i d2i
        join   incidents i
        on     i.inc_id = d2i.inc_id
        left join incident_groups ig
        on     i.ig_id = ig.ig_id';

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for workings");
echo "Inserted " .  $db->count_affected() . " rows for working dates<br />";

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select sp.loco_id,
               sd.sd_date,
               concat(sd.sd_site,
                      CASE WHEN sp.caveat IS NOT NULL THEN
                        concat(" - ", sp.caveat)
                      ELSE
                        ""
                      END,
                      CASE WHEN sp.info IS NOT NULL THEN
                        concat(" - ", sp.info)
                      ELSE
                        ""
                      END),
               "Sightings",
               NULL
        from   d_spotting sp
        join   spotting_site ss
        on     sp.sd_id = sd.sd_id
        where  sd.bl_code IS NULL';

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for workings");
echo "Inserted " .  $db->count_affected() . " rows for working dates<br />";
*/

/***********************************************************************************************/
/*                                                                                             */
/* Renumbering                                                                                 */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select dn.loco_id,
               dn.start_date,
               concat("Renumbered to ",
                       dn.number),
               "Renumbered",
               NULL
         from  d_nums dn
         join  diesels d
         on    d.loco_id = dn.loco_id
         where dn.carried_number = "Y"
         and   dn.start_date <> d.b_date
         and   dn.visit_id is null';

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for renumbering");
echo "Inserted " .  $db->count_affected() . " rows for renumber dates<br />";

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select dn.loco_id,
               dn.start_date,
               concat("Allocated number ",
                      dn.number,
                      " but not taken up"),
               "Number Allocated",
               NULL
         from  d_nums dn
         join  diesels d
         on    d.loco_id = dn.loco_id
         where dn.carried_number = "N"
         and   dn.start_date <> d.b_date';

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for renumbering (2)");
echo "Inserted " .  $db->count_affected() . " rows for renumber dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Works Visits                                                                                */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select wv.loco_id,
               coalesce(wv.start_date, wv.end_date),
               concat("Works Visit - ",
                      ifnull(coalesce(bl.bl_short_name, bl.bl_name), ""),
                      " (", vt.description, ") ",
                      " -",
                      CASE WHEN wv.start_date IS NOT NULL THEN
                        concat(" Arr: ", date_format(wv.start_date, "%d/%m/%Y"), ".")
                      ELSE
                        " "
                      END,
                      CASE WHEN wv.end_date IS NOT NULL THEN
                        concat(" Dep: ", date_format(wv.end_date, "%d/%m/%Y"), ".")
                      ELSE
                        " "
                      END,
                      CASE WHEN wv.stopped_date IS NOT NULL THEN
                        concat("<br />Stopped on ",
                               date_format(wv.stopped_date, "%d/%m/%Y"))
                      ELSE
                        " "
                      END,
                      CASE WHEN wv.summary IS NOT NULL THEN
                        concat("<br />Work undertaken:  <br />", wv.summary)
                      ELSE
                        " "
                      END
                      ),
               "Works Visit",
               NULL
        from   works_visits wv
        LEFT JOIN   ref_visit_type vt
        ON     vt.visit_code = wv.visit_code
        JOIN   ref_builders bl
        ON     bl.bl_code = wv.bl_code
        WHERE  wv.type = "D"';

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for works visits arrivals");
echo "Inserted " .  $db->count_affected() . " rows for works visit dates<br />";

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select wv.loco_id,
               coalesce(wv.start_date, wv.end_date),
               concat("Depot Repair - ",
                      dp.depot_name,
                      " (", vt.description, ") ",
                      " -",
                      CASE WHEN wv.start_date IS NOT NULL THEN
                        concat(" Arr: ", date_format(wv.start_date, "%d/%m/%Y"), ".")
                      ELSE
                        " "
                      END,
                      CASE WHEN wv.end_date IS NOT NULL THEN
                        concat(" Dep: ", date_format(wv.end_date, "%d/%m/%Y"), ".")
                      ELSE
                        " "
                      END,
                      CASE WHEN wv.stopped_date IS NOT NULL THEN
                        concat("<br />Stopped on ",
                               date_format(wv.stopped_date, "%d/%m/%Y"))
                      ELSE
                        " "
                      END,
                      CASE WHEN wv.summary IS NOT NULL THEN
                        concat("<br />Work undertaken:  <br />", wv.summary)
                      ELSE
                        " "
                      END
                      ),
               "Works Visit",
               NULL
        from   works_visits wv
        LEFT JOIN   ref_visit_type vt
        ON     vt.visit_code = wv.visit_code
        JOIN   ref_depot dp
        ON     dp.depot_id = wv.depot_id
        WHERE  wv.type = "D"';

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for ref_depot visits arrivals");
echo "Inserted " .  $db->count_affected() . " rows for ref_depot visit dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Mods on works visits                                                                        */
/*                                                                                             */
/***********************************************************************************************/

/*
$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select wv.loco_id,
               wv.end_date,
               concat("Works Visit - Departure",
                       CASE WHEN wv.duration IS NOT NULL THEN
                         concat(" - ", wv.duration, " days")
                       ELSE
                         " "
                       END),
               "Exit Works",
               NULL
        from   works_visits wv
        JOIN   visit_type vt
        ON     vt.visit_code = wv.visit_code
        JOIN   ref_builders bl
        ON     bl.bl_code = wv.bl_code
        WHERE  wv.type = "D"
        AND    wv.end_date IS NOT NULL';

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for works visit departures");
echo "Inserted " .  $db->count_affected() . " rows for works visit dates<br />";
*/

/***********************************************************************************************/
/*                                                                                             */
/* Scrapping                                                                                   */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select d.loco_id,
               d.s_date,
               concat("Broken up by ",
                      sm.merchant_name,
                      ": ",
                      sy.location),
               "Scrapped",
               NULL
         from  diesels d
         join  ref_scrapyard sy
         on    sy.scrapyard_code = d.scrapyard_code
         join  ref_scrap_merchant sm
         on    sm.merchant_code = substr(sy.scrapyard_code, 1, 3)
         where d.scrapyard_code is not null
         and   d.s_date is not null';

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for scrapping");
echo "Inserted " .  $db->count_affected() . " rows for scrapping<br />";


$sql = 'insert into d_summary (loco_id, event_date, details, event_type, source)
        select d.loco_id,
               d.s_date,
               "Scrapped",
               "Scrapped",
               NULL
         from  diesels d
         where d.scrapyard_code is null
         and   d.s_date is not null';

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for scrapping");
echo "Inserted " .  $db->count_affected() . " rows for scrapping<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Mods on works visits                                                                        */
/*                                                                                             */
/***********************************************************************************************/

/*
$sql = 'update d_summary ss,
               d_to_tender s2t,
               d_tender st,
               tender_type t,
               works_visits wv
        set    sd.details = concat(sd.details,
                                   "<br />Tender fitted: ",
                                   t.tender_type,
                                   " number ",
                                   st.tender_number)
        where  sd.event_type = "Works Visit"
        and    sd.loco_id = s2t.loco_id
        and    sd.event_date between wv.start_date and wv.end_date
        and    s2t.d_tender_id = st.d_tender_id
        and    st.tender_type_id = t.tender_type_id
        and    s2t.loco_id = wv.loco_id
        and    wv.type = "D"
        and    s2t.visit_id = wv.visit_id';
                        
$result = $db->execute($sql);// or die("Couldn't update into table d_summary for works visits/tenders");
echo "Updated " .  $db->count_affected() . " rows for works visit/tender dates<br />";

$sql = 'update d_summary ss,
               d_to_boiler s2b,
               d_boiler sb,
               boiler_type b,
               works_visits wv
        set    sd.details = concat(sd.details,
                                   "<br />Boiler fitted: ",
                                   b.boiler_diagram_no,
                                   " number ",
                                   sb.boiler_number)
        where  sd.event_type = "Works Visit"
        and    sd.loco_id = s2b.loco_id
        and    sd.event_date between wv.start_date and wv.end_date
        and    s2b.d_boiler_id = sb.d_boiler_id
        and    sb.boiler_type_id = b.boiler_type_id
        and    s2b.loco_id = wv.loco_id
        and    wv.type = "D"
        and    s2b.visit_id = wv.visit_id';
        
$result = $db->execute($sql);// or die("Couldn't update into table d_summary for works visits/boilers");
echo "Updated " .  $db->count_affected() . " rows for works visit/boilers dates<br />";

$sql = 'update d_summary dd,
               d_to_livery d2l,
               ref_livery l,
               works_visits wv
        set    dd.details = concat(dd.details,
                                   "<br />Livery applied: ",
                                   coalesce(l.description, l.base_colour))
        where  dd.event_type = "Works Visit"
        and    dd.loco_id = wv.loco_id
        and    wv.type = "D"
        and    dd.event_date between wv.start_date and wv.end_date
        and    d2l.visit_id  = wv.visit_id
        and    l.livery_id   = d2l.livery_id';

$result = $db->execute($sql);// or die("Couldn't update into table d_summary for works visits/livery");
echo "Updated " .  $db->count_affected() . " rows for works visit/livery dates<br />";

*/

$sqlo = 'select distinct(modification) as modi from d_mods';
$resulto = $db->execute($sqlo) or die("Couldn't open d_mods");

while ($row = mysqli_fetch_assoc($resulto))
{
  $sql = 'update d_summary dd,
                 d_mods dm,
                 ref_modifications m,
                 works_visits wv
          set    dd.details = concat(dd.details,
                                     "<br />Modification: ",
                                     m.description)
          where  dd.event_type = "Works Visit"
          and    dd.loco_id = wv.loco_id
          and    dm.loco_id = wv.loco_id
          and    wv.type = "D"
          and    dd.event_date between wv.start_date and wv.end_date
          and    dm.date_modified between wv.start_date and wv.end_date
          and    dm.modification = m.modification
          and    dm.visit_id IS NOT NULL
          and    m.modification = "' . $row['modi'] . '"';

  $result = $db->execute($sql); 
  echo "Updated " .  $db->count_affected() . " rows for works visit/mod " . $row['modi'] . " dates<br />";
}

$sql = 'update d_summary dd,
               d_to_component d2c_a,
               d_to_component d2c_b,
               ref_components cmp_a,
               ref_components cmp_b,
               works_visits wv
        set    dd.details = concat(dd.details, 
                                   "<br />Power Unit ",
                                   cmp_a.serial_no,
                                   " removed: ",
                                   d2c_a.removal_reason,
                                   ". Replaced with ",
                                   cmp_b.serial_no,
                                   CASE WHEN d2c_a.details IS NOT NULL THEN
                                     concat(" (", d2c_a.details, ")")
                                   ELSE
                                     ""
                                   END)
        where  dd.event_type = "Works Visit"
        and    dd.loco_id = wv.loco_id
        and    d2c_a.loco_id = d2c_b.loco_id
        and    d2c_a.loco_id = dd.loco_id
        and    cmp_a.component_id = d2c_a.component_id
        and    cmp_b.component_id = d2c_b.component_id
        and    d2c_a.end_date = d2c_b.start_date
        and    d2c_a.details  = d2c_b.details
        and    d2c_b.visit_id = wv.visit_id
        and    d2c_a.visit_id = wv.visit_id';

$result = $db->execute($sql);// or die("Couldn't insert into table d_summary for components");
echo "Inserted " .  $db->count_affected() . " rows for ref_components dates<br />";

$sql = "update d_summary
        set    details = replace(details, ' 00/00/', ' ?/')";

$result = $db->execute($sql);

$sql = "update d_summary
        set    details = replace(details, ' 00/', ' ?/')";

$result = $db->execute($sql);

?>
