<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    //
    public function register(Request $request){
    	echo "<pre>";
    	print_r($request->all());
    	die;

    }
}
