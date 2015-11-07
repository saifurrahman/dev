<?php

class CommonController extends Controller
{

    public function __construct ()
    {
        $this->beforeFilter('csrf',
                array(
                        'on' => 'post'
                ));
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
}
