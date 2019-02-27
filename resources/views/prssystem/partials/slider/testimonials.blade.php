 <link rel="stylesheet" href="{{config('global.THEME_URL_FRONT_CSS').'/lightslider.css'}}">
<style>
    ul{
        list-style: none outside none;
        padding-left: 0;
        margin: 0;
    }
    .demo .item{
        background-color: #FFF;
    }
    .content-slider li{
        background-color: #FFF;
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

    blockquote {
        border:none;
        font-family:Georgia, "Times New Roman", Times, serif;
        margin-bottom:-30px;
        }

        blockquote h3 {
            font-size:21px;
            color: #666
        }


        blockquote h3:before { 
            content: open-quote;
            font-weight: bold;
            font-size:100px;
            color:#888;
        } 
        blockquote h3:after { 
            content: close-quote;
            font-weight: bold;
            font-size:100px;
            color:#888;
        }
</style>
    <style type="text/css">
        /* carousel */
#quote-carousel 
{
  padding: 0 10px 10px 10px;
  margin-top: 30px;
}

/* Control buttons  */
#quote-carousel .carousel-control
{
  background: none;
  color: #222;
  font-size: 22px;
  text-shadow: none;
}
/* Previous button  */
#quote-carousel .carousel-control.left 
{
  left: -12px;
}
/* Next button  */
#quote-carousel .carousel-control.right 
{
  right: -12px !important;
}

#quote-carousel img
{
  width: 250px;
  height: 100px
}
/* End carousel */

.item blockquote {
    border-left: none; 
    margin: 0;
}

.item blockquote img {
    margin-bottom: 10px;
    border-radius: 50%;
}

.item blockquote p {
    font-size: 16px;
    color: #666
}

.item blockquote p:before {
    content: "\f10d";
    font-family: 'Fontawesome';
    float: left;
    margin-right: 10px;
    font-size: 20px;
    color: #666;
    margin-bottom:15px;
}
.item blockquote small {
    color: #666;
    font-size: 16px;
}

.item blockquote {
    border-left: none;
    margin: 0;
}
.item blockquote p:after {
    content: "\f10e";
    font-family: 'Fontawesome';
    float: right;
    margin-left: 10px;
    font-size: 20px;
    margin-bottom:15px;
}

#quote-carousel .carousel-indicators {
    position: relative;
    right: 50%;
    top: auto;
    bottom: 0px;
    margin-top: 20px;
    margin-right: -19px;
}
#quote-carousel .carousel-indicators li {
    width: 50px;
    height: 50px;
    cursor: pointer;
    border: 1px solid #ccc;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    border-radius: 50%;
    opacity: 0.4;
    overflow: hidden;
    transition: all .4s ease-in;
    vertical-align: middle;
}
#quote-carousel .carousel-indicators .active {
    width: 128px;
    height: 128px;
    opacity: 1;
    transition: all .2s;
}


/**
  MEDIA QUERIES
*/

/* Small devices (tablets, 768px and up) */
@media (min-width: 768px) { 
    #quote-carousel 
    {
      margin-bottom: 0;
      padding: 0 40px 30px 40px;
    }
    .img-circle img{
        border-radius: 50%;
    }
    
}

/* Small devices (tablets, up to 768px) */
@media (max-width: 768px) { 
    .img-circle img{
        border-radius: 50%;
    }
}
    </style>
    
    <script src="{{config('global.THEME_URL_FRONT_JS').'/lightslider.js'}}"></script>
    <script>
         $(document).ready(function() {
            $("#testimonial-slider").lightSlider({
                loop:true,
                keyPress:true,
                item:1,
                thumbItem:10,
                slideMargin: 0,
                speed:500,
                auto:true,
                loop:true,
                auto:true,
            });
        });
    </script>
    <div class="demo row" style="padding-top: 40px;">
            <div class="col-sm-2">&nbsp;</div>
            <div class="item col-sm-8 text-center">
            <div class="carousel slide" data-ride="carousel" id="quote-carousel">
            <ul id="testimonial-slider" class="content-slider">

                @if(!empty($itemList))
                @foreach($itemList as $testimonials)
                <li>
                 <div class="carousel-inner text-center">
                  <!-- Quote 3 -->
                  <div class="item">
                    <blockquote>
                      <div class="row">
                        <div class="col-sm-2 text-center">
                          <img class="img-circle" src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/user.jpg" style="width: 100px;height:100px;">
                        </div>
                        <div class="col-sm-9">
                          <p>{{$testimonials['text']}}</p>
                          <small style="margin-top:5px;padding-top: 10px;">--{{$testimonials['full_name']}}</small>
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  </div>  
                </li>
                @endforeach
                @endif
            </ul>
            
        </div>
        </div>
    </div>  
<hr style="margin:0px;">
