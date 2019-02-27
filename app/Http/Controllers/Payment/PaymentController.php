<?php

namespace App\Http\Controllers\Payment;
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


class PaymentController extends Master
{
    public $cartId;
	public $sessionId;
	
	function __construct(){
		//$this->sessionId=session()->getId();
	}
	
	//Get All the Items into Cart
	public function getCartItemList($sessionId,$cart_id){
		$cartItem=array();
        //Get All the Cart List
        $cartObj=Cart::where('session_id','=',$sessionId)->where('id','=',$cart_id)->with('CartItem')->first();
        if(!empty($cartObj)){
            foreach($cartObj->CartItem as $item){
                $cartItem[]= CartItem::with(['UserProduct','Seller'])->find($item['id']);
            }
        }
		session(['countItem' => count($cartItem)]);
		return $cartItem;
	}
	
	
	
	
	public function preorder(Request $request){
		if($request->get('pickup')!='' ||  $request->get('shippingAddress')!=''){
			$userId=Auth::user()->id;
			$pickup_id = $request->get('pickup');
			$shipping_id = $request->get('shippingAddress');
			$ip_address = $_SERVER['REMOTE_ADDR'];


			//Delevry Addredd
			$title ='Pickup';
			if($shipping_id!=''){
				$address = DeliveryAddress::where('id','=',decrypt($shipping_id))->where('user_id','=',Auth::user()->id)->first();
				$title = 'Shipping';
			}

			if($pickup_id!=''){
				$sellerIDArr = decrypt($request->get('sellerIDArr'));
				$address = DeliveryAddress::where('id','=',decrypt($pickup_id))->where('user_id','=',$sellerIDArr)->first();
				$title = 'Pickup';
			}

			$cartCollection = \Cart::session(Auth::user()->id);
			$cartCollections = \Cart::getContent();
			$cartItem = $cartCollections->toArray();
			$count=$cartCollections->count();
			$quantity=\Cart::getTotalQuantity();
			$subTotal=\Cart::session($userId)->getSubTotal();
			$total=\Cart::session($userId)->getTotal();

			$order = new Order();
			$order->created_at = date('Y-m-d H:i:s');
			//$order->save();
		}
		return view(Master::loadFrontTheme('frontend.payment.preorder'),
		array(
			'totalAmount'=>$total,
			'count'=>$count,
			'quantity'=>$quantity,
			'subTotal'=>$subTotal,
			'total'=>$total,
			'cartItem'=>$cartItem,
			'address'=>$address,
			'shipping_id'=>$shipping_id,
			'pickup_id'=>$pickup_id,
			'title'=>$title
		)); 
		
	}
	



	/*
	 *@Choose Payment Options
	 */
	public function choosepayment(Request $request){
		$shipping_id = $request->get('s');
		$totalAmount = $request->get('t');
		$userId = Auth::user()->id;
		$cartCollection = \Cart::session(Auth::user()->id);
		$cartCollections = \Cart::getContent();
		$cartItem = $cartCollections->toArray();
		$count=$cartCollections->count();
		$quantity=\Cart::getTotalQuantity();
		$subTotal=\Cart::session($userId)->getSubTotal();
		$total=\Cart::session($userId)->getTotal();
		return view(Master::loadFrontTheme('frontend.payment.payment_options'),
		array(
			'totalAmount'=>$totalAmount,
			'count'=>$count,
			'quantity'=>$quantity,
			'subTotal'=>$subTotal,
			'total'=>$total,
			'cartItem'=>$cartItem,
			'shipping_id'=>$shipping_id
		)); 

	}



	public function orderpost(Request $request){
		$paymentType = $request->get('_pt');
		$totalAmount = $request->get('_tm');

		$userId = Auth::user()->id;
		$cartCollection = \Cart::session(Auth::user()->id);
		$cartCollections = \Cart::getContent();
		$cartItem = $cartCollections->toArray();
		$count=$cartCollections->count();
		$quantity=\Cart::getTotalQuantity();
		$subTotal=\Cart::session($userId)->getSubTotal();
		$total=\Cart::session($userId)->getTotal();

		$orderObj = new Order();
		$orderObj->sessionId =session_id();
		$orderObj->cookies_id =Cookie::get('email');
		$orderObj->user_id =Auth::user()->id;

		return view(Master::loadFrontTheme('frontend.payment.order_creating'),
		array(
			'count'=>$count,
			'quantity'=>$quantity,
			'subTotal'=>$subTotal,
			'total'=>$total,
			'cartItem'=>$cartItem
		)); 

	}
}
