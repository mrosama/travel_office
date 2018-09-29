<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CompanySectionRequest;
use App\company;
use App\CompanySection;
use Redirect;

class CompanySectionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$all_sections = CompanySection::all();
		$all_company = Company::all();
		return view('admin.companySection.index' , compact('all_sections' , 'all_company'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$all_company = company::lists('name' , 'id');
		return view('admin.companySection.create' , compact('all_company'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(CompanySectionRequest $request)
	{
		CompanySection::create($request->all());
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
		$all_company     = company::all();
		$companySection = CompanySection::find($id);
		return view('admin.companySection.edit' , compact('all_company' , 'companySection'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(CompanySectionRequest $request, $id)
	{
		$data = $request->all();
		CompanySection::find($id)->update($data);
		 return Redirect::back()->with('success' , 'لقد تمت عملية الاضافة بنجاح');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		CompanySection::find($id)->destroy($id);
		return Redirect::back()->with('success' , 'لقد تمت عملية الحذف بنجاح');
	}
}
