
<link href="{{config('global.THEME_URL_CSS').'/profile/dropzone.css'}}" rel="stylesheet">
<script src="{{config('global.THEME_URL_JS').'/profile/dropzone.min.js'}}"></script>
<style>
div.polaroid {
width: 25%;
background-color: white;
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

img {width: 100%}

div.container {
text-align: center;
padding: 10px 20px;
}
    
</style>
<div id="page-wrapper" style="background-color: #FFF">
  <div class="graphs">
  <table style="width: 100%">
    <tr>
      <td><b>@lang('product.add_new_product_img')</b></td>
      <td style="text-align: right;font-weight: bold">
        <a href="{{ route('allproduct')}}" style="font-size: 14px;"><i class="fa fa-list"></i>&nbsp;All New</a></td>
    </tr>
  </table>
        <div class="tab-content">
            
                    <div class="tab-pane active" id="horizontal-form">
                      @if(Session::has('flash_message'))
                        <div class="alert alert-success">
                            {{ Session::get('flash_message') }}
                        </div>
                    @endif
                     <b>Please Choose or Drage Images here.</b>
                     <form method="post"  id="my-awesome-dropzone" action="{{ route('addProductImg',['id'=>$userProduct['id']]) }}" class=" dropzone dz-clickable form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    
                </form>

            </div>
            <hr/>
@if(!empty($userProduct->ProductImage))
<div class="row">
@foreach($userProduct->ProductImage as $imgObj)
@if($imgObj->status==1)
<div class="col-md-3" style="backgroud-color:green">
  <div class="thumbnail">
    <a href="{{config('global.PRODUCT_IMG_GALLERY').DIRECTORY_SEPARATOR.'prod_00'.$imgObj->user_product_id.DIRECTORY_SEPARATOR.$imgObj->image_name}}" target="_blank">
      <img src="{{config('global.PRODUCT_IMG_GALLERY').DIRECTORY_SEPARATOR.'prod_00'.$imgObj->user_product_id.DIRECTORY_SEPARATOR.$imgObj->image_name}}" alt="Image" style="width:100%">
  
      <div class="caption">
          <div class="btn-group btn-group-justified">
            @if($imgObj->is_default==0)
            <a href="{{route('setProductImageAsDefault',['prod_id'=>$imgObj->user_product_id,'id'=>$imgObj->id])}}" class="btn btn-warning" title="Set Default Image on Page">Set As Default</a>
            @endif
            <a href="{{route('hideProductImage',['id'=>$imgObj->id])}}" class="btn btn-info" title="Hide Image From Product Page">Hide</a>
            <a href="{{route('deleteProductImage',['id'=>$imgObj->id])}}" class="btn btn-danger" title="Delete Image">Remove</a>
          </div>

        
      </div>
    </a>
  </div>
</div>
@endif
@endforeach
</div>
@endif
<hr/>
<b>All Hide Images<b>
<hr/>
@if(!empty($userProduct->ProductImage))
<div class="row">
@foreach($userProduct->ProductImage as $imgObj)
@if($imgObj->status==0)
<div class="col-md-3" style="backgroud-color:green">
  <div class="thumbnail">
    <a href="{{config('global.PRODUCT_IMG_GALLERY').DIRECTORY_SEPARATOR.'prod_00'.$imgObj->user_product_id.DIRECTORY_SEPARATOR.$imgObj->image_name}}" target="_blank">
      <img src="{{config('global.PRODUCT_IMG_GALLERY').DIRECTORY_SEPARATOR.'prod_00'.$imgObj->user_product_id.DIRECTORY_SEPARATOR.$imgObj->image_name}}" alt="Image" style="width:100%">
  
      <div class="caption">
          <div class="btn-group btn-group-justified">
            
            <a href="{{route('showProductImage',['id'=>$imgObj->id])}}" class="btn btn-info" title="Show Image From Product Page">Show</a>
            <a href="{{route('deleteProductImage',['id'=>$imgObj->id])}}" class="btn btn-danger" title="Delete Image">Remove</a>
          </div>

        
      </div>
    </a>
  </div>
</div>
@endif
@endforeach
</div>
@endif

            
            
        </div>

    </div>
</div>

