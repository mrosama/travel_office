<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Models\Country;
use App\Http\Models\City;
use App\Http\Models\Office;
use App\Http\Requests\OfficeRequest;
use App\User;
use Redirect;


class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = Office::all();
        return view('admin.offices.index' , compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::lists('name' , 'code');
        return view('admin.offices.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfficeRequest $request)
    {
        $newOffice = Office::create($request->except('user_name' , 'password'));
        User::add($request->user_name , $request->password , $newOffice->id, "office");
        return Redirect::back()->with('success' , 'تم اضافة المكتب بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['office']    = Office::find($id);
        return view('admin.offices.show' , $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['office']    = Office::find($id);
        $data['countries'] = Country::lists('name' , 'code');
        $data['cities']    = City::where('country_code' , $data['office']->country)->lists('name' , 'id');

        return view('admin.offices.edit' , $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfficeRequest $request, $id)
    {
        $Office = Office::find($id)->update($request->except('user_name' , 'password'));
        User::edit($request->user_name , $request->password , $id , "office");
        return Redirect::back()->with('success' , 'تم تعديل البيانات بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $office = Office::find($id);
        $office->user->delete();

        if($office->employees->count() != 0)
        {
            foreach($office->employees as $employee)
            {
                if($employee->profile_img != "/noimage.gif")
                    File::delete(public_path().$employee->profile_img);
                $employee->delete();
            }
        }

        $office->delete();
        return Redirect::back()->with('success' , 'تم حذف المكتب بنجاح');
    }
}
