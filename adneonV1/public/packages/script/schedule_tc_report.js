window.onload = function() {
	$('#telecast_time_reports').addClass('active');
	allClient();
	//allfctdealbyclient();

}
var token = $("input[name=_token]").val();


$("#from_date,#to_date").datepicker({
	dateFormat : 'yy-mm-dd',
	changeMonth : true,
	changeYear : true,
	showAnim : 'slideDown',
});
function allClient() {
	$.ajax(
			{
				url : '/deal/allclient',
				type : 'GET',
				datatype : 'JSON',
				success : function(data) {
					$('#client_id').append('<option value="0">Select Client</option>');
					for ( var i in data) {
						// select box
						$('#client_id').append(
								'<option value="' + data[i].id + '">'
										+ data[i].name + '</option>');
					}

				}

			}).done(function() {
		$('#client_id').selectize()
	});
	;
}


function searchReport() {
//	alert('hello')
	var formData = $('form#report-form').serializeArray();
	var client_id = $('#client_id').val();
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
	if (client_id != 0 && from_date != '' && to_date!='') {
		$('#searchBtn').attr('disabled', true).html('please wait..');
		$('#schecdule_table').empty();
		$.ajax({
			url : '/report/telecastreport',
			type : 'POST',
			datatype : 'JSON',
			data : formData,
			success : function(data) {
				$('#searchBtn').attr('disabled', false).html('Search');

				var count=0;
				for ( var i in data) {
					count=count+1;
					var deal = '<tr>' + '<td>'
					+ count
					+ '</td>'
					+ '<td>'
					+ moment(data[i].tc_date)
					.format('ll')
					+ '</td>'

					+ '<td>AT'
					+ pad(data[i].id, 4)
					+ '</td>'
					+ '<td>'
					+ data[i].caption
					+ '</td>'
					+ '<td class="text-center">'
					+ data[i].duration
					+ '</td>'
					+ '<td>'
					+ data[i].tc_time
					+ '</td>';

			$('#schecdule_table').append(deal);
				}
				if(count==0){
					$('#schecdule_table').append('<tr class="danger"><td colspan="8" class="text-center">No Schedule found</td></tr>');
				}
			}

		});
	}else{
		alertify.success('Please select Client ,From date and To date');
	}

}
//download excel
$("#excel").click(function() {
	$("#schecdule_table").table2excel({
		exclude : ".noExl",
		name : "CoommercialSchedule_TC"
	});
});
