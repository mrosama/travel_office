<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class executing_orders extends Model
{
    protected $fillable = ['order_id' , 'price' , 'profit' , 'percentage' , 'total'];
}
