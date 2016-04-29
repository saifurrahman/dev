window.onload = function() {
	$('#billing').addClass('active');
	$('#generate_bill_section').hide();
	$('#search_field').hide();

	$('#all_bills').show();
	getAllbill();
}
$("#newBill").on("click", function() {
	//$('#generate_bill_section').show();
	$('#search_field').toggle();
	$('#all_bills').toggle();

});
var token = $("input[name=_token]").val();
$("#from_date,#to_date").datepicker({
	dateFormat : 'yy-mm-dd',
	showAnim : 'slideDown'
});
function calculateUnits(from_date,to_date,schedule_from_date,schedule_to_date,schedule_units){
	var a = moment(schedule_from_date);
	var b = moment(schedule_to_date);
	var x = moment(from_date);
	var y = moment(to_date);
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
	var days_billing = bill_end_date.diff(bill_start_date, 'days')+1;
	var billing_units=days_billing*daily_schedule;
	return billing_units;//daily_schedule*days_billing;
}
var agency_com_amount=0;
var total_amount=0;
var subtotal_amount =0;
var service_tax_amount=0;
var bill_amount=0;
function search() {
			var deal_id = $('#deal_id').val();
			var from_date = $('#from_date').val();
			var to_date = $('#to_date').val();

			if(deal_id==0 || deal_id==''|| from_date=='' || to_date==''){
					alertify.alert('All fields are required!');
			}else {
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
							var schedule_details =data['schedule_details'];
							var deal_details =data['deal_details'];

							if(deal_master.length==0){
									alertify.error('No deal found!');
									$('#generate_bill_section').hide();
							}else if (schedule_details.length==0) {
									alertify.error('No Schedule found!');
							}else{
									$('#generate_bill_section').show();

							var agency_name=deal_master[0].agency_name;
							var client_details ='<address><strong>'+deal_master[0].client_name+'</strong><br>1355 Market Street, Suite 900<br>San Francisco, CA 94103<br><abbr title="Phone">P:</abbr> (123) 456-7890</address>';
							$('#client_details').empty().append(client_details);
							$('#agency_details').empty().append('<address><strong>'+agency_name+'</strong><br>1355 Market Street, Suite 900<br>San Francisco, CA 94103<br><abbr title="Phone">P:</abbr> (123) 456-7890</address>');


							var row_deal_details='<tr><td>'+deal_master[0].ro_number+'</td><td>'+deal_master[0].ro_date+'</td><td>'+deal_master[0].ro_amount+'</td><td>'+from_date+' To '+to_date+'</td><td>'+deal_master[0].payment_peference+'</td></tr>';
							$('#deal_details').empty().append(row_deal_details);


							$('#schedule_details').empty();
							var total_telecast_duration=0;
							var total_telecast_spots=0;
							var total_schedule_duration=0;
							var total_schedule_spots=0;
							for(var i in schedule_details){
								var row_item='<tr><td>AT'+pad(schedule_details[i].ad_id,4)+'</td><td>'+schedule_details[i].caption+'</td><td>'+schedule_details[i].brand_name+'</td><td>'+schedule_details[i].ad_duration+'</td><td>'+schedule_details[i].schedule_duration+'/'+parseInt(schedule_details[i].schedule_spots)+'</td><td>'+schedule_details[i].telecast_duration+'/'+parseInt(schedule_details[i].telecast_spots)+'</td></tr>';
								total_telecast_duration=total_telecast_duration+parseInt(schedule_details[i].telecast_duration);
								total_telecast_spots=total_telecast_spots+parseInt(schedule_details[i].telecast_spots);
								total_schedule_duration=total_schedule_duration+parseInt(schedule_details[i].schedule_duration);
								total_schedule_spots=total_schedule_spots+parseInt(schedule_details[i].schedule_spots);
								$('#schedule_details').append(row_item);

							}
							row_item='<tr  class="text-success"><td>Total </td><td></td><td></td><td></td><td>'+total_schedule_duration+'/'+parseInt(total_schedule_spots)+'</td><td>'+total_telecast_duration+'/'+parseInt(total_telecast_spots)+'</td></tr>';
							$('#schedule_details').append(row_item);

							var units=parseInt(total_telecast_duration)/10;
							var rate=0;
							var amount=0;
							for(var i in deal_details){
								var row_item='';
								rate=deal_details[i].rate;
								if(deal_details[i].item_id==1 || deal_details[i].item_id==6){
										amount=parseFloat(rate*units).toFixed(2);
										row_item='<tr><td>'+deal_details[i].item+'</td><td>'+total_telecast_duration+' Sec</td><td>'+units+'</td><td>'+rate+'</td><td>'+amount+'</td></tr>';
								}else{
										units=calculateUnits(from_date,to_date,deal_details[i].from_date,deal_details[i].to_date,deal_details[i].units);
										amount=parseFloat(rate*units).toFixed(2);
									  row_item='<tr><td>'+deal_details[i].item+'</td><td>-</td><td>'+units+'</td><td>'+rate+'</td><td>'+amount+'</td></tr>';
								}

								$('#item_list').append(row_item);
								total_amount=parseFloat(total_amount)+parseFloat(amount);
							//	console.log(total_amount);
							}
							var row_tax ='<br>';
							//<tr><td></td><td></td><td>Less Agency Commission</td><td>15%</td><td>4900</td></tr><tr><td></td><td></td><td>SUBTOTAL</td><td>28050</td></tr><tr><td></td><td></td><td>Service Tax @14.5%</td><td></td><td>4067</td></tr><tr><td></td><td></td><td><strong>Total amount</strong></td><td></td><td><strong>32117</strong></td></tr>';
							$('#item_list').append(row_tax);

								var row_tax ='<tr><td></td><td></td><td>Less Agency Commission</td><td id="agency_com_per"></td><td id="agency_com_amount">'+agency_com_amount+'</td></tr><tr>';
							//<td></td><td></td><td>SUBTOTAL</td><td>28050</td></tr><tr><td></td><td></td><td>Service Tax @14.5%</td><td></td><td>4067</td></tr><tr><td></td><td></td><td><strong>Total amount</strong></td><td></td><td><strong>32117</strong></td></tr>';
							$('#item_list').append(row_tax);
							subtotal_amount =total_amount-agency_com_amount;
							service_tax_amount=parseFloat(subtotal_amount*0.145).toFixed(2);
							bill_amount=parseFloat(subtotal_amount)+parseFloat(service_tax_amount);
							var row_tax ='<tr><td></td><td></td><td>SUBTOTAL</td><td>&#8377;</td><td id="subtotal_amount_id">'+parseFloat(subtotal_amount).toFixed(2)+'</td></tr><tr><td></td><td></td><td>Service Tax @14.5%</td><td>&#8377;</td><td id="service_tax_amount_td">'+service_tax_amount+'</td></tr><tr><td></td><td></td><td><strong>Total amount</strong></td><td>&#8377;</td><td id="bill_amount_id"><strong>'+bill_amount+'</strong></td></tr>';
							//';
							$('#item_list').append(row_tax);
						}
				}
				});
				}

}
var agency_commission=0;
$('#agency_com').on("change",function(){
	agency_commission=$('#agency_com').val();
	agency_com_amount=parseFloat(total_amount*agency_commission/100).toFixed(2);
	subtotal_amount =parseFloat(total_amount-agency_com_amount).toFixed(2);
	service_tax_amount=parseFloat(subtotal_amount*0.145).toFixed(2);
	bill_amount=parseFloat(subtotal_amount)+parseFloat(service_tax_amount);
	$('#agency_com_amount').empty().append(agency_com_amount);
	$('#subtotal_amount_id').empty().append(subtotal_amount);
	$('#service_tax_amount_td').empty().append(service_tax_amount);
	$('#bill_amount_id').empty().append('<strong>'+parseFloat(bill_amount).toFixed(2)+'</strong>');
	//alert(agency_com_amount);

});
$("#savebillBtn").on("click", function() {
	agency_commission=$('#agency_com').val();
	alert(agency_commission);
	var deal_id = $('#deal_id').val();
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
	$.ajax({
		url : '/billing/savebill',
		type : 'POST',
		dataType : 'JSON',
		data : {'_token':token,'deal_id':deal_id,'bill_start_date':from_date,'bill_end_date':to_date,'agency_commission':agency_commission,'subtotal':subtotal_amount,'service_tax':service_tax_amount,'discount':0,'total_amount':bill_amount},
		success : function(data) {
		//console.log(data);
		getAllbill();
		}
	});
});




