@extends('layouts.app') @section('content')
<section class="row m-b-md">
	<div class="col-sm-10">
		<h3 class="m-b-xs text-black">Commercial Billing</h3>
	</div>
	<div class="col-sm-2">

		<h3><button type="button" class="btn btn-info" id="newBill">New Bill</button></h3>
	</div>
</section>

<section class="" id="search_field" >
<div class="row">
				<div class="col-sm-2">
					<input class="form-control"
							id="deal_id" name="deal_id" placeholder="Deal id"></input>
				</div>
					<div class="col-sm-3">
						<input class="form-control"
								id="from_date" name="from_date" placeholder="from date"></input>

					</div>
					<div class="col-sm-3">
						<input class="form-control"
							id="to_date" name="to_date" placeholder="to date"></input>
					</div>
				<div class="col-md-2">
					<button type="search" class="btn btn-success" id="sBtn"
						onclick="search();">search</button>
				</div>

				<div class="col-md-2">

						<button  class="btn btn-danger pull-right" id="savebillBtn">Save Bill</button>

				</div>

</div>
</section>

<br>
<section class="" id="generate_bill_section" >

		<div class="row">
			<div class="col-md-4" id="client_details">


			</div>
			<div class="col-md-4" id="agency_details">


			</div>


		</div>
		<div class="row">
			<div class="col-md-12">

				<h5>Deal Details</h5>
				<table class="table table-striped m-b-none table-bordered">
				<thead>
					<tr>
						<th>RO no</th>
						<th>Ro Date</th>
						<th>Ro Amount</th>
						<th>Activity Period</th>
						<th>Terms</th>
					</tr>
				</thead>
				<tbody id="deal_details">

				</tbody>
			</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">

				<h5>Schedule Details</h5>
				<table class="table table-striped m-b-none table-bordered">
				<thead>
					<tr>
						<th>Ad Id</th>
						<th>Caption</th>
						<th>Brand</th>
						<th>Duration</th>
						<th>Schedule Duration/Spots</th>
						<th>Telecast Duration/Spots</th>
					</tr>
				</thead>
				<tbody id="schedule_details">

				</tbody>
			</table>
			</div>
		</div>
		<br>
		<div class="row">
	    <div class="col-md-10" id="items">
        <table class="table table-striped m-b-none table-bordered">
          <thead>
            <tr>
              <th>Property</th>
              <th>Duration</th>
              <th>Units</th>
              <th>Rate</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody id="item_list">


					</tbody>
        </table>
      </div>
			<div class="col-md-2" id="agency_com_div">
					<label>Agency Commission </label>
					<select id="agency_com" class="form-control"><option value="0">0%</option><option value="10">10%</option><option value="15">15%</option><option value="20">20%</option></select>
			</div>
		</div>
</section>
<section class="" id="all_bills" >
<div class="row">
	<div class="col-md-12">

		<h4 class="text-success">Generated Bills</h4>
		<table class="table table-striped m-b-none table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th>Deal</th>
				<th>Agency</th>
				<th>Client</th>
				<th>Executive</th>
				<th>Ro Details</th>
				<th>Billing Period</th>
				<th>Bill Amount</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody id="all_bills_row">

		</tbody>
	</table>
	</div>
</div>
</section>

{{HTML::script('packages/script/billing.js');}} @stop
