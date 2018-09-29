<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Orders_typeRequest;
use App\Orders_type;
use Redirect;


class Orders_typesController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$all_types = Orders_type::all();
		return view('admin.orders_types.index' , compact('all_types'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.orders_types.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Orders_typeRequest $request)
	{
		Orders_type::create($request->all());
		return Redirect::back()->with('success' , 'لقد تمت عملية الاضافة بنجاح !');
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
		$order_type = Orders_type::find($id);
		return view('admin.orders_types.edit' , compact('order_type'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Orders_typeRequest $request, $id)
	{
		$data = $request->all();
		Orders_type::find($id)->update($data);
		return Redirect::back()->with('success' , 'لقد تم عملية التعديل بنجاح !');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		Orders_type::find($id)->destroy($id);
		return Redirect::back()->with('success' , 'لقد تمت عملية الحذف بنجاح !');
	}
}
