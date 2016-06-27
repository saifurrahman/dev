
window.onload = function(){
	$('#monthlydeals').addClass('active');
	allItem();
	allExe();

}
function allExe(){
	$.ajax({
		url : '/deal/allexe',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			$('#executive_id').append('<option value="0">All Executives</option>');
			for(var i in data){
				//select box
				$('#executive_id').append('<option value="'+data[i].id+'">'+data[i].ex_name+'</option>');
			}

		}

	});
}

function allItem(){
	$('#item_id').empty();
	$.ajax({
		url : '/deal/allitem',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
      	$('#item_id').append('<option value="0">All Property</option>');
			for(var i in data){
				//select box
				$('#item_id').append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
			}

		}
});
}

var token = $("input[name=_token]").val();
function searchReport(){

  var formData = $('form#dealreport-form').serializeArray();
   $('#searchBtn').attr('disabled', true).html('PLEASE WAIT..');
  $.ajax({
    url : '/report/monthlydeals',
    type : 'POST',
    dataType : 'JSON',
    data : formData,
    success : function(data) {
      $('#searchBtn').attr('disabled', false).html('Search');
      $("#monthlydeals_report").empty();
      var total_amount=0;
      var count=0;
        var row;
      for(var i in data){
        count=count+1;

        var amount=data[i].amount;
          row ='<tr>'
              +'<td>'+count+'</td>'
              +'<td>'+data[i].client+'</td>'
              +'<td>'+data[i].agency+'</td>'
              +'<td>'+data[i].executive+'</td>'
              +'<td>'+data[i].property+'<br><span class="text-info">'+data[i].from_date+' to '+data[i].to_date+'</span></td>'
              +'<td>'+data[i].units+'</td>'
              +'<td>'+data[i].rate+'</td>'
              +'<td>'+amount+'</td>'
              +'</tr>'


        $("#monthlydeals_report").append(row);
        total_amount=total_amount+amount;
      }
      row ='<tr>'
          +'<td class="text-success">Total</td>'
          +'<td></td>'
          +'<td></td>'
          +'<td></td>'
          +'<td></td>'
          +'<td></td>'
          +'<td></td>'
          +'<td>'+total_amount+'</td>'
          +'</tr>'
      $("#monthlydeals_report").append(row);
    }
  });
}
