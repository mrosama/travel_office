<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class CompanyPhone extends Model
{
	protected $fillable = ['number', 'company_id'];
}
