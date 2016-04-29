 @extends('layouts.app') @section('content')
<section class="row m-b-md">
	<div class="col-md-6">
		<h3 class="m-b-xs text-black">Dashboard</h3>
	</div>

</section>
<section class="row m-b-md">
	<div class="col-md-12">
		<canvas id="myChart" width="400" height="100%"></canvas>
	</div>
</section>

{{HTML::script('packages/script/dashboard.js');}} @stop