$("#schecdule_table_row").on("click", ".del", function() {
	var $del = $(this);
	var id = $del.closest("tr").find(".asm_id").text();

	alertify.confirm("Delete schedule?", function(e) {
		if (e) {
			deletePro($del, id);
		}
	});
});
$(document).on('click', '#print_tclog', function()
{
// your code
	alert('print_tclog');
});

function getAllbill(){
	$('#generate_bill_section').hide();
	$('#all_bills').show();
	$.ajax({
		url : '/billing/allbill',
		type : 'GET',
		dataType : 'JSON',
		success : function(data) {
		//console.log(data);
		$('#all_bills_row').empty();
			for(var i in data){
				var action_btns ='<div class="btn-group"><a href="/addneon/printinvoice/1" target="_blank"><i class="fa fa-print"></i></a></div>';
				var row_item='<tr><td>'+pad(data[i].id,4)
										+'</td><td>D'+pad(data[i].deal_id,4)
										+'</td><td>'+data[i].client_name
										+'</td><td>'+data[i].agency_name
										+'</td><td>'+data[i].ex_name
										+'</td><td> INR '+data[i].ro_amount
										+'</td><td>'+moment(data[i].bill_start_date).format('ll')
										+'<strong> To </strong><br>'+moment(data[i].bill_end_date).format('ll')
										+'</td><td>INR '+data[i].total_amount
										+'</td><td>'+action_btns+'</td></tr>';
				$('#all_bills_row').append(row_item);
			}
		}
	});

}
