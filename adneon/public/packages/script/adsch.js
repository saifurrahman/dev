var schedule_date;
window.onload = function() {
	schedule_date = $('#schedule_date').val();
	;
	$('#ad_schedule').addClass('active');
	$('#days').selectize({
		maxItems : 7
	});
	test(schedule_date);
	scheduleByDate(schedule_date);
	alldeal();
	// allSlot();

}
var token = $("input[name=_token]").val();

var currentDate = new Date();

var tomorrow = new Date();

var break_value;
var timeslot_id;
var no_of_spot;
var scheduleJson;
var scheduleArray = [];
$('input[type="checkbox"]').click(function() {
	if ($(this).is(':checked')) {
		break_value = $(this).val()
		$('#no_of_spot').empty();
		no_of_spot = $("input:checkbox:checked").length
		$('#no_of_spot').val(no_of_spot);
		var id = $(this).closest('tr').prop('id');
		timeslot_id = id.substr(9);

		var sch = [];
		sch[0] = timeslot_id;
		sch[1] = break_value;


		scheduleArray.push(sch);

		var scheduleJson = JSON.stringify(scheduleArray);


		console.log("added --"+scheduleArray);


	} else {
		$('#no_of_spot').empty();
		no_of_spot = $("input:checkbox:checked").length
		$('#no_of_spot').val(no_of_spot);
		break_value = $(this).val()
		var id = $(this).closest('tr').prop('id');
		timeslot_id = id.substr(9);

		var sch = [];
		sch[0] = timeslot_id;
		sch[1] = break_value;

		for (var i = 0; i < scheduleArray.length; i++) {
			if (scheduleArray[i][0] === sch[0] && scheduleArray[i][1] === sch[1]) {
				scheduleArray.splice(i, 1);
				console.log("removed --"+scheduleArray);
			}
		}
	}
});

tomorrow.setDate(currentDate.getDate() + 1);
$("#schedule_date").datepicker({
	dateFormat : 'yy-mm-dd',
	showAnim : 'slideDown'
});
$("#repeat_date").multiDatesPicker({
	dateFormat : 'yy-mm-dd',
	// showAnim : 'slideDown',
	minDate : new Date()
});
$("#schedule_date").datepicker("setDate", tomorrow);

$('#schedule_date').change(function() {
	schedule_date = $('#schedule_date').val();
	test(schedule_date);
	scheduleByDate(schedule_date);
});

function scheduleForm() {
	$('#schedule-div').toggle('200');
}
var deleteBtn;
function test(schedule_date) {
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

function alldeal() {
	$.ajax({
		url : '/deal/allfct',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#deal_id').append('<option value="">Select</option>');
			for ( var i in data) {
				// select box
				$('#deal_id').append(
						'<option data-client_id ="' + data[i].client_id
								+ '"data-client_name="' + data[i].client_name
								+ '"data-agency_name="' + data[i].agency_name
								+ '"data-from_date="' + data[i].from_date
								+ '"data-to_date="' + data[i].to_date
								+ '"data-duration="' + data[i].duration
								+ '"data-item_name="' + data[i].item_name
								+ '"data-time_slot="' + data[i].time_slot
								+ '" value="' + data[i].id + '">'
								+ pad(data[i].id, 4) + '--'
								+ data[i].client_name + '</option>');
			}

		}

	});

}

var client_id = 0;
// show ads of the client
$('#deal_id')
		.change(
				function() {
					$('#deal-panel').show('200');
					$('#ad_id').empty();
					$('#deal-details').empty();
					client_id = $(this).children('option:selected').data(
							'client_id');
					var client_name = $(this).children('option:selected').data(
							'client_name');
					var agency_name = $(this).children('option:selected').data(
							'agency_name');
					var from_date = $(this).children('option:selected').data(
							'from_date');
					var to_date = $(this).children('option:selected').data(
							'to_date');
					var duration = $(this).children('option:selected').data(
							'duration');
					var item_name = $(this).children('option:selected').data(
							'item_name');
					var time_slot = $(this).children('option:selected').data(
							'time_slot');

					$('#deal-details')
							.html(
									'<center><i class="fa fa-spinner fa-spin fa-4x"></i></center>');
					$
							.ajax({
								url : '/advertise/byclient',
								type : 'POST',
								dataType : 'JSON',
								data : {
									'_token' : token,
									'client_id' : client_id
								},
								success : function(data) {
									$('#deal-details').empty();
									var deal = '<div class="col-md-12"><h5><strong>Client Name:</strong> '
											+ client_name
											+ '</h5>'
											+ '<h5><strong>Agency Name:</strong> '
											+ agency_name
											+ '</h5>'
											+ '<h5><strong>Duration:</strong> '
											+ moment(from_date).format('ll')
											+ '&nbsp;-&nbsp;'
											+ moment(to_date).format('ll')
											+ '</h5>'
											+ '<h5><strong>Ad. Duration:</strong> '
											+ duration
											+ ' Secs.</h5>'
											+ '<h5><strong>Total Spot:</strong></h5>'
											+ '<h5><strong>Remaining Secs:</strong> '
											+ duration
											+ ' Secs.</h5>'
											+ '<h5><strong>Remaining Spots:</strong></h5>'
											+ '<h5><strong>Adv. Type:</strong> '
											+ item_name
											+ '</h5>'
											+ '<h5><strong>Pref. Time Segment:</strong> '
											+ time_slot + '</h5>' + '</div>';
									$('#deal-details').append(deal);

									for ( var i in data) {
										// select box
										$('#ad_id').append(
												'<option value="' + data[i].id
														+ '">' + data[i].id
														+ '-' + data[i].caption
														+ '('
														+ data[i].duration
														+ ' secs )</option>');
									}

								}
							});
				});

