<?php
class DealController extends Controller {
	public function __construct() {
		$this->beforeFilter ( 'csrf', array (
				'on' => 'post'
		) );
	}
	public function getAllclient() {
		$client = DB::table ( 'client_master' )->get ();
		return Response::json ( $client );
	}
	public function getAllexe() {
		$exe = DB::table ( 'advetisement_executive' )->get ();
		return Response::json ( $exe );
	}
	public function getAllagency() {
		$agency = DB::table ( 'agency_master' )->get ();
		return Response::json ( $agency );
	}
	public function getAllitem() {
		$item = DB::table ( 'item_master' )->get ();
		return Response::json ( $item );
	}
	public function postSavedeal() {
		$user_id = Session::get ( 'user_id' );
		$deal = new Deal ();
		//'ro_amount':ro_amount,'ro_date':ro_date,'executive_id':executive_id,'payment_peference':payment_peference,'remark':remark,},
		$deal->client_id = Input::get ( 'client_id' );
		$deal->agency_id = Input::get ( 'agency_id' );
	  $deal->ro_number = Input::get ( 'ro_number' );
		$deal->ro_date = Input::get ( 'ro_date' );
		$deal->ro_amount = Input::get ( 'ro_amount' );
		$deal->executive_id = Input::get ( 'executive_id' );
		$deal->payment_peference = Input::get ( 'payment_peference' );
		$deal->remarks = Input::get ( 'remark' );
		$deal->user_id = $user_id;
		$deal->save ();
		$id = $deal->id;
		//echo $id;
		$itemList = Input::get ( 'itemList' );
		for($count=0;$count<count($itemList);$count++){
			$dealdetails=new DealDetails();
			$dealdetails->deal_id=$id;
			$dealdetails->item_id=$itemList[$count]['property_id'];
			if(count($itemList)==0){
				$dealdetails->time_slot='NA';
			}else{
				$dealdetails->time_slot=implode(",",$itemList[$count]['time_slot']);
			}
			$dealdetails->from_date=$itemList[$count]['from_date'];
			$dealdetails->to_date=$itemList[$count]['to_date'];
			$dealdetails->units=$itemList[$count]['units'];
			$dealdetails->rate=$itemList[$count]['rate'];
			$dealdetails->amount=$itemList[$count]['amount'];
			$dealdetails->save();

		}

	//	$deal->from_date = Input::get ( 'from_date' );
		//$deal->to_date = Input::get ( 'to_date' );
		//$deal->rate = Input::get ( 'rate' );

	//	$deal->duration = Input::get ( 'duration' );
		//$deal->executive_id = Input::get ( 'executive_id' );
		//$deal->time_slot = implode(',', Input::get('time_slot'));
		//$deal->item_id = Input::get ( 'item_id' );

	//	$deal->save ();
		return Response::json ( $deal );
	}

	public function getAlldeal() {
		$alldeal = DB::table ( 'deal_master' )
				->join ( 'client_master', 'deal_master.client_id', '=', 'client_master.id' )
				->join ( 'agency_master', 'deal_master.agency_id', '=', 'agency_master.id' )
				->join ( 'advetisement_executive', 'deal_master.executive_id', '=', 'advetisement_executive.id' )
				->select('deal_master.id','client_master.name as client_name','agency_master.name as agency_name','deal_master.ro_amount','deal_master.remarks','advetisement_executive.ex_name','deal_master.ro_number','deal_master.ro_date')
				 ->orderBy('deal_master.id', 'desc')
				->get();
		return Response::json ( $alldeal );
	}



	//deal by id
	public function postDealbyid(){
		$id = Input::get('deal_id');
		$dealbyid = DB::table ( 'deal_details' )
		->join ('item_master', 'deal_details.item_id', '=', 'item_master.id')
				->where('deal_details.deal_id',$id)
				->get();
		return Response::json($dealbyid);
	}
	//update deal
	public function postUpdatedeal(){
		$id = Input::get('id');
		$user_id = Session::get ( 'user_id' );
		$update = Deal::find($id);
		$update->client_id = Input::get ( 'client_id' );
		$update->agency_id = Input::get ( 'agency_id' );
		$update->from_date = Input::get ( 'from_date' );
		$update->to_date = Input::get ( 'to_date' );
		$update->rate = Input::get ( 'rate' );
		$update->amount = Input::get ( 'amount' );
		$update->duration = Input::get ( 'duration' );
		$update->executive_id = Input::get ( 'executive_id' );
		$update->time_slot =  Input::get('time_slot');
		$update->item_id = Input::get ( 'item_id' );
		$update->ro_number = Input::get ( 'ro_number' );
		$update->ro_date = Input::get ( 'ro_date' );
		$update->remark = Input::get ( 'remark' );
		$update->user_id = $user_id;
		$update->save ();
		return Response::json ( $update );

	}
	public function getRevinuebytype(){
		$query="SELECT t2.name, sum(t1.amount) from deal_master t1,item_master t2 where t1.item_id=t2.id GROUP by t2.id";
		$result = DB::select ( DB::raw ( $query ) );
		return Response::json ( $result );
	}
	//all fct ad
	public function getAllfct() {
	    $alldeal = DB::table ( 'deal_master' )
	    ->join ( 'client_master', 'deal_master.client_id', '=', 'client_master.id' )
	    ->join ( 'agency_master', 'deal_master.agency_id', '=', 'agency_master.id' )
	    ->join ( 'item_master', 'deal_master.item_id', '=', 'item_master.id' )
	    ->join ( 'advetisement_executive', 'deal_master.executive_id', '=', 'advetisement_executive.id' )
	    ->where('item_master.type','FCT')
	    ->select('deal_master.id','client_master.name as client_name','agency_master.name as agency_name','deal_master.time_slot','deal_master.from_date','deal_master.to_date','item_master.name as item_name','deal_master.time_slot','deal_master.amount','advetisement_executive.ex_name','deal_master.duration','deal_master.client_id')
	    ->orderBy('deal_master.id', 'desc')
	    ->get();
	    return Response::json ( $alldeal );
	}

	// save executive
	public function postExecutive() {
		$exe = new Executive ();
		$exe->ex_name = Input::get ( 'ex_name' );
		$exe->location = Input::get ( 'location' );
		$exe->save ();
		return Response::json ( $exe );
	}
}
