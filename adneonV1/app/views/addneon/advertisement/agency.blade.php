@extends('layouts.app') @section('content')
<section class="row m-b-md">
	<div class="col-sm-6">
		<h3 class="m-b-xs text-black">Agency Master</h3>
	</div>
	<div class="col-sm-6 text-right text-left-xs m-t-md">
		<div class="btn-group">
			<button class="btn btn-icon b-2x btn-primary btn-rounded hover "
				onclick="clientForm();">
				<i class="fa fa-plus hover-rotate"></i>
			</button>
		</div>
	</div>
</section>
<div class="row" id="client-div">
	<div class="col-sm-12">
		<section class="panel panel-default">
			<header class="panel-heading font-bold">Add Clients</header>
			<div class="panel-body">
				{{Form::open(array('','id'=>'agency-form','class'=>'form-horizontal'))}}
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-sm-2">Name</label>
						<div class="col-sm-10">
							<input type="hidden" id="editID" name="id"> <input type="text"
								class="form-control" name="name" id="name"
								placeholder="agency name">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-2">Email</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="email" id="email"
								placeholder="email address">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Mobile</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="mobile" id="mobile"
								placeholder="mobile">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2">Comm.(%)</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="Editcommission"
								name="commission" placeholder="commission in %">
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-sm-2">Address</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="address1"
								id="address1" placeholder="Address Line 1">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2"></label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="address2"
								id="address2" placeholder="Address Line 2">
						</div>
					</div>
					<div class="form-group">

						<label class="control-label col-sm-2">City</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="city" id="city"
								placeholder="City">
						</div>

					</div>
					<div class="col-md-offset-2">
						<button type="button" class="btn btn-success" id="saveBtn"
							onclick="saveAgency();">Save</button>

						<button type="button" class="btn btn-info" id="upBtn"
							onclick="updateAgency();">update</button>
					</div>
				</div>
				{{ Form::close()}}
			</div>
		</section>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<section class="panel panel-default">
			<header class="panel-heading bg-light"> </header>
			<div class="row wrapper">
				<div class="col-md-12">
					<input type="search" class="form-control" id="search"
						placeholder="search agency"></input>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-striped m-b-none table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Region</th>
							<th>Comm. <small>(in %)</small></th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="agency-list"></tbody>
				</table>
			</div>
		</section>
	</div>
</div>
{{HTML::script('packages/script/agency.js');}} @stop
