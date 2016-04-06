@extends('layouts.app') @section('content')
<section class="row m-b-md">

	<div class="col-sm-4">
		<h3 class="m-b-xs text-black">Schedule Vs Telecast</h3>
	</div>
	{{Form::open(array('url' => ' ','id'=>'schedule-form', 'method' => 'post'))}}
	<div class="col-md-2">
		<label></label>
		<input type="text" class="form-control"
			id="from_date" name="from_date"
			placeholder="from date">
	</div>
	<div class="col-md-2">
		<label></label>
		<input type="text" class="form-control"
			id="to_date" name="to_date"
			placeholder="to date">
	</div>
	<div class="col-md-2">
				<label></label>
		<button type="button" class="btn btn-success btn-block" onclick="searchReport();"
			id="searchBtn">Search</button>
	</div>
			{{ Form::close()}}
	<div class="col-md-2 text-right">

		<label></label>
<button type="button" class="btn btn-danger btn-block" onclick="saveSchedule();"
	id="saveBtn">Save Schedule</button>

	</div>

</section>

<section class="row m-b-md">
	<div class="col-md-12">
			<div class="panel-body">
				<table class="table table-striped m-b-none">
					<thead>
						<tr>
							<th>Ad Id</th>
							<th>Deal id</th>
							<th>Time Slot</th>
							<th>Time Stamp</th>
							<th>Action</th>

						</tr>
					</thead>
					<tbody id="scvstc_report_table"></tbody>
				</table>
			</div>

	</div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body" id="telecasttime">

      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
{{HTML::script('packages/script/scvstc_report.js');}} @stop
