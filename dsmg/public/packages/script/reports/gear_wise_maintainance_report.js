window.onload = function(){
  $('#gear_report').addClass('active');
//  get_maintenance_reports();
  get_all_stations();
  gearCode();
};
var token =  $("input[name=_token]").val();
function gearCode(){
	$.ajax({
		url: '/common/allgearcode',
		type: 'GET',
		dataTtype: 'JSON',
		success: function(data){
			$('#gear_code').empty();
			for(var i in data){
				$('#gear_code').append('<option value="'+data[i].id+'">'+data[i].code+'</option>');
			}
		}
	}).promise().done(function(data) {
        $select_station_id = $('#gear_code').selectize({
        	maxItems: null,valueField: 'id',labelField: 'code',searchField: 'code',options: data,create: false
        });
    });
}
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
	}).promise().done(function(data) {
        $select_station_id = $('#select_station_id').selectize({
        	maxItems: null,valueField: 'id',labelField: 'code',searchField: 'code',options: data,create: false
        });
    });
}

$(function(){
    $( "#from_date" ).datepicker({
      defaultDate: "+0D",
      maxDate: "+0D",
      changeMonth: true,
      dateFormat: 'dd-mm-yy',
      onClose: function( selectedDate ) {
        $( "#to_date" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    var fromDate =$( "#from_date" ).val();
    $( "#to_date" ).datepicker({
      minDate: fromDate,
      maxDate: "+0D",
      changeMonth: true,
      numberOfMonths: 2,
      dateFormat: 'dd-mm-yy',
      onClose: function( selectedDate ) {
        $( "#from_date" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
});function get_maintenance_reports(){
  var formData = $('form#gear_wise_report_form').serializeArray();

  var fromDate =$( "#from_date" ).val();
  var toDate =$( "#to_date" ).val();
    var gear_code =$( "#gear_code" ).val();
if(fromDate!='' && toDate!='' && gear_code!=''){
  $('#data-list').html('<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-3x"></i></center></td></tr>')

  $.ajax({
    url: '/report/gearwisemaintenancereports',
    type: 'POST',
    datatype: 'JSON',
    data: formData,
    success: function(data){
      $('#data-list').empty();
      if(data.length==0){
        $('#data-list').append('<tr><td colspan="9"><center><h4 class="label label-danger text-center">No data found</h4></center></td></tr>');
      }
        for(var i in data){
            console.log(moment(data[i].next_maintenance_date).isAfter(new Date().getTime()));
            if(moment(data[i].next_maintenance_date).isAfter(new Date().getTime())){
               next_date_row='<td>'+moment(data[i].next_maintenance_date).format('DD/MM/YY')+'</td>';
            }else{
              next_date_row='<td class="text text-danger">'+moment(data[i].next_maintenance_date).format('DD/MM/YY')+'</td>';

            }
          var row = '<tr>'
    					+'<td>'+data[i].station+'</td>'
    					+'<td>'+data[i].gear_type+'</td>'
    					+'<td>'+data[i].gear_no+'</td>'
    					+'<td>'+data[i].schedule_code+'/'+data[i].role+'</td>'
              +'<td>'+moment(data[i].maintenance_date).format('DD/MM/YY')+'</td>'
            	+next_date_row
    					+'<td>'+data[i].discontinuation_status+'</td>'
    					+'<td>'+data[i].maintenance_by+'/'+data[i].designation+'</td>'
    					+'</tr>';
    			$('#data-list').append(row);


        }

      }

  });
}else{

  alertify.error('Please select from date and to date and Gear Code !');
}
}
$("#print_report").on("click", function () {
 printDiv();

});
function printDiv()
{
  var fromDate =moment($( "#from_date" ).val()).format('DD/MM/YY');
  var toDate =moment($( "#to_date" ).val()).format('DD/MM/YY');
  var divToPrint=document.getElementById('maintenance_reports');
  newWin= window.open("");
  //console.log(divToPrint.outerHTML);
  newWin.document.write('<h3>Gear Wise Maintenance Report from <small>'+fromDate+' To '+toDate+'</small></h3>');
  newWin.document.write(divToPrint.outerHTML);
  newWin.document.write('<small>Report generated by DSMG monitoring software (Tinsukia Division): all date format are in <b>dd/mm/yy</b></small>');
  newWin.print();
  //newWin.close();
}
$("#excel_report").click(function() {
	$("#maintenance_reports").table2excel({
		exclude : ".noExl",
		name : "maintainance_report",
    filename: "maintainance_report"
	});
});
