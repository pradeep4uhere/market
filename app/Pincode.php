<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    //
	protected $table = 'pincodes';
	
	public function getAllPlaceName(){
		return Pincode::where('status','=','1')->get();
	}
}
