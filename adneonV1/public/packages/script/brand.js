window.onload = function(){
	$('#brand').addClass('active');
	allClient();
	category();
	allBrand();
}

var token = $("input[name=_token]").val();


function allClient(){
	$.ajax({
		url : '/deal/allclient',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#client_id').empty().append('<option value="">Select Client</option>');
			for(var i in data){
				//select box
				$('#client_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}

		}

	}).done(function() {
		$('#client_id').selectize();
	});
}

$('#saveBtn').on("click", function() {
  saveBrand();
  return false;
});
$('#category_id').on('change', function(){
	if($(this).val() == 0){
		$('#categoryModal').modal('show');
	}
});

//all category
function category(){
	$.ajax({
		url : '/category/all',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#category_id').append('<option value="1">Select Catagory</option><option value="0"> + New</option>');
			for(var i in data){
				//select box
				$('#category_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}
		}
	}).done(function() {
		$('#category_id').selectize()
	});
}
function saveCategory(){
	var formData = $('form#category-form').serializeArray();

	var name = $('#cat_name').val();

	if(name != 0 || name !=''){
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
					$('#category_id').append('<option value="'+data['id']+'">'+data['name']+'</option>');
				}
				else{
					alertify.error('something went wrong!!');
				}

			}
		})
	}
	else{
		alertify.error('please enter category name');
	}

}
/*category end*/


function saveBrand(){
	//var formData = $('form#brand-form').serializeArray();
	$('#saveBtn').attr('disabled', true).html('PLEASE WAIT..');
	var client_id=$('#client_id').val();
	var category_id=$('#category_id').val();
	var brand_name=$('#brand_name').val();
	if(brand_name!='' || brand_name!=null || client_id!='' || client_id!=0 ){
		$.ajax({
			url : '/brand/save',
			type : 'POST',
			dataType : 'JSON',
			data : {'_token':token,'client_id':client_id,'category_id':category_id,'brand_name':brand_name},
			success : function(data) {
				$('#saveBtn').attr('disabled', false).html('submit');
				if(data!=0){
					$('form#brand-form').each(function() {
						this.reset();
					});
					alertify.success('saved successfully');
					allBrand();
				}
				else{
					alertify.error('something went wrong!!');
				}
			}
		});
	}else{
		alertify.error('Please required fileds!');
	}

	return false;
}

function allBrand(){
	$('#brand-list').html('<tr><td colspan="4" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
	$.ajax({
		url : '/brand/all',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#brand-list').empty();
			var count = 0;
			for(var i in data){
				count = count+1;
				var deal = '<tr>'
							+'<td>'+count+'</td>'
							+'<td class="brand_name">'+data[i].brand_name+'</td>'
							+'<td class="cat_name">'+data[i].category+'</td>'
							+'<td class="client_name">'+data[i].name+'</td>'
							+'</tr>';
				$('#brand-list').append(deal);

			}

		}
	});
}

////edit brand
$("#brand-list").on("click", ".edit", function() {
	var $edit = $(this);
	var id = $edit.closest("tr").find(".id").text();
	var brand_name = $edit.closest("tr").find(".brand_name").text();
	var cat_name = $edit.closest("tr").find(".cat_name").text();
	var client_name = $edit.closest("tr").find(".client_name").text();

	var client_id = $edit.closest("tr").find(".client_id").text();
	var cat_id = $edit.closest("tr").find(".cat_id").text();

	$('#saveBtn').hide();
	$('#upBtn').show();


	$('#editID').val(id);
	$('#brand_name').val(brand_name);

	var client = new Option(client_name, client_id);
	$("#client_id").append(client);
	client.setAttribute("selected","selected");

	var category = new Option(cat_name, cat_id);
	$("#category_id").append(category);
	category.setAttribute("selected","selected");

});

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
