<?php

class AdvertiseController extends Controller
{

    public function __construct ()
    {
        $this->beforeFilter('csrf', array(
                'on' => 'post'
        ));
    }

    public function getAll ()
    {
        $alladd = DB::select(
                DB::raw(
                        "SELECT ad_master.id,ad_master.duration,ad_master.caption,brand_master.brand_name,client_master.name as client_name,client_master.id as client_id,brand_master.id as brand_id,language_master.name as lang_name,language_master.id as lang_id FROM ad_master,brand_master,client_master,language_master WHERE ad_master.language_id=language_master.id and ad_master.client_id=client_master.id and ad_master.brand_id=brand_master.id ORDER BY ad_master.id desc"));
        return Response::json($alladd);
    }

    public function postSaveadd ()
    {
        $advertise = new Advertise();
        $advertise->caption = Input::get('caption');
        $advertise->language_id = Input::get('language_id');
        $advertise->client_id = Input::get('client_id');
        $advertise->brand_id = Input::get('brand_id');
        $advertise->duration = Input::get('duration');
       
        $advertise->save();
        
        return Response::json($advertise);
    }
    
    public function postUpdateadd(){
    	$id = Input::get('id');
    	$advertise = Advertise::find($id);
    	
    	$advertise->caption = Input::get('caption');
    	$advertise->language_id = Input::get('language_id');
    	$advertise->client_id = Input::get('client_id');
    	$advertise->brand_id = Input::get('brand_id');
    	$advertise->duration = Input::get('duration');
    	 
    	$advertise->save();
    	
    	return Response::json($advertise);
    	
    }
    

    public function postUpdate ()
    {
        $id = substr(Input::get('id'), 2);
        $advertise = Advertise::find($id);
        $advertise->caption = Input::get('caption');
        $advertise->language_id = Input::get('language_id');
        $advertise->client_id = Input::get('client_id');
        $advertise->duration = Input::get('duration');
        $advertise->brand_id = Input::get('brand_id');
        
        $advertise->save();
        return Response::json($advertise);
    }
    
    public function postBrandbyclient(){
    	$client_id = Input::get('client_id');
    	$brandbyclient = DB::table ( 'brand_master' )->where('brand_master.client_id',$client_id)->get ();
		return Response::json ( $brandbyclient );
    }
    

    public function postByclient ()
    {
        $client_id = Input::get('client_id');
        $advertise = DB::select(
                DB::raw(
                        "SELECT CONCAT('AT', ad_master.id) as id,ad_master.duration,ad_master.caption  FROM ad_master WHERE ad_master.client_id = $client_id"));
        return Response::json($advertise);
    }
}