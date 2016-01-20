window.onload = function(){
	$('#ro').addClass('active');
	allClient();
	language();
	allAdd();
	
}

function comForm(){
	$('#com-div').toggle('200');
}


$('#language_id').on('change', function(){		
	if($(this).val() == 0){
		$('#languageModal').modal('show');
	}		
});


var token =  $("input[name=_token]").val();

function allClient(){
	$.ajax({
		url : '/deal/allclient',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#client_id').append('<option value="">Select</option>');
			for(var i in data){
				//select box
				$('#client_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}
	
		}

	});
}



$('#client_id').change(function() {
	var client_id = $(this).children('option:selected').val();
	
	$.ajax({
		url : '/advertise/brandbyclient',
		type : 'POST',
		data : {'client_id':client_id,'_token':token},
		datatype : 'JSON',
		success : function(data) {
			$('#brand_id').empty();
			$('#brand_id').append('<option value="">Select</option>');
			for(var i in data){
				//select box
				$('#brand_id').append('<option value="'+data[i].id+'">'+data[i].brand_name+'</option>');
			}
	
		}

	});
	
	
});

function language(){
	$.ajax({
		url : '/language/all',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#language_id').append('<option value="--">Select</option><option value="0" onchange="languageModal();"> + New</option>');
			for(var i in data){
				//select box
				$('#language_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}
	
		}

	});
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
				$('#language_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
				$('form#language-form').each(function() {this.reset();});
				$('#languageModal').modal('hide');
			}
			else{
				alertify.error('something went wrong!!');
			}
			
		}
	})
}

function saveAdd(){
	var formData = $('form#advertise-form').serializeArray();
	$('#cBtn').attr('disabled', true).html('PLEASE WAIT..');
	$.ajax({
		url : '/advertise/saveadd',
		type : 'POST',
		dataType : 'JSON',
		data : formData,
		success : function(data) {
			$('#cBtn').attr('disabled', false).html('Save');
			if(data!=0){
				alertify.success('saved');
				$('form#advertise-form').each(function() {this.reset();});
				allAdd();
			}
			else{
				alertify.error('something went wrong!!');
			}
			
		}
	})
}

 function allAdd(){
	$('#add-list').html('<tr><td colspan="6" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
	$.ajax({
		url : '/advertise/all',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#add-list').empty();
			var count = 0;
			for(var i in data){
				var add = '<tr>'
							+'<td class=" id"> AT'+pad(data[i].id,4)+'</td>'
							+'<td class="caption">'+data[i].caption+'</td>'
							+'<td class="duration">'+data[i].duration+'</td>'
							+'<td class="lang_name">'+data[i].lang_name+'</td>'
							+'<td class="client_name">'+data[i].client_name+'</td>'
							+'<td class="brand_name">'+data[i].brand_name+'</td>'
							
							+'<td class="brand_id hidden">'+data[i].brand_id+'</td>'
							+'<td class="client_id hidden">'+data[i].client_id+'</td>'
							+'<td class="lang_id hidden">'+data[i].lang_id+'</td>'
							
							+'<td><button class="edit btn btn-rounded btn-sm btn-icon btn-danger"><i class="fa fa-edit"></i></button></td>'
							+'</tr>';
				$('#add-list').append(add);
				
			}
			
		}
	});
}
 $("#add-list").on("click", ".edit", function() {
		var $edit = $(this);
		var id = $edit.closest("tr").find(".id").text();
		var caption = $edit.closest("tr").find(".caption").text();
		var lang_name = $edit.closest("tr").find(".lang_name").text();
		var duration = $edit.closest("tr").find(".duration").text();
		var client_name = $edit.closest("tr").find(".client_name").text();
		var brand_name = $edit.closest("tr").find(".brand_name").text();
		
		var brand_id = $edit.closest("tr").find(".brand_id").text();
		var client_id = $edit.closest("tr").find(".client_id").text();
		var lang_id = $edit.closest("tr").find(".lang_id").text();
		$('#com-div').show('200');
		
		
		var editID = id.substr(3);
		
		$('#editID').val(editID);
		$('#caption').val(caption);
		$('#duration').val(duration);
		$('#upBtn').show();
		$('#cBtn').hide();
		
		
		
		var client = new Option(client_name, client_id);
		$("#client_id").append(client);
		client.setAttribute("selected","selected");
		
		var language = new Option(lang_name, lang_id);
		$("#language_id").append(language);
		language.setAttribute("selected","selected");
		
		
		var brand = new Option(brand_name, brand_id);
		$("#brand_id").append(brand);
		brand.setAttribute("selected","selected");
		
	});
 
 
function update(){
	var formData = $('form#advertise-form').serializeArray();
	$('#upBtn').attr('disabled', true).html('Updating...');
	$.ajax({
		url : '/advertise/updateadd',
		type : 'POST',
		dataType : 'JSON',
		data : formData,
		success : function(data) {
			$('#upBtn').attr('disabled', false).html('Update');
			if(data!=0){
				alertify.success('saved');
				$('form#advertise-form').each(function() {this.reset();});
				
				$('#upBtn').hide();
				$('#cBtn').show();
				$('#com-div').hide('200');
				allAdd();
			}
			else{
				alertify.error('something went wrong!!');
			}
			
		}
	})
}

//table search js
$("#search").keyup(function () {
    var value = this.value.toLowerCase().trim();

    $("table tr").each(function (index) {
        if (!index) return;
        $(this).find("td").each(function () {
            var id = $(this).text().toLowerCase().trim();
            var not_found = (id.indexOf(value) == -1);
            $(this).closest('tr').toggle(!not_found);
            return not_found;
        });
    });
});
 
