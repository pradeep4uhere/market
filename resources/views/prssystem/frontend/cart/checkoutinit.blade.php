@extends('prssystem/layouts/frontDetails')
@section('title')
    My Delivery Address
@stop
@section('content')
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style type="text/css">
	
/*  bhoechie tab */
div.bhoechie-tab-container{
  z-index: 10;
  background-color: #ffffff;
  padding: 0 !important;
  border-radius: 4px;
  -moz-border-radius: 4px;
  border:1px solid #ddd;
  margin-top: 20px;
  margin-left: 50px;
  -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  box-shadow: 0 6px 12px rgba(0,0,0,.175);
  -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  background-clip: padding-box;
  opacity: 0.97;
  filter: alpha(opacity=97);
}
div.bhoechie-tab-menu{
  padding-right: 0;
  padding-left: 0;
  padding-bottom: 0;
}
div.bhoechie-tab-menu div.list-group{
  margin-bottom: 0;
}
div.bhoechie-tab-menu div.list-group>a{
  margin-bottom: 0;
}
div.bhoechie-tab-menu div.list-group>a .glyphicon,
div.bhoechie-tab-menu div.list-group>a .fa {
  color: #5A55A3;
}
div.bhoechie-tab-menu div.list-group>a:first-child{
  border-top-right-radius: 0;
  -moz-border-top-right-radius: 0;
}
div.bhoechie-tab-menu div.list-group>a:last-child{
  border-bottom-right-radius: 0;
  -moz-border-bottom-right-radius: 0;
}
div.bhoechie-tab-menu div.list-group>a.active,
div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
div.bhoechie-tab-menu div.list-group>a.active .fa{
  background-color: #5A55A3;
  background-image: #5A55A3;
  color: #ffffff;
}
div.bhoechie-tab-menu div.list-group>a.active:after{
  content: '';
  position: absolute;
  left: 100%;
  top: 50%;
  margin-top: -13px;
  border-left: 0;
  border-bottom: 13px solid transparent;
  border-top: 13px solid transparent;
  border-left: 10px solid #5A55A3;
}

div.bhoechie-tab-content{
  background-color: #ffffff;
  /* border: 1px solid #eeeeee; */
  padding-left: 20px;
  padding-top: 10px;
}

div.bhoechie-tab div.bhoechie-tab-content:not(.active){
  display: none;
}

