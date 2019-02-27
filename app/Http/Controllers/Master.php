<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Darryldecode\Cart\CartCondition;

//use App\Helpers;


use Auth;
use File;
use Session;
use Config;
use App\Location;
use Log;
use App\Seller;


class Master extends Controller {

    public $default_lang='en';
	public $session_wid ='';
    protected $responseArray = array();

    /*
     * @Get Session Language Code
     */
    public static function getLangCode(){
        return Session::get('lang_code');
    }

    public static function getCreatedDate(){
        return date('Y-m-d H:i:s');
    }

    public static function getRefererCode(){
     return strtoupper(substr(md5(uniqid(rand(time(),time()), true)),0,8));   
    }

    public static function getMetaTags(){
        $meta = [
            'description'=>'',
            'keywords'=>'',
            'pageimage'=>'',
            'pageurl'=>'',
            'publishedTime'=>'',
            'modifiedTime'=>'',
            'section'=>'',
            'category'=>'',
            'tag'=>'',
            'article'=>'',
            'twittersite'=>'',
            'urlimage'=>'',
            'title'=>'',
            'url'=>'',
            'sitename'=>''
        ];

        return $meta;
    }

    public static function getLogo(){
        //$img = 'cat/images.jpeg';
        $img = 'logo1.png';
        $img = 'go4shop.online.jpg';
        return self::getURL().'/public/theme/prssystem/img/front/'.$img;
    }


    public static function getURL(){
        return env('APP_URL');
    }

    public static function getAppName(){
        return env('APP_NAME');
    }


    public static function getPageItem($pageItem=NULL){
        if($pageItem>0){
            return 250;
        }else{
            return env('PER_PAGE_ITEM');
        }
    }


    public function setMetaTags($meta,$value){

    }


    public static function getMessage($code,$msg){
        $responseArray = array();
        $responseArray['code'] = $code;
        switch ($code) {
            case '200':
                # code...
                $responseArray['status'] = true;
                $responseArray['message'] = $msg;
                return $responseArray;
                break;
            case '500':
                # code...
                $responseArray['status'] = false;
                $responseArray['message'] = $msg;
                return $responseArray;
                break;
            
            default:
                $responseArray['status'] = false;
                $responseArray['message'] = $msg;
                return $responseArray;
                break;
        }

    }

 /**
     *@Author: Pradeep Kumar
     *@Description: Login Authentication Page
     */
    public static function isValidToekn($request){
        $parameters = $request->all();
        $str='';
        $token='';
        if(!empty($parameters)){
            foreach($parameters as $key=>$val){
                if($key!='token'){
                    $str.=$val.'|'; 
                }else{
                    $token = $val;
                }
            }
           //echo $str.config('global.CLIENT_SECRET');
           $serverTotak = md5($str.config('global.CLIENT_SECRET')); 
            if($token==$serverTotak){
                return true;
            }else{
                return true;
            }
        }else{
            return true;
        }
    }


    /*
     * @Get Redirect With Lang
     */
    public function redirect($pageName){
        $redirectName='';
        if(Session::get('lang_code')){
            $getLangCode=Session::get('lang_code');
        }else{
            $default_lang = \App\Model\Language::getDefaultLanguge();
            $getLangCode = $default_lang->languageCode;
            Session::put('lang_code',$getLangCode);
        }
        if(Auth::check()){
            if(Auth::user()->user_type=='1001'){
                $redirectName=$getLangCode.'/admin/'.$pageName;    
            }else{
                $redirectName=$getLangCode.'/'.$pageName;    
            }
            
        }else{
            $redirectName=$getLangCode.'/'.$pageName;    
        }
        return redirect($redirectName);
    }






    
    /*
     * @Get All the System configuration
     */
    public function systemConfig($system_name=null) {
        $system_val = '';
        if(!empty($system_name)){ 
            $system = \App\SystemConfig::select('system_val')->where('system_name','=', $system_name)->first();
            $system_val = $system->system_val;
        }  
        return $system_val;         
    } 

 

    /*
     * @Get load the theme
     */
    public static function loadFrontTheme($path) {
        if(session('default_theme') == null){
            $default_theme = \App\SystemConfig::getSystemVal('DEFAULT_THEME');
            \Session::put('default_theme', $default_theme);
        }
        return session('default_theme').'.'.$path;
    }


    function getConfiguration($type) {
   
        $conf_lists = \App\SystemConfig::getSystemConfig($type); 
        $conf_lists = $conf_lists->toArray();
        foreach($conf_lists as $val) {            
            $config_arr[$val['system_name']] = $val['system_val'];
        }
        //echo '<pre>';print_r($config_arr);die;
        return $config_arr;
    }



    public static function Render($name){
        return view('admin.'.$name);

    }

    public function getCityList(Request $request,$state_name){
        $stateList = Location::where('state','=',$state_name)->get();
        if(!empty($stateList)){
            $district = "<option value='-1'>--Choose District--</option>";
            foreach($stateList as $data){
                $city[$data->district][]=array('location'=>$data->location,'Pincode'=>$data->pincode);

            }
            foreach($city as $districtName=>$valArr){
                $district.="<option value='".str_replace(" ", "_", strtolower($districtName))."'>".$districtName."</option>";
            }
            return $district; 
        }
    } 


    public function getlocationlist(Request $request,$district){
        $city = array();
        if($district!=''){
            $district = str_replace("_", " ",ucwords($district));
            $districList = Location::where('district','=',$district)->get();
            if(!empty($districList)){
                $location = "<option value='-1'>--Choose Location--</option>";
                foreach($districList as $data){
                    $city[$data->location]=$data->pincode;
                    $location.="<option value='".$data->id.'|'.$data->pincode.'|'.$data->location."'>".$data->location."</option>";
                }
                
                return $location; 
            }
        }
    } 







    /*Send All Email To User*/
    public static function sendEmailToUser($type,$request, $data){
        $Email = new EmailController();
        switch($type){
            case 'newUser':
                    $Email::sendNewUserRegister($request, $data);
                    break;
            default: break;
        }
    }



    /*Send All Email To Seller*/
    public static function sendEmailToSeller($type, $data){
        $Email = new EmailController();
        switch($type){
            case 'newSeller':
                    $Email::sendWelcomeSellerEmail($data);
                    break;
            default: break;
        }
    }





    /*Send All Notification*/
    public function sendWhatsappMessage($type,$data){
        $notify = new NotificationController();
        switch($type){
            
            case 'newUser':
                    $notify::sendWelcomeMessage($data);
                    break;

            case 'newSeller':
                    $notify::sendWelcomeMessageAsSeller($data);
                    break;

            case 'paymentConfirmation':
                    $notify::sendPaymentConfirmationToUser($data);
                    break;

            case 'orderConfirmation':
                    $notify::sendOrderConfirmationToUser($data);
                    break;

            case 'orderRecivedSeller':
                    $notify::sendOrderConfirmationToSeller($data);
                    break;

            default: break;
        }
    }




    public static function getSeller(){
        $sellerArr = Seller::where('user_id','=',Auth::user()->id)->first();
        return $sellerArr;
    }




}
