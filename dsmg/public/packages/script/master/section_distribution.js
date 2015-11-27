window.onload = function(){
	allsupervisors();
	get_all_stations();
	allsupervisorsdesig();
}
var token =  $("input[name=_token]").val();
function get_all_stations(){
	$.ajax({
		url: '/common/allstations',
		type: 'GET',
		dataType: 'JSON',
		success: function(data){
			$('#station_id').empty();
			for(var i in data){
			  $('#station_id').append('<option value="'+data[i].code+'">'+data[i].code+'</option>');
			}
		}
	}).promise().done(function(data) {
        $select_station_id = $('#select_station_id').selectize({
        	maxItems: null,valueField: 'code',labelField: 'code',searchField: 'code',options: data,create: false
        });
    });
}
var allDesig=[];
function allsupervisorsdesig(){
	$('#designation_table').empty();
	$('#designation').empty();
	 $.ajax({
	 url: '/common/allsupervisorsdesignation',
	 type: 'GET',
	 dataTtype: 'JSON',
	 success: function(data){
		 var count=0;
		 $('#designation').append('<option value="NA">--NA--</option>');
		 for(var i in data){
			 $('#designation').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');

			  allDesig.push(data[i].name);
	       count=count+1;
	       var row = '<tr>'
	 				   					+'<td>'+count+'</td>'
	 					+'<td>'+data[i].name+'</td>'
	 					 					+'</tr>';
	 			$('#designation_table').append(row);
	     }

	 }
 });
}

function allsupervisors(){
  $('#sectional_distribution').empty();
  $.ajax({
   url: '/common/allsupervisors',
   type: 'GET',
   dataTtype: 'JSON',

   success: function(data){
     var count=0;
     for(var i in data){
       count=count+1;
       var row = '<tr>'
 					+'<td class="hidden id">'+data[i].id+'</td>'
           					+'<td>'+count+'</td>'
 					+'<td>'+data[i].name+'</td>'
 					+'<td>'+data[i].desig+'</td>'
 					+'<td>'+data[i].stations+'</td>'

 					+'<td><button class="edit btn btn-rounded btn-icon btn-info"><i class="fa fa-edit"></i></button></td>'
 					+'</tr>';
 			$('#sectional_distribution').append(row);
     }
   }
 });
}

var token =  $("input[name=_token]").val();
function saveDesig(){
var desig=$('#new_designation').val();

if(_.contains(allDesig, desig)){
	alertify.error("Designation  already exist!");
}else{
	$.ajax({
	 url: '/common/savedesignation',
	 type: 'POST',
	 dataTtype: 'JSON',
	 data: {'desig': desig,'_token':token},
	 success: function(data){

			 $('#createDesigModal').modal('hide');
			 alertify.error("New Designation  added");
		 	allsupervisorsdesig();
	 }
 });
}

}

function createSupervisor(){
	alert('fdsfd');
	var supervisor_name=$('#name').val();
	var desig_id=$('#designation').val();
	var supervisor_stations=$('#select_station_id').val();

	$.ajax({
	 url: '/common/savenewsupervisor',
	 type: 'POST',
	 dataTtype: 'JSON',
	 data: {'supervisor_name':supervisor_name,'desig_id': desig_id,'supervisor_stations':supervisor_stations,'_token':token},
	 success: function(data){

			 $('#createUserModal').modal('hide');
			 alertify.error("New Supervisor  added");
				allsupervisors();
	 }
	});

}
