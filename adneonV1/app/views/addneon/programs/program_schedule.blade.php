@extends('layouts.app') @section('content')
<section class="row m-b-md">
	<div class="col-sm-6">
		<h3 class="m-b-xs text-black">Program schedule</h3>
	</div>
</section>
<div class="row">
	<div class="col-md-12">
		<section class="panel panel-default">
			<header class="panel-heading font-bold">Schedule Program</header>
			<div class="panel-body">
				{{Form::open(array('','id'=>'schedule-form'))}}
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<div class="row">
								<div class="col-md-6">
									<label>Select Program</label> <select class="form-control"
										id="program_id" name="program_id">
									</select>
								</div>

								<div class="col-md-6">
									<label>Time Slot</label> <select class="form-control"
										name="time_slot_id" id="time_slot_id">

									</select>
								</div>
							</div>
						</div>
						<div class="form-group ">
							<div class="row">
								<div class="col-md-6">
									<label>Start Date</label> <input type="text"
										class="form-control" name="start_date" placeholder="click to choose" id="start_date">
								</div>
								<div class="col-md-6">
									<label>End Date</label> <input type="text" class="form-control"
										name="end_date" placeholder="click to choose" id="end_date">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Days</label> <select class="form-control" id="days"
								name="days[]" multiple="multiple">
								<option value="">select</option>
								<option value="MON">Monday</option>
								<option value="TUE">Tuesday</option>
								<option value="WED">Wednessday</option>
								<option value="THU">Thursday</option>
								<option value="FRI">Friday</option>
								<option value="SAT">Saturday</option>
								<option value="SUN">Sunday</option>
							</select>
						</div>
						<div class="form-group">
							<label>Repeat</label>
							<div class="radio i-checks ">
								<label> <input type="radio" name="repeat" value="1" checked> <i></i>
									Yes
								</label>
							</div>

							<div class="radio i-checks ">
								<label> <input type="radio" name="repeat" value="0"> <i></i> No
								</label>
							</div>
						</div>
						<div class="form-group">
							<button class="btn btn-success" id="saveBtn"
								onclick="saveSchedule();">submit</button>
						</div>
					</div>
				</div>
				{{ Form::close()}}
			</div>
		</section>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<section class="panel panel-default">
			<table class="table table-striped m-b-none">
				<thead>
					<tr>
						<th>Time Slot</th>
						<th>Program Name</th>
						<th>Days</th>
						<th>Duration</th>
						<th>Repeat</th>
					</tr>
				</thead>
				<tbody id="log-list"></tbody>
			</table>
		</section>
	</div>
</div>
{{HTML::script('packages/script/schedule.js');}} @stop
