<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DriverRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
        'supplier_id' => 'required|numeric',
        'name' => 'required',
        'age' => 'required',
        'nationality' => 'required',
        'country' => 'required',
        'city' => 'required',
        'card_number' => 'required',
        "licence"=>"required",
        "licence_img"=>"image",
        "photo"=>"image",
        "notes"=>"required",
        ];
        foreach( range(0 , count($this->mobile) - 1) as $mobile){
            $rules['mobile.'.$mobile] = 'required';
            break;
        }
        return $rules;
    }
}
