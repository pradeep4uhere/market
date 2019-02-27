<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Master;
use Mail;
use App\User;

 
class EmailController extends Controller
{
 
    /*
     *@Author: Pradeep Kumar
     *@Desc  : Send New Register User
     */
    public static function sendNewUserRegister($request,$user){
        $user = User::findOrFail($user['id']);
        $name = $user->first_name;
        $url  = env('APP_URL');
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
            'url'  => $url 
            ], function ($m) use ($user) {
            $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $m->to($user->email, ucwords(strtolower($user->first_name)))->subject('Thank you for register with Go4Shop!');
        });
        if($mail){
            return true;
        }

    } 










/*******************************Seller Email Start Here*******************************************/





    /**
     * Send an e-mail confirmation to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public static function sendWelcomeSellerEmail($data)
    {   
        $seller = \App\Seller::findOrFail($data['id']);
        $business_name  = $data['business_name'];
        $contact_number = $data['contact_number'];
        $email_address  = $data['email_address'];
        $url  = env('APP_URL');
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
                $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $m->to($seller->email_address, ucwords(strtolower($seller->business_name)))
                ->cc(env('MAIL_FROM_ADDRESS'))
                ->subject('Your Seller Account Created!');
            });
        if($mail){

            return true;
        }
    }

/*******************************Seller Email Start Here*******************************************/













}