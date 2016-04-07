@extends('layouts.app') @section('content')

<section class="row m-b-md">
  {{Form::open(array('url' => ' ','id'=>'schedule-form', 'method' => 'post'))}}
	<div class="col-md-3">
		<h3 class="m-b-xs text-black">Daily Schedule</h3>
	</div>
  <div class="col-md-3">
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
    <div class="col-md-2">
      <label></label>
      <button id="dailyTcBtn"
        class="btn btn-success form-control">Telecast Time</button>

    </div>

	{{ Form::close()}}


  </section>
  <section class="row m-b-md">
  	<div class="col-md-6">
  			<input type="search" class="form-control" id="search" placeholder="search brand using name or client name"></input>
  	</div>
    <div class="col-md-2">

  	   <input type="text" class="form-control" name="no_of_spot"
  			id="no_of_spot" readonly="readonly">

  	</div>
    <div class="col-md-2">

      <button type="button" class="btn btn-danger form-control" id="update_tc" >Update Telecast</button>

    </div>

  </section>
<section class="row m-b-md" id="schedule_table">

	<div class="col-md-11">
<table class="table table-striped m-b-none" >
	<thead>
    <tr>
			<th>#</th>
      <th>Ad ID</th>
			<th>Caption</th>
      <th>Time Slot</th>
			<th>Break</th>
			<th class="text-center">Duration <small>(in secs.)</small></th>
			<th>Deal_id</th>
			<th>Delete</th>
		</tr>
	</thead>
	<tbody id="schecdule_table_row"></tbody>
</table>

</div>
<div class="col-md-1 btn-group">
  <button class="btn btn-icon b-2x btn-default btn-rounded"
    id="excel">
    <i class="fa fa-download "></i>
  </button>
</div>
</section>
<section class="row m-b-md" id="telecast_table">
	<div class="col-md-11">
		<table class="table table-striped table-hover">
			<thead>
				<tr>

          <th>Ad ID</th>
          <th>Caption</th>
          <th>Deal id</th>
          <th>Duration <small>(in secs.)</small></th>
          <th>TimeSlot</th>
          <th>Telecast Time</th>
          <th>Action</th>
				</tr>
			</thead>
			<tbody id="telecast_table_row"></tbody>
		</table>

</div>
<div class="col-sm-1 text-right text-left-xs m-t-md">
  <div class="btn-group">
    <input type="file" name="File Upload" id="upload_csv" accept=".csv"/>
  </div>
</div>
</section>
{{HTML::script('packages/script/daily_schedule.js');}} @stop
