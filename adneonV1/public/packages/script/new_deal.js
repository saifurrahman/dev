
window.onload = function(){
	$('#deals').addClass('active');
	allClient();
	allAgency();
	allItem();
	allExe();
	allDeal();
//	getRevinuebytype();
	$('#deal-div').hide();
	$('#item-div').hide();
}

$("#item-list").on("click", ".delete", function() {
	var $del = $(this);


	alertify.confirm("Delete Item?", function(e) {
		if (e) {
			var itemId = $del.closest('tr').find('.id').text();
			for(var i = 0; i < itemList.length; i++) {
			    var obj = itemList[i];
			    if(obj.id==itemId) {
			        itemList.splice(i, 1);
			    }
			}
			$del.closest("tr").remove();
		}
	});

});

$("#save_deal").on("click",function(e){
		e.preventDefault;
		//validate form
		//ajax
		var client_id=$('#client_id').val();
		var agency_id=$('#agency_id').val();
		var ro_number=$('#ro_number').val();
		var ro_amount=$('#ro_amount').val();
		var executive_id=$('#executive_id').val();
		var payment_peference=$('#payment_peference').val();
		var remark=$('#remark').val();
		var ro_date=moment($('#ro_date').val()).format('DD/MM/YY');

		if(itemList.length==0){

				alertify.error('Please add property!');

		}else if(client_id==0 || ro_number=='' || ro_date==''){

				alertify.error('Please select all reqired filed!');

		}else{
		$.ajax({
			url : '/deal/savedeal',
			type : 'POST',
			dataType : 'JSON',
			data : {'_token':token,'itemList':itemList,'client_id':client_id,'agency_id':agency_id,'ro_number':ro_number,'ro_amount':ro_amount,'ro_date':ro_date,'executive_id':executive_id,'payment_peference':payment_peference,'remark':remark,},
			success : function(data) {
			//	$('#save_deal').attr('disabled', false).html('submit');
				if(data!=0){
					$('form#deal-form').each(function() {
						this.reset();
					});
					alertify.success('saved successfully');
					$('#deal-div').hide('200');
					$('#item-div').hide('200');
					itemList =[];
					$('#item-list').empty();

					//allDeal();
				}
				else{
					alertify.error('something went wrong!!');
				}
			}
		});
	}

		console.log(client_id+'--'+executive_id);
	  return false;
});
function getRevinuebytype(){
	$.ajax({
		url : '/deal/revinuebytype',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			console.log(data);

		}
	});
}
function dealForm(){
	$('#deal-div').toggle('200');
	$('#item-div').toggle('200');
	$('#deal_details_div').toggle('200');
}

// Init list
var itemList =[];// new List('item', options);

function additem(){
var property= $( "#item_id option:selected" ).text();
	alert(property);
//	var property=$( "#item_id option:selected").val();
	var time_slot=$('#time_slot').val();
	var from_date=moment($('#from_date').val()).format('DD/MM/YY');
	var to_date=moment($('#to_date').val()).format('DD/MM/YY');
	var units=$('#units').val();
	var rate=$('#rate').val();
	var amount=units*rate;
	if(from_date=='' || to_date=='' || units=='' || rate=='' ){
		alertify.error('Please select all required field!');

	}else{
var id=Math.floor(Math.random()*110000);
	var deal = '<tr>'
				+'<td class="id" style="display:none;">'+id+'</td>'
				+'<td>'+property+'</td>'
					+'<td>'+time_slot+'</td>'
						+'<td>'+from_date+'-'+to_date+'</td>'
							+'<td>'+units+'</td>'
								+'<td>'+rate+'</td>'
								+'<td>'+amount+'</td>'
								+'<td ><button class="delete btn btn-rounded btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></button></td>'
				+'</tr>';
	$('#item-list').append(deal);
var property_id=	$( "#item_id" ).val();
	var item ={
	 id: id,
	 property_id: property_id,
	 property: property,
	 time_slot: time_slot,
	 from_date: from_date,
	 to_date: to_date,
	 units: units,
	 rate: rate,
	 amount: amount
 };
 itemList.push(item);
 }
	console.log(itemList);
}

jQuery('#table-div').css("overflow-y", "scroll");


var token = $("input[name=_token]").val();

$("#from_date,#to_date,#editfrom_date,#editto_date,#editro_date").datepicker({
	dateFormat : 'yy-mm-dd',
	changeMonth : true,
	changeYear : true,
	showAnim : 'slideDown',
});

$("#ro_date").datepicker({
	dateFormat : 'yy-mm-dd',
	showAnim : 'slideDown',
});

$('#time_slot').selectize();

