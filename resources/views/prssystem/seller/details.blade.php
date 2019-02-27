@extends('prssystem/layouts/frontDetails')
@include('prssystem.partials.metatags',array('meta'=>$metaTags))
@section('content')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!--main section-->
    <!--============================= DETAIL =============================-->
        <!-- Swiper -->
            <section class="reserve-block" style="margin: 0px;padding: 1px;">
     <div class="container">
        <div class="row">
        <div class="swiper-container">
            <div class="swiper-wrapper">
				<?php if(!empty($seller->SellerImage)){ 
				foreach($seller->SellerImage as $imgObj){ ?>
                <div class="swiper-slide" style="height:350px;width: 250px;">
                    <a href="{{config('global.SELLER_STORAGE_DIR').DIRECTORY_SEPARATOR.$imgObj->seller_id.DIRECTORY_SEPARATOR.config('global.SELLER_IMG_WIDTH').'X'.config('global.SELLER_IMG_HEIGHT').DIRECTORY_SEPARATOR.$imgObj->image_name}}" class="grid image-link">
                        <img src="{{config('global.SELLER_STORAGE_DIR').DIRECTORY_SEPARATOR.$imgObj->seller_id.DIRECTORY_SEPARATOR.config('global.SELLER_THUMB_IMG_WIDTH').'X'.config('global.SELLER_THUMB_IMG_HEIGHT').DIRECTORY_SEPARATOR.$imgObj->image_name}}" alt="Image" style="width:100%" onerror="this.onerror=null;this.src='{{ Config('global.THEME_URL_FRONT_IMAGE') }}/default250x250.jpg';">
                    </a>
                </div>
				<?php }}else{ ?>
                <div class="swiper-slide">
                    <a href="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/reserve-slide1.jpg" class="grid image-link">
                        <img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/reserve-slide1.jpg" class="img-fluid" alt="#">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/reserve-slide3.jpg" class="grid image-link">
                        <img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/reserve-slide3.jpg" class="img-fluid" alt="#">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/reserve-slide1.jpg" class="grid image-link">
                        <img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/reserve-slide1.jpg" class="img-fluid" alt="#">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/reserve-slide2.jpg" class="grid image-link">
                        <img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/reserve-slide2.jpg" class="img-fluid" alt="#">
                    </a>
                </div>
                <div class="swiper-slide">
                    <a href="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/reserve-slide3.jpg" class="grid image-link">
                        <img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/reserve-slide3.jpg" class="img-fluid" alt="#">
                    </a>
                </div>
				<?php  } ?>

                
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination-white"></div>
            <!-- Add Arrows -->
            <div class="swiper-button-next swiper-button-white"></div>
            <div class="swiper-button-prev swiper-button-white"></div>
        </div>
        </div>
