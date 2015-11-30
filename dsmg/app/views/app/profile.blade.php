@extends('layouts.app') @section('content')
<section class="content">
	<div class="row">

		<div class="col-md-4 col-md-offset-3">
			<div class="box box-danger">
				<div class="box-header">
					<h3 class="box-title">Change Password</h3>
				</div>
				<div class="box-body">
					{{Form::open(array('url' => ' ','id'=>'changePassword-form','class'=>'form-horizontal' , 'method' => 'post'))}}

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
