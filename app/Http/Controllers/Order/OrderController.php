<?php
namespace App\Http\Controllers\Order;
date_default_timezone_set('Asia/Kolkata');
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Master;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Seller;
use Session;
use Cookie;
use App\Category;
use Image;
use App\Unit;
use App\Product;
use App\UserProduct;
use App\ProductImage;
use App\Cart;
use App\CartItem;
use App\DeliveryAddress;
use App\Order;
use App\OrderDetail;
use Darryldecode\Cart\CartCondition;
use App\Services\PayUService\Exception;
use App\Payment;
use App\Controllers\PusherController;
use Log;

class OrderController extends Master
{
    //
    public function orderpost(Request $request){
    	$paymentType = $request->get('_pt');
		$totalAmount = $request->get('_tm');
		$shippingId = $request->get('_sp');
		$userId = Auth::user()->id;
		$cartCollection = \Cart::session(Auth::user()->id);
		$cartCollections = \Cart::getContent();
		$cartItem = $cartCollections->toArray();
		$count=$cartCollections->count();
		$quantity=\Cart::getTotalQuantity();
		$subTotal=\Cart::session($userId)->getSubTotal();
		$total=\Cart::session($userId)->getTotal();
		

		//Insert Records Into Order Table
		$orderObj = new Order();
		$orderObj->sessionId =time().Session::get('_token');
		$orderObj->cookies_id =md5(Cookie::get('email'));
		$orderObj->user_id =Auth::user()->id;
		$orderObj->shipping_id =decrypt($shippingId);
		$orderObj->totalAmount =$total;
		$orderObj->payment_status ='Pending';
		$orderObj->order_status ='Processing';
		$orderObj->ip_address =$_SERVER['REMOTE_ADDR'];
		$orderObj->created_at =date('Y-m-d H:i:s');
		try{
			//dd($cartItem);
			if($orderObj->save()){
				//Create Each Order For Item
				$lastOrderId = $orderObj->id;
				$item=0;
				$seller_id = '';
				$productInfo = array();
				foreach ($cartItem as $key => $value) {
					$odObj =array();
					$odObj = new OrderDetail();
					$odObj->order_track=$this->getOrderId($lastOrderId);
					$odObj->order_id=$lastOrderId;
					$odObj->seller_id=$value['attributes']['seller_id'];
					$odObj->seller_name=$value['attributes']['seller'];
					$odObj->brand_name=$value['attributes']['brandName'];
					$odObj->order_date=date('Y-m-d H:i:s');
					$odObj->product_name=$value['name'];
					$odObj->user_product_id=$value['attributes']['product_id'];
					$odObj->default_images=$value['attributes']['default_images'];
					$odObj->default_thumbnail=$value['attributes']['default_thumbnail'];
					$odObj->quantity=$value['quantity'];
					$odObj->unit_price=$value['price'];
					$odObj->shipping_amount='0.00';
					$odObj->gst_amount='0.00';

					$totalPayAmt = $this->getTotalAmountOfItem($value);
					$odObj->total_amount=$totalPayAmt;
					$productInfo[]=$value['attributes']['product_id'];

					//Update Seller Id For this Order
					$sellerId = $value['attributes']['seller_id'];
					try{
						$odObj->save();
						$this->saveOrderIdOfItem($lastOrderId,$odObj->id);
						$odObj ="";
						$item++;
					}catch (\Exception $e) {
						dd($e->getMessage());
						//abort(404);
					}
				}
				if($item==$count){
					//Update Order Id of the Table
					$orderNewObj = Order::find($lastOrderId);
					$lastOrderIdStr = $this->getOrderId($lastOrderId);
					$orderNewObj->orderId = $lastOrderIdStr;
					$orderNewObj->seller_id = $sellerId;
					if($orderNewObj->save()){
							session(['order_id' => $lastOrderId]);
							// \Cart::clear();
							// \Cart::session($userId)->clear();
							//\Cart::where('id','=',$cart_id)->delete();
							//session(['countItem' => 0]);

							//Set All the Prameter For Payment Gatway
							$merchentKey = env('PAYYOU_MERCHENT_KEY');
							$merchentSalt = env('PAYYOU_MERCHENT_SALT');
							$transxId = $lastOrderIdStr;
							$productInfo = implode(',', $productInfo);
							$customerName = Auth::user()->first_name;
							$customerEmail = Auth::user()->email;

							//Get Shipping Address Details
							$shippingId = decrypt($shippingId);
							$deliveryAddress = DeliveryAddress::find($shippingId);
							if(!empty($deliveryAddress)){
								$mobile = $deliveryAddress->mobile;
							}else{
								$mobile = Auth::user()->mobile;
							}
							$udf5 = '';
							$hash = '';
							$hash_string = $merchentKey.'|'.$transxId.'|'.$total.'|'.$productInfo.'|'.$customerName.'|'.$customerEmail.'|||||'.$udf5.'||||||'.$merchentSalt;
							$hash = strtolower(hash('sha512', $hash_string));
							$successUrl = route('success', ['token'=>Session::get('_token'),'id'=>encrypt($transxId)]);
							$failedUrl = route('failed', ['token'=>Session::get('_token'),'id'=>encrypt($transxId)]);
							$PAYU_BASE_URL = env('PAYU_BASE_URL');
							//return redirect()->route('thanks', ['token'=>Session::get('_token'),'id'=>encrypt($lastOrderId)]);
					}
				}

			}

		}catch (\Exception $e) {
			dd($e->getMessage());
			//abort(404);
		}
		
		
		return view(Master::loadFrontTheme('frontend.payment.order_creating'),
		array(
			'count'=>$count,
			'quantity'=>$quantity,
			'subTotal'=>$subTotal,
			'total'=>$total,
			'cartItem'=>$cartItem,
			'merchentKey'=>$merchentKey,
			'merchentSalt'=>$merchentSalt,
			'transxId'=>$transxId,
			'productInfo'=>$productInfo,
			'customerName'=>$customerName,
			'customerEmail'=>$customerEmail,
			'mobile'=>$mobile,
			'hash'=>$hash,
			'successUrl'=>$successUrl,
			'failedUrl'=>$failedUrl,
			'PAYU_BASE_URL'=>$PAYU_BASE_URL

		)); 
    }


