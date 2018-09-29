<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Client_family extends Model
{
	protected $fillable = ['type' , 'parent_id' , 'new_client_id'];

	public function client()
	{
		return $this->belongsTo('App\Client' , 'new_client_id' , 'id');
	}

	public function parentClient()
	{
		return $this->belongsTo('App\Client' , 'parent_id' , 'id');
	}
}
