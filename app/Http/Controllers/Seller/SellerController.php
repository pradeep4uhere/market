<?php
namespace App\Http\Controllers\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Master;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Seller;
use Session;
use App\State;
use App\City;
use Image;
use App\SellerImage;
use App\StoreType;
use DB;
use App\OrderDetail;
use App\Order;
use App\Location;
use App\User;
use Log;
use Storage;
use App\Category;



class SellerController extends Master
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
	   $this->middleware('auth')->except(['index','sellerview']);
       $this->uploadDir=config('global.UPLOAD_DIR');
       $this->uploadLogoDir=config('global.SELLER_IMG_DIR');
       $this->uploadThumbDir=config('global.SELLER_THUMB_DIR');
       $this->thumbHeight=config('global.SELLER_THUMB_IMG_HEIGHT');
       $this->thumbWidth=config('global.SELLER_THUMB_IMG_WIDTH');
       $this->Height=config('global.SELLER_IMG_HEIGHT');
       $this->Width=config('global.SELLER_IMG_WIDTH');

       $this->imageName=NULL;
    }
	


    /*
     *@Author: Pradeep Kumar
     */
    public function getProductFilterList(Request $request, $seller,$id, $category_id){
       if($request->ajax()) {
        if($id!=''){
          $seller_id=decrypt($id);
          $seller = Seller::where('id','=',$seller_id)->with('User')->first();
        }
        $productList=array();
        //Get All the Products with Category Id
        $params  = array();
        $idList  = array();
        $lsitArr = array();

        if($category_id>0){
          $params['category_id'] = $category_id;
          //Get All the Product List Of Seller
          $query = DB::table('products')->select('id')->where('category_id','=',$params['category_id'])->get();
          if(count($query)>0){
            foreach($query as $val){
              $idList[] = $val->id;
            }
          }
          $params['product_id'] = $idList;
        }else{
          $params = array();
        }
        $userProd = new \App\UserProduct();
        //echo $productList = $userProd->getSellerProductFilterList($seller_id,$seller['user_id'],$params)->toQueryString();die;
        $productList = $userProd->getSellerProductFilterList($seller_id,$seller['user_id'],$params)->paginate(self::getPageItem());
        if(!empty($productList)){
        foreach($productList as $key=>$obj){
              $lsitArr[]=array(
                 'UserProduct'=>$obj,
                 'Product'=>$obj->product
                );    
              }
          }
        return view(Master::loadFrontTheme('partials.loadmore'),array(
           'productDetails'=>$productList,
           'productList'=>$lsitArr,
        ));
      }
    }



    /*
    *@Author: Pradeep Kumar
    *@Description: View Seller orderDetails
    */
    public function orderDetails(Request $request){
        $orderId = decrypt($request->get('id'));
        $sellerArr = Seller::where('user_id','=',Auth::user()->id)->first();
        $seller_id = $sellerArr['id']; 
        $query="SELECT * FROM so_order_details";
        $query.=" where order_id=".$orderId." AND seller_id=".$seller_id."";
        $query.=" ORDER BY id DESC";
        $ordersDetails = DB::select(DB::raw($query));
         return view(Master::loadFrontTheme('seller.admin.orderDetails'),array(
            'orders'=>$ordersDetails
        ));

    }

	/*
    *@Author: Pradeep Kumar
    *@Description: View Seller Prifole
    */
    public function orderlist(Request $request){
        $type = $request->get('type');
        $order_id = $request->get('ord');
        if($order_id!=''){
            $ty='';
            $typ = $request->get('ty');
            if($typ=='Open'){ $ty = 'Open';}
            if($typ=='Processing'){ $ty = 'Processing';}
            if($typ=='Complete'){ $ty = 'Complete';}
            if($typ=='Canceled'){ $ty = 'Canceled';}
            if($typ=='return'){ $ty = 'Return';}
            if($typ=='OnHold'){ $ty = 'On Hold';}
            if($typ=='Pending'){ $ty = 'Pending';}
            if($typ=='PaymentReview'){ $ty = 'Payment Review';}
            if($typ=='PendingPayment'){ $ty = 'Pending Payment';}
            if($typ=='SuspectedFraud'){ $ty = 'Suspected Fraud';}
            if($typ=='Closed'){ $ty = 'Closed';}
            $orderObj = Order::find(decrypt($order_id));
            $orderObj->order_status = $ty;
            $orderObj->save();
        }

        //Search Query
        $orderid = $request->get('orderid');
        $mobile = $request->get('mobile');
        $date = $request->get('date');


        $sellerArr = Seller::where('user_id','=',Auth::user()->id)->first();
        $seller_id = $sellerArr['id']; 
        $query ='SELECT CONCAT(u.first_name," ",u.last_name) as name, da.mobile,da.address_1,da.address_2,da.landmarks, o.id,o.orderID, o.user_id,o.shipping_id,o.totalAmount,o.payment_status,o.order_status,o.created_at ';
        $query.=' FROM so_orders as o ';
        $query.=' LEFT JOIN so_order_details od on od.order_id = o.id ';
        $query.=' LEFT JOIN so_sellers s on s.id = od.seller_id ';
        $query.=' LEFT JOIN so_users u on o.user_id = u.id ';
        $query.=' LEFT JOIN so_delivery_addresses da on o.shipping_id = da.id ';
        $query.=' where od.seller_id='.$seller_id.'';
        if($type=='Open'){
            $query.=' AND o.order_status="Open"';
        }elseif($type=='Processing'){
            $query.=' AND o.order_status="Processing"';
        }elseif($type=='Complete'){
            $query.=' AND o.order_status="Complete"';
        }elseif($type=='return'){
            $query.=' AND o.order_status="Return"';
        }elseif($type=='OnHold'){
            $query.=' AND o.order_status="On Hold"';
        }elseif($type=='Pending'){
            $query.=' AND o.order_status="Pending"';
        }elseif($type=='PaymentReview'){
            $query.=' AND o.order_status="Payment Review"';
        }elseif($type=='PendingPayment'){
            $query.=' AND o.order_status="Pending Payment"';
        }elseif($type=='SuspectedFraud'){
            $query.=' AND o.order_status="SuspectedFraud"';
        }elseif($type=='Closed'){
            $query.=' AND o.order_status="Closed"';
        }else{
            $query.=' ';
            $type='All';
        }

        if($orderid!=''){
            $query.=' AND o.orderID="'.$orderid.'"';
        }

        if($mobile!=''){
            $query.=' AND da.mobile LIKE "%'.$mobile.'%"';
        }

        if($date!=''){
            $query.=' AND DATE(o.created_at)="'.date("Y-m-d",strtotime($date)).'"';
        }
        $query.=' group by o.id ';
        $query.=' order by o.id DESC ';
        $orders = DB::select(DB::raw($query));
        return view(Master::loadFrontTheme('seller.admin.allorderlist'),array(
            'orders'=>$orders,
            'type'=>$type,
            'orderid'=>$orderid,
            'mobile'=>$mobile,
            'date'=>$date


        ));
    }

    /*******************************Admin Profile Section***********************************/






    /*
	*@Author: Pradeep Kumar
	*@Description: View Seller Prifole
	*/
	public function sellerview(Request $request, $seller,$id,$catId=null){
      if($request->ajax()) {
        if($id!=''){
          $id=decrypt($id);
          $seller = Seller::where('id','=',$id)->with('User')->first();
        }
        $productList=array();
        $userProd = new \App\UserProduct();
        $productList = $userProd->getUserProductList($seller['user_id'])->paginate(self::getPageItem());
        if(!empty($productList)){
        foreach($productList as $key=>$obj){
              $lsitArr[]=array(
                 'UserProduct'=>$obj,
                 'Product'=>$obj->product
                );    
              }
          }
        return view(Master::loadFrontTheme('partials.loadmore'),array(
           'productDetails'=>$productList,
           'productList'=>$lsitArr,
        ));
      }

      $metaTags = self::getMetaTags();
  		if($id!=''){
  			$id=decrypt($id);
  			$seller = Seller::where('id','=',$id)->with('User')->first();
  		} 

		  //dd($seller['user_id']);
        $lsitArr=array();
        $productList=array();
    		$userProd = new \App\UserProduct();
        
        //Search Parameters
        $params=array();
        if($catId!=''){
          $params['category_id']=$catId;
        }
    		$productList = $userProd->getUserProductList($seller['user_id'])->paginate(self::getPageItem());
        if(!empty($productList)){
    		foreach($productList as $key=>$obj){
                   
                $lsitArr[]=array(
                        'UserProduct'=>$obj,
                        'Product'=>$obj->product
                        );    
                    
                }
            }

        $metaTitle = $seller['business_name'];
        $metaDesc = $seller['business_name'].', Near '.$seller['address_1'].', '.$seller['address_2'];
        $metaKeywords = 'Seller, Near Store';
        if($seller['image_logo']!=''){
          $pageImage = config('global.SELLER_STORAGE_DIR').'/250X250/'. $seller['image_thumb'];
        }else{
          $pageImage = self::getLogo();
        }
        $pageUrl = self::getURL().'/seller/'.str_slug($seller['business_name']).'/'.encrypt($seller['id']);
        $createdAtStr = $seller['created_at'];
        $updatedAtStr = $seller['updated_at'];
        $section      = 'Seller';
        $category     = 'Seller Page';
        $tag          = 'Buy, Sell, Lower Price, Hot Deal';
        $article      = 'Seller Business Page';

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

        //Get All the Category For Filter Respective Store Type
        $categoryList = Category::with('children')
        ->where('status','=',1)
        ->where('parent_id','=',0)
        ->where('store_type','=',$seller['store_type_id'])
        ->paginate(self::getPageItem(100));
        
        if($seller['store_type_id']==8){
          $featureImage = 'furnitures.jpg';
        }else if($seller['store_type_id']==2){
          $featureImage = '675787457fcbbc5.jpg';
        }else{
          $featureImage = 'banner4.jpg';
        }

		return view(Master::loadFrontTheme('seller.details'),array(
				'seller'=>$seller,
				'productDetails'=>$productList,
        'productList'=>$lsitArr,
        'metaTags'=>$metaTags,
        'categoryList'=>$categoryList,
        'store_type'=>$featureImage
				)
			);
		
	}
	 
	 
	
	
	public function sellerregister(){
		//Get All State List
    $stateObj = new State();
    $state= $stateObj->getAllState();
    $cityObj = new City();
    $city =$cityObj->getAllCity();
    $seller=Seller::where('user_id','=',Auth::user()->id)->first();
		//Get Business Type List
		$businessType = StoreType::where('status','=',1)->all();
		if(!empty($seller)){
			return redirect()->route('seller');
		}else{
			return view(Master::loadFrontTheme('seller.register'),array(
				'user'=>$seller,
				'stateList'=>$state,
				'cityList'=>$city,
				'businessType'=>$businessType,
				)
			);
		}
	//return view(Master::loadFrontTheme('seller.register'));
		
	}
	
	
	public function dashboard(){
       $orderType['order_recived']=0;
       $orderType['processing']=0;
       $orderType['canceled']=0;
       $orderType['delivered']=0;
       $orderType['return']=0;

       $allOrderType['order_recived']=0;
       $allOrderType['processing']=0;
       $allOrderType['canceled']=0;
       $allOrderType['delivered']=0;
       $allOrderType['return']=0;

        $sellerArr = Seller::where('user_id','=',Auth::user()->id)->first();
        $seller_id = $sellerArr['id']; 
        $orderInfo = DB::table('order_details')
                 ->where('seller_id','=',$seller_id)
                 //->where('order_status','!=','Delivered')
                 ->whereRaw('Date(order_date) = CURDATE()')
                 ->select('order_status', DB::raw('count(*) as total'))
                 ->groupBy('order_status')
                 ->get();

        $orderType=[];
        if(count($orderInfo)>0){
            foreach($orderInfo as $data){
                $orderType[str_replace(" ","_",strtolower($data->order_status))]=$data->total;
            }
        }else{
            $orderType['order_recived']=0;
            $orderType['processing']=0;
            $orderType['canceled']=0;
            $orderType['delivered']=0;
            $orderType['return']=0;
        }

        //Get All Latest Order List
        $records = DB::table('order_details')
                  ->select(DB::raw('*'))
                  ->whereRaw('Date(order_date) = CURDATE()')
                  ->get();
                  //dd($records);

        //Total Order

        if(count($records)>0){
            $totalTodayOrder = count($records);
        }else{
            $totalTodayOrder='0';
        }

        //Total Quantiy Sold
        $allOrderInfo = DB::table('order_details')
                 ->where('seller_id','=',$seller_id)
                 ->select('order_status', DB::raw('count(*) as total'))
                 ->groupBy('order_status')
                 ->get();
                 //dd($allOrderInfo);

        if(count($allOrderInfo)>0){
            foreach($allOrderInfo as $alldata){
                $allOrderType[str_replace(" ","_",strtolower($alldata->order_status))]=$alldata->total;
            }
        }else{
            $allOrderType['order_recived']=0;
            $allOrderType['processing']=0;
            $allOrderType['canceled']=0;
            $allOrderType['delivered']=0;
            $allOrderType['return']=0;
        }
        //dd($allOrderType);

        //Tatol Quantiy Sold  Today
        $totalTodayQuantity = DB::table('order_details')
                 ->where('seller_id','=',$seller_id)
                 ->whereRaw('Date(order_date) = CURDATE()')
                 ->sum('quantity');
                 //DD($totalTodayQuantity);

         //Tatol  Sold  Today
         $totalTodaySell = DB::table('order_details')
         ->where('seller_id','=',$seller_id)
         ->whereRaw('Date(order_date) = CURDATE()')
         ->sum('total_amount');


        //Tatol Quantiy Sold  Month
        $currentMonth = date('m');
        $totalMonthQuantity = DB::table('order_details')
                 ->where('seller_id','=',$seller_id)
                 ->whereRaw('MONTH(order_date) = ?',[$currentMonth])
                 ->sum('quantity');

         //Tatol  Sold  Month
         $totalMonthSell = DB::table('order_details')
         ->where('seller_id','=',$seller_id)
         ->whereRaw('MONTH(order_date) = ?',[$currentMonth])
         ->sum('total_amount');




        //Tatol Quantiy Sold Till Today
        $totalQuantity = OrderDetail::where('seller_id','=',$seller_id)
        ->sum('quantity');

        //Total Sell
        $totalAmount = OrderDetail::where('seller_id','=',$seller_id)
        ->sum('total_amount');



	return view(Master::loadFrontTheme('seller.dashboard'),array(
		'userProduct'=>"",
        'totalTodayOrder'=>$totalTodayOrder,
        'orderType'=>$orderType,
        'allOrderType'=>$allOrderType,
        'totalQuantity'=>$totalQuantity,
        'totalAmount'=>$totalAmount,
        'totalTodayQuantity'=>$totalTodayQuantity,
        'totalTodaySell'=>$totalTodaySell,
        'totalMonthQuantity'=>$totalMonthQuantity,
        'totalMonthSell'=>$totalMonthSell
        ));
		
	}
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Master::redirect('login');
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sellerProfile(Request $request)
    {

        // $user = User::with('Seller')->find(Auth::user()->id)->get();
          $seller = array();
          $district = "";
          $location_id  = "";
          $districtName = ""; 
          $stateName    = "";
          $locationName = "";
          $location  = "";
          $pincode  = "";
        if ($request->isMethod('post')) {
            $data=$request->all();
            $stateName    = $request->get('state');
            $districtName = $request->get('district');
            $locArr = explode('-',$request->get('location'));
            $locationName = end($locArr);
            $pincode = $request->get('pincode');
            $location  = $request->get('location');
			      
            $data['user_id']=Auth::user()->id;
            $validator = $this->validator($request->all());
            if($validator->fails()) {
                $error=$validator->errors()->all();
                Session::flash('error', $error);

            }else{
                  $image = $request->file('logo');
                  IF(!empty($image)){
                      $this->imageName=$this->saveLogo($request);
                      //$this->imageName=$this->saveImage($image);
                  }
                  if(array_key_exists('id',$data) && ($data['id']>0)){
                      $this->updateSeller($data);
                  }else{
                      $this->createSeller($data);
                  }
            }
        }
        //Get all the District From State
        $district = Location::getAllDistrictByState($request->get('state'));
        //Get All the Location Of the Disti
        $location = Location::getAllLocationByDistrict(ucwords(str_replace('-',' ',$request->get('district'))));
          
        try{
            $sellerArr=Seller::where('user_id','=',Auth::user()->id)->get();
            if(count($sellerArr)){
              foreach($sellerArr as $obj){
                $seller = $obj;
              } 
              //dd($seller);
              $location_id  = $seller['location_id'];
              $stateName = strtolower($seller['state']);
              $districtName = strtolower(str_replace(' ','_',$seller['district']));
              $locationName = strtolower(str_replace(' ','_',$seller['location']));

              //Get all the District From State
              //dd($seller['state']);
              $district = Location::getAllDistrictByState($seller['state']);

              //Get All the Location Of the Disti
              $location = Location::getAllLocationByDistrict($seller['district']);
            }
       }catch(exception $e){

       }

        $businessType = StoreType::where('status','=',1)->get();

        //Get All State List
        $state = Location::getAllState();

        $cityObj = new City();
        $city =$cityObj->getAllCity();
        
        // dd($seller);
        //echo $stateName;die;
        //echo $districtName;die;
        return view(Master::loadFrontTheme('seller.profile'),array(
            'user'=>$seller,
            'stateList'=>$state,
            'district'=>$district,
            'location_id'=>$location_id,
            'districtName'=>$districtName,
            'stateName'=>$stateName,
            'locations'=>$location,
            'locationName'=>$locationName,
            'pincode'=>$pincode,
            'cityList'=>$city,
      			'businessType'=>$businessType)
        );
    }
    
    
    function saveLogo($request){
      if ($request->hasFile('logo')) {
            $image      = $request->file('logo');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $directoryName = 'seller';
            //120X120
            $thubmName = '250X250';
            $img->resize(250, 250, function ($constraint) {
                $constraint->aspectRatio();                 
            });
            $img->stream(); // <-- Key point
            $res = Storage::disk('public')->put('uploads/'.$directoryName.'/'.$thubmName.'/'.$fileName, $img, 'public');
            return $fileName;
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
        if(in_array(strtolower($ext),config('global.IMG_EXT'))){
            $destinationPath = $this->uploadThumbDir;
            $img = Image::make($image->getRealPath());
            $destinationPath . '/' . $this->imageName;
            $img->resize($this->thumbWidth, $this->thumbHeight, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $this->imageName);
            $destinationPath = $this->uploadLogoDir;
            $image->move($destinationPath, $this->imageName);
            return $this->imageName;
        }else{
            Session::flash('message', 'Invalid File Extension!');
            return Redirect::back()->with('msg', 'Invalid File Extension!');
        }
    }
	
	
	
	public function sellerImages(Request $request){
		$sellerImage=SellerImage::where('user_id','=',Auth::user()->id)->get();
		return view(Master::loadFrontTheme('seller.profileimage'),array('userProduct'=>$sellerImage));
	}
    

    /*
     *@Author: Pradeep Kumar
     *
     *
     *
     */
    public function saveBusinessCoverImages($request,$sellerId){
      $image      = $request->file('file');
      $fileName   = md5(time()) . '.' . $image->getClientOriginalExtension();
      $img = Image::make($image->getRealPath());
      $directoryName = 'seller/'.$sellerId;
      $thubmName = $this->thumbHeight.'X'.$this->thumbWidth;
      $img->resize($this->thumbWidth, $this->thumbHeight, function ($constraint) {
          $constraint->aspectRatio();                 
      });
      $img->stream(); // <-- Key point
      $res = Storage::disk('public')->put('uploads/'.$directoryName.'/'.$thubmName.'/'.$fileName, $img, 'public');


      $imgName = $this->Width.'X'.$this->Height;
      $img->resize($this->Width, $this->Height, function ($constraint) {
          $constraint->aspectRatio();                 
      });
      $img->stream(); // <-- Key point
      $res = Storage::disk('public')->put('uploads/'.$directoryName.'/'.$imgName.'/'.$fileName, $img, 'public');

      return $fileName;
    }
	
	
	
	/**
     * @Author: Pradeep Kumar   
     * @Description: To Get the product in edit mode
     */
    public function addSellerImg(Request $request){
		
      if ($request->isMethod('post')) {
            $image = $request->file('file');
			//Get Seller Id
			$seller = Seller::where('user_id','=',Auth::user()->id)->first();
			//dd(Auth::user()->id);
			if(!empty($seller)){ 
				SellerImage::where('user_id','=',Auth::user()->id)->where('seller_id','=',$seller['id'])->update(array('is_default' => '0'));
				$this->uploadLogoDir=config('global.SELLER_UPLOAD_DIR').DIRECTORY_SEPARATOR.$this->getSellerImageDirName($seller['id']);
				$this->uploadThumbDir=config('global.SELLER_UPLOAD_DIR').DIRECTORY_SEPARATOR.$this->getSellerImageDirName($seller['id']);
        //$this->imageName=$this->saveImage($image);
				$this->imageName=$this->saveBusinessCoverImages($request,$seller['id']);
				$sellerImgObj= new \App\SellerImage();
				$sellerImgObj->image_name=$this->imageName;
				$sellerImgObj->user_id=Auth::user()->id;
				$sellerImgObj->seller_id=$seller['id'];
				$sellerImgObj->is_default=1;
				$sellerImgObj->save();
				$this->imageName="";
				
			}
        }
        $sellerImages=SellerImage::where('user_id','=',Auth::user()->id)->where('seller_id','=',$seller['id'])->get();
	    return view(Master::loadFrontTheme('seller.profileimage'),array(
		'userProduct'=>$sellerImages));
    }
	
	

	
	
	private function getSellerImageDirName($id){
        return 'seller_'.$id;
    }
	
	
   
    
    
    
     /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Seller
     */
    protected function updateSeller(array $data)
    {
        $seller= \App\Seller::find($data['id']);
        if($this->imageName!=NULL){
            $image_thumb=$this->imageName;
        }else{
            $image_thumb=(!empty($seller))?$seller->image_thumb:NULL;
        }
        
        if($this->imageName!=NULL){
            $image_logo=$this->imageName;
        }else{
            $image_logo=(!empty($seller))?$seller->image_logo:NULL;
        }


        if($seller->user_id==$data['user_id']){
            $username = "";
            if(preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $data['businessusername'])){
                $username = $data['businessusername'];
            }else{
                $username = str_replace(" ", "", $data['businessusername']);
            }

            $seller->store_type_id =$data['store_type_id'];
            $seller->business_name =$data['business_name'];
            $seller->businessusername =$username;
            $seller->address_1 =ucwords(strtolower($data['address_1']));
            $seller->address_2 =ucwords(strtolower($data['address_2']));
            $seller->state =ucwords(strtolower($data['state']));
            $seller->district =ucwords(str_replace("_"," ",strtolower($data['district'])));
            $locationArr = explode("|",$data['location']);
            $seller->location =end($locationArr);
            $seller->pincode =$data['pincode'];
            if(array_key_exists('location_id', $data)){
              $seller->location_id =$data['location_id'];
            }
            $seller->contact_number =$data['contact_number'];
            $seller->email_address =$data['email_address'];
            $seller->image_thumb =$image_thumb;
            $seller->image_logo =$image_logo;
        }
        try{
            if($seller->save()){
               Session::flash('message', 'Seller Profile Updated Successfully!'); 
            }else{
                Session::flash('message', 'Seller Profile Not Updated !'); 
            }
        }catch(QueryException  $exception)
        {
            $errormsg = 'Database error! ' . $exception->getCode();
            dd($errormsg);
        }
    }



     /**
     * Create a new seller instance after a valid data.
     * @param  array  $data
     * @return \App\Seller
     */
    protected function createSeller(array $data)
    {

        try{
            $locationArr = explode("-",$data['location']);
            //Save Business Username
            // validate alphanumeric
            $username = "";
            if(preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $data['businessusername'])){
                $username = $data['businessusername'];
            }else{
                $username = str_replace(" ", "", $data['businessusername']);
            }

            $seller=Seller::create([
                'store_type_id' => $data['store_type_id'],
                'business_name' => $data['business_name'],
                'businessusername' => $username,
                'address_1' => $data['address_1'],
                'state' => $data['state'],
                'district' => ucwords(str_replace('_',' ',$data['district'])),
                'location' => end($locationArr),
                'pincode' => $data['pincode'],
                'location_id' => $data['location_id'],
                'contact_number' => $data['contact_number'],
                'email_address' => $data['email_address'],
                'user_id' => Auth::user()->id,
                'image_logo'=>$this->imageName,
                'image_thumb'=>$this->imageName,
            ]);
            Session::flash('message', 'Seller Profile Updated Successfully!'); 
            //Send Welcome Message to Seller
            //$this->sendWhatsappMessage('newSeller',$seller);

            //Send Email to Seller
            Master::sendEmailToSeller('newSeller',$seller);

            //Log For New Seller 
            Log::channel('newuser')->info('New Seller', array(
              'Name'=>$seller['business_name'],
              'BusinessURl'=>env('APP_URL').'/seller/'.$seller['businessusername'],
              'Date'=>$seller['created_at']
            )); 

        }catch(QueryException  $exception){
            $errormsg = 'Database error! ' . $exception->getCode();
            dd($errormsg);
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
        $user= \App\Seller::find(Auth::user()->id);
        return Validator::make($data, [
            'business_name' => 'required|string|min:1',
            'businessusername' => 'required|string|min:6|unique:sellers,businessusername,'.$data['id'],
            'address_1'=>'required|string|max:255',
            'country_id' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'pincode' => 'required|string|min:6',
            'contact_number' => 'required|string|min:10',
            'email_address' => 'required|string|min:10|unique:sellers,email_address,'.$data['id']
        ]);
    }
	
	
	
	
	public function deleteSellerImage(Request $request,$id){
        $product = \App\SellerImage::findOrFail($id);
        $product->delete();
        Session::flash('flash_message', 'Seller Image successfully deleted!');
        return redirect()->back();
    }
    
     public function setSellerImageAsDefault(Request $request,$prod_id,$id){
        $product = \App\SellerImage::where('user_id','=',$prod_id)->update(['is_default'=>0]);
        $product = \App\SellerImage::where('id','=',$id)->update(['is_default'=>1]);
        Session::flash('flash_message', 'Seller Image successfully updated!');
        return redirect()->back();
    }
    
    
    
    public function hideSellerImage(Request $request,$id){
        $product = \App\SellerImage::where('id','=',$id)->update(['status'=>0]);
        Session::flash('flash_message', 'Seller Image successfully updated!');
        return redirect()->back();
    }
    
    public function showSellerImage(Request $request,$id){
        $product = \App\SellerImage::where('id','=',$id)->update(['status'=>1]);
        Session::flash('flash_message', 'Seller Image successfully updated!');
        return redirect()->back();
    }


}
