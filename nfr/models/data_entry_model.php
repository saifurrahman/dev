<?php
class Data_Entry_Model extends Model {
	public function __construct() {
		parent::__construct ();
		header ( "Content-type: application/json" );
		header ( "X-XSS-Protection: 1; mode=block" );
	}
	function searchScheduleCodeByStation() {
		$station_id = $_POST ['station_id'];
		$gear_code = $_POST ['gear_code'];

		// get gear_no
		$sql = "SELECT * FROM " . TABLE_STATION_GEAR_MASTER . " WHERE station_id = $station_id AND gear_type_id = $gear_code";
		$sth = $this->db->prepare ( $sql );
		$sth->setFetchMode ( PDO::FETCH_ASSOC );
		$sth->execute ();
		$data = $sth->fetchAll ();
		$datanew ['gear_no'] = $data;

		// get schedule code
		$sql = "SELECT * FROM " . TABLE_SCHEDULE_CODE_MASTER . " WHERE  gear_type_id = $gear_code";
		$sth = $this->db->prepare ( $sql );
		$sth->setFetchMode ( PDO::FETCH_ASSOC );
		$sth->execute ();
		$data = $sth->fetchAll ();
		$datanew ['sch_code'] = $data;

		// show in json
		$this->closeConnection ();
		echo json_encode ( $datanew );
	}
	function getMaintanaceLedger() {
		$query = 'SELECT t1.*,t4.code as station,t5.code as gear_type,t2.gear_no,t3.code as schedule_code FROM nfr_maintenance_schedule_ledger t1,nfr_station_gear_master t2, nfr_schedule_code_master t3,nfr_station_master t4,nfr_gear_type_master t5 WHERE t1.station_gear_id=t2.id AND t1.schedule_code_id=t3.id AND t2.station_id=t4.id AND t2.gear_type_id=t5.id';
		$sth = $this->db->prepare ( $query );
		$sth->setFetchMode ( PDO::FETCH_ASSOC );
		$sth->execute ();
		$data = $sth->fetchAll ();
		$this->closeConnection ();
		echo json_encode ( $data );
	}
	// save data
	function saveData() {
		$data = array ();
		$data ['station_gear_id'] = $_POST ['station_gear_id'];
		$data ['schedule_code_id'] = $_POST ['schedule_code_id'];
		$data ['maintenance_date'] = $_POST ['maintenance_date'];
		$data ['next_maintenance_date'] = '2015-03-01'; // $_POST['maintenance_date'];
		$data ['role'] = $_POST ['role'];
		$data ['maintenance_by'] = $_POST ['maintenance_by'];
		$data ['discontinuation_status'] = $_POST ['discontinuation_status'];
		$data ['user_id'] = 1;
		$this->db->insert ( 'nfr_maintenance_schedule_ledger', $data );
		$id = $this->db->lastInsertId ();
		// $this->closeConnection();
		echo $id;
	}

	// delete data
	function deleteData() {
		$station_id = $_POST ['station_id'];
		$query = "DELETE FROM nfr_maintenance_schedule_ledger WHERE id = $station_id";
		$sth = $this->db->prepare ( $query );
		$sth->execute ();
		$row = $sth->rowCount ();
		echo json_encode ( $station_id );
	}
	function loadStationOverdueGears() {
		$query = 'SELECT t1.*,t4.code as station,t5.code as gear_type,t2.gear_no,t3.code as schedule_code FROM nfr_maintenance_schedule_ledger t1,nfr_station_gear_master t2, nfr_schedule_code_master t3,nfr_station_master t4,nfr_gear_type_master t5 WHERE t1.station_gear_id=t2.id AND t1.schedule_code_id=t3.id AND t2.station_id=t4.id AND t2.gear_type_id=t5.id';
		$sth = $this->db->prepare ( $query );
		$sth->setFetchMode ( PDO::FETCH_ASSOC );
		$sth->execute ();
		$data = $sth->fetchAll ();
		echo json_encode ( $data );
	}
	function getStationJointCrossingSchedule() {
		$query = 'select * from nfr_station_master t2 LEFT JOIN (SELECT * from nfr_jp_crossing_inspection_ledger t1 WHERE due_date_of_inspection=(SELECT due_date_of_inspection FROM nfr_jp_crossing_inspection_ledger WHERE role=t1.role ORDER BY due_date_of_inspection DESC LIMIT 0,1)) t3 ON t2.id=t3.station_id ';
		$sth = $this->db->prepare ( $query );
		$sth->setFetchMode ( PDO::FETCH_ASSOC );
		$sth->execute ();
		$data = $sth->fetchAll ();
		echo json_encode ( $data );
	}
	function getOverdueStationJointCrossing() {
		$query ="SELECT * FROM `nfr_jp_crossing_inspection_ledger` GROUP BY station_id,role";$sth = $this->db->prepare ( $query );
		$sth->setFetchMode ( PDO::FETCH_ASSOC );
		$sth->execute ();
		$data = $sth->fetchAll ();
		echo json_encode ( $data );
	}

}
