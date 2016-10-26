@extends('layouts.admin')
@section('navbar')
    @parent  
 	<link media="all" type="text/css" rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
 	<link media="all" type="text/css" rel="stylesheet" href="{{asset('css/selectize.bootstrap3.css')}}"> 	
@stop

@section('content')
    <div class="container">
    	<div class="panel panel-info">
			<div class="panel-heading">
			    <h3 class="panel-title">Details <small class="pull-right" style="margin-top: 5px;"><a data-toggle="modal" data-target="#cpassModal" href="#">Change Password</a></small></h3>
			</div>
			<div class="panel-body">
    			<div class="row">				
			      	{{ Form::open(array('', 'id'=>'admin_profile_form'))}}
						<div class="col-md-4">
							<div class="form-group">
							<label>Hotel Name<span class="text-danger">*</span></label>
							<input type="text" class="form-control " name="name" value="{{Auth::user()->name}}" placeholder="">
							</div>
							<div class="form-group">
							<label>Contact Person<span class="text-danger">*</span></label>
							<input type="text" class="form-control " name="contact_person" value="{{Auth::user()->contact_person}}" placeholder="">
							</div>
							<div class="form-group">
							<label>Police Station <span class="text-danger">*</span></label>
							{{ Form::select('ps_id', $ps, Auth::user()->ps_id, array('class' => 'form-control', 'name' => "ps_id"))}}
							</div>
							<div class="form-group">
							<label>Email <span class="text-danger">*</span></label>
							<input type="email" disabled="disabled" class="form-control " name="email" value="{{Auth::user()->email}}">
							</div>
							<div class="form-group">
							<label>Mobile <span class="text-danger">*</span></label>
							<input type="text" disabled="disabled" class="form-control " name="mobile" maxlength="10" value="{{Auth::user()->mobile}}">	
							</div>							
						</div>
						<div class="col-md-4">							
							<div class="form-group">
							<label>City <span class="text-danger">*</span></label>
							{{ Form::select('city_id', $city, Auth::user()->city_id, array('class' => 'form-control', 'name' => "city_id"))}}
							</div>
							<div class="form-group">
							<label>State</label>
							<input type="text" class="form-control " name="state" value="{{Auth::user()->state}}">
							</div>
							<div class="form-group">
							<label>Country</label>
							<input type="text" class="form-control " name="country" value="{{Auth::user()->country}}">						
							</div>
							<div class="form-group">
							<label>Number of Rooms</label>
							<input disabled="disabled" type="text" class="form-control " name="number_of_rooms" value="{{Auth::user()->number_of_rooms}}">
							</div>
							<div class="form-group">
							<label>Licence No</label>
							<input disabled="disabled" type="text" class="form-control " name="licence_no" value="{{Auth::user()->licence_no}}">
							</div>
						</div>
						<div class="col-md-4">		
							<div class="form-group">					
							<label>Locality</label>
							<input disabled="disabled" type="text" class="form-control " name="locality" value="{{Auth::user()->locality}}">
							</div>
							<div class="form-group">
							<label>Pin</label>
							<input disabled="disabled" type="text" class="form-control " name="pin" value="{{Auth::user()->pin}}">
							</div>
							<div class="form-group">
							<label>Address</label>
							<textarea disabled="disabled" rows="5" cols="" class="form-control " name="address">{{Auth::user()->address}}</textarea>
							</div>
							<div class="form-group">
							<label> &nbsp;</label>
							<button type="button" class="btn btn-primary  btn-block" id="update_profile_btn" style="margin-top: -5px;">Update</button>
							</div>
						</div>
					{{ Form::close() }}
			    </div>
			</div>
		</div>
    </div>
    <!-- Modal -->
	<div class="modal fade" id="cpassModal" tabindex="-1" role="dialog" aria-labelledby="cpassModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-sm">
	    <div class="modal-content">
	      <div class="panel panel-danger" style="margin-bottom: 0;">
		      <div class="panel-heading">
		        <h3 class="panel-title">Change Password <button type="button" class="close pull-right" data-dismiss="modal"><span aria-hidden="true">&times;</span></h3>
		      </div>
		      <div class="panel-body">
				{{ Form::open(array("","id"=>"changepass_form", "role"=>"form"))}}
				  <div class="form-group">
				    <label>Old Password</label>
				    <input type="password" class="form-control" id="old_password" name="old_password">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">New Password</label>
				    <input type="password" class="form-control" name="password">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Retype New Password</label>
				    <input type="password" class="form-control" name="confirmPassword">
				  </div>
				  <div class="form-group" style="margin-top: 20px;">
				  	<button type="button" class="btn btn-danger btn-block pull-right" id="change_password_btn">Submit</button>
				  </div>
				 {{ Form::close() }}
		      </div>
		    </div>
	    </div>
	  </div>
	</div>
	{{ HTML::script('js/selectize.min.js');}}
	{{ HTML::script('js/admin-profile.js');}}
@stop
