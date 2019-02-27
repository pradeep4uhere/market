	<style>
.widget-container {
    -webkit-border-radius: 2px;
    -webkit-background-clip: padding-box;
    -moz-border-radius: 2px;
    -moz-background-clip: padding;
    border-radius: 2px;
    background-clip: padding-box;
    -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .07);
    -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .07);
    box-shadow: 0 1px 2px rgba(0, 0, 0, .07);
    margin-bottom: 30px
}

.widget-container .widget {
    margin-bottom: 0
}

.widget-container>.row {
    margin-right: 0 !important;
    margin-left: 0 !important
}

.widget-container>.row>[class*="col-"] {
    padding-left: 0 !important;
    padding-right: 0 !important
}

.widget {
    -webkit-border-radius: 2px;
    -webkit-background-clip: padding-box;
    -moz-border-radius: 2px;
    -moz-background-clip: padding;
    border-radius: 2px;
    background-clip: padding-box;
    background-color: #fff;
    font-weight: 300;
    margin-bottom: 30px;
    position: relative;
    vertical-align: middle
}

.widget .row {
    font-size: 0;
    margin-left: 0;
    margin-right: 0
}

.widget .row:before {
    display: none
}

.widget .row .col {
    font-size: 11px
}

.widget .row .col:first-child {
    -webkit-border-radius: 2px 0 0 2px;
    -webkit-background-clip: padding-box;
    -moz-border-radius: 2px 0 0 2px;
    -moz-background-clip: padding;
    border-radius: 2px 0 0 2px;
    background-clip: padding-box
}

.widget .row .col:last-child {
    -webkit-border-radius: 0 2px 2px 0;
    -webkit-background-clip: padding-box;
    -moz-border-radius: 0 2px 2px 0;
    -moz-background-clip: padding;
    border-radius: 0 2px 2px 0;
    background-clip: padding-box
}

.widget .col {
    display: inline-block;
    vertical-align: top
}

.widget [class*=col-] {
    font-size: 11px;
    margin: 0;
    padding: 0
}

.image-tile {
    border: 1px solid #fff
}

.image-tile .tile {
    border: 1px solid #fff;
    height: 180px;
    margin: 0;
    padding: 0;
    text-align: center;
    vertical-align: bottom
}

.image-tile .tile:hover {
    cursor: pointer
}

.image-tile .tile:hover>p {
    background-color: rgba(3, 3, 3, .5);
    color: #fff
}

.image-tile .tile>p {
    background-color: rgba(3, 3, 3, 0);
    color: rgba(6, 6, 6, 0);
    font-size: 13px;
    font-weight: 300;
    height: 100%;
    padding-top: 50px;
    width: 100%
}

.image-tile .tile.more-images {
    background-color: #29c7ca;
    color: #fff;
    font-size: 15px;
    font-weight: 300
}

.image-tile .tile.more-images .images-number {
    font-size: 25px;
    margin-top: 20px
}
</style>
<div class="col-md-12">
    <div class="widget-container">
        <div class="widget row image-tile">
            <div class="tile col-md-3" style="background: url('{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/11.png') no-repeat center top; background-size: cover;">
                <p>View</p>
            </div>
            <div class="tile col-md-2" style="background: url('{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/22.png') no-repeat center top; background-size: cover;">
                <p>view  </p>
            </div>
			<div class="tile col-md-1" style="background: url('{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/33.jpg') no-repeat center top; background-size: cover;">
                <p>view  </p>
            </div>
            <div class="tile col-md-4" style="background: url('{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/44.jpg') no-repeat center top; background-size: cover;">
                <p>view  </p>
            </div>
            <div class="tile col-md-2" style="background: url('{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/55.jpeg') no-repeat center top; background-size: cover;">
                <p>view  </p>
            </div>
            <div class="tile col-md-1" style="background: url('{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/66.jpg') no-repeat center top; background-size: cover;">
                <p>view  </p>
            </div>
            <div class="tile col-md-3" style="background: url('{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/77.jpg') no-repeat center top; background-size: cover;">
                <p>view  </p>
            </div>
            <div class="tile col-md-2" style="background: url('{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/88.jpg') no-repeat center top; background-size: cover;">
                <p>view  </p>
            </div>
			<div class="tile col-md-3" style="background: url('{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/99.jpg') no-repeat center top; background-size: cover;">
                <p>view  </p>
            </div>
            <div class="tile col-md-2" style="background: url('{{ Config('global.THEME_URL_FRONT_IMAGE') }}/cat/10.jpg') no-repeat center top; background-size: cover;">
                <p>view  </p>
            </div>
            <div class="tile more-images col-md-1" style="background-color:#ff3a6d; padding-top:25px" >
                <div>42+</div>
                More
            </div>
        </div>
    </div>
</div>
    