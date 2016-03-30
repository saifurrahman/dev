@extends('layouts.app') @section('content')
<section class="row m-b-md">
	<div class="col-sm-6">
		<h3 class="m-b-xs text-black">Brand Master</h3>
	</div>
</section>
<section class="row m-b-md" id="brand_form">

	<div class="col-md-3">
		<input type="hidden" id="editID" name="id">
		<select class="form-control"
			id="client_id" name="client_id"></select>
	</div>
	<div class="col-md-3">
	<input type="text" class="form-control" id="brand_name"
			name="brand_name" placeholder="Brand Name">
	</div>
	<div class="col-md-2">
		<select class="form-control"
			name="category_id" id="category_id">
		</select>
	</div>
	<div class="col-md-2">

		<button class="btn btn-success" id="saveBtn" onclick="saveBrand();">save</button>
	</div>
	<div class="col-md-2">
		<button class="btn btn-info" id="upBtn" onclick="updateBrand();">update</button>
	</div>

</section>
<section class="row m-b-md">
	<div class="col-md-6">
			<input type="search" class="form-control" id="search" placeholder="search brand using name or client name"></input>
	</div>
	<div class="col-md-4">

	</div>
	<div class="col-md-2">
		<button class="btn btn-icon b-2x btn-primary btn-rounded hover "
			onclick="brandForm();">
			<i class="fa fa-plus hover-rotate"></i>
		</button>
	</div>
</section>

<section class="row m-b-md">
	<div class="col-md-12">
			<table class="table table-striped m-b-none">
				<thead>
					<tr>
						<th>#</th>
						<th>Brand Name</th>
						<th>Type</th>
						<th>Client</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody id="brand-list"></tbody>
			</table>
		</section>
	</div>
</section>
<!-- category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Add New Category</h4>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					{{Form::open(array('','id'=>'category-form'))}} <input type="text"
						class="form-control" name="name" id="cat_name" placeholder="category name"> {{
					Form::close()}}
				</div>
			</div>
			<br>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="cBtn" class="btn btn-primary" onclick="saveCategory();">Save</button>
			</div>
		</div>
	</div>
</div>
<!-- modal end -->

{{HTML::script('packages/script/brand.js');}} @stop
