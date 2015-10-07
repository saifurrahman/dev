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
          $searchBill = DB::table('deal_master')->join('client_master',
                        'deal_master.client_id', '=', 'client_master.id')
                        ->join('agency_master', 'deal_master.agency_id', '=',
                        'agency_master.id')
                        ->join('item_master', 'deal_master.item_id', '=',
                        'item_master.id')

                       ->where('deal_master.from_date','<=', $from_date)
                        ->where('deal_master.to_date','>=', $to_date)
                        ->where('deal_master.agency_id', $agency_id)
                        ->select('deal_master.id','deal_master.duration','item_master.name','deal_master.amount','deal_master.from_date','deal_master.to_date')
                        ->get();
        }else{
        $searchBill = DB::table('deal_master')->join('client_master',
                      'deal_master.client_id', '=', 'client_master.id')
                      ->join('agency_master', 'deal_master.agency_id', '=',
                      'agency_master.id')
                      ->join('item_master', 'deal_master.item_id', '=',
                      'item_master.id')
                    //  ->where('deal_master.from_date','<=', $from_date)
                      ->where('deal_master.to_date','>=', $to_date)
                      ->where('deal_master.agency_id', $agency_id)
                      ->where('deal_master.client_id', $client_id)
                      ->select('deal_master.id','deal_master.duration','item_master.name','deal_master.amount','deal_master.from_date','deal_master.to_date')
                      ->get();
        }
        foreach ($searchBill as $key) {
          $type = $key->name;
          $deal_id=$key->id;
            if($type=='Visual Advertisement'){
              $query = "SELECT count(t1.id) as slots,SUM(t2.duration) as total_duration FROM 	ad_schedule_master t1,ad_master t2 where t1.ad_id=t2.id and t1.deal_id=$deal_id";
              $tc_details = DB::select ( DB::raw ( $query ) );
              $key->slots=$tc_details[0]->slots;
              $key->total_duration=$tc_details[0]->total_duration;
            }else{
                   $datediff = strtotime($to_date) - strtotime($from_date);
                   $key->total_duration= floor($datediff/(60*60*24));
                   $key->slots='Minimum 20';

            }

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
