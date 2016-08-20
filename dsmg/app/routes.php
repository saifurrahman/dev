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
Route::get('/pdf', function()
{
  $html = '<html><body>'
    . '<p>Hello, Welcome to TechZoo.</p>'
    . '</body></html>';
    return PDF::load($html, 'A4', 'portrait')->download('my_pdf');
});

//before login
Route::controller('users', 'UserController');
Route::controller('mobile', 'MobileController');
//after login
Route::controller('dsmg', 'AppController');
Route::controller('schedule', 'ScheduleController');
Route::controller('common', 'CommonController');
Route::controller('report', 'ReportController');
Route::controller('gear', 'GearController');
Route::controller('cron', 'CronController');
