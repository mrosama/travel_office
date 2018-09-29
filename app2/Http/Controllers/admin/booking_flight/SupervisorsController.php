<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\Country;
use App\Http\Models\City;
use App\Supervisor;
use App\Upload;
use Session;
use Redirect;

class SupervisorsController extends Controller {

    public function index() {
        $data['supervisors'] = Supervisor::all();
        return view('admin.booking_flight.supervisors.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data['countries'] = Country::lists('name', 'code');
        return view('admin.booking_flight.supervisors.create', $data);
    }

    public function store(Request $request, Upload $upload) {

        $this->validate($request, [
            'name' => 'required', 'nationality' => 'required', 'country' => 'required', 'city' => 'required', 'mobile' => 'required', 'birthDate' => 'required', 'photo' => 'required',
            'motherName' => 'required', 'email' => 'required', 'phone' => 'required', 'fax' => 'required', 'twitter' => 'required', 'instgram' => 'required', 'skype' => 'required',
            'face' => 'required', 'family_card' => 'required', 'passportNumber' => 'required', 'passportIssue' => 'required', 'passportExpire' => 'required', 'passportPlace' => 'required',
            'passportPhoto' => 'required', 'civilRegistry' => 'required', 'civilRegistryPhoto' => 'required'
        ]);

        $data = $request->except('code');
        //upload images
        if ($request->file('photo') != null)
            $data['photo'] = $upload->uploadFile($request->file('photo'), 'supervisors');

        if ($request->file('family_card') != null)
            $data['family_card'] = $upload->uploadFile($request->file('family_card'), 'supervisors');

        if ($request->file('passportPhoto') != null)
            $data['passportPhoto'] = $upload->uploadFile($request->file('passportPhoto'), 'supervisors');

        if ($request->file('civilRegistryPhoto') != null)
            $data['civilRegistryPhoto'] = $upload->uploadFile($request->file('civilRegistryPhoto'), 'supervisors');

        $data['mobile'] = $request->get('code') . $request->get('mobile');

        Supervisor::create($data);
        return Redirect::back()->with('success', 'تم اضافة البيانات بنجاح');
    }

    public function show($id) {
        $data['supervisor'] = Supervisor::find($id);
        return view('admin.booking_flight.supervisors.edit', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $data['supervisor'] = Supervisor::find($id);
        $data['cities'] = City::where('country_code', $data['supervisor']->country)->lists('name', 'id');
        $data['countries'] = Country::lists('name', 'code');
        return view('admin.booking_flight.supervisors.edit', $data);
    }

    public function update(Request $request, Upload $upload, $id) {
        $this->validate($request, [
            'name' => 'required', 'nationality' => 'required', 'country' => 'required', 'city' => 'required', 'mobile' => 'required', 'birthDate' => 'required',
            'motherName' => 'required', 'email' => 'required', 'phone' => 'required', 'fax' => 'required', 'twitter' => 'required', 'instgram' => 'required', 'skype' => 'required',
            'face' => 'required', 'passportNumber' => 'required', 'passportIssue' => 'required', 'passportExpire' => 'required', 'passportPlace' => 'required', 'civilRegistry' => 'required'
        ]);

        $data = $request->all();
        //upload images
        if ($request->file('photo') != null)
            $data['photo'] = $upload->uploadFile($request->file('photo'), 'supervisors');

        if ($request->file('family_card') != null)
            $data['family_card'] = $upload->uploadFile($request->file('family_card'), 'supervisors');

        if ($request->file('passportPhoto') != null)
            $data['passportPhoto'] = $upload->uploadFile($request->file('passportPhoto'), 'supervisors');

        if ($request->file('civilRegistryPhoto') != null)
            $data['civilRegistryPhoto'] = $upload->uploadFile($request->file('civilRegistryPhoto'), 'supervisors');

        //$data['mobile'] = $request->get('code') . $request->get('mobile');
        //dd($data);

        Supervisor::find($id)->update($data);
        return Redirect::back()->with('success', 'تم تعديل البيانات بنجاح');
    }

    public function destroy($id) {
        Supervisor::find($id)->delete();
        return Redirect::back()->with('success', 'تم حذف البيانات بنجاح');
    }

}
