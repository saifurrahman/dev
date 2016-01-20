<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    
    use UserTrait, RemindableTrait;

    protected $table = 'user_master';

    public static $rules = array(
            'username' => 'required',
            'password' => 'required'
    );

    public static $require = array(
            'name' => 'required',
            'mobile' => 'required'
    );
}
