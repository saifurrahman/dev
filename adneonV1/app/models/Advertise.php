<?php

class Advertise extends Eloquent
{

    protected $table = 'ad_master';
    
    
    public static $rules = array(
//     		'category_id' => 'required',
//     		'duration' => 'required',
//     		'caption' => 'required',
    		'client_id' => 'required',
    );
}