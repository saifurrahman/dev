window.onload = function(){
//  get_maintenance_reports();
  get_all_stations();
};
var token =  $("input[name=_token]").val();
function get_all_stations(){
	$.ajax({
		url: '/common/allstations/',
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
});
function get_maintenance_reports(){
  var formData = $('form#schedule-form').serializeArray();


  $.ajax({
    url: '/report/get_maintenance_reports/',
    type: 'POST',
    datatype: 'JSON',
    data: formData,
    success: function(data){
      $('#maintenance_reports tbody').empty();
      for (var i  in  data){
        if(data[i].maintenance_date < data[i].actual_maintenance_date){
          var row ='<tr>'
          +'<td class="id hidden">'+data[i].id+'</td>'
          +'<td class="station_code">'+data[i].station_code+'</td>'
          +'<td class="gear_code">'+data[i].gear_code+'</td>'
          +'<td class="maintenance_date">'+data[i].preety_maintenance_date+'</td>'
          +'<td class="preety_actual_maintenance_date text-late-latif">'+data[i].preety_actual_maintenance_date+'</td>'
          +'<td class="role_name">'+data[i].role_name+'</td>'
          +'<td class="maintenance_by_name">'+data[i].maintenance_by_name+'</td>'
          +'</tr>';
        }
        else{
          var row ='<tr>'
          +'<td class="id hidden">'+data[i].id+'</td>'
          +'<td class="station_code">'+data[i].station_code+'</td>'
          +'<td class="gear_code">'+data[i].gear_code+'</td>'
          +'<td class="maintenance_date">'+data[i].preety_maintenance_date+'</td>'
          +'<td class="preety_actual_maintenance_date">'+data[i].preety_actual_maintenance_date+'</td>'
          +'<td class="role_name">'+data[i].role_name+'</td>'
          +'<td class="maintenance_by_name">'+data[i].maintenance_by_name+'</td>'
          +'</tr>';
        }
        $('#maintenance_reports tbody').append(row);
      }
    }
  });
}
