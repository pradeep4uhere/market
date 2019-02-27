<?php

namespace App\Http\Controllers\Brand;

use Illuminate\Http\Request;
use App\Http\Controllers\Master;
use App\Brand;
use App\Category;
use Session;

class BrandController extends Master
{
    public $brandObj;
    
    public function __construct() {
        $brand = new Brand();
        $this->brandObj=$brand;
    }

    public function savebrand(Request $request){
        if ($request->isMethod('post')) {
            $data=$request->all();
            if($data['id']>0){
                $catObj = Brand::find($data['id']);
            }else{
            $catObj = new Brand();
            }
            $catObj->category_id=$data['parent_id'];
            $catObj->name=$data['name'];
            $catObj->description=$data['description'];
            $catObj->status=1;
            if (strpos($data['name'], ' ') !== false) {
                $strText= explode(' ',$data['name']);
                $name = $strText[0];
            }else{
                $name= $data['name'];
            }
            $catObj->brand_code=strtoupper($name);
            $catObj->created_at=date('Y-m-d H:i:s');
            $catObj->save();
        }
        Session::flash('message', 'Brand Savesd Successfully!');
        return redirect()->route('getbrands');
        //$catList= $catObj->getAllCategory();
        //return view(Master::loadFrontTheme('category.categoryList'),array(
        //    'categoryArr'=>$catList
        //));
    }
    
    public function getAllBrands(Request $request){
            $catObj = new Category();
            $catList= $catObj->getAllCategory();
            foreach($catList as $id=>$catobj){
                    $List[$catobj]=$this->brandObj->getBrandList($id);
            }
            return view(Master::loadFrontTheme('brand.brandList'),array(
            'brandListArr'=>$List,
            'categoryArr'=>$catList
            ));
            
    }

    public function getBrandList(Request $request){
        if ($request->isMethod('post')) {
            $data=$request->all();
            if($data['id']>0){
                $category_id=$data['id'];
                $List=$this->brandObj->getBrandList($category_id);
                if(empty($List)){
                    $category_id=$data['parentCatId'];
                    $List=$this->brandObj->getBrandList($category_id);
                }
                $res=array('status'=>'success','data'=>$List);
            }else{
                $res=array('status'=>'error','data'=>array());
            }
            return response()->json($res);
        }
    }
}
