<?php
class Audience extends Eloquent{
	
	protected $table = 'audience_master';
	
	public static $rules = array(
			'name' => 'required',
	);
	
}