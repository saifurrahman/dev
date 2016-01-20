@extends('layouts.app') @section('content')

<section class="row m-b-md">
	<div class="col-sm-6">
		<h3 class="m-b-xs text-black">Programs</h3>
	</div>
	<div class="col-sm-6 text-right text-left-xs m-t-md">
		<div class="btn-group">
			<button class="btn btn-icon b-2x btn-primary btn-rounded hover "
				onclick="showForm();">
				<i class="fa fa-plus hover-rotate"></i>
			</button>
		</div>
	</div>
</section>
<div class="row" id="pform-div">
	<div class="col-sm-12">
		<section class="panel panel-default">
			<header class="panel-heading font-bold">Add Program</header>
			<div class="panel-body">
				{{Form::open(array('','id'=>'program-form'))}}
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label>Program Name</label> <input type="text"
								class="form-control" name="name" id="name"
								placeholder="enter program name">
								<input type="hidden" id="editID"name="id">
						</div>
						<div class="form-group">
							<label>Category</label> <select class="form-control"
								name="category_id" id="category_id">

							</select>
						</div>
						<div class="form-group">
							<label>Classification</label> <select class="form-control"
								name="classification" id="classification">
								<option value="0">select</option>
								<option value="episodic">Episodic</option>
								<option value="general">General</option>
								<option value="no_episodic">Non-Episodic</option>

							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label>Audience</label> <select class="form-control"
								name="audience_id" id="audience_id">
							</select>
						</div>
						<div class="form-group">
							<label>Language</label> <select class="form-control"
								name="language_id" id="language_id">
							</select>
						</div>
						<br>
						<div class="form-group">
							<button type="button" id="saveBtn" class="btn btn-success"
								onclick="addProgram();">submit</button>
								<button type="button" id="upBtn" class="btn btn-primary"
								onclick="upProgram();">update</button>
								<button type="button" onclick="cancelEdit();" id="rBtn" class="btn btn-danger"
								>cancel</button>
						</div>
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
			<header class="panel-heading font-bold">Program List</header>

			<table class="table table-striped m-b-none">
				<thead>
					<tr>
					    <th>SI No</th>
						<th width="25%">Name</th>
						<th>Category</th>
						<th>Classification</th>
						<th>Audience</th>
						<th>Language</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody id="program-list">

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
<!-- audience Modal -->
<div class="modal fade" id="audienceModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Add New Audience</h4>
			</div>
			<div class="modal-body">
				<div class="col-md-12">
					{{Form::open(array('','id'=>'audience-form'))}} <input type="text"
						class="form-control" name="name" placeholder="audience name"> {{
					Form::close()}}
				</div>
			</div>
			<br>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="aBtn" class="btn btn-primary" onclick="saveAudience();">Save</button>
			</div>
		</div>
	</div>
</div>
<!-- modal end -->
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
						class="form-control" name="name" placeholder="category name"> {{
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
{{HTML::script('packages/script/program.js');}} @stop
 