<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Master;
use Mail;
use App\User;
use App\Order;
use File;
use App\Payment;

 
class EmailController extends Controller
{
 
    /*
     *@Author: Pradeep Kumar
     *@Desc  : Send New Register User
     */
    public static function sendNewUserRegister($request,$user){
        $user = User::findOrFail($user['id']);
        $name = $user->first_name;
        $url  = env('APP_URL');
        $body1 = "You have successfully registered .";
        $username = "Username: ".$user->email;
        $password = "Password: ".$request->get('password');
        $body2= "Thank you for joining with us.";
        $mail = Mail::send('Email.user.register', [
            'name' => $name,
            'body1' => $body1,
            'username' => $username,
            'password' => $password,
            'body3' => $body2,
            'url'  => $url 
            ], function ($m) use ($user) {
            $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $m->to($user->email, ucwords(strtolower($user->first_name)))->subject('Thank you for register with Go4Shop!');
        });
        if($mail){
            return true;
        }

    } 





    /*
     *@Author: Pradeep Kumar
     *@Desc  : Send New Register User
     */
    public static function sendContactUsEmailToUser($request){
        $name = $request->get('name');
        $surname = $request->get('surname');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $message = $request->get('message');

        $user['name']= $name.' '.$surname;
        $user['email']= $email;

        $url  = env('APP_URL');
        $body1 = "Thanks for contacting us.";
        $nameStr = $name.' '.$surname;
        $messageTitle = "Your query/message as below-";
        $messageBody = $message;
        $body2= "we are doing our best, we will back to you 2 working days, Thank you for joining with us.";
        $mail = Mail::send('Email.admin.contactus', [
                'name' => $name,
                'body1' => $body1,
                'nameStr' => $nameStr,
                'msg' => $messageTitle,
                'messageBody' => $messageBody,
                'username' => $user['name'],
                'body3' => $body2,
                'url'  => $url 
            ], function ($m) use ($user) {
            $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $m->to($user['email'], ucwords(strtolower($user['name'])))
                ->bcc(env('MAIL_FROM_ADDRESS'))
                ->subject('Thank you for register with Go4Shop!');
        });
        if($mail){
            return true;
        }

    } 










/*******************************Seller Email Start Here*******************************************/





    /**
     * Send an e-mail confirmation to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public static function sendWelcomeSellerEmail($data)
    {   
        $seller = \App\Seller::findOrFail($data['id']);
        $business_name  = $data['business_name'];
        $contact_number = $data['contact_number'];
        $email_address  = $data['email_address'];
        $url  = env('APP_URL');
        $body1 = "You have successfully registered .";
        $body2= "Thank you for joining with us.";
        $mail = Mail::send('Email.seller.register', [
            'name' => $business_name,
            'body1' => $body1,
            'business_name' => $business_name,
            'contact_number' => $contact_number,
            'email_address' => $email_address,
            'body3' => $body2,
            'url'  => $url ,
            'copyright' => 'copyright'
            ], function ($m) use ($seller) {
                $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $m->to($seller->email_address, ucwords(strtolower($seller->business_name)))
                ->cc(env('MAIL_FROM_ADDRESS'))
                ->subject('Your Seller Account Created!');
            });
        if($mail){

            return true;
        }
    }
    


    /**
     * Send an e-mail confirmation to the Seller For New Order.
     *
     * @param  Request  $request
     * @param  Order Details Object
     * @return Response
     */
    public static function sendOrderConfirmationSellerEmail($data)
    {   
        $orderDetails = Order::with('OrderDetail','User')->where('id','=',$data[0]['id'])->first();
        $paymentDetailArr = Payment::where('order_id','=',$orderDetails['orderID'])->first();
        
        $orderDate = Master::getDate('d M,Y H:i:s',$orderDetails['created_at']);
        $seller = \App\Seller::findOrFail($orderDetails['seller_id']);
        $sellerName = $seller['business_name'];
        //User Details
        $userDetails = " Customer Name: ".$orderDetails['User']['first_name'].' '.$orderDetails['User']['last_name']."</br>";
        $userDetails.= " Contact Number: ".$orderDetails['User']['mobile']."</br>";
        $userDetails.= " Email: ".$orderDetails['User']['email']."</br>";
        $userDetails.= " Address: ".$orderDetails['User']['address_1']."</br>";
        $userDetails.= " <hr></br>";

        //All Payment Details        
        $paymentDetails=" Payment Details<br/>";
        $paymentDetails.=" Order Id: ".$orderDetails['orderID']."<br/>";
        $paymentDetails.=" Total Amount: ₹".number_format($paymentDetailArr['net_amount_debit'],2)."<br/>";
        $paymentDetails.=" Payment Status: ".strtoupper($paymentDetailArr['status'])."<br/>";
        $paymentDetails.=" Transaction No: ".strtoupper($paymentDetailArr['bank_ref_num'])."<br/>";
        $paymentDetails.=" Payment Date: ".Master::getDate('d M,Y H:i:s',$paymentDetailArr['payment_date'])."<br/>";
        $paymentDetails.=" <hr><br/>";


        //All Item Details
        $items ="Items Details:<br/>";
        $items.="<table cellpadding='2' cellspacing='0' border='1' style='width:100%'>";
        $items.='<tr>';
        $items.='<td>SN</td>';
        $items.='<td>Image</td>';
        $items.='<td>Name</td>';
        $items.='<td>Quantity</td>';
        $items.='<td>Price</td>';
        $items.='</tr>';
        $count=1;
        foreach($orderDetails['OrderDetail'] as $itemObj){
            $items.="<tr>";
            $items.="<td>".$count."</td>";
            $items.="<td><img src=".$itemObj['default_thumbnail']." alt='image'></td>";
            $items.="<td>".ucwords($itemObj['product_name'])."</td>";
            $items.="<td>".$itemObj['quantity']."</td>";
            $items.="<td>₹".$itemObj['unit_price']."</td>";
            $items.='</tr>';
            $count++;
        }
        $items.="</table>";

        $body1 = "You have new order recived on <b>".$orderDate."</b> with order id <b>".$orderDetails['orderID']."</b><br/>";
        $body3 =" For more details, please login to your seller account.";
        $customerDetails= "";
        
        $url  = env('APP_URL');
        $body1 = "You have successfully registered .";
        $body2= "Thank you for joining with us.";
        $mail = Mail::send('Email.seller.order.order_confirom', [
            'name' => $sellerName,
            'body1' => $body1,
            'userDetails' => $userDetails,
            'paymentDetails' => $paymentDetails,
            'items' => $items,
            'body3' => $body3,
            'url'  => $url ,
            'copyright' => 'copyright'
            ], function ($m) use ($seller) {
                $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $m->to($seller['email_address'], ucwords(strtolower($seller['business_name'])))
                ->bcc(env('MAIL_FROM_ADDRESS'))
                ->subject('New Order Recived!');
            });
        if($mail){
            return true;
        }
    }











