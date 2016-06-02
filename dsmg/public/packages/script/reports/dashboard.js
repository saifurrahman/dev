window.onload = function(){

dashboardreport();
}
function getCount(data,station_id) {
    var count = 0;
    for (var i = 0; i < data.length; i++) {
        if (data[i].station_id == station_id) {
            count++;
        }
    }
    return count;
}
function dashboardreport(){

	$.ajax({
		url: '/report/dashboardreport',
		type: 'GET',
		dataTtype: 'JSON',
		success: function(data){
			$('#data_list').empty();
			var overdue_gears=data['overdue_gears'];
      var overdue_count=data['overdue_count'];
			for(var i = 0; i < overdue_count.length; i++) {
          var row='<tr>'
                  +'<td>'+overdue_count[i].code+'</td>'
                  +'<td>'+overdue_count[i].total+'</td>'
                  +'</tr>'
          $('#data_list').append(row);
			}

		}
	});

}
