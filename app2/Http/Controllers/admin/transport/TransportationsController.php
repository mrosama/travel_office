<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Transportation;

class TransportationsController extends Controller {

    public function index() {
        $data['transporations'] = Transportation::all();
        return view('admin/transportations/index', $data);
    }

    public function create() {
        return view('admin/transportations/create');
    }

    public function store(Request $request) {
        $this->validate($request, ['transName' => 'required']);
        Transportation::create($request->all());
        return redirect()->back()->with('success', 'تمت عملية الاضافة بنجاح');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $data['transportation'] = Transportation::find($id);
        return view('admin/transportations/edit', $data);
    }

    public function update(Request $request, $id) {
        $this->validate($request, ['transName' => 'required']);
        Transportation::find($id)->update($request->all());
        return redirect()->back()->with('success', 'تمت عملية التحديث بنجاح');
    }

    public function destroy($id) {
        Transportation::find($id)->destroy($id);
        return redirect()->back()->with('success', 'تمت عملية الحذف بنجاح');
    }

}
