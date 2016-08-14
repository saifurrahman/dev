<?php
class Bill extends Eloquent{

	protected $table = 'bill_master';

	public static $rules = array(
			'deal_id' => 'required',
			'invoice_no' => 'required',
	);

}
