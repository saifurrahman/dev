<?php
class Settings_Model extends Model {

	public function __construct() {
		parent::__construct();
		header("Content-type: application/json");
		header("X-XSS-Protection: 1; mode=block");
	}
	function get_all_stations(){
		$sql = "SELECT * FROM ".TABLE_STATION_MASTER;
		$sth = $this->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();
		$this->closeConnection();
		echo json_encode($data);
	}
	function get_all_role(){
		$sql = "SELECT * FROM ".TABLE_ROLE_MASTER." WHERE name != 'ADMINISTRATOR'";
		$sth = $this->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();
		$this->closeConnection();
		echo json_encode($data);
	}
	
	function all_gear_no(){
		$sql = "SELECT * FROM ".TABLE_STATION_GEAR_MASTER."" ;
		$sth = $this->db->prepare($sql);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();
		$this->closeConnection();
		echo json_encode($data);
	}
	
	
	//user
	function getAllUsers(){
		$query =  "SELECT um.id, um.name, um.email, um.mobile, um.designation, um.user_type, um.role_id, um.status, um.created, rm.name as role
        FROM ".TABLE_USER_MASTER." um, ".TABLE_ROLE_MASTER." rm WHERE um.role_id = rm.id";
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data=$sth->fetchAll();
		$this->closeConnection();
		echo json_encode($data);
	}
	
	function createUser(){
		//$password = $this->generate_password();
		$password = 'demo';
		$data = array();
        $data['name'] = $_POST['name'];
        $data['mobile'] = $_POST['mobile'];
		$data['email'] = $_POST['email'];
		$data['password'] = Hash::create('md5', $password, HASH_PASSWORD_KEY);
		$data['designation'] = $_POST['designation'];
		$data['role_id'] = $_POST['role_id'];
		$data['user_type'] = 'user';
		$data['status'] = 0;
		

		$count_email = $this->check_email(TABLE_USER_MASTER, $data['email']);
		$count_mobile = $this->check_mobile(TABLE_USER_MASTER, $data['mobile']);
		if($count_email == 0 && $count_mobile == 0){
			$this->db->insert(TABLE_USER_MASTER, $data);
        	$id = $this->db->lastInsertId();
        	$data['id'] = $id;
        	$this->closeConnection();
        	echo json_encode($data);
		}
        else {
        	echo 0;
        }
	}	
	function change_account_status(){
		$user_id = $_POST['user_id'];
		$updateData = array(
			'status' => $_POST['status']
		);
		$this->db->update('nfr_user_master', $updateData, "id = $user_id");
		echo json_encode($updateData);
		$this->closeConnection();
	}
	function update_user_details(){
		$user_id = $_POST['id'];
		$data = array();
		$data['name'] = $_POST['name'];
		$data['email'] = $_POST['email'];
		$data['mobile'] = $_POST['mobile'];
		$data['designation'] = $_POST['designation'];
		$data['role_id'] = $_POST['role_id'];
		
		$count_email = $this->check_email(TABLE_USER_MASTER, $data['email']);
		$count_mobile = $this->check_mobile(TABLE_USER_MASTER, $data['mobile']);		
		if (($count_email == 0 || $count_email == $user_id) && ($count_mobile == 0 || $count_mobile == $user_id)) {
			$this->db->update(TABLE_USER_MASTER, $data, "id = $user_id");
			$this->closeConnection();
			echo 1;
		}
		else {
			echo 0;
		}		
	}
	function delete_user() {
		$user_id = $_POST['user_id'];
		$query = "DELETE FROM " . TABLE_USER_MASTER . " WHERE id = $user_id";
		$sth = $this->db->prepare($query);
		$sth->execute();
		$this->closeConnection();
		echo $user_id;
	}
	function get_user_details() {
		$table_um = "nfr_user_master";
		$table_sm = "nfr_station_master";
		$user_id = $_POST['user_id'];
		$user_type = $_POST['user_type'];
		$query = "";
		if ($user_type == 'nfrailway') {
			$query = "SELECT um.id,um.name, um.email,um.mobile,um.designation, um.station_id,um.status, um.role, um.user_type, UCASE(sm.id) AS st_id, UCASE(sm.name) AS station_name  FROM $table_um um, $table_sm sm  WHERE sm.id = um.station_id AND um.id = $user_id";
		}
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();
		echo json_encode($data);
	}
	