    /*
     *@Author : Pradeep Kumar
     *@Description: Get Order ID
     */
    private function saveOrderIdOfItem($orderId,$itemId){
    	$itemObj = OrderDetail::find($itemId);
    	$itemObj->order_track = $this->getOrderId($orderId).'-'.$itemId;
    	$itemObj->save();
    }


    /*
     *@Author : Pradeep Kumar
     *@Description: Get Order ID
     */
    private function getOrderId($orderId){
    	return 'ODR'.date('Ymd').$orderId;
    }
 	

 	/*
     *@Author : Pradeep Kumar
     *@Description: Get getTotalAmountOfItem 
     */
    private function getTotalAmountOfItem($value){
    	$totalAmount = 0;
    	$totalAmount = $value['price'] * $value['quantity'];
    	return  $totalAmount;
    }




    /*
     *@Author : Pradeep Kumar
     *@Description: Get getTotalAmountOfItem 
     */
    public function thankyou($token,$id){
    	$ordeId = session('order_id');
    	//DD($ordeId);
    	$ids = decrypt($id);
    	if($ordeId==$ids){
    		$count='';
    		$quantity='';
    		$subTotal='';
    		$total='';
    		$cartItem='';
    		$orderArr=Order::with('OrderDetail')->find($ordeId);
    		if(count($orderArr['OrderDetail'])==0){
    			session(['order_id' => '']);
    			return redirect()->route('home', ['token'=>Session::get('_token')]);

    		}
    		$orderDate = date('d M Y',strtotime($orderArr['created_at']));
    		$totalAmount = $orderArr['totalAmount'];
    		$shipping_id = $orderArr['shipping_id'];
    		//Delevry Addredd
			if($shipping_id!=''){
				$address = DeliveryAddress::where('id','=',$shipping_id)->where('user_id','=',Auth::user()->id)->first();
			}
			//DD($address);
    		return view(Master::loadFrontTheme('frontend.payment.thankyou'),
				array(
					'count'=>$count,
					'quantity'=>$quantity,
					'subTotal'=>$subTotal,
					'total'=>$total,
					'cartItem'=>$cartItem,
					'orderID'=>$this->getOrderId($ordeId),
					'orderDetails'=>$orderArr,
					'orderDate'=>$orderDate,
					'totalAmount'=>$totalAmount,
					'address'=>$address
				)); 
    	}else{
    		abort(404);
    	}
    }





    /*
     *@Author      : Pradeep Kumar
     *@Description : Failed Url
     */
    public function paymentFailed(Request $request){
    	dd($request->all());
    	die("Payment Failed");

    }
    


