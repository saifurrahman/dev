@extends('layouts.app') @section('content')
<section class="row m-b-md">
	<div class="col-sm-6">
		<h3 class="m-b-xs text-black">Commercial Billing</h3>
	</div>
</section>

<section class="" id="search_field" >
<div class="row">


				<div class="col-sm-3">
					<input class="form-control"
							id="deal_id" name="deal_id" ></input>

				</div>
					<div class="col-sm-3">
						<input class="form-control"
								id="from_date" name="from_date" ></input>

					</div>
					<div class="col-sm-3">
						<input class="form-control"
							id="to_date" name="to_date"></input>
					</div>


				<div class="col-md-3">
					<button type="search" class="btn btn-success" id="sBtn"
						onclick="search();">search</button>
				</div>



</div>
</section>
<br>
	<section class="" id="generate_bill_section" >

		<div class="row">
			<div class="col-md-6" id="client_details">


			</div>
			<div class="col-md-6" id="agency_details">


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
						<th>Details</th>
						<th>Activity Period</th>
						<th>Terms</th>
					</tr>
				</thead>
				<tbody id="deal_details">

				</tbody>
			</table>
			</div>
		</div>
		<br>
		<div class="row">
	    <div class="col-md-12" id="items">
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
		</div>
		<br>
		<br>

		<div class="row">
			<div class="col-md-12">







		Payments to be made in Favour of <strong>"Rockland Media and Communication Pvt Ltd".</strong><br>
		# State Bank of India, New Guwahati Branch<br>
		# A/c No. <strong>34514432516</strong> & IFS Code: <strong>SBIN0000221</strong><br>
		# PAN: <strong>AADCR5052M</strong><br>
		# Service Tax: <strong>AADCR5052MSD002</strong>


			</div>

		</div>
		<br>
				<div class="row">
					<div class="col-md-12">
						<button  class="btn btn-danger pull-right" id="savebillBtn">Save Bill</button>
					</div>
				</div>

	</section>

{{HTML::script('packages/script/billing.js');}} @stop
