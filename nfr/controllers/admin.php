<?php

class Admin extends Controller {

	function __construct() {
		parent::__construct();
		Auth::handleLogin();
	}

    function maintenance_roster(){
    	$this->view->render('admin/maintenance_roster');
    }
		function overdue_status(){
    	$this->view->render('admin/overdue_status');
    }
		function crossing_inspection(){
			$this->view->render('admin/crossing_inspection');
		}

    function data_entry(){
    	$this->view->render('admin/data_entry');
    }

    function profile(){
    	$this->view->render('admin/profile');
    }
    function reports_station_wise(){
    	$this->view->render('admin/reports/reports_station_wise');
    }
		function reports_gear_wise(){
			$this->view->render('admin/reports/reports_gear_wise');
		}
		function reports_schedule_wise(){
			$this->view->render('admin/reports/reports_schedule_wise');
		}
    //settings
    function user_msater(){
    	$this->view->render('admin/settings/user_msater');
    }
    function station_master(){
    	$this->view->render('admin/settings/station_master');
    }
    function gear_type_master() {
    	$this->view->render('admin/settings/gear_type_master');
    }
    function schedule_master() {
    	$this->view->render('admin/settings/schedule_master');
    }
    function gear_master(){
    	$this->view->render('admin/settings/gear_master');
    }


}
