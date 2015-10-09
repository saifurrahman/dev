<?php
class Reset_Password extends Controller {

	function __construct() {
		parent::__construct();
	}
	function index(){
		$token = $_GET['token'];		
		if(isset($token)){
			$this->view->render('reset_password/index', true);
		}
		else{
			header('location:'.URL);
		}
	}
}