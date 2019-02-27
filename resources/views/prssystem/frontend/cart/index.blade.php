@extends('prssystem/layouts/frontDetails')
@section('title')
My Shopping Cart
@stop
@section('content')
<style type="text/css">
    .row-bordered:after {
  content: "";
  display: block;
  border-bottom: 1px solid #ccc;
  margin: 0 0px 25px 0px;
  padding: 0 0px 25px 0px;
}
</style>
<section class="reserve-block">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="row ">
               <div class="col-md-12 row-bordered">
                  <div class="row">
                     <div class="col-md-10">
                           <b>My Item ({{$count}} Items) </b>
                     </div>
                     <div class="col-md-2">
                        <a href="{{route('listing')}}" class="btn btn-danger">Continue Shopping </a>
                     </div>
                  </div>
               </div>
               <div class="col-md-8">
                  <div class="card">
                     <div class="card-header bg-info">Item List</div>
                     <div class="card-body card-success" style="font-size: 13px !important">
                        <?php $totalAmount=array();?>
                        @if(!empty($cartItem))
                        @foreach($cartItem as $item)
                        <div class="row">
                           <div class="col-sm-2">
                              <a href="{{route('details',['slug'=>str_slug($item['name']),'id'=>encrypt($item['id'])])}}">
                              <img style="width:200px;height: 100px; " src="{{ $item['attributes']['default_thumbnail']}}" class="img-fluid" alt="#">
                              </a>
                           </div>
                           <div class="col-sm-4 left-align" >
                              <div style="font-size: 14px;">
                                 <a href="{{route('details',['slug'=>str_slug($item['name']),'id'=>encrypt($item['id'])])}}">{{ucwords($item['name'])}}</a>
                              </div>
                              <div style="font-size: 11px; ">Brand:&nbsp;<span style="color: orange; font-weight: bold">{{ucwords($item['attributes']['brandName'])}}</span></div>
                              <div style="font-size: 11px;">Seller:&nbsp;
                                 <span style="color: #333;">{{ucwords($item['attributes']['seller'])}}</span>
                              </div>
                           </div>
                           <div class="col-sm-2">
                                <select class="custom-select"  style="font-size: 11px;" onchange="updateCart(this.value,'{{encrypt($item["id"])}}')" id="quantity_{{$item['id']}}">
                                 @for($i=1;$i<100;$i++)
                                 <option value="{{$i}}" @if($item['quantity']==$i) selected="selected" @endif>{{$i}}</option>
                                 @endfor
                                 </select>
                           </div>
                        
                           <div class="col-sm-2">₹{{$item['quantity']*$item['price']}}</div>
                          
                           <div class="col-sm-1 pull-right">
                                    <a style="font-size: 11px; padding:2px; font-weight: bold" href="{{route('removeCartItem',['id'=>encrypt($item['id'])])}}">
                                        <i class="fa fa-remove"></i>
                                    </a>
                           </div>
                        </div>
                        <?php $totalAmount[]=$item['quantity']*$item['price'];?>
                        <div style="border-bottom: solid 1px #eee; margin-top:10px;margin-bottom:10px; "></div>
                        @endforeach

                        @else
                        <div class="featured-btn-wrap">
                           <a href="{{route('listing')}}" class="btn btn-danger">No Item In your cart, Add Now</a>
                        </div>
                        @endif
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="card success">
                     <div class="card-header bg-info"> Payment Summary</div>
                     <div class="card-body" style="font-size: 11px !important">
                        @if(!empty($cartItem))
                        <div class="row">
                           <div class="col-sm-9">Subtotal</div>
                           <div class="col-sm-3">₹{{$subTotal}}</div>
                        </div>
                        <div class="row">
                           <div class="col-sm-9">Shipping Fee </div>
                           <div class="col-sm-3">₹0</div>
                        </div>
                        <div style="border-bottom: solid 1px #eee; margin-top:10px;margin-bottom:10px; "></div>
                        <div class="row">
                           <div class="col-sm-9"><b>Total</b> </div>
                           <div class="col-sm-3"><b>₹{{$total}}</b></div>
                        </div>
                        <div style="border-bottom: solid 1px #eee; margin-top:10px;margin-bottom:10px; "></div>
                        <center>
                           <div class="reserve-btn row">
                              <div class="featured-btn-wrap">
                                 @if(Auth::check()) 
                                 <a href="javascript:$('#cartCheckout').submit()" class="btn btn-danger">Payment Now</a>
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
            <div class="row">
            </div>
         </div>
      </div>
   </div>
</section>
<form id="cart" action="{{route('updatecart')}}" method="post">
   {{ csrf_field() }}
   <input type="hidden" name="item_id" id="item_id">
   <input type="hidden" name="qnty" id="qnty">
   <input type="hidden" name="cart_id" id="cart_id">
</form>
<form id="cartCheckout" action="{{route('checkoutinit')}}" method="post">
   {{ csrf_field() }}
   <input type="hidden" name="qnty" id="qnty" value={{$count}}>
   <input type="hidden" name="gtotal" value="{{encrypt($total)}}">
</form>
<script>
   function getAlert(a,b,c){
       swal({
         title:a,
         text: b,
         icon: c,
       });
   }
   @if(Session::has('message'))
   getAlert('Great',"{{ Session::get('message') }}",'success');
   @endif
   function updateCart(v,i){
       $('#item_id').val(i);
       $('#qnty').val(v);
       $('#cart').submit();
   }
   
</script>
@stop
@section('footer_scripts')
@stop