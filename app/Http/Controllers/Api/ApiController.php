<?php
namespace App\Http\Controllers\Api;
#require '../../'.__DIR__ . '/vendor/autoload.php';
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Master;
use Auth;
use App\User;
use Session;
use App\State;
use App\City;
use App\DeliveryAddress;
use App\StoreType;
use Log;
// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;


class ApiController extends Master
{
     /**
     *@Author: Pradeep Kumar
     *@Description: Login Authentication Page
     */
   
    public function gettoken(Request $request) {
        $params = $request->all();
        //dd($params);
        $str='';
        foreach($params as $val){
            $str.=$val.'|'; 
        }
        //echo $str.config('global.CLIENT_SECRET');
        return md5($str.config('global.CLIENT_SECRET'));
        
    }


    public function getStoreType(Request $request){
        //Get Business Type List
        try{
            $businessType = StoreType::where('status','=',1)->get();
            $responseArray['status'] = true;
            $responseArray['data'] =$businessType;
            
        }catch (Exception $e) {
            $responseArray['status'] = false;
            $responseArray['message'] = $e->getMessage();
        }
        return response()->json($responseArray);

    }


    public function getStateList(Request $request){
        //Get Business Type List

        try{
            $params = $request->all();
            $stateObj = new State();
            $state= $stateObj->getAllState();
            $responseArray['status'] = true;
            $responseArray['data'] =$state;
            
        }catch (Exception $e) {
            $responseArray['status'] = false;
            $responseArray['message'] = $e->getMessage();
        }
        return response()->json($responseArray);

    }


    /*public function getCitylist(Request $request){
        //Get Business Type List
        if(self::isValidToekn($request)){
            try{
                $state_id = $request->get('state_id');
                $stateArr = State::find($state_id);
                if(!empty($stateArr)){
                    $cityList = City::where('state_id','=',$state_id)->get();
                    $responseArray['status'] = true;
                    $responseArray['data']['State'] =$stateArr;
                    $responseArray['data']['City'] =$cityList;
                }else{
                    $responseArray['status'] = false;
                    $responseArray['message'] ="Invalid State Id";
                }
                
            }catch (Exception $e) {
                $responseArray['status'] = false;
                $responseArray['message'] = $e->getMessage();
            }
        }else{
            $responseArray['status'] = false;
            $responseArray['message'] ="Invalid Token provided.";
        }
        return response()->json($responseArray);
    }*/




    public function twilioWhatsapp(Request $request){
        /*
        // Your Account SID and Auth Token from twilio.com/console
        $sid = 'ACc9f590aae6dde163c7e1e4465de9c011';
        $token = '48267db39ffd36e39cb18d047e9d8ab7';
        $twilio = new Client($sid, $token);

        // Use the client to do fun stuff like send text messages!
        /*$client->messages->create(
                    // the number you'd like to send the message to
                    '+919015446567',
                array(
                        // A Twilio phone number you purchased at twilio.com/console
                    'from' => '+18036755424',
                    // the body of the text message you'd like to send
                    'body' => 'Hello! Welcome to www.go4shop.online. How My I help you.'
                )
        );*/
        /*$message = $twilio->messages
                    ->create("whatsapp:+919015446567",
                        array(
                            "body" => "Hello! Welcome to www.go4shop.online. Thanks For Registered with us. Regards, Go4Shop Team",
                            "from" => "whatsapp:+14155238886"
                        )
                    );
        //print($message->sid);
        //$data = $request->all();
        //Log::channel('twilio')->info('Request', $data); 
        //return response()->json($message->sid);
        */

    }


    public function chat(Request $request){
    	Log::info($request->all());
    	return response()->json($request->all());
    }
}