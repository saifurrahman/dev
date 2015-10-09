<aside class="right-side">
   <section class="content-header">
   	<h1>Reports</h1>
   	<ol class="breadcrumb">
   		<li></li>
   	</ol>
   </section>
   <section class="content">
      <div class="row pagemenu">
        <div class="col-md-2">
              <select id="select_station_id" name="station_id[]" multiple class="form-control" placeholder="Select Station"></select>
        </div>
        <div class="col-md-2">
              <select id="select_station_gear_id" name="station_gear_id[]" multiple class="form-control" placeholder="Select Gear"></select>
        </div>

		    <div class="col-md-3">
			       <input type="text" class="form-control" id="from_date" name="from_date" placeholder="From Date">
		    </div>
		    <div class="col-md-3">
			       <input type="text" class="form-control" id="to_date" name="to_date" placeholder="To Date">
		    </div>
		    <div class="col-md-2">
			       <button type="button" class="btn btn-default pull-right" onclick="get_custom_report_data();">Search</button>
		    </div>
	  </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="maintenance_reports">
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
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
	 </section>
</aside>
<script type="text/javascript">
$('#reports_li ,#user_report_li').addClass('active');
$('#reports_sub_li').css('display', 'block');

window.onload = function(){
  
  get_all_stations();
  get_all_gear_by_station()
};
function get_all_stations(){
	$.ajax({
		url: '<?php echo URL;?>settings/getAllStations/',
		type: 'POST',
		dataType: 'JSON',
		success: function(data){
			$('#station_id').empty();
			for(var i in data){
			  $('#station_id').append('<option value="'+data[i].id+'">'+data[i].code+'</option>');
			}
		}
	}).promise().done(function(data) {
        $select_station_id = $('#select_station_id').selectize({
        	maxItems: null,valueField: 'id',labelField: 'code',searchField: 'code',options: data,create: false
        });
    });
}

function get_all_gear_by_station(){
	$.ajax({
		url: '<?php echo URL;?>settings/getAllStations/',
		type: 'POST',
		dataType: 'JSON',
		success: function(data){
			$('#station_id').empty();
			for(var i in data){
			  $('#station_id').append('<option value="'+data[i].id+'">'+data[i].code+'</option>');
			}
		}
	}).promise().done(function(data) {
        $select_station_id = $('#select_station_gear_id').selectize({
        	maxItems: null,valueField: 'id',labelField: 'code',searchField: 'code',options: data,create: false
        });
    });
}
$(function(){
    $( "#from_date" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 2,
      dateFormat: 'dd-mm-yy',
      onClose: function( selectedDate ) {
        $( "#to_date" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to_date" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 2,
      dateFormat: 'dd-mm-yy',
      onClose: function( selectedDate ) {
        $( "#from_date" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
});
function get_maintenance_reports(){
  $.ajax({
    url: '<?php echo URL;?>gear/get_maintenance_reports/',
    type: 'POST',
    datatype: 'JSON',
    success: function(data){
      $('#maintenance_reports tbody').empty();
      for (var i  in  data){
        if(data[i].maintenance_date < data[i].actual_maintenance_date){
          var row ='<tr>'
          +'<td class="id hidden">'+data[i].id+'</td>'
          +'<td class="station_code">'+data[i].station_code+'</td>'
          +'<td class="gear_code">'+data[i].gear_code+'</td>'
          +'<td class="maintenance_date">'+data[i].preety_maintenance_date+'</td>'
          +'<td class="preety_actual_maintenance_date text-late-latif">'+data[i].preety_actual_maintenance_date+'</td>'
          +'<td class="role_name">'+data[i].role_name+'</td>'
          +'<td class="maintenance_by_name">'+data[i].maintenance_by_name+'</td>'
          +'</tr>';
        }
        else{
          var row ='<tr>'
          +'<td class="id hidden">'+data[i].id+'</td>'
          +'<td class="station_code">'+data[i].station_code+'</td>'
          +'<td class="gear_code">'+data[i].gear_code+'</td>'
          +'<td class="maintenance_date">'+data[i].preety_maintenance_date+'</td>'
          +'<td class="preety_actual_maintenance_date">'+data[i].preety_actual_maintenance_date+'</td>'
          +'<td class="role_name">'+data[i].role_name+'</td>'
          +'<td class="maintenance_by_name">'+data[i].maintenance_by_name+'</td>'
          +'</tr>';
        }
        $('#maintenance_reports tbody').append(row);
      }
    }
  });
}
</script>
