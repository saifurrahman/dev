@extends('layouts.app') @section('content')
<div class="row">
			<div class="page-header">
				<h3>Dashboard</h3>
			</div>
</div>

<div class="row">
	<div class="col-md-4">

		<div class="table-responsive">
			<table class="table table-bordered table-hover" id="maintenance_reports" border="1" cellpadding="5" cellspacing="0">
				<thead>
					<tr>
						<th>Station Code</th>
						<th>Overdue Gears</th>
					</tr>
				</thead>
				<tbody id="data_list"></tbody>
			</table>
		</div>
	</div>
	<div class="col-md-4">

	</div>
	<div class="col-md-4">

	</div>
</div>
{{HTML::script('packages/script/reports/dashboard.js');}} @stop
