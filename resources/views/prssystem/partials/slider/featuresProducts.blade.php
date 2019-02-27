<style>
.containerFeatureProduct .product-description {
  transform: translate3d(0, 0, 0);
  transform-style: preserve-3d;
  perspective: 1000;
  backface-visibility: hidden;
  color: #212121;
}
.containerFeatureProduct .container {
  padding-top: 25px;
  padding-bottom: 25px;
}
.containerFeatureProduct img {
  max-width: 100%;
}
.containerFeatureProduct hr {
  border-color: #e5e5e5;
  margin: 15px 0;
}
.containerFeatureProduct .secondary-text {
  color: #b6b6b6;
}
.containerFeatureProduct .list-inline {
  margin: 0;
}
.containerFeatureProduct .list-inline li {
  padding: 0;
}
.containerFeatureProduct .card-wrapper {
  position: relative;
  width: 100%;
  height: 390px;
  border: 1px solid #e5e5e5;
  border-bottom-width: 2px;
  overflow: hidden;
  margin-bottom: 30px;
}
.containerFeatureProduct .card-wrapper:after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
  transition: opacity 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
}
.containerFeatureProduct .card-wrapper:hover:after {
  opacity: 1;
}
.containerFeatureProduct .card-wrapper:hover .image-holder:before {
  opacity: 0.75;
}
.containerFeatureProduct .card-wrapper:hover .image-holder:after {
  opacity: 1;
  transform: translate(-50%, -50%);
}
.containerFeatureProduct .card-wrapper:hover .image-holder--original {
  transform: translateY(-15px);
}
.containerFeatureProduct .card-wrapper:hover .product-description {
  height: 205px;
}
@media (min-width: 768px) {
  .containerFeatureProduct .card-wrapper:hover .product-description {
    height: 185px;
  }
}
.containerFeatureProduct .image-holder {
  display: block;
  position: relative;
  width: 100%;
  height: 310px;
  background-color: #fff;
  z-index: 1;
}
@media (min-width: 768px) {
  .containerFeatureProduct .image-holder {
    height: 325px;
  }
}
.containerFeatureProduct .image-holder:before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #4caf50;
  opacity: 0;
  z-index: 5;
  transition: opacity 0.6s;
}
.containerFeatureProduct .image-holder:after {
  content: '+';
  font-family: 'Raleway', sans-serif;
  font-size: 70px;
  color: #4caf50;
  text-align: center;
  position: absolute;
  top: 92.5px;
  left: 50%;
  width: 75px;
  height: 75px;
  line-height: 75px;
  background-color: #fff;
  opacity: 0;
  border-radius: 50%;
  z-index: 10;
  transform: translate(-50%, 100%);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
  transition: all 0.4s ease-out;
}
@media (min-width: 768px) {
  .containerFeatureProduct .image-holder:after {
    top: 107.5px;
  }
}
.containerFeatureProduct .image-holder .image-holder__link {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 15;
}
.containerFeatureProduct .image-holder .image-holder--original {
  transition: transform 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
}
.containerFeatureProduct .image-liquid {
  width: 100%;
  height: 325px;
  background-size: cover;
  background-position: center center;
}
.containerFeatureProduct .product-description {
  position: absolute;
  left: 0;
  bottom: 0;
  width: 100%;
  height: 80px;
  padding: 10px 15px;
  overflow: hidden;
  background-color: #fafafa;
  border-top: 1px solid #e5e5e5;
  transition: height 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
  z-index: 2;
}
@media (min-width: 768px) {
  .containerFeatureProduct .product-description {
    height: 65px;
  }
}
.containerFeatureProduct .product-description p {
  margin: 0 0 5px;
}
.containerFeatureProduct .product-description .product-description__title {
  font-family: 'Raleway', sans-serif;
  position: relative;
  white-space: nowrap;
  overflow: hidden;
  margin: 0;
  font-size: 18px;
  line-height: 1.25;
}
.containerFeatureProduct .product-description .product-description__title:after {
  content: '';
  width: 60px;
  height: 100%;
  position: absolute;
  top: 0;
  right: 0;
  background: linear-gradient(to right, rgba(255, 255, 255, 0), #fafafa);
}
.containerFeatureProduct .product-description .product-description__title a {
  text-decoration: none;
  color: inherit;
  font-size: 14px;
}
.containerFeatureProduct .product-description .product-description__category {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  font-size: 11px;
}
.containerFeatureProduct .product-description .product-description__price {
  color: #4caf50;
  text-align: left;
  font-weight: bold;
  letter-spacing: 0.06em;
}
@media (min-width: 768px) {
  .containerFeatureProduct .product-description .product-description__price {
    text-align: right;
  }
}
.containerFeatureProduct .product-description .sizes-wrapper {
  margin-bottom: 15px;
}
.containerFeatureProduct .product-description .color-list {
  font-size: 0;
}
.containerFeatureProduct .product-description .color-list__item {
  width: 25px;
  height: 10px;
  position: relative;
  z-index: 1;
  transition: all 0.2s;
}
.containerFeatureProduct .product-description .color-list__item:hover {
  width: 40px;
}
.containerFeatureProduct .product-description .color-list__item--red {
  background-color: #f44336;
}
.containerFeatureProduct .product-description .color-list__item--blue {
  background-color: #448aff;
}
.containerFeatureProduct .product-description .color-list__item--green {
  background-color: #cddc39;
}
.containerFeatureProduct .product-description .color-list__item--orange {
  background-color: #ff9800;
}
.containerFeatureProduct .product-description .strikePrice {
  font-size: 11px;
  color: #888;
}

</style>
<div class="containerFeatureProduct">
<div class="container">
  <div class="row">
    <?php $count=0; ?>
    @foreach($productList as $prodObj) 
    <?php if($prodObj->selling_price>0){ ?>
    <?php $imgStr = config('global.PRODUCTS_STORAGE_DIR').'/'.$prodObj->seller_id.'/'.config('global.PRODUCT_THUMB_IMG_WIDTH').'X'.config('global.PRODUCT_THUMB_IMG_HEIGHT').'/'.$prodObj->default_images; ?>
    <div class="col-xs-12 col-sm-6 col-md-4">
      <article class="card-wrapper">
        <div class="image-holder">
          <a href="{{route('details',['slug'=>str_slug($prodObj['Product']['title']),'id'=>encrypt($prodObj->id)])}}" class="image-holder__link"></a>
          <div class="image-liquid image-holder--original" style="background-image: url('{{$imgStr}}')">
          </div>
        </div>

        <div class="product-description">
          <!-- title -->
          <h1 class="product-description__title">
            <a href="{{route('details',['slug'=>str_slug($prodObj['Product']['title']),'id'=>encrypt($prodObj->id)])}}">            
              <?php if($prodObj['Product']['title']!=''){ ?>{{ str_limit(ucwords($prodObj['Product']['title']), $limit = 25, $end = '...') }}<?php }else{ echo "Unknown Name"; } ?>
              </a>
          </h1>

          <!-- category and price -->
          <div class="row">
            <div class="col-sm-8 product-description__category secondary-text">
              {{ str_limit(ucwords($prodObj['Product']['description']), $limit = 30, $end = '...') }}
            </div>
            <div class="col-xs-12 col-sm-4 product-description__price">
              <strike class="strikePrice">₹{{$prodObj->price}}</strike>&nbsp;₹{{$prodObj->selling_price}}&nbsp;
            </div>
          </div>

          <!-- divider -->
          <hr />

          <!-- sizes -->
          <div class="sizes-wrapper">
            <span class="secondary-text text-uppercase">
            Discount:{{($prodObj['UserProduct']['discount']!='')?$prodObj['UserProduct']['discount']:'0'}}%
            </span>&nbsp;|&nbsp;
            <span class="secondary-text text-uppercase">
              Unit:{{$prodObj['UserProduct']['quantity_in_unit']}}&nbsp;{{$prodObj['Product']['Unit']['name']}}
            </span>
          </div>

          <!-- colors -->
          <div class="color-wrapper">
            <center><a href="javascript:void(0)" class="btn" style="background-color:#ff3a6d;color:#FFF; margin:0 auto" onClick="addToCart('{{encrypt($prodObj->id)}}','{{str_slug($prodObj['Product']['title'])}}')">Add To Cart</a>
              </center>
          </div>
        </div>

      </article>
    </div>
    <?php } $count++;  ?>
    @endforeach
  </div>
  <script type="text/javascript">
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
                        getAlert('Error',res.message,res.status);
                    }
                }
            });
        }else{
            getAlert('Opps Login Required!!','You have to login first!!','error');
        }
        }
  </script>