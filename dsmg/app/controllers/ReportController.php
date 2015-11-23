<?php

class ReportController extends Controller
{

  public function __construct() {
    $this->beforeFilter ( 'csrf', array (
        'on' => 'post'
    ) );
  }
//Overdue gear by station
    public function postOverduegearbystation(){
      $station_ids="";
      $query;
        if(Input::get('station_id') != null){
  			     $station_ids = implode(",",Input::get('station_id'));
  			     $station_in = "AND sgm.station_id IN ($station_ids)";
             $query="select t1.*,t3.code as station,t4.gear_no,t5.code as type,t6.code as schedule_code from nfr_maintenance_schedule_ledger t1,nfr_station_master t3,nfr_station_gear_master t4,nfr_gear_type_master t5,nfr_schedule_code_master t6 where t1.station_id IN ($station_ids) and t1.station_id=t3.id and t1.schedule_code_id=t6.id and t1.station_gear_id=t4.id and t4.gear_type_id=t5.id and t1.next_maintenance_date<=NOW() and t1.next_maintenance_date = (SELECT MAX(t2.next_maintenance_date) FROM nfr_maintenance_schedule_ledger t2 WHERE t2.station_gear_id = t1.station_gear_id and t2.role=t1.role) order by t1.station_gear_id";
  		  }else{
          $query="select t1.*,t3.code as station,t4.gear_no,t5.code as type,t6.code as schedule_code from nfr_maintenance_schedule_ledger t1,nfr_station_master t3,nfr_station_gear_master t4,nfr_gear_type_master t5,nfr_schedule_code_master t6 where  t1.station_id=t3.id and t1.schedule_code_id=t6.id and t1.station_gear_id=t4.id and t4.gear_type_id=t5.id and t1.next_maintenance_date<=NOW() and t1.next_maintenance_date = (SELECT MAX(t2.next_maintenance_date) FROM nfr_maintenance_schedule_ledger t2 WHERE t2.station_gear_id = t1.station_gear_id and t2.role=t1.role) order by t1.station_gear_id";
        }
        $data = DB::select(DB::raw($query));
        return Response::json($data);

    }

    public function convert_to_mysqlDateFormate($getdate){
       //to yyyy-mm-dd
     $date = DateTime::createFromFormat('d-m-Y', $getdate);
     $date = $date->format('Y-m-d');
     return $date;
   }

}
