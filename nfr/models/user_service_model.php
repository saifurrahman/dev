<?php

class User_Service_Model extends Model {

    public function __construct() {
        parent::__construct();
        header("Content-type: application/json");
        header("X-XSS-Protection: 1; mode=block");
    }
    
    function login(){
    	$username = $this->clear_input_string($_POST['username']);
        $password = Hash::create('md5', $this->clear_input_string($_POST['password']), HASH_PASSWORD_KEY);
    	$query = "SELECT um.id, um.name, um.email, um.designation, um.user_type, um.role_id, um.status, um.created, rm.name as role 
        FROM ".TABLE_USER_MASTER." um, ".TABLE_ROLE_MASTER." rm WHERE um.role_id = rm.id 
        AND (um.email = '$username' OR um.mobile='$username') AND um.password = '$password'";
    	$sth = $this->db->prepare($query);
    	$sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        $data = $sth->fetch();
    	$count = $sth->rowCount();
    	if ($count == 1) {
    		Session::init();
    		Session::set('user_id', $data['id']);
    		Session::set('name', $data['name']);
    		Session::set('email', $data['email']);
    		Session::set('mobile', $data['mobile']);
    		Session::set('designation', $data['designation']);
    		Session::set('created', $data['created']);
    		Session::set('user_type', $data['user_type']);
    		Session::set('status', $data['status']);
    		Session::set('role_id', $data['role_id']);
            Session::set('role', $data['role']);
    		$access_id = 1;//$this->write_access_log($data['id'], $location, $ip_address, $data['status']);
    		if($access_id > 0){
    			Session::set('loggedIn', true);
    			if ($data['user_type'] == 'admin'){
                    if ($data['status'] == 1) {
    					header('location:'.URL.'admin/maintenance_roster');
    				} else{
    					header('location:'.URL.'admin/profile');
    				}
    			}                
                if ($data['user_type'] == 'user'){
                	header('location:'.URL.'admin/maintenance_roster');
                }
    		} 
    		else{
    			header('Location:'.URL.'?loginFailed');
    		}
    	}
    	else{
    		header('location:'.URL.'?loginFailed');
    	}
        
    }
    
    function changePassword() {
    	Session::init();
    	$user_id = Session::get("user_id");
    	$password = $_POST['password'];
    	$updateData = array();
    	$updateData['password'] = Hash::create('md5', $password, HASH_PASSWORD_KEY);
    	$this->db->update(TABLE_USER_MASTER, $updateData, "id = $user_id");
    	echo 1;
    }

    function check_email($table, $email) {
    	//check for email
    	$query = "SELECT id FROM $table where email = '$email'";
    	$sth = $this->db->prepare($query);
    	$sth->setFetchMode(PDO::FETCH_ASSOC);
    	$sth->execute();
    	$data = $sth->fetchAll();
    	$count_email = $sth->rowCount();
    	if ($count_email == 0) {
    		return $count_email;
    	} else {
    		return $data[0]['id'];
    	}
    }
    function forget_password() {
        $email = $_POST['email'];
        $user_id = $this->check_email(TABLE_USER_MASTER, $email);
        if($user_id != 0){
            $token = $this->getToken();
            $today = date('Y-m-d H:i:s', time());
            $expiry_datetime = date('Y-m-d H:i:s', strtotime($today."+ 1 days"));
            $data = array('user_id' => $user_id, 'token' => $token, 'expiry_datetime' => $expiry_datetime);
            $this->db->insert('nfr_reset_password', $data);
            //email the link with the token
        }
        else{
            echo 0;
        }
    }
    
    function verify_token(){
    	$data = array();
    	$token = $_POST['token'];
    	$query = "SELECT * FROM nfr_reset_password WHERE token='$token'";
    	$sth = $this->db->prepare($query);
    	$sth->setFetchMode(PDO::FETCH_ASSOC);
    	$sth->execute();
    	$data = $sth->fetchAll();
    	$count = $sth->rowCount();
    	$status = $data[0]['status'];
    	if($count == 1 & $status != 1){
    		$today = date('Y-m-d H:i:s', time());
    		if($data[0]['expiry_datetime'] > $today){
    			echo 1;
    		}
    		else{
    			echo 2;
    		}
    	}
    	else{
    		echo 0;
    	}
    }    
    
    function reset_password(){
    	$token = $_POST['token'];
    	$password = $_POST['password'];
    	$query = "SELECT * FROM nfr_reset_password WHERE token='$token'";
    	$sth = $this->db->prepare($query);
    	$sth->setFetchMode(PDO::FETCH_ASSOC);
    	$sth->execute();
    	$data = $sth->fetchAll();
    	$count = $sth->rowCount();
    	if($count == 1){
    		$id = $data[0]['id'];
    		$user_id = $data[0]['user_id'];
    		$data = array('status' => 1);
    		$this->db->update('nfr_reset_password', $data, "id = $id");
    		$updateData = array('password' => Hash::create('md5', $password, HASH_PASSWORD_KEY));
    		$this->db->update(TABLE_USER_MASTER, $updateData, "id = $user_id");
    		echo 1;    		    		  		    		
    	}
    	else{
    		echo 0;
    	}
    }
    
    function get_all_districts(){
    	$sql = "SELECT * FROM ".TABLE_DISTRICT_MASTER;
    	$sth = $this->db->prepare($sql);
    	$sth->setFetchMode(PDO::FETCH_ASSOC);
    	$sth->execute();
    	$data = $sth->fetchAll();
    	echo json_encode($data);
    }
    function logout() {
        Session::init();
        Session::destroy();
        header('Location: ' . URL);
        exit;
    }
}

?>