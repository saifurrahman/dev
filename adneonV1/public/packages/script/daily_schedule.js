window.onload = function() {

	$('#varification').addClass('active');
	$('#schedule_table').hide();
	$('#telecast_table').hide();
	$("#schedule_date").datepicker("setDate", currentDate);
	var schedule_date = $('#schedule_date').val();
	deleteBtnStatus(schedule_date);
  scheduleByDate(schedule_date);
	telecastTimeByDate(schedule_date);
}

var token = $("input[name=_token]").val();
var currentDate = new Date();
$("#schedule_date").datepicker({
	dateFormat : 'yy-mm-dd',
	showAnim : 'slideDown'
});
$('#schedule_date').on('change', function(){
	var schedule_date = $('#schedule_date').val();
	deleteBtnStatus(schedule_date);
	scheduleByDate(schedule_date);
	telecastTimeByDate(schedule_date);


});

$('#dailyScheduleBtn').on("click", function() {
	$('#schedule_table').show();
	$('#telecast_table').hide();
  return false;
});

$('#dailyTcBtn').on("click", function() {
	$('#schedule_table').hide();
	$('#telecast_table').show();
  return false;
});
function telecastTimeByDate(tcTime){

	$
			.ajax({
				url : '/adlog/tcbydate',
				type : 'POST',
				datatype : 'JSON',
				data : {
					'schedule_date' : tcTime,
					'_token' : token
				},
				success : function(data) {

					$('#telecast_table_row').empty();
					if (data.length != 0) {

						var agency;
						var time_slot;// =data[0].time_slot;
						var total_spot=0;
						for ( var i in data) {

							total_spot = total_spot + 1;

							var deal = '<tr><td>'
									+ total_spot
									+ '</td>'
									+ '<td>AT'
									+ pad(data[i].ad_id, 4)
									+ '</td>'
									+ '<td>'
									+ data[i].caption
									+ '</td>'

									+ '<td>'
									+ data[i].tc_time
									+ '</td>'
								+ '<td class="duration text-center">'
									+ data[i].duration
									+ '</td>'
									+ '<td >'
									+ data[i].deal_id
									+ '</td>'
								  + '</tr>';
							$('#telecast_table_row').append(deal);
						}


					} else {
						$('#telecast_table_row')
								.append(
										'<tr class="danger"><td colspan="7" class="text-center">No Telecast log found!Click here to upload</td></tr>');
					}

				}
			});

}
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

function scheduleByDate(schedule_date) {
	$('#total_spots').empty().append("Total Spots: 0");
	$('#total_duration').empty().append("Total Duration: 0");
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

					$('#schecdule_table_row').empty();
					if (data.length != 0) {

						var agency;
						var time_slot;// =data[0].time_slot;
						var total_spot = 0;
						var total_duration = 0;
						for ( var i in data) {

							total_spot = total_spot + 1;
							total_duration = total_duration + data[i].duration;
							var deal = '<tr>'
									+ '<td class="hidden asm_id">'
									+ data[i].id
									+ '</td>'
							 		+ '<td>'
									+ total_spot
									+ '</td>'
									+ '<td>AT'
									+ pad(data[i].ad_id, 4)
									+ '</td>'
									+ '<td>'
									+ data[i].caption
									+ '</td>'

									+ '<td>'
									+ data[i].time_slot
									+ '</td>'
									+ '<td>'
									+ data[i].break_name
									+ '</td>'
										+ '<td class="duration text-center">'
									+ data[i].duration
									+ '</td>'
									+ '<td >'
									+ data[i].deal_id
									+ '</td>'
									+ '<td>'
									+ deleteBtn + '</td>' + '</tr>';
							$('#schecdule_table_row').append(deal);
						}
						$('#total_spots').empty()
								.append("Spots: " + total_spot);
						$('#total_duration').empty().append(
								"Duration: " + total_duration + " Secs");

					} else {
						$('#schecdule_table_row')
								.append(
										'<tr class="danger"><td colspan="7" class="text-center">No Schedule found</td></tr>');
					}

				}
			});

}
// //delete schedule
$("#schecdule_table_row").on("click", ".del", function() {
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
	$("#schecdule_table_row").table2excel({
		exclude : ".noExl",
		name : "Coommercial Schedule"
	});
});

var fileInput = document.getElementById('upload_csv');
fileInput.addEventListener('change', function(e) {
        var file = fileInput.files[0];
        var textType = /text.*/;


				var obj=[];
        if (file.type.match(textType)) {
            var reader = new FileReader();

            reader.onload = function(e) {
								//obj=reader.result;
                processData(reader.result);
            }

            reader.readAsText(file);
        } else {
          //  fileDisplayArea.innerText = "File not supported!"
					alertify.info("File not supported!");
        }


    });

function processData(allText) {
var allTextLines = allText.split(/\r\n|\n/);
var headers = allTextLines[0].split(',');
var lines = [];
var tc_details = [];
//console.log("Total row:"+allTextLines.length);
for (var i = 1; i < allTextLines.length; i++) {
    var data = allTextLines[i].split(',');



    if (data.length == headers.length) {
				var sch = [];
				//console.log(data[0]);
				//console.log(headers.length);
				sch[0] = data[0];
				sch[1] = data[1];
				tc_details.push(sch);

    }
}
//console.log(tc_details);
saveTC(tc_details);
}
function saveTC(tc_details){

	var schedule_date = $('#schedule_date').val();
//	$("#schecdule_table").hide(200);
	$('#varification_row').show(200);
	$
			.ajax({
				url : '/adlog/savetelecasttime',
				type : 'POST',
				dataType : 'JSON',
				data : {
					'tc_details' : tc_details,
					'tc_date' : schedule_date,
					'_token' : token
				},
				success : function(data) {
					alert("Saved "+data+" Spots!");
					}

			});

}
$("#search").keyup(function () {
    var value = this.value.toLowerCase().trim();
    doSearch(value);

});
function doSearch(searchText) {
	total_spot = 0;
	total_duration = 0;
	var targetTable = document.getElementById('schecdule_table_row');
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
	var targetTable = document.getElementById('schecdule_table_row');
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
