@extends('layouts.home')

@section('navbar')
    @parent	    
    <link media="all" type="text/css" rel="stylesheet" href="{{asset('css/home.css')}}">
@stop

@section('content')
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
			      	{{ Form::open(array('url'=>'hotel/users/signin', 'class'=>''))}}
			      		<div class="form-group">
			      			<label class="form-label">Email or Mobile</label>
					    	{{ Form::text('username', null, array('class'=>'form-control', 'placeholder'=>'')) }}
					    </div>
					    <div class="form-group">
					    	<label class="form-label">Password</label>
					    	{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'')) }}
					 	</div>
					 	<div class="form-group">
                        	<input type="text" name="error" id="login_fail" class="form-control" value="Email or Password is Incorrect" disabled="disabled"/>
                      	</div>	
                      	@if ($alert = Session::get('error'))
                      	<div class="form-group">
				            <p class="bg-danger" style="padding: 15px;">{{ $alert }}</p>				        
			        	</div>
			        	@endif
                      	<div class="form-group">
					    	{{ Form::submit('Sign in', array('class'=>'btn btn-primary btn-block mbefore'))}}
					    	<p>
					    		<small class="pull-left"><a href="#" data-toggle="modal" data-target="#forgotModal">I forgot my password</a></small>					    		
					    	</p>					    	
					    </div>	
					    <hr>					    
					    <div class="form-group">
					    	<h5 class="text-center">New Hotel?</h5>
					    	<p><a class="btn btn-success btn-block btn-lg" href="#" data-toggle="modal" data-target="#regModal">Register Here</a></p>
						</div>
					{{ Form::close() }}
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
	       			{{ Form::open(array("","id"=>"registration_form","class"=>""))}}
	       				<div class="form-group">
			      			<label class="form-label">Hotel Name</label>
					    	{{ Form::text('name', null, array('class'=>'form-control', 'placeholder'=>'')) }}
					    </div>
			       		<div class="form-group">
			      			<label class="form-label">Email Address</label>
					    	{{ Form::email('email', null, array('class'=>'form-control', 'placeholder'=>'')) }}
					    </div>
					    <div class="form-group">
					    	<label class="form-label">Mobile Number</label>
					    	{{ Form::text('mobile', null, array('class'=>'form-control', 'maxlength'=>'10', 'placeholder'=>'')) }}
					 	</div>						
			        {{ Form::close() }}
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
	      	{{ Form::open(array("","id"=>"forgot_form","class"=>""))}}
	      		<div class="form-group">
			    	<label class="form-label">Your Crimatrix Registered Email</label>
					{{ Form::email('email', null, array('class'=>'form-control', 'placeholder'=>'')) }}
				</div>
	      	{{ Form::close() }}
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" id="request_reset_password_btn">Send Request</button>
	      </div>
	    </div>
	  </div>
	</div>
	 {{ HTML::script('js/home.js');}}
@stop