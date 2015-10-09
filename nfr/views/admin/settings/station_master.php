<aside class="right-side">                
    <section class="content-header">
      	<h1>Stations</h1>
      	<ol class="breadcrumb"></ol>
    </section>
    <section class="content">    	
    	<div class="row pagemenu">
    		
    		<div class="col-md-8 col-xs-12">
    			<input type="text" class="form-control" id="search_station" placeholder="Search">	
    		</div>
    		<div class="col-md-4 col-xs-12">
    			<button class="btn btn-success pull-right" data-toggle="modal" data-target="#AddStationModal"><i class="fa fa-plus"></i> add station</button>
    		</div>
    	</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-danger">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Station Name</th>
								<th>District Name</th>
								<th>Station Code</th>
								<th style="width: 5%;">Edit</th>
								<th style="width: 5%;">Delete</th>
							</tr>
						</thead>
						<tbody id="railway_stations_list"></tbody>
					</table>
				</div>	
			</div>
		</div>
    </section>
</aside> 
<!-- Add Station Model-->
<div class="modal fade" id="AddStationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="AddStationModalLabel">Add stations</h3>
      </div>
      <div class="modal-body">
        <form role="form" id="add_station_form" action="" method="post">
        	<label>Station Name</label>
        	<input type="text" class="form-control input-lg" id="name" name="name" required="required" placeholder="">
        	<label>Select District</label>
        	<select class="form-control input-lg" id="district_id" name="district_id"></select>
        	<label>Statio Code</label>
        	<input type="text" class="form-control input-lg upcase" name="code" required="required" placeholder="">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="add_station_btn" onclick="createStation();">Save</button>
      </div>
    </div>
  </div>
</div>
<!-- edit station -->
<div class="modal fade" id="editStationModal" tabindex="-1" role="dialog" aria-labelledby="editStationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header cm-modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="editStationModalLabel">Edit  station</h3>
      </div>
      <div class="modal-body row">
	      <form role="form" id="edit_station_form" class="form-horizontal">
	      	<div class="col-md-12">
	      		<input id="edit_station_id" type="hidden" name="station_id"> 
	      		<label>Name </label>
		  		<input id="edit_name" class="form-control input-lg" type="text" name="name" required="required">
		  		<label>select distric</label>
		  		<select class="form-control input-lg" id="edit_district_id" name="district_id"></select>
			    <label>Code </label>
			    <input id="edit_code" class="form-control input-lg upcase" type="text" name="code" required="required">
		  	</div>
		</form>
      </div>
      <div class="modal-footer cm-modal-footer">
      	<span class="pull-left"></span>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="updateStationDetails_btn" onclick="updateStationDetails();">Update</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$('#setting_li,#station_master_li').addClass('active');
