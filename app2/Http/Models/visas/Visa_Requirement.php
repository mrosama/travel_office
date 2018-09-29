<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visa_Requirement extends Model
{
	protected $fillable = ['visa_id' , 'requirement'];
	protected $table = "visa_requirements";

	public function createRequirement($requirements , $id)
	{
		foreach($requirements as $requirement)
		{
			$this->create([
				'visa_id'=>$id,
				'requirement'=>$requirement,
				]);
		}
	}

	public function editRequirement($requirements , $id)
	{
		foreach ($this->where('visa_id' , $id)->get() as $key ) 
			$key->delete();

		if($requirements != null)
		{
			foreach($requirements as $requirement)
			{
				$this->create([
					'visa_id'=>$id,
					'requirement'=>$requirement,
					]);
			}
		}
	}
}
