window.onload = function() {
	$('#scvstcreport').addClass('active');
	modified_tc_time=[];

}
var token = $("input[name=_token]").val();


$("#from_date,#to_date").datepicker({
	dateFormat : 'yy-mm-dd',
	changeMonth : true,
	changeYear : true,
	showAnim : 'slideDown',
});

var modified_tc_time=[];

$("#scvstc_report_table").on("change", ".selecttc", function() {
	var $del = $(this);
	var id = $del.closest("tr").find(".asm_id").text();
	var tc_time = $(this).val();


	for(var i = 0; i < modified_tc_time.length; i++) {
			var obj = modified_tc_time[i];
		//	console.log(obj[0]+'--'+id);
			if(obj.asm_id==id) {
					modified_tc_time.splice(i, 1);
				}
	}

	var item ={
	 asm_id: id,
	 tc_time: tc_time
 }
	modified_tc_time.push(item);
	//alert(id+'--'+tc_time);
});

function saveSchedule(){

	console.log(modified_tc_time.length);
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
			}
		});

}
function searchReport(){

	modified_tc_time=[];
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();

	$
	  .ajax({
	    url : '/report/scvstcreport',
	    type : 'POST',
	    datatype : 'JSON',
	    data : {
	      'from_date' : from_date,
	      'to_date' : to_date,
	      '_token' : token
	    },
	    success : function(data) {
	          $('#scvstc_report_table').empty();
						var schedule =data['schedule'];
						tc =data['tc'];


					for ( var i in schedule) {
						var ad_id=schedule[i].ad_id;
						var deal_id=schedule[i].deal_id;
						
						if(schedule[i].telecast_time=='00:00:00'){
							var tc_time=0;
							var asm_id=schedule[i].id;
							tc_time=getTelecastTime(schedule[i].ad_id,schedule[i].deal_id,schedule[i].start_time,schedule[i].end_time);
						//	console.log(tc_time);


						if(tc_time=='0'){
						  var tc_select= selectTC(ad_id,deal_id);
							 var selectTcRow='<select class="selecttc"><option value="00:00:00">00:00:00</option>';
							 for(var j in tc_select){
								 selectTcRow= selectTcRow+'<option value="'+tc_select[j]+'">'+tc_select[j]+'</option>';
							 }
							 selectTcRow=selectTcRow+'</select>';

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
						tc_time=schedule[i].telecast_time;
					}
					//	console.log(schedule[i].time_slot);
	        	var row ='<tr><td class="hidden asm_id">'+asm_id+'</td>'
										+'<td>AT'
	                  +pad(ad_id,4)
	                  +'</td>'
										+'<td>'
					          +deal_id
	                  +'<td>'
	                  +schedule[i].time_slot
	                  +'</td>'
	                  +'<td>'
	                  +tc_time
	                  +'</td>'
										+'<td>-</td>'
	                  +'</tr>'


	          $('#scvstc_report_table').append(row);
	        }


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
