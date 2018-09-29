<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
	protected $fillable = ['name' , 'email' , 'mobile' , 'phone'];
	
	public function user()
	{
		return $this->hasOne('App\User' , 'user_id' , 'id' )->where('type' , "admin");
	}

}
