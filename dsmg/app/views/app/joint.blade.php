@extends('layouts.app') @section('content')

<div class="row">
			<div class="page-header">
				<h2>Joint Point and Crossing Inspection
				<button type="button" title="click to download as a excel" class="btn btn-default cmn_btn"
					onclick="download();">
					<i class="fa fa-download text-danger-dk"></i>
				</button>
			</h2>
			</div>
</div>

<div class="row" id="maintainance_form">
				<div class="col-md-3">
					<label class="small">Station</label>
						<div class="form-group">
							<select class="form-control" id="station_id" name="station_id"></select>
				</div>
			</div>

				<div class="col-md-3">
					<label class="small">Inspection By</label>
								<select class="form-control" id="role"
									name="role">
										<option value="SS">SS</option>
										<option value="IC">IC</option>
									</select>
				</div>

					<div class="col-md-3">
						<label class="small">Inspection Date</label>
						<input type="text" class="form-control" name="maintenance_by" id="maintenance_by">
					</div>
					<div class="col-md-1">
						<label></label>
						<button type="button" onclick="saveData();" id="saveBtn" class="btn btn-success btn-block">save</button>
					</div>

</div>
{{HTML::script('packages/script/agency.js');}} @stop
