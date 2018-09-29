<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course; 
use App\Http\Models\Country;
use App\Http\Models\City;
use App\Http\Requests\CoursesRequest;
use Redirect;
use App\Client;
use File;

class CoursesController extends Controller
{
	public function index()
	{
		$courses = Course::all();
		return view('admin.coursesAndInstitutes.courses.index' , ['courses'=>$courses , 'i'=>0]);
	}

	public function create()
	{
		$data['countries'] = Country::lists('name' , 'code');
		return view('admin.coursesAndInstitutes.courses.create' , ['data'=>$data]);
	}

	public function store(CoursesRequest $request , Client $upload )
	{
		if($request->advertisment_photo != null)
			$advertisment_photo = $upload->uploadFile($request->advertisment_photo);
		else
			$advertisment_photo = null;

		Course::create($request->except("advertisment_photo") + ['advertisment_photo'=>$advertisment_photo]);
		return Redirect::back()->with('global_s' , 'لقد تم انشاء الدورة بنجاح');
	}

	public function show($id)
	{
		$course = Course::find($id);
		return view('admin.coursesAndInstitutes.courses.show' , ['course'=>$course]);
	}

	public function edit($id)
	{
		$data['course']    = Course::find($id);
		$data['countries'] = Country::lists('name' , 'code');
		$data['cities']             = City::where('country_code' , $data['course']->country)->lists('name' , 'id');
		return view('admin.coursesAndInstitutes.courses.edit' , ['data'=>$data]);
	}

	public function update(CoursesRequest $request , Client $upload , $id)
	{
		$course = Course::find($id);

		if($request->advertisment_photo != null)
		{
			if($course->advertisment_photo != "/noimage.gif")
				File::delete(public_path().$course->advertisment_photo);
			$advertisment_photo = $upload->uploadFile($request->advertisment_photo);
		}
		else
			$advertisment_photo = $course->advertisment_photo;

		$course->update($request->except('advertisment_photo') + ['advertisment_photo'=>$advertisment_photo]);
		return Redirect::back()->with('global_s' , 'لقد تم تعديل بيانات الدورة بنجاح');
	}

	public function destroy($id)
	{
		$course = Course::find($id);
		File::delete(public_path().$course->advertisment_photo);
		$course->delete();
		
		return Redirect::back()->with('global_s' , 'لقد تم حذف الدورة بنجاح');
	}
}
