<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Master;
use Auth;
use App\User;
use Session;
use App\City;
use App\DeliveryAddress;
use Illuminate\Support\Facades\Hash;
use Mail;

class OrderController extends Master
{
     
     public function addDeliveryAddress(Request $request){
        if ($request->isMethod('post')) {
            if(self::isValidToekn($request)){
                $validator = Validator::make($request->all(), [
                    'user_id' => 'required|numeric',
                    'user_type' => 'required|numeric',
                    'mobile' => 'required|numeric|min:10',
                    'email_address' => 'required|email',
                    'full_name' => 'required|min:3',
                    'address_1' => 'required',
                    'address_2' =>'required',
                    'landmarks' =>'required',
                    'state' => 'required',
                    'district' => 'required',
                    'location' => 'required',
                    'pincode' => 'required|numeric|min:6',
                    'location_id' => 'required'
                ]);
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $responseArray['status'] = false;
                    $responseArray['message']= "Input are not valid";
                    $responseArray['error']= $errors;   
                }else{
                    $data = $request->all();
                    $oldDelAddress = array();
                    //Check is this Address Already Present
                    /*$oldDelAddress = DeliveryAddress::where('user_id','=',$data['user_id'])
                                        ->where('user_type','=',$data['user_type'])
                                        ->where('mobile','=',$data['mobile'])
                                        ->where('email_address','=',$data['email_address'])
                                        ->where('full_name','=',$data['full_name'])
                                        ->where('address_1','=',$data['address_1'])
                                        ->where('address_2','=',$data['address_2'])
                                        ->where('pincode','=',$data['pincode'])
                                        ->first();*/
                    if(count($oldDelAddress)>0){
                        $lastId = $oldDelAddress->id;
                        $responseArray['message'] = "You address already exists.";
                    }else{
                        $lastId = $this->saveDeliveryAddress($data);
                        $responseArray['message'] = "New Address Updated Successfully";

                    }
                    if($lastId>0){
                        //Get New Address
                        $delAddress = DeliveryAddress::find($lastId);
                        $responseArray['status'] = true;
                        $responseArray['result'] = $delAddress;


                    }else{
                        $responseArray['status'] = false;
                        $responseArray['message'] = "Somthing went wrong, please try after some time.";
                    }
                }

            }else{
                $responseArray['status'] = false;
                $responseArray['message'] = "Invalid Token";
            }
        }
        return response()->json($responseArray);
     }


     private function saveDeliveryAddress($data){
        try{
            $delAddress=DeliveryAddress::updateOrCreate([
                    'user_id' => $data['user_id'],
                    'user_type' => $data['user_type'],
                    'mobile' => $data['mobile'],
                    'email_address' => $data['email_address'],
                    'full_name' => $data['full_name'],
                    'address_1' => $data['address_1'],
                    'address_2' => $data['address_2'],
                    'location' => $data['location'],
                    'pincode' => $data['pincode'],
                    'location_id' => $data['location_id'],
                    'landmarks' => $data['landmarks'],
                    'location_id' => $data['location_id'],
                    'created_at'=>self::getCreatedDate()
                ]);
                $last_insert_id = $delAddress->id;
                if($last_insert_id>0){
                    return $last_insert_id;
                }else{
                    return false;
                }
            }catch(Exception $e){
                return false;
            }

     }


}