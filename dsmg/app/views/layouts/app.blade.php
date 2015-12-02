<!DOCTYPE html>
<html lang="en" class="app">
<head>
<meta charset="ISO-8859-1">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
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
{{HTML::style('packages/css/dsmg.css')}}
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
{{HTML::script('packages/js/underscore-min.js');}}


</head>

<body>
	<section class="vbox">
		<header
			class="bg-black text-white header header-md navbar navbar-fixed-top-xs ">

				<span class="navbar-brand"> {{
					HTML::image('packages/images/logo.png', 'dsmg', array('class' =>
					'm-r-md'))}} <span>DSMG monitoring</span>
				</span>
			<!--	<span class="navbar-brand"><button class="btn btn-danger btn-rounded btn-right">26</button> gear overdue</span>

				<span class="navbar-brand"><button class="btn btn-danger btn-rounded btn-right">3</button>JP&X-ing overdue</span>
-->

			<ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">
				<li class="dropdown"><a href="#" class="dropdown-toggle"
					data-toggle="dropdown"><?php echo Session::get("name"); ?> <b
						class="caret"></b>
				</a>
					<ul class="dropdown-menu animated fadeInRight">
						<li><span class="arrow top"></span> <a
							href="{{URL::to('dsmg/profile')}}">Change Password</a></li>
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
										<div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Maintenance</div>

										<li id="schedule_entry">
    										<a href="{{URL::to('dsmg/scheduleentry')}}">
    										  <i class="fa fa-gears text-danger-dk"> </i> <span class="font-bold">Gear Maintenance</span>
    										</a>
										</li>
										<li id="jp_crossing">
    										<a href="{{URL::to('dsmg/crossing')}}">
    										  <i class="fa fa-futbol-o text-info-dk"> </i> <span class="font-bold">JointPoint & X-ing</span>
    										</a>
										</li>
										<div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Reports</div>

										<li id="overdue_report">
												<a href="{{URL::to('dsmg/overduereport')}}">
													<i class="fa fa-stack-overflow text-danger-dk"> </i> <span class="font-bold">Overdue Gear</span>
												</a>
										</li>
										<li id="stn_report">
												<a href="{{URL::to('dsmg/staionwisereport')}}">
													<i class="fa fa-home text-success-dk"> </i> <span class="font-bold">Station Wise Maintenance</span>
												</a>

										</li>
										<li id="gear_report">
    										<a href="{{URL::to('dsmg/gearwisereport')}}">
    										  <i class="fa fa-gear text-success-dk"> </i> <span class="font-bold">Gear Wise Maintenance</span>
    										</a>

										</li>

										<div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Master Data</div>
										<li id="stn_details">
    										<a href="{{URL::to('dsmg/stationmaster')}}">
    										  <i class="fa fa-home text-primary-dk"> </i> <span class="font-bold">Stations</span>
    										</a>

										</li>

										<li id="code_master">
    										<a href="{{URL::to('dsmg/schedulecode')}}">
    										  <i class="fa  fa-calendar-check-o text-primary-dk"> </i> <span class="font-bold">DSMG Schedule Codes</span>
    										</a>

										</li>
										<li id="gear_type">
    										<a href="{{URL::to('dsmg/geartype')}}">
    										  <i class="fa fa-gears text-primary-dk"> </i> <span class="font-bold">Gear Type </span>
    										</a>

										</li>
										<li id="stn_gear">
    										<a href="{{URL::to('dsmg/stationgear')}}">
    										  <i class="fa fa-industry text-primary-dk"> </i> <span class="font-bold">Station Gears</span>
    										</a>

										</li>
										<li id="sec_distribution">
												<a href="{{URL::to('dsmg/section')}}">
													<i class="fa fa-user text-primary-dk"> </i> <span class="font-bold">Section Distribution</span>
												</a>

										</li>
										<li id="news_update">
												<a href="{{URL::to('dsmg/news')}}">
													<i class="fa fa-user text-primary-dk"> </i> <span class="font-bold">News & Updates</span>
												</a>

										</li>
										<li id="users">
												<a href="{{URL::to('dsmg/users')}}">
													<i class="fa fa-user text-primary-dk"> </i> <span class="font-bold">Users</span>
												</a>

										</li>

									</ul>
								</nav>
								<!-- / nav -->
							</div>
						</section>


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
