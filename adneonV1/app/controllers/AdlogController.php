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


	public function postScheduledadvarfication() {
		$schedule_date = Input::get ( 'schedule_date' );
		$alladd = DB::select ( DB::raw ( "select asm.id, asm.ad_id,asm.schedule_date,asm.status,asm.schedule_date,asm.telecast_time, asm.remark,  am.caption,am.duration,bm.name as break_name,tm.id as timeslot_id,tm.time_slot,asm.deal_id from ad_schedule_master asm,ad_master am,adbreak_master bm,timeslot_master tm where  asm.schedule_date = '$schedule_date' and asm.ad_id=am.id and asm.break_id=bm.id and asm.timeslot_id=tm.id ORDER BY asm.ad_id,tm.id" ) );

		return Response::json ( $alladd );
	}
	public function postSavetelecasttime() {
		$tc_details = json_decode(Input::get ('tc_details' ));
		$tc_date = Input::get ('tc_date');
		$data = array ();
		$affected = DB::table ('telecasttime_log')->where ( 'tc_date', '=', $tc_date )->delete ();
		$total_spots=0;
		$schedule_update_id=array();
		for($i = 0; $i < count ( $tc_details ); $i ++) {
			$ad_id = $tc_details [$i] [0];
			$tc_time = $tc_details [$i] [1];
			$deal_id = $tc_details [$i] [2];
			$telecasttimelog = array();
			$telecasttimelog['tc_date'] = $tc_date;
			$telecasttimelog['ad_id'] = substr ( $ad_id, 2 );
			$telecasttimelog['tc_time'] =$tc_time;
			$telecasttimelog['deal_id']=$deal_id;// $this->tctimeslot(6);
			$total_spots=$total_spots+1;
			array_push($data,$telecasttimelog);
		}
		$products;
		$rowsPerChunk = 100;
		$productChunks = array_chunk($data, $rowsPerChunk);
		foreach($productChunks as $chunk) {
		    DB::table('telecasttime_log')->insert($chunk);
		}

		$schedule_array = DB::table ('ad_schedule_master')->where ( 'schedule_date', '=', $tc_date )->get();

		$telecast_array=array();
		$tc_time='00:00:00';

		$schedule_update=array();

		foreach ($schedule_array as $row) {
				$ad_id = $row->ad_id;
				$deal_id = $row->deal_id;
				$asm_id=$row->id;

				for ($index=0; $index < count($data);$index++) {
				//	print_r($data[$index]['ad_id']);
					$tc_ad_id=$data[$index]['ad_id'];
					$tc_deal_id=$data[$index]['deal_id'];
					if($ad_id==$tc_ad_id && $deal_id==$tc_deal_id){
							$tc_time=$data[$index]['tc_time'];
							$update_row=array();
							$update_row['asm_id']=$asm_id;
							$update_row['tc_time']=$tc_time;
							array_push($schedule_update,$update_row);
							unset($data[$index]);
							$data=array_values($data);
							break;
					}
				}
		}
			foreach ($schedule_update as $row) {
				$asm_id =$row['asm_id'];
				$tc_time =$row['tc_time'];
				$adschedule = Adschedule::find ( $asm_id );
				$adschedule->telecast_time = $tc_time;
				$adschedule->status = 1;
				$adschedule->save ();
			}
			foreach ($data as $row) {
				$tc_date =$row['tc_date'];
				$tc_time =$row['tc_time'];
				$ad_id =$row['ad_id'];
				$deal_id =$row['deal_id'];
				$query = "UPDATE  telecasttime_log SET schedule_status = 0 WHERE tc_time ='$tc_time' and tc_date='$tc_date' and ad_id='$ad_id' and deal_id='$deal_id';";
				DB::select ( DB::raw ( $query ) );
			}
			return Response::json ($schedule_update);
	}

	function postTelecasttime() {
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
