@extends('layouts.app') @section('content')

<div class="row">
			<div class="page-header">
				<h3>Joint Point and Crossing Inspection	</h3>
			</div>
</div>
{{Form::open(array('','id'=>'crossing-form','class'=>'form-horizontal'))}}
<div class="row" id="crossing-form">
				<div class="col-md-3">
					<label class="small">Station</label>
						<div class="form-group">
							<select class="form-control" id="station_id" name="station_id"></select>
				</div>
			</div>

				<div class="col-md-3">
					<label class="small">Inspection By</label>
								<select class="form-control" id="role"
									name="role">
										<option value="SS">SS</option>
										<option value="IC">IC</option>
									</select>
				</div>

					<div class="col-md-3">
						<label class="small">Inspection Date</label>
						<input type="text" class="form-control" name="inspection_date" id="inspection_date">
					</div>
					<div class="col-md-1">
						<label></label>
						<button type="button" onclick="saveData();" id="saveBtn" class="btn btn-success btn-block">save</button>
					</div>
					<div class="col-md-2">
						<label></label>
						<button type="button" onclick="overdueStation();" id="saveBtn" class="btn btn-danger btn-block">overdue station</button>
					</div>
{{ Form::close()}}
</div>
<div class="row">
			<div class="col-md-12">
				<label>Inspection ledger</label>
				<div class="table-responsive">
					<table id="data-entry-table" class="table table-hover table-bordered table-striped table-condensed">
						<thead>
							<tr>
								<th>Station Code</th>
								<th>Role</th>
								<th>Last Inspection Date</th>
								<th>Next Inspection Date Due</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody id="data-list"></tbody>
					</table>
				</div>
			</div>
</div>

{{HTML::script('packages/script/crossing.js');}} @stop
