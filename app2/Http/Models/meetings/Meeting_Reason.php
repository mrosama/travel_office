<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting_Reason extends Model
{
	protected $table    = 'meeting_reasons';
    protected $fillable = ['meeting_event_id' , 'employee_id' , 'reason'];
}
