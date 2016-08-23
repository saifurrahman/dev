window.onload = function() {
	$('#tc_correction').addClass('active');
}

$("#from_date,#to_date").datepicker({
	dateFormat : 'yy-mm-dd',
	showAnim : 'slideDown'
});
var token = $("input[name=_token]").val();

function searchReport(){

  var deal_id = $('#deal_id').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  if(deal_id==0 || deal_id==''|| from_date=='' || to_date==''){
      alertify.alert('All fields are required!');
  }else {

      $('#deal_wise_report').html('<tr><td colspan="8" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');

      $.ajax({
        url : '/billing/dealwisetelecast',
        type : 'POST',
        dataType : 'JSON',
        data : {
          '_token' : token,
          'deal_id' : deal_id,
          'from_date' : from_date,
          'to_date' : to_date

        },
        success : function(data) {
          var schedule =data['schedule'];
					var telecast =data['telecast'];
					var schedule_spot=0;
					var missed_spot=0;
					var status='';
          $('#deal_wise_report').empty();
          for(var i in schedule){
            schedule_spot=schedule_spot+1;
            var ad_id=schedule[i].ad_id;
            var deal_id=schedule[i].deal_id;
            var telecast_time=schedule[i].telecast_time;
            var row='';
            if(telecast_time==='00:00:00' || telecast_time=='' || telecast_time==null){
                row='<tr class="danger">';
                missed_spot=missed_spot+1;
                status='Missed';
            }else{
                row ='<tr>';
                status='Telecast';
            }
            row = row+'<td>'
                    +moment(schedule[i].schedule_date).format("ll")
                    +'</td>'
                    +'<td>AT'
                    +pad(ad_id,4)
                    +'</td>'
                    +'<td>'
                    +deal_id
                    +'<td>'
                    +schedule[i].caption
                    +'</td>'
                    +'<td>'
                    +schedule[i].telecast_time
                    +'</td>'
                    +'<td>'
                    +schedule[i].remark
                    +'</td>'

                    +'<td>'
                    +schedule[i].duration
                    +'</td>'
                    +'<td>'
                    +parseFloat(schedule[i].rate).toFixed(2)
                    +'</td>'
                    +'<td>'
                    +status
                    +'</td>'
										+'<td>Edit</td>'
                    +'</tr>'
            $('#deal_wise_report').append(row);
          }
          var extra_spot=0;
          for(var i in telecast){
            extra_spot=extra_spot+1;
            row ='<tr class="info">'
                    +'<td>'
                    +moment(telecast[i].tc_date).format("ll")
                    +'</td>'
                    +'<td>AT'
                    +pad(ad_id,4)
                    +'</td>'
                    +'<td>'
                    +deal_id
                    +'<td>'
                    +telecast[i].caption
                    +'</td>'
                    +'<td>'
                    +telecast[i].tc_time
                    +'</td>'
                    +'<td>-</td>'
                    +'<td>'
                    +telecast[i].duration
                    +'</td>'
                    +'<td>'
                    +telecast[i].rate
                    +'</td>'
                    +'<td>Extra</td>'
										+'<td>Edit</td>'
                    +'</tr>'
                  $('#deal_wise_report').append(row);
          }
          $('#schedule_spot').html("Schedule Spot: "+schedule_spot);
          $('#missed_spot').html("Missed Spot: "+missed_spot);
          $('#extra_spot').html("Extra Spot: "+extra_spot);
        }
      });

    }
}
$("#excel").click(function() {
	$("#deal_wise_report").table2excel({
		exclude : ".noExl",
		name : "Coommercial Schedule"
	});
});
