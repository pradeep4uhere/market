<?php

namespace App\Http\Controllers\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Master;
use App\Category;
use Session;
use App\StoreType;
use App\Unit;
use App\Seller;
use Auth;


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
		$sellerArr= Master::getSeller();
		$store_type_id = $sellerArr['store_type_id'];

		//Get All the store Type
		$sellerDetails = Seller::with('StoreType')->where('user_id','=',Auth::user()->id)->get();

		//Get All Category of this Store Type
		$parentCategory = Category::where('store_type','=',$store_type_id)->where('parent_id','=',0)->where('status','=',1)->get();
		return view(Master::loadFrontTheme('category.categoryList'),array(
            'categoryArr'=>$catList,
            'storeTypeList'=>$sellerDetails,
            'parentCategory'=>$parentCategory,
            'store_type_id'=>$store_type_id
        ));
	}












	
	public function savecategory(Request $request){
		if ($request->isMethod('post')) {
			$data=$request->all();
			$catObj = new Category();
			if($data['id']>0){
				$catObj = Category::find($data['id']);
				if($catObj->user_id==Auth::user()->id){
				$sellerArr= Master::getSeller();
				$store_type_id = $sellerArr['store_type_id'];
				$catObj->store_type=$store_type_id;
				$catObj->parent_id=$data['parent_id'];
				$catObj->name=$data['name'];
				$catObj->description=$data['description'];
				$catObj->status=$data['status'];
				$catObj->user_id=Auth::user()->id;
				if (strpos($data['name'], ' ') !== false) {
					$strText= explode(' ',$data['name']);
					$name = $strText[0];
				}else{
					$name= $data['name'];
				}
				$catObj->cat_code=strtoupper($name);
				$catObj->created_at=date('Y-m-d H:i:s');
				$catObj->save();

				Session::flash('message', 'Category Savesd Successfully!');
				}else{
					$error[]= "You can not update default Category.";
					Session::flash('error', $error);
				}

			}else{

				$sellerArr= Master::getSeller();
				$store_type_id = $sellerArr['store_type_id'];
				$catObj->store_type=$store_type_id;
				$catObj->parent_id=$data['parent_id'];
				$catObj->name=$data['name'];
				$catObj->description=$data['description'];
				$catObj->status=$data['status'];
				$catObj->user_id=Auth::user()->id;
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
			
		}
        return redirect()->route('allcategory');
		//$catList= $catObj->getAllCategory();
		//return view(Master::loadFrontTheme('category.categoryList'),array(
        //    'categoryArr'=>$catList
        //));
	}




	public function saveStoreType(Request $request){
		if ($request->isMethod('post')) {
			$data=$request->all();
			$storeType = StoreType::find($data['store_type']);
			$storeType->status=$data['status'];
			$storeType->save();
		}
		Session::flash('message1', 'Store Type Savesd Successfully!');
        return redirect()->route('allcategory');
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




	public function getStoreCategory(Request $request){
		$store_type= $request->get('sty');
		$catObj = new Category();
		$catList= $catObj->getAllStoreTypeCategoryWithChild($store_type);
		if(count($catList)>0){
			foreach($catList as $k=>$obj){
			
				if($obj->parent_id==0){
					if($obj['status']==0){
						$catList[$k]['color']="#FFF";
						$catList[$k]['backColor']="#FF00FF";
					}else{
						$catList[$k]['color']="#FFF";
						$catList[$k]['backColor']="#49C34F";
					}
					$catList[$k]['selectable']=false;
					//Highlights For Nods Child
					// dd($catList[$k]['nodes']);
					foreach($catList[$k]['nodes'] as $c=>$child){
						if($child['status']==0){
							$catList[$k]['nodes'][$c]['color']="#FFF";
							$catList[$k]['nodes'][$c]['backColor']="#ff4343";
						}
					}
				}
			}

			$resultArr['status']=200;	
			$resultArr['dataSet']=$catList;

		}else{

			$resultArr['status']=500;
			$resultArr['dataSet']=$str;
		}
		return response()->json($resultArr);	
	}


	public function getStoreSubCategory(Request $request){
		$sty= $request->get('sty');
		$parent_id= $request->get('parent_id');
		$catObj = new Category();
		$catList= $catObj->getAllStoreTypeSubCategoryWithChild($sty,$parent_id);
		$str="<option value='-1'>Choose Sub Category</option>";
		
		if(count($catList)>0){
		//dd($categoryArr);
		foreach($catList as $val){
			$str.="<option value='".$val['id']."'>".$val['name']."</option>";
		}
			$resultArr['status']=200;
			$resultArr['dataSet']=$str;
		}else{
			$str.="<option data-tokens='-1'>Not Available</option>";
			$resultArr['status']=500;
			$resultArr['dataSet']=$str;
		}
		return response()->json($resultArr);	
	}









	














	public function allUnits(Request $request){
		$sellerArr= Master::getSeller();
		$store_type_id = $sellerArr['store_type_id'];
		//Get All the store Type
		$storeActiveTypeList = StoreType::where('status','=','1')->get();

		$UnitM = Unit::where('status','=','1')->get()->toArray();
		$Unit = Unit::orderBy('name','ASC')->orwhere('user_id','=',Auth::user()->id)->get()->toArray();
		return view(Master::loadFrontTheme('category.unitList'),array(
            'UnitList'=>$Unit,
            'storeTypeList'=>$storeActiveTypeList,
            'store_type_id'=>$store_type_id,
            'masterUnit'=>$UnitM
        ));
			
	}



	public function saveUnit(Request $request){
		if ($request->isMethod('post')) {
			$data=$request->all();
			$catObj = new Unit();
			if($data['id']>0){
				$catObj = Unit::find($data['id']);
				if($catObj->user_id==Auth::user()->id){
				$sellerArr= Master::getSeller();
				$catObj->name=$data['name'];
				$catObj->status=$data['status'];
				$catObj->user_id=Auth::user()->id;
				if (strpos($data['name'], ' ') !== false) {
					$strText= explode(' ',$data['name']);
					$name = $strText[0];
				}else{
					$name= $data['name'];
				}
				$catObj->code=strtoupper($name);
				$catObj->created_at=date('Y-m-d H:i:s');
				$catObj->save();

				Session::flash('message', 'Unit Savesd Successfully!');
				}else{
					$error[]= "You can not update default Category.";
					Session::flash('error', $error);
				}

			}else{
				$catObj->name=$data['name'];
				$catObj->status=$data['status'];
				$catObj->user_id=Auth::user()->id;
				if (strpos($data['name'], ' ') !== false) {
					$strText= explode(' ',$data['name']);
					$name = $strText[0];
				}else{
					$name= $data['name'];
				}
				$catObj->code=strtoupper($name);
				$catObj->created_at=date('Y-m-d H:i:s');
				$catObj->save();
				
			}
			
		}
        return redirect()->route('allunits');
	}
}