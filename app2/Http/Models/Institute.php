<?php
namespace App;
use Illuminate\Database\Eloquent\Model;


class Institute extends Model
{
	protected $fillable = ['country_code' , 'city' , 'name' , 'phone' , 'mobile' , 'web_site' , 'postal_code' , 'address'];
    
    public function students()
    {
    	return $this->hasMany('App\Student');
    }

	public function getCountry()
	{
		return $this->belongsTo('App\Http\Models\Country' , 'country_code' , 'code');
	}

	public function getCity()
	{
		return $this->belongsTo('App\Http\Models\City' , 'city' , 'id' );
	}
}
