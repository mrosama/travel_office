<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\MeetingType;
use Redirect;
use URL;

class MeetingTypesController extends Controller {

    public function index() {
        $data['types'] = MeetingType::all();
        return view('admin.meetings.types.index', $data);
    }

    public function create() {
        return view('admin.meetings.types.create');
    }

    public function store(Request $request) {
        $rules = ['type' => 'required'];
        $this->validate($request, $rules);
        MeetingType::create($request->all());
        return Redirect::to(URL::to('/admin/meeting_types'))->with('success', 'لقد تمت عملية الاضافة بنجاح');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $data['type'] = MeetingType::find($id);
        return view('admin.meetings.types.edit', $data);
    }

    public function update(Request $request, $id) {
        $rules = ['type' => 'required'];
        $this->validate($request, $rules);
        MeetingType::find($id)->update($request->all());
        return Redirect::to(URL::to('/admin/meeting_types'))->with('success', 'لقد تمت عملية التحديث بنجاح');
    }

    public function destroy($id) {
        MeetingType::find($id)->destroy($id);
        return Redirect::to(URL::to('/admin/meeting_types'))->with('success', 'لقد تمت عملية التحديث بنجاح');
    }

}
