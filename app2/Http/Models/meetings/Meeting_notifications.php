<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting_notifications extends Model
{
    protected $fillable = ['meeting_id' , 'user_id' , 'message' , 'seen'];
}
