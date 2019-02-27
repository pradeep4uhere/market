<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    
    //
    protected $fillable = ['title', 'description', 'category_id', 'sub_category_id','brand_id','unit_id','created_by'];
    
    
    public function Category() {
         return $this->belongsTo(Category::class);
    }
    
    
    public function SubCategory() {
        //Third Argumanet is from Category Table
        //Second Argument From Product Table [Relationship Table]
         return $this->belongsTo('App\Category', 'sub_category_id', 'id');
    }
    
    public function Brand() {
         return $this->belongsTo(Brand::class);
    }
    
    public function Unit() {
         return $this->belongsTo(Unit::class);
    }

    public function UserProduct(){
        return $this->hasMany(UserProduct::class);   
    }
    
   
    
    
}
