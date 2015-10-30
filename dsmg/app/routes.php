<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});
//before login
Route::controller('users', 'UserController');

//after login
Route::controller('app', 'AppController');
Route::controller('schedule', 'ScheduleController');
Route::controller('common', 'CommonController');
