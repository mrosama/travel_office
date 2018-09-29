<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
	protected $fillable = ['employee_id','basic_salary','transportation_allowance','house_allowance','number_extra_hours','number_extra_days','holiday_allowance','other_allowances','amount_deducted','discount_reason','notes'];

	public function employee()
	{
		return $this->belongsTo('App\Http\Models\Employee');
	}
}
