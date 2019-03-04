@extends('prssystem.layouts.list')
@section('title')
Home Page
@stop
@section('content')
<div id="page-wrapper" style="background-color: #FFF">
	
	<div class="graphs">
    	<table style="width: 100%">
		<tr>
			<td><b>All Contact Us List</b></td>
			<td style="text-align: right;font-weight: bold"></td>
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
	                    <th>Name</th>
	                    <th>Mobile</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
	                </thead>
                    <tbody>
                        @foreach($listArr as $faq)
                        <tr>
                         <td>{{$faq->id}}</td>   
                         <td width="20%">{!! $faq->first_name !!}&nbsp;{!! $faq->last_name !!}</td>   
                         <td>{!! $faq->phone !!}</td>   
                         <td>{{$faq->email}}</td>   
                         <td>{{$faq->message}}</td> 
                         <td><?php echo ($faq['status']==1)?"<font color='Green'><b>Active</b></font>":"<font color='Red'><b>InActive</b></font>";?></td>  
                         <td width="8%">{{$faq->created_at}}</td> 
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
