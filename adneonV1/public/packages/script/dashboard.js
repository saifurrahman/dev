window.onload = function() {
	$('#dashboard').addClass('active');
	//getDashboardReport();
}
function getDashboardReport(){
	$
		.ajax({
			url : '/report/dashboardreport',
			type : 'GET',
			datatype : 'JSON',
			success : function(data) {
					telecastScheduleChart(data);
					nonFctScheduleChart(data);
			}
		});
}
function telecastScheduleChart(data){
	var telecast_array =data['month_wise_fct_telecast'];
	var schedule_array =data['month_wise_fct_schedule'];
	var telecast_months=[];
	var telecast_amount=[];
	var schedule_amount=[];
	for(var i in telecast_array){
		telecast_months[i]=telecast_array[i].months;
		telecast_amount[i]=telecast_array[i].total_amount;
	}
	for(var i in schedule_array){
		schedule_amount[i]=schedule_array[i].total_amount;
	}
	var ctx = document.getElementById("tcvssch");
	var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: telecast_months,
        datasets: [{
            label: 'Telecast',
						fill:false,
						backgroundColor:"#00994d",
            data: telecast_amount
        },{
            label: 'Schedule',
						fill:false,
						backgroundColor:"#ff1a1a",
            data: schedule_amount
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
}
function nonFctScheduleChart(data){
	var non_fct =data['non_fct'];
	var labels_date=['APR','MAY'];
	var schedule_amount=[200000,340000];
	for(var i in non_fct){

	}

	var ctx = document.getElementById("myChart");
	var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels_date,
        datasets: [{
            label: 'Schedule',
						fill:false,
						backgroundColor:"#ff1a1a",
            data: schedule_amount
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
}
function calculateUnits(schedule_from_date,schedule_to_date,schedule_units){
	var a = moment(schedule_from_date);
	var b = moment(schedule_to_date);
	var x = moment('2016-04-01');
	var y = moment(date());
	var days = b.diff(a, 'days')+1;
	var daily_schedule =parseInt(schedule_units/days);
		var bill_start_date;
		var bill_end_date;
	if(moment(x).isSameOrBefore(a)){
		bill_start_date=a;
	}
	if(moment(x).isSameOrAfter(a)){
		bill_start_date=x;
	}
	if(moment(y).isSameOrBefore(b)){
		bill_end_date=y;
	}
	if(moment(y).isSameOrAfter(b)){
			bill_end_date=b;
	}
	var days_billing = bill_end_date.diff(bill_start_date, 'days')+1;
	var billing_units=days_billing*daily_schedule;
	return billing_units;//daily_schedule*days_billing;
}
