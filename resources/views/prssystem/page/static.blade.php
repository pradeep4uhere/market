@extends('prssystem/layouts/frontDetails')
@section('title'){{$pageRow['title']}}@stop
@section('description'){{$pageRow['title']}}@stop
@section('content')
<style type="text/css">
	.detail-filter-wrap p{
		font-size: 13px;
	}
</style>
<section style="margin-top: 30px;">
<div class="container">
	<div class="row">
    	<div class="col-md-12 responsive-wrap">
			<div class="row detail-filter-wrap">
			    <div class="col-md-4 featured-responsive">
			        <div class="detail-filter-text">
			            <h3>{{$pageRow['title']}}</h3>
			        </div>
			    </div>
			</div>
    		<div class="row detail-filter-wrap" style="font-size: 13px !important;">
				<p >{!! $pageRow['description'] !!}</p>
	   		</div>
		</div>
	</div>
</div>
</section>
@stop
@section('footer_scripts')
@stop