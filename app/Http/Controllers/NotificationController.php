<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// Use the REST API Client to make requests to the Twilio REST API
use App\Http\Controllers\Master;
use Twilio\Rest\Client;


 
class NotificationController extends Master
{
 
    static private  $sid;
    static private  $token;

    public function __construct(){
        self::$sid = env('TWILIO_SID');
        self::$token = env('TWILIO_TOKEN');
    }


    /*Welcome Message for New User Register to Website*/
    public static function sendWelcomeMessage($user,$body=null)
    {
        $twilio = new Client(self::$sid, self::$token);
        if($user!=''){
             $mobileNumber = $user['mobile'];
             if($body!=''){
                $text = $body;
             }else{
                $text = "Hello ".$user['first_name']."! Welcome to www.go4shop.online. Thanks For Registered with us. Regards, Go4Shop Team";
             }
             $message = $twilio->messages
                ->create("whatsapp:".$mobileNumber,
                array(
                    "body" => $text,
                    "from" => "whatsapp:".env('TWILIO_FROM')
                )
            );
            self::sendMessageToAdmin($user);

        }
    }




    /*Welcome Message for New User Register to Website as Seller*/
    public static function sendWelcomeMessageAsSeller($seller)
    {
        $twilio = new Client(self::$sid, self::$token);
        if(!empty($seller)){
             $mobileNumber = '+91'.$seller['contact_number'];
             if($mobileNumber!=''){
                $text = "Hello ".$seller['business_name']."!.";
                $text.=" Thanks For Registered with us as seller, Please visit your shop here ".env('APP_URL').'/seller/'.$seller['businessusername'];
                $text.= "Regards, Go4Shop Team";
             }
             $message = $twilio->messages
                ->create("whatsapp:".$mobileNumber,
                array(
                    "body" => $text,
                    "from" => "whatsapp:".env('TWILIO_FROM')
                )
            );
            self::sendMessageToAdminForSeller($seller);

        }
    }



    /***************Send Payment Confirmation To User after successfull payment****************************/
    public static function sendPaymentConfirmationToUser($lastPaymentId){
        $twilio = new Client(self::$sid, self::$token);
        if($lastPaymentId!=''){
             //Get Payment Details
            $payment = \App\Payment::with(['Order','Order.User'])->where('id','=',$lastPaymentId)->first();
            $orderStatus = $payment['status'];
            $orderId = $payment['order_id'];
            $paymentDate = $payment['payment_date'];
            $tansaxtionNo = $payment['bank_ref_num'];
            $totalAmount = $payment['net_amount_debit'];
            $userName = $payment['Order']['User']['first_name'].' '.$payment['Order']['User']['last_name'];
            $mobileNumber = '+'.$payment['Order']['User']['mobile'];
            $mobileNumber = $mobileNumber;
            if($mobileNumber!=''){
                $text = "Hello ".$userName."!.                                         ";
                $text.=" Your payment status is *".strtoupper($orderStatus)."* , Your Order no is *".$orderId."* is confirmed on *".date('d M, Y H:i',strtotime($paymentDate))."*, with transaction No: *".$tansaxtionNo."*.                                         Total Payment *₹".$totalAmount."* recived.                  ";
                $text.= "Regards                                               , *Go4Shop Team*";
            }
            $message = $twilio->messages
                ->create("whatsapp:".$mobileNumber,
                array(
                    "body" => $text,
                    "from" => "whatsapp:".env('TWILIO_FROM')
                )
            );
            //self::sendMessageToAdminForSeller($seller);

        }

    }


    /***************Send Payment Confirmation To User after successfull payment****************************/
    public static function sendOrderConfirmationToSeller($lastPaymentId){
        //echo  $lastPaymentId;
        $twilio = new Client(self::$sid, self::$token);
        if($lastPaymentId!=''){
             //Get Payment Details
            $payment = \App\Payment::with(['Order','Order.User','Order.OrderDetail','Order.Seller'])->where('id','=',$lastPaymentId)->first();

            //dd($payment['Order']['Seller']);
            //echo "<pre>";    
            //print_r($payment);    
            //print_r($payment['Order']['Seller']);   

            $orderStatus = $payment['status'];
            $orderId = $payment['order_id'];
            $paymentDate = $payment['payment_date'];
            $tansaxtionNo = $payment['bank_ref_num'];
            $totalAmount = $payment['net_amount_debit'];
            $userName = $payment['Order']['Seller']['business_name'];
            $mobileNumber = '+91'.$payment['Order']['Seller']['contact_number'];
            //$mobileNumber = '+919015446567';

             $mobileNumber = $mobileNumber;
             if($mobileNumber!=''){
                $text = "Hello *".$userName."*!.                                                     ";
                $text.= " Your have new order                                                  ";
                $text.= " Order No   : *".$orderId."*                                              ";
                $text.= " Order Date : * ".date('d M, Y H:i',strtotime($paymentDate))."*           ";
                $text.= " Transaction No: *".$tansaxtionNo."*                                      ";
                $text.= "                                        All Items                         ";  
                $text.= "------------------------------------------";  
                $count = 1;
                foreach ($payment['Order']['OrderDetail'] as $item) {
                    $text.= $count."). *".ucwords($item['product_name'])."*                                       ";
                    $text.= "                     *Quntity:* ".$item['quantity']."    |      ";
                    $text.= " *Price:*   ₹".$item['total_amount']."                                       ";
                    //$text.= "                     *OrderID:* ".$item['order_track']."                                       ";
                    
                    $text.= "------------------------------------------";  
                    $count++;
                }
                $text.="Total Payment *₹".$totalAmount."*                                                                   ";

                $text.= "                                                                                                    ";
                $text.= "                                                                                                    ";
                if(!empty($payment['Order']['Seller'])){                                                                     
                    $text.= " For More Details Contact to User:                                                             ";
                    $text.= " User Name: ".$payment['Order']['User']['first_name']."                                        ";
                    $text.= " Mobile No: ".$payment['Order']['User']['mobile']."                           ";
                }
                $text.= " Regards                                                                                            ";
                $text.= " *Go4Shop Team*";
             }
             //$mobileNumber = '+919953711959';
             //echo $text;die; 
             $message = $twilio->messages
                ->create("whatsapp:".$mobileNumber,
                array(
                    "body" => $text,
                    "from" => "whatsapp:".env('TWILIO_FROM')
                )
            );
            //self::sendMessageToAdminForSeller($seller);

        }

    }



