<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Trip;
use Redirect;

class TripsController extends Controller {

    public function index() {
        $data['trips'] = Trip::all();
        return view('admin.trips.index', $data);
    }

    public function create() {
        return view('admin.trips.create');
    }

    public function store(Request $request) {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        Trip::create($input);
        return redirect()->back()->with('success', '  لقد تمت عملية الاضافة بنجاح');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $data['trip'] = Trip::find($id);
        return view('admin.trips.edit', $data);
    }

    public function update(Request $request, $id) {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        Trip::find($id)->update($input);
        return redirect()->back()->with('success', '  لقد تمت عملية التعديل بنجاح');
    }

    public function destroy($id) {
        Trip::find($id)->delete();
        return Redirect::back()->with('success', 'لقد تمت عملية الحذف  بنجاح');
    }

}
