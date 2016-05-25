window.onload = function(){
	$('#schedule_entry').addClass('active');
	$('#maintenance_date').datepicker({dateFormat: 'dd-mm-yy', maxDate: "+0D"});
	$("#maintenance_date").datepicker("setDate", new Date());
	var maintenance_date = $('#maintenance_date').val();
	gearmaintenececommon();
	getMaintanaceLedgerOn(maintenance_date);

}
var token =  $("input[name=_token]").val();

function gearmaintenececommon(){

	$.ajax({
		url: '/gear/gearmaintenececommon',
		type: 'GET',
		datatype: 'JSON',
		success: function(result){

				var data =	result['stations'];
				for (var i in data){
					$('#station_id').append('<option value="'+data[i].id+'">'+data[i].code+'</option>');
				}
				data =	result['gear_type'];
				$('#gear_code').append('<option value="">Select</option>');
				for(var i in data){
					$('#gear_code').append('<option value="'+data[i].id+'">'+data[i].code+'</option>');
				}

				data =	result['designation'];
				$('#designation').append('<option value="NA">--NA--</option>');
				for(var i in data){
					$('#designation').append('<option value="'+data[i].name+'">'+data[i].name+'</option>');
				}
				data =	result['supervisor'];
				$('#maintenance_by').append('<option value="NA">--NA--</option>');
	 			for(var i in data){
					$('#maintenance_by').append('<option value="'+data[i].name+'">'+data[i].name+'</option>');
				}
		}
	});
}

function migrateData(){

	$.ajax({
		url: '/common/migrate',
		type: 'GET',
		datatype: 'JSON',
		success: function(data){
				console.log(data);
		}
	});
}




$('#maintenance_date').change(function(){
		 var maintenance_date = $('#maintenance_date').val();
		 //alert(maintenance_date);
		 //$('#schedule-form').reset();

		 getMaintanaceLedgerOn(maintenance_date);

});

$("#station_id").on("change", function () {
 var station_id = $('#station_id').val();
 var gear_code = $('#gear_code').val();

 loadStationGears(station_id,gear_code);
 //loadStationSupervisors(station_id);

});


//onselect gear code function

 $("#gear_code").on("change", function () {
	var station_id = $('#station_id').val();
	var gear_code = $('#gear_code').val();
	$('#station_gear_id,#schedule_code_id').empty();
	loadStationGears(station_id,gear_code);

 });


function loadStationGears(station_id,gear_code){

	//$("#station_gear_id").html().empty()
	//document.getElementById('station_gear_id').innerHTML = "";
	$('#schedule_code_id').empty();
	$.ajax({
		url: '/common/stationgear',
		type: 'POST',
		data: {'station_id':station_id, 'gear_code':gear_code,'_token':token},
		dataTtype: 'JSON',
		success: function(data){
			$('#station_gear_div').empty().append('<select multiple class="form-control" id="station_gear_id" name="station_gear_id[]">[]"></select>');
			for(var i in data['gear_no']){
			//	console.log(data['gear_no'][i].gear_no);
				$('#station_gear_id').append('<option value="'+data['gear_no'][i].id+'">'+data['gear_no'][i].gear_no+'</option>');
			}
			for (var j in data['sch_code']){
				$('#schedule_code_id').append('<option value="'+data['sch_code'][j].id+'" data-level1="'+data['sch_code'][j].periodicity_level_1+'" data-level2="'+data['sch_code'][j].periodicity_level_2+'" >'+data['sch_code'][j].code+'</option>');
			}
		}
	}).promise().done(function(data) {
		      	$select_station_id = $('#station_gear_id').selectize({
        	maxItems: null,
					valueField: 'id',
					labelField: 'gear_no',
					searchField: 'gear_no',
					//options: data.gear_no,
					create: false
        });
    });
}

 //save form data

 function saveData(){
 	var formData = $('form#schedule-form').serializeArray();
 	var m_date = $('#maintenance_date').val();
 	var gear_code = $('#gear_code').val();
 	var station_id = $('#station_id').val();
	var periodicity_level_1= $("#schedule_code_id option:selected").data("level1");
	var periodicity_level_2=$("#schedule_code_id option:selected").data("level2");
	formData.push({name:'periodicity_level_1', value: periodicity_level_1});
	formData.push({name:'periodicity_level_2', value: periodicity_level_2});
	$('#saveBtn').attr('disabled',true).html('<i class="fa fa-spinner fa-spin"></i>');

		 $.ajax({
			url:'/schedule/savedata',
			type: 'POST',
			datatype: 'JSON',
			data: formData,
			success: function(data){

				$('#saveBtn').attr('disabled',false).html('save');
				if(data!=0){
					alertify.success('data saved successfully');
					//$('form#schedule-form').each(function(){this.reset()});
					$("#maintenance_date").datepicker("setDate", m_date);
					getMaintanaceLedgerOn(m_date);
				}
				else{
					alertify.error('Not able to save ');
				}
			}
		});

	}

 function getMaintanaceLedgerOn(maintenance_date){
	$('#data-list').html('<tr><td colspan="10"><center><i class="fa fa-spinner fa-spin fa-3x"></i></center></td></tr>')
 	$.ajax({
 	 url:'/schedule/maintanaceledger',
 	 type: 'POST',
	 data: {'maintenance_date':maintenance_date,'_token':token},
 	 datatype: 'JSON',
 	 success: function(data){
 		$('#data-list').empty();
 		 for (var i in data){
			 var next_date_row;
			 if(moment(data[i].next_maintenance_date).isAfter(new Date().getTime())){
					next_date_row='<td>'+moment(data[i].next_maintenance_date).format('DD/MM/YY')+'</td>';
			 }else{
				 next_date_row='<td class="text text-danger">'+moment(data[i].next_maintenance_date).format('DD/MM/YY')+'</td>';

			 }
			var row = '<tr>'
					+'<td class="hidden id">'+data[i].id+'</td>'
					+'<td>'+data[i].station+'</td>'
					+'<td>'+data[i].gear_type+'</td>'
					+'<td>'+data[i].gear_no+'</td>'
					+'<td>'+data[i].schedule_code+'/'+data[i].role+'</td>'
					+ next_date_row
					+'<td>'+data[i].discontinuation_status+'</td>'
					+'<td>'+data[i].maintenance_by+'</td>'
					+'<td>'+data[i].designation+'</td>'
					+'<td>'+data[i].remarks+'</td>'
					+'<td><button class="del btn btn-rounded btn-sm btn-icon btn-danger"><i class="fa fa-trash"></i></button></td>'
					+'</tr>';
			$('#data-list').append(row);
 	 	}
 	 }
  });
}


//delete data
$("#data-list").on("click", ".del", function(){
	$deleting = $(this);
	var id = $deleting.closest("tr").find(".id").text();
	alertify.confirm('Please confirm your delete!').set('onok', function(closeEvent){
				$deleting.html('&nbsp;&nbsp;<i class="fa fa-spinner fa-spin fa-lg"></i>&nbsp;&nbsp;');
				delete_data(id);
	});
});
function delete_data(id){
	$.ajax({
	url: '/schedule/deletedata/'+id,
		type: 'GET',
		datatype: 'JSON',
		success: function(data){
			if(data == 1){
				$deleting.closest("tr").remove();
				alertify.error("Data Deleted");
			}
		}
	});
}
$("#excel").click(function() {
	//alert(1);
	$("#data-list").table2excel({
		exclude : ".noExl",
		name : "Coommercial Schedule"
	});
});
