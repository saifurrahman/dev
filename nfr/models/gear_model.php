<?php
class Gear_Model extends Model {
	public function __construct() {
		parent::__construct();
		header("Content-type: application/json");
		header("X-XSS-Protection: 1; mode=block");
	}
	function assign_gear(){
		$data = array();
		$data['station_id'] = $_POST['station_id'];
		$data['gear_type_id'] = $_POST['gear_type_id'];
		$data['gear_no'] = strtoupper($_POST['gear_no']);
		$this->db->insert(TABLE_STATION_GEAR_MASTER, $data);
		$id = $this->db->lastInsertId();
		echo $id;
	}
	function get_all_assign_gear(){
		$station_id = $_POST['station_id'];
		$query = "SELECT t1.*,t2.code as stn_code,t3.code as gear_code FROM nfr_station_master t2,nfr_gear_type_master t3 ,nfr_station_gear_master t1  WHERE t1.station_id=t2.id AND t1.gear_type_id=t3.id and t1.station_id=$station_id";		
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data=$sth->fetchAll();
		$this->closeConnection();
		echo json_encode($data);
	}

	function get_assign_gear_by_id(){
		$id = $_POST['id'];
		$query ="SELECT sgm.id, sgm.station_id, sm.code as station_code, sgm.gear_type_id, gtm.code as gear_type_code, sgm.gear_no
		FROM ".TABLE_STATION_GEAR_MASTER." sgm, ".TABLE_STATION_MASTER." sm, ".TABLE_GEAR_TYPE_MASTER." gtm
		WHERE sgm.station_id = sm.id AND sgm.gear_type_id = gtm.id AND sgm.id = $id";
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data=$sth->fetchAll();
		$this->closeConnection();
		echo json_encode($data);
	}

	function get_all_schedule_maintenance($station_gear_id){
		$query ="SELECT msl.id, msl.schedule_code_id, scm.code as schedule_code,  msl.role_id,rm.name as role_name, msl.maintenance_date, msl.status,DATE_FORMAT(msl.maintenance_date,'%d-%m-%Y') preety_maintenance_date
		FROM nfr_maintenance_schedule_ledger msl, nfr_schedule_code_master scm, nfr_role_master rm
		WHERE msl.schedule_code_id = scm.id AND msl.role_id = rm.id AND station_gear_id = $station_gear_id AND status = 'pending' ORDER BY `scm`.`code` ASC";
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data=$sth->fetchAll();
		return $data;
	}

