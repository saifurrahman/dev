<?php
class ClientController extends Controller {
	public function __construct() {
		$this->beforeFilter ( 'csrf', array (
				'on' => 'post' 
		) );
	}
	// client
	public function getAll() {
		$client = Client::all ();
		return Response::json ( $client );
	}
	public function postSaveclient() {
		$client = new Client ();
		$client->name = Input::get ( 'name' );
		$client->email = Input::get ( 'email' );
		$client->mobile = Input::get ( 'mobile' );
		$client->city = Input::get ( 'city' );
		$client->address = Input::get ( 'address' );
		$client->save ();
		return Response::json ( $client );
	}
	public function postUpdateclient() {
		$id = Input::get ( 'id' );
		$client = Client::find ( $id );
		$client->name = Input::get ( 'name' );
		$client->email = Input::get ( 'email' );
		$client->mobile = Input::get ( 'mobile' );
		$client->city = Input::get ( 'city' );
		$client->address = Input::get ( 'address' );
		$client->save ();
		return Response::json ( $client );
	}
	
	// agency
	public function getAllagency() {
		$agency = Agency::all ();
		return Response::json ( $agency );
	}
	public function postSaveagency() {
		$agency = new Agency ();
		$agency->name = Input::get ( 'name' );
		$agency->email = Input::get ( 'email' );
		$agency->mobile = Input::get ( 'mobile' );
		$agency->city = Input::get ( 'city' );
		$agency->address = Input::get ( 'address' );
		$agency->commission = Input::get ( 'commission' );
		$agency->save ();
		return Response::json ( $agency );
	}
	public function postUpdateagency() {
		$id = Input::get ( 'id' );
		$agency = Agency::find ( $id );
		$agency->name = Input::get ( 'name' );
		$agency->email = Input::get ( 'email' );
		$agency->mobile = Input::get ( 'mobile' );
		$agency->city = Input::get ( 'city' );
		$agency->address = Input::get ( 'address' );
		$agency->commission = Input::get ( 'commission' );
		$agency->save ();
		return Response::json ( $agency );
	}
}
