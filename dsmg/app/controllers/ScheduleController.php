<?php

class ScheduleController extends Controller
{

    public function __construct ()
    {
        $this->beforeFilter('csrf',
                array(
                        'on' => 'post'
                ));
    }
//Maintainance Ledger
    public function postMaintanaceledger(){
        $maintenance_date=$this->convert_to_mysqlDateFormate(Input::get('maintenance_date'));
        $query="SELECT t1.*,t4.code as station,t5.code as gear_type,t2.gear_no,t3.code as schedule_code FROM nfr_maintenance_schedule_ledger t1,nfr_station_gear_master t2, nfr_schedule_code_master t3,nfr_station_master t4,nfr_gear_type_master t5 WHERE t1.station_gear_id=t2.id AND t1.schedule_code_id=t3.id AND t2.station_id=t4.id AND t2.gear_type_id=t5.id AND t1.maintenance_date='$maintenance_date' ORDER BY t1.updated_at desc";
        $data = DB::select(DB::raw($query));
        return Response::json($data);

    }
    // delete data
  	public function postDeletedata() {
  		$id = $_POST ['id'];
      $data= DB::table('nfr_maintenance_schedule_ledger')->where('id', '=', $id)->delete();
      return Response::json($data);
  	}
    //Crossing and Joint point inspection

    public function getAllcrossinginspectionledger(){
      $query="SELECT t1.*,t2.code FROM nfr_jp_crossing_inspection_ledger t1, nfr_station_master t2 where t1.station_id=t2.id order by t1.created_at desc";
      $data = DB::select(DB::raw($query));
      return Response::json($data);
    }

    public function postDeletecrossinginspection() {
      $id = $_POST ['id'];
      $data= DB::table('nfr_jp_crossing_inspection_ledger')->where('id', '=', $id)->delete();
      return Response::json(1);
    }
    public function getOverduecrossinginspection(){
      $query ="SELECT * FROM nfr_jp_crossing_inspection_ledger t1, nfr_station_master t2 where t1.station_id=t2.id GROUP BY t1.station_id,t1.role order by t1.station_id";
      $data = DB::select(DB::raw($query));
      return Response::json($data);
    }

    public function postSavedata(){
        $user_id = Session::get("user_id");
  		  $periodicity_level_1 = Input::get('periodicity_level_1');
  		  $periodicity_level_2 = Input::get('periodicity_level_2');
        $maintenance_date=$this->convert_to_mysqlDateFormate(Input::get('maintenance_date'));
        $role =Input::get('role');
        $next_maintenance_date;
        if($role=='SS'){
          $next_maintenance_date = date('Y-m-d', strtotime($maintenance_date."+ $periodicity_level_1 days"));
        }
        if($role=='IC'){
          $next_maintenance_date = date('Y-m-d', strtotime($maintenance_date."+ $periodicity_level_2 days"));
        }
        $ledger = new MaintainanceLedger();
        $ledger->station_gear_id = Input::get('station_gear_id');
        $ledger->schedule_code_id = Input::get('schedule_code_id');
        $ledger->maintenance_date = $maintenance_date;
        $ledger->next_maintenance_date = $next_maintenance_date;
        $ledger->role = Input::get('role');
        $ledger->discontinuation_status = Input::get('discontinuation_status');
        $ledger->maintenance_by = Input::get('maintenance_by');

        $ledger->user_id = $user_id;
        $ledger->save();
        return Response::json($ledger);
    }
    public function postSavecrossingdata(){
        $user_id = Session::get("user_id");
        $inspection_date=$this->convert_to_mysqlDateFormate(Input::get('inspection_date'));
        $next_inspection_date = date('Y-m-d', strtotime($inspection_date."+ 30 days"));

        $ledger = new CrossingInspection();
        $ledger->station_id = Input::get('station_id');
        $ledger->role = Input::get('role');
        $ledger->date_of_inspection = $inspection_date;
        $ledger->due_date_of_inspection = $next_inspection_date;
        $ledger->user_id = $user_id;
        $ledger->save();
        return Response::json($ledger);
    }
    public function convert_to_mysqlDateFormate($getdate){
       //to yyyy-mm-dd
     $date = DateTime::createFromFormat('d-m-Y', $getdate);
     $date = $date->format('Y-m-d');
     return $date;
   }

}
