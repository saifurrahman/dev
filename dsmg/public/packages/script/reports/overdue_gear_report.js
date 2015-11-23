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
  $('#data-list').html('<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-3x"></i></center></td></tr>')

  $.ajax({
    url: '/report/overduegearbystation/',
    type: 'POST',
    datatype: 'JSON',
    data: formData,
    success: function(data){
      $('#data-list').empty();
        for(var i in data){
        //  <th>Station Code</th>
        //  <th>Gear Code</th>
        //  <th>Gear No</th>
          //  <th>Schedule Code/Role</th>
          //  <th>Last Maintenance Date</th>
          //  <th>Discontinuation Applied</th>
          //  <th>Maintenance By</th>
          var row = '<tr>'
    					+'<td class="hidden id">'+data[i].id+'</td>'
    					+'<td>'+data[i].station+'</td>'
    					+'<td>'+data[i].type+'</td>'
    					+'<td>'+data[i].gear_no+'</td>'
    					+'<td>'+data[i].schedule_code+'/'+data[i].role+'</td>'
              +'<td>'+moment(data[i].maintenance_date).format('DD/MM/YY')+'</td>'
            	+'<td class="text text-danger">'+moment(data[i].next_maintenance_date).format('DD/MM/YY')+'</td>'
    					+'<td>'+data[i].discontinuation_status+'</td>'
    					+'<td>'+data[i].maintenance_by+'/'+data[i].designation+'</td>'
    					+'</tr>';
    			$('#data-list').append(row);


        }

      }

  });
}
