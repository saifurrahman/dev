<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>ADneon::Invoice</title>
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1" />
<!-- css -->
{{HTML::style('packages/css/bootstrap.css')}}
{{HTML::style('packages/css/icon.css')}}
{{HTML::style('packages/css/font.css')}}
{{HTML::style('packages/css/print.css')}}
<!-- script js -->
{{HTML::script('packages/js/jquery.min.js');}}
{{HTML::script('packages/js/bootstrap.js');}}
{{HTML::script('packages/js/jquery.slimscroll.min.js');}}
{{HTML::script('packages/js/app.plugin.js');}}
{{HTML::script('packages/js/moment.js');}}
{{HTML::script('packages/js/app.js');}}
</head>
<body class="">
    <div class="row">
			<div class="col-sm-4">
				{{
					HTML::image('packages/images/assam_talks_logo.png', 'addneon', array('class' =>
					'm-r-sm'))}}
			</div>
			<div class="col-sm-4"></div>
			<div class="col-sm-4 style="text-align:right;"">
				<address>
															  <strong>Rockland Media & Comm. (P) Ltd.</strong><br>
															  26/27,3rd ByeLane,Industrial Easte<br>
															  Bamunimaidam,Guwahati-21<br>
																<small>CIN: U32204DL2006PTC157069</small>
															</address>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-6">

			</div>
			<div class="col-sm-6 pull-right" style="text-align:right;">
				<div id="invoice_id"></div>
				<div id="inv_details"></div>
			</div>

		</div>
		<hr>
		<div class="row">
			<div class="col-sm-4">
				<div id="address_to"></div>
			</div>
			<div class="col-sm-2">

			</div>
			<div class="col-sm-6 pull-right">
				<div id="address_for"></div>
			</div>

		</div>
		<br>

		<div class="row">
			<div class="col-sm-12">
				<strong>Ro Details</strong>
			</div>
			<div class="col-sm-12">
				<table class="table table-bordered">
				<thead>
					<tr>
						<th>Ro No</th>
						<th>Ro Date</th>
						<th>Ro Amount</th>
						<th>Activity Period</th>
						<th>Terms</th>

					</tr>
				</thead>
				<tbody id="ro_details">

				</tbody>
			</table>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-6">
				<strong>Item Details</strong>
			</div>
			<div class="col-sm-2">
			</div>
			<div class="col-sm-4" style="text-align:right;">
				<small>all the prices are in INR (&#8377;)</small>
			</div>

			<div class="col-sm-12">
				<table class="table table-bordered">
				<thead>
					<tr>
						<th>Property</th>
						<th>Details</th>
						<th>Units</th>
						<th>Rate</th>
						<th>Total</th>

					</tr>
				</thead>
				<tbody id="item_details">

				</tbody>
			</table>
			</div>

		</div>

		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-10 pull-right" style="text-align:right;">
			<span id="inwords"></span>
			</div>
		</div>
		<br>
		<br>
		<hr>
		<div class="row">
			<div class="col-sm-7">
				Payments to be made in Favour of
		<br><strong>"Rockland Media and Communication Pvt Ltd".</strong><br>
		# State Bank of India, New Guwahati Branch<br>
		# A/c No. <strong>34514432516</strong> & IFS Code: <strong>SBIN0000221</strong><br>
		# PAN: <strong>AADCR5052M</strong><br>
		# Service Tax: <strong>AADCR5052MSD002</strong>


			</div>
			<div class="col-sm-5 pull-right" style="text-align:right;">
										<strong>Rockland Media & Comm. (P) Ltd.</strong>
										<br>
										<br><br>
										<small>Authorized Signatory</small>
			</div>
			<br>

		</div>
		<br>
		<hr>
		<div id="footer">SUBJECT TO GUWAHATI JURISDICTION</div>
		<p class="pull-right hidden">
			<small>Designed and Developed by <i>http://glomindz.com</i></small>
		</p>
	</div>
  </body>
</html>
<script>
window.onload = function() {
	var bill_id={{$bill_id}};

	getBillDetails(bill_id);
}
function getBillDetails(bill_id){
	$('#item_details').html('<tr><td colspan="5" style="text-align: center;margin-top: 20px;"><i class="fa fa-spinner fa-spin fa-4x"></i></td></tr>');
	$.ajax({
		url : '/billing/printinvoice/'+bill_id,
		type : 'GET',
		dataType : 'JSON',
		success : function(data) {
			$('#item_details').empty();
			var bill_details = data['bill_details'][0];
			var deal_details = data['deal_details'];
			var tc_details = data['tc_details'];
			var total_telecast_duration =0;
			var brand='';
			for(var i in tc_details){
				total_telecast_duration =total_telecast_duration +parseInt(tc_details[i].telecast_duration);
				if(brand.localeCompare(tc_details[i].brand_name)==1){
					brand =brand+','+tc_details[i].brand_name;
				}else{
					brand =tc_details[i].brand_name;
				}
			}
			if(bill_details.agency_id===1){
					$('#address_to').empty().append('<strong>To</strong><br><strong>'+bill_details.client_name+'</strong><br>'+bill_details.address1+'<br>'+bill_details.address2+','+bill_details.city+'<br>');
			}else{
					$('#address_to').empty().append('<strong>To</strong><br><strong>'+bill_details.agency_name+'</strong><br>'+bill_details.agency_a1+'<br>'+bill_details.agency_a2+','+bill_details.agency_city+'<br>');
					$('#address_for').empty().append('<br><br><strong>Client:</strong>'+bill_details.client_name+'<br><strong>Brand:</strong>'+brand);
			}
			$('#invoice_id').empty().append('<h4>INVOICE NO #&nbsp;&nbsp;'+pad(bill_details.invoice_no,4)+'</h4>');


			$('#ro_details').empty().append('<tr><td>'+bill_details.ro_number+'</td><td>'+bill_details.ro_date+'</td><td> &#8377;'+bill_details.ro_amount+'</td><td>'+bill_details.bill_start_date+'<strong> to</strong> '+bill_details.bill_end_date+'</td><td>'+bill_details.payment_peference+'</td></tr>');


			$('#item_details').empty();
			var units=parseInt(total_telecast_duration)/10;
			var rate=0;
			var amount=0;
			var total_amount=0;
			for ( var i in deal_details) {
				var row_item='';
				rate=parseFloat(deal_details[i].rate).toFixed(2);
				if(deal_details[i].item_id==1 || deal_details[i].item_id==6){
						amount=parseFloat(rate*units).toFixed(2);
						row_item='<tr><td>'+deal_details[i].item+'</td><td>'+total_telecast_duration+' Sec</td><td style="text-align:right;">'+units+'</td><td style="text-align:right;">'+rate+'</td><td style="text-align:right;">'+amount+'</td></tr>';
				}else{
						units=calculateUnits(bill_details.bill_start_date,bill_details.bill_end_date,deal_details[i].from_date,deal_details[i].to_date,deal_details[i].units);
						amount=parseFloat(rate*units).toFixed(2);
						row_item='<tr><td>'+deal_details[i].item+'</td><td>-</td><td style="text-align:right;">'+units+'</td><td style="text-align:right;">'+rate+'</td><td style="text-align:right;">'+amount+'</td></tr>';
				}

				$('#item_details').append(row_item);
				total_amount=parseFloat(total_amount)+parseFloat(amount);

				//		$('#item_details').empty().append('<tr><td>'+	deal_details[i].item+'</td><td>'+bill_details.ro_date+'</td><td> &#8377;'+bill_details.ro_amount+'</td><td>'+bill_details.bill_start_date+'<strong> to</strong> '+bill_details.bill_end_date+'</td><td>'+bill_details.payment_peference+'</td></tr>');
			}
			var row_tax ='<br>';
			//<tr><td></td><td></td><td>Less Agency Commission</td><td>15%</td><td>4900</td></tr><tr><td></td><td></td><td>SUBTOTAL</td><td>28050</td></tr><tr><td></td><td></td><td>Service Tax @14.5%</td><td></td><td>4067</td></tr><tr><td></td><td></td><td><strong>Total amount</strong></td><td></td><td><strong>32117</strong></td></tr>';
			$('#item_details').append(row_tax);
				var	agency_com_amount=parseFloat(total_amount*bill_details.agency_commission/100).toFixed(2);
				var row_tax ='<tr><td></td><td></td><td>Less Agency Commission</td><td id="agency_com_per">'+bill_details.agency_commission+' %</td><td style="text-align:right;">'+agency_com_amount+'</td></tr><tr>';
			//<td></td><td></td><td>SUBTOTAL</td><td>28050</td></tr><tr><td></td><td></td><td>Service Tax @14.5%</td><td></td><td>4067</td></tr><tr><td></td><td></td><td><strong>Total amount</strong></td><td></td><td><strong>32117</strong></td></tr>';
			$('#item_details').append(row_tax);
			subtotal_amount =total_amount-agency_com_amount;
			service_tax_amount=parseFloat(subtotal_amount*0.14).toFixed(2);
			swach_bhart_cess=parseFloat(subtotal_amount*0.005).toFixed(2);
			khrishi_kalyan_cess=parseFloat(subtotal_amount*0.005).toFixed(2);
			tax_amount=parseFloat(parseFloat(service_tax_amount)+parseFloat(swach_bhart_cess)+parseFloat(khrishi_kalyan_cess)).toFixed(2);
			bill_amount=parseFloat(parseFloat(subtotal_amount)+parseFloat(tax_amount)).toFixed(2);
			var row_tax ='<tr><td></td><td></td><td>SUBTOTAL</td><td>&#8377;</td><td id="subtotal_amount_id" style="text-align:right;">'+parseFloat(subtotal_amount).toFixed(2)+'</td></tr><tr><td></td><td></td><td>Service Tax @14%</td><td>&#8377;</td><td id="service_tax_amount_td" style="text-align:right;">'+service_tax_amount+'</td></tr><tr><td></td><td></td><td>Swach Bharat Cess @ 0.50%</td><td>&#8377;</td><td id="swach_bhart_cess" style="text-align:right;">'+swach_bhart_cess+'</td></tr>><tr><td></td><td></td><td>Krishi Kalyan Cess @ 0.50%</td><td>&#8377;</td><td id="khrishi_kalyan_cess" style="text-align:right;">'+khrishi_kalyan_cess+'</td></tr>><tr><td></td><td></td><td>Tax</td><td>&#8377;</td><td id="tax_amount" style="text-align:right;">'+parseFloat(tax_amount).toFixed(2)+'</td></tr><tr><td></td><td></td><td><strong>Total amount</strong></td><td>&#8377;</td><td id="bill_amount_id" style="text-align:right;"><strong>'+bill_amount+'</strong></td></tr>';
			//';
			$('#item_details').append(row_tax);
			$('#inwords').empty().append('amount in words (rounded) : <strong>'+convert_number(bill_amount)+'</strong>');

			var invoice_date=moment(bill_details.created_at).format("ll");
			var due_date=moment(bill_details.created_at).add(90, 'days').format("ll");
			$('#inv_details').empty().append('<strong>Invoice Date : '+invoice_date+'</strong>');
		}
	});

}
function convert_number(number)
{
   if ((number < 0) || (number > 999999999))
    {
    return "Number is out of range";
    }
    var Gn = Math.floor(number / 10000000);  /* Crore */
    number -= Gn * 10000000;
    var kn = Math.floor(number / 100000);     /* lakhs */
    number -= kn * 100000;
    var Hn = Math.floor(number / 1000);      /* thousand */
    number -= Hn * 1000;
    var Dn = Math.floor(number / 100);       /* Tens (deca) */
    number = number % 100;               /* Ones */
    var tn= Math.floor(number / 10);
    var one=Math.floor(number % 10);
    var res = "";

    if (Gn>0)
    {
        res += (convert_number(Gn) + " Crore");
    }
    if (kn>0)
    {
            res += (((res=="") ? "" : " ") +
            convert_number(kn) + " Lakhs");
    }
    if (Hn>0)
    {
        		res += (((res=="") ? "" : " ") +
            convert_number(Hn) + " Thousand");
    }

    if (Dn)
    {
        res += (((res=="") ? "" : " ") +convert_number(Dn) + " hundred");
    }


    var ones = Array("", "One", "Two", "Three", "Four", "Five", "Six","Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen","Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen","Nineteen");
		var tens = Array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty","Seventy", "Eigthy", "Ninety");

    if (tn>0 || one>0)
    {
        if (!(res==""))
        {
            res += " and ";
        }
        if (tn < 2)
        {
            res += ones[tn * 10 + one];
        }
        else
        {
            res += tens[tn];
            if (one>0)
            {
                res += ("-" + ones[one]);
            }
        }
    }

    if (res=="")
    {
        res = "zero";
    }
    return res;
}
function calculateUnits(from_date,to_date,schedule_from_date,schedule_to_date,schedule_units){
	var a = moment(schedule_from_date);
	var b = moment(schedule_to_date);
	var x = moment(from_date);
	var y = moment(to_date);
	var days = b.diff(a, 'days');
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
	var duration = moment.duration(bill_end_date.diff(bill_start_date));
	var hours = duration.asHours();
	var days_billing = hours/24;
	console.log("bill_start_date="+moment(bill_start_date).format('ll')+"bill_start_date="+moment(bill_end_date).format('ll')+"  schedule_units="+schedule_units+" Diff="+days_billing);

	var billing_units=schedule_units/days_billing;
	return billing_units;//daily_schedule*days_billing;
}
</script>
