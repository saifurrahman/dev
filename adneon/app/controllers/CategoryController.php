<?php
class CategoryController extends Controller {
	public function __construct() {
		$this->beforeFilter ( 'csrf', array (
				'on' => 'post' 
		) );
	}
	
	public function getAll(){
		$category = Category::all();
		return Response::json($category);
	}
	public function postCategory(){
		$category = new Category();
		$category->name = Input::get('name');
		$category->save();
		return Response::json($category);
	}
}