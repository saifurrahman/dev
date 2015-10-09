<?php

class NFRailway extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();
    }
    function index(){
        $this->view->render('nfrailway/index');
    }
    function profile(){
    	$this->view->render('nfrailway/profile');
    }
    function gears(){
    	$this->view->render('nfrailway/gears');
    }
    function maintenance_schedules(){
    	$this->view->render('nfrailway/maintenance_schedules');
    }
    function user_msater(){
    	$this->view->render('nfrailway/settings/user_msater');
    }
    function gear_master() {
    	$this->view->render('nfrailway/settings/gear_master');
    }
    function station_master(){
    	$this->view->render('nfrailway/settings/station_master');
    }
    function reports(){
    	$this->view->render('nfrailway/reports');
    }
    function gear_history(){
    	$this->view->render('nfrailway/gear_history');
    }
}