function allClient(){
	$.ajax({
		url : '/deal/allclient',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#client_id').empty().append('<option value="">Select</option>');
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
			$('#agency_id').empty();
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
//advertisement type
function allItem(){
	$('#item_id').empty();
	$.ajax({
		url : '/deal/allitem',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			for(var i in data){
				//select box
				$('#item_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}

		}
});
}

$('#executive_id').on('change', function(){
	if($(this).val() == 0){
		$('#exModal').modal('show');
	}
});

//executive
function allExe(){
	$.ajax({
		url : '/deal/allexe',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#executive_id').append('<option value="0">Select</option>');
			for(var i in data){
				//select box
				$('#executive_id').append('<option value="'+data[i].id+'">'+data[i].ex_name+' -> '+data[i].location+'</option>');
			}

		}

	});
}
function saveDeal(){
	var formData = $('form#deal-form').serializeArray();
	$('#saveBtn').attr('disabled', true).html('PLEASE WAIT..');

	$.ajax({
		url : '/deal/savedeal',
		type : 'POST',
		dataType : 'JSON',
		data : formData,
		success : function(data) {
			$('#saveBtn').attr('disabled', false).html('submit');
			if(data!=0){
				$('form#deal-form').each(function() {
					this.reset();
				});
				alertify.success('saved successfully');
				$('#deal-div').hide('200');
				$('#deal-div').show(deal_details_div);
				allDeal();
			}
			else{
				alertify.error('something went wrong!!');
			}
		}
	});
}
function getdealdetails(id){

			 $('#detailsModal').modal('show');
			 $.ajax({
		 		url : '/deal/dealbyid',
		 		type : 'POST',
				data:{'_token':token,'deal_id':id},
		 		datatype : 'JSON',
		 		success : function(data) {

$('#deal_details').empty();
						for(var i in data){

					var deal = '<tr>'
								+'<td>'+data[i].name+'</td>'
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
function allDeal(){
	$('#deal-list').html('<tr><td colspan="9" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
	$.ajax({
		url : '/deal/alldeal',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#deal-list').empty();
			var count = 0;
			var agency;
			var total_amount=0;
		//	console.log(data);
		$('#deal_details_list').empty();
			for(var i in data){
				var deal = '<tr>'
							+'<td class="hidden deal_id">'+data[i].id+'</td>'
							+'<td class="deal_name"><a href="javascript:getdealdetails('+data[i].id+');">D'+pad(data[i].id, 4)+'</a></td>'
							+'<td class="client_name">'+data[i].client_name+'</td>'
							+'<td class="agency_id">'+data[i].agency_name+'</td>'
							+'<td class="amount">'+data[i].ex_name+'</td>'
							+'<td class="remarks">'+data[i].ro_number+'||'+data[i].ro_date+'</td>'
							+'<td class="remarks">'+data[i].ro_amount+'</td>'
							+'<td class="remarks">'+data[i].remarks+'</td>'

							+'</tr>';
				$('#deal_details_list').append(deal);

				total_amount=total_amount+data[i].ro_amount;
			//	console.log(data[i].from_date+'----'+data[i].to_date+'-----'+getDuration(data[i].from_date,data[i].to_date));

			}



		}
	});
}



$("#deal-list").on("click", ".edit", function() {
	var $edit = $(this);
	var id = $edit.closest("tr").find(".deal_id").text();
	var deal_name = $edit.closest("tr").find(".deal_name").text();
	$('#editModal').modal('show');
	$('#deal_name').empty();
	$('#deal_name').append(deal_name);
	getdealByID(id);
});

$('#editModal').on('hidden.bs.modal', function (e) {
	$('form#dealedit-form').each(function() {
		this.reset();
	});
	$('#editclient_id,#editagency_id,#edititem_id,#editexecutive_id').empty();
	})

function getdealByID(id){
	$.ajax({
		url : '/deal/dealbyid',
		type : 'POST',
		data: {'id':id,'_token':token},
		datatype : 'JSON',
		success : function(data) {
			for (var i in data){
				$('form#dealedit-form').each(function() {
					this.reset();
				});
				$('#editclient_id').append('<option value="'+data[i].client_id+'">'+data[i].client_name+'</option>');
				$('#editagency_id').append('<option value="'+data[i].agency_id+'">'+data[i].agency_name+'</option>');
				$('#editfrom_date').val(data[i].from_date);
				$('#editto_date').val(data[i].to_date);
				$('#editrate').val(data[i].rate);
				$('#editamount').val(data[i].amount);
				$('#edittimeslot_id').val(data[i].time_slot);
				$('#editduration').val(data[i].duration);
				$('#edititem_id').append('<option value="'+data[i].item_id+'">'+data[i].item_name+'</option>');
				$('#editexecutive_id').append('<option value="'+data[i].ex_id+'">'+data[i].ex_name+'->'+data[i].location+'</option>');
				$('#editro_no').val(data[i].ro_number);
				$('#editro_date').val(data[i].ro_date);
				$('#editremark').val(data[i].remark);
				$('#editID').val(data[i].id);

			}
		}
	});

}
