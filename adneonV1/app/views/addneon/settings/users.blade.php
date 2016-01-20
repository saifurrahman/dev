@extends('layouts.app') @section('content')
<section class="row m-b-md">
	<div class="col-sm-6">
		<h3 class="m-b-xs text-black">Users</h3>
	</div>
</section>
<div class="row">
	<div class="col-md-3">
		<section class="panel panel-default">
			<header class="panel-heading font-bold">Add User</header>
			<div class="panel-body">
				{{Form::open(array('','id'=>'user-form'))}}
				<div class="form-group">
					<label>Name</label>
					<div >
						<input type="text" class="form-control" name="name"
							placeholder="username">
					</div>
				</div>
				<div class="form-group">
					<label>Email</label>
					<div >
						<input type="email" class="form-control" name="email"
							placeholder="email address">
					</div>
				</div>
				<div class="form-group">
					<label>Mobile</label>
					<div >
						<input type="tel" class="form-control" name="mobile"
							placeholder="mobile">
					</div>
				</div>
				<div class="form-group">
					<label>Designation</label>
					<div >
						<input type="text" class="form-control" name="designation"
							placeholder="Designation">
					</div>
				</div>
				<div class="form-group">
					
						<button type="button" id="saveBtn" onclick="saveUser();"
							class="btn btn-success btn-block">submit</button>
					
				</div>
				{{ Form::close()}}
			</div>
		</section>
	</div>
	<div class="col-md-9">
		<section class="panel panel-default">
			<header class="panel-heading font-bold">User Table</header>
			<table class="table table-striped m-b-none">
				<thead>
					<tr>
						<th>Name</th>
						<th>Mobile</th>
						<th>Email</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody id="user-list">

				</tbody>
			</table>

		</section>
	</div>
</div>
<!-- permission modal -->
	<div class="modal fade" id="permissionModal" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel"></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<table class="table">
								<thead>
									<tr>
										<th>Module Name</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody id="permission-list">
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
{{HTML::script('packages/script/user.js');}} @stop
