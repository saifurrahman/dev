@extends('layouts.app') @section('content')

<section class="row m-b-md">
	<div class="col-md-4">
		<h3 class="m-b-xs text-black">Commercial Schedule</h3>
	</div>
	{{Form::open(array('url' => ' ','id'=>'schedule-form', 'method' => 'post'))}}
	<div class="col-md-2">
		<label></label> <input type="number" name="deal_id" id="deal_id" placeholder="Deal Id" class="form-control">
	</div>
	<div class="col-md-2">
		<label></label>
		<button id="sBtn"
			class="btn btn-success form-control">Search</button>

	</div>

	<div class="col-md-2">
		<label></label>
		<input type="text" class="form-control" name="no_of_spot"
			id="no_of_spot" readonly="readonly">

	</div>


	{{ Form::close()}}
</section>
<section class="row m-b-md">
	<div class="col-md-4">
	<input type="text" class="form-control"
		id="schedule_date" name="schedule_date"
		placeholder="choose date" readonly="true">
		</div>
		<div class="col-md-4">
		<select id="ad_id" class="form-control"></select>
	</div>
	<div class="col-md-2">

		<button id="saveScheduleBtn"
			class="btn btn-danger form-control">Save Schedule</button>

	</div>
</section>
<section class="row m-b-md">
	<div class="col-md-4">
		<table class="table table-striped m-b-none table-bordered">
		<thead>
			<tr>
				<th>Schedule Date</th>
				<th>Spots</th>
				<th>Duration</th>

			</tr>
		</thead>
		<tbody id="schedule_spots">
		</tbody>
	</table>
	</div>
	<div class="col-md-4">
		<table class="table table-striped m-b-none table-bordered">
		<thead>
			<tr>
				<th>TimeSlot</th>
				<th>Break1</th>
				<th>Break2</th>
				<th>Break3</th>

			</tr>
		</thead>
		<tbody id="time_slot">

		</tbody>
	</table>
	</div>
	<div class="col-md-4" id="deal_details">

	</div>

</section>

{{HTML::script('packages/script/new_schedule.js');}} @stop
