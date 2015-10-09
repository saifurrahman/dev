<aside class="right-side">                
   	<!-- Content Header (Page header) -->
    <section class="content-header">
      	<h1>Maintenance Roster</h1>
      	<ol class="breadcrumb">
      	</ol>
    </section>
    <section class="content">
        <div class="row pagemenu hidden-print">
        	<div class="col-md-3">        	
        		<select id="select_station_id" name="station_id[]" multiple class="form-control" placeholder="Select Station"></select>
        	</div>
        	<div class="col-md-3">
        		<select class="form-control" id="role_id"></select>
        	</div>
        	<div class="col-md-3">
        		<input type="text" class="form-control" id="search_date"placeholder="Date">
        	</div>
        	<div class="col-md-3">
        		<button class="btn btn-default pull-left hidden-print" onclick="search_maintenance_schedules();">Search</button>
        		<button class="btn btn-default pull-right hidden-print" onclick="print_table();">Print</button>
        	</div>
        </div>
        <div class="row mbefore">
	        <div class="col-md-12">
	            <div class="nav-tabs-custom">
	                <ul class="nav nav-tabs pull-left" id="maintenance_schedules_tabs">	                    
	                    <li class="active" onclick="get_maintenance_schedules();"><a href="#tab_next_30_day" data-toggle="tab">Schedules</a></li>
	                    <li><a href="#tab_overdue" data-toggle="tab">Overdue <span id="overdue_count"></span></a></li>
	                </ul>	                
	                <div class="tab-content">
	                    <div class="tab-pane active" id="tab_next_30_day">
	                        <div class="table-responsive">
								<table class="table table-bordered" id="table_next_30_day">
									<thead>
										<tr>
											<th>Station</th>
											<th>Gear No</th>
											<th>Schedule Code</th>																					
											<th>Role</th>
											<th>Maintenance Due Date</th>																					
											<th style="width:5%;">Maintenance</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>	                       
	                    </div><!-- /.tab-pane -->
	                    <div class="tab-pane" id="tab_overdue">
	                        <div class="table-responsive">
								<table class="table table-bordered" id="table_tab_overdue">
									<thead>
										<tr>
											<th>Station</th>
											<th>Gear No</th>
											<th>Schedule Code</th>																					
											<th>Role</th>
											<th>Maintenance Due Date</th>																					
											<th style="width:5%;">Maintenance</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>	                       
	                    </div><!-- /.tab-pane -->
	                </div><!-- /.tab-content -->
	            </div><!-- nav-tabs-custom -->
	        </div>
		</div>
    </section>
</aside>  

<!-- Modal -->
<div class="modal fade" id="maintenanceModal" tabindex="-1" role="dialog" aria-labelledby="maintenanceModalLabel" aria-hidden="false" data-backdrop="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="maintenanceModalLabel">Maintenance</h4>
      </div>
      <div class="modal-body">      
			<form role="form" id="maintenance_form">
			  <input type="hidden" id="edit_maintenance_schedule_id" name="maintenance_schedule_id"> 
			  <input type="hidden" id="edit_station_gear_id" name="station_gear_id"> 			  
			  <input type="hidden" id="edit_schedule_code_id" name="schedule_code_id"> 			  
			  <input type="hidden" id="edit_role_id" name="role_id"> 			  
			  <input type="hidden" id="edit_periodicity_level_1" name="periodicity_level_1"> 
			  <input type="hidden" id="edit_periodicity_level_2" name="periodicity_level_2">
			  <input type="hidden" name="status" value="done">

			  <div class="form-group">
			    <label>Maintenance By</label>
			    <select class="form-control" id="user_list" name="maintenance_by"></select>
			  </div>
			  <div class="form-group">
			    <label>Maintenance Date</label>
			    <input type="text" class="form-control" id="maintenance_date" name="maintenance_date">
			  </div>
			  <div class="form-group">
			  	<div class="clearfix">
			  		<span class="pull-left"><label>Remark</label></span>	
			  	</div>		    
			    <input type="text" class="form-control" id="remarks" name="remarks">
			  </div>		  
			  <div class="form-group">
			  	<button type="button" class="btn btn-primary btn-block" id="save_maintenance_btn" onclick="save_maintenance();">Save</button>
			  </div>
			</form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$('#maintenance_schedules_li').addClass('active');
