<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transactions_type;
use App\Http\Requests\TransactionsTypeRequest;
use Redirect;

class TransactionsTypesController extends Controller
{
	public function index()
	{
		$transactions_types = Transactions_type::all();
		return view('admin.transactions.types.index' , ['transactions_types'=>$transactions_types , 'i'=>0]);
	}
	
	public function create()
	{
		return view('admin.transactions.types.create');
	}

	public function store(TransactionsTypeRequest $request)
	{
		Transactions_type::create($request->all());
		return Redirect::back()->with('global_s' , 'لقد تم اضافة نوع المعاملة بنجاح');
	}


	public function edit($id)
	{
		$transactions_type = Transactions_type::find($id);
		return view('admin.transactions.types.edit' , ['transactions_type'=>$transactions_type]);
	}

	public function update(TransactionsTypeRequest $request , $id)
	{
		$transactions_type = Transactions_type::find($id);
		$transactions_type->update($request->all());
		return Redirect::back()->with('global_s' , 'لقد تم تعديل نوع المعاملة بنجاح');
	}

	public function destroy($id)
	{
		$transactions_type = Transactions_type::find($id);

         //delete related transactions
		if($transactions_type->transactions != null)
		{
			foreach ($transactions_type->transactions as $transaction) {
				\File::delete(public_path().$transaction->form);
				$transaction->delete();
			}
		}

		$transactions_type->delete();

		return Redirect::back()->with('global_s' , 'لقد تم حذف نوع المعاملة بنجاح');
	}
}
