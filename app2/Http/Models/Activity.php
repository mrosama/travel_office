<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['event' , 'time' , 'duration' , 'tourist_program_id'];
}
