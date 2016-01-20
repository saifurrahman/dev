@extends('layouts.app') @section('content')

<div class="row">
			<div class="page-header">
				<h3> Joint Point and X-ing Inspection Overdue report
						</h3>
			</div>
</div>
{{Form::open(array('url' => ' ','id'=>'overdue_on_form','class'=>'form-horizontal' , 'method' => 'post'))}}
<div class="row">
	<div class="col-md-2">
		<h4>Overdue on</h4>
</div>
<div class="col-md-2">
		<select id="overdue_on" name="overdue_on"  class="form-control">
				<option value="0">Today</option>
				<option value="7">Next 7 days</option>
				<option value="15">Next 15 days</option>
				<option value="30">1 month</option>
				<option value="60">2 month</option>
				<option value="91">3 month</option>
				<option value="182">6 month</option>
				<option value="365">1 year</option>
		</select>
	</div>
	<div class="col-md-6">
		<h4 id="total_overdue" class="text text-danger">Total Overdue :</h4>
</div>
<div class="col-md-2 btn-group pull-right">
 <button type="button" class="btn btn-danger" id="print_report"><i class="fa fa-print"></i></button>
 <button type="button" class="btn btn-warning" id="excel_report"><i class="fa fa-download"></i></button>
</div>
</div>
{{ Form::close()}}
<br>
<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="jp_xing_table" class="table table-hover table-bordered" border="1" cellpadding="5" cellspacing="0">
						<thead id="table_header">

						</thead>
						<tbody id="data-list"></tbody>
					</table>
				</div>
			</div>
</div>

{{HTML::script('packages/script/reports/overduejp.js');}} @stop
