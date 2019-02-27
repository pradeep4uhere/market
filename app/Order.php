<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';
	/**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    public function OrderDetail() {
        return $this->hasMany(OrderDetail::class);
    }
	
	public function User() {
         return $this->belongsTo('App\User', 'user_id', 'id' );
    }
	
	public function Seller() {
         return $this->belongsTo('App\Seller', 'seller_id', 'id' );
    }


  
}