	//gear master
	function get_all_schedule_code(){
		$query = "SELECT scm.*, gtm.code as type_code FROM ".TABLE_SCHEDULE_CODE_MASTER." scm, ".TABLE_GEAR_TYPE_MASTER." gtm WHERE scm.gear_type_id = gtm.id ORDER BY scm.gear_type_id ASC";
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data=$sth->fetchAll();
		$this->closeConnection();
		echo json_encode($data);
	}
	function create_gear(){
		$data = array();
		$data['code'] = strtoupper($_POST['code']);
		$data['gear_type_id'] = $_POST['gear_type_id'];
		$data['periodicity_level_1'] = $_POST['periodicity_level_1'];
		$data['periodicity_level_2'] = $_POST['periodicity_level_2'];
		$data['remarks'] = $_POST['remarks'];			
		$count = $this->check_gear($data['code'],$data['gear_type_id']);
		if($count == 0){
			$this->db->insert(TABLE_SCHEDULE_CODE_MASTER, $data);
			$data['id'] = $this->db->lastInsertId();
			$this->closeConnection();
			echo json_encode($data);
		}
		else {echo 0;}
	}
	function update_gear_details() {
		$gear_id = $_POST['id'];
		$data = array();
		$data['code'] = strtoupper($_POST['code']);
		$data['gear_type_id'] = $_POST['gear_type_id'];
		$data['periodicity_level_1'] = $_POST['periodicity_level_1'];
		$data['periodicity_level_2'] = $_POST['periodicity_level_2'];
		$data['remarks'] = $_POST['remarks'];		
		$count = $this->check_gear($data['code'],$data['gear_type_id']);
		if($count == 0 || $count == $gear_id){
			$this->db->update(TABLE_SCHEDULE_CODE_MASTER, $data,"id = $gear_id");
			$data['id'] = $this->db->lastInsertId();
			$this->closeConnection();
			echo json_encode($data);
		}
		else {echo 0;}
	}
	function check_gear($code, $gear_type_id) {
		//check for gear code
		$query = "SELECT id FROM ".TABLE_SCHEDULE_CODE_MASTER." WHERE code='$code' AND gear_type_id = $gear_type_id";
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();
		$count = $sth->rowCount();
		if ($count == 0) {return $count;} else {return $data[0]['id'];}
	}	
	/***/
	function get_gear_details(){
		$gear_id = $_POST['gear_id'];
		$query = "SELECT * FROM ".TABLE_GEAR_MASTER." WHERE id = $gear_id";
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data=$sth->fetchAll();
		$this->closeConnection();
		echo json_encode($data);
	}
	function get_all_gear_type(){
		$query = "SELECT * FROM ".TABLE_GEAR_TYPE_MASTER;
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data=$sth->fetchAll();
		echo json_encode($data);
	}
	function save_gear_type(){
		$data = array();
		$data['code'] = $_POST['code'];
		$data['name'] = $_POST['name'];
		$this->db->insert(TABLE_GEAR_TYPE_MASTER, $data);
		$data['id'] = $this->db->lastInsertId();
		echo json_encode($data);
	}
	/***/
	
	//stations
	function getAllStations(){
		$query = "SELECT sm.id, sm.name, sm.code, sm.district_id, dm.name as district_name 
				FROM ".TABLE_STATION_MASTER." sm, ".TABLE_DISTRICT_MASTER." dm WHERE sm.district_id = dm.id";
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data=$sth->fetchAll();
		echo json_encode($data);
	}
	function createStation(){
		$data = array();
		$data['name'] = $_POST['name'];
		$data['district_id'] = $_POST['district_id'];
		$data['code'] = strtoupper($_POST['code']);
		$this->db->insert('nfr_station_master', $data);
		$data['id'] = $this->db->lastInsertId();
		echo json_encode($data);
	}
	function get_station_details(){
		$station_id = $_POST['station_id'];
		$query = "SELECT * FROM nfr_station_master WHERE id = $station_id";
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data=$sth->fetchAll();
		header("Content-type: application/json");
		echo json_encode($data);
	}
	function delete_station(){
		$station_id = $_POST['station_id'];
		$query = "DELETE FROM " . TABLE_STATION_MASTER . " WHERE id = $station_id";
		$sth = $this->db->prepare($query);
		$sth->execute();
		$row = $sth->rowCount();
		echo $row;
	}
	function update_station_details() {
		$station_id = $_POST['station_id'];
		$data = array();
		$data['name'] = $_POST['name'];
		$data['district_id'] = $_POST['district_id'];
		$data['code'] = $_POST['code'];
		$this->db->update(TABLE_STATION_MASTER, $data, "id = $station_id");
		echo 1;
	}
	
	//helper functions
	function check_email($table, $email) {
		//check for email
		$query = "SELECT id FROM $table where email = '$email'";
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();
		$count_email = $sth->rowCount();
		if ($count_email == 0) {
			return $count_email;
		} else {
			return $data[0]['id'];
		}
	}
	
	function check_mobile($table, $mobile) {
		//check for mobile
		$query = "SELECT id FROM $table where mobile = '$mobile'";
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data = $sth->fetchAll();
		$count_mobile = $sth->rowCount();
		if ($count_email == 0) {
			return $count_mobile;
		} else {
			return $data[0]['id'];
		}
	}
	
	
	
	//permission
	
	function setPermission(){
		$user_id = $_POST['user_id'];
		$query = "SELECT pt.name,up.permission_id,up.user_id,pt.id, IF(up.permission_id IS NULL,false,true) permission
    					FROM nfr_permission_type pt LEFT OUTER JOIN user_permission up ON pt.id = up.permission_id AND up.user_id = $user_id";
		
		$sth = $this->db->prepare($query);
		$sth->setFetchMode(PDO::FETCH_ASSOC);
		$sth->execute();
		$data=$sth->fetchAll();
		echo json_encode($data);
		
	}
	
	function on(){
		$data = array();
		$data['user_id'] = $_POST['user_id'];
		$data['permission_id'] = $_POST['permission_id'];
		$this->db->insert('user_permission', $data);
		$data['id'] = $this->db->lastInsertId();
		echo json_encode($data);
	}
	
	function off(){
		$user_id = $_POST ['user_id'];
		$permission_id = $_POST ['permission_id'];
		$query = "DELETE FROM user_permission WHERE user_id = $user_id AND permission_id = $permission_id";
		$sth = $this->db->prepare ( $query );
		$sth->execute ();
		$row = $sth->rowCount ();
		echo json_encode ( $user_id );
	}
}