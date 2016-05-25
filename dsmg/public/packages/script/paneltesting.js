window.onload = function(){
	$('#paneltesting').addClass('active');
	$('#inspection_date').datepicker({dateFormat: 'dd-mm-yy', maxDate: "+0D"});
	$("#inspection_date").datepicker("setDate", new Date());
allPaneltestingstnlcgaten();
}
var token =  $("input[name=_token]").val();

function allPaneltestingstnlcgaten(){
	$.ajax({
		url: '/common/paneltestingstnlcgate',
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

function allsupervisors(){
	$('#maintenance_by').empty();
 $.ajax({
	 url: '/common/allsupervisors',
	 type: 'GET',
	 dataTtype: 'JSON',
	 success: function(data){
		 $('#maintenance_by').append('<option value="NA">--NA--</option>');
		 for(var i in data){
			 $('#maintenance_by').append('<option value="'+data[i].name+'">'+data[i].name+'</option>');
		 }
	 }
 });
}
function allsupervisorsdesig(){
	$('#designation').empty();
	 $.ajax({
	 url: '/common/allsupervisorsdesignation',
	 type: 'GET',
	 dataTtype: 'JSON',
	 success: function(data){
		 $('#designation').append('<option value="NA">--NA--</option>');
		 for(var i in data){
			 $('#designation').append('<option value="'+data[i].name+'">'+data[i].name+'</option>');
		 }
	 }
 });
}
function loadCrossingPointInspectionLedger(){
	$('#overdueBtn').attr('onclick','overdueStation()').attr('class','btn btn-danger btn-block').html('overdue station');

	$('#table_level').empty().html('<h5><span class="label label-success">Joint Point & Crossing Inspection Ledger</span></h5>');
	$('#table_header').empty().html('<tr><th>Station Code</th><th>Role</th><th>Designation</th><th>Maintenance by</th><th>Last Inspection Date</th><th>Next Inspection Date Due</th><th>Delete</th></tr>');
	$('#data-list').html('<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-3x"></i></center></td></tr>')

	$.ajax({
		url: '/schedule/allcrossinginspectionledger',
		type: 'GET',
		dataTtype: 'JSON',
		success: function(data){
			$('#data-list').empty();
			 for (var i in data){

				 var today=moment(new Date()).format('DD/MM/YY');

				 var next_date_row=moment(data[i].due_date_of_inspection).format('DD/MM/YY');


				 if(data[i].role=='SS'){
				 	next_date_row=next_date_row+'  for IC';
				}else{
					next_date_row=next_date_row+'  for SS';
				}

				 if(moment(data[i].due_date_of_inspection).isAfter(new Date().getTime())){
				 			next_date_row='<td >'+next_date_row+'</td>';
					 }else{
						 next_date_row='<td class="text text-danger">'+next_date_row+'</td>';

					 }

				var row = '<tr>'
						+'<td class="hidden id">'+data[i].id+'</td>'
						+'<td>'+data[i].code+'</td>'
						+'<td>'+data[i].role+'</td>'
						+'<td>'+data[i].designation+'</td>'
						+'<td>'+data[i].maintenance_by+'</td>'
						+'<td>'+moment(data[i].date_of_inspection).format('DD/MM/YY')+'</td>'
						+next_date_row
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
		url: '/schedule/deletecrossinginspection/'+id,
		type: 'GET',
		dataType: 'JSON',
		success: function(data){
				$deleting.closest("tr").remove();
				alertify.error("Data Deleted");

		}
	});
}
