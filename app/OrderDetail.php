<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_details';
	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
	
	public function Product() {
         return $this->belongsTo('App\Product', 'product_id', 'id' );
    }
}
