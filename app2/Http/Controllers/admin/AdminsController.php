<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\BillRequest;
use Redirect;
use App\Admin;
use App\User;
use App\Http\Requests\AdminRequest;

class AdminsController extends Controller
{
	public function index()
	{
		$data['admins'] = Admin::all();
		$data['i']      = 0;
		return view('admin.admins.index' , $data);
	}

	public function create()
	{
		return view('admin.admins.create');
	}


	public function store(AdminRequest $request)
	{   
		$data = $request->except('user_name' , 'password');
		$newAdmin = Admin::create($data);
		User::add($request->user_name , $request->password , $newAdmin->id, "admin");
		return Redirect::back()->with('global_s' , 'لقد تم اضافة المدير بنجاح');
	}

	public function show($id)
	{
        //
	}

	public function edit($id)
	{
		$data['admin'] = Admin::find($id);
		return view('admin.admins.edit', $data);
	}

	public function update(AdminRequest $request , $id)
	{
		Admin::find($id)->update($request->except('user_name' , 'password'));
		User::edit($request->user_name , $request->password , $id , "admin");
		return Redirect::back()->with('global_s' , 'لقد تم تعديل بيانات المدير بنجاح');
	}

	public function destroy($id)
	{
		$admin = Admin::find($id);
		$admin->user->delete();
		$admin->delete();
		return Redirect::back()->with('success' , 'لقد تمت عملية الحذف بنجاح ! ');
	}
}
