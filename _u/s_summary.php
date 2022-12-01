<?php

require("../lib/quickdb.class.php");
require("../lib/brlib.php");

$db = fn_connectdb() or die("Couldn't connect to database");

set_time_limit(360);

$result = $db->delete("s_summary", "loco_id >= 0");
echo "Deleted " .  $db->count_affected() . " rows<br />";

$sql = 'update works_visits
        set    summary = NULL
        where  type = "S"';
        
if ($debug) echo $sql;

$result = $db->execute($sql) or die("works_visits 1");

$sql = 'update works_visits
        set    summary = concat(reason_text, "<br />")
        where  type = "S"
        and    reason_text is not null';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("works_visits 2");

$sql = 'update works_visits wv, 
               ref_boiler_type bt,
               s_boiler sb,
               s_boiler_nums sbn,
               s_to_boiler s2b
        set    wv.summary = concat(ifnull(wv.summary, ""),
                                   "Boiler number ",
                                   sbn.boiler_number,
                                   " (Diagram ",
                                   bt.boiler_diagram_no,
                                   ")<br />")
        where  wv.type = "S"
        and    wv.visit_id = s2b.visit_id
        and    s2b.s_boiler_id = sb.s_boiler_id
        and    sb.boiler_type_id = bt.boiler_type_id
        and    sbn.s_boiler_id = sb.s_boiler_id';

$result = $db->execute($sql) or die("works_visits 3");

$sql = 'update works_visits wv, 
               ref_tender_type tt,
               s_tender st,
               s_to_tender s2t
        set    wv.summary = concat(ifnull(wv.summary, ""),
                                   "Tender number ",
                                   st.tender_number,
                                   " (",
                                   tt.tender_type,
                                   ") attached.<br />")
        where  wv.type = "S"
        and    wv.visit_id = s2t.visit_id
        and    s2t.s_tender_id = st.s_tender_id
        and    st.tender_type_id = tt.tender_type_id';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("works_visits 4");

$sql = 'update works_visits wv, 
               s_mods sm,
               ref_modifications m
        set    wv.summary = concat(ifnull(wv.summary, ""),
                                   m.description,
                                   "<br />")
        where  wv.type = "S"
        and    wv.visit_id = sm.visit_id
        and    sm.modification = m.modification';

$result = $db->execute($sql) or die("works_visits 5");

$sql = 'update works_visits wv, 
               s_to_livery s2l,
               ref_livery l
        set    wv.summary = concat(ifnull(wv.summary, ""),
                                   "Painted ",
                                   l.description,
                                   "<br />")
        where  wv.type = "S"
        and    wv.visit_id = s2l.visit_id
        and    s2l.livery_id = l.livery_id';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("works_visits 6");

$sql = 'update works_visits wv, 
               s_nums sn
        set    wv.summary = concat(ifnull(wv.summary, ""),
                                   "Renumbered to ",
                                   sn.company,
                                   " ",
                                   CASE WHEN sn.subtype IS NOT NULL THEN
                                     concat("(", sn.subtype, ") number ")
                                   ELSE ""
                                   END,
                                   CASE WHEN sn.prefix IS NOT NULL THEN
                                     sn.prefix
                                   ELSE ""
                                   END,
                                   sn.number,
                                   CASE WHEN sn.suffix IS NOT NULL THEN
                                     sn.suffix
                                   ELSE ""
                                   END,
                                   "<br />")
        where  wv.type = "S"
        and    wv.visit_id = sn.visit_id
        and    sn.carried_number = "Y"';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("works_visits 7");

$sql = 'update works_visits wv, 
               s_name sn
        set    wv.summary = concat(ifnull(wv.summary, ""),
                                   "De-named ",
                                   sn.name,
                                   "<br />")
        where  wv.type = "S"
        and    wv.visit_id = sn.visit_id2';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("works_visits 8a");

$sql = 'update works_visits wv, 
               s_name sn
        set    wv.summary = concat(ifnull(wv.summary, ""),
                                   "Named ",
                                   sn.name,
                                   "<br />")
        where  wv.type = "S"
        and    wv.visit_id = sn.visit_id';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("works_visits 8b");

