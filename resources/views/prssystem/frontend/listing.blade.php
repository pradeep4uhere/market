@extends('prssystem/layouts/listing')
@section('content')
    <!--main section-->
    <!--============================= DETAIL =============================-->


<section class="reserve-block bg-info">
 <div class="container">
    <div class="row">
	    <div class="col-md-12 responsive-wrap">
                <div class="row detail-filter-wrap">
                    <div class="col-md-4 featured-responsive">
                        <div class="detail-filter-text">
                            <p>{{count($productList)}} Result Found</p>
                        </div>
                    </div>
                    <div class="col-md-4 featured-responsive">
                        <div class="detail-filter-text">
                             @if(Session::has('flash_message'))
                             <div class="alert alert-success" style="padding: 6px">
                                {{ Session::get('flash_message') }}
                            </div>
                            @endif
                             @if(Session::has('error_message'))
                             <div class="alert alert-danger" style="padding: 6px">
                                {{ Session::get('error_message') }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 featured-responsive">
                        <div class="detail-filter">
                            <p>Filter by</p>
                            <form class="filter-dropdown" id="catForm">
                                <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="categoryName" name="category" onchange="getList(this.value)">	
								@foreach($Category as $cat)
								<option value="{{$cat}}" @if($cat==$searchCat) selected @endif>{{$cat}}</option>
								@endforeach
								</select>
                            </form>
                            <div class="map-responsive-wrap">
                                <a class="map-icon" href="#"><span class="icon-location-pin"></span></a>
                            </div>
                        </div>
                    </div>
					
				
                </div>
                <div class="row detail-checkbox-wrap">
                    <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                       <p>Category :: {{$searchCat}}</p>
                    </div>
                   
                </div>
				<!--Product Box Start-->
                    @if(!empty($productList))
                <div class="row light-bg detail-options-wrap">
                    
                    @foreach($productList as $prodObj)
                    <div class="col-xl-3 featured-responsive">
                        <div class="featured-place-wrap" >
                    <a href="{{route('details',['slug'=>str_slug($prodObj['Product']['title']),'id'=>encrypt($prodObj['UserProduct']['id'])])}}">
                        <center style="border-bottom:solid 1px #EEE; ">
                            <img style="width:150px;height: 150px; " src="{{ config('global.PRODUCT_IMG_URL').DIRECTORY_SEPARATOR.$prodObj['UserProduct']['default_images'] }}" class="img-fluid" alt="#">
                            </center>
                        <span class="featured-rating-orange">₹ {{$prodObj['UserProduct']['price']}}</span>
                        <div class="featured-title-box">
                            <h2>{{ucwords($prodObj['Product']['title'])}}</h2>
                            <ul>
                                <li><span class="icon-location-pin"></span>
                                    <p><span>{{$prodObj['Product']->Brand['name']}}</span></p>
                                </li>
                                <li><span class="icon-location-pin"></span>
                                    <p><b>₹&nbsp;{{$prodObj['UserProduct']['price']}}</b>&nbsp;&nbsp;&nbsp; Unit: {{$prodObj['UserProduct']['quantity_in_unit']}}&nbsp;{{$prodObj['Product']->Unit['name']}}</p>
                                </li>
                                <li><span class="icon-location-pin"></span>
                                    <p>{{$prodObj['Seller']['business_name']}}</p>
                                </li>
                              
                            </ul>
                            <div class="bottom-icons">
                                <div class="closed-now"><a href="javascript:void(0)" onClick="addToCart('{{encrypt($prodObj['UserProduct']['id'])}}','{{str_slug($prodObj['Product']['title'])}}')" class="btn" style="background-color:#ff3a6d;color:#FFF; ">Add To Cart</a></div>
                                <span class="ti-heart"></span>
                                <span class="ti-bookmark"></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
                    @endforeach
					
            <!--Product Box Ends Here-->   
            </div>
			@else
				<center>
					<div class="alert alert-danger">
													<strong>No Result Found in your area!</strong>
					</div>
				</center>
                    @endif
        </div>
    </div>
</div>
</section>
@stop
@section('footer_scripts')
@stop

