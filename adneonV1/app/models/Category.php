<?php
class Category extends Eloquent{
	
	protected $table = 'category_master';
	
	public static $rules = array(
			'name' => 'required',
	);
	
}