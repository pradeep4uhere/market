<!DOCTYPE html>
<html lang="en">
    @include('prssystem.layouts.metaHead')

    <link href="{{config('global.THEME_URL_FRONT_CSS').'/bootstrap.min.css'}}" rel="stylesheet">
    <link href="{{config('global.THEME_URL_FRONT_CSS').'/material-icons.css'}}" rel="stylesheet">
    <link href="{{config('global.THEME_URL_FRONT_CSS').'/font-awesome-4.7.0/css/font-awesome.min.css'}}" rel="stylesheet">
    <link href="{{config('global.THEME_URL_FRONT_CSS').'/bootstrap/3.3.7/bootstrap.min.css'}}" rel="stylesheet">
    <link href="{{config('global.THEME_URL_FRONT_CSS').'/material-icons.css'}}" rel="stylesheet">
    <script src="{{config('global.THEME_URL_FRONT_JS').'/bootstrap/3.3.7/bootstrap.min.js'}}"></script>


    <!-- Bootstrap CSS -->
	<link href="http://localhost/laravel/public/css/app.css" rel="stylesheet">
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
    <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/style.css'}}">
	<script src="{{config('global.THEME_URL_FRONT_JS').'/jquery-3.2.1.min.js'}}"></script>
	<script src="{{config('global.THEME_URL_FRONT_JS').'/sweetalert.min.js'}}"></script>
    <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/theme.css'}}">
    <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/custom.scss.css'}}">
    <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/theme.custom.css'}}">
    <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/footer.css'}}">

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-7598818514297383",
        enable_page_level_ads: true
      });
    </script>
</head>
<body class="template-index" style="">
<div class="whole-content">
<!--============================= HEADER =============================-->
@include('prssystem.partials.frontend_header')
<div class="page-container drawer-page-content" id="PageContainer">
<main class="main-content" id="MainContent" role="main">

<!--============================= MAIN CONTENT =============================-->
@yield('content')
<!--============================= FOOTER =============================-->
@include('prssystem.partials.theme_footer')
<script>
var CSRF_TOKEN = '{{csrf_token()}}';
var POST_LOCATION_URL = '{{route('getlocation')}}';
</script>
<script type="text/javascript">
    if($(window).width() < 992) {
    //convertToMobile();
  }
  $(document).ready(function(){

      $('#menu-icon').on('click', function() {
    $("#mobile_top_menu_wrapper").animate({
      width: "toggle"
    });
  });

  $('#top_menu_closer i').on('click', function() {
    $("#mobile_top_menu_wrapper").animate({
      width: "toggle"
    });
  });


  });

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
</main>
</div>
</div>
</body>
</html>