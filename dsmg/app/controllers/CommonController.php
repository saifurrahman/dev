<?php

class CommonController extends Controller
{

  public function __construct() {
		$this->beforeFilter ( 'csrf', array (
				'on' => 'post'
		) );
	}

  public function getAllstations(){
    $query="SELECT t1.*,t2.name as district_name,t2.id as district_id from nfr_station_master t1,nfr_district_master t2 WHERE t1.district_id=t2.id";
    $data = DB::select(DB::raw($query));
    return Response::json($data);
  }

  public function getAlldistrict(){
    $gears = District::all ();
    return Response::json ( $gears );
  }
  public function getAllgearcode(){
    $gears = GearType::all ();
    return Response::json ( $gears );
  }
  public function getAllschedulecode(){
    $query="SELECT t1.*,t2.code as type_code,t2.name FROM nfr_schedule_code_master t1,nfr_gear_type_master t2 WHERE t1.gear_type_id=t2.id";
    $data = DB::select(DB::raw($query));
    return Response::json($data);
  }
  public function getAlluser(){
    $data = User::all();
    return Response::json($data);
  }

  public function postStationgear(){

    $station_id = Input::get ( 'station_id' );
    $gear_code = Input::get ( 'gear_code' );

    $data = DB::table ( 'nfr_station_gear_master' )
                ->where('station_id',$station_id)
                ->where('gear_type_id',$gear_code)
                ->get ();

	  $datanew ['gear_no'] = $data;
    $data = DB::table ( 'nfr_schedule_code_master' )
                ->where('gear_type_id',$gear_code)
                ->get ();

    $datanew ['sch_code'] = $data;
    return Response::json ( $datanew );
  }
  public function postSavestation(){
    $station = new Station();
    $station->district_id = Input::get('district_id');
    $station->name = Input::get('name');
    $station->code = Input::get('code');
    $station->save();
    return Response::json($station);
  }
  public function postChangestationstatus(){
    Input::get('district_id');
    Input::get('status');
    return Response::json(1);

  }
  public function postUpdatestation(){
    Input::get('district_id');
    Input::get('status');
    return Response::json(1);
  }
  public function postAllassigngear(){
    $station_id = Input::get('station_id');
    $query="SELECT t2.code,GROUP_CONCAT(t1.gear_no SEPARATOR ', ') as gear_no  from nfr_station_gear_master t1,nfr_gear_type_master t2 WHERE t1.gear_type_id=t2.id and t1.station_id=$station_id GROUP by t2.id order by t2.code";
    //echo $query;
    $data = DB::select(DB::raw($query));
    return Response::json($data);

  }
  public function postSavestationgear(){

    $station = new StationGear();
    $station->station_id = Input::get('station_id');
    $station->gear_type_id = Input::get('gear_type_id');
    $station->gear_no = Input::get('gear_no');
    $station->save();
    return Response::json($station);

  }
  public function getMigrate(){
  	$final_array=array();
  	$query="select * from station_gears";
  	$data = DB::select(DB::raw($query));
  	foreach ($data as $row) {
  			$gear_name=explode(',',$row->gear_name);
        //print_r($gear_name);
  			foreach ($gear_name as $gear) {
          $new_row=array();
          $new_row['station_id']=$row->station_id;
  				$new_row['gear_no']=$gear;
  				$new_row['gear_type_id']=$row->gear_type_id;
          array_push($final_array,$new_row);
  			}

  	}
    //  DB::table('nfr_station_gear_master')->insert($final_array);

    $users = DB::table('nfr_station_gear_master')->get();
  //  print_r($users);
  }
  public function getAllsupervisors(){
    $query="SELECT t1.*,GROUP_CONCAT(t3.code SEPARATOR ', ') as stations from nfr_supervisors t1 LEFT Join nfr_supervisors_stations t2 on t1.id=t2.supervisors_id LEFT JOIN nfr_station_master t3 ON t2.station_id=t3.id GROUP by t1.id";
    $data = DB::select(DB::raw($query));
    return Response::json($data);
  }
  public function getAllsupervisorsdesignation(){
    $query="SELECT * from nfr_supervisors_desig";
    $data = DB::select(DB::raw($query));
    return Response::json($data);
  }
  public function getSupervisorstations($id){

    $query="SELECT * from nfr_supervisors_stations t1,nfr_station_master t2 where supervisors_id=$id and t1.station_id=t2.id";
    $data = DB::select(DB::raw($query));
    return Response::json($data);
  }
}
