@extends('layouts.app') @section('content')
<section class="row m-b-md">

	<div class="col-md-12">
		<h3 class="m-b-xs text-black">Deal Wise Telecast</h3>
	</div>

</section>
<section class="row m-b-md">

	{{Form::open(array('url' => ' ','id'=>'schedule-form', 'method' => 'post'))}}
	<div class="col-md-2">
		<input class="form-control"
				id="deal_id" name="deal_id" placeholder="Deal id"></input>
	</div>
		<div class="col-md-3">
			<input class="form-control"
					id="from_date" name="from_date" placeholder="from date"></input>

		</div>
		<div class="col-md-3">
			<input class="form-control"
				id="to_date" name="to_date" placeholder="to date"></input>
		</div>


	{{ Form::close()}}

	<div class="col-md-2">

		<button type="button" class="btn btn-success btn-block" onclick="searchReport();"
			id="searchBtn">Search</button>
	</div>
	<div class="col-md-2">

		<button class="btn btn-icon b-2x btn-danger btn-rounded"
			id="excel">

			<i class="fa fa-download "></i>
		</button>
	</div>

</section>

<section class="row m-b-md">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-3">
			<h4 class="m-b-xs text-success" id="schedule_spot">Schedule Spot: 0</h4>
		</div>
		<div class="col-md-3">
			<h4 class="m-b-xs text-danger" id="missed_spot">Missed Spot: 0</h4>
		</div>
		<div class="col-md-3">
			<h4 class="m-b-xs text-info" id="extra_spot">Extra Spot: 0</h4>
		</div>
	</div>
	<div class="col-md-12">
			<div class="panel-body">
				<table class="table table-striped m-b-none">
					<thead>
						<tr>
							<th>Date</th>
							<th>Ad Id</th>
							<th>Deal id</th>
							<th>Caption</th>
							<th>Telecast Time</th>
							<th>Remarks</th>
							<th>Duration</th>
							<th>Rate</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody id="deal_wise_report"></tbody>
				</table>
			</div>

	</div>
</section>

{{HTML::script('packages/script/dealwisetelecast.js');}} @stop
