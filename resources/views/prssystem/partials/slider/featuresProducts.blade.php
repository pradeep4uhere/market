<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<style type="text/css">
    .col-centered {
    float: none;
    margin: 0 auto;
}

.carousel-control { 
    width: 8%;
    width: 0px;
}
.carousel-control.left,
.carousel-control.right { 
    margin-right: 40px;
    margin-left: 32px; 
    background-image: none;
    opacity: 1;
}
.carousel-control > a > span {
    color: white;
      font-size: 29px !important;
}

.carousel-col { 
    position: relative; 
    min-height: 1px; 
    padding: 5px; 
    float: left;
 }

 .active > div { display:none; }
 .active > div:first-child { display:block; }

/*xs*/
@media (max-width: 375px) {
  .carousel-inner .active.left { left: -50%; }
  .carousel-inner .active.right { left: 50%; }
    .carousel-inner .next        { left:  50%; }
    .carousel-inner .prev            { left: -50%; }
  .carousel-col                { width: 50%; }
    .active > div:first-child + div { display:block; }
  .address {
    font-size: 10px;
    padding-left:1px;
  }

}


@media (max-width: 767px) {
  .carousel-inner .active.left { left: -50%; }
  .carousel-inner .active.right { left: 50%; }
    .carousel-inner .next        { left:  50%; }
    .carousel-inner .prev            { left: -50%; }
  .carousel-col                { width: 50%; }
    .active > div:first-child + div { display:block; }
    .address {
    font-size: 10px;
    padding-left:1px;
  }
}

/*sm*/
@media (min-width: 768px) and (max-width: 991px) {
  .carousel-inner .active.left { left: -50%; }
  .carousel-inner .active.right { left: 50%; }
    .carousel-inner .next        { left:  50%; }
    .carousel-inner .prev            { left: -50%; }
  .carousel-col                { width: 50%; }
    .active > div:first-child + div { display:block; }
    .address {
    font-size: 10px;
    padding-left:1px;
  }
}

/*md*/
@media (min-width: 992px) and (max-width: 1199px) {
  .carousel-inner .active.left { left: -33%; }
  .carousel-inner .active.right { left: 33%; }
    .carousel-inner .next        { left:  33%; }
    .carousel-inner .prev            { left: -33%; }
  .carousel-col                { width: 33%; }
    .active > div:first-child + div { display:block; }
  .active > div:first-child + div + div { display:block; }
  .address {
    font-size: 10px;
    padding-left:1px;
  }
}

/*lg*/
@media (min-width: 1200px) {
  .carousel-inner .active.left { left: -25%; }
  .carousel-inner .active.right{ left:  25%; }
    .carousel-inner .next        { left:  25%; }
    .carousel-inner .prev            { left: -25%; }
  .carousel-col                { width: 25%; }
    .active > div:first-child + div { display:block; }
  .active > div:first-child + div + div { display:block; }
    .active > div:first-child + div + div + div { display:block; }
    .address {
    font-size: 10px;
    padding-left:1px;
  }
}

.block {
    width: 350px;
    height: 230px;
}

.red {background: red;}
.blue {background: blue;}
.green {background: green;}
.yellow {background: yellow;}
.glyphicon-chevron-left:before{
  content:'';
}
.glyphicon-chevron-right:before{
  content:'';
}

