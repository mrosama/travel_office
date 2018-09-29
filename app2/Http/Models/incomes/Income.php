<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
	protected $fillable = ['employee_id' , 'income_type_id', 'receipt' , 'bank' , 'receipt_type' , 'receipt_photo' , 'receipt_date' , 'receipt_daily_total' , 'receipt_daily_number' , 'money_source' , 'notes' , 'total'];


	public function getEmployeeName()
	{
		return $this->belongsTo('App\Http\Models\Employee' , 'employee_id' , 'id');
	}

	public function incometype()
	{
		return $this->belongsTo('App\IncomeType' , 'income_type_id' , 'id');
	}

}