<aside class="right-side">                
   	<!-- Content Header (Page header) -->
    <section class="content-header">
      	<h1>Gears</h1>
      	<ol class="breadcrumb">
			<li><button class="btn btn-success pull-right" data-toggle="modal" data-target="#createGearModal"><i class="fa fa-cogs"></i> add gear</button></li>
        </ol>
    </section>
    <section class="content">
    	<input type="text" class="form-control" id="search_gears" placeholder="Search">
        <div class="row">
			<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th rowspan="2">CODE</th>
							<th rowspan="2">NAME</th>
							<th colspan="2">MAINTANENCE PERIODICITY</th>
							<th rowspan="2">TYPE</th>
							<th rowspan="2">MAINTANENCE STEPS</th>
							<th rowspan="2">EDIT</th>
							<th rowspan="2">DELETE</th>
						</tr>
						<tr>
							<th>SECTIONAL DSMG</th>
							<th>INCHARGE SSE/SE</th>
						</tr>
					</thead>
					<tbody id="railway_gears_list"></tbody>
				</table>
			</div>	
			</div>
		</div>
    </section>
</aside>

<!-- Add User Modal -->
<div class="modal fade" id="createGearModal" tabindex="-1" role="dialog" aria-labelledby="createGearModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="createGearModalLabel">Add Gear</h3>
      </div>
      <div class="modal-body">
        <div class="row" id="add_gear_row">
        	<form action="" id="add_gear_form">
	        	<div class="col-md-4">
	        		<label>Name</label>
	        		<input class="form-control" type="text" name="name" placeholder="">
	        		<label>Code</label>
	        		<input class="form-control upcase" type="text" name="code" placeholder="">
	        		<label>Periodicity</label>&nbsp;<small class="text-muted">Sectional DSMG</small>
	        		<select class="form-control" name="periodicity_level_1">
	        			<option value="0">Select Periodicity</option>
		        		<option value="14">Fortnightly</option>
		        		<option value="30">Monthly</option>
		        		<option value="90">Quarterly</option>
		        		<option value="182">Half Yearly</option>
		        		<option value="365">Yearly</option>
		        	</select>
	        		<label>Periodicity</label>&nbsp;<small class="text-muted">Incharge SSE/SE</small>
	        		<select class="form-control" name="periodicity_level_2">
	        			<option value="0">Select Periodicity</option>
		        		<option value="14">Fortnightly</option>
		        		<option value="30">Monthly</option>
		        		<option value="90">Quarterly</option>
		        		<option value="182">Half Yearly</option>
		        		<option value="365">Yearly</option>
		        	</select>
	        	</div>
	        	<div class="col-md-4">
	        		<label>Type</label>
	        		<select class="form-control" name="type">
	        			<option value="0"></option>
		        		<option value="electrical">Electrical</option>
		        		<option value="mechanical">Mechanical</option>
		        	</select>
		        	<label>Remarks</label>
		        	<textarea rows="7" class="form-control" name="remarks" placeholder="(if any)"></textarea>
	        	</div>
	        	<div class="col-md-4">
					<label>Maintanence Steps</label>
		        	<textarea rows="10" class="form-control" name="maintainance_steps"></textarea>		        	
	        	</div>
        	</form>
        </div>
		<div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Calcel</button>
        	<button class="btn btn-primary" id="create_gear_btn" onclick="create_gear();">Save</button>
       </div>
      </div>
    </div>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editGearModal" tabindex="-1" role="dialog" aria-labelledby="editGearModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="editGearModalLabel">Edit Gear</h3>
      </div>
      <div class="modal-body">
        <div class="row">
        	<form action="" id="edit_gear_form">
	        	<div class="col-md-4">
	        		<input type="hidden" name="id" id="edit_id">
	        		<label>Name</label>
	        		<input class="form-control" type="text" name="name" id="edit_name">
	        		<label>Code</label>
	        		<input class="form-control upcase" type="text" name="code" id="edit_code">
	        		<label>Periodicity level 1</label>
	        		<select class="form-control" name="periodicity_level_1" id="edit_periodicity_level_1">
	        			<option value="0">Select Periodicity</option>
		        		<option value="14">Fortnightly</option>
		        		<option value="30">Monthly</option>
		        		<option value="90">Quarterly</option>
		        		<option value="182">Half Yearly</option>
		        		<option value="365">Yearly</option>
		        	</select>
	        		<label>Periodicity level 2</label>
	        		<select class="form-control" name="periodicity_level_2" id="edit_periodicity_level_2">
	        			<option value="0">Select Periodicity</option>
		        		<option value="14">Fortnightly</option>
		        		<option value="30">Monthly</option>
		        		<option value="90">Quarterly</option>
		        		<option value="182">Half Yearly</option>
		        		<option value="365">Yearly</option>
		        	</select>
	        	</div>
	        	<div class="col-md-4">
	        		<label>Type</label>
	        		<select class="form-control" name="type" id="edit_type">
	        			<option value="0"></option>
		        		<option value="electrical">Electrical</option>
		        		<option value="mechanical">Mechanical</option>
		        	</select>
		        	<label>Remarks</label>
		        	<textarea rows="7" class="form-control" name="remarks" id="edit_remarks"></textarea>
	        	</div>
	        	<div class="col-md-4">
					<label>Maintanence Steps</label>
		        	<textarea rows="10" class="form-control" name="maintainance_steps" id="edit_maintainance_steps"></textarea>		        	
	        	</div>
        	</form>
        </div>
		<div class="modal-footer">
        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        	<button class="btn btn-primary" id="updateGearDetailsBtn" onclick="updateGearDetails();">Update</button>
       </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="msModal" tabindex="-1" role="dialog" aria-labelledby="msModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header mafter">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="ion-ios7-close"></i></button>
        <h4 class="modal-title" id="msModalLabel"></h4>
      </div>
      <div class="modal-body mafter" id="msModalBody">
        
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$('#setting_li, #gear_master_li').addClass('active');
$('#setting_sub_ul').css('display', 'block');
window.onload = function(){
	getAllGears();
};
function create_gear(){
	var formData = $('form#add_gear_form').serializeArray();
	$('#create_gear_btn').attr('disabled',true).html('<i class="fa fa-spinner fa-spin"></i>');
	$.ajax({
		url: '<?php echo URL;?>settings/create_gear/',
		type: 'POST',
		dataTtype: 'JSON',
		data: formData,
		success: function(data){
			var row ='<tr>'
	 			+'<td class="id hidden">'+data['id']+'</td>'
	 			+'<td class="code">'+data['code']+'</td>'
	 			+'<td class="name">'+data['name']+'</td>'
	 			+'<td class="periodicity_level_1">'+data['periodicity_level_1']+'</td>'
	 			+'<td class="periodicity_level_2">'+data['periodicity_level_2']+'</td>'
	 			+'<td class="type">'+data['type']+'</td>'
	 			+'<td class="maintainance_steps">'+data['maintainance_steps']+'</td>'
	 			+'<td class="remarks">'+data['remarks']+'</td>'
	 			+'<td><button class="edit btn btn-info btn-xs">edit</button></td>'
	 			+'<td><button class="del btn btn-danger btn-xs">delete</button></td>'
	 			+'</tr>';
			$('#railway_gears_list').prepend(row);
			$('form#add_gear_form').each(function(){this.reset();});
			$('#create_gear_btn').attr('disabled',false).html('Add');
			alertify.success("Added Successfully");
			$('#createGearModal').modal('hide');
			$row = $('#railway_gears_list tr').first();
			$class = 'alert alert-success';
			rowActive($row,$class);
		}			
	});
}
function getAllGears(search_gears){
	$('#railway_gears_list').html('<tr><td colspan="9" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
	$.ajax({
		url: '<?php echo URL;?>settings/getAllGears/',
		type: 'POST',
		datatype: 'JSON',
		success: function(data){
			$('#railway_gears_list').empty();
			for (var i  in  data){
				var row ='<tr>'
		 			+'<td class="id hidden">'+data[i].id+'</td>'
		 			+'<td class="code">'+data[i].code+'</td>'
		 			+'<td class="name">'+data[i].name+'</td>'
		 			+'<td class="periodicity_level_1">'+data[i].periodicity_level_1+'</td>'
		 			+'<td class="periodicity_level_2">'+data[i].periodicity_level_2+'</td>'
		 			+'<td class="type">'+data[i].type+'</td>'
		 			+'<td class="maintainance_steps hidden">'+data[i].maintainance_steps+'</td>'
		 			+'<td><button class="viewms btn btn-default btn-xs">maintainance steps</button></td>'
		 			+'<td class="remarks hidden">'+data[i].remarks+'</td>'
		 			+'<td><button class="edit btn btn-info btn-xs">edit</button></td>'
		 			+'<td><button class="del btn btn-danger btn-xs">delete</button></td>'
		 			+'</tr>';
				$('#railway_gears_list').append(row);
			}
		}
	});
}
//view ms
var $viewms = 0;
$("#railway_gears_list").on("click", ".viewms", function() {
	$viewms = $(this);
	var code =  $viewms.closest("tr").find(".code").text();
    var name = $viewms.closest("tr").find(".name").text();
    var maintainance_steps = $viewms.closest("tr").find(".maintainance_steps").text();
    $viewms.html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
    $('#msModalLabel').text(name+' - '+code);
    $('#msModalBody').text(maintainance_steps);
    $('#msModal').modal('show');
});
$('#msModal').on('hidden.bs.modal', function (e){
	$viewms.html('maintainance steps');
	$('#msModalLabel').text('');
    $('#msModalBody').text('');
	$viewms = 0;
});
//edit
var $edit = 0;
$("#railway_gears_list").on("click", ".edit", function(){
	$edit = $(this);
	var id = $edit.closest("tr").find(".id").text();
	var code = $edit.closest("tr").find(".code").text();
	var name = $edit.closest("tr").find(".name").text();
	var periodicity_level_1 = $edit.closest("tr").find(".periodicity_level_1").text();
	var periodicity_level_2 = $edit.closest("tr").find(".periodicity_level_2").text();
	var type = $edit.closest("tr").find(".type").text();
	var maintainance_steps = $edit.closest("tr").find(".maintainance_steps").text();
	var remarks = $edit.closest("tr").find(".remarks").text();

	$edit.html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
	$('#edit_id').val(id);
	$('#edit_code').val(code);
	$('#edit_name').val(name);
	$('#edit_periodicity_level_1').val(periodicity_level_1);
	$('#edit_periodicity_level_2').val(periodicity_level_2);
	$('#edit_type').val(type);
	$('#edit_maintainance_steps').val(maintainance_steps);
	$('#edit_remarks').val(remarks);
	$('#editGearModal').modal('show');
});
//update gear details
function updateGearDetails(){
	var formData = $('form#edit_gear_form').serializeArray();
	$('#updateGearDetailsBtn').attr('disabled',true).html('<i class="fa fa-refresh fa-spin"></i>');
	$.ajax({
			url: '<?php echo URL?>settings/update_gear_details/',
			type: 'POST',
			dataType: 'JSON',
			data: formData,
			success: function(data){
				$edit.closest("tr").find(".code").text($('#edit_code').val());
				$edit.closest("tr").find(".name").text($('#edit_name').val());
				$edit.closest("tr").find(".periodicity_level_1").text($('#edit_periodicity_level_1').val());
				$edit.closest("tr").find(".periodicity_level_2").text($('#edit_periodicity_level_2').val());
				$edit.closest("tr").find(".type").text($('#edit_type').val());
				$edit.closest("tr").find(".maintainance_steps").text($('#edit_maintainance_steps').val());
				$edit.closest("tr").find(".remarks").text($('#edit_remarks').val());
				$('#editGearModal').modal('hide');
				$('#updateGearDetailsBtn').attr('disabled',false).html('Update');
				$('form#edit_gear_form').each(function(){this.reset();});
				$row = $edit.closest("tr");
				$class = 'alert alert-success';
				rowActive($row,$class);
			}
	});
}
$('#editGearModal').on('hidden.bs.modal', function (e){
	$edit.html('edit');
	$edit = 0;
});
//delete users
$("#railway_gears_list").on("click", ".del", function() {
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
	    url: '<?php echo URL; ?>settings/delete_gear/',
	    type: 'POST',
	    dataType: 'JSON',
	    data: {'gear_id': id},
	    success: function(data){
	    	if(data > 1){
				$this.closest("tr").remove();
				alertify.error("Gear Removed");
			}
		}
	});
}
//Quick Table Search
$('#search_gears').keyup(function() {
  var regex = new RegExp($('#search_gears').val(), "i");
  var rows = $('table tbody#railway_gears_list tr:gt(0)');
  rows.each(function (index) {
    title = $(this).children(".code, .name").html();
    if (title.search(regex) != -1) {
      $(this).show();
    } else {
      $(this).hide();
    }
  });
});
</script>