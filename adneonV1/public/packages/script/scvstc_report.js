window.onload = function() {
	$('#scvstcreport').addClass('active');


}
var token = $("input[name=_token]").val();


$("#telecast_date").datepicker({
	dateFormat : 'yy-mm-dd',
	changeMonth : true,
	changeYear : true,
	showAnim : 'slideDown',
});


function searchReport(){


	var telecast_date = $('#telecast_date').val();
	$('#scvstc_report_table').html('<tr><td colspan="7" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');

	$
	  .ajax({
	    url : '/report/dailytelecastreport',
	    type : 'POST',
	    datatype : 'JSON',
	    data : {
	      'telecast_date' : telecast_date,
	      '_token' : token
	    },
	    success : function(schedule) {
	          $('#scvstc_report_table').empty();

					var schedule_spot=0;
					var missed_spot=0;
					for ( var i in schedule) {
						schedule_spot=schedule_spot+1;
						var ad_id=schedule[i].ad_id;
						var deal_id=schedule[i].deal_id;
						var telecast_time=schedule[i].telecast_time;
						var row='';
						if(telecast_time==='00:00:00' || telecast_time=='' || telecast_time==null){
								row='<tr class="danger">';
								missed_spot=missed_spot+1;

						}else{
								row ='<tr>';

						}

	        		row = row+'<td>AT'
	                  +pad(ad_id,4)
	                  +'</td>'
										+'<td>'
					          +deal_id
	                  +'<td>'
	                  +schedule[i].caption
	                  +'</td>'
										+'<td>'
	                  +schedule[i].duration
	                  +'</td>'
										+'<td>'
	                  +schedule[i].rate
	                  +'</td>'
										+'<td>'
	                  +schedule[i].time_slot
	                  +'</td>'
	                  +'<td>'
	                  +telecast_time
	                  +'</td>'
										+'<td>'
										+schedule[i].remark
										+'</td>'
	                  +'</tr>'


	          $('#scvstc_report_table').append(row);
	        }
					$('#schedule_spot').html("Schedule Spot: "+schedule_spot);
					$('#missed_spot').html("Missed Spot: "+missed_spot);


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
$("#excel").click(function() {
	$("#scvstc_report_table").table2excel({
		exclude : ".noExl",
		name : "Coommercial Schedule"
	});
});
