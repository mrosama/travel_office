<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Vacation_type;
use Redirect;

class Vacation_typesController extends Controller {

    public function index() {
        $data['vacation_types'] = Vacation_type::all();
        return view('admin.vacation_types.index', $data);
    }

    public function create() {
        return view('admin.vacation_types.create');
    }

    public function store(Request $request) {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        Vacation_type::create($input);
        return redirect()->back()->with('success', '  لقد تمت عملية الاضافة بنجاح');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $data['vacation_type'] = Vacation_type::find($id);
        return view('admin.vacation_types.edit', $data);
    }

    public function update(Request $request, $id) {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        Vacation_type::find($id)->update($input);
        return redirect()->back()->with('success', '  لقد تمت عملية التعديل بنجاح');
    }

    public function destroy($id) {
        Vacation_type::find($id)->delete();
        return Redirect::back()->with('success', 'لقد تمت عملية الحذف  بنجاح');
    }

}
