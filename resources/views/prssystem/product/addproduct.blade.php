@extends('prssystem.layouts.default')
@section('title')
Home Page
@stop
@section('content')
<div id="page-wrapper" style="background-color: #FFF">
    <div class="graphs">
        <table style="width: 100%">
        <tr>
            <td><b>@lang('product.add_new_product')</b></td>
            <td style="text-align: right;font-weight: bold">
                <a href="{{ route('allproduct')}}" style="font-size: 14px;"><i class="fa fa-plus"></i>&nbsp;All New</a></td>
        </tr>
    </table>
    <hr/>
        
        <div class="tab-content">
            
                    <div class="tab-pane active" id="horizontal-form">
                    @if(Session::has('message'))
                    <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
                    @if(Session::has('error'))
                    <p class="alert alert-danger">
                    @foreach(Session::get('error') as $err)
                    {{ $err }}</br>
                    @endforeach
                    </p>
                    @endif
                    
                    <form method="post" action="{{ route('saveproduct') }}"class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.choose_category')</label>
                        <div class="col-sm-8">
                            <select class="form-control1" data-live-search="true" id="category_id" name="category_id">
                                <option data-tokens="">Choose Category</option>
                                @if(!empty($categoryArr))
                                @foreach($categoryArr as $id=>$name)
                                <option value="{{$id}}" @if($id==old('category_id')) selected="selected" @endif>{{$name}}</option>
                                @endforeach
                                @endif
                              </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">@lang('product.subCategory'):</label>
                        <div class="col-sm-8">
                            <select class="form-control1" data-live-search="true" id="sub_category_id" name="sub_category_id">
                            <option value=''>Choose SubCategory</option>
                            </select>
                        </div>
                        <div class="col-sm-2 jlkdfj1" style="display: none">
                            <p class="help-block">Error!</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">@lang('product.brand_list'):</label>
                        <div class="col-sm-8">
                            <select class="form-control1" data-live-search="true" id="brand_id" name="brand_id">
                            <option value=''>Choose Brand</option>
                            </select>
                        </div>
                        <div class="col-sm-2 jlkdfj1" style="display: none">
                            <p class="help-block">Error!</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="disabledinput" class="col-sm-2 control-label">@lang('product.title')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="title" placeholder="Enter the product title" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="disabledinput" class="col-sm-2 control-label">@lang('product.description')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="description" placeholder="Enter Product description" name="description" value="{{ old('description') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">@lang('product.product_in_unit'):</label>
                        <div class="col-sm-8">
                            <select class="form-control1" data-live-search="true" id="unit_id" name="unit_id">
                            <option value=''>Choose Unit</option>
                            @if(!empty($unitList))
                            @foreach($unitList as $k=>$v)
                            <option value='{{$k}}'>{{$v}}</option>
                            @endforeach
                            @endif
                            </select>
                        </div>
                        <div class="col-sm-2 jlkdfj1" style="display: none">
                            <p class="help-block">Error!</p>
                        </div>
                    </div>
                        <hr>
                    
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.quantity')</label>
                        <div class="col-sm-2">
                            <input  type="text" class="form-control1" id="quantity" placeholder="Enter Product Quantity" name="quantity" value="{{ old('quantity') }}">
                        </div>
                         <div class="col-sm-6">
                             <p id="qntyId" style="margin-top: 5px;"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.product_in_stock')</label>
                        <div class="col-sm-2">
                            <select class="form-control1" data-live-search="true" id="product_in_stock" name="product_in_stock">
                            <option value='1'>Yes</option>
                            <option value='0'>No</option>
                            </select>
                        </div>
                         <div class="col-sm-6">
                             <p id="qntyId" style="margin-top: 5px;"></p>
                        </div>
                    </div>
                        <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.product_unlimited')</label>
                        <div class="col-sm-2">
                            <select class="form-control1" data-live-search="true" id="product_unlimited" name="product_unlimited">
                            <option value='1'>Yes</option>
                            <option value='0'>No</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input style="display: none" size="100"  type="text" class="form-control1 input-sm" id="productQuantity" placeholder="Enter Product Quantity" name="productQuantity" value="{{ old('productQuantity') }}">
                        </div>
                    </div>

                    
                    
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.actual_price')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="actprice" placeholder="Enter Original Price" name="actprice" value="{{ old('original_price') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.price')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="price" placeholder="Enter Price" name="price" value="{{ old('price') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.discount')</label>
                        <div class="col-sm-2">
                            <select class="form-control1" data-live-search="true" id="discount" name="discount" onChange="getDiscountedPrice(this.value)">
                                <option value='0' selected="selected">0%</option>
                                <option value='5' >5%</option>
                                <option value='10' >10%</option>
                                <option value='15' >15%</option>
                                <option value='20' >20%</option>
                                <option value='25' >25%</option>
                                <option value='30' >30%</option>
                                <option value='35' >35%</option>
                                <option value='40' >40%</option>
                                <option value='45' >45%</option>
                                <option value='50' >50%</option>
                                <option value='55' >55%</option>
                                <option value='60' >60%</option>
                                <option value='65' >65%</option>
                                <option value='70' >70%</option>
                                <option value='75' >75%</option>
                                <option value='80' >80%</option>
                                <option value='85' >85%</option>
                                <option value='90' >90%</option>
                                <option value='95' >95%</option>
                            </select>
                        </div>
                         <div class="col-sm-6">
                             <p id="qntyId" style="margin-top: 5px;padding-left: 15px;">Price On Store:&nbsp;<span id="orgPrice" style="
                             font-size: 12px;color:#888;padding-left: 15px;padding-right:10px;"></span>&nbsp;<span id="discountPrice"></span></p>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.selling_price')&nbsp;(₹)</label>
                        <div class="col-sm-2">
                            <input  type="text" class="form-control1" id="selling_price" name="selling_price" value="{{ old('selling_price') }}" readonly="readonly">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.image')</label>
                        <div class="col-sm-8">
                            <input  type="file" class="form-control1" id="logo"  name="logo">
                        </div>
                    </div>
                    @if(!empty($user->image_thumb))
                     <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('seller.profile.preview')</label>
                        <div class="col-sm-2">
                            <img src="{{config('global.BUSINESS_THUMB_IMG')}}/{{ $user->image_thumb }}" />
                        </div>
                        <div class="col-sm-6 jlkdfj1">
                            <p id="msg" class="help-block" style="color: red"></p>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.status')</label>
                        <div class="col-sm-2">
                            <select class="form-control1" data-live-search="true" id="status" name="status" >
                            <option value='1' >Active</option>
                            <option value='0' >In-Active</option>
                            </select>
                        </div>
                         <div class="col-sm-6">
                             <p id="qntyId" style="margin-top: 5px;"></p>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4"></div>
                      <div class="form-group col-md-4">
                        <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
                        <button type="button" class="btn btn-danger" style="margin-left:38px">Cancel</button>
                      </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<script>

