window.onload = function(){
	$('#paneltesting').addClass('active');
	$('#report_table').hide();
	$('#testing_date').datepicker({dateFormat: 'dd-mm-yy', maxDate: "+0D"});
	$("#testing_date").datepicker("setDate", new Date());
allPaneltestingstnlcgaten();
allsupervisors();
allsupervisorsdesig();
init();
loadPanelTestingLedger();
}


function init(){
	$('#designation').empty();
	$('#designation').append('<option value="DSTE/TSK">DSTE/TSK</option>');
	$('#designation').append('<option value="ADSTE/MXN">ADSTE/MXN</option>');
	$('#designation').append('<option value="ADSTE/TSK">ADSTE/TSK</option>');
	$('#maintenance_by').empty().append('<option value="NA">--NA--</option>');
}
var token =  $("input[name=_token]").val();


function saveData(){
	var formData = $('form#paneltesting-form').serializeArray();
	$('#saveBtn').attr('disabled',true).html('<i class="fa fa-spinner fa-spin"></i>');
		 $.ajax({
			url:'/schedule/savepaneltesting',
			type: 'POST',
			dataTtype: 'JSON',
			data: formData,
			success: function(data){
				console.log(data)
				$('#saveBtn').attr('disabled',false).html('save');
				if(data!=0){
					alertify.success('data saved successfully');
					loadPanelTestingLedger();
				}
				else{
					alertify.error('Not able to save at this moment.Please contact administrator!');
				}
			}
		});
}
function allPaneltestingstnlcgaten(){
	$.ajax({
		url: '/common/paneltestingstnlcgate',
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
var supervisors = new Array();
var supervisors_desig = new Array();

function choosingRole(){
	var role =$("#role").val();
	if(role=="Officer"){
		$('#designation').empty();
	 	$('#designation').append('<option value="DSTE/TSK">DSTE/TSK</option>');
		$('#designation').append('<option value="ADSTE/MXN">ADSTE/MXN</option>');
		$('#designation').append('<option value="ADSTE/TSK">ADSTE/TSK</option>');
		$('#maintenance_by').empty().append('<option value="NA">--NA--</option>');

	}else if (role=="Supervisor") {
				showSupervisorDesig(supervisors_desig);
				showSupervisor(supervisors);
	}

}

function allsupervisors(){
	$('#maintenance_by').empty();
 $.ajax({
	 url: '/common/allsupervisors',
	 type: 'GET',
	 dataTtype: 'JSON',
	 success: function(data){
		 supervisors=data;

	 }
 });
}
function showSupervisor(data){
	$('#maintenance_by').empty();
	$('#maintenance_by').append('<option value="NA">--NA--</option>');
	for(var i in data){
		$('#maintenance_by').append('<option value="'+data[i].name+'">'+data[i].name+'</option>');
	}
}
function showSupervisorDesig(data){
	$('#designation').empty();
	$('#designation').append('<option value="NA">--NA--</option>');
  for(var i in data){
 	 $('#designation').append('<option value="'+data[i].name+'">'+data[i].name+'</option>');
  }
}
function allsupervisorsdesig(){
	$('#designation').empty();
	 $.ajax({
	 url: '/common/allsupervisorsdesignation',
	 type: 'GET',
	 dataTtype: 'JSON',
	 success: function(data){
		 supervisors_desig=data;

	 }
 });
}
function loadPanelTestingLedger(){
	$('#overdueBtn').attr('onclick','overdueStation()').attr('class','btn btn-danger btn-block').html('overdue station');

	$('#table_level').empty().html('<h5><span class="label label-success">Panel Testing Ledger</span></h5>');
	$('#table_header').empty().html('<tr><th>Station/LC Gate</th><th>Role</th><th>Designation</th><th>Maintenance by</th><th>Last testing date</th><th>Next testing date</th><th>Delete</th></tr>');
	$('#data_list').html('<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-3x"></i></center></td></tr>')

	$.ajax({
		url: '/schedule/allpaneltestingledger',
		type: 'GET',
		dataTtype: 'JSON',
		success: function(data){
			$('#data_list').empty();
			 for (var i in data){
				 var next_date_row='<td>'+moment(data[i].testing_date).format('DD/MM/YY')+'</td>';

				var row = '<tr>'
						+'<td class="hidden id">'+data[i].id+'</td>'
						+'<td>'+data[i].code+'</td>'
						+'<td>'+data[i].role+'</td>'
						+'<td>'+data[i].designation+'</td>'
						+'<td>'+data[i].maintenance_by+'</td>'
						+'<td>'+moment(data[i].testing_date).format('DD/MM/YY')+'</td>'
						+next_date_row
						+'<td><button class="del btn btn-rounded btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></button></td>'
						+'</tr>';
				$('#data_list').append(row);
			}
		}
	});

}
function showReport(){
	$('#crossing-form').toggle();
	$('#ledger_table').toggle();
	$('#report_table').toggle();
	$('#data_report').html('<tr><td colspan="6"><center><i class="fa fa-spinner fa-spin fa-3x"></i></center></td></tr>')
	//$('#reportBtn').attr('disabled',true).html('<i class="fa fa-spinner fa-spin"></i>');
	$.ajax({
		url: '/schedule/cablemeggeringreport',
		type: 'GET',
		datatype: 'JSON',
		success: function(data){
			$('#reportBtn').attr('disabled',false).html('Report');
			//$('#station_id').append('<option value="0">--station code--</option>');
			$('#data_report').empty();
			 for (var i in data){
				var today=moment(new Date()).format('DD/MM/YY');
				var meggering_date=moment(data[i].meggering_date).format('DD/MM/YY');
				var next_meggering_date=moment(data[i].next_meggering_date).format('DD/MM/YY');
				var today= moment(new Date()).format('DD/MM/YY');
				var days_to_overdue=data[i].days_to_overdue;

				var row_color='<tr>';
				if(days_to_overdue<=0){
					row_color = '<tr class="text text-danger">'
				}
				var row = row_color+
						+'<td class="hidden id">'+data[i].id+'</td>'
						+'<td>'+data[i].code+'</td>'
						+'<td>'+data[i].type+'</td>'
						+'<td>'+meggering_date+'</td>'
						+'<td>'+next_meggering_date+'</td>'
						+'<td>'+data[i].days_to_overdue+'</td>'
						+'</tr>';

				$('#data_report').append(row);
			}
		}
	});

}
//delete data
$("#data_list").on("click", ".del", function(){
	$deleting = $(this);
	var id = $deleting.closest("tr").find(".id").text();
	alertify.confirm('Please confirm your delete!').set('onok', function(closeEvent){
				$deleting.html('&nbsp;&nbsp;<i class="fa fa-spinner fa-spin fa-lg"></i>&nbsp;&nbsp;');
				delete_data(id);
	});
});
function delete_data(id){
	$.ajax({
		url: '/schedule/deletepaneltestingledger/'+id,
		type: 'GET',
		dataType: 'JSON',
		success: function(data){
				$deleting.closest("tr").remove();
				alertify.error("Data Deleted");

		}
	});
}
