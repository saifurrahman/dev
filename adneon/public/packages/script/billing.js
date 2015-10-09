window.onload = function() {
	$('#billing').addClass('active');
	allClient();
	allAgency();

}
$("#from_date,#to_date").datepicker({
	dateFormat : 'yy-mm-dd',
	showAnim : 'slideDown'
});

var total_duration, count;

function allClient(){
	$.ajax({
		url : '/deal/allclient',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#client_id').append('<option value="0">Select Client</option>');
			for(var i in data){
				//select box
				$('#client_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}

		}

	}).done(function() {
		$('#client_id').selectize()
	});;
}
//all agency
function allAgency(){
	$.ajax({
		url : '/deal/allagency',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#agency_id').append('<option value="0">Select Agency</option>');
			for(var i in data){
				//select box
				$('#agency_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}

		}

	}).done(function() {
		$('#agency_id').selectize()
	});;
}
function editModel(dealId){
	alert(dealId);
}

function search() {
	var client_id = $('#client_id').val();
	var agency_id = $('#agency_id').val();
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
//	$('#sBtn').attr('disabled', true).html('Searching...');
	$('#schedule-list').html('<tr><td colspan="8" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
	$.ajax({
		url : '/billing/search',
		type : 'POST',
		dataType : 'JSON',
		data : {
			'client_id' : client_id,
			'agency_id' : agency_id,
			'from_date' : from_date,
			'to_date' : to_date
		},
		success : function(data) {
			$('#schedule-list,#total-sec').empty();
		//	$('#sBtn').attr('disabled', false).html('Search');
			$('#deal-list,#tax-part').empty();
			for ( var i in data) {
			var days =	calculateDuration(moment(data[i].from_date),moment(data[i].to_date),moment(from_date),moment(to_date));
			if(days>0){
				var deal = '<tr>'
										+'<td class="id hidden">'+data[i].id+'</td>'
										+'<td class="deal_id">D'+pad(data[i].id, 4)+'</a></td>'
										+'<td class="duration">'+moment(data[i].from_date).format('DD-MMM-YY')+' to '+moment(data[i].to_date).format('DD-MMM-YY')+'</td>'
										+'<td class="name">'+data[i].name+'</td>'
											+'<td class="name">'+days+'</td>'
										+'<td class="amount">'+data[i].amount+'</td>'
										+'</tr>';
					$('#deal-list').append(deal);
				}
			}
if(data.length!=0){
	var tax = '<tr>'
		+'<td colspan="3"class="text-right">Subtotal</h5></td>'
		+'<td><input type="text"class="form-control"  value="30000"></td>'
		+'</tr>'
		+'<tr>'
		+'<tr>'
		+'<td colspan="3"class="text-right">Tax rate</h5></td>'
		+'<td><input type="text"class="form-control"  value="14%"></td>'
		+'</tr>'
		+'<tr>'
		+'<td colspan="3"class="text-right">Service tax</h5></td>'
		+'<td><input type="text"class="form-control"  value="12.5%"></td>'
		+'</tr>'
		+'<tr>'
		+'<td colspan="3"class="text-right">Other</h5></td>'
		+'<td><input type="text"class="form-control"  value="5%"></td>'
		+'</tr>'
		+'<tr>'
		+'<td colspan="3" class="text-right">Total</h5></td>'
		+'<td><input type="text"class="form-control"  value="35000"></td>'
		+'</tr>';
	$('#tax-part').append(tax);

}
							//$('#billBtn').show();
}
	});

}
function calculateDuration(dealStartDate,dealEndDate,billFromDate,billToDate){
	var from_date;
	var to_date;
	if(billFromDate>=dealStartDate){
		from_date=moment(billFromDate,"YYYY-MM-DD");
	}else{
		from_date=moment(dealStartDate,"YYYY-MM-DD");
	}
	if(billToDate<=dealEndDate){
		  to_date =moment(billToDate,"YYYY-MM-DD");
	}else{
		to_date =moment(dealEndDate,"YYYY-MM-DD");
	}

	var ms = moment(to_date,"YYYY-MM-DD").diff(moment(from_date,"YYYY-MM-DD"));
	var d = moment.duration(ms);

	console.log(moment(from_date).format("YYYY-MM-DD") +'--'+moment(to_date).format("YYYY-MM-DD")+' : '+d.asDays());
	return d.asDays();
}

$("#deal-list").on("click", ".del", function() {
	var $del = $(this);
	var id = $del.closest("tr").find(".id").text();
	$del.closest("tr").remove();
	alertify.error("Deal removed");
});
function getDuration(startDate, endDate) {
  var start = moment(startDate);
  var end = moment(endDate);
  var units = ['years', 'months', 'days'];
  var parts = [];
  units.forEach(function(unit, i) {
    var diff = Math.floor(end.diff(start, unit, true));
    if (diff > 0 || i == units.length - 1) {
      end.subtract(unit, diff);
      parts.push(diff + ' ' + unit);
    }
  })
  return parts.join(', ');
}
