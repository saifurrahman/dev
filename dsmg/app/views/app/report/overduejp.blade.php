@extends('layouts.app') @section('content')

<div class="row">
			<div class="page-header">
				<h3>Joint Point and X-ing Inspection Overdue report
					<div class="btn-group pull-right">
				   <button type="button" class="btn btn-danger" id="print_report"><i class="fa fa-print"></i></button>
				   <button type="button" class="btn btn-warning" id="excel_report"><i class="fa fa-download"></i></button>
				 </div>	</h3>
			</div>
</div>
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
