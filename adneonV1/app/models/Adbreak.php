<?php
class Adbreak extends Eloquent{
	
	protected $table = 'adbreak_master';
	
	public static $rules = array(
			'name' => 'required',
	        'duration'=>'required',
	);
	
}