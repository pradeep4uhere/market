<?php 
namespace App\Helpers;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!function_exists('themeUrl')) {
    function themeUrl($type){
        $type= strtolower(trim($type));
        switch($type){
            case 'css':  return config('global.THEME_URL_CSS');
                         break;
            case 'js':   return config('global.THEME_URL_JS');
                         break;
            case 'image':return config('global.THEME_URL_IMAGE');
                         break;
            default:    return "Invalid Parameter!!";
                        break;
        }
        
    }
}




if (!function_exists('sellerAccountList')) {
	function sellerAccountList(){
		$sellerObj = new \App\Seller();
		$sellerProfile=$sellerObj->getSellerList();
		dd($sellerProfile);
	}
}