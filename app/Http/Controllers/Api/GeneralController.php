<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Master;
use Auth;
use App\User;
use App\SaleUser;
use App\Location;
use Session;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Category;
use App\StoreType;
use App\Brand;
use App\MasterUnit;
use DB;

class GeneralController extends Master
{
   
    /***API For Location****/
    public function getStateList(){
    	$stateArray = array();
    	try{
        	$stateList = Location::where('status','=',1)->groupBy('state')->select('state')->get()->toArray();
        	if(count($stateList)>0){
        		foreach($stateList as $stateListObj){
        			$stateKey = str_replace(" ","_",strtolower($stateListObj['state']));
        			$stateValue = $stateListObj['state'];
        			$stateArray[$stateKey] = $stateValue;
        		}
            	$responseArray['status'] = true;
	        	$responseArray['message'] = "success";
          		$responseArray['result'] = $stateArray;        	

        	}else{
            	$responseArray['status'] = false;
	        	$responseArray['message'] = "No State Found";
        	}
    	}catch (Exception $e) {
            $responseArray['status'] = false;
            $responseArray['message'] = $e->getMessage();
        }

        return response()->json($responseArray);
    }







    /******Get City/Distict List*******/
    public function getDistrictList(Request $request){
    	$districtList = array();
    	$districtListArray = array();
    	if(self::isValidToekn($request)){
    		$validator = Validator::make($request->all(), [
                'state' => 'required'
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $responseArray['status'] = false;
                $responseArray['message']= "State name required.";
                $responseArray['error']= $errors;
            }else{
            	$stateName = ucwords(str_replace("_"," ",$request->get('state')));
            	$districtList = Location::where('state','=',$stateName)->where('status','=',1)->groupBy('district')->select('district')->get()->toArray();
            	if(count($districtList)>0){

            		foreach($districtList as $distObj){
            			$disKey = str_replace(" ","_",strtolower($distObj['district']));
	        			$disValue = $distObj['district'];
            			$districtListArray[$disKey] = $disValue;
            		}
	            	$responseArray['status'] = true;
		        	$responseArray['message'] = "success";
    		    	$responseArray['result'] = $districtListArray;  

            	}else{
                	$responseArray['status'] = false;
		        	$responseArray['message'] = "No district found";
            	}

            }
    	}else{
    		$responseArray['status'] = false;
            $responseArray['message']= "Invalid Token.";
    	}
    	return response()->json($responseArray);

    }




    /******Get City/Distict List*******/
    public function getAllLocationList(Request $request){
    	$typeList = array();
    	$typeListArray = array();
    	if(self::isValidToekn($request)){
    		$validator = Validator::make($request->all(), [
                'state' => 'required',
                'district' => 'required'
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $responseArray['status'] = false;
                $responseArray['message']= "State name required.";
                $responseArray['error']= $errors;
            }else{
            	$stateName = ucwords(str_replace("_"," ",$request->get('state')));
            	$districtName = ucwords(str_replace("_"," ",$request->get('district')));
            	$typeList = Location::where('state','=',$stateName)->where('district','=',$districtName)->where('status','=',1)->get()->toArray();
            	if(count($typeList)>0){
            		foreach($typeList as $typeObj){
            			$typeListArray[$typeObj['id']] = $typeObj;
	          		}
                	$responseArray['status'] = true;
		        	$responseArray['message'] = "success";
    		    	$responseArray['result'] = $typeListArray;  

            	}else{
                	$responseArray['status'] = false;
		        	$responseArray['message'] = "No district found";
            	}

            }
    	}else{
    		$responseArray['status'] = false;
            $responseArray['message']= "Invalid Token.";
    	}
    	return response()->json($responseArray);

    }





    /*********All Category List**********/
    public function getAllCategoryList(Request $request){
    	if(self::isValidToekn($request)){
    		$parent_id = $request->get('parent_id');
    		$categoryList = Category::where('parent_id','=',$parent_id)->where('status','=',1)->get()->toArray();
    		if(count($categoryList)>0){
    			$responseArray['status'] = false;
	        	$responseArray['message'] = "success";
	        	$responseArray['result'] = $categoryList;

    		}else{
                	$responseArray['status'] = false;
		        	$responseArray['message'] = "No category found";
            }
    	}else{
    		$responseArray['status'] = false;
            $responseArray['message']= "Invalid Token.";
    	}
    	return response()->json($responseArray);

    }






    /*********All Store Type List**********/
    public function getStoreTypeList(Request $request){
    	if(self::isValidToekn($request)){
    		$typeList = StoreType::where('status','=',1)->get()->toArray();
    		if(count($typeList)>0){
    			$responseArray['status'] = false;
	        	$responseArray['message'] = "success";
	        	$responseArray['result'] = $typeList;

    		}else{
                	$responseArray['status'] = false;
		        	$responseArray['message'] = "No Store Type Found";
            }
    	}
    	return response()->json($responseArray);

    }




    /*********All Brand Type List**********/
    public function getBrandTypeList(Request $request){
    	if(self::isValidToekn($request)){
    		$typeList = Brand::where('status','=',1)->get()->toArray();
    		if(count($typeList)>0){
    			$responseArray['status'] = false;
	        	$responseArray['message'] = "success";
	        	$responseArray['result'] = $typeList;

    		}else{
                	$responseArray['status'] = false;
		        	$responseArray['message'] = "No Brand Type Found";
            }
    	}
    	return response()->json($responseArray);

    }





     /*********All MAster Type List**********/
    public function getMasterUnitList(Request $request){
    	if(self::isValidToekn($request)){
    		$typeList = MasterUnit::where('parent_id','=',0)->where('status','=',1)->get()->toArray();
    		if(count($typeList)>0){
    			foreach($typeList as $k=>$child){
    				$typeChildList = MasterUnit::where('parent_id','=',$child['id'])->where('status','=',1)->where('status','=',1)->get()->toArray();
    				$typeList[$k]['Child']=$typeChildList;
    			}
    			$responseArray['status'] = false;
	        	$responseArray['message'] = "success";
	        	$responseArray['result'] = $typeList;

    		}else{
                	$responseArray['status'] = false;
		        	$responseArray['message'] = "No Unit Type Found";
            }
    	}
    	return response()->json($responseArray);

    }




    /*** Location Search Result *****/
  	public function getLocationResult(Request $request){
  		$query = $request->get('text');
		if($query != '')
	      {
	       $data = DB::table('locations')
	         ->where('status', '=', '1')
	         ->where('location', 'like', '%'.$query.'%')
	         ->orWhere('pincode', 'like', '%'.$query.'%')
	         ->orWhere('state', 'like', '%'.$query.'%')
	         ->orWhere('district', 'like', '%'.$query.'%')
	         ->get();
	         $total_row = $data->count();
	         $output=array();
	         if($total_row > 0){

                if($request->has('type')){
                    $list="<ul  class='list-group'>";
                    foreach($data as $row){
                        $list.="<li class='list-group-item listItem' id='listid_".$row->id."' onclick='setLocationId(".$row->id.")'>".$row->location." ".$row->district." ".$row->pincode." ".$row->state."</li>";
                    }
                    $list.="</ul>";
                    $output = $list;

                }else{
                    
                    foreach($data as $row){
                        $output[]=array(
                            "location_id"=>$row->id,
                            "location"=>$row->location,
                            "district"=>$row->district,
                            "pincode"=>$row->pincode,
                            "state"=>$row->state
                        );
                }

                }
		        $responseArray['status'] = true;
		        $responseArray['result'] = $output;
	        }else{
	        	$responseArray['status'] = false;
	 	        $responseArray['message'] = "No result found.";
	        }
	        
	        return response()->json($responseArray);
	    }  		
    }
  


}
