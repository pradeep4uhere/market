
<!doctype html><html lang="en"><head><meta charset="utf-8" /><link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png"><link rel="icon" type="image/png" href="assets/img/favicon.png"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><title>Contact Us</title><meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' /><meta name="viewport" content="width=device-width" />
<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
<!-- CSS Files -->
<link href="{{config('global.LANDING_URL').'/assets/css/contactus_bootstrap.min.css'}}" rel="stylesheet">
<link href="{{config('global.LANDING_URL').'/assets/css/contactus_material-bootstrap-wizard.css'}}" rel="stylesheet">
<link href="{{config('global.LANDING_URL').'/assets/css/contact_us_demo.css'}}" rel="stylesheet">
</head>
<body>
<div class="image-container set-full-height" style="background-image: url('{{config('global.LANDING_URL')}}/assets/img/wizard-book.jpg')">
<!--   Creative Tim Branding   -->
<a href="{{env('APP_URL')}}">
<div class="logo-container">
<div class="logo">
<img src="{{env('APP_URL')}}/public/theme/prssystem/img/front/rsz_go4shoponline.jpg">
</div>
<div class="brand">
Go4Shop.
<small>online</small>
</div>
</div>
</a>
<!--  Made With Get Shit Done Kit  -->
<a href="{{env('APP_URL')}}" class="made-with-mk">
<div class="brand">
<i class="fa fa-home"></i>
</div>
<div class="made-with">Go to 
<strong>Home</strong>
</div>
</a>
<!--   Big container   -->
<div class="container">
<div class="row">
<div class="col-sm-8 col-sm-offset-2">
<!--      Wizard container        -->
<div class="wizard-container">
<div class="card wizard-card" data-color="red" id="wizard">
  <form id="ajax-contact"  method="post" action="{{route('contactuspage')}}" role="form">
    {{ csrf_field() }}
    <!--        You can switch " data-color="blue" "  with one of the next bright colors: "green", "orange", "red", "purple"             -->
    <div class="wizard-header">
      <h3 class="wizard-title">Contact Us</h3>
      <p><small class="description">Mahagun Mywoods, Gaur City-2, Greater Noida West, Pin-201016 (Uttar Pradesh)<br>, Mobile: +91-9958760605, Email: info@go4shop.online</small></p>
    </div>
    <div class="wizard-navigation">
      <ul>
        <li>
          <a href="#details" data-toggle="tab">I am</a>
        </li>
        <li>
          <a href="#captain" data-toggle="tab">Basic Details</a>
        </li>
        <li>
          <a href="#description" data-toggle="tab">Your Message</a>
        </li>
      </ul>
    </div>
    <div class="tab-content">
      <div class="tab-pane" id="captain">
        <div class="row">

           

          <div class="col-sm-12">
            <h5 class="info-text">Let's start with the basic details.</h5>
          </div>
            <div class="col-sm-6">
                  <div class="form-group label-floating">
                    <label class="control-label">First Name <small>(required)</small></label>
                    <input name="name" type="text" class="form-control">
                    </div>
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">email</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">Email <small>(required)</small></label>
                      <input name="email" type="email" class="form-control">
                    </div>
                  </div>
              </div>
              <div class="col-sm-6">
                 <div class="form-group label-floating">
                  <label class="control-label">Last Name <small>(required)</small></label>
                  <input name="surname" type="text" class="form-control">
                  </div>

                 <div class="input-group">
                    <span class="input-group-addon">
                      <i class="material-icons">phone</i>
                    </span>
                    <div class="form-group label-floating">
                      <label class="control-label">Mobile <small>(required)</small></label>
                      <input name="phone" type="text" class="form-control" maxlength="10">
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="tab-pane" id="details">
            <div class="row">

              <div class="col-sm-10 col-sm-offset-1">
                    <?php if(array_key_exists('status', $error)){
            if($error['status']){ ?>
            <div class="alert alert-success">{{$error['message']}}</div>  
            <?php }else if(!$error['status']){ ?>
            <div class="alert alert-danger">
                <?php $messages = $error['error']->messages();
                foreach ($messages as $message)
                {
                    echo "<li>";
                    echo $message[0];
                    echo "</li>";
                }
                ?>
            </div>  
            <?php }else{ ?>             
            <div class="alert alert-success">{{$error['message']}}</div> 
            <?php }} ?> 
              <center><h5>This information will let us know more about you.</h5></center>
                <div class="col-sm-3">
                  <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Select If you are Customer." id="type_1">
                    <input type="radio" name="usertype" value="1" id="type_1_val">
                      <div class="icon">
                        <i class="material-icons">how_to_reg</i>
                      </div>
                      <h6>Customer</h6>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Select if you are seller." id="type_2">
                      <input type="radio" name="usertype" value="2" id="type_2_val">
                        <div class="icon">
                          <i class="material-icons">store</i>
                        </div>
                        <h6>Seller</h6>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Select if you are sales user." id="type_3">
                        <input type="radio" name="usertype" value="3" id="type_3_val">
                          <div class="icon">
                            <i class="material-icons">supervisor_account</i>
                          </div>
                          <h6>Sales User</h6>
                        </div>
                      </div>
                    <div class="col-sm-3">
                      <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Select if you are not of them." id="type_4">
                        <input type="radio" name="usertype" value="4" id="type_4_val">
                          <div class="icon">
                            <i class="material-icons">account_circle</i>
                          </div>
                          <h6>Other</h6>
                        </div>
                      </div>

                    </div>


                  </div>
                </div>
                <div class="tab-pane" id="description">
                  <div class="row">
                    <h4 class="info-text"> Drop us a small message / Query.</h4>
                    <div class="col-sm-6 col-sm-offset-1">
                      <div class="form-group">
                        <label>Enter Your Query / Message</label>
                        <textarea class="form-control" placeholder="" rows="6" name="message"></textarea>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Address</label>
                        <p class="description">Mahagun Mywoods, Gaur City-2<br>
                            Greater Noida West<br>
                            Pin-201016 (Uttar Pradesh)</br>
                        Mobile: +91-9958760605</br>
                      Email: info@go4shop.online</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="wizard-footer">
                <div class="pull-right">
                  <input type='button' class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='Next' />
                  <input type='submit' class='btn btn-finish btn-fill btn-danger btn-wd' name='finish' value='Finish' />
                </div>
                <div class="pull-left">
                  <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
                  <div class="footer-checkbox">
                    <div class="col-sm-12">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="optionsCheckboxes" value="1">
                          </label>
                                Subscribe to our newsletter
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </form>
            </div>
          </div>
          <!-- wizard container -->
        </div>
      </div>
      <!-- row -->
    </div>
    <!--  big container -->
  <div class="footer">
        <div class="container">
             Made with by <a href="{{env('APP_URL')}}">www.go4shop.online</a>
        </div>
    </div>
  </div>
</body>
<!--   Core JS Files   -->
<script src="{{config('global.LANDING_URL').'/assets/js/jquery-2.2.4.min.js'}}"></script>
<script src="{{config('global.LANDING_URL').'/assets/js/bootstrap.min.js'}}"></script>
<script src="{{config('global.LANDING_URL').'/assets/js/jquery.bootstrap.js'}}"></script>
<!--  Plugin for the Wizard -->
<script src="{{config('global.LANDING_URL').'/assets/js/material-bootstrap-wizard.js'}}"></script>
<!--  More information about jquery.validate here: http://jqueryvalidation.org/  -->
<script src="{{config('global.LANDING_URL').'/assets/js/jquery.validate.min.js'}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.choice').on('click',function(){
      var id = $(this).attr('id');
      $(id+'_val').attr('checked');
    });
  });
</script>
</html>
