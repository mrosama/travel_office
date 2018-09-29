<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Client_order extends Model{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['client_id', 'id_wife' ,'id_child' , 'order_type' , 'country_from' , 'city_from' ,'country_to' ,'city_to'];


    public function get_client_name()
    {
        return $this->hasOne('App\Client' ,  'id' ,'client_id' );
    }

    public function get_wife_name()
    {
        return $this->hasOne('App\Client_family' ,  'new_client_id' ,'id_wife' );
    }

    public function country_order()
    {
       return $this->belongsTo('App\Http\Models\Country' , 'id' , 'country_id');
    }


}
