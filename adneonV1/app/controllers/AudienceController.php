<?php
class AudienceController extends Controller {
	public function __construct() {
		$this->beforeFilter ( 'csrf', array (
				'on' => 'post' 
		) );
	}
	
	public function getAll(){
		$audience = Audience::all();
		return Response::json($audience);
	}
	public function postAudience(){
		$audience = new Audience();
		$audience->name = Input::get('name');
		$audience->save();
		return Response::json($audience);
	}
}