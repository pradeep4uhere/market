<style>

.preview {
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
-webkit-box-orient: vertical;
-webkit-box-direction: normal;
-webkit-flex-direction: column;
-ms-flex-direction: column;
flex-direction: column; }
@media screen and (max-width: 996px) {
.preview {
margin-bottom: 20px; } }

.preview-pic {
-webkit-box-flex: 1;
-webkit-flex-grow: 1;
-ms-flex-positive: 1;
flex-grow: 1; }

.preview-thumbnail.nav-tabs {
border: none;
margin-top: 1px; }
.preview-thumbnail.nav-tabs li {
width: 16%;
margin-right: 0.8%; }
.preview-thumbnail.nav-tabs li img {
max-width: 100%;
display: block; }
.preview-thumbnail.nav-tabs li a {
padding: 0;
margin: 0; }
.preview-thumbnail.nav-tabs li:last-of-type {
margin-right: 0; }

.tab-content {
overflow: hidden; }
.tab-content img {
width: 100%;
-webkit-animation-name: opacity;
animation-name: opacity;
-webkit-animation-duration: .3s;
animation-duration: .3s; }


@media screen and (min-width: 997px) {
.wrapper {
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex; } }

.details {
display: -webkit-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
-webkit-box-orient: vertical;
-webkit-box-direction: normal;
-webkit-flex-direction: column;
-ms-flex-direction: column;
flex-direction: column; }

.colors {
-webkit-box-flex: 1;
-webkit-flex-grow: 1;
-ms-flex-positive: 1;
flex-grow: 1; }

.product-title, .price, .sizes, .colors {
text-transform: UPPERCASE;
font-weight: bold; }

.checked, .price span {
color: #ff9f1a; }

.product-title, .rating, .product-description, .price, .vote, .sizes {
margin-bottom: 15px; }

@-webkit-keyframes opacity {
0% {
opacity: 0;
-webkit-transform: scale(3);
transform: scale(3); }
100% {
opacity: 1;
-webkit-transform: scale(1);
transform: scale(1); } }

@keyframes opacity {
0% {
opacity: 0;
-webkit-transform: scale(3);
transform: scale(3); }
100% {
opacity: 1;
-webkit-transform: scale(1);
transform: scale(1); } }
.product-description{ font-size: 14px;}
/*# sourceMappingURL=style.css.map */

.sdBox{
display: block;
border: 1px dashed #ebebeb;
border-radius: 2px;
padding: 15px;
}
</style>

<div class="preview col-md-5">
    <div class="preview-pic tab-content">
        @if(!empty($productDetails->ProductImage))
        @foreach($productDetails->ProductImage as $img)
        <div class="tab-pane @if($img['is_default']==1) active @endif" id="pic-{{$img['id']}}" style="min-height: 358px;">
		      <img src="{{config('global.PRODUCTS_STORAGE_DIR')}}/{{$productDetails['seller_id']}}/{{config('global.PRODUCT_IMG_WIDTH')}}X{{config('global.PRODUCT_IMG_HEIGHT')}}/{{$img['image_name']}}"onerror="this.onerror=null;this.src='{{ Config('global.THEME_URL_FRONT_IMAGE') }}/default250x250.jpg';" />
    		</div>
        @endforeach
        <ul class="preview-thumbnail nav nav-tabs">
            <?php $count=1; ?>
            @foreach($productDetails->ProductImage as $img)
            @if($count<=6)
           <li class="@if($img['is_default']==1) active @endif">
                <a data-target="#pic-{{$img['id']}}" data-toggle="tab">
                <img src="{{config('global.PRODUCTS_STORAGE_DIR')}}/{{$productDetails['seller_id']}}/{{config('global.PRODUCT_THUMB_IMG_WIDTH')}}X{{config('global.PRODUCT_THUMB_IMG_HEIGHT')}}/{{$img['image_name']}}" onerror="this.onerror=null;this.src='{{ Config('global.THEME_URL_FRONT_IMAGE') }}/default250x250.jpg';"/>
                </a>
          </li>
            <?php $count++ ?>
            @endif
            @endforeach
        </ul>
        @endif
    </div>


</div>

<style>
.tabs {
  max-width: 100%;
  margin: 0 auto;
  padding: 0 20px;
  font-size:12px;
  margin-top:25px;
}
#tab-button {
  display: table;
  table-layout: fixed;
  width: 100%;
  margin: 0;
  padding: 0;
  list-style: none;
}
#tab-button li {
  display: table-cell;
  width: 20%;
}
#tab-button li a {
  display: block;
  padding: .5em;
  background: #eee;
  border: 1px solid #ddd;
  text-align: center;
  color: #999;
  text-decoration: none;
}
#tab-button li:not(:first-child) a {
  border-left: none;
}
#tab-button li a:hover,
#tab-button .is-active a {
  border-bottom-color: transparent;
  background: #ff3a6d;
  color: #fff;
}
.tab-contents {
  padding: .5em 2em 1em;
  border: 1px solid #ddd;
  font-size:12px;
}
.tab-contents p {
    font-size:12px;
}

.tab-contents h5 {
    font-size:14px;
	margin: 9px;
}



.tab-button-outer {
  display: none;
}
.tab-contents {
  margin-top: 20px;
}
@media screen and (min-width: 768px) {
  .tab-button-outer {
    position: relative;
    z-index: 2;
    display: block;
  }
  .tab-select-outer {
    display: none;
  }
  .tab-contents {
    position: relative;
    top: -1px;
    margin-top: 0;
  }
}
</style>