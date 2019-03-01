@extends('prssystem/layouts/frontDetails')
@section('title')
Contact Us
@stop
@section('content')
<div class="container-fluid" style="padding:0px; ">
<div class="row">
<div class="col-md-12">
<div class="container-fluid" style="background: #FFF">
<h1 class="text-center">Contact US</h1>
<div class="contact-us">
       <div class="container">
          <div class="contact-form">
           <div class="row">
            <div class="col-md-4 featured-responsive">
                    <div class="detail-filter-text">
                        <h3>Is account registration required?</h3>
                    </div>
                </div>
               <div class="col-sm-7">   
                    
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


                    <form id="ajax-contact"  method="post" action="{{route('contactus')}}" role="form">
                        {{ csrf_field() }}
                        <div class="messages" id="form-messages"></div>
                        <div class="controls">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_name">Firstname *</label>
                                        <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_lastname">Lastname *</label>
                                        <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Please enter your lastname *">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_email">Email *</label>
                                        <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" >
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_phone">Phone*</label>
                                        <input id="form_phone" type="tel" name="phone"  class="form-control" placeholder="Please enter your phone*" >
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="form_message">Message *</label>
                                        <textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" ></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-danger" value="Send message">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                   <br>
                                    <small class="text-muted"><strong>*</strong> These fields are required.</small>
                                </div>
                            </div>
                        </div>

                    </form>
    
               </div>
               <div class="col-sm-5">
                   <div class="row col1">
                       <div class="col-xs-3">
                           <i class="fa fa-map-marker" style="font-size:16px;"></i>   Address <br>
                       </div>
                       <div class="col-xs-9">
                            www.go4shop.online,<br>
                            Mahagun, Gaur City-2<br>
                            Noida Extension,Greater Noida West<br>
                            Pin-201016 (Uttar Pradesh)
                       </div>
                   </div>
                   
                    <div class="row col1">
                        <div class="col-sm-3">
                            <i class="fa fa-phone"></i>   Phone
                        </div>
                        <div class="col-sm-9">
                             +(91) 9015446567
                        </div>
                    </div>
                    <div class="row col1">
                        <div class="col-sm-3">
                             <i class="fa fa-fax"></i>    Office-  
                        </div>
                        <div class="col-sm-9">
                              +(91) 7610902646
                        </div>
                    </div>
                    <div class="row col1">
                        <div class="col-sm-3">
                            <i class="fa fa-envelope"></i>   Email
                        </div>
                        <div class="col-sm-9">
                             <a href="mailto:info@yourdomain.com">info@go4shop.online</a> <br> <a href="mailto:support@yourdomain.com">support@go4shop.online</a>
                        </div>
                    </div><br>
                   <!--  <iframe width="90%" height="230" frameborder="0" style="border-radius:0px;" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?client=firefox-a&ie=UTF8&q=www.go4shop.online&fb=1&gl=in&hq=www.go4shop.online&cid=8183905562449910042&t=m&ll=28.62162,77.4232574&spn=0.052731,0.154495&z=13&iwloc=A&output=embed"  style="border-radius:20px;"></iframe> -->
               </div>
           </div>
           
          </div>
       </div>
   </div>
    
</div>
        </div>
    </div>
@stop
@section('footer_scripts')
@stop