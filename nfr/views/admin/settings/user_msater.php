<aside class="right-side">                
   	<!-- Content Header (Page header) -->
    <section class="content-header">
      	<h1>Users</h1>
      	<ol class="breadcrumb"></ol>
    </section>
    <section class="content">
    	<div class="row pagemenu">
    		<div class="col-md-8 col-xs-12">
    			<input type="text" class="form-control" id="search_user" placeholder="Search">	
    		</div>
    		<div class="col-md-4 col-xs-12">
    			<button class="btn btn-primary pull-right" id="add_user_btn" data-toggle="modal" data-target="#createUserModal"><i class="fa fa-plus"></i> New User</button>
    		</div>
    	</div>
        <div class="row">
			<div class="col-md-12">
				<div class="box box-danger">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Mobile</th>
									<th>Designation</th>
									<th>Role</th>
									<th>Permission</th>
									<th style="width:5%;">Approve</th>
									<th style="width:5%;">Edit</th>
								</tr>
							</thead>
							<tbody id="railway_users_list"></tbody>
						</table>
					</div>
				</div>		
			</div>
		</div>
    </section>
</aside>
<!-- Add User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="createUserModalLabel">Add User</h3>
      </div>
      <div class="modal-body mafter">
        <div class="row">
        	<form role="form" id="add_user_form" action="" method="post">
	        	<div class="col-md-6">
		        	<div class="form-group">
		        		<label>Name</label>
			        	<input type="text" class="form-control" id="name" name="name" required="required" placeholder="Name">
			        </div>
			        <div class="form-group">	
			        	<label>Email</label>
			        	<input type="email" class="form-control" id="email" name="email" required="required"  placeholder="Email">
					</div>
			        <div class="form-group">		        	
			        	<label>Mobile</label>
			        	<input type="tel" class="form-control" id="mobile" name="mobile" maxlength="10" required="required" placeholder="Mobile">
			        </div>
	        	</div>
	        	<div class="col-md-6">
			        <div class="form-group">
			        	<label>Designation</label>
			        	<input type="text" class="form-control" id="designation" name="designation" placeholder="Designation">
			        </div>
			        <div class="form-group">	
			        	<label>Role</label>
			        	<select class="form-control" name="role_id" id="role_id">
			        		<option value="0">--select--</option>
			        		<option value="3" >SR DSTE/TSK</option>
			        		<option value="6" >DSTE/TSK</option>
			        		<option value="4" >ADSTE/W/TSK</option>
			        		<option value="5" >ADSTE/MXN</option>
			        		<option value="1">SECTIONAL SUPERVISER</option>
			        		<option value="2">INCHARGE SSE/SE</option>
			        	</select>
			        </div>
			        <div class="form-group">
			        	<label><br/></label>
			        	<button type="button" class="btn btn-primary btn-block" id="createUserBtn" onclick="createUser();">Save</button>
			        </div>	
	        	</div>
        	</form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="editUserModalLabel">Edit User</h3>
      </div>
      <div class="modal-body mafter">
        <div class="row">
        	<form role="form" id="edit_user_form" action="" method="post">
	        	<div class="col-md-6">
		        	 <div class="form-group">
		        		<input type="hidden" id="edit_id" name="id">
		        		<label>Name</label>
			        	<input type="text" class="form-control" id="edit_name" name="name" required="required" placeholder="Name">
			         </div>		
			        <div class="form-group">
			        	<label>Email</label>
			        	<input type="email" class="form-control" id="edit_email" name="email" required="required"  placeholder="Email">
		        	</div>	
			        <div class="form-group">		        	
			        	<label>Mobile</label>
			        	<input type="tel" class="form-control" id="edit_mobile" name="mobile" maxlength="10" required="required" placeholder="Mobile">
		        	</div>	
	        	</div>
	        	<div class="col-md-6">
			        <div class="form-group">	        	
		        		<label>Designation</label>
			        	<input type="text" class="form-control" id="edit_designation" name="designation" placeholder="Designation">
		        	</div>	
			        <div class="form-group">
		        		<label>Role</label>
			        	<select class="form-control" name="role_id" id="edit_role_id">
			        		<option></option>
			        		<option value="1">SECTIONAL DSMG</option>
			        		<option value="2">INCHARGE SSE/SE</option>
			        		<option value="3" disabled="disabled">ADMINISTRATOR</option>
			        	</select>
			        </div>	
			        <div class="form-group">		        	
			        	<label><br/></label>
		        		<button type="button" class="btn btn-primary btn-block" id="updateUserDetails_btn" onclick="updateUserDetails();">Update</button>
	        		</div>
	        	</div>
        	</form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="setPermissionModal" tabindex="-1"
	role="dialog" aria-labelledby="setPermissionModalLabel"
	aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="setPermissionModalLabel">Set Permission</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<table class=" table table-responsive">
							<thead>
								<tr>
									<th>Permission Type</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody id="user_permission"></tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$('#setting_li, #user_msater_li').addClass('active');
