 @extends('layouts.app') @section('content')
<section class="row m-b-md">
	<div class="col-sm-6">
		<h3 class="m-b-xs text-black">Dashboard</h3>
	</div>

</section>
<div class="row">


</div>
<div class="row">
	<div class="col-sm-6">
	   <section class="panel panel-default">
			<header class="panel-heading font-bold">Monthly Deals</header>
			<canvas id="monthly_deals" height="100%"></canvas>
	   </section>
	</div>
	<div class="col-sm-6">
		<section class="panel panel-default">
			<header class="panel-heading font-bold" >Daily FCT Schedule Amount<p id="total_amount"></p></header>
        	{{Form::open(array('','id'=>'advertise-form','class'=>'form-horizontal'))}}
      <select name="month" id="month_select">
        <option value="10">Oct</option>
        <option value="09">Sep</option>
        <option value="08">Aug</option>
      </select>
      	{{ Form::close()}}
        <div id="daily_schedule_canvas">
      	</div>
		 </section>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
	   <section class="panel panel-default">
			<header class="panel-heading font-bold">Monthly Bills</header>
			<canvas id="monthly_bills" height="250"></canvas>
	   </section>
	</div>
	<div class="col-sm-6">
		<section class="panel panel-default">
			<header class="panel-heading font-bold">Current month deals</header>
			<canvas id="monthly_executive_deals"  height="250"></canvas>
			<div id="js-legend" class="chart-legend"></div>
	   </section>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
	   <section class="panel panel-default">
			<header class="panel-heading font-bold">Location wise deals</header>
			<canvas id="location_deals" height="250"></canvas>
	   </section>
	</div>
	<div class="col-sm-6">
		<section class="panel panel-default">
			<header class="panel-heading font-bold">Monthly Payments</header>
			<canvas id="monthly_payments"  height="250"></canvas>
	   </section>
	</div>
</div>
{{HTML::script('packages/script/dashboard.js');}} @stop
