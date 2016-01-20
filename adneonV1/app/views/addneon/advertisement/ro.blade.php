@extends('layouts.app') @section('content')
<section class="row m-b-md">
	<div class="col-sm-6">
		<h3 class="m-b-xs text-black">Commercial Master</h3>
	</div>
	<div class="col-sm-6 text-right text-left-xs m-t-md">
		<div class="btn-group">
			<button class="btn btn-icon b-2x btn-primary btn-rounded hover "
				onclick="comForm();">
				<i class="fa fa-plus hover-rotate"></i>
			</button>
		</div>
	</div>
</section>
<div class="row" id="com-div">
	<div class="col-md-6">
		<section class="panel panel-default" >
			<div class="panel-body">
				{{Form::open(array('','id'=>'advertise-form','class'=>'form-horizontal'))}}
				<div class="form-group">
						<label class="control-label col-sm-3">Client</label>
						<div class="col-sm-9">
							<select class="form-control" name="client_id" id="client_id"></select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Brand</label>
						<div class="col-sm-9">
							<select class="form-control" name="brand_id" id="brand_id"></select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Caption</label>
						<div class="col-sm-9">
							<input type="hidden" id="editID" name="id">
							<input type="text" class="form-control" name="caption" placeholder="advertise caption" id="caption">
						</div>
					</div>
					
					<div class="form-group">
						<label class="control-label col-sm-3">Duration</label>
						<div class="col-sm-9">
							<input type="number" class="form-control" id="duration" name="duration" placeholder="duration in secs">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-3">Language</label>
						<div class="col-sm-9">
							<select class="form-control" name="language_id" id="language_id"></select>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-9 col-md-offset-3">
							<button type="button" id="cBtn" class="btn btn-success" onclick="saveAdd();">Save</button>
							<button type="button" id="upBtn" class="btn btn-info" onclick="update();">Update</button>
						</div>
					</div>
				{{ Form::close()}}
			</div>
		</section>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<section class="panel panel-default">
			<header class="panel-heading font-bold">Advertise List</header>
			<div class="row wrapper">
				<div class="col-md-12">
					<input type="search" class="form-control" id="search"
						placeholder="search commercial"></input>
				</div>
			</div>

			<table class="table table-striped m-b-none">
				<thead>
					<tr>
					    <th>ADD ID</th>
						<th>Caption</th>
						<th>Duration <small>(in secs.)</small></th>
						<th>Language</th>
						<th>Client</th>
						<th>Brand</th>
						<th>Edit</th>
<!-- 						<th>Edit</th> -->
						
					</tr>
				</thead>
				<tbody id="add-list">

				</tbody>
			</table>
		</section>
	</div>
</div>

<!-- language Modal -->
<div class="modal fade" id="languageModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Add New Language</h4>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					{{Form::open(array('','id'=>'language-form'))}} <input type="text"
						class="form-control" name="name" placeholder="language name"> {{
					Form::close()}}
				</div>
			</div>
			<br>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="lBtn" class="btn btn-primary" onclick="saveLanguage();">Save</button>
			</div>
		</div>
	</div>
</div>
<!-- modal end -->
{{HTML::script('packages/script/add.js');}}
 @stop
