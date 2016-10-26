<?php

class HomeController extends BaseController {

	public function __construct() {
		$this->beforeFilter('auth', array('only'=>array('getGuestlist')));
		$this->beforeFilter('auth', array('only'=>array('getProfile')));
		$this->beforeFilter('auth', array('only'=>array('updateProfile')));
	}

	protected $layout = "layouts.home";

	public function homePage()
	{
		if (Auth::check())
		{
			if(Auth::user()->role == 'admin'){
                return Redirect::to('/hotel/admin/hotels');
            }
		    return Redirect::to('hotel/guestlist');
		}
		else{
			$this->layout->content = View::make('home.index');
		}
	}
	public function aboutPage()
	{
		$this->layout->content = View::make('home.about');
	}
	public function contactPage()
	{
		$this->layout->content = View::make('home.contact');
	}	
	//after login
	public function getGuestlist() {
		if (Auth::check())
		{
			if(Auth::user()->status != 0){
				$this->layout->content = View::make('home.guestlist');
			}
			else{
				return Redirect::to('/hotel/profile');
			}
		}
		else{
			return Redirect::to('hotel');
		}	   
	}
	public function getProfile(){
	    if (Auth::check())
		{
			$ps = DB::table('policestations')->lists('name','id');
			$city = DB::table('city_master')->lists('name','id');
			$this->layout->content = View::make('home.profile',compact('ps', 'city'));
		}
		else{
			return Redirect::to('hotel');
		}
	}
	public function getReports(){
		if (Auth::check())
		{
			$this->layout->content = View::make('home.reports');
		}
		else{
			return Redirect::to('hotel');
		}
	}
	public function updateProfile(){
		$data = Input::all();
	}
	public function getReset($token){
        $reset = DB::table('reset_password')->where('token',$token)->get();
        $resetsize = sizeof($reset);
        if($resetsize != 0){
            if($reset[0]->status != 1){
                $today = date('Y-m-d H:i:s', time());
                if($reset[0]->expiry_datetime > $today){
                    $this->layout->content = View::make('home.reset', compact('reset'));
                }
                else{
                   return "Time Expired";
                }
            }
            else{
                return "Token Expired";
            }   
        }
        else{
            return Redirect::to('/');
        }        
    }
}
