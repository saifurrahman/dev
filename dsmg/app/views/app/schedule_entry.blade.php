@extends('layouts.app') @section('content')
<div class="row">
	<div class="col-md-12">
		<h3>Gear Maintainace</h3>
	</div>
</div>
{{Form::open(array('','id'=>'schedule-form','class'=>'form-horizontal'))}}
<div class="row">
			<div class="col-md-3">
				<input type="text" class="form-control" id="maintenance_date"
					name="maintenance_date" placeholder="Maintenance Date">
			</div>
			<div class="col-md-1 col-md-offset-8">
				<button type="button" title="click to download as a excel" class="btn btn-default cmn_btn"
					id="excel">
					<i class="fa fa-download text-danger-dk"></i>
				</button>
			</div>
</div>

<div class="row" id="schedule-form">
				<div class="col-md-2">
					<label class="small">Station</label>
						<div class="form-group">
							<select class="form-control" id="station_id" name="station_id"></select>
				</div>
			</div>

				<div class="col-md-3">
						<label class="small">Gear code</label>
						<div class="form-group">
							<div class="input-group">
								<select class="form-control" id="gear_code" name="gear_code"></select>
								<span class="input-group-addon">-</span>
								<select class="form-control" id="station_gear_id"
									name="station_gear_id"></select>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						<label class="small">Schedule code</label>
							<div class="input-group">
								<select class="form-control" id="schedule_code_id" name="schedule_code_id"></select>
								<span class="input-group-addon">-</span>
								<select class="form-control" id="role"
									name="role">
										<option value="SS">SS</option>
										<option value="IC">IC</option>
									</select>
							</div>
						</div>
					</div>
					<div class="col-md-1">
						<label class="small">Disc. app</label>
							<select class="form-control" id="discontinuation_status" name="discontinuation_status">
								<option value="Yes">Y</option>
								<option value="No">N</option>
							</select>
					</div>
					<div class="col-md-2">
						<label class="small">Maintained by</label>
						<input type="text" class="form-control" name="maintenance_by" id="maintenance_by">
					</div>
					<div class="col-md-1">
						<label></label>
						<button type="button" onclick="saveData();" id="saveBtn" class="btn btn-success btn-block">save</button>
					</div>
					{{ Form::close()}}
</div>
<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="data-entry-table" class="table table-hover table-bordered table-striped table-condensed">
						<thead>
							<tr>
								<th>Station Code</th>
								<th>Gear Code</th>
								<th>Gear No.</th>
								<th>Schedule Code</th>
								<th>Designation</th>
								<th>Next Maintainance Date</th>
								<th>Disc app.</th>
								<th>Maintained by</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody id="data-list"></tbody>
					</table>
				</div>
			</div>
</div>
{{HTML::script('packages/script/schedule_entry.js');}} @stop
