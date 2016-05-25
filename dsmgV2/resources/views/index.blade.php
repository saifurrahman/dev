<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<meta property="og:title" content="DSMG monitoring module" />
<meta property="og:image" content="packages/images/logo.png" />
  <title>DSMG monitoring module</title>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- css -->
<link href='packages/css/bootstrap.css' rel='stylesheet' type='text/css'>
<link href='packages/css/app.css' rel='stylesheet' type='text/css'>


<script src="packages/js/jquery.min.js"></script>
<script src="packages/js/bootstrap.js"></script>


</head>
<body class="">
	<section id="content" class="m-t-lg wrapper-md animated fadeInUp">
		<div class="container aside-xxl">
			<div class="col-xs-12 col-md-6 col-md-offset-3  col-sm-offset-3">
					<img id="logo" alt="" class="img-responsive" src="packages/images/logo.png">
			</div>
			<br/>
			<div class="row">
				<div class="col-md-12">
					<h4 class="text-center" style="margin-bottom: 0;">NF Railway</h4>
					<h3 class="text-center" style="margin-top: 0;">DSMG Monitoring Module</h3>
					<h5 class="text-center">(Tinsukia Division)</h5>
          <h5 class="text-center"><small>Version 1.0</small></h5>

				</div>
			</div>
			<div class="text-center padder">

			</div>
			<section class="m-b-lg">
				<header class="wrapper text-center">
					<strong>Sign in</strong>
				</header>

        <?php if(Input::get ( 'error' )!=null){?>
        <div class="bg-danger text-center"><strong >Authentication Failed!</strong></div>
          <?php }?>
				<div class="list-group">
					<div class="list-group-item">
						<input type="text" class="form-control no-border" name="username"
							placeholder="Registered mobile" required="required"
							autocomplete="off">
					</div>
					<div class="list-group-item">
						<input type="password" class="form-control no-border"
							name="password" placeholder="Password" required="required"
							autocomplete="off">
					</div>
				</div>
				<button type="submit" class="btn btn-lg btn-primary btn-block">Sign
					in</button>
				<div class="line line-dashed"></div>

			</section>
		</div>
	</section>
	<!-- footer -->
	<footer id="footer">
		<div class="text-center padder">
			<p>
				&copy;NF Railway,Tinsukia Division
					2015
					<br>
				<small>Designed and Developed by <a href="http://glomindz.com" target="_blank">Glomindz</a></small>
			</p>
		</div>
	</footer>
</body>
</html>
