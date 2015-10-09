<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DSMG Monitoring Module</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- plugin css-->
        <link href="<?php echo URL;?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL;?>assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL;?>assets/css/ionicons.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo URL;?>assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL;?>assets/css/alertify.core.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo URL;?>assets/css/alertify.bootstrap3.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo URL;?>assets/app/css/app.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL;?>assets/css/bootstrapValidator.min.css" rel="stylesheet" type="text/css"/>
		<link href="<?php echo URL;?>assets/app/css/home.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <!-- js -->
        <script src="<?php echo URL;?>assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo URL;?>assets/js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?php echo URL;?>assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo URL;?>assets/js/alertify.min.js" type="text/javascript"></script>
        <script src="<?php echo URL;?>assets/js/bootstrapValidator.min.js" type="text/javascript"></script>
        <script src="<?php echo URL;?>assets/js/app.js" type="text/javascript"></script>
        <style type="text/css">
        	#reset_form{
        		display: none;
        	}
        </style>
    </head>
  	<body>
    <div class="container">
    	<div class="row">
    		<div class="col-xs-12 col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4">
      			<img id="logo" alt="" class="img-responsive" src="<?php echo URL;?>assets/app/img/logo.png">
      		</div>
        </div>    
        <div class="row">    
      		<div class="col-xs-12 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
                <h3 class="text-center" style="margin-bottom: 0;">NF Railway</h3>
      			<h1 class="text-center" style="margin-top: 0;">DSMG Monitoring Module</h1>
      			<h5 class="text-center">(Tinsukia Division)</h5>
      		</div>
      	</div>
        <div class="row" id="reset_form">
            <div class="col-md-4 col-sm-4">
            </div> 
            <div class="col-md-4 col-sm-4">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title">Reset Password</h3>
                  </div>
                  <div class="panel-body">
                    <form role="form" id="reset_password_form">
                      <div class="form-group">
                      	<input type="hidden" value="<?php echo $_GET['token'];?>" name="token">
                      </div>                    
                      <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control"/>
                      </div>
                      <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" name="confirmPassword" class="form-control"/>
                      </div>                      
                      <button type="button" class="btn btn-primary btn-block" onclick="reset_password();">Reset Password</button>
                    </form>
                  </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4"></div>
        </div>
        <div class="row">
        	<div class="col-md-12" id="message">        		
        	</div>
        </div>
    </div>
     <div id="footer">
	 	<div class="container">
	    	<p id="footerP">Developed and Designed by <a id="devdesby" target="_blank" href="http://glomindz.com">Glomindz</a></p>
	    </div>
	 </div>
  </body>
<script type="text/javascript">
window.onload = function() {
	var token = '<?php echo $_GET['token']; ?>';
	verify_token(token);
};

function verify_token(token){
	$.ajax({
		url: '<?php echo URL;?>user_service/verify_token/',
		type: 'POST',
		dataType: 'JSON',
		data: {'token': token},
		success: function(data){
			if(data == 0){
				$('#message').html('<h3 class="text-center text-late-latif">Invalid Token</h3>');
			}
			if(data == 1){
				$('#reset_form').show();
				$('#message').html('');
			}
			if(data == 2){
				$('#message').html('<h3 class="text-center text-late-latif">Token has been expired</h3>');
			}
		}	
	});
}

$(function(){
	$('#reset_password_form').bootstrapValidator({
		message: 'This value is not valid',
        fields: {              	             
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
                        min: 4,
                        max: 30,
                        message: 'The username must be more than 4 characters long'
                    },
                }
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: 'The confirm password is required and can\'t be empty'
                    },
                    identical: {
                        field: 'password',
                        message: 'The password and its confirm are not the same'
                    }
                }
            }
        }
    });
});

function reset_password(){
	$(this).attr('disabled',true);
	var res = $('#reset_password_form').data('bootstrapValidator').validate();
	var formData = $('form#reset_password_form').serializeArray();
	if(res.isValid() == true){
		$.ajax({
			url: '<?php echo URL;?>user_service/reset_password/',
			type: 'POST',
			dataType: 'JSON',
			data: formData,
			success: function(data){
				$('#reset_form').hide();	
				$(this).attr('disabled',false);			
				if(data == 0){
					$('#message').html('<h3 class="text-center text-late-latif">Error, Try again later</h3>');
				}
				if(data == 1){
					$('#message').html('<h3 class="text-center text-success">Password changed successfully</h3>');					
				}
			}	
		});
	}	
}
</script>
</html>