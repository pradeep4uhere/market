<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{config('global.THEME_URL_CSS').'/profile/bootstrap.min.css'}}" rel="stylesheet">
    <link href="{{config('global.THEME_URL_CSS').'/profile/style.css'}}" rel="stylesheet">
    <link href="{{config('global.THEME_URL_CSS').'/profile/font-awesome.css'}}" rel="stylesheet">
    <link href="{{config('global.THEME_URL_CSS').'/profile/font-awesome.min.css'}}" rel="stylesheet">
    <link href="{{config('global.THEME_URL_CSS').'/profile/icon-font.min.css'}}" rel="stylesheet">
    <script src="{{config('global.THEME_URL_JS').'/profile/Chart.js'}}"></script>
    <link href="{{config('global.THEME_URL_CSS').'/profile/animate.css'}}" rel="stylesheet">
    <script src="{{config('global.THEME_URL_JS').'/profile/wow.min.js'}}"></script>
    

<!--<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" rel="stylesheet">-->
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>-->
    
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script>
//         new WOW().init();
</script>
<!----webfonts--->

<!--<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>-->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<!---//webfonts---> 
 <!-- Meters graphs -->
<script src="{{config('global.THEME_URL_JS').'/profile/'}}jquery-1.11.0.min.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->
</head>
 <body class="sticky-header left-side-collapsed">
<section>
<!-- BEGIN MAIN CONTENT -->  
@include('prssystem.partials.leftsidebar')
<!-- main content start-->
<div class="main-content">
@include('prssystem.partials.notificationbar')
@yield('content')
</div>
<!-- END MAIN CONTENT -->
</section>
<!-- Scripts -->
<script src="{{config('global.THEME_URL_JS').'/profile/jquery.nicescroll.js'}}"></script>
<script src="{{config('global.THEME_URL_JS').'/profile/scripts.js'}}"></script>
<script src="{{config('global.THEME_URL_JS').'/profile/bootstrap.min.js'}}"></script>
<script>
CSRF_TOKEN="{{csrf_token()}}";
</script>
<script src="{{config('global.THEME_URL_JS').'/profile/custome.js'}}"></script>
</body>
</html>
