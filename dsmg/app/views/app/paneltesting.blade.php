@extends('layouts.app') @section('content')

<div class="row">
			<div class="col-md-10">
				<h3>Panel Testing
						</h3>
			</div>
			<div class="col-md-2 pull-right">
				<label></label>
				<button type="button" onclick="showReport();" id="reportBtn" class="btn btn-info btn-block">Report</button>
			</div>
</div>
{{Form::open(array('url' => ' ','id'=>'paneltesting-form','class'=>'form-horizontal' , 'method' => 'post'))}}
<div class="row" id="paneltesting-form">
				<div class="col-md-2">
					<label class="small">Station/LC Gate</label>
						<div class="form-group">
							<select class="form-control" id="station_id" name="station_id"></select>
				</div>
			</div>

				<div class="col-md-2">
					<label class="small">Role</label>
								<select class="form-control" id="role"
									name="role" onchange="choosingRole()">
										<option value="Officer">Officer</option>
										<option value="Supervisor">Supervisor</option>
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
						<label class="small">Panel testing date</label>
						<input type="text" class="form-control" name="testing_date" id="testing_date">
					</div>
					<div class="col-md-2">
						<label></label>
						<button type="button" onclick="saveData();" id="saveBtn" class="btn btn-success btn-block">save</button>
					</div>

</div>
{{ Form::close()}}
<div class="row" id="ledger_table">
			<div class="col-md-12">
				<label id="table_level">Panel testing ledger</label>
				<div class="table-responsive">
					<table id="jp_xing_table" class="table table-hover table-bordered" border="1" cellpadding="5" cellspacing="0">
						<thead id="table_header">

						</thead>
						<tbody id="data_list"></tbody>
					</table>
				</div>
			</div>
</div>
<div  id="report_table">
		<div class="row">
			<div class="col-md-10">
			</div>
			<div class="col-md-2">
				<div class="btn-group">
			   <button type="button" class="btn btn-danger" id="print_report"><i class="fa fa-print"></i></button>
			   <button type="button" class="btn btn-warning" id="excel_report"><i class="fa fa-download"></i></button>
			 </div>
			</div>
		</div>
<div class="row">
			<div class="col-md-12">
				<h5><span class="label label-danger">Panel Testing report</span></h5>
				<div class="table-responsive">
					<table id="panel_testing_report" class="table table-hover table-bordered" border="1" cellpadding="5" cellspacing="0">
						<thead id="table_header">
							<tr>
								<th rowspan="2">Station/LC Gate</th>
								<th rowspan="2">Last testing date</th>
								<th colspan="2">Panel testing done by</th>
								<th rowspan="2">Next panel testing date</th>
								<th rowspan="2">Days remaining</th>
							</tr>
							<tr>
								<th>Officer</th>
								<th>Supervisor</th>

							</tr>
						</thead>
						<tbody id="data_report"></tbody>
					</table>
				</div>
			</div>
			</row>
</div>
{{HTML::script('packages/script/paneltesting.js');}} @stop
