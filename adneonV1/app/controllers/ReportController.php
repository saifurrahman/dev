	<?php
class ReportController extends Controller {
	public function __construct() {
		$this->beforeFilter ( 'csrf', array (
				'on' => 'post'
		) );
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

		$query = "SELECT t1.id,t1.caption,t1.duration,t2.name as client_name,t3.brand_name,t0.tc_time,t0.tc_date FROM telecasttime_log t0,ad_master t1 ,client_master t2,brand_master t3 WHERE t2.id=$client_id and t0.tc_date BETWEEN '$from_date' AND '$to_date' and t0.ad_id=t1.id and t1.client_id=t2.id and t1.brand_id=t3.id order by t0.tc_date,t0.tc_time";

		$all_log = DB::select ( DB::raw ( $query ) );
		return Response::json ( $all_log	 );
}
	public function postTelecasttime() {
		$ad_id = substr ( Input::get ( 'ad_id' ), 2 );
		$tc_date = Input::get ( 'tc_date' );
		$query = "Select tc_time from telecasttime_log where tc_date='$tc_date' and ad_id='$ad_id'";
		$tc_time = DB::select ( DB::raw ( $query ) );
		return Response::json ( $tc_time );
	}
	public function postTcbydate() {
		$schedule_date = substr ( Input::get ( 'schedule_date' ), 2 );
		$query = "Select * from telecasttime_log where tc_date='$schedule_date'ORDER BY ad_id,tc_time";
		$tc_time = DB::select ( DB::raw ( $query ) );
		return Response::json ( $tc_time );
	}
	public function postDailyschedulereport() {
		$schedule_date = Input::get ( 'schedule_date' );
		$query="SELECT t1.ad_id,t4.duration,t8.time_slot,t6.rate,t7.ex_name,t2.name as client_name,t3.name as agency_name,t4.caption FROM ad_schedule_master t1,client_master t2,agency_master t3,ad_master t4,deal_master t5,deal_details t6,advetisement_executive t7,timeslot_master t8 WHERE t1.ad_id=t4.id and t1.deal_id=t5.id and t5.client_id=t2.id and t5.agency_id=t3.id and t1.timeslot_id=t8.time_slot and t6.deal_id=t1.deal_id and t5.executive_id=t7.id and t1.schedule_date='$schedule_date'  order by t6.rate";
		$tc_time = DB::select ( DB::raw ( $query ) );
		return Response::json ( $tc_time );
	}
	public function postScvstcreport() {
		$schedule_date = Input::get ( 'from_date' );
		$to_date = Input::get ( 'to_date' );
		$result=[];
		$query="SELECT t1.id,t1.deal_id,t1.ad_id,t2.start_time,t2.end_time,t2.time_slot,t1.telecast_time from ad_schedule_master t1,timeslot_master t2 WHERE t1.schedule_date='2016-04-03' and t1.timeslot_id =t2.id order by t2.id,t1.ad_id";
		$schedule = DB::select ( DB::raw ( $query ) );

		$query="SELECT deal_id,ad_id,tc_time from telecasttime_log WHERE tc_date='2016-04-03' order by tc_time";
		$tc = DB::select ( DB::raw ( $query ) );
		$result['schedule']=$schedule;
		$result['tc']=$tc;
		return Response::json ( $result );
	}
}
