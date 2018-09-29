<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message_id' , 'type' , 'message' , 'seen' , 'user_id'];

       //module_id , type , message , user_ids if exsists
	function createMessage($message_id , $type , $message , $user_ids = null)
	{
		$this->create([
             'message_id'=>$message_id,
             'type'      =>$type,
             'message'   =>$message,
             'user_id'   =>$user_ids,
			]);
	}
}
