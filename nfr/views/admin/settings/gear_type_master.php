<aside class="right-side">                
    <section class="content-header">
      	<h1>Gear Type Master</h1>
    </section>
    <section class="content">
    	<div class="row pagemenu">
    		<span id="add_gear_span">   
    			<div class="col-md-3 col-xs-12">
    				<input type="text" class="form-control" id="code" placeholder="Gear Code">
    			</div>
    			<div class="col-md-6 col-xs-12">	
    				<input type="text" class="form-control" id="name" placeholder="Gear Name">
    			</div>
    			<div class="col-md-3 col-xs-12">
	    			<button type="button" class="btn btn-primary btn-block pull-right" id="save_gear_type_btn" onclick="save_gear_type();">Save</button>
	    		</div>
    		</span>
    		<span id="clear_field">
	    		<div class="col-md-12 col-xs-12">
		    		<button type="button" class="btn btn-primary pull-right" onclick="$('#add_gear_span').show();$('#clear_field').hide();">Add Gear Type <i class="fa fa-plus"></i></button>
		    	</div>
	    	</span>
    	</div>
        <div class="row">              	
        	<div class="col-md-12">
        		<div class="box box-danger">
        			<table class="table table-hover table-bordered" id="gear_type_table">
        				<thead>
        					<tr>
        						<th style="width: 10%;">#</th>
        						<th style="width: 30%;">Gear Code</th>
        						<th style="width: 60%;">Gear Name</th>
        					</tr>
        				</thead>
        				<tbody></tbody>
        			</table>
        		</div>
        	</div>  	
        </div>
    </section>
</aside>    
<script type="text/javascript">
$(' #setting_li , #gear_type_master_li').addClass('active');
$('#setting_sub_ul').css('display', 'block');
window.onload = function() {
	get_all_gear_type();
};
function get_all_gear_type(){
	$.ajax({
		url: '<?php echo URL;?>settings/get_all_gear_type/',
		type: 'POST',
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
			url: '<?php echo URL;?>settings/save_gear_type/',
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
	
	
</script>