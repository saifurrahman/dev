<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<style type="text/css">dd{line-height: 2;}</style>
	</head>
	<body>
		<div style="width: 100%;min-height: 200px;">
			<h1 style="width:100%; padding: 20px;border-bottom: 2px solid #cc0000;">
				<a href="http://crimatrix.com/" style="float: left;"><img src="http://enterprise.crimatrix.com/img/logo.png" alt="Crimatrix Logo" style="width: 100%;"></a>
				<span style="margin-left: 12%;font-size: 1.4em;">Welcome to Crimatrix</span>
			</h1>
			<div style="width:100%; padding: 15px;">
				<h3>Thank you for registered on Crimatrix</h3>
				<dl>
					<dt><strong>{{ $name}}:</strong></dt><br/>
					<dd>Your sign up details are below</dd>
					<dd>Email: {{ $email}}</dd>
					<dd>Mobile: {{ $mobile}}</dd>
					<dd>Password: {{ $password}}</dd>
				</dl>
				<p>Now you can login to crimatrix using your email or mobile as username and using the above password. After login complete your profile and than you are ready to submit guestlist.</p>
				<p>For any help <strong>email:</strong> support@glomindz.com <u>OR<u> <strong>call:</strong> +91-9854087006</p>

			</div>
			<div style="border-top: 2px solid #cc0000;">
				<p><small>&copy; <a href="http://crimatrix.com">Crimatrix</a> 2016</small></p>
			</div>
		</div>
	</body>
</html>
