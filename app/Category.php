<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    public function product() {
        return $this->hasMany(Product::class);
    }

	public function parent(){
		return $this->hasOne( 'App\Category', 'id', 'parent_id' );
	}

	public function nodes(){
		return $this->hasMany( 'App\Category', 'parent_id', 'id' )
        ->where('parent_id','>',0)
        ->select(['id', 'name','name as text','parent_id','id as href','status'])
        ->with('nodes');
	}
	
	
    public function getAllCategory($storeType=NULL){
        $cateArr=array();
        $catObj = Category::where('parent_id','=','0');
        if($storeType!=''){
            $catObj = $catObj->where('store_type','=',$storeType);    
        }
        $catObj =  $catObj->where('status','=','1');
	    $catObj =  $catObj->get();
        foreach ($catObj as $obj) {
            $cateArr[$obj->id]=$obj->name;
        }
        return $cateArr;
    }
    
    
    /**
     * @Author: Pradeep Kumar
     * @Description: To Get the all Subcategory List
     */
    public function getSubCategoryList($category_id){
        $subCateArr=array('9999'=>'Not Available');
        if($category_id>0){
            $subCatObj = Category::where('parent_id','=',$category_id)
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
	
	
	
	
	 public function getAllCategoryWithChild(){
        $cateArr=array('9999'=>'Not Available');
        $catObj = Category::where('parent_id','=','0')
                ->orwhere('status','=','1')
				->with('nodes')
			    ->get(['id', 'name','name as text','parent_id','name as href','status']);
                //dd($catObj);
        foreach ($catObj as $obj) {
            if($obj->parent_id==0){
                $cateArr[$obj->id]=array('name'=>$obj->name);
            }
        }
        return $catObj;
    }



    public function children() { 
        return $this->hasMany('App\Category', 'parent_id', 'id'); 
    }




}
