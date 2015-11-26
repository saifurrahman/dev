@extends('layouts.app') @section('content')

<div class="row">
			<div class="page-header">
				<h3>Section Distribution</h3>
			</div>
</div>

<div class="row">

			<div class="col-md-4">
				<button class="btn btn-primary pull-right" id="add_user_btn" data-toggle="modal" data-target="#createUserModal"><i class="fa fa-plus"></i> New </button>
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
									<th>Sl No.</th>
									<th>Name</th>
									<th>Designation</th>
									<th>Stations</th>
									<th style="width:5%;">Edit</th>
								</tr>
							</thead>
							<tbody id="sectional_distribution"></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="createUserModalLabel">New Supervisor</h3>
      </div>
      <div class="modal-body mafter">
        <div class="row">
        	<form role="form" id="add_user_form" action="" method="post">
	        	<div class="col-md-12">
		        	<div class="form-group">
		        		<label>Name</label>
			        	<input type="text" class="form-control" id="name" name="name" required="required" placeholder="Name">
			        </div>

			        <div class="form-group">
			        	<label>Mobile</label>
			        	<input type="tel" class="form-control" id="mobile" name="mobile" maxlength="10" required="required" placeholder="Mobile">
			        </div>

			        <div class="form-group">
			        	<label>Designation</label>
								<select class="form-control" name="desig_id" id="desig_id">
									<option value="0">----</option>

								</select></div>
			        <div class="form-group">
			        	<label>Role</label>
			        	<select class="form-control" name="role_id" id="role_id">
			        		<option value="IC">IC</option>
									<option value="SS">SS</option>

			        	</select>
			        </div>
							<div class="form-group">
								<label>Stations</label>
								<input type="text" class="form-control" id="designation" name="designation" placeholder="Select Stations">
							</div>
			        <div class="form-group">
			        	<label><br/></label>
			        	<button type="button" class="btn btn-primary btn-block" id="createUserBtn" onclick="createUser();">Save</button>
			        </div>
	        	</div>
        	</form>
        </div>
      </div>
    </div>
  </div>
</div>
{{HTML::script('packages/script/master/section_distribution.js');}} @stop
