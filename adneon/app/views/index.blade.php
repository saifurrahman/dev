<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>ADneon::login</title>
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1" />
<!-- css -->
{{HTML::style('packages/css/bootstrap.css')}}
{{HTML::style('packages/css/animate.css')}}
{{HTML::style('packages/css/font-awesome.min.css')}}
{{HTML::style('packages/css/icon.css')}}
{{HTML::style('packages/css/font.css')}}
{{HTML::style('packages/css/app.css')}}


<!-- script js -->
{{HTML::script('packages/js/jquery.min.js');}}
{{HTML::script('packages/js/bootstrap.js');}}
{{HTML::script('packages/js/app.js');}}
{{HTML::script('packages/js/jquery.slimscroll.min.js');}}
{{HTML::script('packages/js/app.plugin.js');}}

</head>
<body class="">
	<section id="content" class="m-t-lg wrapper-md animated fadeInUp">
		<div class="container aside-xl">
			<a class="navbar-brand block" href="#">ADNeon</a>
			<div class="text-center padder">
				<small class="align-center">(v 1.0.1)</small>
			</div>
			<section class="m-b-lg">
				<header class="wrapper text-center">
					<strong>Sign in to use the app</strong>
				</header>
				{{ Form::open(array('url'=>'users/login', 'class'=>''))}}
				<div class="list-group">
					<div class="list-group-item">
						<input type="text" class="form-control no-border" name="username"
							placeholder="email or mobile" required="required"
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
				{{ Form::close() }}
			</section>
		</div>
	</section>
	<!-- footer -->
	<footer id="footer">
		<div class="text-center padder">
			<p>
				<small>Designed and Developed by Glomindz<br>&copy;Rockland Media,
					2015
				</small>
			</p>
		</div>
	</footer>
</body>
</html>