<?php

class GuestController extends BaseController {
	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));	

		$this->beforeFilter('auth', array('only'=>array('getList')));
        $this->beforeFilter('auth', array('only'=>array('postAdd')));        
        $this->beforeFilter('auth', array('only'=>array('postCheckedout')));
        $this->beforeFilter('auth', array('only'=>array('getReports')));
        //$this->beforeFilter('auth', array('only'=>array('getDelete')));
	}
	public function getList() {
		$path = public_path();
		$user_id = Session::get('user_id');
    	//$guestlist = DB::table('hotel_guestlist')->where('check_out_status', '0')->get();
    	$guestlist = DB::select(DB::raw("SELECT * FROM hotel_guestlist WHERE hotel_id = $user_id AND check_out_status = 0"));
		foreach ($guestlist as $guest) {
			clearstatcache();
			$is_file_exist = false;			
			$file = $guest->id.'.jpg';
			$file_url = $path.'/uploads/hotelguestlist/'.$file;
			$is_file_exist = file_exists($file_url);
			if(!$is_file_exist){
				$image_url = 'http://enterprise.crimatrix.com/img/default_pic.jpg';
				//$image_url_thumb = 'http://enterprise.crimatrix.com/img/default_pic_thumb.jpg';
			}else{
				$image_url = 'http://enterprise.crimatrix.com/uploads/hotelguestlist/thumb/'.$file;
				//$image_url_thumb = 'http://enterprise.crimatrix.com/uploads/hotelguestlist/thumb/'.$file;
			}
			$guest->image_url = $image_url;
			//$guest->image_url_thumb = $image_url_thumb;				
		}		
    	return Response::json($guestlist);
    }
	public function postAdd() {
		$user_id = Session::get('user_id');        
		$checkin_date=date('Y-m-d H:i:s', time());
		$guestlist_date = date("Y-m-d", strtotime(Input::get('guestlist_date')));
 		$data_url = Input::get('data_url');

		$data = array();
		$data['room_no'] = Input::get('room_no');
		$data['name'] = Input::get('name');
		$data['mobile'] = Input::get('mobile');
		$data['additional_member'] = Input::get('additional_member');
		$data['coming_from'] = Input::get('coming_from');
		$data['id_type'] = Input::get('id_type');
		$data['id_no'] = Input::get('id_no');
		$data['going_to'] = Input::get('going_to');
		$data['nationality'] = Input::get('nationality');
		$data['age'] = Input::get('age');
		$data['sex'] = Input::get('sex');
		$data['vehicle_no'] = Input::get('vehicle_no');
		$data['guestlist_date'] = $guestlist_date;
		$data['checkin_date'] = $checkin_date;
		$data['check_out_status'] = 0;
		$data['hotel_id'] = $user_id;
		$data['id'] = DB::table('hotel_guestlist')->insertGetId($data);			
		if($data['id'] != 0){
			if(isset($data_url)){
				$this->saveGuestphoto($data['id'],$data_url);
			}
		}
		return Response::json($data);	
    }   
    public function saveGuestphoto($id,$data_url){
    	$path = public_path();
    	$destinationPath = $path.'/uploads/hotelguestlist/';
    	$file = $id.".jpg";    	
		$img = substr($data_url, strpos($data_url, ",") + 1);
		$decodedData = base64_decode($img);
		$success = file_put_contents($destinationPath.$file, $decodedData);

		$source_path = $destinationPath.$file;
		$destination= $destinationPath.$file;
		$newwidth = 640;
		$this->resizeImg($newwidth,$source_path,$destination);	
		$destination = $destinationPath."thumb/".$file;
		$newwidth = 50;
		$this->resizeImg($newwidth,$source_path,$destination);
    }
    public function resizeImg($newwidth,$source_path,$destination) {
		$image = imagecreatefromjpeg($source_path);
		$width = imagesx($image);
		$height = imagesy($image);
		$newheight=($height/$width)*$newwidth;
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$image,0,0,0,0,$newwidth,$newheight, $width,$height);
		imagejpeg($tmp,$destination,100);
		imagedestroy($image);
		imagedestroy($tmp);
	}    
    public function postCheckedout(){
    	$id = Input::get('id');
    	$check_out_date=date('Y-m-d H:i:s', time());
    	DB::table('hotel_guestlist')->where('id', $id)->update(array('checkout_date'=> $check_out_date, 'check_out_status' => 1));
    	echo $id;
    }
	public function getReports(){
    	$user_id = Session::get('user_id');
        $data = DB::select(DB::raw("SELECT * FROM (SELECT hotel_id, total_check_in, total_check_out, guestlist_date FROM hotel_records where hotel_id = $user_id ORDER BY guestlist_date DESC LIMIT 0 , 30) t ORDER BY guestlist_date ASC"));
        return Response::json($data);       
    }
}

?>
