<?php


class MobileController extends BaseController {

	public function postOverduegearbystation(){
		$station_code=Input::get("stationCode");
		$query="select t1.*,t3.code as station,t4.gear_no,t5.code as type,t6.code as schedule_code from nfr_maintenance_schedule_ledger t1,nfr_station_master t3,nfr_station_gear_master t4,nfr_gear_type_master t5,nfr_schedule_code_master t6 where t3.code ='$station_code' and t1.station_id=t3.id and t1.schedule_code_id=t6.id and t1.station_gear_id=t4.id and t4.gear_type_id=t5.id and t1.next_maintenance_date<=NOW() and t1.next_maintenance_date = (SELECT MAX(t2.next_maintenance_date) FROM nfr_maintenance_schedule_ledger t2 WHERE t2.station_gear_id = t1.station_gear_id and t2.role_id=t1.role_id) order by t1.next_maintenance_date";
		$data = DB::select(DB::raw($query));

		$result =array();
		$result['over_due_gears']=$data;
		return Response::json($result);
	}

}
