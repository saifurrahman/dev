<?php

class BillingController extends Controller
{

    public function postSearch ()
    {
        $searchBill='';
        $from_date = Input::get('from_date');
        $to_date = Input::get('to_date');
        $agency_id = Input::get('agency_id');
        $client_id = Input::get('client_id');
        if($client_id==0){
          $searchBill = DB::table('deal_master')
                        ->where('deal_master.agency_id', $agency_id)
                       ->get();
        }elseif($agency_id==0){
          $searchBill = DB::table('deal_master')
                        ->where('deal_master.client_id', $client_id)
                        ->get();
        }else{
        $searchBill = DB::table('deal_master')
                      ->where('deal_master.agency_id', $agency_id)
                      ->where('deal_master.client_id', $client_id)
                      ->get();
        }


        return Response::json($searchBill);
    }

    public function postDealdetails(){
    	$deal_id = Input::get('deal_id');
    	$dealdetails = DB::table ( 'deal_master' )
    				->join ( 'client_master', 'deal_master.client_id', '=', 'client_master.id' )
    				->join ( 'agency_master', 'deal_master.agency_id', '=', 'agency_master.id' )
    				->join ( 'item_master', 'deal_master.item_id', '=', 'item_master.id' )
    				->join ( 'advetisement_executive', 'deal_master.executive_id', '=', 'advetisement_executive.id' )
    				->where('deal_master.id',$deal_id)
    				->select('deal_master.id','client_master.name as client_name','agency_master.name as agency_name','deal_master.from_date','deal_master.to_date','item_master.name as item_name','deal_master.time_slot','deal_master.amount','advetisement_executive.ex_name','deal_master.duration','deal_master.ro_number')
    				->get();
    	return Response::json($dealdetails);
    }
}
