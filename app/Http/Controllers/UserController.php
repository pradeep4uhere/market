<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class UserController extends Master
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile() {
		//dd(Master::loadFrontTheme('user.profile'));
        return view(Master::loadFrontTheme('user.profile'));
    }
	
	
	public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
   
}
