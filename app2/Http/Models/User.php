<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'user_name', 'shown_password', 'password' , 'type' , 'user_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    'password', 'remember_token',
    ];

    public static function add($user_name , $password , $user_id , $type)
    {
        self::create([
            'user_name'       => $user_name, 
            'password'        => Hash::make($password), 
            'shown_password'  => $password, 
            'user_id'         => $user_id, 
            'type'            => $type, 
            ]);
    }

    public static function edit($user_name , $password , $id , $type)
    {
        self::where('user_id' , $id)->where('type' , $type)->update([
            'user_name'       => $user_name, 
            'password'        => Hash::make($password), 
            'shown_password'  => $password, 
            ]);
    }
}
