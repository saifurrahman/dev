<?php

class ScheduleController extends Controller
{

  public function __construct() {
		$this->beforeFilter ( 'csrf', array (
				'on' => 'post'
		) );
	}
//Maintainance Ledger
    public function postMaintanaceledger(){
        $maintenance_date=$this->convert_to_mysqlDateFormate(Input::get('maintenance_date'));
        $query="SELECT t1.*,t4.code as station,t5.code as gear_type,t2.gear_no,t3.code as schedule_code FROM nfr_maintenance_schedule_ledger t1,nfr_station_gear_master t2, nfr_schedule_code_master t3,nfr_station_master t4,nfr_gear_type_master t5 WHERE t1.station_gear_id=t2.id AND t1.schedule_code_id=t3.id AND t2.station_id=t4.id AND t2.gear_type_id=t5.id AND t1.maintenance_date='$maintenance_date' ORDER BY t1.updated_at desc";
        $data = DB::select(DB::raw($query));
        return Response::json($data);

    }
    // delete data
  	public function getDeletedata($id) {
  		//$id = Input::get('id');
      $data= DB::table('nfr_maintenance_schedule_ledger')->where('id', '=', $id)->delete();
      return Response::json($data);
  	}
    //Crossing and Joint point inspection

    public function getAllcrossinginspectionledger(){
      $query="SELECT t1.*,t2.code FROM nfr_jp_crossing_inspection_ledger t1, nfr_station_master t2 where t1.station_id=t2.id order by t1.created_at desc";
      $data = DB::select(DB::raw($query));
      return Response::json($data);
    }

    public function getDeletecrossinginspection($id) {
      //$id = Input::get('id');
      $data= DB::table('nfr_jp_crossing_inspection_ledger')->where('id', '=', $id)->delete();
      return Response::json(1);
    }
    public function postOverduecrossinginspection(){
      $overdue_on = Input::get("overdue_on");
      $today= date('Y-m-d');
      $overdurOn_date = date('Y-m-d', strtotime( $today. " + $overdue_on days"));
      $query ="SELECT * from nfr_jp_crossing_inspection_ledger t1,nfr_station_master t2 WHERE t1.due_date_of_inspection<='$overdurOn_date' and t1.station_id=t2.id and t1.date_of_inspection=(SELECT max(t3.date_of_inspection) from nfr_jp_crossing_inspection_ledger t3 WHERE t1.station_id=t3.station_id)";
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
        $role_id=1;
        if($role==='SS' || $role==='TSM'){
          $role_id=1;
          $next_maintenance_date = date('Y-m-d', strtotime($maintenance_date."+ $periodicity_level_1 days"));
        }
        if($role==='IC'){
          $role_id=2;
          $next_maintenance_date = date('Y-m-d', strtotime($maintenance_date."+ $periodicity_level_2 days"));
        }

        if(Input::get('station_gear_id') != null){
  			     $station_gear_ids=Input::get('station_gear_id');
        for($i = 0; $i < count($station_gear_ids); $i++)  {
          //echo $station_gear_ids[$i];
          $ledger = new MaintainanceLedger();
          $ledger->station_id = Input::get('station_id');
          $ledger->station_gear_id = $station_gear_ids[$i];
          $ledger->schedule_code_id = Input::get('schedule_code_id');
          $ledger->maintenance_date = $maintenance_date;
          $ledger->next_maintenance_date = $next_maintenance_date;
          $ledger->role = $role;
          $ledger->role_id = $role_id;
          $ledger->discontinuation_status = Input::get('discontinuation_status');
          $ledger->maintenance_by = Input::get('maintenance_by');
          $ledger->designation = Input::get('designation');
          $ledger->remarks = Input::get('remarks');
          $ledger->user_id = $user_id;
          $ledger->save();
        }
      }
        return Response::json($ledger);
    }
    public function postSavecrossingdata(){
        $user_id = Session::get("user_id");
        $inspection_date=$this->convert_to_mysqlDateFormate(Input::get('inspection_date'));
        $next_inspection_date = date('Y-m-d', strtotime($inspection_date."+ 90 days"));

        $ledger = new CrossingInspection();
        $ledger->station_id = Input::get('station_id');
        $ledger->role = Input::get('role');
        $ledger->designation = Input::get('designation');
        $ledger->maintenance_by = Input::get('maintenance_by');
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

   public function postSavecablemeggering(){
     $user_id = Session::get("user_id");
     $inspection_date=$this->convert_to_mysqlDateFormate(Input::get('inspection_date'));
     $next_inspection_date = date('Y-m-d', strtotime($inspection_date."+ 1 year"));

     $ledger = new CableMeggeringLedger();
     $ledger->stn_lc_gate_id = Input::get('station_id');
     $ledger->type = Input::get('type');
     $ledger->meggering_date = $inspection_date;
     $ledger->next_meggering_date = $next_inspection_date;
     $ledger->user_id = $user_id;
      $ledger->remarks = Input::get('remarks');
     $ledger->save();
     return Response::json($ledger);

   }
   public function getAllcablemeggeringledger(){
     $query="SELECT t1.*,t2.stn_lc_gate as code FROM `nfr_cablemeggering_stnlcgate_ledger` t1, nfr_cablemeggering_stnlcgate t2 where t1.stn_lc_gate_id=t2.id group by t2.id,t1.type order by t1.created_at desc";
     $data = DB::select(DB::raw($query));
     return Response::json($data);
   }

   public function getDeletecablemeggeringledger($id){
     //$id = Input::get('id');
     $data= DB::table('nfr_cablemeggering_stnlcgate_ledger')->where('id', '=', $id)->delete();
     return Response::json(1);
   }

}
