<?php

class ReportController extends Controller
{

    public function __construct ()
    {
        $this->beforeFilter('csrf',
                array(
                        'on' => 'post'
                ));
    }
//Overdue gear by station
    public function postOverduegearbystation(){
      $station_ids="";
      if(Input::get('station_id') != null){
			     $station_ids = implode(",",Input::get('station_id'));
			     $station_in = "AND sgm.station_id IN ($station_ids)";
		  }

        $query="SELECT * FROM `nfr_maintenance_schedule_ledger` where station_gear_id IN ($station_ids) GROUP by schedule_code_id,role";
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
