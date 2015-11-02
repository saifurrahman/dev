window.onload = function(){
	//$('#ro').addClass('active');
	$('#inspection_date').datepicker({dateFormat: 'dd-mm-yy', maxDate: "+0D"});
	$("#inspection_date").datepicker("setDate", new Date());

	allStation();
	loadCrossingPointInspectionLedger();

}
var token =  $("input[name=_token]").val();
function allStation(){
	$.ajax({
		url: '../common/allstations/',
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


function loadCrossingPointInspectionLedger(){
	$('#data-list').html('<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-3x"></i></center></td></tr>')

	$.ajax({
		url: '../schedule/allcrossinginspectionledger/',
		type: 'GET',
		dataTtype: 'JSON',
		success: function(data){
			$('#data-list').empty();
			 for (var i in data){
				var row = '<tr>'
						+'<td class="hidden id">'+data[i].id+'</td>'
						+'<td>'+data[i].code+'</td>'
						+'<td>'+data[i].role+'</td>'
						+'<td>'+moment(data[i].date_of_inspection).format('ll')+'</td>'
						+'<td>'+moment(data[i].due_date_of_inspection).format('ll')+'</td>'
						+'<td><button class="del btn btn-rounded btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></button></td>'
						+'</tr>';
				$('#data-list').append(row);
			}
		}
	});

}
function overdueStation(){
	$('#data-list').html('<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-3x"></i></center></td></tr>')

	$.ajax({
		url: '../schedule/overduecrossinginspection/',
		type: 'GET',
		dataTtype: 'JSON',
		success: function(data){
			$('#data-list').empty();
			 for (var i in data){
				var row = '<tr>'
						+'<td class="hidden id">'+data[i].id+'</td>'
						+'<td>'+data[i].code+'</td>'
						+'<td>'+data[i].role+'</td>'
						+'<td>'+moment(data[i].date_of_inspection).format('ll')+'</td>'
						+'<td>'+moment(data[i].due_date_of_inspection).format('ll')+'</td>'
						+'</tr>';
				if(moment(data[i].due_date_of_inspection)<= new Date()){
				$('#data-list').append(row);
			 }
			}
		}
	});

}


 //save form data
 var token =  $("input[name=_token]").val();

 function saveData(){
 	var formData = $('form#crossing-form').serializeArray();

	$('#saveBtn').attr('disabled',true).html('<i class="fa fa-spinner fa-spin"></i>');

		 $.ajax({
			url:'../schedule/savecrossingdata/',
			type: 'POST',
			dataTtype: 'JSON',
			data: formData,
			success: function(data){

				$('#saveBtn').attr('disabled',false).html('save');
				if(data!=0){
					alertify.success('data saved successfully');
					loadCrossingPointInspectionLedger();
				}
				else{
					alertify.error('please input  datas');
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
		url: '../schedule/deletecrossinginspection/',
		type: 'POST',
		dataType: 'JSON',
		data: {'id':id,'_token':token},
		success: function(data){
				$deleting.closest("tr").remove();
				alertify.error("Data Deleted");

		}
	});
}
$("#excel").click(function() {
	//alert(1);
	$("#data-list").table2excel({
		exclude : ".noExl",
		name : "Coommercial Schedule"
	});
});
