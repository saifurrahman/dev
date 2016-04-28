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
var modified_tc_time=[];

$("#schedule_date").datepicker({
	dateFormat : 'yy-mm-dd',
	showAnim : 'slideDown'
});
$('#schedule_date').on('change', function(){
	var schedule_date = $('#schedule_date').val();
	deleteBtnStatus(schedule_date);
	scheduleByDate(schedule_date);
	telecastTimeByDate(schedule_date);
	$('#schedule_table').show();
	$('#telecast_table').hide();

	$('#search').show();

});

$('#dailyScheduleBtn').on("click", function() {
	$('#schedule_table').show();
	$('#search').show();
	$('#telecast_table').hide();

  return false;
});

$('#dailyTcBtn').on("click", function() {
	$('#schedule_table').hide();
	$('#search').hide();
	$('#telecast_table').show();

	return false;
});

var tc_select=[];
function selectTC(ad_id,deal_id){
	//$('#telecasttime').empty();
	var	tc_select=[];
	for(var i in tc){
		var ad_id_tc = tc[i].ad_id;
		var deal_id_tc = tc[i].deal_id;
		if(ad_id_tc===ad_id && deal_id_tc===deal_id){
			tc_select.push(tc[i].tc_time);
		//	$('#telecasttime').append('<p class="label label-default">'+tc[i].tc_time+'</p><br>');

		}
	}

return tc_select;
}


var tc=[];
function telecastTimeByDate(schedule_date){
	var count_schedule=0;
	var count_missed=0;

	$
	  .ajax({
	    url : '/schedule/dailyscvstcreport',
	    type : 'POST',
	    datatype : 'JSON',
	    data : {
	      'schedule_date' : schedule_date,
	      '_token' : token
	    },
	    success : function(data) {
	          $('#telecast_table_row').empty();
						var schedule =data['schedule'];
						tc =data['tc'];
						console.log('TC length=='+tc.length);
						if(tc.length!=0){


								for ( var i in schedule) {
										var ad_id=schedule[i].ad_id;
										var deal_id=schedule[i].deal_id;
										var telecast_time=schedule[i].telecast_time;
										var asm_id=schedule[i].asm_id;

										var row='<tr>';
										if(telecast_time=='00:00:00'){
												row='<tr class="text-danger">';
												count_missed=count_missed+1;
										}


					        	row =row+'<td class="hidden asm_id">'+asm_id+'</td>'
														+'<td>AT'
					                  +pad(ad_id,4)
					                  +'</td>'
														+'<td>'
														+schedule[i].caption
														+'</td>'
														+'<td>'
														+pad(deal_id,4)
														+'</td>'
														+'<td>'
														+schedule[i].duration
														+'</td>'
														+'<td>'
					                  +schedule[i].time_slot
					                  +'</td>'
					                  +'<td>'
					                  +telecast_time
					                  +'</td>'
														+'<td class="tc_manual"><span class="text-danger">Edit</span></td>'
					                  +'</tr>'


					          $('#telecast_table_row').append(row);
										count_schedule=count_schedule+1;
					        }


			      }else{
							$('#telecast_table_row').append('<tr class="danger"><td colspan="7" class="text-center">No Telecast log found</td></tr>');
						}
						$('#no_of_spot').empty().val(count_schedule);
						$('#missed_spot').empty().val(count_missed);

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
	$('#schecdule_table_row').html('<tr><td colspan="7" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
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
					$('#schedule_table').show();
					$('#schecdule_table_row').empty();

					if (data.length != 0) {

						var agency;
						var time_slot;// =data[0].time_slot;
						var total_spot = 0;
						var total_duration = 0;
						for ( var i in data) {

							total_spot = total_spot + 1;
							total_duration = total_duration + data[i].duration;
							var tc_time;
							if(data[i].telecast_time=='00:00:00'){
								tc_time='<span class="bg-danger">00:00:00</span>';
							}else{
								tc_time=data[i].telecast_time;
							}
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
									+ '<td >'
									+ data[i].deal_id
									+ '</td>'
									+ '<td>'
									+ data[i].time_slot
									+ '</td>'
									+ '<td>'
									+ tc_time
									+ '</td>'
									+ '<td>'
									+ data[i].break_name
									+ '</td>'
										+ '<td class="duration text-center">'
									+ data[i].duration
									+ '</td>'

									+ '<td>'
									+ deleteBtn + '</td>' + '</tr>';
							$('#schecdule_table_row').append(deal);
						}
						$('#no_of_spot').empty().val(total_spot);

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
					alertify.alert('File not supported');
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
					sch[2] = data[2];
					tc_details.push(sch);

	    }
	}
	console.log(headers.length+'--'+tc_details.length);
	if(tc_details.length==0 || headers.length!=3){
		alertify.alert('CSV file is not n format!');
	}else{
		uploadTC(tc_details);
	}
}



function uploadTC(tc_details){

	var schedule_date = $('#schedule_date').val();
//	$("#schecdule_table").hide(200);
	$('#telecast_table').show(200);
	$('#telecast_table_row').html('<tr><td colspan="7" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');

//	$('#telecast_table_row').html('<p style="text-align:center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></p>');
	//console.log(tc_details);
	//$('#telecast_table').show(200);
	var tc_details_str=JSON.stringify(tc_details);
	$
			.ajax({
				url : '/adlog/savetelecasttime',
				type : 'POST',
				dataType : 'JSON',
				data : {
					'_token' : token,
					'tc_details' : tc_details_str,
					'tc_date' : schedule_date,

				},
				success : function(data) {
					alertify.set('notifier','position', 'top-right');
					alertify.success('Telecast log successfully!');
						telecastTimeByDate(schedule_date);
					},
					error: function(data){
						$('#telecast_table_row').empty();
						alertify.set('notifier','position', 'top-right');
						alertify.error('Failed to upload!'+data['error']);

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
$("#telecast_table_row").on("click", ".tc_manual", function() {
	var $del = $(this);
	var id = $del.closest("tr").find(".asm_id").text();
	console.log(id);
	$('#asm_id').val(id);
	$('#tc_time_mannual').val('00:00:00');
	$('#remark').val('');
	$('#remarkModal').modal('show');

});

function saveManualTc(){

	var asm_id = $('#asm_id').val();
	var tc_time_mannual = $('#tc_time_mannual').val();
	var remark = $('#remark').val();
	console.log(asm_id+'--'+tc_time_mannual);
	$.ajax({
	    url : '/schedule/updatemannualtelecasttime',
	    type : 'POST',
	    datatype : 'JSON',
	    data : {
	      'asm_id' : asm_id,
				'tc_time_mannual' : tc_time_mannual,
				'remark' : remark,
	      '_token' : token
	    },
	    success : function(data) {
				console.log(data);
				$('#remarkModal').modal('hide');
				alertify.set('notifier','position', 'top-right');
				alertify.success('Telecast Time updated successfully!');
				//telecastTimeByDate(schedule_date);
			}
		});
}
