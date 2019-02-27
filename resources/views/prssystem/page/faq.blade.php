@extends('prssystem/layouts/frontDetails')
@include('prssystem.partials.metatags',array('meta'=>$metaTags))
@section('content')
<style type="text/css">
  .accordion p{
    font-size: 14px;
  }.accordion button{
    font-size: 14px;
  }
</style>
<section style="margin-top: 30px;">
<div class="container">
  <div class="row">
      <div class="col-md-12 responsive-wrap">
      <div class="row detail-filter-wrap">
          <div class="col-md-4 featured-responsive">
              <div class="detail-filter-text">
                  <h3>FAQs-General questions</h3>
              </div>
          </div>
          </div>
          <div class="row detail-filter-wrap">
            <div class="col-md-12">
                <div class="panel panel-default">
                 <div class="panel-body">
                 <div class="accordion" id="accordionExample">
                  <?php $count = 1; ?>
                  @foreach($faqArr as $k=>$v)
                    <b>{{$k}}</b>
                    <hr style="margin-bottom:5px; margin-top: 1px;">
                    @foreach($v as $faq)
                    <div class="card" style="margin-bottom: 5px;">
                      <div class="card-header" id="heading{{$faq['id']}}" style="padding:1px; margin:0px;">
                        <h5 class="mb-0">
                          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$faq['id']}}" aria-expanded="true" aria-controls="collapse{{$faq['id']}}" aria-expanded="false" style="color: #333">
                            {{$faq['title']}}
                          </button>
                        </h5>
                      </div>

                      <div id="collapse{{$faq['id']}}"  class="collapse" aria-labelledby="heading{{$count}}" data-parent="#accordionExample">
                        <div class="card-body">
                          <p class="content">{!! $faq['descriptions'] !!}</p>
                        </div>
                      </div>
                    </div>
                  <?php $count++; ?>
                  @endforeach
                  <br/>
                  @endforeach
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
</section>
@stop
@section('footer_scripts')
@stop
