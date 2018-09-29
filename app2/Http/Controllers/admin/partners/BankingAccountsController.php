<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
use App\PartnerBankData;
use App\Client;
use App\Notification;
use App\PartnerPayTransfer;
use App\Http\Requests;
use App\Http\Requests\BankingAccoountsRequest;
use Redirect;
use File;
use App\Http\Models\Country;
use App\Http\Models\City;

class BankingAccountsController extends Controller
{

	public function index()
	{
		$accounts = PartnerBankData::all();
		return view('admin.partners.bankingData.index' , ['accounts'=>$accounts , 'i'=>0]);
	}

	
	public function create()
	{
		$partners  = Partner::lists('name' , 'id');
		$countries = Country::lists('name' , 'code');
		return view('admin.partners.bankingData.create' , ['partners'=>$partners , 'countries'=>$countries]);
	}

	public function store(BankingAccoountsRequest $request)
	{
		PartnerBankData::create($request->all());
		return Redirect::back()->with('global_s' , 'لقد تم اضافة الحساب البنكى بنجاح');
	}

	public function show($id)
	{
		$account = PartnerBankData::find($id);
		return view('admin.partners.bankingData.show' , ['account'=>$account]);
	}

	public function edit($id)
	{
		$data['account']   = PartnerBankData::find($id);
		$data['partners']  = Partner::lists('name' , 'id');
		$data['countries'] = Country::lists('name' , 'code');
		$data['cities']    = City::where('country_code' , $data['account']->country)->lists('name' , 'id');
		return view('admin.partners.bankingData.edit' , ['data'=>$data]);
	}

	public function update(BankingAccoountsRequest $request , $id)
	{
		PartnerBankData::find($id)->update($request->all());
		return Redirect::back()->with('global_s' , 'لقد تم تعديل الحساب البنكى بنجاح');
	}

	public function destroy($id)
	{
		PartnerBankData::destroy($id);
		return Redirect::back()->with('global_s' , 'لقد تم حذف الحساب البنكى بنجاح');
	}

}
