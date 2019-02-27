@extends('prssystem.layouts.default')
@section('title')
Home Page
@stop
@section('content')
<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">@lang('user.update_profile'), {{ Auth::user()->first_name}}</h3>
        <div class="tab-content">
            
                    <div class="tab-pane active" id="horizontal-form">
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
                    <form method="post" action="{{ route('updateUserProfile') }}"class="form-horizontal">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">@lang('user.profile.first_name'):</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control1" id="first_name" placeholder="Default Input" name="first_name" value="{{$user->first_name}}">
                        </div>
                        <div class="col-sm-2 jlkdfj1" style="display: none">
                            <p class="help-block">Error!</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="disabledinput" class="col-sm-2 control-label">@lang('user.profile.last_name')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="last_name" placeholder="Last Name" name="last_name" value="{{$user->last_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('user.profile.email')</label>
                        <div class="col-sm-8">
                            <input  type="email" class="form-control1" id="email" placeholder="Email Address" name="email" value="{{$user->email}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('user.profile.mobile')</label>
                        <div class="col-sm-1">
                            <input disabled=""  type="text" class="form-control1" placeholder="+91" value="+91">
                        </div>
                        <div class="col-sm-7">
                            <input  type="text" class="form-control1" id="mobile" placeholder="123456789" name="mobile" value="{{$user->mobile}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('user.profile.address1')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="address1" placeholder="Address-1" name="address1" value="{{$user->address_1}}">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('user.profile.address2')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="address2" placeholder="Address-2" name="address2" value="{{$user->address_2}}">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('user.profile.address3')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="address3" placeholder="Address-3" name="address3" value="{{$user->address_3}}">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('user.profile.pincode')</label>
                        <div class="col-sm-8">
                            <input  type="text" maxlength="6" class="form-control1" id="pincode" placeholder="Pincode" name="pincode" value="{{$user->pincode}}">
                        </div>
                    </div>   
                    <div class="row">
                      <div class="col-md-4"></div>
                      <div class="form-group col-md-4">
                        <button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
                        <button type="button" class="btn btn-danger" style="margin-left:38px">Cancel</button>
                      </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@stop
@section('footer_scripts')
@stop
