<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model{

	protected $table="employess";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['office_id' , 'nationality' , 'street' , 'latitude' , 'longitude' , 'birth_date' , 'expireResidence' , 'sourceResidence' , 'passportNumber' , 'passport_issue_date' , 'passport_finish_date' , 'sourcePassport' , 'photoPassport' , 'days' , 'hours_from' , 'hours_to' , 'over_time_price' , 'extra_hours_numbers' , 'notes' , 'name', 'mobile','gender','email','salary','civil_registry_number','work_type','civil_registry_image','profile_img','bank_name','iban','account_number','holidays_number','hire_date'
    ];

    public function office()
    {
    	return $this->belongsTo('App\Http\Models\Office');
    }

    public function user()
    {
        return $this->hasOne('App\User' , 'user_id' , 'id' )->where('type' , "o_emp");
    }
}
