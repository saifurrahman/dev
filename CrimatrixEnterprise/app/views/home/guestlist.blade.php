@extends('layouts.home')
@section('navbar')
    @parent	
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/smoothness/jquery-ui.css" /> 	    
 	<link media="all" type="text/css" rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
 	<link media="all" type="text/css" rel="stylesheet" href="{{asset('css/selectize.bootstrap3.css')}}"> 	
 	<link media="all" type="text/css" rel="stylesheet" href="{{asset('css/guestlist.css')}}"> 	
@stop

@section('content')
<div class="container">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title">Add Guest</h3>
		</div>
		<div class="panel-body">			
			<div class="row">
				<div class="col-xs-9 col-md-3">
					<div class="input-group pull-right" id="guestlist_date_group">
					  <span class="input-group-addon">Date</span>
					  <input type="text" class="form-control" id="guestlist_date">
					</div> 
		        </div>
		        <div class="col-xs-3 col-md-3 col-md-offset-6">
		        	<button type="button" class="btn btn-primary pull-right" id="save_guest_btn">Save Guest</button>
		        </div>	
			</div>
			<hr>
			<div id="loader"><img src="{{asset('img/ajax-loader1.gif')}}" alt="loading"></div>
		    <div class="row" id="guest-form-row">
		    	<!-- image -->
		        <div class="col-xs-6 col-md-3">
		        	<img class="img-responsive" id="cam_photo" style="width:100%;" alt="photo" src="{{asset('img/default_pic.jpg')}}">
					<input type="file" id="imgfiles" name="imgfiles" accept="image/jpeg" onchange="readURL(this);" style="display: none;"> 
					<div class="btn-group btn-group-justified">
					  <div class="btn-group">
					    <button type="button" class="btn btn-default" onclick="$('#imgfiles').click();"><i class="fa fa-upload"></i> Upload</button>
					  </div>
					  <div class="btn-group">
					    <button type="button" class="btn btn-default" disabled="disabled">OR</button>
					  </div>
					  <div class="btn-group">
					    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#cam_modal" onclick="webcam();"><i class="fa fa-camera-retro"></i> Capture</button>
					  </div>
					</div>
		        </div>
				<!-- data -->
				{{ Form::open(array('', 'id'=>'guest_form'))}}				
			        <div class="col-xs-6 col-md-3">
						<div class="form-group">
						   <label>Room Number</label>
						   <input type="text" name="room_no" class="form-control">
						</div>
						<div class="form-group">
						   <label>Guest Name</label>
						   <input type="text" name="name" class="form-control" onchange="addmember(this.value);">
						</div>
						<div class="form-group">
						   <label>Mobile Number</label>
						   <input type="text" name="mobile" class="form-control" maxlength="10">
						</div>
						<div class="form-group">
						   <label>Additional Member</label>
						   <input type="number" name="additional_member" min="0" class="form-control" value="0" onfocus="set_additional_member(this.value);">
						</div>
			        </div>
			        <div class="col-xs-6 col-md-3">
						<div class="form-group">
						   <label>Coming From</label>
						   <select class="form-control" name="coming_from">
								<option value="">Select City/Town</option><option value="Hyderabad">Hyderabad</option><option value="Itanagar">Itanagar</option><option value="Dispur">Dispur</option><option value="Patna">Patna</option><option value="Raipur">Raipur</option><option value="Panaji">Panaji</option><option value="Gandhinagar">Gandhinagar</option><option value="Guwahati">Guwahati</option><option value="Chandigarh">Chandigarh</option><option value="Shimla">Shimla</option><option value="Srinagar">Srinagar</option><option value="Jammu">Jammu</option><option value="Ranchi">Ranchi</option><option value="Bengaluru">Bengaluru</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Bhopal">Bhopal</option><option value="Mumbai">Mumbai</option><option value="Imphal">Imphal</option><option value="Shillong">Shillong</option><option value="Aizawl">Aizawl</option><option value="Kohima">Kohima</option><option value="Bhubaneswar">Bhubaneswar</option><option value="Chandigarh">Chandigarh</option><option value="Jaipur">Jaipur</option><option value="Gangtok">Gangtok</option><option value="Goa">Goa</option><option value="Chennai">Chennai</option><option value="Agartala">Agartala</option><option value="Lucknow">Lucknow</option><option value="Dehradun">Dehradun</option><option value="Kolkata">Kolkata</option><option value="Port" blair="">Port Blair</option><option value="Chandigarh">Chandigarh</option><option value="Silvassa">Silvassa</option><option value="Daman">Daman</option><option value="Delhi">Delhi</option><option value="Kavaratti">Kavaratti</option><option value="Pondicherry">Pondicherry</option>
						   </select>
						</div>
						<div class="form-group">
						   <label>Going To</label>
						   <select class="form-control" name="going_to">
						   	    <option value="">Select City/Town</option><option value="Hyderabad">Hyderabad</option><option value="Itanagar">Itanagar</option><option value="Dispur">Dispur</option><option value="Patna">Patna</option><option value="Raipur">Raipur</option><option value="Panaji">Panaji</option><option value="Gandhinagar">Gandhinagar</option><option value="Guwahati">Guwahati</option><option value="Chandigarh">Chandigarh</option><option value="Shimla">Shimla</option><option value="Srinagar">Srinagar</option><option value="Jammu">Jammu</option><option value="Ranchi">Ranchi</option><option value="Bengaluru">Bengaluru</option><option value="Thiruvananthapuram">Thiruvananthapuram</option><option value="Bhopal">Bhopal</option><option value="Mumbai">Mumbai</option><option value="Imphal">Imphal</option><option value="Shillong">Shillong</option><option value="Aizawl">Aizawl</option><option value="Kohima">Kohima</option><option value="Bhubaneswar">Bhubaneswar</option><option value="Chandigarh">Chandigarh</option><option value="Jaipur">Jaipur</option><option value="Gangtok">Gangtok</option><option value="Goa">Goa</option><option value="Chennai">Chennai</option><option value="Agartala">Agartala</option><option value="Lucknow">Lucknow</option><option value="Dehradun">Dehradun</option><option value="Kolkata">Kolkata</option><option value="Port" blair="">Port Blair</option><option value="Chandigarh">Chandigarh</option><option value="Silvassa">Silvassa</option><option value="Daman">Daman</option><option value="Delhi">Delhi</option><option value="Kavaratti">Kavaratti</option><option value="Pondicherry">Pondicherry</option>
						   </select>				   
						</div>
						<div class="form-group">
						   <label>ID Type</label>
						   <!--<input type="text" name="id_type" class="form-control" placeholder="">-->
						   <select class="form-control" name="id_type">
						   		<option value="">Select ID Type</option>
								<option value="Passport">Passport</option>
								<option value="PAN Card">PAN Card</option>
								<option value="Driving Licence">Driving Licence</option>
								<option value="Voter ID Card">Voter ID Card</option>
								<option value="Aadhaar Card">Aadhaar Card</option>
								<option value="Employee ID Card">Employee ID Card</option>
								<option value="Govt. Employee ID Card">Govt. Employee ID Card</option>
								<option value="Student ID Card">Student ID Card</option>
								<option value="Others">Others</option>
							</select>
						</div>
						<div class="form-group">
						   <label>ID Card No</label>
						   <input type="text" class="form-control" name="id_no">
						</div>	        		
			        </div>
			        <div class="col-xs-6 col-md-3">				
			        	<div class="form-group">
						   <label>Age</label>
						   <input type="text" class="form-control" min="1" max="130" name="age">
						</div>
						<div class="form-group">
						   <label>Sex</label>				   
						    <select class="form-control" name="sex">
						    	<option value="M">Male</option>
						    	<option value="F">Female</option>
						    </select>
						</div>
						<div class="form-group">
						   <label>Nationality</label><small class="pull-right"><span class="text-danger"><span class="label label-danger">Note:</span> Select only the country</span></small>
						   <select class="form-control" name="nationality">
							<option value="AFG">Afghanistan</option>
							<option value="ALA">Åland Islands</option>
							<option value="ALB">Albania</option>
							<option value="DZA">Algeria</option>
							<option value="ASM">American Samoa</option>
							<option value="AND">Andorra</option>
							<option value="AGO">Angola</option>
							<option value="AIA">Anguilla</option>
							<option value="ATA">Antarctica</option>
							<option value="ATG">Antigua and Barbuda</option>
							<option value="ARG">Argentina</option>
							<option value="ARM">Armenia</option>
							<option value="ABW">Aruba</option>
							<option value="AUS">Australia</option>
							<option value="AUT">Austria</option>
							<option value="AZE">Azerbaijan</option>
							<option value="BHS">Bahamas</option>
							<option value="BHR">Bahrain</option>
							<option value="BGD">Bangladesh</option>
							<option value="BRB">Barbados</option>
							<option value="BLR">Belarus</option>
							<option value="BEL">Belgium</option>
							<option value="BLZ">Belize</option>
							<option value="BEN">Benin</option>
							<option value="BMU">Bermuda</option>
							<option value="BTN">Bhutan</option>
							<option value="BOL">Bolivia, Plurinational State of</option>
							<option value="BES">Bonaire, Sint Eustatius and Saba</option>
							<option value="BIH">Bosnia and Herzegovina</option>
							<option value="BWA">Botswana</option>
							<option value="BVT">Bouvet Island</option>
							<option value="BRA">Brazil</option>
							<option value="IOT">British Indian Ocean Territory</option>
							<option value="BRN">Brunei Darussalam</option>
							<option value="BGR">Bulgaria</option>
							<option value="BFA">Burkina Faso</option>
							<option value="BDI">Burundi</option>
							<option value="KHM">Cambodia</option>
							<option value="CMR">Cameroon</option>
							<option value="CAN">Canada</option>
							<option value="CPV">Cape Verde</option>
							<option value="CYM">Cayman Islands</option>
							<option value="CAF">Central African Republic</option>
							<option value="TCD">Chad</option>
							<option value="CHL">Chile</option>
							<option value="CHN">China</option>
							<option value="CXR">Christmas Island</option>
							<option value="CCK">Cocos (Keeling) Islands</option>
							<option value="COL">Colombia</option>
							<option value="COM">Comoros</option>
							<option value="COG">Congo</option>
							<option value="COD">Congo, the Democratic Republic of the</option>
							<option value="COK">Cook Islands</option>
							<option value="CRI">Costa Rica</option>
							<option value="CIV">Côte d'Ivoire</option>
							<option value="HRV">Croatia</option>
							<option value="CUB">Cuba</option>
							<option value="CUW">Curaçao</option>
							<option value="CYP">Cyprus</option>
							<option value="CZE">Czech Republic</option>
							<option value="DNK">Denmark</option>
							<option value="DJI">Djibouti</option>
							<option value="DMA">Dominica</option>
							<option value="DOM">Dominican Republic</option>
							<option value="ECU">Ecuador</option>
							<option value="EGY">Egypt</option>
							<option value="SLV">El Salvador</option>
							<option value="GNQ">Equatorial Guinea</option>
							<option value="ERI">Eritrea</option>
							<option value="EST">Estonia</option>
							<option value="ETH">Ethiopia</option>
							<option value="FLK">Falkland Islands (Malvinas)</option>
							<option value="FRO">Faroe Islands</option>
							<option value="FJI">Fiji</option>
							<option value="FIN">Finland</option>
							<option value="FRA">France</option>
							<option value="GUF">French Guiana</option>
							<option value="PYF">French Polynesia</option>
							<option value="ATF">French Southern Territories</option>
							<option value="GAB">Gabon</option>
							<option value="GMB">Gambia</option>
							<option value="GEO">Georgia</option>
							<option value="DEU">Germany</option>
							<option value="GHA">Ghana</option>
							<option value="GIB">Gibraltar</option>
							<option value="GRC">Greece</option>
							<option value="GRL">Greenland</option>
							<option value="GRD">Grenada</option>
							<option value="GLP">Guadeloupe</option>
							<option value="GUM">Guam</option>
							<option value="GTM">Guatemala</option>
							<option value="GGY">Guernsey</option>
							<option value="GIN">Guinea</option>
							<option value="GNB">Guinea-Bissau</option>
							<option value="GUY">Guyana</option>
							<option value="HTI">Haiti</option>
							<option value="HMD">Heard Island and McDonald Islands</option>
							<option value="VAT">Holy See (Vatican City State)</option>
							<option value="HND">Honduras</option>
							<option value="HKG">Hong Kong</option>
							<option value="HUN">Hungary</option>
							<option value="ISL">Iceland</option>
							<option value="IND" selected="selected">India</option>
							<option value="IDN">Indonesia</option>
							<option value="IRN">Iran, Islamic Republic of</option>
							<option value="IRQ">Iraq</option>
							<option value="IRL">Ireland</option>
							<option value="IMN">Isle of Man</option>
							<option value="ISR">Israel</option>
							<option value="ITA">Italy</option>
							<option value="JAM">Jamaica</option>
							<option value="JPN">Japan</option>
							<option value="JEY">Jersey</option>
							<option value="JOR">Jordan</option>
							<option value="KAZ">Kazakhstan</option>
							<option value="KEN">Kenya</option>
							<option value="KIR">Kiribati</option>
							<option value="PRK">Korea, Democratic People's Republic of</option>
							<option value="KOR">Korea, Republic of</option>
							<option value="KWT">Kuwait</option>
							<option value="KGZ">Kyrgyzstan</option>
							<option value="LAO">Lao People's Democratic Republic</option>
							<option value="LVA">Latvia</option>
							<option value="LBN">Lebanon</option>
							<option value="LSO">Lesotho</option>
							<option value="LBR">Liberia</option>
							<option value="LBY">Libya</option>
							<option value="LIE">Liechtenstein</option>
							<option value="LTU">Lithuania</option>
							<option value="LUX">Luxembourg</option>
							<option value="MAC">Macao</option>
							<option value="MKD">Macedonia, the former Yugoslav Republic of</option>
							<option value="MDG">Madagascar</option>
							<option value="MWI">Malawi</option>
							<option value="MYS">Malaysia</option>
							<option value="MDV">Maldives</option>
							<option value="MLI">Mali</option>
							<option value="MLT">Malta</option>
							<option value="MHL">Marshall Islands</option>
							<option value="MTQ">Martinique</option>
							<option value="MRT">Mauritania</option>
							<option value="MUS">Mauritius</option>
							<option value="MYT">Mayotte</option>
							<option value="MEX">Mexico</option>
							<option value="FSM">Micronesia, Federated States of</option>
							<option value="MDA">Moldova, Republic of</option>
							<option value="MCO">Monaco</option>
							<option value="MNG">Mongolia</option>
							<option value="MNE">Montenegro</option>
							<option value="MSR">Montserrat</option>
							<option value="MAR">Morocco</option>
							<option value="MOZ">Mozambique</option>
							<option value="MMR">Myanmar</option>
							<option value="NAM">Namibia</option>
							<option value="NRU">Nauru</option>
							<option value="NPL">Nepal</option>
							<option value="NLD">Netherlands</option>
							<option value="NCL">New Caledonia</option>
							<option value="NZL">New Zealand</option>
							<option value="NIC">Nicaragua</option>
							<option value="NER">Niger</option>
							<option value="NGA">Nigeria</option>
							<option value="NIU">Niue</option>
							<option value="NFK">Norfolk Island</option>
							<option value="MNP">Northern Mariana Islands</option>
							<option value="NOR">Norway</option>
							<option value="OMN">Oman</option>
							<option value="PAK">Pakistan</option>
							<option value="PLW">Palau</option>
							<option value="PSE">Palestinian Territory, Occupied</option>
							<option value="PAN">Panama</option>
							<option value="PNG">Papua New Guinea</option>
							<option value="PRY">Paraguay</option>
							<option value="PER">Peru</option>
							<option value="PHL">Philippines</option>
							<option value="PCN">Pitcairn</option>
							<option value="POL">Poland</option>
							<option value="PRT">Portugal</option>
							<option value="PRI">Puerto Rico</option>
							<option value="QAT">Qatar</option>
							<option value="REU">Réunion</option>
							<option value="ROU">Romania</option>
							<option value="RUS">Russian Federation</option>
							<option value="RWA">Rwanda</option>
							<option value="BLM">Saint Barthélemy</option>
							<option value="SHN">Saint Helena, Ascension and Tristan da Cunha</option>
							<option value="KNA">Saint Kitts and Nevis</option>
							<option value="LCA">Saint Lucia</option>
							<option value="MAF">Saint Martin (French part)</option>
							<option value="SPM">Saint Pierre and Miquelon</option>
							<option value="VCT">Saint Vincent and the Grenadines</option>
							<option value="WSM">Samoa</option>
							<option value="SMR">San Marino</option>
							<option value="STP">Sao Tome and Principe</option>
							<option value="SAU">Saudi Arabia</option>
							<option value="SEN">Senegal</option>
							<option value="SRB">Serbia</option>
							<option value="SYC">Seychelles</option>
							<option value="SLE">Sierra Leone</option>
							<option value="SGP">Singapore</option>
							<option value="SXM">Sint Maarten (Dutch part)</option>
							<option value="SVK">Slovakia</option>
							<option value="SVN">Slovenia</option>
							<option value="SLB">Solomon Islands</option>
							<option value="SOM">Somalia</option>
							<option value="ZAF">South Africa</option>
							<option value="SGS">South Georgia and the South Sandwich Islands</option>
							<option value="SSD">South Sudan</option>
							<option value="ESP">Spain</option>
							<option value="LKA">Sri Lanka</option>
							<option value="SDN">Sudan</option>
							<option value="SUR">Suriname</option>
							<option value="SJM">Svalbard and Jan Mayen</option>
							<option value="SWZ">Swaziland</option>
							<option value="SWE">Sweden</option>
							<option value="CHE">Switzerland</option>
							<option value="SYR">Syrian Arab Republic</option>
							<option value="TWN">Taiwan, Province of China</option>
							<option value="TJK">Tajikistan</option>
							<option value="TZA">Tanzania, United Republic of</option>
							<option value="THA">Thailand</option>
							<option value="TLS">Timor-Leste</option>
							<option value="TGO">Togo</option>
							<option value="TKL">Tokelau</option>
							<option value="TON">Tonga</option>
							<option value="TTO">Trinidad and Tobago</option>
							<option value="TUN">Tunisia</option>
							<option value="TUR">Turkey</option>
							<option value="TKM">Turkmenistan</option>
							<option value="TCA">Turks and Caicos Islands</option>
							<option value="TUV">Tuvalu</option>
							<option value="UGA">Uganda</option>
							<option value="UKR">Ukraine</option>
							<option value="ARE">United Arab Emirates</option>
							<option value="GBR">United Kingdom</option>
							<option value="USA">United States</option>
							<option value="UMI">United States Minor Outlying Islands</option>
							<option value="URY">Uruguay</option>
							<option value="UZB">Uzbekistan</option>
							<option value="VUT">Vanuatu</option>
							<option value="VEN">Venezuela, Bolivarian Republic of</option>
							<option value="VNM">Viet Nam</option>
							<option value="VGB">Virgin Islands, British</option>
							<option value="VIR">Virgin Islands, U.S.</option>
							<option value="WLF">Wallis and Futuna</option>
							<option value="ESH">Western Sahara</option>
							<option value="YEM">Yemen</option>
							<option value="ZMB">Zambia</option>
							<option value="ZWE">Zimbabwe</option>
							</select>
						</div>
						<div class="form-group">
						   <label>Vehicle Number (if any)</label>
						   <input type="text" class="form-control" name="vehicle_no">
						</div>				
			        </div>
		    	{{ Form::close() }}<!-- end form -->				
		    </div><!-- end row -->   
			<div class="row">
		    	<div class="col-xs-12 col-md-4">
		        	<div class="alert alert-danger" role="alert">
		        		<span class="label label-primary">Please</span> Select the Country from the list in the Nationality field.
		        	</div>
		        </div>
		        <div class="col-xs-12 col-md-4">
		        	<div class="alert alert-danger" role="alert">
		        		<span class="label label-primary">For Example:</span><br/> Don't write INDIAN --- Just select INDIA
		        	</div>
		        </div>
		        <div class="col-xs-12 col-md-4">
		        	<div class="alert alert-danger" role="alert">
		        		<h4><span class="label label-danger">DON'T TYPE.</span> <span class="label label-success">JUST SELECT</span></h4>
		        	</div>
		        </div>
		    </div>
		</div>
	</div>
	<hr>
	<div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Guestlist <small class="SourceSansPro">(List of <span class="text-danger">not checked-out</span> guests only)</small></h3>
      </div>
      <div class="panel-body">

      	<div class="table-responsive">
		  <table class="table table-bordered" id="guestlist_tb">
	        <thead>
	          <tr>
	          	<th style="width: 40px;"><span class="glyphicon glyphicon-picture"></span></th>
	          	<input type="hidden" name="_token" id="cfr_token" value="<?php echo csrf_token(); ?>">
	            <th>Room No</th>
	            <th>Name</th>
	            <th>Mobile</th>
	            <th>Coming From</th>
	            <th>Going To</th>
	            <th>ID Type</th>
	            <th>ID Card No</th>
	            <th>Check-In</th>
	            <th>Check-Out</th>
	          </tr>
	        </thead>
	        <tbody>	          
	        </tbody>
	      </table>
		</div>        
      </div>
    </div>
