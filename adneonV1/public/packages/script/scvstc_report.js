window.onload = function() {
	$('#scvstcreport').addClass('active');
}
var token = $("input[name=_token]").val();


$("#from_date,#to_date").datepicker({
	dateFormat : 'yy-mm-dd',
	changeMonth : true,
	changeYear : true,
	showAnim : 'slideDown',
});

var schedule_options = {
  valueNames: [ 'ad_id', 'caption','agency', 'client','ex_name', 'duration','rate', 'time_slot' ],

};
var tc_options = {
  valueNames: [ 'ad_id', 'caption','agency', 'client','ex_name', 'duration','rate', 'tc_time' ],

};

function searchReport(){


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

        for ( var i in data) {
          var loss_spots=parseInt(data[i].schedule_spots)-parseInt(data[i].tc_spots);
					var row;
					if(loss_spots>0){
							row ='<tr class="danger">'
					}else{
						row ='<tr>'
					}
          row =row+'<td>'
                  +data[i].caption
                  +'</td>'
                  +'<td>'
                  +data[i].client_name
                  +'</td>'
                  +'<td>'
                  +data[i].agency_name
                  +'</td>'
                  +'<td>'
                  +data[i].schedule_spots
                  +'</td>'
                  +'<td>'
                  +data[i].tc_spots
                  +'</td>'
                  +'<td>'
                  +loss_spots
                  +'</td>'
                  +'</tr>'


          $('#scvstc_report_table').append(row);
        }


      }

    });

}
