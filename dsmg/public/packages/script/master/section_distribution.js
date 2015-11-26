window.onload = function(){
	allsupervisors();
}
var token =  $("input[name=_token]").val();

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
 					+'<td>'+data[i].designation+'</td>'
 					+'<td>'+data[i].stations+'</td>'

 					+'<td><button class="edit btn btn-rounded btn-icon btn-info"><i class="fa fa-edit"></i></button></td>'
 					+'</tr>';
 			$('#sectional_distribution').append(row);
     }
   }
 });
}
$("#sectional_distribution").on("click", ".view", function(){
	deleting = $(this);
	var id = deleting.closest("tr").find(".id").text();
  getsupervisorStaions(id,deleting);
});

function getsupervisorStaions(id,deleting){
  //$('#sectional_distribution').empty();
  deleting.closest("tr").find(".stations").empty();
  $.ajax({
   url: '/common/supervisorstations/'+id,
   type: 'GET',
   dataTtype: 'JSON',
   success: function(data){
     var stations;

     for(var i in data){
       stations=stations+', '+data[i].code;
       console.log(data[i].code);
     }
     deleting.closest("tr").find(".stations").html(stations);
   }
 });
}
