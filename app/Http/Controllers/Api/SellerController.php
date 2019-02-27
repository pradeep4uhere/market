<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Master;
use Auth;
use App\User;
use App\Seller;
use Session;
use App\City;
use App\DeliveryAddress;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\SaleUser;
use DB;
use App\UserProduct;


class SellerController extends Master
{

    protected $perPageItem = '2';

    public function __construct(){
        $this->perPageItem = 2;
    }
     
    //Get All Product List Of the Seller
     /**
     *@Author       : Pradeep Kumar
     *@Description  : PRoduct List API 
     *@Created Date : 27 Dec 2018
     */
    public function allSellerProductList(Request $request){
        $seller_id = $request->get('seller_id');
        if($seller_id>0){
            $seller = Seller::find($seller_id);
            if(empty($seller)){
                $responseArray['status'] = false;
                $responseArray['message'] = "Seller not found";
                return response()->json($responseArray);
            }

        }else{
            $responseArray['status'] = false;
            $responseArray['message'] = "Invalid Seller Id Request";
            return response()->json($responseArray);

        }



        try{
            $page = $request->get('page');
            $allProduct = UserProduct::select('id','user_id','seller_id','product_id','product_sku','default_images','default_thumbnail','quantity_in_unit','product_in_stock','quantity','default_price','isDiscounted','price','discountType','discount_value','status')->with('Product')->where('seller_id','=',$seller_id)->paginate($this->perPageItem)->toArray();
            $productArray= array();
            //Formate All the Product Array
            if(array_key_exists('total', $allProduct)){
                if($allProduct['total']>0){
                    foreach ($allProduct['data'] as $key => $value) {
                        $productArray[$key]['productDetails']['id'] = $value['id'];
                        $productArray[$key]['productDetails']['user_id'] = $value['user_id'];
                        $productArray[$key]['productDetails']['seller_id'] = $value['seller_id'];
                        $productArray[$key]['productDetails']['product_id'] = $value['product_id'];

                        // Data From Main Product
                        $productArray[$key]['productDetails']['name'] = $value['product']['title'];
                        $productArray[$key]['productDetails']['description'] = $value['product']['description'];

                        //Category
                        $productArray[$key]['productDetails']['categoryId'] = $value['product']['category']['id'];
                        $productArray[$key]['productDetails']['categoryName'] = $value['product']['category']['name'];

                        $productArray[$key]['productDetails']['subCategoryId'] = $value['product']['sub_category']['id'];
                        $productArray[$key]['productDetails']['subCategoryName'] = $value['product']['sub_category']['name'];

                        $productArray[$key]['productDetails']['brandId'] = $value['product']['brand']['id'];
                        $productArray[$key]['productDetails']['brandName'] = $value['product']['brand']['name'];

                        $productArray[$key]['productDetails']['unitId'] = $value['product']['unit']['id'];
                        $productArray[$key]['productDetails']['unitName'] = $value['product']['unit']['name'];

                        $productArray[$key]['productDetails']['product_sku'] = $value['product_sku'];
                        $productArray[$key]['productDetails']['default_images'] = $value['default_images'];
                        $productArray[$key]['productDetails']['default_thumbnail'] = $value['default_thumbnail'];
                        $productArray[$key]['productDetails']['quantity_in_unit'] = $value['quantity_in_unit'];
                        $productArray[$key]['productDetails']['product_in_stock'] = $value['product_in_stock'];
                        $productArray[$key]['productDetails']['quantity'] = $value['quantity'];
                        $productArray[$key]['productDetails']['default_price'] = $value['default_price'];
                        $productArray[$key]['productDetails']['isDiscounted'] = $value['isDiscounted'];
                        $productArray[$key]['productDetails']['price'] = $value['price'];
                        $productArray[$key]['productDetails']['discountType'] = $value['discountType'];
                        $productArray[$key]['productDetails']['discount_value'] = $value['discount_value'];
                        $productArray[$key]['productDetails']['status'] = $value['status'];
                    }
                    $productArray['first_page_url'] = $allProduct['first_page_url'];
                    $productArray['from']           = $allProduct['from'];
                    $productArray['last_page']      = $allProduct['last_page'];
                    $productArray['last_page_url']  = $allProduct['last_page_url'];
                    $productArray['next_page_url']  = $allProduct['next_page_url'];
                    $productArray['path']           = $allProduct['path'];
                    $productArray['per_page']       = $allProduct['per_page'];
                    $productArray['prev_page_url']  = $allProduct['prev_page_url'];
                    $productArray['to']             = $allProduct['to'];
                    $productArray['total']          = $allProduct['total'];


                    $responseArray['status'] = true;
                    $responseArray['result'] = $productArray;
                }else{
                    $responseArray['status'] = false;
                    $responseArray['message'] = "No products added by this seller";
                }


            }else{
                $responseArray['status'] = false;
                $responseArray['message'] = "Invalid Request";
            }

        }catch(Exception $e){
            $responseArray['status'] = false;
            $responseArray['message'] = "Invalid Seller";

        }

        return response()->json($responseArray);

    }



