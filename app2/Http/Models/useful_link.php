<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class useful_link extends Model
{
    protected $fillable = ['title' , 'link' , 'logo' , 'notes'];
}
