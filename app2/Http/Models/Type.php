<?php
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class Type extends Model{

protected $table="work_types";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    
 

}
