<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class Country extends Model{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'code' , 'lineOpen' , 'logo'];
    
    public function cities()
    {
        return $this->hasMany('App\Http\Models\City' , 'country_id' , 'id' );
    }

}
