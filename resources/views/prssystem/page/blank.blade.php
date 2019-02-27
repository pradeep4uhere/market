@extends('prssystem/layouts/frontDetails')
@section('title')
    Select a delivery address
@stop
@section('content')
<section class="reserve-block" style="font-size: 12px !important">
        <div class="container">
		<div class="row">
				<div class="col-md-12">
				<center>
                    <img src="{{config('global.THEME_URL_FRONT_IMAGE')}}/order_placed.png" class="img-fluid" alt="#"></br>
                    </br>
                    <div style="font-size: 24px;">Thank you for your purchase !</div>
                    <div style="font-size: 16px;">Hi {{Auth::user()->first_name}}, we're getting your order ready to be shipped. We will notify you when it has been sent.</div>
                    <div style="font-size: 15px;"><strong>Order ID:: {{$orderID}}</strong></div>
                </center>
				</div>
		</div>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                <div class="col-md-7">
                <p>Your Order Details</p>
                @if(!empty($orderDetails))
                    @foreach($orderDetails['OrderDetail'] as $item)
                    <div class="row">

                    <div class="col-sm-2">
                        <a href="{{route('details',['slug'=>str_slug($item['product_name']),'id'=>encrypt($item['user_product_id'])])}}">
                            <img style="width:200px;height: 100px; " src="{{ $item['default_thumbnail']}}" class="img-fluid" alt="#">
                        </a>
                    </div>
                    <div class="col-sm-6 left-align" >
                        <div style="font-size: 16px;">{{ucwords($item['product_name'])}}</div>
                        <div style="font-size: 12px; ">Brand:&nbsp;<span style="color: orange; font-weight: bold">{{ucwords($item['brand_name'])}}</span></div>
                        <div style="font-size: 13px;">Seller:&nbsp;
                            <span style="color: #333; font-weight: bold">{{ucwords($item['seller_name'])}}</span></div>
                        <div style="font-size: 13px;">Quantity:&nbsp;
                            <span style="color: #333; font-weight: bold">{{$item['quantity']}}</span></div>
                        <div>Order Id - {{$item['order_track']}}</div>
                            
                    </div>
                  
                    <div class="col-sm-3">
                        <div style="font-size: 16px;">
                            <p style="color: black">
                            ₹{{$item['quantity']*$item['unit_price']}}
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

                </div>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-6" >
                            <p>Order Summery</p>
                            <div style="font-size:12px;">Order ID      : {{$orderID}}</BR>
                            Order Date    : {{$orderDate}}</BR>
                            Order Total   : ₹{{$totalAmount}}</BR>
                            Payment Method: Cash On Deleviry</div>
                        </div>
                        <div class="col-md-6">
                            <p>Address Summery</p>
                            <div style="font-size:12px;">
                                {{$address['full_name']}},<br/>
                                {{$address['address_1']}},{{$address['address_2']}},<br/>
                                {{$address['landmarks']}},{{$address['pincode']}},{{$address['country']}}
                            </div>
                        </div>
                    </div>
                    <HR/>
                    <center><a href="{{route('home')}}" class="btn top-btn" style="background-color:#ff3a6d;color:#FFF" id="payment"> Continue For More Shopping</a></center>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
@stop
@section('footer_scripts')
@stop