<?php

class BillingController extends Controller
{

    public function postSearch ()
    {
        $searchBill='';
        $deal_id = Input::get('deal_id');
        $from_date = Input::get('from_date');
        $to_date= Input::get('to_date');


        $bill_details=[];
          $deal_master =  DB::table ( 'deal_master' )
      				->join ( 'client_master', 'deal_master.client_id', '=', 'client_master.id' )
      				->join ( 'agency_master', 'deal_master.agency_id', '=', 'agency_master.id' )
      				->join ( 'advetisement_executive', 'deal_master.executive_id', '=', 'advetisement_executive.id' )
              ->where('deal_master.id', $deal_id)
              ->select('client_master.id as client_id','client_master.name as client_name','agency_master.name as agency_name','deal_master.ro_amount','advetisement_executive.ex_name','deal_master.ro_number','deal_master.ro_date','deal_master.payment_peference')
      				->get();
              $bill_details['deal_master']=$deal_master;
              $client_id=0;
              if(count($deal_master)!=0){
                  $client_id=$deal_master[0]->client_id;
              }


        $deal_details =  DB::table ( 'deal_details' )
        	        ->join ( 'item_master', 'deal_details.item_id', '=', 'item_master.id' )
                  ->where('deal_details.deal_id', $deal_id)
                  ->select('item_master.name as item')
                  ->get();
        $bill_details['deal_details']=$deal_details;
        $query="SELECT t1.ad_id,t2.caption,t3.brand_name,SUM(t2.duration) as schedule_duration,count(t1.id) as schedule_spots from ad_schedule_master t1,ad_master t2,brand_master t3 WHERE t1.schedule_date BETWEEN '$from_date' and '$to_date' and t1.deal_id=$deal_id and t1.ad_id=t2.id and t2.brand_id=t3.id GROUP by t1.ad_id";
        $schedule_details =DB::select ( DB::raw ($query) );



        $schedule_ad_id=array();

        foreach ($schedule_details as $key => $value) {
          $schedule_ad_id[]= $value->ad_id;

        }
        $schedule_ad_id= implode(",",$schedule_ad_id);
        $query="select t1.ad_id,sum(t2.duration) as telecast_duration,count(t1.id) as telecast_spots from telecasttime_log t1,ad_master t2 where t1.tc_date  BETWEEN '$from_date' and '$to_date' and t1.ad_id IN($schedule_ad_id) and t1.ad_id=t2.id group by t1.ad_id";
        $telecast_details =DB::select ( DB::raw ($query) );

        foreach ($schedule_details as $key => $value) {
          //echo $telecast_details[$key]->telecast_duration;
        //  $schedule_details[$key]->telecast_duration = $telecast_details[$key]->telecast_duration;
        //  $schedule_details[$key]->telecast_spots =$telecast_details[$key]->telecast_spots;
        }

        $bill_details['schedule_details']=$schedule_details;
        //$bill_details['telecast_details']=$telecast_details;
        return Response::json($bill_details);
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
