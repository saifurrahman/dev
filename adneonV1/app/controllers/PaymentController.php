<?php
class PaymentController extends \BaseController {
	public function __construct() {
		$this->beforeFilter ( 'csrf', array (
				'on' => 'post'
		) );
	}
	public function postSavepayments() {
		$user_id = Session::get ( 'user_id' );
		$validator = Validator::make ( Input::all (), Payments::$rules );
		if ($validator->passes ()) {
			$payments = new Payments ();
			$payments->agency_id = Input::get ( 'agency_id' );
			$payments->client_id = Input::get ( 'client_id' );
			$payments->bill_id = Input::get ( 'bill_id' );
			$payments->amount = Input::get ( 'amount' );
				$payments->tds = Input::get ( 'tds' );
			$payments->payment_date = Input::get ( 'payment_date' );
			$payments->payment_mode = Input::get ( 'payment_mode' );
			$payments->instrument_number = Input::get ( 'instrument_number' );
			$payments->remarks = Input::get ( 'remarks' );
			$payments->instrument_date = Input::get ( 'instrument_date' );
			$payments->user_id = $user_id;
			$payments->save ();
		} else {
			return 0;
		}
		return Response::json ( $payments );
	}
	public function getAlltransaction() {
		$query="SELECT t1.*,t2.name as client,t3.name as agency FROM payments_master t1,client_master t2,agency_master t3 where t1.client_id=t2.id and t1.agency_id=t3.id order by t1.payment_date desc";
		$transcation = DB::select ( DB::raw ( $query ) );
		return Response::json ( $transcation );
	}
	public function postDelete(){
		$id = Input::get ( 'id' );
		$delsch = Payments::find ( $id );
		$delsch->delete ();
		return 1;
	}
}
