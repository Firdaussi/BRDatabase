truncate table tdw_allocations;

insert into tdw_allocations
       (loco_id,
        type,
        allocation,
        depot_id,
        loan_allocation,
        loan_depot_id,
        hire_allocation,
        hire_depot_id,
        alloc_date,
        alloc_date_prd,
        alloc_flag,
        by_flag,
        seq,
        caveat,
        loco_usage,
        snap)
select s_alloc.loco_id         AS loco_id,
       'S',
       s_alloc.allocation      AS allocation,
       s_alloc.depot_id        AS depot_id,
       s_alloc.loan_allocation AS loan_allocation,
       s_alloc.loan_depot_id   AS loan_depot_id,
       s_alloc.hire_allocation AS hire_allocation,
       s_alloc.hire_depot_id   AS hire_depot_id,
       s_alloc.alloc_date      AS alloc_date,
       s_alloc.period          AS alloc_date_prd,
       s_alloc.alloc_flag      AS alloc_flag,
       s_alloc.by_flag         AS by_flag,
       s_alloc.seq             AS seq,
       s_alloc.caveat          AS caveat,
       s_alloc.loco_usage      AS loco_usage,
       s_alloc.snapshot        AS snap
from   s_alloc
where (ifnull(s_alloc.alloc_flag,'X') not in ('N','W'))
union 
select steam.loco_id AS loco_id,
       'S',
       steam.last_depot        AS allocation,
       steam.last_depot_id     AS depot_id,
       NULL                    AS loan_allocation,
       NULL                    AS loan_depot_id,
       NULL                    AS hire_allocation,
       NULL                    AS hire_depot_id,
       steam.w_date            AS alloc_date,
       steam.w_date_prd        AS alloc_date_prd,
       'W'                     AS alloc_flag,
       NULL                    AS by_flag,
       98                      AS seq,
       NULL                    AS caveat,
       NULL                    AS loco_usage,
       NULL                    AS snap
from steam
where steam.w_date is not NULL
union
select steam.loco_id           AS loco_id,
       'S',
       steam.first_depot       AS allocation,
       steam.last_depot_id     AS depot_id,
       NULL                    AS loan_allocation,
       NULL                    AS loan_depot_id,
       NULL                    AS hire_allocation,
       NULL                    AS hire_depot_id,
       steam.b_date            AS alloc_date,
       steam.b_date_prd        AS alloc_date_prd,
       'N'                     AS alloc_flag,
       NULL                    AS by_flag,
       0                       AS seq,
       NULL                    AS caveat,
       NULL                    AS loco_usage,
       NULL                    AS snap
from steam
where steam.b_date is not NULL;
