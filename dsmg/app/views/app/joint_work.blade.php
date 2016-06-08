@extends('layouts.app') @section('content')
<div class="row">
	  <div class="col-md-11">
			<h3>Joint Work</h3>
					</div>
					
</div>

{{Form::open(array('url' => ' ','id'=>'jointwork-form','class'=>'form-horizontal' , 'method' => 'post'))}}
<div class="row" id="jointwork-form">
				<div class="col-md-2">
					<label class="small">Station</label>
						<div class="form-group">
							<select class="form-control" id="station_id" name="station_id"></select>
				</div>
			</div>
      <div class="col-md-2">
        <label class="small">Date</label>
          <div class="form-group">
            <input type="text" class="form-control" name="date_of_jointwork" id="date_of_jointwork">
      </div>
    </div>
    <div class="col-md-4">
      <label class="small">Remark</label>
        <div class="form-group">
          <input type="text-area" class="form-control" name="remarks" id="remarks">
    </div>
  </div>
  <div class="col-md-2">
    <label></label>
    <button type="button" onclick="saveData();" id="saveBtn" class="btn btn-success btn-block">save</button>
  </div>
</div>
{{ Form::close()}}
<div class="row" id="joint_work_div">
			<div class="col-md-12">
				<label id="table_level" class="label label-success">Joint work ledger</label>
				<div class="table-responsive">
					<table id="jointwork_table" class="table table-hover table-bordered" border="1" cellpadding="5" cellspacing="0">
						<thead id="table_header">
							<tr>
								<th>Station Code</th>
								<th>Date of Joint work </th>
								<th>Remarks</th>
								<th>Action</th>

						</thead>
						<tbody id="data-list"></tbody>
					</table>
				</div>
			</div>
</div>

{{HTML::script('packages/script/joint_work.js');}} @stop
