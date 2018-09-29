<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\Nature_workRequest;
use App\Nature_work;
use Redirect;

class Nature_workController extends Controller {

    public function index() {
        $data['nature_work'] = Nature_work::all();
        return view('admin.partners.nature_work.index', $data);
    }

    public function create() {
        return view('admin.partners.nature_work.create');
    }

    public function store(Request $request) {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        Nature_work::create($input);
        return redirect()->back()->with('success', '  لقد تمت عملية الاضافة بنجاح');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $data['nature_work'] = Nature_work::find($id);
        return view('admin.partners.nature_work.edit', $data);
    }

    public function update(Request $request, $id) {
        $this->validate($request, ['name' => 'required']);
        $input = $request->all();
        Nature_work::find($id)->update($input);
        return redirect()->back()->with('success', '  لقد تمت عملية التعديل بنجاح');
    }

    public function destroy($id) {
        Nature_work::find($id)->delete();
        return Redirect::back()->with('success', 'لقد تمت عملية الحذف  بنجاح');
    }

}
