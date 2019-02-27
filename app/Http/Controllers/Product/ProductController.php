<?php
namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Master;
use Illuminate\Support\Facades\Redirect;
use AuthAuth;
use App\Seller;
use Session;
use App\State;
use App\City;
use App\Category;
use Image;
use App\Unit;
use App\Product;
use App\UserProduct;
use App\ProductImage;
use Auth;
use App\User;
use Storage;


class ProductController extends Master
{
    /**
     * Global Directory Name
     * Where All Images will upload
     */
    public $uploadDir;
    /**
     * Global Directory Name
     * Where All Business Images will upload
     */
    public $uploadLogoDir;
    /**
     * Global Directory Name
     * Where All Business thumb Images will upload
     */
    public $uploadThumbDir;
    
    public $imageName;
    public $thumbWidth;
    public $thumbHeight;
    
    
    
    public function __construct() {
       $this->middleware('auth')->except(['index','details']);
       $this->uploadDir=config('global.PRODUCT_DIR');
       $this->uploadLogoDir=config('global.PRODUCT_IMG_DIR');
       $this->uploadThumbDir=config('global.PRODUCT_THUMB_DIR');
       

       $this->Width=config('global.PRODUCT_IMG_WIDTH');
       $this->Height=config('global.PRODUCT_IMG_HEIGHT');

       $this->thumbHeight=config('global.PRODUCT_THUMB_IMG_HEIGHT');
       $this->thumbWidth=config('global.PRODUCT_THUMB_IMG_WIDTH');
       $this->imageName=NULL;
       //$this->uploadDir.DIRECTORY_SEPARATOR.Auth::user()->id;
       //$this->uploadDir.DIRECTORY_SEPARATOR.Auth::user()->id.DIRECTORY_SEPARATOR.'thumb';
       
    }
    
    /**
     *@author Pradeep Kumar
     * @Desc: To Add New Product
     */
    public function addProduct(Request $request){
        
        //Get All the Unit List
        $userId = Auth::user()->id;
        $sellerArr = Seller::where('user_id','=',$userId)->first()->toArray();
        $catObj=  new Category();
        $catArr=$catObj->getAllCategory($sellerArr['store_type_id']);
       

        $unitObj = new Unit();
        $unitList=$unitObj->getAllUnit();
        if(count($sellerArr)>0){
            return view(Master::loadFrontTheme('product.addproduct'),array(
            'categoryArr'=>$catArr,
            'unitList'=>$unitList
            ));
        }else{
            return view(Master::loadFrontTheme('seller.setting'),array('userProduct'=>""));
        }
    }
    
