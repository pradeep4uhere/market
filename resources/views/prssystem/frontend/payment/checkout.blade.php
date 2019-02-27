@extends('prssystem/layouts/frontDetails')
@section('title')
    Select a delivery address
@stop
@section('content')
<section class="reserve-block" style="font-size: 12px !important">
        <div class="container">
		<div class="row">
				<div class="col-md-12">
				<p>Order Details</p>
				<p>Total Amount: {{$totalAmount}}</p>
				</div>
		</div>
        <div class="row">
		<div class="col-md-12">
		<button class="btn btn-info">Cash On Delivery</button>
		</div>
		</div>
        </div>
        </div>
    </section>
<script>
$(document).ready(function(){
	function getAlert(a,b,c){
		swal({
		  title:a,
		  text: b,
		  icon: c,
		});
	}
	});
</script>
@stop
@section('footer_scripts')
@stop