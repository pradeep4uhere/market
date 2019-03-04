@extends('prssystem.layouts.list')
@section('title')
Home Page
@stop
@section('content')
<div id="page-wrapper" style="background-color: #FFF">
	
	<div class="graphs">
    	<table style="width: 100%">
		<tr>
			<td><b>@lang('product.all_product')</b></td>
			<td style="text-align: right;font-weight: bold">
				<a href="{{ route('addproduct')}}" style="font-size: 14px;"><i class="fa fa-plus"></i>&nbsp;Add New</a></td>
		</tr>
	</table>
        
        <div class="tab-content" style="font-size: 14px;">
            @if(Session::has('message'))
                    <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
                    @if(Session::has('error'))
                    <p class="alert alert-danger">
                    @foreach(Session::get('error') as $err)
                    {{ $err }}</br>
                    @endforeach
                    </p>
                    @endif
            <div class="table-responsive">
                <table id="mytable" class="table table-bordred table-striped">
                    <thead>
	                    <th><input type="checkbox" id="checkall" /></th>
	                    <th>ID</th>
	                    <th>Title</th>
	                    <th>Descriptions</th>
                        <th>Parnet Id</th>
	                    <th>Status</th>
	                    <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach($faqsArr as $faq)
                        <tr>
                         <td>{{$faq->id}}</td>   
                         <td width="20%">{!! $faq->title !!}</td>   
                         <td>{!! $faq->descriptions !!}</td>   
                         <td>{{$faq->parnet_id}}</td>   
                         <td>{{$faq->status}}</td> 
                         <td><?php echo ($faq['status']==1)?"<font color='Green'><b>Active</b></font>":"<font color='Red'><b>InActive</b></font>";?></td>  
                         <td width="5%">
                            <a href="{{ route('editProduct',['id'=>$faq['id']]) }}" style="font-size: 14px;" title="Edit FAQ">
                                <i class="lnr lnr-pencil"></i>
                            </a>&nbsp;&nbsp;
                            <a href="{{ route('deleteProduct',['id'=>$faq['id']]) }}" style="font-size: 17px;" title="Delete FAQ">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                        </tr>
                        @endforeach

                        
                    </tbody>
                </table>
                <div class="clearfix"></div>
                <ul class="pagination pull-right">
                    {{$links}}
                </ul>
            </div>
        </div>
    </div>
</div>

@stop
@section('footer_scripts')
@stop
