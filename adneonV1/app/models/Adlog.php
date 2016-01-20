<?php

class Adlog extends Eloquent
{

    protected $table = 'ad_schedule_log';
    
    
    public static $rules = array(
    		'deal_id' => 'required',
    		'ad_id' => 'required',
    		'timeslot_id' => 'required',
            'break_id' => 'required',
    );
}