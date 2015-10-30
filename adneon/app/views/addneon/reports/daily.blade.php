@extends('layouts.app') @section('content')
<section class="row m-b-md">
	<div class="col-sm-6">
		<h3 class="m-b-xs text-black">Daily Report</h3>
	</div>
	<div class="col-md-2">
		<input type="text" class="form-control"
			id="schedule_date" name="schedule_date"
			placeholder="Choose Date">
	</div>
	<div class="col-sm-6 text-right text-left-xs m-t-md">
		<div class="btn-group">
			<button class="btn btn-icon b-2x btn-default btn-rounded  "
				id="excel">
				<i class="fa fa-download "></i>
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
							<th>Type</th>
							<th>Spots</th>
							<th>Rate</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody id="daily-table"></tbody>
				</table>
			</div>
		</section>
	</div>
</div>
{{HTML::script('packages/script/daily_report.js');}} @stop
