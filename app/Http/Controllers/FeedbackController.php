<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Master;
use App\Testimonial;
class FeedbackController extends Master
{

    public function feedback(Request $request){
    	echo "<pre>";
    	print_r($request->all());
    	die;

    }




    //addTestimonial
    public function addTestimonial(Request $request){
    	dd($request->all());

    }
}
