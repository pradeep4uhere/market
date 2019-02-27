<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CartItem;

class Cart extends Model
{
    /**
     * @Author: Pradeep Kumar
     * @Description: To Get the all Cart List
     */
     public function CartItem() {
        return $this->hasMany(CartItem::class);
    }

}
