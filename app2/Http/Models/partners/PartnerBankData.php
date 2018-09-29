<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerBankData extends Model
{
	protected $table = 'partners_banking_data';
	protected $fillable = ['partner_id' , 'country' , 'city' , 'bank_name' , 'iban' , 'bank_number' , 'bank_account_owner' , 'other' , 'notes'];

	public function partner()
	{
		return $this->belongsTo('App\Partner');
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
