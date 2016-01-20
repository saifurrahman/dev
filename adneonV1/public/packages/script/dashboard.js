
var month;
var canvas;
var context;
window.onload = function() {
	$('#dashboard').addClass('active');
	month = 10;
	$("#daily_schedule_canvas").empty().append('<canvas id="schedule_details" height="100%"></canvas>');
	canvas = document.getElementById('schedule_details');
  context=canvas.getContext('2d');

	lastScheduleReport();
	monthlyDeals();
	executiveMonthlyDeals();

	monthlyPayments();
		monthlyBills();
	locationMonthlyDeals();
	getMonthlyscheduleamount();
	monthly_report_master();
}

function monthly_report_master(){
	$.ajax({
		url : '/report/allscheduleamount',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			var rowsx = [];
			var rowsy1 = [];
			var rowsy2 = [];

			for ( var key in data) {
				rowsx.push(data[key].month);
				rowsy1.push(parseFloat(data[key].schedule_amount/100000).toFixed(2));
				rowsy2.push(parseFloat(data[key].govt_amount/100000).toFixed(2));
				//rowsy3.push(parseFloat(data[key].mumbai/100000).toFixed(2));
				//rowsy4.push(parseFloat(data[key].delhi/100000).toFixed(2));
				//rowsy5.push(parseFloat(data[key].kolkota/100000).toFixed(2));
				//rowsy6.push(parseFloat(data[key].bangalore/100000).toFixed(2));
			}
			var data_set = {
    labels: rowsx,
    datasets: [
        {
            label: "Total Schedule",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: getRandomColor(),
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: rowsy1
        },
        {
            label: "Govt",
            fillColor: "rgba(191,197,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: rowsy2
        }
    	]
		};
		var ctx = document.getElementById('monthly_report_master')
				.getContext('2d');
				ctx.canvas.width = 900;
				ctx.canvas.height = 300;
		var myLineChart = new Chart(ctx).Line(data_set);

		}
	});


}
var token = $("input[name=_token]").val();

$("#month_select").on("change", function () {
 month = $('#month_select').val();
 $("#daily_schedule_canvas").empty().append('<canvas id="schedule_details" height="100%"></canvas>');
 canvas = document.getElementById('schedule_details');
 context=canvas.getContext('2d');
 lastScheduleReport();
});

