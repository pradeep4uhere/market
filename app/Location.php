<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Location extends Model
{
    //
    public function getAllLocation(){
    	$locArr=array();
        $locObj = Location::where('status','=','1')->get();
        foreach ($locObj as $obj) {
            $locArr[$obj->id]=$obj->location." ".$obj->district.' ('.$obj->pincode.')';
            //$locArr[$obj->id]=$obj->location;
        }
        return $locArr;
    }


    public static function getAllState(){
            $data = DB::table("locations")
           ->select(DB::raw("state"))
           ->orderBy("state")
           ->groupBy(DB::raw("state"))
           ->get()->toArray();
           return $data; 
    }


    public static function getAllDistrictByState($state){
      $data = Location::where('state','=',$state)->groupBy('district')->get()->toArray();
      return $data;
    }

    public static function getAllLocationByDistrict($district){
      $data = Location::where('district','=',$district)->get()->toArray();
      return $data;
    }
}