$sql = 'update works_visits wv
        set    wv.duration = datediff(end_date, start_date) + 1
        where  wv.start_date is not null
        and    wv.end_date is not null';

if ($debug) echo $sql;

$result = $db->execute($sql);

// $result = $db->execute($sql) or die("Couldn't truncate table s_summary");

/***********************************************************************************************/
/*                                                                                             */
/* Basic details when new                                                                      */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
        select s2snip.loco_id,
               ssnip.snippet_date,
               concat("Report: ",
                      ssnip.snippet,
                      " (", pub.title,
                      CASE WHEN pub.issue IS NOT NULL THEN
                        concat(" - ", pub.issue)
                      ELSE
                        ""
                      END,
                      ")"),
               "Report",
               NULL
        from   s_snippet ssnip
        join   s_to_snippet s2snip
        on     s2snip.s_snippet_id = ssnip.s_snippet_id
        join   ref_publication pub
        on     pub.pub_id = ssnip.publication_id
        where  s2snip.loco_id > 0';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("rows for snippets");
echo "Inserted " .  $db->count_affected() . " rows for snippets<br />";

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
        select s.loco_id, 
               s.b_date, 
               concat("To service as ",
                      coalesce(c.cmp_name, sn.company),
                      " Number ",
                      sn.number,
                      CASE WHEN snm.name IS NOT NULL THEN
                        concat(", name: ", snm.name)
                      ELSE
                        " "
                      END), 
               "To Service", 
               NULL
        from   steam s
        join   s_nums sn
        on     sn.loco_id = s.loco_id
        and    sn.start_date = s.b_date
        left join ref_companies c
        on     c.cmp_initials = sn.company
        left join s_name snm
        on     snm.loco_id = s.loco_id
        and    snm.start_date = s.b_date';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("rows for steam");
echo "Inserted " .  $db->count_affected() . " rows for build date<br />";

