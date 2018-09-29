<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Client_mobile extends Model{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code' , 'number', 'client_id'];


}
