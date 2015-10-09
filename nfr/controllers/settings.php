<?php
class Settings extends Controller {
	function __construct() {
		parent::__construct ();
		Session::init ();
		Auth::handleLogin ();
	}
	// users
	function getAllUsers() {
		$this->model->getAllUsers ();
	}
	function createUser() {
		$this->model->createUser ();
	}
	function change_account_status() {
		$this->model->change_account_status ();
	}
	function delete_user() {
		$this->model->delete_user ();
	}
	function get_user_details() {
		$this->model->get_user_details ();
	}
	function update_user_details() {
		$this->model->update_user_details ();
	}
	// gear master
	function get_all_schedule_code() {
		$this->model->get_all_schedule_code ();
	}
	function create_gear() {
		$this->model->create_gear ();
	}
	function update_gear_details() {
		$this->model->update_gear_details ();
	}
	function get_gear_details() {
		$this->model->get_gear_details ();
	}
	function get_all_gear_type() {
		$this->model->get_all_gear_type ();
	}
	function save_gear_type() {
		$this->model->save_gear_type ();
	}
	function all_gear_no() {
		$this->model->all_gear_no ();
	}
	
	// stations
	function getAllStations() {
		$this->model->getAllStations ();
	}
	function createStation() {
		$this->model->createStation ();
	}
	function delete_station() {
		$this->model->delete_station ();
	}
	function get_station_details() {
		$this->model->get_station_details ();
	}
	function update_station_details() {
		$this->model->update_station_details ();
	}
	
	// role
	function get_all_role() {
		$this->model->get_all_role ();
	}
	
	
	//permission
	function setPermission(){
		$this->model->setPermission ();
	}
	
	function on(){
		$this->model->on ();
	}
	
	function off(){
		$this->model->off();
	}
}