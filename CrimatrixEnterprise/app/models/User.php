<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	//protected $hidden = array('password', 'remember_token');

	public static $rules = array(		
		'name'=>'required|min:2',
		'email'=>'required|email|unique:users',
		'mobile' => 'required|unique:users'
	);

    public static $change_password_rules = array(
    	'old_password' => 'required|alpha_num|between:6,16',
        'password' => 'required|alpha_num|between:6,16',
        'confirmPassword'=> 'required|same:password',
    );

    public static $reset_password_rules = array(
        'password' => 'required|alpha_num|between:6,16',
        'confirmPassword'=> 'required|same:password',
    );
}
