<html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Crimatrix for hotel.">
        <meta name="keywords" content="Assam Police, Crimatrix">
        <title>Crimatrix for hotel</title>
        <!-- css -->
  	    {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
        {{ HTML::style('css/bootstrapValidator.min.css')}}
        {{ HTML::style('css/alertify.core.css')}}
        {{ HTML::style('css/alertify.bootstrap3.css')}}
  	    {{ HTML::style('css/app.css')}}
        <!-- js -->
        {{ HTML::script('js/jquery.min.js');}}
        {{ HTML::script('packages/bootstrap/js/bootstrap.min.js');}}
        {{ HTML::script('js/bootstrapValidator.min.js');}}
        {{ HTML::script('js/alertify.min.js');}}
	</head>
    <body>
        @section('navbar')
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
                    <a class="navbar-brand" href="#">
                        <img id="logo_image" class="img-responsive" src="{{asset('img/logo.png')}}" alt="Crimatrix Logo">
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                    @if(Auth::check())

										<li id="guestlist_li"><a href="{{URL::to('hotel/guestlist')}}">Guestlist</a></li>
										<li id="reports_li"><a href="{{URL::to('hotel/reports')}}">Reports</a></li>
                        <li id="reg_hotel_users_li"><a href="{{URL::to('hotel/admin/hotels')}}">Registerd Hotels & Lodges</a></li>
                    @endif
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                        <li id="profile_li"><a href="{{URL::to('hotel/admin/profile')}}">Profile</a></li>
                        <li>{{ HTML::link('hotel/users/logout', 'Logout') }}</li>
                    @endif
                    </ul>
                </div>
            </div>
        </nav>
        @show
        <section>
            @yield('content')
        </section>
        @section('footer')
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
