window.onload = function() {
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
function get_maintenance_reports(){
  var formData = $('form#overdue-form').serializeArray();
	$('#saveBtn').attr('disabled', true).html('PLEASE WAIT..');

  $.ajax({
    url: '/report/overduegearbystation/',
    type: 'POST',
    datatype: 'JSON',
    data: formData,
    success: function(data){

      }

  });
}
