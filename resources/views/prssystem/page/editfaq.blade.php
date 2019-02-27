@extends('prssystem.layouts.default')
@section('title')
Update Page Content
@stop
@section('content')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<div id="page-wrapper" style="background-color: #FFF">
<div class="graphs">
  <table style="width: 100%">
        <tr>
            <td><b>FAQ-Update</b></td>
            <td style="text-align: right;font-weight: bold">
                <a href="{{ route('allfaqs')}}" style="font-size: 14px;"><i class="fa fa-plus"></i>&nbsp;All List</a></td>
        </tr>
    </table>
    <hr/>
<!-- <script src="{{config('global.THEME_URL_JS').'/profile/tinymce.min.js'}}"></script> -->
<div class="container"> 
  <div class="row">

  <div class="col-md-12">
  <form action="{{route('updatePageFaq',['id'=>$pageRow['id']])}}" method="POST">
    {{csrf_field()}}
    <div class="form-group">
    <label><h4>Type</h4></label>
    <select name="type" class="form-control1" >
      <option value="User" <?php if($pageRow['type']=='User'){ echo "selected"; }?>>User</option>
      <option value="Seller" <?php if($pageRow['type']=='Seller'){ echo "selected"; }?>>Seller</option>
      <option value="Buyer" <?php if($pageRow['type']=='Buyer'){ echo "selected"; }?>>Buyer</option>
      <option value="Sales" <?php if($pageRow['type']=='Sales'){ echo "selected"; }?>>Sales</option>
      <option value="General" <?php if($pageRow['type']=='General'){ echo "selected"; }?>>General</option>
    </select>
    </div>

    <div class="form-group">
    <label><h4>Title</h4></label>
    <input type="text" name="title" class="form-control1" required="" value="{{$pageRow['title']}}">
    </div>
    
    <div class="form-group">
    <label><h4>Content</h4></label>
    @include('prssystem.partials.product.editor',array('name'=>'misc','fieldName'=>'misc','value'=>$pageRow['descriptions']))
    </div>

    <div class="form-group">
    <label><h4>Staus</h4></label>
    <select name="status" class="form-control1" >
      <option value="1" <?php if($pageRow['status']==1){ echo "selected"; }?>>Active</option>
      <option value="0" <?php if($pageRow['status']==0){ echo "selected"; }?>>In-Active</option>
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