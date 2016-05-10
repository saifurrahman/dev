	<?php
class ReportController extends Controller {
	public function __construct() {
		$this->beforeFilter ( 'csrf', array (
				'on' => 'post'
		) );
	}

	public function getDashboardreport(){
			$result=array();
			$today=date("Y-n-j");
			$query="SELECT DATE_FORMAT(t1.schedule_date,'%b-%y') as months,SUM(t2.duration)  as total_duration,SUM((t2.duration*t3.rate)/10) as total_amount from ad_schedule_master t1,ad_master t2,deal_details t3 WHERE t1.schedule_date  BETWEEN '2016-04-01' AND '$today' and t1.ad_id=t2.id and t1.status=1 and t1.deal_id=t3.deal_id and t3.item_id IN(1,6) GROUP by MONTH(t1.schedule_date)";
			$result['month_wise_fct_telecast'] = DB::select ( DB::raw ( $query ) );

			$query="SELECT DATE_FORMAT(t1.schedule_date,'%b-%y') as months,SUM(t2.duration)  as total_duration,SUM((t2.duration*t3.rate)/10) as total_amount from ad_schedule_master t1,ad_master t2,deal_details t3 WHERE t1.schedule_date  BETWEEN '2016-04-01' AND '$today' and t1.ad_id=t2.id  and t1.deal_id=t3.deal_id and t3.item_id IN(1,6) GROUP by MONTH(t1.schedule_date)";
			$result['month_wise_fct_schedule'] = DB::select ( DB::raw ( $query ) );

			$query="SELECT DATE_FORMAT(t1.schedule_date,'%b-%y') as months,SUM(t2.duration)  as total_duration,SUM((t2.duration*t3.rate)/10) as total_amount from ad_schedule_master t1,ad_master t2,deal_details t3 WHERE t1.schedule_date  BETWEEN '2016-04-01' AND '$today' and t1.ad_id=t2.id and t1.status=0 and t1.deal_id=t3.deal_id and t3.item_id IN(1,6) GROUP by MONTH(t1.schedule_date)";
			$result['month_wise_missed_schedule'] = DB::select ( DB::raw ( $query ) );

			$query="SELECT * from deal_details  WHERE item_id NOT IN(1,6) and to_date >='2016-04-01' and from_date<='2016-04-31'";
			$result['non_fct'] = DB::select ( DB::raw ( $query ) );

			return Response::json ( $result );
	}
	public function postSchedulereport() {
		$client_id = Input::get ( 'client_id' );
		$deal_id = Input::get ( 'deal_id' );
		$from_date = Input::get ( 'from_date' );
		$to_date = Input::get ( 'to_date' );

		$query = "";

		if ($deal_id == 0) {
			$query = "select asm.id, asm.ad_id,asm.schedule_date,asm.status,asm.schedule_date,asm.telecast_time, asm.remark, am.caption,am.duration,bm.name as break_name,tm.id as timeslot_id,tm.time_slot, am.client_id from ad_schedule_master asm,ad_master am,adbreak_master bm,timeslot_master tm where asm.schedule_date BETWEEN '$from_date' AND '$to_date' and am.client_id='$client_id' and asm.ad_id=am.id and asm.break_id=bm.id and asm.timeslot_id=tm.id ORDER BY asm.schedule_date, tm.id,bm.id";
		} else {
			$query = "select asm.id, asm.ad_id,asm.schedule_date,asm.status,asm.schedule_date,asm.telecast_time, asm.remark, am.caption,am.duration,bm.name as break_name,tm.id as timeslot_id,tm.time_slot, am.client_id from ad_schedule_master asm,ad_master am,adbreak_master bm,timeslot_master tm where asm.schedule_date BETWEEN '$from_date' AND '$to_date' and am.client_id='$client_id' and asm.deal_id='$deal_id' and asm.ad_id=am.id and asm.break_id=bm.id and asm.timeslot_id=tm.id ORDER BY asm.schedule_date, tm.id,bm.id";
		}
		$alladd = DB::select ( DB::raw ( $query ) );

		return Response::json ( $alladd );
	}
	public function postTelecastreport() {
		$client_id = Input::get ( 'client_id' );
		$from_date = Input::get ( 'from_date' );
		$to_date = Input::get ( 'to_date' );

		$query = "SELECT t1.id,t1.caption,t1.duration,t2.name as client_name,t3.brand_name,t0.tc_time,t0.tc_date FROM telecasttime_log t0,ad_master t1 ,client_master t2,brand_master t3 WHERE t0.schedule_status=0 and t2.id=$client_id and t0.tc_date BETWEEN '$from_date' AND '$to_date' and t0.ad_id=t1.id and t1.client_id=t2.id and t1.brand_id=t3.id order by t0.tc_date,t0.tc_time";

		$all_log = DB::select ( DB::raw ( $query ) );
		return Response::json ( $all_log	 );
}