	function get_schedule_code(){
		$result = array();
		$gear_type_id = $_POST['gear_type_id'];
		$query ="SELECT * FROM nfr_schedule_code_master WHERE gear_type_id = $gear_type_id";
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();
		$result['schedule_codes'] = $data;
		$schedule_maintenance = $this->get_all_schedule_maintenance($_POST['station_gear_id']);
		$result['schedule_maintenance'] = $schedule_maintenance;
		$this->closeConnection();
		echo json_encode($result);
	}
	function schedule_maintenance(){
		Session::init();
		$user_id = Session::get("user_id");
		$periodicity_level_1 = $_POST['periodicity_level_1'];
		$periodicity_level_2 = $_POST['periodicity_level_2'];
		$next_maintenance_date = $this->convert_to_mysqlDateFormate($_POST['next_maintenance_date']);
		$next_maintenance_date_l1 = date('Y-m-d', strtotime($next_maintenance_date."+ $periodicity_level_1 days"));
		$next_maintenance_date_l2 = date('Y-m-d', strtotime($next_maintenance_date."+ $periodicity_level_2 days"));

		$count = $this->check_schedule_maintenance($_POST['station_gear_id'],$_POST['schedule_code_id'],$_POST['role_id']);
		if($_POST['role_id'] == 1){
			if($count == 0){
				$data = array();
				$data['station_gear_id'] = $_POST['station_gear_id'];
				$data['schedule_code_id'] = $_POST['schedule_code_id'];
				$data['maintenance_date'] = $next_maintenance_date_l1;
				$data['role_id'] = $_POST['role_id'];
				$data['user_id'] = $user_id;
				$data['status'] = "pending";
				$this->db->insert('nfr_maintenance_schedule_ledger', $data);
				$id = $this->db->lastInsertId();
				$arr = array('id'=> $id,  'next_maintenance_date' =>$next_maintenance_date_l1, 'status' => 'insert');
				echo json_encode($arr);
			}
			else{
				$data = array();
				$data['station_gear_id'] = $_POST['station_gear_id'];
				$data['schedule_code_id'] = $_POST['schedule_code_id'];
				$data['maintenance_date'] = $next_maintenance_date_l1;
				$data['role_id'] = $_POST['role_id'];
				$data['user_id'] = $user_id;
				$data['status'] = "pending";
				$this->db->update('nfr_maintenance_schedule_ledger', $data, "id = $count");
				$arr = array('id'=> $count,  'next_maintenance_date' =>$next_maintenance_date_l1, 'status' => 'update');
				echo json_encode($arr);
			}
		}
		if($_POST['role_id'] == 2){
			if($count == 0){
				$data = array();
				$data['station_gear_id'] = $_POST['station_gear_id'];
				$data['schedule_code_id'] = $_POST['schedule_code_id'];
				$data['maintenance_date'] = $next_maintenance_date_l2;
				$data['role_id'] = $_POST['role_id'];
				$data['user_id'] = $user_id;
				$data['status'] = "pending";
				$this->db->insert('nfr_maintenance_schedule_ledger', $data);
				$id = $this->db->lastInsertId();
				$arr = array('id'=> $id,'next_maintenance_date' =>$next_maintenance_date_l2, 'status' => 'insert');
				echo json_encode($arr);
			}
			else{
				$data = array();
				$data['station_gear_id'] = $_POST['station_gear_id'];
				$data['schedule_code_id'] = $_POST['schedule_code_id'];
				$data['maintenance_date'] = $next_maintenance_date_l2;
				$data['role_id'] = $_POST['role_id'];
				$data['user_id'] = $user_id;
				$data['status'] = "pending";
				$this->db->update('nfr_maintenance_schedule_ledger', $data, "id = $count");
				$arr = array('id'=> $count,'next_maintenance_date' =>$next_maintenance_date_l2, 'status' => 'update');
				echo json_encode($arr);
			}
		}
	}
	function check_schedule_maintenance($station_gear_id, $schedule_code_id, $role_id){
		$query = "SELECT id FROM nfr_maintenance_schedule_ledger WHERE station_gear_id = $station_gear_id AND schedule_code_id = $schedule_code_id AND role_id = $role_id AND status = 'pending'";
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();
		$count = $sth->rowCount();
		if ($count == 0) {
			return $count;
		} else {
			return $data[0]['id'];
		}
	}
	function get_maintenance_schedules(){
		Session::init();
		$role_id = Session::get("role_id");
		if($role_id != 3){
			$filter_by_role = "AND msl.role_id = $role_id";
		}
		else{
			$filter_by_role = '';
		}
		$result = array();
		$today = date('Y-m-d', time());
		$next_30_days = date('Y-m-d', strtotime($today."+ 30 days"));

		$query = "SELECT msl.id, msl.station_gear_id, msl.maintenance_date, msl.role_id, msl.maintenance_by, msl.status, msl.progress,
		scm.id as schedule_code_id,scm.code as schedule_code, sgm.gear_no, rm.name as role_name, sm.code as station_code, scm.periodicity_level_1, scm.periodicity_level_2,
		gtm.code as gear_code, DATE_FORMAT(msl.maintenance_date,'%d %b %Y') preety_maintenance_date
		FROM nfr_maintenance_schedule_ledger msl, nfr_role_master rm, nfr_station_gear_master sgm,nfr_station_master sm, nfr_gear_type_master gtm, nfr_schedule_code_master scm
		WHERE msl.role_id = rm.id AND msl.station_gear_id = sgm.id AND sgm.station_id = sm.id AND sgm.gear_type_id= gtm.id
		AND msl.schedule_code_id= scm.id AND msl.status = 'pending' AND msl.maintenance_date BETWEEN '$today' AND '$next_30_days'  $filter_by_role ORDER BY scm.code ASC";

		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data=$sth->fetchAll();
		$result['next_30_days'] = $data;

		$query = "SELECT msl.id, msl.station_gear_id, msl.maintenance_date, msl.role_id, msl.maintenance_by, msl.status, msl.progress,
		scm.id as schedule_code_id,scm.code as schedule_code, sgm.gear_no, rm.name as role_name, sm.code as station_code, scm.periodicity_level_1, scm.periodicity_level_2,
		gtm.code as gear_code, DATE_FORMAT(msl.maintenance_date,'%d %b %Y') preety_maintenance_date
		FROM nfr_maintenance_schedule_ledger msl, nfr_role_master rm, nfr_station_gear_master sgm,nfr_station_master sm, nfr_gear_type_master gtm, nfr_schedule_code_master scm
		WHERE msl.role_id = rm.id AND msl.station_gear_id = sgm.id AND sgm.station_id = sm.id AND sgm.gear_type_id= gtm.id
		AND msl.schedule_code_id= scm.id AND msl.status = 'pending' AND msl.maintenance_date < '$today' $filter_by_role ORDER BY scm.code ASC";
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data=$sth->fetchAll();
		$result['overdue'] = $data;

		echo json_encode($result);
	}
	function save_maintenance(){
		Session::init();
		$user_id = Session::get("user_id");
		$id = $_POST['maintenance_schedule_id'];
		$status = $_POST['status'];
		$periodicity_level_1 = $_POST['periodicity_level_1'];
		$periodicity_level_2 = $_POST['periodicity_level_2'];
		if($status == 'done'){
			$data = array();
			$data['maintenance_by'] = $_POST['maintenance_by'];
			$data['actual_maintenance_date'] = $this->convert_to_mysqlDateFormate($_POST['maintenance_date']);
			$data['progress'] = 100;
			$data['status'] = 'done';
			$data['remarks'] = $_POST['remarks'];
			$data['user_id'] = $user_id;
			$this->db->update('nfr_maintenance_schedule_ledger', $data, "id = $id");
			//insert new maintenance_schedule
			$arr = array();
			$arr['station_gear_id'] = $_POST['station_gear_id'];
			$arr['schedule_code_id'] = $_POST['schedule_code_id'];
			if($_POST['role_id'] == 1){
				$arr['maintenance_date'] = date('Y-m-d', strtotime($data['maintenance_date']."+ $periodicity_level_1 days"));
			}
			else{
				$arr['maintenance_date'] = date('Y-m-d', strtotime($data['maintenance_date']."+ $periodicity_level_2 days"));
			}
			$arr['role_id'] = $_POST['role_id'];
			$arr['user_id'] = $user_id;
			$arr['status'] = "pending";
			$id = $this->db->insert('nfr_maintenance_schedule_ledger', $arr);
			echo 1;
		}
	}

