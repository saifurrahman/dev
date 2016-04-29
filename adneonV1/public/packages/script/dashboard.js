window.onload = function() {
	$('#dashboard').addClass('active');
//	getDashboardReport();
}


function getDashboardReport(){
	$
		.ajax({
			url : '/report/dashboardreport',
			type : 'GET',
			datatype : 'JSON',
			success : function(data) {

drawChart();
			}
		});

}
function drawChart(){
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: 'Telecast',
						fill:false,
						backgroundColor:"#00994d",
            data: [12, 19, 3, 5, 2, 3]
        },{
            label: 'Schedule',
						fill:false,
						backgroundColor:"#ff1a1a",
            data: [10, 11, 13, 15, 21, 3]
        },{
            label: 'Missed',
						fill:false,
						backgroundColor:"#b30000",
            data: [1, 1, 3, 5, 2, 3]
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
