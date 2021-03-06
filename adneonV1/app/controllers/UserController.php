<?php
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class UserController extends BaseController {
	public function postLogin() {
		$userinput = Input::get ( 'username' );
		$field = filter_var ( $userinput, FILTER_VALIDATE_EMAIL ) ? 'email' : 'mobile';

		if (Auth::attempt ( array (
				$field => $userinput,
				'password' => Input::get ( 'password' ),
				'status' => 1
		) )) {
			 $permissions = $this->get_permissions(Auth::user()->id);
			Session::put ( 'user_id', Auth::user ()->id );
			Session::put ( 'name', Auth::user ()->name );
			Session::put ( 'email', Auth::user ()->email );
			Session::put ( 'mobile', Auth::user ()->mobile );
			Session::put ( 'role', Auth::user ()->role );
			Session::put ( 'status', Auth::user ()->status );
			foreach ($permissions as $row) {
			 Session::put($row->name, $row->permission);
			}
			if(Auth::user ()->role=='admin'){
				return Redirect::to ( 'addneon/dashboard' );
		}else{
			return Redirect::to ( 'addneon/clients' );
		}
			// var_dump(Session::all());
		} else {
			return Redirect::to ( '/' );
		}
	}

	public function get_permissions ($user_id)
	{
		$permissions = DB::select(
				DB::raw(
						"SELECT pt.name, IF(up.permission_id IS NULL,false,true) as permission
						FROM permission_type pt LEFT OUTER JOIN user_permission up ON pt.id = up.permission_id AND up.user_id = $user_id"));

		return $permissions;
	}


	public function anyLogout() {
		Auth::logout ();
		Session::flush ();
		return Redirect::to ( '/' );
	}
}
