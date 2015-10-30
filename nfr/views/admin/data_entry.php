<aside class="right-side">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Maintenance Roster</h1>
		<ol class="breadcrumb">
		</ol>
	</section>
	<section class="content">
		<form class="form" id="data-form">
		<div class="row pagemenu">
			<div class="col-md-3">
				<input type="text" class="form-control" id="maintenance_date"
					name="maintenance_date" placeholder="maintenance date">
			</div>
			<div class="col-md-1 col-md-offset-8 ">
				<button type="button" title="click to download as a excel" class="btn btn-default cmn_btn"
					onclick="show();">
					<i class="fa fa-download text-primary-dk"></i>
				</button>
			</div>
		</div>

		<div class="row" id="data-row">
			<div class="col-md-12">

					<div class="col-md-2">
					<label class="small">station</label>
						<div class="form-group">
							<select class="form-control" id="station_id" name="station_id"></select>
						</div>
					</div>
					<div class="col-md-3">
						<label class="small">Gear code</label>
						<div class="form-group">
							<div class="input-group">
								<select class="form-control" id="gear_code" name="gear_code"></select>
								<div class="input-group-addon"></div>
								<select class="form-control" id="station_gear_id"
									name="station_gear_id"></select>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						<label class="small">Schedule  code</label>
							<div class="input-group">
								<select class="form-control" id="schedule_code_id" name="schedule_code_id"></select>
								<div class="input-group-addon"></div>
								<select class="form-control" id="role"
									name="role">
										<option value="SS">SS</option>
										<option value="IC">IC</option>
									</select>
							</div>
						</div>
					</div>
					<div class="col-md-1">
						<label class="small">Disc. app</label>
							<select class="form-control" id="discontinuation_status" name="discontinuation_status">
								<option value="Yes">Y</option>
								<option value="No">N</option>
							</select>
					</div>
					<div class="col-md-2">
						<label class="small">Maintaned by</label>
						<input type="text" class="form-control" name="maintenance_by" id="maintenance_by">
					</div>
					<div class="col-md-1">
						<label></label>
						<button type="button" onclick="saveData();" id="saveBtn" class="btn btn-success btn-block">save</button>
					</div>


			</div>
		</div>
		</form>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="data-entry-table" class="table table-hover table-bordered table-striped table-condensed">
						<thead>
							<tr>
								<th>Station Code</th>
								<th>Gear Code</th>
								<th>Gear No.</th>
								<th>Schedule Code</th>
								<th>Designation</th>
								<th>Disc app.</th>
								<th>Maintaned by</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody id="data-list"></tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</aside>

<script type="text/javascript">
window.onload = function(){
	 getMaintanaceLedger();
	 allStation();
	 gearCode();
}
$('#maintenance_date').datepicker({dateFormat: 'dd-mm-yy', maxDate: "+0D"});
$("#maintenance_date").datepicker("setDate", new Date());

function show(){
	$("#data-entry-table").table2excel({
	    name: "Dataentry excel",
	    filename: "SomeFile" //do not include extension
	});
}
function allStation(){
	$.ajax({
		url: '<?php echo URL;?>settings/getAllStations/',
		type: 'POST',
		datatype: 'JSON',
		success: function(data){
			//$('#station_id').append('<option value="0">--station code--</option>');
			for (var i in data){
				$('#station_id').append('<option value="'+data[i].id+'">'+data[i].code+'</option>');
			}
		}
	});
}

function gearCode(){
	$.ajax({
		url: '<?php echo URL;?>settings/get_all_gear_type/',
		type: 'GET',
		dataTtype: 'JSON',
		success: function(data){
			$('#gear_code').append('<option value="">Select</option>');
			for(var i in data){
				$('#gear_code').append('<option value="'+data[i].id+'">'+data[i].code+'</option>');
			}
		}
	});
}

$("#station_id").on("change", function () {
 var station_id = $('#station_id').val();
 var gear_code = $('#gear_code').val();

 loadStationGears(station_id,gear_code);

});
//onselect gear code function

 $("#gear_code").on("change", function () {
	var station_id = $('#station_id').val();
	var gear_code = $('#gear_code').val();
	$('#station_gear_id,#schedule_code_id').empty();
	loadStationGears(station_id,gear_code);

 });

function loadStationGears(station_id,gear_code){
	$.ajax({
		url: '<?php echo URL;?>data_entry/searchScheduleCodeByStation/',
		type: 'POST',
		data: {'station_id':station_id, 'gear_code':gear_code},
		dataTtype: 'JSON',
		success: function(data){

			for(var i in data['gear_no']){
				$('#station_gear_id').append('<option value="'+data['gear_no'][i].id+'">'+data['gear_no'][i].gear_no+'</option>');
			}
			for (var j in data['sch_code']){
				$('#schedule_code_id').append('<option value="'+data['sch_code'][j].id+'">'+data['sch_code'][j].code+'</option>');
			}
		}
	});
}

 //save form data

 function saveData(){
 	var formData = $('form#data-form').serializeArray();
 	var m_date = $('#maintenance_date').val();
 	var gear_code = $('#gear_code').val();
 	var station_id = $('#station_id').val();
	$('#saveBtn').attr('disabled',true).html('<i class="fa fa-spinner fa-spin"></i>');

		 $.ajax({
			url:'<?php echo URL;?>data_entry/saveData/',
			type: 'POST',
			dataTtype: 'JSON',
			data: formData,
			success: function(data){
				
				$('#saveBtn').attr('disabled',false).html('save');
				if(data!=0){
					alertify.success('data saved successfully');
					$('form#data-form').each(function(){this.reset()});
					getMaintanaceLedger();
				}
				else{
					alertify.error('please input  datas');
				}
			}
		});

	}
 
 function getMaintanaceLedger(){
	$('#data-list').html('<tr><td colspan="8"><center><i class="fa fa-spinner fa-spin fa-3x"></i></center></td></tr>')
 	$.ajax({
 	 url:'<?php echo URL;?>data_entry/getMaintanaceLedger/',
 	 type: 'GET',
 	 dataTtype: 'JSON',
 	 success: function(data){
 		$('#data-list').empty();
 		 for (var i in data){
			var row = '<tr>'
					+'<td class="hidden id">'+data[i].id+'</td>'
					+'<td>'+data[i].station+'</td>'
					+'<td>'+data[i].gear_type+'</td>'
					+'<td>'+data[i].gear_no+'</td>'
					+'<td>'+data[i].schedule_code+'</td>'
					+'<td>'+data[i].role+'</td>'
					+'<td>'+data[i].discontinuation_status+'</td>'
					+'<td>'+data[i].maintenance_by+'</td>'
					+'<td><button class="del btn btn-xs btn-danger">delete</button></td>'
					+'</tr>';
			$('#data-list').append(row);
 	 	}
 	 }
  });
}


//delete data
$("#data-list").on("click", ".del", function(){
	$deleting = $(this);
	var station_id = $deleting.closest("tr").find(".id").text();
	$deleting.html('&nbsp;&nbsp;<i class="fa fa-spinner fa-spin fa-lg"></i>&nbsp;&nbsp;');
	delete_data(station_id);
});
function delete_data(station_id){
	$.ajax({
		url: '<?php echo URL; ?>data_entry/deleteData/',
		type: 'POST',
		dataType: 'JSON',
		data: {'station_id': station_id},
		success: function(data){
			if(data == 1){
				$deleting.closest("tr").remove();
				alertify.error("Data Deleted");
			}
		}
	});
}
</script>
