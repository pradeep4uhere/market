 <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/lightslider.css'}}">
    <style>
        ul{
            list-style: none outside none;
            padding-left: 0;
            margin: 0;
            text-align: left;
        }
        .demo .item{
            margin-bottom: 60px;
        }
        .content-slider li{
            background-color: #FFF;
            color: #FFF;
            text-align: left;
        }
        .content-slider img {
            margin: 0;
            padding:0;
        }
        .content-slider p {
            margin: 0;
            padding:0;
            color: #CCC;
            text-align: left;
        }
        .demo{
            width: 100%;
        }
    </style>
    
    <script src="{{config('global.THEME_URL_FRONT_JS').'/lightslider.js'}}"></script>
    <script>
         $(document).ready(function() {
            $("#content-slider_seller").lightSlider({
                loop:true,
                keyPress:true,
                auto:true
            });
         });
    </script>
    <div class="demo">
        <div class="item container-fluid">
            <ul id="content-slider_seller" class="content-slider ">
                <?php $count=0;foreach($sellerArr as $seller){ if($count<=10){ ?>
                <li style="width:180px; text-align: left;">
                   <div class="container-fluid">
                      <div class="row">
                        <div class="col-md-10">
                          <div class="featured-place-wrap">{{config('global.SELLER_STORAGE_DIR') }}
                              <a href="{{route('sellerview',['seller'=>str_slug($seller['business_name']),'id'=>encrypt($seller['id'])])}}">
                                <img height="300" src="{{config('global.SELLER_STORAGE_DIR').'/250X250/'.$seller['image_thumb']}}" onerror="this.onerror=null;this.src='{{ Config('global.THEME_URL_FRONT_IMAGE') }}/default250x250.jpg';"/>
                                <div class="featured-title-box">
                                    <h2>{{ucwords($seller['business_name'])}}</h2>
                                    <p>{{$seller['StoreType']['name']}} </p><span>• </span>
                                    <p>3 Reviews</p> <span> • </span>
                                    <p><span>Open Now</span></p>
                                    <ul>
                                    <li style="text-align: left;">
                                        <p> <i class="fa fa-map-marker"></i> {{$seller['address_1']}}, {{$seller['location']}},{{$seller['district']}},{{$seller['state']}},{{$seller['pincode']}}</p>
                                    </li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                        </div>
                      </div>
                    </div>
                </li>
                <?php $count++; }} ?>
            </ul>
        </div>
    </div>  