window.onload = function(){
	$('#overdue_jp_report').addClass('active');
	overdueStation();

}
var overdueOn =0;
$("#overdue_on").on("change", function () {
 overdueOn = $('#overdue_on').val();
	overdueStation();
});
var token =  $("input[name=_token]").val();
function overdueStation(){
	//$('#overdueBtn').attr('onclick','loadCrossingPointInspectionLedger()').attr('class','btn btn-success btn-block').html('Ledger');
	//$('#table_level').empty().html('<h5><span class="label label-danger">Joint Point & Crossing Inspection Overdue Station</span></h5>');

	$('#table_header').empty().html('<tr><th>Station Code</th><th>Role</th><th>Designation</th><th>Maintenance by</th><th>Last Inspection Date</th><th>Next Inspection Date Due</th></tr>');

	$('#data-list').html('<tr><td colspan="6"><center><i class="fa fa-spinner fa-spin fa-3x"></i></center></td></tr>')

	$.ajax({
		url: '/schedule/overduecrossinginspection',
		type: 'POST',
		data: {'overdue_on':overdueOn,'_token':token},
		dataTtype: 'JSON',
		success: function(data){
			$('#data-list').empty();
			var count=0;
			 for (var i in data){
				 count=count+1;
				 var next_date_row=moment(data[i].due_date_of_inspection).format('DD/MM/YY');

				 if(data[i].role=='SS'){
				 	next_date_row=next_date_row+'  for IC';
				 }else{
					 next_date_row=next_date_row+'  for SS';
				 }
				var row = '<tr>'
						+'<td>'+data[i].code+'</td>'
						+'<td>'+data[i].role+'</td>'
						+'<td>'+data[i].designation+'</td>'
						+'<td>'+data[i].maintenance_by+'</td>'
						+'<td>'+moment(data[i].date_of_inspection).format('DD/MM/YY')+'</td>'
						+'<td class="text text-danger">'+next_date_row+'</td>'
						+'</tr>';

				$('#data-list').append(row);


			}
			$('#total_overdue').empty().append('Total Overdue: '+count);
			$('#overdue_jpxing_count').empty().append(count);
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
  newWin.document.write('<h3>Overdue Joint Point & X-ing Station on '+moment(new Date()).add(overdueOn, 'days').format('DD/MM/YY')+'</h3>');
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
