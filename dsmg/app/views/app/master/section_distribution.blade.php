@extends('layouts.app') @section('content')

<div class="row">
			<div class="page-header">
				<h3>Section Distribution</h3>
			</div>
</div>

<div class="row">

			<div class="col-md-10">
				<button class="btn btn-primary pull-right" id="add_user_btn" data-toggle="modal" data-target="#createUserModal"><i class="fa fa-plus"></i> New Supervisor </button>
	    </div>
			<div class="col-md-2">
				<button class="btn btn-primary" id="add_user_btn" data-toggle="modal" data-target="#createDesigModal">Designation</button>
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
					{{Form::open(array('url' => ' ','id'=>'desig-form','class'=>'form-horizontal' , 'method' => 'post'))}}

        	<form role="form" id="add_user_form" action="" method="post">
	        	<div class="col-md-12">
		        	<div class="form-group">
		        		<label>Name</label>
			        	<input type="text" class="form-control" id="name" name="name" required="required" placeholder="Name">
			        </div>
			        <div class="form-group">
			        	<label>Designation</label>
								<select class="form-control" id="designation" name="designation"></select></div>

							<div class="form-group">
								<label>Stations</label>
								<select id="select_station_id" name="station_id[]" multiple class="form-control" placeholder="Select Station"></select>

							</div>
			        <div class="form-group">
			        	<label><br/></label>
			        	<button type="button" onclick="createSupervisor();" class="btn btn-primary btn-block" >Save</button>
			        </div>
	        	</div>
        	</form>
						{{ Form::close()}}
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="createDesigModal" tabindex="-1" role="dialog" aria-labelledby="createDesigModalLabel" aria-hidden="true">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3 class="modal-title" id="createUserModalLabel">New Designation</h3>
		</div>
		<div class="modal-body">
			{{Form::open(array('url' => ' ','id'=>'desig-form','class'=>'form-horizontal' , 'method' => 'post'))}}

			<div class="row">
						<div class="col-md-6">
								<label class="small">Designation</label>
							<input type="text" class="form-control" id="new_designation"
								name="new_designation" placeholder="Designation">
						</div>
						<div class="col-md-6">
							<label></label>
							<button type="button" onclick="saveDesig();" id="saveBtn" class="btn btn-success btn-block">save</button>
						</div>
					</div>
					{{ Form::close()}}
					<hr>
					<div class="row">
					<div class="col-md-12">
						<div class="box box-danger">
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>Sl No.</th>
											<th>Name</th>

										</tr>
									</thead>
									<tbody id="designation_table"></tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
{{HTML::script('packages/script/master/section_distribution.js');}} @stop
