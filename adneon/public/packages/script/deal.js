window.onload = function(){
	$('#deals').addClass('active');
	allClient();
	allAgency();
	allItem();
	allExe();
	allDeal();
	getRevinuebytype();
}
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
//advertisement type
function allItem(){
	$.ajax({
		url : '/deal/allitem',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#item_id').append('<option value="">Select</option>');
			for(var i in data){
				//select box
				$('#item_id').append('<option value="'+data[i].id+'">'+data[i].name+'&nbsp;('+data[i].type+')</option>');
			}

		}

	}).done(function() {
		$('#item_id').selectize()
	});;
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
			//$('#executive_id').append('<option value="-">Select</option>');
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
				allDeal();
			}
			else{
				alertify.error('something went wrong!!');
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
			for(var i in data){
				var deal = '<tr>'
							+'<td class="hidden deal_id">'+data[i].id+'</td>'
							+'<td class="deal_name">D'+pad(data[i].id, 4)+'</td>'
							+'<td class="client_name">'+data[i].client_name+'</td>'
							+'<td class="agency_id">'+data[i].agency_name+'</td>'
							+'<td class="duration">'+moment(data[i].from_date).format('ll')+'</td>'
							+'<td class="duration">'+moment(data[i].to_date).format('ll')+'</td>'
							+'<td class="item_name">'+data[i].item_name+'</td>'
							+'<td class="sec">'+data[i].duration+'</td>'
							+'<td class="rate">'+data[i].rate+'</td>'
							+'<td class="amount">'+data[i].amount+'</td>'
							+'<td class="remarks">'+data[i].ex_name+'</td>'
							+'<td class="remarks">'+data[i].remark+'</td>'
							+'<td ><button class="edit btn btn-rounded btn-sm btn-icon btn-info"><i class="fa fa-edit"></i></button></td>'
							+'</tr>';
				$('#deal-list').append(deal);

				total_amount=total_amount+data[i].amount;
				console.log(data[i].from_date+'----'+data[i].to_date+'-----'+getDuration(data[i].from_date,data[i].to_date));

			}
			var deal = '<tr>'

				+'<td>Total</td>'
				+'<td></td>'
				+'<td></td>'
				+'<td></td>'
				+'<td></td>'
				+'<td></td>'
				+'<td></td>'
				+'<td></td>'
				+'<td></td>'
				+'<td> INR '+total_amount.toFixed(2)+'</td>'
				+'<td></td>'
				+'</tr>';

			$('#total_deal').empty().append('INR '+total_amount.toFixed(2));
			$('#deal-list').append(deal);
		}
	});
}
function saveEx(){
	var name = $.trim($('#ex_name').val());
	var formData = $('form#ex-form').serializeArray();
	if(name !=0||name!=''){
		$('#exBtn').attr('disabled', true).html('PLEASE WAIT..');
		$.ajax({
			url : '/deal/executive',
			type : 'POST',
			dataType : 'JSON',
			data : formData,
			success : function(data) {
				$('#exBtn').attr('disabled', false).html('Save');
				alertify.success('saved');
				$('#executive_id').append('<option value="'+data['id']+'">'+data['ex_name']+'->'+data['location']+'</option>');
				$('form#ex-form').each(function() {this.reset();});
				$('#exModal').modal('hide');
			}
		})
	}
	else{
		alertify.error('required field unfilled');
	}
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


//update deal
function updateDeal(){
	var formData = $('form#dealedit-form').serializeArray();
	$('#updateBtn').attr('disabled', true).html('PLEASE WAIT..');

	$.ajax({
		url : '/deal/updatedeal',
		type : 'POST',
		dataType : 'JSON',
		data : formData,
		success : function(data) {
			$('#updateBtn').attr('disabled', false).html('submit');
			if(data!=0){
				$('form#dealedit-form').each(function() {
					this.reset();
				});
				alertify.success('update successfully');
				allDeal();
				$('#editModal').modal('hide');
			}
			else{
				alertify.error('something went wrong!!');
			}
		}
	});
}
//table search js
$("#search").keyup(function () {
    var value = this.value.toLowerCase().trim();

    $("table tr").each(function (index) {
        if (!index) return;
        $(this).find("td").each(function () {
            var id = $(this).text().toLowerCase().trim();
            var not_found = (id.indexOf(value) == -1);
            $(this).closest('tr').toggle(!not_found);
            return not_found;
        });
    });
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
