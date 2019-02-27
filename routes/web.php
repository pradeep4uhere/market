<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| USer Section Start Here 
|--------------------------------------------------------------------------
|
| This value is the name of your application. This value is used when the
| framework needs to place the application's name in a notification or
| any other location as required by the application or its packages.
|
*/


    /**************Import Product****************************/
    Route::get('qrcode', function () {
            return QrCode::size(250)->generate('http://www.go4shop.online');
    });
    Route::get('/importproduct', 'Import\ImportController@getImport')->name('import');
    Route::post('/import_parse', 'Import\ImportController@parseImport')->name('import_parse');
    Route::post('/import_process', 'Import\ImportController@processImport')->name('import_process');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('/notify', 'PusherController@sendNotification');
    Route::view('/home', 'home');

    

    //ExamplePages
    Route::view('/page1', 'prssystem.page.page1');

    Route::get('storage/product/{productid}/{path}/{filename}', function ($productid,$path,$filename)
    {
        $path = storage_path('app/public/uploads/product/product_'.$productid .'/'.$path.'/'. $filename);
        if (!File::exists($path)) {
            return "Image Not Found.";
        }else{
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        }
    });



    Route::post('/feedback','FeedbackController@feedback')->name('feedback');

    Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login','Auth\LoginController@login')->name('login');
    
    Route::get('/register', 'Auth\RegisterController@registerPage')->name('register');
    Route::post('/register', 'Auth\RegisterController@register')->name('register');
    Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::get('getcity/{state_name}','Master@getCityList');
    Route::get('getdislist/{district}','Master@getlocationlist')->name('getdislist');


    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/listing', 'HomeController@listing')->name('listing');
    Route::get('/detail/{slug}/{id}', 'Product\ProductController@details')->name('details');
    Route::post('/getlocation', 'HomeController@getlocation')->name('getlocation');
    
    //All Cart Routing
    Route::any('/seller/{seller}/{id}', 'Seller\SellerController@sellerview')->name('sellerview');
    Route::any('/seller/{seller}/{id}/{category_id}', 'Seller\SellerController@getProductFilterList')->name('getProductFilterList');
    Route::get('loadmore', 'Seller\SellerController@loadMoreProduct')->name('sellerProductList');
	
    
    //General Page
    Route::get('/page/faq', 'Page\PageController@FAQ')->name('faq');
    Route::get('/page/{slug}', 'Page\PageController@viewPage')->name('viewPage');
    Route::get('/allfaqs', 'Page\PageController@allfaqs')->name('allfaqs');
    Route::get('/contactus', 'Page\PageController@contactus')->name('contactus');
    Route::post('/contactus', 'Page\PageController@contactus')->name('contactus');
    
    Route::group(['middleware' => 'auth'], function () {
        Route::post('/cart/{id}', 'Product\CartController@addToCart')->name('addtoCart');
        Route::get('/cart', 'Product\CartController@index')->name('cart');
        //Route::get('/cart/{_id}', 'Product\CartController@index')->name('cart');
        Route::post('/updatecart', 'Product\CartController@updateCart')->name('updatecart');
        Route::get('/removecartitem/{id}', 'Product\CartController@removeCartItem')->name('removeCartItem');
        Route::post('/addtocart', 'Product\CartController@addToCart')->name('addtocart');
        Route::any('/checkoutinit', 'Product\CartController@checkoutinit')->name('checkoutinit');
        Route::any('/preorder', 'Payment\PaymentController@preorder')->name('preorder');
        Route::any('/choosepayment', 'Payment\PaymentController@choosepayment')->name('choosepayment');
        Route::any('/orderpost', 'Order\OrderController@orderpost')->name('orderpost');
        Route::get('/thanks/{token}/{id}', 'Order\OrderController@thankyou')->name('thanks');
        Route::post('/addaddress', 'User\UserController@AddAddress')->name('addaddress');
        Route::post('/failed', 'Order\OrderController@paymentFailed')->name('failed');
        Route::post('/success', 'Order\OrderController@paymentSuccess')->name('success');

        Route::get('/updateprofile', 'User\UserController@profile')->name('updateProfile');        
        Route::get('/profile', 'User\UserController@dashboard')->name('dashboard');        
        Route::get('/logout', 'User\UserController@logout')->name('logout'); 
        //Seller Profile Start Here
        Route::get('/seller/dashboard', 'Seller\SellerController@dashboard')->name('seller');
        Route::get('/seller/orderlist', 'Seller\SellerController@orderlist')->name('orderlist');
        Route::get('/seller/orderdetails', 'Seller\SellerController@orderDetails')->name('orderdetails');
        Route::get('/seller/updateorder', 'Seller\SellerController@updateOrderState')->name('updateorder');
        
        Route::post('/seller/{id}', 'Seller\SellerController@sellerProfile')->name('updateSellerProfile');
        Route::get('/sellerimg/{id}', 'Seller\SellerController@sellerImages')->name('sellerimggallery');
        Route::post('/addSellerImg', 'Seller\SellerController@addSellerImg')->name('addSellerImg');
        Route::post('/getcity', 'User\UserController@getcity')->name('getcity');
        Route::post('/getaddress', 'User\UserController@getAddressById')->name('getaddress');
		Route::post('/removeaddress', 'User\UserController@RemoveAddressById')->name('removeaddress');
		
		
		Route::get('/deleteSellerImage/{id}', 'Seller\SellerController@deleteSellerImage')->name('deleteSellerImage');
        Route::get('/hideSellerImage/{id}', 'Seller\SellerController@hideSellerImage')->name('hideSellerImage');
        Route::get('/showSellerImage/{id}', 'Seller\SellerController@showSellerImage')->name('showSellerImage');
        Route::get('/setAsDefault/{user_id}/{id}', 'Seller\SellerController@setSellerImageAsDefault')->name('setSellerImageAsDefault');
        //Image
		Route::get('resizeImage', 'ImageController@resizeImage');
		Route::post('resizeImagePost',['as'=>'resizeImagePost','uses'=>'ImageController@resizeImagePost']);
        
        //Product Realted Link
        Route::get('/allproduct', 'Product\ProductController@allProductList')->name('allproduct');
        Route::get('/addproduct', 'Product\ProductController@addProduct')->name('addproduct');
        Route::post('/saveproduct', 'Product\ProductController@saveProduct')->name('saveproduct');
        Route::get('/addProductImg/{id}', 'Product\ProductController@addProductImg')->name('addProductImg');
        Route::post('/addProductImg/{id}', 'Product\ProductController@addProductImg')->name('addProductImg');
        Route::get('/editproduct/{id}', 'Product\ProductController@editProduct')->name('editProduct');
        Route::post('/editproduct/{id}', 'Product\ProductController@editProduct')->name('editProduct');
        Route::get('/deleteProduct/{id}', 'Product\ProductController@deleteProduct')->name('deleteProduct');
        Route::get('/deleteProductImage/{id}', 'Product\ProductImageController@deleteProductImage')->name('deleteProductImage');
        Route::get('/hideProductImage/{id}', 'Product\ProductImageController@hideProductImage')->name('hideProductImage');
        Route::get('/showProductImage/{id}', 'Product\ProductImageController@showProductImage')->name('showProductImage');
        Route::get('/setAsDefault/{prod_id}/{id}', 'Product\ProductImageController@setProductImageAsDefault')->name('setProductImageAsDefault');
        Route::post('/productattr/{id}', 'Product\ProductController@productAttr')->name('productattr');


        
        //Category Section
		Route::get('/allcategory', 'Category\CategoryController@allcategory')->name('allcategory');
		Route::get('/getcategory', 'Category\CategoryController@getAllCategory')->name('getcategory');
        Route::get('/addcategory', 'Category\CategoryController@addcategory')->name('addcategory');
        Route::post('/savecategory', 'Category\CategoryController@savecategory')->name('savecategory');
        Route::post('/delcategory', 'Category\CategoryController@delcategory')->name('delcategory');

        Route::get('/getbrands', 'Brand\BrandController@getAllBrands')->name('getbrands');
        Route::post('/savebrand', 'Brand\BrandController@savebrand')->name('savebrand');
        
		//All Ajax Call herer
        Route::post('/getSubCategory', 'Category\CategoryController@getSubCategory')->name('getSubCategory');
        Route::post('/getBrandList', 'Brand\BrandController@getBrandList')->name('getBrandList');

        //File Manager
        Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
        Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    });
        


    // Admin routes
    Route::group(array('prefix' =>'user/'), function () {
        Route::get('/register', 'Auth\RegisterController@registerPage')->name('register');
		Route::post('/register', 'Auth\RegisterController@register')->name('register');
		Route::get('/thankyou', 'Auth\RegisterController@thankyou')->name('thankyou');
		Route::get('/updateprofile', 'User\UserController@updateProfile')->name('updateProfile');
		Route::get('/sellerregister', 'Seller\SellerController@sellerregister')->name('sellerregister');
		Route::get('/profile', 'User\UserController@dashboard')->name('dashboard');
		Route::post('/profile', 'User\UserController@updateProfile')->name('updateUserProfile');

        //Get All User Order list
        Route::get('/myorders', 'User\UserController@getOrderList')->name('myorders');
    });


    // Admin routes
    Route::group(array('prefix' =>'seller/'), function () {
        Route::get('/', 'Seller\SellerController@sellerProfile')->name('seller');
        Route::get('/dashboard', 'Seller\SellerController@dashboard')->name('sellerdashboard');
        Route::get('/addproduct', 'Product\ProductController@addProduct')->name('selleraddproduct');
    });

    // Admin routes
    Route::group(['middleware' => 'auth','prefix' =>'admin'], function () {
            Route::post('/contactus', 'Page\PageController@contactus')->name('contactus');
            Route::get('/contactus', 'Page\PageController@contactus')->name('contactus');
            Route::get('/page/allpagelist', 'Page\PageController@allPageList')->name('allPageList');
            Route::get('/page/{slug}', 'Page\PageController@updatePage')->name('editContent');
            Route::post('/page/{slug}', 'Page\PageController@updatePage')->name('updatePage');
            Route::get('/page/faq/{id}', 'Page\PageController@updateFaq')->name('updatePageFaq');
            Route::post('/page/faq/{id}', 'Page\PageController@updateFaq')->name('updatePageFaq');
    });
