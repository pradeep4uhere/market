<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Master;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Seller;
use Session;
use App\Product;
use App\UserProduct;
use App\ProductImage;


class ProductImageController extends Master
{
    //
    public function __construct() {
       $this->middleware('auth')->except(['index']);
    }
    
    public function deleteProductImage(Request $request,$id){
        $product = \App\ProductImage::findOrFail($id);
        $product->delete();
        Session::flash('flash_message', 'Product Image successfully deleted!');
        return redirect()->back();
    }
    
     public function setProductImageAsDefault(Request $request,$prod_id,$id){
        $product = \App\ProductImage::where('user_product_id','=',$prod_id)->update(['is_default'=>0]);
        $product = \App\ProductImage::where('id','=',$id)->update(['is_default'=>1]);
        Session::flash('flash_message', 'Product Image successfully updated!');
        return redirect()->back();
    }
    
    
    
    public function hideProductImage(Request $request,$id){
        $product = \App\ProductImage::where('id','=',$id)->update(['status'=>0]);
        Session::flash('flash_message', 'Product Image successfully updated!');
        return redirect()->back();
    }
    
    public function showProductImage(Request $request,$id){
        $product = \App\ProductImage::where('id','=',$id)->update(['status'=>1]);
        Session::flash('flash_message', 'Product Image successfully updated!');
        return redirect()->back();
    }
}
