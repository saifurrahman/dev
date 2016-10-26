<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<style type="text/css">dd{line-height: 2;}</style>
	</head>
	<body>
		<div style="width: 100%;min-height: 200px;">
			<h2 style="width:100%;">
				<a href="http://crimatrix.com/" style="float: left;"><img src="http://hotel-apsoa.rhcloud.com/img/logo.png" alt="Crimatrix Logo" style="width: 100%;"></a>
			</h2>
			<div style="width:100%; padding-top: 50px;">
				<h3>Crimatrix daily report for hotels</h3>
				<ul>
					<dt>Guestlist Date: {{$guestlist_date}}</dt><br/>
					<dt>Registered Hotels: {{$registered}}</dt><br/>
					<dt>Submitted Hotels: {{$subimitted_hotels}}</dt><br/>
					<dt>Total Checkin: {{ $total_check_in}}</dt><br/>
					<dt>Total Checkout: {{ $total_check_out}}</dt><br/>
					<dt>Foreign Guest: {{ $foreign_guest}}</dt><br/>
				</dl>				
				
			</div>
			<div>
				<p>Thanks, Crimatrix Team</p>
				<p>For any help <strong>email:</strong> support@glomindz.com <u>OR<u> <strong>call:</strong> +91-970691374</p>
			</div>
			<div style="border-top: 2px solid #cc0000;">
				<p><small>&copy; <a href="http://crimatrix.com">Crimatrix</a> 2014</small></p>
			</div>
		</div>
	</body>
</html>