div .mb-5{
	margin-bottom: 5px;
}
</style>
<section class="reserve-block" style="font-size: 12px !important">
<div class="container">
	<div class="row">
        <div class="col-lg-12 col-md-5 col-sm-8 col-xs-9 bhoechie-tab-container">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
              <div class="list-group">
                <a href="#" class="list-group-item active text-center">
                  <h4 name="shippingType" value="1" class="addressType" id="delivery" >Shipping Address</h4>
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="addressType" id="delivery" value="2">Pickup Address</h4>
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="">Add New Address</h4>
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="">&nbsp;</h4>
                </a>
                <a href="#" class="list-group-item text-center">
                  <h4 class="">&nbsp;</h4>
                </a>
              </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                <!-- flight section -->
                <div class="bhoechie-tab-content active">
                	<div class="row">
                	@if(count($address)>0)
                    @foreach($address as $item)
					
					<div class="col-md-6 mb-5">
						<div class="card cardClass" id="card_{{$item->id}}" >
						<div class="card-header" style="font-size: 16px;">{{ucwords($item->full_name)}}</b></div>
						<div class="card-body" style="font-size: 13px !important">
						<div class="">
						<div>{{$item->address_1}}</div>	
						<div>{{$item->address_2}}</div>	
						<div>{{$item->landmarks}}</div>	
						<div>{{$item->city_id}}, {{$item->state_id}}, {{$item->pincode}}, {{$item->country}}
							<input type="hidden" id="shipphide_{{$item->id}}" value="{{encrypt($item->id)}}"></div>	
						</div>
						<div>Mobile: {{$item->mobile}}</div>	
						<div>
						<button class="btn btn-info del" style="padding:8px; font-size:12px;margin-top:5px;" id="del_{{$item->id}}" >Delivery Here</button>
						<button class="btn btn-warning edit" style="padding:8px; font-size:12px;margin-top:5px;" id="edit_{{encrypt($item->id)}}" >&nbsp;&nbsp;Edit&nbsp;&nbsp;</button>
						<button class="btn btn-danger remove" style="padding:8px; font-size:12px;margin-top:5px;" id="remove_{{encrypt($item->id)}}">Remove</button>
						</div>
						</div>
						</div>
					</div>
					
				    @endforeach
				    @endif
                	</div>
                </div>
                <!-- train section -->
                <div class="bhoechie-tab-content">
                   <div class="row" id="pickAddress">
                    @if(!empty($sellerAddress))
                    @foreach($sellerAddress as $name=>$seller)
					<div class="col-md-12">
					<div style="font-size:16px;"> Pickup Address For Seller :: {{$name}}</div>
					<hr/>
					@foreach($seller as $item)
					<div class="col-md-6">
						<div class="card">
						<div class="card-header" style="font-size: 16px;">{{$item->full_name}}</b></div>
						<div class="card-body" style="font-size: 13px !important">
						<div class="">
						<div>{{$item->address_1}}</div>	
						<div>{{$item->address_2}}</div>	
						<div>{{$item->location}}</div>	
						<div>{{$item->district}}, {{$item->state}}, {{$item->pincode}}, {{$item->country}}
							 <input type="hidden" id="picphide_{{$item->id}}" value="{{encrypt($item->id)}}">
						</div>	
						</div>
						<button class="btn btn-info pic" style="padding:8px; font-size:12px;margin-top:5px;" id="del_{{$item->id}}" >Pick Up Here</button>
						</div>
						
						
						</div>
						<br/>
						<br/>
					</div>
					@endforeach
					
					</div>
					
				    @endforeach
                    
			        @endif
					</div>
                </div>
    
                <!-- hotel search -->
                <div class="bhoechie-tab-content">
                    @include('prssystem.partials.user.addaddress')
                </div>
                <div class="bhoechie-tab-content">
                    <center>
                      <h1 class="glyphicon glyphicon-cutlery" style="font-size:12em;color:#55518a"></h1>
                      <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
                    </center>
                </div>
                <div class="bhoechie-tab-content">
                    <center>
                      <h1 class="glyphicon glyphicon-credit-card" style="font-size:12em;color:#55518a"></h1>
                      <h2 style="margin-top: 0;color:#55518a">Cooming Soon</h2>
                    </center>
                </div>
            </div>
        </div>
  </div>
  <div style="border-bottom: solid 1px #eee; margin-top:10px;margin-bottom:10px;"></div>
    <a href="javascript:void(0))" class="btn top-btn" style="background-color:#ff3a6d;color:#FFF; float: right; padding:10px;" id="payment"> Procced To Payment</a>
</div>

</section>
<script type="text/javascript">
	$(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});
</script>
<!-- 

