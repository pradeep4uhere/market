@extends('prssystem/layouts/listing')
@section('title')
    Seller List
@stop
@section('content')
<style type="text/css">
     .reserve-block .address{
        font-size: 10px !important;
     }
     .reserve-block .featured-title-box h2{
        margin:0px;
        padding:0px;  
        }
    .reserve-block .featured-title-box p{
        font-size: 11px !important;
        padding:1px;
        margin-top: 1px;  
     }
</style>
<section class="reserve-block" style="margin-top:30px;padding: 1px;">
<div class="page-width collection_templete">
   <div class="row">
      <div class="col-md-3 col-sm-12 col-xs-12 normal-sidebar sidebar_content">
         @include('prssystem.seller.sellerListSideBar',array('storeList'=>$Category))
      </div>
      <div class="col-md-9 col-sm-12 col-xs-12 normal_main_content">
        <div class="row detail-filter-wrap" style="padding-bottom: 1px;padding-top:1px;margin-bottom: 1px; border-color: none ">
                <div class="filters-toolbar-wrapper" style="width: 100%">
                 <div class="filters-toolbar">
                    <div class="collection-view">
                       <div id="grid-img" class="grid-img checked">  
                       </div>
                       <div id="list-img" class="list-img"> 
                       </div>
                    </div>
                    <div class="filters-toolbar__item filters-toolbar__item--count">
                       <span class="filters-toolbar__product-count">{{count($sellerArr)}} Result Found</span>
                    </div>
                    <div class="filters-toolbar__item">
                       <label for="SortBy" class="sort-label">Sort by:</label>
                       <div class="select-wrapper">
                          <select name="SortBy" id="SortBy" class="filters-toolbar__input filters-toolbar__input--sort" style="width: 89px;">
                             <option value="title-ascending" selected="selected">Sort by:</option>
                             <option value="best-selling">Best Selling</option>
                             <option value="title-ascending">Alphabetically, A-Z</option>
                             <option value="title-descending">Alphabetically, Z-A</option>
                             <option value="price-ascending">Price, low to high</option>
                             <option value="price-descending">Price, high to low</option>
                             <option value="created-descending">Date, new to old</option>
                             <option value="created-ascending">Date, old to new</option>
                          </select>
                       </div>
                       <label for="SortBy" class="sort-label" onclick="load_more_category_items(0)">Clear All:</label>
                    </div>
                 </div>
              </div>
        </div>
        <!--All Seller List Start-->
        <div class="row" style="background-color: #FFF; padding: 15px 05px 05px 05px;">
            <?php foreach($sellerArr as $seller){?>
                <div class="col-md-4">
                      <div class="featured-place-wrap">
                          <a href="{{route('sellerview',['seller'=>str_slug($seller['business_name']),'id'=>encrypt($seller['id'])])}}">
                            <img height="200" src="{{config('global.SELLER_STORAGE_DIR').'/250X250/'.$seller['image_thumb']}}" onerror="this.onerror=null;this.src='{{ Config('global.THEME_URL_FRONT_IMAGE') }}/default250x250.jpg';"/>
                            <div class="featured-title-box">
                                <h2>{{ucwords($seller['business_name'])}}</h2>
                                <p>Category:: {{$seller['StoreType']['name']}} </p>
                                <p class='address'> <i class="fa fa-map-marker"></i> {{$seller['address_1']}}, {{$seller['location']}},{{$seller['district']}},{{$seller['state']}},{{$seller['pincode']}}
                                </p>
                            </div>
                        </a>
                    </div>
                    </div>
            <?php } ?>
       </div>
<!--All Seller List Ends-->
</div>
</div>
</div>
</section>
@stop
@section('footer_scripts')
@stop

