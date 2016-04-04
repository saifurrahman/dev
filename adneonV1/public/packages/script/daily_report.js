
var schedule_date = new Date();
window.onload = function() {
  $("#schedule_date").datepicker("setDate", schedule_date);
	scheduleByDate();
}
// download excel
$("#excel").click(function() {
	$("#daily_report_table").table2excel({
		exclude : ".noExl",
		name : "Coommercial Schedule"
	});
});
$('#schedule_date').on('change', function(){

scheduleByDate();

});

$("#schedule_date").datepicker({
	dateFormat : 'yy-mm-dd',
	showAnim : 'slideDown'
});
var token = $("input[name=_token]").val();
function scheduleByDate(){

  schedule_date = $('#schedule_date').val();

  $
    .ajax({
      url : '/report/dailyschedulereport',
      type : 'POST',
      datatype : 'JSON',
      data : {
        'schedule_date' : schedule_date,
        '_token' : token
      },
      success : function(data) {

        $('#daily_report_table').empty();
        if (data.length != 0) {

          var count=0;
          for ( var i in data) {
            count=count+1;
            var row ='<tr>'
                    +'<td>'
                    +count
                    +'</td>'
                    +'<td>AT'
                    +pad(data[i].ad_id,4)+'-'+data[i].caption
                    +'</td>'
                    +'<td>'
                    +data[i].client_name
                    +'</td>'
                    +'<td>'
                    +data[i].agency_name
                    +'</td>'
                    +'<td>'
                    +data[i].ex_name
                    +'</td>'
                    +'<td>'
                    +data[i].time_slot
                    +'</td>'
                    +'<td>'
                    +data[i].duration
                    +'</td>'
                    +'<td>'
                    +data[i].rate
                    +'</td>'
                    +'<td>'
                    +parseInt(data[i].rate)*parseInt(data[i].duration)/10
                    +'</td>'
                    +'</tr>'


            $('#daily_report_table').append(row);
          }
        }
      }
      });

}
