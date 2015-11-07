<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="ISO-8859-1">
<title>DSMG</title>
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

</head>

<body>
	<section class="vbox">
		<header
			class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
			<div class="navbar-header aside-md dk">
				<a class="btn btn-link visible-xs"
					data-toggle="class:nav-off-screen" data-target="#nav"> <i
					class="fa fa-bars"></i>
				</a> <a href="#" class="navbar-brand"> {{
					HTML::image('packages/images/logo.png', 'addneon', array('class' =>
					'm-r-sm'))}} <span class="hidden-nav-xs">DSMG </span>
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

											</span> <span class="text-muted text-xs block"><?php echo Session::get("designation"); ?></span>
										</span>
										</a>
									</div>
								</div>
								<nav class="nav-primary hidden-xs">
									<ul class="nav nav-main">
										@if (Session::get('Agency/Client Master') != 0)
										<div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Maintainance</div>

										<li id="schedule_entry">
    										<a href="{{URL::to('dsmg/scheduleentry')}}">
    										  <i class="fa fa-gears text-danger-dk"> </i> <span class="font-bold">Gear Maintainace</span>
    										</a>
										</li>
										@endif

										@if (Session::get('Brand Master') != 0)
										<li id="brand">
    										<a href="{{URL::to('dsmg/crossing')}}">
    										  <i class="fa fa-futbol-o text-info-dk"> </i> <span class="font-bold">JointPoint/Crossing</span>
    										</a>
										</li>
										@endif
										@if (Session::get('Commercial Master') != 0)
										<div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Reports</div>

										<li id="client">
												<a href="{{URL::to('dsmg/overduereport')}}">
													<i class="fa fa-stack-overflow text-danger-dk"> </i> <span class="font-bold">Overdue Gear</span>
												</a>
										</li>
										<li id="deals">
												<a href="{{URL::to('dsmg/staionwisereport')}}">
													<i class="fa fa-home text-success-dk"> </i> <span class="font-bold">Station Wise Maintainance</span>
												</a>

										</li>
										<li id="deals">
    										<a href="{{URL::to('dsmg/gearwisereport')}}">
    										  <i class="fa fa-gear text-success-dk"> </i> <span class="font-bold">Gear Wise Maintainance</span>
    										</a>

										</li>

										@endif


										@if (Session::get('Deals') != 0)
										<div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Master Data</div>
										<li id="deals">
    										<a href="{{URL::to('dsmg/stations')}}">
    										  <i class="fa fa-home text-primary-dk"> </i> <span class="font-bold">Station Master</span>
    										</a>

										</li>

										<li id="deals">
    										<a href="{{URL::to('dsmg/schedulecode')}}">
    										  <i class="fa  fa-calendar-check-o text-primary-dk"> </i> <span class="font-bold">Schedule Code Master</span>
    										</a>

										</li>
										<li id="deals">
    										<a href="{{URL::to('dsmg/geartype')}}">
    										  <i class="fa fa-gears text-primary-dk"> </i> <span class="font-bold">Gear Type Master</span>
    										</a>

										</li>
										<li id="deals">
    										<a href="{{URL::to('dsmg/stationgear')}}">
    										  <i class="fa fa-industry text-primary-dk"> </i> <span class="font-bold">Station Gear Master</span>
    										</a>

										</li>
										<li id="deals">
												<a href="{{URL::to('dsmg/users')}}">
													<i class="fa fa-user text-primary-dk"> </i> <span class="font-bold">User Master</span>
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
								class="fa fa-arrow-left text"></i> <i
								class="fa fa-arrow-right text-active"></i>
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
