@extends('layouts.app') @section('content')
<section class="row m-b-md">
	<div class="col-sm-10">
		<div class="row">
			<div class="col-md-4">
				<h3 class="m-b-xs text-black">Schedule Varification</h3>
			</div>
			<div class="col-md-3">
				<label></label> <input type="text" class="form-control"
					id="schedule_date" name="schedule_date"
					placeholder="click to choose">
			</div>
			<div class="col-sm-5 text-right text-left-xs m-t-md">
				<div class="btn-group">
					<button class="btn btn-icon b-2x btn-primary btn-rounded "
						onclick="excelUpload();">
						<i class="fa fa-upload" title="upload excel file"></i>
					</button>
				</div>
				<input type="file" id="xlf" name="xlfile">
			</div>
		</div>
	</div>
</section>
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped m-b-none table-hover">
			<thead>
				<tr>
					<!-- 					<th>Date</th> -->
					<th>Time Slot</th>
					<th>Break</th>
					<th>Ad ID</th>
					<th>Duration (<small>in secs.</small>)
					</th>
					<th>Caption</th>
					<th>Telecast Time</th>
					<th>Remraks</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody id="schecdule_table"></tbody>
		</table>
	</div>
</div>

<!-- telecast modal -->
<div class="modal fade" id="teleModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Telecast Time</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Telecast Time</label> <input type="hidden" id="teleID"
								name="id"> <select class="form-control" id="tc_time"
								name="tc_time"></select>

						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="tBtn"
					onclick="saveTelecast();">Save</button>
			</div>
		</div>
	</div>
</div>
<!-- remartk modal -->
<div class="modal fade" id="remarkModal" tabindex="-1" role="dialog"
	aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Put Telecast Time</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						{{Form::open(array('','id'=>'remark-form'))}}
						<div class="form-group">
							<label>Remark</label> <input type="hidden" id="reID" name="id">
							<textarea rows="2" cols="" name="remark" id="remark"
								class="form-control"></textarea>

						</div>

						{{ Form::close()}}
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="reBtn"
					onclick="saveRemark();">Save</button>
			</div>
		</div>
	</div>
</div>
{{HTML::script('packages/script/sch_varification.js');}}
{{HTML::script('packages/js/shim.js');}}
{{HTML::script('packages/js/xls.js');}}
{{HTML::script('packages/script/upload.js');}} @stop
