<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Brand extends Model
{
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'brands';
    
    public function product() {
        return $this->hasMany(Product::class);
    }


    /**
     * @Author: Pradeep Kumar
     * @Description: To Get the all Subcategory List
     */
    public function getBrandList($category_id){
        $subCateArr=array('9999'=>'Not Available');
        if($category_id>0){
            $subCatObj = Brand::where('category_id','=',$category_id)
                    ->where('status','=','1')
                    ->get();
            foreach ($subCatObj as $obj) {
                $subCateArr[$obj->id]=$obj->name;
            }
            return $subCateArr;
        }else{
            return $subCateArr;
        }
    }


    public function AllBrandList(){
        $subCateArr=array();
        $subCatObj = Brand::where('status','=','1')->get();
        return $subCatObj;
        
    }
}