$('#search_date').datepicker({dateFormat: 'dd-mm-yy'});
$('#maintenance_date').datepicker({dateFormat: 'dd-mm-yy', maxDate: "+0D"});
$("#maintenance_date").datepicker("setDate", new Date());
var $select_station_id;
window.onload = function() {
	get_all_stations();
	get_all_role();
	get_all_users();
	get_maintenance_schedules();	
};
$(function() {
	$( "#progress_slider" ).slider({
	  range: "min",
	  value: 0,
	  min: 0,
	  max: 100,
	  slide: function( event, ui ) {
	  	$("#input_amount_progress_slider").val(ui.value);
	    $("#amount_progress_slider").text(ui.value);
	  }
	});
});

function get_all_stations(){
	$.ajax({
		url: '<?php echo URL;?>settings/getAllStations/',
		type: 'POST',
		dataType: 'JSON',
		success: function(data){
			$('#station_id').empty();
			for(var i in data){
			  $('#station_id').append('<option value="'+data[i].id+'">'+data[i].code+'</option>');
			}
		}	
	}).promise().done(function(data) {
        $select_station_id = $('#select_station_id').selectize({
        	maxItems: null,valueField: 'id',labelField: 'code',searchField: 'code',options: data,create: false
        });
    });
}
function get_all_role(){
	$.ajax({
		url: '<?php echo URL;?>settings/get_all_role/',
		type: 'POST',
		dataType: 'JSON',
		success: function(data){
			$('#role_id').empty();
			var session_role = <?php echo Session::get('role_id');?>;
			if(session_role == 3){$('#role_id').append('<option value="0">All Roles</option>');}
			for(var i in data){			  
			  if(session_role == 1 && data[i].id == 1){
				  $('#role_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			  }
			  if(session_role == 2 && data[i].id == 2){
				  $('#role_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			  }
			  if(session_role == 3){
				  $('#role_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			  }
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
			for(var i in data){
			  $('#user_list').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}
		}
	}).promise().done(function() {
		var user_id = '<?php echo Session::get("user_id"); ?>';
		$('#user_list').val(user_id)
	});
}
function get_maintenance_schedules(){
	$.ajax({
		url: '<?php echo URL;?>gear/get_maintenance_schedules/',
		type: 'POST',
		dataType: 'JSON',
		success: function(data){
			$('#tab_next_30_day tbody, #tab_overdue tbody').empty();
			for(var i in data['next_30_days']){
		 		var row ='<tr>'
		 			+'<td class="id hidden">'+data['next_30_days'][i].id+'</td>'
		 			+'<td class="station_gear_id hidden">'+data['next_30_days'][i].station_gear_id+'</td>'
		 			+'<td class="schedule_code_id hidden">'+data['next_30_days'][i].schedule_code_id+'</td>'
		 			+'<td class="periodicity_level_1 hidden">'+data['next_30_days'][i].periodicity_level_1+'</td>'
		 			+'<td class="periodicity_level_2 hidden">'+data['next_30_days'][i].periodicity_level_2+'</td>'	
		 			+'<td class="role_id hidden">'+data['next_30_days'][i].role_id+'</td>'
		 			+'<td class="station_code">'+data['next_30_days'][i].station_code+'</td>'
		 			+'<td class="gear_no">'+data['next_30_days'][i].gear_code+'-'+data['next_30_days'][i].gear_no+'</td>'
		 			+'<td class="schedule_code">'+data['next_30_days'][i].schedule_code+'</td>'
		 			+'<td class="role_name">'+data['next_30_days'][i].role_name+'</td>'
		 			+'<td class="maintenance_date hidden">'+data['next_30_days'][i].maintenance_date+'</td>'	
		 			+'<td class="preety_maintenance_date">'+data['next_30_days'][i].preety_maintenance_date+'</td>'
		 			+'<td><button class="action btn btn-info btn-xs">Maintenance</button></td>'				 			
		 			+'</tr>';		 				 						
				$('#tab_next_30_day tbody').append(row);
			}	
			for(var i in data['overdue']){
		 		var row ='<tr>'
		 			+'<td class="id hidden">'+data['overdue'][i].id+'</td>'
		 			+'<td class="station_gear_id hidden">'+data['overdue'][i].station_gear_id+'</td>'
		 			+'<td class="schedule_code_id hidden">'+data['overdue'][i].schedule_code_id+'</td>'
		 			+'<td class="periodicity_level_1 hidden">'+data['overdue'][i].periodicity_level_1+'</td>'
		 			+'<td class="periodicity_level_2 hidden">'+data['overdue'][i].periodicity_level_2+'</td>'	
		 			+'<td class="role_id hidden">'+data['overdue'][i].role_id+'</td>'
		 			+'<td class="station_code">'+data['overdue'][i].station_code+'</td>'
		 			+'<td class="gear_no">'+data['overdue'][i].gear_code+'-'+data['overdue'][i].gear_no+'</td>'
		 			+'<td class="schedule_code">'+data['overdue'][i].schedule_code+'</td>'
		 			+'<td class="role_name">'+data['overdue'][i].role_name+'</td>'
		 			+'<td class="maintenance_date hidden">'+data['overdue'][i].maintenance_date+'</td>'	
		 			+'<td class="preety_maintenance_date">'+data['overdue'][i].preety_maintenance_date+'</td>'
		 			+'<td><button class="action btn btn-info btn-xs">Maintenance</button></td>'				 			
		 			+'</tr>';		 				 						
				$('#tab_overdue tbody').append(row);
			}			
		 }
	}).promise().done(function() {
		var overdue_count = $('#table_tab_overdue tbody tr').length;
		$('#overdue_count').html('<span class="label label-danger">'+overdue_count+'</span>');
	});
}

//Maintenance
var $action ='';
$("table tbody").on("click", ".action", function() {
	$action = $(this);
	
	var id = $action.closest("tr").find(".id").text();
	var station_gear_id = $action.closest("tr").find(".station_gear_id").text();
	var schedule_code_id = $action.closest("tr").find(".schedule_code_id").text();
	var role_id = $action.closest("tr").find(".role_id").text(); 
	var periodicity_level_1 = $action.closest("tr").find(".periodicity_level_1").text();
	var periodicity_level_2 = $action.closest("tr").find(".periodicity_level_2").text();

	$('#edit_maintenance_schedule_id').val(id);
	$('#edit_role_id').val(role_id);
	$('#edit_station_gear_id').val(station_gear_id);
	$('#edit_schedule_code_id').val(schedule_code_id);
	$('#edit_periodicity_level_1').val(periodicity_level_1);
	$('#edit_periodicity_level_2').val(periodicity_level_2);
	$('#maintenanceModal').modal('show');
});
$(".maintenance_status").on("change", function() {
	if(this.value == 'done'){
		$("#progress_slider" ).slider({value: 100});
	    $("#amount_progress_slider").text(100);
	}
	else{
		var previous_progress = $("#input_amount_progress_slider").val();
		$("#progress_slider" ).slider({value: previous_progress});
	    $("#amount_progress_slider").text(previous_progress);
	}
});

function save_maintenance(){
	var formData = $('#maintenance_form').serializeArray();
		$('#save_maintenance_btn').attr('disabled',true).html('Saving...');
		var user = $('#user_list').val();
		if(user != null){
			$.ajax({
				url: '<?php echo URL;?>gear/save_maintenance/',
				type: 'POST',
				dataType: 'JSON',
				data: formData,
				success: function(data){
					var id = $('#edit_maintenance_schedule_id').val();
					$('form#maintenance_form').each(function(){this.reset();});
					$("#maintenance_date").datepicker("setDate", new Date());
					alertify.success("Maintenance Successfull");
					$('#save_maintenance_btn').attr('disabled',false).html('Save');
					$('#maintenanceModal').modal('hide');						
					if(data == 1){
						remove_row(id);
					}
					$action ='';
				}	
			});			
		}
		else{
			alertify.error("Select Maintenance By");
			$('#save_maintenance_btn').attr('disabled',false).html('Save');
		}
	}

function remove_row(id){
	var $tb = $("#table_next_30_day tbody td.id.hidden, #tab_overdue tbody td.id.hidden");
	$tb.filter(function() {
      return $(this).text() == id;
 	}).parent().remove();
}

function search_maintenance_schedules(){
	var station_ids = $('#select_station_id').val();
	var role_id = $('#role_id').val();
	var search_date = $('#search_date').val();
	$.ajax({
		url: '<?php echo URL;?>gear/search_maintenance_schedules/',
		type: 'POST',
		dataType: 'JSON',
		data: {'station_ids':station_ids, 'role_id':role_id, 'search_date':search_date},
		success: function(data){
			$('#tab_next_30_day tbody').empty();
			if(data['next_30_days'].length != 0){
				for(var i in data['next_30_days']){
			 		var row ='<tr>'
			 			+'<td class="id hidden">'+data['next_30_days'][i].id+'</td>'
			 			+'<td class="station_gear_id hidden">'+data['next_30_days'][i].station_gear_id+'</td>'
			 			+'<td class="schedule_code_id hidden">'+data['next_30_days'][i].schedule_code_id+'</td>'
			 			+'<td class="periodicity_level_1 hidden">'+data['next_30_days'][i].periodicity_level_1+'</td>'
			 			+'<td class="periodicity_level_2 hidden">'+data['next_30_days'][i].periodicity_level_2+'</td>'	
			 			+'<td class="role_id hidden">'+data['next_30_days'][i].role_id+'</td>'
			 			+'<td class="station_code">'+data['next_30_days'][i].station_code+'</td>'
			 			+'<td class="gear_no">'+data['next_30_days'][i].gear_code+'-'+data['next_30_days'][i].gear_no+'</td>'
			 			+'<td class="schedule_code">'+data['next_30_days'][i].schedule_code+'</td>'
			 			+'<td class="role_name">'+data['next_30_days'][i].role_name+'</td>'
			 			+'<td class="maintenance_date hidden">'+data['next_30_days'][i].maintenance_date+'</td>'	
			 			+'<td class="preety_maintenance_date">'+data['next_30_days'][i].preety_maintenance_date+'</td>'
			 			+'<td><button class="action btn btn-info btn-xs">Maintenance</button></td>'				 			
			 			+'</tr>';		 				 						
					$('#tab_next_30_day tbody').append(row);
				}	
			}
			else{
				$('#tab_next_30_day tbody').append('<tr><td colspan="6" class="danger">No Schedule Found</td></tr>');
			}
		}		
	});	
}		
//search
/*
function search_maintenance_schedules(){
	var station_ids = $('#select_station_id').val();
	var role_id = $('#role_id').val();
	if(station_ids != null){
		$.ajax({
			url: '<?php echo URL;?>gear/search_maintenance_schedules/',
			type: 'POST',
			dataType: 'JSON',
			data: {'station_ids':station_ids, 'role_id':role_id},
			success: function(data){
			$('#table_today tbody, #table_next_7_day tbody, #table_next_15_day tbody, #table_next_30_day tbody, #table_tab_overdue tbody').empty();
			for (var i  in  data['today']){				
				var row ='<tr>'
					+'<td class="id hidden">'+data['today'][i].id+'</td>'
					+'<td class="station_gear_id hidden">'+data['today'][i].station_gear_id+'</td>'
					+'<td class="gear_id hidden">'+data['today'][i].gear_id+'</td>'
					+'<td class="periodicity_level_1 hidden">'+data['today'][i].periodicity_level_1+'</td>'
		 			+'<td class="periodicity_level_2 hidden">'+data['today'][i].periodicity_level_2+'</td>'
		 			+'<td class="gear_id hidden">'+data['today'][i].gear_id+'</td>'
		 			+'<td class="station_id hidden">'+data['today'][i].station_id+'</td>'
		 			+'<td class="role_id hidden">'+data['today'][i].role_id+'</td>'
		 			+'<td class="maintenance_date">'+data['today'][i].preety_maintenance_date+'</td>'
		 			+'<td class="station_code">'+data['today'][i].station_code+'</td>'
		 			+'<td class="gear_code">'+data['today'][i].gear_code+'</td>'		 			
		 			+'<td class="role_name">'+data['today'][i].role_name+'</td>'
		 			+'<td class="status">'+data['today'][i].status+'</td>'
		 			+'<td class="progress_value visible-print">'+data['today'][i].progress+'</td>'
		 			+'<td class="progress_bar hidden-print"><div class="progress xs"><div class="progress-bar progress-bar-green" style="width: '+data['today'][i].progress+'%;"></div></div></td>'
		 			+'<td><button class="action btn btn-info btn-xs">Maintenance</button></td>'
		 			+'</tr>';		 						
				$('#table_today tbody').append(row);
			}
			for (var i  in  data['next_7_days']){
				var row ='<tr>'
					+'<td class="id hidden">'+data['next_7_days'][i].id+'</td>'
					+'<td class="station_gear_id hidden">'+data['next_7_days'][i].station_gear_id+'</td>'
					+'<td class="gear_id hidden">'+data['next_7_days'][i].gear_id+'</td>'
					+'<td class="periodicity_level_1 hidden">'+data['next_7_days'][i].periodicity_level_1+'</td>'
		 			+'<td class="periodicity_level_2 hidden">'+data['next_7_days'][i].periodicity_level_2+'</td>'
		 			+'<td class="gear_id hidden">'+data['next_7_days'][i].gear_id+'</td>'
		 			+'<td class="station_id hidden">'+data['next_7_days'][i].station_id+'</td>'
		 			+'<td class="role_id hidden">'+data['next_7_days'][i].role_id+'</td>'
		 			+'<td class="maintenance_date">'+data['next_7_days'][i].preety_maintenance_date+'</td>'
		 			+'<td class="station_code">'+data['next_7_days'][i].station_code+'</td>'
		 			+'<td class="gear_code">'+data['next_7_days'][i].gear_code+'</td>'
		 			+'<td class="role_name">'+data['next_7_days'][i].role_name+'</td>'
		 			+'<td class="status">'+data['next_7_days'][i].status+'</td>'
		 			+'<td class="progress_value visible-print">'+data['next_7_days'][i].progress+'</td>'
		 			+'<td class="progress_bar hidden-print"><div class="progress xs"><div class="progress-bar progress-bar-green" style="width: '+data['next_7_days'][i].progress+'%;"></div></div></td>'
		 			+'<td><button class="action btn btn-info btn-xs">Maintenance</button></td>'
		 			+'</tr>';		 						
				$('#table_next_7_day tbody').append(row);
			}
			for (var i  in  data['next_15_days']){
				var row ='<tr>'
					+'<td class="id hidden">'+data['next_15_days'][i].id+'</td>'
					+'<td class="station_gear_id hidden">'+data['next_15_days'][i].station_gear_id+'</td>'
					+'<td class="gear_id hidden">'+data['next_15_days'][i].gear_id+'</td>'
					+'<td class="periodicity_level_1 hidden">'+data['next_15_days'][i].periodicity_level_1+'</td>'
		 			+'<td class="periodicity_level_2 hidden">'+data['next_15_days'][i].periodicity_level_2+'</td>'
		 			+'<td class="gear_id hidden">'+data['next_15_days'][i].gear_id+'</td>'
		 			+'<td class="station_id hidden">'+data['next_15_days'][i].station_id+'</td>'
		 			+'<td class="role_id hidden">'+data['next_15_days'][i].role_id+'</td>'
		 			+'<td class="maintenance_date">'+data['next_15_days'][i].preety_maintenance_date+'</td>'
		 			+'<td class="station_code">'+data['next_15_days'][i].station_code+'</td>'
		 			+'<td class="gear_code">'+data['next_15_days'][i].gear_code+'</td>'
		 			+'<td class="role_name">'+data['next_15_days'][i].role_name+'</td>'
		 			+'<td class="status">'+data['next_15_days'][i].status+'</td>'
		 			+'<td class="progress_value visible-print">'+data['next_15_days'][i].progress+'</td>'
		 			+'<td class="progress_bar hidden-print"><div class="progress xs"><div class="progress-bar progress-bar-green" style="width: '+data['next_15_days'][i].progress+'%;"></div></div></td>'
		 			+'<td><button class="action btn btn-info btn-xs">Maintenance</button></td>'
		 			+'</tr>';		 						
				$('#table_next_15_day tbody').append(row);
			}		
			for (var i  in  data['next_30_days']){				
		 		var row ='<tr>'
					+'<td class="id hidden">'+data['next_30_days'][i].id+'</td>'
					+'<td class="station_gear_id hidden">'+data['next_30_days'][i].station_gear_id+'</td>'
					+'<td class="gear_id hidden">'+data['next_30_days'][i].gear_id+'</td>'
					+'<td class="periodicity_level_1 hidden">'+data['next_30_days'][i].periodicity_level_1+'</td>'
		 			+'<td class="periodicity_level_2 hidden">'+data['next_30_days'][i].periodicity_level_2+'</td>'
		 			+'<td class="station_id hidden">'+data['next_30_days'][i].station_id+'</td>'
		 			+'<td class="role_id hidden">'+data['next_30_days'][i].role_id+'</td>'
		 			+'<td class="maintenance_date">'+data['next_30_days'][i].preety_maintenance_date+'</td>'
		 			+'<td class="station_code">'+data['next_30_days'][i].station_code+'</td>'
		 			+'<td class="gear_code">'+data['next_30_days'][i].gear_code+'</td>'
		 			+'<td class="role_name">'+data['next_30_days'][i].role_name+'</td>'
		 			+'<td class="status">'+data['next_30_days'][i].status+'</td>'
		 			+'<td class="progress_value visible-print">'+data['next_30_days'][i].progress+'</td>'		 			
		 			+'<td class="progress_bar hidden-print"><div class="progress xs"><div class="progress-bar progress-bar-green" style="width: '+data['next_30_days'][i].progress+'%;"></div></div></td>'
		 			+'<td><button class="action btn btn-info btn-xs">Maintenance</button></td>'
		 			+'</tr>';		 						
				$('#table_next_30_day tbody').append(row);
			}	
			for (var i  in  data['overdue']){
				var row ='<tr>'
					+'<td class="id hidden">'+data['overdue'][i].id+'</td>'
					+'<td class="station_gear_id hidden">'+data['overdue'][i].station_gear_id+'</td>'
					+'<td class="gear_id hidden">'+data['overdue'][i].gear_id+'</td>'
					+'<td class="periodicity_level_1 hidden">'+data['overdue'][i].periodicity_level_1+'</td>'
		 			+'<td class="periodicity_level_2 hidden">'+data['overdue'][i].periodicity_level_2+'</td>'
		 			+'<td class="station_id hidden">'+data['overdue'][i].station_id+'</td>'
		 			+'<td class="role_id hidden">'+data['overdue'][i].role_id+'</td>'
		 			+'<td class="maintenance_date">'+data['overdue'][i].preety_maintenance_date+'</td>'
		 			+'<td class="station_code">'+data['overdue'][i].station_code+'</td>'
		 			+'<td class="gear_code">'+data['overdue'][i].gear_code+'</td>'
		 			+'<td class="role_name">'+data['overdue'][i].role_name+'</td>'
		 			+'<td class="status">'+data['overdue'][i].status+'</td>'
		 			+'<td class="progress_value visible-print">'+data['overdue'][i].progress+'</td>'		 			
		 			+'<td class="progress_bar hidden-print"><div class="progress xs"><div class="progress-bar progress-bar-green" style="width: '+data['overdue'][i].progress+'%;"></div></div></td>'
		 			+'<td><button class="action btn btn-info btn-xs">Maintenance</button></td>'
		 			+'</tr>';		 						
				$('#table_tab_overdue tbody').append(row);
			}		
		}
		}).promise().done(function() {
			var overdue_count = $('#table_tab_overdue tbody tr').length;			
			$('#overdue_count').html('<span class="label label-danger">'+overdue_count+'</span>');
		});
	}	
	else{
		get_maintenance_schedules();
	}
}
*/
$("select#role_id").on("change", function() {
	if($(this).val()!= 0){
		$("table > tbody > tr").hide();
    	$("table > tbody > tr:contains('" + $("#role_id option:selected").text() + "')").show();
	}
	else{
		$("table > tbody > tr").show();
	}
});

$("select#station_id").on("change", function() {
	if($(this).val()!= 0){
		$("table > tbody > tr").hide();
    	$("table > tbody > tr:contains('" + $("#station_id option:selected").text() + "')").show();
	}
	else{
		$("table > tbody > tr").show();
	}
});

function print_table(){
	window.print();
}

</script>