POST_URL="{{ route('getSubCategory') }}";
POST_BRAND_URL="{{ route('getBrandList') }}";
var catId=$(this).val();
var postJson={_token:CSRF_TOKEN,id:catId};
//getAjaxCall(POST_URL,postJson);
function getDiscountedPrice(discount){
    var price = $('#price').val();
    if(price>0){
        var price = $('#price').val();
        var discount = discount;
        var newPrice = Math.round(price) - Math.round(price) * Math.round(discount)/100;
        $('#discountPrice').html("₹"+Math.round(newPrice));
        $('#selling_price').val(Math.round(newPrice));
        $('#orgPrice').html("<strike>₹"+Math.round(price)+"</strike>");
    }else{
        document.getElementById("price").style.borderColor = "red";
    }
}


function getAjaxCall(url,postJson){
	alert(url);
    //console.log(url);
    //console.log(postJson);
    $.ajax({
        type:'POST',
        url:url,
        data:postJson,        
        success:function(res){
        var str="<option value=''>Choose SubCategory</option>";
        if(res.status=='success'){
           if(res.data.length!=0){
                for(key in res.data){
                    str+="<option value='"+key+"'>"+res.data[key]+"</option>";
                    $('#sub_category_id').html(str);
                };
            }else{
                $('#sub_category_id').html(str);
            }
        }else{
            $('#sub_category_id').html(str);
            alert("somthing went wrong.");
        }
        }
    });
};
</script>
@stop
@section('footer_scripts')
@stop
