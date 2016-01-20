@extends('layouts.app') @section('content')
<section class="content-header">
	<h1>Profile</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-5">
			<div class="box box-danger">
				<div class="box-header">
					<h3 class="box-title">Profile Details</h3>
				</div>
				<div class="box-body">
					{{ Form::open(array('','id'=>'profile-form'))}}
						<label>Name</label>
						<input type="text" class="form-control"id="name" name="name">
						<input type="hidden" id="user_id"name="id">
						<label>Email</label>
						<input type="email" class="form-control" id="email" name="email">
						<label>Mobile</label>
						<input type="tel" class="form-control" id="mobile" name="mobile">
						<label>Designation</label>
						<input type="text" class="form-control" id="designation" name="designation">
						<br>
					{{Form::close()}}
					<button class="btn btn-danger" id="proBtn"onclick="updateProfile();">Update</button>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-md-offset-3">
			<div class="box box-danger">
				<div class="box-header">
					<h3 class="box-title">Change Password</h3>
				</div>
				<div class="box-body">
					{{ Form::open(array('','id'=>'password-form'))}}
						<label>New Password <small>(*minimum 6 charecters)</small></label>
						<input type="password" id="password"  name="password" class="form-control">
						<label>Confirm Password</label>
						<input type="password" id="confirm_password" class="form-control">
					{{Form::close()}}
					<br>
					<button class="btn btn-danger" id="pBtn"onclick="changePassword();">Change</button>
				</div>
			</div>
		</div>
	</div>
</section>
{{HTML::script('packages/script/profile.js');}} @stop
