<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Master;
use Auth;
use App\User;
use Session;
use App\City;
use App\DeliveryAddress;

class UserController extends Master
{
    public function __construct() {
       $this->middleware('auth')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Master::redirect('login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        if ($request->isMethod('post')) {
            $data=$request->all();
            $data['id']=Auth::user()->id;
            $validator = $this->validator($request->all());
            
            if($validator->fails()) {
//                dd($validator->errors()->all());
                $error=$validator->errors()->all();
                Session::flash('error', $error);
            }else{
                $this->updateUser($data);
            }
        }
        $user=User::find(Auth::user()->id);
        return view(Master::loadFrontTheme('user.editprofile'),array('user'=>$user));
    }
    
    
    
      /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function updateUser(array $data)
    {
        $user= \App\User::find($data['id']);
        $user->id =$data['id'];
        $user->first_name =$data['first_name'];
        $user->last_name =$data['last_name'];
        $user->address_1 =$data['address1'];
        $user->address_2 =$data['address2'];
        $user->address_3 =$data['address3'];
        $user->pincode =$data['pincode'];
        $user->mobile =$data['mobile'];
        $user->email =$data['email'];
        try{
            if($user->save()){
               Session::flash('message', 'Profile Updated Successfully!'); 
            }else{
                Session::flash('message', 'Profile Not Updated !'); 
            }
        }catch(QueryException  $exception)
        {
            $errormsg = 'Database error! ' . $exception->getCode();
            dd($errormsg);
        }
    }

        
     /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $user= \App\User::find(Auth::user()->id);
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'mobile' => 'required|string|string|min:10|unique:users,mobile,'.$user->id,
            'pincode' => 'required|string|string|min:6',
            
        ]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        return view(Master::loadFrontTheme('user.dashboardProfile'));
    }
    
    
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }


    public function AddAddress(Request $request){
        
        //dd($request->all());
        $id = $request->get('id');
        if($id!=''){
            $dAddObj = DeliveryAddress::find(decrypt($id));
        }else{
            $dAddObj = new DeliveryAddress();
        }
        $dAddObj->user_type =1;
        $dAddObj->user_id =Auth::user()->id;
        $dAddObj->full_name = ucwords($request->get('full_name'));
        $dAddObj->address_1 = $request->get('address_1'); 
        $dAddObj->address_2 = $request->get('address_2'); 
        $dAddObj->landmarks = $request->get('landmarks'); 
        $dAddObj->mobile = $request->get('mobile'); 
        $dAddObj->pincode = $request->get('pincode'); 
        $dAddObj->city_id = $request->get('city_id'); 
        $dAddObj->state_id = $request->get('state_id'); 
        $dAddObj->created_at = date('Y-m-d H:i:s'); 
        if($dAddObj->save()){
            Session::flash('message', 'Address Added!');
        }else{
            Session::flash('message', 'Somthing went wrong!');
        }
        return redirect()->back();
    }

    public function getCity(Request $request){
        $stateId = $request->get('state_id');
        $cityArr = City::where('state_id','=',$stateId)->where('status','=',1)->select('id','city_name')->get();
        $str=" <option>Select City</option>";
        foreach ($cityArr as $value) {
            $str.='<option value="'.$value['id'].'">'.$value['city_name'].'</option>';
        }
        $result = array('status'=>'success','result'=>$str);
        return json_encode($result);
    }


    function getAddressById(Request $request){
        $id= decrypt($request->get('id'));
        $address=array();
        $sendArr=array();
        if($id>0){
            $address=DeliveryAddress::where('id','=',$id)
            ->where('user_id','=',Auth::user()->id)
            ->first();
            $sendArr['full_name']=$address['full_name'];
            $sendArr['address_1']=$address['address_1'];
            $sendArr['address_2']=$address['address_2'];
            $sendArr['landmarks']=$address['landmarks'];
            $sendArr['city_id']=$address['city_id'];
            $sendArr['state_id']=$address['state_id'];
            $sendArr['pincode']=$address['pincode'];
            $sendArr['mobile']=$address['mobile'];
            $sendArr['id']=encrypt($address['id']);
            $result = array('status'=>'success','result'=>$sendArr);
        }else{
            $result = array('status'=>'error','result'=>[],'message'=>'Invalid Id.');
        }
        return json_encode($result);


    }

    function RemoveAddressById(Request $request){
        $id = decrypt($request->get('id'));
        $delObj = DeliveryAddress::where('user_id','=',Auth::user()->id)->where('id','=',$id)->delete();
        if($delObj){
            $result = array('status'=>'success','message'=>'Address Deleted');
        }else{
            $result = array('status'=>'error','result'=>[],'message'=>'Invalid Id.');
        }
        return json_encode($result);
    }

}