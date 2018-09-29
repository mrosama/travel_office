<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Travel_employeeRequest;
use App\Travel_employee;
use App\Travel_office;
use App\Travel_section;
use App\Client;
use Redirect;





class Travel_employeesController extends Controller
{

    public function index()
    {
        $all_employee = Travel_employee::all();
        return view('admin.travel_employee.index', compact('all_employee'));
    }


    public function create()
    {
        $all_office = Travel_office::lists('name' , 'id');
        return view('admin.travel_employee.create' , compact('all_office'));
    }

    public function store(Travel_employeeRequest $request , Client $upload)
    {

        $input = $request->all(); 

        if($request->photoResidence != null)
            $photoResidence = $upload->uploadFile($request->photoResidence);
        else
            $photoResidence = "/noimage.gif";
        $input['photoResidence'] = $photoResidence;


        if($request->emp_photo != null)
            $emp_photo = $upload->uploadFile($request->emp_photo);
        else
            $emp_photo = "/noimage.gif";
        $input['emp_photo'] = $emp_photo;


        if($request->photoPassport != null)
            $photoPassport = $upload->uploadFile($request->photoPassport);
        else
            $photoPassport = "/noimage.gif";
        $input['photoPassport'] = $photoPassport;

        Travel_employee::create($input);
        return Redirect::back()->with('success' , 'لقد تمت عملية الاضافة بنجاح');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $all_office = Travel_office::all();
        $employee = Travel_employee::find($id);
        $travel_officeId = $employee->travel_officeId;
        $all_section = Travel_section::where('travel_officeId' , $travel_officeId)->get();
        return view('admin.travel_employee.edit' , compact('employee' , 'all_office' , 'all_section'));
    }


    public function update(Travel_employeeRequest $request,  Client $upload  , $id )
    {

        $employee = Travel_employee::find($id);
        
        $input = $request->all(); 

        if($request->emp_photo != null)
        {
            if($employee->emp_photo != "/noimage.gif")
            {
                \File::delete(public_path().$employee->emp_photo); 
            }
            $emp_photo = $upload->uploadFile($request->emp_photo);
        }
        else
        {
            $emp_photo = $employee->emp_photo;
        }
        $input['emp_photo'] = $emp_photo;


        if($request->photoResidence != null)
        {
            if($employee->photoResidence != "/noimage.gif")
            {
                \File::delete(public_path().$employee->photoResidence); 
            }
            $photoResidence = $upload->uploadFile($request->photoResidence);
        }
        else
        {
            $photoResidence = $employee->photoResidence;
        }
        $input['photoResidence'] = $photoResidence;


        if($request->photoPassport != null)
        {
          if($employee->photoPassport != "/noimage.gif")
          {
            \File::delete(public_path().$employee->photoPassport); 
        }
        $photoPassport = $upload->uploadFile($request->photoPassport);
    }
    else
    {
        $photoPassport = $employee->photoPassport;
    }
    $input['photoPassport'] = $photoPassport;

    Travel_employee::find($id)->update($input);
    return Redirect::back()->with('success' , 'لقد تمت عملية التعديل بنجاح');
}


public function destroy($id)
{
 Travel_employee::find($id)->destroy($id);
 return Redirect::back()->with('success' , 'لقد تمت عملية الحذف بنجاح');
}


public function getTravelSection()
{
    $travel_officeId =  $_GET['travel_officeId'];
    $all_section = Travel_section::where('travel_officeId' , $travel_officeId)->get();
    return $all_section;
}


public function getEmployeesBySectionId()
{
    $companyId =  $_GET['travel_officeId'];
    $all_employees = Travel_employee::where('travel_officeId' , $travel_officeId)->get();
    return $all_employees;
}
}
