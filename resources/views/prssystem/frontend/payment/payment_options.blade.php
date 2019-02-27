@extends('prssystem/layouts/frontDetails')
@section('title')
    Select a delivery address
@stop
@section('content')
<section class="reserve-block" style="font-size: 12px !important">
        <div class="container">
		
        <div class="row">
			<div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="font-size: 16px;">Payment Option</div>
                    <div class="">
                    <label id="cod" style="background-color: #f7f7f7; width: 100%; padding: 15px; border-bottom: dashed thin #ccc; margin-top: 5px; font-weight: bold; font-size: 14px;" onclick="setType('{{encrypt(1)}}')">  
                        <input type="radio" name="paymentType" class="paymentType" value="{{encrypt(1)}}">&nbsp;&nbsp;
                        Credit / Debit Card / ATM Card

                    </label>

                    <label id="cod" style="background-color: #f7f7f7; width: 100%; padding: 15px; border-bottom: dashed thin #ccc; margin-top: 5px; font-weight: bold; font-size: 14px;" onclick="setType('{{encrypt(1)}}')">  
                        <input type="radio" name="paymentType" class="paymentType" value="{{encrypt(2)}}">&nbsp;&nbsp;
                        Pay At Shop

                    </label>
                   
                    <label id="pal" style="background-color: #f7f7f7; width: 100%; padding: 15px; border-bottom: dashed thin #ccc;font-size: 14px; cursor: not-allowed; "  onclick="setType('{{encrypt(2)}}')">    
                        <input type="radio" name="paymentType" class="paymentType" value="{{encrypt(3)}}" disabled="disabled">&nbsp;&nbsp;
                        Pay Later
                    </label>
                   
                    <label id="ccdebatm" style="background-color: #f7f7f7; width: 100%; padding: 15px; border-bottom: dashed thin #ccc;font-size: 14px; cursor: not-allowed;" onclick="setType('{{encrypt(3)}}')">    
                        <input type="radio" name="paymentType" class="paymentType" value="{{encrypt(1)}}">&nbsp;&nbsp;
                        Credit / Debit Card / ATM Card
                    </label>
                   
                    <label id="ccdebatm" style="background-color: #f7f7f7; width: 100%; padding: 15px; border-bottom: dashed thin #ccc;font-size: 14px; cursor: not-allowed;" onclick="setType('{{encrypt(5)}}')">    
                        <input type="radio" name="paymentType" value="{{encrypt(1)}}">&nbsp;&nbsp;
                        Phone Pay / UPI / BHIM UPI
                    </label>
                    <label id="ccdebatm" style="background-color: #f7f7f7; width: 100%; padding: 15px; border-bottom: dashed thin #ccc;font-size: 14px; cursor: not-allowed;" onclick="setType('{{encrypt(5)}}')">     
                        <input type="radio" name="paymentType" class="paymentType" value="{{encrypt(1)}}">&nbsp;&nbsp;
                        Net Banking
                    </label>
                    </div>
                    </div>
			</div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header" style="font-size: 16px;">Payment Summery</div>
                    <div class="card-body">
                       @if(!empty($cartItem))
                        <div class="row" style="font-size: 14px;">
                            <div class="col-sm-9">Subtotal</div>
                            <div class="col-sm-3">₹{{$subTotal}}</div>
                        </div><br/>    
                        <div class="row" style="font-size: 14px;">
                            <div class="col-sm-9">Shipping Fee </div>
                            <div class="col-sm-3">₹0</div>
                        </div> 
                        <hr style="margin-bottom:1px; padding:5px">
                        <div class="row" style="font-size: 14px;">
                            <div class="col-sm-9"><b>Total</b> </div>
                            <div class="col-sm-3"><b>₹{{$total}}</b></div>
                        </div> 
                        <hr style="margin-bottom:1px; padding:5px">
                        <center>
                        <div class="reserve-btn row">
                            <div class="featured-btn-wrap">
                                @if(Auth::check()) 
                                <a style="width: 100%" href="javascript:void(0)" onclick="return submitForm()" class="btn btn-danger">Pay ₹{{$total}}</a>
                                @else
                                <a href="{{route('login')}}" class="btn btn-danger">Login To Order</a>
                                @endif
                            </div>
                        </div>
                        </center>
                        @endif
                    </div>
                </div>
            </div>
		</div>
	    </div>
    </section>
    <form action="{{route('orderpost')}}" method="get" id="_op">
        <input type="hidden" name="_pt" id="pt" >
        <input type="hidden" name="_tm" id="tm" value="{{encrypt($total)}}">
        <input type="hidden" name="_sp" id="sp" value="{{$shipping_id}}">
        {{csrf_field()}}
    </form>
    <!--//END RESERVE A SEAT -->
    <!--============================= BOOKING DETAILS =============================-->
    <!--//END BOOKING DETAILS -->
    
<script>
    function setType(e){
        $('#pt').val(e);
    }


   function submitForm(){
     if($('#pt').val()!=''){
        $('#_op').submit();
     }else{
        getAlert('Error','Please Choose Payment Type','error');
     }   
}
    function getAlert(a,b,c){
        swal({
          title:a,
          text: b,
          icon: c,
        });
    }


</script>
@stop
@section('footer_scripts')
@stop