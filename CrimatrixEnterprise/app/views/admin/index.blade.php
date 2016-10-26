@extends('layouts.admin')

@section('navbar')
    @parent	    
@stop

@section('content')
	<div class="container">
		<div class="row">
		    <div class="panel panel-default">
		      <div class="panel-heading">
		        <h3 class="panel-title">Registerd Hotels & Lodges</h3>
		      </div>
		      <div class="panel-body">

		      	<div class="table-responsive">      		
				  <table class="table table-bordered" id="reg-hotels-tb">
			        <thead>
			          <tr>	          	
			          	<input type="hidden" name="_token" id="cfr_token" value="<?php echo csrf_token(); ?>">
			            <th>#</th>
			            <th>Name</th>
			            <th>Contact Person</th>
			            <th>Email</th>
			            <th>Mobile</th>
			            <th>Police Station</th>
			            <th>Location</th>
			            <th style="width:5%;">Aprove</th>
			            <th style="width:5%;">Edit</th>
			            <th style="width:5%;">Reset</th>	            
			          </tr>
			        </thead>
			        <tbody>	   
			        	<?php $i = 1; $admincss ='';?>			        	
				        @if(!empty($notFound))
						<p>Sorry nothing found for your query!</p>
						@else
							@foreach($hotels as $hotel)							
							@if($hotel->role == 'admin')
								<?php $admincss = 'warning'; ?>
							@else
								<?php $admincss = ''; ?>
							@endif
							<tr class="{{$admincss}}">	          	
					           <td class="id hidden">{{$hotel->id}}</td>
					           <td class="data hidden">{{json_encode($hotel)}}</td>
							   <td>{{$i++}}</td>							   
					           <td>{{$hotel->name}}</td>
					           <td>{{$hotel->contact_person}}</td>
					           <td>{{$hotel->email}}</td>
					           <td>{{$hotel->mobile}}</td>
					           <td>{{$hotel->ps_name}}</td>
					           <td>{{$hotel->locality}}</td>
					           @if($hotel->status != 0)
						           <!-- 1 -->
						           <td><button type="button" class="unapproved btn btn-success btn-xs" title="click to disabled">Enabled</button></td>
					           @else
						           <!-- 0 -->
								   <td><button type="button" class="approved btn btn-disable btn-xs" title="click to enabled">Disabled</button></td>
					           @endif
					           <td><button type="button" class="edit btn btn-default btn-xs">Edit</button></td>
					           <td><button type="button" class="reset btn btn-danger btn-xs">Reset</button></td>
					        </tr>
						@endforeach
						@endif
			        </tbody>	      
			      </table>
				</div>        
		      </div>
		    </div>
	    </div>       
    </div>

    <!-- Modal -->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="editModalLabel">Edit</h4>
	      </div>
	      <div class="modal-body">
				<div class="row">				
			      	{{ Form::open(array('', 'id'=>'update_user_form'))}}
						<div class="col-md-4">
							<input type="hidden" name="id" id="edit_id">
							<div class="form-group">
							<label>Hotel Name<span class="text-danger">*</span></label>
							<input type="text" class="form-control " name="name" id="edit_name">
							</div>
							<div class="form-group">
							<label>Contact Person<span class="text-danger">*</span></label>
							<input type="text" class="form-control " name="contact_person" id="edit_contact_person">
							</div>
							<div class="form-group">
							<label>Police Station <span class="text-danger">*</span></label>
							{{ Form::select('ps_id', $ps, 9999, array('class' => 'form-control', 'name' => 'ps_id', 'id'=>'edit_ps_id'))}}
							</div>
							<div class="form-group">
							<label>Email <span class="text-danger">*</span></label>
							<input type="email" class="form-control " name="email" id="edit_email">
							</div>
							<div class="form-group">
							<label>Mobile <span class="text-danger">*</span></label>
							<input type="text" class="form-control " name="mobile" maxlength="10" id="edit_mobile">	
							</div>							
						</div>
						<div class="col-md-4">							
							<div class="form-group">
							<label>City <span class="text-danger">*</span></label>
							{{ Form::select('city_id', $city, 1, array('class' => 'form-control', 'name' => 'city_id', 'id'=>'edit_city_id'))}}
							</div>
							<div class="form-group">
							<label>State</label>
							<input type="text" class="form-control " name="state" id="edit_state">
							</div>
							<div class="form-group">
							<label>Country</label>
							<input type="text" class="form-control " name="country" id="edit_country">
							</div>
							<div class="form-group">
							<label>Number of Rooms</label>
							<input type="text" class="form-control " name="number_of_rooms" id="edit_number_of_rooms">
							</div>
							<div class="form-group">
							<label>Licence No</label>
							<input type="text" class="form-control " name="licence_no" id="edit_licence_no">
							</div>
						</div>
						<div class="col-md-4">		
							<div class="form-group">					
							<label>Locality</label>
							<input type="text" class="form-control " name="locality" id="edit_locality">
							</div>
							<div class="form-group">
							<label>Pin</label>
							<input type="text" class="form-control " name="pin" id="edit_pin">
							</div>
							<div class="form-group">
							<label>Address</label>
							<textarea rows="8" cols="" class="form-control " name="address" id="edit_address"></textarea>
							</div>
						</div>
					{{ Form::close() }}
			    </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" id="save_changes_btn">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>
	 {{ HTML::script('js/admin-hotels.js');}}	 
@stop