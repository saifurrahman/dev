
SELECT t1.schedule_date,t1.deal_id,t1.ad_id,t2.caption,t2.duration,t3.brand_name from ad_schedule_master t1,ad_master t2,brand_master t3
WHERE t1.schedule_date BETWEEN '2016-01-01' and '2016-01-31'
and t1.deal_id=325
and t1.ad_id=t2.id
and t2.brand_id=t3.id


SELECT t1.schedule_date,t1.deal_id,t1.ad_id,t2.caption,SUM(t2.duration),t3.brand_name from ad_schedule_master t1,ad_master t2,brand_master t3 WHERE t1.schedule_date BETWEEN '2016-01-01' and '2016-01-31' and t1.deal_id=328 and t1.ad_id=t2.id and t2.brand_id=t3.id GROUP by t1.ad_id



UPDATE telecasttime_log
INNER JOIN ad_schedule_master ON telecasttime_log.ad_id = ad_schedule_master.ad_id
SET telecasttime_log.deal_id = ad_schedule_master.deal_id
WHERE telecasttime_log.tc_date = '2016-04-03' and ad_schedule_master.schedule_date = '2016-04-03'


SELECT ad_id,count(*) FROM `ad_schedule_master` WHERE schedule_date='2016-04-03' group by ad_id 
