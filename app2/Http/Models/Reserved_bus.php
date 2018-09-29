<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserved_bus extends Model
{
    protected $fillable = ['supplier_id' , 'bus_id' , 'driver_id' , 'tourist_program_id'];
}
