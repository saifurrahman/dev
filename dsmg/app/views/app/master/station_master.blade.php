@extends('layouts.app') @section('content')

<div class="row">
			<div class="page-header">
				<h3>Stations master</h3>
			</div>
</div>
<div class="row">

    		<div class="col-md-8 col-xs-12">
    			<input type="text" class="form-control" id="search_station" placeholder="Search">
    		</div>
    		<div class="col-md-4 col-xs-12">
    			<button class="btn btn-success pull-right" data-toggle="modal" data-target="#AddStationModal"><i class="fa fa-plus"></i> add station</button>
    		</div>
</div>
<div class="row">
			<div class="col-md-12">
				<div class="box box-danger">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Station Name</th>
								<th>District Name</th>
								<th>Station Code</th>
								<th style="width: 5%;">Edit</th>
								<th style="width: 5%;">Delete</th>
							</tr>
						</thead>
						<tbody id="railway_stations_list"></tbody>
					</table>
				</div>
			</div>
</div>
{{HTML::script('packages/script/crossing.js');}} @stop
