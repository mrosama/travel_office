<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
	protected $fillable = ['client_id' , 'receipt'   , 'receipt_photo' , 'country'   , 'city'  , 'flight_type' , 'traveles',
	'date_go'  , 'date_back' , 'dayNumbers'    , 'dayNights' , 'phone' , 'mobile'      , 'email'   ,
	'price_sa' , 'price_ba'  , 'price_us'];




	public function getClientName()
	{
		return $this->belongsTo('App\Client' , 'client_id' , 'id');
	}

	public function getCountryName()
	{
		return $this->belongsTo('App\Http\Models\Country' , 'country' , 'code');
	}

	public function getCityName()
	{
		return $this->belongsTo('App\Http\Models\City' , 'city' , 'id');
	}
}
