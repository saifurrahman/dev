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
                  ->select('item_master.name as item','deal_details.*')
                  ->get();
        $bill_details['deal_details']=$deal_details;



        $query="SELECT t2.duration as ad_duration,t1.ad_id,t2.caption,t3.brand_name,SUM(t2.duration) as schedule_duration,count(t1.id) as schedule_spots from ad_schedule_master t1,ad_master t2,brand_master t3 WHERE t1.schedule_date BETWEEN '$from_date' and '$to_date' and t1.deal_id=$deal_id and t1.ad_id=t2.id and t2.brand_id=t3.id GROUP by t1.ad_id";
        $schedule_details =DB::select ( DB::raw ($query) );

        $schedule_ad_id=array();
        $telecast_details=array();

        foreach ($schedule_details as $key => $value) {
          $ad_id= $value->ad_id;
          $query="SELECT t1.ad_id,COUNT(t1.id) as telecast_spots,SUM(t2.duration) as telecast_duration from ad_schedule_master t1,ad_master t2 WHERE schedule_date BETWEEN '$from_date' and '$to_date' and telecast_time!='00:00:00' and t1.ad_id=t2.id and t1.ad_id =$ad_id and t1.deal_id=$deal_id GROUP BY ad_id";
          $telecast_details =DB::select ( DB::raw ($query) );
          if(count($telecast_details)!=0){
          $schedule_details[$key]->telecast_spots =$telecast_details[0]->telecast_spots;
          $schedule_details[$key]->telecast_duration =$telecast_details[0]->telecast_duration;
        }else{
          $schedule_details[$key]->telecast_spots =0;
          $schedule_details[$key]->telecast_duration =0;
        }

        }

        $bill_details['schedule_details']=$schedule_details;
      //  $bill_details['telecast_details']=$telecast_details;
        return Response::json($bill_details);
    }
    public function postSavebill(){

      //data : {'_token':token,'deal_id':deal_id,'bill_start_date':from_date,'bill_end_date':to_date,'agency_commission':agency_commission,'subtotal':subtotal_amount,'service_tax':service_tax_amount,'discount':0,'total_amount':bill_amount},
      $bill = new Bill();
      $bill->deal_id = Input::get('deal_id');
      $bill->bill_start_date = Input::get('bill_start_date');
      $bill->bill_end_date = Input::get('bill_end_date');
      $bill->agency_commission = Input::get('agency_commission');
      $bill->subtotal = Input::get('subtotal');
      $bill->service_tax = Input::get('service_tax');
      $bill->discount = Input::get('discount');
      $bill->total_amount = Input::get('total_amount');
      $bill->user_id =Session::get ( 'user_id' );
      $bill->save();
      return Response::json($bill);
    }
    public function getAllbill ()
    {
      $query="SELECT t1.*,t2.ro_number,t2.ro_amount,t3.name as client_name,t4.name as agency_name,t5.ex_name FROM bill_master t1,deal_master t2,client_master t3,agency_master t4,advetisement_executive t5 WHERE t1.deal_id=t2.id and t2.client_id=t3.id AND t2.agency_id=t4.id AND t2.executive_id=t5.id order by t1.id desc";
      $brands = DB::select ( DB::raw ( $query ) );
      return Response::json ( $brands );
    }


    public function getPrintinvoice($bill_id)
    {
      $result=array();
      $query="SELECT t1.*,t2.ro_number,t2.ro_amount,t3.name as client_name,t4.name as agency_name,t5.ex_name FROM bill_master t1,deal_master t2,client_master t3,agency_master t4,advetisement_executive t5 WHERE t1.id=$bill_id and t1.deal_id=t2.id and t2.client_id=t3.id AND t2.agency_id=t4.id AND t2.executive_id=t5.id order by t1.id desc";
      $result['bill_details'] = DB::select ( DB::raw ( $query ) );

      return Response::json ( $result );
    }

}
