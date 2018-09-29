<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class Office extends Model{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'country','city','street_name','lang','lat','email','employee_num'];
    
    public function getCountry()
    {
        return $this->hasOne('App\Http\Models\Country' ,  'code' , 'country');
    }

    public function getCity()
    {
        return $this->hasOne('App\Http\Models\City' , 'id' , 'city');
    }

    public function employees()
    {
      return $this->hasMany('App\Http\Models\Employee');
  }

  public function user()
  {
    return $this->hasOne('App\User' , 'user_id' , 'id' )->where('type' , "office");
}

}
