<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class CompanyFax extends Model
{
	protected $table = "company_faxs";
	protected $fillable = ['fax', 'company_id'];
}
