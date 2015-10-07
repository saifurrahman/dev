<?php

class BrandController extends Controller
{

    public function __construct ()
    {
        $this->beforeFilter('csrf', 
                array(
                        'on' => 'post'
                ));
    }

    public function postSave ()
    {
        $validator = Validator::make(Input::all(), Brand::$rules);
        if ($validator->passes()) {
            $brand = new Brand();
            $brand->client_id = Input::get('client_id');
            $brand->brand_name = Input::get('brand_name');
            $brand->category_id = Input::get('category_id');
            $brand->save();
            return Response::json($brand);
        } else {
            return 0;
        }
    }

    public function getAll ()
    {
        $brand = DB::table ( 'brand_master' )
				->join ( 'client_master', 'brand_master.client_id', '=', 'client_master.id' )
				->join ( 'category_master', 'brand_master.category_id', '=', 'category_master.id' )
				->select('client_master.name','client_master.id as client_id', 'brand_master.*','category_master.name as cat_name','category_master.id as cat_id')
				->get(); 
		return Response::json ( $brand );
    }
}