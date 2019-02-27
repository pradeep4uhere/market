@extends('prssystem/layouts/frontDetails')
@section('title')
    Select a delivery address
@stop
@section('content')
<section class="reserve-block" style="font-size: 12px !important">
        <div class="container">
		<div class="row">
				<div class="col-md-12">
				<span style="font-size:16px; font-weight: bold ">You Order Details</span>
				</div>
				</div>
			<hr/>
            <div class="row">
				<div class="col-md-12">
				<div style="font-size:14px;" class="alert alert-success">
					<span style="font-size:16px; font-weight: bold ">Shipping Address</span><br/>
					{{$address['full_name']}},<br/>
					{{$address['address_1']}},{{$address['address_2']}},<br/>
					{{$address['landmarks']}},{{$address['pincode']}},{{$address['country']}}
				</div>
				<span style="font-size:16px; font-weight: bold ">Your Item List</span>
				</div>
				
				
				</div>
				<hr/>
				<div class="row">
					<div class="col-md-12">
					@if(!empty($cartItem))
                    @foreach($cartItem as $item)
                    <div class="row">
                    <div class="col-sm-2">
                    	<a href="{{route('details',['slug'=>str_slug($item['name']),'id'=>encrypt($item['id'])])}}">
                        <img style="width:200px;height: 100px; " src="{{ $item['attributes']['default_thumbnail']}}" class="img-fluid" alt="#">
                    </a>
                        </div>
                    <div class="col-sm-6 left-align" >
                        <div style="font-size: 16px;">{{ucwords($item['name'])}}</div>
                        <div style="font-size: 12px; ">Brand:&nbsp;<span style="color: orange; font-weight: bold">{{ucwords($item['attributes']['brandName'])}}</span></div>
                        <div style="font-size: 13px;">Seller:&nbsp;
                            <span style="color: #333; font-weight: bold">{{ucwords($item['attributes']['seller'])}}</span></div>
                        <div style="font-size: 13px;">Quantity:&nbsp;
                            <span style="color: #333; font-weight: bold">{{$item['quantity']}}</span></div>
                            
                    </div>
                  
                    <div class="col-sm-3">
                        <div style="font-size: 16px;">
                            <p style="color: black">
                            ₹{{$item['quantity']*$item['price']}}
                            </p>

                        </div>
                        
                    </div>
                    <div class="col-sm-1">
                    	<a href="#">
         					 <i class="fa fa-edit" style="font-size:24px"></i>
        				</a>
                    </div>
                </div> 
                    <hr/>
                    @endforeach
                    @endif
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-6" style="font-size: 16px;"><p style="color: black">Total Pay:</p></div>
                    <div class="col-sm-3" style="font-size: 16px;"><p style="color: black">₹{{$total}} </p></div>

                </div>
                <hr/>
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-6"></div>
                    <div class="col-sm-3">
                    	<a href="{{route('choosepayment')}}?act=paymentOptions&t={{encrypt($total)}}&s={{encrypt($address['id'])}}" class="btn top-btn" style="background-color:#ff3a6d;color:#FFF" id="payment"> Procced To Payment</a>
                    </div>
                </div>
					
				</div>
				</div>
				
				
               
                
            </div>
            
           
        </div>
    </section>
    
    
    
    </section>
    <!--//END RESERVE A SEAT -->
    <!--============================= BOOKING DETAILS =============================-->
    <!--//END BOOKING DETAILS -->
    
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