<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	protected $fillable = ['bill_id' , 'type' , 'message' , 'seen' , 'user_id'];

       //module_id , type , message , user_ids if exsists
	function createNotification($module_id , $type , $message , $user_ids = null)
	{
		$this->create([
             'bill_id'=>$module_id,
             'type'=>$type,
             'message'=>$message,
             'user_id'=>$user_ids,
			]);
	}
}
