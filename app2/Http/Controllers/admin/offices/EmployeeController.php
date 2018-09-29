<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Models\Country;
use App\Http\Models\Employee;
use App\Http\Models\Office;
use App\Http\Requests\EmployeeRequest;
use File;
use Redirect;
use App\User;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return view('admin.offices.employee.index' , compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['offices']   = Office::lists('name' , 'id');
        return view('admin.offices.employee.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request , HomeController $upload)
    {
        $data                         = $request->except('user_name' , 'password');
        $data['profile_img']          = $upload->uploadFile($request->profile_img);
        $data['photoPassport']        = $upload->uploadFile($request->photoPassport);
        $data['civil_registry_image'] = $upload->uploadFile($request->civil_registry_image);

        $newEmployee = Employee::create($data);
        User::add($request->user_name , $request->password , $newEmployee->id, "o_emp");
        return Redirect::back()->with('success' , 'تم اضافة الموظف بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('admin.offices.employee.show' , compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['employee']  = Employee::find($id);
        $data['offices']   = Office::lists('name' , 'id');
        return view('admin.offices.employee.edit' , $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, HomeController $upload , $id)
    {
        $employee = Employee::find($id);
        $data                         = $request->except('user_name' , 'password');
        $data['profile_img']          = $upload->updateFile($request->profile_img , $employee->profile_img);
        $data['photoPassport']          = $upload->updateFile($request->photoPassport , $employee->photoPassport);
        $data['civil_registry_image']          = $upload->updateFile($request->civil_registry_image , $employee->civil_registry_image);

        $employee->update($data);
        User::edit($request->user_name , $request->password , $id , "o_emp");
        return Redirect::back()->with('success' , 'تم تعديل بيانات الموظف بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->user->delete();

        if($employee->profile_img != "/noimage.gif")
            File::delete(public_path().$employee->profile_img);
        if($employee->photoPassport != "/noimage.gif")
            File::delete(public_path().$employee->photoPassport);
        if($employee->civil_registry_image != "/noimage.gif")
            File::delete(public_path().$employee->civil_registry_image);
        $employee::delete();
        return Redirect::back()->with('success' , 'تم حذف الموظف بنجاح');
    }
}