     /**
     *@Author       : Pradeep Kumar
     *@Description  : Register API 
     *@Created Date : 24 Nov 2018
     */
    public function registerAsSeller(Request $request){
        if(self::isValidToekn($request)){

           $validator = Validator::make($request->all(), [
                'store_type_id' => 'required|numeric',
                'business_name' => 'required|min:6',
                'address_1' => 'required|min:6',
                'address_2' => 'required|min:6',
                'state' => 'required',
                'district' => 'required',
                'location' => 'required',
                'pincode' => 'required|numeric|min:6',
                'location_id' => 'required',
                'contact_number' => 'required|unique:sellers|numeric'
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $responseArray['status'] = false;
                $responseArray['message']= "Input are not valid";
                $responseArray['error']= $errors;
                
                 
            }else{
                 
                try{

                    if ($request->isMethod('post')) {
                        $data = $request->all();

                            if(!self::IsValidRefer($data['referer_code'])){
                                $responseArray['status'] = false;
                                $responseArray['message'] = "Invalid Referer Code.";
                                return response()->json($responseArray);
                            }
                            $seller=Seller::create([
                                'store_type_id' => $data['store_type_id'],
                                'business_name' => $data['business_name'],
                                'referer_code' => $data['referer_code'],
                                'address_1' => $data['address_1'],
                                'state' => $data['state'],
                                'district' => $data['district'],
                                'location' => $data['location'],
                                'pincode' => $data['pincode'],
                                'location_id' => $data['location_id'],
                                'contact_number' => $data['contact_number'],
                                'email_address' => $data['email'],
                                'user_id' => decrypt($data['uid']),
                                'created_at'=>self::getCreatedDate()
                            ]);
                            $last_insert_id = $seller->id;
                            $userData= User::select('first_name','last_name','email','mobile')->find(decrypt($data['uid']));

                            //Get Seller Details
                            $sellerDetails = Seller::find($last_insert_id);
                            $responseArray['status'] = true;
                            $responseArray['message']= "User register as seller Account successfully.";
                            $responseArray['data']['Seller'] = $sellerDetails;
                            $responseArray['data']['User'] = $userData;
                            //Send Email to User For His Seller Account
                            if($last_insert_id){
                                $this->sendEmail($last_insert_id,$data);
                            }

                            //Check this user has Seller Account
                            $sellerProfile = Seller::where('user_id','=',decrypt($data['uid']))->get();
                            if($sellerProfile->count()){
                                $sellerArr=array();
                                foreach($sellerProfile as $sellerObj){
                                    $sellerDetails = Seller::find($sellerObj['id']);
                                    $sellerArr[] = $sellerDetails;
                                }
                                $userData['totalSellerAccount'] = count($sellerArr);
                                $responseArray['data']['User'] = $userData;
                                $responseArray['data']['User']['Seller'] = $sellerArr;
                            }
                            $responseArray['data']['uid'] = $data['uid'];
                            $responseArray['data']['sid'] = encrypt($last_insert_id);
                        

                    }
                    
                }catch (Exception $e) {
                    $responseArray['status'] = false;
                    $responseArray['message'] = $e->getMessage();
                }
            }

        }else{
            $responseArray['status'] = false;
            $responseArray['message'] = "Invalid Token";
        }
        return response()->json($responseArray);
    }






    private static function IsValidRefer($referer_code){
        if($referer_code!=''){
            $count= SaleUser::where('referer_code','=',$referer_code)->get()->count();
            if($count>0){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }

    }


    /**
     * Send an e-mail confirmation to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function sendEmail($last_insert_id,$data)
    {   
        $seller = Seller::findOrFail($last_insert_id);
        $business_name  = $data['business_name'];
        $contact_number = $data['contact_number'];
        $email_address  = $data['email'];
        $url  = "http;//www.google.com";
        $body1 = "You have successfully registered .";
        $body2= "Thank you for joining with us.";
        $mail = Mail::send('Email.seller.register', [
            'name' => $business_name,
            'body1' => $body1,
            'business_name' => $business_name,
            'contact_number' => $contact_number,
            'email_address' => $email_address,
            'body3' => $body2,
            'url'  => $url ,
            'copyright' => 'copyright'
            ], function ($m) use ($seller) {
                $m->from('support@grabmorenow.com', 'Your Seller Account Created!');
                $m->to($seller->email_address, ucwords(strtolower($seller->business_name)))->subject('Your Seller Account Created!');
            });
        if($mail){
            return true;
        }
    }




    /****Get All the Seller List Based On Location**/
    public function getSellerList(Request $request){
        $state          =   $request->get('state');
        $district       =   $request->get('district');
        $location       =   $request->get('location');
        $location_id    =   $request->get('location_id');
        $pincode        =   $request->get('pincode');
        $offset         =   $request->get('offset');
        if($request->has('offset')){
            $num = $offset;
        }else{
            $num = 9999;
        }
        
        $data = DB::table('sellers')->where('sellers.status', '=', '1');
        
        //Join with Seller Image Table
        $data->leftJoin('seller_images', 'sellers.id', '=', 'seller_images.seller_id');

        //Join with Store Type Table
        $data->leftJoin('store_types', 'sellers.store_type_id', '=', 'store_types.id');
        
        $data->select(
            'sellers.id',
            'sellers.user_id',
            'sellers.business_name',
            'sellers.address_1',
            'sellers.address_2',
            'sellers.state',
            'sellers.district',
            'sellers.location',
            'sellers.location_id',
            'sellers.pincode',
            'sellers.contact_number',
            'sellers.email_address',
            'sellers.status',
            'sellers.image_thumb',
            'sellers.image_logo',
            'seller_images.image_name',
            'seller_images.is_default',
            'store_types.name as StoreName',
            'store_types.descriptions as StoreDescription');
        
        if($location_id!=''){                
            $data->Where('location_id',   '=', $location_id);
        }
        if($state!='' && $location_id==''){            
            $data->Where('state',      'like', '%'.$state.'%');
        }
        if($location!='' && $location_id==''){            
            $data->where('location',     'like', '%'.$location.'%');
        }
        if($pincode!='' && $location_id==''){            
            $data->Where('pincode',    'like', '%'.$pincode.'%');
        }
        if($district!='' && $location_id==''){                
            $data->Where('district',   'like', '%'.$district.'%');
        }
        
        $data->orderBy('sellers.business_name', 'asc');
        //$data = $data->get();
        $data = $data->paginate($num);
        $total_row = $data->count();
        $output=array();
        if($total_row > 0){
            foreach($data as $k=>$row){
                $row->publicUrl = env('APP_URL').'/seller/'.str_slug($row->business_name).'/'.encrypt($row->id);
                $output[]=$row;
            }
            $responseArray['status'] = true;
            $responseArray['misc']['count'] = $data->count();
            $responseArray['misc']['firstItem'] = $data->firstItem();
            $responseArray['misc']['currentPage'] = $data->currentPage();
            $responseArray['misc']['hasMorePages'] = $data->hasMorePages();
            $responseArray['misc']['lastItem'] = $data->lastItem();
            $responseArray['misc']['nextPageUrl'] = $data->nextPageUrl();
            $responseArray['misc']['onFirstPage'] = $data->onFirstPage();
            $responseArray['misc']['perPage'] = $data->perPage();
            $responseArray['misc']['previousPageUrl'] = $data->previousPageUrl();
            $responseArray['result'] = $output;


        }else{
            $responseArray['status'] = false;
            $responseArray['message'] = "No result found.";
        }
        return response()->json($responseArray);

    }




}