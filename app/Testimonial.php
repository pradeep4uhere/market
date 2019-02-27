<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Testimonial extends Model
{
    //
    protected $table ='testimonials';

    public function User() {
         return $this->belongsTo(User::class);
    }
    
}
