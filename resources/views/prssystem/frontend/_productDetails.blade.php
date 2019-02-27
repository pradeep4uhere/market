<div class="container" style="width: 100% !important">
            <div class="row">
                <div class="col-md-9 responsive-wrap">
					<div class="wrapper row">
						@include('prssystem.frontend._productImage')
						<div class="details col-md-6">
						<h3 class="product-title" style="border-bottom: dashed 1px #CCC; ">{{$productDetails->product['title']}}</h3>
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							<span class="review-no">41 reviews</span>
						</div>
						<div class="action">
						<p class="product-description">{{$productDetails['description']}}</p>
						<h4 class="price">current price: <strike>₹{{$productDetails['price']}}</strike>&nbsp;<span>₹{{$productDetails['selling_price']}}</span><br><small  style="font-size:8px;">Inclusive of all Taxes</small></h4>
						<h5  class="sizes" style="margin-bottom: 10px;">Category :: {{$productDetails->product->Category['name']}} > {{$productDetails->product->SubCategory['name']}}</h5><br/>
						<h5  class="sizes" style="margin-bottom:10px;"><strong>Unit:</strong> {{$productDetails['quantity_in_unit']}}&nbsp;{{$productDetails->product->Unit['name']}}</h5><br/>
						<h5  class="sizes" style="padding-left:0px;margin-bottom:15px;"> Manufacture By: <strong>{{$productDetails->product->Brand['name']}}</strong>&nbsp;&nbsp;&nbsp;  <img src="{{config('global.THEME_URL_FRONT_IMAGE')}}/Liefstatus_Gruen_04de426b.png.gif"> Certified Brand Seller</h5>
						<p style="padding-left:0px;" class="sizes"><h5  class="sizes">Quantity <select class="" id="inlineFormCustomSelect">
								<option selected="">Select Item</option>
								@for($i=1;$i<100;$i++)
								<option value="{{$i}}">{{$i}}</option>
								@endfor
								</select>
							</h5><br/>
						</p>
					</div>
						<div class="action">
							<a href="javascript:void(0)" class="btn" style="background-color:#ff3a6d;color:#FFF;" onClick="addToCart('{{encrypt($productDetails->id)}}','{{str_slug($productDetails->product['title'])}}')">Add To Cart</a>
							<a href="javascript:void(0)" onClick="buyNow('{{encrypt($productDetails->id)}}','{{str_slug($productDetails->product['title'])}}')" class="btn btn-success">Buy Now </a>
						</div>
					</div>



						
						<div class="col-md-12">
							<div class="tabs">
								<div class="sharethis-inline-share-buttons"></div>				
							</div>
						</div>
						<div class="details col-md-12">
							<div class="tabs">
								  <div class="tab-button-outer">
									<ul id="tab-button">
									  <li><a href="#tab01">Overview</a></li>
									  <li><a href="#tab02">Product Highlights</a></li>
									  <li><a href="#tab03">Offers</a></li>
									  <li><a href="#tab04">About Brand</a></li>
									  <li><a href="#tab05">Return Policy</a></li>
									</ul>
								  </div>
								  <div class="tab-select-outer">
									<select id="tab-select">
									  <option value="#tab01">Overview</option>
									  <option value="#tab02">Product Highlights</option>
									  <option value="#tab03">Offers</option>
									  <option value="#tab04">About Brand</option>
									  <option value="#tab05">Return Policy</option>
									</select>
								  </div>

								  <div id="tab01" class="tab-contents">
									<h5>Overview</h5>
									<p>{!! $productDetails['about_product'] !!}</p>
								  </div>
								  <div id="tab02" class="tab-contents">
									<h5>Product Highlights</h5>
									<p>{!! $productDetails['offers'] !!}</p>
								  </div>
								  <div id="tab03" class="tab-contents">
									<h5>Offers</h5>
									<p>{!! $productDetails['offers'] !!}</p>
								  </div>
								  <div id="tab04" class="tab-contents">
									<h5>About Brand</h5>
									<p>{!! $productDetails['offers'] !!}</p>
								  </div>
								  <div id="tab05" class="tab-contents">
									<h5>Return Policy</h5>
									<p>{!! $productDetails['return_policy'] !!}</p>
								  </div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3 sdBox">
					<div class="wrapper row">
						<h4 class="price" style="margin-left:10px;">Discount</h4>
						<p style="font-size:13px;">This product is not in offer for this seller.</p>
						<div class="reserve-btn">
						<center>
						<div class="featured-btn-wrap" style="margin-bottom: 10px;">
							<a href="javascript:void(0)" onClick="buyNow('{{encrypt($productDetails->id)}}','{{str_slug($productDetails->product['title'])}}')" class="btn btn-danger">Buy Now in <span>₹{{$productDetails['selling_price']}}</span></a>
						</div>
						<p>
							<img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/map.jpg" class="img-fluid" alt="map" style="width: 100%">
						</p>
						
						<hr style="margin-top:5px;padding-bottom: 15px;">
						<p  style="font-size:13px;"><span class="icon-clock"></span>
							Mon - Sun 09:30 am - 05:30 pm 
						</p>
						<hr style="margin:0px;padding-bottom: 15px;">
						<span class="open-now" style="padding-top: 10px;font-weight: bold;">OPEN NOW</span></center>
					</div>
					</div>
				</div>
            </div>
		</div>




