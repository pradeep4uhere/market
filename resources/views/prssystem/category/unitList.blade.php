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
						<div class="panel panel-default">
						<div class="panel-heading">
							<h5 class="blank1"><b>@lang('All Measurement  Units')</b></h5>
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
						<form method="post" action="{{ route('saveunit') }}" class="form-horizontal">
						{{csrf_field()}}
						</br/>
						<div class="form-group">
							<label for="inputPassword" class="col-sm-3 control-label">@lang('Store Type')</label>
							<div class="col-sm-8">
								<select class="form-control1" data-live-search="true" id="store_type" name="store_type" disabled="disabled">
									<option data-tokens="">Choose Store Type</option>
									@if(!empty($storeTypeList))
									@foreach($storeTypeList as $storeTypeObj)
									<option value="{{$storeTypeObj->id}}" <?php if($store_type_id==$storeTypeObj->id){?> selected="selected" <?php }?>>{{$storeTypeObj->name}}</option>
									@endforeach
									@endif
								  </select>
							</div>
						</div>
						<div class="form-group">
                        <label for="disabledinput" class="col-sm-3 control-label">@lang('category.title')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="name" placeholder="Enter the Category Name" name="name">
                        </div>
                    </div>
					<div class="form-group">
                        <label for="disabledinput" class="col-sm-3 control-label">@lang('category.description')</label>
                        <div class="col-sm-8">
                            <input  type="text" class="form-control1" id="description" placeholder="Enter the Category Description" name="description">
                            
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
                        <input  type="hidden" class="form-control1" id="hiddenid" name="id">
                      </div>
                    </div>
                </form>
						</div>
						</div>
						
					</div>




					<div class="col-md-6">

					<!--panel-->
					<div class="panel panel-default">
					<div class="panel-heading">
					<h5 class="blank1"><b>@lang('All Measurement  Units')</b></h5>
					</div>
					<div class="panel-body">
					<div class="row">
						<div class="col-md-11" style="font-size:14px;">
							<table class="table table-striped">
						    <thead>
						      <tr>
						        <th>SN</th>
						        <th>Title</th>
						        <th>Code/Description</th>
						        <th>Status</th>
						        <th>Action</th>
						      </tr>
						    </thead>
						    <tbody>
						      <?php $count=1; foreach($masterUnit as $unit){ ?>	
						      <tr>
						        <td>{{$count}}</td>
						        <td>{{$unit['name']}}</td>
						        <td>{{$unit['code']}}</td>
						        <td><?php echo ($unit['status']==1)?"<font color='Green'><b>Active</b></font>":"<font color='Red'><b>Inactive</b></font>";?></td>
						        <td></td>
						      </tr>  
						       <?php $count++; } ?>    

						      <?php foreach($UnitList as $unit){ ?>	
						      <tr <?php if($unit['status']==0){ ?> class="danger" <?php }?>>
						        <td>{{$count}}</td>
						        <td>{{$unit['name']}}</td>
						        <td>{{$unit['code']}}</td>
						        <td><?php echo ($unit['status']==1)?"<font color='Green'><b>Active</b></font>":"<font color='Red'><b>Inactive</b></font>";?></td>
						        <td><a href="javascript:void(0)" id="unit_{{$unit['id']}}_{{$unit['name']}}_{{$unit['code']}}" class="edit">Edit</a></td>
						      </tr>  
						       <?php $count++; } ?>    
						    </tbody>
						  </table>
						  </div>
					</div>
						
					</div>
					</div>
					</div>

    </div>
</div>
</div>


<script type="text/javascript">
$(document).ready(function(){ 
 
$(".edit").on("click", function(){
	var idstr = $(this).attr('id');
	var idstrArr = idstr.split('_');
	$('#name').val(idstrArr[2]);
	$('#description').val(idstrArr[3]);
	$('#hiddenid').val(idstrArr[1]);

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
