window.onload = function(){
	$('#cablemeggering').addClass('active');
	$('#inspection_date').datepicker({dateFormat: 'dd-mm-yy', maxDate: "+0D"});
	$("#inspection_date").datepicker("setDate", new Date());
	allCablemeggeringstnlcgate();
	loadCablemeggeringledger();
}
var token =  $("input[name=_token]").val();
function allCablemeggeringstnlcgate(){
	$.ajax({
		url: '/common/cablemeggeringstnlcgate',
		type: 'GET',
		datatype: 'JSON',
		success: function(data){
			//$('#station_id').append('<option value="0">--station code--</option>');
			for (var i in data){
				$('#station_id').append('<option value="'+data[i].id+'">'+data[i].stn_lc_gate+'</option>');
			}
		}
	});
}


function saveData(){
	var formData = $('form#crossing-form').serializeArray();
	$('#saveBtn').attr('disabled',true).html('<i class="fa fa-spinner fa-spin"></i>');
		 $.ajax({
			url:'/schedule/savecablemeggering',
			type: 'POST',
			dataTtype: 'JSON',
			data: formData,
			success: function(data){
				console.log(data)
				$('#saveBtn').attr('disabled',false).html('save');
				if(data!=0){
					alertify.success('data saved successfully');
				//	loadCrossingPointInspectionLedger();
				}
				else{
					alertify.error('Not able to save at this moment.Please contact administrator!');
				}
			}
		});
}
function loadCablemeggeringledger(){
	$('#data-list').html('<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-3x"></i></center></td></tr>')

	$.ajax({
		url: '/schedule/allcablemeggeringledger',
		type: 'GET',
		dataTtype: 'JSON',
		success: function(data){
			$('#data-list').empty();
			 for (var i in data){

				 var today=moment(new Date()).format('DD/MM/YY');





			//		 id":6,"stn_lc_gate_id":6,"type":"MC","meggering_date":"2016-05-10","next_meggering_date":"2017-05-10"
//,"remarks":"test","user_id":1,"created_at":"2016-05-23 11:54:47","updated_at":"2016-05-23 11:54:47","code"
//:"CKW"
				var meggering_date=moment(data[i].meggering_date).format('DD/MM/YY');
				var next_meggering_date=moment(data[i].next_meggering_date).format('DD/MM/YY');
				var days_to_overdue=moment(next_meggering_date).diff(meggering_date, 'days')   //

				var row = '<tr>'
						+'<td class="hidden id">'+data[i].id+'</td>'
						+'<td>'+data[i].code+'</td>'
						+'<td>'+data[i].type+'</td>'
						+'<td>'+meggering_date+'</td>'
						+'<td>'+next_meggering_date+'</td>'
						+'<td>'+days_to_overdue+'</td>'
						+'<td>'+data[i].remarks+'</td>'
						+'<td><button class="del btn btn-rounded btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></button></td>'
						+'</tr>';
				$('#data-list').append(row);
			}
		}
	});
}
//delete data
$("#data-list").on("click", ".del", function(){
	$deleting = $(this);
	var id = $deleting.closest("tr").find(".id").text();
	$deleting.html('&nbsp;&nbsp;<i class="fa fa-spinner fa-spin fa-lg"></i>&nbsp;&nbsp;');
	delete_data(id);
});
function delete_data(id){
	$.ajax({
		url: '/schedule/deletecablemeggeringledger/'+id,
		type: 'GET',
		dataType: 'JSON',
		success: function(data){
				$deleting.closest("tr").remove();
				alertify.error("Data Deleted");

		}
	});
}
