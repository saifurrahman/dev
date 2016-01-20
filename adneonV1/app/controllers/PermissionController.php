<?php

class PermissionController extends BaseController
{

    public function postSetpermission ()
    {
        $user_id = Input::get('user_id');
        $permission = DB::select(
                DB::raw(
                        "SELECT pt.name,up.permission_id,up.user_id,pt.id, IF(up.permission_id IS NULL,false,true) permission
    					FROM permission_type pt LEFT OUTER JOIN user_permission up ON pt.id = up.permission_id AND up.user_id = $user_id"));
        return Response::json($permission);
    }

    public function postOn ()
    {
        $user_id = Input::get('user_id');
        $permission_id = Input::get('permission_id');
        $userpermission = new Userpermission();
        $userpermission->user_id = $user_id;
        $userpermission->permission_id = $permission_id;
        $userpermission->save();
        return Response::json($userpermission);
    }

    public function postOff ()
    {
        $user_id = Input::get('user_id');
        $permission_id = Input::get('permission_id');
        $delete = DB::table('user_permission')->where('user_id', 
                $user_id)
            ->where('permission_id', $permission_id)
            ->delete();
        return Response::json($delete);
    }
}