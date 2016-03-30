window.onload = function() {

	$('#varification').addClass('active');

}

var token = $("input[name=_token]").val();
var currentDate = new Date();
$("#schedule_date").datepicker({
	dateFormat : 'yy-mm-dd',
	showAnim : 'slideDown'
});
$("#schedule_date").datepicker("setDate", currentDate);

$('#dailyScheduleBtn').on("click", function() {
	var schedule_date = $('#schedule_date').val();
	deleteBtnStatus(schedule_date);
  scheduleByDate(schedule_date);
  return false;
});
var deleteBtn;
function deleteBtnStatus(schedule_date) {
	var today = new Date();
	var diff = -today.getTime();

	if (new Date(schedule_date).getTime() > today.getTime()) {
		deleteBtn = '<button class="del btn btn-rounded btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></button>';
		$('#schBtn').attr('disabled', false);
	} else {
		deleteBtn = '<button class="del btn btn-rounded btn-sm btn-icon btn-danger "disabled="disabled"><i class="fa fa-trash"></i></button>';
		$('#schBtn').attr('disabled', true);

	}
}
var total_spot = 0;
var total_duration = 0;
function scheduleByDate(schedule_date) {
	total_spot = 0;
	total_duration = 0;
	$('#total_spots').empty().append("Total Spots: 0");
	$('#total_duration').empty().append("Total Duration: 0");
	$('#schecdule_table')
			.html(
					'<tr><td colspan="7" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
	$
			.ajax({
				url : '/adlog/scheduledad',
				type : 'POST',
				datatype : 'JSON',
				data : {
					'schedule_date' : schedule_date,
					'_token' : token
				},
				success : function(data) {

					$('#schecdule_table').empty();
					if (data.length != 0) {

						var agency;
						var time_slot;// =data[0].time_slot;
						for ( var i in data) {

							total_spot = total_spot + 1;
							total_duration = total_duration + data[i].duration;
							var deal = '<tr>' + '<td class="hidden asm_id">'
									+ data[i].id
									+ '</td>'
									// + '<td class="date">'
									// +
									// moment(data[i].schedule_date).format('ll')
									// + '</td>'
									+ '<td class="time_slot">'
									+ data[i].time_slot
									+ '</td>'
									+ '<td class="duration">'
									+ data[i].break_name
									+ '</td>'
									+ '<td>AT'
									+ pad(data[i].ad_id, 4)
									+ '</td>'
									+ '<td class="client_name">'
									+ data[i].caption
									+ '</td>'
									+ '<td class="duration text-center">'
									+ data[i].duration
									+ '</td>'
									+ '<td class="schedule date">'
									+ moment(data[i].schedule_date)
											.format('ll') + '</td>' + '<td>'
									+ deleteBtn + '</td>' + '</tr>';
							$('#schecdule_table').append(deal);
						}
						$('#total_spots').empty()
								.append("Spots: " + total_spot);
						$('#total_duration').empty().append(
								"Duration: " + total_duration + " Secs");

					} else {
						$('#schecdule_table')
								.append(
										'<tr class="danger"><td colspan="7" class="text-center">No Schedule found</td></tr>');
					}

				}
			});

}
// //delete schedule
$("#schecdule_table").on("click", ".del", function() {
	var $del = $(this);
	var id = $del.closest("tr").find(".asm_id").text();

	alertify.confirm("Delete schedule?", function(e) {
		if (e) {
			deletePro($del, id);
		}
	});
});
function deletePro($del, id) {
	$.ajax({
		url : '/adlog/delete',
		type : 'POST',
		dataType : 'JSON',
		data : {
			'id' : id,
			'_token' : token
		},
		success : function(data) {
			$del.closest("tr").remove();
			alertify.error("Schedule removed");
		}
	});
}
// download excel
$("#excel").click(function() {
	$("#advertise-table").table2excel({
		exclude : ".noExl",
		name : "Coommercial Schedule"
	});
});
