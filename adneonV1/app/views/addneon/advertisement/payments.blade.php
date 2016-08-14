@extends('layouts.app') @section('content')
<section class="row m-b-md">
	<div class="col-sm-6">
		<h3 class="m-b-xs text-black">Payments <span class="m-b-xs text-danger pull-right" id="total_payments"></span></h3>
	</div>
	<div class="col-sm-6 text-right text-left-xs m-t-md">
		<div class="btn-group">
			<button class="btn btn-icon b-2x btn-primary btn-rounded hover "
				onclick="accountsForm();">
				<i class="fa fa-plus hover-rotate"></i>
			</button>
		</div>
	</div>
</section>
<div class="row" id="client-div">
	<div class="col-sm-12">
		<section class="panel panel-default">
			<header class="panel-heading font-bold">Payments</header>
			<div class="panel-body">
				{{Form::open(array('url' => ' ','id'=>'payment-form','class'=>'form-horizontal' , 'method' => 'post'))}}
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-sm-4">Agency</label>
						<div class="col-sm-8">
							<select class="form-control"
								id="agency_id" name="agency_id"></select>

						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Client</label>
						<div class="col-sm-8">
							<select class="form-control"
								id="client_id" name="client_id"></select>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-4">Bill No</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="bill_id"
								id="bill_id" placeholder="bill_id" >
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Amount</label>
						<div class="col-sm-8">
							<input type="number" class="form-control" name="amount"
								id="amount" placeholder="amount" required="required">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">TDS</label>
						<div class="col-sm-8">
							<input type="number" class="form-control" name="tds"
								id="tds" placeholder="tds" required="required">
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-sm-4">Payment Date</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="payment_date"
								id="payment_date" placeholder="payment_date" readonly="readonly" required="required">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Payment Mode</label>
						<div class="col-sm-8">
							<select rows="6" cols="" class="form-control"
								name="payment_mode" id="payment_mode">
								<option value="Cash">Cash</option>
								<option value="Cheque">Cheque</option>
								<option value="Online">Online</option>
								<option value="Draft">Draft</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">instrument_number</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="instrument_number"
								id="instrument_number" placeholder="instrument_number">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">instrument_date</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="instrument_date"
								id="instrument_date" placeholder="instrument_date"
								readonly="readonly">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Remarks</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="remarks"
								id="remarks" placeholder="remarks">
						</div>
					</div>

					<div class="col-md-offset-2">
						<button type="button" class="btn btn-success" id="saveBtn"
							onclick="savePayments();">Save</button>
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

			<div class="panel-body">
				<table class="table table-striped m-b-none" id="payment_table">
					<thead>
						<tr>
							<th>Date</th>
							<th>Agency</th>
							<th>Client</th>
							<th>Payment Mode</th>
							<th>Amount</th>
							<th>TDS</th>
							<th>Details</th>
							<th>Remarks</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody id="transcation-list"></tbody>
				</table>
			</div>
		</section>
	</div>
</div>
{{HTML::script('packages/script/payments.js');}} @stop
