<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cart;
use App\UserProduct;

class CartItem extends Model
{
	/**
     * @Author: Pradeep Kumar
     * @Description: To Get the all cartItem List
     */
    public function Cart() {
         return $this->belongsTo(Cart::class);
    }
    
	/**
     * @Author: Pradeep Kumar
     * @Description: To Get the all cartItem List
     */
     public function UserProduct() {
         return $this->belongsTo('App\UserProduct', 'product_id', 'id')->with('Product');
    }
	
	public function Seller() {
         return $this->belongsTo('App\Seller', 'seller_id', 'id');
    }
}
