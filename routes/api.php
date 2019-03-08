<?php
use Illuminate\Http\Request;
Route::group(['prefix' => 'en/v1/'], function (){
	
	//Twilio API Integration
	//http://go4shop.online/api/en/v1/sms/twilio
	Route::any('chat', 'Api\ApiController@chat')->name('chat');
	Route::any('sms/twilio', 'Api\ApiController@twiliowhatsapp')->name('twilio');



	Route::any('gettoken', 'Api\ApiController@gettoken')->name('gettoken');
	
	Route::any('gettoken', 'Api\ApiController@gettoken')->name('gettoken');
	Route::any('getstoretype', 'Api\ApiController@getStoreType')->name('getstoretype');
	

	//All User Related API
	Route::any('login', 'Api\UserController@login')->name('login');
	Route::any('register', 'Api\UserController@register')->name('register');
	Route::any('sellerregister', 'Api\SellerController@registerAsSeller')->name('sellerregister');
	Route::any('getproductlist', 'Api\UserController@register')->name('getproductlist');
	Route::get('sendemail','Api\UserController@sendEmailReminder');
	Route::any('updateuserprofile','Api\UserController@updateUserProfile')->name('updateuserprofile');

	//Cart Related API
	Route::any('adddeliveraddress','Api\OrderController@addDeliveryAddress')->name('adddeliveraddress');
	
	

	//All Sales API
	Route::any('salesregister', 'Api\SaleUserController@register')->name('register');

	/*******************All Master List Here************************************/

	//Location API
	Route::any('getstatelist', 'Api\GeneralController@getStateList')->name('getstatelist');
	Route::any('getdistrictlist', 'Api\GeneralController@getDistrictList')->name('getdistrictlist');
	Route::any('getlocationlist', 'Api\GeneralController@getAllLocationList')->name('getlocationlist');

	//Categpry List
	Route::any('getallcategorylist', 'Api\GeneralController@getAllCategoryList')->name('getallcategorylist');

	//Store Type List
	Route::any('getstoretypelist', 'Api\GeneralController@getStoreTypeList')->name('getstoretypelist');


	//Brand Type List
	Route::any('getbrandtypelist', 'Api\GeneralController@getBrandTypeList')->name('getbrandtypelist');

	//Master Unit Type List
	Route::any('getunitlist', 'Api\GeneralController@getMasterUnitList')->name('getunitlist');



	/*******************All Master List Here************************************/


	//Add New Product
	Route::any('addnewproduct', 'Api\ProductController@addNewProduct')->name('addnewproduct');
	Route::any('uploadimage', 'Api\ProductController@uploadimage')->name('uploadimage');
	
	

	//Feedback API
	Route::any('feedbackquery','Api\FeedbackController@feedbackSubmitt')->name('feedbackquery');

	//Location Search
	Route::any('getlocation','Api\GeneralController@getLocationResult')->name('getlocation');
	
	//Seller List
	Route::any('getsellerlist','Api\SellerController@getSellerList')->name('getsellerlist');

	//Get All Seller Products List
	Route::any('allproductlist','Api\SellerController@allSellerProductList')->name('allproductlist');


	//Cart 
	Route::any('addtocart','Api\CartController@addToCart')->name('addtocart');
	Route::any('removeitemfromcart','Api\CartController@removeCartItem')->name('removeitemfromcart');
	Route::any('updatecart','Api\CartController@updateCart')->name('updatecart');
	Route::any('getcartlist','Api\CartController@getCartList')->name('getcartlist');

	//Testimonials
	Route::any('addtestimonial','Api\FeedbackController@addTestimonial')->name('addtestimonial');


	


});
