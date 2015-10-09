<?php

class User_Service extends Controller {

    function __construct() {
        parent::__construct();
    }

    function login() {
        $this->model->login();
    }
    function logout() {
    	$this->model->logout();
    }
	function forget_password() {
    	$this->model->forget_password();
    }    
    function verify_token(){
    	$this->model->verify_token();
    }
    function reset_password(){
    	$this->model->reset_password();
    }
    
    function get_all_districts() {
        $this->model->get_all_districts();
    }
}