function saveSchedule() {
	var deal_id = $('#deal_id').val();
	var ad_id = $('#ad_id').val();
	var schedule_date = $('#schedule_date').val();
	if (deal_id != 0 && ad_id != 0) {
		$('#sBtn').attr('disabled', true).html('please wait..');
		$.ajax({
			url : '/adlog/saveschedule',
			type : 'POST',
			dataType : 'JSON',
			data : {
				'scheduleArray' : scheduleArray,
				'deal_id' : deal_id,
				'ad_id' : ad_id,
				'schedule_date' : schedule_date,
				'spots' : no_of_spot,
				'_token' : token
			},
			success : function(data) {
				$('form#adsch-form').each(function() {
					this.reset();
				});
				$('#sBtn').attr('disabled', false).html('save');
				$('#deal-details').empty();
				alertify.success('schedule saved successfully');
				$('#schedule-div').hide('200');
				scheduleByDate(schedule_date);
			}
		});
	} else {
		alertify.error('choose deal and commercial');
	}

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

$("#time-break").on("click", ".save", function() {
	var $timebreak = $(this);
	var timeslot_id = $timebreak.closest("tr").find(".timeslot").attr('id');
	var break_id = $timebreak.closest("tr").find("option:selected").val();
	var spot = $timebreak.closest("tr").find(".spot-count").val();

	var id_time = timeslot_id.substr(9);
	var schedule_date = $('#schedule_date').val();
	var deal_id = $('#deal_id').val();
	var ad_id = $('#ad_id').val();
	// alert(id_time);

	$.ajax({
		url : '/adlog/saveschedule',
		type : 'POST',
		dataType : 'JSON',
		data : {
			'timeslot_id' : id_time,
			'schedule_date' : schedule_date,
			'deal_id' : deal_id,
			'break_id' : break_id,
			'spots' : spot,
			'ad_id' : ad_id,
			'_token' : token
		},
		success : function(data) {
			alertify.success('schedule saved successfully');
		}
	});

});

// download excel
$("#excel").click(function() {
	$("#advertise-table").table2excel({
		exclude : ".noExl",
		name : "Coommercial Schedule"
	});
});
//table search js
$("#search").keyup(function () {
    var value = this.value.toLowerCase().trim();
    doSearch(value);

});
function doSearch(searchText) {
	total_spot = 0;
	total_duration = 0;
	var targetTable = document.getElementById('advertise-table');
	var targetTableColCount;

	// Loop through table rows
	for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
		var rowData = '';

		// Get column count from header row
		if (rowIndex == 0) {
			targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
			continue; // do not execute further code for header row.
		}

		// Process data rows. (rowIndex >= 1)
		for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
			rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).textContent;
		}

		// If search term is not found in row data
		// then hide the row, else show
		if (rowData.indexOf(searchText) == -1) {
			total_spot = total_spot - 1;
			total_duration = total_duration - 10;
			targetTable.rows.item(rowIndex).style.display = 'none';
		} else {

			total_spot = total_spot + 1;
			total_duration = total_duration + 10;
			targetTable.rows.item(rowIndex).style.display = 'table-row';
		}
	}
	$('#total_spots').empty()
	.append("Spots: " + total_spot);
	$('#total_duration').empty().append(
	"Duration: " + total_duration + " Secs");
}
function resetTable() {
	var targetTable = document.getElementById('advertise-table');
	var targetTableColCount;

	// Loop through table rows
	for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
		var rowData = '';

		// Get column count from header row
		if (rowIndex == 0) {
			targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
			continue; // do not execute further code for header row.
		}

		// Process data rows. (rowIndex >= 1)
		for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
			rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).textContent;
		}

		targetTable.rows.item(rowIndex).style.display = 'table-row';


	}
}
