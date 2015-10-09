<aside class="right-side">
    <section class="content-header">
      	<h1>Stations</h1>
      	<ol class="breadcrumb"></ol>
    </section>
    <section class="content">
    	<div class="row pagemenu">

    		<div class="col-md-12 col-xs-12">
    			<input type="text" class="form-control" id="search_station" placeholder="Search">
    		</div>

    	</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-danger">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
                <th>Sl no</th>
                <th>Station Code <small> (Station name)</small></th>
					      <th>Inspection due date/Role</th>
								<th>Set Insp. date</th>
								<th>Insp History</th>
							</tr>
						</thead>
						<tbody id="railway_stations_list"></tbody>
					</table>
				</div>
			</div>
		</div>
    </section>
</aside>
<!-- Modal -->
<div class="modal fade" id="crossingModal" tabindex="-1" role="dialog" aria-labelledby="maintenanceModalLabel" aria-hidden="false" data-backdrop="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="maintenanceModalLabel"></h4>
      </div>
      <div class="modal-body">      
			<form role="form" id="insp_form">
			  <input type="hidden" id="station_id" name="station_id"> 
			  <div class="form-group">
			    <label>Inspection By</label>
			    <select class="form-control"  name="role">
			    	<option value="SS">SS</option>
			    	<option value="IC">IC</option>
			    </select>
			  </div>
			  <div class="form-group">
			    <label>Inspection  Date</label>
			    <input type="text" class="form-control" id="date_of_inspection" name="date_of_inspection">
			  </div>
			  <div class="form-group">
			  	<button type="button" class="btn btn-primary btn-block" id="savebtn" onclick="save_insp();">Save</button>
			  </div>
			</form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$('#crossing_inspection_li').addClass('active');
$('#crossing_inspection_li').css('display', 'block');

$('#date_of_inspection').datepicker({dateFormat: 'dd-mm-yy'});
$("#date_of_inspection").datepicker("setDate", new Date());
var district_list=[];
window.onload = function(){
	getStationJointCrossingSchedule();

};
function getStationJointCrossingSchedule(){
	$('#railway_stations_list').html('<tr><td colspan="6" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-2x"></i></td></tr>');
	$.ajax({
		url: '<?php echo URL;?>data_entry/getStationJointCrossingSchedule/',
		type: 'POST',
		datatype: 'JSON',
		success: function(data){
			$('#railway_stations_list').empty();
      var count=1;
			for (var i in data){
				var row ='<tr>'
		 			+'<td class="id hidden">'+data[i].id+'</td>'
          			+'<td >'+count+'</td>'
          			+'<td class="code">'+data[i].code+'</td>'
		 		  	+'<td class="district_name">'+data[i].due_date_of_inspection+'/'+data[i].role+'</td>'
		 			+'<td><button class="edit btn btn-info btn-xs">Set Insp. date</button></td>'
		 			+'<td><button class="del btn btn-danger btn-xs">Insp. history</button></td>'
		 			+'</tr>';
				$('#railway_stations_list').append(row);
        count=count+1;
			}
		}
	});
}
$('#search_station').keyup(function() {
	var regex = new RegExp($('#search_station').val(), "i");
	var rows = $('table tbody#railway_stations_list tr:gt(0)');
	rows.each(function (index) {
		title = $(this).children(".name, .code").html();
		if (title.search(regex) != -1) {
			$(this).show();
		}
		else {
		    $(this).hide();
		}
	});
});


//set inspectin date
$("#railway_stations_list").on("click", ".edit", function(){
	$edit = $(this);
	var station_id = $edit.closest("tr").find(".id").text();
	var station_code = $edit.closest("tr").find(".code").text();
	$('#crossingModal').modal('show');
	$('#maintenanceModalLabel').empty();
	$('#maintenanceModalLabel').append(station_code);

	$('#station_id').val(station_id);
	
	
});


function save_insp(){
	var formData = $('#insp_form').serializeArray();
	$.ajax({
		url: '<?php echo URL; ?>data_entry/saveStationJoinCrossingSignal/',
		type: 'POST',
		dataType: 'JSON',
		data: formData,
		success: function(data){
			
		}
	});
}

</script>
