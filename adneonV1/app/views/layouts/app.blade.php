<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="ISO-8859-1">
<title>addneon</title>
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1" />
<!-- css -->
{{HTML::style('packages/css/bootstrap.css')}}
{{HTML::style('packages/css/animate.css')}}
{{HTML::style('packages/css/jquery-ui.min.css')}}
{{HTML::style('packages/css/font-awesome.css')}}
{{HTML::style('packages/css/icon.css')}}
{{HTML::style('packages/css/font.css')}}
{{HTML::style('packages/css/app.css')}}
{{HTML::style('packages/css/alertify.min.css')}}
{{HTML::style('packages/css/selectize.bootstrap3.css')}}
{{HTML::style('packages/css/addneon.css')}}
{{HTML::style('packages/css/jquery-ui.min.css')}}
{{HTML::style('packages/css/jquery-ui.min.css')}}

<!-- script js -->
{{HTML::script('packages/js/jquery.min.js');}}
{{HTML::script('packages/js/jquery-ui.min.js');}}
{{HTML::script('packages/js/bootstrap.js');}}
{{HTML::script('packages/js/selectize.min.js');}}
{{HTML::script('packages/js/app.js');}}
{{HTML::script('packages/js/jquery.slimscroll.min.js');}}
{{HTML::script('packages/js/app.plugin.js');}}
{{HTML::script('packages/js/alertify.min.js');}}
{{HTML::script('packages/js/moment.js');}}
{{HTML::script('packages/js/jquery.table2excel.min.js');}}
{{HTML::script('packages/js/Chart.js');}}
{{HTML::script('packages/js/list.min.js');}}

