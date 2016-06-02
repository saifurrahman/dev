@extends('layouts.app') @section('content')

<div class="row">
			<div class="col-md-12">
				<h3>Overdue Gear Report</h3>
			</div>
</div>
{{Form::open(array('','id'=>'overdue-form','class'=>'form-horizontal' , 'method' => 'post'))}}
<div class="row">
		<div class="col-md-8">
			 <select id="select_station_id" name="station_id[]" multiple class="form-control" placeholder="Select Station"></select>
		</div>
	 <div class="col-md-2">
		 <button type="button" class="btn btn-success " onclick="get_maintenance_reports();">Search</button>
	 </div>

 <div class="btn-group">
  <button type="button" class="btn btn-danger" id="print_report"><i class="fa fa-print"></i></button>
  <button type="button" class="btn btn-warning" id="excel_report"><i class="fa fa-download"></i></button>
</div>


</div>
{{ Form::close()}}
<div class="row" id="overdue_table">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="maintenance_reports" border="1" cellpadding="5" cellspacing="0">
                <thead>
                  <tr>
                    <th>Station Code</th>
                    <th>Gear Code</th>
                    <th>Gear No</th>
                    <th>Schedule Code/Role</th>
										<th>Due Date</th>
                    <th>Maintenance History</th>
        				</tr>
                </thead>
                <tbody id="data-list"></tbody>
              </table>
            </div>
          </div>
        </div>
</div>

				<div class="row" id="history_table">
				        <div class="col-md-12">
									<h4 class="modal-title" id="model_title">Gear maintenance history</h4>
									<button type="button" class="btn-info text-right" id="back_btn" >Back</button>
				          <div class="box box-primary">
				            <div class="table-responsive">
				              <table class="table table-bordered table-hover">
				                <thead>
				                  <tr>
				                    <th>Schedule Code</th>
				                    <th>Role</th>
				                    <th>Maintenance periodicity</th>
				                    <th>Maintenance date</th>
														<th>Due maintenance date</th>
				                    <th>Maintenance by/designation</th>
				                    <th>Discontinuation Status</th>
														<th>Remarks</th>
				        				</tr>
				                </thead>
				                <tbody id="history_list"></tbody>
				              </table>
				            </div>
				          	</div>
				    </div>
</div>


{{HTML::script('packages/script/reports/overdue_gear_report.js');}} @stop
