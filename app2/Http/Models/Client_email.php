<?php
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Client_email extends Model
{
    protected $fillable = ['email', 'client_id'];
}
