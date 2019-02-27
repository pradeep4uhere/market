<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    //
    protected $table ='faqs';

    public function Child() {
         return $this->hasMany(Faq::class,'parnet_id','id');
    }
    
}
