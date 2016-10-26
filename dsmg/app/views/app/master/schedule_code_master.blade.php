@extends('layouts.app') @section('content')

    <div class="row">
      	<h3>DSMG Schedule Code</h3>
    </div>


    <div class="row">

    		<div class="col-md-8 col-xs-12">
    			<input type="text" class="form-control" id="search_gears" placeholder="Search">
    		</div>
    		<div class="col-md-4 col-xs-12">
    			<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#createGearModal"><i class="fa fa-plus"></i> New Schedule</button>
    		</div>
    	</div>
			<br/>
      <div class="row">
			<div class="col-md-12">
				<div class="box box-danger">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th rowspan="2">Schedule Code</th>
									<th rowspan="2">Type</th>
									<th colspan="2" class="text-center">Maintanence Periodicity</th>
									<th rowspan="2" style="width: 45%;">Maintanence Description</th>
									<th rowspan="2" style="width: 5%;">Edit</th>
								</tr>
								<tr>
									<th>SS</th>
									<th>I/C</th>
								</tr>
							</thead>
							<tbody id="railway_gears_list"></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>


<!-- Add User Modal -->
<div class="modal fade" id="createGearModal" tabindex="-1" role="dialog" aria-labelledby="createGearModalLabel" data-backdrop="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="createGearModalLabel">Add New Schedule Code</h3>
      </div>
      <div class="modal-body">
        <div class="row" id="add_gear_row">
        	<form action="" id="add_gear_form">
	        	<div class="col-md-12">
	        		<label>Code</label>
	        		<input class="form-control upcase" type="text" name="code" placeholder="">
	        		<label>Gear Type</label>
	        		<select class="form-control" name="gear_type_id" id="gear_type_id"></select>
	        		<label>Periodicity</label>&nbsp;<small class="text-muted">Sectional DSMG</small>
	        		<select class="form-control" name="periodicity_level_1">
	        			<option value="0">Select Periodicity</option>
		        		<option value="14">Fortnightly</option>
		        		<option value="30">Monthly</option>
		        		<option value="90">Quarterly</option>
		        		<option value="182">Half Yearly</option>
		        		<option value="365">Yearly</option>
		        		<option value="730">2 Yearly</option>
		        		<option value="1095">3 Yearly</option>
		        	</select>
	        		<label>Periodicity</label>&nbsp;<small class="text-muted">Incharge SSE/SE</small>
	        		<select class="form-control" name="periodicity_level_2">
	        			<option value="0">Select Periodicity</option>
		        		<option value="14">Fortnightly</option>
		        		<option value="30">Monthly</option>
		        		<option value="90">Quarterly</option>
		        		<option value="182">Half Yearly</option>
		        		<option value="365">Yearly</option>
		        		<option value="730">2 Yearly</option>
		        		<option value="1095">3 Yearly</option>
		        	</select>
		        	<label>Remarks</label>
		        	<textarea rows="1" class="form-control" name="remarks" placeholder="(if any)"></textarea>
	        	</div>
        	</form>
        </div>
		<div class="modal-footer">
        	<button class="btn btn-primary btn-block" id="create_gear_btn" onclick="create_gear();">Save</button>
       </div>
      </div>
    </div>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editGearModal" tabindex="-1" role="dialog" aria-labelledby="editGearModalLabel" data-backdrop="false" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="editGearModalLabel">Edit Schedule Code</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          {{Form::open(array('','id'=>'overdue-form','class'=>'form-horizontal' , 'method' => 'post'))}}
        	<form action="" id="edit_gear_form">
	        	<div class="col-md-12">
	        		<input type="hidden" name="id" id="edit_id">
	        		<label>Code</label>
	        		<input class="form-control upcase" type="text" name="code" id="edit_code">
	        		<label>Gear Type</label>
	        		<select class="form-control" name="gear_type_id" id="edit_gear_type_id"></select>
	        		<label>Periodicity level 1</label>
	        		<select class="form-control" name="periodicity_level_1" id="edit_periodicity_level_1">
	        			<option value="0">Select Periodicity</option>
		        		<option value="14">Fortnightly</option>
		        		<option value="30">Monthly</option>
		        		<option value="90">Quarterly</option>
		        		<option value="182">Half Yearly</option>
		        		<option value="365">Yearly</option>
		        		<option value="730">2 Yearly</option>
		        		<option value="1095">3 Yearly</option>
		        	</select>
	        		<label>Periodicity level 2</label>
	        		<select class="form-control" name="periodicity_level_2" id="edit_periodicity_level_2">
	        			<option value="0">Select Periodicity</option>
		        		<option value="14">Fortnightly</option>
		        		<option value="30">Monthly</option>
		        		<option value="90">Quarterly</option>
		        		<option value="182">Half Yearly</option>
		        		<option value="365">Yearly</option>
		        		<option value="730">2 Yearly</option>
		        		<option value="1095">3 Yearly</option>
		        	</select>
		        	<label>Remarks</label>
		        	<textarea rows="5" class="form-control" name="remarks" id="edit_remarks"></textarea>
	        	</div>
        	</form>
          {{ Form::close()}}
        </div>
		<div class="modal-footer">
        	<button class="btn btn-primary btn-block" id="updateGearDetailsBtn" onclick="updateGearDetails();">Update</button>
       </div>
      </div>
    </div>
  </div>
</div>
{{HTML::script('packages/script/master/schedulecode_master.js');}} @stop
