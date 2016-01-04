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
<div class="row">
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
										<th>Last Maintenance Date</th>
                    <th>Due Date</th>
                    <th>Disc. applied</th>
                    <th>Maintenance By</th>
										  <th>Remarks</th>
                  </tr>
                </thead>
                <tbody id="data-list"></tbody>
              </table>
            </div>
          </div>
        </div>
</div>
{{HTML::script('packages/script/reports/overdue_gear_report.js');}} @stop
