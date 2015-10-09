<aside class="right-side">                
    <section class="content-header">
      	<h1>Schedule Master</h1>
      	<ol class="breadcrumb"></ol>
    </section>
    <section class="content">
    	<div class="row pagemenu">
    		<div class="col-md-8 col-xs-12">
    			<input type="text" class="form-control" id="search_gears" placeholder="Search">	
    		</div>
    		<div class="col-md-4 col-xs-12">
    			<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#createGearModal"><i class="fa fa-plus"></i> New Schedule</button>
    		</div>
    	</div>
        <div class="row">
			<div class="col-md-12">
				<div class="box box-danger">
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th rowspan="2">Schedule Code</th>
									<th rowspan="2">Type</th>
									<th colspan="2" class="text-center">Maintanence Periodicity</th>
									<th rowspan="2" style="width: 45%;">Maintanence Description</th>
									<th rowspan="2" style="width: 5%;">Edit</th>									
								</tr>
								<tr>
									<th>SS</th>
									<th>I/C</th>
								</tr>
							</thead>
							<tbody id="railway_gears_list"></tbody>
						</table>
					</div>
				</div>	
			</div>
		</div>
    </section>
</aside>

<!-- Add User Modal -->
<div class="modal fade" id="createGearModal" tabindex="-1" role="dialog" aria-labelledby="createGearModalLabel" data-backdrop="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="createGearModalLabel">Add New Schedule Code</h3>
      </div>
      <div class="modal-body">
        <div class="row" id="add_gear_row">
        	<form action="" id="add_gear_form">
	        	<div class="col-md-12">
	        		<label>Code</label>
	        		<input class="form-control upcase" type="text" name="code" placeholder="">	        		
	        		<label>Gear Type</label>
	        		<select class="form-control" name="gear_type_id" id="gear_type_id"></select>	        		
	        		<label>Periodicity</label>&nbsp;<small class="text-muted">Sectional DSMG</small>
	        		<select class="form-control" name="periodicity_level_1">
	        			<option value="0">Select Periodicity</option>
		        		<option value="14">Fortnightly</option>
		        		<option value="30">Monthly</option>
		        		<option value="90">Quarterly</option>
		        		<option value="182">Half Yearly</option>
		        		<option value="365">Yearly</option>
		        		<option value="730">2 Yearly</option>
		        		<option value="1095">3 Yearly</option>
		        	</select>
	        		<label>Periodicity</label>&nbsp;<small class="text-muted">Incharge SSE/SE</small>
	        		<select class="form-control" name="periodicity_level_2">
	        			<option value="0">Select Periodicity</option>
		        		<option value="14">Fortnightly</option>
		        		<option value="30">Monthly</option>
		        		<option value="90">Quarterly</option>
		        		<option value="182">Half Yearly</option>
		        		<option value="365">Yearly</option>
		        		<option value="730">2 Yearly</option>
		        		<option value="1095">3 Yearly</option>
		        	</select>
		        	<label>Remarks</label>
		        	<textarea rows="1" class="form-control" name="remarks" placeholder="(if any)"></textarea>
	        	</div>
        	</form>
        </div>
		<div class="modal-footer">
        	<button class="btn btn-primary btn-block" id="create_gear_btn" onclick="create_gear();">Save</button>
       </div>
      </div>
    </div>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editGearModal" tabindex="-1" role="dialog" aria-labelledby="editGearModalLabel" data-backdrop="false" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title" id="editGearModalLabel">Edit Schedule Code</h3>
      </div>
      <div class="modal-body">
        <div class="row">
        	<form action="" id="edit_gear_form">
	        	<div class="col-md-12">
	        		<input type="hidden" name="id" id="edit_id">
	        		<label>Code</label>
	        		<input class="form-control upcase" type="text" name="code" id="edit_code">	        		
	        		<label>Gear Type</label>
	        		<select class="form-control" name="gear_type_id" id="edit_gear_type_id"></select>	
	        		<label>Periodicity level 1</label>
	        		<select class="form-control" name="periodicity_level_1" id="edit_periodicity_level_1">
	        			<option value="0">Select Periodicity</option>
		        		<option value="14">Fortnightly</option>
		        		<option value="30">Monthly</option>
		        		<option value="90">Quarterly</option>
		        		<option value="182">Half Yearly</option>
		        		<option value="365">Yearly</option>
		        		<option value="730">2 Yearly</option>
		        		<option value="1095">3 Yearly</option>
		        	</select>
	        		<label>Periodicity level 2</label>
	        		<select class="form-control" name="periodicity_level_2" id="edit_periodicity_level_2">
	        			<option value="0">Select Periodicity</option>
		        		<option value="14">Fortnightly</option>
		        		<option value="30">Monthly</option>
		        		<option value="90">Quarterly</option>
		        		<option value="182">Half Yearly</option>
		        		<option value="365">Yearly</option>
		        		<option value="730">2 Yearly</option>
		        		<option value="1095">3 Yearly</option>
		        	</select>
		        	<label>Remarks</label>
		        	<textarea rows="5" class="form-control" name="remarks" id="edit_remarks"></textarea>
	        	</div>	        	
        	</form>
        </div>
		<div class="modal-footer">
        	<button class="btn btn-primary btn-block" id="updateGearDetailsBtn" onclick="updateGearDetails();">Update</button>
       </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(' #setting_li ,  #schedule_master_li').addClass('active');
$('#setting_sub_ul').css('display', 'block');
window.onload = function(){
	get_all_schedule_code();
	get_all_gear_type();
};



