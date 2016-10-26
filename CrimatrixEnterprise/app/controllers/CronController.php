<?php

class CronController extends BaseController {
	public function __construct() {

	}
	public function getSubmittedhotels(){
		
		$guestlist_date = date('Y-m-d',strtotime(date('Y-m-d'). "-1 days"));		
		$registered = User::count();
		$subimitted = Hotelrecord::select(DB::raw('count(*) as subimitted_hotels'))
				->where('guestlist_date', $guestlist_date)
                ->get();
		$totals = Hotelrecord::select(DB::raw('sum(total_check_in) as total_check_in, sum(total_check_out) as total_check_out, sum(foreign_guest) as foreign_guest'))
				->where('guestlist_date', $guestlist_date)
                ->get();               
        $totals[0]['guestlist_date'] = $guestlist_date;
		$totals[0]['subimitted_hotels'] = $subimitted[0]['subimitted_hotels'];
        $totals[0]['registered'] = $registered - 5;        
        $data = array(
        	'guestlist_date' => $totals[0]['guestlist_date'], 
        	'registered' => $totals[0]['registered'], 
        	'subimitted_hotels' => $totals[0]['subimitted_hotels'], 
        	'total_check_in' => $totals[0]['total_check_in'], 
        	'total_check_out' => $totals[0]['total_check_out'], 
        	'foreign_guest' => $totals[0]['foreign_guest'] 
        	);
       	Mail::send('emails.reports', $data, function($message){
                $message->from('reports@crimatrix.com', 'Crimatrix');
                $message->to('kamal.dev@glomindz.com')->cc('support@glomindz.com')->subject('Crimatrix daily report');
        });
	}
	public function getStats(){
			DB::transaction(function(){			
			$guestlist_date = date('Y-m-d',strtotime(date('Y-m-d'). "-1 days"));			
			
			$hotels = Guestlist::select('hotel_id')
	                    ->where('guestlist_date', $guestlist_date)
	                    ->distinct()
	                    ->get();
			
			foreach ($hotels as $row) {
				$total_check_in = Guestlist::select(DB::raw('count(*) as total_check_in'))
					->where('guestlist_date', $guestlist_date)
					->where('hotel_id', $row->hotel_id)
					->pluck('total_check_in');

				$total_check_out = Guestlist::select(DB::raw('count(*) as total_check_out'))
					->where('checkout_date', 'like', $guestlist_date.'%')
					->where('hotel_id', $row->hotel_id)
					->pluck('total_check_out');

				$foreign_guest = Guestlist::select(DB::raw('count(*) as foreign_guest'))
					->where('checkin_date', 'like', $guestlist_date.'%')
					->where('hotel_id', $row->hotel_id)
					->whereNotIn('nationality', array('IND', 'INDIA', 'INDIAN'))
					->pluck('foreign_guest');
				
				//dd(DB::getQueryLog($total_check_out));
				$data = array();
				$data['hotel_id'] = $row->hotel_id;
				$data['guestlist_date'] = $guestlist_date;
				$data['total_check_in'] = $total_check_in;
				$data['total_check_out'] = $total_check_out;
				$data['foreign_guest'] = $foreign_guest;			
				$data['id'] = DB::table('hotel_records')->insertGetId($data);				
			}
			
		});
		
	}

	public function getRemovephoto(){				
		$guestlist_date = date('Y-m-d',strtotime(date('Y-m-d'). "-21 days"));	
		$hotels = DB::select(DB::raw("SELECT id FROM hotel_guestlist WHERE guestlist_date = '$guestlist_date'"));	
		$count = 0;
		foreach ($hotels as $row){
			$path = public_path();
			$file_url = $path.'/uploads/hotelguestlist/'.$row->id.'.jpg';
			$filethumb_url = $path.'/uploads/hotelguestlist/thumb/'.$row->id.'.jpg';			
			if(file_exists($file_url)){
				unlink($file_url);
				$count = $count + 1;
			}			
			if(file_exists($filethumb_url)){
				unlink($filethumb_url);
				$count = $count + 1;
			}
		}
		Mail::send('emails.count', array('count' => $count, 'guestlist_date'=> $guestlist_date), function($message)
		{
			$message->to('kamal.dev@glomindz.com')->cc('support@glomindz.com')->subject('Crimatrix Remove Photo Count');
		});		
	}
	
	public function getTest(){
		echo time();
	}
}

?>
