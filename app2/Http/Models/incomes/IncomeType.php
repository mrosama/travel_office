<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class IncomeType extends Model
{
	protected $fillable = ['type'];
    
    public function incomes()
    {
    	return $this->hasMany('App\Income');
    }
}