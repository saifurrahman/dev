@extends('layouts.app') @section('content')
<div class="row">
			<div class="page-header">
				<h3>Dashboard</h3>
			</div>
</div>

<div class="row">
	<div class="col-md-4 ">
		<h3>Maintenece Overdue</h3>
			<span class="badge badge-danger">4</span>
	</div>
	<div class="col-md-4">

	</div>
	<div class="col-md-4">

	</div>
</div>
{{HTML::script('packages/script/reports/dsahboard.js');}} @stop
