window.onload = function() {
	$('#billing').addClass('active');
	allClient();
	allAgency();
	$('#search_field').show();
	$('#generate_bill_section').hide();
	$('#deal_details_div').hide();
	$('#schedulebill-div').hide();

}
$("#from_date,#to_date").datepicker({
	dateFormat : 'yy-mm-dd',
	showAnim : 'slideDown'
});

var total_duration, count;
var token = $("input[name=_token]").val();
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
				var row_item='<tr><td>'+deal_details[i].item_id+'</td><td>600 Sec</td><td>165</td><td>250</td><td>33000</td></tr>';
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
$("#deal_details_list").on("click", ".bill", function() {
	var $edit = $(this);
	var id = $edit.closest("tr").find(".deal_id").text();
	$('#generate_bill_section').show();
	$('#deal_details_div').hide();
	$('#schedulebill-div').hide();

	//alert(id);
});

$('#editModal').on('hidden.bs.modal', function (e) {
	$('form#dealedit-form').each(function() {
		this.reset();
	});
	$('#editclient_id,#editagency_id,#edititem_id,#editexecutive_id').empty();
	})



function getdealdetails(id){

			 $('#detailsModal').modal('show');
			 $.ajax({
		 		url : '/deal/dealbyid',
		 		type : 'POST',
				data:{'_token':token,'deal_id':id},
		 		datatype : 'JSON',
		 		success : function(data) {

						for(var i in data){
							$('#deal_details').empty();
					var deal = '<tr>'
								+'<td>'+data[i].item_id+'</td>'
								+'<td>'+data[i].time_slot+'</td>'
									+'<td>'+data[i].from_date+' To '+data[i].to_date+'</td>'
											+'<td>'+data[i].units+'</td>'
												+'<td>'+data[i].rate+'</td>'
												+'<td>'+data[i].amount+'</td>'

								+'</tr>';
		 			$('#deal_details').append(deal);
				}
				}
			});
}
