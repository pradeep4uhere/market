@extends('prssystem.layouts.page')
@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>My Orders </b></div>
                    <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>Order Date</th>
                            <th>Order ID</th>
                            <th>Total Item</th>
                            <th>Total Amount</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            @foreach($orderItem as $order)
                            <tr>
                            <th>{{$order['orderDate']}}</th>
                            <th>{{$order['orderID']}}</th>
                            <th>{{count($order['orderItem'])}}</th>
                            <th>{{$order['totalAmount']}}</th>
                            <th>{{$order['paymentStatus']}}</th>
                            <th>{{$order['orderStatus']}}</th>
                            <th align="center"><?php if($order['orderStatus']!='Confirm'){ ?>
                                    <a href="#">Invoice</a>&nbsp;|&nbsp;<a href="#">Cancle</a>
                                <?php }else{ ?>
                                <a href="#">Invoice</a>
                                <?php } ?>
                            </th>
                            </tr>
                            @endforeach
                        </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
