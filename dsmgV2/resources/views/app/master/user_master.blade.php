@extends('layouts.app') @section('content')

<div class="row">
			<div class="page-header">
				<h3>User Master</h3>
			</div>
</div>
{{Form::open(array('url' => ' ','id'=>'crossing-form','class'=>'form-horizontal' , 'method' => 'post'))}}
{{ Form::close()}}
<div class="row">
			<div class="col-md-8">
				<input type="text" class="form-control" id="search_user" placeholder="Search">
			</div>
			<div class="col-md-4">
				<button class="btn btn-primary pull-right" id="add_user_btn" data-toggle="modal" data-target="#createUserModal"><i class="fa fa-plus"></i> New User</button>
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
									<th>Name</th>

									<th>Mobile</th>
										<th>Email</th>
									<th>Designation</th>
									<th>Role</th>
									<th style="width:5%;">Approve</th>
									<th style="width:5%;">Edit</th>
								</tr>
							</thead>
							<tbody id="railway_users_list"></tbody>
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
        <h3 class="modal-title" id="createUserModalLabel">Add User</h3>
      </div>
      <div class="modal-body mafter">
        <div class="row">
        	<form role="form" id="add_user_form" action="" method="post">
	        	<div class="col-md-6">
		        	<div class="form-group">
		        		<label>Name</label>
			        	<input type="text" class="form-control" id="name" name="name" required="required" placeholder="Name">
			        </div>

			        <div class="form-group">
			        	<label>Mobile</label>
			        	<input type="tel" class="form-control" id="mobile" name="mobile" maxlength="10" required="required" placeholder="Mobile">
			        </div>
	        	</div>
	        	<div class="col-md-6">
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" id="email" name="email" required="required"  placeholder="Email">
					</div>
			        <div class="form-group">
			        	<label>Designation</label>
								<select class="form-control" name="role_id" id="role_id">
									<option value="NA">--select--</option>
									<option value="SR DSTE/TSK" >SR DSTE/TSK</option>
									<option value="DSTE/TSK" >DSTE/TSK</option>
									<option value="ADSTE/W/TSK" >ADSTE/W/TSK</option>
									<option value="ADSTE/MXN" >ADSTE/MXN</option>
									<option value="SECTIONAL SUPERVISER">SECTIONAL SUPERVISER</option>
									<option value="INCHARGE SSE/SE">INCHARGE SSE/SE</option>
								</select>
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
{{HTML::script('packages/script/master/user.js');}} @stop
