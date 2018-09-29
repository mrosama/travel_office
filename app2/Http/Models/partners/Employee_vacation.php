<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee_vacation extends Model {

    protected $fillable = ['emp_id', 'vacation_type_id', 'day_number', 'vacation_start', 'vacation_end', 'reason', 'nature', 'remaining', 'previous', 'notes'];

    public function Employee() {
        return $this->hasOne('App\partner_employees', 'id', 'emp_id');
    }
    
    public function Vacation_type() {
        return $this->hasOne('App\Vacation_type', 'id', 'vacation_type_id');
    }

}
