<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use App\UserProduct;
use App\Seller;
use App\Location;
use App\Pin;
use App\Cart;
use App\Testimonial;
use App\StoreType;


class HomeController extends Master
{


	function notification(Request $request){
		

	}
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		//dd($this->session_wid);
		$this->getCartItemList();
		//echo session('sessionId'); die;
    }
	
	
	
	private function getCartItemList(){
		$cartItem=array();
        //Get All the Cart List
        $sessionId=session()->get('session_id');
//		dd($sessionId);
		$cartId="";
		if($cartId!=''){
			$cartObj=Cart::find($cartId)->with('CartItem')->first();
		}else{
			$cartObj=Cart::where('session_id','=',$sessionId)->with('CartItem')->first();
		}
		
		
        if(!empty($cartObj)){
            foreach($cartObj->CartItem as $item){
                $cartItem[]= CartItem::with(['UserProduct','Seller'])->find($item['id']);
            }
			session(['cart_id' => $cartObj->id]);
        }
		session(['countItem' => count($cartItem)]);
		return $cartItem;
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
    	//$this->sendWhatsappMessage('paymentConfirmation',6);
    	//$this->sendWhatsappMessage('orderConfirmation',6);
    	//$this->sendWhatsappMessage('orderRecivedSeller',6);
    	//die;
    	$metaTags = self::getMetaTags();
		$this->saveZipcode();
//         if(Auth::check()){
//            return $this->redirect('profile');
//         }else{
//             return view(Master::loadFrontTheme('home.index'));
//         }
		//Get All Category and Sub Category List
		
		$catObj = new \App\Category();
		$catArr=$catObj->getAllCategory();
		foreach($catArr as $obj){
			//$catJson[]=$obj;
		}
		//Get All Cities
		$city = new \App\City();
		$cityArrObj=$city->getAllCity();
		foreach($cityArrObj as $obj){
			$cityArr[]=$obj;
		}
		
		//Get All Cities
		$locArrObj=new Location();
		$locArr =$locArrObj->getAllLocation();
		foreach($locArr as $obj){
			$catJson[]=$obj;
		}
		//Get All Seller List
		$seller = Seller::with('StoreType')->with('SellerImage')->get();
		//dd($seller);


		//Get All the Testimonials
		$testimonials = array();
		$testimonials = Testimonial::with('User')->where('status','=',1)->get()->toArray();


		//Set Meta Section Data
		
        $metaTitle = "Go4Shop- Your Own Online Shop";
        $metaDesc = 'Go4shop offer you to sell your own products online. The best online local near you store in India. Best way buy or sell your products here.';
        $metaKeywords = 'online grocery,vegetable store, Furniture shops, online local seller in Noida, Greater Noida, delhi, buy groceries, vegitables and many more from local shop';
        $pageImage = self::getLogo();
        $pageUrl = self::getURL();
        $section      = 'Buy and Sell';
        $category     = 'Online Supermarket';
        $tag          = 'Online, Supermarket,Seller, Buyer';
        $article      = 'Near Online Supermarket';

        $metaTags['title']        =$metaTitle;
        $metaTags['description']  =$metaDesc;
        $metaTags['keywords']     =$metaKeywords;
        $metaTags['pageimage']    =$pageImage;
        $metaTags['pageurl']      =$pageUrl;
        $metaTags['section']      =$section;
        $metaTags['category']     =$category;
        $metaTags['tag']          =$tag;
        $metaTags['article']      =$article;
        $metaTags['twittersite']  ='';
        $metaTags['urlimage']     =$pageImage;
        $metaTags['url']          =$pageUrl.'/user/register';
        $metaTags['sitename']     =self::getAppName();

        //Get All Features Products From Different Vendor
        $productsList = UserProduct::where('status','=',1)->orderBy('id')->paginate(self::getPageItem());


        return view(Master::loadFrontTheme('frontend.index'),array(
		'catJson'=>json_encode($catJson),
		'cityArr'=>json_encode($cityArr),
		'sellerArr'=>$seller,
		'Testimonials'=>$testimonials,
		'metaTags'=>$metaTags,
		'productList'=>$productsList
		));
    }
    
    
    
    
    public function listing(Request $request) {
    	//dd($request->all());
    	/*
    	array:3 [▼
		  "_token" => "WaSq1cowbym96kDnHE80qmNdmWGjCOybAnMMbmrf"
		  "place" => "Bisrakh Gautam Buddha Nagar 201301 Uttar Pradesh"
		  "locationId" => "18"
		]
		*/

		$locationId = $request->get('locationId');
		$cat = $request->get('place');
		$locationObj = Location::find($locationId)->toArray();
		if(!empty($locationObj)){
			$locationStr = $locationObj['location'];
			$pincode = $locationObj['pincode'];
			$state = $locationObj['state'];
			$district = $locationObj['district'];
		}

		//Get all the Seller in Nearrest Pincode
		$allSeller = Seller::where('pincode', 'LIKE', "%$pincode%")
		->where('location', 'LIKE', "%$locationStr%")
		->where('district', 'LIKE', "%$district%")
		->where('state', 'LIKE', "%$state%")
		->orderBy('business_name')
		->groupBy('id')
		->get();

		$catObj = new \App\Category();
		$catArr=$catObj->getAllCategory();
		foreach($catArr as $obj){
			$catJson[]=$obj;
		}

		//Get All Store Type
		$storeList = StoreType::where('status','=',1)->orderBy('name')->get();
		
        //dd($lsitArr);	
		//URL of the get the location of the user
		return view(Master::loadFrontTheme('seller.sellerListing'),array(
			'sellerArr'=>$allSeller,
			'Category'=>$storeList,
			'searchCat'=>$cat
			)
		);
    }
    
    /*Not In Used Right Now*/
    public function listingProductsFromAllSeller(Request $request) {
		$cat=$request->get('place');
		//Get Location
		if($cat!=""){
			try{
				$locationArr = explode(" ", $cat);
				if(!empty(end($locationArr))){
					$pincode=str_replace('(', '',end($locationArr));
					$pincode=str_replace(')', '',$pincode);
				}else{
					$pincode="";
				}
			}catch (Exception $e) {
            	$pincode='';
        	}
		}else{
			$pincode='';
		}
		//Get All the Seller List From this Pincode
		$allSeller = Seller::where('pincode','=',$pincode)->get();
		dd($allSeller);
        //Get All Product List
        $userProduct = new UserProduct();
		$param=array();
		if($category_id>0){
			$param['category_id']=$category_id;
		}
		//dd($param);
        $lsit=$userProduct->getAllList($param);
		//dd($lsit);
		//Get All Category and Sub Category List
		$catObj = new \App\Category();
		$catArr=$catObj->getAllCategory();
		foreach($catArr as $obj){
			$catJson[]=$obj;
		}
		
		$lsitArr=array();
		if(!empty($lsit)){
			foreach($lsit as $key=>$obj){
			$lsitArr[]=array(
				'UserProduct'=>$obj,
				'Product'=>$obj->product,
				'Seller'=>$this->getSellerInfo($obj['user_id'])
				);    
			}
		}
        //dd($lsitArr);	
		//URL of the get the location of the user
		return view(Master::loadFrontTheme('frontend.listing'),array(
		'productList'=>$lsitArr,
		'Category'=>$catJson,
		'searchCat'=>$cat)
		);
    }

    public function login() {
         return Master::Render('login.login');
    }
    
    public function getSellerInfo($user_id){
        return Seller::where('user_id','=',$user_id)->first();
    }
	
	public function getLocationByLatLng($lat,$lng){
		if(($lat!='') && ($lng!='')){
			$url="http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$lng."&sensor=false";
			$result = file_get_contents($url);
			// Will dump a beauty json :3
			$address=json_decode($result, true);
			dd($address);
			$formateAdd=array();
			$pincodeObj = array();
			$i=0;
			if(array_key_exists('results',$address)){
				foreach($address['results'] as $addressArr){
				if($i==0){
					foreach($addressArr['address_components'] as $v){
					$type=$v['types'][0];
					switch($type){
						case 'locality':
							$pincodeObj['locality']=$v['long_name'];
							break;
						case 'political':
							$pincodeObj['political']=$v['long_name'];
							break;
						case 'administrative_area_level_2':
							$pincodeObj['administrative_area_level_2']=$v['long_name'];
							break;
						case 'administrative_area_level_1':
							$pincodeObj['administrative_area_level_1']=$v['long_name'];
							break;
						case 'country':
							$pincodeObj['country']=$v['long_name'];
							break;
						case 'postal_code':
							$pincodeObj['postal_code']=$v['long_name'];
							break;
					}
				}
					$pincodeObj['formatted_address']=$address['results'][0]['formatted_address'];
					}
					$i++;
				}
			}
			return $pincodeObj;
		}
	}
	
	
	public function savePincodeData($arr,$lat,$lng){
		$pincodeObj = new \App\Pincode();
		if(array_key_exists('locality',$arr)){
			$pincodeObj->locality=$arr['locality'];
		}
		if(array_key_exists('political',$arr)){
			$pincodeObj->political=$arr['political'];
			$pincodeObj->place_name=$arr['political'];
		}
		$pincodeObj->administrative_area_level_2=$arr['administrative_area_level_2'];
		$pincodeObj->administrative_area_level_1=$arr['administrative_area_level_1'];
		$pincodeObj->admin_code1='100';
		$pincodeObj->country=$arr['country'];
		$pincodeObj->state=$arr['administrative_area_level_1'];
		$pincodeObj->county_province=$arr['administrative_area_level_2'];
		$pincodeObj->postal_code=$arr['postal_code'];
		$pincodeObj->created_at=date('Y-m-d H:i:s');
		$pincodeObj->status=1;
		$pincodeObj->country_code='IN';
		$pincodeObj->latitude=$lat;
		$pincodeObj->longitude=$lng;
		$pincodeObj->formatted_address=$arr['formatted_address'];
		$pincodeObj->save();
	}
	
	
	public function getlocation(Request $request){
		if ($request->isMethod('post')) {
			$lat=$request->get('lat');
			$lng=$request->get('lng');
			//find this lat and lng from database, if found return else
			// Call the APi for location and update the database
			$pincodeArr = Pincode::where(\DB::raw('substr(latitude, 0, 6)'), '=' ,substr($lat,0,6))
			->orwhere(\DB::raw('substr(longitude, 0, 6)'), '=' ,substr($lng,0,6))->first();
			if(!empty($pincodeArr)){
				if(empty($pincodeArr)){
					$this->savePincodeData($res,$lat,$lng);
					$res['place_name']=$pincodeArr['place_name'];
					$res['county_province']=$pincodeArr['county_province'];
					$res['state']=$pincodeArr['state'];
					$res['country']=$pincodeArr['country'];
					$res['postal_code']=$pincodeArr['postal_code'];
				}
			}else{
				$addressArr=$this->getLocationByLatLng($lat,$lng);
				$result['error']='success';
				$res=$addressArr;
				//dd($res);
				$pincodeArr = Pincode::where('postal_code', '=' ,$addressArr['postal_code'])->first();
				if(!empty($pincodeArr)){
					$res['place_name']=$pincodeArr['place_name'];
					$res['county_province']=$pincodeArr['county_province'];
					$res['state']=$pincodeArr['state'];
					$res['country']=$pincodeArr['country'];
					$res['postal_code']=$pincodeArr['postal_code'];
					$res['formatted_address']=$res['place_name'].', '.$res['county_province'].', '.$res['state'].', '.$res['postal_code'].', '.$res['country'];
				}else{
					$this->savePincodeData($res,$lat,$lng);

				}
				
				//return
			}
			$result['data']=$res;
			//dd($res);
			return json_encode($result);
		}
		
	}
	
	public function saveZipcode(){
		
	}
}
