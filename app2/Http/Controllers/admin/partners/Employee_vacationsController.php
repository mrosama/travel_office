<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Vacation_type;
use App\Employee_vacation;
use App\partner_employees;

class Employee_vacationsController extends Controller {

    public function index() {
        $data['employee_vacations'] = Employee_vacation::all();
        return view('admin.partners.employee_vacations.index', $data);
    }

    public function create() {
        $data['vacation_types'] = Vacation_type::lists('name', 'id');
        $data['employees'] = partner_employees::lists('name', 'id');
        return view('admin.partners.employee_vacations.create', $data);
    }

    public function store(Request $request) {
        $this->validate($request, ['emp_id' => 'required',
            'vacation_type_id' => 'required',
            'day_number' => 'required',
            'vacation_start' => 'required',
            'vacation_end' => 'required',
            'reason' => 'required',
            'nature' => 'required',
            'remaining' => 'required',
            'previous' => 'required',
            'notes' => 'required'
        ]);
        $input = $request->all();
        Employee_vacation::create($input);
        return redirect()->back()->with('success', '  لقد تمت عملية الاضافة بنجاح');
    }

    public function edit($id) {
        $data['employee_vacation'] = Employee_vacation::find($id);
        $data['vacation_types'] = Vacation_type::lists('name', 'id');
        $data['employees'] = partner_employees::lists('name', 'id');
        return view('admin.partners.employee_vacations.edit', $data);
    }

    public function update(Request $request, $id) {
        $employee_vacation = Employee_vacation::find($id);
        $this->validate($request, ['emp_id' => 'required',
            'vacation_type_id' => 'required',
            'day_number' => 'required',
            'vacation_start' => 'required',
            'vacation_end' => 'required',
            'reason' => 'required',
            'nature' => 'required',
            'remaining' => 'required',
            'previous' => 'required',
            'notes' => 'required'
        ]);
        $input = $request->all();
        $employee_vacation->update($input);
        return redirect()->back()->with('success', '  لقد تمت عملية التعديل بنجاح');
    }

    public function destroy($id) {
        Employee_vacation::find($id)->delete();
        return redirect()->back()->with('success', '  لقد تمت عملية الحذف بنجاح');
    }

}
