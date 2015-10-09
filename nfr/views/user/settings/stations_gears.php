<aside class="right-side">                
   <section class="content-header">
   	<h1>Assign Gears</h1>
   	<ol class="breadcrumb">
   		<li><button class="btn btn-success pull-right" data-toggle="modal" data-target="#AssignGearModal"><i class="fa fa-plus"></i> assign gears</button></li>
   	</ol>
   </section>
   <section class="content">
        <div class="row">
			<div class="col-md-12">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>STATION</th>
							<th>GEAR</th>
							<th>TRACK</th>
							<th>DATE OF INSTALLMENT</th>
							<th>DATE OF EXP.</th>
							<th>EDIT</th>
							<th>DELETE</th>
						</tr>
					</thead>
					<tbody id="railway_assignedGear_list"></tbody>
				</table>
			</div>
		</div>
    </section>
</aside>

<!-- Assign Gear Model-->
<div class="modal fade" id="AssignGearModal" tabindex="-1" role="dialog" aria-labelledby="AssignGearModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="AssignGearModalLabel">Assign Gear</h3>
      </div>
      <div class="modal-body">
         <div class="row mafter">
	   		<form action="" id="assign_gear_form">
	        	<div class="col-md-4">
	        		<label>Station</label>
	        		<select class="form-control" id="station_id" name="station_id"></select>
	        		<label>Gear</label>
	        		<select class="form-control" id="gear_id" name="gear_id"></select>
	        		<label>Track</label>
	        		<select class="form-control" id="track_id" name="track_id"></select>
	        	</div>
	        	<div class="col-md-4">
	        		<label>Date of install</label>
	        		<input type="text" class="form-control" id="date_of_install" name="date_of_install">
	        		<label>Date of exp</label>
	        		<input type="text" class="form-control" id="date_of_exp" name="date_of_exp">
	        		<label>Remarks</label>
	        		<input type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks">
	        	</div>
	        	<div class="col-md-4">
	        		<label>Logitude</label>
	        		<input type="text" class="form-control" id="longitude" placeholder="Logitude" disabled="disabled">
	        		<label>Latitude</label>
	        		<input type="text" class="form-control" id="latitude" placeholder="Latitude" disabled="disabled">  
	        		<label class="before_btn"></label>
	        		<button type="button" class="btn btn-primary btn-block" id="assign_gear_btn" onclick="assign_gear();">Save</button>
	        	</div>
	        </form>	
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$('#setting_li, #gear_li').addClass('active');
$('#setting_sub_ul').css('display', 'block');
$('#date_of_install, #date_of_exp').datepicker({dateFormat: 'dd-mm-yy'});
window.onload = function() {
	get_all_assign_gear();
	get_all_stations();
	get_all_gear();
	get_all_tracks();
};

