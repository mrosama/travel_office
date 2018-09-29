<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
use App\partner_employees;
use App\Client;
use App\Notification;
use App\PartnerPayTransfer;
use App\Http\Requests;
use App\Http\Requests\EmployeesRequest;
use Redirect;
use File;
use App\Http\Models\Country;
use App\Http\Models\City;
use App\User;
use App\Nature_work;

class EmployeesController extends Controller {

    public function index() {
        $employees = partner_employees::all();
        return view('admin.partners.employees.index', ['employees' => $employees, 'i' => 0]);
    }

    public function create() {
        $data['nature_work'] = Nature_work::lists('name', 'id');
        $data['countries'] = Country::lists('name', 'code');
        $data['partners'] = Partner::lists('name', 'id');
        return view('admin.partners.employees.create', $data);
    }

    public function store(EmployeesRequest $request) {
        $newEmployee = partner_employees::create($request->except('user_name', 'password'));
        User::add($request->user_name, $request->password, $newEmployee->id, "p_emp");
        return Redirect::back()->with('global_s', 'لقد تم اضافة الموظف بنجاح');
    }

    public function show($id) {
        $employee = partner_employees::find($id);
        return view('admin.partners.employees.show', ['employee' => $employee]);
    }

    public function edit($id) {
        $data['countries'] = Country::lists('name', 'code');
        $data['nature_work'] = Nature_work::lists('name', 'id');
        $data['employee'] = partner_employees::find($id);
        $data['partners'] = Partner::lists('name', 'id');
        return view('admin.partners.employees.edit', $data);
    }

    public function update(EmployeesRequest $request, $id) {
        partner_employees::find($id)->update($request->all());
        User::edit($request->user_name, $request->password, $id, "p_emp");
        return Redirect::back()->with('global_s', 'لقد تم تعديل الموظف بنجاح');
    }

    public function destroy($id) {
        $employee = partner_employees::find($id);
        $employee->user->delete();
        $employee->delete();
        return Redirect::back()->with('global_s', 'لقد تم حذف الموظف بنجاح');
    }

}
