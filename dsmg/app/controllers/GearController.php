<?php

class GearController extends Controller
{

  public function __construct() {
    $this->beforeFilter ( 'csrf', array (
        'on' => 'post'
    ) );
  }


    public function getGearmaintenececommon(){

      $query="SELECT id, code from nfr_station_master";
      $data = DB::select(DB::raw($query));
      $result['stations']=$data;

      $result['gear_type']=GearType::all();

      $query="SELECT DISTINCT(designation) as name from nfr_supervisors order by order_id asc";
      $data = DB::select(DB::raw($query));
      $result['designation']=$data;

      $query="SELECT * from nfr_supervisors order by order_id asc";
      $data = DB::select(DB::raw($query));
      $result['supervisor']=$data;

      return Response::json($result);
    }

    public function convert_to_mysqlDateFormate($getdate){
       //to yyyy-mm-dd
     $date = DateTime::createFromFormat('d-m-Y', $getdate);
     $date = $date->format('Y-m-d');
     return $date;
   }

}
