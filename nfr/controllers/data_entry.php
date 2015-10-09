<?php
class Data_Entry extends Controller {

	function __construct() {
		parent::__construct();
		Session::init();
		Auth::handleLogin();
	}

	function searchScheduleCodeByStation(){
		$this->model->searchScheduleCodeByStation();
	}
	function saveData(){
		$this->model->saveData();
	}
	function getMaintanaceLedger(){
		$this->model->getMaintanaceLedger();
	}
	function deleteData(){
		$this->model->deleteData();
	}

	function loadStationOverdueGears(){
$this->model->loadStationOverdueGears();
}
function getStationJointCrossingSchedule(){
$this->model->getStationJointCrossingSchedule();
}
}
