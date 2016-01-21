var schedule_date;

window.onload = function() {
	$('#varification').addClass('active');
	$('#processed_row').hide();
	schedule_date = $('#schedule_date').val();
//	scheduleByDate(schedule_date);
	tcbydate(schedule_date);
}

var currentDate = new Date();

$("#schedule_date").datepicker({
	dateFormat : 'yy-mm-dd',
	maxDate : new Date()
});

$('#schedule_date').change(function() {
	schedule_date = $('#schedule_date').val();
	//scheduleByDate(schedule_date);
	tcbydate(schedule_date);
});

$("#schedule_date").datepicker("setDate", currentDate);

var token = $("input[name=_token]").val();
var tc_schedule_details = [];
function scheduleByDate(schedule_date) {

	$('#schecdule_table')
			.html(
					'<tr><td colspan="6" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
	$
			.ajax({
				url : '/adlog/scheduledadvarfication',
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
						var telecast_time = '';
						var confirm, reject, deal, remark;
						tc_schedule_details=[];
						for ( var i in data) {
							if (data[i].telecast_time != '00:00:00') {
								telecast_time = data[i].telecast_time;
							} else {
								telecast_time = '';
							}
							var sch = [];
							sch[0] = data[i].caption;
							sch[1] = data[i].ad_id;
							sch[2] =data[i].time_slot
							sch[3] =data[i].id;
							tc_schedule_details.push(sch);


							deal = '<tr class="success">'
									+ '<td class="hidden asm_id">'
									+ data[i].id
									+ '</td>'
									+ '<td class="duration">'
									+ data[i].break_name
									+ '</td>'

									+ '<td class="duration">'
									+ data[i].duration
									+ ' </td>'
									+ '<td class="client_name">'
									+ data[i].caption
									+ '</td>'
									+ '<td class="ad_id">AT'
									+ pad(data[i].ad_id, 4)
									+ '</td>'
									+ '<td class="time_slot">'
									+ data[i].time_slot
									+ '</td>'
									+ '<td ondrop="drop(event)" ondragover="allowDrop(event)" contenteditable data-adid="'
									+ data[i].ad_id
									+ '" data-time_slot="'
									+ data[i].time_slot
									+ '" data-asmid="'
									+ data[i].id
									+ '">'
									+ telecast_time
									+ '</td>' + '</tr>';

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
var tc_details = [];
function tcbydate(schedule_date) {

	$('#tc_time_table')
			.html(
					'<tr><td colspan="12" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
	$
			.ajax({
				url : '/adlog/tcbydate',
				type : 'POST',
				datatype : 'JSON',
				data : {
					'schedule_date' : schedule_date,
					'_token' : token
				},
				success : function(data) {

					$('#tc_time_table').empty();
					if (data.length != 0) {
						tc_details = [];

						for ( var i in data) {
							var adlog = '<tr class="danger">'
									+ '<td class="ad_id">AT'
									+ pad(data[i].id, 4)
									+ '</td>'
									+ '<td>'
									+ data[i].caption
									+ '</td>'
									+ '<td>'
									+ data[i].client_name
									+ '</td>'
									+ '<td>'
									+ data[i].brand_name
									+ '</td>'
									+ '<td>'
									+ data[i].duration
									+ '</td>'
									+ '<td class="time_slot">' + data[i].tc_time
									+ '</td>';

							$('#tc_time_table').append(adlog);
						}
					} else {
						$('#tc_time_table')
								.append(
										'<tr class="danger"><td colspan="12" class="text-center">No Telecast Time uploaded.Please upload excel in proper format.</td></tr>');
					}

				}
			});

}
function updateTelecastTime(sch_table_asmid, tc_time) {

	$.ajax({
		url : '/adlog/telecast',
		type : 'POST',
		dataType : 'JSON',
		data : {
			'asm_id' : sch_table_asmid,
			'tc_time' : tc_time,
			'_token' : token
		},
		success : function(data) {

			alertify.success('telecast time saved');

		}
	});

}


function excelUpload() {

	$('#xlf').click();
}
function allowDrop(ev) {
	ev.preventDefault();
}
function drag(ev) {
	ev.dataTransfer.setData("tc_time", ev.target.id);
	ev.dataTransfer.setData("tc_ad_id", ev.target.getAttribute("data-ad_id"));

	var tc_ad_id = pad(ev.target.getAttribute("data-ad_id"), 4);
	doSearch(tc_ad_id);
}

function drop(ev) {
	ev.preventDefault();
	var tc_time = ev.dataTransfer.getData("tc_time");
	var tc_ad_id = ev.dataTransfer.getData("tc_ad_id");
	var sch_table_adid = ev.target.getAttribute("data-adid");
	var sch_table_asmid = ev.target.getAttribute("data-asmid")

	if (tc_ad_id == sch_table_adid) {
		ev.target.appendChild(document.getElementById(tc_time));
	} else {
		alert('ad id mismatch');
	}
	resetTable();
	updateTelecastTime(sch_table_asmid, tc_time);
}
var $rows = $('#table tr');

function doSearch(searchText) {
	var targetTable = document.getElementById('schecdule_table');
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

			targetTable.rows.item(rowIndex).style.display = 'none';
		} else {
			targetTable.rows.item(rowIndex).style.display = 'table-row';
		}
	}
}
function processVarification(){
var schecdule_table = document.getElementById('schecdule_table');
var tc_time_table = document.getElementById('tc_time_table');

var final=[];
var new_array=[];
//tc_details
for(var i=0;i<tc_schedule_details.length;i++){
	for(var j=0;j<tc_details.length;j++){
		if(tc_schedule_details[i][1]===tc_details[j][1]){
			tc_details.splice(j, 1);
			var sch = [];
			sch[0] = tc_schedule_details[i][1]; //ad_id
			sch[1] = tc_details[j][0];          //tc time
			sch[2] = tc_schedule_details[i][0];  //caption
			sch[3] = tc_schedule_details[i][2];  //time slot
			sch[4] = tc_schedule_details[i][3];  //asm_id
			final.push(sch);
			var a=[];
			a[0]=tc_schedule_details[i][3];
			a[1]=tc_details[j][0];
			new_array.push(a);
			break;
		}
	}

}
$('#processed_table').empty();
for(var i=0;i<final.length;i++){
	var deal = '<tr><td class="hidden">'
					+ final[i][4]
					+ '</td><td>'
					+ final[i][2]
					+ '</td>'
					+ '<td>AT'
					+ pad(final[i][0], 4)
					+ '</td>'
					+ '<td>'
					+ final[i][3]
					+ '</td>'
						+ '<td>'
					+ final[i][1]
					+ '</td>' + '</tr>';

	$('#processed_table').append(deal);
}
$('#varification_row').hide();
$('#processed_row').show();
validateTelecastTime(new_array);
}
function validateTelecastTime(final_data) {
token = $("input[name=_token]").val();
	$.ajax({
		url : '/adlog/validatetelecasttime',
		type : 'POST',
		datatype : 'JSON',
		data : {
			'tcdata' : final_data,
			'_token' : token
		},
		success : function(data) {

			alertify.success('telecast time saved');

		}
	});

}
function resetTable() {
	var targetTable = document.getElementById('schecdule_table');
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
