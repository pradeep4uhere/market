@extends('prssystem.layouts.default')
@section('title')
Home Page
@stop
@section('content')
<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">@lang('seller.title'), {{ Auth::user()->first_name}}</h3>
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
                    <form method="post" action="{{ route('updateSellerProfile') }}"class="form-horizontal" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">@lang('seller.profile.business_name'):</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control1" id="business_name" placeholder="Enter Business Name" name="business_name" value="{{(!empty($user))?$user->business_name:''}}">
                        </div>
                        <div class="col-sm-2 jlkdfj1" style="display: none">
                            <p class="help-block">Error!</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="disabledinput" class="col-sm-2 control-label">@lang('seller.profile.address1')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="address_1" placeholder="Address-1" name="address_1" value="{{(!empty($user))?$user->address_1:''}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('seller.profile.address2')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="address_2" placeholder="Addres-2" name="address_2" value="{{(!empty($user))?$user->address_2:''}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('seller.profile.state')</label>
                        <div class="col-sm-8">
                            <select class="form-control1" data-live-search="true" id="state_id" name="state_id">
                                <option data-tokens="">Choose State</option>
                                @if(!empty($stateList))
                                @foreach($stateList as $id=>$name)
                                <option value="{{$id}}" @if(!empty($user)) @if($user->state_id==$id) {{"selected"}} @endif @endif>{{$name}}</option>
                                @endforeach
                                @endif
                              </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('seller.profile.city')</label>
                        <div class="col-sm-8">
                        <select class="form-control1" data-live-search="true" id="city_id" name="city_id">
                                <option data-tokens="">Choose City</option>
                                @if(!empty($cityList))
                                @foreach($cityList as $id=>$name)
                                <option value="{{$id}}" @if(!empty($user)) @if($user->city_id==$id) {{"selected"}} @endif @endif>{{$name}}</option>
                                @endforeach
                                @endif
                              </select>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('seller.profile.pincode')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="pincode_id" placeholder="Enter Pincode" name="pincode_id" value="{{(!empty($user))?$user->pincode_id:''}}">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('seller.profile.contact_number')</label>
                        <div class="col-sm-1">
                            <input disabled=""  type="text" class="form-control1" placeholder="+91" value="+91">
                        </div>
                        <div class="col-sm-7">
                            <input  type="text" class="form-control1" id="contact_number" placeholder="Enter Contact Number" name="contact_number" value="{{(!empty($user))?$user->contact_number:old('contact_number')}}">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('seller.profile.upload_business_logo')</label>
                       
                        <div class="col-sm-8">
                            <input  type="file" class="form-control1" id="logo"  name="logo">
                        </div>
                    </div>
                    @if(!empty($user->image_thumb))
                     <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('seller.profile.preview')</label>
                        <div class="col-sm-2">
                            <img src="{{config('global.BUSINESS_THUMB_IMG')}}/{{ $user->image_thumb }}" />
                        </div>
                        <div class="col-sm-6 jlkdfj1">
                            <p id="msg" class="help-block" style="color: red"></p>
                        </div>
                    </div>
                    @endif
                     <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">@lang('seller.profile.email_address')</label>
                        <div class="col-sm-8">
                            <input readonly=""  type="text" maxlength="100" class="form-control1" id="email_address" placeholder="Email Address" name="email_address" value="{{(!empty($user))?$user->email_address:Auth::user()->email}}">
                            <input  type="hidden" class="form-control1" id="country_id" placeholder="Choose Country" name="country_id" value="1">
                            <input  type="hidden" class="form-control1" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                            <input  type="hidden" class="form-control1" id="id" name="id" value="{{(!empty($user))?$user->id:'0'}}">
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
<script>
$("#logo").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#msg').html("Only formats are allowed : "+fileExtension.join(', '));
            $('#logo').val('');
        }
    });
</script>
@stop
@section('footer_scripts')
@stop
