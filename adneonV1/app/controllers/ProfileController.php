<?php

class ProfileController extends BaseController {
	public function __construct() {
		$this->beforeFilter ( 'csrf', array (
				'on' => 'post'
		) );
	}
	public function getUserprofile(){
		$user_id = Session::get('user_id');
		$profile = DB::table ( 'user_master' )->where ( 'id', $user_id )->get ();
		return Response::json ( $profile );
	}
	public function postUpdate(){
		$user_id = Input::get('id');
		$profile = User::find($user_id);
		$profile->name = Input::get('name');
		$profile->email = Input::get('email');
		$profile->mobile = Input::get('mobile');
			$profile->designation = Input::get('designation');
		$profile->save ();
		return Response::json ( $profile );
	}
	public function postChangepassword(){
		$user_id = Session::get('user_id');
		$password = Input::get('password');
		$profile = User::find($user_id);
		$profile->password = Hash::make($password);
		$profile->save();
		return $user_id;
	}
}
