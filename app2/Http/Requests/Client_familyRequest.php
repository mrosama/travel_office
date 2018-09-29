<?php
namespace App\Http\Requests;
use App\Http\Requests\Request;

class Client_familyRequest extends Request
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {   
    }
}
