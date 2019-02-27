@extends('prssystem.layouts.front')
@section('content')
<link href="http://localhost/laravel/public/css/app.css" rel="stylesheet">
<br/><br/>
<!--<link href="//netdna.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<style>
label{
font-size:14px;
}
</style>
<section class="testimonial py-5" id="testimonial">
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
    <div class="container">
        <div class="row ">
            <div class="col-md-1">
                
            </div>
			<div class="col-md-4 text-white text-center bg-danger">
                <div class="">
                    <div class="card-body">
                        <img src="http://www.ansonika.com/mavia/img/registration_bg.svg" style="width:30%">
                        <h3 class="py-3">Seller New Account</h3>
                        <h5>Welcome Back, {{Auth::user()->first_name}} </h5>
						<br/><br/><br/>
						<h6>Reach millions of People</h6>
<p>
Add your Business infront of millions and earn 3x profits from our listing
</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7 py-5 border ">
                
                <form method="post" action="{{ route('updateSellerProfile',['id'=>'1']) }}"class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
						<div class="form-row">
						<div class="form-group col-md-6 text-left">
						  <label for="name" class="col-md-12 control-label">Choose Business Type </label>
						  <select class="form-control" data-live-search="true" id="store_type_id" name="store_type_id">
                                <option data-tokens="">Choose Store Type</option>
                                @if(!empty($businessType))
                                @foreach($businessType as $obj)
                                <option value="{{$obj['id']}}">{{$obj['name']}}</option>
                                @endforeach
                                @endif
                              </select>
							
						</div>
						
						<div class="form-group col-md-6 text-left">
						  <label for="name" class="col-md-12 control-label">Business Name</label>
						  <input id="business_name" type="text" class="form-control" name="business_name" value="{{ old('business_name') }}" required autofocus>
						  @if ($errors->has('business_name'))
								<span class="help-block">
									<strong>{{ $errors->first('business_name') }}</strong>
								</span>
							@endif
							
						</div>
						
						
						
						
						</div>
						
						
						
						<div class="form-row">
						<div class="form-group col-md-6">
						  <label for="email" class="col-md-12 control-label">Address-1</label>
						  
						  <input type="text" id="address_1" name="address_1" class="form-control validate" required="required" placeholder="Enter your address-1">
						  @if ($errors->has('address_1'))
							<span class="help-block">
								<strong>{{ $errors->first('address_1') }}</strong>
							</span>
						  @endif
						  
						</div>
						
						<div class="form-group col-md-6">
						  <label for="email" class="col-md-12 control-label">Address-2</label>
						  
						  <input type="text" id="address_2" name="address_2" class="form-control validate" required="required" placeholder="Enter your address-2">
						  @if ($errors->has('address_2'))
							<span class="help-block">
								<strong>{{ $errors->first('address_2') }}</strong>
							</span>
						  @endif
						  
						</div>
						
						<div class="form-group{{ $errors->has('state_id') ? ' has-error' : '' }} col-md-6">
						  <label for="mobile" class="col-md-12 control-label">State</label>
						  
						  <select class="form-control" data-live-search="true" id="state_id" name="state_id">
                                <option data-tokens="">Choose State</option>
                                @if(!empty($stateList))
                                @foreach($stateList as $id=>$name)
                                <option value="{{$id}}" @if(!empty($user)) @if($user->state_id==$id) {{"selected"}} @endif @endif>{{$name}}</option>
                                @endforeach
                                @endif
                              </select>
							  
							  
						@if ($errors->has('state_id'))
							<span class="help-block">
								<strong>{{ $errors->first('state_id') }}</strong>
							</span>
						@endif
						</div>
						
						
                    <div class="form-group col-md-6">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('seller.profile.district')</label>
                        <select class="form-control" data-live-search="true" id="city_id" name="city_id">
                                <option data-tokens="">Choose District</option>
                                @if(!empty($cityList))
                                @foreach($cityList as $id=>$name)
                                <option value="{{$id}}" @if(!empty($user)) @if($user->city_id==$id) {{"selected"}} @endif @endif>{{$name}}</option>
                                @endforeach
                                @endif
                              </select>
                        
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('seller.profile.location')</label>
                        <select class="form-control" data-live-search="true" id="city_id" name="city_id">
                                <option data-tokens="">Choose Location</option>
                                @if(!empty($cityList))
                                @foreach($cityList as $id=>$name)
                                <option value="{{$id}}" @if(!empty($user)) @if($user->city_id==$id) {{"selected"}} @endif @endif>{{$name}}</option>
                                @endforeach
                                @endif
                              </select>
                        
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-6">
						  <label for="mobile" class="col-md-12 control-label">Pincode</label>
						  <input  type="text" class="form-control" id="pincode_id" placeholder="Enter Pincode" name="pincode_id" required>
						</div>
						
						</div>
						
						
						<div class="form-row">
						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-6">
						 <label for="mobile" class="col-md-12 control-label">Contact Number</label>
						 <div class="form-row">
						<div class="col-sm-3">
                            <input disabled=""  type="text" class="form-control" placeholder="+91" value="+91">
                        </div> 
						<div class="col-sm-9">
                            <input  type="text" class="form-control" id="contact_number" placeholder="Enter Mobile Number" name="contact_number" value="{{(!empty($user))?$user->contact_number:old('contact_number')}}">
                        </div>
                        </div>

						
						</div>
						
						
						
						
						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-6">
						  <label for="mobile" class="col-md-12 control-label">Email Address</label>
						  <input  type="text" class="form-control" id="email_address" placeholder="Enter Email address" name="email_address" required>
						</div>
						</div>
						<div class="form-row col-md-12">
                        <div class="form-group">
							  <label class="form-check-label" for="invalidCheck2">
							  <input  type="hidden" class="form-control1" id="country_id" placeholder="Choose Country" name="country_id" value="1">
							  <input  type="hidden" class="form-control1" id="user_id" name="user_id" value="{{Auth::user()->id}}">
							  <input  type="hidden" class="form-control1" id="id" name="id" value="{{(!empty($user))?$user->id:'0'}}">
							  <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
								<small>By clicking Submit, you agree to our <a href="#!" class="main-title red-text">Terms & Conditions</a>, <a href="#!" class="main-title red-text">Visitor Agreement</a> and <a href="#!" class="main-title red-text">Privacy Policy</a>.</small>
							  </label>
                          </div>
                    </div>
                    
					     <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</section>
@endsection
