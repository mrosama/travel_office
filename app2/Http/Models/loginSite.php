<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class loginSite extends Model
{
    protected $fillable = ['name' , 'goal' , 'link' , 'username' , 'password' , 'type' , 'notes'];
}
