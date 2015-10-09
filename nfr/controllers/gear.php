<?php
class Gear extends Controller {

	function __construct() {
		parent::__construct();
		Session::init();
		Auth::handleLogin();
	}
	
	function assign_gear(){
		$this->model->assign_gear();
	}	
	function get_all_assign_gear(){
		$this->model->get_all_assign_gear();
	}
	function get_assign_gear_by_id(){
		$this->model->get_assign_gear_by_id();
	}

	//maintenance schedules
	function get_maintenance_schedules(){
		$this->model->get_maintenance_schedules();
	}
	function save_maintenance(){
		$this->model->save_maintenance();
	}
	function get_maintenance_reports(){	
		$this->model->get_maintenance_reports();
	}
	function search_maintenance_schedules(){	
		$this->model->search_maintenance_schedules();
	}	
	function get_schedule_code(){
		$this->model->get_schedule_code();
	}	
	function schedule_maintenance(){
		$this->model->schedule_maintenance();
	}
	function set_failure(){
		$this->model->set_failure();
	}
	function update_gear(){
		$this->model->update_gear();
	}
	/*
	function change_status(){
		$this->model->change_status();
	}
	function delete_assign_gear(){
		$this->model->delete_assign_gear();
	}
	function get_gear_configure_details(){
		$this->model->get_gear_configure_details();
	}
	function update_gear_configure_details(){
		$this->model->update_gear_configure_details();
	}

	function get_maintenance_schedules(){
		$this->model->get_maintenance_schedules();
	}
	function confirm_maintenance(){
		$this->model->confirm_maintenance();
	}
	*/
}