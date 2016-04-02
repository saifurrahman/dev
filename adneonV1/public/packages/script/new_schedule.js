window.onload = function() {

	$('#ad_schedule').addClass('active');

}
var currentDate = new Date();

var tomorrow = new Date();
tomorrow.setDate(currentDate.getDate() + 1);
$("#schedule_date").datepicker({
	dateFormat : 'yy-mm-dd',
	showAnim : 'slideDown',
});
$("#schedule_date").datepicker("setDate", tomorrow);



var token = $("input[name=_token]").val();

$('#sBtn').on("click", function() {
  searchdeal();
  return false;
});
$('#saveScheduleBtn').on("click", function() {
  saveSchedule();
  return false;
});
var remaing_duration=0;
function searchdeal(){

  var deal_id =$('#deal_id').val();
//  alert(deal_id);
  $.ajax({
    url : '/deal/searchdeal',
    type : 'POST',
    dataType : 'JSON',
    data : {'_token':token,'deal_id':deal_id},
    success : function(data) {
    //	$('#save_deal').attr('disabled', false).html('submit');

			var time_slot=data['time_slot'];
			$('#time_slot').empty();
      if(time_slot!=0){
        for(var i in time_slot){
            $('#time_slot').append('<tr id="timeslot_'+time_slot[i].id+'"><td hidden>'+time_slot[i].id+'</td><td class="timeslot">'+time_slot[i].time_slot+'</td><td class="text-center"><input type="checkbox" name="chek_'+time_slot[i].id+'" value="1"></td><td class="text-center"><input type="checkbox" name="chek_'+time_slot[i].id+'" value="2"></td><td class="text-center"><input type="checkbox" name="chek_'+time_slot[i].id+'" value="3"></td></tr>');
        }
      }
      else{
        alertify.error('no FCT found');
      }

			var schedule_spots =data['schedule_count'];
			$('#schedule_spots').empty();
			var total_duration=0;
			for(var i in schedule_spots){
					$('#schedule_spots').append('<tr><td class="timeslot">'+moment(schedule_spots[i].schedule_date).format('ll')+'</td><td>AT'+pad(schedule_spots[i].ad_id,4)+'</td><td>'+schedule_spots[i].spots+'</td><td>'+schedule_spots[i].total_duration+'</td></tr>');
					total_duration=total_duration+parseInt(schedule_spots[i].total_duration);
			}

			var deal_master=data['deal_master'];
			remaing_duration=(parseInt(data['details'][0].units)*10)-total_duration;
			$('#deal_details').empty();
			$('#deal_details').append('<h5><strong> Agency :</strong> '+ deal_master[0].agency_name+'</h5>');
			$('#deal_details').append('<h5><strong> Client :</strong> '+ deal_master[0].client_name+'</h5>');
			$('#deal_details').append('<h5><strong> RO Details :</strong> '+ deal_master[0].ro_number+' on '+deal_master[0].ro_date+'</h5>');
			$('#deal_details').append('<h5><strong> FCT Duration :</strong> '+ parseInt(data['details'][0].units)*10+' Secs</h5>');
			$('#deal_details').append('<h5><strong> Schedule Duration :</strong> '+ total_duration+' Secs</h5>');
			if(remaing_duration<=0){
				$('#deal_details').append('<h5 class="text-danger"><strong> Remaining Duration :</strong> '+remaing_duration+' Secs</h5>');
			}else{
				$('#deal_details').append('<h5><strong> Remaining Duration :</strong> '+remaing_duration+' Secs</h5>');
			}
			$('#deal_details').append('<h5><strong> FCT duration :</strong> '+data['details'][0].from_date+' To '+data['details'][0].to_date+'</h5>');
			$('#deal_details').append('<h5><strong> FCT pref time :</strong> '+data['details'][0].start_time+' hrs To '+data['details'][0].end_time+'hrs</h5>');
			var minDate =moment(data['details'][0].from_date).format();
			var maxDate = moment(data['details'][0].to_date).format();


			var ad_ids=data['ad_id'];
			$('#ad_id').empty();
			for ( var i in ad_ids) {
				// select box
				$('#ad_id').append(
						'<option value="' + ad_ids[i].id
								+ '">AT' + pad(ad_ids[i].id,4)
								+ '-' + ad_ids[i].caption
								+ '(' + ad_ids[i].brand_name+')'
								+ '-'
								+ ad_ids[i].duration
								+ ' secs</option>');
			}
			if(remaing_duration<=0){
					$('#saveScheduleBtn').attr('disabled', true);
			}else{
					$('#saveScheduleBtn').attr('disabled', false);
			}

    }
  });
}




var currentDate = new Date();

var tomorrow = new Date();

var break_value;
var timeslot_id;
var no_of_spot=0;
var scheduleJson;
var scheduleArray = [];
$(document).on('click','input[type="checkbox"]',function(){
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

function saveSchedule() {
	var deal_id = $('#deal_id').val();
	var ad_id = $('#ad_id').val();

	var schedule_date = $('#schedule_date').val();
	if(no_of_spot==0){
			alertify.success('Please select Spots');
	}else if(ad_id==null || ad_id==''){
			alertify.success('Please select Commercial');
	}else if (deal_id != 0 || ad_id != 0 || deal_id != '' || ad_id != '' || deal_id != null || ad_id != null) {
		$('#sBtn').attr('disabled', true);
		$('#saveScheduleBtn').attr('disabled', true);
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
				$('#sBtn').attr('disabled', false);
				$('#saveScheduleBtn').attr('disabled', false);
				$('#no_of_spot').empty();
				no_of_spot=0;
				$('#no_of_spot').val(no_of_spot);
				alertify.success('schedule saved successfully');
				searchdeal();


			}
		});
	} else {
		alertify.error('choose deal and commercial');
	}

}
