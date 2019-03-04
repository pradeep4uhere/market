@extends('prssystem.layouts.list')
@section('title')
Home Page
@stop
@section('content')
<style>
.treeview .list-group-item{cursor:pointer}.treeview span.indent{margin-left:10px;margin-right:10px}
.treeview span.icon{width:12px;margin-right:5px}.treeview .node-disabled{color:silver;cursor:not-allowed}
</style>
<script src="{{ Config('global.THEME_URL_JS') }}/profile/bootstrap-treeview.min.js"></script>
<div id="page-wrapper">
    <div class="graphs">
        
        <div class="tab-content">
					
					<div class="col-md-6">

					<!--panel-->
					<div class="panel panel-default">
					<div class="panel-heading">
					<h53class="blank1">@lang('brand.all_brand')</h3>
					</div>
					<div class="panel-body">
					

					<div class="row">
						<div class="col-md-8">
							<?php// dd($brandListArr);?>
							@foreach($brandListArr as $name=>$brandObj)
							<div><b>{{$name}}</b>
							@foreach($brandObj as $id=>$val)
							<div>-{{$val}}</div>
							@endforeach
							</div>
	  						<hr/>
							@endforeach
							
						</div>
					</div>
						
					</div>
					</div>
					</div>
					<div class="col-md-6">
						<div class="panel panel-default">
						<div class="panel-heading">
							<h5 class="blank1">@lang('brand.add_brand')</h5>
						</div>
						<div class="row">
						<div class="col-md-12">
						@if(Session::has('message'))
						<p class="alert alert-success" style="padding:10px; margin:5px; font-size:12px;">{{ Session::get('message') }}</p>
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
						<form method="post" action="{{ route('savebrand') }}"class="form-horizontal" enctype="multipart/form-data">
						{{csrf_field()}}
						</br/>
						<div class="form-group">
							<label for="inputPassword" class="col-sm-3 control-label">@lang('Store Type')</label>
							<div class="col-sm-8">
								<select class="form-control1" data-live-search="true" id="store_type" name="store_type">
									<option data-tokens="">Choose Store Type</option>
									@if(!empty($storeType))
									@foreach($storeType as $storeTypeObj)
									<option value="{{$storeTypeObj->id}}">{{$storeTypeObj->name}}</option>
									@endforeach
									@endif
								  </select>
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword" class="col-sm-3 control-label">@lang('product.choose_category')</label>
							<div class="col-sm-8">
								<select class="form-control1" data-live-search="true" id="parent_id" name="parent_id">
									<option data-tokens="">Choose Category</option>
									
								  </select>
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword" class="col-sm-3 control-label">@lang('Sub Category')</label>
							<div class="col-sm-8">
								<select class="form-control1" data-live-search="true" id="category_id" name="category_id">
									<option data-tokens="">Choose Sub Category</option>
									
								  </select>
							</div>
						</div>
						<div class="form-group">
                        <label for="disabledinput" class="col-sm-3 control-label">@lang('category.title')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="name" placeholder="Enter brand Name" name="name">
                        </div>
                    </div>
					<div class="form-group">
                        <label for="disabledinput" class="col-sm-3 control-label">@lang('category.description')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="description" placeholder="Enter Brand Description" name="description">
                            <input  type="hidden" class="form-control1" id="id" name="id">
                        </div>
                    </div>
					<div class="form-group">
                        <label for="inputPassword" class="col-sm-3 control-label">@lang('category.status')</label>
                        <div class="col-sm-8">
                            <select class="form-control1" data-live-search="true" id="status" name="status" >
                            <option value='1' >Active</option>
                            <option value='0' >In-Active</option>
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
    </div>
</div>
</div>


<script type="text/javascript">
$(document).ready(function(){ 
	$('#store_type').on('change',function(){
		var storeType = $(this).val();
		 $.ajax({
		   type: "GET", 
		   url: "{{route('getStoreCategory')}}?sty="+storeType,
		   dataType: "json",       
		   success: function(response)  
		   {
				$('#parent_id').html(response.dataSet)
		   }   
		 }); 
	});


	$('#parent_id').on('change',function(){
		var parent_id = $(this).val();
		var sty = $('#store_type').val();
		 $.ajax({
		   type: "GET", 
		   url: "{{route('getStoreSubCategory')}}?parent_id="+parent_id+"&sty="+sty,
		   dataType: "json",       
		   success: function(response)  
		   {
				$('#category_id').html(response.dataSet)
		   }   
		 }); 
	});

  
 function initTree(treeData) {
	$('#treeview_json').treeview(
	{data: treeData,
	onNodeSelected: function(event, data) {
		//$("#mi-modal").modal('show');
		// Your logic goes here
		var id = data.id;
		var parent_id = data.parent_id;
		if(parent_id>0){
			var name = data.name;
			var description = data.text;
			var status = data.status;
			$('#name').val(name);
			$('#parent_id').val(parent_id);
			$('#id').val(id);
			$('#description').val(description);
			$('#status').val(status);
			$("#mi-modal").modal('show');
		}
	}
  });
 }
 

 
 
$("#modal-btn-no").on("click", function(){
	$("#mi-modal").modal('hide');
});

$("#modal-btn-si").on("click", function(){
	var cat_id=$('#id').val();
	$.ajax({
		type: "POST",  
		url: "{{route('delcategory')}}",
		dataType: "json",
		data: {_token:'{{ csrf_token() }}',id:cat_id},      
		success: function(response){
			$("#mi-modal").modal('hide');
		}   
   });
});
});
</script>

<!-- set up the modal to start hidden and fade in and out -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Do you want to Remove ?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="modal-btn-si">Remove</button>
        <button type="button" class="btn btn-primary" id="modal-btn-no">Edit</button>
      </div>
    </div>
  </div>
</div>


@stop
@section('footer_scripts')
@stop
