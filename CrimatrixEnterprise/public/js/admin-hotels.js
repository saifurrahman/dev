$(function(){
    $('#reg_hotel_users_li').addClass('active');
});

var $permission = 0;
$("table#reg-hotels-tb tbody").on("click", ".unapproved", function(){//'1-to-0';
	$permission = $(this);	
	var id = $permission.closest('tr').find('.id').text();	
	permission(id,0);

}); 
$("table#reg-hotels-tb tbody").on("click", ".approved", function(){//'0-to-1'	
	$permission = $(this);
	var id = $permission.closest('tr').find('.id').text();	
	permission(id,1);	
});
var $resetpass = 0;
$("table#reg-hotels-tb tbody").on("click", ".reset", function(){
	$resetpass = $(this);
	var id = $resetpass.closest('tr').find('.id').text();
	resetpass(id);
});
var $edit = 0;
$("table#reg-hotels-tb tbody").on("click", ".edit", function(){
	$edit = $(this);	
	var details = $edit.closest('tr').find('.data').text();
	details = JSON.parse(details);
	$('#edit_id').val(details['id']);
	$('#edit_name').val(details['name']);
	$('#edit_contact_person').val(details['contact_person']);
	$('#edit_ps_id').val(details['ps_id']);
	$('#edit_email').val(details['email']);
	$('#edit_mobile').val(details['mobile']);
	$('#edit_city_id').val(details['city_id']);
	$('#edit_state').val(details['state']);
	$('#edit_country').val(details['country']);
	$('#edit_number_of_rooms').val(details['number_of_rooms']);
	$('#edit_licence_no').val(details['licence_no']);
	$('#edit_locality').val(details['locality']);
	$('#edit_pin').val(details['pin']);
	$('#edit_address').val(details['address']);	
	$('#editModal').modal('show');		
});
function permission(id, status){
	var cfr_token = $('#cfr_token').val();
	$permission.attr('disabled',true);
	$.ajax({
		type: 'POST',
		url: 'permission',
		dataType: 'JSON',
		data: {'id':id,'status':status,'_token':cfr_token},
		success: function(data){
			$permission.attr('disabled',false);
			if(data != 0){
				$permission.closest("td").html('<button type="button" class="unapproved btn btn-success btn-xs" title="click to disabled">Enabled</button>');
				alertify.success("User Enabled");
			}
			else{
				$permission.closest("td").html('<button type="button" class="approved btn btn-disable btn-xs" title="click to enabled">Disabled</button>');
				alertify.success("User Disabled");
			}
			$permission = 0;
		}
	});
}
function resetpass(id){
	var cfr_token = $('#cfr_token').val();
	$resetpass.attr('disabled',true);
	$.ajax({
		type: 'POST',
		url: 'resetpass',
		dataType: 'JSON',
		data: {'id':id,'_token':cfr_token},
		success: function(data){			
			$resetpass.attr('disabled',false);
			if(data != 0){
				alertify.success("Password Reset Successfully");
			}
			else{
				alertify.error("Password Reset Successfully");
			}
			$resetpass = 0;
		}
	});
}

$("#save_changes_btn").on("click", function(){	
	var res = $('form#update_user_form').data('bootstrapValidator').validate();          
    if(res.isValid() == true){
    	$("#save_changes_btn").attr('disabled',true);
    	var formData = $('form#update_user_form').serializeArray();
		 $.ajax({
            type: 'POST',
            url: 'updatehotelsdetails',
            dataType: 'JSON',
            data: formData,
            success: function(data){ 
            	$("#save_changes_btn").attr('disabled',false);
                $('#hotel_sign_up_btn').attr('disabled', false);
                $('#editModal').modal('hide');
                $('form#update_user_form').each(function(){this.reset();});
                alertify.success('Updated Successfully');
            },
            error: function(xhr, textStatus, thrownError) {            	
                $('#editModal').modal('hide');
                $('form#update_user_form').each(function(){this.reset();});
                $("#save_changes_btn").attr('disabled',false);
                alertify.error("Something went to wrong.Please Try again later...");
            }
        });
    }
});

$(function(){
	$('form#update_user_form').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The name is required and can\'t be empty'
                    }
                }
            },
            contact_person: {
                validators: {
                    notEmpty: {
                        message: 'The contact person is required and can\'t be empty'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                	emailAddress: {message: 'The input is not a valid email address'}
            	}
        	},
            mobile: {
                validators: {
                    notEmpty: {
                        message: 'The mobile is required and can\'t be empty'
                    },
                    digits: {
                        message: 'The mobile can contain only digits'
                    },
                    stringLength: {
                        min: 10,
                        max: 10,
                        message: 'The mobile must be 10'
                    }
                }
            },
            ps_id: {
                validators: {
                    notEmpty: {
                        message: 'The police station is required and can\'t be empty'
                    }
                }
            }
        }
    });
});