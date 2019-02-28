<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Become Seller, Build Your Profile in 5 min</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!--     Fonts and icons     -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.css" rel="stylesheet">

    <!-- CSS Files -->
    <link href="{{config('global.LANDING_URL').'/assets/css/bootstrap.min.css'}}" rel="stylesheet">
    <link href="{{config('global.LANDING_URL').'/assets/css/gsdk-bootstrap-wizard.css'}}" rel="stylesheet">
    <link href="{{config('global.LANDING_URL').'/assets/css/demo.css'}}" rel="stylesheet">
    

</head>

<body>
<div class="image-container set-full-height" style="background-image: url('{{config('global.LANDING_URL')}}/assets/img/wizard.jpg')">
    <!--   Creative Tim Branding   -->
    <a href="{{env('APP_URL')}}">
         <div class="logo-container">
            <div class="logo">
                <img src="{{env('APP_URL')}}/public/theme/prssystem/img/front/rsz_go4shoponline.jpg">
            </div>
            <div class="brand">
                Go4Shop.<small>online</small>
            </div>
        </div>
    </a>

    <!--  Made With Get Shit Done Kit  -->
        <a href="{{env('APP_URL')}}" class="made-with-mk">
            <div class="brand"><i class="fa fa-home"></i></div>
            <div class="made-with">Go to <strong>Home</strong></div>
        </a>
        
    <!--   Big container   -->
    <div class="container">
        <div class="row">
        <div class="col-sm-8 col-sm-offset-2">

            <!--      Wizard container        -->
            <div class="wizard-container">

                <div class="card wizard-card" data-color="orange" id="wizardProfile">

                    <form method="POST" action="{{route('create')}}">
                        {!! csrf_field() !!}
                <!--        You can switch ' data-color="orange" '  with one of the next bright colors: "blue", "green", "orange", "red"          -->

                        <div class="wizard-header">
                            <h3>
                               <b>CREATE</b> YOUR PROFILE <br>
                               <small>This information will let us know more about you.</small>
                            </h3>
                            <p>
                                @if(Session::has('message'))
                                <p class="alert alert-success">You profile is created successfully, click here for <a href="{{route('login')}}">Login</a></p>
                                @endif
                                @if(Session::has('error'))
                                <p class="alert alert-danger"><small>
                                @foreach(Session::get('error') as $err)
                                <b>Error:</b> {{ $err }}</br>
                                @endforeach
                                </small>
                                </p>
                                @endif

                            </p>
                        </div>

                        <div class="wizard-navigation">
                            <ul>
                                <li><a href="#about" data-toggle="tab">About</a></li>
                                <li><a href="#account" data-toggle="tab">Address</a></li>
                            </ul>

                        </div>

                        <div class="tab-content">
                            <div class="tab-pane" id="about">
                                
                              <div class="row">
                                  <h4 class="info-text"> Let's start with the basic information</h4>
                                  <div class="col-sm-4 col-sm-offset-1">
                                     <div class="picture-container">
                                          <div class="picture">
                                              <img src="{{config('global.LANDING_URL')}}/assets/img/default-avatar.png" class="picture-src" id="wizardPicturePreview" title=""/>
                                              <input type="file" id="wizard-user-picture">
                                          </div>
                                          <h6>Choose Picture</h6>
                                      </div>
                                  </div>
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                        <label>First Name <small>(required)</small></label>
                                        <input name="firstname" type="text" class="form-control" placeholder="Andrew..." value="{{Session::get('firstname')}}">
                                      </div>
                                      <div class="form-group">
                                        <label>Last Name <small>(required)</small></label>
                                        <input name="lastname" type="text" class="form-control" placeholder="Smith..."  value="{{Session::get('lastname')}}">
                                      </div>
                                  </div>
                                  <div class="col-sm-5 col-sm-offset-1">
                                      <div class="form-group">
                                          <label>Email <small>(required)</small></label>
                                          <input name="email" type="email" class="form-control" placeholder="e.g andrew@abc.com" value="{{Session::get('email')}}">
                                      </div>
                                  </div>
                                  <div class="col-sm-5">
                                      <div class="form-group">
                                          <label>Mobile No <small>(required)</small></label>
                                          <input name="mobile" type="text" class="form-control" placeholder="e.g 9015446567" maxlength="10" value="{{Session::get('mobile')}}">
                                      </div>
                                  </div>
                                  <div class="col-sm-5 col-sm-offset-1">
                                      <div class="form-group">
                                          <label>Password <small>(required)</small></label>
                                          <input name="password" type="password" class="form-control" placeholder="enter your password" required="required" value="{{Session::get('password')}}">
                                      </div>
                                   
                                  </div>
                                  <div class="col-sm-5">
                                     <div class="form-group">
                                        <label>Confirm Password <small>(required)</small></label>
                                        <input name="password_confirmation" type="password" class="form-control" placeholder="enter your confirm password" required="required">
                                      </div>
                                  </div>
                              </div>
                             
                            </div>
                            <div class="tab-pane" id="account">
                                 <!--Address-->
                                 <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="info-text"> Are you living in a nice area? </h4>
                                    </div>
                                    <div class="col-sm-5 col-sm-offset-1">
                                         <div class="form-group">
                                             <label>State <small>(required)</small></label><br>
                                             <select class="form-control"  id="state" name="state" >
                                                <option value="">Choose State</option>
                                                @if(!empty($stateList))
                                                @foreach($stateList as $name)
                                                <option value="{{$name->state}}" <?php if(strtolower(Session::get('state'))==strtolower($name->state)){ ?> selected="selected" <?php } ?>>{{$name->state}}</option>
                                                @endforeach
                                                @endif
                                              </select>
                                          </div>
                                    </div>
                                     <div class="col-sm-5">
                                         <div class="form-group">
                                            <label>District <small>(required)</small></label><br>
                                             <select  class="form-control"  data-live-search="true" id="city_id" name="district">
                                              <option data-tokens="">Choose City/District</option>
                                            </select>
                                          </div>
                                    </div>

                                    <div class="col-sm-5 col-sm-offset-1">
                                         <div class="form-group">
                                            <label>Location <small>(required)</small></label><br>
                                             <select  class="form-control" data-live-search="true" id="location" name="location">
                                              <option data-tokens="">Choose Locations</option>
                                            </select>
                                          </div>
                                    </div>
                                    <div class="col-sm-5">
                                         <div class="form-group">
                                            <label>Pincode <small>(required)</small></label>
                                            <input type="text" class="form-control" placeholder="201301" name="pincode" id="pincode" value={{Session::get('pincode')}}>
                                          </div>
                                    </div>
                                    <div class="col-sm-10 col-sm-offset-1">
                                         <div class="form-group">
                                            <label>Street Name / Address <small>(required)</small></label>
                                            <input type="text" class="form-control" placeholder="5h Avenue, Gaur City-2" name="address" value={{Session::get('address')}}>
                                          </div>
                                    </div>
                                   
                                </div>
                                 <!--Address-->

                            </div>
                            <div class="tab-pane" id="address">
                                 <div class="row">
                                  <h4 class="info-text"> Basic Store Information</h4>
                                  <div class="col-sm-4 col-sm-offset-1">
                                     
                                  </div>
                              </div>
                            </div>
                        </div>
                        <div class="wizard-footer height-wizard">
                            <div class="pull-right">
                                <input type='button' class='btn btn-next btn-fill btn-warning btn-wd btn-sm' name='next' value='Next' />
                                <input type='submit' class='btn btn-finish btn-fill btn-warning btn-wd btn-sm' name='finish' value='Finish' />
                                <input  type="hidden" class="form-control1" id="location_id" name="location_id">

                            </div>

                            <div class="pull-left">
                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd btn-sm' name='previous' value='Previous' />
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </form>
                </div>
            </div> <!-- wizard container -->
        </div>
        </div><!-- end row -->
    </div> <!--  big container -->

    <div class="footer">
        <div class="container">
             Made with <i class="fa fa-heart heart"></i> by <a href="{{env('APP_URL')}}">www.go4shop.online</a>
        </div>
    </div>

