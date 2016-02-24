window.onload = function(){
	$('#client').addClass('active');
	allclient();
	
}

function clientForm(){
	$('#client-div').toggle('200');
}


var token = $("input[name=_token]").val();

function saveClient(){
	var formData = $('form#client-form').serializeArray(); 
	$('#saveBtn').attr('disabled', true).html('PLEASE WAIT..');
	$.ajax({
		url : '/client/saveclient',
		type : 'POST',
		dataType : 'JSON',
		data : formData,
		success : function(data) {
			$('#saveBtn').attr('disabled', false).html('submit');
			var c_status
			if(data.length!=0){
				$('form#client-form').each(function() {
					this.reset();
					allclient();
				});
			
				alertify.success('saved successfully');
			}
			else{
				alertify.error('something went wrong!!');
			}
		}
	});
}





//all client on a table
function allclient(){
	$('#client-list').html('<tr><td colspan="8" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
	$.ajax({
		url : '/client/all',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#client-list').empty();
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
								+'<td class="city">'+data[i].city+'</td>'
								+'<td class="address hidden">'+data[i].address+'</td>'
								+'<td><button class="edit btn btn-rounded btn-sm btn-icon btn-info"><i class="fa fa-edit"></i></button></td>'
								+'</tr>';
				
				$('#client-list').append(client);			
			}
		}
	});
}


//update agency

$("#client-list").on("click", ".edit", function() {
	var $edit = $(this);
	var id = $edit.closest("tr").find(".id").text();
	var name = $edit.closest("tr").find(".name").text();
	var email = $edit.closest("tr").find(".email").text();
	var mobile = $edit.closest("tr").find(".mobile").text();
	var city = $edit.closest("tr").find(".city").text();
	var address = $edit.closest("tr").find(".address").text();
	
	$('#saveBtn').hide();
	$('#upBtn').show();
	$('#client-div').show('200');
	$('#editID').val(id);
	$('#name').val(name);
	$('#email').val(email);
	$('#mobile').val(mobile);
	$('#city').val(city);
	$('#address').val(address);
});
function updateClient(){
	var formData = $('form#client-form').serializeArray(); 
	$('#upBtn').attr('disabled', true).html('Updating...');
	$.ajax({
		url : '/client/updateclient',
		type : 'POST',
		dataType : 'JSON',
		data : formData,
		success : function(data) {
			$('#upBtn').attr('disabled', false).html('update');
			var c_status
			if(data.length!=0){
				$('form#client-form').each(function() {
					this.reset();
				});
				$('#saveBtn').show();
				$('#upBtn').hide();
				alertify.success('updated successfully');
				allclient();
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




