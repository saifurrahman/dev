<?php
class LanguageController extends Controller {
	public function __construct() {
		$this->beforeFilter ( 'csrf', array (
				'on' => 'post' 
		) );
	}
	
	public function getAll(){
		$language = Language::all();
		return Response::json($language);
	}
	public function postLanguage(){
		$language = new Language();
		$language->name = Input::get('name');
		$language->save();
		return Response::json($language);
	}
}