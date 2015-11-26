@extends('layouts.app') @section('content')

<div class="row">
			<div class="page-header">
				<h3>Joint Point and X-ing Inspection	</h3>
			</div>
</div>
{{Form::open(array('url' => ' ','id'=>'crossing-form','class'=>'form-horizontal' , 'method' => 'post'))}}
<div class="row" id="crossing-form">
				<div class="col-md-2">
					<label class="small">Station</label>
						<div class="form-group">
							<select class="form-control" id="station_id" name="station_id"></select>
				</div>
			</div>

				<div class="col-md-2">
					<label class="small">Role</label>
								<select class="form-control" id="role"
									name="role">
										<option value="JE/Signal">JE/Signal</option>
										<option value="SSE/IC/Signal">SSE/IC/Signal</option>
									</select>
				</div>
				<div class="col-md-3">
					<label class="small">Designation</label>
					<select class="form-control" id="designation" name="designation"></select>

				</div>

					<div class="col-md-2">
						<label class="small">Inspection Date</label>
						<input type="text" class="form-control" name="inspection_date" id="inspection_date">
					</div>
					<div class="col-md-1">
						<label></label>
						<button type="button" onclick="saveData();" id="saveBtn" class="btn btn-success btn-block">save</button>
					</div>
					<div class="col-md-2">
						<label></label>
						<button type="button" onclick="overdueStation();" id="overdueBtn" class="btn btn-danger btn-block">overdue station</button>
					</div>

</div>
{{ Form::close()}}
<div class="row">
			<div class="col-md-12">
				<label id="table_level">Inspection ledger</label>
				<div class="table-responsive">
					<table id="data-entry-table" class="table table-hover table-bordered table-striped table-condensed">
						<thead id="table_header">

						</thead>
							{{Form::open(array('url' => ' ','id'=>'del-form','class'=>'form-horizontal' , 'method' => 'post'))}}
						<tbody id="data-list"></tbody>
						{{ Form::close()}}
					</table>
				</div>
			</div>
</div>

{{HTML::script('packages/script/crossing.js');}} @stop