      /*
     *@Author: Pradeep Kumar
     *@Description: Update Payment Details Via PayU Payment Gateway
     *@params Request
     */
    private function updatePaymentDetailsViaPayU($request){
    	$result = false;
    	$orderId = $request->get('txnid');
		//Save All the Details Of Payment Table
		$paymentArr = Payment::where('order_id','=',$orderId)->get();
		$lastId = 0;
		if(count($paymentArr)==0){

			$payment = new Payment();
			$payment->order_id = $orderId;
			$payment->merchent_id = $request->get('mihpayid');
			$payment->mode = $request->get('mode');
			$payment->status = $request->get('status');
			$payment->unmappedstatus = $request->get('unmappedstatus');
			$payment->txnid = $request->get('txnid');
			$payment->amount = $request->get('amount');
			$payment->payment_date = $request->get('addedon');
			$payment->firstname = $request->get('firstname');
			$payment->email = $request->get('email');
			$payment->phone = $request->get('phone');
			$payment->bank_ref_num = $request->get('bank_ref_num');
			$payment->bankcode = $request->get('bankcode');
			$payment->error = $request->get('error');
			$payment->error_Message = $request->get('error_Message');
			$payment->payuMoneyId = $request->get('payuMoneyId');
			$payment->payment_details = json_encode($request->all());
			$payment->net_amount_debit = $request->get('net_amount_debit');
			$payment->created_at = $this->getCreatedDate();
			//Payment Via Debit Card
			if($request->get('mode')=='CC'){
				
				$payment->name_on_card = $request->get('name_on_card');
				$payment->cardnum = $request->get('cardnum');

			}else if($request->get('mode')=='UPI'){

				$payment->upi_id = $request->get('field1');
				$payment->upi_ref = $request->get('field2');
				$payment->paymentId = $request->get('paymentId');

			}else{

				$payment->name_on_card = $request->get('name_on_card');
				$payment->cardnum = $request->get('cardnum');
			}

			$payment->save();
			$result = true;
			$lastId= $payment->id;

		}
		return $lastId;

    }





    /*
     *@Author      : Pradeep Kumar
     *@Description : Success Url
     */
    public function paymentSuccess(Request $request){
    	if ($request->isMethod('post')) {
    		Log::info(json_encode($request->all()));
    		//dd($request->all());
    		$orderId = $request->get('txnid');
    		if(!empty($orderId)){

    			$orderDeails = Order::where('orderID','=',$orderId)->get();

    			//Update the Order Table Status
    			if($request->get('status')=='success'){
    				$res = Order::where('orderID','=',$orderId)->update(['payment_status' => 'Success','order_status'=>'Confirm']);
    				if($res==1){
    					//Update Payment Details VIA PayU Payment Gateway
    					$lastPaymentId = $this->updatePaymentDetailsViaPayU($request);
    					//Send Order Confirmation To User By Payment Id

    					//Send Order Confirmation To User
    					$this->sendWhatsappMessage('paymentConfirmation',$lastPaymentId);
    					
    					//Send Order Confirmation To User
    					$this->sendWhatsappMessage('orderConfirmation',$lastPaymentId);

    					//Send Order Confirmation To Seller
    					$this->sendWhatsappMessage('orderRecivedSeller',$lastPaymentId);

    					if($lastPaymentId){
   							return redirect()->route('thanks', ['token'=>Session::get('_token'),'id'=>encrypt($orderDeails[0]['id'])]);
   						}else{
   							return redirect()->route('failed', ['token'=>Session::get('_token'),'id'=>encrypt($orderDeails[0]['id'])]);
   						}
    				}
    			}
    		}
    	}else{
    		$ordeId = session('order_id');
	    	//DD($ordeId);
	    	$ids = decrypt($id);
	    	if($ordeId==$ids){
	    		$count='';
	    		$quantity='';
	    		$subTotal='';
	    		$total='';
	    		$cartItem='';
	    		$orderArr=Order::with('OrderDetail')->find($ordeId);
	    		if(count($orderArr['OrderDetail'])==0){
	    			session(['order_id' => '']);
	    			return redirect()->route('home', ['token'=>Session::get('_token')]);

	    		}
	    		$orderDate = date('d M Y',strtotime($orderArr['created_at']));
	    		$totalAmount = $orderArr['totalAmount'];
	    		$shipping_id = $orderArr['shipping_id'];
	    		//Delevry Addredd
				if($shipping_id!=''){
					$address = DeliveryAddress::where('id','=',$shipping_id)->where('user_id','=',Auth::user()->id)->first();
				}
				//DD($address);
	    		return view(Master::loadFrontTheme('frontend.payment.thankyou'),
					array(
						'count'=>$count,
						'quantity'=>$quantity,
						'subTotal'=>$subTotal,
						'total'=>$total,
						'cartItem'=>$cartItem,
						'orderID'=>$this->getOrderId($ordeId),
						'orderDetails'=>$orderArr,
						'orderDate'=>$orderDate,
						'totalAmount'=>$totalAmount,
						'address'=>$address
					)); 
	    	}else{
	    		abort(404);
	    	}


    	}
    }
}
