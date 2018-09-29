<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions_type extends Model
{
    protected $fillable = ['name'];

    public function transactions()
    {
    	return $this->hasMany('App\Transactions' , 'transaction_type_id');
    }

    public function getCountry()
	{
		return $this->hasOne('App\Http\Models\Country' ,  'code' , 'country');
	}

	public function getCity()
	{
		return $this->hasOne('App\Http\Models\City' , 'id' , 'city');
	}
}
