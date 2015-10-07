<?php
class Payments extends Eloquent {
	protected $table = 'payments_master';
	public static $rules = array (
			'amount' => 'required',
			'payment_date' => 'required'
	);
}
