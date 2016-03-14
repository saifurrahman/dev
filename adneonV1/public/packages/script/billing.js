window.onload = function() {
	$('#billing').addClass('active');
	$('#generate_bill_section').hide();
}
var token = $("input[name=_token]").val();
$("#from_date,#to_date").datepicker({
	dateFormat : 'yy-mm-dd',
	showAnim : 'slideDown'
});

function search() {
	var deal_id = $('#deal_id').val();
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();


//	$('#sBtn').attr('disabled', true).html('Searching...');
	$('#schedule-list').html('<tr><td colspan="8" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
	$('#deal_details_list').empty();
	$.ajax({
		url : '/billing/search',
		type : 'POST',
		dataType : 'JSON',
		data : {
			'_token' : token,
			'deal_id' : deal_id,
			'from_date' : from_date,
			'to_date' : to_date

		},
		success : function(data) {
			$('#item_list').empty();
			var deal_master =data['deal_master'];
			if(deal_master.length==0){
					alertify.error('No deal found!');
					$('#generate_bill_section').hide();
			}else{
					$('#generate_bill_section').show();

			var agency_name=deal_master[0].agency_name;
			var client_details ='<address><strong>'+deal_master[0].client_name+'</strong><br>1355 Market Street, Suite 900<br>San Francisco, CA 94103<br><abbr title="Phone">P:</abbr> (123) 456-7890</address>';
			$('#client_details').empty().append(client_details);
			$('#agency_details').empty().append('<address><strong>'+agency_name+'</strong><br>1355 Market Street, Suite 900<br>San Francisco, CA 94103<br><abbr title="Phone">P:</abbr> (123) 456-7890</address>');
			var deal_details =data['deal_details'];

			var row_deal_details='<tr><td>'+deal_master[0].ro_number+'</td><td>'+deal_master[0].ro_date+'</td><td>'+deal_master[0].ro_number+'</td><td>'+from_date+' To '+to_date+'</td><td>'+deal_master[0].payment_peference+'</td></tr>';
			$('#deal_details').empty().append(row_deal_details);
			for(var i in deal_details){
				var row_item='<tr><td>'+deal_details[i].item+'</td><td>600 Sec</td><td>165</td><td>250</td><td>33000</td></tr>';
				$('#item_list').append(row_item);

			}
			var row_tax ='<br>';
			//<tr><td></td><td></td><td>Less Agency Commission</td><td>15%</td><td>4900</td></tr><tr><td></td><td></td><td>SUBTOTAL</td><td>28050</td></tr><tr><td></td><td></td><td>Service Tax @14.5%</td><td></td><td>4067</td></tr><tr><td></td><td></td><td><strong>Total amount</strong></td><td></td><td><strong>32117</strong></td></tr>';
			$('#item_list').append(row_tax);
			var row_tax ='<tr><td></td><td></td><td>Less Agency Commission</td><td><select id="agency_com"><option value="0">0%</option><option value="10">10%</option><option value="15">15%</option><option value="20">20%</option></select></td><td>4900</td></tr><tr>';
			//<td></td><td></td><td>SUBTOTAL</td><td>28050</td></tr><tr><td></td><td></td><td>Service Tax @14.5%</td><td></td><td>4067</td></tr><tr><td></td><td></td><td><strong>Total amount</strong></td><td></td><td><strong>32117</strong></td></tr>';
			$('#item_list').append(row_tax);
			var row_tax ='<tr><td></td><td></td><td>SUBTOTAL</td><td></td><td>28050</td></tr><tr><td></td><td></td><td>Service Tax @14.5%</td><td></td><td>4067</td></tr><tr><td></td><td></td><td><strong>Total amount</strong></td><td></td><td><strong>32117</strong></td></tr>';
			//';
			$('#item_list').append(row_tax);
		}
}
	});

}
var agency_commission=100;
$('#agency_com').on("change",function(){
	agency_commission=$('#agency_com').val();

});
$("#savebillBtn").on("click", function() {
	agency_commission=$('#agency_com').val();
	alert(agency_commission);

});
