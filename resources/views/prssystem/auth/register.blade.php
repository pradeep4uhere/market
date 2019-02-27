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
    <div class="container">
        <div class="row ">
            <div class="col-md-1">
                
            </div>
			<div class="col-md-4 text-white text-center bg-danger">
                <div class="">
                    <div class="card-body">
                        <img src="http://www.ansonika.com/mavia/img/registration_bg.svg" style="width:30%">
                        <h3 class="py-3">Registration</h3>
                        <small>Add your Business infront of millions and earn 3x profits from our listing</small>
                    </div>
                </div>
            </div>
            <div class="col-md-7 py-5 border ">
                
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
						<div class="form-row">
						<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }} col-md-6 text-left">
						  <label for="name" class="col-md-12 control-label">First Name</label>
						  <input id="name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>
						  @if ($errors->has('first_name'))
								<span class="help-block">
									<strong>{{ $errors->first('first_name') }}</strong>
								</span>
							@endif
							
						</div>
						
						<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }} col-md-6">
						  <label for="last_name" class="col-md-12 control-label">Last Name</label>
						  <input id="name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>
						  @if ($errors->has('first_name'))
								<span class="help-block">
									<strong>{{ $errors->first('first_name') }}</strong>
								</span>
							@endif
							
						</div>
						
						
						</div>
						
						
						
						<div class="form-row">
						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-6">
						  <label for="email" class="col-md-12 control-label">Email</label>
						  
						  <input type="text" id="email" name="email" class="form-control validate" required="required" placeholder="Enter your email">
						  @if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						  @endif
						  
						</div>
						
						<div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }} col-md-6">
						  <label for="mobile" class="col-md-12 control-label">Mobile</label>
						  <input id="mobile" type="phone" class="form-control" name="mobile" value="{{ old('mobile') }}" required>
						@if ($errors->has('mobile'))
							<span class="help-block">
								<strong>{{ $errors->first('mobile') }}</strong>
							</span>
						@endif
						</div>
						
						</div>
						
						
						<div class="form-row">
						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-6">
						  <label for="mobile" class="col-md-12 control-label">Password</label>
						  <input id="password" type="password" class="form-control" name="password" required>
						@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
						</div>
						
						
						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-6">
						  <label for="mobile" class="col-md-12 control-label">Confirm Password</label>
						  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
						</div>
						</div>
						<div class="form-row col-md-12">
                        <div class="form-group">
							  <label class="form-check-label" for="invalidCheck2">
							  <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
								<small>By clicking Submit, you agree to our <a href="#!" class="main-title red-text" style="color: red; font-weight: bold">Terms & Conditions</a>, <a style="color: red; font-weight: bold" href="#!" class="main-title red-text">Visitor Agreement</a> and <a href="#!" class="main-title red-text" style="color: red; font-weight: bold">Privacy Policy</a>.</small>
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
