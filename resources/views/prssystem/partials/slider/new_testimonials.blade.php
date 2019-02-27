<style type="text/css">
    #quote-carousel {
    padding: 0 10px 30px 10px;
    margin-top: 60px;
}
#quote-carousel .carousel-control {
    background: none;
    color: #CACACA;
    font-size: 2.3em;
    text-shadow: none;
    margin-top: 30px;
}
#quote-carousel p {
    font-size: 16px;
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
.item blockquote {
    border-left: none;
    margin: 0;
}
.item blockquote p:before {
    content: "\f10d";
    font-family: 'Fontawesome';
    float: left;
    margin-right: 10px;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                <!-- Carousel Slides / Quotes -->
                <div class="carousel-inner text-center">
                    <?php if(!empty($itemList)){  $count =1;
                    foreach($itemList as $testimonials){ ?>
                    <!-- Quote 1 -->
                    <div class="item <?php if($count==1){ echo "active";} ?>">
                        <blockquote>
                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <p>{{$testimonials['text']}}</p>
                                    <small>-{{$testimonials['full_name']}}</small>
                                </div>
                            </div>
                        </blockquote>
                    </div>
                    <?php $count++;}} ?>
                </div>
                <ol class="carousel-indicators">
                        <li data-target="#quote-carousel" data-slide-to="0" class="active"><img class="img-responsive " src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/user.jpg" alt="">
                        </li>
                    </ol>
                <!-- Carousel Buttons Next/Prev -->
                <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
    </div>
</div>