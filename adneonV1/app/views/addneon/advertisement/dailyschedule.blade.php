@extends('layouts.app') @section('content')

<section class="row m-b-md">
  {{Form::open(array('url' => ' ','id'=>'schedule-form', 'method' => 'post'))}}
	<div class="col-md-4">
		<h3 class="m-b-xs text-black">Daily Schedule</h3>
	</div>
  <div class="col-md-4">
    <label></label>
  <input type="text" class="form-control"
    id="schedule_date" name="schedule_date"
    placeholder="choose date">
    </div>
    <div class="col-md-2">
  		<label></label>
  		<button id="dailyScheduleBtn"
  			class="btn btn-info form-control">Schedule</button>

  	</div>

	{{ Form::close()}}
  <div class="col-sm-1 text-right text-left-xs m-t-md">
    <div class="btn-group">
      <button class="btn btn-icon b-2x btn-default btn-rounded  "
        id="excel">
        <i class="fa fa-download "></i>
      </button>
    </div>
  </div>
  </section>
<section class="row m-b-md">
	<div class="col-md-12">
<table class="table table-striped m-b-none" id="advertise-table">
	<thead>
		<tr>
			<th hidden="true">Id</th>
			<th>Time Slot</th>
			<th>Break</th>
			<th>Ad ID</th>
			<th>Caption</th>
			<th class="text-center">Duration <small>(in secs.)</small></th>
			<th>Schedule Date</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody id="schecdule_table"></tbody>
</table>
</div>

</section>

{{HTML::script('packages/script/daily_schedule.js');}} @stop
