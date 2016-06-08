@extends('layouts.app') @section('content')

<div class="row">
			<div class="col-md-11">
				<h3>Foot plate inspection
						</h3>
					</div>
					
</div>
{{Form::open(array('url' => ' ','id'=>'crossing-form','class'=>'form-horizontal' , 'method' => 'post'))}}
<div class="row" id="crossing-form">
				<div class="col-md-1">
							<label class="small">Train No</label>
							<div class="form-group">
								<input type="text" class="form-control" id="train_no" name="train_no"></input>
							</div>
				</div>
				<div class="col-md-1">
							<label class="small">From Sec</label>
							<div class="form-group">
									<select class="form-control" id="from_station" name="from_station"></select>
							</div>
				</div>
				<div class="col-md-1">
							<label class="small">To Sec</label>
							<div class="form-group">
								<select class="form-control" id="to_station" name="to_station"></select>
							</div>
				</div>

				<div class="col-md-2">
						<label class="small">Date</label>
						<input type="text" class="form-control" name="inspection_date" id="inspection_date">
				</div>
				<div class="col-md-2">
								<label class="small">Shift</label>
								<select class="form-control" id="shift" name="shift">
										<option value="Day">Day</option>
										<option value="Night">Night</option>
								</select>
				</div>

					<div class="col-md-2">
						<label class="small">Name</label>
						<select class="form-control" id="inspection_by" name="inspection_by"></select>
					</div>
					<div class="col-md-2">
						<label class="small">Desig.</label>
							<select class="form-control" id="designation" name="designation"></select>
					</div>
					<div class="col-md-1">
						<label></label>
						<button type="button" onclick="saveData();" id="saveBtn" class="btn btn-success">save</button>
					</div>

</div>
{{ Form::close()}}
<div class="row" id="ledger_table">
			<div class="col-md-12">
				<label id="table_label" class="label label-success">Foot plate inspection ledger</label>
				<div class="table-responsive">
					<table id="cable_meggering_ledger" class="table table-hover table-bordered" border="1" cellpadding="5" cellspacing="0">
						<thead id="table_header">
							<tr>
								<th>Train No</th>
								<th>Section From </th>
								<th>Section To </th>
								<th>Inspection by</th>
								<th>Date of inspection</th>
								<th>Day/Night</th>
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
				<label id="table_label" class="label label-danger">Foot plate inspection report</label>
				<div class="table-responsive">
					<table id="cable_meggering_report" class="table table-hover table-bordered" border="1" cellpadding="5" cellspacing="0">
						<thead id="table_header">
							<tr>
								<th rowspan="2">Train No</th>
								<th colspan="2">Section</th>
								<th rowspan="2">Inspection by</th>
								<th rowspan="2">Last date of inspection</th>
								<th rowspan="2">Day/Night</th>
							</tr>
							<tr>
								<th>From</th>
								<th>To</th>

							</tr>
						</thead>
						<tbody id="data_report"></tbody>
					</table>
				</div>
			</div>
			</row>
</div>
{{HTML::script('packages/script/foot_plate_inspection.js');}} @stop
