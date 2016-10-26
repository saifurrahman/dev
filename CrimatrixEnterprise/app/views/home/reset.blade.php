@extends('layouts.home')

@section('navbar')
    @parent	    
    <link media="all" type="text/css" rel="stylesheet" href="{{asset('css/home.css')}}">
@stop

@section('content')
	<div class="container">
        <div class="row">
	        <div class="col-md-4 col-md-offset-4">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<h3 class="panel-title">Password Reset</h3>
					</div>
					<div class="panel-body">
						{{ Form::open(array('url' => 'hotel/users/resetpassword')) }}
							<div class="form-group">
						    	<input type="hidden" name="id" value="{{$reset[0]->id}}">
						    	<input type="hidden" name="user_id" value="{{$reset[0]->user_id}}">
						    	<label class="form-label">New Password</label>
						    	{{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'')) }}
					 		</div>
					 		<div class="form-group">
						    	<label class="form-label">Confirm New Password</label>
						    	{{ Form::password('confirmPassword', array('class'=>'form-control', 'placeholder'=>'')) }}
					 		</div>
					 		{{ Form::submit('Reset', array('class'=>'btn btn-primary btn-block mbefore'))}}
						{{ Form::close() }}
					</div>					
				</div>
				<div class="alert alert-danger" role="alert">
			      <p>Password has to be alphanumeric characters and of minimum 6 characters.</p>
			    </div>
			</div>
        </div>
    </div>
@stop      	