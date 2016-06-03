@extends('layouts.app') @section('content')

<div class="row">
			<div class="col-md-10">
				<h3>Cable Meggering
						</h3>
					</div>
						<div class="col-md-2" style=" align-right">
							<label></label>
							<button type="button" onclick="showReport();" id="reportBtn" class="btn btn-info btn-block">Report</button>
						</div>
</div>
{{Form::open(array('url' => ' ','id'=>'crossing-form','class'=>'form-horizontal' , 'method' => 'post'))}}
<div class="row" id="crossing-form">
				<div class="col-md-3">
					<label class="small">Station/LC Gate</label>
						<div class="form-group">
							<select class="form-control" id="station_id" name="station_id"></select>
				</div>
			</div>

			<div class="col-md-3">
				<label class="small">Type</label>
							<select class="form-control" id="type"
								name="type">
									<option value="TC">Tail cable</option>
									<option value="MC">Main Cable</option>
							</select>
			</div>
					<div class="col-md-2">
						<label class="small">Date</label>
						<input type="text" class="form-control" name="inspection_date" id="inspection_date">
					</div>
					<div class="col-md-2">
						<label class="small">Remark</label>
					<input type="text" class="form-control" id="remarks" name="remarks"></input>
					</div>
					<div class="col-md-2">
						<label></label>
						<button type="button" onclick="saveData();" id="saveBtn" class="btn btn-success btn-block">save</button>
					</div>

</div>
{{ Form::close()}}
<div class="row" id="ledger_table">
			<div class="col-md-12">
				<label id="table_label">Cable Meggering ledger</label>
				<div class="table-responsive">
					<table id="cable_meggering_ledger" class="table table-hover table-bordered" border="1" cellpadding="5" cellspacing="0">
						<thead id="table_header">
							<tr>
								<th>Station/LC Gate</th>
								<th>Type</th>
								<th>Last meggering date</th>
								<th>Next meggering date due</th>
								<th>Days remaining</th>
								<th>Remarks</th>
								<th>Delete</th></tr>
						</thead>
						<tbody id="data-list"></tbody>
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
				<label id="table_label">Cable Meggering Report</label>
				<div class="table-responsive">
					<table id="cable_meggering_report" class="table table-hover table-bordered" border="1" cellpadding="5" cellspacing="0">
						<thead id="table_header">
							<tr>
								<th rowspan="2">Station/LC Gate</th>
								<th colspan="2">Last Date of Cable Meggering</th>
								<th colspan="2">Due Date of Cable Meggering	e</th>
								<th colspan="2">Days remaining</th>
							</tr>
							<tr>
								<th>Tail cable</th>
								<th>Main cable</th>
								<th>Tail cable</th>
								<th>Main cable</th>
								<th>Tail cable</th>
								<th>Main cable</th>
								
							</tr>
						</thead>
						<tbody id="data_report"></tbody>
					</table>
				</div>
			</div>
			</row>
</div>
{{HTML::script('packages/script/cablemeggering.js');}} @stop
