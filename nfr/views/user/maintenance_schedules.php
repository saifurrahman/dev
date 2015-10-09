<aside class="right-side">                
   	<!-- Content Header (Page header) -->
    <section class="content-header">
      	<h1>Maintenance Schedules</h1>
      	<ol class="breadcrumb">
      	</ol>
    </section>
    <section class="content">
        <div class="row">
        	<div class="col-md-4">
        		<select class="form-control" id="station_id">
        		</select>
        	</div>
        	<div class="col-md-8">
        		<input type="text" class="form-control" placeholder="Search">
        	</div>
        </div>
        <div class="row mbefore">
			<div class="col-md-12">
				<table class="table table-bordered">
					<h3>Today</h3>
					<thead>
						<tr>
							<th>Gear id</th>
							<th>Gear</th>
							<th>Station</th>
							<th>Track</th>
							<th>Due date</th>
							<th>Type</th>
							<th>Status</th>
							<th>Maintenance by</th>
						</tr>
					</thead>
					<tbody id="schedule_list_today"></tbody>
				</table>
				<hr>
				<table class="table table-bordered">
					<h3>Over Due</h3>
					<thead>
						<tr>
							<th>Gear id</th>
							<th>Gear</th>
							<th>Station</th>
							<th>Track</th>
							<th>Due date</th>
							<th>Type</th>
							<th>Status</th>
							<th>Maintenance by</th>
						</tr>
					</thead>
					<tbody id="schedule_list_over_due"></tbody>
				</table>
				<hr>
				<table class="table table-bordered">
					<h3>Next 30 days</h3>
					<thead>
						<tr>
							<th>Gear id</th>
							<th>Gear</th>
							<th>Station</th>
							<th>Track</th>
							<th>Due date</th>
							<th>Type</th>
							<th>Status</th>
							<th>Maintenance by</th>
						</tr>
					</thead>
					<tbody id="schedule_list_rest"></tbody>
				</table>
			</div>
		</div>
    </section>
</aside>  
<!-- doneModal -->
<div class="modal fade" id="doneModal" tabindex="-1" role="dialog" aria-labelledby="doneModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="doneModal">Maintenance</h4>
      </div>
      <div class="modal-body">
	      <form id="maintenance_done_form">
	      	<input type="hidden" name="id" id="id">
	      	<input type="hidden" name="station_gear_id" id="station_gear_id">
	      	<input type="hidden" name="type" id="type">
	      	<input type="hidden" name="maintenance_date" id="maintenance_date">
	      	<input type="hidden" name="gear_id" id="gear_id">
	      	<label>Done By</label>
	      	<select class="form-control" name="maintenance_by" id="user_list"></select>
	      	<label>Remark</label>
	      	<textarea rows="3" cols="" class="form-control" name="remarks" id="remarks" placeholder="if any"></textarea>
	      </form>	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="confirm_maintenance_btn" onclick="confirm_maintenance();">Confirm</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$('#maintenance_schedules_li').addClass('active');
window.onload = function() {
	get_all_stations();
	get_all_users();
	get_maintenance_schedules();
};
function get_all_stations(){
	$.ajax({
		url: '<?php echo URL;?>settings/getAllStations/',
		type: 'POST',
		dataType: 'JSON',
		success: function(data){
			$('#station_id').empty();
			$('#station_id').append('<option value="0" selected="selected" disabled="disabled">Select Station</option>');
			for(var i in data){
			  $('#station_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}
		}	
	});
}
function get_all_users(){
	$.ajax({
		url: '<?php echo URL;?>settings/getAllUsers/',
		type: 'POST',
		dataType: 'JSON',
		success: function(data){
			$('#user_list').empty();
			$('#user_list').append('<option value="0" selected="selected" disabled="disabled">Select Station</option>');
			for(var i in data){
			  $('#user_list').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}
		}	
	});
}
function get_maintenance_schedules(){
	$('#schedule_list_today').html('<i class="fa-li fa fa-spinner fa-spin fa-2x mcenter"></i>');
	$.ajax({
		url: '<?php echo URL;?>gear/get_maintenance_schedules/',
		type: 'POST',
		dataType: 'JSON',
		success: function(data){
			var today = getToday();
			$('#schedule_list_today, #schedule_list_rest').empty();
			for (var i  in  data){
				var status = 0;
				if(data[i].status == "done"){
					status = '<td class="status"><button class="btn btn-success btn-xs" disabled="disabled">Done</button></td>';
				}
				if(data[i].status == "pending"){
					status = '<td class="status"><button class="pending btn btn-warning btn-xs">Pending</button></td>';	
				}
				var row ='<tr>'
					+'<td class="id hidden">'+data[i].id+'</td>'
		 			+'<td class="gear_id hidden">'+data[i].gear_id+'</td>'
		 			+'<td class="station_gear_id hidden">'+data[i].station_gear_id+'</td>'
		 			+'<td class="">GID_'+data[i].station_gear_id+'</td>'
		 			+'<td class="gear_code">'+data[i].gear_code+'</td>'
		 			+'<td class="track_name">'+data[i].track_name+'</td>'
		 			+'<td class="station_name">'+data[i].station_name+'</td>'
		 			+'<td class="maintenance_date">'+readable_date(data[i].maintenance_date)+'</td>'
		 			+'<td class="type">'+data[i].type+'</td>'
		 			+status
		 			+'<td class="maintenance_by">'+data[i].maintenance_by+'</td>'
		 			+'</tr>';
		 		if(data[i].maintenance_date == today){
		 			$('#schedule_list_today').append(row);
			 	}else  if(data[i].maintenance_date<today){
		 			if(data[i].status == "pending"){
		 				$('#schedule_list_over_due').append(row);
		 			}
			 	}
		 		else{
		 			if(data[i].status == "pending"){
		 				$('#schedule_list_rest').append(row);
				 	}
			 	}	
			}
		}
	});
}

//adhoc maintanence
var $done = 0; 
$("#schedule_list_today,#schedule_list_over_due, #schedule_list_rest").on("click", ".pending", function(){
	$done = $(this);
	var id = $done.closest("tr").find(".id").text();
	var station_gear_id = $done.closest("tr").find(".station_gear_id").text();
	var type = $done.closest("tr").find(".type").text();
	var maintenance_date = getToday();
	var gear_id = $done.closest("tr").find(".gear_id").text();	

	$('#id').val(id);
	$('#station_gear_id').val(station_gear_id);
	$('#type').val(type);
	$('#maintenance_date').val(maintenance_date);
	$('#gear_id').val(gear_id);
    $('#doneModal').modal('show');
});

function confirm_maintenance(){
	var formData = $('form#maintenance_done_form').serializeArray();
	$('#confirm_maintenance_btn').attr('disabled',true).html('<i class="fa fa-refresh fa-spin"></i>');
	$.ajax({
		url: '<?php echo URL;?>gear/confirm_maintenance/',
		type: 'POST',
		dataType: 'JSON',
		data: formData,
		success: function(data){
			$('#doneModal').modal('hide');
			$('#confirm_maintenance_btn').attr('disabled',false).html('Update');
			$('form#maintenance_done_form').each(function(){this.reset();});
			$row = $done.closest("tr");
			$class = 'alert alert-success';
			rowActive($row,$class);
			$done.closest("td").html('<button class="btn btn-success btn-xs" disabled="disabled">Done</button>');
			$done = 0;
		}	
	});
}
</script>