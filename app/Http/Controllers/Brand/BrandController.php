<?php

namespace App\Http\Controllers\Brand;

use Illuminate\Http\Request;
use App\Http\Controllers\Master;
use App\Brand;
use App\Category;
use Session;
use App\StoreType;
use App\Seller;
use Auth;

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
          //dd($data);
            if($data['id']>0){
                $catObj = Brand::find($data['id']);
                    if(Auth::user()->id==$catObj->user_id){
                    if($data['category_id']>0){
                        $catObj->category_id=$data['category_id'];
                    }else{
                        $catObj->category_id=$data['parent_id'];
                    }
                    $catObj->name=$data['name'];
                    $catObj->description=$data['description'];
                    $catObj->user_id=Auth::user()->id;
                    $catObj->status=$data['status'];
                    if (strpos($data['name'], ' ') !== false) {
                        $strText= explode(' ',$data['name']);
                        $name = $strText[0];
                    }else{
                        $name= $data['name'];
                    }
                    $catObj->brand_code=strtoupper($name);
                    $catObj->created_at=date('Y-m-d H:i:s');
                    $catObj->save();
                }else{
                    $error[] = "You can not update default brands.";
                    Session::flash('error', $error);
                }

            }else{

                $catObj = new Brand();
                if($data['category_id']>0){
                        $catObj->category_id=$data['category_id'];
                    }else{
                        $catObj->category_id=$data['parent_id'];
                }
                $catObj->name=$data['name'];
                $catObj->description=$data['description'];
                $catObj->user_id=Auth::user()->id;
                $catObj->status=$data['status'];
                if (strpos($data['name'], ' ') !== false) {
                    $strText= explode(' ',$data['name']);
                    $name = $strText[0];
                }else{
                    $name= $data['name'];
                }
                $catObj->brand_code=strtoupper($name);
                $catObj->created_at=date('Y-m-d H:i:s');
                $catObj->save();
                Session::flash('message', 'Brand Savesd Successfully!');
            }
        }
        
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



    public function getAllBrandsList(Request $request){
            $catObj = new Category();
            $catList= $catObj->getAllCategory();
            $sellerArr= Master::getSeller();
            $store_type_id = $sellerArr['store_type_id'];

            //Get All the store Type
            $sellerDetails = Seller::with('StoreType')->where('user_id','=',Auth::user()->id)->get();

            //Get All Category of this Store Type
            $parentCategory = Category::where('store_type','=',$store_type_id)->where('parent_id','=',0)->where('status','=',1)->get();


            $catObj = new Category();
            $catList= $catObj->getAllCategory();
            foreach($catList as $id=>$catobj){
                    $List[$catobj]=$this->brandObj->getBrandList($id);
            }
            return view(Master::loadFrontTheme('brand.brandList'),array(
                    'brandListArr'=>$List,
                    'categoryArr'=>$catList,
                    'storeTypeList'=>$sellerDetails,
                    'parentCategory'=>$parentCategory,
                    'store_type_id'=>$store_type_id
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










    /**************Get All the Brands List***************/
    public function getStoreBrandsTreeList(Request $request){
        $store_type= $request->get('sty');
        $catObj = new Category();
        $catList= $catObj->getAllStoreTypeCategoryWithChild($store_type)->toArray();

        if(count($catList)>0){
            foreach($catList as $k=>$obj){
            
                if($obj['parent_id']==0){
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
                        $catList[$k]['nodes'][$c]['nodes']=$this->getAllBrandByCategoryId($child['id']);  
                        foreach ($catList[$k]['nodes'][$c]['nodes'] as $kk => $brand) {
                            $catList[$k]['nodes'][$c]['backColor']="#E1E076";
                            if($brand['status']==0){
                                $catList[$k]['nodes'][$c]['nodes'][$kk]['color']="#FFF";
                                $catList[$k]['nodes'][$c]['nodes'][$kk]['backColor']="#ff4343";
                            }else{
                                $catList[$k]['nodes'][$c]['nodes'][$kk]['color']="#000";
                                $catList[$k]['nodes'][$c]['nodes'][$kk]['backColor']="#FFF";
                            }
                            $catList[$k]['nodes'][$c]['nodes'][$kk]['parent_id']=$obj['id'];
                            $catList[$k]['nodes'][$c]['nodes'][$kk]['category_id']=$child['id'];
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



    //Get All the Bands By Category Ids
    public function getAllBrandByCategoryId($category_id){
    $brand = Brand::where('category_id','=',$category_id)->get(['id', 'name','name as text','id as href','status'])->toArray();
    return $brand; 
    }


















}