</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-md-12 col-centered">
            <div id="carousel" class="carousel slide" data-ride="carousel" data-type="multi" data-interval="2500">
                <div class="carousel-inner">
                	  <?php $count=0; ?>
                	  @foreach($productList as $prodObj)
                	  <div class="item <?php if($count==0){ echo "active";  } ?>" >
                   	   <div class="carousel-col" id="{{$prodObj['id']}}">
                        <!-- <div class="grid__item grid__item--collection-template col-xs-6 col-sm-4 col-md-4 col-lg-3 col-xl-3"> -->
                        <div class="col-sm-12">
                           <div class="grid-view-item ">
                              <div class="grid-view-item__link grid-view-item__image-container">
                                 <div class="grid-view-item__image-wrapper js">
                                    <a href="{{route('details',['slug'=>str_slug($prodObj['Product']['title']),'id'=>encrypt($prodObj['UserProduct']['id'])])}}">
                                       <div class="image-inner">
                                          <div class="reveal" style="max-height:250px;">
                                             <img class="grid-view-item__image  main-img lazyloaded" src="{{config('global.PRODUCTS_STORAGE_DIR')}}/{{$prodObj['UserProduct']['seller_id']}}/{{config('global.PRODUCT_THUMB_IMG_WIDTH')}}X{{config('global.PRODUCT_THUMB_IMG_HEIGHT')}}/{{$prodObj['UserProduct']['default_images']}}" onerror="this.onerror=null;this.src='{{ Config('global.THEME_URL_FRONT_IMAGE') }}/default250x250.jpg';" />

                                              <img class="extra-img" src="{{config('global.PRODUCTS_STORAGE_DIR')}}/{{$prodObj['UserProduct']['seller_id']}}/{{config('global.PRODUCT_THUMB_IMG_HEIGHT')}}X{{config('global.PRODUCT_THUMB_IMG_HEIGHT')}}/{{$prodObj['UserProduct']['default_images']}}" alt="image" onerror="this.onerror=null;this.src='{{ Config('global.THEME_URL_FRONT_IMAGE') }}/default250x250.jpg';" width="100%">

                                             <span class="spr-badge" id="spr_badge_1639015841892" data-rating="0.0"><span class="spr-starrating spr-badge-starrating"><i class="spr-icon spr-icon-star-empty"></i><i class="spr-icon spr-icon-star-empty"></i><i class="spr-icon spr-icon-star-empty"></i><i class="spr-icon spr-icon-star-empty"></i><i class="spr-icon spr-icon-star-empty"></i></span>
                                             <span class="spr-badge-caption">No reviews</span>
                                             </span>
                                          </div>
                                          <div class="hide socialurl-for-quickview">
                                             <span>
                                             </span>
                                          </div>
                                       </div>
                                    </a>
                                 </div>
                                 <div class="product-description">
                                    <div class="product-detail">
                                       <div class="h4 grid-view-item__title">
                                        <?php if($prodObj['Product']['title']!=''){ ?>
                                          {{ str_limit(ucwords($prodObj['Product']['title']), $limit = 25, $end = '...') }}
                                        <?php }else{ echo "Unknown Name"; } ?>
                                        <p>
                                        Description::
                                        <?php if($prodObj['Product']['description']!=''){ ?>
                                          {{ str_limit(ucwords($prodObj['Product']['description']), $limit = 25, $end = '...') }}
                                        <?php }else{ echo "Unknown Name"; } ?>
                                       </p>
                                       <p>
                                       <p class="regular" style="text-decoration: line-through;">₹{{$prodObj['UserProduct']['price']}}</p>
                                       <span class="product-price__price product-price__sale">
                                       <s class="product-price__price is-bold"> ₹{{$prodObj['UserProduct']['selling_price']}} </s>
                                       </span>&nbsp;<span class="discount-percentage">{{($prodObj['UserProduct']['discount']!='')?$prodObj['UserProduct']['discount']:'0'}}%</span><br/>
                                       <span class="h5 grid-view-item__title">Unit: {{$prodObj['UserProduct']['quantity_in_unit']}}&nbsp;{{$prodObj['Product']['Unit']['name']}}</span>
                                       </p>
                                        </div>
                                    </div>
                                    <div class="grid-view-item__meta">
                                       
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
                        </div>
                        </div>
                     <?php $count++;  ?>
                     @endforeach
                </div>

                <!-- Controls -->
                <div class="left carousel-control">
                    <a href="#carousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                        <span class="sr-only">Previous</span>
                    </a>
                </div>
                <div class="right carousel-control">
                    <a href="#carousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
  
    $('.carousel .item').each(function() {
    var next = $(this).next();
    if (!next.length) {
        next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));

    for (var i = 0; i < 2; i++) {
        next = next.next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }

        next.children(':first-child').clone().appendTo($(this));
    }
});
</script>
