<aside class="right-side">
	<section class="content-header">
		<h1>Gears Master</h1>
		<ol class="breadcrumb"></ol>
	</section>
	<section class="content">
		<div class="row pagemenu">
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
		<div class="row">
			<div class="col-md-12" style="padding-right: 0;">
				<div class="box box-danger">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th style="width: 20%;">Station Code</th>
									<th style="width: 20%;">Gear Code</th>
									<th style="width: 25%;">Gear No</th>
									<th style="width: 35%;">Failure History</th>
								</tr>
							</thead>
							<tbody id="railway_assignedGear_list"></tbody>
						</table>
					</div>
				</div>
			</div>
				<div style="margin: 0 10px 0 10px;">
		</div>
	</section>
</aside>

<div class="modal fade" id="set_failureModal" tabindex="-1"
	role="dialog" aria-labelledby="set_failureModalLabel"
	aria-hidden="true" data-backdrop="false">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Add Failure Details</h4>
			</div>
			<div class="modal-body">
				<form id="set_failure_form">
					<div class="form-group">
						<input type="hidden" class="form-control"
							id="set_failure_station_gear_id" name="station_gear_id"> <label>Failure
							Date</label> <input type="text" class="form-control"
							id="failure_date" name="failure_date">
					</div>
					<div class="form-group">
						<label>Failure Reason</label> <input type="text"
							class="form-control" name="failure_type">
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-primary btn-block"
							id="set_failure_btn" onclick="set_failure();">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$('#setting_li, #gear_master_li').addClass('active');
$('#setting_sub_ul').css('display', 'block');
$('#next_maintenance_date, #failure_date').datepicker({dateFormat: 'dd-mm-yy'});
window.onload = function() {
	get_all_stations();
	get_all_gear_type();
};

var station_id;

function get_all_stations(){
	$.ajax({
		url: '<?php echo URL;?>settings/getAllStations/',
		type: 'POST',
		dataType: 'JSON',
		success: function(data){
			$('#station_id').empty();
			for(var i in data){
			  $('#station_id').append('<option value="'+data[i].id+'">'+data[i].code+'</option>');
			}
		}
	}).promise().done(function() {
		 station_id = $('#station_id').val()
		 get_all_assign_gear(station_id);
	});
}
function get_all_gear_type(){
	$.ajax({
		url: '<?php echo URL;?>settings/get_all_gear_type/',
		type: 'POST',
		dataType: 'JSON',
		success: function(data){
			$('#gear_type_id').empty().append('<option value="0">Gear Type</option>');
			for(var i in data){
			  $('#gear_type_id').append('<option value="'+data[i].id+'">'+data[i].code+'</option>');
			}
		}
	});
}

function get_all_assign_gear(station_id){
	$('#railway_assignedGear_list').html('<tr><td colspan="4" style="text-align: center;margin-top: 10px;"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
	$.ajax({
		url: '<?php echo URL;?>gear/get_all_assign_gear/',
		type: 'POST',
		dataType: 'JSON',
		data: {'station_id':station_id},
		success: function(data){
			$('#railway_assignedGear_list').empty();
			for(var i in data){
				var last_failure = '';
				if(data[i].failure_date!= null){
					last_failure = data[i].failure_type+' on '+data[i].failure_date;
				}
				var row = '<tr>'
					+'<td class="id hidden">'+data[i].id+'</td>'
					+'<td class="station_id hidden">'+data[i].station_id+'</td>'
					+'<td>'+data[i].stn_code+'</td>'
					+'<td class="gear_type_id hidden">'+data[i].gear_type_id+'</td>'
					+'<td>'+data[i].gear_code+'</td>'
					+'<td class="gear_no_edit"><span class="gear_no pull-left">'+data[i].gear_no+'</span><button class="edit btn btn-default btn-xs pull-right"><i class="fa fa-edit"></i></button></td>'
					+'<td><button class="failurehistory btn btn-default btn-xs pull-left">Failure History</button><button class="setFailuredate btn btn-danger btn-xs pull-right">Set Date</button></td>'
					+'</tr>';
				$('#railway_assignedGear_list').append(row);
			}
		}
	});
}

var edit = '';
$("#railway_assignedGear_list").on("click", ".edit", function(){
	 $edit = $(this);
	 var id = $edit.closest("tr").find(".id").text();
	 var gear_no = $edit.closest("tr").find(".gear_no").text();
	 $edit.parent().html('<div class="input-group"><input type="hidden" class="edit_id" name="id" value="'+id+'"><input type="text" class="editGearNo form-control input-sm" value="'+gear_no+'"><span class="input-group-btn"><button class="updateGearBtn btn btn-default btn-sm" type="button"><i class="fa fa-save"></i></button></span></div>');
});

var $updateGearBtn = '';
$("#railway_assignedGear_list").on("click", ".updateGearBtn", function(){
	 $updateGearBtn = $(this);
	 var id = $updateGearBtn.closest("td").find('.edit_id').val();
	 var gearNo = $updateGearBtn.closest("td").find('.editGearNo').val();
	 $updateGearBtn.closest("td").html('<span class="gear_no pull-left">'+gearNo+'</span><button class="edit btn btn-default btn-xs pull-right"><i class="fa fa-edit"></i></button>');
	 update_gear(id,gearNo);
});

var $setFailuredate = '';
$("#railway_assignedGear_list").on("click", ".setFailuredate", function(){
	 $setFailuredate = $(this);
	 var id = $setFailuredate.closest("tr").find(".id").text();
	 $('#set_failure_station_gear_id').val(id);
	 $('#set_failureModal').modal('show');
});



function save_gear(){
	var station_id = $('#station_id').val();
	var gear_type_id = $('#gear_type_id').val();
	var gear_no = $('#gear_no').val();
	if(gear_type_id != 0 && gear_no.length != 0){
		$('#save_gear_btn').attr('disabled',true).html('Save');
		$.ajax({
			url: '<?php echo URL;?>gear/assign_gear/',
			type: 'POST',
			dataTtype: 'JSON',
			data: {'station_id':station_id,'gear_type_id':gear_type_id,'gear_no':gear_no},
			success: function(data){
				$('#gear_type_id').val(0);
				$('#gear_no').val('');
				alertify.success("Assigned Successfully");
				$('#save_gear_btn').attr('disabled',false).html('Save');
				$('#span_form').hide();$('#span_search').show();
				get_all_assign_gear(station_id);
			}
		});
	}
	else{
		alertify.error('Fill the form correctly');
	}
}

function set_failure(){
	var formData = $('form#set_failure_form').serializeArray();
	console.log(formData);
	$('#set_failure_btn').attr('disabled',true);
	$.ajax({
		url: '<?php echo URL;?>gear/set_failure/',
		type: 'POST',
		dataTtype: 'JSON',
		data: formData,
		success: function(data){
			var failure_date = $('#failure_date').val();
			$setFailuredate.parent().prepend(failure_date);
		 	$('form#set_failure_form').each(function(){this.reset();});
			$('#set_failure_btn').attr('disabled',false);
			$('#set_failureModal').modal('hide');
		}
	});
}
function update_gear(id,gearNo){
	$.ajax({
		url: '<?php echo URL;?>gear/update_gear/',
		type: 'POST',
		dataTtype: 'JSON',
		data: {'id':id, 'gear_no':gearNo},
		success: function(data){

		}
	});
}
</script>
