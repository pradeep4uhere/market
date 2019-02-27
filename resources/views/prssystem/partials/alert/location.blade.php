<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
</script>
<style type="text/css">
	.modal-content{
		width: 600px;
	}
</style>
<link href="{{env('APP_URL')}}public/css/app.css" rel="stylesheet">
<div class="container-fluid">
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog modal-sm">
  <div class="modal-content">
	 <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sign in</h4>
        </div>
    <div class="modal-body">
		    <div class="container">
		        <div class="row">
		           <div class="col-md-4 text-white text-center bg-danger">
		                <div class="">
		                    <div class="card-body">
		                        <p><img width="50%" src="http://www.ansonika.com/mavia/img/registration_bg.svg"></p>
		                        <p>Already Register Member Login</p>
		                    </div>
		                </div>
		            </div>
		            <div class="col-md-8 border ">
		                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
		                            {{ csrf_field() }}
		                    <div class="form-row">
		                        <div class="form-group col-md-12">
		                          <input type="email" id="email" name="email" class="form-control validate" required="required" placeholder="Email Address" value="{{ old('email') }}">
		                        </div>
		                        
		                      </div>
		                    <div class="form-row">
		                        <div class="form-group col-md-12">
		                            <input type="password" id="pass" name="password" class="form-control validate" required="required" placeholder="Password">
		                        </div>
		                    </div>
		                    <div class="signup-toggle center" >
		                                    <small><a href="#!" class="main-title red-text" style="color: red; font-weight: bold">Forgot Password ?</a></small>
		                                  </div>
							<div class="signup-toggle center" >
		                            <p class="center">Have No Account ? <a href="{{route('register')}}" class="main-title red-text" style="color: red; font-weight: bold">Sign Up</a></p>
		                        </div>
		                    
		                    <div class="form-row">
		                        <button type="submit" name="login" class="btn waves-effect waves-light blue right btn-danger">Log in</button>
		                    </div>
		                </form>
		            </div>
		        </div>
		    </div>
        </div>
        
      </div>
    </div>
  </div>
</div>