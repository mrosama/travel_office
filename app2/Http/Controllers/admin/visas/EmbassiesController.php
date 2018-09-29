<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Embassy;
use App\Http\Models\Country;
use App\Http\Models\City;
use App\Http\Requests\EmbassiesRequest;
use Redirect;

class EmbassiesController extends Controller
{
	public function index()
	{
		$data['embassies'] = Embassy::all();
		$data['i'] = 0;
		return view('admin.visas.embassies.index' , $data);
	}
	public function create()
	{
		$data['countries'] = Country::lists('name' , 'code');
		return view('admin.visas.embassies.create' , $data);
	}

	public function store(EmbassiesRequest $request)
	{
		Embassy::create($request->all());
		return Redirect::back()->with('global_s' , "لقد تم اضافة السفارة بنجاح");
	}

	public function edit($id)
	{
		$data['embassy']   = Embassy::find($id);
		$data['countries'] = Country::lists('name' , 'code');
		$data['cities']    = City::where('country_code' , $data['embassy']->country)->lists('name' , 'id');
		return view('admin.visas.embassies.edit' , $data);
	}

	public function update(EmbassiesRequest $request , $id)
	{
		Embassy::find($id)->update($request->all());
		return Redirect::back()->with('global_s' , "لقد تم تعديل بيانات السفارة بنجاح");
	}

	public function show($id)
	{
		$data['embassy']   = Embassy::find($id);
		return view('admin.visas.embassies.show' , $data);
	}

	public function destroy($id)
	{
		$embassy = Embassy::find($id);

		if($embassy->branches->count() != 0)
			foreach($embassy->branches as $branch)
				$branch->delete();

			$embassy->delete();
			
			return Redirect::back()->with('global_s' , "لقد تم حذف السفارة بنجاح");
		}

	}
