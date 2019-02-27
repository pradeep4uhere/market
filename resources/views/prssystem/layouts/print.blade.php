<!DOCTYPE html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="grabmorenow">
    <meta name="description" content="Become Seller Now Or Order Online From Nearest Shop">
    <meta name="keywords" content="Best Grocery Items, Best Seller Platform">
    <!-- Page Title -->
     <title>{{ config('app.name') }}</title>
    <!-- Bootstrap CSS -->
    <link href="{{config('global.THEME_URL_FRONT_CSS').'/bootstrap.min.css'}}" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900" rel="stylesheet">
    <!-- Simple line Icon -->
    <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/simple-line-icons.css'}}">
    <!-- Themify Icon -->
    <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/themify-icons.css'}}">
    <!-- Hover Effects -->
    <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/set1.css'}}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/thumbs2.css'}}">
    <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/thumbnail-slider.css'}}">
    <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/style.css'}}">
	<script src="{{config('global.THEME_URL_FRONT_JS').'/jquery-3.2.1.min.js'}}"></script>
	<script src="{{config('global.THEME_URL_FRONT_JS').'/sweetalert.min.js'}}"></script>
</head>
<body>
<div class="nav-menu">
        <div class="bg transition">
            <div class="container-fluid fixed">
<!--============================= HEADER START HERE =============================-->
@include('prssystem.partials.frontend_header')
<!--============================= HEADER ENDS HERE=============================-->
</div>    
</div>    
</div>    
   
<!-- BEGIN MAIN CONTENT -->
   @yield('content')
<!-- END MAIN CONTENT -->
<!--============================= FOOTER =============================-->
    @include('prssystem.partials.frontend_footer')
	<script>
		var CSRF_TOKEN = '{{csrf_token()}}';
		var POST_LOCATION_URL = '{{route('getlocation')}}';
	</script>
    <!--//END FOOTER -->
    <!-- jQuery, Bootstrap JS. -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{config('global.THEME_URL_FRONT_JS').'/popper.min.js'}}"></script>
    <script src="{{config('global.THEME_URL_FRONT_JS').'/bootstrap.min.js'}}"></script>
	<script src="{{config('global.THEME_URL_FRONT_JS').'/custome.js'}}"></script>
<!-- begin page level js -->
@yield('footer_scripts')
<!-- end page level js -->
    </body>
</html>
