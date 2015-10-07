<?php
class Programschedulelog extends Eloquent
{

    protected $table = 'program_schedule_log';

    public static $rules = array(
            'program_id' => 'required',
            'start_datetime' => 'required',
            'end_datetime' => 'required',
            'days' => 'required',
            'repeat_type' => 'required',
    );
}