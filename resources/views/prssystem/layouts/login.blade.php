<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" >
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css'>
        <!--<link rel="stylesheet" href="{{config('global.THEME_URL_CSS').'/materialize.min.css'}}">-->
        <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Pacifico'>
        <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
        <link rel="stylesheet" href="{{config('global.THEME_URL_CSS').'/login.css'}}">
        <style>
        .login-body{background-image:url({{config('global.THEME_URL_IMAGE').'/bg1.jpg'}});background-size:cover;background-position: center;background-attachment:fixed;}

        </style>
    </head>
    <body>
    <html>
        <head>
            <meta charset="utf-8">
            <title>Member Login</title>
        </head>
        <body class="login-body">
            <div class="row">
                <div class="input-cart col s12 m10 push-m1 z-depth-2 grey lighten-5">
                    <div class="col s12 m5 login">
                        <h4 class="center grey-text"><b>Log in</b></h4>
                        <br>
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="input-field">
                                    <input type="email" id="email" name="email" class="validate" required="required" placeholder="Email Address" value="{{ old('email') }}">
                                    <label for="user">
                                        <i class="material-icons">person</i>                </label>
                                </div>	
                            </div>
                            <div class="row">
                                <div class="input-field">
                                    <input type="password" id="pass" name="password" class="validate" required="required" placeholder="Password">
                                    <label for="pass">
                                        <i class="material-icons">lock</i>
                                    </label>
                                </div>	
                            </div>
                            <div class="row">
                                <div class="switch col s6">
                                    <label>
                                        <input type="checkbox"  {{ old('remember') ? 'checked' : '' }}>
                                               <span class="lever"></span>
                                        Remember Me
                                    </label>
                                    <br/>
                                    <br/>
                                    <label>
                                        <a href="{{ route('password.request') }}">Forgot Your Password?</a>
                                    </label>
                                </div>
                                <div class="col s6">
                                    <button type="submit" name="login" class="btn waves-effect waves-light blue right">Log in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Signup form -->
                    <div class="col s12 m7 signup">
                        <div class="signupForm">
                            <h4 class="center grey-text"><b>Sign up</b></h4>
                            <br>
                            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="input-field col s12 m6">
                                        <input type="text" id="name-picked" name="first_name" class="validate" required="required" placeholder="Enter a First Name">
                                        <label for="name-picked">
                                            <i class="material-icons">person_add</i>       
                                        </label>
                                    </div>
                                    <div class="input-field col s12 m6">
                                        <input type="text" id="pass-picked" name="last_name" class="validate" required="required" placeholder="Enter Last Name">
                                        <label for="pass-picked">
                                            <i class="material-icons">lock</i>                    
                                        </label>
                                    </div>	
                                </div>
                                <div class="row">
                                    <div class="input-field email">
                                        <div class="input-field col s12 m6">
                                            <input type="text" id="email" name="email" class="validate" required="required" placeholder="Enter your email">
                                            <label for="email">
                                                <i class="material-icons">mail</i> 
                                            </label>
                                        </div>
                                        <div class="input-field col s12 m6">
                                        <input type="password" id="pass-picked" name="password" class="validate" required="required" placeholder="Enter Password">
                                        <label for="pass-picked">
                                            <i class="material-icons">lock</i>                    
                                        </label>
                                    </div>
                                    </div>	
                                </div>
                            
                            <div class="row">
                                <label>

                                    You can SignUp By Facebook, Google OR Twitter account, by click <a href="#!" class="waves-effect waves-light ">Login</a> button right bottom.
                                </label>
                                <button type="submit" name="btn-signup" class="btn blue right waves-effect waves-light  ">Sign Up</button>
                            </div>
                        </form>
                        </div>
                        <div class="signup-toggle center" >
                            <h4 class="center">Have No Account ? <a href="#!" class="main-title red-text">Sign Up</a></h4>
                        </div>
                    </div>
                    <div class="col s12">
                        <br>
                        <div class="legal center">
                        </div>
                        <div class="legal center">
                            <div class="col s12 m7 right">
                                <p class="grey-text policy center">By signing up, you agree on our <a href="#!">Privacy Policy</a> and  <a href="#!">Terms of Use</a> including <a href="#!">Cookie Use</a>.</p>
                            </div>
                            <div class="col s12 m5">
                                <p class="center grey-text" style="font-size: 14px;">&COPY; GRABMORE PVT LTD. <a href="#" class="main-title red-text" target="_blank">GrabMore</a></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="fixed-action-btn toolbar">
                <a class="btn-floating btn-large amber black-text">
                    Login
                </a>
                <ul>
                    <li><a class="indigo center" href="#!">Login with FB</a></li>
                    <li><a class="blue center" href="#!">Login with Twitter</a></li>
                    <li><a class="red center" href="#!">Login with Google +</a></li>
                </ul>
            </div>
        </body>
    </html>
      <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>-->
    <!--<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js'></script>-->
    <script  src="{{config('global.THEME_URL_JS').'/jquery.min.js'}}"></script>
    <script  src="{{config('global.THEME_URL_JS').'/materialize.min.js'}}"></script>
    <script  src="{{config('global.THEME_URL_JS').'/login.js'}}"></script>
</body>
</html>
