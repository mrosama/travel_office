<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\exchangeTypeRequest;
use App\exchangeType;
use Redirect;

class exchangeTypeController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data['all_exchangeType'] = exchangeType::all();
		return view('admin.exchangeType.index' , $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.exchangeType.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(exchangeTypeRequest $request)
	{
		exchangeType::create($request->all());
		return Redirect::back()->with('success' , 'تمت عملية الاضافة بنجاح');
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
		$data['exchangeType'] = exchangeType::find($id);
		return view('admin.exchangeType.edit' , $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(exchangeTypeRequest $request, $id)
	{
		exchangeType::find($id)->update($request->all());
		return Redirect::back()->with('success' , 'تم عملية التعديل بنجاح !');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		exchangeType::find($id)->destroy($id);
		return Redirect::back()->with('success' , 'تم عملية الحذف بنجاح !');
	}

	public function getDuration()
	{
		return exchangeType::find($_GET['exchangeType_id']);

		//return exchangeType::select('duration')->where('id',$_GET['exchangeType_id'])->first();
	}
}
