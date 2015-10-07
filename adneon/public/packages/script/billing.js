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
	$('#schedule-list').html('<tr><td colspan="6" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
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
			console.log(data);
			$('#deal-list,#tax-part').empty();
			total_duration = 0;
			for ( var i in data) {

				var deal = '<tr>'
										+'<td class="id hidden">'+data[i].id+'</td>'
										+'<td class="deal_id">D'+pad(data[i].id, 4)+'</a></td>'
										+'<td class="duration">Duration '+data[i].duration+'</td>'
										+'<td class="name">'+data[i].name+'</td>'
										+'<td class="amount">'+data[i].amount+'</td>'
										+'<td><button class="del btn btn-rounded btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></button></td>'
										+'</tr>';
					$('#deal-list').append(deal);

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

function showBillDetails(){
	var deal_id = $('#deal_id').val();
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
	var spot = count;
	var total_sec = total_duration;
	$('#billBtn').attr('disabled', true).html('Please Wait..');
	$.ajax({
		url : '/billing/dealdetails',
		type : 'POST',
		dataType : 'JSON',
		data : {'deal_id' : deal_id,},
		success:function(data){
			$('#billBtn').attr('disabled', false).html('Generate Bill');
			$('#schedulebill-div').hide('200');
			$('#bill-row').show('200');
			for(var i in data){
				var dealInfo = 	'<h5><strong>Client Name:</strong> &nbsp;'+data[i].client_name+'</h5>'
								+'<h5><strong>Agency Name:</strong> &nbsp;'+data[i].agency_name+'</h5>'
								+'<h5><strong>Duration (in secs.):</strong> &nbsp;'+data[i].duration+'</h5>'
								+'<h5><strong>RO Number:</strong> &nbsp;'+data[i].ro_number+'</h5>'
								+'<h5><strong>Time Slots:</strong> &nbsp;'+data[i].time_slot+'</h5>'
								+'<h5><strong>Date:</strong> &nbsp;'+moment(data[i].from_date).format('ll')+'&nbsp;-&nbsp;'+moment(data[i].to_date).format('ll')+'</h5>';

				$('#deal-info').html(dealInfo);
			}
			$('#deal_id').val(deal_id);
			$('#date_from').val(from_date);
			$('#date_to').val(to_date);
			$('#spot').val(spot);
			//alert(total_sec);
			$('#total_duration').val(total_sec);
			$('#rate').val(spot);
			$('#net_amount').val(spot);
			$('#service_tax').val(spot);
			$('#edu_cess').val(spot);
			$('#billed_amount').val(spot);

		}

	});

}


$("#deal-list").on("click", ".del", function() {
	var $del = $(this);
	var id = $del.closest("tr").find(".id").text();
	$del.closest("tr").remove();
	alertify.error("Deal removed");
});
