<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\MeetingPlace;
use Redirect;
use URL;

class MeetingPlacesController extends Controller {

    public function index() {
        $data['places'] = MeetingPlace::all();
        return view('admin.meetings.places.index', $data);
    }

    public function create() {
        return view('admin.meetings.places.create');
    }

    public function store(Request $request) {
        $rules = ['place' => 'required'];
        $this->validate($request, $rules);
        MeetingPlace::create($request->all());
        return Redirect::to(URL::to('/admin/meeting_places'))->with('success', 'لقد تمت عملية الاضافة بنجاح');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $data['place'] = MeetingPlace::find($id);
        return view('admin.meetings.places.edit', $data);
    }

    public function update(Request $request, $id) {
        $rules = ['place' => 'required'];
        $this->validate($request, $rules);
        MeetingPlace::find($id)->update($request->all());
        return Redirect::to(URL::to('/admin/meeting_places'))->with('success', 'لقد تمت عملية التحديث بنجاح');
    }

    public function destroy($id) {
        MeetingPlace::find($id)->destroy($id);
        return Redirect::to(URL::to('/admin/meeting_places'))->with('success', 'لقد تمت عملية التحديث بنجاح');
    }

}
