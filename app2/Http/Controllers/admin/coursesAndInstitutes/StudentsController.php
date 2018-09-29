<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StudentsRequest;
use App\Student;
use App\Institute;
use App\Http\Models\Country;
use App\Http\Models\City;
use App\Client;
use Redirect;
use File;

class StudentsController extends Controller
{

    public function index()
    {
        //
    }

    public function create($id)
    {
        if(Institute::find($id) == null)
            return Redirect::route('admin.institutes.index');

        $data['id'] = $id;
        $data['countries'] = Country::lists('name' , 'code'); 
        return view('admin.coursesAndInstitutes.students.create'  , ['data'=>$data]);
    }


    public function store(StudentsRequest $request , Client $upload , $id)
    {
        if($request->photo != null)
            $photo = $upload->uploadFile($request->photo);
        else
            $photo = "/noimage.gif";

        Student::create($request->except("photo") + ['photo'=>$photo , "institute_id"=>$id]);
        return Redirect::back()->with('global_s' , 'لقد تم انشاء الطالب بنجاح');
    }

    public function show($institute_id , $id)
    {
        $data['institute'] = Institute::find($id);
        $data['student']   = Student::find($id);
        return view('admin.coursesAndInstitutes.students.show'  , ['data'=>$data]);
    }


    public function edit($institute_id , $id)
    {
        $data['institute'] = Institute::find($id);
        $data['student']   = Student::find($id);
        $data['countries'] = Country::lists('name' , 'code');
        $data['cities']    = City::where('country_code' , $data['student']->country)->lists('name' , 'id');
        return view('admin.coursesAndInstitutes.students.edit'  , ['data'=>$data]);
    }

    public function update(StudentsRequest $request , Client $upload , $institute_id , $id)
    {
        $student = Student::find($id);

        if($request->photo != null)
        {
            if($student->photo != "/noimage.gif")
                File::delete(public_path().$student->photo);
            $photo = $upload->uploadFile($request->photo);
        }
        else
            $photo = $student->photo;

        $student->update($request->except('photo') + ['photo'=>$photo , "institute_id"=>$institute_id]);
        return Redirect::back()->with('global_s' , 'لقد تم تعديل بيانات الطالب بنجاح');
    }

    public function destroy($institute_id , $id)
    {
        $student = Student::find($id);
        File::delete(public_path().$student->photo);
        $student->delete();

        return Redirect::back()->with('global_s' , 'لقد تم حذف الطالب بنجاح');
    }
}
