@extends('layouts.app') @section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Gear Maintenance</h3>
	</div>
</div>
{{Form::open(array('url' => ' ','id'=>'schedule-form','class'=>'form-horizontal' , 'method' => 'post'))}}
<div class="row">
			<div class="col-md-3">
					<label class="small">Date</label>
				<input type="text" class="form-control" id="maintenance_date"
					name="maintenance_date" placeholder="Maintenance Date">
			</div>
			<div class="col-md-2">
				<label class="small">Station</label>
					<div class="form-group">
						<select class="form-control" id="station_id" name="station_id"></select>
			</div>
		</div>
		<div class="col-md-2">
				<label class="small">Gear type</label>
				<div class="form-group">
						<select class="form-control" id="gear_code" name="gear_code"></select>
					</div>
			</div>
			<div class="col-md-2">
					<label class="small">Gear no</label>
					<div class="form-group" id="station_gear_div">
						<select multiple class="form-control" id="station_gear_id"
							name="station_gear_id[]" style="height:33px"></select>
									</div>
				</div>
			</div>

<div class="row">

				<div class="col-md-2">

								<label class="small">Schedule code</label>
								<select class="form-control" id="schedule_code_id" name="schedule_code_id"></select>
				</div>
				<div class="col-md-2">
					<label class="small">Role</label>
				<select class="form-control" id="role"	name="role">
										<option value="SS">SS</option>
										<option value="IC">IC</option>
										<option value="TSM">TSM</option>
									</select>
							</div>

					<div class="col-md-1">
						<label class="small">Disc.applied</label>
							<select class="form-control" id="discontinuation_status" name="discontinuation_status">
								<option value="Yes">Y</option>
								<option value="No">N</option>
							</select>
					</div>
					<div class="col-md-2">
						<label class="small">Desig</label>
							<select class="form-control" id="designation" name="designation"></select>

					</div>
					<div class="col-md-2">
						<label class="small">Name</label>
					<select class="form-control" id="maintenance_by" name="maintenance_by"></select>
					</div>
					<div class="col-md-2">
						<label class="small">Remark</label>
					<input type="text" class="form-control" id="remarks" name="remarks"></input>
					</div>
					<div class="col-md-1">
						<label></label>
						<button type="button" onclick="saveData();" id="saveBtn" class="btn btn-success btn-block">save</button>
					</div>

</div>
{{ Form::close()}}
<br>
<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="data-entry-table" class="table table-hover table-bordered table-striped table-condensed">
						<thead>
							<tr>
								<th>Station Code</th>
								<th>Gear Code</th>
								<th>Gear No.</th>
								<th>Sch. code/Role</th>
								<th>Due date</th>
								<th>Disc.applied</th>
								<th>Maintenance by</th>
								<th>Designation</th>
								<th>Remarks</th>
								<th>Delete</th>
							</tr>
						</thead>

						<tbody id="data-list"></tbody>

					</table>
				</div>
			</div>
</div>

{{HTML::script('packages/script/schedule_entry.js');}} @stop
