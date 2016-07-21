
window.onload = function(){
	$('#monthlydeals').addClass('active');
	allItem();
	allExe();

}
function allExe(){
	$.ajax({
		url : '/deal/allexe',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#executive_id').append('<option value="0">All Executives</option>');
			for(var i in data){
				//select box
				$('#executive_id').append('<option value="'+data[i].id+'">'+data[i].ex_name+'</option>');
			}

		}

	});
}

function allItem(){
	$('#item_id').empty();
	$.ajax({
		url : '/deal/allitem',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
      	$('#item_id').append('<option value="0">All Property</option>');
			for(var i in data){
				//select box
				$('#item_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}

		}
});
}

var token = $("input[name=_token]").val();
function searchReport(){

  var formData = $('form#dealreport-form').serializeArray();
   $('#searchBtn').attr('disabled', true).html('PLEASE WAIT..');
  $.ajax({
    url : '/report/monthlydeals',
    type : 'POST',
    dataType : 'JSON',
    data : formData,
    success : function(data) {
      $('#searchBtn').attr('disabled', false).html('Search');
      $("#monthlydeals_report").empty();
      var total_amount=0;
      var count=0;
        var row;
        var year =$('#year').val();
        var month =$('#month').val();
        var monthx = moment([year, month - 1]);
        var monthy = moment(monthx).endOf('month');


      for(var i in data){
        count=count+1;

        var monthly_units =calculateUnits(data[i].from_date,data[i].to_date,data[i].units,monthx,monthy);
        var amount=parseFloat(monthly_units*data[i].rate).toFixed(2);
          row ='<tr>'
              +'<td>'+count+'</td>'
              +'<td>'+data[i].client+'</td>'
              +'<td>'+data[i].agency+'</td>'
              +'<td>'+data[i].executive+'</td>'
              +'<td>'+data[i].property+'<br><span class="text-info">'+data[i].from_date+' to '+data[i].to_date+'</span></td>'
              +'<td>'+monthly_units+'</td>'
              +'<td>'+data[i].rate+'</td>'
              +'<td>'+parseFloat(data[i].amount).toFixed(2)+'/'+amount+'</td>'
              +'</tr>'


        $("#monthlydeals_report").append(row);
        total_amount=parseFloat(total_amount)+parseFloat(amount);
      }
      row ='<tr>'
          +'<td class="text-success">Total</td>'
          +'<td></td>'
          +'<td></td>'
          +'<td></td>'
          +'<td></td>'
          +'<td></td>'
          +'<td></td>'
          +'<td>'+parseFloat(total_amount).toFixed(2)+'</td>'
          +'</tr>'
      $("#monthlydeals_report").append(row);
    }
  });
}

function calculateUnits(schedule_from_date,schedule_to_date,schedule_units,monthx,monthy){
	var a = moment(schedule_from_date);
	var b = moment(schedule_to_date);
	var x = moment(monthx);
	var y = moment(monthy);
	var days = b.diff(a, 'days')+1;
	var daily_schedule =parseInt(schedule_units/days);
		var bill_start_date;
		var bill_end_date;
	if(moment(x).isSameOrBefore(a)){
		bill_start_date=a;
	}
	if(moment(x).isSameOrAfter(a)){
		bill_start_date=x;
	}
	if(moment(y).isSameOrBefore(b)){
		bill_end_date=y;
	}
	if(moment(y).isSameOrAfter(b)){
		bill_end_date=b;
	}
  console.log('---'+y);
	var days_billing = bill_end_date.diff(bill_start_date, 'days')+1;
	var billing_units=days_billing*daily_schedule;
	return billing_units;//daily_schedule*days_billing;
}
