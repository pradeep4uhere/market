<?php
namespace App\Http\Controllers\Page;
use App\Http\Controllers\Master;
use Illuminate\Http\Request;
use App\ContactUs;
use Illuminate\Support\Facades\Validator;
use App\Page;
use App\Faq;


class PageController extends Master
{


    /***************Update Page Content****************/
    public function updateFaq(Request $request,$id){

        $pageRow = Faq::find($id);
        if ($request->isMethod('post')) {
            $id =  $pageRow['id'];
            $pageObj = Faq::find($id);
            $pageObj->title = $request->get('title');
            $pageObj->descriptions = $request->get('misc');
            $pageObj->status = $request->get('status');
            $pageObj->created_at = self::getCreatedDate();
            $pageObj->save();
        }
        $pageRow = Faq::find($id);
        return view(Master::loadFrontTheme('page.editfaq'),array('pageRow'=>$pageRow));
    }


     /***************Update Page Content****************/
    public function updatePage(Request $request,$slug){
        $pageRow = Page::where('slug','=',$slug)->first()->toArray();
        if ($request->isMethod('post')) {
            $id =  $pageRow['id'];
            $pageObj = Page::find($id);
            $pageObj->title = $request->get('title');
            $pageObj->description = $request->get('misc');
            $pageObj->created_at = self::getCreatedDate();
            $pageObj->save();
        }
        $pageRow = Page::where('slug','=',$slug)->first()->toArray();
        return view(Master::loadFrontTheme('page.editcontent'),array('pageRow'=>$pageRow));
    }


    /***************Update Page Content****************/
    public function viewPage(Request $request,$slug){
        $pageRowObj = Page::where('slug','=',$slug)->first();
        
        if(!empty($pageRowObj)){
            $pageRow = $pageRowObj->toArray();
        }else{
            return abort('404');
        }
        return view(Master::loadFrontTheme('page.static'),array('pageRow'=>$pageRow));
    }



    /***************FAQ***************************/
    public function FAQ(Request $request){
        $metaTags = self::getMetaTags();
        $faqObj = FAQ::with('Child')->where('status','=','1')->orderBy('type','ASC')->get();
        $newFaq = array();
        if(!empty($faqObj)){
            $faqObjArr = $faqObj->toArray();
            $count = 1;
            $titleStr = "";
            $descriptionStr = "";
            $createdAtStr = "";
            $updatedAtStr= "";
            foreach($faqObjArr as $val){
                if($count==1){
                    $titleStr = $val['title'];
                    $descriptionStr = $val['descriptions'];
                    $createdAtStr = $val['created_at'];
                    $updatedAtStr = $val['updated_at'];
                }
                $count++;
                $newFaq[$val['type']][]=$val;
            }
        }
        $metaTags['description'] ='FAQ-'.$descriptionStr;
        $metaTags['keywords'] ='Faq,User,Seller, Buyer, General';
        $metaTags['pageimage'] =self::getLogo();
        $metaTags['pageurl'] =self::getURL().'/page/faqs';
        $metaTags['publishedTime'] =$createdAtStr;
        $metaTags['modifiedTime'] =$updatedAtStr;
        $metaTags['section'] ='FAQ';
        $metaTags['category'] ='Help';
        $metaTags['tag'] ='Faq';
        $metaTags['article'] ='Faq';
        $metaTags['twittersite'] ='';
        $metaTags['urlimage'] =self::getLogo();
        $metaTags['title'] ='Faq-'.$titleStr;
        $metaTags['url'] =self::getURL().'/page/faqs';
        $metaTags['sitename'] =self::getAppName();
        return view(Master::loadFrontTheme('page.faq'),array('faqArr'=>$newFaq,'metaTags'=>$metaTags));
    }



    /***************FAQ***************************/
    public function contactus(Request $request){

        $responseArray = array();
        if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|min:3',
                'surname' => 'required|min:3',
                'email' => 'required|min:6',
                'phone' => 'required|min:10',
                'message' => 'required',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $responseArray['status'] = false;
                $responseArray['message']= "Input are not valid";
                $responseArray['error']= $errors;
            }else{
                $name = $request->get('name');
                $surname = $request->get('surname');
                $email = $request->get('email');
                $phone = $request->get('phone');
                $message = $request->get('message');
                try{
                    $contactObj = new ContactUs();
                    $contactObj->first_name = $name;
                    $contactObj->last_name = $surname;
                    $contactObj->email = $email;
                    $contactObj->phone = $phone;
                    $contactObj->message = $message;
                    $contactObj->created_at = self::getCreatedDate();
                    $contactObj->save();
                    $responseArray['status'] = true;
                    $responseArray['message']= "Thank you for contact us, we will back to you 2 business working days.";
                    Master::sendEmailToUser('contactUs',$request,NULL);
                }catch(Exception $e){
                    $responseArray['status'] = '9999';
                    $responseArray['message']= "Somthing went wrong, Please try after sometime.";
                }
                   //     dd($responseArray);


            }
        }
        // return view(Master::loadFrontTheme('page.contactus'),array('error'=>$responseArray));
        return view('landing.contactus',array('error'=>$responseArray));
    }

}
