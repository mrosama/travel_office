<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TypeRequest extends Request
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
   


        public function rules() {

        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
            'name' => 'required|unique:work_types',


        ];
                }
            case 'PUT':
            case 'PATCH': {

                

                     return [
            'name' => 'required|unique:work_types,name,'. $this->segment(3),
    

        ];
                }
            default:break;
        }
    }
}
