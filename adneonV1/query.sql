
SELECT t1.schedule_date,t1.deal_id,t1.ad_id,t2.caption,t2.duration,t3.brand_name from ad_schedule_master t1,ad_master t2,brand_master t3
WHERE t1.schedule_date BETWEEN '2016-01-01' and '2016-01-31'
and t1.deal_id=325
and t1.ad_id=t2.id
and t2.brand_id=t3.id


SELECT t1.schedule_date,t1.deal_id,t1.ad_id,t2.caption,SUM(t2.duration),t3.brand_name from ad_schedule_master t1,ad_master t2,brand_master t3 WHERE t1.schedule_date BETWEEN '2016-01-01' and '2016-01-31' and t1.deal_id=328 and t1.ad_id=t2.id and t2.brand_id=t3.id GROUP by t1.ad_id