function lastScheduleReport(){

	$.ajax({
		url : '/report/dailyscheduleamount',
		type : 'POST',
		datatype : 'JSON',
		data: {'month':month,'_token':token},
		success : function(data) {
			var rowsx = [];
			var rows_rate = [];
			var rows_duration = [];
			var rows_amount = [];
			var total_amount=0;
			var count=1;
			for ( var key in data) {
				var schedule_date=moment(data[key].schedule_date);
				rowsx.push(schedule_date.format('D'));
			//	rows_rate.push(parseInt(data[key].rate));
				//rows_duration.push(parseInt(data[key].total_duration));
				rows_amount.push(parseInt(data[key].amount));
				total_amount=total_amount+data[key].amount;
				count=count+1;
			}

			$('#total_amount').empty().append("Total : "+total_amount+" INR : Avg Sch :"+parseInt(total_amount/count));
			var barChartData = {
					labels : rowsx,
					datasets : [ {
						label : "Rate",
						fillColor : getRandomColor(),
						strokeColor : getRandomColor(),
						data : rows_amount,
					} ]
				};
				context.canvas.width = 480;
				context.canvas.height = 250;
				var myBarChart = new Chart(context).Line(barChartData);
		}
	});

}
function monthlyDeals(){
	$.ajax({
		url : '/report/monthlydeals',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			var rowsx = [];
			var rowsy = [];

			for ( var key in data) {
				rowsx.push(data[key].month_name);
				rowsy.push(parseFloat(data[key].total_amount/100000).toFixed(2));
			}
			var barChartData = {
					labels : rowsx,
					scaleLabel : "Title",
					datasets : [ {
						label : "Amount",
						fillColor : getRandomColor(),
						strokeColor : getRandomColor(),
						data : rowsy,
					} ]
				};
				var stockChart = document.getElementById('monthly_deals')
						.getContext('2d');
				stockChart.canvas.width = 500;
				stockChart.canvas.height = 250;
				var myBarChart = new Chart(stockChart).Bar(barChartData);
		}
	});
}
function monthlyBills(){
	$.ajax({
		url : '/report/monthlybills',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			var rowsx = [];
			var rowsy = [];
			var total_bills=0;;
			for ( var key in data) {
				rowsx.push(data[key].month_name);
				rowsy.push(parseFloat(data[key].total_amount/100000).toFixed(2));
					total_bills=total_bills+ parseInt(data[key].total_amount/100000);
			}
			//$('#total_bills').empty().append('Bill amount: '+total_bills+' / ');
			var barChartData = {
					labels : rowsx,
					scaleLabel : "Title",
					datasets : [ {
						label : "Amount",
						fillColor : getRandomColor(),
						strokeColor : getRandomColor(),
						data : rowsy,
					} ]
				};
				var stockChart = document.getElementById('monthly_bills')
						.getContext('2d');
				stockChart.canvas.width = 500;
				stockChart.canvas.height = 250;
				var myBarChart = new Chart(stockChart).Bar(barChartData);
		}
	});
}
function executiveMonthlyDeals(){
	$.ajax({
		url : '/report/executivemonthlydeals',
		type : 'GET',
		datatype : 'JSON',
		success : function(row) {
			var dataarray=[];

			for ( var key in row) {
				var amount= row[key].amount;
				var name=row[key].name;
				var data = {
				value:amount,
				color:getRandomColor(),
				highlight:getRandomColor(),
				label: name
			}
		//	console.log(data);
				dataarray.push(data);
			}

				var stockChart = document.getElementById('monthly_executive_deals')
						.getContext('2d');
				stockChart.canvas.width = 500;
				stockChart.canvas.height = 250;
				var myBarChart = new Chart(stockChart).Pie(dataarray);
		}
	});
}
function monthlyPayments(){
	$.ajax({
		url : '/report/monthlypayments',
		type : 'GET',
		datatype : 'JSON',
		success : function(data) {
			var rowsx = [];
			var rowsy = [];
			var total_recieved=0;;
			for ( var key in data) {
				rowsx.push(data[key].month_name);
				rowsy.push(parseFloat(data[key].total_amount/100000).toFixed(2));
				total_recieved=total_recieved+ parseFloat(data[key].total_amount);
			}
			var barChartData = {
					labels : rowsx,
					scaleLabel : "Title",
					datasets : [ {
						label : "Amount",
						fillColor : getRandomColor(),
						strokeColor : getRandomColor(),
						data : rowsy,
					} ]
				};
				var stockChart = document.getElementById('monthly_payments')
						.getContext('2d');
				stockChart.canvas.width = 500;
				stockChart.canvas.height = 250;
				var myBarChart = new Chart(stockChart).Bar(barChartData);
			//	$('#total_recieved').empty().append('Received amount:  '+total_recieved);
		}
	});
}
function locationMonthlyDeals(){
	$.ajax({
		url : '/report/locationmonthlydeals',
		type : 'GET',
		datatype : 'JSON',
		success : function(row) {
			var dataarray=[];
		//	console.log(data);
			for ( var key in row) {
				var amount= row[key].amount;
				var name=row[key].name;
				var data = {
				value:amount,
				color:getRandomColor(),
				highlight:getRandomColor(),
				label:name
			}
		//	console.log(data);
				dataarray.push(data);
			}

				var stockChart = document.getElementById('location_deals')
						.getContext('2d');
				stockChart.canvas.width = 500;
				stockChart.canvas.height = 250;
				var myBarChart = new Chart(stockChart).Pie(dataarray);
		}
	});
}

function getMonthlyscheduleamount(){
	$.ajax({
		url : '/report/monthlyscheduleamount',
		type : 'GET',
		datatype : 'JSON',
		success : function(row) {
			var dataarray=[];
		for ( var key in row) {
				var from_date= row[key].from_date;
				var to_date=row[key].to_date;
				var amount=row[key].amount;

				//var per_day=amount/(Date(to_date)-Date(from_date));

				//console.log(per_day);
			}

		}
	});

}

function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 10)];
    }
    return color;
}