    /**
     * @Author: Pradeep Kumar   
     * @Description: To Get the product in edit mode
     */
    public function addProductImg(Request $request,$id){
		$seller = self::getSeller();
        $sellerId = $seller['id'];
        if ($request->isMethod('post')) {
            $image = $request->file('file');
            //$this->uploadLogoDir=config('global.PRODUCT_UPLOAD_DIR').DIRECTORY_SEPARATOR.$this->getProductImageDirName($id);
            //$this->uploadThumbDir=config('global.PRODUCT_UPLOAD_DIR').DIRECTORY_SEPARATOR.$this->getProductImageDirName($id);
            $this->imageName=$this->saveMoreProductImage($request,$sellerId);
            $prodImgObj= new \App\ProductImage();
            $prodImgObj->user_product_id=$id;
            $prodImgObj->image_name=$this->imageName;
            $prodImgObj->user_id=Auth::user()->id;
            $prodImgObj->save();
            $this->imageName="";
        }
        $product = new \App\UserProduct();
        $userProduct=$product->getUserProductById($id);
        return view(Master::loadFrontTheme('product.addproductimg'),array(
		'userProduct'=>$userProduct,'sellerId'=>$sellerId));
    }
    
    
    private function getProductImageDirName($id){
        return 'prod_00'.$id;
    }
    
    
    
    
    /**
     * @Author: Pradeep Kumar   
     * @Description: To Get the product in edit mode
     */
    public function editProduct(Request $request,$id){
        $seller = self::getSeller();
        $sellerId = $seller['id'];
        $store_type_id = $seller['store_type_id'];
        if ($request->isMethod('post')) {
            $validator = $this->validator($request->all());
            if($validator->fails()) {
                $error=$validator->errors()->all();
                Session::flash('error', $error);
                return Redirect::back()->withInput()->with('msg', 'Invalid File Extension!');
            }
            $data=$request->all();
            //Validate Product Data 
            $lastNewId=$this->saveValidProduct($data);
            if($lastNewId){
                $userProduct =  UserProduct::find($id);
                $userProduct->product_id=$lastNewId;
                $userProduct->user_id=Auth::user()->id;
                if(isset($data['quantity'])){
                    $userProduct->quantity_in_unit=$data['quantity'];
                }
                $userProduct->product_in_stock=$data['product_in_stock'];
                $userProduct->unlimited_product=$data['product_unlimited'];
                $userProduct->quantity=$data['productQuantity'];
                $userProduct->default_price=$data['price'];
                $userProduct->price=$data['price'];
                $userProduct->created_at=date('Y-m-d H:i:s');
                $userProduct->status=$data['status'];
                $userProduct->is_deleted=0;
                
                
                //Working for Image if Image is updated
                $image = $request->file('logo');
//                DD($image);
                IF(!empty($image)){
                    $this->imageName=$this->saveProductImage($request,$sellerId);
                    $userProduct->default_images =$this->imageName;
                    $userProduct->default_thumbnail =$this->imageName;
                }
                $userProduct->save();
                $prdObj=new \App\UserProduct();
                $userProduct->product_sku= $prdObj->getSKU($id);
                $userProduct->save();
                Session::flash('message', 'Product Updated Successfully!');
                return redirect()->route('allproduct');
            }
        }
        if($id){
            $saveProduct =  UserProduct::with('Product')->find($id);
            //Check is this valid product of this user
            $product = new \App\UserProduct();
            $userProduct=$product->getUserProductById($id);
            $product=$userProduct->Product;
            
//            $userProduct=$userProduct->UserProduct;
//            dd($userProduct['quantity_in_unit']);
            $catObj=  new Category();
            $catArr=$catObj->getAllCategory($store_type_id);
            
            //Get All SubCategory List
            $subCatArr=$catObj->getSubCategoryList($product['category_id']);
            
            //Get All the brand 
            $brand = new \App\Brand();
            $brandList=$brand->getBrandList($product['category_id']);
            //Get All the Unit List
            $unitObj = new Unit();
            $unitList=$unitObj->getAllUnit();

            return view(Master::loadFrontTheme('product.editproduct'),
                        array(
                            'categoryArr'=>$catArr,
                            'subCatArr'=>$subCatArr,
                            'unitList'=>$unitList,
                            'product'=>$product,
                            'brandList'=>$brandList,
                            'userProduct'=>$userProduct,
                            'sellerId'=>$sellerId
                        )
                    );
        }else{
            abort(404, 'Unauthorized action.');
        }
    }
    
    
    /**
     *@Author: Pradeep Kumar
     *@Description: to Save the image if image is uploaded from the form 
     */
    private function createDir($destinationPath){
        if (!file_exists($destinationPath)) {
               mkdir($destinationPath, 0777, true);
        }
    }
    
    
    /**
     *@Author: Pradeep Kumar
     *@Description: to Save the image if image is uploaded from the form 
     */
    function saveImage($image){
        $this->imageName = md5(time()) . '.' . $image->getClientOriginalExtension();
        $imgArr=explode(".",$this->imageName);
        $ext=end($imgArr);
        if(in_array($ext,config('global.IMG_EXT'))){
            $destinationPath = $this->uploadThumbDir;
            $this->createDir($destinationPath);
            $img = Image::make($image->getRealPath());
            $img->resize($this->thumbWidth, $this->thumbHeight, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . DIRECTORY_SEPARATOR . $this->imageName);
            $destinationPath = $this->uploadLogoDir;
            $this->createDir($destinationPath);
            $image->move($destinationPath, $this->imageName);
            return $this->imageName;
        }else{
            Session::flash('message', 'Invalid File Extension!');
            return Redirect::back()->with('msg', 'Invalid File Extension!');
        }
    }




     
    /**
     *@Author: Pradeep Kumar
     *@Description: to Save the product image if image is uploaded from the form 
     */
    function saveMoreProductImage($request, $sellerId){
          $image      = $request->file('file');
          $fileName   = md5(time()) . '.' . $image->getClientOriginalExtension();
          $imgArr=explode(".",$fileName);
          $ext=end($imgArr);
          if(in_array($ext,config('global.IMG_EXT'))){
          $img = Image::make($image->getRealPath());
          $directoryName = 'products/'.$sellerId;
          
          $thubmName = $this->Height.'X'.$this->Width;
          $img->resize($this->Width, $this->Height, function ($constraint) {
              $constraint->aspectRatio();                 
          });
          $img->stream(); // <-- Key point
          $res = Storage::disk('public')->put('uploads/'.$directoryName.'/'.$thubmName.'/'.$fileName, $img, 'public');



          $thubmName = $this->thumbHeight.'X'.$this->thumbWidth;
          $img->resize($this->thumbHeight, $this->thumbWidth, function ($constraint) {
              $constraint->aspectRatio();                 
          });
          $img->stream(); // <-- Key point
          $res = Storage::disk('public')->put('uploads/'.$directoryName.'/'.$thubmName.'/'.$fileName, $img, 'public');


          
          return $fileName;
          }else{
            Session::flash('message', 'Invalid File Extension!');
            return Redirect::back()->with('msg', 'Invalid File Extension!');
          }
    }





