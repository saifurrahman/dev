window.onload = function(){
	$('#jp_crossing').addClass('active');
	$('#inspection_date').datepicker({dateFormat: 'dd-mm-yy', maxDate: "+0D"});
	$("#inspection_date").datepicker("setDate", new Date());
	allStation();
	allsupervisors();
	allsupervisorsdesig();
	loadCrossingPointInspectionLedger();
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
	$('#table_header').empty().html('<tr><th>Station Code</th><th>Role</th><th>Designation by</th><th>Maintenance by</th><th>Last Inspection Date</th><th>Next Inspection Date Due</th><th>Delete</th></tr>');
	$('#data-list').html('<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-3x"></i></center></td></tr>')

	$.ajax({
		url: '/schedule/allcrossinginspectionledger',
		type: 'GET',
		dataTtype: 'JSON',
		success: function(data){
			$('#data-list').empty();
			 for (var i in data){
				 var next_date_row;
				 var today=moment(new Date()).format('DD/MM/YY');

				 //alert(today);
				 //	console.log(moment(data[i].due_date_of_inspection).format('DD/MM/YY')+'----'+today);
				  //console.log(moment(data[i].due_date_of_inspection)+'----'+new Date().getTime());
					//console.log(moment(data[i].due_date_of_inspection).isAfter(new Date().getTime()));
				 if(moment(data[i].due_date_of_inspection).isAfter(new Date().getTime())){
				 			next_date_row='<td>'+moment(data[i].due_date_of_inspection).format('DD/MM/YY')+'</td>';
					 }else{
						 next_date_row='<td class="text text-danger">'+moment(data[i].due_date_of_inspection).format('DD/MM/YY')+'</td>';

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
function overdueStation(){
	$('#overdueBtn').attr('onclick','loadCrossingPointInspectionLedger()').attr('class','btn btn-success btn-block').html('Ledger');
	$('#table_level').empty().html('<h5><span class="label label-danger">Joint Point & Crossing Inspection Overdue Station</span></h5>');

	$('#table_header').empty().html('<tr><th>Station Code</th><th>Role</th><th>Designation by</th><th>Maintenance by</th><th>Last Inspection Date</th><th>Next Inspection Date Due</th></tr>');

	$('#data-list').html('<tr><td colspan="6"><center><i class="fa fa-spinner fa-spin fa-3x"></i></center></td></tr>')

	$.ajax({
		url: '/schedule/overduecrossinginspection',
		type: 'GET',
		dataTtype: 'JSON',
		success: function(data){
			$('#data-list').empty();
			 for (var i in data){
				var row = '<tr>'
						+'<td>'+data[i].code+'</td>'
						+'<td>'+data[i].role+'</td>'
						+'<td>'+data[i].designation+'</td>'
						+'<td>'+data[i].maintenance_by+'</td>'
						+'<td>'+moment(data[i].date_of_inspection).format('DD/MM/YY')+'</td>'
						+'<td class="text text-danger">'+moment(data[i].due_date_of_inspection).format('DD/MM/YY')+'</td>'
						+'</tr>';
				if(moment(data[i].due_date_of_inspection)<= new Date()){
				$('#data-list').append(row);
			 }
			}
		}
	});

}


 function saveData(){
 	var formData = $('form#crossing-form').serializeArray();

	$('#saveBtn').attr('disabled',true).html('<i class="fa fa-spinner fa-spin"></i>');

		 $.ajax({
			url:'/schedule/savecrossingdata',
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
					alertify.error('Not able to save at this moment.Please contact administrator!');
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

function printoverdueStation()
{
  var divToPrint=document.getElementById('jp_xing_table');
  newWin= window.open("");
  console.log(divToPrint.outerHTML);
  newWin.document.write('<h3>Overdue Joint Point & X-ing Station on '+new Date()+'</h3>');
  newWin.document.write(divToPrint.outerHTML);
  newWin.document.write('<small>Report generated by DSMG monitoring software (Tinsukia Division)</small>');
  newWin.print();
  //newWin.close();
}
$("#print_report").on("click", function () {
 printDiv();

});
function printDiv()
{
  var divToPrint=document.getElementById('jp_xing_table');
  newWin= window.open("");
  //console.log(divToPrint.outerHTML);
  newWin.document.write('<h3>Overdue Joint Point & X-ing Station on '+new Date()+'</h3>');
  newWin.document.write(divToPrint.outerHTML);
  newWin.document.write('<small>Report generated by DSMG monitoring software (Tinsukia Division): all date format are in <b>dd/mm/yy</b></small>');
  newWin.print();
  //newWin.close();
}
$("#excel_report").click(function() {
	$("#jp_xing_table").table2excel({
		exclude : ".noExl",
		name : "maintainance_report",
    filename: "maintainance_report"
	});
});
