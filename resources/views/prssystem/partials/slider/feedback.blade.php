 <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/lightslider.css'}}">
    <style>
        ul{
            list-style: none outside none;
            padding-left: 0;
            margin: 0;
        }
        .demo .item{
            margin-bottom: 60px;
        }
        .content-slider li{
            background-color: #CCC;
            text-align: center;
            color: #FFF;
        }
        .content-slider img {
            margin: 0;
            padding:0;
        }
        .demo{
            width: 100%;
        }
    </style>
    
    <script src="{{config('global.THEME_URL_FRONT_JS').'/lightslider.js'}}"></script>
    <script>
         $(document).ready(function() {
            $("#content-slider").lightSlider({
                loop:true,
                keyPress:true
            });
            $('#image-gallery').lightSlider({
                gallery:true,
                item:6,
                thumbItem:9,
                slideMargin: 0,
                speed:300,
                auto:true,
                loop:true,
                auto:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
        });
    </script>
    <div class="demo">
        <div class="item">
            <ul id="content-slider" class="content-slider">
                <li>
                    <img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/11.png">
                </li>
                <li>
                    <img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/11.png">
                </li>
                <li>
                    <img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/11.png">
                </li>
                <li>
                    <img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/11.png">
                </li>
                <li>
                    <img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/11.png">
                </li>
                <li>
                    <img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/11.png">
                </li>
                <li>
                    <img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/11.png">
                </li>
                <li>
                    <img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/11.png">
                </li>
            </ul>
        </div>

    </div>  