<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Master;
use App\Http\Controllers\Auth\Session;
use Illuminate\Http\Request;
use Auth;
use Darryldecode\Cart\CartCondition;
use App\Http\Controllers\Auth\Cookie;
//use App\Http\Controllers\Auth\Session;


class LoginController extends Master
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }
    
    /**
     *@Author: Pradeep Kumar
     *@Description: Show Login Page
     */
    public function showLoginForm() {
        return view(Master::loadFrontTheme('auth.login'));
    }
    
    
    /**
     *@Author: Pradeep Kumar
     *@Description: Login Authentication Page
     */
    public function login(Request $request) {
        //dd($request);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $userId = Auth::user()->id;
            $email =  Auth::user()->email;
            $first_name =  Auth::user()->first_name;
            \Cookie::make('email', $email, 3600);
            \Cookie::make('name', $email, 360);
            \Cookie::make('password', $request->get('password'), 360);
            \Cookie::make('first_name', $first_name, 360);
            $cartCollection = \Cart::session(Auth::user()->id);
            // then you can:
            $cartCollection = \Cart::getContent();
            session(['countItem' => $cartCollection->count()]);
            $lang = \Session::get('lang_code');
		    return redirect()->route('home');
        }
        return view(Master::loadFrontTheme('auth.login'));
    }
}
