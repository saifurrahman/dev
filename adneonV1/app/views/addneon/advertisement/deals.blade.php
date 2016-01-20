@extends('layouts.app') @section('content')
<section class="row m-b-md">
	<div class="col-sm-4">
		<h3 class="m-b-xs text-black">Advertisement Deals</h3>
	</div>
	<!--<div class="col-sm-4">
		<h3 class="m-b-xs text-danger" id="total_deal"></h3>
	</div>-->
	<div class="col-sm-4 text-right text-left-xs m-t-md">
		<div class="btn-group">
			<button class="btn btn-icon b-2x btn-primary btn-rounded hover "
				onclick="dealForm();">
				<i class="fa fa-plus hover-rotate"></i>
			</button>
		</div>

	</div>
</section>
<div class="row">
	<section class="panel panel-default" id="deal-div">
		<header class="panel-heading font-bold">Add Deals</header>
		<div class="panel-body">
			{{Form::open(array('','id'=>'deal-form'))}}
			<div class="col-md-6">
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Select Client</label> <select class="form-control"
								id="client_id" name="client_id"></select>
						</div>
						<div class="col-md-6">
							<label>Select Agency</label> <select class="form-control"
								id="agency_id" name="agency_id"></select>
						</div>
					</div>
				</div>
				<div class="form-group ">
					<div class="row">
						<div class="col-md-6">
							<label>From Date</label> <input type="text" class="form-control"
								name="from_date" id="from_date" placeholder="From Date">
						</div>
						<div class="col-md-6">
							<label>To Date</label> <input type="text" class="form-control"
								name="to_date" id="to_date" placeholder="To date">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Amount (in Rs.)</label> <input type="number"
								class="form-control" name="amount" id="amount">
						</div>

						<div class="col-md-6">
							<label>Rate</label> <input type="number" class="form-control"
								id="rate" name="rate">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Preffered Time Segment</label> <select class="form-control"
						name="time_slot[]" id="time_slot" multiple>
						<option value="">select</option>
						<option value="RODP (6 AM 12 AM)">RODP (6 AM 12 AM)</option>
						<option value="Morning Prime Time(7 AM 10 AM)">Morning Prime
							Time(7 AM 10 AM)</option>
						<option value="Noon Prime Time (10 AM 4 PM)">Noon Prime Time (10
							AM 4 PM)</option>
						<option value="Evening Prime Time(4 PM 7 PM)">Evening Prime Time(4
							PM 7 PM)</option>
						<option value="Super Prime Time (7 PM 10 PM)">Super Prime Time (7
							PM 10 PM)</option>
						<option value="Night Prime Time (10 PM 12 PM)">Night Prime Time
							(10 PM 12 PM)</option>

					</select>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Campaign Duration (<small class="text-muted">In secs.</small>)
							</label> <input type="number" class="form-control"
								name="duration">
						</div>
						<div class="col-md-6">
							<label>Ad Type</label> <select class="form-control"
								name="item_id" id="item_id"></select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-6">
									<label>RO No.</label> <input type="text" class="form-control"
										name="ro_number">
								</div>
								<div class="col-md-6">
									<label>RO Date</label> <input type="text" class="form-control"
										name="ro_date" id="ro_date" placeholder="click to choose">
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<label>Remark</label>
							<textarea rows="1" cols="" class="form-control" name="remark"></textarea>
						</div>

					</div>
				</div>
				<div class="from-group">
					<div class="row">
						<div class="col-md-6">
							<select class="form-control" id="executive_id"
								name="executive_id"></select>
						</div>
						<div class="col-md-6">
							<button class="btn btn-success" onclick="saveDeal();"
								id="saveBtn">Save</button>
						</div>
					</div>
				</div>
			</div>
			{{ Form::close()}}
		</div>
	</section>
</div>
<div class="row">
	<section class="panel panel-default">
		<header class="panel-heading font-bold">
			Deal List <span class="m-b-xs text-danger pull-right" id="total_deal"></span>
		</header>
		<div class="row wrapper">
			<div class="col-md-12">
				<input type="search" class="form-control" id="search"
					placeholder="Search"></input>
			</div>
		</div>
		<div class="table-responsive" id="table-div">
			<table class="table table-striped m-b-none table-bordered">
				<thead>
					<tr>
						<th>Deal ID</th>
						<th>Client Name</th>
						<th>Agency</th>
						<th>From Date</th>
						<th>To Date</th>
						<th>Type</th>
						<th>Duration (In secs)</th>
						<th >Rate</th>
						<th>Amount</th>
						<th>Executive</th>
						<th>Remarks</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody id="deal-list"></tbody>
			</table>
		</div>
	</section>
</div>
<div class="modal fade" id="exModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">New Executive</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						{{Form::open(array('','id'=>'ex-form'))}}
						<div class="form-group">
							<label>Executive Name</label> <input type="text"
								class="form-control" name="ex_name" id="ex_name"
								placeholder="executive name">
						</div>
						<div class="form-group">
							<label>Location</label> <input type="text" class="form-control"
								name="location" id="location" placeholder="location">
						</div>
						{{ Form::close()}}
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="exBtn"
					onclick="saveEx();">Save</button>
			</div>
		</div>
	</div>
</div>
<!-- edit deal modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">
					EDIT <span id="deal_name"></span>
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					{{Form::open(array('','id'=>'dealedit-form'))}}
					<div class="col-md-6">
						<div class="form-group">
							<label>Client Name</label> <select class="form-control"
								id="editclient_id" name="client_id"></select> <input
								type="hidden" name="id" id="editID">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Agency Name</label> <select class="form-control"
								id="editagency_id" name="agency_id"></select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>From Date</label> <input type="text" class="form-control"
								name="from_date" id="editfrom_date">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>To Date</label> <input type="text" class="form-control"
								name="to_date" id="editto_date">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Rate</label> <input type="text" class="form-control"
								name="rate" id="editrate">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Amount</label> <input type="text" class="form-control"
								name="amount" id="editamount">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label> Time Slot</label> <input type="text" class="form-control"
								id="edittimeslot_id" name="time_slot" readonly>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Campaign Duration</label> <input type="text"
								class="form-control" id="editduration" name="duration">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Ad Type</label> <select class="form-control"
								name="item_id" id="edititem_id"></select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Executive</label> <select class="form-control"
								name="executive_id" id="editexecutive_id"></select>
						</div>
					</div>
					<div class="col-md-4">
						<label>RO No.</label> <input type="text" class="form-control"
							id="editro_no" name="ro_no">
					</div>
					<div class="col-md-4">
						<label>RO Date.</label> <input type="text" class="form-control"
							id="editro_date" name="ro_date">
					</div>
					<div class="col-md-4">
						<label>Remarks</label> <input type="text" class="form-control"
							id="editremark" name="remark">
					</div>
					{{ Form::close()}}
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="updateBtn"
					onclick="updateDeal();">Save</button>
			</div>
		</div>
	</div>
</div>
{{HTML::script('packages/script/deal.js');}} @stop