    /***************Send Payment Confirmation To User after successfull payment****************************/
    public static function sendOrderConfirmationToUser($lastPaymentId){
        $twilio = new Client(self::$sid, self::$token);
        if($lastPaymentId!=''){
             //Get Payment Details
            $payment = \App\Payment::with(['Order','Order.User','Order.OrderDetail','Order.Seller'])->where('id','=',$lastPaymentId)->first();

            //dd($payment['Order']['Seller']);
            

            $orderStatus = $payment['status'];
            $orderId = $payment['order_id'];
            $paymentDate = $payment['payment_date'];
            $tansaxtionNo = $payment['bank_ref_num'];
            $totalAmount = $payment['net_amount_debit'];
            $userName = $payment['Order']['User']['first_name'].' '.$payment['Order']['User']['last_name'];
            $mobileNumber = '+'.$payment['Order']['User']['mobile'];

             $mobileNumber = $mobileNumber;
             if($mobileNumber!=''){
                $text = "Hello *".$userName."*!.                                                     ";
                $text.= " Your Order is confirmed                                                  ";
                $text.= " Order No   : *".$orderId."*                                              ";
                $text.= " Order Date : * ".date('d M, Y H:i',strtotime($paymentDate))."*           ";
                $text.= " Transaction No: *".$tansaxtionNo."*                                      ";
                $text.= "                                        All Items                         ";  
                $text.= "------------------------------------------";  
                $count = 1;
                foreach ($payment['Order']['OrderDetail'] as $item) {
                    $text.= $count."). *".ucwords($item['product_name'])."*                                       ";
                    $text.= "                     *Quntity:* ".$item['quantity']."    |      ";
                    $text.= " *Price:*   ₹".$item['total_amount']."                                       ";
                    //$text.= "                     *OrderID:* ".$item['order_track']."                                       ";
                    
                    $text.= "------------------------------------------";  
                    $count++;
                }
                $text.="Total Payment *₹".$totalAmount."*                                                                   ";

                $text.= "                                                                                                    ";
                $text.= "                                                                                                    ";
                if(!empty($payment['Order']['Seller'])){                                                                     
                    $text.= " For More Details Contact to Seller as below:                                                   ";
                    $text.= " Seller Name: ".$payment['Order']['Seller']['business_name']."                                  ";
                    $text.= " Seller Contact No: ".$payment['Order']['Seller']['contact_number']."                           ";
                }
                $text.= " Regards                                                                                            ";
                $text.= " *Go4Shop Team*";
             }

             
             $message = $twilio->messages
                ->create("whatsapp:".$mobileNumber,
                array(
                    "body" => $text,
                    "from" => "whatsapp:".env('TWILIO_FROM')
                )
            );
            //self::sendMessageToAdminForSeller($seller);

        }

    }


    /************************************************************************************************/
    
                                /*Send All Notification To Admin Whatsapp*/

    /************************************************************************************************/

    public static function sendMessageToAdmin($user){

        $twilio = new Client(self::$sid, self::$token);
        $mobileNumber = env('ADMIN_MOBILE');
        $text = "Hello Admin! New User Register, Name:".$user['first_name']." Mobile:".$user['mobile'].". Regards, Go4Shop Team";
        $message = $twilio->messages->create("whatsapp:".$mobileNumber,array("body" => $text,"from" => "whatsapp:".env('TWILIO_FROM')));

    }


    public static function sendMessageToAdminForSeller($seller){

        $twilio = new Client(self::$sid, self::$token);
        $mobileNumber = env('ADMIN_MOBILE');
        
        $text = "Hello Admin! New Seller Created, Business Name:".$seller['business_name']." Mobile:".$seller['contact_number'];
        $text.=" Please visit your shop here ".env('APP_URL')."/seller/".$seller['businessusername'];
        $text.=" Regards, Go4Shop Team";

        $message = $twilio->messages->create("whatsapp:".$mobileNumber,array("body" => $text, "from" => "whatsapp:".env('TWILIO_FROM')));
    }



    public static function AdminPaymentRecived($user){

        $twilio = new Client(self::$sid, self::$token);
        $mobileNumber = env('ADMIN_MOBILE');
        $text = "Hello Admin! New User Register, Name:".$user['first_name']." Mobile:".$user['mobile'].". Regards, Go4Shop Team";
        $message = $twilio->messages->create("whatsapp:".$mobileNumber,array("body" => $text,"from" => "whatsapp:".env('TWILIO_FROM')));

    }




    /************************************************************************************************/

                              /*Send All Notification To Admin Whatsapp*/

    /************************************************************************************************/











}