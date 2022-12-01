select "Diesel"               AS long_type,
       "D"                    AS type,
       da2.loco_id            AS loco_id,
       dn.number              AS number,
       concat("locoqry.php?action=locodata&id=", da2.loco_id, "&type=D&loco=", dn.number)
                              AS number_hl,
       da1.allocation         AS alloc_prior,
       concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                              AS alloc_prior_hl,
       da1.alloc_date         AS alloc_date_prior,
       dp1.depot_name         AS depot_name_prior,
       concat("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                              AS depot_name_prior_hl,
       da2.allocation         AS alloc_current,
       concat("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                              AS alloc_current_hl,
       da2.alloc_date         AS alloc_date_current,
       dp2.depot_name         AS depot_name_current,
       concat("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                              AS depot_name_current_hl,
       da3.allocation         AS alloc_next,
       concat("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                              AS alloc_next_hl,
       da3.alloc_date         AS alloc_date_next,
       dp3.depot_name         AS depot_name_next,
       concat("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                              AS depot_name_next_hl,

from   d_alloc da2
left join d_alloc da1
on     da1.loco_id = da2.loco_id
and    da1.alloc_date = (select max(da1a.alloc_date)
                         from   d_alloc da1a
                         where  da1a.alloc_date < da2.alloc_date
                         and    da1a.loco_id = da2.loco_id)
left join d_alloc da3
on     da3.loco_id = da2.loco_id
and    da3.alloc_date = (select min(da3a.alloc_date)
                         from   d_alloc da3a
                         where  da3a.alloc_date > da2.alloc_date
                         and    da3a.loco_id = da2.loco_id)
LEFT JOIN ref_depot_codes dpc1
ON     dpc1.depot_code = da1.allocation
AND    da1.alloc_date between dpc1.date_from and ifnull(dpc1.date_to, "2999-01-01")
LEFT JOIN   ref_depot dp1
ON     dp1.depot_id = dpc1.depot_id

JOIN   ref_depot_codes dpc2
ON     dpc2.depot_code = da2.allocation
AND    da2.alloc_date between dpc2.date_from and ifnull(dpc2.date_to, "2999-01-01")
JOIN   ref_depot dp2
ON     dp2.depot_id = dpc2.depot_id
AND    dp2.depot_id = 555

LEFT JOIN ref_depot_codes dpc3
ON     dpc3.depot_code = da3.allocation
AND    da3.alloc_date between dpc3.date_from and ifnull(dpc3.date_to, "2999-01-01")
LEFT JOIN   ref_depot dp3
ON     dp3.depot_id = dpc3.depot_id

join   d_nums dn
on     dn.loco_id = da2.loco_id
AND    da2.alloc_date between dn.start_date
                          and ifnull(dn.end_date,   "2999-01-01")



          select  "Diesel"                  AS type,
	          da2.loco_id               AS loco_id,
                  da2.alloc_date            AS alloc_date,
                  da2.allocation,
                  concat("sites.php?page=depots&action=query&id=", dp2.depot_id) AS allocation_hl,
                  concat("sites.php?page=depots&action=query&id=", dp2.depot_id) AS depot_name_hl,
                  dp2.depot_id,
	          dp2.depot_name,
	          da2.alloc_flag,
	          da2.period,
	          da2.seq                   AS seq,
	          dcl.d_class_id,
	          dcl.d_class_var_id,
	          ifnull(dc.common_name,dc.identifier) AS loco_type,
	          dc.wheel_arrangement      AS wheel_arr,
                  concat("misc.php?page=wheel_arr&id=", dc.wheel_arrangement) AS wheel_arr_hl,
	          dcv.designer              AS designer,
                  concat("people.php?page=cme&name=",dcv.designer) AS designer_hl,
	          dcv.identifier            AS class_type,
                  concat("locoqry.php?action=locodata&id=", da2.loco_id,
                                 "&type=D&loco=",dn.number) AS number_hl
          from    d_alloc da2
          join    d_nums dn
          on      dn.loco_id = da2.loco_id
          AND     da2.alloc_date between dn.start_date
                                     and ifnull(dn.end_date,   "2999-01-01")

          JOIN    ref_depot_codes dpc
          ON      dpc.depot_code = da2.allocation
          AND     da2.alloc_date between dpc.date_from and ifnull(dpc.date_to, "2999-01-01")
          JOIN    ref_depot dp2
          ON      dp2.depot_id = dpc.depot_id

          join    d_class_link dcl
          on      dcl.loco_id = da2.loco_id
          and     da2.alloc_date between ifnull(dcl.start_date, "1800-01-01") 
		                                 and ifnull(dcl.end_date,   "2999-12-31")
          join    d_class dc
          on      dc.d_class_id = dcl.d_class_id
          join    d_class_var dcv
          on      dcv.d_class_id = dcl.d_class_id
          and     dcv.d_class_var_id = dcl.d_class_var_id

	        left join d_alloc da1
	        on      da2.loco_id = da1.loco_id

          JOIN    ref_depot_codes dpc1
          ON      dpc1.depot_code = da1.allocation
          AND     da1.alloc_date between dpc1.date_from 
                                     and ifnull(dpc1.date_to, "2999-01-01")
          AND     da1.alloc_date = da2.alloc_date

          JOIN    ref_depot dp1
          ON      dp1.depot_id = dpc1.depot_id
	        AND     dpc1.depot_id = ' . $id . '
