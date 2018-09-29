<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\loginSiteRequest;
use App\loginSite;
use Redirect;
class loginSiteController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$all_loginSite = loginSite::all();
		return view('admin.loginSite.index' , compact('all_loginSite'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('admin.loginSite.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(loginSiteRequest $request)
	{
		loginSite::create($request->all());
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
		$loginSite = loginSite::find($id);
		return view('admin.loginSite.edit' , compact('loginSite'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(loginSiteRequest $request, $id)
	{
		loginSite::find($id)->update($request->all());
		return Redirect::back()->with('success' , 'لقد تمت عملية التعديل بنجاح !');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		loginSite::find($id)->destroy($id);
		return Redirect::back()->with('success' , 'لقد تمت عملية الحذف بنجاح !');
	}
}
