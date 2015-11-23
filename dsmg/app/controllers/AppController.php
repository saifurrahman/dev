<?php

class AppController extends BaseController
{

    protected $layout = "layouts.app";
    public function __construct() {
      $this->beforeFilter ( 'csrf', array (
          'on' => 'post'
      ) );
    }
    // program manager
    public function getScheduleentry ()
    {
        if (Auth::check()) {
            $this->layout->content = View::make('app.schedule_entry');
        } else {
            return Redirect::to('/');
        }
    }
    public function getCrossing ()
    {
        if (Auth::check()) {
            $this->layout->content = View::make('app.joint');
        } else {
            return Redirect::to('/');
        }
    }

    //user
    public function getProfile() {
    	if (Auth::check ()) {
    		$this->layout->content = View::make ('app.settings.profile');
    	} else {
    		return Redirect::to ( '/' );
    	}
    }


    //Reports
    public function getOverduereport ()
    {
        if (Auth::check()) {
            $this->layout->content = View::make('app.overdue_report');
        } else {
            return Redirect::to('/');
        }
    }
    public function getStaionwisereport ()
    {
        if (Auth::check()) {
            $this->layout->content = View::make('app.station_report');
        } else {
            return Redirect::to('/');
        }
    }
    public function getGearwisereport ()
    {
        if (Auth::check()) {
            $this->layout->content = View::make('app.gear_wise_report');
        } else {
            return Redirect::to('/');
        }
    }
    //Masters
    public function getStationmaster ()
    {
        if (Auth::check()) {
            $this->layout->content = View::make('app.master.station_master');
        } else {
            return Redirect::to('/');
        }
    }
    public function getSchedulecode ()
    {
        if (Auth::check()) {
            $this->layout->content = View::make('app.master.schedule_code_master');
        } else {
            return Redirect::to('/');
        }
    }
    public function getGeartype ()
    {
        if (Auth::check()) {
            $this->layout->content = View::make('app.master.gear_type_master');
        } else {
            return Redirect::to('/');
        }
    }
    public function getStationgear ()
    {
        if (Auth::check()) {
            $this->layout->content = View::make('app.master.station_gear_master');
        } else {
            return Redirect::to('/');
        }
    }
    public function getUsers ()
    {
        if (Auth::check()) {
            $this->layout->content = View::make('app.master.user_master');
        } else {
            return Redirect::to('/');
        }
    }
}
