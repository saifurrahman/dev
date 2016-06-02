window.onload = function(){
	$('#cablemeggering').addClass('active');
	$('#report_table').hide();
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
					loadCablemeggeringledger();
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

				 var today=moment(new Date()).format('DD/MM/YYYY');
				var meggering_date=moment(data[i].meggering_date).format('DD/MM/YYYY');
				var next_meggering_date=moment(data[i].next_meggering_date).format('DD/MM/YYYY');


				console.log(today+"-"+next_meggering_date);
			//	var days_to_overdue=daydiff(parseDate(today), parseDate(next_meggering_date));
				var days_to_overdue=moment(next_meggering_date).diff(today, 'days')+1
				console.log("="+days_to_overdue);
				var row = '<tr>'
						+'<td class="hidden id">'+data[i].id+'</td>'
						+'<td>'+data[i].code+'</td>'
						+'<td>'+data[i].type+'</td>'
						+'<td>'+meggering_date+'</td>'
						+'<td>'+next_meggering_date+'</td>'
						+'<td>'+data[i].days_to_overdue+'</td>'
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
$("#print_report").on("click", function () {
 printDiv();

});
function printDiv()
{
  var divToPrint=document.getElementById('cable_meggering_report');
  newWin= window.open("");
  //console.log(divToPrint.outerHTML);
  newWin.document.write('<h3>Cable Meggering Report on '+moment(new Date()).format('DD/MM/YY')+'</h3>');
  newWin.document.write(divToPrint.outerHTML);
  newWin.document.write('<small>Report generated by DSMG monitoring software (Tinsukia Division): all date format are in <b>dd/mm/yy</b></small>');
  newWin.print();
  //newWin.close();
}
$("#excel_report").click(function() {
	$("#cable_meggering_report").table2excel({
		exclude : ".noExl",
		name : "cablemeggeringreport",
    filename: "cablemeggeringreport"
	});
});

function parseDate(str) {
    var mdy = str.split('/');
    return new Date(mdy[2], mdy[0]-1, mdy[1]);
}

function daydiff(first, second) {
    return Math.round((second-first)/(1000*60*60*24));
}
