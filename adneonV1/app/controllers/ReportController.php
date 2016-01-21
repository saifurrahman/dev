	<?php
class ReportController extends Controller {
	public function __construct() {
		$this->beforeFilter ( 'csrf', array (
				'on' => 'post'
		) );
	}
	public function postSchedulereport() {
		$client_id = Input::get ( 'client_id' );
		$deal_id = Input::get ( 'deal_id' );
		$from_date = Input::get ( 'from_date' );
		$to_date = Input::get ( 'to_date' );

		$query = "";

		if ($deal_id == 0) {
			$query = "select asm.id, asm.ad_id,asm.schedule_date,asm.status,asm.schedule_date,asm.telecast_time, asm.remark, am.caption,am.duration,bm.name as break_name,tm.id as timeslot_id,tm.time_slot, am.client_id from ad_schedule_master asm,ad_master am,adbreak_master bm,timeslot_master tm where asm.schedule_date BETWEEN '$from_date' AND '$to_date' and am.client_id='$client_id' and asm.ad_id=am.id and asm.break_id=bm.id and asm.timeslot_id=tm.id ORDER BY asm.schedule_date, tm.id,bm.id";
		} else {
			$query = "select asm.id, asm.ad_id,asm.schedule_date,asm.status,asm.schedule_date,asm.telecast_time, asm.remark, am.caption,am.duration,bm.name as break_name,tm.id as timeslot_id,tm.time_slot, am.client_id from ad_schedule_master asm,ad_master am,adbreak_master bm,timeslot_master tm where asm.schedule_date BETWEEN '$from_date' AND '$to_date' and am.client_id='$client_id' and asm.deal_id='$deal_id' and asm.ad_id=am.id and asm.break_id=bm.id and asm.timeslot_id=tm.id ORDER BY asm.schedule_date, tm.id,bm.id";
		}
		$alladd = DB::select ( DB::raw ( $query ) );

		return Response::json ( $alladd );
	}
	public function postTelecasttime() {
		$ad_id = substr ( Input::get ( 'ad_id' ), 2 );
		$tc_date = Input::get ( 'tc_date' );
		$query = "Select tc_time from telecasttime_log where tc_date='$tc_date' and ad_id='$ad_id'";
		$tc_time = DB::select ( DB::raw ( $query ) );
		return Response::json ( $tc_time );
	}
	public function postTcbydate() {
		$schedule_date = substr ( Input::get ( 'schedule_date' ), 2 );
		$query = "Select * from telecasttime_log where tc_date='$schedule_date'ORDER BY ad_id,tc_time";
		$tc_time = DB::select ( DB::raw ( $query ) );
		return Response::json ( $tc_time );
	}
	public function getLastschedulereport() {
		$query = "SELECT t1.schedule_date,count(t1.id) as slots,SUM(t2.duration) as total_duration FROM 	ad_schedule_master t1,ad_master t2 where t1.ad_id=t2.id  and MONTH(t1.schedule_date)=MONTH(NOW()) group BY t1.schedule_date ORDER BY t1.schedule_date";
		$tc_time = DB::select ( DB::raw ( $query ) );
		return Response::json ( $tc_time );
	}
	public function getMonthlydeals() {
		$query = "SELECT MONTHNAME (created_at) as month_name, sum(amount) as total_amount from deal_master GROUP BY MONTH(created_at)";
		$tc_time = DB::select ( DB::raw ( $query ) );
		return Response::json ( $tc_time );
	}

	public function getExecutivemonthlydeals(){
		$query="SELECT t1.executive_id,t2.ex_name as name ,sum(t1.amount) as amount,MONTHNAME(t1.created_at) as month_name FROM deal_master t1, advetisement_executive t2 where t1.executive_id =t2.id and MONTH(t1.created_at)=MONTH(NOW()) group BY t1.executive_id,MONTH(t1.created_at) ORDER BY MONTH(t1.created_at)";
		$deals = DB::select ( DB::raw ( $query ) );
		return Response::json ( $deals );
	}
	public function getMonthlybills(){
		$query = "SELECT MONTHNAME (to_date) as month_name, sum(total_amount) as total_amount from bill_master GROUP BY MONTH(to_date)";
		$deals = DB::select ( DB::raw ( $query ) );
		return Response::json ( $deals );
	}
	public function getLocationmonthlydeals(){
		$query="SELECT t1.executive_id,t2.location as name ,sum(t1.amount) as amount,MONTHNAME(t1.created_at) as month_name FROM deal_master t1, advetisement_executive t2 where t1.executive_id =t2.id and MONTH(t1.created_at)=MONTH(NOW()) group BY t2.location,MONTH(t1.created_at) ORDER BY MONTH(t1.created_at)";
		$deals = DB::select ( DB::raw ( $query ) );
		return Response::json ( $deals );
	}
	public function getMonthlypayments(){
		$query = "SELECT MONTHNAME (payment_date) as month_name, sum(amount) as total_amount from payments_master  GROUP BY MONTH(payment_date) order by payment_date";
		$deals = DB::select ( DB::raw ( $query ) );
		return Response::json ( $deals );
	}
	public function getMonthlyscheduleamount(){
		$query = "SELECT * from deal_master";
		$deals = DB::select ( DB::raw ( $query ) );
		return Response::json ( $deals );
	}
	public function getRatedurationcurve(){
		$query = "SELECT t1.schedule_date as schedule_date, SUM(t2.rate)/count(t1.id) as rate,sum(t3.duration)/60 as total_duration, (rate*SUM(t3.duration))/10000 as amount FROM ad_schedule_master t1,deal_master t2,ad_master t3 WHERE t1.deal_id=t2.id and month(t1.schedule_date)=MONTH(NOW()) and t1.ad_id=t3.id GROUP BY t1.schedule_date";
		$deals = DB::select ( DB::raw ( $query ) );
		return Response::json ( $deals );
	}
	public function postDailyscheduleamount(){
		$month = Input::get( 'month' );
		$query="SELECT t1.schedule_date as schedule_date,SUM(CEILING(t2.rate*t3.duration/10)) as amount FROM ad_schedule_master t1,deal_master t2,ad_master t3 WHERE t1.deal_id=t2.id and month(t1.schedule_date)=$month and t1.ad_id=t3.id and t2.item_id=1 GROUP BY t1.schedule_date ORDER BY t1.schedule_date ASC";
			$deals = DB::select ( DB::raw ( $query ) );
		return Response::json ( $deals );
	}
	public function getAllscheduleamount(){
			$query="SELECT * from monthly_report_master";
			$deals = DB::select ( DB::raw ( $query ) );
			return Response::json ( $deals );
	}
}
