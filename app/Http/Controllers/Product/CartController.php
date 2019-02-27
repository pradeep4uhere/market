<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Master;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Encryption\DecryptException;
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
//use App\Cart;
//use App\CartItem;
use App\DeliveryAddress;
use Darryldecode\Cart\CartCondition;
use App\State;
class CartController extends Master
{
    public $cartId;
    public $productId;
	public $sessionId;
	
	 /**
	 * add item to the cart, it can be an array or multi dimensional array
	 *
	 * @param string|array $id
	 * @param string $name
	 * @param float $price
	 * @param int $quantity
	 * @param array $attributes
	 * @param CartCondition|array $conditions
	 * @return $this
	 * @throws InvalidItemException
	 */

    public function addToCart(Request $request){
		$req=$request->all();
		$pid = $request->get('pid');
	    $userProductId=decrypt($pid);
        if($userProductId>0){
        	$user_id=Auth::user()->id;
			$productDetails=UserProduct::with('Product')->find($userProductId);
		    $sellerDetails=Seller::where('user_id','=',$productDetails['user_id'])->first();
    	    //Add Item Into Cart
        	$userId = Auth::user()->id;
        	$price = $productDetails['selling_price'];
        	$product_id = $userProductId;
        	$qty = 1;
        	$name = str_replace("-",' ',request('name'));
        	//Get Product Details
        	$imgUrlDefaultImages = config('global.PRODUCTS_STORAGE_DIR').DIRECTORY_SEPARATOR.$productDetails['seller_id'].DIRECTORY_SEPARATOR.config('global.PRODUCT_IMG_WIDTH').'X'.config('global.PRODUCT_IMG_HEIGHT').DIRECTORY_SEPARATOR.$productDetails['default_images'];

            $imgUrlDefaultThumbnail = config('global.PRODUCTS_STORAGE_DIR').DIRECTORY_SEPARATOR.$productDetails['seller_id'].DIRECTORY_SEPARATOR.config('global.PRODUCT_THUMB_IMG_WIDTH').'X'.config('global.PRODUCT_THUMB_IMG_HEIGHT').DIRECTORY_SEPARATOR.$productDetails['default_thumbnail'];
        	$productDetails = array(
        		'seller_id'=>$sellerDetails['id'],
        		'seller'=>$sellerDetails['business_name'],
        		'brandName'=>$productDetails['Product']['Brand']['name'],
        		'product_id'=>$productDetails['product_id'],
        		'default_images'=>$imgUrlDefaultImages,
        		'default_thumbnail'=>$imgUrlDefaultThumbnail,
        		'product_in_stock'=>$productDetails['product_in_stock'],
        		'selling_price'=>$productDetails['selling_price'],
        		'status'=>$productDetails['status'],
        	);
         	$item = \Cart::session($userId)->add($product_id, $name, $price, $qty, $productDetails);
        	// then you can:
			$cartCollection = \Cart::getContent();
			session(['countItem' => $cartCollection->count()]);
			$cartData = array(
				'item'=>$cartCollection,
				'count'=>$cartCollection->count(),
				'quantity'=>\Cart::getTotalQuantity(),
				'subTotal'=>\Cart::session($userId)->getSubTotal(),
				'total'=>\Cart::session($userId)->getTotal()
			);


        	$res =array(
        		'status'=>'success',
        		'message'=>title_case($name).' added into your cart!',
        		'cart'=>$cartData
        	);
			return response()->json($res,201,[]);
		}else{
			$res =array('status'=>'error','message'=>'Product not added into cart!');
			return response()->json($res,201,[]);
		}
        
    }
    



	public function checkoutinit(Request $request){
		$stateArr = State::where('status','=',1)->get();
		$userId = Auth::user()->id;
		$cartCollection = \Cart::session(Auth::user()->id);
		$cartCollections = \Cart::getContent();
		$cartItem = $cartCollections->toArray();

		$address = DeliveryAddress::where('user_id','=',Auth::user()->id)->get();
		//Get Seller Name
		$sellerNameArr=[];
		$sellerIDArr=[];
		if(!empty($cartItem)){
			foreach($cartItem as $item){
				//Get All Seller Address
				$sellerAddress = DeliveryAddress::where('user_type','=','2')->where('user_id','=',$item['attributes']['seller_id'])->get();
				$sellerNameArr[$item['attributes']['seller']]=$sellerAddress;
				$sellerIDArr[$item['attributes']['seller_id']]=$item['attributes']['seller_id'];
			}
			$sellerName = array_keys($sellerNameArr);
		}else{
			$sellerName = "";
			$sellerIDArr="";
		}
		
		return view(Master::loadFrontTheme('frontend.cart.checkoutinit'),
		array(
			'cartItem'=>$cartItem,
			'address'=>$address,
			'seller'=>$sellerName,
			'sellerAddress'=>$sellerNameArr,
			'count'=>$cartCollections->count(),
			'quantity'=>\Cart::getTotalQuantity(),
			'subTotal'=>\Cart::session($userId)->getSubTotal(),
			'total'=>\Cart::session($userId)->getTotal(),
			'item'=>$cartItem,
			'sellerIDArr'=>encrypt(implode(',',$sellerIDArr)),
			'stateArr'=>$stateArr
		)); 
	}
	
