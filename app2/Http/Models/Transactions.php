<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
	protected $fillable = ['transaction_type_id' , 'site' , 'paper_work' , 'form' , 'website' , 'country' , 'city' , 'email' , 'mobile' , 'notes'];

	public function transactionType()
	{
		return $this->belongsTo('App\Transactions_type');
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
