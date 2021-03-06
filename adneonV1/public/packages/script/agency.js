window.onload = function(){
	$('#agency').addClass('active');
	allAgency();
//	$('#client-div').show();
}


function clientForm(){
	$('#client-div').toggle('200');
}
var token = $("input[name=_token]").val();

function saveAgency(){
	var formData = $('form#agency-form').serializeArray();
	$('#saveBtn').attr('disabled', true).html('PLEASE WAIT..');
	$.ajax({
		url : '/client/saveagency',
		type : 'POST',
		dataType : 'JSON',
		data : formData,
		success : function(data) {
			$('#saveBtn').attr('disabled', false).html('submit');
			var c_status
			if(data.length!=0){
				$('form#agency-form').each(function() {
					this.reset();
				});
				alertify.success('saved successfully');
				allAgency();
			}
			else{
				alertify.error('something went wrong!!');
			}
		}
	});
}
//all agency on a table
function allAgency(){
	$('#agency-list').html('<tr><td colspan="7" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
	$.ajax({
		url : '/client/allagency',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#agency-list').empty();
			var count = 0;
			var c_status;
			for(var i in data){
				count = count+1;
				var client = '<tr>'
								//+'<td class="hidden">'+data[i].id+'</td>'
								+'<td class="count">'+count+'</td>'
								+'<td class="id hidden">'+data[i].id+'</td>'
								+'<td class="name ">'+data[i].name+'</td>'
								+'<td class="email">'+data[i].email+'</td>'
								+'<td class="mobile">'+data[i].mobile+'</td>'
								+'<td>'+data[i].address1+'\n'+data[i].address2+','+data[i].city+'</td>'
								+'<td class="city hidden">'+data[i].city+'</td>'
								+'<td class="commission">'+data[i].commission+' &nbsp; </td>'
								+'<td class="address1 hidden">'+data[i].address1+' &nbsp; </td>'
								+'<td class="address2 hidden">'+data[i].address2+' &nbsp; </td>'
								+'<td><button class="edit btn btn-rounded btn-sm btn-icon btn-info"><i class="fa fa-edit"></i></button></td>'
								+'</tr>';

				$('#agency-list').append(client);
			}
		}
	});
}


////edit client
$("#agency-list").on("click", ".edit", function() {
	var $edit = $(this);
	var id = $edit.closest("tr").find(".id").text();
	var name = $edit.closest("tr").find(".name").text();
	var email = $edit.closest("tr").find(".email").text();
	var mobile = $edit.closest("tr").find(".mobile").text();
	var city = $edit.closest("tr").find(".city").text();
	var commission = $edit.closest("tr").find(".commission").text();
	var address1 = $edit.closest("tr").find(".address1").text();
	var address2 = $edit.closest("tr").find(".address2").text();

	$('#saveBtn').hide();
	$('#upBtn').show();
	$('#client-div').show('200');

	$('#editID').val(id);
	$('#name').val(name);
	$('#email').val(email);
	$('#mobile').val(mobile);
	$('#city').val(city);
	$('#Editcommission').val(commission);
	$('#address1').val(address1);
	$('#address2').val(address2);
});
function updateAgency(){
	var formData = $('form#agency-form').serializeArray();
	$('#upBtn').attr('disabled', true).html('Updating...');
	$.ajax({
		url : '/client/updateagency',
		type : 'POST',
		dataType : 'JSON',
		data : formData,
		success : function(data) {
			$('#upBtn').attr('disabled', false).html('update');
			var c_status
			if(data.length!=0){
				$('form#agency-form').each(function() {
					this.reset();
				});
				$('#saveBtn').show();
				$('#upBtn').hide();
				alertify.success('updated successfully');
				allAgency();
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