function get_all_gear_type(){
	$.ajax({
		url: '<?php echo URL;?>settings/get_all_gear_type/',
		type: 'POST',
		dataType: 'JSON',
		success: function(data){
			$('#gear_type_id, #edit_gear_type_id').empty().append('<option value="0">Select Type</option>');
			for(var i in data){
			  $('#gear_type_id, #edit_gear_type_id').append('<option value="'+data[i].id+'">'+data[i].code+'</option>');
			}
		}	
	});
}
function get_all_schedule_code(){
	$('#railway_gears_list').html('<tr><td colspan="9" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
	$.ajax({
		url: '<?php echo URL;?>settings/get_all_schedule_code/',
		type: 'POST',
		datatype: 'JSON',
		success: function(data){
			$('#railway_gears_list').empty();
			for (var i  in  data){
				var row ='<tr>'
		 			+'<td class="id hidden">'+data[i].id+'</td>'
		 			+'<td class="gear_type_id hidden">'+data[i].gear_type_id+'</td>'
		 			+'<td class="code">'+data[i].code+'</td>'
		 			+'<td class="type_code">'+data[i].type_code+'</td>'
		 			+'<td class="periodicity_level_1 hidden">'+data[i].periodicity_level_1+'</td>'
		 			+'<td class="periodicity_level_2 hidden">'+data[i].periodicity_level_2+'</td>'
		 			+'<td class="periodicity_level_1_name">'+periodicity_type(data[i].periodicity_level_1)+'</td>'
		 			+'<td class="periodicity_level_2__name">'+periodicity_type(data[i].periodicity_level_2)+'</td>'
		 			+'<td class="remarks ">'+data[i].remarks+'</td>'
		 			+'<td><button class="edit btn btn-info btn-xs">edit</button></td>'
		 			+'</tr>';
				$('#railway_gears_list').append(row);
			}
		}
	});
}
function create_gear(){
	var formData = $('form#add_gear_form').serializeArray();
	//$('#create_gear_btn').attr('disabled',true).html('<i class="fa fa-spinner fa-spin"></i>');
	$.ajax({
		url: '<?php echo URL;?>settings/create_gear/',
		type: 'POST',
		dataTtype: 'JSON',
		data: formData,
		success: function(data){
			if(data == 0){
				alertify.error("Already Exist");
				$('form#add_gear_form').each(function(){this.reset();});
				$('#create_gear_btn').attr('disabled',false).html('Add');
				$('#createGearModal').modal('hide');
			}
			else{
				var row ='<tr>'
		 			+'<td class="id hidden">'+data['id']+'</td>'
		 			+'<td class="gear_type_id hidden">'+data['gear_type_id']+'</td>'
		 			+'<td class="code">'+data['code']+'</td>'
		 			+'<td class="type_code">'+$('#gear_type_id option:selected').text()+'</td>'
		 			+'<td class="periodicity_level_1">'+periodicity_type(data['periodicity_level_1'])+'</td>'
		 			+'<td class="periodicity_level_2">'+periodicity_type(data['periodicity_level_2'])+'</td>'
		 			+'<td><button class="edit btn btn-info btn-xs">edit</button></td>'
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
		}			
	});
}

//edit
var $edit = 0;
$("#railway_gears_list").on("click", ".edit", function(){
	$edit = $(this);
	var id = $edit.closest("tr").find(".id").text();
	var gear_type_id = $edit.closest("tr").find(".gear_type_id").text();	
	var code = $edit.closest("tr").find(".code").text();	
	var periodicity_level_1 = $edit.closest("tr").find(".periodicity_level_1").text();
	var periodicity_level_2 = $edit.closest("tr").find(".periodicity_level_2").text();
	var remarks = $edit.closest("tr").find(".remarks").text();

	$edit.html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
	$('#edit_id').val(id);
	$('#edit_code').val(code);
	$('#edit_gear_type_id').val(gear_type_id);
	$('#edit_periodicity_level_1').val(periodicity_level_1);
	$('#edit_periodicity_level_2').val(periodicity_level_2);
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
				if(data == 0){
					alertify.error("Dupilicate Error");					
					$('#updateGearDetailsBtn').attr('disabled',false).html('Update');
					$('form#edit_gear_form').each(function(){this.reset();});
					$('#editGearModal').modal('hide');
				}
				else{
					$edit.closest("tr").find(".code").text($('#edit_code').val());
					$edit.closest("tr").find(".name").text($('#edit_name').val());
					$edit.closest("tr").find(".periodicity_level_1").text($('#edit_periodicity_level_1').val());
					$edit.closest("tr").find(".periodicity_level_2").text($('#edit_periodicity_level_2').val());
					//$edit.closest("tr").find(".type").text($('#edit_type').val());
					$edit.closest("tr").find(".maintainance_steps").text($('#edit_maintainance_steps').val());
					$edit.closest("tr").find(".remarks").text($('#edit_remarks').val());
					$('#editGearModal').modal('hide');
					$('#updateGearDetailsBtn').attr('disabled',false).html('Update');
					$('form#edit_gear_form').each(function(){this.reset();});
					$row = $edit.closest("tr");
					$class = 'alert alert-success';
					rowActive($row,$class);
				}
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

function periodicity_type(days){
	var days = parseInt(days);
	var periodicity ='';
	switch (days) {
    case 14:
        periodicity = "Fortnightly";
        break;
    case 30:
        periodicity = "Monthly";
        break;
    case 90:
        periodicity = "Quarterly";
        break;
    case 182:
        periodicity = "Half Yearly";
        break;
    case 365:
        periodicity = "Yearly";
        break; 
    case 730:
        periodicity = "2 Yearly";
        break;
    case 1095:
        periodicity = "3 Yearly";
        break;     
    default :
    	periodicity = " ";
    	break;
	}
	return periodicity;
}

</script>