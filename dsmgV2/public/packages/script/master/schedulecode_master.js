window.onload = function(){
	$('#code_master').addClass('active');
	get_all_schedule_code();
	get_all_gear_type();
};



function get_all_gear_type(){
	$.ajax({
		url: '/common/allgearcode/',
		type: 'GET',
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
		url: '/common/allschedulecode/',
		type: 'GET',
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
			url: '/common/updategeardetails/',
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
