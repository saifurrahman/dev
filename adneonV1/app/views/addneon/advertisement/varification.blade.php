@extends('layouts.app') @section('content')

<section class="row m-b-md">
	<div class="col-md-12">

		<div class="row">
			<div class="col-md-4">
				<h3 class="m-b-xs text-black">Daily Telecast Log</h3>
			</div>
			{{Form::open(array('url' => ' ','id'=>'schedule-form','class'=>'form-horizontal' , 'method' => 'post'))}}
			<div class="col-md-3">
				<label></label> <input type="text" class="form-control"
					id="schedule_date" name="schedule_date"
					placeholder="click to choose">
			</div>

			<div class="col-md-2 text-left-xs m-t-md">

		<form method="post" action="file-upload-1.htm" name="submit" enctype="multipart/form-data">
		  <input type="file" name="xlfile" id="xlf1">

		</form>
  </div>

			</div>
{{ Form::close()}}
		</div>

	</div>
</section>

<div class="row" id="varification_row">

	<div class="col-md-12">
		<table class="table table-striped m-b-none table-hover">
			<thead>
				<tr>
					<!-- 					<th>Date</th> -->

					<th>Ad ID</th>
					<th>Caption</th>
					<th>Client</th>
					<th>Brand</th>
					<th>Duration</th>
					<th>Telecast Time</th>


				</tr>
			</thead>
			<tbody id="tc_time_table"></tbody>
		</table>
	</div>
</div>

{{HTML::script('packages/script/sch_varification.js');}}
{{HTML::script('packages/js/shim.js');}}
{{HTML::script('packages/js/xls.js');}}
{{HTML::script('packages/script/upload.js');}} @stop
