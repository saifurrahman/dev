@extends('layouts.app') @section('content')
<section class="row m-b-md">

	<div class="col-md-12">
		<h3 class="m-b-xs text-black">Monthly Deals</h3>
	</div>

</section>
<section class="row m-b-md">

	{{Form::open(array('url' => ' ','id'=>'dealreport-form', 'method' => 'post'))}}
	<div class="col-md-2">
    <select class="form-control" id="month"
      name="month">
      <option value="04">Apr</option>
      <option value="05">May</option>
      <option value="06">Jun</option>
      <option value="07">Jul</option>
      <option value="08">Aug</option>
      <option value="09">Sep</option>
      <option value="10">Oct</option>
      <option value="11">Nov</option>
      <option value="12">Dec</option>
      <option value="01">Jan</option>
      <option value="02">Feb</option>
      <option value="03">Mar</option>

  </select>

	</div>
  <div class="col-md-2">
      <select class="form-control" id="year"
          name="year">
          <option value="2016">2016</option>
          <option value="2017">2017</option>
        </select>

  </div>
		<div class="col-md-2">
			<select class="form-control"
					id="executive_id" name="executive_id" placeholder="executive"></select>

		</div>
		<div class="col-md-3">
			<select class="form-control"
				id="item_id" name="item_id" placeholder="item"></select>
		</div>


	{{ Form::close()}}
  <div class="col-md-2">

    <button type="button" class="btn btn-success btn-block" onclick="searchReport();"
      id="searchBtn">Search</button>
  </div>
  <div class="col-md-1">

    <button class="btn btn-icon b-2x btn-danger btn-rounded"
      id="excel">

      <i class="fa fa-download "></i>
    </button>
  </div>

</section>

<section class="row m-b-md">
  <div class="col-md-12">
      <div class="panel-body">
        <table class="table table-striped m-b-none">
          <thead>
            <tr>
              <th>Sl No</th>
              <th>Client</th>
              <th>Agency</th>
              <th>Executive</th>
              <th>Property</th>
              <th>Units</th>
              <th>Rate</th>
              <th>Amount</th>

            </tr>
          </thead>
          <tbody id="monthlydeals_report"></tbody>
        </table>
      </div>

  </div>
</section>

{{HTML::script('packages/script/monthlydeals.js');}} @stop
