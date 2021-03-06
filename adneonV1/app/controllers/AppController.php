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
            $this->layout->content = View::make ( 'addneon.advertisement.schedule' );
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
            $this->layout->content = View::make ( 'addneon.advertisement.dailyschedule' );
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
    public function getTelecastcorrection(){
      if (Auth::check () ) {
            $this->layout->content = View::make ( 'addneon.advertisement.telecast_correction' );
      }else {
        return Redirect::to ( '/' );
      }
    }
    //eports

    public function getScvstcreport(){
      if (Auth::check ()) {
    		$this->layout->content = View::make ( 'addneon.reports.scvstc' );
    	} else {
    		return Redirect::to ( '/' );
    	}
    }
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
    public function getMonthlydeals(){
      if (Auth::check ()) {
        $this->layout->content = View::make ( 'addneon.reports.monthlydeals' );
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
    public function getPrintinvoice($bill_id){
    //  $bill_id = Input::get ( 'bill_id' );
  //  echo $bill_id;
      if (Auth::check () ) {
    		  return  View::make ( 'addneon.advertisement.print_invoice' )->with('bill_id',$bill_id);
    	}else {
    		return Redirect::to ( '/' );
    	}
    }

    public function getDealwisetelecast(){
      if (Auth::check () ) {
    		    $this->layout->content = View::make ( 'addneon.reports.dealwisetelecast' );
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
