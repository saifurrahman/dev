var schedule_date;

window.onload = function() {
	$('#varification').addClass('active');
	schedule_date = $('#schedule_date').val();
	scheduleByDate(schedule_date);
}

var currentDate = new Date();

$("#schedule_date").datepicker({
	dateFormat : 'yy-mm-dd',
	maxDate : new Date()
});

$('#schedule_date').change(function() {
	schedule_date = $('#schedule_date').val();
	scheduleByDate(schedule_date);
});

$("#schedule_date").datepicker("setDate", currentDate);

var token = $("input[name=_token]").val();

function scheduleByDate(schedule_date) {
	$('#schecdule_table')
			.html(
					'<tr><td colspan="6" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
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
						var count = 0;
						var agency;
						var time_slot;
						var telecast_time, confirm, reject, deal, remark;

						for ( var i in data) {

							if (data[i].telecast_time == '00:00:00') {
								telecast_time = '--'
								remarks = data[i].remark;
							} else {
								telecast_time = data[i].telecast_time;
								remarks = '--';

							}

							if (data[i].status == 1) {
								confirm = '<button class=" btn btn-rounded btn-sm btn-icon btn-success" disabled="disabled"><i class="fa fa-check"></i></button>';
								reject = '<button class=" btn btn-rounded btn-sm btn-icon btn-danger"disabled="disabled"><i class="fa fa-remove"></i></button>'
								deal = '<tr class="success">'
										+ '<td class="hidden asm_id">'
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
										+ '<td class="ad_id">AT'
										+ pad(data[i].ad_id, 4)
										+ '</td>'
										+ '<td class="duration">'
										+ data[i].duration
										+ ' </td>'
										+ '<td class="client_name">'
										+ data[i].caption
										+ '</td>'
										+ '<td>'
										+ telecast_time
										+ '</td>'
										+ '<td>'
										+ remarks
										+ '</td>'
										+ '<td>'
										+ confirm
										+ '&nbsp;&nbsp;'
										+ reject
										+ '</td>'
										+ '</tr>';

							} else if (data[i].status == 0) {
								confirm = '<button class=" btn btn-rounded btn-sm btn-icon btn-success" disabled="disabled"><i class="fa fa-check"></i></button>';
								reject = '<button class=" btn btn-rounded btn-sm btn-icon btn-danger"disabled="disabled"><i class="fa fa-remove"></i></button>'
								deal = '<tr class="danger">'
										+ '<td class="hidden asm_id">'
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
										+ '<td class="ad_id">AT'
										+ pad(data[i].ad_id, 4)
										+ '</td>'
										+ '<td class="duration">'
										+ data[i].duration
										+ '</td>'
										+ '<td class="client_name">'
										+ data[i].caption
										+ '</td>'
										+ '<td>'
										+ telecast_time
										+ '</td>'
										+ '<td>'
										+ remarks
										+ '</td>'
										+ '<td>'
										+ confirm
										+ '&nbsp;&nbsp;'
										+ reject
										+ '</td>'
										+ '</tr>';

							} else {
								confirm = '<button class="confirm btn btn-rounded btn-sm btn-icon btn-success" ><i class="fa fa-check"></i></button>';
								reject = '<button class="reject btn btn-rounded btn-sm btn-icon btn-danger"><i class="fa fa-remove"></i></button>'
								deal = '<tr class="default" id="ts_'
										+ data[i].timeslot_id + '">'
										+ '<td class="hidden asm_id">'
										+ data[i].id + '</td>'
										// + '<td class="date">'
										// +
										// moment(data[i].schedule_date).format('ll')
										// + '</td>'
										+ '<td class="time_slot">'
										+ data[i].time_slot + '</td>'
										+ '<td class="duration">'
										+ data[i].break_name + '</td>'
										+ '<td class="ad_id">AT'
										+ pad(data[i].ad_id, 4) + '</td>'
										+ '<td class="duration">'
										+ data[i].duration + '</td>'
										+ '<td class="client_name">'
										+ data[i].caption + '</td>' + '<td>'
										+ telecast_time + '</td>' + '<td>'
										+ remarks + '</td>' + '<td>' + confirm
										+ '&nbsp;&nbsp;' + reject + '</td>'
										+ '</tr>';
							}

							// console.log(data);

							$('#schecdule_table').append(deal);
						}
					} else {
						$('#schecdule_table')
								.append(
										'<tr class="danger"><td colspan="8" class="text-center">No Schedule found</td></tr>');
					}

				}
			});

}

// confirm schedule
$("#schecdule_table").on(
		"click",
		".confirm",
		function() {
			var $del = $(this);
			var id = $del.closest("tr").find(".asm_id").text();
			var ad_id = $del.closest("tr").find(".ad_id").text();

			$.ajax({
				url : '/adlog/telecasttime',
				type : 'POST',
				dataType : 'JSON',
				data : {
					'ad_id' : ad_id,
					'tc_date' : schedule_date,
					'_token' : token
				},
				success : function(data) {
					$('#teleModal').modal('show');
					$('#tc_time').empty();
					for ( var i in data) {
						$('#tc_time').append(
								'<option value="' + data[i].tc_time + '">'
										+ data[i].tc_time + '</option>');
					}
				}
			});

		});
$('#teleModal').on('shown.bs.modal', function() {
	//$('#telecast_time').focus();
})
// reject schedule
$("#schecdule_table").on("click", ".reject", function() {
	var $del = $(this);
	var id = $del.closest("tr").find(".asm_id").text();
	$('#remarkModal').modal('show');
	$('#reID').val(id);

});
function saveTelecast() {
	var asm_id = $('#teleID').val();
	var tc_time = $('#tc_time').val();
	if (tele != 0 || tele != '') {
		$('#tBtn').attr('disabled', true).html('PLEASE WAIT..');
		$.ajax({
			url : '/adlog/telecast',
			type : 'POST',
			dataType : 'JSON',
			data : {
				'asm_id' : asm_id,
				'tc_time' : tc_time,
				'_token' : token
			},
			success : function(data) {
				$('#tBtn').attr('disabled', false).html('Save');
				alertify.success('telecast time saved');
				$('form#telecast-form').each(function() {
					this.reset();
				});
				$('#teleModal').modal('hide');
				scheduleByDate(schedule_date);
			}
		});
	} else {
		alertify.error('put telecast time');
	}
}

// $('#telecast_time').timepicker({
// minuteStep : 2,
// showSeconds : true,
// showMeridian : false,
// showInputs : false,
// disableFocus : true
// });
function saveRemark() {
	var formData = $('form#remark-form').serializeArray();
	var remark = $('#remark').val();
	if (remark != 0 || remark != '') {
		$('#reBtn').attr('disabled', true).html('PLEASE WAIT..');
		$.ajax({
			url : '/adlog/remark',
			type : 'POST',
			dataType : 'JSON',
			data : formData,
			success : function(data) {
				$('#reBtn').attr('disabled', false).html('Save');
				alertify.success('schedule cancelled');
				$('form#remark-form').each(function() {
					this.reset();
				});
				$('#remarkModal').modal('hide');
				scheduleByDate(schedule_date);
			}
		});
	} else {
		alertify.error('put remark please');
	}
}

function excelUpload() {

	$('#xlf').click();
}
