<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class CompanyEmail extends Model
{
	protected $fillable = ['email', 'company_id'];
}
