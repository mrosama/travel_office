<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transactions;
use Redirect;
use App\Transactions_type;
use App\Http\Models\Country;
use App\Http\Models\City;
use App\Http\Requests\TransactionsRequest;
use App\Client;
use File;

class TransactionsController extends Controller
{
	public function index()
	{
		$transactions = Transactions::all();
		return view('admin.transactions.index' , ['transactions'=>$transactions , 'i'=>0]);
	}
	
	public function create()
	{
		$data['transactions_types'] = Transactions_type::lists('name' , 'id');
		$data['countries'] = Country::lists('name' , 'code');
		return view('admin.transactions.create' , ['data'=>$data]);
	}

	public function store(TransactionsRequest $request , Client $upload)
	{
		if($request->form != null)
			$form = $upload->uploadFile($request->form);
		else
			$form = null;

		Transactions::create($request->except('form') + ['form'=>$form]);
		return Redirect::back()->with('global_s' , 'لقد تم اضافة المعاملة بنجاح');
	}

	public function show($id)
	{
		$transaction = Transactions::find($id);
		return view('admin.transactions.show' , ['transaction'=>$transaction]);
	}

	public function edit($id)
	{
		$data['transaction']        = Transactions::find($id);
		$data['transactions_types'] = Transactions_type::lists('name' , 'id');
		$data['countries']          = Country::lists('name' , 'code');
		$data['cities']             = City::where('country_code' , $data['transaction']->country)->lists('name' , 'id');
		return view('admin.transactions.edit' , ['data'=>$data]);
	}

	public function update(TransactionsRequest $request , Client $upload , $id)
	{
		$transaction = Transactions::find($id);

		if($request->form != null)
		{
			if($transaction->form != "/noimage.gif")
				File::delete(public_path().$transaction->form);
			$form = $upload->uploadFile($request->form);
		}
		else
			$form = $transaction->form;

		$transaction->update($request->except('form') + ['form'=>$form]);
		return Redirect::back()->with('global_s' , 'لقد تم تعديل المعاملة بنجاح');
	}

	public function destroy($id)
	{
		$transaction = Transactions::find($id);
		File::delete(public_path().$transaction->form);
		$transaction->delete();
		
		return Redirect::back()->with('global_s' , 'لقد تم حذف المعاملة بنجاح');
	}
}
