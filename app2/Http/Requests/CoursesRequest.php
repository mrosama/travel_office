<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CoursesRequest extends Request
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
        return [
        "name"=>"required",
        "country"=>"required",
        "city"=>"required",
        "type"=>"required",
        "duration_in_days"=>"required",
        "duration_in_weeks"=>"required",
        "duration_in_month"=>"required",
        "start_date"=>"required",
        "end_date"=>"required",
        "level"=>"required",
        "language"=>"required",
        "dayly_hours"=>"required",
        "total_hours"=>"required",
        "price"=>"required",
        "conditions"=>"required",
        "advertisment_date"=>"required",
        "advertisment_duration"=>"required",
        "advertisment_photo"=>"image",
        ];
    }
}
