<?php

namespace App\Http\Controllers\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Master;
use App\Category;
use Session;



class CategoryController extends Master
{
    
    public $catObj;
    
    public function __construct() {
        $cat = new Category();
        $this->catObj=$cat;
    }
    
    public function getSubCategory(Request $request){
        if ($request->isMethod('post')) {
            $data=$request->all();
            if($data['id']>0){
                $category_id=$data['id'];
                $subCatList=$this->catObj->getSubCategoryList($category_id);
                $res=array('status'=>'success','data'=>$subCatList);
            }else{
                $res=array('status'=>'error','data'=>array());
            }
            return response()->json($res);
        }
    }
	
	
	
	
	public function allcategory(Request $request){
		$catObj = new Category();
		$catList= $catObj->getAllCategory();
		//return response()->json($catList);
		return view(Master::loadFrontTheme('category.categoryList'),array(
            'categoryArr'=>$catList
        ));
	}
	
	public function savecategory(Request $request){
		if ($request->isMethod('post')) {
			$data=$request->all();
			if($data['id']>0){
				$catObj = Category::find($data['id']);
			}else{
			$catObj = new Category();
			}
			$catObj->parent_id=$data['parent_id'];
			$catObj->name=$data['name'];
			$catObj->description=$data['description'];
			$catObj->status=1;
			if (strpos($data['name'], ' ') !== false) {
				$strText= explode(' ',$data['name']);
				$name = $strText[0];
			}else{
				$name= $data['name'];
			}
			$catObj->cat_code=strtoupper($name);
			$catObj->created_at=date('Y-m-d H:i:s');
			$catObj->save();
		}
		Session::flash('message', 'Category Savesd Successfully!');
        return redirect()->route('allcategory');
		//$catList= $catObj->getAllCategory();
		//return view(Master::loadFrontTheme('category.categoryList'),array(
        //    'categoryArr'=>$catList
        //));
	}
	
	public function delcategory(Request $request){
		if ($request->isMethod('post')) {
			$data=$request->all();
			$catObj =Category::find($data['id']);
			$catObj->status = 0;
			$catObj->save();
			$catList=array('status'=>'success','message'=>"Category Marked as Delated!");
			
		}else{
			$catList=array('status'=>'error','message'=>"Category not deleted!!!");
			
		}
		return response()->json($catList);
		
	}
	
	
	/******************************************API**************************************************/
	public function getAllCategory(Request $request){
		$catObj = new Category();
		$catList= $catObj->getAllCategoryWithChild();
		//dd($catList);
		foreach($catList as $k=>$obj){
			if($obj->parent_id==0){
				$categoryArr[]=$obj;
			}
		}
		
		
		foreach($categoryArr as $k=>$obj){
			//echo $obj->id;
			if($obj->parent_id==0){
				if($obj['status']==0){
					$categoryArr[$k]['color']="#FFF";
					$categoryArr[$k]['backColor']="#ff0000";
				}else{
					$categoryArr[$k]['color']="#FFF";
					$categoryArr[$k]['backColor']="#49C34F";
				}
				$categoryArr[$k]['selectable']=false;
			}
		}
		//dd($categoryArr);
		return response()->json($categoryArr);	
	}
}