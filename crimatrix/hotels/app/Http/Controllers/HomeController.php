<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\View;

class HomeController extends Controller {

			public function homePage()
			{
				return view('home.index');

			}
			public function aboutPage()
				{
					//$this->layout->content = view('home.about');
					return view('home.about')->with('name', 'Victoria');
				}

}