</div>     	

<!-- Camera Modal -->
<div class="modal fade" id="cam_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="background: #cccccc; border: 1px solid #cc0000;">				
				<video id="vi" style="margin-left: 60px;" width="400" height="340" autoplay></video>				
				<canvas id="photoCanvas" width="400" height="340" style="display: none;"></canvas>
			</div>
			<div class="modal-footer" style="margin-top: 0px;">
				<button type="button" class="btn btn-default pull-left"	data-dismiss="modal">Cancel</button>
				<button class="btn btn-primary" type="button" id="capture">Capture</button>
				<button class="btn btn-info" type="button" id="re_capture">Re-Capture</button>
				<button class="btn btn-success pull-right" type="button" id="ok" data-dismiss="modal" aria-hidden="true">OK</button>
			</div>
		</div>		
	</div>
</div>
<!-- end modal-->
<script type="text/javascript">
	var user_system_date = moment().format("YYYY-MM-DD");
	var currentdate = '<?php echo Session::get('currentdate'); ?>';
	var currentdate_read = '<?php $crdate = Session::get('currentdate'); echo date('d-M-Y')?>';
	if(currentdate != user_system_date){
		//$('html').css('overflow','hidden');
		//$('body').prepend("<div class='alert alert-danger' style='margin-top: 20%;text-align: center;z-index: 9999;position: absolute;width: 100%;'><h3>Today is "+currentdate_read+"</h3><h4>Please adjust your computer Date and Time<h4><h5>After fix your datetime <a class='btn btn-default' href='{{URL::to('hotel/users/logout')}}'>Logout</a> and Login Again</h5></div><img src='{{asset('img/ic-down-arrow.png')}}' style='position: fixed;z-index: 9999;right: 9;bottom: 0;'><div class='modal-backdrop fade in' style='height: 984px;'></div>");		
		alertify.log("Please adjust your computer Date and Time", "", 0);		
	}	
</script>
 {{ HTML::script('js/jquery-ui.min.js');}}
 {{ HTML::script('js/selectize.min.js');}}
 {{ HTML::script('js/guestlist.js');}} 
@stop
