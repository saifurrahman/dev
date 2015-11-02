@extends('layouts.app') @section('content')

<div class="row">
			<div class="page-header">
				<h3>Gear Type Master</h3>
			</div>
</div>
<div class="row">
    			<div class="col-md-3 col-xs-12">
    				<input type="text" class="form-control" id="code" placeholder="Gear Code">
    			</div>
    			<div class="col-md-6 col-xs-12">
    				<input type="text" class="form-control" id="name" placeholder="Gear Name">
    			</div>
    			<div class="col-md-3 col-xs-12">
	    			<button type="button" class="btn btn-primary btn-block pull-right" id="save_gear_type_btn" onclick="save_gear_type();">Save</button>
	    		</div>
    		

</div>
        <div class="row">
        	<div class="col-md-12">
        		<div class="box box-danger">
        			<table class="table table-hover table-bordered" id="gear_type_table">
        				<thead>
        					<tr>
        						<th style="width: 10%;">#</th>
        						<th style="width: 30%;">Gear Code</th>
        						<th style="width: 60%;">Gear Name</th>
        					</tr>
        				</thead>
        				<tbody></tbody>
        			</table>
        		</div>
        	</div>
        </div>
{{HTML::script('packages/script/crossing.js');}} @stop
