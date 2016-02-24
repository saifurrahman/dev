
var schedule_date = new Date();
window.onload = function() {
  $("#schedule_date").datepicker("setDate", schedule_date);

	scheduleByDate();
}


$("#schedule_date").datepicker({
	dateFormat : 'yy-mm-dd',
	showAnim : 'slideDown'
});

function scheduleByDate(){
  
  schedule_date = $('#schedule_date').val();



}
