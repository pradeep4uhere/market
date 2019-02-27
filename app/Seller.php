<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;
class Seller extends Model
{
    protected $table = 'sellers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_type_id',
        'business_name',
        'businessusername',
        'address_1', 
        'address_2', 
        'email_address', 
        'contact_number',
        'user_id',
        'pincode_id',
        'state_id',
        'city_id',
        'district',
        'state',
        'location',
        'location_id',
        'pincode',
        'referer_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ ];
    
    public function User() {
         return $this->belongsTo('App\User', 'user_id', 'id' );
    }
	
	public function SellerImage() {
         return $this->hasMany('App\SellerImage', 'seller_id', 'id' );
    }
	
	
	public function SellerAddress() {
         return $this->hasMany('App\DeliveryAddress', 'user_id', 'id' );
    }
	
	public function StoreType() {
         return $this->belongsTo('App\StoreType', 'store_type_id', 'id' );
    }
	
	//Calling From Helper File :: sellerAccountList :: Methods
	public function getSellerList(){
		return Seller::where('user_id','=',Auth::user()->id)->get();
	}
}
