<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellerImage extends Model
{
    //
	protected $table = 'seller_images';
	
	public function Seller() {
         return $this->belongsTo('App\SellerImage', 'seller_id', 'id' );
    }
	
}