$('#setting_sub_ul').css('display', 'block');
var district_list=[];
window.onload = function(){
	get_all_stations();
	get_all_districts();
};
function get_all_districts(){
	var districts = localStorage.getItem('district_list');
    if (districts == null || districts == '') {
    	$.ajax({
    		url: '<?php echo URL;?>user_service/get_all_districts/',
    		type: 'POST',
    		datatype: 'JSON',
    		success: function(data){
				district_list=data;
				localStorage.setItem('district_list', JSON.stringify(data));
    		}
    	});
    } 
    else{
    	district_list = JSON.parse(districts);
    }
    $('#district_id').append('<option></option>');
	for(var i in district_list){
		  $('#district_id, #edit_district_id').append('<option value="'+district_list[i].id+'">'+district_list[i].name+'</option>');
	}
}
function get_all_stations(){
	$('#railway_stations_list').html('<tr><td colspan="6" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
	$.ajax({
		url: '<?php echo URL;?>settings/getAllStations/',
		type: 'POST',
		datatype: 'JSON',
		success: function(data){
			$('#railway_stations_list').empty();
			for (var i in data){
				var row ='<tr>'
		 			+'<td class="id hidden">'+data[i].id+'</td>'
		 			+'<td class="name">'+data[i].name+'</td>'
		 			+'<td class="district_id hidden">'+data[i].district_id+'</td>'
		 			+'<td class="district_name">'+data[i].district_name+'</td>'
		 			+'<td class="code">'+data[i].code+'</td>'
		 			+'<td><button class="edit btn btn-info btn-xs">edit</button></td>'
		 			+'<td><button class="del btn btn-danger btn-xs">delete</button></td>'
		 			+'</tr>';
				$('#railway_stations_list').append(row);
			}
		}
	});
}
//create
function createStation(){
	var formData = $('form#add_station_form').serializeArray();
	$('#add_station_btn').attr('disabled',true).html('<i class="fa fa-spinner fa-spin"></i>');
	 $.ajax({
		url: '<?php echo URL;?>settings/createStation/',
		type: 'POST',
		dataTtype: 'JSON',
		data: formData,
		success: function(data){
			$('#add_station_btn').attr('disabled',false).html('Add');
			var row ='<tr>'
	 			+'<td class="id hidden">'+data['id']+'</td>'
	 			+'<td class="name">'+data['name']+'</td>'
	 			+'<td class="district_id hidden">'+data['district_id']+'</td>'
	 			+'<td class="district_name">'+$("#district_id option:selected" ).text()+'</td>'
	 			+'<td class="code">'+data['code']+'</td>'
	 			+'<td><button class="edit btn btn-info btn-xs">edit</button></td>'
	 			+'<td><button class="del btn btn-danger btn-xs">delete</button></td>'
	 			+'</tr>';
			$('#railway_stations_list').prepend(row);
			$('form#add_station_form').each(function(){this.reset()});
			//$('#AddStationModal').modal('hide');
			alertify.success("Added Successfully");
			$row = $('#railway_stations_list tr').first();
			$class = 'alert alert-success';
			rowActive($row,$class);
		}			
	});
}
//edit
var $editing = 0;
$("#railway_stations_list").on("click", ".edit", function(){
	$editing = $(this);
	var station_id = $editing.closest("tr").find(".id").text();
	var name = $editing.closest("tr").find(".name").text();
	var district_id = $editing.closest("tr").find(".district_id").text();
	var code = $editing.closest("tr").find(".code").text();
	
	$('#edit_station_id').val(station_id);
	$('#edit_name').val(name);
	$('#edit_district_id').val(district_id);
	$('#edit_code').val(code);
	$('#editStationModal').modal('show');
	$editing.html('&nbsp;<i class="fa fa-spinner fa-spin fa-lg"></i>&nbsp;');
});
//update station details
function updateStationDetails(){
	var formData = $('form#edit_station_form').serializeArray();
	$('#updateStationDetails_btn').attr('disabled',true).html('<i class="fa fa-refresh fa-spin"></i>');
	$.ajax({
		url: '<?php echo URL?>settings/update_station_details/',
 		type: 'POST',
		dataType: 'JSON',
		data: formData,
		success: function(data){
			$editing.closest("tr").find(".name").text(formData[1]['value']);
			$editing.closest("tr").find(".district_id").text(formData[2]['value']);
			$editing.closest("tr").find(".district_name").text($("#edit_district_id option:selected" ).text());
			$editing.closest("tr").find(".code").text(formData[3]['value']);
			$('#editStationModal').modal('hide');
			$('#updateStationDetails_btn').attr('disabled',false).html('Update');
			$('form#edit_station_form').each(function(){this.reset()});
			//alertify.success("Updated Successfully");
			$row = $editing.closest("tr");$class = 'alert alert-success';
			rowActive($row,$class);
		}
	});
}
$('#editStationModal').on('hidden.bs.modal', function (e){
	$editing.html('edit');
	$editing = 0;
});
//delete stations
$("#railway_stations_list").on("click", ".del", function(){
	$deleting = $(this);
	var station_id = $deleting.closest("tr").find(".id").text();
	$deleting.html('&nbsp;&nbsp;<i class="fa fa-spinner fa-spin fa-lg"></i>&nbsp;&nbsp;');
	delete_station(station_id);
});
function delete_station(station_id){
	$.ajax({
		url: '<?php echo URL; ?>settings/delete_station/',
		type: 'POST',
		dataType: 'JSON',
		data: {'station_id': station_id},
		success: function(data){
			if(data == 1){
				$deleting.closest("tr").remove();
				alertify.error("Station Removed");
			}
		}
	});
}
$('#search_station').keyup(function() {
	var regex = new RegExp($('#search_station').val(), "i");
	var rows = $('table tbody#railway_stations_list tr:gt(0)');
	rows.each(function (index) {
		title = $(this).children(".name, .code").html();
		if (title.search(regex) != -1) {
			$(this).show();
		} 
		else {
		    $(this).hide();
		}
	});
});
</script>