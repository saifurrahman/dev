<?php
 
class UsersController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));	
        $this->beforeFilter('auth', array('only'=>array('postProfile')));
        $this->beforeFilter('auth', array('only'=>array('postChangepassword')));
	}
    public function sendMail(){
        Mail::send('folder.view', $data, function($message) {
            $message->to('kamaldev.bhuyan@gmail. com', 'Jon Doe')->subject('Welcome to the Laravel 4 Auth App!');
        });
    }
    public function postSignin() {
        $usernameinput = Input::get('username');
        $field = filter_var($usernameinput, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        if (Auth::attempt(array($field => $usernameinput, 'password'=>Input::get('password')))) {
            Session::put('user_id', Auth::user()->id);
            Session::put('name', Auth::user()->name);
            Session::put('email', Auth::user()->email);
            Session::put('mobile', Auth::user()->mobile);
			Session::put('currentdate', date("Y-m-d"));
            if(Auth::user()->role == 'admin'){
                return Redirect::to('/hotel/admin/hotels');   
            }
            else{
                if(Auth::user()->status == 0){
                    return Redirect::to('/hotel/profile')->with('posts', Auth::user());
                }
                else{
                    return Redirect::to('/hotel/guestlist');                    
                }
            }            
        }
        else{
            return Redirect::to('/hotel?login=fail')->with('error', 'Email or Password is Incorrect');
        }
    }
	public function postSignup() {
        $string = str_random(8);
        $validator = Validator::make(Input::all(), User::$rules);
        if ($validator->passes()) {
            $user = new User;
            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->mobile = Input::get('mobile');
            $user->password = Hash::make($string);
            $user->save();            
            $userinfo = array('email' => $user->email, 'name' => $user->name); 
            $data = array(
                'detail'=>'Your are logged in to Crimatrix',
                'name'  => $user->name,
                'email'  => $user->email,
                'mobile' => $user->mobile,
                'password' => $string
            );            
            Mail::send('emails.welcome', $data, function($message) use ($userinfo){
                $message->from('support@glomindz.com', 'Crimatrix');
                $message->to($userinfo['email'], $userinfo['name'])->cc('support@glomindz.com')->subject('Welcome to Crimatrix!');
            });                 
            return Response::json( array('msg' => 1));
        }
        else{
            return Response::json( array('msg' => 0));
        }
    }
    public function postForgetpass() {
        $input['email'] = Input::get('email');
        $rules = array('email' => 'unique:users,email');
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $user = DB::table('users')->select('id','name')->where('email',$input['email'])->get();
            $tokenstring = $this->getToken();
            $today = date('Y-m-d H:i:s', time());
            $expiry_datetime = date('Y-m-d H:i:s', strtotime($today."+ 1 days"));
            DB::table('reset_password')->insertGetId(
                array('user_id' => $user[0]->id, 'token' => $tokenstring, 'expiry_datetime'=> $expiry_datetime)
            );
            $userinfo = array('email' => $input['email'], 'name'=>$user[0]->name);
            $data = array(
                'detail'=>'Please visit the following link to recovery password for your account',
                'link' => 'http://enterprise.crimatrix.com/hotel/reset/'.$tokenstring
            );
            Mail::send('emails.resetpasswordlink', $data, function($message) use ($userinfo){
                $message->from('support@glomindz.com', 'Crimatrix');
                $message->to($userinfo['email'], $userinfo['name'])->cc('support@glomindz.com')->subject('Crimatrix: Password Reset Link');
            });  
            return 1;
        }
        else {
            return 0;
        }    
    }
    public function getToken(){
        $length=48;
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
        return $key;
    }
    //after login activity
    public function postProfile(){
        $user_id = Session::get('user_id');
        $user = User::find($user_id);
        $user->name = Input::get('name');
        $user->address = Input::get('address');
        $user->city_id = Input::get('city_id');
        $user->contact_person = Input::get('contact_person');
        $user->country = Input::get('country');
        $user->licence_no = Input::get('licence_no');
        $user->locality = Input::get('locality');
        $user->number_of_rooms = Input::get('number_of_rooms');
        $user->pin = Input::get('pin');
        $user->ps_id = Input::get('ps_id');
        $user->state = Input::get('state');
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
    public function postResetpassword(){
        $id = Input::get('id');
        $user_id = Input::get('user_id');
        $password = Input::get('password');
        $confirmPassword = Input::get('confirmPassword');
        $validator = Validator::make(Input::all(), User::$reset_password_rules);
        if($validator->passes()){            
            $password = Hash::make(Input::get('password'));
            $resp = DB::table('users')->where('id', $user_id)->update(array('password' => $password));            
            $changedstatus = DB::table('reset_password')->where('id', $id)->update(array('status' => 1));            
            
            $userinfo = DB::table('users')->select('name', 'email')->where('id', $user_id)->get();
            $data = array('detail'=>'Your Password has been reset successfully');

            Mail::send('emails.resetconfirm', $data, function($message) use ($userinfo){
                $message->from('support@glomindz.com', 'Crimatrix');
                $message->to($userinfo[0]->email, $userinfo[0]->name)->cc('support@glomindz.com')->subject('Crimatrix: Password Reset Confirmation');
            }); 
            return Redirect::to('/');
        }
        else{
            return "Password has to be same as Confirmed Password and Password has to be alphanumeric characters and of minimum 6 characters.";
        }        
    }
    public function getLogout() {
        Auth::logout();
        return Redirect::to('/');
    }
}
?>