           CREATE TABLE `brdataba_live`.`tdw_dep_snap_new` AS SELECT * FROM `brdataba_live`.`tdw_dep_snap` WHERE 1 = 0;
           
           INSERT INTO tdw_dep_snap_new
               SELECT "Steam"         AS long_type,
               "S"                    AS type,
               sa2.loco_id            AS loco_id,
               sa1.allocation         AS alloc_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS alloc_prior_hl,
               sa1.alloc_date         AS alloc_date_prior,
               date_format(sa1.alloc_date, "%Y%m%d")  AS alloc_date_prior_fmt,
               sa1.alloc_flag         AS alloc_flag_prior,
               dp1.depot_name         AS depot_name_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS depot_name_prior_hl,
               ifnull(dpc2.displayed_depot_code, dpc2.depot_code)  AS alloc_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                      AS alloc_current_hl,
               sa2.alloc_date         AS alloc_date_current,
               date_format(sa2.alloc_date, "%Y%m%d")  AS alloc_date_current_fmt,
               sa2.alloc_flag         AS alloc_flag_current,
               dp2.depot_name         AS depot_name_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id)
                                      AS depot_name_current_hl,
               dp2.depot_id           AS depot_id_current,
               sa3.allocation         AS alloc_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS alloc_next_hl,
               sa3.alloc_date         AS alloc_date_next,
               date_format(sa3.alloc_date, "%Y%m%d")  AS alloc_date_next_fmt,
               sa3.alloc_flag         AS alloc_flag_next,
               dp3.depot_name         AS depot_name_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS depot_name_next_hl,
               IFNULL(sc.common_name, sc.identifier) 
                                      AS loco_type,
               concat("locoqry.php?action=class&type=S&id=", sc.s_class_id) AS loco_type_hl,
               sc.wheel_arrangement   AS wheel_arr,
               CONCAT("misc.php?page=wheel_arr&id=", sc.wheel_arrangement) 
                                      AS wheel_arr_hl,
               scv.designer           AS designer,
               CONCAT("people.php?page=cme&name=",scv.designer) 
                                      AS designer_hl,
               CONCAT(
                 CASE WHEN p.surname IS NOT NULL THEN
                   concat(p.surname, " ")
                 ELSE
                   ""
                 END,
                   coalesce(scv.common_name, sc.common_name, scv.class_type)) AS class_type,
               concat("locoqry.php?action=class&type=S&id=", sc.s_class_id)   AS class_type_hl
        
        FROM   s_alloc sa2

        LEFT JOIN s_alloc sa1
        ON     sa1.loco_id = sa2.loco_id
        AND    concat(sa1.alloc_date, sa1.seq) = (SELECT MAX(concat(sa1a.alloc_date, sa1a.seq))
                                 FROM   s_alloc sa1a
                                 WHERE ((sa1a.alloc_date < sa2.alloc_date)
                                     OR (sa1a.alloc_date = sa2.alloc_date
                                        AND 
                                         sa1a.seq        < sa2.seq))
                                 AND    sa1a.loco_id = sa2.loco_id)
        LEFT JOIN s_alloc sa3
        ON     sa3.loco_id = sa2.loco_id
        AND    concat(sa3.alloc_date, sa3.seq) = (SELECT MIN(concat(sa3a.alloc_date, sa3a.seq))
                                 FROM   s_alloc sa3a
                                 WHERE ((sa3a.alloc_date > sa2.alloc_date)
                                     OR (sa3a.alloc_date = sa2.alloc_date
                                        AND
                                         sa3a.seq        > sa2.seq))
                                 AND    sa3a.loco_id = sa2.loco_id)
        LEFT JOIN ref_depot_codes dpc1
        ON     dpc1.depot_code = sa1.allocation
        AND    sa1.alloc_date BETWEEN dpc1.date_from
                                  AND IFNULL(dpc1.date_to, "2999-01-01")
        LEFT JOIN ref_depot dp1
        ON     dp1.depot_id = dpc1.depot_id
        
        JOIN   ref_depot_codes dpc2
        ON     dpc2.depot_code = sa2.allocation
        AND    sa2.alloc_date BETWEEN dpc2.date_from 
                                  AND IFNULL(dpc2.date_to, "2999-01-01")
        JOIN   ref_depot dp2
        ON     dp2.depot_id = dpc2.depot_id
        
        LEFT JOIN ref_depot_codes dpc3
        ON     dpc3.depot_code = sa3.allocation
        AND    sa3.alloc_date BETWEEN dpc3.date_from
                                  AND IFNULL(dpc3.date_to, "2999-01-01")
        LEFT JOIN ref_depot dp3
        ON     dp3.depot_id = dpc3.depot_id
        
        JOIN   s_class_link scl
        ON     scl.loco_id = sa2.loco_id
        AND    scl.start_date = (select max(scl1.start_date)
                                 from   s_class_link scl1
                                 where  scl1.loco_id = scl.loco_id
                                 and    scl1.start_date <= sa2.alloc_date)

        JOIN   s_class sc
        ON     sc.s_class_id = scl.s_class_id
        JOIN   s_class_var scv
        ON     scv.s_class_id = scl.s_class_id
        AND    scv.s_class_var_id = scl.s_class_var_id
        
        LEFT JOIN ref_people p
        ON     p.p_id = sc.designer_id
              
        UNION
        
        SELECT "Diesel"               AS long_type,
               "D"                    AS type,
               da2.loco_id            AS loco_id,
               da1.allocation         AS alloc_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS alloc_prior_hl,
               da1.alloc_date         AS alloc_date_prior,
               date_format(da1.alloc_date, "%Y%m%d") AS alloc_date_prior_fmt,
               da1.alloc_flag         AS alloc_flag_prior,
               dp1.depot_name         AS depot_name_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS depot_name_prior_hl,
               ifnull(dpc2.displayed_depot_code, dpc2.depot_code)  AS alloc_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                      AS alloc_current_hl,
               da2.alloc_date         AS alloc_date_current,
               date_format(da2.alloc_date, "%Y%m%d") AS alloc_date_current_fmt,
               da2.alloc_flag         AS alloc_flag_current,
               dp2.depot_name         AS depot_name_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                      AS depot_name_current_hl,
               dp2.depot_id           AS depot_id_current,
               da3.allocation         AS alloc_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS alloc_next_hl,
               da3.alloc_date         AS alloc_date_next,
               date_format(da3.alloc_date, "%Y%m%d") AS alloc_date_next_fmt,
               da3.alloc_flag         AS alloc_flag_next,
               dp3.depot_name         AS depot_name_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS depot_name_next_hl,
               IFNULL(dc.common_name, dc.identifier) 
                                      AS loco_type,
               concat("locoqry.php?action=class&type=D&id=", dc.d_class_id) AS loco_type_hl,
               dc.wheel_arrangement   AS wheel_arr,
               CONCAT("misc.php?page=wheel_arr&id=", dc.wheel_arrangement) 
                                      AS wheel_arr_hl,
               dcv.designer           AS designer,
               CONCAT("people.php?page=cme&name=",dcv.designer) 
                                      AS designer_hl,
               dcv.identifier         AS class_type,
               concat("locoqry.php?action=class&type=D&id=", dc.d_class_id) AS class_type_hl
                
        FROM   d_alloc da2
        LEFT JOIN d_alloc da1
        ON     da1.loco_id = da2.loco_id
        AND    concat(da1.alloc_date, da1.seq) = (SELECT MAX(concat(da1a.alloc_date, da1a.seq))
                                 FROM   d_alloc da1a
                                 WHERE ((da1a.alloc_date < da2.alloc_date)
                                     OR (da1a.alloc_date = da2.alloc_date
                                        AND 
                                         da1a.seq        < da2.seq))
                                 AND    da1a.loco_id = da2.loco_id)
        LEFT JOIN d_alloc da3
        ON     da3.loco_id = da2.loco_id
        AND    concat(da3.alloc_date, da3.seq) = (SELECT MIN(concat(da3a.alloc_date,da3a.seq))
                                 FROM   d_alloc da3a
                                 WHERE ((da3a.alloc_date > da2.alloc_date)
                                     OR (da3a.alloc_date = da2.alloc_date
                                        AND
                                         da3a.seq        > da2.seq))
                                 AND    da3a.loco_id = da2.loco_id)

        LEFT JOIN ref_depot_codes dpc1
        ON     dpc1.depot_code = da1.allocation
        AND    da1.alloc_date BETWEEN dpc1.date_from
                                  AND IFNULL(dpc1.date_to, "2999-01-01")
        LEFT JOIN ref_depot dp1
        ON     dp1.depot_id = dpc1.depot_id
        
        JOIN   ref_depot_codes dpc2
        ON     dpc2.depot_code = da2.allocation
        AND    da2.alloc_date BETWEEN dpc2.date_from 
                                  AND IFNULL(dpc2.date_to, "2999-01-01")
        JOIN   ref_depot dp2
        ON     dp2.depot_id = dpc2.depot_id
        
        LEFT JOIN ref_depot_codes dpc3
        ON     dpc3.depot_code = da3.allocation
        AND    da3.alloc_date BETWEEN dpc3.date_from
                                  AND IFNULL(dpc3.date_to, "2999-01-01")
        LEFT JOIN ref_depot dp3
        ON     dp3.depot_id = dpc3.depot_id
        
        JOIN   d_class_link dcl
        ON     dcl.loco_id = da2.loco_id
        AND    dcl.start_date = (select max(dcl1.start_date)
                                 from   d_class_link dcl1
                                 where  dcl1.loco_id = dcl.loco_id
                                 and    dcl1.start_date <= da2.alloc_date)

        JOIN   d_class dc
        ON     dc.d_class_id = dcl.d_class_id
        JOIN   d_class_var dcv
        ON     dcv.d_class_id = dcl.d_class_id
        AND    dcv.d_class_var_id = dcl.d_class_var_id
        
        UNION
        
        SELECT "Electric"             AS long_type,
               "E"                    AS type,
               ea2.loco_id            AS loco_id,
               ea1.allocation         AS alloc_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS alloc_prior_hl,
               ea1.alloc_date         AS alloc_date_prior,
               date_format(ea1.alloc_date, "%Y%m%d") AS alloc_date_prior_fmt,
               ea1.alloc_flag         AS alloc_flag_prior,
               dp1.depot_name         AS depot_name_prior,
               CONCAT("sites.php?page=depots&action=query&id=", dp1.depot_id) 
                                      AS depot_name_prior_hl,
               ifnull(dpc2.displayed_depot_code, dpc2.depot_code)  AS alloc_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                      AS alloc_current_hl,
               ea2.alloc_date         AS alloc_date_current,
               date_format(ea2.alloc_date, "%Y%m%d") AS alloc_date_current_fmt,
               ea2.alloc_flag         AS alloc_flag_current,
               dp2.depot_name         AS depot_name_current,
               CONCAT("sites.php?page=depots&action=query&id=", dp2.depot_id) 
                                      AS depot_name_current_hl,
               dp2.depot_id           AS depot_id_current,
               ea3.allocation         AS alloc_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS alloc_next_hl,
               ea3.alloc_date         AS alloc_date_next,
               date_format(ea3.alloc_date, "%Y%m%d") AS alloc_date_next_fmt,
               ea3.alloc_flag         AS alloc_flag_next,
               dp3.depot_name         AS depot_name_next,
               CONCAT("sites.php?page=depots&action=query&id=", dp3.depot_id) 
                                      AS depot_name_next_hl,
               IFNULL(ec.common_name, ec.identifier) 
                                      AS loco_type,
               concat("locoqry.php?action=class&type=E&id=", ec.e_class_id) AS loco_type_hl,
               ec.wheel_arrangement   AS wheel_arr,
               CONCAT("misc.php?page=wheel_arr&id=", ec.wheel_arrangement) 
                                      AS wheel_arr_hl,
               ecv.designer           AS designer,
               CONCAT("people.php?page=cme&name=",ecv.designer) 
                                      AS designer_hl,
               ecv.identifier         AS class_type,
               concat("locoqry.php?action=class&type=E&id=", ec.e_class_id) AS class_type_hl
        
        FROM   e_alloc ea2
        LEFT JOIN e_alloc ea1
        ON     ea1.loco_id = ea2.loco_id
        AND    concat(ea1.alloc_date, ea1.seq) = (SELECT MAX(concat(ea1a.alloc_date, ea1a.seq))
                                 FROM   e_alloc ea1a
                                 WHERE ((ea1a.alloc_date < ea2.alloc_date)
                                     OR (ea1a.alloc_date = ea2.alloc_date
                                        AND 
                                         ea1a.seq        < ea2.seq))
                                 AND    ea1a.loco_id = ea2.loco_id)
        LEFT JOIN e_alloc ea3
        ON     ea3.loco_id = ea2.loco_id
        AND    concat(ea3.alloc_date, ea3.seq) = (SELECT MIN(concat(ea3a.alloc_date,ea3a.seq))
                                 FROM   e_alloc ea3a
                                 WHERE ((ea3a.alloc_date > ea2.alloc_date)
                                     OR (ea3a.alloc_date = ea2.alloc_date
                                        AND
                                         ea3a.seq        > ea2.seq))
                                 AND    ea3a.loco_id = ea2.loco_id)

        LEFT JOIN ref_depot_codes dpc1
        ON     dpc1.depot_code = ea1.allocation
        AND    ea1.alloc_date BETWEEN dpc1.date_from
                                  AND IFNULL(dpc1.date_to, "2999-01-01")
        LEFT JOIN ref_depot dp1
        ON     dp1.depot_id = dpc1.depot_id
        
        JOIN   ref_depot_codes dpc2
        ON     dpc2.depot_code = ea2.allocation
        AND    ea2.alloc_date BETWEEN dpc2.date_from 
                                  AND IFNULL(dpc2.date_to, "2999-01-01")
        JOIN   ref_depot dp2
        ON     dp2.depot_id = dpc2.depot_id

        LEFT JOIN ref_depot_codes dpc3
        ON     dpc3.depot_code = ea3.allocation
        AND    ea3.alloc_date BETWEEN dpc3.date_from
                                  AND IFNULL(dpc3.date_to, "2999-01-01")
        LEFT JOIN ref_depot dp3
        ON     dp3.depot_id = dpc3.depot_id
        
        JOIN   e_class_link ecl
        ON     ecl.loco_id = ea2.loco_id
        AND    ecl.start_date = (select max(ecl1.start_date)
                                 from   e_class_link ecl1
                                 where  ecl1.loco_id = ecl.loco_id
                                 and    ecl1.start_date <= ea2.alloc_date)

        JOIN   e_class ec
        ON     ec.e_class_id = ecl.e_class_id
        JOIN   e_class_var ecv
        ON     ecv.e_class_id = ecl.e_class_id
        AND    ecv.e_class_var_id = ecl.e_class_var_id
        
        JOIN   e_nums en
        ON     en.loco_id = ea2.loco_id;
        
        ALTER TABLE `brdataba_live`.`tdw_dep_snap_new`
        DROP INDEX `depot_id_current`;
        
        ALTER TABLE `brdataba_live`.`tdw_dep_snap_new`
        ADD INDEX `depot_id_current` (`depot_id_current`, `alloc_date_current`, `type`, `loco_id`) USING BTREE;
        
    DROP TABLE `brdataba_live`.`tdw_dep_snap`;
    
    RENAME TABLE `brdataba_live`.`tdw_dep_snap_new` TO `brdataba_live`.`tdw_dep_snap`;
    
