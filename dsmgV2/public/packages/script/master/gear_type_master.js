window.onload = function() {
	$('#gear_type').addClass('active');
	get_all_gear_type();
};
function get_all_gear_type(){
	$.ajax({
		url: '/common/allgearcode/',
		type: 'GET',
		dataTtype: 'JSON',
		success: function(data){
			for(var i in data){
				$('#gear_type_table tbody').append('<tr><td>'+data[i]['id']+'</td><td>'+data[i]['code']+'</td><td>'+data[i]['name']+'</td></tr>');
			}
		}
	});
}

function save_gear_type(){
	var code = $('#code').val();
	var name = $('#name').val();
	if(code.length != 0 && name.length != 0){
		$('#save_gear_type_btn').attr('disabled',true).html('Save');
		$.ajax({
			url: '/common/save_gear_type/',
			type: 'POST',
			dataTtype: 'JSON',
			data: {'code':code,'name':name},
			success: function(data){
				$('#code').val('');
				$('#name').val('');
				alertify.success("Assigned Successfully");
				$('#save_gear_type_btn').attr('disabled',false).html('Save');
				$('#add_gear_span').hide();$('#clear_field').show();
				$('#gear_type_table tbody').append('<tr><td>'+data['id']+'</td><td>'+data['code']+'</td><td>'+data['name']+'</td></tr>');
			}
		});
	}
	else{
		alertify.error('Fill the form correctly');
	}
}
