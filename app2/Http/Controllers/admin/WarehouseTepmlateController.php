<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\WarehouseTepmlate;
use Redirect;

class WarehouseTepmlateController extends Controller {

    public function index() {
        $data['templates'] = WarehouseTepmlate::all();
        return view('admin.warehouse_template.index', $data);
    }

    public function create() {
        return view('admin.warehouse_template.create');
    }

    public function store(Request $request) {
        $data = $request->all();
        $rules = ['title' => 'required', 'type' => 'required', 'attachment' => 'required'];
        $this->validate($request, $rules);
        if ($request->hasFile('attachment')) {
            $data['attachment'] = uploadFile('images/warehouse_template', $request->attachment);
        }
        WarehouseTepmlate::create($data);
        return Redirect::back()->with('success', 'لقد تم الاضافة بنجاح');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $data['template'] = WarehouseTepmlate::find($id);
        return view('admin.warehouse_template.edit', $data);
    }

    public function update(Request $request, $id) {
        $data = $request->all();
        $template = WarehouseTepmlate::find($id);
        $rules = ['title' => 'required', 'type' => 'required'];
        $this->validate($request, $rules);
        if ($request->hasFile('attachment')) {
            $data['attachment'] = uploadFile('images/warehouse_template', $request->attachment);
            \File::delete($template->attachment);
        }
        $template->update($data);
        return Redirect::back()->with('success', 'لقد تم التعديل بنجاح');
    }

    public function destroy($id) {
        $template = WarehouseTepmlate::find($id);
        \File::delete($template->attachment);
        $template->destroy($id);
        return Redirect::back()->with('success', 'لقد تم التعديل بنجاح');
    }

}
