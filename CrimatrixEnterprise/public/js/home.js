$('#hotel_sign_up_btn').on('click',function(){
    var res = $('form#registration_form').data('bootstrapValidator').validate();          
    if(res.isValid() == true){
        $('#hotel_sign_up_btn').attr('disabled', true);
        var formData = $('form#registration_form').serializeArray();
        $.ajax({
            type: 'POST',
            url: 'hotel/users/signup',
            dataType: 'JSON',
            data: formData,
            success: function(data){                
                $('#hotel_sign_up_btn').attr('disabled', false);
                $('#regModal').modal('hide');
                $('form#registration_form').each(function(){this.reset();});
                if(data['msg'] == 1){
                    alertify.success('Thanks for registering.');
                }
                else{
                    alertify.error("Email or Mobile already registered!");
                }
            },
            error: function(xhr, textStatus, thrownError) {
                $('#regModal').modal('hide');
                $('form#registration_form').each(function(){this.reset();});
                alertify.error("Something went to wrong.Please Try again later...");
            }
        });
    }
    else{
        alertify.error("Fill the form correctly");
    }    
});

$('#request_reset_password_btn').on('click',function(){
    var res = $('form#forgot_form').data('bootstrapValidator').validate();
    if(res.isValid() == true){
        $('#request_reset_password_btn').attr('disabled', true);
        var formData = $('form#forgot_form').serializeArray();
        $.ajax({
            type: 'POST',
            url: 'hotel/users/forgetpass',
            dataType: 'JSON',
            data: formData,
            success: function(data){
                $('form#forgot_form').each(function(){this.reset();});
                $('#request_reset_password_btn').attr('disabled', false);                
                $('#forgotModal').modal('hide');                
                if(data == 1){
                    alertify.success('Check your email for reset password');
                }
                else{
                    alertify.error("Email not registered!");
                }
            },
            error: function(xhr, textStatus, thrownError) {
                $('#forgotModal').modal('hide');
                $('form#forgot_form').each(function(){this.reset();});
                alertify.error("Something went to wrong.Please Try again later...");
            }
        });        
    }
});

$(function(){
	$('form#registration_form').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            hotel: {
                validators: {
                    notEmpty: {
                        message: 'The name is required and can\'t be empty'
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
            }
        }
    });

    $('form#forgot_form').bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required and can\'t be empty'
                    },
                    emailAddress: {message: 'The input is not a valid email address'}
                }
            }
        }
    });
});
