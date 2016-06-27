window.onload = function() {
	$('#accounts').addClass('active');
	alltransaction();
	allClient();
	allAgency();
}

function accountsForm() {
	$('#client-div').toggle('200');
}
function allClient(){
	$.ajax({
		url : '/deal/allclient',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#client_id').append('<option value="">Select</option>');
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
			$('#agency_id').append('<option value="">Select</option>');
			for(var i in data){
				//select box
				$('#agency_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}

		}

	}).done(function() {
		$('#agency_id').selectize()
	});;
}
$("#payment_date,#instrument_date").datepicker({
	dateFormat : 'yy-mm-dd',
	changeMonth : true,
	changeYear : true,
	showAnim : 'slideDown',
});

var token = $("input[name=_token]").val();

function savePayments() {
	var formData = $('form#payment-form').serializeArray();
	 $('#saveBtn').attr('disabled', true).html('PLEASE WAIT..');
	$.ajax({
		url : '/payment/savepayments',
		type : 'POST',
		dataType : 'JSON',
		data : formData,
		success : function(data) {
			$('#saveBtn').attr('disabled', false).html('submit');
			var c_status
			if (data!= 0) {
				$('form#payment-form').each(function() {
					this.reset();
					alltransaction();
				});

				alertify.success('saved successfully');
			} else {
				alertify.error('something went wrong!!');
			}
		}
	});
}

// all client on a table
function alltransaction() {
	$('#transcation-list')
			.html(
					'<tr><td colspan="8" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
	$.ajax({
		url : '/payment/alltransaction',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#transcation-list').empty();
			var total_amount=0;
			for ( var i in data) {
				var row = '<tr>'
					// +'<td class="hidden">'+data[i].id+'</td>'
					+ '<td>' + data[i].payment_date + '</td>'
					+ '<td ><b> Client:</b> '+ data[i].client + '<b>Agency:</b> '+data[i].agency+'</td>'
					+ '<td>' + data[i].payment_mode + '_'
							+ data[i].instrument_number + '_'
							+ data[i].instrument_date

				+ '<td >'+ data[i].amount + '</td>'
				+ '<td >'+ data[i].tds + '</td>'
				+ '<td>' + data[i].remarks + '</td>'
				+ '</td>' + '</tr>';
				$('#transcation-list').append(row);
				total_amount=total_amount+data[i].amount;
			}
			$('#total_payments').empty().append('INR '+total_amount.toFixed(2));
		}
	});
}
