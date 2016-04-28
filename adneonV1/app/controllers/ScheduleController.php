<?php

class ScheduleController extends Controller
{

    public function __construct ()
    {
        $this->beforeFilter('csrf',
                array(
                        'on' => 'post'
                ));
    }

    public function getAllslot ()
    {
        $timeslot = Timeslot::all();
        return Response::json($timeslot);
    }

    public function getAllprogram ()
    {
        $program = Program::all();
        return Response::json($program);
    }
    public function postSchedule(){
        $schedule = new Programschedulelog();
        $schedule->program_id = Input::get('program_id');
        $schedule->time_slot_id = Input::get('time_slot_id');
        $schedule->start_date = Input::get('start_date');
        $schedule->end_date = Input::get('end_date');
        $schedule->days = implode(',', Input::get('days'));
        $schedule->repeat = Input::get('repeat');
        $schedule->save();
       // return Response::json($schedule);
        return   $schedule;
    }

    public function getAlllog(){
        $program = DB::table('program_schedule_log')
                ->join('program_master', 'program_schedule_log.program_id', '=', 'program_master.id')
                ->join('timeslot_master', 'program_schedule_log.time_slot_id', '=', 'timeslot_master.id')
                ->get();

        return Response::json($program);
    }

    public function postUpdatetelecast(){
        $tc_time = Input::get('modified_tc_time');
        $result=[];
        for($i=0;$i<count($tc_time);$i++) {
                $asm_id =$tc_time[$i]['asm_id'];
                $time ='00:00:00';
                if(isset($tc_time[$i]['tc_time'])){
                  $time =$tc_time[$i]['tc_time'];
                }
                $query="UPDATE ad_schedule_master SET telecast_time='$time' where id=$asm_id";
                $result = DB::select ( DB::raw ( $query ) );
        }


       // return Response::json($schedule);
        return Response::json($result);
    }
    public function postUpdatemannualtelecasttime() {
  		$asm_id = Input::get ( 'asm_id' );
  		$telecast = Adschedule::find ( $asm_id );
  		$telecast->telecast_time = Input::get ( 'tc_time_mannual' );
      $telecast->remark = Input::get ( 'remark' );
  		//$telecast->status = 0;
  		$telecast->save ();
  		return Response::json ( $telecast );
  	}
    public function postDailyscvstcreport() {
  		$schedule_date = Input::get ( 'schedule_date' );
  		$result=[];
  		$query="SELECT t1.id asm_id,t1.deal_id,t1.ad_id,t2.start_time,t2.end_time,t2.time_slot,t1.telecast_time,t4.caption,t4.duration from ad_schedule_master t1,timeslot_master t2,deal_master t3,ad_master t4 WHERE t1.schedule_date='$schedule_date' and t1.timeslot_id =t2.id and t1.deal_id=t3.id and t3.client_id=t4.client_id and t1.ad_id=t4.id order by t1.telecast_time,t2.id,t1.ad_id";
  		$schedule = DB::select ( DB::raw ( $query ) );

  		$query="SELECT deal_id,ad_id,tc_time from telecasttime_log WHERE tc_date='$schedule_date' order by tc_time";
  		$tc = DB::select ( DB::raw ( $query ) );
  		$result['schedule']=$schedule;
  		$result['tc']=$tc;
  		return Response::json ( $result );
  	}


}
