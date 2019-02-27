<!DOCTYPE html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="index,follow"/>
    <meta name="googlebot" content="noodp, noydir"/>
    <title>@yield('title')</title>


    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="news_keywords" content="@yield('keywords')"/>

    <meta itemprop="name" content="@yield('description')">
    <meta itemprop="description" content="@yield('description')">

    <meta itemprop="image" content="@yield('pageimage')"> 
    <link rel="amphtml" href="@yield('pageurl')"/>

    <meta name="author" content="{{env('APP_NAME')}}">
    <meta property="article:published_time" content="@yield('publishedTime')"/>
    <meta property="article:modified_time" content="@yield('modifiedTime')"/>
    <meta property="article:section" content="@yield('section')">
    <meta property="article:category" content="@yield('category')">
    <meta property="article:tag" content="@yield('tag')"/>

    <meta property="og:type" content="article"/>
    <meta name="twitter:creator" content="@yield('description')"/>
    <meta name="twitter:card" content="@yield('description')">
    <meta name="twitter:site" content="{{env('APP_URL')}}">
    <meta name="twitter:title" content="@yield('description')">
    <meta name="twitter:description" content="@yield('description')">
    <meta name="twitter:image" content="@yield('urlimage')">

    <meta property="og:title" content="@yield('title')"/>
    <meta property="og:url" content="@yield('url')"/>
    <meta property="og:image" content="@yield('urlimage')"/>
    <meta property="og:image:width" content="200"/>
    <meta property="og:image:height" content="250"/>
    <meta property="og:description" content="@yield('description')"/>
    <meta property="og:site_name" content="{{env('APP_NAME')}}"/>
    <meta name="atdlayout" content="article">

    <!-- Page Title -->
    <!-- Bootstrap CSS -->
    <link href="{{config('global.THEME_URL_FRONT_CSS').'/bootstrap.min.css'}}" rel="stylesheet">
    <link href="{{config('global.THEME_URL_FRONT_CSS').'/material-icons.css'}}" rel="stylesheet">
    <link href="{{config('global.THEME_URL_FRONT_CSS').'/material-icons.css'}}" rel="stylesheet">
    <link href="{{config('global.THEME_URL_FRONT_CSS').'/bootstrap/3.3.7/bootstrap.min.css'}}" rel="stylesheet">
    <script src="{{config('global.THEME_URL_FRONT_JS').'/bootstrap/3.3.7/bootstrap.min.js'}}"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700,900" rel="stylesheet">
    <link href="{{config('global.THEME_URL_FRONT_CSS').'/font-awesome-4.7.0/css/font-awesome.min.css'}}" rel="stylesheet">
    <!-- Simple line Icon -->
    <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/simple-line-icons.css'}}">
    <!-- Themify Icon -->
    <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/themify-icons.css'}}">
    <!-- Swipper Slider -->
    <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/swiper.min.css'}}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/magnific-popup.css'}}">
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






<!-- jQuery, Bootstrap JS. -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{config('global.THEME_URL_FRONT_JS').'/popper.min.js'}}"></script>
<script src="{{config('global.THEME_URL_FRONT_JS').'/bootstrap/3.3.7/bootstrap.min.js'}}"></script>
<!-- Magnific popup JS -->
<script src="{{config('global.THEME_URL_FRONT_JS').'/jquery.magnific-popup.js'}}"></script>
<!-- Swipper Slider JS -->
<script src="{{config('global.THEME_URL_FRONT_JS').'/swiper.min.js'}}"></script>
<script src="{{config('global.THEME_URL_FRONT_JS').'/front-common.js'}}"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 3,
        slidesPerGroup: 3,
        loop: true,
        loopFillGroupWithBlank: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
<script>
    if ($('.image-link').length) {
        $('.image-link').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    }
    if ($('.image-link2').length) {
        $('.image-link2').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });
    }



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
<!-- begin page level js -->
@yield('footer_scripts')
<!-- end page level js -->
</main>
</div>
</div>
</body>
</html>
