window.onload = function() {
	get_all_stations();
	get_all_gear_type();
};

var station_id;

function get_all_stations(){
	$.ajax({
		url: '/common/allstations/',
		type: 'GET',
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
		url: '/common/allgearcode/',
		type: 'GET',
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
