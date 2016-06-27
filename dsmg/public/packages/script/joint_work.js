window.onload = function(){
	$('#joint_work').addClass('active');
	$('#date_of_jointwork').datepicker({dateFormat: 'dd-mm-yy', maxDate: "+0D"});
	$("#date_of_jointwork").datepicker("setDate", new Date());
	allStation();
	loadjointworkledger();
}
var token =  $("input[name=_token]").val();

function allStation(){
	$.ajax({
		url: '/common/allstations',
		type: 'GET',
		datatype: 'JSON',
		success: function(data){
			//$('#station_id').append('<option value="0">--station code--</option>');
			for (var i in data){
				$('#station_id').append('<option value="'+data[i].id+'">'+data[i].code+'</option>');
			}
		}
	});
}
function saveData(){
	var formData = $('form#jointwork-form').serializeArray();
	$('#saveBtn').attr('disabled',true).html('<i class="fa fa-spinner fa-spin"></i>');
		 $.ajax({
			url:'/schedule/savejointwork',
			type: 'POST',
			dataTtype: 'JSON',
			data: formData,
			success: function(data){
				console.log(data)
				$('#saveBtn').attr('disabled',false).html('save');
				if(data!=0){
					alertify.success('data saved successfully');
					loadjointworkledger();
				}
				else{
					alertify.error('Not able to save at this moment.Please contact administrator!');
				}
			}
		});
	}
function loadjointworkledger(){
	$('#data-list').html('<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-3x"></i></center></td></tr>')

	$.ajax({
		url: '/schedule/jointworkledger',
		type: 'GET',
		dataTtype: 'JSON',
		success: function(data){
			$('#data-list').empty();
			 for (var i in data){
				 var row = '<tr>'
						+'<td class="hidden id">'+data[i].id+'</td>'
						+'<td>'+data[i].code+'</td>'
						+'<td>'+moment(data[i].date_of_jointwork).format('DD/MM/YY')+'</td>'
						+'<td>'+data[i].remarks+'</td>'
						+'<td><button class="del btn btn-rounded btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></button></td>'
						+'</tr>';
				$('#data-list').append(row);
			}
		}
	});
}
$("#data-list").on("click", ".del", function(){
	$deleting = $(this);
	var id = $deleting.closest("tr").find(".id").text();
	alertify.confirm('Please confirm your delete!').set('onok', function(closeEvent){
				$deleting.html('&nbsp;&nbsp;<i class="fa fa-spinner fa-spin fa-lg"></i>&nbsp;&nbsp;');
				delete_data(id);
	});
});
function delete_data(id){
	$.ajax({
		url: '/schedule/deletejointworkledger/'+id,
		type: 'GET',
		dataType: 'JSON',
		success: function(data){
				$deleting.closest("tr").remove();
				alertify.error("Data Deleted");

		}
	});
}