$('#setting_sub_ul').css('display', 'block');
window.onload = function() {
	getAllUsers();
};

function getAllUsers(){
	$('#railway_users_list').html('<tr><td colspan="9" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
	$.ajax({
		url: '<?php echo URL;?>settings/getAllUsers/',
		type: 'POST',
		datatype: 'JSON',
		success: function(data){
			$('#railway_users_list').empty();
			for(var i in data){
				var status = ''; 
				if(data[i].status == 1){
					status = '<td><button class="approved btn btn-success btn-xs" title="click to disable">enabled</button></td>';	
				}
				else{
					status = '<td><button class="unapproved btn bg-navy btn-xs" title="click to enable">disabled</button></td>';
				}
				var row ='<tr>'
		 			+'<td class="id hidden">'+data[i].id+'</td>'
		 			+'<td class="name">'+data[i].name+'</td>'
		 			+'<td class="email">'+data[i].email+'</td>'
		 			+'<td class="mobile">'+data[i].mobile+'</td>'
		 			+'<td class="designation">'+data[i].designation+'</td>'
		 			+'<td class="role_name">'+data[i].role+'</td>'
		 			+'<td class="role_id hidden">'+data[i].role_id+'</td>'
		 			+'<td><button class="permission btn btn-warning btn-xs">permission</button></td>'
		 			+status
		 			+'<td><button class="edit btn btn-info btn-xs">edit</button></td>'
		 			//+'<td><button class="del btn btn-danger btn-xs">delete</button></td>'
		 			+'</tr>';
				$('#railway_users_list').append(row);
			}	
		}
	});
}

function createUser(){
	var formData = $('form#add_user_form').serializeArray();
	$('#createUserBtn').attr('disabled',true).html('<i class="fa fa-spinner fa-spin"></i>');
	$.ajax({
		url: '<?php echo URL;?>settings/createUser/',
		type: 'POST',
		dataTtype: 'JSON',
		data: formData,
		success: function(data){
			if(data == 0){
				alertify.error("Already Registered");
				$('form#add_user_form').each(function(){this.reset();});
				$('#createUserBtn').attr('disabled',false).html('create');
				$('#createUserModal').modal('hide');
			}
			else{
				$('#createUserModal').modal('hide');
				$('#createUserBtn').attr('disabled',false).html('create');
				var row ='<tr>'
		 			+'<td class="id hidden">'+data['id']+'</td>'
		 			+'<td class="name">'+data['name']+'</td>'
		 			+'<td class="email">'+data['email']+'</td>'
		 			+'<td class="mobile">'+data['mobile']+'</td>'
		 			+'<td class="designation">'+data['designation']+'</td>'
		 			+'<td class="role_name">'+$("#role_id option:selected").text()+'</td>'
		 			+'<td class="role_id hidden">'+data['role_id']+'</td>'
		 			+'<td><button class="permission btn btn-warning btn-xs">permission</button></td>'
		 			+'<td><button class="unapproved btn bg-navy btn-xs" title="click to enable">disabled</button></td>'
		 			+'<td><button class="edit btn btn-info btn-xs">edit</button></td>'
		 			//+'<td><button class="del btn btn-danger btn-xs">delete</button></td>'
		 			+'</tr>';
				$('#railway_users_list').prepend(row);
				$('form#add_user_form').each(function(){this.reset();});
				alertify.success("Added Successfully");
				$row = $('#railway_users_list tr').first();
				$class = 'alert alert-success';
				rowActive($row,$class);
			}
		}			
	});
}
//registered user enable disable
 $("#railway_users_list").on("click", ".approved", function(){
	 var $approved = $(this);
	 var user_id = $approved.closest("tr").find(".id").text();
	 var status = 0;
	 alertify.confirm("Are you sure ?", function(e){
		if(e){
			$approved.html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
			enable_disable($approved,user_id,status);
		}
	});
});
$("#railway_users_list").on("click", ".unapproved", function(){
	 var $unapproved = $(this);
	 var user_id = $unapproved.closest("tr").find(".id").text();
	 var status = 1;
	 alertify.confirm("Are you sure ?", function(e){
		if(e){
			$unapproved.html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
			enable_disable($unapproved,user_id,status);
		}
	});
}); 
function enable_disable($this,user_id,status){
    $.ajax({
        url: '<?php echo URL; ?>settings/change_account_status/',
        type: 'POST',
        dataType: 'JSON',
        data: {'user_id': user_id,'status': status},
        success: function(data){
            if(status == 0){
            	$this.closest("td").html('<button class="unapproved btn bg-navy btn-xs" title="click to enable">disabled</button>');
            }
            if(status == 1){
            	$this.closest("td").html('<button class="approved btn btn-success btn-xs" title="click to disable">enabled</button>');
            }
        }
    });
}

//delete users
/*
$("#railway_users_list").on("click", ".del", function() {
	var $del = $(this);
    var user_id = $del.closest("tr").find(".id").text();
    alertify.confirm("Are you sure ?", function(e){
		if(e){
			$del.html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
			delete_user($del,user_id);
		}
	});
});
function delete_user($this,user_id){
	$.ajax({
	    url: '<?php echo URL; ?>settings/delete_user/',
	    type: 'POST',
	    dataType: 'JSON',
	    data: {'user_id': user_id},
	    success: function(data){
	    	if(data > 1){
				$this.closest("tr").remove();
				alertify.error("User Removed");
			}
		}
	});
}
*/
//edit
var $edit = 0;
$("#railway_users_list").on("click", ".edit", function(){
	$edit = $(this); 
	var id = $edit.closest("tr").find(".id").text();
	var name = $edit.closest("tr").find(".name").text();
	var email = $edit.closest("tr").find(".email").text();
	var mobile = $edit.closest("tr").find(".mobile").text();
	var designation = $edit.closest("tr").find(".designation").text();
	var role_id = $edit.closest("tr").find(".role_id").text();
	$edit.html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
	$('#edit_id').val(id);
	$('#edit_name').val(name);
	$('#edit_email').val(email);
	$('#edit_mobile').val(mobile);
	$('#edit_designation').val(designation);
	$('#edit_role_id').val(role_id);
	$('#editUserModal').modal('show');
});
//update user details
function updateUserDetails(){
	var formData = $('form#edit_user_form').serializeArray();
	$('#updateUserDetails_btn').attr('disabled',true).html('<i class="fa fa-refresh fa-spin"></i>');
	$.ajax({
		url: '<?php echo URL?>settings/update_user_details/',
		type: 'POST',
		dataType: 'JSON',
		data: formData,
		success: function(data){
			if(data == 1){
				$edit.closest("tr").find(".name").text($('#edit_name').val());
				$edit.closest("tr").find(".email").text($('#edit_email').val());
				$edit.closest("tr").find(".mobile").text($('#edit_mobile').val());
				$edit.closest("tr").find(".designation").text($('#edit_designation').val());
				$edit.closest("tr").find(".role_name").text($("#edit_role_id option:selected" ).text());
				$edit.closest("tr").find(".role_id").text($("#edit_role_id option:selected").val());
				$('#updateUserDetails_btn').attr('disabled',false).html('Update');
				$('form#edit_user_form').each(function(){this.reset();});
				$('#editUserModal').modal('hide');
				alertify.success("User Updated");
				$row = $edit.closest("tr");
				$class = 'alert alert-success';
				rowActive($row,$class);
			}
			else{
				alertify.error("User can't be update");
				$('form#edit_user_form').each(function(){this.reset();});
				$('#updateUserDetails_btn').attr('disabled',false).html('Update');
				$('#editUserModal').modal('hide');
			}
		}
	});
}
$('#editUserModal').on('hidden.bs.modal', function (e){
	$edit.html('edit');
	$edit = 0;
});

//Quick Table Search
$('#search_user').keyup(function() {
  var regex = new RegExp($('#search_user').val(), "i");
  var rows = $('table tbody#railway_users_list tr:gt(0)');
  rows.each(function (index) {
    title = $(this).children(".name, .email,.mobile").html();
    if (title.search(regex) != -1) {
      $(this).show();
    } else {
      $(this).hide();
    }
  });
});


//set permission
var $set = 0;
$("#railway_users_list").on("click", ".permission", function() {
	$set = $(this);
	var user_id = $set.closest("tr").find(".id").text();
	var name = $set.closest('tr').find('.name').text();	
	$('#setPermissionModalLabel').text(name);
	$('#setPermissionModal').modal('show');
	setPermission($set,user_id,name);
});


function setPermission($set,user_id,name){
	$('#user_permission').html('<tr><td colspan="2" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
	$.ajax({
		url: '<?php echo URL; ?>settings/setpermission',
	    type: 'POST',
	    dataType: 'JSON',
	    data: {'user_id':user_id},
	    success: function(data){
	    	$('#user_permission').empty();
	    	console.log(data);
	    	var action;
	    	for (var i in data){
	    		if(data[i].permission == 1){
	    			action = '<div class="btn-group btn-toggle">' 
	    			    +'<button class="btn btn-xs btn-success btn-active">ON</button>'
	    			    +'<button class="off btn btn-xs btn-default ">OFF</button>'
	    			    +'</div>';
	    		}
	    		else{
	    			action = '<div class="btn-group btn-toggle">' 
	    			    	+'<button class="on btn btn-xs btn-default">ON</button>'
	    			    	+'<button class="btn btn-xs btn-danger btn-active">OFF</button>'
	    			    	+'</div>';
	    		}
	    		 var row = '<tr>'
					    +'<td class="user_id hidden">'+user_id+'</td>'
					    +'<td class="permission_id hidden">'+data[i].id+'</td>'
					    +'<td class="permission_name">'+data[i].name+'</td>'
					    +'<td>'+action+'</td>'				    
			    	$('#user_permission').append(row);
	    	}
	    }
	});
}


//on permission
$("#user_permission").on("click", ".on", function() {
	$on = $(this);
	var user_id = $on.closest("tr").find(".user_id").text();
	var permission_id = $on.closest("tr").find(".permission_id").text();
	var permission_name = $on.closest("tr").find(".permission_name").text();
	$.ajax({
	    url: '<?php echo URL; ?>settings/on',
	    type: 'POST',
	    dataType: 'JSON',
	    data: {'user_id': user_id, 'permission_id':permission_id},
	    success: function(data){
	    	$on.closest("tr").html('<td class="user_id hidden">'+user_id+'</td><td class="permission_id hidden">'+permission_id+'</td><td class="permission_name">'+permission_name+'</td><td><div class="btn-group btn-toggle"><button class="btn btn-xs btn-success btn-active">ON</button><button class="off btn btn-xs btn-default ">OFF</button></div></td>');
		}
	});
});
//off permission
$("#user_permission").on("click", ".off", function() {
	$off = $(this);
	var permission_id = $off.closest("tr").find(".permission_id").text();
	var user_id = $off.closest("tr").find(".user_id").text();
	var permission_name = $off.closest("tr").find(".permission_name").text();
	$.ajax({
	    url: '<?php echo URL; ?>settings/off',
	    type: 'POST',
	    dataType: 'JSON',
	    data: {'user_id': user_id, 'permission_id':permission_id},
	    success: function(data){
	    	$off.closest("tr").html('<td class="user_id hidden">'+user_id+'</td><td class="permission_id hidden">'+permission_id+'</td><td class="permission_name">'+permission_name+'</td><td><div class="btn-group btn-toggle"><button class="on btn btn-xs btn-default" >ON</button><button class="btn btn-xs btn-danger btn-active">OFF</button></div></td>');
		}
	});
	
});
</script>