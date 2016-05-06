window.onload = function() {
	var bill_id={{$bill_id}};
	getBillDetails(bill_id);
}
function getBillDetails(bill_id){

	$.ajax({
		url : '/billing/printinvoice/'+bill_id,
		type : 'GET',
		dataType : 'JSON',
		success : function(data) {
			var bill_details = data['bill_details'][0];
			if(bill_details.agency_name=='Direct'){
					$('#address_to').empty().append('<strong>To</strong><br><strong>'+bill_details.client_name+'</strong><br>'+bill_details.address1+'<br>'+bill_details.address2+','+bill_details.city+'<br>');
			}else{
					$('#address_to').empty().append('<strong>To</strong><br><strong>'+bill_details.client_name+'</strong><br>'+bill_details.address1+'<br>'+bill_details.address2+','+bill_details.city+'<br>');
					$('#address_for').empty().append('<strong>For</strong><br><strong>'+bill_details.agency_name+'</strong><br>'+bill_details.agency_a1+'<br>'+bill_details.agency_a2+','+bill_details.agency_city+'<br>');
			}
			var bill_details = data['item_details'];

		}
	});

}
