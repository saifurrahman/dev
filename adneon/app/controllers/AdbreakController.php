<?php

class AdbreakController extends Controller
{

    public function __construct ()
    {
        $this->beforeFilter('csrf', 
                array(
                        'on' => 'post'
                ));
    }

    public function postAddbreak ()
    {
        $validator = Validator::make(Input::all(), Adbreak::$rules);
        if ($validator->passes()) {
            $break = new Adbreak();
            $break->name = Input::get('name');
            $break->duration = Input::get('duration');
            
            $break->save();
            return Response::json($break);
        } else {
            return 0;
        }
    }

    public function getAll ()
    {
        $break = Adbreak::all();
        return Response::json($break);
    }
}