    /**
     *@Author: Pradeep Kumar
     *@Description: to Save the product image if image is uploaded from the form 
     */
    function saveProductImage($request, $sellerId){
          $image      = $request->file('logo');
          $fileName   = md5(time()) . '.' . $image->getClientOriginalExtension();
          $imgArr=explode(".",$fileName);
          $ext=end($imgArr);
          if(in_array($ext,config('global.IMG_EXT'))){
          $img = Image::make($image->getRealPath());
          $directoryName = 'products/'.$sellerId;
          $thubmName = $this->thumbHeight.'X'.$this->thumbWidth;
          $img->resize($this->thumbHeight, $this->thumbWidth, function ($constraint) {
              $constraint->aspectRatio();                 
          });
          $img->stream(); // <-- Key point
          $res = Storage::disk('public')->put('uploads/'.$directoryName.'/'.$thubmName.'/'.$fileName, $img, 'public');
          return $fileName;
          }else{
            Session::flash('message', 'Invalid File Extension!');
            return Redirect::back()->with('msg', 'Invalid File Extension!');
          }
    }





    
    
    
    
    /**
     * @author Pradeep Kumar
     * @description: To Validate the Product with parent product
     * if the is any changes, create new product with created by user_id
     * else leave as it is.
     */
    public function saveValidProduct($data){
        $product = new \App\UserProduct();
        $userProduct=$product->getUserProductById($data['upid']);
        $product=$userProduct->Product;
        $oldProduct['title']=$product['title'];
        $oldProduct['description']=$product['description'];
        $oldProduct['category_id']=$product['category_id'];
        $oldProduct['sub_category_id']=$product['sub_category_id'];
        $oldProduct['brand_id']=$product['brand_id'];
        $oldProduct['unit_id']=$product['unit_id'];
        
        //New Product Data
        $newProduct['title']=$data['title'];
        $newProduct['description']=$data['description'];
        $newProduct['category_id']=$data['category_id'];
        $newProduct['sub_category_id']=$data['sub_category_id'];
        $newProduct['brand_id']=$data['brand_id'];
        $newProduct['unit_id']=$data['unit_id'];
        
        $result=array_intersect($newProduct, $oldProduct);
//        print_r($product);
        //print_r($result);
        //If Count of the Old and New Array Matched, then we will do nothing into product
        //Else we will Create new Products and Update new Product Id to UserProduct Table
        if(count($newProduct)>count($result)){
            $newProduct = new \App\Product();
            $newProduct->title=$data['title'];
            $newProduct->description=$data['description'];
            $newProduct->category_id=$data['category_id'];
            $newProduct->sub_category_id=$data['sub_category_id'];
            $newProduct->brand_id=$data['brand_id'];
            $newProduct->unit_id=$data['unit_id'];
            $newProduct->created_by=Auth::user()->id;
            $newProduct->created_at=date('Y-m-d H:i:s');
            $newProduct->save();
            $lastId=$newProduct->id;
        }else{
            $lastId=$data['id'];
        }
        return $lastId;
    }
    
    
    /**
     * @author Pradeep Kumar
     * @Description: To Check is this product is valid for current user
     * @param upid [user_product_id]
     * @return type
     */
    public function isValidProduct($upid){
        $product = new \App\UserProduct();
        $userProduct=$product->getUserProductById($upid);
        return $userProduct;
    }
    
    
    public function saveProduct(Request $request){
		$data=array();
        if ($request->isMethod('post')) {
            $seller = self::getSeller();
            $sellerId = $seller['id'];
            $data=$request->all();
            $request->flash();
            $data['user_id']=Auth::user()->id;
            $validator = $this->validator($request->all());
            if($validator->fails()) {
                $error=$validator->errors()->all();
                Session::flash('error', $error);
                return Redirect::back()->withInput()->with('msg', 'Invalid File Extension!');
            }else{
                $product = new Product();
                $product->title=$data['title'];
                $product->description=$data['description'];
                $product->category_id=$data['category_id'];
                $product->sub_category_id=$data['sub_category_id'];
                $product->brand_id=$data['brand_id'];
                $product->unit_id=$data['unit_id'];
                $product->created_by=$data['user_id'];
                $product->created_at=date('Y-m-d H:i:s');
                $product->save();
                $lastId=$product->id;
                
                //Save data into product user table
                if($lastId){
                    $data['productQuantity']=100;
                    $userProduct =  new \App\UserProduct();
                    $userProduct->product_id=$lastId;
                    $userProduct->seller_id=$sellerId;
                    $userProduct->user_id=$data['user_id'];
                    $userProduct->quantity_in_unit=$data['quantity'];
                    $userProduct->product_in_stock=$data['product_in_stock'];
                    $userProduct->unlimited_product=$data['product_unlimited'];
                    $userProduct->quantity=$data['productQuantity'];
                    $userProduct->default_price=$data['price'];
                    $userProduct->price=$data['price'];
                    if($data['discount']>0){
                        $userProduct->isDiscounted=1;
                    }else{
                        $userProduct->isDiscounted=0;
                    }
                    $userProduct->discount_value=$data['discount'];
                    $userProduct->selling_price=$data['selling_price'];
                    $userProduct->created_at=date('Y-m-d H:i:s');
                    $userProduct->status=$data['status'];
                    $userProduct->is_deleted=0;
                    
                    //Working for Image if Image is updated
                    $image = $request->file('logo');
                    IF(!empty($image)){
                        $this->imageName=$this->saveProductImage($request,$image,$sellerId);
                        $userProduct->default_images =$this->imageName;
                        $userProduct->default_thumbnail =$this->imageName;
                    }
                    
                    $userProduct->save();
                    $lastUserProdId=$userProduct->id;
                    //Update the SKU
                    //Get Latest Saved Product,
                    
                    $prodObj=new \App\UserProduct();
                    $sku=$prodObj->getSKU($lastUserProdId);
                    $saveProduct =  UserProduct::find($lastUserProdId);
                    $saveProduct->product_sku=$sku;
                    $userProduct->save();
                    
                }
                return redirect()->route('editProduct', ['upid' => $lastUserProdId]);
            }
        }
        
    }
    
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'category_id' => 'required|string|min:1',
            'sub_category_id'=>'required|string|max:255',
            'brand_id' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'unit_id' => 'required|string|min:1',
            'quantity' => 'required|string|max:10',
            'product_in_stock' => 'required|string|min:1',
            'product_unlimited' => 'required|string|min:1',
            'discount' => 'required|string|min:1',
            'discount' => 'required|string|min:1',
            'selling_price' => 'required|string|min:1',
        ]);
    }
    
    /**
     * @author Pradeep Kumar
     * @Description: To Get All the List of Product
     */
    public function allProductList(Request $request){
        $product = new \App\UserProduct();
        $userId= Auth::user()->id;

        $seller = self::getSeller();
        $sellerId = $seller['id'];
            

        $userProductList=$product->getSellerProductList($userId)->orderBy('id','DESC')->paginate(self::getPageItem()); 
        return view(Master::loadFrontTheme('product.allproduct'),
            array(
                'userProduct'=>$userProductList,
                'sellerId'=>$sellerId,
                'links'=>$userProductList->links()
            )
        );
        
    }
    
    /**
     * @author Pradeep Kumar
     * @Description: To SoftDelete of the Product
     */
    public function deleteProduct(Request $request,$id){
        $userProduct =  UserProduct::find($id);
        $userProduct->is_deleted=0;
        $userProduct->status=0;
        $userProduct->save();
        Session::flash('message', 'Product marked as deleted!');
        return redirect()->route('allproduct');
    }

    
    /**
     * @author Pradeep Kumar
     * @Description: For Product Details
     */
    public function details(Request $request,$slug,$id){
        $metaTags = self::getMetaTags();
		$lsitArr = array();
        $userProductId=decrypt($id);
        if($userProductId>0){
            $userProduct =  UserProduct::with('product','ProductImage')->find($userProductId);
            $seller=Seller::where('user_id','=',$userProduct['user_id'])->with('SellerImage')->first();
			//Get Seller Product List

            $uPObj = new UserProduct();
            $lsit=$uPObj->getAllProductListOfSeller($userProduct['user_id'],$id);
            foreach($lsit as $key=>$obj){
            if($obj['id']!=$userProductId){    
            $lsitArr[]=array(
                    'UserProduct'=>$obj,
                    'Product'=>$obj->product
                    );    
                }
            }
        }else{
            abort(404);
        }
        if(count($userProduct['ProductImage'])>0){
            $productImage = config('global.PRODUCTS_STORAGE_DIR').DIRECTORY_SEPARATOR.$seller['id'].DIRECTORY_SEPARATOR.config('global.PRODUCT_THUMB_IMG_WIDTH').'X'.config('global.PRODUCT_THUMB_IMG_HEIGHT').DIRECTORY_SEPARATOR.$userProduct['default_images'];
        }else{
            $productImage = self::getLogo();
        }
        $metaTitle = $userProduct['product']['title'];
        $metaDesc = 'Seller '.$seller['business_name'].', Buy '.$userProduct['product']['title'].' at ₹'.$userProduct['selling_price'].' only.';
        $metaKeywords = $userProduct['product']['title'];
        $pageImage = $productImage;
        $pageUrl = self::getURL().'/detail/'.str_slug($userProduct['product']['title']).'/'.$id;
        $createdAtStr = $userProduct['created_at'];
        $updatedAtStr = $userProduct['updated_at'];
        $section      = 'Product';
        $category     = 'Product Page';
        $tag          = 'Buy, Sell, Lower Price, Hot Deal';
        $article      = 'Buy '. $userProduct['product']['title'];

        $metaTags['title']        =$metaTitle;
        $metaTags['description']  =$metaDesc;
        $metaTags['keywords']     =$metaKeywords;
        $metaTags['pageimage']    =$pageImage;
        $metaTags['pageurl']      =$pageUrl;
        $metaTags['publishedTime']=$createdAtStr;
        $metaTags['modifiedTime'] =$updatedAtStr;
        $metaTags['section']      =$section;
        $metaTags['category']     =$category;
        $metaTags['tag']          =$tag;
        $metaTags['article']      =$article;
        $metaTags['twittersite']  ='';
        $metaTags['urlimage']     =$pageImage;
        $metaTags['url']          =$pageUrl;
        $metaTags['sitename']     =self::getAppName();
        return view(Master::loadFrontTheme('frontend.details'),array(
                    'productDetails'=>$userProduct,
                    'seller'=>$seller,
                    'productList'=>$lsitArr,
                    'metaTags'=>$metaTags
                )
            );
    }




    public function productAttr(Request $request,$id){
        if ($request->isMethod('post')) {
            $productId = $id;
            $aboutproduct = $request->get('aboutproduct');
            $offer = $request->get('offer');
            $returnpolicy = $request->get('returnpolicy');
            $misc = $request->get('misc');
            $userProduct =  UserProduct::find($productId);
            $tag = 'Product';
            if($aboutproduct!=''){
                $tag = 'About Product updated!';
                $userProduct->about_product = $aboutproduct;
            }
            if ($offer!='') {
                $tag = 'Product Offer updated!';
                $userProduct->offers = $offer;
            }
            if ($returnpolicy!='') {
                $tag = 'Product Return Policy updated!';
                $userProduct->return_policy = $returnpolicy;
            }
            if ($misc!='') {
                $tag = 'Product Misc updated!';
                $userProduct->misc = $misc;
            }
            try{
                $userProduct->save();
                Session::flash('message', $tag);
            }catch(Exception $e){
                Session::flash('message', 'Product not updated!');
            }
            return redirect()->route('editProduct', ['upid' => $productId]);
        }

    }




    

}
