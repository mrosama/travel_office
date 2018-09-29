<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Redirect;
use App\Embassy_branches;
use App\Embassy;
use App\Http\Models\Country;
use App\Http\Models\City;
use App\Http\Requests\Embassy_branchesRequest;

class EmbassybranchesController extends Controller
{
	public function index()
	{
		$data['branches']  = Embassy_branches::all();
		$data['i'] = 0;
		return view('admin.visas.embassy_branches.index' , $data);
	}
	public function create()
	{
		$data['countries'] = Country::lists('name' , 'code');
		$data['embassies'] = Embassy::lists('name' , 'id');
		return view('admin.visas.embassy_branches.create' , $data);
	}

	public function store(Embassy_branchesRequest $request)
	{
		Embassy_branches::create($request->all());
		return Redirect::back()->with('global_s' , "لقد تم اضافة الفرع بنجاح");
	}

	public function edit($id)
	{
		$data['embassies'] = Embassy::lists('name' , 'id');
		$data['branch']    = Embassy_branches::find($id);
		$data['countries'] = Country::lists('name' , 'code');
		$data['cities']    = City::where('country_code' , $data['branch']->country)->lists('name' , 'id');
		return view('admin.visas.embassy_branches.edit' , $data);
	}

	public function update(Embassy_branchesRequest $request , $id)
	{
		Embassy_branches::find($id)->update($request->all());
		return Redirect::back()->with('global_s' , "لقد تم تعديل بيانات الفرع بنجاح");
	}

	public function show($id)
	{
		$data['branch']   = Embassy_branches::find($id);
		return view('admin.visas.embassy_branches.show' , $data);
	}

	public function destroy($id)
	{
		Embassy_branches::destroy($id);
		return Redirect::back()->with('global_s' , "لقد تم حذف الفرع بنجاح");
	}
}