	public function postDailyschedulereport() {
		$schedule_date = Input::get ( 'schedule_date' );
		$query="SELECT t1.ad_id,t4.duration,t8.time_slot,t6.rate,t7.ex_name,t2.name as client_name,t3.name as agency_name,t4.caption FROM ad_schedule_master t1,client_master t2,agency_master t3,ad_master t4,deal_master t5,deal_details t6,advetisement_executive t7,timeslot_master t8 WHERE t1.ad_id=t4.id and t1.deal_id=t5.id and t5.client_id=t2.id and t5.agency_id=t3.id and t1.timeslot_id=t8.time_slot and t6.deal_id=t1.deal_id and t5.executive_id=t7.id and t1.schedule_date='$schedule_date'  order by t6.rate";
		$tc_time = DB::select ( DB::raw ( $query ) );
		//return Response::json ( $tc_time );
	}
	public function postDailytelecastreport() {
		$telecast_date = Input::get ('telecast_date' );
		$result=array();
		$query="select t1.ad_id,t1.telecast_time,t1.deal_id,t2.caption,t2.duration,t1.remark,t3.rate from ad_schedule_master t1,ad_master t2,deal_details t3 WHERE t1.schedule_date='$telecast_date' and t1.ad_id=t2.id and t1.deal_id=t3.deal_id and t3.item_id IN(1,6) order by t1.telecast_time";
		$result['schedule'] = DB::select ( DB::raw ( $query ) );
		$query="select t1.*,t2.caption,t2.duration,t3.rate from telecasttime_log t1,ad_master t2,deal_details t3 WHERE t1.tc_date='$telecast_date' and t1.schedule_status =0 and t1.ad_id=t2.id and t1.deal_id=t3.deal_id and t3.item_id IN(1,6) order BY tc_time";
		$result['telecast'] = DB::select ( DB::raw ( $query ) );
		return Response::json ( $result );
	}
	public function postDealwisetelecast() {
		$deal_id = Input::get ('deal_id' );
		$from_date = Input::get ('from_date' );
		$to_date = Input::get ('to_date' );

		$result=array();
		$query="select t1.id,t1.schedule_date,t1.ad_id,t1.telecast_time,t1.deal_id,t2.caption,t2.duration,t1.remark,t3.rate from ad_schedule_master t1,ad_master t2,deal_details t3 WHERE t1.schedule_date BETWEEN '$from_date' and '$to_date' and t1.deal_id=$deal_id and t1.ad_id=t2.id and t1.deal_id=t3.deal_id and t3.item_id IN(1,6) order by t1.schedule_date,t1.telecast_time";
		$result['schedule'] = DB::select ( DB::raw ( $query ) );
  //  echo $query;
		$query="select t1.*,t2.caption,t2.duration,t3.rate from telecasttime_log t1,ad_master t2,deal_details t3 WHERE t1.tc_date BETWEEN '$from_date' and '$to_date' and t1.deal_id=$deal_id and t1.schedule_status =0 and t1.ad_id=t2.id and t1.deal_id=t3.deal_id and t3.item_id IN(1,6) order BY t1.tc_date,t1.tc_time";
  //  echo $query;
		$result['telecast'] = DB::select ( DB::raw ( $query ) );
		return Response::json ( $result );
	}
}
