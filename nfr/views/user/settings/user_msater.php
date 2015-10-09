<aside class="right-side">                
   	<!-- Content Header (Page header) -->
    <section class="content-header">
      	<h1>Users</h1>
      	<ol class="breadcrumb">
      		<li><button class="btn btn-success pull-right" id="add_user_btn" data-toggle="modal" data-target="#createUserModal"><i class="fa fa-user"></i> add user</button></li>
      	</ol>
    </section>
    <section class="content">
    	<input type="text" class="form-control" id="search_users" placeholder="Search">
        <div class="row">
			<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>NAME</th>
							<th>EMAIL</th>
							<th>MOBILE</th>
							<th>DESIGNATION</th>
							<th>STATION</th>
							<th>APPROVE</th>
							<th>EDIT</th>
							<th>DELETE</th>
						</tr>
					</thead>
					<tbody id="railway_users_list"></tbody>
				</table>
			</div>	
			</div>
		</div>
    </section>
</aside>
<!-- Add User Modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="createUserModalLabel">Add User</h3>
      </div>
      <div class="modal-body mafter">
        <div class="row">
        	<form role="form" id="add_user_form" action="" method="post">
	        	<div class="col-md-4">
	        		<label>Name</label>
		        	<input type="text" class="form-control" id="name" name="name" required="required" placeholder="Name">
		        	<label>Email</label>
		        	<input type="email" class="form-control" id="email" name="email" required="required"  placeholder="Email">
	        	</div>
	        	<div class="col-md-4">
	        		<label>Mobile</label>
		        	<input type="tel" class="form-control" id="mobile" name="mobile" maxlength="10" required="required" placeholder="Mobile">
		        	<label>Designation</label>
		        	<input type="text" class="form-control" id="designation" name="designation" placeholder="Designation">
	        	</div>
	        	<div class="col-md-4">
	        		<label>Station</label>
		        	<select class="form-control" id="station_id" name="station_id"></select>
		        	<label class="before_btn"></label>
	        		<button type="button" class="btn btn-primary btn-block" id="createUserBtn" onclick="createUser();">SAVE</button>
	        	</div>
        	</form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="editUserModalLabel">Edit User</h3>
      </div>
      <div class="modal-body mafter">
        <div class="row">
        	<form role="form" id="edit_user_form" action="" method="post">
	        	<div class="col-md-4">
	        		<input type="hidden" id="edit_id" name="id">
	        		<label>Name</label>
		        	<input type="text" class="form-control" id="edit_name" name="name" required="required" placeholder="Name">
		        	<label>Email</label>
		        	<input type="email" class="form-control" id="edit_email" name="email" required="required"  placeholder="Email">
	        	</div>
	        	<div class="col-md-4">
	        		<label>Mobile</label>
		        	<input type="tel" class="form-control" id="edit_mobile" name="mobile" maxlength="10" required="required" placeholder="Mobile">
		        	<label>Designation</label>
		        	<input type="text" class="form-control" id="edit_designation" name="designation" placeholder="Designation">
	        	</div>
	        	<div class="col-md-4">
	        		<label>Station</label>
		        	<select class="form-control" id="edit_station_id" name="station_id"></select>
		        	<label class="before_btn"></label>
	        		<button type="button" class="btn btn-primary btn-block" id="updateUserDetails_btn" onclick="updateUserDetails();">Update</button>
	        	</div>
        	</form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$('#setting_li, #user_msater_li').addClass('active');
$('#setting_sub_ul').css('display', 'block');
window.onload = function() {
	get_all_stations();
	getAllUsers();
	reset();
};
function get_all_stations(){
	$.ajax({
		url: '<?php echo URL;?>settings/getAllStations/',
		type: 'POST',
		dataType: 'JSON',
		success: function(data){
			$('#station_id, #edit_station_id').empty();
			$('#station_id, #edit_station_id').append('<option value="0"></option>');
			for(var i in data){
			  $('#station_id, #edit_station_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}
		}	
	});
}
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
		 			+'<td class="station_name">'+data[i].station_name+'</td>'
		 			+'<td class="station_id hidden">'+data[i].station_id+'</td>'
		 			+status
		 			+'<td><button class="edit btn btn-info btn-xs">edit</button></td>'
		 			+'<td><button class="del btn btn-danger btn-xs">delete</button></td>'
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
			$('#createUserModal').modal('hide');
			$('#createUserBtn').attr('disabled',false).html('create');
			var row ='<tr>'
	 			+'<td class="id hidden">'+data['id']+'</td>'
	 			+'<td class="name">'+data['name']+'</td>'
	 			+'<td class="email">'+data['email']+'</td>'
	 			+'<td class="mobile">'+data['mobile']+'</td>'
	 			+'<td class="designation">'+data['designation']+'</td>'
	 			+'<td class="station_name">'+$("#station_id option:selected").text()+'</td>'
	 			+'<td class="station_id hidden">'+data['station_id']+'</td>'
	 			+'<td><button class="unapproved btn bg-navy btn-xs" title="click to enable">disabled</button></td>'
	 			+'<td><button class="edit btn btn-info btn-xs">edit</button></td>'
	 			+'<td><button class="del btn btn-danger btn-xs">delete</button></td>'
	 			+'</tr>';
			$('#railway_users_list').prepend(row);
			$('form#add_user_form').each(function(){this.reset();});
			alertify.success("Added Successfully");
			$row = $('#railway_users_list tr').first();
			$class = 'alert alert-success';
			rowActive($row,$class);
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
//edit
var $edit = 0;
$("#railway_users_list").on("click", ".edit", function(){
	$edit = $(this); 
	var id = $edit.closest("tr").find(".id").text();
	var name = $edit.closest("tr").find(".name").text();
	var email = $edit.closest("tr").find(".email").text();
	var mobile = $edit.closest("tr").find(".mobile").text();
	var designation = $edit.closest("tr").find(".designation").text();
	var station_id = $edit.closest("tr").find(".station_id").text();
	$edit.html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
	
	$('#edit_id').val(id);
	$('#edit_name').val(name);
	$('#edit_email').val(email);
	$('#edit_mobile').val(mobile);
	$('#edit_designation').val(designation);
	$('#edit_station_id').val(station_id);
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
			$edit.closest("tr").find(".name").text($('#edit_name').val());
			$edit.closest("tr").find(".email").text($('#edit_email').val());
			$edit.closest("tr").find(".mobile").text($('#edit_mobile').val());
			$edit.closest("tr").find(".designation").text($('#edit_designation').val());
			$edit.closest("tr").find(".station_name").text($("#edit_station_id option:selected" ).text());
			$edit.closest("tr").find(".station_id").text($("#edit_station_id option:selected").val());
			$('#updateUserDetails_btn').attr('disabled',false).html('Update');
			$('form#edit_user_form').each(function(){this.reset();});
			$('#editUserModal').modal('hide');
			$row = $edit.closest("tr");
			$class = 'alert alert-success';
			rowActive($row,$class);
		}
	});
}
$('#editUserModal').on('hidden.bs.modal', function (e){
	$edit.html('edit');
	$edit = 0;
});
//Quick Table Search
$('#search_users').keyup(function() {
  var regex = new RegExp($('#search_users').val(), "i");
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
</script>