<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Master;
use Illuminate\Support\Facades\Redirect;
use App\Seller;
use App\Category;
use App\Unit;
use App\Product;
use App\UserProduct;
use App\ProductImage;
use App\User;
use Storage;

class CartController extends Master
{

    protected $userId;
    protected $userType;
    protected $sellerId;
    protected $categoryId;
    protected $productId;

    

    public function addToCart(Request $request){
         if(self::isValidToekn($request)){
            $validator = Validator::make($request->all(), [
                'user_type' => 'required|numeric',
                'seller_id' => 'required|numeric',
                'user_id' => 'required|numeric',
                'product_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $responseArray['status'] = false;
                $responseArray['message']= "Input are not valid";
                $responseArray['error']= $errors;
            }else{
                $this->userId = $request->get('user_id');
                $this->userType = $request->get('user_type');
                $this->sellerId = $request->get('seller_id');
                $this->categoryId = $request->get('category_id');
                $this->productId = $request->get('product_id');

                //Get Product Details
                $product = UserProduct::with('Product')->where('product_id','=',$this->productId)->where('seller_id','=',$this->sellerId)->where('status','=',1)->get();
                if($product->count()==0){
                    $responseArray['status'] = false;
                    $responseArray['message'] = "Invalid product id or seller id";
                }else{
                    //Check is this product has in Stock or Not
                    if($this->isProductInStock()){

                        $sellerDetails=Seller::where('id','=',$this->sellerId)->first();

                        $prodArray = $product->toArray();
                        $prodArr = $prodArray[0];
                        //print_r($product->toArray()); die;
                        $productName = $prodArr['product']['title'];
                        $price = $prodArr['price'];
                        $qty = 1;

                        $imgUrlDefaultImages = config('global.PRODUCT_IMG_URL').DIRECTORY_SEPARATOR.$prodArr['default_images'];
                        $imgUrlDefaultThumbnail = config('global.PRODUCT_IMG_URL').DIRECTORY_SEPARATOR.$prodArr['default_thumbnail'];
                        $productDetails = array(
                            'seller_id'=>$sellerDetails['id'],
                            'seller'=>$sellerDetails['business_name'],
                            'brandName'=>$prodArr['product']['brand']['name'],
                            'product_id'=>$prodArr['product_id'],
                            'default_images'=>$imgUrlDefaultImages,
                            'default_thumbnail'=>$imgUrlDefaultThumbnail,
                            'product_in_stock'=>$prodArr['product_in_stock'],
                            'price'=>$prodArr['price'],
                            'status'=>$prodArr['status'],
                        );
                        $item = \Cart::session($this->userId)->add($this->productId, $productName , $price, $qty, $productDetails);
                        // then you can:
                        $cartCollection = \Cart::getContent();
                        $cartData = array(
                            'item'=>$cartCollection,
                            'count'=>$cartCollection->count(),
                            'quantity'=>\Cart::getTotalQuantity(),
                            'subTotal'=>\Cart::session($this->userId)->getSubTotal(),
                            'total'=>\Cart::session($this->userId)->getTotal()
                        );

                        $responseArray['status'] = true;
                        $responseArray['message'] = title_case($productName).' added into your cart!';
                        $responseArray['result']['cart'] = $cartData;
                        $responseArray['result']['user_id'] = $this->userId;
                        $responseArray['result']['seller_id'] = $this->sellerId;

                    }else{
                        $responseArray['status'] = false;
                        $responseArray['message'] = "Product out of stock.";
                    }
                }
            }
         }else{
            $responseArray['status'] = false;
            $responseArray['message'] = "Invalid Token";
        }
        return response()->json($responseArray);
    }    




    /*
     *@Author: Pradeep Kumar
     *@Description: To Get the Status of the Product in Stock or not
     *@return True On In Stock
     *@return False On Out Of Stock
     */
    private function isProductInStock(){
        return true;
    }






    /**
     * @Author: Pradeep Kumar
     * @Description: Remove Cart Item From Table
     * removes an item on cart by item ID
     *
     * @param $id
     */

     public function removeCartItem(Request $request){
        if(self::isValidToekn($request)){


            $validator = Validator::make($request->all(), [
                'item_id' => 'required|numeric',
                'user_id' => 'required|numeric'
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $responseArray['status'] = false;
                $responseArray['message']= "Input are not valid";
                $responseArray['error']= $errors;
            }else{

                $itemId = $request->get('item_id');
                $userId = $request->get('user_id');
                 if($itemId>0){
                    // removing cart item for a specific user's cart
                    $itemDetails = \Cart::session($userId)->get($itemId);
                    \Cart::session($userId)->remove($itemId);
                    if(\Cart::session($userId)->isEmpty()){
                        \Cart::session($userId)->clear();
                    }
                    
                    $cartCollection = \Cart::getContent();
                    $cartData = array(
                        'item'=>$cartCollection,
                        'count'=>$cartCollection->count(),
                        'quantity'=>\Cart::getTotalQuantity(),
                        'subTotal'=>\Cart::session($userId)->getSubTotal(),
                        'total'=>\Cart::session($userId)->getTotal()
                    );
                    if(!empty($itemDetails)){
                        $responseArray['status'] = true;
                        $responseArray['message'] = ucwords($itemDetails->name).' removed from cart successfully!';
                        $responseArray['result']['cart'] = $cartData;
                        $responseArray['result']['user_id'] = $userId;
                    }else{
                        $responseArray['status'] = false;
                        $responseArray['message'] = 'Invalid item';
                    }
                 }else{
                    $responseArray['status'] = false;
                    $responseArray['message'] = 'Somthing went wrong.';
                 }

            }

         }else{
            $responseArray['status'] = false;
            $responseArray['message'] = "Invalid Token";
        }

        return response()->json($responseArray);
     }










      /**
       * @Author: Pradeep Kumar
       * @Description: Remove Cart Item From Table
       * removes an item on cart by item ID
       *
       * @param $id
       */
      public function updateCart(Request $request){
        if(self::isValidToekn($request)){

            $validator = Validator::make($request->all(), [
                'item_id'   => 'required|numeric',
                'user_id'   => 'required|numeric',
                'qnty'      => 'required|numeric'
            ]);


           if ($validator->fails()) {
                $errors = $validator->errors();
                $responseArray['status'] = false;
                $responseArray['message']= "Input are not valid";
                $responseArray['error']= $errors;
            }else{

                $userId = $request->get('user_id');
                $rowId=$request->get('item_id');
                $qnty=$request->get('qnty');
                $updateArr =array(
                    'quantity' => array(
                                    'relative' => false,
                                    'value' => $qnty
                                    ),
                );
                $upAct = \Cart::session($userId)->update($rowId,$updateArr);
                if($upAct){
                    $cartCollection = \Cart::getContent();
                    $cartData = array(
                        'item'=>$cartCollection,
                        'count'=>$cartCollection->count(),
                        'quantity'=>\Cart::getTotalQuantity(),
                        'subTotal'=>\Cart::session($userId)->getSubTotal(),
                        'total'=>\Cart::session($userId)->getTotal()
                    );

                    $responseArray['status'] = true;
                    $responseArray['message'] = "Cart Updated";
                    $responseArray['result'] = $cartData;


                }else{
                    $responseArray['status'] = false;
                    $responseArray['message'] = "Cart Not Updated";
                }
            }
        }else{
            $responseArray['status'] = false;
            $responseArray['message'] = "Invalid Token";
        }

        return response()->json($responseArray);
        
    }



     /**
       * @Author: Pradeep Kumar
       * @Description: Get all the cart item List
       * @param $user_id
       */
    public function getcartlist(Request $request){
        if(self::isValidToekn($request)){
            $validator = Validator::make($request->all(), [
                'user_id'   => 'required|numeric',
            ]);
           if ($validator->fails()) {
                $errors = $validator->errors();
                $responseArray['status'] = false;
                $responseArray['message']= "Input are not valid";
                $responseArray['error']= $errors;
            }else{
                $userId = $request->get('user_id');
                $cartCollection = \Cart::session($userId);
                $cartCollections = \Cart::getContent();
                $cartItem = $cartCollections->toArray();

                $cartData = array(
                    'item'=>$cartItem,
                    'quantity'=>\Cart::getTotalQuantity(),
                    'subTotal'=>\Cart::session($userId)->getSubTotal(),
                    'total'=>\Cart::session($userId)->getTotal()
                );
                $responseArray['status'] = true;
                $responseArray['result'] = $cartData;
            }
        }else{
            $responseArray['status'] = false;
            $responseArray['message'] = "Invalid Token";
        }

        return response()->json($responseArray);

    }

}
