$(function(){
    $('#profile_li').addClass('active');
});
$("select[name='ps_id'], select[name='city_id']").selectize({
    create: true,
    sortField: {field: 'text',direction: 'asc'},
    dropdownParent: 'body'
});

$('#update_profile_btn').on('click',function(){   
    var res = $('form#profile_form').data('bootstrapValidator').validate();
    if(res.isValid() == true){
        var formData = $('form#profile_form').serializeArray();       
        $.ajax({
            type:'POST',
            url: 'users/profile',
            dataType: 'JSON',
            data: formData,
            success: function(data){                
                alertify.success("Successfully Updated");
            },
            error: function(xhr, textStatus, thrownError) {
                alertify.error("Something went to wrong.Please Try again later...");
            }
        });        
    }
    else{
        alertify.error("Fill the form correctly");
    }
});

$('#change_password_btn').on('click',function(){
    var res = $('form#changepass_form').data('bootstrapValidator').validate();
    if(res.isValid() == true){
        var formData = $('form#changepass_form').serializeArray();
        $.ajax({
            type: 'POST',
            url: 'users/changepassword',
            dataType: 'JSON',
            data: formData,
            success: function(data){
                $('#cpassModal').modal('hide');
                $('form#changepass_form').each(function(){this.reset();});
                if(data == 1){
                     alertify.success("Successfully Updated");
                }
                else{
                    alertify.error("Something went to wrong.Please Try again later...");
                }
            }
        });    
    }
});

//validate form
$(function(){
    $('form#profile_form').bootstrapValidator({
        message: 'This value is not valid',
        fields: {            
            name: {
                validators: {
                    notEmpty: {
                        message: 'The name is required and can\'t be empty'
                    }
                }
            },
            ps_id: {
                validators: {
                    notEmpty: {
                        message: 'The police station is required and can\'t be empty',
                    }
                }
            },
            city_id: {
                validators: {
                    notEmpty: {
                        message: 'The mobile is required and can\'t be empty'
                    }                    
                }
            }
        }
    });
    
    $('form#changepass_form').bootstrapValidator({
        message: 'This value is not valid',
        fields: {            
            old_password: {
                validators: {
                    notEmpty: {
                        message: 'The old_password is required and can\'t be empty'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'confirmPassword',
                        message: 'The password and its confirm are not the same'
                    },
                    stringLength: {
                        min: 6,
                        message: 'The name must be 6'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    }
                }
            }
        }        
    });
});