window.onload = function() {
	modified_tc_time=[];
	$('#varification').addClass('active');
	$('#schedule_table').hide();
	$('#telecast_table').hide();
	$('#no_of_spot').hide();
	$('#update_tc').hide();

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
	$('#no_of_spot').hide();
	$('#update_tc').hide();
	$('#search').show();

});

$('#dailyScheduleBtn').on("click", function() {
	$('#schedule_table').show();
	$('#search').show();
	$('#telecast_table').hide();
	$('#no_of_spot').hide();
	$('#update_tc').hide();
  return false;
});

$('#dailyTcBtn').on("click", function() {
	$('#schedule_table').hide();
	$('#search').hide();
	$('#telecast_table').show();
	$('#no_of_spot').show();
	$('#update_tc').show();
	return false;
});
$('#update_tc').on("click", function() {
	$('#schedule_table').hide();
	$('#search').hide();
	$('#telecast_table').show();
	$('#no_of_spot').show();
	console.log(modified_tc_time.length);
	updatetelecast();
	return false;
});
function telecastTimeByDate(schedule_date){


	modified_tc_time=[];

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
						if(tc.length==0){
									$('#telecast_table_row').append('<tr class="danger"><td colspan="7" class="text-center">No Telecast log found</td></tr>');

								}else{
								var count_schedule=0;
								for ( var i in schedule) {
										var ad_id=schedule[i].ad_id;
										var deal_id=schedule[i].deal_id;
										var telecast_time=schedule[i].telecast_time;
										var asm_id=schedule[i].asm_id;
										var tc_time=0;

										if(telecast_time==='00:00:00' || telecast_time=='' || telecast_time==null){

													tc_time=getTelecastTime(ad_id,deal_id,schedule[i].start_time,schedule[i].end_time);
													//missed sopt found,showing select box
													if(tc_time=='0' || tc_time=='' || tc_time==null){
													  var tc_select= selectTC(ad_id,deal_id);
														var selectTcRow='<select class="selecttc"><option value="00:00:00">00:00:00</option>';
														 for(var j in tc_select){
															 selectTcRow= selectTcRow+'<option value="'+tc_select[j]+'">'+tc_select[j]+'</option>';
														 }
														 selectTcRow=selectTcRow+'</select>';
													//	 $('.selecttc').selectize();

													//	tc_time='<button type="button" class="btn" onclick="selectTC('+ad_id+','+deal_id+');"id="searchBtn">Select</button>';
														tc_time=selectTcRow;
													}else{
														var item ={
																	 asm_id: asm_id,
																	 tc_time: tc_time
													 		}
														modified_tc_time.push(item);
													}

											}else{
												tc_time=telecast_time;
												var item ={
															 asm_id: asm_id,
															 tc_time: tc_time
											 		}
												modified_tc_time.push(item);
											}
									//	console.log(schedule[i].time_slot);
					        	var row ='<tr><td class="hidden asm_id">'+asm_id+'</td>'
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
					                  +tc_time
					                  +'</td>'
														+'<td>Edit</td>'
					                  +'</tr>'


					          $('#telecast_table_row').append(row);
										count_schedule=count_schedule+1;
					        }
							$('#no_of_spot').empty().val(count_schedule);

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
					sch[2] = data[2];
					tc_details.push(sch);

	    }
	}
	//console.log(tc_details);
		uploadTC(tc_details);
}



function uploadTC(tc_details){

	var schedule_date = $('#schedule_date').val();
//	$("#schecdule_table").hide(200);
	$('#telecast_table').show(200);
	//$('#telecast_table_row').html('<p style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></p>');
	$('#telecast_table').show(200);
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
						telecastTimeByDate(schedule_date);
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


$("#telecast_table_row").on("change", ".selecttc", function() {
	var $del = $(this);
	var id = $del.closest("tr").find(".asm_id").text();
	var tc_time = $(this).val();


	for(var i = 0; i < modified_tc_time.length; i++) {
			var obj = modified_tc_time[i];

			if(obj.asm_id==id) {
					modified_tc_time.splice(i, 1);
				}
	}

	var item ={
	 asm_id: id,
	 tc_time: tc_time
 }
	modified_tc_time.push(item);
	console.log(item);
	//alert(id+'--'+tc_time);
});

function updatetelecast(){

var schedule_date = $('#schedule_date').val();
	$
	  .ajax({
	    url : '/schedule/updatetelecast',
	    type : 'POST',
	    datatype : 'JSON',
	    data : {
	      'modified_tc_time' : modified_tc_time,
	      '_token' : token
	    },
	    success : function(data) {
				console.log(data);
				telecastTimeByDate(schedule_date);
			}
		});

}
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
function getTelecastTime(ad_id,deal_id,start_time,end_time){
	//console.log("SCHEDULE: "+ad_id +'-'+deal_id+'-'+start_time+'-'+end_time);

			for (var i in tc) {
				var ad_id_tc = tc[i].ad_id;
				var deal_id_tc = tc[i].deal_id;


				if(ad_id_tc===ad_id && deal_id_tc===deal_id){
					var tc_time =tc[i].tc_time;

					var aa1=start_time.split(":");
					var aa2=end_time.split(":");
					var aa3=tc_time.split(":");

					var startTimeObject = new Date();
 								startTimeObject.setHours(aa1[0], aa1[1], aa1[2]);
					var endTimeObject = new Date();
								endTimeObject.setHours(aa2[0], aa2[1], aa2[2]);
					var tcTimeObject = new Date();
								tcTimeObject.setHours(aa3[0], aa3[1], aa3[2]);
						if(tcTimeObject>startTimeObject && tcTimeObject<endTimeObject){
							tc.splice(i, 1);
						//	console.log(moment(startTimeObject).format("HH:mm:ss")+'--'+moment(endTimeObject).format("HH:mm:ss")+'--'+moment(tcTimeObject).format("HH:mm:ss"));
							return moment(tcTimeObject).format("HH:mm:ss");
						}else{
							return 0;
					}

				}

			}
}
