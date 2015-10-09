<aside class="right-side">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Maintenance Roster</h1>
		<ol class="breadcrumb">
		</ol>
	</section>
	<section class="content">
		<div class="row pagemenu">
			<div class="col-md-3">
        <label class="small">Station Maintainance Overdue</label>
          <div class="form-group">
            <select class="form-control" id="station_id" name="station_id"></select>
          </div>
			</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
											<th>Station Code</th>
											<th>Gear Code</th>
											<th>Gear No</th>
											<th>Schedule Code/Role</th>
											<th>Last Maintenance Date</th>
											<th>Discontinuation Applied</th>
											<th>Maintenance By</th>
									</tr>
								</thead>
								<tbody id="overdue_status"></tbody>
							</table>
						</div>
					</div>
				</div>
				</div>
  </section>
  </aside>

  <script type="text/javascript">
  window.onload = function(){
     allStation();


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
				var station_id = $('#station_id').val();
				loadStationOverdueGears(station_id);

  		}
  	});
  }
	$("#station_id").on("change", function () {
 	var station_id = $('#station_id').val();
 	loadStationOverdueGears(station_id);
  });

 function loadStationOverdueGears(station_id){
	 $('#overdue_status').empty();
 	$.ajax({
 		url: '<?php echo URL;?>data_entry/loadStationOverdueGears/',
 		type: 'POST',
 		data: {'station_id':station_id},
 		dataTtype: 'JSON',
 		success: function(data){
 			for(var i in data){
			var row = '<tr>'
				+'<td class="id hidden">'+data[i].id+'</td>'
				+'<td class="station_id hidden">'+data[i].station_id+'</td>'
				+'<td>'+data[i].station+'</td>'
				+'<td>'+data[i].gear_type+'</td>'
				+'<td>'+data[i].gear_no+'</td>'
				+'<td>'+data[i].schedule_code+'/'+data[i].role+'</td>'
				+'<td>'+data[i].maintenance_date+'</td>'
				+'<td>'+data[i].discontinuation_status+'</td>'
				+'<td>'+data[i].maintenance_by+'</td>'
				+'</tr>';
			$('#overdue_status').append(row);
		}
 		}
 	});
 }
  </script>
