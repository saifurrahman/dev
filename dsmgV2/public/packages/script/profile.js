window.onload = function() {
	//getUserProfile();
}
// get profle details
function getUserProfile() {
	$.ajax({
		url : '/profile/userprofile',
		type : 'GET',
		dataType : 'JSON',
		success : function(data) {
			for ( var i in data) {
					$('#user_id').val(data[i].id);
				$('#name').val(data[i].name);
				$('#email').val(data[i].email);
				$('#mobile').val(data[i].mobile);
				$('#designation').val(data[i].designation);
			}
		}
	});
}
function updateProfile() {
	var formData = $('form#profile-form').serializeArray();
	var name = $('#name').val();
	var mobile = $('#mobile').val();
	var email = $('#email').val();
		var designation = $('#designation').val();

	if (name != 0 & mobile != 0 & email != 0) {
		$('#proBtn').attr('disabled', true).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
		$.ajax({
			url : '/profile/update',
			type : 'POST',
			dataType : 'JSON',
			data : formData,
			success : function(data) {
				$('#proBtn').attr('disabled', false).html('Update');
				alertify.success('successfully updated profile');
			}
		});
	} else {
		alertify.error('something went wrong');
	}
}

function changePassword() {
	var formData = $('form#changePassword-form').serializeArray();
	var password = $('#password').val();
	var confirm = $('#confirm_password').val();
	if (password != 0 & confirm != 0 & password == confirm) {
		$('#pBtn').attr('disabled', true).html('<i class="fa fa-circle-o-notch fa-spin"></i>');
		$.ajax({
			url : '/common/changedpassword',
			type : 'POST',
			dataType : 'JSON',
			data : formData,
			success : function(data) {
				$('#pBtn').attr('disabled', false).html('Change');
				$('form#password-form').each(function() {
					this.reset();
				});
				alertify.success('Password successfully changed');
			}
		});
	} else {
		alertify.error('password did not match');
	}
}
