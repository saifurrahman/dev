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
    $stations = Station::all ();
    return Response::json ( $stations );

  }
  public function getAllgearcode(){
    $gears = GearType::all ();
    return Response::json ( $gears );
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
}
