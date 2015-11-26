var district_list=[];
window.onload = function(){
	get_all_stations();

};
var token =  $("input[name=_token]").val();


function get_all_stations(){
	$('#saveBtn').attr('onclick','createStation()').attr('class','btn btn-success btn-block').html('save station');

	$('#railway_stations_list').html('<tr><td colspan="6" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
	$.ajax({
    url: '/common/allstations/',
    type: 'GET',
		datatype: 'JSON',
		success: function(data){
			$('#railway_stations_list').empty();
			var count=1;
			for (var i in data){
        var status =data[i].status;
        var status_row='<button class="del btn btn-default btn-xs" onclick="changeStationStatus('+data[i].id+','+data[i].status+');">Disable</button>';
        if(status==1){
           status_row='<button class="del btn btn-success btn-xs" onclick="changeStationStatus('+data[i].id+','+data[i].status+');">Enable</button>';
        }
				var ediBtn='<button id="editBtn" class="del btn btn-danger btn-xs" data-code="'+data[i].code+'" data-name="'+data[i].name+'" data-district_id="'+data[i].district_id+'" onclick="editStation('+data[i].id+');">Edit</button>';
				var row ='<tr>'
		 			+'<td class="id hidden">'+data[i].id+'</td>'
					+'<td class="code">'+count+'</td>'
					+'<td class="code">'+data[i].code+'</td>'
		 			+'<td class="name">'+data[i].name+'</td>'
		 			+'<td>'+ediBtn+'</td>'
		 			+'</tr>';

				$('#railway_stations_list').append(row);
				count=count+1;
			}
		}
	});
}
//create
function createStation(){
	var formData = $('form#add-station-form').serializeArray();
//	$('#add_station_btn').attr('disabled',false).html('<i class="fa fa-spinner fa-spin"></i>');
	 $.ajax({
		url: '/common/savestation/',
		type: 'POST',
		dataTtype: 'JSON',
		data: formData,
		success: function(data){
			if(data == 1){

				alertify.error("New Station  added");
				get_all_stations();
			}
		}
	});
}
function editStation(station_id){
$('#station_code').val($("#editBtn").data("code"));
$('#station_name').val($("#editBtn").data("name"));

$('#saveBtn').attr('onclick','updateStation()').attr('class','btn btn-danger btn-block').html('update station');

}
function updateStation(){
	var formData = $('form#add-station-form').serializeArray();
  $.ajax({
		url: '/common/updatestation/',
		type: 'POST',
		dataType: 'JSON',
		data: formData,
		success: function(data){
			if(data == 1){
				alertify.error("Station  modified");

				get_all_stations();
			}
		}
	});
}
function changeStationStatus(station_id,status){
  $.ajax({
		url: '/common/updatestation/',
		type: 'POST',
		dataType: 'JSON',
		data: {'station_id': station_id,'status':status},
		success: function(data){
			if(data == 1){
				alertify.error("Station Status is changed");
				get_all_stations();
			}
		}
	});
}
$('#search_station').keyup(function() {
	var regex = new RegExp($('#search_station').val(), "i");
	var rows = $('table tbody#railway_stations_list tr:gt(1)');
	rows.each(function (index) {
		title = $(this).children(".name, .code").html();
		if (title.search(regex) != -1) {
			$(this).show();
		}
		else {
		    $(this).hide();
		}
	});
});
