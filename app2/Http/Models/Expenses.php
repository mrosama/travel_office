<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
	protected $fillable = ['exchangeType_id' , 'income_date' , 'income_period' , 'amount_paid' , 'remaning_amount', 'total_amount' ,'notes' , 'attachment'];

	
	public function getExchangeType()
	{
		return $this->belongsTo('App\exchangeType' , 'exchangeType_id' , 'id');
	}


}
