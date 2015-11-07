@extends('layouts.app') @section('content')

<div class="row">
			<div class="page-header">
				<h3>Station Gear Master</h3>
			</div>
</div>
<div class="row">
			<div class="col-md-3 col-xs-12">
				<select class="form-control" id="station_id"
					onchange="get_all_assign_gear(this.value);"></select>
			</div>
			<span id="span_form" style="display: none;">
				<div class="col-md-3 col-xs-12">
					<select class="form-control" id="gear_type_id"><option value="0">Select
							Type</option></select>
				</div>
				<div class="col-md-3 col-xs-12">
					<input type="text" class="form-control" id="gear_no"
						placeholder="Gear No">
				</div>
				<div class="col-md-3 col-xs-12">
					<button type="button" class="btn btn-primary btn-block pull-right"
						onclick="save_gear();" id="save_gear_btn">Save</button>
				</div>
			</span> <span id="span_search">
				<div class="col-md-6 col-xs-12"></div>
				<div class="col-md-3 col-xs-12">
					<button class="btn btn-primary pull-right"
						onclick="$('#span_form').show();$('#span_search').hide();">
						<i class="fa fa-plus"></i> Add Gears
					</button>
				</div>
			</span>

		</div>
{{HTML::script('packages/script/master/station_gears.js');}} @stop
