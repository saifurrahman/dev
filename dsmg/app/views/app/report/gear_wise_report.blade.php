@extends('layouts.app') @section('content')
<div class="row">
			<div class="page-header">
				<h3>Gear Wise Maintenance Report</h3>
			</div>
</div>
{{Form::open(array('url' => ' ','id'=>'gear_wise_report_form','class'=>'form-horizontal' , 'method' => 'post'))}}

<div class="row" id="gear_wise_report_form">
		<div class="col-md-2">
			<select id="select_station_id" name="station_id[]" multiple class="form-control" placeholder="Select Station"></select>

		</div>
		<div class="col-md-2">
					 <select  id="gear_code" name="gear_code[]" multiple class="form-control" placeholder="Gear Code"></select>
		</div>

	  <div class="col-md-2">
		       <input type="text" class="form-control" id="from_date" name="from_date" placeholder="From Date">
	  </div>
	  <div class="col-md-2">
		       <input type="text" class="form-control" id="to_date" name="to_date" placeholder="To Date">
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
                  </tr>
                </thead>
                <tbody id="data-list"></tbody>
              </table>
            </div>
          </div>
        </div>
</div>
{{HTML::script('packages/script/reports/gear_wise_maintainance_report.js');}} @stop
