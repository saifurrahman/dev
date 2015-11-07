@extends('layouts.app') @section('content')

<div class="row">
			<div class="col-md-12">
				<h3>Overdue Gear Report</h3>
			</div>
</div>
{{Form::open(array('','id'=>'overdue-form','class'=>'form-horizontal'))}}
<div class="row">
<div class="col-md-6">
						 <select id="select_station_id" name="station_id[]" multiple class="form-control" placeholder="Select Station"></select>
					 </div>

	 <div class="col-md-3">
		 <button type="button" class="btn btn-default pull-right" onclick="get_maintenance_reports();">Search</button>
	 </div>
</div>
{{ Form::close()}}
<div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="maintenance_reports">
                <thead>
                  <tr>
                    <th>Station Code</th>
                    <th>Gear Code</th>
                    <th>Gear No</th>
                    <th>Schedule Code/Role</th>
                    <th>Last Maintenance Date</th>
                    <th>Discontinuation Applied</th>
                    <th>Maintenance By</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
</div>
{{HTML::script('packages/script/reports/overdue_gear_report.js');}} @stop