<section class="reserve-block" style="font-size: 12px !important">
        <div class="container">
            <div class="row">
				<div class="col-md-12">
				<div class="row">
				<div class="col-md-4">
				<label class="btn btn-info"><input type="radio" name="shippingType" value="1" class="addressType" id="delivery" checked>&nbsp;&nbsp;I want Item Deliver To My Address</label>
				</div>
				<div class="col-md-4">
				<label  class="btn btn-info"><input type="radio" id="pickup" name="shippingType" value="2" class="addressType">&nbsp;&nbsp;I Will Pick From Shop</label>
				</div>
				</div>
                <div class="col-md-12" style="padding-left: 0px; margin-left: 0px;">
                <div class="">
                <div class="card-body">
					<div class="row" id="delAddress">
						<?php //dd($address);?>
                    @if(count($address)>0)
                    @foreach($address as $item)
					
					<div class="col-md-4">
						<div class="card cardClass" id="card_{{$item->id}}" >
						<div class="card-header" style="font-size: 16px;">{{ucwords($item->full_name)}}</b></div>
						<div class="card-body" style="font-size: 13px !important">
						<div class="">
						<div>{{$item->address_1}}</div>	
						<div>{{$item->address_2}}</div>	
						<div>{{$item->landmarks}}</div>	
						<div>{{$item->city_id}}, {{$item->state_id}}, {{$item->pincode}}, {{$item->country}}
							<input type="hidden" id="shipphide_{{$item->id}}" value="{{encrypt($item->id)}}"></div>	
						</div>
						<div>Mobile: {{$item->mobile}}</div>	
						<div>
						<button class="btn btn-info del" style="padding:8px; font-size:12px;margin-top:5px;" id="del_{{$item->id}}" >Delivery Here</button>
						<button class="btn btn-warning edit" style="padding:8px; font-size:12px;margin-top:5px;" id="edit_{{encrypt($item->id)}}" >&nbsp;&nbsp;Edit&nbsp;&nbsp;</button>
						<button class="btn btn-danger remove" style="padding:8px; font-size:12px;margin-top:5px;" id="remove_{{encrypt($item->id)}}">Remove</button>
						</div>
						</div>
						</div>
					</div>
					
					
				    @endforeach

				    <div class="col-md-3">
						<div class="card">
						<div class="card-header" style="background-color: #ff3a6d; color: #FFF; font-weight: bold;">Add New Address</div>
						<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
						<div class="card-body" style="min-height: 150px;">
						<center>
						 	<img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/more.png" class="img-fluid" alt="image" style="width:100px;">	
						</center>
						</div>
						</a>
						</div>
					</div>
                    @else
					 <div class="col-md-4">
						<div class="card">
						<div class="card-header" style="font-size: 16px; background-color: #ff3a6d">Add New Address</b></div>
						<div class="card-body" style="font-size: 13px !important;min-height: 186px;">
						<center>
							<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal">
						 <img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/assaddress.jpg" class="img-fluid" alt="#">	
						</a>
						</center>
						</div>
						</div>
					</div>
			        @endif
					</div>
					
					<div class="row" id="pickAddress" style="display:none">
                    @if(!empty($sellerAddress))
                    @foreach($sellerAddress as $name=>$seller)
					<div class="col-md-12">
					<div style="font-size:16px;"> Pickup Address For Seller :: {{$name}}</div>
					<hr/>
					@foreach($seller as $item)
					<div class="col-md-4">
						<div class="card">
						<div class="card-header" style="font-size: 16px;">{{$item->full_name}}</b></div>
						<div class="card-body" style="font-size: 13px !important">
						<div class="">
						<div>{{$item->address_1}}</div>	
						<div>{{$item->address_2}}</div>	
						<div>{{$item->landmarks}}</div>	
						<div>{{$item->city_id}}, {{$item->state_id}}, {{$item->pincode}}, {{$item->country}}</div>	
						</div>
						<button class="btn btn-info pic" style="padding:8px; font-size:12px;margin-top:5px;" id="del_{{$item->id}}" >Delivery Here</button>
						</div>
						
						
						</div>
						<br/>
						<br/>
					</div>
					@endforeach
					
					</div>
					
				    @endforeach
                    
			        @endif
					</div>
                </div> 
				
				
                </div>
                    
                </div>
                
            </div>
            
           
        </div>
         <div style="border-bottom: solid 1px #eee; margin-top:10px;margin-bottom:10px; "></div>
    <a href="javascript:void(0))" class="btn top-btn" style="background-color:#ff3a6d;color:#FFF" id="payment"> Procced To Payment</a>
    </section>
 -->
    
    
    </section>
    <!--//END RESERVE A SEAT -->
    <!--============================= BOOKING DETAILS =============================-->
    <!--//END BOOKING DETAILS -->
    
	<form id="choosePay" action="{{route('preorder')}}" method="get">
		<input type="hidden" name="pickup" id="pickupAddress">
		<input type="hidden" name="shippingAddress" id="shippingAddress">
		<input type="hidden" name="sellerIDArr" value="{{$sellerIDArr}}">
		{{csrf_field()}}
	</form>



