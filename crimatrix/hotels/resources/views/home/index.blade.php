
<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Crimatrix for hotel.">
        <meta name="keywords" content="Assam Police, Crimatrix">
        <title>Crimatrix for hotel</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
				<link rel="stylesheet" href="css/app.css">
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="{{URL::to('hotel')}}">
								<img id="logo_image" class="img-responsive" src="{{asset('img/logo.png')}}" alt="Crimatrix Logo">
						</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				
		</div>
	</nav>
	<section>
<div class="container">
      <div class="row">
          <div class="col-xs-12 col-md-8">
              <h2 class="home_header">Hotel <span class="text-crimatrix">Guest List</span> Submission</h2>
              <div>
                  <h3 class="SourceSansPro">Crimatrix allows registered hotels and guest houses to submit their guest records in real-time</h3>
                  <p class="mission_detail">As per The Sarais Act , all hotels and guest houses are required to submit their guest lists to the nearest police station everyday.
        <span class="text-crimatrix">The Sarais Act, 1867 </span>[<a href="http://www.indiankanoon.org/doc/1283654/" target="_blank">view full Act</a>]</p>
                  <p class="mission_detail">Crimatrix now allows registered hotels and guest houses to submit the guest record in real-time from an internet connected computer instead of written reports. Crimatrix then cross checks the data immediately with available crime records and alerts the nearest police station if any match is found. Concerned officer will then alert the manager and provide further instructions. This helps in crime prevention and detection.</p>
                  <p class="dm_order">"The District Magistrate Kamrup (Metro) has instructed vide order dated 31st July 2013, that all hotels , guest houses and lodges shall submit their respective borders' lists online on Crimatrix.com." [View Order]</p>
                  <img class="img-responsive" src="{{asset('img/tagline.png')}}">
              </div>
          </div>
          <div class="col-xs-12 col-md-4" id="forms">
            <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="text-center">Sign in</h3>
          </div>
          <div class="panel-body">

              <div class="form-group">
                <label class="form-label">Email or Mobile</label>

            </div>
            <div class="form-group">
              <label class="form-label">Password</label>

          </div>
          <div class="form-group">
                        <input type="text" name="error" id="login_fail" class="form-control" value="Email or Password is Incorrect" disabled="disabled"/>
                      </div>

                      <div class="form-group">

              </div>

                      <div class="form-group">

              <p>
                <small class="pull-left"><a href="#" data-toggle="modal" data-target="#forgotModal">I forgot my password</a></small>
              </p>
            </div>
            <hr>
            <div class="form-group">
              <h5 class="text-center">New Hotel?</h5>
              <p><a class="btn btn-success btn-block btn-lg" href="#" data-toggle="modal" data-target="#regModal">Register Here</a></p>
          </div>

          </div>
        </div>
          </div>
      </div>
  </div>
<!-- Register Modal -->
<div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="regModalLabel" aria-hidden="false" data-backdrop="static">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="false">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="regModalLabel">Hotel Registration</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
                <label class="form-label">Hotel Name</label>
            </div>
              <div class="form-group">
                <label class="form-label">Email Address</label>
            </div>
            <div class="form-group">
              <label class="form-label">Mobile Number</label>
          </div>
            <button type="button" class="btn btn-primary btn-block" id="hotel_sign_up_btn">Sign Up</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Froget Modal -->
<div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="forgotModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="forgotModalLabel">Crimatrix Password Reset</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
          <label class="form-label">Your Crimatrix Registered Email</label>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="request_reset_password_btn">Send Request</button>
      </div>
    </div>
  </div>
</div>
</section>
<div id="footer">
	<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<p class="pull-left">
						<small class="text-crimatrix">&copy; Crimatrix 2016</small>
						<small class="text-muted"> | </small>
						<small><a href="#" title="Learn about your privacy and Crimatrix"> Privacy</a></small>
					</p>
				</div>
				<div class="col-xs-12 col-md-6"></div>
			</div>
	</div>
</div>
</body>
</html>
