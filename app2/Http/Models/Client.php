<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'username_en', 'nationality', 'userType' ,'country', 'city', 'code' ,'mobile' ,  'birth_date' , 'photo' , 'mother_name' , 'email_address',
    'phone' , 'fax' ,  'skype' , 'twitter' , 'instgram' , 'facebook' ,'family_card' , 'passport_number' , 'issue_date' , 'expire_date' , 'passport_issue_place'  , 'passpot_copy' ,
    'notes' , 'residence_number', 'residence_copy', 'civil_registry_number' , 'id_number' , 'license_copy' , 'license_issue_date' ,
    'license_expire_date' , 'conservation_number','issuer'];

    public function mobile()
    {
        return $this->hasMany('App\Http\Models\Client_mobile');
    }

    public function getCountry()
    {
        return $this->belongsTo('App\Http\Models\Country' , 'country' , 'code');
    }
    
    public function getCityName()
    {
        return $this->belongsTo('App\Http\Models\City' , 'city' , 'id' );
    }

    public function user()
    {
        return $this->hasOne('App\User' , 'user_id' , 'id' )->where('type' , "client");
    }

    public function uploadFile($file , $fileName = null)
    {
       $destinationPath = public_path().'/images/';

       if($fileName == null)
           $fileName = str_replace(' ' , '_' , str_random(15).'.'.$file->getClientOriginalExtension());
       else
         $fileName = str_replace(' ', '_' , $file->getClientOriginalName());

     $file->move($destinationPath , $fileName);
     return '/images/'.$fileName;
 } 

}
