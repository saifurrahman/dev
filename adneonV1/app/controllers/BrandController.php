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

            $brand = new Brand();
            $brand->client_id = Input::get('client_id');
            $brand->brand_name = Input::get('brand_name');
            $brand->category_id = Input::get('category_id');
            $brand->save();
            return Response::json($brand);

    }

    public function getAll ()
    {
      $query="SELECT t1.brand_name,t2.name,t3.name as category FROM brand_master t1,client_master t2,category_master t3 where t1.category_id=t3.id and t1.client_id=t2.id order by t1.id desc";
      $brands = DB::select ( DB::raw ( $query ) );

		return Response::json ( $brands );
    }
}