    /**
     * Send an e-mail confirmation to the User For New Order.
     *
     * @param  Request  $request
     * @param  Order Details Object
     * @return Response
     */
    public static function sendOrderConfirmationToUser($data)
    {   
        $orderDetails = Order::with('OrderDetail','User')->where('id','=',$data[0]['id'])->first();
        $paymentDetailArr = Payment::where('order_id','=',$orderDetails['orderID'])->first();
        
        $orderDate = Master::getDate('d M,Y H:i:s',$orderDetails['created_at']);
        $seller = \App\Seller::findOrFail($orderDetails['seller_id']);
        $sellerName = $seller['business_name'];
        dd($sellerName);
        //User Details
        $userDetails = " Seller Name: ".$seller['business_name']."</br>";
        $userDetails.= " Contact Number: ".$seller['User']['mobile']."</br>";
        $userDetails.= " Email: ".$orderDetails['User']['email']."</br>";
        $userDetails.= " Address: ".$orderDetails['User']['address_1']."</br>";
        $userDetails.= " <hr></br>";

        //All Payment Details        
        $paymentDetails=" Payment Details<br/>";
        $paymentDetails.=" Order Id: ".$orderDetails['orderID']."<br/>";
        $paymentDetails.=" Total Amount: ₹".number_format($paymentDetailArr['net_amount_debit'],2)."<br/>";
        $paymentDetails.=" Payment Status: ".strtoupper($paymentDetailArr['status'])."<br/>";
        $paymentDetails.=" Transaction No: ".strtoupper($paymentDetailArr['bank_ref_num'])."<br/>";
        $paymentDetails.=" Payment Date: ".Master::getDate('d M,Y H:i:s',$paymentDetailArr['payment_date'])."<br/>";
        $paymentDetails.=" <hr><br/>";


        //All Item Details
        $items ="Items Details:<br/>";
        $items.="<table cellpadding='2' cellspacing='0' border='1'>";
        $items.='<tr>';
        $items.='<td>SN</td>';
        $items.='<td>Image</td>';
        $items.='<td>Name</td>';
        $items.='<td>Quantity</td>';
        $items.='<td>Price</td>';
        $items.='</tr>';
        $count=1;
        foreach($orderDetails['OrderDetail'] as $itemObj){
            $items.="<tr>";
            $items.="<td>".$count."</td>";
            $items.="<td><img src=".$itemObj['default_images']." alt='image'></td>";
            $items.="<td>".ucwords($itemObj['product_name'])."</td>";
            $items.="<td>".$itemObj['quantity']."</td>";
            $items.="<td>₹".$itemObj['unit_price']."</td>";
            $items.='</tr>';
            $count++;
        }
        $items.="</table>";

        $body1 = "You have new order recived on <b>".$orderDate."</b> with order id <b>".$orderDetails['orderID']."</b><br/>";
        $body3 =" For more details, please login to your seller account.";
        $customerDetails= "";
        
        $url  = env('APP_URL');
        $body1 = "You have successfully registered .";
        $body2= "Thank you for joining with us.";
        $mail = Mail::send('Email.seller.order.order_confirom', [
            'name' => $sellerName,
            'body1' => $body1,
            'userDetails' => $userDetails,
            'paymentDetails' => $paymentDetails,
            'items' => $items,
            'body3' => $body3,
            'url'  => $url ,
            'copyright' => 'copyright'
            ], function ($m) use ($seller) {
                $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $m->to($seller['email_address'], ucwords(strtolower($seller['business_name'])))
                ->bcc(env('MAIL_FROM_ADDRESS'))
                ->subject('New Order Recived!');
            });
        if($mail){
            return true;
        }
    }


/*******************************Seller Email Start Here*******************************************/













}