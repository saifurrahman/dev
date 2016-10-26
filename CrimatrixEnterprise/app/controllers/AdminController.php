<?php

class AdminController extends BaseController {
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('auth', array('only'=>array('postProfile')));
        $this->beforeFilter('auth', array('only'=>array('postChangepassword')));
		$this->beforeFilter('auth', array('only'=>array('getHotels')));		
		$this->beforeFilter('auth', array('only'=>array('postPermission')));
		$this->beforeFilter('auth', array('only'=>array('postUpdatehotelsdetails')));
	}
	protected $layout = "layouts.admin";
	//profile
	public function getProfile(){
	    if (Auth::check())
		{
			$ps = DB::table('policestations')->lists('name','id');
			$city = DB::table('city_master')->lists('name','id');
			$this->layout->content = View::make('admin.profile',compact('ps', 'city'));
		}
		else{
			return Redirect::to('hotel/users/logout');
		}
	}
    public function postProfile(){
        $user_id = Session::get('user_id');
        $user = User::find($user_id);
		
		$user->name = Input::get('name');
		$user->contact_person = Input::get('contact_person');        
		$user->ps_id = Input::get('ps_id');
        $user->city_id = Input::get('city_id');        
        $user->state = Input::get('state');
        $user->country = Input::get('country');
        $user->status = 1;
        $user->save();
        return $user->id;
    }
    public function postChangepassword(){        
        $validator = Validator::make(Input::all(), User::$change_password_rules);
        if($validator->passes()){
            $old_password = Input::get('old_password');
            $new_password = Input::get('password');
            $user = Auth::user();
            if (Hash::check($old_password, $user->password)) {
                $user->password = Hash::make($new_password);
                $user->save();
                return 1;
            }
            else {
                return 0;
            }
        }
        else {
            return 0;
        }        
    }
    //service
	public function getHotels() {
		//$hotels = DB::table('users')->get();    
		$hotels = DB::select(DB::raw('SELECT users.*, policestations.name as ps_name FROM users INNER JOIN policestations ON users.ps_id = policestations.id'));
		$ps = DB::table('policestations')->lists('name','id');
		$city = DB::table('city_master')->lists('name','id');
		$this->layout->content = View::make('admin.index',compact('hotels','ps', 'city'));
	}	
    public function postPermission() {
		$id = Input::get('id');
		$status = Input::get('status');
		DB::table('users')->where('id', $id)->update(array('status' => $status));
    	return $status;
    }
    public function postResetpass() {
		$id = Input::get('id');
		$string = str_random(8);
		$password = Hash::make($string);
		DB::table('users')->where('id', $id)->update(array('password' => $password));		
		
		$userinfo = DB::table('users')->select('name', 'email')->where('id', $id)->get();
        $data = array("detail"=>"Your Password has been reset and the new password is: $string");

        Mail::send('emails.resetconfirm', $data, function($message) use ($userinfo){
        	$message->from('support@glomindz.com', 'Crimatrix');
            $message->to($userinfo[0]->email, $userinfo[0]->name)->cc('support@glomindz.com')->subject('Crimatrix: Password Reset Confirmation');
        }); 
        return 1;		
    }
    public function postUpdatehotelsdetails() {    	
    	$id = Input::get('id');
    	$data = array();
    	$data['name'] = Input::get('name');
    	$data['contact_person'] = Input::get('contact_person');
    	$data['ps_id'] = Input::get('ps_id');
    	$data['email'] = Input::get('email');
		$data['mobile'] = Input::get('mobile');
		$data['city_id'] = Input::get('city_id');
		$data['state'] = Input::get('state');
		$data['country'] = Input::get('country');
		$data['number_of_rooms'] = Input::get('number_of_rooms');
		$data['licence_no'] = Input::get('licence_no');
		$data['locality'] = Input::get('locality');
        $data['pin'] = Input::get('pin');
		$data['address'] = Input::get('address');
        $resp = DB::table('users')->where('id', $id)->update($data);
        if($resp != 1){
			return Response::json( array('msg' => 0));
        }
        else{
			return Response::json( array('msg' => 1));
		}

    }
	public function postReports(){
        $data = DB::select(DB::raw("SELECT * FROM (SELECT hotel_id, total_check_in, total_check_out, guestlist_date FROM hotel_records where hotel_id = 259 ORDER BY guestlist_date DESC LIMIT 0 , 30) t ORDER BY guestlist_date ASC"));
        return Response::json($data);       
    }
}

?>
