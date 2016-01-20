@extends('layouts.app') @section('content')
<section class="row m-b-md">
	<div class="col-sm-6">
		<h3 class="m-b-xs text-black">Telecast Report</h3>
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
			<header class="panel-heading bg-light"> </header>
			<div class="row wrapper">
				<div class="from-group">
				    {{Form::open(array('','id'=>'report-form'))}}
					<div class="col-md-12">
						<div class="col-md-3">
							<label>Client</label> <select class="form-control" id="client_id"
								name="client_id"></select>
						</div>
						<div class="col-md-3" hidden="true">
							<label>Deal</label> <select class="form-control" id="deal_id"
								name="deal_id"></select>
						</div>
						<div class="col-md-2">
							<label>From Date</label> <input type="text" class="form-control"
								name="from_date" id="from_date" placeholder="From Date"
								readonly="readonly">
						</div>
						<div class="col-md-2">
							<label>To Date</label> <input type="text" class="form-control"
								name="to_date" id="to_date" placeholder="To date"
								readonly="readonly">
						</div>
						<div class="col-md-2">
						      <label></label>
							<button type="button" class="btn btn-success btn-block" onclick="searchReport();"
								id="searchBtn"  >Search</button>
						</div>
					</div>
					{{ Form::close()}}
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-striped m-b-none" id="advertise-table">
					<thead>
						<tr>
							<th>Count</th>
							<th>Schedule Date</th>
							<th>Time Slot</th>
							<th>Break</th>
							<th>Ad ID</th>
							<th>Caption</th>
							<th class="text-center">Duration <small>(in secs.)</small></th>
							<th>Telecast Time</th>
						</tr>
					</thead>
					<tbody id="schecdule_table"></tbody>
				</table>
			</div>
		</section>
	</div>
</div>
{{HTML::script('packages/script/schedule_tc_report.js');}} @stop
