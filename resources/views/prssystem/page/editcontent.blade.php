@extends('prssystem.layouts.default')
@section('title')
Update Page Content
@stop
@section('content')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<div id="page-wrapper" style="background-color: #FFF">
    <div class="graphs">
         <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="{{ url('admin/page/aboutus')}}">About Us <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ url('admin/page/aboutus')}}">About Us</a></li>
                <li><a href="{{ url('admin/page/aboutus')}}">About Us</a></li>
                <li><a href="{{ url('admin/page/aboutus')}}">About Us</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="{{ url('admin/page/aboutus')}}">About Us</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
            <li><a href="{{ url('admin/page/termsandconditions')}}">Terms & Conditions</a></li>
            <li><a href="{{ url('admin/page/help')}}">Help</a></li>
            <li><a href="{{ url('admin/page/policy')}}">Policy</a></li>
            <li><a href="{{ url('admin/page/contactus')}}">Contact Us</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('allPageList')}}" style="font-size: 14px;"><i class="fa fa-plus"></i>&nbsp;All List</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
<hr/>
<!-- <script src="{{config('global.THEME_URL_JS').'/profile/tinymce.min.js'}}"></script> -->
<div class="container"> 
  <div class="row">

  <div class="col-md-12">
  <form action="{{route('updatePage',['id'=>$pageRow['slug']])}}" method="POST">
    {{csrf_field()}}
    
    <div class="form-group">
    <label><h4>Title</h4></label>
    <input type="text" name="title" class="form-control1" required="" value="{{$pageRow['title']}}">
    </div>
    
    <div class="form-group">
    <label><h4>Content</h4></label>
    @include('prssystem.partials.product.editor',array('name'=>'misc','fieldName'=>'misc','value'=>$pageRow['description']))
    </div>

    <div class="form-group">
    <label><h4>Staus</h4></label>
    <select name="status" class="form-control1" >
      <option valie="1">Active</option>
      <option valie="0">In-Active</option>
    </select>
    </div>
    <input type="submit" name="Save" value="Save" class="btn btn-success">&nbsp;
    <input type="button" name="cancel" value="Cancel" class="btn btn-danger">
  </form>
  </div>
  </div>
</div>
</div>
@stop
@section('footer_scripts')
@stop