</div>
</section>
<!--//END BOOKING -->
<!--============================= RESERVE A SEAT =============================-->
<section class="reserve-block bg-info" style="margin-bottom: 1px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 style="padding:0px;margin:0px; font-weight:400">{{$seller['business_name']}}&nbsp;<img src="{{config('global.THEME_URL_FRONT_IMAGE')}}/tick_circle.png"></h1>
                <h5 style="padding:0px;margin:0px;">{{$seller['address_1']}}, {{$seller['address_2']}}, 
                            {{$seller['state_id']}}</h5>
            </div>
            <div class="col-md-6">
                <div class="reserve-seat-block">
                    <div class="reserve-btn">
                        <div class="featured-btn-wrap">
                            <a href="{{route('sellerview',['seller'=>str_slug($seller['business_name']),'id'=>encrypt($seller['id'])])}}" class="btn btn-success">Go To Seller Page</a>
                            <a href="#" class="btn" style="background-color:#ff3a6d;color:#FFF;"><i class="fa fa-phone"></i> +91-{{$seller['contact_number']}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--============================= PRODUCT LIST START =============================-->

    @include('prssystem.partials.product.productList',array('productList'=>$productList))

    <!--============================= PRODUCT LIST ENDS  =============================-->
    


    <script>
  var $tabButtonItem = $('#tab-button li'),
      $tabSelect = $('#tab-select'),
      $tabContents = $('.tab-contents'),
      activeClass = 'is-active';

  $tabButtonItem.first().addClass(activeClass);
  $tabContents.not(':first').hide();

  $tabButtonItem.find('a').on('click', function(e) {
    var target = $(this).attr('href');

    $tabButtonItem.removeClass(activeClass);
    $(this).parent().addClass(activeClass);
    $tabSelect.val(target);
    $tabContents.hide();
    $(target).show();
    e.preventDefault();
  });

  $tabSelect.on('change', function() {
    var target = $(this).val(),
        targetSelectNum = $(this).prop('selectedIndex');

    $tabButtonItem.removeClass(activeClass);
    $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
    $tabContents.hide();
    $(target).show();
  });

  
  
function getAlert(a,b,c){
	swal({
	  title:a,
	  text: b,
	  icon: c,
	});
}
//Add To Cart 
function addToCart(pid,title){
@if(Auth::check()) 
var Auth ="<?php echo Auth::user()->id ?>";
@else
var Auth =0;
@endif
if(Auth>0){
    var csrf="{{csrf_token()}}";
    var postJson={_token:csrf,pid:pid,name:title};
    $.ajax({
    	type:'POST',
    	url:"{{route('addtocart')}}",
    	data:postJson,        
    	dataType:'json',        
    	success:function(res){
    		//var result = JSON.parse(res);
    		console.log(res);
    		if(res.status=='success'){
    			getAlert('Great',res.message,res.status);
    			$('#itemCount').text(res.cart.count);
    		}

            if(res.status=='error'){
                getAlert('Great',res.message,res.status);
            }
    	}
    });
}else{
    getAlert('Opps Login Required!!','You have to login first!!','error');
}
}


//for change grid to list view
  // $(document).on('click', '.list-img', function(e){
  //   if($(this).hasClass('checked')){
  //       return;
  //   }
  //   else{
  //     $('#list-img').addClass('checked');
  //     $('#grid-img').removeClass('checked');
  //     $('.products-display-collection .grid__item').each(function () {
  //       $(this).removeClass('grid__item');
  //       $(this).addClass('one-whole');
  //       $(this).addClass('list__item');
  //     });
  //     $('.products-display-collection .grid-view-item__image-wrapper').each(function () {
  //       $(this).addClass('col-xs-6 col-sm-6 col-md-4 col-lg-3');
  //     });
  //     $('.products-display-collection .product-description').each(function () {
  //       $(this).addClass('col-xs-6 col-sm-6 col-md-8 col-lg-9');
  //     });
      
  //     $('#Collection').fadeOut(0);
  //     $('#Collection').fadeIn(500);
  //   }
  // });
  // //for change list to grid view
  // $(document).on('click', '.grid-img', function(e){
  //   if($(this).hasClass('checked')){
  //     return;
  //   }
  //   else {
  //     $('#list-img').removeClass('checked');
  //     $('#grid-img').addClass('checked');
  //     $('.products-display-collection .list__item').each(function () {
  //       $(this).addClass('grid__item');
  //       $(this).removeClass('one-whole');
  //       $(this).removeClass('list__item');        
  //     });
  //     $('.products-display-collection .grid-view-item__image-wrapper').each(function () {
  //       $(this).removeClass('col-xs-6 col-sm-6 col-md-4 col-lg-3');
  //     });
  //     $('.products-display-collection .product-description').each(function () {
  //       $(this).removeClass('col-xs-6 col-sm-6 col-md-8 col-lg-9');
  //     });
      
  //     $('#Collection').fadeOut(0);
  //     $('#Collection').fadeIn(500);
  //   }
  // });
</script>

@stop
@section('footer_scripts')
@stop
