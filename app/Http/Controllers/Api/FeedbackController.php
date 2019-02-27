<?php 
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Master;
use Mail;
use App\Feedback;
use App\Testimonial;

class FeedbackController extends Master
{
    protected $responseArray = array();
     
    public function feedbackSubmitt(Request $request){
    	try{
            
            if(self::isValidToekn($request)){
                $validator = Validator::make($request->all(), [
                    'name' => 'required|min:6',
                    'email' => 'required',
                    'mobile' => 'required|min:10|numeric',
                    'subject' => 'required|min:5',
                    'description' => 'required|min:20'
                ]);
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $this->responseArray['status'] = false;
                    $this->responseArray['message']= "Input are not valid";
                    $this->responseArray['error']= $errors;
                }else{
                	$feedbackObj = new Feedback();
                	$feedbackObj->name = $request->get('name');
                	$feedbackObj->email = $request->get('email');
                	$feedbackObj->contact_number = $request->get('mobile');
                	$feedbackObj->subject = $request->get('subject');
                	$feedbackObj->description = $request->get('description');
                	$feedbackObj->created_at = self::getCreatedDate();
                	$feedbackObj->save();
                	if($feedbackObj->id){
                        $this->sendEmailToAdmin($feedbackObj->id);
                        $this->responseArray = self::getMessage(200,"Feedback Submitted");

                	}else{
                		$this->responseArray['status'] = false;
                        $this->responseArray['message'] = self::getMessage(500,"Feedback Not  Submitted");
                	}
                }

        }else{
                $this->responseArray['status'] = false;
                $this->responseArray['message'] = "Invalid Token!!";
            }

        }catch (Exception $e) {
            $this->responseArray['status'] = false;
            $this->responseArray['message'] = self::getMessage(9999,$e->getMessage());
        }
        return response()->json($this->responseArray);
    }



    /**
     * Send an e-mail confirmation to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function sendEmailToAdmin($last_insert_id)
    {   
        $user = Feedback::findOrFail($last_insert_id);
        $name = $user->name;
        $email = $user->email;
        $contact_number = $user->contact_number;
        $subject = 'New feedback: '.$user->subject;
        $description = $user->description;
        $body1 = "You have One Feedback from ".$name;
        $name = "Name: ".$name;
        $email = "Email: ".$email;
        $contact_number = "Contact Number: ".$contact_number;
        $description = "Message: ".$description;
        try{
        $mail = Mail::send('Email.admin.feedback', [
            'name' => $name,
            'body1' => $body1,
            'name' => $name,
            'contact_number'=>$contact_number,
            'email' => $email,
            'description' => $description,
            'copyright' => 'copyright'
            ], function ($m) use ($user) {
                $m->from('support@grabmorenow.com');
                $m->to($user->email, ucwords(strtolower($user->first_name)))->subject('New feedback: '.$user->subject);
        });
        if($mail){
               //return true;
          }
        }catch(Exception $e){
            //return false;
        }
    }





    /**
     * Add new Tesimonials By the user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function addTestimonial(Request $request){
        try{
            
            if(self::isValidToekn($request)){
                $validator = Validator::make($request->all(), [
                    'name' => 'required|min:6',
                    'text' => 'required',
                    'user_id' => 'required|numeric'
                ]);
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $this->responseArray['status'] = false;
                    $this->responseArray['message']= "Input are not valid";
                    $this->responseArray['error']= $errors;
                }else{
                    $name = $request->get('name');
                    $user_id = $request->get('user_id');
                    $text = $request->get('text');
                    $testimonialsObj = new Testimonial();
                    $testimonialsObj->full_name = $name;
                    $testimonialsObj->user_id = $user_id;
                    $testimonialsObj->text = $text;
                    $testimonialsObj->created_at = self::getCreatedDate();
                    try{
                        $testimonialsObj->save();
                        $testimonialsObj->id;
                        $this->responseArray = self::getMessage(200,"Thanks for your time.");
                    }catch (Exception $e) {
                        $this->responseArray['status'] = false;
                        $this->responseArray['message'] = self::getMessage(9999,$e->getMessage());
                    }

                }

            }
        }catch (Exception $e) {
            $this->responseArray['status'] = false;
            $this->responseArray['message'] = self::getMessage(9999,$e->getMessage());
        }
        return response()->json($this->responseArray);


    }

}