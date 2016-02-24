<?php

class AppController extends BaseController
{

    protected $layout = "layouts.app";

    // program manager
    public function getIndex ()
    {
        if (Auth::check()) {
            $this->layout->content = View::make('addneon.programs.index');
        } else {
            return Redirect::to('/');
        }
    }

    public function getProgramschedule ()
    {
        if (Auth::check()) {
            $this->layout->content = View::make(
                    'addneon.programs.program_schedule');
        } else {
            return Redirect::to('/');
        }
    }
    //user
    public function getProfile() {
    	if (Auth::check ()) {
    		$this->layout->content = View::make ('addneon.users.profile');
    	} else {
    		return Redirect::to ( '/' );
    	}
    }

    //advertisement
    public function getClients() {
        if (Auth::check ()) {
            $this->layout->content = View::make ( 'addneon.advertisement.clients' );
        } else {
            return Redirect::to ( '/' );
        }
    }
    public function getAgency() {
        if (Auth::check ()) {
            $this->layout->content = View::make ( 'addneon.advertisement.agency' );
        } else {
            return Redirect::to ( '/' );
        }
    }
    public function getDeals() {
        if (Auth::check ()) {
            $this->layout->content = View::make ( 'addneon.advertisement.new_deal' );
        } else {
            return Redirect::to ( '/' );
        }
    }
    public function getAdvertise(){
    	if (Auth::check ()) {
    		$this->layout->content = View::make ( 'addneon.advertisement.ro' );
    	} else {
    		return Redirect::to ( '/' );
    	}
    }
    public function getAdschedule(){
        if (Auth::check ()) {
            $this->layout->content = View::make ( 'addneon.advertisement.adschedule' );
        } else {
            return Redirect::to ( '/' );
        }
    }
    public function getBrand(){
    	if (Auth::check ()) {
    		$this->layout->content = View::make ( 'addneon.advertisement.brand' );
    	} else {
    		return Redirect::to ( '/' );
    	}
    }
    public function getVarification(){
        if (Auth::check ()) {
            $this->layout->content = View::make ( 'addneon.advertisement.varification' );
        } else {
            return Redirect::to ( '/' );
        }
    }
    //payments

    public function getBilling(){
        if (Auth::check ()) {
            $this->layout->content = View::make ( 'addneon.advertisement.billing' );
        } else {
            return Redirect::to ( '/' );
        }
    }

    public function getPayments(){
    	if (Auth::check ()) {
    		$this->layout->content = View::make ( 'addneon.advertisement.payments' );
    	} else {
    		return Redirect::to ( '/' );
    	}
    }

    //eports
    public function getSchedulereport(){
    	if (Auth::check ()) {
    		$this->layout->content = View::make ( 'addneon.reports.schedule' );
    	} else {
    		return Redirect::to ( '/' );
    	}
    }
    public function getTelecastreport(){
    	if (Auth::check ()) {
    		$this->layout->content = View::make ( 'addneon.reports.telecast' );
    	} else {
    		return Redirect::to ( '/' );
    	}
    }

    public function getDashboard(){
      $role = Auth::user ()->role;
    	if (Auth::check () && $role=='admin') {
    		$this->layout->content = View::make ( 'addneon.reports.dashboard' );
    	} elseif (Auth::check () ) {
    		    $this->layout->content = View::make ( 'addneon.advertisement.agency' );
    	}else {
    		return Redirect::to ( '/' );
    	}
    }
    public function getDailyreport(){
      if (Auth::check () ) {
    		    $this->layout->content = View::make ( 'addneon.reports.daily' );
    	}else {
    		return Redirect::to ( '/' );
    	}
    }
    // settings
    public function getUsers ()
    {
        if (Auth::check()) {
            $this->layout->content = View::make(
                    'addneon.settings.users');
        } else {
            return Redirect::to('/');
        }
    }
}
