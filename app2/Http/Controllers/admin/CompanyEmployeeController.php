<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CompanyEmployeeRequest;
use App\company;
use App\CompanySection;
use App\CompanyEmployee;
use App\Client;
use Redirect;

class CompanyEmployeeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$all_employee = CompanyEmployee::all();
		return view('admin.companyEmployee.index' , compact('all_employee'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$all_company = company::lists('name' , 'id');
		return view('admin.companyEmployee.create' , compact('all_company'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CompanyEmployeeRequest $request , Client $upload)
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

		CompanyEmployee::create($input);
		return Redirect::back()->with('success' , 'لقد تمت عملية الاضافة بنجاح');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$all_company = company::all('name' , 'id');
		$employee = CompanyEmployee::find($id);
		$companyId = $employee->companyId;
		$all_section = CompanySection::where('companyId' , $companyId)->get();
		return view('admin.companyEmployee.edit' , compact('employee' , 'all_company' , 'all_section'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(CompanyEmployeeRequest $request, Client $upload ,  $id)
	{
		$employee = CompanyEmployee::find($id);
		
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

	CompanyEmployee::find($id)->update($input);
	return Redirect::back()->with('success' , 'لقد تمت عملية التعديل بنجاح');
}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}


	

	public function getCompanySection()
	{
		$companyId =  $_GET['companyId'];
		$all_section = CompanySection::where('companyId' , $companyId)->get();
		return $all_section;
	}

	public function getEmployeesBySectionId()
	{
		$companyId =  $_GET['companyId'];
		$all_employees = CompanyEmployee::where('companyId' , $companyId)->get();
		return $all_employees;
	}
}