$result = $db->update("s_summary ds, steam d, ref_builders b",
                      "ds.details = concat(ds.details, \"<br />\",
                                               \"Built at \", b.bl_name,
                       CASE WHEN d.works_num IS NULL THEN
                         \" \"
                       ELSE
                         concat(\", Works Number \", d.works_num)
                             END)",
                      "ds.event_type = \"To Service\"
                       and    ds.loco_id = d.loco_id
                       and    d.bl_code = b.bl_code");

echo "Updated " .  $db->count_affected() . " rows for build details<br />";

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
        select s.loco_id, 
               s.svc_date, 
               concat("To ",
                      sn.company,
                      " stock"), 
               "To Stock", 
               NULL
        from   steam s
        join   s_nums sn
        on     sn.loco_id = s.loco_id
        and    sn.start_date = (select max(sn1.start_date)
                                from   s_nums sn1
                                where  sn1.loco_id = s.loco_id
                                and    sn1.start_date <= svc_date)';

if ($debug) echo $sql;

$result = $db->execute($sql);
echo "Inserted " .  $db->count_affected() . " rows for stock date<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Allocation details when new                                                                 */
/*                                                                                             */
/***********************************************************************************************/

$result = $db->update("s_summary ds, steam d, s_alloc da, ref_depot dp, ref_depot_codes dpc",
                      "ds.details = concat(ds.details, \"<br />\",
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
                      "ds.event_type = \"To Service\"
                       and ds.loco_id = d.loco_id
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
/* Livery details when new                                                                     */
/*                                                                                             */
/***********************************************************************************************/

$result = $db->update("s_summary ds, s_to_livery d2l, ref_livery l",
                      "ds.details = concat(ds.details, \"<br />\",
                                           \"Livery applied: \",
                                           coalesce(l.description, l.base_colour))",
                      "ds.event_type = \"To Service\"
                       and d2l.loco_id = ds.loco_id
                       and d2l.start_date = ds.event_date
                       and l.livery_id = d2l.livery_id");

echo "Updated " .  $db->count_affected() . " rows for livery details<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Condemnation details                                                                        */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
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
        from   steam d
        join   s_nums dn
        on     dn.loco_id = d.loco_id
        and    dn.start_date = (select max(dn1.start_date)
                                from   s_nums dn1
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

if ($debug) echo $sql;

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for withdrawals");
echo "Inserted " .  $db->count_affected() . " rows for withdrawal dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Livery changes throught the course of the locomotives life                                  */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
        select s2l.loco_id, 
               s2l.start_date, 
        concat("Change of livery to ", CASE WHEN l.description IS NOT NULL THEN
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
        FROM   s_to_livery s2l
        JOIN   ref_livery l on s2l.livery_id = l.livery_id
        WHERE  s2l.first_livery = "N"';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for liveries");
echo "Inserted " .  $db->count_affected() . " rows for livery dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Tender changes throught the course of the locomotives life                                  */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
        select s.loco_id, 
               s2t.start_date, 
               concat("Tender fitted: ", t.tender_type, " number ", st.tender_number),
               "Tender", 
               NULL
        from   s_to_tender s2t

        join   s_tender st
        on     st.s_tender_id = s2t.s_tender_id

        join   steam s
        on     s.loco_id = s2t.loco_id
        and    s2t.start_date <> s.b_date

        join   ref_tender_type t
        on     t.tender_type_id = st.tender_type_id

        where  s2t.visit_id IS NULL';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for tenders");
echo "Inserted " .  $db->count_affected() . " rows for tender dates<br />";

$result = $db->update("s_summary ds, steam d, s_to_tender s2t, s_tender st, ref_tender_type t",
                      "ds.details = concat(ds.details, \"<br />\",
                                               \"Tender fitted: \",
                                               t.tender_type)",
                      "ds.event_type = \"To Service\"
                       and    ds.loco_id = d.loco_id
                       and    s2t.loco_id = d.loco_id
                       and    st.s_tender_id = s2t.s_tender_id
                       and    t.tender_type_id = st.tender_type_id
                       and    s2t.start_date = d.b_date
                       and    s2t.visit_id IS NULL");

echo "Updated " .  $db->count_affected() . " rows for tender details<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Allocation changes throught the course of the locomotives life                              */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
        select d.loco_id, 
               da.alloc_date,
               concat( CASE WHEN da.loan_allocation IS NOT NULL THEN
                         "Loaned to "
                       ELSE
                         CASE WHEN da.snapshot = "Y" THEN
                           "Allocation Snapshot - "
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
        from   steam d
        join   s_alloc da
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

if ($debug) echo $sql;

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for allocations 1");
echo "Inserted " .  $db->count_affected() . " rows for allocation dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Withdrawals where not final                                                                 */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
        select s.loco_id, 
               s.w_date,
               concat("Condemned as ", 
                      sn.number,
                      CASE WHEN s.last_depot IS NOT NULL THEN
                        concat(" from ", s.last_depot, " ", dp.depot_name)
                      ELSE
                        ""
                      END),
               "Withdrawn", 
               NULL
        from   steam s
        join   s_nums sn
        on     sn.loco_id = s.loco_id
        and    sn.start_date = (select max(sn1.start_date)
                                from   s_nums sn1
                                where  sn1.loco_id = s.loco_id
                                and    sn1.carried_number = "Y")
        left join ref_depot_codes dpc
        on     dpc.depot_code = s.last_depot
        and    dpc.date_from = (select max(dpc1.date_from)
                                from   ref_depot_codes dpc1
                                where  dpc1.depot_code = s.last_depot
                                and    dpc1.date_from <= s.w_date)
        left join ref_depot dp
        on     dp.depot_id = dpc.depot_id';

if ($debug) echo $sql;

//$result = $db->execute($sql) or die("Couldn't insert into table s_summary for allocations 2");
//echo "Inserted " .  $db->count_affected() . " rows for condemnation dates (prior to reinstatement)<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Going into store                                                                            */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
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
        from   steam d
        join   s_alloc da
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

if ($debug) echo $sql;

$result = $db->execute($sql);// or die("Couldn't insert into table s_summary for storage");
echo "Inserted " .  $db->count_affected() . " rows for storage dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Allocation changes for reinstatements                                                       */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
        select d.loco_id, 
               da.alloc_date,
               concat("Reinstated to ", dp.depot_name, " (", da.allocation, ")"),
               "Reinstated", 
               NULL
        from   steam d
        join   s_alloc da
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

if ($debug) echo $sql;

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for reinstatements");
echo "Inserted " .  $db->count_affected() . " rows for reinstatement dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Works Visits                                                                                */
/*                                                                                             */
/***********************************************************************************************/

/*
$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
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
        JOIN   builders bl
        ON     bl.bl_code = wv.bl_code
        WHERE  wv.type = "S"
        AND    wv.start_date IS NOT NULL';

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for works visits arrivals");
echo "Inserted " .  $db->count_affected() . " rows for works visit dates<br />";
*/

/***********************************************************************************************/
/*                                                                                             */
/* Mods on works visits                                                                        */
/*                                                                                             */
/***********************************************************************************************/
/*
$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
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
        JOIN   builders bl
        ON     bl.bl_code = wv.bl_code
        WHERE  wv.type = "S"
        AND    wv.end_date IS NOT NULL';

$result = $db->execute($sql) or die("Couldn't insert into table d_summary for works visit departures");
echo "Inserted " .  $db->count_affected() . " rows for works visit dates<br />";
*/
/***********************************************************************************************/
/*                                                                                             */
/* ref_modifications                                                                               */
/*                                                                                             */
/***********************************************************************************************/

$result = $db->update("s_summary ss, steam s, s_alloc sa, s_to_boiler s2b, s_boiler sb, ref_boiler_type bt",
                      "ss.details = concat(ss.details, \"<br />\",
                                           \"Diagram \",
                                           CASE when bt.boiler_diagram_no IS NULL THEN
                                             \"(unknown)\"
                                               else
                                             bt.boiler_diagram_no
                                           END,
                                           \" boiler fitted\")",
                      "ss.event_type = \"To Service\"
                       and ss.loco_id = s.loco_id
                       and sa.loco_id = s.loco_id
                       and s2b.loco_id = s.loco_id
                       and s2b.s_boiler_id = sb.s_boiler_id
                       and s.b_date = s2b.start_date
                       and bt.boiler_type_id = sb.boiler_type_id");

if ($debug) echo $sql;

echo "Updated " .  $db->count_affected() . " rows for 'boiler when new' details<br />";


$result = $db->update("s_summary ss, steam s, s_to_boiler_type s2bt, ref_boiler_type bt",
                      "ss.details = concat(ss.details, \"<br />\",
                                           \"Diagram \",
                                           CASE when bt.boiler_diagram_no IS NULL THEN
                                             \"(unknown)\"
                                               else
                                             bt.boiler_diagram_no
                                           END,
                                           \" boiler fitted\")",
                      "ss.event_type = \"To Service\"
                       and ss.loco_id = s.loco_id
                       and s2bt.loco_id = s.loco_id
                       and s.b_date = s2bt.start_date
                       and bt.boiler_type_id = s2bt.boiler_type_id");

echo "Updated " .  $db->count_affected() . " rows for 'boiler when new' details<br />";

/***********************************************************************************************/
/*                                                                                             */
/* ref_modifications 2                                                                             */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
        select s.loco_id, 
               sm.date_modified,
               concat("Modification: ", m.description),
               "Modification", 
               NULL
        from   steam s
        join   s_mods sm
        on     sm.loco_id = s.loco_id
        and    sm.visit_id IS NULL
        join   ref_modifications m
        on     m.modification = sm.modification
        and    sm.visit_id IS NULL
        UNION

        SELECT s2b.loco_id,
               s2b.start_date,
               concat("Diagram ",
                      CASE when bt.boiler_diagram_no IS NULL THEN
                        "(unknown)"
                           else
                        bt.boiler_diagram_no
                      END,
                      CASE when sbn.boiler_number IS NULL THEN
                        " "
                          else
                        concat(" number ", sbn.boiler_number, " ")
                      END,
                      "boiler fitted") AS description,
               "Modification", 
               NULL
        FROM   s_to_boiler s2b
        JOIN   steam s
        ON     s.loco_id = s2b.loco_id
        AND    s.b_date <> s2b.start_date
        LEFT JOIN s_boiler sb
        ON     sb.s_boiler_id = s2b.s_boiler_id
        LEFT JOIN s_boiler_nums sbn
        ON     sbn.s_boiler_id = sb.s_boiler_id
        JOIN   ref_boiler_type bt
        ON     bt.boiler_type_id = sb.boiler_type_id
        WHERE  s2b.visit_id is null
        
        UNION
        
        SELECT s2bt.loco_id,
               s2bt.start_date,
               concat("Diagram ",
                      CASE when bt.boiler_diagram_no IS NULL THEN
                        "(unknown)"
                           else
                        bt.boiler_diagram_no
                      END,
                      " boiler fitted") AS description,
               "Modification", 
               NULL
        FROM   s_to_boiler_type s2bt
        JOIN   steam s
        ON     s.loco_id = s2bt.loco_id
        JOIN   ref_boiler_type bt
        ON     bt.boiler_type_id = s2bt.boiler_type_id
        WHERE  s2bt.start_date > s.b_date';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for ref_modifications");
echo "Inserted " .  $db->count_affected() . " rows for modification dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* ref_components                                                                                  */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
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
        from   s_to_component d2c_a
        left join   s_to_component d2c_b
        on     d2c_a.loco_id = d2c_b.loco_id
        left join ref_components cmp_a
        on     cmp_a.component_id = d2c_a.component_id
        left join ref_components cmp_b
        on     cmp_b.component_id = d2c_b.component_id
        where  d2c_a.end_date = d2c_b.start_date
        and    d2c_a.details = d2c_b.details
        and    d2c_b.visit_id IS NULL';

if ($debug) echo $sql;

$result = $db->execute($sql);// or die("Couldn't insert into table s_summary for ref_components");
echo "Inserted " .  $db->count_affected() . " rows for ref_components dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Extra Names                                                                                 */
/*                                                                                             */
/***********************************************************************************************/

$sql = "insert into s_summary (loco_id, event_date, details, event_type, source)
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
        from   s_name dnm
        join   steam d
        on     d.loco_id = dnm.loco_id
        and    dnm.visit_id is null
        left join s_name dnm1
        on     dnm1.loco_id = dnm.loco_id
        and    dnm1.start_date < dnm.start_date
        where  dnm.start_date > d.b_date";

if ($debug) echo $sql;

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for namings");
echo "Inserted " .  $db->count_affected() . " rows for naming dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Incidents                                                                                   */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into s_summary (loco_id, event_date, event_edate, details, event_type)
        select log_l.loco_id,
               log_v.visit_date,
               NULL,
               concat(log_v.title, " ", log_v.details, " - ", log_l.notes),
               "Sightings"
        from   log_visit log_v
        join   log_vw
        on     log_vw.visit_id = log_v.visit_id
        join   log_locos log_l
        on     log_l.vw_id = log_vw.vw_id
        and    log_l.type = "S"
        and    log_l.loco_id > 0';

if ($debug) echo $sql;

// $result = $db->execute($sql);
// echo "Inserted " .  $db->count_affected() . " rows for sightings<br />";

/*

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source, ig_id)
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
        from   s_to_i d2i
        join   incidents i
        on     i.inc_id = d2i.inc_id
        left join incident_groups ig
        on     i.ig_id = ig.ig_id';

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for workings");
echo "Inserted " .  $db->count_affected() . " rows for working dates<br />";

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
        select sp.loco_id,
               ss.ss_date,
               concat(ss.ss_site,
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
        from   s_spotting sp
        join   spotting_site ss
        on     sp.ss_id = ss.ss_id
        where  ss.bl_code IS NULL';

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for workings");
echo "Inserted " .  $db->count_affected() . " rows for working dates<br />";
*/

/***********************************************************************************************/
/*                                                                                             */
/* Renumbering                                                                                 */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
        select sn.loco_id,
               sn.start_date,
               concat("Renumbered to ",
                      CASE WHEN sn.prefix IS NOT NULL THEN
                       sn.prefix
                      ELSE
                       ""
                      END,
                      sn.number,
                      CASE WHEN sn.suffix IS NOT NULL THEN
                       sn.suffix
                      ELSE
                       ""
                      END),
               "Renumbered",
               NULL
         from  s_nums sn
         join  steam s
         on    s.loco_id = sn.loco_id
         where sn.carried_number = "Y"
         and   sn.start_date <> s.b_date
         and   sn.visit_id is null';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for renumbering");
echo "Inserted " .  $db->count_affected() . " rows for renumber dates<br />";

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
        select dn.loco_id,
               dn.start_date,
               concat("Allocated number ",
                      CASE WHEN dn.prefix IS NOT NULL THEN
                       dn.prefix
                      ELSE
                       ""
                      END,
                      dn.number,
                      CASE WHEN dn.suffix IS NOT NULL THEN
                       dn.suffix
                      ELSE
                       ""
                      END,
                      " but not taken up"),
               "Number Allocated",
               NULL
         from  s_nums dn
         join  steam d
         on    d.loco_id = dn.loco_id
         where dn.carried_number = "N"
         and   dn.start_date <> d.b_date';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for renumbering (2)");
echo "Inserted " .  $db->count_affected() . " rows for renumber dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Works Visits                                                                                */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
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
        WHERE  wv.type = "S"';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for works visits arrivals");
echo "Inserted " .  $db->count_affected() . " rows for works visit dates<br />";

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
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
        WHERE  wv.type = "S"';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for depot visits arrivals");
echo "Inserted " .  $db->count_affected() . " rows for depot visit dates<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Mods on works visits                                                                        */
/*                                                                                             */
/***********************************************************************************************/

/*
$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
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
        JOIN   builders bl
        ON     bl.bl_code = wv.bl_code
        WHERE  wv.type = "S"
        AND    wv.end_date IS NOT NULL';

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for works visit departures");
echo "Inserted " .  $db->count_affected() . " rows for works visit dates<br />";
*/

/***********************************************************************************************/
/*                                                                                             */
/* Scrapping                                                                                   */
/*                                                                                             */
/***********************************************************************************************/

$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
        select s.loco_id,
               s.s_date,
               concat("Broken up by ",
                      sm.merchant_name,
                      ": ",
                      sy.location),
               "Scrapped",
               NULL
         from  steam s
         join  ref_scrapyard sy
         on    sy.scrapyard_code = s.scrapyard_code
         join  ref_scrap_merchant sm
         on    sm.merchant_code = substr(sy.scrapyard_code, 1, 3)
         where s.scrapyard_code is not null
         and   s.s_date is not null';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for scrapping");
echo "Inserted " .  $db->count_affected() . " rows for scrapping<br />";


$sql = 'insert into s_summary (loco_id, event_date, details, event_type, source)
        select s.loco_id,
               s.s_date,
               "Scrapped",
               "Scrapped",
               NULL
         from  steam s
         where s.scrapyard_code is null
         and   s.s_date is not null';

if ($debug) echo $sql;

$result = $db->execute($sql) or die("Couldn't insert into table s_summary for scrapping");
echo "Inserted " .  $db->count_affected() . " rows for scrapping<br />";

/***********************************************************************************************/
/*                                                                                             */
/* Mods on works visits                                                                        */
/*                                                                                             */
/***********************************************************************************************/

/*
$sql = 'update s_summary ss,
               s_to_tender s2t,
               s_tender st,
               tender_type t,
               works_visits wv
        set    ss.details = concat(ss.details,
                                   "<br />Tender fitted: ",
                                   t.tender_type,
                                   " number ",
                                   st.tender_number)
        where  ss.event_type = "Works Visit"
        and    ss.loco_id = s2t.loco_id
        and    ss.event_date between wv.start_date and wv.end_date
        and    s2t.s_tender_id = st.s_tender_id
        and    st.tender_type_id = t.tender_type_id
        and    s2t.loco_id = wv.loco_id
        and    wv.type = "S"
        and    s2t.visit_id = wv.visit_id';
                        
$result = $db->execute($sql);// or die("Couldn't update into table s_summary for works visits/tenders");
echo "Updated " .  $db->count_affected() . " rows for works visit/tender dates<br />";

$sql = 'update s_summary ss,
               s_to_boiler s2b,
               s_boiler sb,
               ref_boiler_type b,
               works_visits wv
        set    ss.details = concat(ss.details,
                                   "<br />Boiler fitted: ",
                                   b.boiler_diagram_no,
                                   " number ",
                                   sb.boiler_number)
        where  ss.event_type = "Works Visit"
        and    ss.loco_id = s2b.loco_id
        and    ss.event_date between wv.start_date and wv.end_date
        and    s2b.s_boiler_id = sb.s_boiler_id
        and    sb.boiler_type_id = b.boiler_type_id
        and    s2b.loco_id = wv.loco_id
        and    wv.type = "S"
        and    s2b.visit_id = wv.visit_id';
        
$result = $db->execute($sql);// or die("Couldn't update into table s_summary for works visits/boilers");
echo "Updated " .  $db->count_affected() . " rows for works visit/boilers dates<br />";

$sql = 'update s_summary ds,
               s_to_livery d2l,
               livery l,
               works_visits wv
        set    ds.details = concat(ds.details,
                                   "<br />Livery applied: ",
                                   coalesce(l.description, l.base_colour))
        where  ds.event_type = "Works Visit"
        and    ds.loco_id = wv.loco_id
        and    wv.type = "S"
        and    ds.event_date between wv.start_date and wv.end_date
        and    d2l.visit_id  = wv.visit_id
        and    l.livery_id   = d2l.livery_id';

$result = $db->execute($sql);// or die("Couldn't update into table s_summary for works visits/livery");
echo "Updated " .  $db->count_affected() . " rows for works visit/livery dates<br />";

*/

$sqlo = 'select distinct(modification) as modi from s_mods';
$resulto = $db->execute($sqlo) or die("Couldn't open s_mods");

while ($row = mysqli_fetch_assoc($resulto))
{
  $sql = 'update s_summary ss,
                 s_mods sm,
                 ref_modifications m,
                 works_visits wv
          set    ss.details = concat(ss.details,
                                     "<br />Modification: ",
                                     m.description)
          where  ss.event_type = "Works Visit"
          and    ss.loco_id = wv.loco_id
          and    sm.loco_id = wv.loco_id
          and    wv.type = "S"
          and    ss.event_date between wv.start_date and wv.end_date
          and    sm.date_modified between wv.start_date and wv.end_date
          and    sm.modification = m.modification
          and    sm.visit_id IS NULL
          and    m.modification = "' . $row['modi'] . '"';

  $result = $db->execute($sql); 
  echo "Updated " .  $db->count_affected() . " rows for works visit/mod " . $row['modi'] . " dates<br />";
}

$sql = 'update s_summary ds,
               s_to_component d2c_a,
               s_to_component d2c_b,
               ref_components cmp_a,
               ref_components cmp_b,
               works_visits wv
        set    ds.details = concat(ds.details, 
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
        where  ds.event_type = "Works Visit"
        and    ds.loco_id = wv.loco_id
        and    d2c_a.loco_id = d2c_b.loco_id
        and    d2c_a.loco_id = ds.loco_id
        and    cmp_a.component_id = d2c_a.component_id
        and    cmp_b.component_id = d2c_b.component_id
        and    d2c_a.end_date = d2c_b.start_date
        and    d2c_a.details  = d2c_b.details
        and    d2c_b.visit_id = wv.visit_id
        and    d2c_a.visit_id = wv.visit_id';

if ($debug) echo $sql;

$result = $db->execute($sql);// or die("Couldn't insert into table s_summary for ref_components");
echo "Inserted " .  $db->count_affected() . " rows for ref_components dates<br />";

$sql = "update s_summary
        set    details = replace(details, ' 00/00/', ' ?/')";

$result = $db->execute($sql);

$sql = "update s_summary
        set    details = replace(details, ' 00/', ' ?/')";

$result = $db->execute($sql);

?>
