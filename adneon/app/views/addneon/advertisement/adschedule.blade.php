@extends('layouts.app') @section('content')
<section class="row m-b-md">

	<div class="col-sm-10">
			<div class="col-md-4">
				<h3 class="m-b-xs text-black">Commercial Schedule</h3>
			</div>
			<div class="col-md-2">
				<label></label> <input type="text" class="form-control"
					id="schedule_date" name="schedule_date"
					placeholder="choose date">
			</div>
	</div>

	<div class="col-sm-1 text-right text-left-xs m-t-md">
		<div class="btn-group">
			<button class="btn btn-icon b-2x btn-default btn-rounded  "
				id="excel">
				<i class="fa fa-download "></i>
			</button>
		</div>
	</div>

	<div class="col-sm-1 text-right text-left-xs m-t-md">
	
		<div class="btn-group">
			<button class="btn btn-icon b-2x btn-primary btn-rounded hover "
				onclick="scheduleForm();" id="schBtn">
				<i class="fa fa-plus hover-rotate"></i>
			</button>
		</div>
	</div>
</section>
<div class="row" id="schedule-div">
	<div class="col-md-8">
		<section class="panel panel-default">

			<div class="panel-body">
				{{Form::open(array('','id'=>'adsch-form'))}}
				<div class="form-group"></div>
				<div class="form-group">

					<div class="row">
						<div class="col-md-6">
							<label> Deal</label> <select class="form-control" id="deal_id"
								name="deal_id"></select>
						</div>

						<div class="col-md-6">
							<label>Select Commercial</label> <select class="form-control"
								id="ad_id" name="ad_id"></select>
						</div>
					</div>
				</div>
				<div class="form-group" id="slot-div">
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th class="text-center">Time Slot</th>
										<th class="text-center">Break 1</th>
										<th class="text-center">Break 2</th>
										<th class="text-center">Break 3</th>
									</tr>
								</thead>
								<tbody id="time-break">
									<tr class="success" id="timeslot_1">
										<td class="timeslot">06:00-06:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="success" id="timeslot_2">
										<td class="timeslot">06:30-07:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="success" id="timeslot_3">
										<td class="timeslot">07:00-07:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="success" id="timeslot_4">
										<td class="timeslot">07:30-08:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="success" id="timeslot_5">
										<td class="timeslot">08:00-08:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="success" id="timeslot_6">
										<td class="timeslot">08:30-09:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="success" id="timeslot_7">
										<td class="timeslot">09:00-09:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="success" id="timeslot_8">
										<td class="timeslot">09:30-10:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="success" id="timeslot_9">
										<td class="timeslot">10:00-10:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="success" id="timeslot_10">
										<td class="timeslot">10:30-11:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="success" id="timeslot_11">
										<td class="timeslot">11:00-11:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="success" id="timeslot_12">
										<td class="timeslot">11:30-12:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="info" id="timeslot_13">
										<td class="timeslot">12:00-12:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="info" id="timeslot_14">
										<td class="timeslot">12:30-13:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="info" id="timeslot_15">
										<td class="timeslot">13:00-13:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="info" id="timeslot_16">
										<td class="timeslot">13:30-14:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="info" id="timeslot_17">
										<td class="timeslot">14:00-14:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="info" id="timeslot_18">
										<td class="timeslot">14:30-15:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="info" id="timeslot_19">
										<td class="timeslot">15:00-15:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="info" id="timeslot_20">
										<td class="timeslot">15:30-16:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="info" id="timeslot_21">
										<td class="timeslot">16:00-16:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="info" id="timeslot_22">
										<td class="timeslot">16:30-17:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="info" id="timeslot_23">
										<td class="timeslot">17:00-17:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="info" id="timeslot_24">
										<td class="timeslot">17:30-18:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="danger" id="timeslot_25">
										<td class="timeslot">18:00-18:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="danger" id="timeslot_26">
										<td class="timeslot">18:30-19:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="danger" id="timeslot_27">
										<td class="timeslot">19:00-19:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="danger" id="timeslot_28">
										<td class="timeslot">19:30-20:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="danger" id="timeslot_29">
										<td class="timeslot">20:00-20:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="danger" id="timeslot_30">
										<td class="timeslot">20:30-21:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="danger" id="timeslot_31">
										<td class="timeslot">21:00-21:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="danger" id="timeslot_32">
										<td class="timeslot">21:30-22:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="danger" id="timeslot_33">
										<td class="timeslot">22:00-22:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="danger" id="timeslot_34">
										<td class="timeslot">22:30-23:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="danger" id="timeslot_35">
										<td class="timeslot">23:00-23:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="danger" id="timeslot_36">
										<td class="timeslot">23:30-24:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="success" id="timeslot_37">
										<td class="timeslot">00:00-00:30</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
									<tr class="success" id="timeslot_38">
										<td class="timeslot">00:30-01:00</td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="1"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="2"></td>
										<td class="text-center"><input type="checkbox" name="chek"
											value="3"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-8">
							<input type="text" class="form-control" name="no_of_spot"
								id="no_of_spot" readonly="readonly">
						</div>
						<div class="col-md-4">
							<button type="button" id="sBtn"
								class="btn btn-success pull-right" onclick="saveSchedule();">Save</button>
						</div>
					</div>
				</div>

				{{ Form::close()}}

				<!-- 				
<!-- 				<div class="form-group"> -->
				<!-- 				    <label>Repeat Dates</label> -->
				<!-- 				    <input type="text" class="form-control" id="repeat_date" name="repeat_date"> -->
				<!-- 				</div> -->


			</div>
		</section>
	</div>
	<div class="col-md-4">
		<section class="panel " id="deal-panel">
			<div class="panel-body">
				<div class="row text-justify" id="deal-details"></div>
			</div>
		</section>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<header class="panel-heading bg-light"> </header>
		<div class="row wrapper">
			<div class="col-md-4">
				<input type="search" class="form-control" id="search"
					placeholder="search..."></input>
			</div>
			<div class="col-md-6">
			<span class="label label-warning" id="total_spots"></span> 
			<span	 class="label label-success" id="total_duration"></span>
			</div>
			
		</div>
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
</div>

{{HTML::script('packages/js/jquery-ui.multidatespicker.js');}}
{{HTML::script('packages/script/adsch.js');}} @stop
