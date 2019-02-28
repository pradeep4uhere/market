<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Controllers\Master;
use App\Http\Controllers\NotificationController;
use Log;
use Session;
use App\Seller;
use App\StoreType;
use App\State;
use App\Location;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   $len =  strlen($data['mobile']);
        if($len>10){
            $data['mobile']= '+91'.substr($data['mobile'],-10);
        }else{
            $data['mobile'] = '+91'.$data['mobile'];
        }
        return User::create([
            'first_name' => ucwords(strtolower($data['first_name'])),
            'last_name' => ucwords(strtolower($data['last_name'])),
            'email' => ucwords(strtolower($data['email'])),
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);
    }
	
	
	
	 // override default register method
    public function register(Request $request) {
        $validator = $this->validator($request->all());
        if (!empty($validator->errors()->all())) {
           return redirect('login')->with('message', 'User Email Address Already Registred with us.');
        }else{
            $user = $this->create($request->all())->toArray();
            //Send Whatsapp Message To User
            Log::channel('newuser')->info('Request', array('Name'=>$user['first_name'],'Date'=>$user['created_at'])); 
            $notify = new NotificationController();
            $notify::sendWelcomeMessage($user);

            //Send Welcome Email To User
            Master::sendEmailToUser('newUser', $request, $user);
            // Sending email, sms or doing anything you want
            //$this->activationService->sendActivationMail($user);
            return redirect('user/thankyou')->with('message', 'We sent a comfirmation email to your email, please click on link inside before login');
        }
        
    }
    // override default register method
   
    
    
    public function thankyou(Request $request) {
        return view(Master::loadFrontTheme('auth.thankyou'));
    }
	
	
	public function registerPage(Request $request) {
        return view(Master::loadFrontTheme('auth.register'));
    }




    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorSeller(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'mobile' => 'required|digits:10',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'store_type' => 'required',
            'state' => 'required',
            'district' => 'required',
            'location' => 'required',
            'pincode' => 'required',
            'address' => 'required',
            'business_name' => 'required',
            'businessusername' => 'required',
            'contact_number' => 'required|digits:10',
            'email_address' => 'required|string|min:6|unique:sellers,email_address',
        ]);
    }


    public function becomeSeller(Request $request){
        if ($request->isMethod('post')) {

            $data = array();
            $sellerData = array();
            $validator = $this->validatorSeller($request->all());
            if($validator->fails()) {
                $error=$validator->errors()->all();
                Session::flash('error', $error);
                foreach($request->all() as $k=>$value){
                    Session::flash($k, $request->get($k));
                }
            }else{

                $data['first_name'] = $request->get('firstname');
                $data['last_name'] = $request->get('lastname');
                $data['mobile'] = $request->get('mobile');
                $data['email'] = $request->get('email');
                $data['password'] = $request->get('password');
                $user = $this->createUser($request,$data);
                $newUserId = $user['id'];
                if($newUserId>0){
                    $dataArr = $request->all();
                    $sellerData['store_type_id'] = $dataArr['store_type'];
                    $sellerData['referer_code'] = $dataArr['referer_code'];
                    $sellerData['business_name'] = $dataArr['business_name'];
                    $sellerData['businessusername'] = $dataArr['businessusername'];
                    $sellerData['address_1'] = $dataArr['address'];
                    $sellerData['state'] = $dataArr['state'];
                    $sellerData['district'] = $dataArr['district'];
                    $sellerData['location'] = $dataArr['location'];
                    $sellerData['pincode'] = $dataArr['pincode'];
                    $sellerData['location_id'] = $dataArr['location_id'];
                    $sellerData['contact_number'] = $dataArr['contact_number'];
                    $sellerData['email_address'] = $dataArr['email_address'];
                    $sellerData['user_id']=$newUserId;
                    $seller = $this->createSeller($sellerData);
                    //Update User Type, Once Seller is Created
                    if($seller['id']>0){
                        $uObj = User::find($newUserId);
                        $uObj->user_type = 2;
                        $uObj->save();
                        Session::flash('message', "Your Profile is created now,Login to visit to your profile.");
                    }
                }else{
                   $error['Error'] = "Somthing Went Wrong";
                   Session::flash('error', $error); 
                }
           }
        }else{

        }
        $businessType = StoreType::where('status','=',1)->get();
        //Get All State List
        $state = Location::getAllState();
        return view('landing.index',array(
            'stateList'=>$state,
            'businessType'=>$businessType
        ));
    }



     /**
         * Get a validator for an incoming registration request.
         *
         * @param  array  $data
         * @return \Illuminate\Contracts\Validation\Validator
         */
        protected function validatorUser(array $data)
        {
            return Validator::make($data, [
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'mobile' => 'required|digits:10',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed'
            ]);
        }
    public function becomeUser(Request $request){
        if ($request->isMethod('post')) {

            $data = array();
            $sellerData = array();
            $validator = $this->validatorUser($request->all());
            if($validator->fails()) {
                $error=$validator->errors()->all();
                Session::flash('error', $error);
                foreach($request->all() as $k=>$value){
                    Session::flash($k, $request->get($k));
                }
            }else{

                $data['first_name'] = $request->get('firstname');
                $data['last_name'] = $request->get('lastname');
                $data['mobile'] = $request->get('mobile');
                $data['email'] = $request->get('email');
                $data['password'] = $request->get('password');
                $user = $this->createUser($request,$data);
                $newUserId = $user['id'];
                if($newUserId>0){
                        Session::flash('message', "Your Profile is created now,Login to visit to your profile.");
                }else{
                   $error['Error'] = "Somthing Went Wrong";
                   Session::flash('error', $error); 
                }
           }
        }else{

        }
        $businessType = StoreType::where('status','=',1)->get();
        //Get All State List
        $state = Location::getAllState();
        return view('landing.createaccount',array(
            'stateList'=>$state,
            'businessType'=>$businessType
        ));
    }




    private function createUser($request,$data){
        $user = $this->create($data);

        //Send Whatsapp Message To User
        Log::channel('newuser')->info('Request', array('Name'=>$user['first_name'],'Date'=>$user['created_at'])); 
        $notify = new NotificationController();
        $notify::sendWelcomeMessage($user);

        //Send Welcome Email To User
        Master::sendEmailToUser('newUser', $request, $user);
        return $user;
    }



    private function createSeller($data){
        $seller=Seller::create([
                'store_type_id' => $data['store_type_id'],
                'business_name' => $data['business_name'],
                'businessusername' => $data['businessusername'],
                'address_1' => $data['address_1'],
                'state' => $data['state'],
                'district' =>$data['district'],
                'location' => $data['location'],
                'pincode' => $data['pincode'],
                'location_id' => $data['location_id'],
                'contact_number' => $data['contact_number'],
                'email_address' => $data['email_address'],
                'user_id' => $data['user_id'],
            ]);

        //Send Email to Seller
        Master::sendEmailToSeller('newSeller',$seller);

        //Log For New Seller 
        Log::channel('newuser')->info('New Seller', array(
          'Name'=>$seller['business_name'],
          'BusinessURl'=>env('APP_URL').'/seller/'.$seller['businessusername'],
          'Date'=>$seller['created_at']
        )); 
        return $seller;
    }
}
