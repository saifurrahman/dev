<?php
class Telecasttimelog extends Eloquent {
	protected $table = 'telecasttime_log';
	public static $rules = array (
			'tc_date' => 'required',
			'tc_time' => 'required' 
	)
	;
}