@if(!empty($productList))
@foreach($productList as $prodObj)
<div class="grid__item grid__item--collection-template col-xs-12 col-sm-4 col-md-4 col-lg-3 col-xl-3" style="border: solid 1px #eee">
   <div class="grid-view-item ">
      <div class="grid-view-item__link grid-view-item__image-container">
         <div class="grid-view-item__image-wrapper js">
            <a href="{{route('details',['slug'=>str_slug($prodObj['Product']['title']),'id'=>encrypt($prodObj['UserProduct']['id'])])}}">
               <div class="image-inner">
                  <div class="reveal" style="min-height:171px;">
                     <img class="grid-view-item__image  main-img lazyloaded" src="{{config('global.PRODUCTS_STORAGE_DIR')}}/{{$prodObj['UserProduct']['seller_id']}}/{{config('global.PRODUCT_THUMB_IMG_WIDTH')}}X{{config('global.PRODUCT_THUMB_IMG_HEIGHT')}}/{{$prodObj['UserProduct']['default_images']}}" onerror="this.onerror=null;this.src='{{ Config('global.THEME_URL_FRONT_IMAGE') }}/default250x250.jpg';" style="min-height:171px;"/>
                     <img class="extra-img" src="{{config('global.PRODUCTS_STORAGE_DIR')}}/{{$prodObj['UserProduct']['seller_id']}}/{{config('global.PRODUCT_THUMB_IMG_HEIGHT')}}X{{config('global.PRODUCT_THUMB_IMG_HEIGHT')}}/{{$prodObj['UserProduct']['default_images']}}" alt="image" onerror="this.onerror=null;this.src='{{ Config('global.THEME_URL_FRONT_IMAGE') }}/default250x250.jpg';"  style="min-height:171px;">

                     <span class="spr-badge" id="spr_badge_1639015841892" data-rating="0.0"><span class="spr-starrating spr-badge-starrating"><i class="spr-icon spr-icon-star-empty"></i><i class="spr-icon spr-icon-star-empty"></i><i class="spr-icon spr-icon-star-empty"></i><i class="spr-icon spr-icon-star-empty"></i><i class="spr-icon spr-icon-star-empty"></i></span><span class="spr-badge-caption">No reviews</span>
                     </span>
                  </div>
                  <div class="hide socialurl-for-quickview">
                     <span>
                     </span>
                  </div>
               </div>
            </a>
            <div class="quick-view">
               <button class="btn" data-toggle="modal"><span> quick view</span></button>
            </div>
            <div class="add-to-wishlist">
               <div class="show">
                  <div class="default-wishbutton-grinders-cafe loading"><a class="add-in-wishlist-js btn" data-href="grinders-cafe"><i class="fa fa-heart-o"></i><span class="tooltip-label">Add to wishlist</span></a></div>
                  <div class="loadding-wishbutton-grinders-cafe loading btn loader-btn" style="display: none; pointer-events: none"><a class="add_to_wishlist" data-href="grinders-cafe"><i class="fa fa-circle-o-notch fa-spin"></i></a></div>
                  <div class="added-wishbutton-grinders-cafe loading" style="display: none;"><a class="added-wishlist btn add_to_wishlist" href="/pages/wishlist"><i class="fa fa-heart"></i><span class="tooltip-label">View Wishlist</span></a></div>
               </div>
            </div>
         </div>
         <div class="product-description">
            <div class="product-detail">
               <div class="h4 grid-view-item__title"><?php if($prodObj['Product']['title']!=''){ ?>{{ str_limit(ucwords($prodObj['Product']['title']), $limit = 25, $end = '...') }}<?php }else{ echo "Unknown Name"; } ?></div>
            </div>
            <div class="grid-view-item__meta">
               <span class="visually-hidden">Regular price</span>
               <span class="regular" style="text-decoration: line-through;">₹{{$prodObj['UserProduct']['price']}}</span>
               <span class="discount-percentage">
               <span>save</span>0%</span>
               <span class="product-price__price product-price__sale">
               <s class="product-price__price is-bold"> ₹{{$prodObj['UserProduct']['selling_price']}} </s>
               </span><br/><br/>
               <span>Unit: {{$prodObj['UserProduct']['quantity_in_unit']}}&nbsp;{{$prodObj['Product']['Unit']['name']}}</span>
            </div>
            <div class="thumbnail-buttons">
               <div class="product-block-hover grid-hover">
                  <div class="nm-cartmain add_to_cart_main grid-cart">
                    <div class="product-form__item product-form__item--submit">
                       <a href="javascript:void(0)" class="btn" style="background-color:#ff3a6d;color:#FFF;" onClick="addToCart('{{encrypt($prodObj['UserProduct']['id'])}}','{{str_slug($prodObj['Product']['title'])}}')">Add To Cart</a>
                    </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endforeach
@else
 <center>
     <div class="alert alert-danger">No product added by this seller</div>
 </center>
@endif