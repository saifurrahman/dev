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
Route::controller('addneon', 'AppController');
Route::controller('program', 'ProgramController');
Route::controller('settings', 'SettingsController');
//master data
Route::controller('audience', 'AudienceController');
Route::controller('language', 'LanguageController');
Route::controller('category', 'CategoryController');
Route::controller('schedule', 'ScheduleController');
Route::controller('client', 'ClientController');
Route::controller('deal', 'DealController');
Route::controller('advertise', 'AdvertiseController');
Route::controller('adbreak', 'AdbreakController');
Route::controller('adlog', 'AdlogController');
Route::controller('brand', 'BrandController');
Route::controller('billing', 'BillingController');
Route::controller('permission', 'PermissionController');
Route::controller('payment', 'PaymentController');
Route::controller('profile', 'ProfileController');
Route::controller('report', 'ReportController');
