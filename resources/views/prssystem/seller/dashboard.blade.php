@extends('prssystem.layouts.default')
@section('title')
Home Page
@stop
@section('content')
<style>
.box {
    padding: 0 5px 0 5px;
	margin-right:5px;
}
.box .inner {
    background-color: #fff;
}
</style>

<div style="background-color: #FFF">
	<div id="page-wrapper">
				<div class="graphs">
					<div class="col_3">
						<div class="col-md-2 widget widget1">
							<a href="{{route('orderlist',['type'=>'All'])}}">
							<div class="r3_counter_box">
								<i class="fa fa-mail-forward"></i>
								<div class="stats">
								  <h5>{{($allOrderType['order_recived']!='')?$allOrderType['order_recived']:0}}</h5>
								  <div class="grow">
									<p>New Order</p>
								  </div>
								</div>
							</div>
							</a>
						</div>
						<div class="col-md-2 widget widget1">
							<a href="{{route('orderlist',['type'=>'Processing'])}}">
							<div class="r3_counter_box">
								<i class="fa fa-mail-forward"></i>
								<div class="stats">
								  <h5>{{($allOrderType['processing']!='')?$allOrderType['processing']:0}}</h5>
								  <div class="grow">
									<p>Processing</p>
								  </div>
								</div>
							</div>
							</a>
						</div>
						<div class="col-md-2 widget widget1">
							<a href="{{route('orderlist',['type'=>'Canceled'])}}">
							<div class="r3_counter_box">
								<i class="fa fa-users"></i>
								<div class="stats">
								  <h5>{{($allOrderType['canceled']!='')?$allOrderType['canceled']:0}}</h5>
								  <div class="grow grow1">
									<p>Canceled</p>
								  </div>
								</div>
							</div>
							</a>
						</div>

						<div class="col-md-2 widget widget1">
							<a href="{{route('orderlist',['type'=>'Complete'])}}">
							<div class="r3_counter_box">
								<i class="fa fa-eye"></i>

								<div class="stats">
								  <h5>{{($allOrderType['delivered']!='')?$allOrderType['delivered']:0}}</h5>
								  <div class="grow grow3">
									<p>Delivered</p>
								  </div>
								</div>
							</div>
							</a>
						 </div>

						 <div class="col-md-3 widget">
							<div class="r3_counter_box">
								<i class="fa fa-inr"></i>
								<div class="stats">
								  <h5>₹{{($totalAmount!='')?$totalAmount:0}}</h5>
								  <div class="grow grow2">
									<p>Total Sell</p>
								  </div>
								</div>
							</div>
						</div>

						<div class="clearfix"> </div>
					</div>

