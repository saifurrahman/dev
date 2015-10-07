<?php
class Language extends Eloquent{
	
	protected $table = 'language_master';
	
	public static $rules = array(
			'name' => 'required',
	);
	
}