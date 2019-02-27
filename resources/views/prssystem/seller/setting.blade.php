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
.progress{
	height: 25px;
}
</style>

<div style="background-color: #FFF">
	<div id="page-wrapper">
		<p style="border: solid 1px #CCC; border-left: solid 5px #F5644C; padding: 10px">Complete your profile to start selling !</p>
		
<div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:50%;">
    40%
  </div>
</div>
<div id="page-wrapper" style="background-color:#87d372;color:#FFF;">

<div class="graphs" >

						<div class="col_3" >
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box" style="color:#666;border-radius: 5px;">
							<i class="fa fa-users"></i><br/>
								<b style="font-size:16px;margin-top:10px;color:#999">Business Details</b><br/>
								<p style="font-size:12px;margin-top:10px;color:#666">You need to provide your GSTIN, TAN and other business information</p>
								<hr style="margin-bottom:10px;">
								<div style="font-size:14px;text-align:center;padding-bottom:10px; ">
								<a href="{{route('seller')}}" style="font-weight: bold">Add Details</a>
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
								<a href="{{route('seller')}}"  style="font-weight: bold">Add Details</a>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box" style="color:#666;border-radius: 5px;">
							<i class="fa fa-bank"></i><br/>
								<b style="font-size:16px;margin-top:10px;color:#999">Store Details</b><br/>
								<p style="font-size:12px;margin-top:10px;color:#666">You need to update your display name and business description
</p>
								<hr style="margin-bottom:10px;">
								<div style="font-size:14px;text-align:center;padding-bottom:10px;">
								<a href="{{route('seller')}}"  style="font-weight: bold">Add Details</a>
								</div>
							</div>
						</div>
						
						<div class="col-md-3 widget widget1">
							<div class="r3_counter_box" style="color:#666;border-radius: 5px;">
							<i class="fa fa-bank"></i><br/>
								<b style="font-size:16px;margin-top:10px;color:#999">Add Products</b><br/>
								<p style="font-size:12px;margin-top:10px;color:#666">You need to add at least one product to activate account
</p>
								<hr style="margin-bottom:10px;">
								<div style="font-size:14px;text-align:center;padding-bottom:10px;">
								<a href="{{route('selleraddproduct')}}"  style="font-weight: bold">Add Details</a>
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
