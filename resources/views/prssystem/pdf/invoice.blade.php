@extends('layouts.print')
@section('content')
<table class="table table-sm" style="font-size: 11px; width: 700px; margin-left: 15px; border: solid 1px #CCC">
    <tr><td>
            <br/>
            <center><p style="text-decoration: underline; font-size: 24px; font-family: cursive;font-weight: bold;">INVOICE</p></center>
            <br/>
                <table class="table  table-sm" style="font-size: 11px;">
                    <tr><td>
                    <table class="table table-bordered table-sm" style="font-size: 11px;">
                    <tbody>
                      <tr>
                        <td><strong>Shipping Address</strong></td>
                      </tr>
                      <tr>
                        <td >
                        <p> {{$ShippingAddress['full_name']}},<br> 
                            {{$ShippingAddress['address_1']}}, {{$ShippingAddress['address_2']}}<br>
                            {{$ShippingAddress['landmarks']}},<br> 
                        Mobile: {{$ShippingAddress['mobile']}}</p>
                    </td>
                        
                      </tr>
                    </tbody>
                    </table>
                    
                    
                </td><td>
                    <table class="table table-bordered table-sm" style="font-size: 11px;">
                    <tbody>
                      <tr>
                        <td><strong>Shipping Address</strong></td>
                      </tr>
                      <tr>
                        <td >
                        <p> Innovative Retail Concepts Pvt Ltd 180,<br> First Floor, Saluja Arcade, <br>Thokkata VillageTarbund, SecunderabadHyderabad-500009<br>Tel.: +91 40 3355 1000TIN : 28133892879</p>
                    </td>
                        
                      </tr>
                    </tbody>
                    </table>
                </td></tr></table>
                <table class="table  table-sm" style="font-size: 11px;">
                    <tr>
                        <td style="width: 50%">
                    <table class="table table-bordered table-sm" style="font-size: 11px;">
                    <tbody>
                      <tr>
                        <td style="width: 30%">Invoice-No</td>
                        <td>{{$invoiceNo}}</td>
                      </tr>
                      <tr>
                        <td>Order-No</td>
                        <td>{{$orderId}}</td>
                      </tr>
                      <tr>
                        <td>Order Date</td>
                        <td>{{$orderDate}}</td>
                      </tr>
                      
                    </tbody>
                  </table>
                </td><td>
                    <table class="table table-bordered table-sm" style="font-size: 11px;">
                    <tbody>
                      <tr>
                        <td style="width: 30%">No Of Items</td>
                        <td>{{$quantity}}</td>
                      </tr>
                      <tr>
                        <td>Payment Mode</td>
                        <td>{{$invoiceDetails['payment_status']}}</td>
                      </tr>
                      <tr>
                        <td>Total</td>
                        <td>{{$total}}</td>
                      </tr>
                      
                    </tbody>
                  </table>
                </td></tr></table>
            <hr style="margin: 1px; padding: 1px; ">
                    <table class="table  table-sm" style="font-size: 11px;">
                    <tbody>
                      <tr>
                        <td style="width:5%">SNo.</td>
                        <td align="center">Item</td>
                        <td align="center">Unit</td>
                        <td align="center">Cost</td>
                        <td align="center">Quantity</td>
                        <td align="right">Price</td>
                      </tr>
                      <?php $count=1; ?>
                      @foreach($OrderDetail as $obj)
                      <tr>
                        <td>{{$count++}}</td>
                        <td align="left">{{ucwords($obj['product_name'])}}</td>
                        <td align="center">100 Gram</td>
                        <td align="center">{{$obj['unit_price']}}</td>
                        <td align="center">{{$obj['quantity']}}</td>
                        <td align="right">{{$obj['total_amount']}}</td>
                      </tr>
                      <?php $total_amount[] = $obj['total_amount']?>
                      @endforeach
                      <tr>
                        <td colspan="4"></td>
                        <td align="right" >Delivery Charges</td>
                        <td align="right">00.00</td>
                      </tr>
                      <tr>
                        <td colspan="4"></td>
                        <td align="right" >Total</td>
                        <td align="right">{{array_sum($total_amount),2}}</td>
                      </tr>
                      <tr>
                        <td colspan="6"><b>Amount in words:</b>&nbsp;&nbsp;{{$amtinwords}}</td>
                        
                      </tr>

                    </tbody>
                  </table>
    
</td></tr></table>
@endsection