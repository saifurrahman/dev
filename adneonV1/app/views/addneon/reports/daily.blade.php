@extends('layouts.app') @section('content')
<section class="row m-b-md">

	<div class="col-sm-6">
		<h3 class="m-b-xs text-black">Daily Report</h3>
	</div>
	{{Form::open(array('url' => ' ','id'=>'schedule-form', 'method' => 'post'))}}
	<div class="col-md-4">
		<label></label>
		<input type="text" class="form-control"
			id="schedule_date" name="schedule_date"
			placeholder="Choose Date">
	</div>
			{{ Form::close()}}
	<div class="col-md-2 text-right">
		<label></label>
		<div class="btn-group">
			<button class="btn btn-icon b-2x btn-danger btn-rounded"
				id="excel">
				<i class="fa fa-download"></i>
			</button>
		</div>
	</div>

</section>

<div class="row">
	<div class="col-md-12">
		<section class="panel panel-default">

			<div class="panel-body">
				<table class="table table-striped m-b-none">
					<thead>
						<tr>
							<th>Sl no</th>
							<th>Caption</th>
							<th>Client</th>
							<th>Agency</th>
							<th>Executive</th>
							<th>Time Slot</th>
							<th>Duration</th>
							<th>Rate</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody id="daily_report_table"></tbody>
				</table>
			</div>
		</section>
	</div>
</div>
{{HTML::script('packages/script/daily_report.js');}} @stop
