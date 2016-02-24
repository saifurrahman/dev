@extends('layouts.app') @section('content')
<section class="row m-b-md">
	<div class="col-sm-6">
		<h3 class="m-b-xs text-black">Deals</h3>
	</div>
	<!--<div class="col-sm-4">
		<h3 class="m-b-xs text-danger" id="total_deal"></h3>
	</div>-->
	<div class="col-sm-6 text-right text-left-xs m-t-md">
		<div class="btn-group">
			<button class="btn btn-icon b-2x btn-primary btn-rounded hover "
				onclick="dealForm();">
				<i class="fa fa-plus hover-rotate"></i>
			</button>
		</div>

	</div>
</section>
	{{Form::open(array('','id'=>'deal-form'))}}
	<section class="panel panel-default" id="deal-div" >
	<div class="row panel-heading">
		<div class="col-md-6">
			<h4>New Deal</h4>
		</div>
		<div class="col-md-6 text-right">
		 <button class="btn b-2x btn-danger" id="save_deal" onclick="#" >Save Deal</button>
		</div>
	</div>

		<div class="panel-body">

      <div class="row">
        <div class="col-md-3">
          <label>Client</label> <select class="form-control"
            id="client_id" name="client_id"></select>
        </div>
        <div class="col-md-3">
          <label>Agency</label> <select class="form-control"
            id="agency_id" name="agency_id"></select>
        </div>
        <div class="col-md-2">
          <label>RO Date</label> <input type="text" class="form-control"
            name="ro_date" id="ro_date" placeholder="click to choose">
        </div>
        <div class="col-md-2">
          <label>RO No.</label> <input type="text" class="form-control"
            name="ro_number" id="ro_number">
        </div>
        <div class="col-md-2">
          <label>RO Amount</label> <input type="text" class="form-control"
            name="ro_amount" id="ro_amount">
        </div>
        </div>
        <div class="row">
        <div class="col-md-3">
          <label>Account</label>
          <select class="form-control" id="executive_id"
            name="executive_id"></select>
        </div>
				<div class="col-md-3">
          <label>Payment Peference</label>
          <select class="form-control" id="payment_peference"
            name="payment_peference"><option value="Cash">Cash</option>
					<option value="Cheque">Cheque/Draft</option>
				<option value="Online">Online</option></select>
        </div>
        <div class="col-md-3">
          <label>Remark</label>
          <textarea rows="1" cols="" class="form-control" name="remark" id="remark"></textarea>
        </div>

    </div>


  		</div>
      <div class="row panel-heading">
      <div class="col-md-6">Deal Details</div>
			  <div class="col-md-6 text-right"><a href="#" onclick="additem();"><i class="fa fa-plus hover-rotate"></i></a>
  </div>
      </div>
  		<div class="panel-body">

        <div class="row">
          <div class="col-md-2">
            <label>Property</label> <select class="form-control"
              name="item_id" id="item_id"></select>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label>Time Segment</label> <select class="form-control"
                name="time_slot[]" id="time_slot" multiple>
                <option value="NA">NA</option>
                <option value="RODP (6 AM 12 AM)">6AM-12AM</option>
                <option value="Morning Prime Time(7 AM 10 AM)">7AM-10AM</option>
                <option value="Noon Prime Time (10 AM 4 PM)">10AM-4PM</option>
                <option value="Evening Prime Time(4 PM 7 PM)">4PM-7PM</option>
                <option value="Super Prime Time (7 PM 10 PM)">7PM-10PM</option>
                <option value="Night Prime Time (10 PM 12 PM)">10PM-12PM</option>
                  <option value="Night Slot (12 PM 6 AM)">12PM-6AM</option>

              </select>
            </div>

        </div>
        <div class="col-md-2">
          <label>From Date</label> <input type="text" class="form-control"
            name="from_date" id="from_date" placeholder="From Date">
        </div>
        <div class="col-md-2">
          <label>To Date</label> <input type="text" class="form-control"
            name="to_date" id="to_date" placeholder="To date">
        </div>
        <div class="col-md-2">
          <label>Units
          </label> <input type="number" class="form-control"
            name="units" id="units">
        </div>
        <div class="col-md-2">
          <label>Rate</label> <input type="number" class="form-control"
            id="rate" name="rate">
        </div>
      </div>

  	</section>
	{{ Form::close()}}
  	<section class="panel panel-default" id="item-div" >
      <div class="table-responsive" id="items">
        <table class="table table-striped m-b-none table-bordered">
          <thead>
            <tr>
              <th>Property</th>
              <th>Time Segment</th>
              <th>Duration</th>
              <th>Units</th>
              <th>Rate</th>
              <th>Amount</th>
              <th>Delete</th>

            </tr>
          </thead>
          <tbody id="item-list"></tbody>
        </table>
      </div>

    </section>

		<section class="panel panel-default" id="deal_details_div" >
			<div class="table-responsive" id="items">
				<table class="table table-striped m-b-none table-bordered">
					<thead>
						<tr>
							<th>Deal Id</th>
							<th>Client</th>
							<th>Agency</th>
							<th>Executive</th>
							<th>Ro Detail</th>
							<th>Amount</th>
							<th>Remarks</th>
							<th>Action</th>

						</tr>
					</thead>
					<tbody id="deal_details_list"></tbody>
				</table>
			</div>

		</section>
		<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog"
			aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>

					</div>
					<div class="modal-body">
						<div class="table-responsive" id="items">
			        <table class="table table-striped m-b-none table-bordered">
			          <thead>
			            <tr>
			              <th>Property</th>
			              <th>Time Segment</th>
			              <th>Duration</th>
			              <th>Units</th>
			              <th>Rate</th>
			              <th>Amount</th>
			            </tr>
			          </thead>
			          <tbody id="deal_details"></tbody>
			        </table>
			      </div>
					</div>
					</div>
					</div>
	</div>

{{HTML::script('packages/script/new_deal.js');}} @stop
