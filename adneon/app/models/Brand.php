<?php
class Brand extends Eloquent{

	protected $table = 'brand_master';

	public static $rules = array(
			'client_id' => 'required',
			'brand_name'=>'required',
	);

}