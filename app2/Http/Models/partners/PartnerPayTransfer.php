<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartnerPayTransfer extends Model
{
	protected $table = 'partners_pay_transfer';
	protected $fillable = ['partner_id' , 'required_amount' , 'paid_amount' , 'remaining_amount' , 'pay_from_date' , 'pay_to_date' , 'bill_photo' , 'notes'];

	public function partner()
	{
		return $this->belongsTo('App\Partner');
	}

	public function billsNotifications()
	{
		return $this->hasMany('App\Notification' , 'bill_id');
	}

}
