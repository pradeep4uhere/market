<?php
// define path

$public_path = public_path();           // /var/www/html/marketadmin/public
$files_path = $public_path.'/files';
$base_path = base_path();               // /var/www/html/marketadmin

$public_url = env('APP_URL');    // http://marketadmin.localhost/
$files_url = $public_url.'files/';
$assets_url = $public_url.'assets/';

$localmode = false;
if(env('APP_ENV') == 'local') {
    $localmode = true;
}

//Set all the Directory Path
//Upload all images
$loaderImg = "";
//Business Images
$uploadDir='uploads';
$businessDir='business_logo';
$businessLogoDir='logo';
$businessLogoThumbDir='thumbnail';
$businessLogoDirPath=$uploadDir.DIRECTORY_SEPARATOR.$businessDir.DIRECTORY_SEPARATOR.$businessLogoDir;
$businessLogoThumbDirPath=$uploadDir.DIRECTORY_SEPARATOR.$businessDir.DIRECTORY_SEPARATOR.$businessLogoThumbDir;
$businessThumbWidth='100';
$businessThumbHeight='100';

$productDir='product';
$productUploadDir=$uploadDir.DIRECTORY_SEPARATOR.$productDir;
$productMainDir='main';
$productThumbDir='thumbnail';
$productDirPath=$uploadDir.DIRECTORY_SEPARATOR.$productDir.DIRECTORY_SEPARATOR.$productMainDir;
$productThumbDirPath=$uploadDir.DIRECTORY_SEPARATOR.$productDir.DIRECTORY_SEPARATOR.$productThumbDir;
$productWidth='500';
$productHeight='500';
$productThumbWidth='200';
$productThumbHeight='200';


$sellerDir='seller';
$sellerUploadDir=$uploadDir.DIRECTORY_SEPARATOR.$sellerDir;
$sellerMainDir='main';
$sellerThumbDir='thumbnail';
$sellerDirPath=$uploadDir.DIRECTORY_SEPARATOR.$sellerDir.DIRECTORY_SEPARATOR.$sellerMainDir;
$sellerThumbDirPath=$uploadDir.DIRECTORY_SEPARATOR.$sellerDir.DIRECTORY_SEPARATOR.$sellerThumbDir;
$sellerWidth='500';
$sellerHeight='500';
$sellerThumbWidth='250';
$sellerThumbHeight='250';

return [
    'LOGO'=>$public_url.'/public/theme/prssystem/img/front/logo1.png',
    'CLIENT_SECRET'=>env('CLIENT_SECRET'),
    'THEME'=>'prssystem',
    'ADMIN_URL_CSS'=>$public_url.'/public/assets/css/',
    'ADMIN_URL_JS'=>$public_url.'/public/assets/js/',
    'ADMIN_URL_IMAGE'=>$public_url.'/public/assets/img/',

    'THEME_URL_CSS'=>$public_url.'/public/theme/prssystem/css',
    'THEME_URL_JS'=>$public_url.'/public/theme/prssystem/js',
    'THEME_URL_IMAGE'=>$public_url.'/public/theme/prssystem/img',

    'LANDING_URL'=>$public_url.'/public/theme/landing',
    
    'THEME_URL_FRONT_CSS'=>$public_url.'/public/theme/prssystem/css/front',
    'THEME_URL_FRONT_JS'=>$public_url.'/public/theme/prssystem/js/front',
    'THEME_URL_FRONT_IMAGE'=>$public_url.'/public/theme/prssystem/img/front',
    
    'UPLOAD_DIR'=>public_path($uploadDir),
    'BUSINESS_DIR'=>public_path($businessDir),
    'BUSINESS_IMG_DIR'=>public_path($businessLogoDirPath),
    'BUSINESS_THUMB_DIR'=>public_path($businessLogoThumbDirPath),
    'BUSINESS_THUMB_WIDTH'=>$businessThumbWidth, // set thumbnail height of the image
    'BUSINESS_THUMB_HEIGHT'=>$businessThumbHeight, // set thumbnail width of the image
    'IMG_EXT'=>array('jpeg','png','jpg','gif','svg'), // set thumbnail width of the image
    'BUSINESS_THUMB_IMG'=>$public_url.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$uploadDir.DIRECTORY_SEPARATOR.$businessDir.DIRECTORY_SEPARATOR.$businessLogoThumbDir,
    
    'PRODUCT_DIR'=>public_path($productDir),
    'PRODUCT_UPLOAD_DIR'=>public_path($productUploadDir),
    'PRODUCT_IMG_DIR'=>public_path($productDirPath),
    'PRODUCT_THUMB_DIR'=>public_path($productThumbDirPath),
    'PRODUCT_IMG_WIDTH'=>$productWidth,
    'PRODUCT_IMG_HEIGHT'=>$productHeight,
    'PRODUCT_THUMB_IMG_WIDTH'=>$productThumbWidth,
    'PRODUCT_THUMB_IMG_HEIGHT'=>$productThumbHeight,
    'PRODUCT_IMG_URL'=>$public_url.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$productDirPath,
    'PRODUCT_THUMB_IMG'=>$public_url.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$productThumbDirPath,
    'PRODUCT_IMG_GALLERY'=>$public_url.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$uploadDir.DIRECTORY_SEPARATOR.$productDir,
	
	'SELLER_DIR'=>public_path($sellerDir),
    'SELLER_UPLOAD_DIR'=>public_path($sellerUploadDir),
    'SELLER_IMG_DIR'=>public_path($sellerDirPath),
    'SELLER_THUMB_DIR'=>public_path($sellerThumbDirPath),
    'SELLER_IMG_WIDTH'=>$sellerWidth,
    'SELLER_IMG_HEIGHT'=>$sellerHeight,
    'SELLER_THUMB_IMG_WIDTH'=>$sellerThumbWidth,
    'SELLER_THUMB_IMG_HEIGHT'=>$sellerThumbHeight,
    'SELLER_IMG_URL'=>$public_url.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$sellerDirPath,
    'SELLER_THUMB_IMG'=>$public_url.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$sellerThumbDirPath,
    'SELLER_IMG_GALLERY'=>$public_url.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$uploadDir.DIRECTORY_SEPARATOR.$sellerDir,

    'SELLER_STORAGE_DIR'=>asset("storage/app/public/uploads/seller/"),
    'PRODUCTS_STORAGE_DIR'=>asset("storage/app/public/uploads/products/"),
    
    
];

?>