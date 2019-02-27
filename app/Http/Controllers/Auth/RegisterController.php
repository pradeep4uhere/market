<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Controllers\Master;
use App\Http\Controllers\NotificationController;
use Log;

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
}
