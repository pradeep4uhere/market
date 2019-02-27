@extends('prssystem.layouts.list')
@section('title')
Home Page
@stop
@section('content')
<div id="page-wrapper" style="background-color: #FFF">
	
	<div class="graphs">
    	<table style="width: 100%">
		<tr>
			<td><b>@lang('order.order.list')</b></td>
			<td style="text-align: right; font-size: 12px;">
            <form action="" method="get">
            <label>Order ID:</label>
            <label><input type="text" name="orderid" class="form-control" placeholder="Enter Order ID" value="{{$orderid}}"></label>&nbsp;&nbsp;
            <label>Mobile Number:</label>
            <label><input type="text" maxlength="10" min="
                10" name="mobile" class="form-control" value="{{$mobile}}" placeholder="Enter Mobile Number"></label>&nbsp;&nbsp;
            <label>Order Date:</label>
            <label><input type="text" name="date" value="{{$date}}" class="datepicker form-control" placeholder="Enter Order Date"></label>&nbsp;&nbsp;
            <label>Choose Order Types:</label>
            <label><select id="orderStatus" onchange="getOrderList(this.value)" class="form-control">
                <option value="All">All</option>
                <option value="Open" @if($type=='Open') selected=selected @endif>Open</option>
                <option value="Processing" @if($type=='Processing') selected=selected @endif>Processing</option>
                <option value="Complete" @if($type=='Complete') selected=selected @endif>Complete</option>
                <option value="Canceled" @if($type=='Canceled') selected=selected @endif>Canceled</option>
                <option value="return" @if($type=='return') selected=selected @endif>Return</option>
                <option value="OnHold" @if($type=='OnHold') selected=selected @endif>On Hold</option>
                <option value="Pending" @if($type=='Pending') selected=selected @endif>Pending</option>
                <option value="PaymentReview" @if($type=='PaymentReview') selected=selected @endif>Payment Review</option>
                <option value="PendingPayment" @if($type=='PendingPayment') selected=selected @endif>Pending Payment</option>
                <option value="SuspectedFraud" @if($type=='SuspectedFraud') selected=selected @endif>Suspected Fraud</option>
                <option value="Closed" @if($type=='Closed') selected=selected @endif>Closed</option>
            </select> 
            </label>
            <input type="submit" style="position: absolute; left: -9999px"/>
            </form>
			</td>
		</tr>
	</table>
    <hr/>
        
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
	                    <th>#SN</th>
	                    <th>OrderID</th>
	                    <th>Date</th>
	                    <th>Name</th>
	                    <th>Mobile</th>
                        <th>Address</th>
	                    <th>Amount</th>
	                    <th>Payment Status</th>
                        <th>Order Status</th>
	                </thead>
                    <tbody>
                        @if(!empty($orders))
                        <?php @$count=1 ?>
                        @foreach($orders as $Obj)
                        <tr @if($Obj->order_status=='Complete') style="background-color: lightgreen;" @endif>
                            <td>{{$count++}}</td>
                            <td><a href="{{route('orderdetails',['id'=>encrypt($Obj->id)])}}" target="_blank">{{$Obj->orderID}}</a></td>
                            <td>{{date("d, M h:i A",strtotime($Obj->created_at))}}</td>
                            <td>{{$Obj->name}}</td>
                            <td>{{$Obj->mobile}}</td>
                            <td>{{$Obj->address_1}}</br>{{$Obj->address_2}}</br>{{$Obj->landmarks}}</td>
                            <td><b>₹{{$Obj->totalAmount}}</b></td>
                            <td>
                                @if($Obj->payment_status=='Pending')
                                <font color="red"><b>{{$Obj->payment_status}}</b>
                                @elseif($Obj->payment_status=='Success')
                                <font color="green"><b>{{$Obj->payment_status}}</b>
                                </font>
                                @endif
                            </td>
                            <td>
                                <select  @if($Obj->order_status=='Complete') disabled @endif class="form-control" style="width:120px">
                                    <option value="Open" @if($Obj->order_status=='Open') selected=selected @endif>Open</option>
                                    <option value="Processing" @if($Obj->order_status=='Processing') selected=selected @endif>Processing</option>
                                    <option value="Complete" @if($Obj->order_status=='Complete') selected=selected @endif>Complete</option>
                                    <option value="Canceled" @if($Obj->order_status=='Canceled') selected=selected @endif>Canceled</option>
                                    <option value="return" @if($Obj->order_status=='return') selected=selected @endif>Return</option>
                                    <option value="OnHold" @if($Obj->order_status=='OnHold') selected=selected @endif>On Hold</option>
                                    <option value="Pending" @if($Obj->order_status=='Pending') selected=selected @endif>Pending</option>
                                    <option value="PaymentReview" @if($Obj->order_status=='PaymentReview') selected=selected @endif>Payment Review</option>
                                    <option value="PendingPayment" @if($Obj->order_status=='PendingPayment') selected=selected @endif>Pending Payment</option>
                                    <option value="SuspectedFraud" @if($Obj->order_status=='SuspectedFraud') selected=selected @endif>Suspected Fraud</option>
                                    <option value="Closed" @if($Obj->order_status=='Closed') selected=selected @endif>Closed</option>
                                </select>
                           
                            </td>
                        </tr>
                        @endforeach
                        @else
                        </tr>
                        <td colspan="9">
                           <div class="alert alert-danger"><center>No Order Found</center></div>
                        </td>
                        </tr>

                        @endif
                    </tbody>
                </table>
                <div class="clearfix"></div>
                <ul class="pagination pull-right">
                    <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function getOrderList(type){
        var strUrl = window.location.href.split("?");
        window.location.href = strUrl[0] +'?type='+ type ;
    }
</script>
@stop
@section('footer_scripts')
@stop
