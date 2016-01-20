<?php

class SettingsController extends BaseController
{

    public function __construct ()
    {
        $this->beforeFilter('csrf', 
                array(
                        'on' => 'post'
                ));
    }
    
    // user
    public function postSaveuser ()
    
    {
        $validator = Validator::make(Input::all(), User::$require);
        if ($validator->passes()) {
            $users = new User();
            $users->name = Input::get('name');
            $users->email = Input::get('email');
            $users->mobile = Input::get('mobile');
            $users->designation = Input::get('designation');
            $users->password = Hash::make('demo');
            $users->role = 'user';
            $users->status = 0;
            $users->save();
            return Response::json($users);
        } else {
            return 0;
        }
    }

    public function getAlluser ()
    {
        $users = User::all();
        return Response::json($users);
    }

    public function postDisable ()
    {
        $id = Input::get('id');
        $status = Input::get('status');
        $users = User::find($id);
        $users->status = 0;
        $users->save();
        return $status;
    }

    public function postEnable ()
    {
        $id = Input::get('id');
        $status = Input::get('status');
        $users = User::find($id);
        $users->status = 1;
        $users->save();
        return $status;
    }
}