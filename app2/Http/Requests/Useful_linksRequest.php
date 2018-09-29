<?php 
namespace App\Http\Requests;
use App\Http\Requests\Request;

class Useful_linksRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return 
        [
            'title' => 'required',
            'link'  =>  'required',
        ];
    }
}


