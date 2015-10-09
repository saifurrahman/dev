@extends('layouts.app') @section('content')
<section class="row m-b-md">
	<div class="col-sm-6">
		<h3 class="m-b-xs text-black">Commercial Billing</h3>
	</div>
</section>


<br>
<div class="row" id="schedulebill-div">
	<div class="col-md-12">
		<section class="panel panel-default">
			<header class="panel-heading"> Search Schedule </header>
			<div class="row wrapper">
					<div class="col-sm-3">
						<select class="form-control"
							id="agency_id" name="agency_id" ></select>

					</div>
					<div class="col-sm-3">
						<select class="form-control"
							id="client_id" name="client_id"></select>
					</div>

				<div class="col-md-2 m-b-xs">
					<input type="text" class="form-control" name="from_date"
						id="from_date" placeholder="click to choose">
				</div>
				<div class="col-md-2">
					<input type="text" class="form-control" name="to_date" id="to_date"
						placeholder="click to choose">
				</div>
				<div class="col-md-2">
					<button type="search" class="btn btn-success" id="sBtn"
						onclick="search();">search</button>
				</div>
			</div>
			<table class="table table-striped b-t b-light">
				<thead>
					<tr>
						<th>Deal ID</th>
						<th>Property</th>
						<th>Details</th>
						<th>Duration(Days)</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody id="deal-list"></tbody>
				<tfoot id="tax-part">

				</tfoot>

			</table>
		</section>
	</div>
	<div class="col-md-3">
		<button class="btn btn-s-md btn-dark" type="button" id="billBtn"
			onclick="showBillDetails();">Generate Bill</button>
	</div>
</div>
<div class="row" id="bill-row">
	<div class="col-md-12">
		<section class="panel panel-default">
			<div class="row wrapper text-left bg-primary" id="deal-info"></div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-2">
						<label>From Date</label> <input type="text" class="form-control"
							name="from_date" id="date_from" readonly="readonly"> <input
							type="hidden" id="deal_id" name="deal_id">
					</div>
					<div class="col-md-2">
						<label>To Date</label> <input type="text" class="form-control"
							name="to_date" id="date_to" readonly="readonly">
					</div>
					<div class="col-md-2">
						<label>Total Spots</label> <input type="text" class="form-control"
							name="spot" id="spot" readonly="readonly">
					</div>
					<div class="col-md-2">
						<label>Total Secs</label> <input type="text" class="form-control"
							name="total_duration" id="total_duration" readonly="readonly">
					</div>
					<div class="col-md-2">
						<label>Rate</label> <input type="number" class="form-control"
							name="rate" id="rate"  readonly="readonly">
					</div>
					<div class="col-md-2">
						<label>Net Amount</label> <input type="number"
							class="form-control" name="net_amount" id="net_amount" readonly="readonly">
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-2">
						<label>Discount</label> <input type="number" class="form-control"
							name="discount" id="discount">
					</div>
					<div class="col-md-2">
						<label>Service Tax@14%</label> <input type="number"
							class="form-control" name="service_tax" id="service_tax" readonly="readonly">
					</div>
					<div class="col-md-2">
						<label>Addl Edu Cess @2%</label> <input type="number"
							class="form-control" name="edu_cess" id="edu_cess" readonly="readonly">
					</div>
					<div class="col-md-2">
						<label>Billed Amount</label> <input type="number"
							class="form-control" name="billed_amount" id="billed_amount" readonly="readonly">
					</div>
					<div class="col-md-2">
						<label></label>
						<button class="btn btn-success btn-block"
							onclick="saveTempBill();">save</button>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>


{{HTML::script('packages/script/billing.js');}} @stop