	function get_maintenance_reports(){
		$query = "SELECT msl.id, msl.station_gear_id, msl.maintenance_date, msl.role_id, msl.maintenance_by, msl.status, msl.progress, um.name as maintenance_by_name,
		scm.id as schedule_code_id,scm.code as schedule_code, sgm.gear_no, rm.name as role_name, sm.code as station_code, scm.periodicity_level_1, scm.periodicity_level_2,
		gtm.code as gear_code, DATE_FORMAT(msl.maintenance_date,'%d %b %Y') preety_maintenance_date, DATE_FORMAT(msl.actual_maintenance_date,'%d %b %Y') preety_actual_maintenance_date
		FROM nfr_maintenance_schedule_ledger msl, nfr_role_master rm, nfr_station_gear_master sgm,nfr_station_master sm, nfr_gear_type_master gtm, nfr_schedule_code_master scm, nfr_user_master um
		WHERE msl.role_id = rm.id AND msl.station_gear_id = sgm.id AND sgm.station_id = sm.id AND sgm.gear_type_id= gtm.id
		AND msl.schedule_code_id= scm.id AND msl.maintenance_by = um.id AND msl.status = 'done' ORDER BY msl.maintenance_date ASC";
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data=$sth->fetchAll();
		echo json_encode($data);
	}
	function search_maintenance_schedules(){
		if($_POST['station_ids'] != null){
			$station_ids = implode(",",$_POST['station_ids']);
			$station_in = "AND sgm.station_id IN ($station_ids)";
		}
		else{$station_in = "";}

		$role_id = $_POST['role_id'];
		if($role_id != 0){$filter_by_role = "AND msl.role_id = $role_id";}
		else{$filter_by_role = '';}

		if($_POST['search_date'] != null){
			$search_date = $this->convert_to_mysqlDateFormate($_POST['search_date']);
			$search_term = "AND msl.maintenance_date = '$search_date'";
		}
		else{$search_term = "";}

		$result = array();
		$today = date('Y-m-d', time());
		$next_30_days = date('Y-m-d', strtotime($today."+ 30 days"));

		$query = "SELECT msl.id, msl.station_gear_id, msl.maintenance_date, msl.role_id, msl.maintenance_by, msl.status, msl.progress,
		scm.id as schedule_code_id,scm.code as schedule_code, sgm.gear_no, rm.name as role_name, sm.code as station_code, scm.periodicity_level_1, scm.periodicity_level_2,
		gtm.code as gear_code, DATE_FORMAT(msl.maintenance_date,'%d %b %Y') preety_maintenance_date
		FROM nfr_maintenance_schedule_ledger msl, nfr_role_master rm, nfr_station_gear_master sgm,nfr_station_master sm, nfr_gear_type_master gtm, nfr_schedule_code_master scm
		WHERE msl.role_id = rm.id AND msl.station_gear_id = sgm.id AND sgm.station_id = sm.id AND sgm.gear_type_id= gtm.id
		AND msl.schedule_code_id= scm.id AND msl.status = 'pending' $station_in $filter_by_role $search_term ORDER BY scm.code ASC";
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data=$sth->fetchAll();
		$result['next_30_days'] = $data;
		echo json_encode($result);
	}
	function set_failure(){
		$data = array();
		$data['station_gear_id'] = $_POST['station_gear_id'];
		$data['failure_date'] = $this->convert_to_mysqlDateFormate($_POST['failure_date']);
		$data['failure_type'] = $_POST['failure_type'];
		$this->db->insert('gear_history', $data);
		$id = $this->db->lastInsertId();
		echo $id;
	}
	function update_gear(){
		$id = $_POST['id'];
		$data = array();
		$data['gear_no'] = $_POST['gear_no'];
		$this->db->update('nfr_station_gear_master', $data, "id = $id");
		echo $id;
	}
}
