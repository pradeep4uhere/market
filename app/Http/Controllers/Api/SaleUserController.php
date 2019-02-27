<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Master;
use Auth;
use App\User;
use App\SaleUser;
use Session;
use Illuminate\Support\Facades\Hash;
use Mail;



class SaleUserController extends Master
{
    
    public function register(Request $request){
    	if(self::isValidToekn($request)){
    		$validator = Validator::make($request->all(), [
                'first_name' => 'required|max:50',
                'last_name' => 'required|max:50',
                'password' => 'required|min:8',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:8',
                'password_confirmation' => 'required|min:8',
                'mobile' => 'required|unique:users|numeric',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                $responseArray['status'] = false;
                $responseArray['message']= "Input are not valid";
                $responseArray['error']= $errors;
            }else{
                $userObj = new User();
                $userObj->first_name = $request->get('first_name');
                $userObj->last_name = $request->get('last_name');
                $userObj->password = Hash::make($request->get('password'));
                $userObj->email = $request->get('email');
                $userObj->mobile = $request->get('mobile');
                $userObj->created_at = self::getCreatedDate();
                try{
                    $userObj->save();
                    $last_insert_id = $userObj->id;
                    $this->sendEmail($last_insert_id,$request);

                    //Save For Sales User Details
                    $salesUser = new SaleUser();
                    $salesUser->user_id =  $last_insert_id;
                    $salesUser->location_id =  $request->get('first_name');;
                    $salesUser->first_name =  $request->get('first_name');
                    $salesUser->last_name =  $request->get('last_name');
                    $salesUser->email =  $request->get('email');
                    $salesUser->location_id =  $request->get('location_id');
                    $salesUser->mobile =  $request->get('mobile');
                    $salesUser->address_1 =  $request->get('address_1');
                    $salesUser->address_2 =  $request->get('address_2');
                    $salesUser->is_verified =  0;
                    $salesUser->status =  0;
                    $salesUser->created_at =  self::getCreatedDate();
                    $salesUser->referer_code =  self::getRefererCode();
                    $salesUser->save();
                    $lastSaleUserId = $salesUser->id;
                    $this->sendSaleUserEmail($lastSaleUserId,$request);

                    $userData= User::with('SaleUser')->find($userObj->id);
                    $responseArray['status'] = true;
                    $responseArray['message']= "Sales User Register Successfully.";
                    $responseArray['data']['user']= $userData;
                    $responseArray['data']['userId']= encrypt($userObj->id);
                }catch (Exception $e) {
                    $responseArray['status'] = false;
                    $responseArray['message'] = $e->getMessage();
                }
            }
            
    	}else{
    		$responseArray['status'] = false;
            $responseArray['message'] = "Invalid Input";
    	}
    	return response()->json($responseArray);die;

    }


    /**
     * Send an e-mail confirmation to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function sendSaleUserEmail($last_insert_id,$request)
    {   
        $user = SaleUser::findOrFail($last_insert_id);
        $name = $user->first_name;
        $url  = "http;//www.google.com";
        $body1 = "Your sales user created successfully.";
        $username = "Username: ".$user->email;
        $password = "Password: ".$request->get('password');
        $referCode = "Referer Code: ".$user->referer_code;
        $body2= "You sale user Created Successfully.";
        $mail = Mail::send('Email.sale.register', [
            'name' => $name,
            'body1' => $body1,
            'username' => $username,
            'password' => $password,
            'referCode' => $referCode,
            'body3' => $body2,
            'url'  => $url ,
            'copyright' => 'copyright'
            ], function ($m) use ($user) {
            $m->from('support@grabmorenow.com', 'Thank you for register');
            $m->to($user->email, ucwords(strtolower($user->first_name)))->subject('Thank you for register!');
        });
        if($mail){
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
    public function sendEmail($last_insert_id,$request)
    {   
        $user = User::findOrFail($last_insert_id);
        $name = $user->first_name;
        $url  = "http;//www.google.com";
        $body1 = "You have successfully registered .";
        $username = "Username: ".$user->email;
        $password = "Password: ".$request->get('password');
        $body2= "Thank you for joining with us.";
        $mail = Mail::send('Email.user.register', [
            'name' => $name,
            'body1' => $body1,
            'username' => $username,
            'password' => $password,
            'body3' => $body2,
            'url'  => $url ,
            'copyright' => 'copyright'
            ], function ($m) use ($user) {
            $m->from('support@grabmorenow.com', 'Thank you for register');
            $m->to($user->email, ucwords(strtolower($user->first_name)))->subject('Thank you for register!');
        });
        if($mail){
            return true;
        }
    }

}
