@extends('layouts.app') @section('content')

<div class="row">
			<div class="page-header">
				<h3>Panel Testing
						</h3>
			</div>
</div>
{{Form::open(array('url' => ' ','id'=>'crossing-form','class'=>'form-horizontal' , 'method' => 'post'))}}
<div class="row" id="crossing-form">
				<div class="col-md-2">
					<label class="small">Station/LC Gate</label>
						<div class="form-group">
							<select class="form-control" id="station_id" name="station_id"></select>
				</div>
			</div>

				<div class="col-md-2">
					<label class="small">Type</label>
								<select class="form-control" id="role"
									name="role">
										<option value="TC">Tail cable</option>
										<option value="MC">Main Cable</option>
								</select>
				</div>
				<div class="col-md-2">
					<label class="small">Designation</label>
					<select class="form-control" id="designation" name="designation"></select>

				</div>
				<div class="col-md-2">
					<label class="small">Name</label>
				<select class="form-control" id="maintenance_by" name="maintenance_by"></select>
				</div>
					<div class="col-md-2">
						<label class="small">Inspection Date</label>
						<input type="text" class="form-control" name="inspection_date" id="inspection_date">
					</div>
					<div class="col-md-2">
						<label></label>
						<button type="button" onclick="saveData();" id="saveBtn" class="btn btn-success btn-block">save</button>
					</div>

</div>
{{ Form::close()}}
<div class="row">
			<div class="col-md-12">
				<label id="table_level">Inspection ledger</label>
				<div class="table-responsive">
					<table id="jp_xing_table" class="table table-hover table-bordered" border="1" cellpadding="5" cellspacing="0">
						<thead id="table_header">

						</thead>
						<tbody id="data-list"></tbody>
					</table>
				</div>
			</div>
</div>

{{HTML::script('packages/script/paneltesting.js');}} @stop