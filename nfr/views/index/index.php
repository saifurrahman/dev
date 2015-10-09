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
        <script src="<?php echo URL;?>assets/js/app.js" type="text/javascript"></script>
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
        <div class="row" id="login_row">
            <div class="col-md-4 col-sm-4">
            </div> 
            <div class="col-md-4 col-sm-4">
                <div class="panel panel-primary">
                  <div class="panel-heading">
                    <h3 class="panel-title">Sign in</h3>
                  </div>
                  <div class="panel-body">
                    <form role="form" action="<?php echo URL;?>user_service/login" method="post">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="username" placeholder="abc@example.com">
                      </div>
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="******">
                      </div>
                      <div class="form-group">
                        <input type="text" name="error" id="login_fail" class="form-control" value="Your email or password was invalid." disabled="disabled"/>
                      </div>
                      <button type="submit" class="btn btn-primary">Sign in</button>
                      <a href="#" class="pull-right" id="forgot_password"><small>forgot password?</small></a>
                    </form>
                  </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4"></div>
        </div>
    </div>
     <div id="footer">
	 	<div class="container">
	    	<p id="footerP">Developed and Designed by <a id="devdesby" target="_blank" href="http://glomindz.com">Glomindz</a></p>
	    </div>
	 </div>
  </body>
<script type="text/javascript">
$(document).ready(function() {
    var current_url = "<?php echo URL; ?>";
    var url = current_url + '?loginFailed';
    var url2 = current_url + '?loginFailed#';
    if (document.URL == url || document.URL == url2){
        $('#login_fail').show();
    } 
});

function reset(){
	alertify.set({
		labels : {
			ok     : "Send",
			cancel : "Cancel"
		},
		delay : 5000,
		buttonReverse : false,
		buttonFocus   : "ok"
	});
}

$("#forgot_password").on( 'click', function () {
	reset();
	alertify.prompt("Type your registered email", function (e, str) {
		if (e){
			var verifyemail = emailValidate(str);
			if(verifyemail == true){
				forget_password(str);
			}
			else{
				alertify.error("Invalid Email");
			}
		}
	}, "");
	return false;
});

function forget_password(email){
	$.ajax({
		url: '<?php echo URL;?>user_service/forget_password/',
		type: 'POST',
		dataType: 'JSON',
		data: {email:email},
		success: function(data){
      if(data != 0){
			   alertify.success("We have send a new password to " + email);
      }
      else{
         alertify.error("Your email is not registered with us"); 
      }
		}		
	});
}
</script>
</html>