function get_all_stations(){
	$.ajax({
		url: '<?php echo URL;?>settings/getAllStations/',
		type: 'POST',
		dataType: 'JSON',
		success: function(data){
			$('#station_id').empty();
			$('#station_id').append('<option value="0"></option>');
			for(var i in data){
			  $('#station_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}
		}	
	});
}
function get_all_gear(){
	$.ajax({
		url: '<?php echo URL;?>settings/getAllGears/',
		type: 'POST',
		dataType: 'JSON',
		success: function(data){
			$('#gear_id').empty();
			$('#gear_id').append('<option value="0"></option>');
			for(var i in data){
				$('#gear_id').append('<option value="'+data[i].id+'">'+data[i].name+'&nbsp;&nbsp;('+data[i].code+')</option>');
			}
		}		
	});
}
function get_all_tracks(){
	$.ajax({
		url: '<?php echo URL;?>settings/getAllTracks/',
		type: 'POST',
		dataType: 'JSON',
		success: function(data){
			$('#track_id').empty();
			$('#track_id').append('<option value="0"></option>');
			for(var i in data){
				$('#track_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}
		}		
	});
}
//assign_gear
function assign_gear(){
	var formData = $('form#assign_gear_form').serializeArray();
	$('#assign_gear_btn').attr('disabled',true).html('<i class="fa fa-spinner fa-spin"></i>');
	$.ajax({
		url: '<?php echo URL;?>gear/assign_gear/',
		type: 'POST',
		dataTtype: 'JSON',
		data: formData,
		success: function(data){
			get_assign_gear_by_id(data);
			$('form#assign_gear_form').each(function(){this.reset();});
			$('#assign_gear_btn').attr('disabled',false).html('Save');
			alertify.success("Assigned Successfully");
			$('#AssignGearModal').modal('hide');
		}			
	});
}
function get_all_assign_gear(){
	$.ajax({
		url: '<?php echo URL;?>gear/get_all_assign_gear/',
		type: 'POST',
		dataType: 'JSON',
		success: function(data){
			for(var i in data){
				var row ='<tr>'
		 			+'<td class="id hidden">'+data[i].id+'</td>'
		 			+'<td class="station_id hidden">'+data[i].station_id+'</td>'
		 			+'<td class="station_name">'+data[i].station_name+'</td>'
		 			+'<td class="gear_id hidden">'+data[i].gear_id+'</td>'
		 			+'<td class="gear_code">'+data[i].gear_code+'</td>'
		 			+'<td class="track_id hidden">'+data[i].track_id+'</td>'
		 			+'<td class="track_name">'+data[i].track_name+'</td>'
		 			+'<td class="date_of_install">'+data[i].date_of_install_ddmmyy+'</td>'
		 			+'<td class="date_of_exp">'+data[i].date_of_exp_ddmmyy+'</td>'
		 			+'<td><button class="edit btn btn-info btn-xs">edit</button></td>'
		 			+'<td><button class="del btn btn-danger btn-xs">delete</button></td>'
		 			+'</tr>';
				$('#railway_assignedGear_list').append(row);
			}
		}		
	});
}
//delete users
$("#railway_assignedGear_list").on("click", ".del", function() {
	var $del = $(this);
    var id = $del.closest("tr").find(".id").text();
    alertify.confirm("Are you sure ?", function(e){
		if(e){
			$del.html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
			delete_user($del,id);
		}
	});
});
function delete_user($this,id){
	$.ajax({
	    url: '<?php echo URL; ?>gear/delete_assign_gear/',
	    type: 'POST',
	    dataType: 'JSON',
	    data: {'id': id},
	    success: function(data){
	    	if(data == 1){
				$this.closest("tr").remove();
				alertify.error("Gear Removed");
			}
		}
	});
}
function get_assign_gear_by_id(id){
	$.ajax({
		url: '<?php echo URL;?>gear/get_assign_gear_by_id/',
		type: 'POST',
		dataType: 'JSON',
		data: {id: id},
		success: function(data){
			var row ='<tr>'
	 			+'<td class="id hidden">'+data[0]['id']+'</td>'
	 			+'<td class="station_id hidden">'+data[0]['station_id']+'</td>'
	 			+'<td class="station_name">'+data[0]['station_name']+'</td>'
	 			+'<td class="gear_id hidden">'+data[0]['gear_id']+'</td>'
	 			+'<td class="gear_code">'+data[0]['gear_code']+'</td>'
	 			+'<td class="track_id hidden">'+data[0]['track_id']+'</td>'
	 			+'<td class="track_name">'+data[0]['track_name']+'</td>'
	 			+'<td class="date_of_install">'+data[0]['date_of_install_ddmmyy']+'</td>'
	 			+'<td class="date_of_exp">'+data[0]['date_of_exp_ddmmyy']+'</td>'
	 			+'<td><button class="edit btn btn-info btn-xs">edit</button></td>'
	 			+'<td><button class="del btn btn-danger btn-xs">delete</button></td>'
	 			+'</tr>';
			$('#railway_assignedGear_list').prepend(row);
			$row = $('#railway_assignedGear_list tr').first();
			$class = 'alert alert-success';
			rowActive($row,$class);
		}		
	});
}
</script>