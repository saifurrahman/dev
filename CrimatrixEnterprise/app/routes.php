<?php
//auth not need
Route::get('/', function()
{
	return Redirect::to('hotel');
});

Route::get('hotel', 'HomeController@homePage');
Route::get('hotel/about', 'HomeController@aboutPage');
Route::get('hotel/contact', 'HomeController@contactPage');

Route::get('hotel/reset/{token}', 'HomeController@getReset');
//auth need
Route::get('hotel/guestlist', 'HomeController@getGuestlist');
Route::get('hotel/profile', 'HomeController@getProfile');
Route::get('hotel/reports', 'HomeController@getReports');

//controllers (auth functions)
Route::controller('hotel/users', 'UsersController');
Route::controller('hotel/guest', 'GuestController');
Route::controller('hotel/admin', 'AdminController');
//api
Route::controller('hotel/police', 'PoliceController');
Route::controller('hotel/cron', 'CronController');