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
                    
                    <form method="post" action="{{ route('editProduct',['id'=>$userProduct['id']]) }}"class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.choose_category')</label>
                        <div class="col-sm-8">
                            <select class="form-control1" data-live-search="true" id="category_id" name="category_id">
                                <option data-tokens="">Choose Category</option>
                                @if(!empty($categoryArr))
                                @foreach($categoryArr as $id=>$name)
                                <option value="{{$id}}" @if($product['category_id']==$id) {{'selected'}} @endif>{{$name}}</option>
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
                            @if(!empty($subCatArr))
                                @foreach($subCatArr as $id=>$name)
                                <option value="{{$id}}" @if($product['sub_category_id']==$id) {{'selected'}} @endif>{{$name}}</option>
                                @endforeach
                            @endif
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
                            @if(!empty($brandList))
                                @foreach($brandList as $id=>$name)
                                <option value="{{$id}}" @if($product['brand_id']==$id) {{'selected'}} @endif>{{$name}}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                        <div class="col-sm-2 jlkdfj1" style="display: none">
                            <p class="help-block">Error!</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="disabledinput" class="col-sm-2 control-label">@lang('product.title')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="title" placeholder="Enter the product title" name="title" value="{{$product['title']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="disabledinput" class="col-sm-2 control-label">@lang('product.description')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="description" placeholder="Enter Product description" name="description" value="{{$product['description']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">@lang('product.product_in_unit'):</label>
                        <div class="col-sm-8">
                            <select class="form-control1" data-live-search="true" id="unit_id" name="unit_id">
                            <option value=''>Choose Unit</option>
                            @if(!empty($unitList))
                            @foreach($unitList as $k=>$v)
                            <option value='{{$k}}' @if($product['unit_id']==$k) {{'selected'}} @endif>{{$v}}</option>
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
                            <input  type="text" class="form-control1" id="quantity" placeholder="Enter Product Quantity" name="quantity" value="{{$userProduct['quantity']}}">
                        </div>
                         <div class="col-sm-6">
                             <p id="qntyId" style="margin-top: 5px;"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.product_in_stock')</label>
                        <div class="col-sm-2">
                            <select class="form-control1" data-live-search="true" id="product_in_stock" name="product_in_stock" >
                            <option value='1' @if($userProduct['product_in_stock']==1) {{"selected"}} @endif>Yes</option>
                            <option value='0' @if($userProduct['product_in_stock']==0) {{"selected"}} @endif>No</option>
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
                            <option value='1' @if($userProduct['unlimited_product']==1) {{"selected"}} @endif>Yes</option>
                            <option value='0' @if($userProduct['unlimited_product']==0) {{"selected"}} @endif>No</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <input <?php if($userProduct['unlimited_product']==1){ ?> style="display: none" <?php }?> size="100"  type="text" class="form-control1 input-sm" id="productQuantity" placeholder="Enter Product Quantity" name="productQuantity" value="{{$userProduct['quantity']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.actual_price')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="actprice" placeholder="Enter Original Price" name="actprice" value=" {{$userProduct['default_price']}}">
                        </div>
                    </div>

                    
                    
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.price')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="price" placeholder="Enter Price" name="price" value="{{$userProduct['price']}}">
                        </div>
                    </div>

                     <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.discount')</label>
                        <div class="col-sm-2">
                            <select class="form-control1" data-live-search="true" id="discount" name="discount" onChange="getDiscountedPrice(this.value)">
                                <option value='0'>0%</option>
                                <?php for($i=5;$i<100;$i=$i+5){ ?>
                                <option value='{{$i}}' <?php if($userProduct['discount_value']==$i){ echo "selected";} ?>>{{$i}}%</option>
                                <?php } ?>
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
                            <input  type="text" class="form-control1" id="selling_price" name="selling_price" value="{{$userProduct['selling_price'] }}" readonly="readonly">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.sku')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="product_sku" placeholder="Enter Product SKU" name="product_sku" value="{{$userProduct['product_sku']}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.image')</label>
                        <div class="col-sm-8">
                            <input  type="file" class="form-control1" id="logo"  name="logo">
                        </div>
                    </div>
                    @if(!empty($userProduct['default_thumbnail']))
                     <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('product.image')</label>
                        <div class="col-sm-2">
                            <img src="{{config('global.PRODUCTS_STORAGE_DIR').DIRECTORY_SEPARATOR.$sellerId.DIRECTORY_SEPARATOR.config('global.PRODUCT_THUMB_IMG_WIDTH').'X'.config('global.PRODUCT_THUMB_IMG_HEIGHT').DIRECTORY_SEPARATOR.$userProduct['default_thumbnail']}}" />
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
                            <option value='1' @if($userProduct['status']==1) {{"selected"}} @endif>Active</option>
                            <option value='0' @if($userProduct['status']==0) {{"selected"}} @endif>In-Active</option>
                            </select>
                        </div>
                         <div class="col-sm-6">
                             <p id="qntyId" style="margin-top: 5px;"></p>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4"></div>
                      <div class="form-group col-md-4">
                          <input type="hidden" name="id" value="{{$userProduct['product_id']}}">
                          <input type="hidden" name="upid" value="{{$userProduct['id']}}">
                        <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
                        <button type="button" class="btn btn-danger" style="margin-left:38px" onclick="history.go('www.google.com')">Cancel</button>
                        
                      </div>
                    </div>
                </form>
            </div>
        </div>
<script type="text/javascript">
    getDiscountedPrice($('#discount').val());
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
</script>