</head>
<body>
	<section class="vbox">
		<header
			class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
			<div class="navbar-header aside-md dk">
				<a class="btn btn-link visible-xs"
					data-toggle="class:nav-off-screen" data-target="#nav"> <i
					class="fa fa-bars"></i>
				</a> <a href="{{URL::to('addneon/dashboard')}}" class="navbar-brand"> {{
					HTML::image('packages/images/logo.png', 'addneon', array('class' =>
					'm-r-sm'))}} <span class="hidden-nav-xs">Adneon</span>
				</a> <a class="btn btn-link visible-xs" data-toggle="dropdown"
					data-target=".user"> <i class="fa fa-cog"></i>
				</a>
			</div>
			<ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">

				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown"> <span class="thumb-sm avatar pull-left"> {{
							HTML::image('packages/images/a0.png', 'addneon', array('class' =>
							''))}} </span> <?php echo Session::get("name"); ?> <b
						class="caret"></b>
				</a>
					<ul class="dropdown-menu animated fadeInRight">
						<li><span class="arrow top"></span> <a
							href="{{URL::to('addneon/profile')}}">Profile</a></li>
						<li class="divider"></li>
						<li><a href="{{URL::to('users/logout')}}">Logout</a></li>
					</ul></li>
			</ul>
		</header>
		<section>
			<section class="hbox stretch">
				<!-- .aside -->
				<aside class="bg-dark dker aside-md hidden-print" id="nav">
					<section class="vbox">
						<section class="w-f scrollable">
							<div class="slim-scroll" data-height="auto"
								data-disable-fade-out="true" data-distance="0" data-size="10px"
								data-railOpacity="0.2">
								<div class="clearfix wrapper bg-danger nav-user hidden-xs">
									<div class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span
											class="thumb avatar pull-left m-r"></span> <span
											class="hidden-nav-xs clear"> <span class="block m-t-xs"> <strong
													class="font-bold text-lt"><?php echo Session::get("name"); ?></strong>

											</span> <span class="text-muted text-xs block">Advertisement</span>
										</span>
										</a>
									</div>
								</div>



								<nav class="nav-primary hidden-xs">
									<!--<div
										class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Program Manager</div>-->
									<!--<ul class="nav nav-main">
										<li id="program">
										  <a href="{{URL::to('addneon')}}"> <i
												class="fa fa-th-list"> </i> <span class="font-bold">Programs</span>
										  </a>
										</li>
										<li id="schedule">
    										<a href="{{URL::to('addneon/programschedule')}}"> <i
    												class="fa fa-calendar"> </i> <span class="font-bold">Program
    													Schedule</span>
    										</a>
										</li>
									</ul>-->

									<div class="line dk hidden-nav-xs"></div>
									<div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Master</div>
									<ul class="nav nav-main">
										@if (Session::get('Agency/Client Master') != 0)
										<li id="agency">
    										<a href="{{URL::to('addneon/agency')}}">
    										  <i class="i i-users3 text-info-dk"> </i> <span class="font-bold">Agency Master</span>
    										</a>
										</li>
										@endif
										@if (Session::get('Agency/Client Master') != 0)
										<li id="client">
    										<a href="{{URL::to('addneon/clients')}}">
    										  <i class="i i-users3 text-info-dk"> </i> <span class="font-bold">Client Master</span>
    										</a>
										</li>
										@endif
										@if (Session::get('Brand Master') != 0)
										<li id="brand">
    										<a href="{{URL::to('addneon/brand')}}">
    										  <i class="fa fa-css3 text-info-dk"> </i> <span class="font-bold">Brand Master</span>
    										</a>
										</li>
										@endif
										@if (Session::get('Commercial Master') != 0)
										<li id="ro">
    										<a href="{{URL::to('addneon/advertise')}}">
    										  <i class="i i-docs text-danger-dk"> </i> <span class="font-bold">Commercial Master</span>
    										</a>
										</li>
										@endif
											<div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Operations</div>
										@if (Session::get('Deals') != 0)
										<li id="deals">
    										<a href="{{URL::to('addneon/deals')}}">
    										  <i class="fa fa-suitcase text-success-dk"> </i> <span class="font-bold">Deals</span>
    										</a>
										</li>
										@endif
										@if (Session::get('Schedule') != 0)
										<li id="ad_schedule">
    										<a href="{{URL::to('addneon/adschedule')}}">
    										  <i class="i i-circle-sm text-danger-dk"> </i> <span class="font-bold">Schedule</span>
    										</a>
										</li>
										@endif
										@if (Session::get('Schedule Varification') != 0)
										<li id="varification">
    										<a href="{{URL::to('addneon/varification')}}">
    										  <i class="i i-circle-sm text-danger-dk"> </i> <span class="font-bold">Daily Schedule</span>
    										</a>
										</li>
										@endif
										@if (Session::get('Billing') != 0)
										<li id="billing">
    										<a href="{{URL::to('addneon/billing')}}">
    										  <i class="fa fa-file-text text-warning-dk"> </i> <span class="font-bold">Billing</span>
    										</a>
										</li>
										@endif
										@if (Session::get('Payments') != 0)
										<li id="payment">
    										<a href="{{URL::to('addneon/payments')}}">
    										  <i class="fa fa-rupee text-success-dk"> </i> <span class="font-bold">Payments</span>
    										</a>

										</li>
										@endif
											<div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Reports</div>
										@if (Session::get('Reports') != 0)
										<li id="scvstcreport"class="auto">
    										<a href="{{URL::to('addneon/scvstcreport')}}">
    										  <i class="i i-stats text-danger-dk"> </i> <span class="font-bold">Schedule vs Telecast</span>
    										</a>
										</li>
										<li id="schedulereports"class="auto">
    										<a href="{{URL::to('addneon/schedulereport')}}">
    										  <i class="i i-stats text-danger-dk"> </i> <span class="font-bold">Schedule Reports</span>
    										</a>
										</li>
										<li id="telecast_time_reports"class="auto">
    										<a href="{{URL::to('addneon/telecastreport')}}">
    										  <i class="i i-stats text-danger-dk"> </i> <span class="font-bold">Telecast Reports</span>
    										</a>
										</li>
										<li id="telecast_time_reports"class="auto">
    										<a href="{{URL::to('addneon/dailyreport')}}">
    										  <i class="i i-stats text-danger-dk"> </i> <span class="font-bold">Daily Reports</span>
    										</a>
										</li>

										@endif
									</ul>
									<div class="line dk hidden-nav-xs"></div>
									<div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Settings</div>
									<ul class="nav nav-main">
										@if (Session::get('Users') != 0)
										<li id="user">
    										<a href="{{URL::to('addneon/users')}}">
    										  <i class="fa fa-users"> </i> <span class="font-bold">Users</span>
    										</a>
										</li>
										@endif
									</ul>
								</nav>
								<!-- / nav -->
							</div>
						</section>

						<footer class="footer hidden-xs no-padder text-center-nav-xs">
							<a href="#nav" data-toggle="class:nav-xs"
								class="btn btn-icon icon-muted btn-inactive m-l-xs m-r-xs"> <i
								class="i i-circleleft text"></i> <i
								class="i i-circleright text-active"></i>
							</a>
						</footer>
					</section>
				</aside>
				<!-- /.aside -->
				<section id="content">
					<section class="hbox stretch">
						<section class="vbox">
							<section class="scrollable padder">@yield('content')</section>
						</section>
					</section>
				</section>
			</section>
		</section>
	</section>
</body>
</html>
