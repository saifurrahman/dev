<?php

class AppController extends BaseController
{

    protected $layout = "layouts.app";

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

    // settings
    public function getUsers ()
    {
        if (Auth::check()) {
            $this->layout->content = View::make(
                    'app.settings.users');
        } else {
            return Redirect::to('/');
        }
    }
}
