window.onload = function(){
	$('#user').addClass('active');
	allUser();
}
var token =  $("input[name=_token]").val();

function saveUser() {
		var formData = $('form#user-form').serializeArray();
		$('#saveBtn').attr('disabled', true).html('please wait...');
		$.ajax({
			url : '/settings/saveuser',
			type : 'POST',
			dataType : 'JSON',
			data : formData,
			success : function(data) {
				$('#saveBtn').attr('disabled', false).html('submit');
				if(data!=0){
					$('form#user-form').each(function() {
						this.reset();
					});
					alertify.success('user successfuly created');
				}
				else{
					alertify.error('something went wrong');
				}
			}
		});

}
function allUser() {
	$('#user-list')
			.html('<tr><td colspan="4" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
		$.ajax({
				url : '/common/alluser',
				type : 'GET',
				datatype : 'JSON',
				success : function(data) {
					var count = 0;
					var  permission, action;
					$('#railway_users_list').empty();
					for ( var i in data) {

						//permission = '<button class="permission   btn btn-default btn-xs">set</button>';
						if (data[i].status == 1) {
							action = '<button class="disable btn   btn-success btn-xs">Enabled</button>';
						} else {
							action = '<button class="enable btn  btn-default btn-xs">Disabled</button>';
						}
						var row = '<tr>'
									+ '<td class="id hidden">'+ data[i].id + '</td>'
									+ '<td class="name">'+ data[i].name + '</td>'
									+ '<td class="mobile">' + data[i].mobile+ '</td>'
									+ '<td class="email">'+ data[i].email + '</td>'
									+ '<td class="email">'+ data[i].designation + '</td>'
									+ '<td class="email">'+ data[i].role + '</td>'
									+ '<td class="email">'+ action + '</td>'
									+ '<td class="email"><button class="permission btn btn-info btn-xs">Edit</button></td>'
									+'</tr>';
						$('#railway_users_list').append(row);
					}
				}
			});
}

//disable user
var $disable = 0;
$("#user-list").on("click", ".disable", function(){
	$disable = $(this);
	var status = 0;
	var id = $disable.closest("tr").find(".id").text();
	disableUser(id, status, $disable);

});

function disableUser(id, status, $disable){
	$disable.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
	$.ajax({
		url: '/settings/disable',
		type: 'POST',
		datatype: 'JSON',
		data:{'id':id, 'status':status ,'_token':token},
		success: function(data){
			$disable.closest('td').html('<button class="enable btn btn-default  btn-xs">Disabled</button>');
		}

	});
}
// enable user
var $enable = 0;
$("#user-list").on("click", ".enable", function(){
	$enable = $(this);
	var status = 1;
	var id = $enable.closest("tr").find(".id").text();
	enableUser(id, status, $enable);
});
function enableUser(id, status, $enable){
	$enable.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
	$.ajax({
		url: '/settings/enable',
		type: 'POST',
		datatype: 'JSON',
		data:{'id':id, 'status':status ,'_token':token},
		success: function(data){
			$enable.closest('td').html('<button class="disable btn btn-success  btn-xs">Enabled</button>');
		}

	});
}


//set permission
var $set = 0;
$("#user-list").on("click", ".permission", function() {
	$set = $(this);
	var user_id = $set.closest("tr").find(".id").text();
	var name = $set.closest('tr').find('.name').text();
	$('#myModalLabel').text(name);
	$('#permissionModal').modal('show');
	setPermission($set,user_id,name);
});

function setPermission($set,user_id,name){
	$('#permission-list').html('<tr><td colspan="2" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
	$.ajax({
		url: '/permission/setpermission',
	    type: 'POST',
	    dataType: 'JSON',
	    data: {'user_id':user_id},
	    success: function(data){
	    	$('#permission-list').empty();
	    	//console.log(data);
	    	var action;
	    	for (var i in data){
	    		if(data[i].permission == 1){
	    			action = '<div class="btn-group btn-toggle">'
	    			    +'<button class="btn btn-xs btn-success active">ON</button>'
	    			    +'<button class="off btn btn-xs btn-default ">OFF</button>'
	    			    +'</div>';
	    		}
	    		else{
	    			action = '<div class="btn-group btn-toggle">'
	    			    	+'<button class="on btn btn-xs btn-default">ON</button>'
	    			    	+'<button class="btn btn-xs btn-danger active">OFF</button>'
	    			    	+'</div>';
	    		}
	    		 var row = '<tr>'
					    +'<td class="user_id hidden">'+user_id+'</td>'
					    +'<td class="permission_id hidden">'+data[i].id+'</td>'
					    +'<td class="permission_name">'+data[i].name+'</td>'
					    +'<td>'+action+'</td>'
			    	$('#permission-list').append(row);
	    	}
	    }
	});
}

//on permission
$("#permission-list").on("click", ".on", function() {
	$on = $(this);
	var user_id = $on.closest("tr").find(".user_id").text();
	var permission_id = $on.closest("tr").find(".permission_id").text();
	var permission_name = $on.closest("tr").find(".permission_name").text();
	$.ajax({
	    url: '/permission/on',
	    type: 'POST',
	    dataType: 'JSON',
	    data: {'user_id': user_id, 'permission_id':permission_id},
	    success: function(data){
	    	$on.closest("tr").html('<td class="user_id hidden">'+user_id+'</td><td class="permission_id hidden">'+permission_id+'</td><td class="permission_name">'+permission_name+'</td><td><div class="btn-group btn-toggle"><button class="btn btn-xs btn-success active">ON</button><button class="off btn btn-xs btn-default ">OFF</button></div></td>');
		}
	});
});
//off permission
$("#permission-list").on("click", ".off", function() {
	$off = $(this);
	var permission_id = $off.closest("tr").find(".permission_id").text();
	var user_id = $off.closest("tr").find(".user_id").text();
	var permission_name = $off.closest("tr").find(".permission_name").text();
	$.ajax({
	    url: '/permission/off',
	    type: 'POST',
	    dataType: 'JSON',
	    data: {'user_id': user_id, 'permission_id':permission_id},
	    success: function(data){
	    	$off.closest("tr").html('<td class="user_id hidden">'+user_id+'</td><td class="permission_id hidden">'+permission_id+'</td><td class="permission_name">'+permission_name+'</td><td><div class="btn-group btn-toggle"><button class="on btn btn-xs btn-default" >ON</button><button class="btn btn-xs btn-danger btn-active">OFF</button></div></td>');
		}
	});

});