</div>

<!--   Core JS Files   -->
<script src="{{config('global.LANDING_URL').'/assets/js/jquery-2.2.4.min.js'}}"></script>
<script src="{{config('global.LANDING_URL').'/assets/js/bootstrap.min.js'}}"></script>
<script src="{{config('global.LANDING_URL').'/assets/js/jquery.bootstrap.wizard.js'}}"></script>
<!--  Plugin for the Wizard -->
<script src="{{config('global.LANDING_URL').'/assets/js/gsdk-bootstrap-wizard.js'}}"></script>
<!--  More information about jquery.validate here: http://jqueryvalidation.org/  -->
<script src="{{config('global.LANDING_URL').'/assets/js/jquery.validate.min.js'}}"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#state').on('change',function(){
        var state = this.value;      
        if(state!=''){
            $.ajax({
                url: "{{route('getcity')}}/"+state,
            beforeSend: function( xhr ) {
                    //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
                }
            }).done(function( data ) {
                $('#city_id').html(data);
                
            });
        }
    });




    $('#city_id').on('change',function(){
        var district = this.value;  
        if(district!=''){
            $.ajax({
               url: "{{url('getdislist')}}/"+district,
            beforeSend: function( xhr ) {
                    //xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
                }
            }).done(function( data ) {
                $('#location').html(data);
            });
        }
    });



    $('#location').on('change',function(){
        if(this.value.length>0){
            var pinArr = this.value.split("|");
            var pincode = pinArr[1]; 
            $('#pincode').val(pincode);
            $('#location_id').val(pinArr[0]);
        }
    });

$("#wizard-user-picture").change(function () {
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            $('#msg').html("Only formats are allowed : "+fileExtension.join(', '));
            $('#wizard-user-picture').val('');
        }
    });
});
</script>
</body>
    

    
</html>