<script>
	function getCity(state_id){
		var token = "{{csrf_token()}}";
		var POST_LOCATION_URL = "{{route('getcity')}}";
	    var postJson={_token:token,state_id:state_id};
		$.ajax({
			type:'POST',
			url:POST_LOCATION_URL,
			data:postJson, 
			beforeSend:function(){
				$('#city').html('Please wait...');
			},       
			success:function(res){
				var result = JSON.parse(res);
				if(result.status=='success'){
					$('#city').html(result.result);
				}
			}
		});

	}



	$(document).ready(function(){
	function getAlert(a,b,c){
		swal({
		  title:a,
		  text: b,
		  icon: c,
		});
	}
	
	$('#payment').click(function(){
		var shippingAddress = $('#shippingAddress').val();
		var pickupAddress = $('#pickupAddress').val();
		if(shippingAddress!='' || pickupAddress!=''){
			$('#choosePay').submit();
		}else{
			 if($('#delivery').is(':checked')) { 
				getAlert('Error!','Please select atleast one delivery address!','error');
			 }else{
				getAlert('Error!','Please Select Shipping Address or Pickup Address!','error');
			}
		}
	});
		
		
		
		
		
	//Select Delevery Address
	$('.del').click(function(){
		var idStr =$(this).attr('id'); 
		var idStrArr =idStr.split('_'); 
		var id =idStrArr[1];
		$('.cardClass').removeClass('bg-info');
		$('#card_'+id).addClass('bg-info');
		$('#shippingAddress').val($('#shipphide_'+id).val());
	});


	$('.pic').click(function(){
		var idStr =$(this).attr('id'); 
		var idStrArr =idStr.split('_'); 
		var id =idStrArr[1];
		$('.cardClass').removeClass('bg-info');
		$('#card_'+id).addClass('bg-info');
		$('#pickupAddress').val($('#picphide_'+id).val());
	});


	$('.remove').click(function(){
		var idStr =$(this).attr('id'); 
		var idStrArr =idStr.split('_'); 
		var id =idStrArr[1];
		$('#card_'+id).parent('div').remove();
		removeAddress(id);
	});
	
	$('.edit').click(function(){
		var idStr =$(this).attr('id'); 
		var idStrArr =idStr.split('_'); 
		var id =idStrArr[1];
		$("#myModal").modal('show');
		$('#addressSpan').html('Update Address');
		getAddress(id);
		//alert('Open Model Box For Update Address');
	});

	function removeAddress(id){
		var token = "{{csrf_token()}}";
		var POST_LOCATION_URL = "{{route('removeaddress')}}";
	    var postJson={_token:token,id:id};
		$.ajax({
			type:'POST',
			url:POST_LOCATION_URL,
			data:postJson,        
			success:function(res){
				var result = JSON.parse(res);
				if(result.status=='success'){
					var idStr= "#card_"+id;
					$(idStr).fadeOut();
					getAlert('Success!','Delivery Address Removed!','success');
				}
			}
		});
	}


	function getAddress(id){
		var token = "{{csrf_token()}}";
		var POST_LOCATION_URL = "{{route('getaddress')}}";
	    var postJson={_token:token,id:id};
		$.ajax({
			type:'POST',
			url:POST_LOCATION_URL,
			data:postJson,        
			success:function(res){
				var result = JSON.parse(res);
				if(result.status=='success'){
					$('#full_name').val(result.result.full_name);
					$('#address_1').val(result.result.address_1);
					$('#address_2').val(result.result.address_2);
					
					$('#landmarks').val(result.result.landmarks);
					$('#mobile').val(result.result.mobile);
					$('#pincode').val(result.result.pincode);
					$('select[name=state_id]').val(result.result.state_id).change();
					getCity(result.result.state_id);
					setTimeout(function(){
						$('select[name=city_id]').val(result.result.city_id).change();
					},2000);
					$('#id').val(result.result.id);
				}
			}
		});

	}

	
	
	$('.addressType').click(function(){
			if($(this).val()==1){
				$('#delAddress').fadeIn();
				$('#pickAddress').hide();
			}else{
				$('#pickAddress').fadeIn();
				$('#delAddress').hide();
			}
		});
		//$('#pickAddress').fadeOut();
	});
        function updateCart(v,i){
            $('#qnty').val(v);
            $('#cart_id').val(i);
            $('#cart').submit();
        }
    </script>
    
@stop

@section('footer_scripts')
    
@stop