</div>
<hr/>
<div>
	
	<!-- switches -->
		<div class="switches">
			<div class="col-3">
				<div class="col-md-4 switch-right">
					<div class="switch-right-grid">
						<div class="switch-right-grid1">
							<h3>TODAY'S STATS</h3>
							<p>Total Sales Today.</p>
							<ul>
								<li>Sell: ₹{{($totalTodaySell!='')?$totalTodaySell:0}}</li>
								<li>Total Items Sold: {{($totalTodayQuantity!='')?$totalTodayQuantity:0}} Items</li>
								<li>Total Order: {{$totalTodayOrder}}</li>
							</ul>
						</div>
					</div>
					<div class="sparkline">
						<canvas id="line" height="150" width="480" style="width: 480px; height: 150px;"></canvas>
							<script>
									var lineChartData = {
										labels : ["Mon","Tue","Wed","Thu","Fri","Sat","Mon"],
										datasets : [
											{
												fillColor : "#fff",
												strokeColor : "#F44336",
												pointColor : "#fbfbfb",
												pointStrokeColor : "#F44336",
												data : [20,35,45,30,10,65,40]
											}
										]
										
									};
									new Chart(document.getElementById("line").getContext("2d")).Line(lineChartData);
							</script>
					</div>
				</div>
				<div class="col-md-3 switch-right">
					<div class="switch-right-grid">
						<div class="switch-right-grid1">
							<h3> <b>{{strtoupper(date('F'))}}</b> MONTH STATS</h3>
							<p>View All Month Stats Please , <a href="#">Click Here</a>.</p>
							<ul>
								<li>Total Order: {{($totalTodayOrder!='')?$totalTodayOrder:0}}</li>
								<li>Earning: ₹{{($totalMonthSell!='')?$totalMonthSell:0}}</li>
								<li>Items Sold: {{($totalMonthQuantity!='')?$totalMonthQuantity:0}} Items</li>
							</ul>
						</div>
					</div>
					<div class="sparkline">
						<canvas id="bar" height="150" width="480" style="width: 480px; height: 150px;"></canvas>
							<script>
								var barChartData = {
									labels : ["Mon","Tue","Wed","Thu","Fri","Sat","Mon","Tue","Wed","Thu"],
									datasets : [
										{
											fillColor : "#8BC34A",
											strokeColor : "#8BC34A",
											data : [25,40,50,65,55,30,20,10,6,4]
										},
										{
											fillColor : "#8BC34A",
											strokeColor : "#8BC34A",
											data : [30,45,55,70,40,25,15,8,5,2]
										}
									]
									
								};
									new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
							</script>
					</div>
				</div>

				<div class="col-md-3 switch-right">
					<div class="switch-right-grid">
						<div class="switch-right-grid1">
							<h3>ALLTIME STATS</h3>
							<p>All Sales Report.</p>
							<ul>
								<li>Total Order: {{$totalTodayOrder}}</li>
								<li>Total Earning: ₹{{$totalAmount}}</li>
								<li>Total Items Sold: {{$totalQuantity}} Items</li>
								
							</ul>
						</div>
					</div>
					<div class="sparkline">
						<!--graph-->
						<link rel="stylesheet" href="{{config('global.THEME_URL_CSS').'/profile/'}}graph.css">
						<script src="{{config('global.THEME_URL_JS').'/profile/'}}jquery.flot.min.js"></script>
					<!--//graph-->
							<script>
								$(document).ready(function () {
								
									// Graph Data ##############################################
									var graphData = [{
											// Returning Visits
											data: [ [4, 4500], [5,3500], [6, 6550], [7, 7600],[8, 4500], [9,3500], [10, 6550], ],
											color: '#FFCA28',
											points: { radius: 7, fillColor: '#fff' }
										}
									];
								
									// Lines Graph #############################################
									$.plot($('#graph-lines'), graphData, {
										series: {
											points: {
												show: true,
												radius: 1
											},
											lines: {
												show: true
											},
											shadowSize: 0
										},
										grid: {
											color: '#fff',
											borderColor: 'transparent',
											borderWidth: 10,
											hoverable: true
										},
										xaxis: {
											tickColor: 'transparent',
											tickDecimals: false
										},
										yaxis: {
											tickSize: 1200
										}
									});
								
									// Graph Toggle ############################################
									$('#graph-bars').hide();
								
									$('#lines').on('click', function (e) {
										$('#bars').removeClass('active');
										$('#graph-bars').fadeOut();
										$(this).addClass('active');
										$('#graph-lines').fadeIn();
										e.preventDefault();
									});
								
									$('#bars').on('click', function (e) {
										$('#lines').removeClass('active');
										$('#graph-lines').fadeOut();
										$(this).addClass('active');
										$('#graph-bars').fadeIn().removeClass('hidden');
										e.preventDefault();
									});
								
								});
							</script>
							<div id="graph-wrapper">
								<div class="graph-container">
									<div id="graph-lines"> </div>
									<div id="graph-bars"> </div>
								</div>
							</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- //switches -->	
</div>
<hr/>
<div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:50%;">
    40%
  </div>
</div>
<div id="page-wrapper" style="background-color:#87d372;color:#FFF;">

<div class="graphs" >
<h5>Complete your profile to start selling !</h5>
						<div class="col_3" >
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box" style="color:#666;border-radius: 5px;">
							<i class="fa fa-users"></i><br/>
								<b style="font-size:16px;margin-top:10px;color:#999">Business Details</b><br/>
								<p style="font-size:12px;margin-top:10px;color:#666">You need to provide your GSTIN, TAN and other business information</p>
								<hr style="margin-bottom:10px;">
								<div style="font-size:14px;text-align:center;padding-bottom:10px;">
								<a href="#">Add Details</a>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box" style="color:#666;border-radius: 5px;">
							<i class="fa fa-bank"></i><br/>
								<b style="font-size:16px;margin-top:10px;color:#999">Bank Details</b><br/>
								<p style="font-size:12px;margin-top:10px;color:#666">We need your bank account details and KYC documents to verify your bank account
</p>
								<hr style="margin-bottom:10px;">
								<div style="font-size:14px;text-align:center;padding-bottom:10px;">
								<a href="#">Add Details</a>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box" style="color:#666;border-radius: 5px;">
							<i class="fa fa-bank"></i><br/>
								<b style="font-size:16px;margin-top:10px;color:#999">Store QR Code</b><br/>
								<p style="font-size:12px;margin-top:10px;color:#666">You need to update your display name  and  business  description
								</p>
								<hr style="margin-bottom:10px;">
								<div style="font-size:14px;text-align:center;padding-bottom:10px;">
								<a href="{{route('seller')}}">See Details</a>
								</div>
							</div>
						</div>
						
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box" style="color:#666;border-radius: 5px;">
							<i class="fa fa-bank"></i><br/>
								<b style="font-size:16px;margin-top:10px;color:#999">Add Products</b><br/>
								<p style="font-size:12px;margin-top:10px;color:#666">You need to add at least one product to activate account<br>
</p>
								<hr style="margin-bottom:10px;">
								<div style="font-size:14px;text-align:center;padding-bottom:10px;">
								<a href="{{route('selleraddproduct')}}">Add Products</a>
								</div>
							</div>
						</div>
						
						
						<div class="clearfix"> </div>
					</div>



        
        
    </div>
</div>


<script>
$("#logo").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#msg').html("Only formats are allowed : "+fileExtension.join(', '));
            $('#logo').val('');
        }
    });
</script>
@stop
@section('footer_scripts')
@stop
