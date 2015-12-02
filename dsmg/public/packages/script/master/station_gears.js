window.onload = function() {
	$('#stn_gear').addClass('active');
	get_all_stations();
	get_all_gear_type();
		 get_all_assign_gear(2);
};

var station_id;
var token =  $("input[name=_token]").val();

function get_all_stations(){
	$.ajax({
		url: '/common/allstations',
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
		 //get_all_assign_gear(station_id);
	});
}
function get_all_gear_type(){
	$.ajax({
		url: '/common/allgearcode',
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
	$('#railway_gears_list').html('<tr><td colspan="4" style="text-align: center;margin-top: 10px;"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
	$.ajax({
		url: '/common/allassigngear',
		type: 'POST',
		dataType: 'JSON',
		data: {'station_id':station_id,'_token':token},
		success: function(data){
			$('#railway_gears_list').empty();
			for(var i in data){

				var row = '<tr>'
					+'<td>'+data[i].code+'</td>'
					+'<td>'+data[i].gear_no+'</td>'
					+'</tr>';
				$('#railway_gears_list').append(row);
			}
		}
	});
}

function save_gear(){
	var station_id = $('#station_id').val();
	var gear_type_id = $('#gear_type_id').val();
	var gear_no = $('#gear_no').val();
	if(gear_type_id != 0 && gear_no.length != 0){
		$('#save_gear_btn').attr('disabled',true).html('Save');
		$.ajax({
			url: '/common/savestationgear',
			type: 'POST',
			dataTtype: 'JSON',
			data: {'station_id':station_id,'gear_type_id':gear_type_id,'gear_no':gear_no,'_token':token},
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
