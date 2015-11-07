@extends('layouts.app') @section('content')

<div class="row">
			<div class="page-header">
				<h3>Stations master</h3>
			</div>
</div>

{{Form::open(array('','id'=>'add-station-form','class'=>'form-horizontal'))}}
<div class="row" id="add-station-form">
	<div class="col-md-3">
		<div class="form-group">
			<input type="hidden"  id="station_id" name="station_id">
			<input type="text" class="form-control" name="code" required="required" placeholder="Station Code" id="station_code">
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<input type="text" class="form-control" id="name" name="name" required="required" placeholder="Station Name">
		</div>
	</div>
				<div class="col-md-3">
				<div class="form-group">
					<select id="district_id"  class="form-control" name="district_id"></select>
					</div>
				</div>


		<div class="col-md-2">
				<button type="button" onclick="createStation();" id="saveBtn" class="btn btn-success btn-block">save</button>
		</div>
</div>
{{ Form::close()}}
<div class="row">
			<div class="col-md-12">
				<div class="box box-danger">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Sl no</th>
								<th>Station Code</th>
								<th>Station Name</th>
								<th>District Name</th>
								<th>Edit</th>
								<th>Station Status</th>
							</tr>
						</thead>
						<tbody id="railway_stations_list"></tbody>
					</table>
				</div>
			</div>
</div>



{{HTML::script('packages/script/master/station_master.js');}} @stop
