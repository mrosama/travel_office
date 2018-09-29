<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting_event extends Model
{
	protected $fillable = ['meeting_id' , 'attendants' , 'file' , 'positive_remarks' , 'negative_remarks' , 'recommendations' , 'notes'];

	public function meeting()
	{
		return $this->belongsTo('App\Meeting');
	}

	public function absences()
	{
		return $this->hasMany('App\Meeting_Reason');
	}
}