	public function getCartItemList(){
		$cartItem=array();
        //Get All the Cart List
        $sessionId=session()->getId();
		$cartId=$this->cartId;
		if($cartId!=''){
			$cartObj=Cart::find($cartId)->with('CartItem')->first();
		}else{
			$cartObj=Cart::where('session_id','=',$sessionId)->with('CartItem')->first();
		}
        if(!empty($cartObj)){
            foreach($cartObj->CartItem as $item){
                $cartItem[]= CartItem::with(['UserProduct','Seller'])->find($item['id']);
            }
			session(['cart_id' => $cartObj->id]);
        }
		session(['countItem' => count($cartItem)]);
		return $cartItem;
	}
    
    /**
     * @Author: Pradeep Kumar
     * @Description: Pradeep Kumar
     */
    public function index(Request $request){
    	$userId = Auth::user()->id;
		$cartCollection = \Cart::session(Auth::user()->id);
		$cartCollections = \Cart::getContent();
		$itemList = $cartCollections->toArray();
        return view(Master::loadFrontTheme('frontend.cart.index'),array(
			'cartItem'=>$itemList,
			'count'=>$cartCollections->count(),
			'quantity'=>\Cart::getTotalQuantity(),
			'subTotal'=>\Cart::session($userId)->getSubTotal(),
			'total'=>\Cart::session($userId)->getTotal()
		));   
    }
    

    
    /**
     * @Author: Pradeep kumar
     * @Description: To Update the Cart Table
	 * update a cart
 	 *
 	 * @param $id (the item ID)
 	 * @param array $data
     *
	 * the $data will be an associative array, you don't need to pass all the data, only the key value
	 * of the item you want to update on it

		Cart::update(456, array(
		  'name' => 'New Item Name', // new item name
		  'price' => 98.67, // new item price, price can also be a string format like so: '98.67'
		));

		// you may also want to update a product's quantity
		Cart::update(456, array(
		  'quantity' => 2, // so if the current product has a quantity of 4, another 2 will be added so this will result to 6
		));

		// you may also want to update a product by reducing its quantity, you do this like so:
		Cart::update(456, array(
		  'quantity' => -1, // so if the current product has a quantity of 4, it will subtract 1 and will result to 3
		));

		// NOTE: as you can see by default, the quantity update is relative to its current value
		// if you want to just totally replace the quantity instead of incrementing or decrementing its current quantity value
		// you can pass an array in quantity value like so:
		Cart::update(456, array(
		  'quantity' => array(
		      'relative' => false,
		      'value' => 5
		  ),
		));

	**/
    public function updateCart(Request $request){
        if ($request->isMethod('post')) {
        	$userId = Auth::user()->id;
            $rowId=$request->get('item_id');
            $qnty=$request->get('qnty');
            $updateArr =array(
            	'quantity' => array(
								'relative' => false,
								'value' => $qnty
  									),
            );
            $upAct = \Cart::session($userId)->update(decrypt($rowId),$updateArr);
            if($upAct){

                Session::flash('message', 'Cart updated!');
            }else{
                Session::flash('message', 'Somthing went wrong!');
            }
            return redirect()->back();
        }
        
    }
	
	/**
	 * @Author: Pradeep Kumar
	 * @Description: Remove Cart Item From Table
	 * removes an item on cart by item ID
 	 *
 	 * @param $id
 	 */

	 public function removeCartItem(Request $request,$id){
		 if(decrypt($id)>0){
			// removing cart item for a specific user's cart
			$userId = Auth::user()->id; // or any string represents user identifier
			$itemDetails = \Cart::session($userId)->get(decrypt($id));
			\Cart::session($userId)->remove(decrypt($id));
			if(\Cart::session($userId)->isEmpty()){
				\Cart::session($userId)->clear();
			}
			$cartCollection = \Cart::getContent();
			session(['countItem' => $cartCollection->count()]);
			Session::flash('message', ucwords($itemDetails->name).' removed from cart successfully!');
			 
		 }else{
			 Session::flash('message', 'Cart not updated!');
		 }
		 return redirect()->back();
		 
	 }
}
