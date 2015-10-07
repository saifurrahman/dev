window.onload = function(){
	$('#schedule').addClass('active');
	$('#days').selectize({
	    maxItems: 7
	});
	allSlot();
	allProgram();
	allschedulelog()
	
}

$("#end_date,#start_date").datepicker({
	dateFormat : 'yy-mm-dd',
});


function saveSchedule(){
	var formData = $('form#schedule-form').serializeArray(); 
	$('#saveBtn').attr('disabled', true).html('PLEASE WAIT..');
	
	$.ajax({
		url : '/program/scheduleprogram',
		type : 'POST',
		dataType : 'JSON',
		data : formData,
		success : function(data) {
			$('#saveBtn').attr('disabled', false).html('submit');
			if(data!=0){
				$('form#schedule-form').each(function() {
					this.reset();
				});
				alertify.success('saved successfully');
			}
			else{
				alertify.error('something went wrong!!');
			}
		}
	});
}
function allSlot(){
	$.ajax({
		url : '/schedule/allslot',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#time_slot_id').append('<option value="">Select</option>');
			for(var i in data){
				//select box
				$('#time_slot_id').append('<option value="'+data[i].id+'">'+data[i].time_slot+'</option>');
			}
	
		}

	}).done(function() {
		$('#time_slot_id').selectize()
	});;
}
function allProgram(){
	$.ajax({
		url : '/schedule/allprogram',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#program_id').append('<option value="">Select</option>');
			for(var i in data){
				//select box
				$('#program_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}
	
		}

	}).done(function() {
		$('#program_id').selectize()
	});;
	
}
 function saveSchedule(){
	var formData = $('form#schedule-form').serializeArray(); 
	$('#saveBtn').attr('disabled', true).html('PLEASE WAIT..');
	
	$.ajax({
		url : '/schedule/schedule',
		type : 'POST',
		dataType : 'JSON',
		data : formData,
		success : function(data) {
			$('#saveBtn').attr('disabled', false).html('submit');
				$('form#schedule-form').each(function() {
					this.reset();
				});
				alertify.success('saved successfully');
		}
	});
}
 
 function allschedulelog(){
	 $('#log-list').html('<tr><td colspan="6" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
		$.ajax({
			url : '/schedule/alllog',
			type : 'GET',
			datatype : 'JSON',
			success : function(data) {
				$('#log-list').empty();
				var status ;
				for(var i in data){
					if(data[i].repeat == 1){
						 status = 'Yes'
					}
					else{
						status = 'no'
					}
					
					
					var program = '<tr>'
									//+'<td class="hidden">'+data[i].id+'</td>'
									+'<td class="timeslot">'+data[i].time_slot+'</td>'
									+'<td class="name">'+data[i].name+'</td>'
									+'<td class="days">'+data[i].days+'</td>'
									+'<td class="duration">'+moment(data[i].start_date).format('ll')+'&nbsp;-&nbsp;'+moment(data[i].end_date).format('ll')+'</td>'
									+'<td class="repeat">'+status+'</td>'
									+'</tr>';
					
					$('#log-list').append(program);			
				}
			}
		});
 }
