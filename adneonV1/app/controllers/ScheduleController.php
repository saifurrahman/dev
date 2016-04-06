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

}
