<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-heading">
	<h5 class="blank1">All Store Type</h5>
</div>
<div class="row">
<div class="col-md-12">
@if(Session::has('message1'))
<p class="alert alert-success" style="padding:10px; margin:5px; font-size:12px;">{{ Session::get('message1') }}</p>
@endif
@if(Session::has('error'))
<p class="alert alert-danger">
@foreach(Session::get('error') as $err)
{{ $err }}</br>
@endforeach
</p>
@endif
</div>
</div>
<div class="row">
<form method="post" action="{{ route('savestoretype') }}" class="form-horizontal">
{{csrf_field()}}
<br>
<div class="form-group">
	<label for="inputPassword" class="col-sm-3 control-label">@lang('Store Type')</label>
	<div class="col-sm-8">
		<select class="form-control1" data-live-search="true" id="store_type" name="store_type">
			<option data-tokens="">Choose Store Type</option>
			@if(!empty($storeType))
			@foreach($storeType as $storeTypeObj)
			<option value="{{$storeTypeObj->id}}">{{$storeTypeObj->name}}==(<?php if($storeTypeObj->status==1){ echo 'Active'; }else{ echo 'In-Active' ;} ?>)</option>
			@endforeach
			@endif
		  </select>
	</div>
</div>
<div class="form-group">
    <label for="inputPassword" class="col-sm-3 control-label">Status</label>
    <div class="col-sm-8">
        <select class="form-control1" data-live-search="true" id="status" name="status">
        <option value="1">Active</option>
        <option value="0">In-Active</option>
        </select>
    </div>
     <div class="col-sm-6">
         <p id="qntyId" style="margin-top: 5px;"></p>
    </div>
</div>
<div class="row">
<div class="col-md-4"></div>
<div class="form-group col-md-6">
<button type="submit" class="btn btn-success" style="margin-left:38px">Update</button>
<button type="button" class="btn btn-danger" style="margin-left:38px">Cancel</button>
</div>
</div>
</form>
</div>
</div>

</div>