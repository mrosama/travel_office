<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Order_transport extends Model{

protected $table="order_transports";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['country_id' , 'city_from' , 'city_to' , 'transport_type' , 'duration' , 'order_id'];
    
 
    public function get_transport()
    {
         return $this->hasOne('App\TransportType' , 'id' , 'transport_type');
    }

    public function get_country()
    {
         return $this->hasOne('App\Http\Models\Country' ,    'id' ,'country_id' );
    }


    public function get_city_from()
    {
         return $this->hasOne('App\Http\Models\City' ,    'id' ,'city_from' );
    }

      public function get_city_to()
    {
         return $this->hasOne('App\Http\Models\City' ,    'id' ,'city_to' );
    }

}
