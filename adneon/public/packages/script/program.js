window.onload = function(){
	$('#program').addClass('active');
	allProgram();
	audience();
	language();
	category();
}

function showForm(){
	$('#pform-div').toggle('200');
}
var token = $("input[name=_token]").val();

function addProgram(){
	var formData = $('form#program-form').serializeArray(); 
	$('#saveBtn').attr('disabled', true).html('PLEASE WAIT..');
	
	$.ajax({
		url : '/program/program',
		type : 'POST',
		dataType : 'JSON',
		data : formData,
		success : function(data) {
			$('#saveBtn').attr('disabled', false).html('submit');
			if(data!=0){
				$('form#program-form').each(function() {
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

function category(){
	$.ajax({
		url : '/category/all',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#category_id').append('<option value="">Select</option><option value="0"> + New</option>');
			for(var i in data){
				//select box
				$('#category_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}
	
		}

	}).done(function() {
		$('#category_id').selectize({
			onChange : function(value){
				if(value){
					var data = this.options[value];	
					if(data['value'] == 0){
						$('#categoryModal').modal('show');
					}
				}
				}
		});
		
	});
}
function audience(){
	$.ajax({
		url : '/audience/all',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#audience_id').append('<option value="">Select</option><option value="0"> + New</option>');
			for(var i in data){
				//select box
				$('#audience_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}
	
		}

	}).done(function() {
		$('#audience_id').selectize({
			onChange : function(value){
				if(value){
					var data = this.options[value];	
					if(data['value'] == 0){
						$('#audienceModal').modal('show');
					}
				}
				}
		});
		
	});
}
function language(){
	$.ajax({
		url : '/language/all',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#language_id').append('<option value="">Select</option><option value="0" onchange="languageModal();"> + New</option>');
			for(var i in data){
				//select box
				$('#language_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}
	
		}

	}).done(function() {
		$('#language_id').selectize({
			onChange : function(value){
				if(value){
					var data = this.options[value];	
					if(data['value'] == 0){
						$('#languageModal').modal('show');
					}
				}
				
			}
			
		});
		
	});
}


////save to master data
function saveAudience(){
	var formData = $('form#audience-form').serializeArray();
	$('#aBtn').attr('disabled', true).html('PLEASE WAIT..');
	$.ajax({
		url : '/audience/audience',
		type : 'POST',
		dataType : 'JSON',
		data : formData,
		success : function(data) {
			$('#aBtn').attr('disabled', false).html('Save');
			if(data!=0){
				alertify.success('saved');
				$('form#audience-form').each(function() {this.reset();});
				$('#audienceModal').modal('hide');
			}
			else{
				alertify.error('something went wrong!!');
			}
			
		}
	})
}
function saveLanguage(){
	var formData = $('form#language-form').serializeArray();
	$('#lBtn').attr('disabled', true).html('PLEASE WAIT..');
	$.ajax({
		url : '/language/language',
		type : 'POST',
		dataType : 'JSON',
		data : formData,
		success : function(data) {
			$('#lBtn').attr('disabled', false).html('Save');
			if(data!=0){
				alertify.success('saved');
				$('form#language-form').each(function() {this.reset();});
				$('#languageModal').modal('hide');
			}
			else{
				alertify.error('something went wrong!!');
			}
			
		}
	})
}
function saveCategory(){
	var formData = $('form#category-form').serializeArray();
	$('#cBtn').attr('disabled', true).html('PLEASE WAIT..');
	$.ajax({
		url : '/category/category',
		type : 'POST',
		dataType : 'JSON',
		data : formData,
		success : function(data) {
			$('#cBtn').attr('disabled', false).html('Save');
			if(data!=0){
				alertify.success('saved');
				$('form#category-form').each(function() {this.reset();});
				$('#categoryModal').modal('hide');
			}
			else{
				alertify.error('something went wrong!!');
			}
			
		}
	})
}


//all program on a table
function allProgram(){
	$('#program-list').html('<tr><td colspan="6" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
	$.ajax({
		url : '/program/all',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#program-list').empty();
			var count = 0;
			for(var i in data){
				count = count+1;
				var program = '<tr>'
								//+'<td class="hidden">'+data[i].id+'</td>'
								+'<td class="count">'+count+'</td>'
								+'<td class="pr_id hidden">'+data[i].pr_id+'</td>'
								+'<td class="pr_name">'+data[i].pr_name+'</td>'
								+'<td class="c_name">'+data[i].c_name+'</td>'
								+'<td class="classification">'+data[i].classification+'</td>'
								+'<td class="a_name">'+data[i].a_name+'</td>'
								+'<td class="l_name">'+data[i].l_name+'</td>'
								+'<td><button class="del btn btn-rounded btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></button></td>'
								+'</tr>';
				
				$('#program-list').append(program);			
			}
		}
	});
}
//// delete program
$("#program-list").on("click", ".del", function() {
	var $del = $(this);
	var id = $del.closest("tr").find(".pr_id").text();
	var name = $del.closest("tr").find(".pr_name").text();
	alertify.confirm("Delete "+name+"?", function(e){
		if(e){
			deletePro($del, id);
		}
		});
});
function deletePro($del,id){
	$.ajax({
		url : '/program/delete',
		type : 'POST',
		dataType : 'JSON',
		data : {'id' : id,'_token':token},
		success : function(data) {
			$del.closest("tr").remove();
			alertify.error("Employee removed");
		}
	});
}



