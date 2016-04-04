<?php
class AdlogController extends Controller {
	public function __construct() {
		$this->beforeFilter ( 'csrf', array (
				'on' => 'post'
		) );
	}
	public function postSaveschedule() {
		$user_id = Session::get ( 'user_id' );
		$scheduleArray = array ();
		$scheduleArray = Input::get ( 'scheduleArray' );
		$deal_id = Input::get ( 'deal_id' );
		$ad_id = Input::get ( 'ad_id' );
		$schedule_date = Input::get ( 'schedule_date' );
		$spots = Input::get ( 'spots' );

		for($i = 0; $i < $spots; $i ++) {

			$adschedule = new Adschedule ();
			$adschedule->deal_id = $deal_id;
			$adschedule->ad_id = $ad_id;
			$adschedule->timeslot_id = $scheduleArray [$i] [0];
			$adschedule->break_id = $scheduleArray [$i] [1];
			$adschedule->user_id = $user_id;
			$adschedule->schedule_date = $schedule_date;
			$adschedule->save ();
		}
		return Response::json ( $adschedule );
	}
	public function postScheduledad() {
		$schedule_date = Input::get ( 'schedule_date' );
		$alladd = DB::select ( DB::raw ( "select asm.id, asm.ad_id,asm.schedule_date,asm.status,asm.schedule_date,asm.telecast_time, asm.remark,  am.caption,am.duration,bm.name as break_name,tm.id as timeslot_id,tm.time_slot,asm.deal_id from ad_schedule_master asm,ad_master am,adbreak_master bm,timeslot_master tm where  asm.schedule_date = '$schedule_date' and asm.ad_id=am.id and asm.break_id=bm.id and asm.timeslot_id=tm.id ORDER BY tm.id,bm.id" ) );

		return Response::json ( $alladd );
	}
	public function postDelete() {
		$id = Input::get ( 'id' );
		$delsch = Adschedule::find ( $id );
		$delsch->delete ();
		return 1;
	}
	public function postTelecast() {
		$id = Input::get ( 'asm_id' );
		$adschedule = Adschedule::find ( $id );
		$adschedule->telecast_time = Input::get ( 'tc_time' );
		$adschedule->status = 1;
		$adschedule->save ();
		return Response::json ( $adschedule );
	}
	public function postRemark() {
		$id = Input::get ( 'id' );
		$telecast = Adschedule::find ( $id );
		$telecast->remark = Input::get ( 'remark' );
		$telecast->status = 0;
		$telecast->save ();
		return Response::json ( $telecast );
	}

	public function postScheduledadvarfication() {
		$schedule_date = Input::get ( 'schedule_date' );
		$alladd = DB::select ( DB::raw ( "select asm.id, asm.ad_id,asm.schedule_date,asm.status,asm.schedule_date,asm.telecast_time, asm.remark,  am.caption,am.duration,bm.name as break_name,tm.id as timeslot_id,tm.time_slot,asm.deal_id from ad_schedule_master asm,ad_master am,adbreak_master bm,timeslot_master tm where  asm.schedule_date = '$schedule_date' and asm.ad_id=am.id and asm.break_id=bm.id and asm.timeslot_id=tm.id ORDER BY asm.ad_id,tm.id" ) );

		return Response::json ( $alladd );
	}
	public function postSavetelecasttime() {
		$tc_details = Input::get ( 'tc_details' );
		$tc_date = Input::get ( 'tc_date' );
		$data = array ();
		$affected = DB::table ( 'telecasttime_log' )->where ( 'tc_date', '=', $tc_date )->delete ();

		$total_spots=0;
		for($i = 0; $i < count ( $tc_details ); $i ++) {
		//	echo $tc_details [$i] [0];
			$tc_time = $tc_details [$i] [1];
			$ad_id = $tc_details [$i] [0];
			$deal_id = $tc_details [$i] [2];
			$telecasttimelog = new Telecasttimelog ();
			$telecasttimelog->tc_date = $tc_date;
			$telecasttimelog->ad_id = substr ( $ad_id, 2 );
			$telecasttimelog->tc_time =$tc_time;
			$telecasttimelog->deal_id=$deal_id;// $this->tctimeslot(6);
			$telecasttimelog->save ();
			$total_spots=$total_spots+1;
		}


		return Response::json ( $total_spots);
	}

	private function tctimeslot($tctime){

		if($tctime>1 && $tctime<=10){
			return 1;
		}

		if($tctime>10 && $tctime<=20){
			return 2;
		}
		if($tctime>20 && $tctime<=30){
			return 3;
		}


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
		$query = "SELECT * FROM telecasttime_log t1,ad_master t2  WHERE t1.tc_date='$schedule_date' and t1.ad_id=t2.id order by t1.tc_time";
		$tc_time = DB::select ( DB::raw ( $query ) );
		return Response::json ( $tc_time );
	}
	public function postValidatetelecasttime(){
		return Response::json ( Input::get ( 'tcdata' ) );
	}

}
