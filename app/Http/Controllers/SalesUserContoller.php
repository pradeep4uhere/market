<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesUserContoller extends Controller
{
    //
    public function register(Request $request){
    	echo "<pre>";
    	print_r($request->all());
    	die;

    }
}
