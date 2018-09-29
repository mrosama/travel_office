<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\DesignerAdvertising;

class DesignerAdvertisingController extends Controller {

    public function index() {
        $data['page_title'] = 'اضافة مصمم جديد';
        $data['designers'] = DesignerAdvertising::all();
        return view('admin.designer_advertising.index', $data);
    }

    public function create() {
        return view('admin.designer_advertising.create');
    }

    public function store(Request $request) {
        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'skype' => 'required'
        ];
        $this->validate($request, $rules);
        DesignerAdvertising::create($request->all());
        return Redirect()->back()->with('success', 'تمت عملية الاضافة بنجاح');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $data['page_title'] = 'تعديل بيانات المصمم';
        $data['designer'] = DesignerAdvertising::find($id);
        return view('admin.designer_advertising.edit', $data);
    }

    public function update(Request $request, $id) {
        $rules = [
            'name' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'skype' => 'required'
        ];
        $this->validate($request, $rules);
        DesignerAdvertising::find($id)->update($request->all());
        return Redirect()->back()->with('success', 'تمت عملية التعديل بنجاح');
    }

    public function destroy($id) {
        DesignerAdvertising::find($id)->destroy($id);
        return Redirect()->back()->with('success', 'تمت عملية الحذف بنجاح');
    }

}
