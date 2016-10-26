<?php

class PoliceController extends BaseController {
	public function __construct() {
		header('Access-Control-Allow-Origin: * ');
	//	header('Access-Control-Allow-Origin: http://police.crimatrix.com');
		header('Access-Control-Request-Method: GET, POST');
	}
	public function getDashdetails(){
		$guestlist_date = date('Y-m-d',strtotime(date('Y-m-d'). "-1 days"));
		$registered = User::count();
		$subimitted = Hotelrecord::select(DB::raw('count(*) as subimitted_hotels'))
				->where('guestlist_date', $guestlist_date)
                ->get();
		$totals = Hotelrecord::select(DB::raw('sum(total_check_in) as total_check_in, sum(total_check_out) as total_check_out, sum(foreign_guest) as foreign_guest'))
				->where('guestlist_date', $guestlist_date)
                ->get();
        $totals[0]['guestlist_date'] = date("d-M-Y", strtotime($guestlist_date));
		$totals[0]['subimitted_hotels'] = $subimitted[0]['subimitted_hotels'];
        $totals[0]['registered'] = $registered - 5;
        return Response::json($totals);
	}
	public function postSubmitter(){
		$token = Input::get('token');
		$guestlist_date = date("Y-m-d", strtotime(Input::get('guestlist_date')));
		$ps_id = Input::get('ps_id');
		if($ps_id != 0){
			$where = "WHERE us.ps_id = $ps_id";
		}
		else{
			$where = "";
		}
		if($token == 'abc'){
			$hotels = DB::select(DB::raw("SELECT DISTINCT(hg.hotel_id), us.name as hotel_name, us.email, us.mobile, us.contact_person, us.locality, us.pin, ps.name as ps_name FROM hotel_guestlist hg INNER JOIN users us ON hg.hotel_id = us.id AND hg.guestlist_date = '$guestlist_date' INNER JOIN policestations ps ON ps.id = us.ps_id $where"));
			return Response::json($hotels);
		}
		return 0;
	}
	function postSearchforeignguest(){
    	$path = public_path();
		$token = Input::get('token');
		$from_date = date("Y-m-d", strtotime(Input::get('from_date')));
		$to_date = date("Y-m-d", strtotime(Input::get('to_date')));
		$nationality = Input::get('nationality');
    	$guest_name = Input::get('guest_name');
    	if($token == 'abc'){
			if($nationality == ''){
    			$nat = "";
    		}
    		else{
    			$nat = "AND hg.nationality = '$nationality'";
    		}
			if($guest_name == ''){
    			$gname = "";
    		}
    		else{
    			$gname = "AND hg.name = '$guest_name'";
    		}
			$guestlist = DB::select(DB::raw("SELECT hg.*, us.name as hotel_name, us.email as hotel_email, us.mobile
			as hotel_mobile, us.contact_person, us.locality as hotel_locality, us.pin,ps.name as ps_name
			FROM hotel_guestlist hg INNER JOIN users us ON hg.hotel_id = us.id INNER JOIN policestations ps ON ps.id = us.ps_id
			WHERE hg.nationality NOT IN ('IND','INDIA','INDIAN') AND hg.guestlist_date between '$from_date' and '$to_date' $nat $gname limit 100"));
			foreach ($guestlist as $guest) {
				clearstatcache();
				$is_file_exist = false;
				$file = $guest->id.'.jpg';
				$file_url = $path.'/uploads/hotelguestlist/'.$file;
				$is_file_exist = file_exists($file_url);
				if(!$is_file_exist){
					$image_url = 'http://enterprise.crimatrix.com/img/default_pic.jpg';
					$image_url_thumb = 'http://enterprise.crimatrix.com/img/default_pic_thumb.jpg';
				}else{
					$image_url = 'http://enterprise.crimatrix.com/uploads/hotelguestlist/'.$file;
					$image_url_thumb = 'http://enterprise.crimatrix.com/uploads/hotelguestlist/thumb/'.$file;
				}
				$guest->image_url = $image_url;
				$guest->image_url_thumb = $image_url_thumb;
			}
			return Response::json($guestlist);
    	}
    }
	public function postGuestlist(){
		$path = public_path();
		$token = Input::get('token');
		$hotel_id = Input::get('hotel_id');
		$guestlist_date = date("Y-m-d", strtotime(Input::get('guestlist_date')));
		if($token == 'abc'){
			$guestlist = DB::select(DB::raw("SELECT * FROM hotel_guestlist WHERE guestlist_date = '$guestlist_date' AND hotel_id = $hotel_id"));
			foreach ($guestlist as $guest) {
				clearstatcache();
				$is_file_exist = false;
				$file = $guest->id.'.jpg';
				$file_url = $path.'/uploads/hotelguestlist/'.$file;
				$is_file_exist = file_exists($file_url);
				if(!$is_file_exist){
					$image_url = 'http://enterprise.crimatrix.com/img/default_pic.jpg';
					$image_url_thumb = 'http://enterprise.crimatrix.com/img/default_pic_thumb.jpg';
				}else{
					$image_url = 'http://enterprise.crimatrix.com/uploads/hotelguestlist/'.$file;
					$image_url_thumb = 'http://enterprise.crimatrix.com/uploads/hotelguestlist/thumb/'.$file;
				}
				$guest->image_url = $image_url;
				$guest->image_url_thumb = $image_url_thumb;
			}
			return Response::json($guestlist);
		}
		else{
			return 0;
		}
    }
    public function postSearchguest() {
    	$path = public_path();
		  $token = Input::get('token');
    	$search_by = Input::get('search_by');
    	$search_input = Input::get('search_input');
    	if($token == 'abc'){
    		if($search_by == 'Name'){
	    		$guestlist = DB::select(DB::raw("SELECT hg.*, us.name as hotel_name, us.email as hotel_email, us.mobile  as hotel_mobile, us.contact_person, us.locality as hotel_locality, us.pin,ps.name as ps_name
				FROM hotel_guestlist hg INNER JOIN users us ON hg.hotel_id = us.id INNER JOIN policestations ps ON ps.id = us.ps_id WHERE hg.name LIKE '%$search_input%'"));
				foreach ($guestlist as $guest) {
					clearstatcache();
					$is_file_exist = false;
					$file = $guest->id.'.jpg';
					$file_url = $path.'/uploads/hotelguestlist/'.$file;
					$is_file_exist = file_exists($file_url);
					if(!$is_file_exist){
						$image_url = 'http://enterprise.crimatrix.com/img/default_pic.jpg';
						$image_url_thumb = 'http://enterprise.crimatrix.com/img/default_pic_thumb.jpg';
					}else{
						$image_url = 'http://enterprise.crimatrix.com/uploads/hotelguestlist/'.$file;
						$image_url_thumb = 'http://enterprise.crimatrix.com/uploads/hotelguestlist/thumb/'.$file;
					}
					$guest->image_url = $image_url;
					$guest->image_url_thumb = $image_url_thumb;
				}
				return Response::json($guestlist);
			}
			else{
				$guestlist = DB::select(DB::raw("SELECT hg.*, us.name as hotel_name, us.email as hotel_email, us.mobile  as hotel_mobile, us.contact_person, us.locality as hotel_locality, us.pin,ps.name as ps_name
				FROM hotel_guestlist hg INNER JOIN users us ON hg.hotel_id = us.id
				INNER JOIN policestations ps ON ps.id = us.ps_id
				WHERE hg.mobile = '$search_input'"));
				foreach ($guestlist as $guest) {
					clearstatcache();
					$is_file_exist = false;
					$file = $guest->id.'.jpg';
					$file_url = $path.'/uploads/hotelguestlist/'.$file;
					$is_file_exist = file_exists($file_url);
					if(!$is_file_exist){
						$image_url = 'http://enterprise.crimatrix.com/img/default_pic.jpg';
						$image_url_thumb = 'http://enterprise.crimatrix.com/img/default_pic_thumb.jpg';
					}else{
						$image_url = 'http://enterprise.crimatrix.com/uploads/hotelguestlist/'.$file;
						$image_url_thumb = 'http://enterprise.crimatrix.com/uploads/hotelguestlist/thumb/'.$file;
					}
					$guest->image_url = $image_url;
				}
				return Response::json($guestlist);
			}
    	}
    	else{
    		return 0;
    	}
    }
    function getAbsents(){
    	$result = array();
    	$submitted_hotels = DB::select(DB::raw("select guestlist_date, group_concat(hotel_id) as submitted_hotels from hotel_records group by guestlist_date"));
    	foreach ($submitted_hotels as $row) {
    		$resp['not_submitted'] = DB::select(DB::raw("select name from users where id not in ($row->submitted_hotels)"));
    		$resp['guestlist_date'] = $row->guestlist_date;
    		array_push($result, $resp);
    	}
		return Response::json($result);
    }

    function getCheckinoutgraph(){
    	$data = DB::select(DB::raw("SELECT * FROM (SELECT guestlist_date, count(*) as total_submited, sum(total_check_in) as total_check_in, sum(total_check_out) as total_check_out FROM hotel_records group by guestlist_date order by guestlist_date desc LIMIT 0 , 30) t ORDER BY guestlist_date ASC"));
    	return Response::json($data);
    }
    function postMigrateuser(){
    	//$user = Input::all();
    	//return Response::json($user);
    	$user = User::find(Input::get('id'));
		$user->password = Hash::make(Input::get('password'));
		$user->address = Input::get('address');
		$user->locality = Input::get('locality');
		$user->number_of_rooms = Input::get('no_of_rooms');
		$user->licence_no = Input::get('licence_no');
		$user->contact_person = Input::get('contact_person');
		$user->ps_id = Input::get('ps_id');
		$user->pin = Input::get('pin');
        $user->status = 1;
        $user->save();
    }
		public function postMobilesearchguest() {
    	$path = public_path();
		  $token = Input::get('token');
    	$search_by = Input::get('search_by');
    	$search_input = Input::get('search_input');
    	if($token == 'abc'){
    		if($search_by == 'Name'){
	    		$guestlist = DB::select(DB::raw("SELECT hg.*, us.name as hotel_name, us.email as hotel_email, us.mobile  as hotel_mobile, us.contact_person, us.locality as hotel_locality, us.pin,ps.name as ps_name
				FROM hotel_guestlist hg INNER JOIN users us ON hg.hotel_id = us.id INNER JOIN policestations ps ON ps.id = us.ps_id WHERE hg.name LIKE '%$search_input%' and hg.guestlist_date='2016-09-01'"));

				return Response::json($guestlist);
			}
			else{
				$guestlist = DB::select(DB::raw("SELECT hg.*, us.name as hotel_name, us.email as hotel_email, us.mobile  as hotel_mobile, us.contact_person, us.locality as hotel_locality, us.pin,ps.name as ps_name
				FROM hotel_guestlist hg INNER JOIN users us ON hg.hotel_id = us.id
				INNER JOIN policestations ps ON ps.id = us.ps_id
				WHERE hg.mobile = '$search_input' and hg.guestlist_date='2016-09-01'"));

				return Response::json($guestlist);
			}
    	}
    	else{
    		return 0;
    	}

			return "Token"+$token;
    }
}
?>
