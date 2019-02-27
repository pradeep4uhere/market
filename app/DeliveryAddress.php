<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user_type', 
        'mobile',
        'email_address',
        'full_name',
        'address_1',
        'address_2',
        'pincode'
    ];
}
