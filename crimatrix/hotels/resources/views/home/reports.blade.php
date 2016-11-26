@extends('layouts.home')
@section('navbar')
    @parent	
    {{ HTML::script('js/chart.min.js');}}
@stop

@section('content')
	<div class="container">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Reports</h3>
			</div>
			<div class="panel-body">
			<div class="row">
		      	<div class="col-md-12">
					<div class="page-header">
					  <h4>Last 30 days Total Checkin & Checkout<small class="pull-right"><span class="label label-success">Checkin</span> <span class="label label-danger">Checkout</span></small></h4>
					</div>
				</div>
			      	<div class="col-md-11">
			      		<canvas id="canvas" style="margin-left: 10px; padding-left: 5px; height:300; width:800;"></canvas>
			      	</div>			
			  	</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
	$('#reports_li').addClass('active');
	var dataset1 = [];
	var dataset2 = [];
	var datalabels = [];
	var barChartData = {	
		labels : datalabels,
		datasets : [
			{
				fillColor : "rgba(29,203,20,0.5)",
				strokeColor : "rgba(29,203,20,0.8)",
				highlightFill: "rgba(29,203,20,0.75)",
				highlightStroke: "rgba(29,203,20,1)",
				data : dataset1
			},
			{
				fillColor : "rgba(255,10,13,0.5)",
				strokeColor : "rgba(255,10,13,0.8)",
				highlightFill : "rgba(255,10,13,0.75)",
				highlightStroke : "rgba(255,10,13,1)",
				data : dataset2
			}
		]
	}
	window.onload = function(){
		get_checkinout_graph();
	}

	function get_checkinout_graph(){
	    $.ajax({
	      url: 'http://enterprise.crimatrix.com/hotel/guest/reports',
	      type: 'GET',
	      dataType: 'JSON',
	      success: function(data){    
	        for(var i in data){
	        	datalabels.push(moment(data[i].guestlist_date).format("MMM Do"));        
	        	dataset1.push(parseInt(data[i].total_check_in));
	        	dataset2.push(parseInt(data[i].total_check_out));                    	
	        }
	        var ctx = document.getElementById("canvas").getContext("2d");
	    	window.myBar = new Chart(ctx).Bar(barChartData, {
	    		responsive : true
	    	});
	      	}
	    });
	  }
</script>
@stop