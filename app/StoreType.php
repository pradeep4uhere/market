<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreType extends Model
{
    protected $table = 'store_types';
	
	
	public function Seller() {
        return $this->belongsTo('App\Seller', 'store_type_id', 'id' );
    }
	
}
